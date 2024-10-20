<template>
  <div>
    <h1>Edit post</h1>

    <div>
      <div v-if="errors.length > 0" class="alert alert-danger">
        <li v-for="error in errors" >
          {{error[0]}}
          </li>
      </div>
      <h3>Title</h3>
      <input type="text" class="form-control" name="title" v-model="title" />
      <h4>Tags</h4>
      <div class="input-group mb-3">
        <input type="text" class="form-control" v-model="tag" />
        <div class="input-group-append">
          <button class="btn btn-outline-secondary" type="button" @click="addTag">Add</button>
        </div>
      </div>
      <div class="row">
       
        <div v-for="t in tags" class="col-">
          <div v-if="!t.confirmed" class="rounded border border-danger">
            <b>{{ t.tag }}</b>
            <button class="btn btn-danger" @click="removeTag(t)">X</button>
          </div>

          <div v-else class="rounded border border-success">
            <b>{{ t.tag }}</b>
            <button class="btn btn-danger">X</button>
          </div>
        </div>
      </div>

      <h4>Content</h4>
      <textarea class="form-control" rows="10" v-model="content"></textarea>
      <h4>Images</h4>
      <div class="input-group mb-3">
        <input type="file" class="form-control" v-on:change="fileChange" />
      </div>
      <div v-for="img in uimages">
        {{ img.name }}
        <button @click="removeFile(img)">Remove</button>
      </div>
      <div v-for="img in images">
        <img :src="'publicImg/'+ img.location " />
        <button @click="removeImg(img)">Remove</button>
      </div>
    </div>
    <button class="btn btn-success form-control" @click="save">Save</button>
    <hr />
    <button class="btn btn-danger form-control" @click="deletePost">Delete</button>
  </div>
</template>


<script>
export default {
  data() {
    return {
      title: "",
      tag: "",
      tags: [],
      content: "",
      uimages: [],
      images: [],
      errors: []
    };
  },
  mounted() {
    if(editCode != -1){
    axios
      .get("/api/postData/" + editCode)
      .then(response => {
        this.title = response.data.title;
        this.tags = response.data.tags;
        this.content = response.data.content;
        this.images = response.data.images;
      })
      .catch(response => {
        console.log("Error " + response);
        if(response.response.status == 401){
            alert("You need to login!");
          }else if(response.response.status == 404){
             window.location = "/";
          }
      });
    }
  },
  methods: {
    addTag: function() {
      this.tags.push({ tag: this.tag, confirmed: false });
      this.tag = "";
    },
    removeTag: function($tag) {
      this.tags.splice($tag, 1);
    },
    fileChange(e) {
      var files = e.target.files || e.dataTransfer.files;
      if (!files.length) return;
      this.uimages.push(files[0]);
    },
    removeFile(f) {
      this.uimages.splice(f, 1);
    },
    save() {
      this.errors = [];
      var mTag = [];
      this.tags.forEach(function(item) {
        mTag.push(item["tag"]);
      });
      axios
        .post(postLink, {
          title: this.title,
          tags: mTag,
          content: this.content,
          code: editCode
        })
        .then(response => {
          console.log(response);
          editCode = response.id;
          for(var key in this.uimages){
            var img = this.uimages[key];
    
          
            //upload the images
            let form = new FormData();

            form.append("image", img);
            form.append("post", response.data.id);
           
            axios
              .post(imagesLink, form)
              .then(function(response) {
               
                this.images.push(response.data);

              }.bind(this))
              .catch(function(response) {
                console.log("error2 "+response);
                this.errors.push(response.response.data.errors["image"]);
              });
          }
          this.uimages = [];
        })
        .catch(response => {
            console.log("error "+response);
            if(response.response.status == 401){
            alert("You need to login!");
          }
            for(var key in response.response.data.errors){
              this.errors.push(response.response.data.errors[key]);
            }
            
         
        });
    },
    removeImg(img) {
      axios
        .delete("/api/image/"+img.location)
        .then(response => {
          this.images.splice(img, 1);
        })
        .catch(response => {
          if(response.response.status == 401){
            alert("You need to login!");
          }
          console.log("Error " + response);
        });
    },
    deletePost() {
      axios
        .delete("/api/post/"+editCode)
        .then(response => {
         window.location = "/";
        })
        .catch(response => {
          if(response.response.status == 401){
            alert("You need to login!");
          }
          console.log("Error " + response);
        });
    }
  }
};
</script>
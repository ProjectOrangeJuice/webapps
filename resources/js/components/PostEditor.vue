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
          <div v-if="!t.approved" class="rounded border border-danger">
            <b>{{ t.name }}</b>
            <button class="btn btn-danger" @click="removeTag(t)">X</button>
          </div>

          <div v-else class="rounded border border-success">
            <b>{{ t.name }}</b>
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
    <button class="btn btn-danger form-control">Delete</button>
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
    axios
      .get("/postData/" + editCode)
      .then(response => {
        this.title = response.data.title;
        this.tags = response.data.tags;
        this.content = response.data.content;
        this.images = response.data.images;
      })
      .catch(response => {
        console.log("Error " + response);
      });
  },
  methods: {
    addTag: function() {
      this.tags.push({ name: this.tag, approved: false });
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
        mTag.push(item["name"]);
      });
      axios
        .post("/post", {
          title: this.title,
          tags: mTag,
          content: this.content,
          code: editCode
        })
        .then(response => {
          console.log(response);
          editCode = response.id;
          this.uimages.forEach(function(img) {
            //upload the images
            let form = new FormData();

            form.append("image", img);
            form.append("post", response.data.id);

            axios
              .post("/images", form)
              .then(function(response) {
                this.images.push(response.data.location);
              })
              .catch(function(response) {
                this.errors.push(response.response.data.errors["image"]);
              });
          });
          this.uimages = [];
        })
        .catch(response => {
            for(var key in response.response.data.errors){
              this.errors.push(response.response.data.errors[key]);
            }
            
         
        });
    },
    removeImage(img) {
      axios
        .delete("/images", {
          image: img
        })
        .then(response => {
          this.images.splice(img, 1);
        })
        .catch(response => {
          console.log("Error " + response);
        });
    }
  }
};
</script>
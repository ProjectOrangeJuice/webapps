<template>
  <div>
    <h1>Edit post</h1>

    <div>
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
      uimages: []
    };
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
      var mTag = [];
      this.tags.forEach(function(item) {
        mTag.push(item["name"]);
      });
      axios
        .post("/post", {
          title: this.title,
          tags: mTag,
          content: this.content
        })
        .then(response => {
          console.log(response);
          this.uimages.forEach(function(img) {
            //upload the images
            let form = new FormData();

            form.append("image", img);

            axios
              .post("/images", form)
              .then(function(response) {
                console.log("SUCCESS!!" + response);
              })
              .catch(function(response) {
                console.log("FAILURE!!" + response);
              });
          });
        })
        .catch(response => {
          console.log("error");
          console.log(response);
        });
    }
  }
};
</script>
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
        <div class="input-group-append">
          <button class="btn btn-outline-secondary" type="button">Add</button>
        </div>
      </div>
(foreach image)
    </div>
    <button class="btn btn-success form-control">Save</button>
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
      images: []
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
    }
  }
};
</script>
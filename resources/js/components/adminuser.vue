<template>
  <div>
    <div v-if="errors.length > 0" class="alert alert-danger">
      <li v-for="error in errors">{{error[0]}}</li>
    </div>

    <div class="form-group">
      <label>Name</label>
      <input type="email" class="form-control" v-model="name" />
    </div>

    <div class="form-group">
      <label>Email</label>
      <input type="email" class="form-control" v-model="email" />
    </div>

    <div class="form-group">
      <label>Admin</label>
      <input type="checkbox" v-model="admin" />
    </div>

    <div class="form-group">
      <label>Tags</label>

      <div class="input-group mb-3">
        <input type="text" class="form-control" v-model="tag" />
        <div class="input-group-append">
          <button class="btn btn-outline-secondary" type="button" @click="addTag">Add</button>
        </div>
      </div>
      <div class="row">
        <div v-for="t in tags" class="col-">
          <div class="rounded border border-success">
            <b>{{ t }}</b>
            <button class="btn btn-danger">X</button>
          </div>
        </div>
      </div>
    </div>

    <p>Created {{ this.created}}</p>
    <button class="btn btn-success" @click="save">Save</button>
    <button class="btn btn-danger" @click="deleteU">Delete</button>
  </div>
</template>

<script>
export default {
  data() {
    return {
      name: user["name"],
      email: user["email"],
      created: user["created_at"],
      admin: user["admin"],
      tag: "",
      tags: [],
      errors: []
    };
  },
  mounted() {
    tagsj.forEach(element => {
      this.tags.push(element["tag"]);
    });
  },
  methods: {
    addTag: function() {
      this.tags.push(this.tag);
      this.tag = "";
    },
    removeTag: function($tag) {
      this.tags.splice($tag, 1);
    },
    save() {
      this.errors = [];
      axios
        .update("/api/admin/user/" + user["id"], {
          name: this.name,
          email: this.email,
          admin: this.admin,
          tags: this.tags
        })
        .then(response => {
          alert("saved");
        })
        .catch(response => {
          this.errors = response.response.data.errors;
        });
    },
    deleteU() {
      this.errors = [];
      axios
        .delete("/api/admin/user/" + user["id"])
        .then(response => {
          window.location.href = '/admin/users';
        })
        .catch(response => {
          this.errors = response.response.data.errors;
        });
    }
  }
};
</script>
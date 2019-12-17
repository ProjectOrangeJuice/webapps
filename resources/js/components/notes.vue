<template>
  <div>
      <h3>Your notepad!</h3>
    <textarea class="form-control" rows="10" v-model="notes"></textarea>
    <button @click="save">Save</button>
  </div>
</template>

<script>
export default {
  data() {
    return {
      notes: ""
    };
  },
   mounted() {
    axios
      .get("/api/notepad")
      .then(response => {
        this.notes = response.data["content"];
      })
      .catch(response => {
        console.log("Error " + response);
      });

  },
  methods: {
    save: function() {
        axios
      .put("/api/notepad",{
          notepad: this.notes
      })
      .then(response => {
       console.log(response);
      })
      .catch(response => {
        console.log("Error " + response);
      });

    }
  }
};
</script>
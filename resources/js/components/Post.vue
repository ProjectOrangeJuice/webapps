<template>
  <div>
    <div v-if="login == 1">
    <h4>Write a comment</h4>
    <li v-for="error in errors">{{ error }}</li>
    <textarea class="form-control" rows="4" v-model="commentBox"></textarea>
    <button @click="sendComment">Send</button>
    </div>
    <div v-else class="alert alert-warning">
      <a href="/login">Login</a> to post a comment
      </div>


    <div v-for="comment in comments.data" class="alert alert-secondary">
      <h4>{{ comment.user.name }} says</h4>
      <p>{{ comment.comment }}</p>
      <p><i>Posted at {{comment.created_at }}</i></p>
    </div>

    <button v-for="num in comments.last_page" :key="num" @click="moveComments(num)">
      <b v-if="num  == pageNumber()">{{num}}</b>
      <span v-else>{{num}}</span>
    </button>
  </div>
</template>

<script>
export default {
  data() {
    return {
      comments: [],
      commentBox: "",
      errors: [],
      login: amILoggedIn,
    };
  },
  mounted() {
    axios
      .get("/api/comments/1")
      .then(response => {
        this.comments = response.data;
      })
      .catch(response => {
        console.log("Error " + response);
      });
  },
  methods: {
    sendComment: function() {
      axios
        .post(urlToSend, {
          comment: this.commentBox
        })
        .then(response => {
          this.commentBox = "Your comment has been saved!";
          this.errors = [];
          if (this.pageNumber() == 1) {
            axios
              .get("/api/comments/1")
              .then(response => {
                this.comments = response.data;
              })
              .catch(response => {});
          }
        })
        .catch(response => {
          this.errors = response.response.data.errors["comment"];
        });
    },

    moveComments: function(num) {
      axios
        .get("/api/comments/1?page=" + num)
        .then(response => {
          this.comments = response.data;
        })
        .catch(response => {
          console.log("Error " + response);
        });
    },

    pageNumber: function() {
      return Math.floor(this.comments.from / this.comments.per_page + 1);
    }
  }
};
</script>
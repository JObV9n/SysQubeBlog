<template>
  <div v-if="checkForMetaAuth">
    <h1>Admin Dashboard</h1>
    <button @click="logout" class="btn btn-danger mb-3">Logout</button>

    <router-link to="/dashboard/posts/create" class="btn btn-primary mb-3">Create Post</router-link>
    <div class="row">
      <div v-for="post in posts" :key="post.id" class="col-sm-4 mb-3">
        <div class="card">
          <div class="card-body post-container" >
            <h6 class="card-title">
              <router-link :to="'/dashboard/posts/' + post.id">{{ post.title }}</router-link>
              <p>{{ post.description }}</p>
              <i>STATUS: {{ post.status }}</i>
            </h6>
            <img :src="post.blog_image" alt="post.slug" class="blog-image">
            <div class="button-group">
              <router-link :to="'/dashboard/posts/'+'edit/'+ post.id " class="btn btn-warning edit">Edit</router-link>
              <button @click="deletePost(post.id)" class="btn btn-danger delete">Delete</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div v-else>
    <div @click="redirectToLogin"></div>
  </div>

</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      posts: []
    };
  },
  mounted() {
    axios.get('/api/dashboard', {
      headers: {
        'Authorization': `Bearer ${localStorage.getItem('auth_token')}`
      }
    })
      .then(response => {
        this.posts = response.data;
      });
  },
  computed: {
    checkForMetaAuth() {
      return this.$route.meta.requiresAuth === true;
    }
  },
  methods: {
    logout() {
      localStorage.removeItem('auth_token');
      this.$router.push('/login');
    },
    deletePost(id) {
      axios.delete(`/api/dashboard/posts/${id}`, {
        headers: {
          'Authorization': `Bearer ${localStorage.getItem('auth_token')}`
        }
      })
        .then(response => {
          this.posts = this.posts.filter(post => post.id !== id);
        });
    },
    redirectToLogin() {
      this.$router.push('/login')
    }
  }
}
</script>

<style noscopped>
.button-group{
  display: flex;
  justify-content: flex-end;
  margin-top:10px;
}

.button-group .btn{
  /* margin-left: 5px; */
  margin-left: 1.8vh;
}
.post-container{
  overflow: hidden;
}
.blog-image{
  max-width: 90%;
  height: auto;
  display: block;
}
</style>
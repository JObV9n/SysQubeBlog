<template>
    <div>
      <h1>Admin Dashboard</h1>
      <button @click="logout" class="btn btn-danger">Logout</button>
      <router-link to="/dashboard/posts/create" class="btn btn-primary">Create Post</router-link>
      <div v-for="post in posts" :key="post.id">
        <router-link :to="'/posts/' + post.slug">{{ post.title }}</router-link>
        <router-link :to="'/dashboard/posts/' + post.id + '/edit'" class="btn btn-warning">Edit</router-link>
        <button @click="deletePost(post.id)" class="btn btn-danger">Delete</button>
      </div>
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
      axios.get('/api/admin/posts', {
        headers: {
          'Authorization': `Bearer ${localStorage.getItem('auth_token')}`
        }
      })
      .then(response => {
        this.posts = response.data;
      });
    },
    methods: {
      logout() {
        localStorage.removeItem('auth_token');
        this.$router.push('/login');
      },
      deletePost(id) {
        axios.delete(`/api/admin/posts/${id}`, {
          headers: {
            'Authorization': `Bearer ${localStorage.getItem('auth_token')}`
          }
        })
        .then(response => {
          this.posts = this.posts.filter(post => post.id !== id);
        });
      }
    }
  }
  </script>
  
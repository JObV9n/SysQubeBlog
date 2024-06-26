<template>
  <!-- Navigation Bar -->
   <div v-if="checkMetauth">
   <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <router-link to="/dashboard" class="nav-link">Home</router-link>
            </li>
            <li class="nav-item">
              <router-link to="/logout" class="nav-link">LogOut</router-link>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </div>
  <div v-else>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <router-link to="/" class="nav-link">Home</router-link>
            </li>
            <li class="nav-item">
              <router-link to="/login" class="nav-link">Login</router-link>
            </li>
            <li class="nav-item">
              <router-link to="/register" class="nav-link">Register</router-link>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </div>
    <!-- main Content -->
    <div>
      <h1>Landing Page</h1>
      <div v-for="post in posts" :key="post.id" >  
        <h6>{{ post.id }}</h6>
        <router-link :to="'/posts/' + post.id">{{ post.title }}</router-link>
        {{post.description}}
        <h5>{{ post.status }}</h5>
      <p><img :src="post.blog_image" alt="Posts image" /></p>
        <br>
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
      axios.get('api/posts')
        .then(response => {
          this.posts = response.data;
        });
    }
  }
  </script>
  
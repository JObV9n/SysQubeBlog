<template>
  <div>
    <h3>Here is the post details</h3>
    <h1>{{ post.title }}</h1>
    <p>{{ post.description }}</p>
    <img :src="post.blog_image" alt="Blog Image" v-if="post.blog_image">
  </div>

  <div v-if="error">{{ error }}</div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      post: {
        title: '',
        description: '',
        slug: '',
        status: '',
        blog_image: ''
      },
      error: ''
    };
  },
  mounted() {
    const postId = this.$route.params.id;
    axios.get(`/api/posts/${postId}`)
      .then(response => {
        console.log("got response ", this.$route.params.id)
        this.post = response.data;
      })
      .catch(error => {
        if (error.response || error.response.status === 404) {
          this.$router.push('/');
        } else {
          this.error = "Error in loading the post: " + error.message;
          console.error("Error occured while fetching the post: ", error);
        }
      })
  },
}
</script>
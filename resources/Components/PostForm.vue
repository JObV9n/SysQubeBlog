<template>
    <div>
      <h1>{{ isEdit ? 'Edit' : 'Create' }} Post</h1>
      <form @submit.prevent="savePost">
        <div class="form-group">
          <label>Title:</label>
          <input type="text" v-model="post.title" class="form-control" required>
        </div>
        <div class="form-group">
          <label>Slug:</label>
          <input type="text" v-model="post.slug" class="form-control" required>
        </div>
        <div class="form-group">
          <label>Description:</label>
          <textarea v-model="post.description" class="form-control" required></textarea>
        </div>
        <div class="form-group">
          <label>Status:</label>
          <select v-model="post.status" class="form-control" required>
            <option value="Published">Published</option>
            <option value="Draft">Draft</option>
          </select>
        </div>
        <div class="form-group">
          <label>Blog Image:</label>
          <input type="file" @change="handleFileUpload" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
      </form>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        post: {
          title: '',
          slug: '',
          description: '',
          status: 'Draft',
          blog_image: null
        },
        isEdit: false
      };
    },
    mounted() {
      if (this.$route.params.id) {
        this.isEdit = true;
        axios.get(`/api/admin/posts/${this.$route.params.id}`, {
          headers: {
            'Authorization': `Bearer ${localStorage.getItem('auth_token')}`
          }
        })
        .then(response => {
          this.post = response.data;
        });
      }
    },
    methods: {
      handleFileUpload(event) {
        this.post.blog_image = event.target.files[0];
      },
      savePost() {
        const formData = new FormData();
        formData.append('title', this.post.title);
        formData.append('slug', this.post.slug);
        formData.append('description', this.post.description);
        formData.append('status', this.post.status);
        if (this.post.blog_image) {
          formData.append('blog_image', this.post.blog_image);
        }
  
        const url = this.isEdit ? `/api/admin/posts/${this.$route.params.id}` : '/api/admin/posts';
        const method = this.isEdit ? 'put' : 'post';
  
        axios({
          method: method,
          url: url,
          data: formData,
          headers: {
            'Authorization': `Bearer ${localStorage.getItem('auth_token')}`,
            'Content-Type': 'multipart/form-data'
          }
        })
        .then(response => {
          this.$router.push('/dashboard');
        });
      }
    }
  }
  </script>
  
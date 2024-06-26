<!-- Vue Components for Updatation of the POSTs -->
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
  <div v-if='formMessage' class="alert">
  </div>
  <div v-else></div>
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
        blog_image: null,

      },
      isEdit: false,
      formMessage: ''
    };
  },
  mounted() {
    if (this.$route.params.id) {
      this.isEdit = true;
      this.fetchPostData();
      // axios.get(`/api/dashboard/posts/${this.$route.params.id}/edit`, {
      //   headers: {
      //     'Authorization': `Bearer ${localStorage.getItem('auth_token')}`
      //   }
      // })
      //   .then(response => {
      //     this.post = response.data;
      //   });
    }
  },
  methods: {
    fetchPostData() {
      axios.get(`/api/dashboard/posts/${this.$route.params.id}/edit`, {
        headers: {
          'Authorization': `Bearer ${localStorage.getItem('auth_token')}`
        }
      })
        .then(response => {
          this.post = response.data;
          this.post.blog_image_url = response.data.blog_image_url;
        })

        .catch(error => {
          this.formMessage = 'Error fetching post data';
          console.error('Error fetching post data:', error);
        });
    },
    handleFileUpload(event) {
      this.post.blog_image = event.target.files[0];
    },
    savePost() {

      //FormData from the Node
      const formData = new FormData();
      
      formData.append('title', this.post.title);
      formData.append('slug', this.post.slug);
      formData.append('description', this.post.description);
      formData.append('status', this.post.status);
      
      //check for blog image URL specifically

      if (this.post.blog_image) {
        formData.append('blog_image', this.post.blog_image);
      }

      const url = this.isEdit ? `/api/dashboard/posts/${this.$route.params.id}/edit` : '/api/dashboard';
      const method = this.isEdit ? 'put' : 'get';

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
          alert(response.data.message);
          this.$router.push('/dashboard');
        });
    }
  }
}
</script>
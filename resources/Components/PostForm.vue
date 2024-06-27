<!-- Vue Components for Updatation of the POSTs -->
<template>
  <div>
    <h1>{{ isEdit ? 'Edit' : 'Create' }} Post</h1>
    <form @submit.prevent="savePost">
      <div class="form-group">
        <label>Title:</label>
        <input type="text" :value="post.title" name="title" class="form-control" >
        <!-- <input type="text" v-model="post.title" name="title" class="form-control"> -->
      </div>
      <div class="form-group">
        <label>Slug:</label>
        <input type="text" :value="post.slug" name="slug" class="form-control">
        <!-- <input type="text" v-model="post.slug" name="slug" class="form-control"> -->
      </div>
      <div class="form-group">
        <label>Description:</label>
        <textarea :value="post.description" name="description" class="form-control" ></textarea>
        <!-- <textarea v-model="post.description" name="description" class="form-control" ></textarea> -->
      </div>
      <div class="form-group">
        <label>Status:</label>
        <select :value="post.status" name="status" class="form-control" >
        <!-- <select v-model="post.status" name="status" class="form-control" > -->
          <option value="Published">Published</option>
          <option value="Draft">Draft</option>
        </select>
      </div>
      <div class="form-group">
        <label>Blog Image:</label>
        <!-- <input type="file" @change="handleFileUpload" name="blog_image" class="form-control"> -->
        <input type="file" @change="handleFileUpload" name="blog_image" class="form-control">
      </div>
     
      <button type="submit" class="btn btn-primary">  {{ isEdit ? 'Update':'Create' }}</button>
    </form>
  </div>
  <div v-if='formMessage' class="alert">
    {{ formMessage }}
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
    }
  },
  methods: {
    fetchPostData() {
      axios.get(`/api/dashboard/posts/edit/${this.$route.params.id}`, {
        headers: {
          'Authorization': `Bearer ${localStorage.getItem('auth_token')}`
        }
      })
        .then(response => {
          this.formMessage = "Successfully Fetched the Post";
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

      if (this.post.blog_image || this.post.blog_image !== null) {
        formData.append('blog_image', this.post.blog_image);
      }

      const url = this.isEdit ? `/api/dashboard/posts/edit/${this.$route.params.id}` : '/api/dashboard/posts';
      const method = this.isEdit ? 'put' : 'post';
  
      console.log(url);
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
          console.log(response)
          this.$router.push('/dashboard');
        })
        .catch(error => {
          this.formMessage = 'Error fetching post data';
          console.error('Error fetching post data:', error);
        });
    }
  }
}
</script>
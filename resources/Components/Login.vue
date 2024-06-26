<template>
  <h1>Login</h1>
  <div class="login">
    <form @submit.prevent="login">
      <div class="form-group">
        <label>Email:</label>
        <input type="email" v-model="email" class="form-control" required>
      </div>
      <div class="form-group">
        <label>Password:</label>
        <input type="password" v-model="password" class="form-control" required>
      </div>
      <p v-if="errorMessage" class="alert alert-danger p-2 m-3">{{ errorMessage }}</p>
      <button type="submit" class="btn btn-primary p-2 m-2 g-col-6">Login</button>
      <router-link to="/register" class="a position-absolute bottom-40 start-50 m-3">Register</router-link> 
    </form>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      email: '',
      password: '',
      errorMessage:''
    };
  },
  methods: {
    login() {
      axios.post('/api/login', {
        email: this.email,
        password: this.password
      })
        .then(response => {
          localStorage.setItem('auth_token', response.data.token);
          this.$router.push('/dashboard');
        })
        .catch(error => {
          if (error.response.status===401){
            // console.log(error.response.data.message)

            // console.log(error);
            this.errorMessage = error.response.data.message;
          }
        });
    }
  }
}
</script>

<style noscoped>
    .login{
    width: 40%;
    margin:auto;
    padding-top: 20px;
  }
</style>
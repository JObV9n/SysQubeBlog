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
      <button type="submit" class="btn btn-primary p-2 m-2 g-col-6">Login</button>
    </form>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      email: '',
      password: ''
    };
  },
  methods: {
    login() {
      axios.post('/login', {
        email: this.email,
        password: this.password
      })
        .then(response => {
          localStorage.setItem('auth_token', response.data.token);
          this.$router.push('/dashboard');
        })
        .catch(error => {
          console.log(error);
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
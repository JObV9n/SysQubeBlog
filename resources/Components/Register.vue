<template>
  <div class="register">
    <h1>Register</h1>
    <form @submit.prevent="register">
      <div class="form-group row g-3 align-items-center p-2">
        <input type="text" v-model="name" class="form-control" placeholder="Enter Name">
      </div>
      <div class="form-group row g-3 align-items-center p-2">
        <input type="email" v-model="email" class="form-control" placeholder="Enter Email" required>
      </div>
      <div class="form-group row g-3 align-items-center p-2">
        <input type="password" v-model="password" class="form-control" placeholder="Enter Password" required>
      </div>
      <div class="form-group row g-3 align-items-center p-2">
        <input type="password" v-model="password_confirmation" class="form-control" placeholder="Confirm Password">
      </div>
      <button type="submit" class="btn btn-primary p-2 m-7 ">Register</button>
      <router-link to="/login" class="a position-absolute bottom-40 start-50">Login</router-link> 
    </form>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      name: '',
      email: '',
      password: '',
      password_confirmation:''
    };
  },
  methods: {
    register() {
      axios.post('/register', {
        name: this.name,
        email: this.email,
        password: this.password,
        password_confirmation:this.password_confirmation
      })
        .then(response => {
          alert(response.data.message)
          this.$router.push('/login');
        })
        .catch(error => {
          alert("Registration error")
          console.log(error);
        });
    }
  }
}
</script>

<style noscopped>
h1{
  text-align: center;
}
  .register{
    width: 50%;
    margin:auto;
    padding-top: 20px;
  }
</style>
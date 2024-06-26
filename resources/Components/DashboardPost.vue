<template>
    <div v-if="checkForMetaAuth">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <router-link to="/" class="nav-link">Home</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/login" class="nav-link">LogOut</router-link>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <h3>Dashboard posts here</h3>
    </div>
    <div v-else>
        <a @click="redirectToLogin"></a>
    </div>

    <div>
        {{ posts.title }}
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
        axios.get(`/api/dashboard/posts/${this.$route.params.id}`, {
            headers: {
                'Authorization': `Bearer ${localStorage.getItem('auth_token')}`
            }
        })
            .then(response => {
                console.log(response.data.post);
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
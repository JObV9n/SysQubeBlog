import { createRouter, createWebHistory } from 'vue-router';
import Landing from '../Components/Landing.vue';
import Login from '../Components/Login.vue';
import Register from '../Components/Register.vue';
import Dashboard from '../Components/Dashboard.vue';
import PostForm from '../Components/PostForm.vue';
import PostDetail from '../Components/PostDetail.vue';

const routes = [
    { path: '/', component: Landing, name: 'landing' },
    { path: '/login', component: Login },
    { path: '/register', component: Register },
    { path: '/dashboard', component: Dashboard, meta: { requiresAuth: true } },
    { path: '/dashboard/posts/create', component: PostForm, meta: { requiresAuth: true } },
    { path: '/dashboard/posts/:id/edit', component: PostForm, meta: { requiresAuth: true } },
    { path: '/posts/:id', component: PostDetail, name:'postDetails'},
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

router.beforeEach((to, from, next) => {
    const loggedIn = localStorage.getItem('auth_token');
    if (to.matched.some(record => record.meta.requiresAuth) && !loggedIn) {
        next('/login');
    } else {
        next();
    }
});

export default router;

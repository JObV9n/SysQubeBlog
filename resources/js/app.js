import 'bootstrap/dist/css/bootstrap.min.css';

import Register from '../Components/Register.vue';
import PostDetail from '../Components/PostDetail.vue';
import { createApp } from 'vue';
import App from './App.vue';

import router from './router';

createApp(App).component('post-detail-component',PostDetail);
createApp(App).component('register-component',PostDetail);

createApp(App).use(router).mount('#app');

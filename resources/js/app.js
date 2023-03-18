import './bootstrap';

import '../sass/app.scss'



import {createApp} from 'vue'
import { createRouter, createWebHistory } from 'vue-router';
import routes from './routes.js';
import Home from './Home.vue'
import Profile from './Profile.vue'
import App from './App.vue'
import ProfileEdit from './ProfileEdit.vue'
import Register from './Register.vue';
import Dashboard from './Dashboard.vue';
import Login from './login.vue'
import store from './store.js'


const router = createRouter({
    history: createWebHistory(),
    routes: routes.routes,
});
  

createApp(App).use(router).use(store).mount("#home")
createApp(ProfileEdit).use(router).use(store).mount("#profile")
createApp(Register).use(router).use(store).mount("#register")
createApp(Dashboard).use(router).use(store).mount("#dashboard")
//createApp(Login).use(router).use(store).mount("#login")
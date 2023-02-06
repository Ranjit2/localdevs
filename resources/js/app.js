import './bootstrap';

import '../sass/app.scss'



import {createApp} from 'vue'
import { createRouter, createWebHistory } from 'vue-router';
import routes from './routes.js';
import Home from './Home.vue'
import Profile from './Profile.vue'
import App from './App.vue'
import ProfileEdit from './ProfileEdit.vue'


const router = createRouter({
    history: createWebHistory(),
    routes: routes.routes,
  });
  
createApp(App).use(router).mount("#home")
createApp(ProfileEdit).use(router).mount("#profile")


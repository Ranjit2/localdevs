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
import Upload from './Upload.vue'
import store from './store.js'
import RegisterCompany from './RegisterCompany.vue'
import "bootstrap-icons/font/bootstrap-icons.css" 

const router = createRouter({
    history: createWebHistory(),
    routes: routes.routes,
});
  

createApp(App).use(router).use(store).mount("#home")
createApp(App).use(router).use(store).mount("#home")
createApp(ProfileEdit).use(router).use(store).mount("#profile")
createApp(Register).use(router).use(store).mount("#register")
createApp(RegisterCompany).use(router).use(store).mount("#register-company")
createApp(Dashboard).use(router).use(store).mount("#dashboard")
createApp(Upload).use(router).mount("#upload")

//createApp(Login).use(router).use(store).mount("#login")
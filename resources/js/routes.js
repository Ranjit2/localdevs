import Home from './Home.vue';
import Profile from './Profile.vue';
import ProfileEdit from './ProfileEdit.vue';

export default {
    routes: [

        {
            path: '/home',
            name: 'Home',
            component: Home,
        },

        {
            path: '/profile/:id',
            name: 'Profile',
            component: Profile,
        },
        {
            path: '/profile/edit',
            name: 'ProfileEdit',
            component: ProfileEdit
        },
    ],
};




import Home from './Home.vue';
import Profile from './Profile.vue';
import ProfileEdit from './ProfileEdit.vue';
import Home2 from './Home2.vue';

export default {
    routes: [

        {
            path: '/home',
            name: 'Home',
            component: Home,
        },
        {
            path: '/home2',
            name: 'Home2',
            component: Home2,
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




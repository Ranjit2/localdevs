import Home from './Home.vue';
import Profile from './Profile.vue';
import ProfileEdit from './ProfileEdit.vue';
import Home2 from './Home2.vue';
import Dashboard from './Dashboard.vue';

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
            path: '/dashboard',
            name: 'Dashboard',
            component: Dashboard,
            // beforeEnter: (to, from, next) => {
            //     // Check if the user's role is authorized to access the route
            //     axios.get('/user/role')
            //       .then(response => {
            //         if (response.data.user == 'talent') {
            //             next()
            //         }
            //         else {
            //             //localStorage.setItem('isAuthorized', false)
            //             next('/home')
            //         }
            //       })
            //       .catch(error => {
            //         // If there was an error, redirect to the login page
            //         next('/login')
            //       })
            // }
        },
        {
            path: '/talent/:slug',
            name: 'Profile',
            component: Profile,
        },
        {
            path: '/user/profile/:slug/edit',
            name: 'ProfileEdit',
            component: ProfileEdit,
            beforeEnter: (to, from, next) => {
                // Check if the user's role is authorized to access the route
                axios.get('/user/role')
                  .then(response => {
                    if (response.data.user == 'talent') {
                        next()
                    }
                    else {
                        //localStorage.setItem('isAuthorized', false)
                        next('/home')
                    }
                  })
                  .catch(error => {
                    // If there was an error, redirect to the login page
                    next('/login')
                  })
              }
        },
    ],

};

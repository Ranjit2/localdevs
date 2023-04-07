import Home from './Home.vue';
import Profile from './Profile.vue';
import ProfileEdit from './ProfileEdit.vue';
import Home2 from './Home2.vue';
import Dashboard from './Dashboard.vue';
import Expertise from './Expertise.vue';

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
      path: '/user/expertise',
      name: 'Expertise',
      component: Expertise,
      beforeEnter: (to, from, next) => {
        // Check if the user is authorized
        if (localStorage.getItem('isAuthorized') === 'true') {
          next() // proceed to the route
        } else {
          next('/dashboard') // redirect to dashboard
        }
      },
      meta: {
        requiresAuth: true // add a meta field to indicate that the route requires authentication
      }
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
      beforeEnter: (to, from, next) => {
        // Check if the user is authorized to access the route
        const isAuthorized = localStorage.getItem('isAuthorized')
        if (isAuthorized === 'true') {
          next()
        } else {
          axios.get('/user/role')
            .then(response => {
              if (response.data.user == 'talent') {
                localStorage.setItem('isAuthorized', true)
                next()
              } else {
                localStorage.setItem('isAuthorized', false)
                next('/home')
              }
            })
            .catch(error => {
              // If there was an error, redirect to the login page
              next('/login')
            })
        }
      }
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
        // Check if the user is authorized
        if (localStorage.getItem('isAuthorized') === 'true') {
          next() // proceed to the route
        } else {
          next('/dashboard') // redirect to dashboard
        }
      },
      meta: {
        requiresAuth: true // add a meta field to indicate that the route requires authentication
      }

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
      //   }
    },
  ],


};

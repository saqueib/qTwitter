import Vue from 'vue'
import Router from 'vue-router'

// Page Components
import Dashboard from '../Pages/Dashboard'
import Profile from '../Pages/Profile'
import Followers from '../Pages/Followers'
import Following from '../Pages/Following'

// Use the router
Vue.use(Router)

export default new Router({
    // All router active link
    linkActiveClass: 'is-active',

    // All routes
    routes: [
        {
            path: '/',
            name: 'dashboard',
            component: Dashboard
        },
        {
            path: '/@:username',
            name: 'profile',
            component: Profile,
            props: true
        },
        {
            path: '/@:username/followers',
            name: 'followers',
            component: Followers,
            props: true
        },
        {
            path: '/@:username/following',
            name: 'following',
            component: Following,
            props: true
        }
    ],

    // mode: 'history', // Enable it to enable scroll behavior
    scrollBehavior (to, from) {
        return { x: 0, y: 0 }
    }
})
import Vue from 'vue'
import Router from 'vue-router'

// Page Components
import Dashboard from '../Pages/Dashboard'
import Profile from '../Pages/Profile'
import Notification from '../Pages/Notification'
import Followers from '../Pages/Followers'
import Following from '../Pages/Following'
import Likes from '../Pages/Notification'

// Use the router
Vue.use(Router)

export default new Router({
    linkActiveClass: 'is-active',
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
        },
        {
            path: '/@:username/likes',
            name: 'likes',
            component: Likes,
            props: true
        },
        {
            path: '/notification',
            name: 'notification',
            component: Notification
        }
    ],
    // mode: 'history',
    scrollBehavior (to, from) {
        return { x: 0, y: 0 }
    }
})

// https://github.com/saqueib/qreader/blob/master/src/router/index.js
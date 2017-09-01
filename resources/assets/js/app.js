// Bootstrap the app
require('./bootstrap');

// Import the Vue
window.Vue = require('vue');

// Import router and vuex store
import router from './router'
import store from './store'

// Global Directive
Vue.directive('focus', {
    inserted: function (el) {
        el.focus()
    }
})

// Configs
Vue.config.devtools = true
Vue.config.productionTip = false

// Components
Vue.component('profile-card', require('./components/ProfileCard'));
Vue.component('tweet-list', require('./components/TweetList'));
Vue.component('follow-suggestions', require('./components/FollowSuggestions'));
Vue.component('side-footer', require('./components/SideFooter'));

// App root Component
import App from './components/App'

// Vue instance
const app = new Vue({
    el: '#app',
    router,
    store,
    render: h => h(App)
});
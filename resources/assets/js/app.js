require('./bootstrap');

window.Vue = require('vue');

import router from './router'

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
Vue.component('example', require('./components/Example'));

// App root Component
import App from './components/App'

// Vue instance
const app = new Vue({
    el: '#app',
    router,
    render: h => h(App)
});
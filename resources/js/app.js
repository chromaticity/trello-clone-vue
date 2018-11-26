// Import Vue dependencies and use Vue router
import Vue          from 'vue'
import VueRouter    from 'vue-router'

Vue.use(VueRouter)

// Import all of the view files, for use in our router.
import App from './components/App'
import Home from './components/IndexComponent'

// Declare routes, along with the components we declared above.
const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
        },
    ]
});

// Initiate the Vue app.
const app = new Vue({
    el: '#app',
    components: { App },
    router,
});
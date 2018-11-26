// Import Vue dependencies and use Vue router
import Vue          from 'vue'
import VueRouter    from 'vue-router'

Vue.use(VueRouter)

// Import all of the view files, for use in our router.
import App from './components/App'
import Board from './components/Board'
import Home from './components/IndexComponent'
import Login from './components/Login'
import Register from './components/Register'

// Declare routes, along with the components we declared above.
const router = new VueRouter({
    mode: 'history',
    routes: [
    	{
        	path: '/board',
        	name: 'board',
        	component: Board
        },
        {
            path: '/',
            name: 'home',
            component: Home
        },
        {
        	path: '/login',
        	name: 'login',
        	component: Login
        },
        {
        	path: '/register',
        	name: 'register',
        	component: Register
        }
    ]
});

// Initiate the Vue app, with App component being the entry point.
const app = new Vue({
    el: '#app',
    components: { App },
    router,
});
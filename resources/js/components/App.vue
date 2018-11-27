<template>
    <div>
        <nav class="navbar navbar-expand-md navbar-laravel navbar-light">
            <div class="container">
                <!-- link back to the home page using the router-link attr. -->
                <router-link :to="{name: 'home'}" class="navbar-brand">Trellu</router-link>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">

                    <!-- Nav Left Side -->
                    <ul class="navbar-nav mr-auto"></ul>

                    <!-- Nav Right Side -->
                    <ul class="navbar-nav ml-auto">
                        <router-link :to="{ name: 'login' }" class="nav-link" v-if="!isLoggedIn">Login</router-link>
                        <router-link :to="{ name: 'register' }" class="nav-link" v-if="!isLoggedIn">Register</router-link>
                        <li class="nav-link" v-if="isLoggedIn"> Hello, {{username}}</li>
                        <router-link :to="{ name: 'board' }" class="nav-link" v-if="isLoggedIn">Board</router-link>
                        <a href="#" class="nav-link" @click="logout()" v-if="isLoggedIn">Logout</a>
                    </ul>

                </div>
            </div>
        </nav>
        <main class="py-4">
            <!-- <router-view> renders whatever is accessed at a given path in the routes. -->
            <router-view></router-view>
        </main>
    </div>
</template>

<script>
    export default {
        data(){
            // Keeping track whether the user is logged in or not. Also keeping track of their username.
            return {
                isLoggedIn : null,
                username : null,
                userId: null
            }
        },

        // Once this is mounted (like in react) then set the isLoggedIn and name variables for use.
        mounted(){
            this.isLoggedIn = localStorage.getItem('userToken');
            this.username = localStorage.getItem('username');
            this.userId = localStorage.getItem('userId');
        },

        methods: {
            // logout method that logs the user out when clicking on the Logout button.
            logout() {
                localStorage.clear();
                axios.post('/api/logout');
                this.$router.go('/login');
            }
        }
    }
</script>
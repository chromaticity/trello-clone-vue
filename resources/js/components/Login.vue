<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">Login</div>

                    <div class="card-body">
                        <form method="POST" action="/login">
                            <div class="form-group row">
                                <label for="email" class="col-sm-4 col-form-label text-md-right">E-Mail Address</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" v-model="email" required autofocus>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" v-model="password" required>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary" @click="handleSubmit">
                                        Login
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        // This will be the same exact thing as the registration form. 
        data(){
            return {
                email : "",
                password : ""
            }
        },

        // do submission of the form.
        methods : {
            handleSubmit(e){
                e.preventDefault()

                // check if the password field is empty
                if (this.password.length > 0) {

                    //Attempt to login using login API route laravel side
                    axios.post('/api/login', {
                        email: this.email,
                        password: this.password
                      })
                      .then(response => {
                        localStorage.setItem('username',response.data.name)
                        localStorage.setItem('userToken',response.data.success.token)
                        localStorage.setItem('userId',response.data.success.id)

                        console.log(response);

                        if (localStorage.getItem('userToken') != null){
                            this.$router.go('/board')
                        }
                      })
                      .catch(function (error) {
                        toastr.error("Incorrect username or password. Please try again.");
                      });
                }
            }
        },
        beforeRouteEnter (to, from, next) { 
            if (localStorage.getItem('userToken')) {
                return next('board');
            }

            next();
        }
    }
</script>
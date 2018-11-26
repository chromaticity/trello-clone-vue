<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">Register</div>

                    <div class="card-body">
                        <form method="POST" action="/register">
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" v-model="name" required autofocus>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" v-model="email" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" v-model="password" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirm Password</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" v-model="password_confirmation" required>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary" @click="handleSubmit">
                                        Register
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
        // always need to return a data object like the one shown below.
        data(){
            return {
                name : "",
                email : "",
                password : "",
                password_confirmation : ""
            }
        },

        // Handle the submission
        methods : {
            handleSubmit(e) {
                e.preventDefault()

                // Check if password confirmation is valid and password is not empty.
                if (this.password === this.password_confirmation && this.password.length > 0)
                {
                    console.log(this.name)
                    // Run simple axios request to my API route to register.
                    axios.post('/api/register', {
                        name: this.name,
                        email: this.email,
                        password: this.password,
                        c_password : this.password_confirmation
                      })
                      .then(response => {
                        // Get the name and token from the successful login request, and put them in localStorage for Auth purposes.
                        localStorage.setItem('user',response.data.success.name)
                        localStorage.setItem('userToken',response.data.success.token)

                        // If there is an auth token, then send them to their board with their tasks. 
                        if (localStorage.getItem('userToken') != null){
                            this.$router.go('/board')
                        }
                      })
                      .catch(error => {
                        console.error(error);
                      });
                } else {
                    // Empty the fields if the passwords to not match.
                    this.password = ""
                    this.passwordConfirm = ""

                    return alert('Passwords do not match')
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
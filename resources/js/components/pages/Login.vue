<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Login</div>
                    <div class="card-body">
                        <form method="POST" action="" @submit.prevent="login($event)">
                            <input type="hidden" name="_token" :value="csrf_token" />

                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-end">E-mail</label>

                                <div class="col-md-6">
                                    <input v-model="email" id="email" type="email" class="form-control" name="email"
                                        required autocomplete="email" autofocus />

                                    <span class="invalid-feedback" role="alert">
                                        <strong>teste</strong>
                                    </span>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password" class="col-md-4 col-form-label text-md-end">Senha</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password" required
                                        autocomplete="current-password" v-model="password" />

                                    <span class="invalid-feedback" role="alert">
                                        <strong>teste</strong>
                                    </span>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" />

                                        <label class="form-check-label" for="remember">
                                            Relembre-me
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Login
                                    </button>

                                    <a class="btn btn-link" href="">
                                        esqueci a senha
                                    </a>
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
    props: ["csrf_token"],
    data() {
        return {
            email: "",
            password: "",
        };
    },
    computed: {
        api() {
            return this.$store.state.api;
        },
        token() {
            return this.$store.state.token;
        }
    },
    methods: {
        async login(e) {
            this.api.post('/login', { email: this.email, password: this.password })
                .then(({ data }) => {
                    const { token } = data;
                    if (token) {
                        // document.cookie = `token=${token};SameSite=Lax`;
                        this.token.saveToken(token);
                        e.target.submit();
                    }
                })
                .catch(e => console.log(e));
        },
    },
};
</script>

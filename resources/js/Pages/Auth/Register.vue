<template>
  <div>
    <div class="home-btn d-none d-sm-block">
      <a href="https://adeptlessor.com/" class="text-dark"><i class="fas fa-home h2"></i></a>
    </div>
    <div class="account-pages my-5 pt-5">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-8 col-lg-6 col-xl-5">
            <div class="card overflow-hidden">
              <div class="bg-primary">
                <div class="text-primary text-center p-4">
                  <h5 class="text-white font-size-20">Free Register</h5>
                  <p class="text-white-50">
                    Get your free Adeptlessor account now.
                  </p>
                  <a href="https://adeptlessor.com/" class="logo logo-admin">
                    <img
                      src="assets/images/logo.png"
                      height="24"
                      alt="logo"
                      style="margin-top: 5px; margin-left: 7px"
                    />
                  </a>
                </div>
              </div>

              <div class="card-body p-4">
                <vue-element-loading
                  :active="loading"
                  spinner="mini-spinner"
                  color="#073491"
                />
                <div class="p-3">
                  <div class="alert alert-danger" v-if="errorMsg.length > 0">
                    <ul>
                      <li v-for="(err, ind) in errorMsg.password" :key="ind">
                        {{ err }}
                      </li>
                      <li>{{ errorMsg }}</li>
                    </ul>
                  </div>
                  <form
                    class="form-horizontal mt-4"
                    action=""
                    @submit.prevent="submit"
                  >
                    <div class="form-group">
                      <label for="useremail">Email</label>
                      <input
                        type="email"
                        class="form-control"
                        id="useremail"
                        placeholder="Enter email"
                        v-model="form.email"
                      />
                    </div>

                    <div class="form-group">
                      <label for="username">Username</label>
                      <input
                        type="text"
                        class="form-control"
                        id="username"
                        placeholder="Enter username"
                        v-model="form.name"
                      />
                    </div>

                    <div class="form-group">
                      <label for="userpassword">Password</label>
                      <input
                        type="password"
                        class="form-control"
                        id="userpassword"
                        placeholder="Enter password"
                        v-model="form.password"
                      />
                    </div>

                    <div class="form-group">
                      <label for="userpassword">Confirm Password</label>
                      <input
                        type="password"
                        class="form-control"
                        id="confirmpassword"
                        placeholder="Confirm password"
                        v-model="form.password_confirmation"
                      />
                    </div>

                    <div class="form-group row">
                      <div class="col-12 text-right">
                        <button
                          class="btn btn-primary w-md waves-effect waves-light"
                          type="submit"
                        >
                          Register
                        </button>
                      </div>
                    </div>

                    <div class="form-group mt-2 mb-0 row">
                      <div class="col-12 mt-4">
                        <p class="mb-0">
                          By registering you agree to the Fidelitas
                          <a href="#" class="text-primary">Terms of Use</a>
                        </p>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>

            <div class="mt-5 text-center">
              <p>
                Already have an account ?
                <inertia-link
                  :href="'/login'"
                  class="font-weight-medium text-primary"
                >
                  Login
                </inertia-link>
              </p>
              <!-- <p>© 2020 Veltrix. Crafted with <i class="mdi mdi-heart text-danger"></i> by Themesbrand</p> -->
              © 2021 Adeptlessor<span class="d-none d-sm-inline-block">
                - Crafted with <i class="mdi mdi-heart text-danger"></i> by
                Idrizzy and Repzlaw.
              </span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import VueElementLoading from "vue-element-loading";
export default {
  components: {
    VueElementLoading,
  },
  data() {
    return {
      form: {
        name: "",
        email: "",
        password: "",
        password_confirmation: "",
      },
      errorMsg: [],
      loading: false,
    };
  },
  methods: {
    submit() {
      this.loading = true;
      axios
        .post("/register", this.form)
        .then((response) => {
          this.loading = false;

          this.$inertia.visit("register");
        })
        .catch((err) => {
          this.loading = false;
          this.toaster(err.response.data.message, "error");
          this.errorMsg = err.response.data.errors;
        });
    },
  },
  mounted() {
    this.loading = false;
  },
  created() {},
};
</script>

<style>
</style>


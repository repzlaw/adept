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
                  <h5 class="text-white font-size-20">Welcome Back !</h5>
                  <p class="text-white-50">
                    Sign in to continue to Adeptlessor.
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
                  <form
                    class="form-horizontal mt-4"
                    action=""
                    @submit.prevent="submit"
                  >
                    <div class="form-group">
                      <label for="username">Email</label>
                      <input
                        type="text"
                        class="form-control"
                        id="username"
                        placeholder="Enter Email"
                        v-model="form.email"
                        required
                      />
                    </div>
                    <p style="color: red" v-if="errors != ''">
                      {{ errors }}
                    </p>
                    <div class="form-group">
                      <label for="userpassword">Password</label>
                      <input
                        type="password"
                        class="form-control"
                        id="userpassword"
                        placeholder="Enter password"
                        v-model="form.password"
                        required
                      />
                    </div>

                    <div class="form-group row">
                      <div class="col-sm-6">
                        <div class="custom-control custom-checkbox">
                          <input
                            type="checkbox"
                            class="custom-control-input"
                            id="customControlInline"
                          />
                          <label
                            class="custom-control-label"
                            for="customControlInline"
                            >Remember me</label
                          >
                        </div>
                      </div>
                      <div class="col-sm-6 text-right">
                        <button
                          class="btn btn-primary w-md waves-effect waves-light"
                          type="submit"
                        >
                          Log In
                        </button>
                      </div>
                    </div>

                    <div class="form-group mt-2 mb-0 row">
                      <div class="col-6 mt-4">
                        <inertia-link :href="'/forgot-password'"
                          ><i class="mdi mdi-lock"></i> Forgot your
                          password?</inertia-link
                        >
                      </div>
                      <div class="col-6 mt-4">
                        <inertia-link :href="'/register'" class="float-right">
                          Register</inertia-link
                        >
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>

            <div class="mt-5 text-center">
              <p>
                Don't have an account ?
                <inertia-link
                  :href="'/register'"
                  class="font-weight-medium text-primary"
                >
                  Signup now
                </inertia-link>
              </p>
              <!-- <p class="mb-0">© 2020 Veltrix. Crafted with <i class="mdi mdi-heart text-danger"></i> by Themesbrand</p> -->
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
        email: null,
        password: null,
      },
      errors: [],
      loading: false,
    };
  },
  methods: {
    submit() {
      this.loading = true;
      axios
        .post("/login", this.form)
        .then((res) => {
          this.loading = false;
          this.toaster("Authenticated", "success");
          this.$inertia.visit("/dashboard");
        })
        .catch((err) => {
          if ([err.response.data.errors.email[0]][0]) {
            this.errors = [err.response.data.errors.email[0]][0];
            this.toaster(err.response.data.message, "error");
            this.loading = false;
          }
        });
    },
  },
  mounted() {
    this.loading = false;
  },
  created() {
    this.loading = true;
  },
};
</script>

<style>
</style>


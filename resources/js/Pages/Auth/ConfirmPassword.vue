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
                  <h5 class="text-white font-size-20 p-2">Reset Password</h5>
                  <a href="https://adeptlessor.com/" class="logo logo-admin">
                    <img
                      src="assets/images/logo-sm.png"
                      height="24"
                      alt="logo"
                    />
                  </a>
                </div>
              </div>

              <div class="card-body p-4">
                <div class="p-3">
                  <div class="alert alert-success mt-5" role="alert">
                    Enter your Password
                  </div>
                  <!-- 81 bags of cement minus your age plus 40 will give you the laast two digit of your birth -->
                  <form
                    class="form-horizontal mt-4"
                    method="post"
                    action=""
                    @submit.prevent="submit"
                  >
                    <div class="form-group">
                      <label for="useremail">Password</label>
                      <input
                        type="password"
                        class="form-control"
                        id="useremail"
                        name="email"
                        placeholder="Enter email"
                        v-model="form.password"
                      />
                    </div>

                    <div class="form-group row mb-0">
                      <div class="col-12 text-right">
                        <button
                          class="btn btn-primary w-md waves-effect waves-light"
                          type="submit"
                        >
                          Confirm
                        </button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>

            <div class="mt-5 text-center">
              <p>
                Remember It ?
                <inertia-link
                  :href="'/login'"
                  class="font-weight-medium text-primary"
                >
                  Sign In here
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
export default {
  data() {
    return {
      form: {},
    };
  },
  methods: {
    submit() {
      this.$inertia.post("/user/confirm-password", this.form);
    },
  },
};
</script>

<style>
</style>

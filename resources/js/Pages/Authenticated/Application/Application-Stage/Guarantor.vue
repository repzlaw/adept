<template>
  <!-- sample modal content -->
  <div class="card card-body">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title mt-0" id="myModalLabel">
          Update Guarantor's Information
        </h5>
        <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> -->
      </div>
      <form action="" method="post" @submit.prevent="updateGuarantor">
        <vue-element-loading
          :active="loading"
          spinner="mini-spinner"
          color="#073491"
        />
        <div class="modal-body">
          <div class="row">
            <div class="col-lg-12 col-md-12">
              <div class="form-group">
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      Referees / Guarantor(1) Name
                    </span>
                  </div>
                  <input
                    class="form-control"
                    type="text"
                    required
                    v-model="form.g_1_name"
                    placeholder="Guarantor's Name"
                  />
                </div>
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      Referees / Guarantor(1) Email
                    </span>
                  </div>
                  <input
                    class="form-control"
                    type="email"
                    required
                    v-model="form.g_1_email"
                    placeholder="Guarantor's email"
                  />
                </div>
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      Referees / Guarantor(1) Phone
                    </span>
                  </div>
                  <input
                    class="form-control"
                    type="number"
                    required
                    v-model="form.g_1_phone"
                    placeholder="Guarantor's phone"
                  />
                </div>
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      Referees / Guarantor(1) Company or Place of Employment
                    </span>
                  </div>
                  <input
                    class="form-control"
                    type="text"
                    required
                    v-model="form.g_1_company"
                    placeholder="Guarantor's Company or Place of Employment"
                  />
                </div>
              </div>
            </div>
            <div class="col-12 mb-2 mt-2">
              <div class="dropdown-divider"></div>
            </div>
            <div class="col-lg-12 col-md-12">
              <div class="form-group">
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      Referees / Guarantor(2) Name
                    </span>
                  </div>
                  <input
                    class="form-control"
                    type="text"
                    required
                    v-model="form.g_2_name"
                    placeholder="Guarantor's Name"
                  />
                </div>
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      Referees / Guarantor(2) Email
                    </span>
                  </div>
                  <input
                    class="form-control"
                    type="email"
                    required
                    v-model="form.g_2_email"
                    placeholder="Guarantor's Email"
                  />
                </div>
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      Referees / Guarantor(2) Phone
                    </span>
                  </div>
                  <input
                    class="form-control"
                    type="number"
                    required
                    v-model="form.g_2_phone"
                    placeholder="Guarantor's Phone"
                  />
                </div>
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      Referees / Guarantor(2) Company or Place of Employment
                    </span>
                  </div>
                  <input
                    class="form-control"
                    type="text"
                    required
                    v-model="form.g_2_company"
                    placeholder="Guarantor's Company or Place of Employment"
                  />
                </div>
              </div>
            </div>
            <div class="col-12 mb-2 mt-2">
              <div class="dropdown-divider"></div>
            </div>
            <div class="col-lg-12 col-md-12">
              <div class="form-group">
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      Referees / Guarantor(3) Name
                    </span>
                  </div>
                  <input
                    class="form-control"
                    type="text"
                    required
                    v-model="form.g_3_name"
                    placeholder="Guarantor's Name"
                  />
                </div>
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      Referees / Guarantor(3) Email
                    </span>
                  </div>
                  <input
                    class="form-control"
                    type="email"
                    required
                    v-model="form.g_3_email"
                    placeholder="Guarantor's Email"
                  />
                </div>
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      Referees / Guarantor(3) Phone
                    </span>
                  </div>
                  <input
                    class="form-control"
                    type="number"
                    required
                    v-model="form.g_3_phone"
                    placeholder="Guarantor's Phone"
                  />
                </div>
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      Referees / Guarantor(3) Company or Place of Employment
                    </span>
                  </div>
                  <input
                    class="form-control"
                    type="text"
                    required
                    v-model="form.g_3_company"
                    placeholder="Guarantor's Company or Place of Employment"
                  />
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="modal-footer">
          <input type="hidden" name="" v-model="form.id" />
          <!-- <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button> -->
          <button
            type="submit"
            class="btn btn-primary waves-effect waves-light"
          >
            Save changes
          </button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
  <!-- /.modal -->
</template>
<script>
import VueElementLoading from "vue-element-loading";
export default {
  components: {
    VueElementLoading,
  },
  data() {
    return {
      loading: false,
      guarantor_1: {
        g_1_name: "",
        g_1_email: "",
        g_1_phone: "",
        g_1_company: "",
      },
      guarantor_2: {
        g_2_name: "",
        g_2_email: "",
        g_2_phone: "",
        g_2_company: "",
      },
      guarantor_3: {
        g_3_name: "",
        g_3_email: "",
        g_3_phone: "",
        g_3_company: "",
      },
      form: {},
    };
  },
  methods: {
    guarantor(data) {
      this.form = data;
      var guarant1 = JSON.parse(data.guarantor_1);
      var guarant2 = JSON.parse(data.guarantor_2);
      var guarant3 = JSON.parse(data.guarantor_3);

      var guarant1 = data.guarantor_1;
      var guarant2 = data.guarantor_2;
      var guarant3 = data.guarantor_3;

      this.form.guarantor_1 = guarant1;
      this.form.guarantor_2 = guarant2;
      this.form.guarantor_3 = guarant3;
    },
    updateGuarantor() {
      // console.log(this.form);
      this.loading = true;
      axios
        .post("/updateGuarantor", this.form)
        .then((res) => {
          this.loading = false;
          this.toaster(res.data.message, "success");
          localStorage.setItem("appData", JSON.stringify(this.form));
          // $('#updateGuarantor').modal('hide');
          // this.$inertia.reload();
        })
        .catch((err) => {
          this.loading = false;
        });
    },
    getData() {
      var data = JSON.parse(localStorage.getItem("appData"));
      //    this.form = data;
      this.guarantor(data);
      //    console.log(data);
    },
  },
  mounted() {
    this.getData();
    // eventBus.$on('addGuarantor', this.guarantor)
  },
};
</script>
<style scoped>
</style>


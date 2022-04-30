<template>
  <Layout>
    <div class="page-content">
      <div class="container-fluid">
        <!-- start page title -->
        <div class="row align-items-center">
          <div class="col-sm-6">
            <div class="page-title-box">
              <h4 class="font-size-18">Profile</h4>
              <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item active">Welcome to AdeptLessor</li>
              </ol>
            </div>
          </div>

          <div class="col-sm-6">
            <div class="float-right d-sm-block">
              <div class="dropdown">
                <button
                  class="
                    btn btn-primary
                    dropdown-toggle
                    waves-effect waves-light
                  "
                  type="button"
                  data-toggle="dropdown"
                  aria-haspopup="true"
                  aria-expanded="false"
                >
                  <i class="mdi mdi-settings"></i>
                  <i class="fa fa-arrow-down"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right">
                  <a
                    class="dropdown-item"
                    href="Javascript:void(0)"
                    v-model="disable"
                    @click="edit"
                    >Edit Profile</a
                  >
                  <a
                    class="dropdown-item"
                    href="Javascript:void(0)"
                    data-target="#photo"
                    data-toggle="modal"
                    >Update Photo</a
                  >
                  <a
                    class="dropdown-item"
                    href="Javascript:void(0)"
                    data-target="#password"
                    data-toggle="modal"
                    >Update Password</a
                  >
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- end page title -->
        <form method="Post" action="" @submit.prevent="profile">
          <div class="row">
            <div class="col-xl-12">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title mb-4">Profile Settings</h4>
                  <div class="row">
                    <div class="col-md-12 col-lg-12 col-12">
                      <div class="alert alert-info">
                        <span class="fa fa-question-circle" title="help"></span>
                        <b>Note:</b> Click on the Option button above to enable
                        profile edit
                      </div>
                    </div>
                    <div class="col-lg-2 col-md-2 mb-3">
                      <img
                        src="/assets/images/users/user-2.jpg"
                        alt=""
                        class="avatar-lg rounded-circle"
                        v-if="!user.profile_photo_path"
                      />
                      <img
                        :src="'/storage/images/' + user.profile_photo_path"
                        alt=""
                        class="avatar-lg rounded-img w-100 h-100"
                        v-else
                      />
                    </div>
                    <div class="col-lg-10 col-md-10">
                      <div class="row">
                        <div class="col-lg-6 col-md-12">
                          <div class="form-group">
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text"> Surname </span>
                              </div>
                              <input
                                class="form-control"
                                type="text"
                                required
                                v-model="user.surname"
                                placeholder="Surname"
                                v-bind:disabled="disable"
                              />
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                          <div class="form-group">
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text"> Name </span>
                              </div>
                              <input
                                class="form-control"
                                type="text"
                                required
                                v-model="user.name"
                                placeholder="Name"
                                v-bind:disabled="disable"
                              />
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                          <div class="form-group">
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text">
                                  Othername
                                </span>
                              </div>
                              <input
                                class="form-control"
                                type="text"
                                required
                                v-model="user.othername"
                                placeholder="Othername"
                                v-bind:disabled="disable"
                              />
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                          <div class="form-group">
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text">
                                  E-mail Address
                                </span>
                              </div>
                              <input
                                class="form-control"
                                type="email"
                                required
                                v-model="user.email"
                                placeholder="Email"
                                v-bind:disabled="disable"
                              />
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                          <div class="form-group">
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text"> Address </span>
                              </div>
                              <input
                                class="form-control"
                                type="text"
                                required
                                v-model="user.adddress"
                                placeholder="Address"
                                v-bind:disabled="disable"
                              />
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                          <div class="form-group">
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text"> Phone </span>
                              </div>
                              <input
                                class="form-control"
                                type="text"
                                required
                                v-model="user.phone"
                                placeholder="Phone"
                                v-bind:disabled="disable"
                              />
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                          <div class="form-group">
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text"> LGA </span>
                              </div>
                              <input
                                class="form-control"
                                type="text"
                                required
                                v-model="user.lga"
                                placeholder="LGA"
                                v-bind:disabled="disable"
                              />
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                          <div class="form-group">
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text"> Sex </span>
                              </div>
                              <select
                                v-model="user.sex"
                                class="form-control"
                                v-bind:disabled="disable"
                              >
                                <option value="m">Male</option>
                                <option value="f">Female</option>
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                          <div class="form-group">
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text">
                                  Marital Status
                                </span>
                              </div>
                              <select
                                v-model="user.marital_status"
                                class="form-control"
                                v-bind:disabled="disable"
                              >
                                <option value="">--Choose--</option>
                                <option value="single">Single</option>
                                <option value="married">Married</option>
                                <option value="divorce">Divorce</option>
                                <option value="none">None</option>
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                          <div class="form-group">
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text">
                                  Date of Birth
                                </span>
                              </div>
                              <input
                                type="date"
                                class="form-control"
                                v-bind:disabled="disable"
                                placeholder="mm/dd/yyyy"
                                id="datepicker-autoclose"
                                required
                                v-model="user.dob"
                              />
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                          <div class="form-group">
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text"> Religion </span>
                              </div>
                              <select
                                v-model="user.religion"
                                class="form-control"
                                v-bind:disabled="disable"
                              >
                                <option value="islamic">Islamic</option>
                                <option value="christian">Christian</option>
                                <option value="other">Others</option>
                              </select>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-6 col-md-6" v-if="disable == false">
                        <div class="form-group float-right">
                          <input
                            type="submit"
                            value="Update"
                            class="btn btn-primary waves-effect waves-light"
                          />
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </form>
        <form action="" method="post">
          <div class="row">
            <div class="col-12">
              <div class="col-12">
                <div class="card">
                  <div class="card-title m-3">
                    <h3>
                      Bank Details
                      <div class="float-right d-sm-block">
                        <div class="dropdown">
                          <button
                            class="
                              btn btn-primary
                              dropdown-toggle
                              waves-effect waves-light
                            "
                            type="button"
                            data-toggle="dropdown"
                            aria-haspopup="true"
                            aria-expanded="false"
                          >
                            <i class="mdi mdi-settings"></i>
                            <i class="fa fa-arrow-down"></i>
                          </button>
                          <div class="dropdown-menu dropdown-menu-right">
                            <a
                              class="dropdown-item"
                              href="Javascript:void(0)"
                              data-target="#bank-details"
                              data-toggle="modal"
                              >Update Bank Details</a
                            >
                            <a
                              class="dropdown-item"
                              href="Javascript:void(0)"
                              data-target="#bank-bvn"
                              data-toggle="modal"
                              >Update BVN</a
                            >
                            <a
                              class="dropdown-item"
                              href="Javascript:void(0)"
                              data-target="#bank-nin"
                              data-toggle="modal"
                              >Update NIN</a
                            >
                          </div>
                        </div>
                      </div>
                    </h3>
                  </div>
                  <div class="card-body">
                    <div class="row">
                      <div class="col-2">
                        <img
                          src="/assets/images/gallery/bank-icon-logo-vector-260nw-399995245.webp"
                          alt=""
                        />
                      </div>
                      <div class="col-10">
                        <div class="row">
                          <div class="col-lg-6 col-md-6 col-12">
                            <div class="form-group">
                              <div class="input-group">
                                <div class="input-group-prepend">
                                  <span class="input-group-text">
                                    Bank Name
                                  </span>
                                </div>
                                <input
                                  type="text"
                                  class="form-control"
                                  v-bind:disabled="disable"
                                  placeholder="Bank Name"
                                  required
                                  v-model="user.bank_name"
                                />
                              </div>
                            </div>
                          </div>
                          <div class="col-lg-6 col-md-6 col-12">
                            <div class="form-group">
                              <div class="input-group">
                                <div class="input-group-prepend">
                                  <span class="input-group-text">
                                    Account Name
                                  </span>
                                </div>
                                <input
                                  type="text"
                                  class="form-control"
                                  v-bind:disabled="disable"
                                  placeholder="Account Name"
                                  required
                                  v-model="user.account_name"
                                />
                              </div>
                            </div>
                          </div>
                          <div class="col-lg-6 col-md-6 col-12">
                            <div class="form-group">
                              <div class="input-group">
                                <div class="input-group-prepend">
                                  <span class="input-group-text">
                                    Account Number
                                  </span>
                                </div>
                                <input
                                  type="text"
                                  class="form-control"
                                  v-bind:disabled="disable"
                                  placeholder="Account Name"
                                  required
                                  v-model="user.account_number"
                                />
                              </div>
                            </div>
                          </div>
                          <div class="col-lg-6 col-md-6 col-12">
                            <div class="form-group">
                              <div class="input-group">
                                <div class="input-group-prepend">
                                  <span class="input-group-text"> BVN </span>
                                </div>
                                <input
                                  type="text"
                                  class="form-control"
                                  v-bind:disabled="disable"
                                  placeholder="BVN number"
                                  required
                                  v-model="user.bvn_number"
                                />
                              </div>
                            </div>
                          </div>
                          <div class="col-lg-6 col-md-6 col-12">
                            <div class="form-group">
                              <div class="input-group">
                                <div class="input-group-prepend">
                                  <span class="input-group-text"> NIN </span>
                                </div>
                                <input
                                  type="text"
                                  class="form-control"
                                  v-bind:disabled="disable"
                                  placeholder="NIN number"
                                  required
                                  v-model="user.nin_number"
                                />
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </form>
        <!-- end row -->
      </div>
      <!-- container-fluid -->
      <!-- Modals -->
      <!-- /.modal -->
      <div
        id="photo"
        class="modal fade"
        tabindex="-1"
        role="dialog"
        aria-labelledby="myModalLabel"
        aria-hidden="true"
      >
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title mt-0" id="myModalLabel">Update Photo</h5>
              <button
                type="button"
                class="close"
                data-dismiss="modal"
                aria-hidden="true"
              >
                ×
              </button>
            </div>
            <form
              action=""
              method="post"
              @submit.prevent="photoUpdate"
              enctype="multipart/form-data"
            >
              <div class="modal-body">
                <div class="row">
                  <div class="col-lg-12 col-md-12">
                    <div class="form-group">
                      <div class="input-group mb-2">
                        <div class="input-group-prepend">
                          <span class="input-group-text">
                            Update Profile Photo
                          </span>
                        </div>
                        <input
                          type="file"
                          class="form-control"
                          @change="onFileChange"
                        />
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button
                  type="button"
                  class="btn btn-secondary waves-effect"
                  data-dismiss="modal"
                >
                  Close
                </button>
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
      </div>

      <!-- For Password -->

      <div
        id="password"
        class="modal fade"
        tabindex="-1"
        role="dialog"
        aria-labelledby="myModalLabel"
        aria-hidden="true"
      >
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title mt-0" id="myModalLabel">
                Update Password
              </h5>
              <button
                type="button"
                class="close"
                data-dismiss="modal"
                aria-hidden="true"
              >
                ×
              </button>
            </div>
            <form
              action=""
              method="post"
              @submit.prevent="updatePassword"
              enctype="multipart/form-data"
            >
              <div class="modal-body">
                <div class="row">
                  <div class="col-lg-12 col-md-12">
                    <div class="form-group">
                      <div class="input-group mb-2">
                        <div class="input-group-prepend">
                          <span class="input-group-text"> Old Password </span>
                        </div>
                        <input
                          type="password"
                          class="form-control"
                          v-model="password.old"
                        />
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="input-group mb-2">
                        <div class="input-group-prepend">
                          <span class="input-group-text"> New Password </span>
                        </div>
                        <input
                          type="password"
                          class="form-control"
                          v-model="password.password"
                          @input="checkPassword"
                        />
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="input-group mb-2">
                        <div class="input-group-prepend">
                          <span class="input-group-text">
                            Confirm Password
                          </span>
                        </div>
                        <input
                          type="password"
                          class="form-control"
                          v-model="password.confirm"
                          @input="checkPassword"
                        />
                      </div>
                    </div>
                    <p style="color: red">{{ password.checkConfirm }}</p>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button
                  type="button"
                  class="btn btn-secondary waves-effect"
                  data-dismiss="modal"
                >
                  Close
                </button>
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
      </div>
      <!-- /.modal -->
      <!-- /.modal -->
      <div
        id="bank-details"
        class="modal fade"
        tabindex="-1"
        role="dialog"
        aria-labelledby="myModalLabel"
        aria-hidden="true"
      >
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title mt-0" id="myModalLabel">
                Add Bank Details
              </h5>
              <button
                type="button"
                class="close"
                data-dismiss="modal"
                aria-hidden="true"
              >
                ×
              </button>
            </div>
            <form action="" method="post" @submit.prevent="checkAccount">
              <div class="modal-body">
                <div class="row">
                  <div class="col-lg-12 col-md-12">
                    <div class="form-group">
                      <div class="input-group mb-2">
                        <div class="input-group-prepend">
                          <span class="input-group-text"> Bank Name </span>
                        </div>
                        <select
                          class="form-control custom-select"
                          v-model="form.bank_code"
                        >
                          <option value>-- Choose Bank --</option>
                          <option
                            v-for="bank in banks.data"
                            :key="bank.id"
                            :value="bank.code + ', ' + bank.name"
                          >
                            {{ bank.name }}
                          </option>
                        </select>
                      </div>
                      <div class="input-group mb-2">
                        <div class="input-group-prepend">
                          <span class="input-group-text"> Account Number </span>
                        </div>
                        <input
                          class="form-control"
                          type="text"
                          required
                          v-model="form.account_number"
                          placeholder="Enter Valid Account Number"
                        />
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button
                  type="button"
                  class="btn btn-secondary waves-effect"
                  data-dismiss="modal"
                >
                  Close
                </button>
                <button
                  type="submit"
                  class="btn btn-primary waves-effect waves-light"
                >
                  Save changes
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <!-- /.modal -->
      <!-- /.modal -->
      <div
        id="bank-bvn"
        class="modal fade"
        tabindex="-1"
        role="dialog"
        aria-labelledby="myModalLabel"
        aria-hidden="true"
      >
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title mt-0" id="myModalLabel">
                Add BVN Details
              </h5>
              <button
                type="button"
                class="close"
                data-dismiss="modal"
                aria-hidden="true"
              >
                ×
              </button>
            </div>
            <form action="" method="post" @submit.prevent="checkBvn">
              <div class="modal-body">
                <div class="row">
                  <div class="col-lg-12 col-md-12">
                    <div class="form-group">
                      <div class="input-group mb-2">
                        <div class="input-group-prepend">
                          <span class="input-group-text"> BVN Number </span>
                        </div>
                        <input
                          class="form-control"
                          type="text"
                          required
                          v-model="form.bvn_number"
                          placeholder="Enter Valid BVN Number"
                        />
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button
                  type="button"
                  class="btn btn-secondary waves-effect"
                  data-dismiss="modal"
                >
                  Close
                </button>
                <button
                  type="submit"
                  class="btn btn-primary waves-effect waves-light"
                >
                  Save changes
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <!-- Modal For Nin -->
      <div
        id="bank-nin"
        class="modal fade"
        tabindex="-1"
        role="dialog"
        aria-labelledby="myModalLabel"
        aria-hidden="true"
      >
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title mt-0" id="myModalLabel">
                Add NIN Details
              </h5>
              <button
                type="button"
                class="close"
                data-dismiss="modal"
                aria-hidden="true"
              >
                ×
              </button>
            </div>
            <form action="" method="post" @submit.prevent="checkNin">
              <div class="modal-body">
                <div class="row">
                  <div class="col-lg-12 col-md-12">
                    <div class="form-group">
                      <div class="input-group mb-2">
                        <div class="input-group-prepend">
                          <span class="input-group-text"> NIN Number </span>
                        </div>
                        <input
                          class="form-control"
                          type="text"
                          required
                          v-model="form.nin_number"
                          placeholder="Enter Valid NIN Number"
                        />
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button
                  type="button"
                  class="btn btn-secondary waves-effect"
                  data-dismiss="modal"
                >
                  Close
                </button>
                <button
                  type="submit"
                  class="btn btn-primary waves-effect waves-light"
                >
                  Save changes
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <!-- /.modal -->
    </div>
    <!-- End Page-content -->
  </Layout>
</template>

<script>
import Layout from "@/BaseLayout/Layout";
import Input from "@/Jetstream/Input";
// import Input from "@/Jetstream/Input";

export default {
  props: {
    user: {},
  },
  components: {
    Input,
    // Input,
    Layout,
  },
  data() {
    return {
      disable: "disabled",
      photo: "",
      form: {},
      password: {
        checkConfirm: "",
      },
      AccountDetailsLoading: false,
      banks: {},
    };
  },
  methods: {
    getCurrent(handler) {
      this.form = handler;
    },

    edit() {
      this.disable = false;
    },
    profile() {
      axios.post("/profileEdit", this.user).then((res) => {
        this.toaster(res.data.message, "success");
        this.disable = "true";
        this.$inertia.reload();
      });
    },
    onFileChange(e) {
      this.photo = e.target.files[0];
    },
    photoUpdate() {
      const config = {
        headers: { "content-type": "multipart/form-data" },
      };

      let formData = new FormData();
      formData.append("photo", this.photo);
      formData.append("id", this.user.id);

      axios.post("/photoUpdate", formData, config).then((res) => {
        this.toaster(res.data.data, "success");
        $("#photo").modal("hide");
        this.$inertia.reload();
      });
    },
    getAllBankNames() {
      this.AccountDetailsLoading = true;
      axios
        .get("/application/AllBanks")
        .then((res) => {
          // console.log(res.data)
          this.banks = res.data;
        })
        .catch((err) => {
          swal("Error", "Unable to fetch Bank Data ", "error");
        })
        .finally((er) => {
          this.AccountDetailsLoading = false;
        });
    },
    ///////function to send request to resoves account
    async checkAccount() {
      ////set loader to true, get form data
      this.AccountDetailsLoading = true;
      //////get bank name and bank code
      var bank_details;
      bank_details = this.form.bank_code;
      bank_details = bank_details.split(", ");

      ///////set form data
      let data = new FormData();
      data.append("account_number", this.form.account_number);
      data.append("bank_code", bank_details[0]);
      /////use axios to send post rerquest
      axios({
        method: "post",
        url: "/application/resolve_account",
        data: data,
      })
        .then((response) => {
          //////check if the action return true
          if (response.data.status == false) {
            /////if no
            this.$swal(
              "Account Error",
              "Could not resolve account name. Check details and try again",
              "error"
            );
          } else {
            ///////if returns true show the user his bank details to confirm

            this.$swal({
              icon: "info",
              title: "Your Account Details",
              text:
                "Account Name: " +
                response.data.data.data.account_name +
                "\n Account Number: " +
                response.data.data.data.account_number +
                " \n  Bank Name: " +
                bank_details[1],
              type: "info",
              buttons: ["no", "Yes"],
            }).then((result) => {
              ///////////if the user clicks on continue
              if (result) {
                let save_data = new FormData();
                save_data.append(
                  "account_number",
                  response.data.data.data.account_number
                );
                save_data.append("bank_code", bank_details[0]);
                save_data.append("bank_name", bank_details[1]);
                save_data.append(
                  "account_name",
                  response.data.data.data.account_name
                );
                save_data.append("id", this.user.id);
                axios({
                  method: "post",
                  url: "/application/save_account ",
                  data: save_data,
                })
                  .then((res) => {
                    this.$swal(
                      "Success",
                      "Account Details Updated Successfully",
                      "success"
                    );
                    $("#bank-details").modal("hide");
                    this.$inertia.reload();
                  })
                  .catch((err) => {
                    this.$swal(
                      "Error",
                      "Error Saving Account, Try Again",
                      "error"
                    );
                  });
              } else {
                swal("Cancelled", "No action made", "error");
              }
            });
          }
        })
        .catch((response) => {
          //handle error
          this.AccountDetailsLoading = false;
          this.$swal("Error", "Error resolving account, Try again", "error");
        });
    },
    ///////function to send request to resoves bvn
    async checkBvn() {
      ////set loader to true, get form data
      this.AccountDetailsLoading = true;
      //////get bank name and bank code
      var bank_bvn_number = this.form.bvn_number;
      ///////set form data
      let data = new FormData();
      data.append("bvn_number", bank_bvn_number);
      /////use axios to send post rerquest
      axios({
        method: "post",
        url: "/application/save_bvn",
        data: data,
      }).then((response) => {
        this.toaster(response.data.success, "success");
        $("#bank-bvn").modal("hide");
        this.$inertia.reload();
      });
      //////check if the action return true
      // if (response) {
      /////if no
      //   this.$swal(
      //     "Account Error",
      //     "Could not resolve BVN. Check details and try again",
      //     "error"
      //   );
      //       } else {
      //         ///////if returns true show the user his bank details to confirm

      //         this.$swal({
      //           icon: "info",
      //           title: "Your Account Details",
      //           text:
      //             "First Name: " +
      //             response.data.data.data.first_name +
      //             "\n Last Number: " +
      //             response.data.data.data.last_name +
      //             " \n  Phone Number: " +
      //             response.data.data.data.mobile +
      //             " \n  Date of Birth: " +
      //             response.data.data.data.dob,
      //           type: "info",
      //           buttons: ["no", "Yes"],
      //         }).then((result) => {
      //           ///////////if the user clicks on continue
      //           if (result) {
      //             let save_data = new FormData();
      //             save_data.append("bvn_number", bank_bvn_number);
      //             save_data.append("id", this.user.id);
      //             axios({
      //               method: "post",
      //               url: "/application/save_bvn ",
      //               data: save_data,
      //             })
      //               .then((res) => {
      //                 this.$swal(
      //                   "Success",
      //                   "Account Details Updated Successfully",
      //                   "success"
      //                 );
      //                 $("#bank-bvn").modal("hide");
      //                 this.$inertia.reload();
      //               })
      //               .catch((err) => {
      //                 this.$swal(
      //                   "Error",
      //                   "Error Saving Account, Try Again",
      //                   "error"
      //                 );
      //               });
      //           } else {
      //             swal("Cancelled", "No action made", "error");
      //           }
      //         });
      //       }
      //     })
      //     .catch((response) => {
      //       //handle error
      //       this.AccountDetailsLoading = false;
      //       this.$swal("Error", "Error resolving account, Try again", "error");
      //     });
    },
    async checkNin() {
      var bank_nin_number = this.form.nin_number;
      let data = new FormData();
      data.append("nin_number", bank_nin_number);
      /////use axios to send post rerquest
      axios({
        method: "post",
        url: "/application/save_nin",
        data: data,
      }).then((response) => {
        this.toaster(response.data.success, "success");
        $("#bank-nin").modal("hide");
        this.$inertia.reload();
      });
    },
    checkPassword() {
      let pass = this.password.password;
      let conpass = this.password.confirm;
      if (pass !== conpass) {
        this.password.checkConfirm = "Password dosen't match";
      } else {
        this.password.checkConfirm = "";
      }
    },
    updatePassword() {
      axios
        .post("/updatePassword", this.password)
        .then((response) => {
          console.log(response);
          this.toaster(response.data.data, "success");
          location.reload();
        })
        .catch((error) => {
          //   alert();
        //   console.log(error.response.data.error);
          this.toaster(error.response.data.error, "error");
        });
    },
  },
  mounted() {
    this.getAllBankNames();
  },
};
</script>

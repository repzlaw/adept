<template>
  <Layout>
    <div class="page-content">
      <div class="container-fluid">
        <!-- start page title -->
        <div class="row align-items-center">
          <div class="col-sm-6">
            <div class="page-title-box">
              <h4 class="font-size-18">My Application</h4>
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
                  Create Application
                  <!-- <i class="mdi mdi-settings "></i> -->
                  <i class="fa fa-arrow-down ml-2"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right">
                  <inertia-link
                    class="dropdown-item"
                    :href="'/create-application-index'"
                    >Apply</inertia-link
                  >
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- end page title -->

        <div class="row">
          <div class="col-xl-12">
            <div class="card">
              <div class="card-body">
                <vue-element-loading
                  :active="loading"
                  spinner="mini-spinner"
                  color="#073491"
                />
                <h4 class="card-title mb-4">My Leasing Application(s)</h4>
                <!-- <div style="overflow:auto;" class="bottom-scroll"> -->
                <table
                  class="
                    table table-hover table-responsive-sm table-responsive-sm
                    mb-0
                  "
                >
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Email</th>
                      <th>Business Name</th>
                      <th>Last Yrs Income</th>
                      <th>Current Yrs Income</th>
                      <th>Asset Details</th>
                      <th>Goods Desc</th>
                      <th>Application Type</th>
                      <th>Status</th>
                      <th>Refund Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(dt, index) in data" :key="index">
                      <th scope="row">{{ index + 1 }}</th>
                      <td>{{ dt.user.email }}</td>
                      <td>{{ dt.business_name }}</td>
                      <td>{{ dt.last_year_net_income }}</td>
                      <td>{{ dt.current_year_income }}</td>
                      <td>{{ dt.details_of_asset }}</td>
                      <td>{{ dt.goods_description }}</td>
                      <td>
                        <span
                          :class="[
                            dt.application_type == 'individual'
                              ? 'badge badge-info'
                              : 'badge badge-success',
                          ]"
                        >
                          {{ dt.application_type }}</span
                        >
                      </td>
                      <td>
                        <span
                          :class="[
                            dt.status == 'pending'
                              ? 'badge badge-info'
                              : dt.status == 'Approved'
                              ? 'badge badge-success'
                              : 'badge badge-danger',
                          ]"
                        >
                          {{ dt.status }}</span
                        >
                      </td>

                      <td>
                        <span
                          v-if="dt.supplier"
                          :class="[
                            dt.supplier.status == 'Pending'
                              ? 'badge badge-info'
                              : dt.supplier.status == 'Completed'
                              ? 'badge badge-success'
                              : 'badge badge-danger',
                          ]"
                        >
                          {{ dt.supplier.status }}</span
                        >
                      </td>
                      <td>
                        <div class="dropdown">
                          <button
                            class="
                              btn btn-outline-primary btn-sm
                              dropdown-toggle
                              waves-effect waves-light
                            "
                            type="button"
                            data-toggle="dropdown"
                            aria-haspopup="true"
                            aria-expanded="false"
                          >
                            <i class="mdi mdi-settings"></i>
                          </button>
                          <div class="dropdown-menu dropdown-menu-right">
                            <a
                              class="dropdown-item"
                              v-if="$page.auth.user.user_type == 'admin'"
                              href="Javascript:void(0)"
                              data-target="#editInformation"
                              data-toggle="modal"
                              @click="EditData(dt)"
                              >Edit Application</a
                            >
                            <a
                              class="dropdown-item"
                              href="Javascript:void(0)"
                              data-toggle="modal"
                              data-target="#viewInformation"
                              @click="viewData(dt)"
                              >View Application</a
                            >
                            <a
                              class="dropdown-item"
                              href="Javascript:void(0)"
                              v-if="
                                $page.auth.user.user_type == 'admin' &&
                                dt.supplier
                              "
                              data-toggle="modal"
                              data-target="#attach"
                              @click="getCurrent(dt)"
                              >Attach Plan</a
                            >
                            <a
                              class="dropdown-item"
                              href="Javascript:void(0)"
                              data-toggle="modal"
                              data-target="#UploadCertificate"
                              @click="getCurrent(dt)"
                              >Upload Certificates</a
                            >
                            <!-- <a class="dropdown-item" href="Javascript:void(0)" data-toggle="modal" data-target="#bank-details" @click="getCurrent(dt)">Update Account Details</a> -->
                            <a
                              class="dropdown-item"
                              href="Javascript:void(0)"
                              data-toggle="modal"
                              data-target="#updateGuarantor"
                              @click="addGuarantor(dt)"
                              >Update Guarantor Details</a
                            >
                            <a
                              class="dropdown-item"
                              v-if="
                                $page.auth.user.user_type == 'admin' &&
                                dt.supplier
                              "
                              href="Javascript:void(0)"
                              data-toggle="modal"
                              data-target="#UpdateAccount"
                              @click="treatApplication(dt)"
                              >Approve / Decline
                            </a>
                            <inertia-link
                              class="dropdown-item"
                              :href="'/profile/' + dt.user_id"
                              >View Profile</inertia-link
                            >
                            <a
                              class="dropdown-item"
                              href="Javascript:void(0)"
                              data-toggle="modal"
                              data-target="#ViewCertificate"
                              @click="ViewCertificate(dt)"
                              >View Certificates</a
                            >
                            <a
                              class="dropdown-item"
                              href="Javascript:void(0)"
                              data-toggle="modal"
                              data-target="#supplier"
                              @click="AddSupplier(dt)"
                              >Manage Supplier
                            </a>
                            <a
                              class="dropdown-item"
                              v-if="
                                $page.auth.user.user_type == 'admin'
                              "
                              href="Javascript:void(0)"
                              data-toggle="modal"
                              data-target="#UpdateAccount"
                              @click="deleteApplication(dt)"
                              >Delete Application
                            </a>
                          </div>
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
                <!-- </div> -->
              </div>
            </div>
          </div>
        </div>
        <!-- end row -->
      </div>
      <!-- container-fluid -->
      <!-- Modals -->

      <div
        id="editInformation"
        class="modal fade"
        tabindex="-1"
        role="dialog"
        aria-labelledby="myModalLabel"
        aria-hidden="true"
      >
        <edit-application />
      </div>

      <div
        id="viewInformation"
        class="modal fade"
        tabindex="-1"
        role="dialog"
        aria-labelledby="myModalLabel"
        aria-hidden="true"
      >
        <view-application />
      </div>

      <div
        id="updateGuarantor"
        class="modal fade"
        tabindex="-1"
        role="dialog"
        aria-labelledby="myModalLabel"
        aria-hidden="true"
      >
        <guarantor />
      </div>
      <!-- /.modal -->

      <!-- sample modal content -->

      <!-- /.modal -->
      <!-- sample modal content -->
      <div
        id="downloadCertificate"
        class="modal fade"
        tabindex="-1"
        role="dialog"
        aria-labelledby="myModalLabel"
        aria-hidden="true"
      >
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title mt-0" id="myModalLabel">
                Download Certificates
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
            <div class="modal-body">
              <div class="row">
                <div class="col-lg-12 col-md-12">
                  <div class="form-group">
                    <p>
                      <a
                        v-bind:href="current.incorporation_certificate"
                        target="_blank"
                        >Download CAC certificate</a
                      >
                    </p>
                    <p>
                      <a v-bind:href="current.tax_clearance" target="_blank"
                        >Download Tax certificate</a
                      >
                    </p>
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
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>

      <div
        id="supplier"
        class="modal fade"
        tabindex="-1"
        role="dialog"
        aria-labelledby="myModalLabel"
        aria-hidden="true"
      >
        <supplier />
      </div>

      <!-- sample modal content -->
      <div
        id="UploadCertificate"
        class="modal fade"
        tabindex="-1"
        role="dialog"
        aria-labelledby="myModalLabel"
        aria-hidden="true"
      >
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title mt-0" id="myModalLabel">
                Upload Certificates
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
              @submit.prevent="formSubmit"
              enctype="multipart/form-data"
            >
              <div class="modal-body">
                <div class="col-lg-12 col-md-12">
                  <h4 class="card-title">Upload Certificates</h4>
                  <div class="alert alert-info">
                    <p>
                      <strong>Note :</strong> You are required to upload the
                      below listed Certificates for quick approval of you
                      application, there may be delays in the approval of your
                      application if all certificates are not uploaded. <br />
                    </p>
                    <p>
                      <strong>Note:</strong> Certificates Will be requested
                      based on your Application type<br />
                    </p>
                    <ul>
                      <span v-if="form.application_type == 'individual'">
                        <li>Your proforma invoice</li>
                        <li>6-12 Bank statements of account</li>
                        <li>A Copy of your utility bill (within 3 months)</li>
                        <li>Passport photos (2 copies)</li>
                        <li>Means of ID (Govt issued)</li>
                        <li>
                          Guarantors forms (already you have implemented this)
                        </li>
                        <li>
                          Any other documents that can aid our approval (Here
                          provide chance for client to add more docs)
                        </li>
                      </span>

                      <span v-else>
                        <li>One(1) year bank statement of account</li>
                        <li>Company Registration Documents including</li>
                        <li>Memo and Article of Association</li>
                        <li>Form CO2</li>
                        <li>Form CO7</li>
                        <li>CAC Certificate</li>
                        <li>Utuility Bill (Both Office and Home of MD)</li>
                        <li>Request Letter on Company Letter Head</li>
                        <li>
                          Letter of Authority mandating the MD to act on behalf
                          of the company
                        </li>
                        <li>Board Resolution</li>
                        <li>2 copies of Passport Photos (MD)</li>
                        <li>Means of Identity (MD)</li>
                        <li>Other relevant documents</li>
                      </span>
                    </ul>
                  </div>
                  <div class="mb-3">
                      <strong style="color:red" >
                          Upload at least 6 documents for individual application or 12 for corporative application
                      </strong>
                  </div>
                  <div class="form-group">
                    <div class="input-group input-group-lg">
                      <label>Upload Above Certificates</label>
                      <input
                        type="file"
                        name="filename"
                        multiple
                        class="dropify"
                        data-height="134"
                        data-allowed-file-extensions="jpg jpeg png jfif"
                        required
                        v-on:change="OnFileChange"
                      />
                    </div>
                  </div>
                </div>
                <div class="row">
                  <input
                    type="hidden"
                    name="application_id"
                    v-model="form.id"
                  />
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

      <div
        id="ViewCertificate"
        class="modal fade"
        tabindex="-1"
        role="dialog"
        aria-labelledby="myModalLabel"
        aria-hidden="true"
      >
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title mt-0" id="myModalLabel">
                View Uploaded Certificates
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
            <div
              class="text-right mr-4 mt-4"
              v-if="$page.auth.user.user_type == 'admin'"
            >
              <button
                class="btn btn-sm btn-primary"
                title="Download All"
                @click="DownloadCertificate(myCertificates)"
              >
                <i class="fa fa-download"></i> &nbsp; Download All
              </button>
            </div>
            <form
              action=""
              method="post"
              @submit.prevent="formSubmit"
              enctype="multipart/form-data"
            >
              <div class="modal-body">
                <div class="row">
                  <div
                    class="col md-4 col-6"
                    v-for="(img, index) in myCertificates"
                    :key="index"
                  >
                    <div class="text-right">
                      <a :href="img" target="_blank"
                        ><i class="fa fa-eye" title="view"></i
                      ></a>
                    </div>
                    <object
                      :data="img"
                      style="height: 250px; width: 350px"
                    ></object>
                    <!-- <img :src="img" alt="" style="height:250px; width:350px;"> -->
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
                <!-- <button type="submit" class="btn btn-primary waves-effect waves-light">Save changes</button> -->
              </div>
            </form>
          </div>
        </div>
      </div>

      <div
        id="attach"
        class="modal fade"
        tabindex="-1"
        role="dialog"
        aria-labelledby="myModalLabel"
        aria-hidden="true"
      >
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title mt-0" id="myModalLabel">
                Attach Payment Plan
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
            <form action="" method="post" @submit.prevent="attachPlan">
              <div class="modal-body">
                <div class="row">
                  <div class="form-group">
                    <!-- <label for="plan">Payment Plan</label><br /> -->
                    <div class="input-group mb-2 p-5">
                      <select
                        class="form-control custom-select"
                        id="plan"
                        required
                        v-model="form.payment_plan"
                      >
                        <option value="">Select Payment Structure</option>
                        <option
                          v-for="(percentage, index) in percentages"
                          :value="percentage.id"
                          :key="index"
                        >
                          {{ percentage.name }}
                        </option>
                      </select>
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

    </div>
  </Layout>
</template>

<script>
import Layout from "@/BaseLayout/Layout";
import Input from "@/Jetstream/Input";
import VueElementLoading from "vue-element-loading";
import Certificate from "./Modals/Certificate.vue";
import Supplier from "./Modals/Supplier.vue";
import Guarantor from "./Modals/Guarantor.vue";
import ViewApplication from "./Modals/ViewApplication.vue";
import EditApplication from "./Modals/EditApplication.vue";
import BankDetails from "./Modals/BankDetails.vue";

export default {
  props: {
    data: {},
  },
  components: {
    Input,
    Layout,
    VueElementLoading,
    Certificate,
    Supplier,
    Guarantor,
    ViewApplication,
    EditApplication,
    BankDetails,
  },
  data() {
    return {
      loading: false,
      form: {
        g_1_name: "",
        g_1_email: "",
        g_1_phone: "",
        guarantor_1: {},
        guarantor_2: {},
        guarantor_3: {},
      },
      banks: {},
      tax: {},
      cac: {},
      current: {},
      guarantor_1: {
        g_1_name: "",
        g_1_email: "",
        g_1_phone: "",
      },
      guarantor_2: {
        g_2_name: "",
        g_2_email: "",
        g_2_phone: "",
      },
      guarantor_3: {
        g_3_name: "",
        g_3_email: "",
        g_3_phone: "",
      },
      supplier: {
        name: "",
        application_id: "",
        phone: "",
        address: "",
        percentage: "",
      },
      percentages: {},
      certificates: {},
      myCertificates: [],
      disableField: false,
    };
  },
  methods: {
    OnFileChange(e) {
      this.certificates = e.target.files;
      // console.log(e);
    },
    taxOnFileChange(e) {
      this.tax = e.target.files[0];
    },
    getPercentage() {
      axios
        .get("/paySetting")
        .then((res) => {
          this.percentages = res.data.paymentPlan;
        })
        .catch((err) => {});
    },
    attachPlan() {
      axios
        .post("/attachPlan", this.form)
        .then((res) => {
          this.percentages = res.data.paymentPlan;
          $("#attach").modal("hide");
          this.toaster(res.data.message, "success");
          this.$inertia.reload();
        })
        .catch((err) => {});
    },
    formSubmit(e) {
      e.preventDefault();
      let currentObj = this;

      const config = {
        headers: { "content-type": "multipart/form-data" },
      };

      let formData = new FormData();
      for (var i = 0; i < this.certificates.length; i++) {
        formData.append("file" + i, this.certificates[i]);
      }

      formData.append("application", this.form.id);

      axios
        .post("/uploadCertificate", formData, config)
        .then((res) => {
          this.toaster(res.data.message, "success");
          $("#UploadCertificate").modal("hide");
          this.$inertia.reload();
        })
        .catch(function (error) {
          swal("Error", error.response.data.message, "error");
        });
    },
    AddCertificate(data) {
      // console.log(data)
      this.form = data;
    },
    getCurrent(current) {
      this.supplier = {};
      this.form = current;
      this.current = current;
      this.supplier.application_id = current.id;
    },
    EditData(data) {
      eventBus.$emit("editApplication", data);
    },
    viewData(data) {
      eventBus.$emit("viewApplication", data);
    },
    AddSupplier(data) {
      eventBus.$emit("AddSupplier", data);
    },
    AddCertificate(data) {
      eventBus.$emit("AddCertificate", data);
    },
    addGuarantor(data) {
      eventBus.$emit("addGuarantor", data);
    },

    treatApplication(data) {
      swal({
        title: "Are you sure You want to?",
        text: " Approve / Decline this Application",
        icon: "info",
        buttons: ["Decline", "Approve"],
        successMode: true,
      }).then((delRec) => {
        if (delRec) {
          axios
            .post("/activate-deactivate", { id: 1, rec: data })
            .then((res) => {
              this.toaster("Application Approved", "success");
              this.$inertia.reload();
            })
            .catch((err) => {
              swal("Error", "Error in sending mail", "error");
            });
        } else {
          axios
            .post("/activate-deactivate", { id: 2, rec: data })
            .then((res) => {
              // console.log(res)
              this.toaster("Application Declined", "success");
              this.$inertia.reload();
            })
            .catch((err) => {
              swal("Error", "Error Deleting record", "error");
            });
        }
      });
    },
    ViewCertificate(data) {
      this.myCertificates = JSON.parse(data.certificate);
    },
    DownloadCertificate(data) {
      var myData = data;
      var temporaryDownloadLink = document.createElement("a");
      temporaryDownloadLink.style.display = "none";

      document.body.appendChild(temporaryDownloadLink);

      for (var n = 0; n < myData.length; n++) {
        var download = myData[n];
        temporaryDownloadLink.setAttribute("href", myData[n]);
        temporaryDownloadLink.setAttribute(
          "download",
          "certificate" + (Number([n]) + 1)
        );
        // return console.log(temporaryDownloadLink);
        temporaryDownloadLink.click();
      }

      document.body.removeChild(temporaryDownloadLink);
    },
    getAllBankNames() {
      this.AccountDetailsLoading = true;
      axios
        .get("/application/banks")
        .then((res) => {
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
      // this.AccountDetailsLoading = true;
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
                response.data.data.account_name +
                "\n Account Number: " +
                response.data.data.account_number +
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
                  response.data.data.account_number
                );
                save_data.append("bank_code", bank_details[0]);
                save_data.append("bank_name", bank_details[1]);
                save_data.append(
                  "account_name",
                  response.data.data.account_name
                );
                save_data.append("id", this.form.id);
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
    deleteApplication(data){
      swal({
        title: "Are you sure You want to?",
        text: " Delete this Application",
        icon: "info",
        buttons: ["Cancel", "Delete"],
        successMode: true,
      }).then((delRec) => {
        if (delRec){
          axios
            .post("/delete-application", { id: data.id})
            .then((res) => {
              this.toaster("Application Deleted", "success");
              this.$inertia.reload();
            })
            .catch((err) => {
              swal("Error", "Error Deleting record", "error");
            });
        }
      });
    }
  },
  mounted() {
    this.loading = false;
    this.getPercentage();
  },
  created() {
    this.loading = true;
  },
};
</script>

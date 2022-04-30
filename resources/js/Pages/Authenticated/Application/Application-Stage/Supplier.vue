<template>
  <div class="card card-body">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title mt-0" id="myModalLabel">
          Manage Supplier Details
        </h5>
        <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> -->
      </div>
      <!-- <form action="" method="post" v-if="disableField" @submit.prevent="submitUpdate">
                <div class="modal-body">
                        <div class="row">
                            <div class="col-2"></div>
                            <div class="col-8">
                                <div class="row">
                                    <div class="col-4">
                                        <p>Name</p>
                                    </div>
                                    <div class="col-8">
                                        <input type="text"  v-model="current.name" id="" class="form-control" :disabled="disableField">
                                    </div>
                                    <div class="col-4">
                                        <p>Address</p>
                                    </div>
                                    <div class="col-8">
                                        <input type="text" v-model="current.address" id="" class="form-control" :disabled="disableField">
                                    </div>
                                    <div class="col-4">
                                        <p>Phone</p>
                                    </div>
                                    <div class="col-8">
                                        <input type="text" v-model="current.phone" id="" class="form-control" :disabled="disableField">
                                    </div>
                                    <div class="col-4">
                                        <p>Item</p>
                                    </div>
                                    <div class="col-8">
                                        <input type="text" v-model="current.item" id="" class="form-control" :disabled="disableField">
                                    </div>
                                    <div class="col-4">
                                        <p>Description</p>
                                    </div>
                                    <div class="col-8">
                                        <input type="text" v-model="current.description" id="" class="form-control" :disabled="disableField">
                                    </div>
                                    <div class="col-4">
                                        <p>Amount</p>
                                    </div>
                                    <div class="col-8">
                                        <input type="text" v-model="current.amount" id="" class="form-control" :disabled="disableField">
                                    </div>
                                    <div class="col-4">
                                        <p>Amount To Refund</p>
                                    </div>
                                    <div class="col-8">
                                        <p>{{current.amount_to_refund}}</p>
                                    </div>
                                    <div class="col-4">
                                        <p>Amount_per_month</p>
                                    </div>
                                    <div class="col-8">
                                        <p>{{current.amount_per_month}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary waves-effect waves-light">Update changes</button>
                </div>
            </form> -->
      <form action="" method="post" @submit.prevent="saveSupplier">
        <vue-element-loading
          :active="loading"
          spinner="mini-spinner"
          color="#073491"
        />
        <!-- v-else -->
        <div class="modal-body">
          <div class="row">
            <div class="col-lg-12 col-md-12">
              <div class="form-group">
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <span class="input-group-text"> Supplier Name </span>
                  </div>
                  <input
                    class="form-control"
                    required
                    type="text"
                    v-model="current.name"
                    placeholder="Supplier name"
                  />
                </div>
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <span class="input-group-text"> Supplier Address </span>
                  </div>
                  <input
                    class="form-control"
                    required
                    type="text"
                    v-model="current.address"
                    placeholder="Supplier Address"
                  />
                </div>
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <span class="input-group-text"> Phone </span>
                  </div>
                  <input
                    class="form-control"
                    required
                    type="number"
                    v-model="current.phone"
                    placeholder="Phone number"
                  />
                </div>
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <span class="input-group-text"> Item </span>
                  </div>
                  <input
                    class="form-control"
                    required
                    type="text"
                    v-model="current.item"
                    placeholder="Items To be Purchased"
                  />
                </div>
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <span class="input-group-text"> Amount </span>
                  </div>
                  <input
                    class="form-control"
                    required
                    type="number"
                    v-model="current.amount"
                    placeholder="Amount in Number(350000)"
                  />
                </div>
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <span class="input-group-text"> Description </span>
                  </div>
                  <input
                    class="form-control"
                    required
                    type="text"
                    v-model="current.description"
                    placeholder="Description of Goods to be purchased"
                  />
                </div>

                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <span class="input-group-text"> Goods Type </span>
                  </div>
                  <select
                    class="form-control"
                    required
                    v-model="current.goods_type"
                  >
                    <option value="">--Select Goods Type--</option>
                    <option value="automobile">
                      AUTOMOBILE / VEHICLE LEASE
                    </option>
                    <option value="home appliance">
                      HOME APPLIANCES / FURNITURE
                    </option>
                    <option value="office equipment">OFFICE EQUIPMENT</option>
                    <option value="medical">
                      MEDICAL / HOSPITAL EQUIPMENT
                    </option>
                    <option value="devices">DEVICES / LED SCREENS</option>
                    <!-- <option value="others">Others</option> -->
                  </select>
                </div>

                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <span class="input-group-text"> Payment Spread </span>
                  </div>
                  <select
                    class="form-control"
                    required
                    v-model="current.payment_spread"
                  >
                    <option value="">--Select Payment Spread--</option>
                    <option value="3">3 MONTHS SPREAD</option>
                    <option value="6">6 MONTHS SPREAD</option>
                    <option value="9">9 MONTHS SPREAD</option>
                    <option value="12">12 MONTHS SPREAD</option>
                    <option value="15">15 MONTHS SPREAD</option>
                    <option value="18">18 MONTHS SPREAD</option>
                    <option value="24">24 MONTHS SPREAD</option>
                    <option value="30">30 MONTHS SPREAD</option>
                  </select>
                </div>

                <div>
                  <p style="color: red">
                    How Much Advance Rentals are you willing to make for this
                    leasing Application? Please note Automobile/Vehicle Leasing
                    has a mandatory minimum 30% equity contribution
                  </p>
                </div>

                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <span class="input-group-text"> Advance Rentals </span>
                  </div>
                  <select
                    class="form-control"
                    required
                    v-model="current.advance_rentals"
                  >
                    <option value="">--Select Advance Rentals--</option>
                    <option value="5">5%</option>
                    <option value="10">10%</option>
                    <option value="15">15%</option>
                    <option value="20">20%</option>
                    <option value="25">25%</option>
                    <option value="30">30%</option>
                    <option value="35">35%</option>
                    <option value="40">40%</option>
                    <option value="45">45%</option>
                    <option value="50">50%</option>
                    <option value="55">55%</option>
                    <option value="60">60%</option>
                    <option value="65">65%</option>
                    <option value="70">70%</option>
                    <option value="75">75%</option>
                    <option value="80">80%</option>
                    <option value="85">85%</option>
                    <option value="90">90%</option>
                    <option value="95">95%</option>
                    <option value="100">100%</option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <input type="hidden" v-model="current.user_id" />
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
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
</template>
<script>
import VueElementLoading from "vue-element-loading";
export default {
  props: {},
  components: {
    VueElementLoading,
  },
  data() {
    return {
      loading: false,
      current: {
        name: "",
        address: "",
        phone: "",
        item: "",
        amount: "",
        description: "",
        payment_spread: "",
        goods_type: "",
        advance_rentals: "",
      },
      application_id: "",
      percentages: {},
      disableField: false,
      percentages: {},
      payplan: [],
    };
  },
  methods: {
    // setData(data){
    //     this.application_id = data.id;
    //     if(data.supplier == null){
    //         this.current = {
    //                         name : '',
    //                         address : '',
    //                         phone : '',
    //                         item : '',
    //                         amount : '',
    //                         description : '',
    //                         payment_plan : '',
    //                         }

    //     }else{
    //         this.disableField = false;
    //         this.checkSupplier(data.supplier);
    //         this.current = data.supplier;
    //     }

    // },

    // checkSupplier(current){
    //     if(current && current.status != 'Pending'){
    //         this.disableField = true;
    //     }
    // },
    saveSupplier() {
      this.loading = true;
      var appId = localStorage.getItem("appId");
      axios
        .post("/saveSupplier?appId=" + appId, this.current)
        .then((res) => {
          this.loading = false;
          this.toaster(res.data.message, "success");
          localStorage.setItem("supplyData", JSON.stringify(this.current));
          //    this.$emit('pay-id',{'id':this.current.payment_plan});
        })
        .catch((err) => {
          this.loading = false;
        });
    },
    submitUpdate() {
      // axios.post('/updateSupplier', this.current)
      //     .then(res=>{
      //         this.toaster(res.data.message,'success');
      //         $('#supplier').modal('hide');
      //         this.$inertia.reload();
      //     })
      //     .catch(err=>{
      //     })
    },
    getpaymentplan() {
      axios
        .get("/get-payment-plan")
        .then((res) => {
          this.payplan = res.data;
        })
        .catch((err) => {});
    },
    getData() {
      var data = JSON.parse(localStorage.getItem("supplyData"));
      // console.log(data);
      if (data) {
        this.current = data;
      }
    },
  },
  mounted() {
    this.getpaymentplan();
    this.getData();
    // this.setData();

    // eventBus.$on('AddSupplier', this.setData)
  },
};
</script>
<style>
</style>


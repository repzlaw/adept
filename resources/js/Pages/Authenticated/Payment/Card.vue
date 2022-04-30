<template>
    <Layout>
        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <div class="page-title-box">
                            <h4 class="font-size-18">Make Payment </h4>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item active">Welcome to  AdeptLessor</li>
                            </ol>
                        </div>
                    </div>

                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-4">Refund Settings</h4>
                                <vue-element-loading :active="loading" spinner="mini-spinner" color="#073491"/>
                                <div class="table-responsive">
                                    <table class="table table-hover table-responsive-sm table-centered table-nowrap mb-0">
                                        <thead>
                                        <tr>
                                            <th>(Id) </th>
                                            <th>Business Name</th>
                                            <th>Item</th>
                                            <th>Plan</th>
                                            <th>Amount</th>
                                            <th>Amount To Pay</th>
                                            <th>Amount paid</th>
                                            <th>Amount Left</th>
                                            <th>Due Amount/Input Amount</th>
                                            <th>Action
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr v-for="(dt, index) in data" :key="index">
                                            <th scope="row">{{index+1}}</th>
                                            <td>{{dt.business_name}}</td>
                                            <td>{{dt.item}}</td>
                                            <td>{{dt.plan_name}}</td>
                                            <td>{{dt.amount}}</td>
                                            <td>{{dt.amount_to_refund}}</td>
                                            <td>{{dt.total}}</td>
                                            <td>{{dt.amount_to_refund - dt.total}}</td>
                                            <td>
                                                <input v-model="dt.totalToPay" type="number" name=""
                                                placeholder="Enter Amount..." id="" class="form-control"
                                                >
                                            </td>
                                            <td>
                                                <button class="btn btn-primary"
                                                        type="button" @click="Pay(dt); ">
                                                        <span class="mdi mdi-cash-multiple"></span>
                                                    Pay Now
                                                </button>
                                            </td>
                                        </tr>

                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- container-fluid -->
            <!-- Modals -->
            <!-- sample modal content -->
            <div id="setPayment" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title mt-0" id="myModalLabel">Add Payment Settings</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <form action="" method="post" @submit.prevent="savepercentage">
                            <div class="modal-body">
                            <vue-element-loading :active="loading" spinner="mini-spinner" color="#073491"/>
                                <div class="row">
                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group" >
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        Plan Name
                                                    </span>
                                                </div>
                                                <input class="form-control" type="text"  v-model="form.duration_name" placeholder="Plan name">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group" >
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        Duration in Months
                                                    </span>
                                                </div>
                                                <input class="form-control" type="number" required v-model="form.duration_month" placeholder="Duration in month">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group" >
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        Percentage
                                                    </span>
                                                </div>
                                                <input class="form-control" type="number" required v-model="form.percentage" placeholder="Enter percentage">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group" >
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        Interest
                                                    </span>
                                                </div>
                                                <input class="form-control" type="number" required v-model="form.interest" placeholder="Enter Interest Percentage">
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary waves-effect waves-light">Save changes</button>
                            </div>
                        </form>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->
            <div id="edit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title mt-0" id="myModalLabel">Edit Payment Settings</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <form action="" method="post" @submit.prevent="savedit">
                            <div class="modal-body">
                            <vue-element-loading :active="loading" spinner="mini-spinner" color="#073491"/>
                                <div class="row">
                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group" >
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        Plan Name
                                                    </span>
                                                </div>
                                                <input class="form-control" type="text" required v-model="form.name" placeholder="Plan name">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group" >
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        Duration in Months
                                                    </span>
                                                </div>
                                                <input class="form-control" type="number" required v-model="form.month" placeholder="Duration in month">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group" >
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        Percentage
                                                    </span>
                                                </div>
                                                <input class="form-control" type="number" required v-model="form.percentage" placeholder="Enter percentage">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group" >
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        Interest
                                                    </span>
                                                </div>
                                                <input class="form-control" type="number" required v-model="form.interest" placeholder="Enter Interest Percentage">
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" v-model="form.id" />
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary waves-effect waves-light">Save changes</button>
                            </div>
                        </form>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div>

            <!-- /.modal -->
        </div>
        <!-- End Page-content -->
    </Layout>

</template>

<script>
    import Layout from '@/BaseLayout/Layout'
    import Input from "@/Jetstream/Input";
    import VueElementLoading from 'vue-element-loading'
    export default {
        props:{
            data:{}
        },
        components: {
            Input,
            Layout,
            VueElementLoading
        },
        data(){
            return {
                form : {
                    duration_name : "",
                    duration_month : "",
                    percentage : "",
                    interest : "",
                },
                pay : {

                },
                my_data : {},
                current : '',
                loading : false

            }
        },
        methods : {

            getCurrent(handler){
                this.form = handler
            },
            clearCurrent(){
                this.form = {}
            },
            Pay(data) {
                // console.log(data);
                if(!data.amount_per_month){

                    return  swal("Error", "Amount Required", "error");
                }

                this.loading = true;
                swal({
                    title: "Are you sure You want to Initiate Payment?",
                    text: "Amount : "+data.totalToPay,
                    icon: "info",
                    buttons: ["No", "Yes"],
                    successMode: true,
                })
                .then((payMoney) => {
                    if (payMoney) {
                         axios
                            .post("/payment/transaction/create", data)
                            .then(response => {
                                this.my_data = response.data.data;
                                this.payWithAutocredit()
                                this.loading = false;
                            })
                            .catch(err => {
                                // console.log(err)
                                swal("Error", "Transaction Failed", "error");
                                 this.loading = false;
                            });

                    } else {
                         this.loading = false;
                        swal("Error", "Transaction Cancelled", "error");
                    }
                });

                },
                payWithAutocredit() {
                    var order_id = this.my_data["orderid"];

                    var handler = PayDirect.invoice({
                        "key": "PUB_LIVE_AC6009301D50C12",
                        "orderid" : this.my_data["orderid"],
                        "revhead_id": "REV_770054755087",
                        "customer": {
                            first_name:  this.data[0].user.surname ,
                            last_name:  this.data[0].user.othername ,
                            email: this.data[0].user.email,
                            phone:  this.data[0].user.phone ,
                        },
                        "fee_bearer": "client",
                        "items": [
                        {
                            "item": "Refund Fee",
                            "description": "newsite.com",
                            "unit_cost": this.my_data["amount_paid"],
                            "quantity": "1"
                        }
                        ],
                        callback: function(response) {
                            // console.log(3345754)
                            axios.get('/checkStatus?transref='+order_id)
                            .then(res=>{
                                window.location.reload();
                                this.loading = false;
                            }).catch(err=>{
                                this.loading = false;
                            })
                        },
                        onClose: function() {
                            this.loading = false;
                        }
                    });

                    handler.openIframe();
                    }
        },
        mounted (){
            this.loading = false;
            // console.log(this.data);
        },
        created (){
            this.loading = true;
        }
    }
</script>

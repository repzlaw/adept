<template>
    <Layout>
        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <div class="page-title-box">
                            <h4 class="font-size-18">Supplier Information</h4>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item active">Welcome to  AdeptLessor</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- end page title -->
                <form method="Post" action="" @submit.prevent="profile" >
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title mb-4">Supplier info.</h4>
                                    <div class="row">
                                        <div class="col-md-12 col-lg-12 col-12">
                                            <table class="table table-striped table-responsive-sm">
                                                <thead>
                                                    <th>(id)</th>
                                                    <th>Supplier Name</th>
                                                    <th>Application</th>
                                                    <th>Plan Name</th>
                                                    <th>Goods Type</th>
                                                    <th>Amount</th>
                                                    <th>Amount to Refund</th>
                                                    <th>Amount Spread</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </thead>
                                                <tbody>
                                                    <tr v-for="(dt, index) in data" :key="index">
                                                        <td>{{index+1}}</td>
                                                        <td>{{dt.name}}</td>
                                                        <td>{{dt.business_name}}</td>
                                                        <td>{{dt.planName}}</td>
                                                        <td>{{dt.goods_type}}</td>
                                                        <td>{{dt.amount}}</td>
                                                        <td>{{dt.amount_to_refund}}</td>
                                                        <td>{{dt.amount_per_month}}</td>
                                                        <td>
                                                            <span :class="[(dt.status=='Pending')?
                                                            'badge badge-info':(dt.status=='Completed')?
                                                            'badge badge-success':'badge badge-danger']">
                                                            {{dt.status}}</span>
                                                        </td>
                                                        <td>
                                                            <div class="dropdown">
                                                                <button class="btn btn-primary dropdown-toggle waves-effect waves-light"
                                                                        type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    <i class="mdi mdi-settings mr-2"></i>
                                                                    <i class="fa fa-arrow-down"></i>
                                                                </button>
                                                                <div class="dropdown-menu dropdown-menu-right">
                                                                    <a class="dropdown-item" href="Javascript:void(0)" data-toggle="modal" data-target="#viewDesc" @click="getCurrent(dt)">View Description</a>
                                                                    <a class="dropdown-item" href="Javascript:void(0)" data-toggle="modal" data-target="#viewNextPay" @click="getCurrent(dt); getNextPay(dt)">View Next Payment Info</a>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- container-fluid -->
   
             <!-- /.modal -->
            <div id="viewDesc" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title mt-0" id="myModalLabel">View Description</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <form action="" method="post">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 text-center">
                                        <div class="alert alert-info">
                                            <h3>Description</h3>
                                            <p>{{current.description}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /.modal -->

             <!-- /.modal -->
            <div id="viewNextPay" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title mt-0" id="myModalLabel">View Next Payment</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <form action="" method="post">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 text-center">
                                            <h3>Payment Breakdown</h3>
                                    </div>
                                    <div class="col-12">
                                        <table class="table table-stripped table-hover">
                                            <thead class="table-dark">
                                                <th>S/N</th>
                                                <th>Payment Name</th>
                                                <th>Amount</th>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>Basic Amount</td>
                                                    <td>{{nextPay.amount}}</td>
                                                </tr>
                                                <tr v-if="nextPay.breakdown">
                                                    <td>2</td>
                                                    <td>Processing Fee</td>
                                                    <td>{{nextPay.breakdown.processingFee}}</td>
                                                </tr>
                                                <tr v-if="nextPay.breakdown">
                                                    <td>3</td>
                                                    <td>Legal Fee</td>
                                                    <td>{{nextPay.breakdown.legalFee}}</td>
                                                </tr>
                                                <tr v-if="nextPay.breakdown">
                                                    <td>4</td>
                                                    <td>Vat Fee</td>
                                                    <td>{{nextPay.breakdown.vatFee}}</td>
                                                </tr>
                                                <tr v-if="nextPay.breakdown">
                                                    <td>5</td>
                                                    <td>Insurance</td>
                                                    <td>{{nextPay.breakdown.insurance}}</td>
                                                </tr>
                                                <tr v-if="nextPay.breakdown">
                                                    <td>6</td>
                                                    <td>Credit Check</td>
                                                    <td>{{nextPay.breakdown.creditCheck}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Total</th>
                                                    <td></td>
                                                    <td v-if="nextPay.breakdown">{{Number(nextPay.breakdown.total) + Number(nextPay.amount)}}</td>
                                                    <td v-else>{{0 + Number(nextPay.amount)}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        
                                        <!-- <div class="float-right">
                                            <button class="btn btn-primary" v-if="nextPay.breakdown" @click="pay(Number(nextPay.breakdown.total) + Number(nextPay.amount))">
                                                <i class="fa fa-money"></i> Pay Now
                                            </button>
                                            <button class="btn btn-primary" type="button" v-else @click="pay(Number(nextPay.amount))">
                                                <i class="fa fa-money"></i> Pay Now
                                            </button>
                                        </div> -->
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
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
    import Layout from '@/BaseLayout/Layout'
    import Input from "@/Jetstream/Input";
    // import Input from "@/Jetstream/Input";

    export default {
        props:{
            data:{}
        },
        components: {
            Input,
            // Input,
            Layout,
        },
        data(){
            return {
                disable : 'disabled',
                photo : '',
                form : {},
                AccountDetailsLoading : false,
                banks : {},
                current : {},
                newData : {},
                nextPay:{
                    breakdown : ''
                },
            }
        },
        methods : {
            getCurrent(handler){
                this.current = handler
                this.newData = handler;
            },

            edit(){
                this.disable = false;
            }
            ,
            getNextPay(data){
                axios.post('/getNextPay', data)
                    .then(res=>{
                        this.nextPay = res.data;
                })
            },
            
             onFileChange(e){
                this.photo = e.target.files[0];
            },
            pay(amount) {
                console.log(amount)
                if(amount < 1){
                    return  swal("success", "Completed Transaction", "success");
                }
                this.loading = true;
                this.current.totalToPay = amount;
                swal({
                    title: "Are you sure You want to Initiate Payment?",
                    text: "Amount : "+amount,
                    icon: "info",
                    buttons: ["No", "Yes"],
                    successMode: true,
                })
                .then((payMoney) => {
                    if (payMoney) {
                         axios
                            .post("/payment/transaction/create", this.current)
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
                        "key": "PUB_DEMO_AC5F5103D6A3D41",
                        "orderid" : this.my_data["orderid"],
                        "revhead_id": "REV_3113010423651",
                        "customer": {
                            first_name:  this.newData.surname ,
                            last_name:  this.newData.othername ,
                            email: this.newData.email,
                            phone:  this.newData.phone ,
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
        mounted () {
    
        }
    }
</script>

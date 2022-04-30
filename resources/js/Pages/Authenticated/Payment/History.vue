<template>
    <Layout>
        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <div class="page-title-box">
                            <h4 class="font-size-18">Payment History</h4>
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

                                <table class="table table-hover table-responsive-sm table-centered table-nowrap mb-0">
                                    <thead>
                                    <tr>
                                        <th>(Id) </th>
                                        <th>Transaction Id</th>
                                        <th>Application</th>
                                        <th>Item</th>
                                        <!-- <th>description</th> -->
                                        <th>Payment Type</th>
                                        <th>Amount</th>
                                        <th>Transaction Date</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="(dt, index) in data" :key="index">
                                        <th scope="row">{{index+1}}</th>
                                        <td>{{dt.orderid}}</td>
                                        <td>{{dt.business_name}}</td>
                                        <td>{{dt.item}}</td>
                                        <!-- <td>{{dt.description}}</td> -->
                                        <td>{{dt.payment_type}}</td>
                                        <td>{{dt.amount_paid}}</td>
                                        <td>{{dt.trans_date}}</td>
                                        <td>
                                            <span :class="[(dt.status=='PENDING')?
                                                    'badge badge-warning':(dt.status=='APPROVED')?
                                                    'badge badge-success':'badge badge-danger']">
                                                    {{dt.status}}</span>
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-primary dropdown-toggle waves-effect waves-light"
                                                        type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="mdi mdi-settings"></i>
                                                    <i class="fa fa-arrow-down"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right" v-if="dt.status != 'APPROVED'  && dt.payment_type == 'CARD'">
                                                    <a class="dropdown-item" href="Javascript:void(0)" @click="checkStatus(dt)">Check Status</a>
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
                <!-- end row -->
            </div>
            <!-- container-fluid -->
            <!-- Modals -->
          
        
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
                this.loading = true;
                axios
                    .post("/payment/transaction/create", data)
                    .then(response => {
                        this.my_data = response.data.data;
                        // console.log(this.my_data.amount_paid);
                        this.payWithAutocredit()
                    })
                    .catch(err => {
                        this.loading = false;
                    });
                },  
                checkStatus(data){
                    this.loading =  true;
                    axios.get('/checkStatus?transref='+data.orderid)
                    .then(res=>{
                        this.loading =  false;
                        this.$inertia.reload();
                    }).catch(err=>{
                        this.loading =  false;
                    })
                },          
            payWithAutocredit() {
                var handler = PayDirect.invoice({
                    "key": "PUB_DEMO_AC5F192BBDEDBDC",
                    "orderid" : '"' + this.my_data["orderid"] + '"',
                    "revhead_id": "REV_508587108281",
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
                    // console.log(response);
                    },
                    onClose: function() {
                    // console.log('Window Closed.');
                    }
                });
            
                handler.openIframe();
                }
        },
        mounted (){
            this.loading = false;
        },
        created (){
            this.loading = true;
        }
    }
</script>

<template>
    <Layout>
        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <div class="page-title-box">
                            <h4 class="font-size-18">Payment Percentage Settings</h4>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item active">Welcome to  AdeptLessor</li>
                            </ol>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="float-right  d-sm-block">
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle waves-effect waves-light"
                                        type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <!-- <i class="mdi mdi-settings"></i> -->
                                    Create Payment Plan
                                    <i class="fa fa-arrow-down ml-2"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="Javascript:void(0)" @click="clearCurrent()" data-toggle="modal" data-target="#setPayment" >Add Payment Setting</a>
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
                                <h4 class="card-title mb-4">Refund Settings</h4>
                                <vue-element-loading :active="loading" spinner="mini-spinner" color="#073491"/>
                                <!-- <div class="table-responsive"> -->
                                    <table class="table table-hover table-responsive-sm table-centered table-nowrap mb-0">
                                        <thead>
                                        <tr>
                                            <th>(#) Id</th>
                                            <th>Name</th>
                                            <th>Duration</th>
                                            <th>Interest Charge</th>
                                            <th>Credit Check Fees</th>
                                            <th>Plan Type</th>
                                            <th>Action
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr v-for="(dt, index) in data" :key="index">
                                            <th scope="row">{{index+1}}</th>
                                            <td>{{dt.name}}</td>
                                            <td>{{dt.payment_duration}}</td>
                                            <td>{{dt.interest_charge}}%</td>
                                            <td>{{dt.credit_check_fee}}</td>
                                            <td>
                                                <span class="badge" 
                                                    :class="{'badge-success' : dt.plan_type =='normal', 
                                                    'badge-info' : dt.plan_type == 'custom'}">
                                                    {{dt.plan_type}}
                                                </span>
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-primary dropdown-toggle waves-effect waves-light"
                                                            type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="mdi mdi-settings mr-2"></i>
                                                        <i class="fa fa-arrow-down"></i>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="Javascript:void(0)" data-toggle="modal" data-target="#viewPayment" @click="getCurrent(dt)">View Details</a>
                                                        <a class="dropdown-item" href="Javascript:void(0)" data-toggle="modal" data-target="#editPayment" @click="getCurrent(dt)">Edit</a>
                                                        <a class="dropdown-item" href="Javascript:void(0)"  @click="getCurrent(dt); deleteset(dt)" >Delete</a>
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

            <!-- sample modal content -->
            <div id="setPayment" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title mt-0" id="myModalLabel">Add Payment Settings</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <form action="" method="post" @submit.prevent="savePlan">
                            <div class="modal-body">
                                <vue-element-loading :active="savePlanLoading" spinner="mini-spinner" color="#073491"/>
                                <div class="row">
                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group" >
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        Plan Name
                                                    </span>
                                                </div>
                                                <input class="form-control" type="text"  v-model="form.name" placeholder="Enter Plan name">
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
                                                <input class="form-control" type="number" step=".01" required v-model="form.payment_duration" placeholder="Enter Payment Duration in month">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group" >
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                       Interest Charge (%) 
                                                    </span>
                                                </div>
                                                <input class="form-control" type="number" step=".01" required v-model="form.interest_charge" placeholder="Enter Interest Charge">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group" >
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                       Advance Rentals (%) 
                                                    </span>
                                                </div>
                                                <input class="form-control" type="number" step=".01"  v-model="form.equity_contribution" placeholder="Enter Advance Rentals (Optional)">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group" >
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                       Processing Fee (%) 
                                                    </span>
                                                </div>
                                                <input class="form-control" type="number" step=".01" required v-model="form.processing_fee" placeholder="Enter Processing Fee">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group" >
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                       Legal Fee (%) 
                                                    </span>
                                                </div>
                                                <input class="form-control" type="number" step=".01" required v-model="form.legal_fee" placeholder="Enter Legal Fee">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group" >
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                       VAT Fee(%)  
                                                    </span>
                                                </div>
                                                <input class="form-control" type="number" step=".01" required v-model="form.vat_fee" placeholder="Enter VAT fee">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group" >
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                       Credit Check Fee  
                                                    </span>
                                                </div>
                                                <input class="form-control" type="number" step=".01" required v-model="form.credit_check_fee" placeholder="Enter Credit Check Fee">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group" >
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                       Insurance Fee (%)  
                                                    </span>
                                                </div>
                                                <input class="form-control" type="number" step=".01" required v-model="form.insurance_fee" placeholder="Enter Insurance Fee">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group" >
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                       Purchase Option Fee (%)  
                                                    </span>
                                                </div>
                                                <input class="form-control" type="number" step=".01" required v-model="form.purchase_option_fee" placeholder="Enter Purchase Option Fee">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group" >
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                       Licensing Registration  Fee
                                                    </span>
                                                </div>
                                                <input class="form-control" type="number" step=".01" required v-model="form.licensing_registration" placeholder="Enter Licensing Registration Fee">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group" >
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                       Plan Type
                                                    </span>
                                                </div>
                                                <select name="" class="form-control" id="" required v-model="form.plan_type">
                                                    <option value="">--Choose Plan type</option>
                                                    <option value="normal">Normal</option>
                                                    <option value="custom">Custom</option>
                                                </select>
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
            <div id="editPayment" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title mt-0" id="myModalLabel">Edit Payment Settings</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <form action="" method="post" @submit.prevent="editPlan">
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
                                                <input class="form-control" type="text"  v-model="form.name" placeholder="Enter Plan name">
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
                                                <input class="form-control" type="number" step=".01" required v-model="form.payment_duration" placeholder="Enter Payment Duration in month">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group" >
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                       Interest Charge 
                                                    </span>
                                                </div>
                                                <input class="form-control" type="number" step=".01" required v-model="form.interest_charge" placeholder="Enter Interest Charge">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group" >
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                       Equity Contribution 
                                                    </span>
                                                </div>
                                                <input class="form-control" type="number" step=".01"  v-model="form.equity_contribution" placeholder="Enter Equity Contribution (Optional)">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group" >
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                       Processing Fee (%) 
                                                    </span>
                                                </div>
                                                <input class="form-control" type="number" step=".01" required v-model="form.processing_fee" placeholder="Enter Processing Fee">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group" >
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                       Legal Fee (%) 
                                                    </span>
                                                </div>
                                                <input class="form-control" type="number" step=".01" required v-model="form.legal_fee" placeholder="Enter Legal Fee">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group" >
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                       VAT Fee  
                                                    </span>
                                                </div>
                                                <input class="form-control" type="number" step=".01" required v-model="form.vat_fee" placeholder="Enter VAT fee">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group" >
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                       Credit Check Fee  
                                                    </span>
                                                </div>
                                                <input class="form-control" type="number" step=".01" required v-model="form.credit_check_fee" placeholder="Enter Credit Check Fee">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group" >
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                       Indurance Fee  
                                                    </span>
                                                </div>
                                                <input class="form-control" type="number" step=".01" required v-model="form.insurance_fee" placeholder="Enter Insurance Fee">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group" >
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                       Purchase Option Fee  
                                                    </span>
                                                </div>
                                                <input class="form-control" type="number" step=".01" required v-model="form.purchase_option_fee" placeholder="Enter Purchase Option Fee">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group" >
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                       Licensing Registration  Fee
                                                    </span>
                                                </div>
                                                <input class="form-control" type="number" step=".01" required v-model="form.licensing_registration" placeholder="Enter Licensing Registration Fee">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group" >
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                       Plan Type
                                                    </span>
                                                </div>
                                                <select name="" class="form-control" id="" required v-model="form.plan_type">
                                                    <option value="">--Choose Plan type</option>
                                                    <option value="normal">Normal</option>
                                                    <option value="custom">Custom</option>
                                                </select>
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
            <!-- /.modal -->
            <div id="viewPayment" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title mt-0" id="myModalLabel">Edit Payment Settings</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <form action="" method="post" @submit.prevent="editPlan">
                            <div class="modal-body">
                                <vue-element-loading :active="loading" spinner="mini-spinner" color="#073491"/>
                                <div class="row">
                                    <div class="col-md-12 col-12 col-lg-12">
                                        <div class="table-responsive">
                                            <table class="table table-stripped table-sm table-bordered">
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Value</th>
                                                </tr>
                                                <tr>
                                                    <td>Payment Name</td>
                                                    <td>{{form.name}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Payment Duration</td>
                                                    <td>{{form.payment_duration}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Interest Charge</td>
                                                    <td>{{form.interest_charge}}%</td>
                                                </tr>
                                                <tr>
                                                    <td>Processing Fees</td>
                                                    <td>{{form.processing_fee}}%</td>
                                                </tr>
                                                <tr>
                                                    <td>Legal Fees</td>
                                                    <td>{{form.legal_fee}}%</td>
                                                </tr>
                                                <tr>
                                                    <td>VAT</td>
                                                    <td>{{form.vat_fee}}%</td>
                                                </tr>
                                                <tr>
                                                    <td>Credit Check</td>
                                                    <td>{{form.credit_check_fee}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Insurance</td>
                                                    <td>{{form.insurance_fee}}%</td>
                                                </tr>
                                                <tr>
                                                    <td>Equity Contribution</td>
                                                    <td>{{form.equity_contribution}}%</td>
                                                </tr>
                                                <tr>
                                                    <td>Purchase Option Fees</td>
                                                    <td>{{form.purchase_option_fee}}%</td>
                                                </tr>
                                                <tr>
                                                    <td>Licensing/ registration</td>
                                                    <td>{{form.licensing_registration}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Plan Type</td>
                                                    <td>
                                                        <span class="badge" 
                                                        :class="{'badge-success' : form.plan_type =='normal', 
                                                            'badge-info' : form.plan_type == 'custom'}">
                                                            {{form.plan_type}}
                                                        </span>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                                <!-- <button type="submit" class="btn btn-primary waves-effect waves-light">Save changes</button> -->
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
                form : {},
                current : '',
                loading : false,
                savePlanLoading : false,

            }
        },
        methods : {
            savePlan(){
                // console.log(this.form)
                this.savePlanLoading = true;
                axios.post('/savePlan', this.form)
                .then(res=>{
                    this.toaster(res.data.message,'success');
                    $("#setPayment").modal('hide');
                    this.savePlanLoading = false;
                    this.$inertia.reload();
                }).catch(err=>{
                    this.savePlanLoading = false;
                }) 
            },
            getCurrent(handler){
                this.form = handler
            },
            clearCurrent(){
                this.form = {}
            },
            editPlan(){
                this.loading = true;
                axios.post('/editSavedPlan', this.form)
                    .then(res=>{
                        this.toaster(res.data.message,'success');
                        $("#editPayment").modal('hide');
                        this.loading = false;
                        this.$inertia.reload();
                    }).catch(err=>{
                        this.loading = false;
                         swal("Error", "Error Saving Record", "error");
                })
            },
            deleteset(id){
                swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this Record!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((delRec) => {
                    if (delRec) {
                         axios.post('/deletePaymentPlan', id)
                            .then(res=>{
                                this.toaster(res.data.message,'success');
                                $("#delete").modal('hide');
                                this.$inertia.reload();
                            }).catch(err=>{
                                swal("Error", "Error Deleting record", "error");
                        })
                        
                    } else {
                        swal("Error", "Cancelled", "error");
                    }
                });
               
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

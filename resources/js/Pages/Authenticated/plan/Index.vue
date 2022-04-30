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
                                    <i class="mdi mdi-settings"></i>
                                    <i class="fa fa-arrow-down"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="Javascript:void(0)" data-toggle="modal" data-target="#setPayment" >Add Payment Setting</a>
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

                                <table class="table table-hover table-responsive-sm table-centered table-nowrap mb-0">
                                    <thead>
                                    <tr>
                                        <th>(#) Id</th>
                                        <th>Name</th>
                                        <th>Months</th>
                                        <th>Interest Percentage</th>
                                        <th>Date</th>
                                        <th>Action
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="(dt, index) in data" :key="index">
                                        <th scope="row">{{index+1}}</th>
                                        <td>{{dt.name}}</td>
                                        <td>{{dt.month}}</td>
                                        <td>{{dt.interest_percentage}}%</td>
                                        <td>{{dt.created_at}}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-primary dropdown-toggle waves-effect waves-light"
                                                        type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="mdi mdi-settings mr-2"></i>
                                                    <i class="fa fa-arrow-down"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item" href="Javascript:void(0)" data-toggle="modal" data-target="#edit" @click="getCurrent(dt)">Edit</a>
                                                    <a class="dropdown-item" href="Javascript:void(0)"  @click="getCurrent(dt); deleteset(dt)" >Delete</a>
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
                                                       Interest Percentage 
                                                    </span>
                                                </div>
                                                <input class="form-control" type="number" required v-model="form.interest_percentage" placeholder="Enter percentage">
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
                                                        Interest Percentage
                                                    </span>
                                                </div>
                                                <input class="form-control" type="number" required v-model="form.interest_percentage" placeholder="Enter percentage">
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
                current : '',
                loading : false

            }
        },
        methods : {
            savepercentage(){
                this.loading = true;
                axios.post('/savePercenetage', this.form)
                .then(res=>{
                    this.toaster(res.data.message,'success');
                    $("#setPayment").modal('hide');
                    this.loading = false;
                    this.$inertia.reload();
                }).catch(err=>{
                    this.loading = false;
                })
            },
            getCurrent(handler){
                this.form = handler
            },
            clearCurrent(){
                this.form = {}
            },
            savedit(){
                this.loading = true;
                axios.post('/saveEdit', this.form)
                    .then(res=>{
                        this.toaster(res.data.message,'success');
                        $("#edit").modal('hide');
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
                         axios.post('/deleteSetting', id)
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

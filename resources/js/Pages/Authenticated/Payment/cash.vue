<template>
    <Layout>
        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <div class="page-title-box">
                            <h4 class="font-size-18">Cash Payment</h4>
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
                                <h4 class="card-title mb-4">Cash Payment</h4>
                                <div class="col-lg-6 col-md-6  mb-3">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Client</span>
                                            </div>

                                            <input type="text" class="form-control" v-model="client" list="client"  v-on:keyup="search" />

                                        </div>
                                    </div>
                                    <div class="panel panel-default w-100" v-if="clients.length !=0 ">
                                        <div class="panel-footer bg-light">
                                            <ul class="list-group">
                                                <li
                                                class="list-group-item"
                                                id="hover"
                                                v-for="(dts, index) in clients" :key="index"
                                                @click="getCurrent(dts)"
                                                >{{dts[0].surname}} - {{dts[0].name}} - {{dts[0].othername}}</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <form>
                                    <div class="table-responsive">
                                        <table class="table table-hover table-responsive-sm table-centered table-nowrap mb-0" v-if="currentClient.length !=0 ">
                                            <thead>
                                            <tr>
                                                <th>(#) Id</th>
                                                <th>Name</th>
                                                <th>Phone</th>
                                                <th>Application Ref</th>
                                                <th>Items</th>
                                                <th>Balance</th>
                                                <th>Cash Paid</th>
                                                <th>Application status</th>
                                                <th>Action
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            <tr v-for="(dt, index) in currentClient[0]" :key="index" >
                                                <th scope="row">{{index+1}}</th>
                                                <td>{{dt.surname}} {{dt.name}} {{dt.othername}}</td>
                                                <td>{{dt.phone}}</td>
                                                <td>{{dt.id}}</td>
                                                <td>{{dt.item}}</td>
                                                <td>{{dt.total}}</td>

                                                <td>
                                                    <input type="text" v-model="paid" placeholder="Enter client paid amount" class="form-control"/>
                                                </td>
                                                <td>Approve</td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button type="button" @click="savePaid(dt, paid)" class="btn btn-primary waves-effect waves-light">
                                                            Remit
                                                        </button>

                                                    </div>
                                                </td>

                                            </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- container-fluid -->

            <!-- /.modal -->
        </div>
        <!-- End Page-content -->
    </Layout>

</template>

<script>
    import Layout from '@/BaseLayout/Layout'
    import Input from "@/Jetstream/Input";

    export default {
        props:{
            data:{}
        },
        components: {
            Input,
            Layout,
        },
        data(){
            return {
                client: '',
                clients: [],
                currentClient: [],
                paid:''

            }
        },
        methods : {
            search(){
                axios.get('/client/'+this.client)
                    .then(res=>{
                        this.clients =  res.data
                    })
                    .catch(err=>{

                    })
            },
            getCurrent(current){
                this.currentClient = [current];
                this.clients = [];
            },
            getRec(data){
                alert(data)
            },
            savePaid(dt, paid){
                swal({
                    title: "Are you sure You want to Initiate Payment?",
                    text: "Amount : "+paid,
                    icon: "info",
                    buttons: ["No", "Yes"],
                    successMode: true,
                })
                .then((payMoney) => {
                    if (payMoney) {
                        dt.amount_paid = paid;
                        axios.post('/savePaid', dt)
                            .then(res=>{
                                this.toaster(res.data,'success');
                            }).catch(err=>{
                                swal("Error", "Transaction Failed", "error");
                        })

                    } else {
                         this.loading = false;
                        swal("Error", "Transaction Cancelled", "error");
                    }
                });
            },
        },

        mounted () {

        }
    }


</script>
<style scoped>
    .panel-default{
        position: absolute;
        top: 50px;
    }
    #hover:hover {
        background-color: lightgrey;
        cursor: pointer;
        }
</style>

<template>
    <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title mt-0" id="myModalLabel">View Application's Information</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-12 col-md-12">
                                    <h4 class="card-title mb-4">Basic Application Information</h4>
                                    <table class="table table-sm table-borderd table-striped">
                                        <thead>
                                            <th>Name</th>
                                            <th>Details</th>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Business Name</td>
                                                <td>{{current.business_name}}</td>
                                            </tr>
                                            <tr>
                                                <td>Business Email</td>
                                                <td>{{current.business_email}}</td>
                                            </tr>
                                            <tr>
                                                <td>Business Nature</td>
                                                <td>{{current.business_nature}}</td>
                                            </tr>
                                            <tr>
                                                <td>Incorporation Business Name</td>
                                                <td>{{current.incorporation_business_name}}</td>
                                            </tr>
                                            <tr>
                                                <td>Date Of Birth</td>
                                                <td>{{current.date_of_birth}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-12 mb-2 mt-2">
                                    <div class="dropdown-divider"></div>
                                </div>
                                <div class="col-lg-12 col-md-12">
                                    <h4 class="card-title mb-4">Asset Information</h4>
                                    <table class="table table-sm table-borderd table-striped">
                                        <thead>
                                            <th>Name</th>
                                            <th>Details</th>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Details Of Asset</td>
                                                <td>{{current.details_of_asset}}</td>
                                            </tr>
                                            <tr>
                                                <td>Last Year Income</td>
                                                <td>{{current.last_year_net_income}}</td>
                                            </tr>
                                            <tr>
                                                <td>Current Year Income</td>
                                                <td>{{current.current_year_income}}</td>
                                            </tr>
                                            <tr>
                                                <td>Evidence Of Residece</td>
                                                <td>{{current.evidence_of_residence}}</td>
                                            </tr>
                                            <tr>
                                                <td>Financial Obligation</td>
                                                <td>{{current.financial_obligation}}</td>
                                            </tr>
                                            <tr>
                                                <td>Goods Description</td>
                                                <td>{{current.goods_description}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- <div class="col-12 mb-2 mt-2">
                                    <div class="dropdown-divider"></div>
                                </div> -->
                                <!-- <div class="col-lg-12 col-md-12">
                                    <h4 class="card-title mb-4">Bank Information</h4>
                                    <table class="table table-sm table-borderd table-striped">
                                        <thead>
                                            <th>Name</th>
                                            <th>Details</th>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Bank Name</td>
                                                <td>{{current.bank_name}}</td>
                                            </tr>
                                            <tr>
                                                <td>Account Number</td>
                                                <td>{{current.account_number}}</td>
                                            </tr>
                                            <tr>
                                                <td>BVN Number</td>
                                                <td>{{current.bvn_number}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div> -->
                                <div class="col-12 mb-2 mt-2">
                                    <div class="dropdown-divider"></div>
                                </div>
                                <div class="col-lg-12 col-md-12">
                                    <h4 class="card-title mb-4">Guarantor Information</h4>
                                    <table class="table table-sm table-borderd table-striped">
                                        <thead>
                                            <th>Name</th>
                                            <th>Details</th>
                                        </thead>
                                        <tbody>
                                            <tr v-if="guarantor_1">
                                                <td>Guarantor 1</td>
                                                <td>
                                                    <!-- <div class="col"> -->
                                                        <p>
                                                            <strong>Name :</strong>
                                                            <span>{{guarantor_1.g_1_name}}</span>
                                                        </p>
                                                        <p>
                                                            <strong>Email :</strong>
                                                            <span>{{guarantor_1.g_1_email}}</span>
                                                        </p>
                                                        <p>
                                                            <strong>Phone :</strong>
                                                            <span>{{guarantor_1.g_1_phone}}</span>
                                                        </p>
                                                    <!-- </div> -->
                                                </td>
                                            </tr>
                                            <tr v-if="guarantor_2">
                                                <td>Guarantor 2</td>
                                                <td>
                                                    <p>
                                                        <strong>Name :</strong>
                                                        <span>{{guarantor_2.g_2_name}}</span>
                                                    </p>
                                                    <p>
                                                        <strong>Email :</strong>
                                                        <span>{{guarantor_2.g_2_email}}</span>
                                                    </p>
                                                    <p>
                                                        <strong>Phone :</strong>
                                                        <span>{{guarantor_2.g_2_phone}}</span>
                                                    </p>
                                                </td>
                                            </tr>
                                            <tr v-if="guarantor_3">
                                                <td>Guarantor 3</td>
                                                <td>
                                                    <p>
                                                        <strong>Name :</strong>
                                                        <span>{{guarantor_3.g_3_name}}</span>
                                                    </p>
                                                    <p>
                                                        <strong>Email :</strong>
                                                        <span>{{guarantor_3.g_3_email}}</span>
                                                    </p>
                                                    <p>
                                                        <strong>Phone : </strong>
                                                        <span>{{guarantor_3.g_3_phone}}</span>
                                                    </p></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                        </div>
                    </div><!-- /.modal-content -->
                </div>
</template>
<script>
import VueElementLoading from 'vue-element-loading'
export default {
     props : {
    },
    components : {
        VueElementLoading,
    },
    data(){
        return{
            loading : false,
            current : {},
             guarantor_1 : {
                    g_1_name : '',
                    g_1_email : '',
                    g_1_phone : '',
                },
                guarantor_2 : {
                    g_2_name : '',
                    g_2_email : '',
                    g_2_phone : '',
                },
                guarantor_3 : {
                    g_3_name : '',
                    g_3_email : '',
                    g_3_phone : '',
                },
        }
    },
    methods : {
        setData(data){
            this.current = data;
                var guarant1 = JSON.parse(data.guarantor_1);
                var guarant2 = JSON.parse(data.guarantor_2);
                var guarant3 = JSON.parse(data.guarantor_3);
               
                this.guarantor_1 = guarant1
                this.guarantor_2 = guarant2
                this.guarantor_3 = guarant3
        },
        // editInformation(){
        //     axios.post('/updateApplication', this.form)
        //         .then(res=>{
        //             this.toaster(res.data.message,'success');
        //             $('#editInformation').modal('hide');
        //             this.$inertia.reload();
        //         })
        //         .catch(err=>{

        //         })
        // },
    },
    mounted () {
        eventBus.$on('viewApplication', this.setData)
    }
}
</script>
<style>

</style>
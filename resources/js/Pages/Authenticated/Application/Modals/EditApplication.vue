<template>
    <!-- sample modal content -->
    <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myModalLabel">Edit Application</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <form action="" method="post" enctype="multipart/form-data" @submit.prevent="editInformation">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <vue-element-loading :active="loading" spinner="mini-spinner" color="#073491"/>
                                            <div class="col-lg-6 col-md-12">
                                                <div class="form-group" >
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                Business Name (or place of emploment)
                                                            </span>
                                                        </div>
                                                        <input class="form-control" type="text" name="" required v-model="form.business_name" placeholder="Business Name">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-12">
                                                <div class="form-group" >
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                E-mail Address
                                                            </span>
                                                        </div>
                                                        <input class="form-control" type="email" name="" required v-model="form.business_email" placeholder="Email Address">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-12">
                                                <div class="form-group" >
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                Nature of Business (Occupation)
                                                            </span>
                                                        </div>
                                                        <input class="form-control" type="text" name="" required v-model="form.business_nature" placeholder="Occupation">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-12">
                                                <div class="form-group" >
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                Net Income in the Last Year
                                                            </span>
                                                        </div>
                                                        <input class="form-control" type="text" name="" required v-model="form.last_year_net_income" placeholder="Net Income Last Year">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-12">
                                                <div class="form-group" >
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                Estimated Income for the Current Year
                                                            </span>
                                                        </div>
                                                        <input class="form-control" type="text" name="" required v-model="form.current_year_income" placeholder="Estimated Income for this Current Year">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-12">
                                                <div class="form-group" >
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                Evidence of Residence/Business Address
                                                            </span>
                                                        </div>
                                                        <input class="form-control" type="text" name="" required v-model="form.evidence_of_residence" placeholder=" Evidence of Residence/Business Address">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-12">
                                                <div class="form-group" >
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                Incorporation Certificate
                                                            </span>
                                                        </div>
                                                        <input class="form-control" type="text" name="" required v-model="form.incorporation_business_name" placeholder="Incorporation Certificate">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-12">
                                                <div class="form-group" >
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                Details of Asset
                                                            </span>
                                                        </div>
                                                        <textarea class="form-control" type="text"  required v-model="form.details_of_asset" placeholder=" Details of Asset"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-12">
                                                <div class="form-group" >
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                Date of Birth
                                                            </span>
                                                        </div>
                                                        <input type="date" class="form-control" placeholder="mm/dd/yyyy" id="datepicker-autoclose" required v-model="form.date_of_birth">
                                                    </div>
                                                </div>
                                            </div>
                                                <div class="col-lg-6 col-md-12">
                                                <div class="form-group" >
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                ID Number
                                                            </span>
                                                        </div>
                                                        <input class="form-control" type="text" required v-model="form.id_number" placeholder="Identity Number">
                                                    </div>
                                                </div>
                                            </div>
                                                <div class="col-lg-6 col-md-12">
                                                <div class="form-group" >
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                Details of Existing Financial Obligations
                                                            </span>
                                                        </div>
                                                        <textarea class="form-control" type="text" required v-model="form.financial_obligation"  placeholder=" Details of Asset"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-12">
                                                <div class="form-group" >
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                Full Description of Goods
                                                            </span>
                                                        </div>
                                                        <textarea class="form-control" type="text" required v-model="form.goods_description"  placeholder=" Description of Goods"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-12">
                                                <div class="form-group" >
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                Application Type
                                                            </span>
                                                        </div>
                                                        <select name="" id="" class="form-control custom-select" v-model="form.application_type">
                                                            <option value="">--Choose type--</option>
                                                            <option value="individual">Individual</option>
                                                            <option value="corporative">Corporative</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="application_id" v-model="form.id">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Save changes</button>
                    </div>
                </form>
            </div>
    </div>
    <!-- sample modal content -->
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
            form : {},
        }
    },
    methods : {
        setData(data){
            // console.log(data)
            this.form = data;
        },
        editInformation(){
            axios.post('/updateApplication', this.form)
                .then(res=>{
                    this.toaster(res.data.message,'success');
                    $('#editInformation').modal('hide');
                    this.$inertia.reload();
                })
                .catch(err=>{

                })
        },
    },
    mounted () {
        eventBus.$on('editApplication', this.setData)
    }
}
</script>
<style scoped>

</style>
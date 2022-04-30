<template>
    <!-- <Layout> -->
        <!-- <div class="page-content">
                    <div class="container-fluid"> -->
                        <!-- start page title -->
                        <!-- <div class="row align-items-center">
                            <div class="col-sm-6">
                                <div class="page-title-box">
                                    <h4 class="font-size-18">My Application</h4>
                                    <ol class="breadcrumb mb-0">
                                        <li class="breadcrumb-item active">Welcome to  AdeptLessor</li>
                                    </ol>
                                </div>
                            </div>
                        </div> -->
                        <!-- end page title -->

                        <div class="row mt-2">
                            <div class="col-xl-12">
                                <form action="" method="post" @submit.prevent="submit" enctype="multipart/form-data">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title mb-4">My Leasing Application(s)</h4>
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
                                                <!-- <div class="col-lg-6 col-md-12">
                                                    <div class="form-group" >
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">
                                                                    Incorporation Certificate Reg (Copy)
                                                                </span>
                                                            </div>
                                                            <input type="file" class="form-control  filestyle" data-input="false" @change="getData('incor_cert')">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-12">
                                                    <div class="form-group" >
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">
                                                                    Tax Clearance Certificate (Copy)
                                                                </span>
                                                            </div>
                                                            <input type="file" class="form-control filestyle" data-input="false" @change="getData('clear_cert')">
                                                        </div>
                                                    </div>
                                                </div> -->
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
                                                <!-- <div class="col-lg-6 col-md-12">
                                                    <div class="form-group" >
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">
                                                                    Bank Name 
                                                                </span>
                                                            </div>
                                                            <input class="form-control" type="text" name="" required v-model="form.bank_name" placeholder="Bank name">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-12">
                                                    <div class="form-group" >
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">
                                                                    Account Number
                                                                </span>
                                                            </div>
                                                            <input class="form-control" type="text" name="" required v-model="form.account_number" placeholder="IAccount Number">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-12">
                                                    <div class="form-group" >
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">
                                                                    BVN Number
                                                                </span>
                                                            </div>
                                                            <input class="form-control" type="Number" name="" required v-model="form.bvn_number" placeholder="BVN Number">
                                                        </div>
                                                    </div>
                                                </div> -->
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
                                                                <option value="corporate">Corporative</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <div class="row float-right">
                                                <div class="d-block text-right card-footer">
                                                    <button type="button" class="mr-2 btn btn-link">Reset</button>
                                                    <button type="submit" class="btn btn-primary">Submit Application</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- end row -->
                    <!-- </div>  -->
                    <!-- container-fluid -->
                <!-- </div> -->
                <!-- End Page-content -->
    <!-- </Layout> -->
</template>

<script>
    import VueElementLoading from 'vue-element-loading'
    import Layout from '@/BaseLayout/Layout';

    export default {
        components: {
            Layout,
            VueElementLoading
        },
        props : {
            data : {}
        },
        data() {
            return {
                form : {
                    business_name:'',
                    business_email : '',
                    business_nature : '',
                    last_year_net_income : '',
                    current_year_income : '',
                    evidence_of_residence : '',
                    incorporation_business_name : '',
                    details_of_asset : '',
                    date_of_birth : '',
                    id_number : '',
                    financial_obligation : '',
                    goods_description : '',
                    incorporation_certificate  : '',
                    tax_clearance : '',
                    business_name : '',
                },
                loading : false,
            }
        },
        methods : {
            getData(e, typ){
            const file = e.target.files[0];
            this.url = URL.createObjectURL(file);
            this.fileName = file.name;
            let reader = new FileReader();
            reader.onloadend = (e)=>{
                let record = e.target;
                this.file = record.result;
            };
            reader.readAsDataURL(file);  
        },
       submit(){
           this.loading = true;
           axios.post('/create-application', this.form)
           .then(res=>{

               this.toaster(res.data[1],'success');
               this.$inertia.visit('/my-application')
           }).catch(err=>{
               this.loading = false;
            //    console.log(err.message.errors)
           })
        }
    },
    mounted (){
        this.loading = false;
        this.form = this.data[0]; 
        },
    created (){
        this.loading = true;
        }
    }
</script>

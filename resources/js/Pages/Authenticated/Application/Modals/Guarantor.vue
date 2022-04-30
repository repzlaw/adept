<template>
     <!-- sample modal content -->
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title mt-0" id="myModalLabel">Update Guarantor's Information</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <form action="" method="post" @submit.prevent="updateGuarantor">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group" >
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        Referees / Guarantor(1) Name
                                                    </span>
                                                </div>
                                                <input class="form-control" type="text" required v-model="form.g_1_name" placeholder="Guarantor's Name">
                                            </div>
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        Referees / Guarantor(1) Email
                                                    </span>
                                                </div>
                                                <input class="form-control" type="email" required v-model="form.g_1_email" placeholder="Guarantor's email">
                                            </div>
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        Referees / Guarantor(1) Phone
                                                    </span>
                                                </div>
                                                <input class="form-control" type="text" required v-model="form.g_1_phone" placeholder="Guarantor's phone">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mb-2 mt-2">
                                        <div class="dropdown-divider"></div>
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group" >
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        Referees / Guarantor(2) Name
                                                    </span>
                                                </div>
                                                    <input class="form-control" type="text" required v-model="form.g_2_name" placeholder="Guarantor's Name">
                                            </div>
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        Referees / Guarantor(2) Email
                                                    </span>
                                                </div>
                                                <input class="form-control" type="email" required v-model="form.g_2_email" placeholder="Guarantor's Email">
                                            </div>
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        Referees / Guarantor(2) Phone
                                                    </span>
                                                </div>
                                                <input class="form-control" type="text" required v-model="form.g_2_phone" placeholder="Guarantor's Phone">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mb-2 mt-2">
                                        <div class="dropdown-divider"></div>
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group" >
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        Referees / Guarantor(3) Name
                                                    </span>
                                                </div>
                                                    <input class="form-control" type="text" required v-model="form.g_3_name" placeholder="Guarantor's Name">
                                            </div>
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        Referees / Guarantor(3) Email
                                                    </span>
                                                </div>
                                                <input class="form-control" type="email" required v-model="form.g_3_email" placeholder="Guarantor's Email">
                                            </div>
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        Referees / Guarantor(3) Phone
                                                    </span>
                                                </div>
                                                <input class="form-control" type="text" required v-model="form.g_3_phone" placeholder="Guarantor's Phone">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="modal-footer">
                                <input type="hidden" name="" v-model="form.id">
                                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary waves-effect waves-light">Save changes</button>
                            </div>
                        </form>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            <!-- /.modal -->
</template>
<script>
export default {
    
    data () {
        return {
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
                form : {},
        }
    },
    methods : {
            guarantor(data){
                this.form = data;
                var guarant1 = JSON.parse(data.guarantor_1);
                var guarant2 = JSON.parse(data.guarantor_2);
                var guarant3 = JSON.parse(data.guarantor_3);
               
                this.form.guarantor_1 = guarant1
                this.form.guarantor_2 = guarant2
                this.form.guarantor_3 = guarant3
                
               
            },
            updateGuarantor(){
                axios.post('/updateGuarantor', this.form)
                .then(res=>{
                    this.toaster(res.data.message,'success');
                    $('#updateGuarantor').modal('hide');
                    this.$inertia.reload();
                })
                .catch(err=>{

                })
            },
    },
    mounted (){
        eventBus.$on('addGuarantor', this.guarantor)
    }
}
</script>
<style scoped>

</style>
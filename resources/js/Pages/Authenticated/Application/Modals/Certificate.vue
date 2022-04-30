<template>
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myModalLabel">Upload Certificates</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <form action="" method="post" @submit.prevent="formSubmit" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="col-lg-12 col-md-12">
                        <div class="alert alert-info">
                            <p> <strong>Note :</strong> 
                            You are required to upload the below listed Certificates for quick
                            approval of you application, there may be delays in the approval of your application
                            if all certificates are not uploaded. <br>
                            </p>
                            <p><strong>Note:</strong>  Certificates Will be requested based on your Application type<br></p>
                            <ul>
                                <span v-if="form.application_type == 'individual'">
                                    <li> Your proforma invoice</li>
                                    <li> 6-12 Bank statements of account</li>
                                    <li> A Copy of your utility bill (within 3 months)</li>
                                    <li> Passport photos (2 copies)</li>
                                    <li> Means of ID (Govt issued)</li>
                                    <li> Guarantors forms (already you have implemented this) </li>
                                    <li> Any other documents that can aid our approval (Here provide chance for client to add more docs) </li>
                                </span>

                                <span v-else>
                                    <li> One(1) year bank statement of account</li>
                                    <li> Company Registration Documents including </li>
                                    <li> Memo and Article of           Association</li>
                                    <li> Form CO2</li>
                                    <li> Form CO7</li>
                                    <li> CAC Certificate</li>
                                    <li> Utuility Bill (Both Office and Home of MD)</li>
                                    <li> Request Letter on Company Letter Head</li>
                                    <li> Letter of Authority mandating the MD to act on behalf of the company</li>
                                    <li> Board Resolution</li>
                                    <li> 2 copies of Passport Photos (MD)</li>
                                    <li> Means of Identity (MD)</li>
                                    <li> Other relevant documents</li>
                                </span>
                            </ul>
                        </div>
                        <div class="mb-3">
                            <strong style="color:red" >
                                Upload at least 6 documents for individual application or 12 for corporative application
                            </strong>
                        </div>
                        <div class="form-group">
                            <div class="input-group input-group-lg">
                                <label>Uploads Above Certificates</label>
                                <input type="file" name="filename"
                                    multiple
                                    class="dropify "
                                    data-height="134"
                                    data-allowed-file-extensions="jpg jpeg png jfif"
                                    required="" v-on:change="OnFileChange" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        
                        <input type="hidden" name="application_id" v-model="form.id">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary waves-effect waves-light">Save changes</button>
                </div>
            </form>
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
        form : {},
        certificates : {}
    }
},
methods : {
    setData(data){
        this.form = data;
    },
    OnFileChange(e){
        // console.log(e);

            this.certificates = e.target.files;
        },
    formSubmit() {
        // console.log(this.form.id)
        let formData = new FormData();
        formData.append('certificates', this.certificates);
        formData.append('application_id', this.form.id);
        // console.log(formData);
        
        axios.post('/uploadCertificate', formData)
            .then(res=>{
                this.toaster(res.data.message,'success');
                $('#UploadCertificate').modal('hide');
                this.$inertia.reload();
            })
            .catch(function (error) {
                currentObj.output = error;
            });
    },
},
    mounted () {
        eventBus.$on('AddCertificate', this.setData)
    }
}
</script>
<style>

</style>
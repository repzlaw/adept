<template>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myModalLabel">Add Bank Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <form action="" method="post" @submit.prevent="checkAccount">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="form-group" >
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            Bank Name
                                        </span>
                                    </div>
                                    <select class="form-control custom-select" v-model="form.bank_code">
                                        <option value>-- Choose Bank --</option>
                                        <option
                                            v-for="bank in banks.data"
                                            :key="bank.id"
                                            :value="bank.code + ', ' + bank.name "
                                        >{{bank.name}}</option>
                                    </select>
                                </div>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            Account Number
                                        </span>
                                    </div>
                                    <input class="form-control" type="text" required v-model="form.account_number" placeholder="Enter Valid Account Number">
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
    </div>
</template>
<script>
export default {
    
}
</script>
<style>

</style>
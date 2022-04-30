<template>
  <!-- ========== Left Sidebar Start ========== -->
    <div class="vertical-menu">
        <div data-simplebar class="h-100" style="background-color:#063299 !important;">

            <!--- Sidemenu -->
            <div id="sidebar-menu">
                <!-- Left Menu Start -->
                <ul class="metismenu list-unstyled" id="side-menu">
                    <li class="menu-title">Main</li>

                    <li>
                        <inertia-link :href="'/dashboard'" class="waves-effect">
                            <i class="ti-home"></i><span class="badge badge-pill badge-primary float-right"></span>
                            <span>Dashboard</span>
                        </inertia-link>
                    </li>

                    <li>
                        <inertia-link :href="'/my-application'" class=" waves-effect">
                            <i class="ti-calendar"></i>
                            <span>My Application</span>
                        </inertia-link>
                    </li>
                    <li>
                        <inertia-link :href="'/supplier'" class=" waves-effect">
                            <i class="ti-calendar"></i>
                            <span>Supplier Info</span>
                        </inertia-link>
                    </li>
                    <li :class="mmActive" >
                        <a href="javascript: void(0);" class="has-arrow waves-effect " :aria-expanded="status" @click="clearCollapse">
                            <i class="ti-package"></i>
                            <span>Payment</span>
                        </a>
                        <ul class="sub-menu mm-collapse" :class="submenuCollapse" aria-expanded="false">
                            <li><inertia-link href="/makePayment">Make Payment</inertia-link></li>
                            <li v-if="$page.auth.user.user_type=='admin'"><inertia-link href="/cashpayment">Cash Payment</inertia-link></li>
                            <li><inertia-link href="/history">Payment History</inertia-link></li>
                        </ul>
                    </li>
                    <li>
                        <inertia-link :href="'/payment-plan'" class=" waves-effect"  v-if="$page.auth.user.user_type=='admin'">
                            <i class="ti-calendar"></i>
                            <span>Payment Plan</span>
                        </inertia-link>
                    </li>


                </ul>
            </div>
            <!-- Sidebar -->
        </div>
    </div>
    <!-- Left Sidebar End -->
</template>

<script>
export default {
    data(){
        return {
            submenuCollapse : '',
            mmActive : '',
            status : true,
            toggle : 0
        }
    },
    methods:{
        clearCollapse(){
            this.toggle =!this.toggle;
            if(this.toggle){
                this.submenuCollapse = 'mm-show';
                this.mmActive = 'mm-active';
                this.status = true;
            }else{
                this.submenuCollapse = '';
                this.mmActive = '';
                this.status = false;
            }
        }
    }
}
</script>

<style>

</style>

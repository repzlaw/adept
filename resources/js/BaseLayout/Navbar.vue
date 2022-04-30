<template>
    <header id="page-topbar">
        <div class="navbar-header">
            <div class="d-flex">
                <!-- LOGO #063299 -->
                <div class="navbar-brand-box" style="background:#ECECF1 !important;">
                    <a href="https://adeptlessor.com/" class="logo logo-dark">
                        <span class="logo-sm">
                            <img src="/assets/images/AdeptlessorLogo.png" alt="" height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="/assets/images/AdeptlessorLogo.png" alt="" height="17">
                        </span>
                    </a>

                    <a href="https://adeptlessor.com/" class="logo logo-light mt-3">
                        <span class="logo-sm">
                            <img src="/assets/images/AdeptlessorLogo.png" alt="" height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="/assets/images/AdeptlessorLogo.png" alt="" height="18">
                        </span>
                    </a>
                </div>

                <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect" id="vertical-menu-btn" @click="slideSideBar">
                    <i class="mdi mdi-menu"></i>
                </button>

                <!-- <div class="d-none d-sm-block">
                    <div class="dropdown pt-3 d-inline-block">
                        <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Create <i class="mdi mdi-chevron-down"></i>
                            </a>

                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <a class="dropdown-item" href="#">Something else here</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Separated link</a>
                        </div>
                    </div>
                </div> -->
            </div>

            <div class="d-flex">
                    <!-- App Search-->
                    <!-- <form class="app-search d-none d-lg-block">
                        <div class="position-relative">
                            <input type="text" class="form-control" placeholder="Search...">
                            <span class="fa fa-search"></span>
                        </div>
                    </form> -->

                <div class="dropdown d-inline-block d-lg-none ml-2">
                    <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="mdi mdi-magnify"></i>
                    </button>
                    <!-- <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-0"
                        aria-labelledby="page-header-search-dropdown">

                        <form class="p-3">
                            <div class="form-group m-0">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div> -->
                </div>

                <div class="dropdown d-inline-block">
                    <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img class="rounded-circle header-profile-user" src="/assets/images/users/user-4.jpg"
                            alt="Header Avatar" v-if="!$page.auth.user.profile_photo_path">
                        <img class="rounded-circle header-profile-user" :src="'/storage/images/'+$page.auth.user.profile_photo_path"
                            alt="Header Avatar" v-else>
                            
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <!-- item-->
                        <a class="dropdown-item" href="javascript:void(0)"><i class="mdi mdi-wallet font-size-17 align-middle mr-1"></i> {{$page.auth.user.name}}</a>
                        <inertia-link class="dropdown-item" :href="'/profile'"><i class="mdi mdi-account-circle font-size-17 align-middle mr-1"></i> Profile</inertia-link>
                        <!-- <a class="dropdown-item d-block" href="#"><span class="badge badge-success float-right">11</span><i class="mdi mdi-settings font-size-17 align-middle mr-1"></i> Settings</a>
                        <a class="dropdown-item" href="#"><i class="mdi mdi-lock-open-outline font-size-17 align-middle mr-1"></i> Lock screen</a> -->
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item text-danger" href="javascript:void(0)" @click.prevent="submit">
                            <i class="bx bx-power-off font-size-17 align-middle mr-1 text-danger"></i> Logout
                        </a>
                    </div>
                </div>

                <!-- <div class="dropdown d-inline-block">
                    <button type="button" class="btn header-item noti-icon right-bar-toggle waves-effect">
                        <i class="mdi mdi-settings-outline"></i>
                    </button>
                </div> -->

            </div>
        </div>
    </header>
</template>

<script>
export default {
    methods : {
        slideSideBar(){
            this.$emit('collapseSidebar');
        },
        submit() {
                this.toaster("Logged Out!!!",'success');
                axios.post('/logout').then(response => {
                    window.location = '/login';
                })
            },
    }
}
</script>

<style>

</style>

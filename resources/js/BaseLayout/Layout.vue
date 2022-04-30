<template>
  <body data-sidebar="dark" :class="className">
      <div id="layout-wrapper">
          <Navbar @collapseSidebar="collapse" />
          <Sidebar />
          <div class="main-content">
            <slot />
          <Footer />
          </div>
      </div>
  </body>
</template>

<script>
import Navbar from '@/BaseLayout/Navbar'
import Sidebar from '@/BaseLayout/Sidebar'
import Footer from '@/BaseLayout/Footer'
export default {
    components : {
        Navbar,
        Sidebar,
        Footer
    },
    data(){
        return {
            toggle : 0,
            className : ''
        }
    },
    methods :{
        collapse(){
            this.toggle = !this.toggle;
            if(this.toggle){
                this.className = "sidebar-enable vertical-collpsed"
            }else{
                this.className = ""

            }
        }
    }
}
</script>

<style>

</style>
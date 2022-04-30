 <template>
    <Layout>
        <div class="page-content">
            <div class="container-fluid">
                <!-- start page title -->
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <div class="page-title-box">
                            <h4 class="font-size-18">My Application</h4>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item active">Welcome to  AdeptLessor</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- end page title -->
        
                <div class="pt-4">
                    <tabs
                        :tabs="tabs"
                        :currentTab="currentTab"
                        :wrapper-class="'body-tabs shadow-tabs'"
                        :tab-class="'tab-item'"
                        :tab-active-class="'tab-item-active'"
                        :line-class="'tab-item-line'"
                        @onClick="handleClick"
                />
                </div>
                <div class="card-body">
          
                    <div class="col-md-12" v-if="currentTab === 'tab1'">
                      <application :app_id="app_id" @app-id="getData($event)" />
                      <!-- @app-data="getAppData($event)" -->
                        <div class="d-block text-right ">
                          <button type="submit" class="btn btn-success btn-md  float-right mb-3 mt-3" @click="nextStage('tab2')"> Next Stage</button>
                        </div>
                    </div>
                    <div class="col-md-12" v-if="currentTab === 'tab2'">
                      <guarantor :app_id="app_id" />
                      <div class="row" >
                        <div class="col-md-6 col-6 d-block text-left ">
                          <button type="submit" class="btn btn-success btn-md  float-left mb-3 mt-3" @click="nextStage('tab1')">Previous Stage</button>
                        </div>
                        <div class="col-md-6 col-6 d-block text-right ">
                          <button type="submit" class="btn btn-success btn-md  float-right mb-3 mt-3" @click="nextStage('tab3')"> Next Stage</button>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12" v-if="currentTab === 'tab3'">
                      <certificate/>
                      <div class="row" >
                        <div class="col-md-6 col-6 d-block text-left ">
                          <button type="submit" class="btn btn-success btn-md  float-left mb-3 mt-3" @click="nextStage('tab2')">Previous Stage</button>
                        </div>
                        <div class="col-md-6 col-6 d-block text-right ">
                          <button type="submit" class="btn btn-success btn-md  float-right mb-3 mt-3" @click="nextStage('tab4')"> Next Stage</button>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12" v-if="currentTab === 'tab4'">
                      <supplier  />
                      <div class="row" >
                        <div class="col-md-6 col-6 d-block text-left ">
                          <button type="submit" class="btn btn-success btn-md  float-left mb-3 mt-3" @click="nextStage('tab3')">Previous Stage</button>
                        </div>
                        <div class="col-md-6 col-6 d-block text-right ">
                          <button type="submit" class="btn btn-success btn-md  float-right mb-3 mt-3" @click="nextStage('tab5')"> Finish Application </button>
                        </div>
                      </div>
                    </div>
                    
                </div>
              
        </div>
        </div>
   </Layout>
 </template>
 
 <script>
import VueElementLoading from 'vue-element-loading'
import Layout from '@/BaseLayout/Layout';
import Tabs from 'vue-tabs-with-active-line';
import application from './Application-Stage/Create-Application';
import guarantor from './Application-Stage/Guarantor';
import certificate from './Application-Stage/Certificate';
import supplier from './Application-Stage/Supplier';

const TABS = [{
    title: '<i class="badge badge-pill badge-primary">1</i>  Application Info.',
    value: 'tab1',
    disabled: true,
  },
  {
    title: '<i class="badge badge-pill badge-primary">2</i>  Guarantors Information.',
    value: 'tab2',
    disabled: true,
  },
  {
    title: '<i class="badge badge-pill badge-primary">3</i>  Upload Certificates.',
    value: 'tab3',
    disabled: true,
  },
  {
    title: '<i class="badge badge-pill badge-primary">4</i>  Manage Supplier.',
    value: 'tab4',
    disabled: true,
  },

  ];
       
 export default {
    components: {
        Layout,
        VueElementLoading,
        Tabs,
        application,
        guarantor,
        certificate,
        supplier,
    },
    data(){
        return{
            tabs: TABS,
            currentTab: 'tab1',  
            app_id:"0",
            appData:{},

        }
    },
    methods: {
      handleClick(newTab) {
        this.currentTab = newTab;
      },
      getData(e){
        //console.log(e)
        this.app_id = e.id;
      },
      getAppData(e){
        //console.log(e)
        //var appData = localStorage.setItem("appData", e.data);
        //this.appData = appData;
      },
      nextStage(tab){
        if(tab == 'tab2'){
          var appId = localStorage.getItem("appId");
          this.app_id = appId;
          if(appId == null){
            this.toaster('You are yet to complete this stage. Fill the form and click Save','error');
          }else{
            this.currentTab = tab;
          }
        }else if(tab == 'tab3'){
          var appData = JSON.parse(localStorage.getItem("appData"));
          //console.log(appData)
          var g_1_name = appData.g_1_name;
          var g_2_name = appData.g_2_name;
          var g_3_name = appData.g_3_name;
          if(g_1_name != null){
            this.currentTab = tab;
          }else{
            this.toaster('You are yet to complete this stage. Fill the form and click Save','error');
          }

        }else if(tab == 'tab5'){
          var supplyData = JSON.parse(localStorage.getItem("supplyData"));

          if(supplyData){
            localStorage.clear();
               this.$inertia.visit('/my-application')
            
          }else{
            this.toaster('You are yet to complete this stage. Fill the form and click Save','error');
          }
        }
        else{
          this.currentTab = tab;
        }

      },

    },
 }
 </script>
 
 <style >
  .tabs {
  position: relative;
  margin: 0 auto;
}
 
.tabs__item {
  display: inline-block;
  margin: 0 5px;
  padding: 10px;
  padding-bottom: 8px;
  font-size: 16px;
  letter-spacing: 0.8px;
  color: gray;
  text-decoration: none;
  border: none;
  background-color: transparent;
  border-bottom: 2px solid transparent;
  cursor: pointer;
  transition: all 0.25s;
}
 
.tabs__item_active {
  color: black;
}
 
.tabs__item:hover {
  border-bottom: 2px solid gray;
  color: black;
}
 
.tabs__item:focus {
  outline: none;
  border-bottom: 2px solid gray;
  color: black;
}
 
.tabs__item:first-child {
  margin-left: 0;
}
 
.tabs__item:last-child {
  margin-right: 0;
}
 
.tabs__active-line {
  position: absolute;
  bottom: 0;
  left: 0;
  height: 2px;
  background-color: black;
  transition: transform 0.4s ease, width 0.4s ease;
}

 </style>
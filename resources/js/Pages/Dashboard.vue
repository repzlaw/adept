<template>
  <Layout>
    <div class="page-content">
      <div class="container-fluid">
        <!-- start page title -->
        <div class="row align-items-center">
          <div class="col-sm-6">
            <div class="page-title-box">
              <h4 class="font-size-18">Dashboard</h4>
              <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item active">
                  Welcome {{ $page.auth.user.name }} !
                </li>
              </ol>
            </div>
          </div>

          <div class="col-sm-6">
            <div class="float-right d-sm-block">
              <inertia-link
                :href="'/my-application'"
                class="btn btn-primary dropdown-toggle waves-effect waves-light"
                type="inertia-link"
              >
                <i class="mdi mdi-calendar mr-2"></i> New Application
              </inertia-link>
            </div>
          </div>
        </div>
        <!-- end page title -->

        <div class="row mb-6">
          <div class="col-12" v-if="status">
            <div
              class="
                alert alert-warning alert-dismissible
                fade
                show
                text-center
              "
              role="alert"
            >
              <strong
                >To be guaranteed of efficient and effective operations on this
                platform, please kindly update your profile...!</strong
              >
              <button
                type="button"
                class="close"
                data-dismiss="alert"
                aria-label="Close"
              >
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          </div>
          <div class="col-xl-3 col-md-6">
            <div class="card mini-stat bg-primary text-white">
              <div class="card-body">
                <div class="mb-4">
                  <div class="float-left mini-stat-img mr-4">
                    <img src="assets/images/services-icon/01.png" alt="" />
                  </div>
                  <h5 class="font-size-16 text-uppercase mt-0 text-white-50">
                    Applications
                  </h5>
                  <h4 class="font-weight-medium font-size-24">
                    {{ stat.total_applications }}
                    <i class="mdi mdi-arrow-left text-primary ml-2"></i>
                  </h4>
                  <div class="mini-stat-label bg-success">
                    <!-- <p class="mb-0">+ 12%</p> -->
                  </div>
                </div>
                <!-- <div class="pt-2">
                                            <div class="float-right">
                                                <a href="#" class="text-white-50"><i class="mdi mdi-arrow-right h5"></i></a>
                                            </div>
                                            <p class="text-white-50 mb-0 mt-1">Active</p>
                                        </div> -->
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-md-6">
            <div class="card mini-stat bg-primary text-white">
              <div class="card-body">
                <div class="mb-4">
                  <div class="float-left mini-stat-img mr-4">
                    <img src="assets/images/services-icon/02.png" alt="" />
                  </div>
                  <h5 class="font-size-16 text-uppercase mt-0 text-white-50">
                    Approved
                  </h5>
                  <h4 class="font-weight-medium font-size-24">
                    {{ stat.approved_applications }}
                    <i class="mdi mdi-arrow-up text-success ml-2"></i>
                  </h4>
                  <div class="mini-stat-label bg-success">
                    <!-- <p class="mb-0">- 28%</p> -->
                  </div>
                </div>
                <!-- <div class="pt-2">
                                            <div class="float-right">
                                                <a href="#" class="text-white-50"><i class="mdi mdi-arrow-right h5"></i></a>
                                            </div>

                                            <p class="text-white-50 mb-0 mt-1">Since last month</p>
                                        </div> -->
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-md-6">
            <div class="card mini-stat bg-primary text-white">
              <div class="card-body">
                <div class="mb-4">
                  <div class="float-left mini-stat-img mr-4">
                    <img src="assets/images/services-icon/03.png" alt="" />
                  </div>
                  <h5 class="font-size-16 text-uppercase mt-0 text-white-50">
                    Declined
                  </h5>
                  <h4 class="font-weight-medium font-size-24">
                    {{ stat.declined_applications }}
                    <i class="mdi mdi-arrow-down text-danger ml-2"></i>
                  </h4>
                  <div class="mini-stat-label bg-danger">
                    <!-- <p class="mb-0"> 00%</p> -->
                  </div>
                </div>
                <!-- <div class="pt-2">
                                            <div class="float-right">
                                                <a href="#" class="text-white-50"><i class="mdi mdi-arrow-right h5"></i></a>
                                            </div>

                                            <p class="text-white-50 mb-0 mt-1">Since last month</p>
                                        </div> -->
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-md-6">
            <div class="card mini-stat bg-primary text-white">
              <div class="card-body">
                <div class="mb-4">
                  <div class="float-left mini-stat-img mr-4">
                    <img src="assets/images/services-icon/04.png" alt="" />
                  </div>
                  <h5 class="font-size-16 text-uppercase mt-0 text-white-50">
                    Pending
                  </h5>
                  <h4 class="font-weight-medium font-size-24">
                    {{ stat.pending_applications }}
                    <i class="mdi mdi-arrow-right text-info ml-2"></i>
                  </h4>
                  <div class="mini-stat-label bg-info">
                    <!-- <p class="mb-0">+ 84%</p> -->
                  </div>
                </div>
                <!-- <div class="pt-2">
                                            <div class="float-right">
                                                <a href="#" class="text-white-50"><i class="mdi mdi-arrow-right h5"></i></a>
                                            </div>

                                            <p class="text-white-50 mb-0 mt-1">Since last month</p>
                                        </div> -->
              </div>
            </div>
          </div>
        </div>
        <!-- end row -->
        <section class="about">
          <div class="container">
            <div class="item-list">
              <div class="row">
                <link type="text/css" rel="stylesheet" href="css/main.css" />
                <div
                  class="col-md-6 col-sm-12 col-xs-12 card card-body"
                  id="col-md"
                >
                  <!-- <div class="sec-title"> -->
                  <div
                    class="faq-accordion"
                    id="faq-accordion"
                    itemscope=""
                    itemtype="http://schema.org/FAQPage"
                  >
                    <div
                      class="faq-question-answer"
                      itemprop="mainEntity"
                      itemscope=""
                      itemtype="http://schema.org/Question"
                    >
                      <div id="faq-question-1" class="faq-question-header">
                        <h2>
                          <a
                            class=""
                            data-toggle="collapse"
                            data-target="#faq-answer-1"
                            aria-expanded="false"
                            aria-controls="faq-answer-1"
                          >
                            <i class="icon-angle-up"></i>
                            <span
                              itemprop="name"
                              style="text-transform: capitalize"
                            >
                              It is a simple process through the following
                              steps;
                            </span>
                          </a>
                        </h2>
                      </div>
                      <div
                        id="faq-answer-1"
                        class="faq-answer-body collapse show"
                        data-parent="#faq-accordion"
                        itemprop="acceptedAnswer"
                        itemscope=""
                        itemtype="http://schema.org/Answer"
                        style=""
                      >
                        <div itemprop="text">
                          <!-- <p class="pp">In order to begin the process of applying for Equipment Leasing, client will be required to fill an ONLINE  LEASING APPLICATION FOR Monthe website. Before client can be able to access the online leasing application form, client will be required to first create an Online Client Account which will require the following information:</p> -->
                          <ul class="s-list list-unstyled mb-20">
                            <li>• Identify your equipment needs</li>
                            <li>• Obtain a pro-forma invoice</li>
                            <li>
                              • Apply & submit necessary documents for the lease
                              online
                            </li>
                            <li>• Obtain an indicative offer</li>
                            <li>• Discuss & accept the offer</li>
                            <li>
                              • Issue post dated cheques against the offer
                            </li>
                            <li>• Pick up leased items</li>
                            <!-- <li><span class="fa fa-check"></span>Country</li> -->
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- <div class="col-md-5 col-sm-10 col-xs-12">
							<div class="item">
								<figure class="image-box">
									<img src="images/img/apply.png" alt="Application Form Process" style="width: 500px; height:300px" />
								</figure>
							</div>
						</div> -->
                <div
                  class="col-md-6 col-sm-12 col-xs-12 card card-body"
                  id="col-md"
                >
                  <!-- <div class="sec-title"> -->
                  <div
                    class="faq-accordion"
                    id="faq-accordion"
                    itemscope=""
                    itemtype="http://schema.org/FAQPage"
                  >
                    <div
                      class="faq-question-answer"
                      itemprop="mainEntity"
                      itemscope=""
                      itemtype="http://schema.org/Question"
                    >
                      <div id="faq-question-1" class="faq-question-header">
                        <h2>
                          <a
                            class=""
                            data-toggle="collapse"
                            data-target="#faq-answer-1"
                            aria-expanded="false"
                            aria-controls="faq-answer-1"
                          >
                            <i class="icon-angle-up"></i>
                            <span
                              itemprop="name"
                              style="text-transform: capitalize"
                            >
                              For Individual Prospective Client
                            </span>
                          </a>
                        </h2>
                      </div>
                      <div
                        id="faq-answer-1"
                        class="faq-answer-body collapse show"
                        data-parent="#faq-accordion"
                        itemprop="acceptedAnswer"
                        itemscope=""
                        itemtype="http://schema.org/Answer"
                        style=""
                      >
                        <div itemprop="text">
                          <p class="mb-4" style="font-weight: bold">
                            To access leasing from us, you will begin with
                            making an Online Application. To make an Online
                            Application will require you upload the following to
                            process your lease facility;
                          </p>
                          <small
                            >To complete this process, you will need the
                            following</small
                          >
                          <ul class="s-list list-unstyled mb-20">
                            <li>• Obtain a pro-forma invoice</li>
                            <li>• 6-12 Bank statements of account</li>
                            <li>
                              • A Copy of your utility bill (within 3 months)
                              (PHCN, water or waste bill)
                            </li>
                            <li>• Passport photos (2 copies)</li>
                            <li>• Means of ID (Govt issued)</li>
                            <li>• Guarantors forms</li>
                            <li>• Post dated cheques</li>
                            <li>
                              • Any other documents that can aid our approval
                            </li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div
                  class="col-md-6 col-sm-12 col-xs-12 card card-body"
                  id="col-md"
                >
                  <!-- <div class="sec-title"> -->
                  <div
                    class="faq-accordion"
                    id="faq-accordion"
                    itemscope=""
                    itemtype="http://schema.org/FAQPage"
                  >
                    <div
                      class="faq-question-answer"
                      itemprop="mainEntity"
                      itemscope=""
                      itemtype="http://schema.org/Question"
                    >
                      <div id="faq-question-1" class="faq-question-header">
                        <h2>
                          <a
                            class=""
                            data-toggle="collapse"
                            data-target="#faq-answer-1"
                            aria-expanded="false"
                            aria-controls="faq-answer-1"
                          >
                            <i class="icon-angle-up"></i>
                            <span
                              itemprop="name"
                              style="text-transform: capitalize"
                            >
                              For Corporate Prospective Client
                            </span>
                          </a>
                        </h2>
                      </div>
                      <div
                        id="faq-answer-1"
                        class="faq-answer-body collapse show"
                        data-parent="#faq-accordion"
                        itemprop="acceptedAnswer"
                        itemscope=""
                        itemtype="http://schema.org/Answer"
                        style=""
                      >
                        <div itemprop="text">
                          <p class="mb-4" style="font-weight: bold">
                            To access leasing from us, you will begin with
                            making an Online Application. To make an Online
                            Application will require you upload the following to
                            process your lease facility;
                          </p>
                          <!-- <small>To complete this process, you will need the following</small> -->
                          <ul class="s-list list-unstyled mb-20">
                            <li>• One(1) year bank statement of account</li>
                            <li>
                              • Company Registration Documents
                              <ul class="s-list list-unstyled mb-20">
                                <li>1. Memo and Article of Association</li>
                                <li>2. Form CO2</li>
                                <li>3. Form CO7</li>
                                <li>4. CAC Certificate</li>
                              </ul>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div
                  class="col-md-6 col-sm-12 col-xs-12 card card-body"
                  id="col-md"
                >
                  <!-- <div class="sec-title"> -->
                  <div
                    class="faq-accordion"
                    id="faq-accordion"
                    itemscope=""
                    itemtype="http://schema.org/FAQPage"
                  >
                    <div
                      class="faq-question-answer"
                      itemprop="mainEntity"
                      itemscope=""
                      itemtype="http://schema.org/Question"
                    >
                      <div
                        id="faq-answer-1"
                        class="faq-answer-body collapse show"
                        data-parent="#faq-accordion"
                        itemprop="acceptedAnswer"
                        itemscope=""
                        itemtype="http://schema.org/Answer"
                        style=""
                      >
                        <div itemprop="text">
                          <!-- <small>To complete this process, you will need the following</small> -->
                          <ul class="s-list list-unstyled mb-20">
                            <li>• Utility Bill (Both Office and Home of MD)</li>
                            <li>• Request Letter on Company Letter Head</li>
                            <li>
                              • Letter of Authority mandating the MD to act on
                              behalf of the company
                            </li>
                            <li>• Board Resolution</li>
                            <li>• 2 copies of Passport Photos (MD)</li>
                            <li>• Means of Identity (MD</li>
                            <li>• Postdated Cheques</li>
                            <li>• Other relevant documents.</li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>

        <!-- end row -->

        <!-- <div class="row">
                            <div class="col-xl-8">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-4">Latest Trasaction</h4>
                                        <div class="table-responsive"> -->
        <!-- <table class="table table-hover table-responsive-sm table-centered table-nowrap mb-0">
                                                <thead>
                                                <tr>
                                                    <th scope="col">(#) Id</th>
                                                    <th scope="col">Application</th>
                                                    <th scope="col">Item</th>
                                                    <th scope="col">Amount</th>
                                                    <th scope="col">Date</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr v-for="(dt, index) in data" :key="index">
                                                    <td>{{dt.orderid}}</td>
                                                    <td>{{dt.business_name}}</td>
                                                    <td>{{dt.item}}</td>
                                                    <td>{{dt.amount_paid}}</td>
                                                    <td>{{dt.trans_date}}</td>
                                                    <td>
                                                        <span :class="[(dt.status=='PENDING')?
                                                                'badge badge-warning':(dt.status=='APPROVED')?
                                                                'badge badge-success':'badge badge-danger']">
                                                                {{dt.status}}</span>
                                                    </td>
                                                    <td>
                                                        <div>
                                                            <a href="#" class="btn btn-primary btn-sm">Edit</a>
                                                        </div>
                                                    </td>
                                                </tr>

                                                </tbody>
                                            </table> -->
        <!-- <table class="table table-hover table-responsive-sm table-centered table-nowrap mb-0">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">(#) Id</th>
                                                        <th scope="col">Name</th>
                                                        <th scope="col">Date</th>
                                                        <th scope="col">Amount</th>
                                                        <th scope="col" colspan="2">Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <th scope="row">#14256</th>
                                                        <td>
                                                            <div>
                                                                <img src="assets/images/users/user-2.jpg" alt=""
                                                                    class="avatar-xs rounded-circle mr-2"> Philip Smead
                                                            </div>
                                                        </td>
                                                        <td>15/1/2018</td>
                                                        <td>$94</td>
                                                        <td><span class="badge badge-success">Delivered</span></td>
                                                        <td>
                                                            <div>
                                                                <a href="#" class="btn btn-primary btn-sm">Edit</a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">#14257</th>
                                                        <td>
                                                            <div>
                                                                <img src="assets/images/users/user-3.jpg" alt=""
                                                                    class="avatar-xs rounded-circle mr-2"> Brent Shipley
                                                            </div>
                                                        </td>
                                                        <td>16/1/2019</td>
                                                        <td>$112</td>
                                                        <td><span class="badge badge-warning">Pending</span></td>
                                                        <td>
                                                            <div>
                                                                <a href="#" class="btn btn-primary btn-sm">Edit</a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">#14258</th>
                                                        <td>
                                                            <div>
                                                                <img src="assets/images/users/user-4.jpg" alt=""
                                                                    class="avatar-xs rounded-circle mr-2"> Robert Sitton
                                                            </div>
                                                        </td>
                                                        <td>17/1/2019</td>
                                                        <td>$116</td>
                                                        <td><span class="badge badge-success">Delivered</span></td>
                                                        <td>
                                                            <div>
                                                                <a href="#" class="btn btn-primary btn-sm">Edit</a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">#14259</th>
                                                        <td>
                                                            <div>
                                                                <img src="assets/images/users/user-5.jpg" alt=""
                                                                    class="avatar-xs rounded-circle mr-2"> Alberto Jackson
                                                            </div>
                                                        </td>
                                                        <td>18/1/2019</td>
                                                        <td>$109</td>
                                                        <td><span class="badge badge-danger">Cancel</span></td>
                                                        <td>
                                                            <div>
                                                                <a href="#" class="btn btn-primary btn-sm">Edit</a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">#14260</th>
                                                        <td>
                                                            <div>
                                                                <img src="assets/images/users/user-6.jpg" alt=""
                                                                    class="avatar-xs rounded-circle mr-2"> David Sanchez
                                                            </div>
                                                        </td>
                                                        <td>19/1/2019</td>
                                                        <td>$120</td>
                                                        <td><span class="badge badge-success">Delivered</span></td>
                                                        <td>
                                                            <div>
                                                                <a href="#" class="btn btn-primary btn-sm">Edit</a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">#14261</th>
                                                        <td>
                                                            <div>
                                                                <img src="assets/images/users/user-2.jpg" alt=""
                                                                    class="avatar-xs rounded-circle mr-2"> Philip Smead
                                                            </div>
                                                        </td>
                                                        <td>15/1/2018</td>
                                                        <td>$94</td>
                                                        <td><span class="badge badge-warning">Pending</span></td>
                                                        <td>
                                                            <div>
                                                                <a href="#" class="btn btn-primary btn-sm">Edit</a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table> -->
        <!-- </div>
                                    </div>
                                </div>
                            </div> -->
        <!-- <div class="col-xl-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-4">Chat</h4>
                                        <div class="chat-conversation">
                                            <ul class="conversation-list" data-simplebar style="max-height: 367px;">
                                                <li class="clearfix">
                                                    <div class="chat-avatar">
                                                        <img src="assets/images/users/user-2.jpg"
                                                            class="avatar-xs rounded-circle" alt="male">
                                                        <span class="time">10:00</span>
                                                    </div>
                                                    <div class="conversation-text">
                                                        <div class="ctext-wrap">
                                                            <span class="user-name">John Deo</span>
                                                            <p>
                                                                Hello!
                                                            </p>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="clearfix odd">
                                                    <div class="chat-avatar">
                                                        <img src="assets/images/users/user-3.jpg"
                                                            class="avatar-xs rounded-circle" alt="Female">
                                                        <span class="time">10:01</span>
                                                    </div>
                                                    <div class="conversation-text">
                                                        <div class="ctext-wrap">
                                                            <span class="user-name">Smith</span>
                                                            <p>
                                                                Hi, How are you? What about our next meeting?
                                                            </p>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="clearfix">
                                                    <div class="chat-avatar">
                                                        <img src="assets/images/users/user-2.jpg"
                                                            class="avatar-xs rounded-circle" alt="male">
                                                        <span class="time">10:04</span>
                                                    </div>
                                                    <div class="conversation-text">
                                                        <div class="ctext-wrap">
                                                            <span class="user-name">John Deo</span>
                                                            <p>
                                                                Yeah everything is fine
                                                            </p>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="clearfix odd">
                                                    <div class="chat-avatar">
                                                        <img src="assets/images/users/user-3.jpg"
                                                            class="avatar-xs rounded-circle" alt="male">
                                                        <span class="time">10:05</span>
                                                    </div>
                                                    <div class="conversation-text">
                                                        <div class="ctext-wrap">
                                                            <span class="user-name">Smith</span>
                                                            <p>
                                                                Wow that's great
                                                            </p>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="clearfix odd">
                                                    <div class="chat-avatar">
                                                        <img src="assets/images/users/user-3.jpg"
                                                            class="avatar-xs rounded-circle" alt="male">
                                                        <span class="time">10:08</span>
                                                    </div>
                                                    <div class="conversation-text">
                                                        <div class="ctext-wrap">
                                                            <span class="user-name mb-2">Smith</span>

                                                            <img src="assets/images/small/img-1.jpg" alt="" height="48"
                                                                class="rounded mr-2">
                                                            <img src="assets/images/small/img-2.jpg" alt="" height="48"
                                                                class="rounded">
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                            <div class="row">
                                                <div class="col-sm-9 col-8 chat-inputbar">
                                                    <input type="text" class="form-control chat-input"
                                                        placeholder="Enter your text">
                                                </div>
                                                <div class="col-sm-3 col-4 chat-send">
                                                    <button type="submit" class="btn btn-success btn-block">Send</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
        <!-- </div> -->
        <!-- end row -->
      </div>
      <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
  </Layout>
</template>

<script>
import Layout from "@/BaseLayout/Layout";

export default {
  components: {
    Layout,
  },
  data() {
    return {
      status: false,
      loading: false,
      stat: [],
    };
  },
  methods: {
    stats() {
      // this.loading= true;
      axios
        .get("/dashboard/stats")
        .then((res) => {
          this.stat = res.data;
          // console.log(res.data);
          // this.stats = res.data;
          // this.studentID = this.stats.studentID;
          // this.sesTermID = this.stats.sesTermID;
          // this.classDescID = this.stats.classDescID;
          // this.loading = false;
        })
        .catch((err) => {
          // swal("Error", "Unable to get stats", "error");
          this.loading = false;
        });
    },
    check() {
      var checkUser = [
        this.$page.auth.user.surname,
        this.$page.auth.user.othername,
        this.$page.auth.user.name,
        this.$page.auth.user.email,
        this.$page.auth.user.phone,
        this.$page.auth.user.religion,
        this.$page.auth.user.lga,
      ];
      var rec = checkUser.filter((element) => {
        return element == null || element == "";
      });
      if (rec.length > 0) {
        this.status = true;
      }
    },
  },
  mounted() {
    this.check();
    this.stats();
    localStorage.clear();
  },
};
</script>

<template>
<div class="slim-mainpanel">
  <div class="container">
    <breadcrumb-slim :position="position"></breadcrumb-slim>
    <div class="row row-sm">
          

    <div class="col-lg-8">

      <div class="card card-latest-activity mg-t-20">
        <div class="card-body">
          <div class="slim-card-title">{{trans('app.user.edit')}}</div>
          <div class="media media-author">
            <img src="http://via.placeholder.com/500x500" alt="">
            <!-- <img :src="draft.image ? draft.image : trans('settings.default_image')" alt="imagen"> -->
            <div class="media-body">
              <h6><a href="">{{draft.name}}</a></h6>
              <!-- <p>Executive Director</p> -->
            </div><!-- media-body -->
          </div><!-- media -->

          <p class="activity-text">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor.</p>
          <div class="row no-gutters">
            <b-container fluid>  
            <div class="row mg-b-25">
              <b-col class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">{{trans('app.user.name')}}: <span class="tx-danger">*</span></label>
                  <input type="text" v-model="draft.name" class="form-control" placeholder="Enter Name">
                </div>
              </b-col><!-- col-4 -->
              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">{{trans('app.user.phone')}}: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="phone" placeholder="Enter phone" v-model="draft.phone">
                </div>
              </div><!-- col-4 -->
              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">{{trans('app.user.email')}} : <span class="tx-danger">*</span></label>
                  <input class="form-control" type="email" name="email" placeholder="Enter email" v-model="draft.email">
                </div>
              </div><!-- col-4 -->
              <div class="col-lg-8">
                <div class="form-group mg-b-10-force">
                  <label class="form-control-label">{{trans('app.user.address')}}: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="address" placeholder="Enter address" v-model="draft.address">
                </div>
              </div><!-- col-8 -->
              <div class="col-lg-4">
                <div class="form-group mg-b-10-force">
                  <label class="form-control-label">{{trans('app.user.user_group')}}: <span class="tx-danger">*</span></label>
                  <b-form-select v-model="draft.user_group_id" :options="userGroups" class="mb-3"/>
                </div>
              </div><!-- col-4 -->
              <div class="col-lg-4">
                <div class="form-group mg-b-10-force">
                  <label class="form-control-label">{{trans('app.user.password')}}: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="password" name="password" placeholder="password" v-model="draft.password">
                </div>
              </div><!-- col-8 -->
              <div class="col-lg-4">
                <div class="form-group mg-b-10-force">
                  <label class="form-control-label">{{trans('app.user.confirm_password')}}: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="password" name="password_confirmation" placeholder="confirm password" v-model="draft.password_confirmation">
                </div>
              </div><!-- col-8 -->
              
            </div><!-- row -->

            <div class="form-layout-footer">
              <b-button type="submit" @click="update" variant="primary">{{trans('app.buttons.update')}}</b-button>
            </div><!-- form-layout-footer -->
          <!-- </div> -->
          <!-- form-layout -->
          </b-container>
            
          </div><!-- row -->

        </div><!-- card-body -->
       
      </div><!-- card -->

      <div class="card card-experience mg-t-20">
        <div class="card-body">
          <div class="slim-card-title">Work Experience</div>
          <div class="media">
            <div class="experience-logo">
              <i class="icon ion-briefcase"></i>
            </div><!-- experience-logo -->
            <div class="media-body">
              <h6 class="position-name">Front-End Engineer / Web Developer</h6>
              <p class="position-company">Cebu Machine Intelligence, Inc.</p>
              <p class="position-year">Nov 2012 - Present (5 years +) &nbsp;-&nbsp; <a href="">Edit</a></p>
            </div><!-- media-body -->
          </div><!-- media -->
        </div><!-- card-body -->
        <div class="card-footer">
          <a href="">Show more<span class="d-none d-sm-inline"> experiences (4)</span> <i class="fa fa-angle-down"></i></a>
          <a href="">Add new</a>
        </div><!-- card-footer -->
      </div><!-- card -->

      <div class="card card-recommendation mg-t-20">
        <div class="card-body pd-25">
          <div class="slim-card-title">Recommendations</div>
          <div class="media align-items-center mg-y-25">
            <img src="http://via.placeholder.com/500x500" class="wd-40 rounded-circle" alt="">
            <div class="media-body mg-l-15">
              <h6 class="tx-14 mg-b-2"><a href="">Rolando Paloso</a></h6>
              <p class="mg-b-0">Head Architect</p>
            </div><!-- media-body -->
            <span class="tx-12">Nov 20, 2017</span>
          </div><!-- media -->

          <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>
          <p class="mg-b-0">Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo.</p>
        </div><!-- card-body -->

        <div class="card-footer pd-y-12 pd-x-25 bd-t bd-gray-300">
          <a href="">More recommendations (2) <i class="fa fa-angle-down"></i></a>
        </div><!-- card-footer -->
      </div>
    </div><!-- col-8 -->

    <div class="col-lg-4 mg-t-20 mg-lg-t-0 ">
      <div class="card card-connection mg-t-20">
        <div class="row ">
          <div class="col align-self-center">
            <template v-if="statusAvatar==false">
              <div class="mg-l-50">
                <b-img thumbnail rounded="circle" fluid width="200" height="200" :src="draft.image ? draft.image : '/images/default-user.png'" alt="Thumbnail"/>
              </div>
              <div class="pull-rigth g-l-200">
                <b-button type="submit" @click="editAvatar('true')" variant="primary">{{trans('app.buttons.edit')}}  <i class="fa fa-pencil" aria-hidden="true"></i></b-button>
              </div>
            </template>
            <template v-else>
              <div class="">
                <upload-images v-model="draft.image" :limit="1"></upload-images>
              </div>
              <div class="mg-t-20 mg-l-60">
                <b-button type="button" @click="saveAvatar" variant="primary">{{trans('app.buttons.create')}}  <i class="fa fa-pencil" aria-hidden="true"></i></b-button>
                <b-button class="mg-l-20" type="button" @click="calcel" variant="danger">{{trans('app.buttons.cancel')}}  <i class="fa fa-pencil" aria-hidden="true"></i></b-button>
              </div>
            </template>
          </div>           
            
        </div><!-- row -->

      </div><!-- card -->

      <div class="card pd-25 mg-t-20">
        <div class="slim-card-title">Contact &amp; Personal Info</div>

        <div class="media-list mg-t-25">
          <div class="media">
            <div><i class="icon ion-link tx-24 lh-0"></i></div>
            <div class="media-body mg-l-15 mg-t-4">
              <h6 class="tx-14 tx-gray-700">Websites</h6>
              <a href="" class="d-block">http://themepixels.me</a>
              <a href="" class="d-block">http://themeforest.net</a>
            </div><!-- media-body -->
          </div><!-- media -->
          <div class="media mg-t-25">
            <div><i class="icon ion-ios-telephone-outline tx-24 lh-0"></i></div>
            <div class="media-body mg-l-15 mg-t-4">
              <h6 class="tx-14 tx-gray-700">Phone Number</h6>
              <span class="d-block">{{draft.phone}}</span>
            </div><!-- media-body -->
          </div><!-- media -->
          <div class="media mg-t-25">
            <div><i class="icon ion-ios-email-outline tx-24 lh-0"></i></div>
            <div class="media-body mg-l-15 mg-t-4">
              <h6 class="tx-14 tx-gray-700">Email Address</h6>
              <span class="d-block">{{draft.email}}</span>
            </div><!-- media-body -->
          </div><!-- media -->
          <div class="media mg-t-25">
            <div><i class="icon ion-social-twitter tx-18 lh-0"></i></div>
            <div class="media-body mg-l-15 mg-t-2">
              <h6 class="tx-14 tx-gray-700">Twitter</h6>
              <a href="#" class="d-block">@themepixels</a>
            </div><!-- media-body -->
          </div><!-- media -->
        </div><!-- media-list -->
      </div><!-- card -->

     

      <div class="card card-people-list mg-t-20">
        <div class="slim-card-title">People you may know</div>
        <div class="media-list">
          <div class="media">
            <img src="http://via.placeholder.com/500x500" alt="">
            <div class="media-body">
              <a href="">Amber Heard</a>
              <p>Software Engineer</p>
            </div><!-- media-body -->
            <a href=""><i class="icon ion-person-add tx-20"></i></a>
          </div><!-- media -->
          <div class="media">
            <img src="http://via.placeholder.com/500x500" alt="">
            <div class="media-body">
              <a href="">Richard Salomon</a>
              <p>Architect</p>
            </div><!-- media-body -->
            <a href=""><i class="icon ion-person-add tx-20"></i></a>
          </div><!-- media -->
          <div class="media">
            <img src="http://via.placeholder.com/500x500" alt="">
            <div class="media-body">
              <a href="">Warren Vito</a>
              <p>Sales Representative</p>
            </div><!-- media-body -->
            <a href=""><i class="icon ion-person-add tx-20"></i></a>
          </div><!-- media -->
          <div class="media">
            <img src="http://via.placeholder.com/500x500" alt="">
            <div class="media-body">
              <a href="">Charlene Plateros</a>
              <p>Sales Representative</p>
            </div><!-- media-body -->
            <a href=""><i class="icon ion-person-add tx-20"></i></a>
          </div><!-- media -->
          <div class="media">
            <img src="http://via.placeholder.com/500x500" alt="">
            <div class="media-body">
              <a href="">Allan Palban</a>
              <p>Sales Representative</p>
            </div><!-- media-body -->
            <a href=""><i class="icon ion-person-add tx-20"></i></a>
          </div><!-- media -->
        </div><!-- media-list -->
      </div><!-- card -->
      
    </div><!-- col-4 -->
    </div><!-- row -->
  </div>
</div>
</template>

<script>
   
    export default {
        data(){
            return{
              statusAvatar:false,
              rotation: 0,
              scale: 1,
              borderRadius: 0,
              position:trans('app.profile.title'),
              email:"",
              draft: [],
                userGrupsList:[],
                statuses: [
                    { value: null, text: trans('app.common.select') },
                    { value: '1', text: trans('app.common.active') },
                    { value: '0', text: trans('app.common.inactive') },
                ],            
            }
        },
        
        created(){
            this.draft = clone(this.$store.getters.getSession)
            this.listUserGroups()
           
        },
        methods:{
            editAvatar(status){
                this.statusAvatar = status
            },
            calcel(){
              this.statusAvatar = false
            },
            saveAvatar(){
              this.update()
              this.statusAvatar = false
            },
            onChangeScale (scale) {
                this.$refs.vueavatar.changeScale(scale)
            },
            saveClicked () {
                var img = this.$refs.vueavatar.getImageScaled()
                console.log(img);
                this.$refs.image.src = img.toDataURL()
            },
            onImageReady () {
                this.scale = 1
                this.rotation = 0
            },
            listUserGroups(){
                this.$store.dispatch('listUserGroups')
            },
            update(){
                var draft = this.draft
                var id = this.draft.id
                var statusAvatar = this.statusAvatar
                this.$store.dispatch('updateUser', { id: id, draft, statusAvatar:statusAvatar })
                this.$store.dispatch('setSession',draft)
            },
            
        },
        computed:{
            user(){
                 return this.$store.getters.getSession
            },
            userGroups(){

                let arr = this.$store.state.User.userGroups
                for (var i = arr.length - 1; i >= 0; i--) {
                   var obj={};
                   obj.value = arr[i].id;
                   obj.text= arr[i].title;
                   this.userGrupsList.push(obj);
                }
                return this.userGrupsList;
            },

            validForm(){
              return this.validName && this.validEmail 
              // && this.validImage && this.validCsscode  && this.validCategory  && this.validStatus
            },
            validName(){
              return this.draft.name ? this.draft.name.length > 3 : false
            },
            validEmail(){
              return this.draft.email
            },

            // validFirstName(){
            //   return this.draft.first_name ? this.draft.first_name.length > 3 : false
            // },

            // validLastName(){
            //   return this.draft.last_name ? this.draft.last_name.length > 3 : false
            // },

            // validLogin(){
            //   return this.draft.login ? this.draft.login.length > 3 : false
            // },

            // validAddress2(){
            //   return this.draft.address_2 ? this.draft.address_2.length > 3 : false
            // },

            // validCsscode(){
            //     return this.draft.csscode
            // },
            // validCategory(){
            //     return this.draft.category
            // },
            // validStatus(){
            //     return this.draft.status
            // },
        }
    }
</script>
<template>
<div>
  <div class="slim-mainpanel">
    <div class="container">
        <breadcrumb-slim :position="position" :elements="elements"></breadcrumb-slim>
        <div class="section-wrapper">
          <label class="section-title">{{draft && draft.id ? trans('app.user.edit') : trans('app.user.add')}}</label>
          <p class="mg-b-20 mg-sm-b-40">A form with a label on top of each form control.</p>

          <!-- <div class="form-layout"> -->
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
              
            </div><!-- row -->

            <div class="form-layout-footer">
              <b-button :class="'bg-'+color.tx + 'bd-'+color.bd" @click="save" variant="primary">{{draft && draft.id ? trans('app.buttons.update') : trans('app.buttons.create')}}</b-button>
              <b-button @click="calcel" variant="secondary" >{{trans('app.buttons.close')}}</b-button>
            </div><!-- form-layout-footer -->
          <!-- </div> -->
          <!-- form-layout -->
          </b-container>
        </div><!-- section-wrapper -->
    </div>
  </div>
</div>
</template>
<style type="text/css">
  .bd-danger {
  border-color: #dc3545 !important; }
  .bg-danger {
  background-color: #dc3545 !important; }
</style>

<script>
    export default {
        data(){
            return{
              position:'User',
              draft: null,
              email:"",
                userGrupsList:[],
                elements:[
                { rute:'playfair/users', name:'Users'},
                ],
                statuses: [
                    { value: null, text: trans('app.common.select') },
                    { value: '1', text: trans('app.common.active') },
                    { value: '0', text: trans('app.common.inactive') },
                ],            
            }
        },
        created(){
            this.listUserGroups()
            if(this.$route.params.id){
            
                if (this.$store.getters.findUser(this.$route.params.id)) {
                    
                    this.draft = clone(this.$store.getters.findUser(this.$route.params.id))
                } else {

                    this.$store.dispatch('getUser', this.$route.params.id)
                        .then(response => {
                            this.draft = clone(this.$store.state.User.solo)
                        })
                }
            } else {
                this.newAds()
            }
        },
        methods:{
            listUserGroups(){
                this.$store.dispatch('listUserGroups')
            },
            save(){
                if (this.draft.id) {
                    this.update()
                } else{
                    this.store()
                }
                this.calcel()
            },
            calcel(){
              this.$router.push({name: 'users'})
                return
            },
            update(){
                var draft = this.draft
                var id = this.draft.id
                this.$store.dispatch('updateUser', { id: id, draft })
            },
            store(){
                this.$store.dispatch('storeUser', this.draft)
            },
            newAds(){
                this.draft = {
                    id: null,
                    name:'',
                    address:'',
                    email:'',
                    phone:null,
                    image:'',
                }
            }
        },
        computed:{

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
            color(){
              return this.$store.getters.getColor
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
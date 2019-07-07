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
                  <label class="form-control-label" :class="validName ? 'label-valid' : 'label-required'">{{trans('app.setting_group.name')}}: <span class="tx-danger">*</span></label>
                  <input type="text" v-model="draft.name" placeholder="Enter name" class="form-control">
                </div>
              </b-col><!-- col-4 -->
              <b-col class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label" :class="validIcon ? 'label-valid' : 'label-required'">{{trans('app.setting_group.icon')}}: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="icon" placeholder="Enter icon" v-model="draft.icon">
                </div>
              </b-col><!-- col-4 -->
              <b-col class="col-lg-4">
                <div class="form-group mg-b-10-force">
                  <label class="form-control-label">{{trans('app.setting_group.component')}}: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="address" placeholder="Enter component" v-model="draft.component">
                </div>
              </b-col><!-- col-8 -->
              <b-col class="col-lg-8">
                <div class="form-group">
                  <label class="form-control-label" :class="validTab ? 'label-valid' : 'label-required'">{{trans('app.setting_group.setting_tab_id')}}: <span class="tx-danger">*</span></label>
                  <b-form-select v-model="draft.setting_tab_id" :options="options" class=""/>
                </div>
              </b-col><!-- col-8 -->
               
            </div><!-- row -->

            <div class="form-layout-footer">
              <b-button type="submit" @click="save" variant="primary" :class="'bg-'+color.tx + ' bd-'+color.bd">{{draft && draft.id ? trans('app.buttons.update') : trans('app.buttons.create')}}</b-button>
              <b-button type="submit" @click="calcel" variant="secondary" >{{trans('app.buttons.close')}}</b-button>
            </div><!-- form-layout-footer -->
          <!-- </div> -->
          <!-- form-layout -->
          </b-container>
        </div><!-- section-wrapper -->
    </div>
  </div>
</div>
</template>

<script>
    export default {
        props: ['show', 'draft','position'],
        data(){
            return{
              email:"",
                elements:[
                { rute:'playfair/setting-group', name:'Setting'},
                ],
                options: [
                    { value: null, text: trans('app.common.select') },
                    { value: 1, text: trans('app.setting_group.tab1') },
                    { value: 2, text: trans('app.setting_group.tab2') },
                ]          
            }
        },
        created(){
            // this.listUserGroups()
            if(this.$route.params.id){
                if (this.$store.getters.findSettingGroup(this.$route.params.id)) {
                    this.draft = clone(this.$store.getters.findSettingGroup(this.$route.params.id))
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
            // listUserGroups(){
            //     this.$store.dispatch('listUserGroups')
            // },
            calcel(){
              this.$router.push({name: 'setting-group'})
                return
            },
            save(){
                if (this.draft.id) {
                    this.update()
                } else{
                    this.store()
                }
                this.calcel()
            },
            update(){
                var draft = this.draft
                var id = this.draft.id
                this.$store.dispatch('updateSettingGroup', { id: id, draft })
            },
            store(){
                this.$store.dispatch('storeSettingGroup', this.draft)
            },
            newAds(){
              this.draft = {
                  id: null,
                  setting_tab_id: '',
                  name: '',
                  icon: '',
                  component: '',
              }
            }
        },
        computed:{

            validForm(){
              return this.validTab && this.validName && this.validIcon
            },
            validTab(){
              return this.draft.setting_tab_id ? this.draft.setting_tab_id != '' : false
            },
            validName(){
              return this.draft.name ? this.draft.name != '' : false
            },
            validIcon(){
              return this.draft.icon ? this.draft.icon != '' : false
            },
            color(){
              return this.$store.getters.getColor
            },
        }
    }
</script>
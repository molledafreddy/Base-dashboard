<template>
<div>
  <b-modal v-model="show" :size="draft.type == 'html' ? 'lg' : ''" :title="draft.id ? trans('app.setting.edit') : trans('app.setting.add')" @hide="close">
    <b-container fluid>
     <b-row class="mb-1">
       <b-col><label :class="validParam ? 'label-valid' : 'label-required'">{{trans('app.setting.param')}}</label></b-col>
     </b-row>
     <b-row class="mb-1">
       <b-col><input type="text" v-model="draft.param" class="form-control" @keypress="changeParam()"></b-col>
     </b-row>
     <b-row class="mb-1">
       <b-col><label :class="validKey ? 'label-valid' : 'label-required'">{{trans('app.setting.key')}}</label></b-col>
     </b-row>
     <b-row class="mb-1">
       <b-col><input type="text" v-model="draft.key" class="form-control"></b-col>
     </b-row>
     <b-row class="mb-1">
       <b-col>
        <label :class="validType ? 'label-valid' : 'label-required'">{{trans('app.setting.type')}}</label></b-col>
     </b-row>
     <b-row class="mb-1">
       <b-col>
          <select class="form-control" v-model="draft.type">
            <option value="">Select an option</option>
            <option value="text">{{trans('app.setting.text')}}</option>
            <option value="number">{{trans('app.setting.number')}}</option>
            <option value="list">{{trans('app.setting.list')}}</option>
            <option value="html">{{trans('app.setting.html')}}</option>
            <option value="boolean">{{trans('app.setting.boolean')}}</option>
            <option value="longText">{{trans('app.setting.longText')}}</option>
            <option value="password">{{trans('app.setting.password')}}</option>
            <option value="image">{{trans('app.setting.image')}}</option>
            <option value="radioButton">{{trans('app.setting.radiobutton')}}</option>
          </select>
       </b-col>
     </b-row>
     <template v-if="draft.type == 'list'">
       <b-row class="mb-1">
         <b-col>
          <label :class="validOptions ? 'label-valid' : 'label-required'">
            {{trans('app.setting.options')}} <b v-if="! validOptions">{{trans('app.setting.invalid_options')}}</b>
          </label>
        </b-col>
       </b-row>
       <b-row class="mb-1">
         <b-col>
            <textarea v-model="draft.options" class="form-control"></textarea>
         </b-col>
       </b-row>
     </template>
     <b-row class="mb-1">
       <b-col>
        <label :class="validValue ? 'label-valid' : 'label-required'">
          {{trans('app.setting.value')}}
        </label>
      </b-col>
     </b-row>
     <b-row class="mb-1">
       <b-col>
            <input-type :setting="draft"></input-type>
       </b-col>
     </b-row>
    </b-container>
    <div slot="modal-footer" class="pull-right">
        <b-btn class="btn btn-outline-danger" :class="'bg-'+color.tx + 'bd-'+color.bd" @click="close"> {{trans('app.buttons.close')}}</b-btn>
        <b-btn class="btn btn-outline-primary" :class="'bg-'+color.tx + 'bd-'+color.bd" @click="save" :disabled="!validForm"> {{draft.id ? trans('app.buttons.update') : trans('app.buttons.create')}}</b-btn>
        <b-btn v-if="draft.id" :class="'bg-'+color.tx + 'bd-'+color.bd" class="btn btn-warning" @click="remove()" > {{draft.id ? trans('app.buttons.delete') : trans('app.buttons.delete')}}</b-btn>
    </div>
  </b-modal>
</div>
</template>

<script>
    export default {
        props: ['show', 'draft'],
        methods:{
            close(){
                this.$emit('close')
            },
            imageName(){
                if (this.images.length > 0) {
                    this.draft.image=this.images[0].url
                }
            },
            save(){
              var draft = this.draft
              console.log(draft);
              if (this.draft.id) {
                var id = this.draft.id
                this.$store.dispatch('updateSetting', { id: id, draft })
              } else {
                this.$store.dispatch('storeSetting', draft)
              }
                this.$emit('close')
            },
            remove(){
                this.$swal({
                  title: trans('app.common.delete_title'),
                  text: trans('app.common.delete_text') + this.draft.param +'?',
                  type: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: trans('app.common.delete_confirm'),
                  cancelButtonText: trans('app.common.0')
                }).then((result) => {
                  if (result.value) {
                    this.$store.dispatch('removeSetting', this.draft.id)
                    this.$emit('close')
                  }
                })
            },
            changeParam(){
              this.draft.key = this.toSnakeCase(this.draft.param)
            },
            toSnakeCase(value){
              if (value) {
                var s;
                s = value.replace(/[^\w\s]/g, "");
                s = s.replace(/\s+/g, " ");
                return s.toLowerCase().split(' ').join('_');
              }
            },
        },
        computed:{
            validForm(){
              return this.validParam && this.validValue && this.validType && this.validOptions
            },
            validParam(){
              return this.draft.param ? this.draft.param != '' : false
            },
            validKey(){
              return this.draft.key ? this.draft.key != '' : false
            },
            validValue(){
                return this.draft.value ? this.draft.value != '' : false
            },
            validType(){
              return this.draft.type ? this.draft.type != '' : false
            },
            validOptions(){
              return this.draft.type == 'list'
                ? (this.draft.options.split(",").indexOf("") === -1)
                : true
            },
            color(){
              return this.$store.getters.getColor
            },
        },
        watch:{
            draft:{
                handler(value){
                    if (value.type != 'list') {
                        value.options = ''
                    }
                },
                deep: true
            },
        }
    }
</script>
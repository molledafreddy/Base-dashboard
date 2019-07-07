<template>
    <div class="box box-solid box-danger" :class="loading ? 'box-loading' : ''">
      <div class="slim-mainpanel">
      <div class="container">
        <breadcrumb-slim :position="position"></breadcrumb-slim>
        <div class="section-wrapper">
          <p class="mg-b-20 mg-sm-b-40">Searching, ordering and paging goodness will be immediately added to the table, as shown in this example.</p>
          <div class="form-inline pull-left ">
            <button class="btn active tx-white" :class="'bg-'+color.tx" @click="create">
                <i class="fa fa-plus ">  </i>
            </button>
          </div>
          <form class="form-inline pull-right">
              <div class="form-group mx-sm-6 mb-2">
                  <input v-model="target"  class="form-control" placeholder="Type Search" />
              </div>
          </form>
          <center>
           <spinner v-if="loading" :size="200" color="#4469e8"/>
          </center>
          <div class="clearfix"></div>            
          <b-table ref="table" striped hover show-empty
                responsive
                :items="setting_group"
                @sort-changed="sortingChanged"
                :fields="fields"
                stacked="md"
                :filter="filter"
                :sort-by.sync="sortBy"
                :sort-desc.sync="sortDesc"
                empty-text="Cargando..."
                >
             <template slot="setting_tab_id" slot-scope="row">
                {{ trans('app.setting_group.tab' + row.item.setting_tab_id) }}
              </template>
              <template slot="Actions" slot-scope="row">
              <b-button @click="edit(row.item, row.index)" :class="'bg-'+color.tx + ' bd-'+color.bd" variant="primary" :title="trans('app.common.edit')"><i class="fa fa-edit fa-lg"></i></b-button>
              <b-button @click="remove(row.item, row.index)" :class="'bg-'+color.tx + ' bd-'+color.bd" variant="primary" :title="trans('app.common.delete')"><i class="fa fa-trash-o fa-lg"></i></i></b-button>
            </template>
        </b-table>
        <div class="box-footer text-center">
          <b-pagination
            :total-rows="totalRows"
            :per-page="perPage"
            align="center"
            v-model="currentPage"
            class="my-0"
            :class="'bd'+color.bd"
            @input="getSettingGroups"
            />
        </div>
        </div><!-- section-wrapper -->
      </div>
    </div>  
    </div>
</template>
<style type="text/css">
  .col-10{
    width: 10%;
  }
  .col-35{
    width: 35%;
  }
  .bd-danger {
  border-color: #dc3545 !important; }
  .bg-danger {
  background-color: #dc3545 !important; }
  .pge-link.btn-primary {
    background-color: #dd4b39 !important;
    border-color: #dd4b39 !important;}
</style>
<script>
    export default {
        watch:{
            target(){
                this.getSettingGroups()
            }
        },
        data(){
            return{
              position: trans('app.setting_group.title'),
                fields: [
                    { key: 'id', label: '#', sortable: true, 'class': 'col-10' },
                    { key: 'setting_tab_id', label: trans('app.setting_group.setting_tab_id'), sortable: true},
                    { key: 'name', label: trans('app.setting_group.name'), sortable: true},
                    { key: 'icon', label: trans('app.setting_group.icon'), sortable: true},
                    { key: 'component', label: trans('app.setting_group.component'), sortable: true},
                    { key: 'Actions', label: trans('app.common.actions')},
                ],
                currentPage: null,
                target: '',
                draft: {},
                currentIndex: null,
                // showEdit: false,               
                currentId: null,
                filter: null,
                items: null,
                sortBy: 'id',
                sortDesc: false,

            }
        },
        created(){
           this.getSettingGroups()
        },
        methods:{
            edit(setting_group, index){
                this.draft = clone(setting_group)
                this.currentIndex = index
                this.$router.push({path:'setting-group-edit/' + this.draft.id, params:{draft:this.draft}})
            },
            create(){
                this.draft = {
                    id: null,
                    setting_tab_id: '',
                    name: '',
                    icon: '',
                    component: '',
                }
                this.$router.push({path:'setting-group-create'})
            },
            getSettingGroups(){
                let params = {page: this.currentPage, target: this.target, orderBy: this.sortBy, desc: this.sortDesc}
                this.$store.dispatch('getSettingGroups', params)
            },
            close(){
              this.showEdit = false
            },
            remove(item, index){
                this.$swal({
                  title: trans('app.common.delete_title'),
                  text: trans('app.common.delete_text') + item.name +'?',
                  type: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: trans('app.common.delete_confirm'),
                  cancelButtonText: trans('app.common.0')
                }).then((result) => {
                  if (result.value) {
                    this.$store.dispatch('removeSettingGroup', item.id)
                  }
                })
            },
            sortingChanged (ctx) {
                if (ctx.sortBy) {
                    this.sortBy = ctx.sortBy
                    this.sortDesc = ctx.sortDesc
                    this.currentPage = 1
                    this.getSettingGroups()
                }
            },
        },
        computed:{

            setting_group(){
                return this.$store.state.SettingGroup.setting_groups
            },
            current_page(){
                return this.$store.state.SettingGroup.currentPage
            },
            totalRows(){
                return this.$store.state.SettingGroup.totalRows
            },
            perPage(){
                return this.$store.state.SettingGroup.perPage
            },
            loading(){
               return this.$store.state.SettingGroup.loading
            },
            color(){
              return this.$store.getters.getColor
            },
        }
    }
</script>

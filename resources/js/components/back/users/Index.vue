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
          <spinner v-if="loading" :size="200" :color="color.code"/>
          </center>
          <div class="clearfix"></div>            
          <b-table ref="table" striped hover show-empty
                responsive
                :items="user"
                @sort-changed="sortingChanged"
                :fields="fields"
                stacked="md"
                :filter="filter"
                :sort-by.sync="sortBy"
                :sort-desc.sync="sortDesc"
                empty-text="Cargando..."
                >
            <template slot="created_at"  slot-scope="row">
                {{row.item.created_at.substring(0,10)}}
            </template>
            <template slot="Actions" slot-scope="row">
              <b-button class="btn active" :class="'bg-'+color.tx + ' bd-'+color.bd"  @click="edit(row.item, row.index)" variant="primary" :title="trans('app.common.edit')"><i class="fa fa-edit fa-lg"></i></b-button>
              <b-button class="btn active" :class="'bg-'+color.tx + ' bd-'+color.bd" @click="remove(row.item, row.index)" variant="primary" :title="trans('app.common.delete')"><i class="fa fa-trash-o fa-lg"></i></i></b-button>
            </template>
        </b-table>

        <div class="box-footer text-center">
          <b-pagination
            :total-rows="totalRows"
            :per-page="perPage"
            :color="color.code"
            variant="black"
            align="center"
            v-model="currentPage"
            class="my-0"
            :class="'bd-'+color.bd + ' bg'+color.tx"
            @input="getUsers"
            />
        </div>
        </div><!-- section-wrapper -->
      </div>
    </div>
	</div>
</template>
<style type="text/css">
  .column-witch{
    width: 150px;
    text-align: center;
  }
  .bd-danger {
  border-color: #dc3545 !important; }
  .bg-danger {
  background-color: #dc3545 !important; }
  .bg-black {
  background-color: rgba(0, 0, 0, 0.9) !important;}
  .bd-black {
  border-color: #181818 !important;}
  .bd-success {
  border-color: #23BF08 !important;  }
  .page-link.btn-primary {
    background-color: #dd4b39 !important;
    /*border-color: #dd4b39 !important;*/
  }

</style>

<script>

    export default {
		watch:{
			target(){
            	this.getUsers()
            }
		},
		data(){
			return{
        position:trans('app.user.title'),
				showModal: false,
        showEdit: false,
				currentPage: 1,
				currentIndex: null,
                currentId: null,
			    filter: null,
                target: '',
                draft: {},
				sortBy: null,
      			sortDesc: false,
                items: null,
                fields: [
        			{
        			 key: 'name', label: trans('app.user.name'), sortable: true,
        			},
        			{
        			 key: 'email', label: trans('app.user.email'), sortable: true,
        			},
              {
               key: 'phone', label: trans('app.user.phone'), sortable: true,
              },
              {
               key: 'address', label: trans('app.user.address'), sortable: true,
              },
        			{
        			 key: 'created_at', label: trans('app.user.created_at'), sortable: true , 'class': 'column-witch col-3',
        			},
              {
        			 key: 'Actions', label: trans('app.common.actions'), 'class': 'column-witch col-3',
        			}
      			],
			}
		},
		created(){
      this.getUsers()
    },
		methods:{
      edit(user, index){
        this.draft = clone(user)
        this.currentIndex = index
        // this.showEdit = true
        this.$router.push({path:'user-edit/' + this.draft.id, params:{draft:this.draft}})
      },
      create(){
          this.draft = {
              id: null,
              name:'',
              address:'',
              phone:'',
              user_group_id:'',
              image:'',
              email:'',
          }
          this.$router.push({path:'user-create'})  
      },
			search(){
        this.current = 1;
        this.getUsers(this.current);
      },
			onFiltered (filteredItems) {
	      // Trigger pagination to update the number of buttons/pages due to filtering
	      this.totalRows = filteredItems.length
	      this.currentPage = 1
	    },
      getUsers(){
          let params = {page: this.currentPage, target: this.target, orderBy: this.sortBy, desc: this.sortDesc}
          this.$store.dispatch('getUsers', params)
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
              this.$store.dispatch('removeUser', item.id)
            }
          })
      },
      sortingChanged (ctx) {
				if (ctx.sortBy) {
            this.sortBy = ctx.sortBy
            this.sortDesc = ctx.sortDesc
            this.currentPage = null
            this.getUser()
        }
     }
		},
    computed:{
      user(){
        return this.$store.state.User.users
      },
      current_page(){
          return this.$store.state.User.currentPage
      },
      totalRows(){
          return this.$store.state.User.totalRows
      },
      perPage(){
          return this.$store.state.User.perPage
      },
      loading(){
         return this.$store.state.User.loading
      },
      color(){
        return this.$store.getters.getColor
      },

    }
	}
</script>
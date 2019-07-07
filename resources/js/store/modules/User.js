let state = {
    users: [],
    userGroups: [],
    perPage: null,
    solo: null,
    currentPage: 1,
    lastPage: null,
    totalRows: null,
    list: [],
    cities: [],
    states: [],
    loading:false,
    authUser: null,
    defaulLang:{},
}

let getters = {
        findUser(state){
            console.log(state.users)
            return function(id){
                let user = state.users.find(user => user.id == id)
                return user;
            }
        },
}

let actions = {
    getUsers(context, params){

        context.state.loading = true
        axios.get('/admin-panel/user?page=' + params.page + '&search=' + params.target + '&orderBy=' + params.orderBy + '&desc=' + params.desc)
            .then(response => {
                context.commit('getUsers', {data: response.data})
                context.state.loading = false
            })
            .catch(error => {
                Vue.toasted.show(error.message, {icon: 'exclamation-triangle', type: 'error'})
                context.state.loading = false
            })
    },

    getUser(context, id){
        context.state.loading = true
        return new Promise((resolve, reject) => {
        axios.get('/admin-panel/user-edit/'+ id)
            .then(response => {
                context.commit('getUser', {data: response.data})
                context.state.loading = false
                resolve()
            })
            .catch(error => {
                Vue.toasted.show(error.message, {icon: 'exclamation-triangle', type: 'error'})
                context.state.loading = false
                reject()
            })
        })
    },

    storeUser(context, payload){

        context.state.loading = true
        axios.post('/admin-panel/user', payload)
            .then(response => {
                let newUser = {
                    id: response.data.user.id,
                    name:payload.name,
                    phone:payload.phone,
                    address:payload.address,
                    user_group_id: response.data.user_group_id,
                    email: payload.email,
                    created_at: response.data.user.created_at,
                }
                Vue.toasted.show(response.data.message, {icon: 'plus', type: 'success'})
                context.commit('storeUser', newUser)
                context.state.loading = false
            })
            .catch(error => {
                Vue.toasted.show(error.message, {icon: 'exclamation-triangle', type: 'error'})
                context.state.loading = false
            })
    },

    updateUser(context, payload){
        context.state.loading = true
        axios.put('/admin-panel/user/' + payload.id, payload.draft)
            .then(response => {
                if (payload.statusAvatar ) {
                  payload.draft.image= response.data.user.image
                }
                Vue.toasted.show(response.data.message, {icon: 'pencil', type: 'info'})
                context.commit('updateUser', payload)
                context.state.loading = false
            })
            .catch(error => {
                Vue.toasted.show(error.message, {icon: 'exclamation-triangle', type: 'error'})
                context.state.loading = false
            })
    },

    updateAvatar(context, payload){
        context.state.loading = true
        axios.put('/admin-panel/avatar/' + payload.id, payload.draft)
            .then(response => {
                Vue.toasted.show(response.data.message, {icon: 'pencil', type: 'info'})
                context.commit('updateAvatar', payload)
                context.state.loading = false
            })
            .catch(error => {
                Vue.toasted.show(error.message, {icon: 'exclamation-triangle', type: 'error'})
                context.state.loading = false
            })
    },

    removeUser(context, id){
        context.state.loading = true
        axios.delete('/admin-panel/user/' + id)
            .then(response => {
                context.commit('removeUser', id)
                Vue.toasted.show(response.data.message, {icon: 'trash-o', type: 'success'})
                context.state.loading = false
            })
            .catch(error => {
                Vue.toasted.show(error.message, {icon: 'exclamation-triangle', type: 'error'})
                context.state.loading = false
            })

    },

    listUser(context){
        axios.get('/admin-panel/userList')
            .then(response => {
                context.commit('listUsers', {data: response.data})
            })
            .catch(error => {
                Vue.toasted.show(error.message, {icon: 'exclamation-triangle', type: 'error'})
            })
    },

    listUserGroups(context){
        axios.get('/admin-panel/userGroupList')
            .then(response => {
                context.commit('listUserGroups', {data: response.data})
            })
            .catch(error => {
                Vue.toasted.show(error.message, {icon: 'exclamation-triangle', type: 'error'})
            })
    },
    listCities(context, state_id){
                console.log(state_id)
        axios.get('/admin-panel/cityList?state_id=' + state_id)
            .then(response => {
                context.commit('listCities', {data: response.data})
            })
            .catch(error => {
                Vue.toasted.show(error.message, {icon: 'exclamation-triangle', type: 'error'})
            })
    },
    listStates(context){
        axios.get('/admin-panel/stateList')
            .then(response => {
                context.commit('listStates', {data: response.data})
            })
            .catch(error => {
                Vue.toasted.show(error.message, {icon: 'exclamation-triangle', type: 'error'})
            })
    },
    setAuthUser(context, user){
        context.commit('setAuthUser', user)
    },

    getDefaulLang(context){
      alert("llego")
      axios.get('admin/lang/')
        .then(response => {
          console.log(response)
          context.commit('getDefaulLang', {data: response.data})
        })
        .catch(error => {
            Vue.toasted.show(error.message, {icon: 'exclamation-triangle', type: 'error'})
        })
    },
    
}

let mutations = {
    getUsers(state, {data}){
        state.currentPage = data.current_page
        state.lastPage = data.last_page
        state.totalRows = data.total
        state.perPage = data.per_page
        state.users = data.data;
    },

    getUser(state, {data}){
        state.solo = data;
    },

    storeUser(state, newUser){
        state.users.unshift(newUser);
    },

    updateUser(state, {id, draft}){
        let index = state.users.findIndex(user => user.id == id);
        state.users.splice(index, 1, draft);
    },

    removeUser(state, id)    {
        let index = state.users.findIndex(user => user.id == id);
        state.users.splice(index, 1);
    },

    listUsers(state, data){
        state.list = data.data;
    },
    listCities(state, data){
        state.cities = data.data;
    },
    listStates(state, data){
        state.states = data.data;
    },
    listUserGroups(state, data){
        state.userGroups = data.data;
    },
    setAuthUser(state, user){
        state.authUser = user
    },

    getDefaulLang(state, {list} ){
         return state.defaulLang = list;
    },

}

export default {
    state,
    getters,
    actions,
    mutations
}
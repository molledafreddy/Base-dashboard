let state = {
    setting_groups: [],
    perPage: null,
    currentPage: 1,
    lastPage: null,
    totalRows: null,
    list: [],
    loading: false,
    solo: null,
}

let getters = {
        findSettingGroup(state){
            return function(id){
                let setting_group = state.setting_groups.find(setting_group => setting_group.id == id)
                return setting_group;
            }
        },
}

let actions = {
    getSettingGroups(context, params){
        context.state.loading = true
        axios.get('/admin-panel/settingGroup?page=' + params.page + '&search=' + params.target + '&orderBy=' + params.orderBy + '&desc=' + params.desc)
            .then(response => {
                context.commit('getSettingGroups', {data: response.data})
                context.state.loading = false
            })
            .catch(error => {
                Vue.toasted.show(error.message, {icon: 'exclamation-triangle', type: 'error'})
                context.state.loading = false
            })
    },

    getSettingGroup(context, id){
        context.state.loading = true
        return new Promise((resolve, reject) => {
        axios.get('/admin-panel/setting-group-edit/' + id)
            .then(response => {
                context.commit('getSettingGroup', {data: response.data})
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

    storeSettingGroup(context, payload){
        context.state.loading = true
        axios.post('/admin-panel/settingGroup', payload)
            .then(response => {
                let newSettingGroup = {
                    id: response.data.id,
                    setting_tab_id: payload.setting_tab_id,
                    name: payload.name,
                    icon: payload.icon,
                }
                Vue.toasted.show(response.data.message, {icon: 'plus', type: 'success'})
                context.commit('storeSettingGroup', newSettingGroup)
                context.state.loading = false
            })
            .catch(error => {
                Vue.toasted.show(error.message, {icon: 'exclamation-triangle', type: 'error'})
                context.state.loading = false
            })
    },

    updateSettingGroup(context, payload){
        context.state.loading = true
        axios.put('/admin-panel/settingGroup/' + payload.id, payload.draft)
            .then(response => {
                Vue.toasted.show(response.data.message, {icon: 'pencil', type: 'info'})
                context.commit('updateSettingGroup', payload)
                context.state.loading = false
            })
            .catch(error => {
                Vue.toasted.show(error.message, {icon: 'exclamation-triangle', type: 'error'})
                context.state.loading = false
            })
    },

    removeSettingGroup(context, id){
        context.state.loading = true
        axios.delete('/admin-panel/settingGroup/' + id)
            .then(response => {
                context.commit('removeSettingGroup', id)
                Vue.toasted.show(response.data.message, {icon: 'trash', type: 'error'})
                context.state.loading = false
            })
            .catch(error => {
                Vue.toasted.show(error.message, {icon: 'exclamation-triangle', type: 'error'})
                context.state.loading = false
            })

    },
    getSettingGroup(state, {data}){
        state.solo = data;
    },
}

let mutations = {
    getSettingGroups(state, {data}){
        state.currentPage = data.current_page
        state.lastPage = data.last_page
        state.totalRows = data.total
        state.perPage = data.per_page
        state.setting_groups = data.data;
    },

    getSettingGroup(state, {data}){
        state.solo = data;
    },

    storeSettingGroup(state, newSettingGroup){
        state.setting_groups.unshift(newSettingGroup);
    },

    updateSettingGroup(state, {id, draft}){
        let index = state.setting_groups.findIndex(setting_group => setting_group.id == id);
        state.setting_groups.splice(index, 1, draft);
    },

    removeSettingGroup(state, id)    {
        let index = state.setting_groups.findIndex(setting_group => setting_group.id == id);
        state.setting_groups.splice(index, 1);
    },

    listSettingGroups(state, data){
        state.list = data.data;
    },
}

export default {
    state,
    getters,
    actions,
    mutations
}
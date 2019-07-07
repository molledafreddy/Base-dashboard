let state = {
    settings: [],
    solo: null,
    loading: false,
}

let getters = {
        findSetting(state){
            return function(id){
                let setting = state.settings.find(setting => setting.id == id)
                return setting;
            }
        },
}

let actions = {
    getSettings(context, params){
        context.state.loading = true
        axios.get('/admin-panel/setting?tab=' + params.tab + '&key=' + params.key )
            .then(response => {
                context.commit('getSettings', {data: response.data})
            })
            .catch(error => {
                Vue.toasted.show(error.message, {icon: 'exclamation-triangle', type: 'error'})
            })
    },

    getSetting(context, key){
        context.state.loading = true
        axios.get('/admin-panel/setting/' + key)
            .then(response => {
                context.commit('getSetting', {data: response.data})
            })
            .catch(error => {
                Vue.toasted.show(error.message, {icon: 'exclamation-triangle', type: 'error'})
            })
    },


    storeSetting(context, payload){
        context.state.loading = true
        axios.post('/admin-panel/setting', payload)
            .then(response => {
                let newSetting = {
                    id: response.data.id,
                    setting_group_id: payload.setting_group_id,
                    param: payload.param,
                    value: payload.value,
                }
                Vue.toasted.show(response.data.message, {icon: 'plus', type: 'success'})
                //context.commit('storeSetting', newSetting)
            })
            .catch(error => {
                Vue.toasted.show(error.message, {icon: 'exclamation-triangle', type: 'error'})
            })
    },

    updateSetting(context, payload){
        context.state.loading = true
        axios.put('/admin-panel/setting/' + payload.id, payload.draft)
            .then(response => {
                console.log(response)
                Vue.toasted.show(response.data.message, {icon: 'pencil', type: 'info'})
                context.state.loading = false
                //context.commit('updateSetting', payload)
            })
            .catch(error => {
                Vue.toasted.show(error.message, {icon: 'exclamation-triangle', type: 'error'})
                context.state.loading = false
            })
    },

    updatePanel(context, payload){
        context.state.loading = true
        axios.put('/admin-panel/settingAll/' + payload.id, payload)
            .then(response => {
                Vue.toasted.show(response.data.message, {icon: 'pencil', type: 'info'})
                //context.commit('updateSetting', payload)
                context.state.loading = false
            })
            .catch(error => {
                Vue.toasted.show(error.message, {icon: 'exclamation-triangle', type: 'error'})
                context.state.loading = false
            })
    },

    removeSetting(context, id){
        context.state.loading = true
        axios.delete('/admin-panel/setting/' + id)
            .then(response => {
                context.commit('removeSetting', id)
                Vue.toasted.show(response.data.message, {icon: 'trash', type: 'error'})
            })
            .catch(error => {
                Vue.toasted.show(error.message, {icon: 'exclamation-triangle', type: 'error'})
            })

    },

    listSettings(context){
        context.state.loading = true
        axios.get('/admin-panel/settingList')
            .then(response => {
                context.commit('listSettings', {data: response.data})
            })
            .catch(error => {
                Vue.toasted.show(error.message, {icon: 'exclamation-triangle', type: 'error'})
            })
    },
}

let mutations = {
    getSettings(state, {data}){
        state.settings = data;
        state.loading = false
    },

    getSetting(state, {data}){
        state.solo = data;
        state.loading = false
    },

    storeSetting(state, newSetting){
        state.settings.unshift(newSetting);
        state.loading = false
    },

    updateSetting(state, {id, draft}){
        let index = state.settings.findIndex(setting => setting.id == id);
        state.settings.splice(index, 1, draft);
        state.loading = false
    },

    removeSetting(state, id)    {
        let index = state.settings.findIndex(setting => setting.id == id);
        state.settings.splice(index, 1);
        state.loading = false
    },
}

export default {
    state,
    getters,
    actions,
    mutations
}
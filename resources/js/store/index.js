import Vue from 'vue'
import Vuex from 'vuex'
import Landing from './modules/StoreLanding.js'
import Session from './modules/Session.js'
import SettingGroup from './modules/SettingGroup.js'
import Setting from './modules/Setting.js'
import createPersistedState from 'vuex-persistedstate'
import * as Cookie from 'js-cookie'

import User from './modules/User.js'

Vue.use(Vuex)

let store = new Vuex.Store({
    modules:{
        Landing,
        Session,
        User,
        SettingGroup,
        Setting,

    },plugins: [
         createPersistedState({
             paths: ['Session.session','Session.lang','Session.defaultLang','Session.color'],
             getState: (key) => Cookie.getJSON(key), 
             setState: (key, state) => Cookie.set(key, state, { expires: 1, secure: false })
         })
      ]   
})

export default store;
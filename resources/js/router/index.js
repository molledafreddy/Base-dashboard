import Vue from 'vue'
import Router from 'vue-router'

//front
import IndexFront from '../components/front/Index.vue'

//back
import IndexBack from '../components/back/Home.vue'
import Dashboard from '../components/back/Dashboard.vue'
import IndexUser from '../components/back/users/Index.vue'
import CreateUser from '../components/back/users/Create.vue'
import Profile from '../components/back/profile/Index.vue'
import SettingGroup from '../components/back/setting_groups/Index.vue'
import CreateSettingGroup from '../components/back/setting_groups/Create.vue'
import Config from '../components/back/settings/Index.vue'

//auth
import login from '../components/auth/login.vue';
import setpassword from '../components/auth/setPassword.vue';
import resetpassword from '../components/auth/resetpassword.vue';


Vue.use(Router)

Vue.component('login',login);
Vue.component('resset-password',resetpassword);

let router = new Router({
	mode: 'history',
	hashbang: false,
	routes: [

		{ 
	        path: '/login/',
	        name: 'login',
	        component: login
	    },
	    { 
	        path: '/password/reset/',
	        name: 'setpassword',
	        component: setpassword
	    },
	    { 
             path: '/password/reset/:hash',
             name: 'resetpassword',
             component: resetpassword
        },
	    {
			path: '/front',
			component: IndexFront,
			children: [
				{
					path: '',
					component: Dashboard
				},
				// {
				// 	path: 'users',
				// 	component: User
				// },
			]
		},
		{
			path: '/admin',
			component: IndexBack,
			children: [
				{
					path: '',
					component: Dashboard
				},
				{
					path: 'dashboard',
					component: Dashboard
				},
				{
					name: 'users',
					path: 'users/',
					component: IndexUser					
				},
				{
					name: 'profile',
					path: 'profile',
					component: Profile					
				},
				{
					name: 'user-create',
					path: 'user-create',
					component: CreateUser,
				},
				{
					name: 'user-edit',
					path: 'user-edit/:id',
					component: CreateUser,
				},
				{
					name: 'setting-group',
					path: 'setting-group',
					component: SettingGroup
				},
				
				{
					name: 'setting-group-create',
					path: 'setting-group-create',
					component: CreateSettingGroup,
				},
				{
					name: 'setting-group-edit',
					path: 'setting-group-edit/:id',
					component: CreateSettingGroup,
				},
				{
					name: 'settings',
					path: 'configuration',
					component: Config
				},
			]
		},
		{
			path: '*',
			component:
			{
				template : '<h1>Error 404</h1>'
			}
		},
	]
})


export default router
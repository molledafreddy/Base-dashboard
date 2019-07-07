export default {
  state: {
    lang:{},
    session:{},
    defaultLang:{},
    color:{},

  },actions:{
        setSession({ commit },user){
           commit('setSession',{ list:user});
        },
        setLangSession({ commit },key){           
           commit('setLangSession',{list: key});
        },
        setColor({ commit },value){
          console.log(value)
          if (value== 'danger') {
                list={
                  bg:'firewatch',
                  tx:'danger',
                  bd:'danger',
                  home:'black',
                  code:'#df0b35',
                }

              }else if(value== 'black'){
                list={
                  bg:'royal',
                  tx:'black',
                  bd:'black',
                  home:'white',
                  code:'#0a0a09',
                }
              }           
           commit('setColor',{list: list});
        },
        getLangs(context, key){
          axios.get('/lang/' + key)
            .then(response => {
            })
            .catch(error => {
                Vue.toasted.show(error.message, {icon: 'exclamation-triangle', type: 'error'})
            })
        },

        getColor(context, key){
          axios.get('/admin-panel/setting/color')
            .then(response => {
              let list={}
              console.log(response.data.value)
              if (response.data.value== 'danger') {
                list={
                  bg:'firewatch',
                  tx:'danger',
                  bd:'danger',
                  home:'black',
                  code:'#df0b35',
                }

              }else if(response.data.value== 'black'){
                list={
                  bg:'royal',
                  tx:'black',
                  bd:'black',
                  home:'white',
                  code:'#0a0a09',
                }
              }else if(response.data.value== 'success'){
                list={
                  bg:'teal-love',
                  tx:'success',
                  bd:'success',
                  home:'white',
                  code:'#00d10f',
                }
              }else if(response.data.value== 'warning'){
                list={
                  bg:'dance',
                  tx:'warning',
                  bd:'warning',
                  home:'white',
                  code:'#f69a00',
                }

              }else if(response.data.value== 'purple'){
                list={
                  bg:'flickr',
                  tx:'purple',
                  bd:'purple',
                  home:'white',
                  code:'#8000c2',
                }
                
              }else if(response.data.value== 'blue dark'){
                list={
                  bg:'grandeur',
                  tx:'info',
                  bd:'info',
                  home:'white',
                  code:'#171e63',
                }
                
              }else if(response.data.value== 'pink'){
                list={
                  bg:'pink',
                  tx:'pink',
                  bd:'pink',
                  home:'white',
                  code:'#f30089',
                }
                
              }
              else if(response.data.value== 'blue'){
                list={
                  bg:'primary',
                  tx:'primary',
                  bd:'primary',
                  home:'white',
                  code:'#426ce9',
                }
                
              }
              
                
              context.commit('setColor',{list: list});
            })
            .catch(error => {
                Vue.toasted.show(error.message, {icon: 'exclamation-triangle', type: 'error'})
            })
        },

        getDefaultLang(context){
          axios.get('admin/lang/')
            .then(response => {
              console.log(response)
              context.commit('getDefaultLang', {data: response.data})
            })
            .catch(error => {
                Vue.toasted.show(error.message, {icon: 'exclamation-triangle', type: 'error'})
            })
        },
     

    },getters:{
        getSession: state => {
            return state.session;
        },
        getColor: state => {
            return state.color;
        },
        getLangSession: state => {
            return state.lang;
        },
        getDefaultLang(state, {list} ){
         return state.defaultLang;
      },
    },mutations:{
      setSession(state,{ list }){
         return state.session = list;
          
      },
      setLangSession(state, {list} ){
         return state.lang = list;
      },
      setColor(state, {list} ){
         return state.color = list;
      },
      getDefaultLang(state, {list} ){
         return state.defaultLang = list;
      },
      logout(state){
        state.session={};
      },

    }
}
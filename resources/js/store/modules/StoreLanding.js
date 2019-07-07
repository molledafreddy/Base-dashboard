export default {
  state: {
    contents:{}
  },actions:{
        listComponents({ commit }){
            axios.get('/api/getSection').then((res)=>{
                commit('setContents' , { list: res.data.data})
                //console.log(res.data.data);
            }).catch((err)=>{
                console.log(error.data);
            })
        },
        listComponentbyId({ commit },section){
            axios.get('api/getComponent/'+section).then((res)=>{
                commit('setContentsbyId' , { list: res.data.data})
                //console.log(res.data.data);
            }).catch((err)=>{
                console.log(error.data);
            })
        },
        saveComponent({ commit },objContent){
             axios.post('api/updateComponent/'+objContent.id,{objContent,'_method':'PUT'}).then((res)=>{
                if(res.data.oper==true){
                    commit('SetContentbyId',{ objcomponent: objContent});
                }                
            }).catch((err)=>{
                console.log(error.data);
            })
        },removeComponent({ commit },objComponent){
            var idcomponent=objComponent.idcomponent;
            axios.post('api/deleteComponent/'+idcomponent,{'_method':'DELETE'}).then((res)=>{
                if(res.data.oper==true){
                    commit('deleteContentbyId',objComponent);
                }                
            }).catch((err)=>{
                console.log(error.data);
            })
        }
    },getters:{
         getComponents: (state) => (sectionid) => {
             var result='';
             for(var i in state.contents){
                if(state.contents[i].id==sectionid){
                    result=state.contents[i]
                    break;
                }
             }
             return result;
        }

    },mutations:{
      setContents(state,{ list }){
         return state.contents = list
     },setContentsbyId(state,{ list }){
         return state.contents.push(list);
     },
     SetContentbyId(state,{ objcomponent }){
        for(var i in state.contents){
            if(state.contents[i].id==objcomponent.section_id){
                var listcomponents=state.contents[i].components;
                for(var a in listcomponents){
                    if(listcomponents[a].id==objcomponent.id){
                        var button_detail=listcomponents[a]['detailbutton'];
                        Vue.set(listcomponents[a], 'description', objcomponent.description);
                        Vue.set(listcomponents[a], 'img', objcomponent.img);
                        Vue.set(listcomponents[a], 'title', objcomponent.title);
                        Vue.set(button_detail, 'button_name', objcomponent.detailbutton.button_name);
                        break;

                    }
                }
            }
        }
     },deleteContentbyId(state,objComponent){
        var sectionid=objComponent.section;
        var componentid=objComponent.idcomponent;
        for(var i in state.contents){
            if(state.contents[i].id==sectionid){
                var listcomponents=state.contents[i].components;
                for(var a in listcomponents){
                    if(listcomponents[a].id==componentid){
                        Vue.delete(listcomponents,a);
                        break;
                    }
                }
            }
        }
     },deleteContent(state,section){
        for(var i in state.contents){
            if(state.contents[i].id==section){
                Vue.delete(state.contents,i);
            }
        }
     }
  }
}
import Vue from 'vue'
import Vuex from 'vuex'
Vue.use(Vuex)


export default new Vuex.Store({
            state: {
                counter: 1001,
        deleteModalObj: {
            showDeleteModal: false,
            deleteUrl: ' ',
            data: null,
            deletingIndex: -1,
            isDeleted: false,

        },


            },
            getters:{
                     getCounter(state){
                        //  if(state.counter>1000) 'This is huge with lot of counters'
                         return state.counter;

                     },
                getDeleteModalObj(state) {
                    return state.deleteModalObj
                },
            },
            mutations:{
                increaseCounter(state,data){
                   state.counter+=data;
                },
                setDeleteModal(state, data) {

                    state.deleteModalObj.isDeleted=true;
                },
                setdeletingModalObj(state,data){
                    state.deleteModalObj=data;
                }
            },
            actions:{
                increasetheCounter({commit}, data) {
                    commit('increaseCounter',data);


                },
                clickChange(){
                    console.log('Changed');
                }
            }

        })

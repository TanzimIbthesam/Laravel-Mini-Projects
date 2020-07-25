import Vue from 'vue'
import Vuex from 'vuex'
Vue.use(Vuex)


export default new Vuex.Store({
            state: {
                counter: 1001,


            },
            getters:{
                     getCounter(state){
                        //  if(state.counter>1000) 'This is huge with lot of counters'
                         return state.counter;

                     }
            },
            mutations:{
                increaseCounter(state,data){
                   state.counter+=data;
                }
            },
            actions:{
                increasetheCounter({commit}, data) {
                    commit('increaseCounter',data);


                }
            }

        })

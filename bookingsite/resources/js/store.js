export default {
    state: {
        lastSearch: {
            from: null,
            to: null
        },
        basket:{
            items:[]
        }
    },
    mutations: {
        setLastSearch(state, payload) {
            state.lastSearch = payload;
        },
        addtoBasket(state,payload){
           state.basket.items.push(payload);
        },
        removeFromBasket(state,payload){
            state.basket.items=state.basket.items.filter(item=>item.bookable.id !==payload);

        }
    },
    actions:{
        setLastSearch(context,payload){
            context.commit('setLastSearch',payload);
            localStorage.setItem('lastSearch',JSON.stringify(payload));
        },
        localStorageState(context){
            const lastSearch=localStorage.getItem("lastSearch");
            if(lastSearch){
                context.commit('setLastSearch',JSON.parse(lastSearch));
            }


        }
    },
    getters:{
        itemsinBasket:state=>state.basket.items.length,
           inBasketAlready(state){

                return function(id){
                      return state.basket.items.reduce((result,item)=>
                 result || item.bookable.id === id
             ,false)
                }
    }
    },

};

const state = {
    user: null,
    userStatus: null,
    // friendButtonText:null
};
const getters = {
    user: state => {
        return state.user;
    },
    friendship:state=>{
        return state.user.data.attributes.friendship;
    },
    friendButtonText:(state,getters,rootState)=>{
          if (getters.friendship === null) {
            //   commit('sendButtonText', 'Add Friend');
            return 'Add Friend';
          } else if (getters.friendship.data.attributes.confirmed_at === null) {
            //   commit('sendButtonText', 'Pending Friend Requests');
            return 'Pending Friend Requests';
          }
    //    return state.friendButtonText;
    }

};
const actions = {

    fetchUser({commit, dispatch
    },userId) {
            commit('setUserStatus', 'loading');
       axios.get('/api/users/' + userId)
           .then(res => {
               commit('setUser',res.data);
               commit('setUserStatus','success');
            //    dispatch('setFriendButton');

           })
           .catch(error => {
              commit('setUserStatus', 'error');

           });


    },
    sendFriendRequest({commit,state},friendId){
         commit('sendButtonText','loading');
           axios.post('/api/friend-request', {
               'friend_id':friendId
           })
           .then(res=>{
              commit('setUserFriendship', res.data);
           })
           .catch(error=>{
                // commit('sendButtonText', 'Add Friend');
           })
           ;

    },
    // setFriendButton({commit,getters}){
    //     if(getters.friendship===null){
    //         commit('sendButtonText', 'Add Friend');
    //     } else if (getters.friendship.data.attributes.confirmed_at === null) {
    //          commit('sendButtonText', 'Pending Friend Requests');
    //     }
    // }

};
const mutations = {
    setUser(state, user) {
        state.user = user;
    },
    setUserFriendship(state, friendship) {
        state.user.data.attributes.friendship=friendship;
    },
    setUserStatus(state, status) {
        state.userStatus = status;
    },
    sendButtonText(state,text){
        state.friendButtonText=text;
    }

};
export default {
    state,
    getters,
    actions,
    mutations
}

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
          } else if (getters.friendship.data.attributes.confirmed_at === null && getters.friendship.data.attributes.friend_id !== rootState.User.user.data.user_id) {

            return 'Pending Friend Requests';
          } else if (getters.friendship.data.attributes.confirmed_at !== null){
              return '';
          }
             return 'Accept';
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
        //  commit('sendButtonText','loading');
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
    acceptFriendRequest({commit,state},userId){

           axios.post('/api/friend-request-response', {
               'user_id':userId,
               'status':1,
           })
           .then(res=>{
              commit('setUserFriendship', res.data);
           })
           .catch(error=>{
                // commit('sendButtonText', 'Add Friend');
           })
           ;

    },


      ignoreFriendRequest({
          commit,
          state
      }, userId) {

          axios.delete('/api/friend-request-response/delete', {
                 data: {
                     'user_id': userId
                 }
              })
              .then(res => {
                  commit('setUserFriendship', null);
              })
              .catch(error => {

              });

      },


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
    // sendButtonText(state,text){
    //     state.friendButtonText=text;
    // }

};
export default {
    state,
    getters,
    actions,
    mutations
}

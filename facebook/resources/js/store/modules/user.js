const state={
user:null,
userStatus:null,

};
const getters={
    authUser:state=>{
        return state.user;
    }

};
const actions={
 fetchAuthUser({commit,state}){
        axios.get('/api/auth-user')
            .then(res => {
                // this.user = res.data;
                commit('setAuthUser',res.data);
            })
            .catch(error => {
                console.log('Unable to fetch auth user');
            })
 }
};
const mutations={
    setAuthUser(state,user){
        state.user=user;
    }

};
export default {
    state,getters,actions,mutations
}

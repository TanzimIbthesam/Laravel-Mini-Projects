const state = {
    newsPosts: null,
    newsPostsStatus: null,
    postMessage: ''
};
const getters = {
    newsPosts: state => {
        return state.newsPosts;
    },
    newsStatus: state => {
        return {
            newsPostsStatus: state.newsPostsStatus
        }

    },
    postMessage: state => {
        return state.postMessage;


    }

};
const actions = {

    fetchNewsPosts({
        commit,
        state
    }) {
        commit('setPostsStatus', 'loading');
        axios.get('/api/posts')
            .then(res => {
                commit('setPosts', res.data);
                commit('setPostsStatus', 'success');
            })
            .catch(error => {
                commit('setPostsStatus', 'error');
            });

    },
       fetchUserPosts({
           commit,
           dispatch
       }, userId) {
           commit('setPostsStatus', 'loading');

           axios.get('/api/users/' + userId + '/posts')
               .then(res => {
                   commit('setPosts', res.data);
                   commit('setPostsStatus', 'success');
               })
               .catch(error => {
                   commit('setPostsStatus', 'error');
               });
       },
    postMessage({
        commit,
        state
    }) {
        commit('setPostsStatus', 'loading');
        axios.post('/api/posts', {
                body: state.postMessage
            })
            .then(res => {
                commit('pushPost', res.data);
                commit('setPostsStatus', 'success');
                commit('updateMessage', '');
            })
            .catch(error => {
                // commit('setPostsStatus', 'error');
            });

    },
    likePost({commit,state},data){
        axios.post('/api/posts/'+data.postId+'/like')
            .then(res => {
                commit('pushLikes', {
                    likes:res.data,
                    postKey:data.postKey
                });

            })
            .catch(error => {
                // commit('setPostsStatus', 'error');
            });

    }
};
const mutations = {
    setPosts(state, posts) {
        state.newsPosts = posts;
    },
    setPostsStatus(state, posts) {
        state.newsPostsStatus = posts;
    },
    setPostsStatus(state, posts) {
        state.newsPostsStatus = posts;
    },
    updateMessage(state, message) {
        state.postMessage = message;
    },
    pushPost(state, post) {
        state.newsPosts.data.unshift(post);
    },
    pushLikes(state,data){
        state.newsPosts.data[data.postKey].data.attributes.likes=data.likes
    }

};
export default {
    state,
    getters,
    actions,
    mutations
}

<template>
<div class="flex flex-col items-center">
    <div class="relative">
        <div class="w-full  overflow-hidden z-10">
               <img src="https://images.pexels.com/photos/46798/the-ball-stadion-football-the-pitch-46798.jpeg?auto=compress&cs=tinysrgb&h=650&w=940" class="object-cover w-full h-64" alt="">
    </div>
    <div class="absolute flex items-center bottom-0 left-0 -mb-8 ml-12 z-20">
      <img  src="https://cdn.pixabay.com/photo/2014/07/09/10/04/man-388104_960_720.jpg" alt="profile image for user" class="w-32 h-32 object-cover   border-4 border-gray-400 rounded-full shadow-lg">
            <p class="text-black text-2xl">{{user.data.attributes.name}}</p>
    </div>
    <div class="absolute flex items-center bottom-0 right-0 mb-8 mr-12 z-20">
<button  class="px-3 py-1 bg-gray-300 text-black">Add friend</button>
    </div>

    </div>
     <p v-if="postLoading">Loading Posts</p>


           <Post v-else v-for="post in posts.data" :key="post.data.post_id" :post="post"/>
<p class="text-red-300 text-2xl" v-if="! postLoading && posts.data.length<1">No Posts available</p>
</div>


</template>
<script>
import Post from '../../components/Post';
import { mapGetters } from 'vuex';
export default {
    components:{
         Post
    },
data() {
    return {
        // user:null,
        posts:null,
        // userLoading:true,
        postLoading:true
    }
},
mounted() {
    // axios.get('/api/users/'+this.$route.params.userId)
    // .then(res=>{
    //     this.user=res.data;
    //     // this.loading=false;
    // })
    // .catch(error=>{
    //   console.log('Unable to fetch the user from the server..');
    // //   this.loading=false;
    // })
    // .finally(()=>{
    //     this.userLoading=false;
    // });
    this.$store.dispatch('fetchUser',+this.$route.params.userId)
     axios.get('/api/users/'+this.$route.params.userId+'/posts')
       .then(res=>{
           this.posts=res.data;
    //    this.loading=false
       })
       .catch(error=>{
           console.log('Unable to fetch posts');
        //    this.loading=false
       })
       .finally(()=>{
        this.postLoading=false;
    });
},
computed:{
    ...mapGetters({
        user:'user'
    })
}
}
</script>
<style scoped>

</style>

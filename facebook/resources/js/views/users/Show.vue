<template>
<div class="flex flex-col items-center" v-if="status.user==='success' && user ">
    <div class="relative">
        <div class="w-full  overflow-hidden z-10">
               <img src="https://images.pexels.com/photos/46798/the-ball-stadion-football-the-pitch-46798.jpeg?auto=compress&cs=tinysrgb&h=650&w=940" class="object-cover w-full h-64" alt="">
    </div>
    <div class="absolute flex items-center bottom-0 left-0 -mb-8 ml-12 z-20">
      <img  src="https://cdn.pixabay.com/photo/2014/07/09/10/04/man-388104_960_720.jpg" alt="profile image for user" class="w-32 h-32 object-cover   border-4 border-gray-400 rounded-full shadow-lg">
            <p class="text-black text-2xl">{{user.data.attributes.name}}</p>
    </div>
    <div class="absolute flex items-center bottom-0 right-0 mb-8 mr-12 z-20">
<button v-if="friendButtonText && friendButtonText !=='Accept'"
@click="$store.dispatch('sendFriendRequest',$route.params.userId)"
class="mr-2 rounded px-3 py-1 bg-gray-300 text-black">
{{ friendButtonText}}

</button>
<button v-if="friendButtonText && friendButtonText ==='Accept'"
@click="$store.dispatch('acceptFriendRequest',$route.params.userId)"
class="mr-2 rounded px-3 py-1 bg-blue-400 text-black">

Accept
</button>
<button v-if="friendButtonText && friendButtonText ==='Accept'"
@click="$store.dispatch('ignoreFriendRequest',$route.params.userId)"
class="mr-2 rounded px-3 py-1 bg-gray-300 text-black">

Ignore
</button>
    </div>

    </div>
     <div v-if="status.posts==='Loading'">Loading Posts</div>



<div class="text-red-300 text-2xl" v-else-if="posts.data.length<1">No Posts available</div>
<Post v-else  v-for="post in posts.data" :key="post.data.post_id" :post="post"/>
</div>


</template>
<script>
import Post from '../../components/Post';
import { mapGetters } from 'vuex';
export default {
    data:{

    },
    name:"Show",
    components:{

         Post,
    },

mounted() {

    this.$store.dispatch('fetchUser',+this.$route.params.userId);
      this.$store.dispatch('fetchUserPosts',+this.$route.params.userId);



},
computed:{
    ...mapGetters({
        user:'user',
        posts:'posts',
        status:'status',
        friendButtonText:'friendButtonText'
    })
}
}
</script>
<style scoped>

</style>

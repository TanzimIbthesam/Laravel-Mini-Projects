<template>
<div class="flex flex-col items-center" v-if="status.user==='success' && user ">
    <div class="relative">
      <div class="w-full h-64 overflow-hidden z-10">
                <UploadableImage image-width="1500"
                                 image-height="500"
                                 location="cover"
                                 alt="user background image"
                                 classes="object-cover w-full"
                                 :user-image="user.data.attributes.cover_image"/>
            </div>
    <div class="absolute flex items-center bottom-0 left-0 -mb-8 ml-12 z-20">
         <img  src="https://cdn.pixabay.com/photo/2014/07/09/10/04/man-388104_960_720.jpg" alt="profile image for user"
       class="w-32 h-32 object-cover   border-4 border-gray-400 rounded-full shadow-lg"

       >

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
<Post v-else  v-for="(post,postKey) in posts.data" :key="postKey" :post="post"/>
</div>


</template>
<script>
import Post from '../../components/Post';
import UploadableImage from '../../components/UploadableImage';
import { mapGetters } from 'vuex';
import Dropzone from 'dropzone';
export default {
    data:{

    },
    name:"Show",
    components:{

         Post,
         UploadableImage,
         Dropzone
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

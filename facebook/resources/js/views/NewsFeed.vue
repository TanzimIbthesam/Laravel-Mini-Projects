<template>
    <div class="flex flex-col items-center py-4">
        <NewPost />
       <p v-if="newsStatus.postsStatus==='loading' ">Loading Posts</p>
        <!-- <Post v-else v-for="post in posts.data" :key="post.data.post_id" :post="post"/> -->
        <Post  v-for="post in posts.data" :key="post.data.post_id" :post="post"/>
    </div>
</template>

<script>
    import NewPost from '../components/NewPost';
    import Post from '../components/Post';
    import {mapGetters} from 'vuex';

    export default {
        name: "NewsFeed",

        components: {
            NewPost,
            Post,
        },
           data() {
               return {

               }
           },
        mounted(){
            this.$store.dispatch('fetchNewsPosts');

        },
        computed: {
            ...mapGetters({
                posts:'newsPosts',
                newsStatus:'newsStatus'

            })
        },
    }
</script>

<style scoped>

</style>

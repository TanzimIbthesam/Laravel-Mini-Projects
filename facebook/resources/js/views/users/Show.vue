<template>
    <div class="w-full  overflow-hidden">
               <img src="https://images.pexels.com/photos/46798/the-ball-stadion-football-the-pitch-46798.jpeg?auto=compress&cs=tinysrgb&h=650&w=940" class="object-cover w-full" alt="">
    </div>
</template>
<script>
export default {
data() {
    return {
        user:null,
        loading:true,
    }
},
mounted() {
    axios.get('/api/users/'+this.$route.params.userId)
    .then(res=>{
        this.user=res.data;
        // this.loading=false;
    })
    .catch(error=>{
      console.log('Unable to fetch the user from the server..');
    //   this.loading=false;
    })
    .finally(()=>{
        this.loading=false;
    });
     axios.get('/api/posts/'+this.$route.params.userId)
       .then(res=>{
           this.posts=res.data;
       this.loading=false
       })
       .catch(error=>{
           console.log('Unable to fetch posts');
           this.loading=false
       })
},
}
</script>
<style scoped>

</style>

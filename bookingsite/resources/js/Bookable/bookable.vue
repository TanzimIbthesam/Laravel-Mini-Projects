<template>

    <div>
       Row is- {{ rows }}
            <div v-if="loading">
          <h1 class="text-warning">Data is loading .....</h1>
    </div>
    <div v-else>
      <bookablelistitem :bookables="bookables">
       </bookablelistitem>
    </div>



    </div>
</template>
<script>
import bookablelistitem from './bookablelistitem';
export default {
components:{
    bookablelistitem
},
data() {
    return {
        bookables:null,
        loading:false,
        columns:3,


    }
},
computed: {
    rows(){
        return this.bookables === null ? 0 : Math.ceil(this.bookables.length/this.columns);
    }
},
  created() {
    this.loading=true;
    setTimeout(() => {
      this.bookables = [
        {

          title: "Cheap Villa !!!",
          content: "A very cheap villa"
        },
        {

          title: "Cheap Villa !!!",
          content: "A very cheap villa"
        },
        {

          title: "Cheap Villa !!!",
          content: "A very cheap villa"
        },
        {

          title: "Cheap Villa !!!",
          content: "A very cheap villa"
        },
        {

          title: "Cheap Villa !!!",
          content: "A very cheap villa"
        },
        {

          title: "Cheap Villa !!!",
          content: "A very cheap villa"
        },
        {

          title: "Cheap Villa !!!",
          content: "A very cheap villa"
        },

      ];
      this.loading = false;
    }, 2000);
  }
}
</script>
<style lang="">

</style>

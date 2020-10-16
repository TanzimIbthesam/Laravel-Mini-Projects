<template>
    <div>
         <div class="container">
         <div class="row">
               <div class="col-md-8">
                     <div class="card-body">
                         <div v-if="!loading">
                       <h2>  {{bookable.title}}</h2>

                     <hr />
                     <article>
                          {{bookable.description}}
                     </article>

                         </div>

                     </div>

                     </div>
                 <div class="col-md-4">
                     availability and prices
                 </div>
                  </div>


         </div>
    </div>
</template>
<script>
export default {
    data(){
        return{
               bookables: null,
      loading: false,

        }

    },
       created(){
        //    console.log(this.$route.params.id);
        this.loading=true;
        axios.get(`/api/bookables/${this.$route.params.id}`)
        .then((response)=>{
            this.bookable=response.data
            this.loading=false;
        });
       }
}
</script>
<style scoped>

</style>

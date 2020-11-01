<template>
    <div>
         <div class="container">
         <div class="row">
               <div class="col-md-8 pb-4">
                     <div class="card-body">
                         <div v-if="!loading">
                       <h2>  {{bookable.title}}</h2>

                     <hr />
                     <article>
                          {{bookable.description}}
                     </article>

                         </div>

                     </div>
                       <reviewList  :bookableId="this.$route.params.id"></reviewList>
                     </div>

                 <div class="col-md-4 pb-4">

                      <availability :bookableId="this.$route.params.id" @availability="  checkPrice($event)"></availability>
                 </div>
                  </div>


         </div>
    </div>
</template>
<script>
import availability from './availability';
import reviewList from './reviewList';

export default {


      components:{
            availability,
            reviewList
        },
    data(){
        return{
               bookables: null,
      loading: false,

        };


    },
       created(){
        //    console.log(this.$route.params.id);
        this.loading=true;
        axios.get(`/api/bookables/${this.$route.params.id}`)
        .then((response)=>{
            this.bookable=response.data.data,
            this.loading=false;
        });
       },
       methods:{
           checkPrice(hasAvailability){
               console.log(hasAvailability);
           }
       }
}
</script>
<style scoped>

</style>

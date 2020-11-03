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

                      <availability
                      :bookableId="this.$route.params.id"
                      @availability="  checkPrice($event)"
                      class="mb-4"
                      >
                      </availability>
                      <div v-if="price">
                           <transition name="fade">

                                   <priceBreakdown  :price="price" class="mb-4"></priceBreakdown>
                                   </transition>
                    <button class="btn btn-outline-secondary btn-block"

                    @click="addtoBasket()"
                    :disabled="inBasketAlready"
                    >Book Now</button>
                      </div>



                    <button class="btn btn-outline-secondary btn-block"
                    @click="removeFromBasket()"
                    v-if="inBasketAlready"
                    >Remove from Basket</button>


                      <div v-if="inBasketAlready" class="mt-4 text-muted warning">Seems like you have added this to Basket already.If you want to change dates remove from basket first</div>

                 </div>
                  </div>


         </div>
    </div>
</template>
<script>
import availability from './availability';
import reviewList from './reviewList';
import {mapState} from 'vuex';
import priceBreakdown from './priceBreakdown';

export default {


      components:{
            availability,
            reviewList,
            priceBreakdown
        },
    data(){
        return{
        bookables: null,
      loading: false,
      price:null

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
         computed:{
     ...mapState({
          lastSearch: "lastSearch",

          inBasketAlready(){
                   if(null===this.bookable){
                  return false;
              }
              return this.$store.getters.inBasketAlready(this.bookable.id);
          }
     }),
    },
       methods:{
          async checkPrice(hasAvailability){
               if(!hasAvailability){
                   this.price=null;
                   return;
               }
               try{
                     this.price=(await axios.get( `/api/bookables/${this.bookable.id}/price?from=${this. lastSearch.from}&to=${this. lastSearch.to}`
        )).data.data;
               }catch(err){
                   this.price=null;

               }
           },
           addtoBasket(){
               this.$store.dispatch('addtoBasket',{
                   bookable:this.bookable,
                   price:this.price,
                   dates:this.lastSearch

               });
           },
             removeFromBasket(){
                 this.$store.dispatch("removeFromBasket",this.bookable.id)

             }
       }
}
</script>
<style scoped>
.warning{
    font-size: 0.7rem;;
}
</style>

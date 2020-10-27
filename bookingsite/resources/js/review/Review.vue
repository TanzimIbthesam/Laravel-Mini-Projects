<template>
<div>

        <fatal-error v-if="error" ></fatal-error>
        <div class="row" v-else>
            <div :class="[{'col-md-4' :twoColumn},{'d-none' :  oneColumn}]">
             <div class="card">
                 <div class="card-body">
                     <div v-if="loading">Loading...</div>
                     <div v-if="hasBooking">
                         <p>
                              <router-link target="_blank"
                  :to="{name: 'bookable', params: { id: booking.bookable.id}}"
                >{{ booking.bookable.title }}</router-link>
                         </p>
                         <p>Booking-{{booking.from}} to {{booking.to}}</p>

                     </div>
                 </div>
             </div>
         </div>
        <div :class="[{'col-md-8' : twoColumn},{'col-md-12' : oneColumn}]">
        <div v-if="loading">
             Loading ...
        </div>
        <div v-else>
              <div v-if=" alreadyReviewed">
            <h1>You have already reviewed this page</h1>
        </div>
        <div v-else>
              Review Page
       <div class="form-group">
     <label  class="text-muted" for="">Select rating from 1 to 5</label>
     <star-rating
     class="fa-3x"

     v-model="review.rating"
     ></star-rating>
       </div>
       <div class="form-group">

     <label for="content"  class="text-muted">Describe your experience</label>
      <textarea  class="form-control" name="content" id="" cols="30" rows="10" v-model="review.content"></textarea>
       </div>
         <button @click.prevent="submit" :disabled="loading" class="btn btn-lg btn-primary btn-block">Submit</button>
     </div>
        </div>
        </div>
        </div>


      </div>


</template>
<script>
import {is404,is422} from './../shared/utils/response';
export default {
    data() {
        return {
            review:{
                id:null,
                rating:5,
                content:null
            },
            existingReview:null,
            loading:false,
            booking:null,
            error:false,
            errors:null

        }
    },
    created(){
        this.review.id=this.$route.params.id;
        this.loading=true;
        //if review already exists(in review table by id)
         axios
      .get(`/api/reviews/${this.review.id}`)
      .then(response =>{
         this.existingReview = response.data.data
      })
      .catch(err => {
        //
        if(is404(err)){
             //Fetch a booking by a review key
            return axios.get(`/api/booking-by-review/${this.review.id}`)
            .then(response=>{
                this.booking=response.data.data;
            }).catch((err)=>{

                   this.error=!is404(err);
            });

        }
        this.error=true;
      })
      .then(()=>{


          this.loading=false;

      } );

        //Storing a review


    },
    computed:{
      alreadyReviewed(){
          return this.hasReview || !this.booking;
      },
      hasReview(){
           return this.existingReview !== null;
    },
    hasBooking(){
        return this.booking !== null;
    },
    oneColumn(){
            return  !this.loading && this.alreadyReviewed
    },
    twoColumn(){
            return  this.loading || !this.alreadyReviewed
    }
    },
    methods:{
        submit(){
            this.errors=null;
            this.loading=true;
            axios.post('/api/reviews',this.review)
            .then((response)=>console.log(response))
            .catch(err=>{
                if(is422(err)){
                    const errors=err.response.data.errors;
                    if(errors['content'] && 1===_.size(errors)){
                        this.errors=errors;
                        return
                    }

                }
                this.error=true;

            })
            .then(()=>this.loading=false)
            ;

        }
    }


}
</script>

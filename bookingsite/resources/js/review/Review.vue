<template>
    <div>
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
         <button class="btn btn-lg btn-primary btn-block">Submit</button>
     </div>
</template>
<script>
export default {
    data() {
        return {
            review:{
                rating:5,
                content:null
            }
        }
    },
    created(){
        //if review already exists(in review table by id)
        //Fetch a booking by a review key
        //Storing a review


    }
    //  methods: {
    //      onRatingChanged(rating){
    //            console.log(rating);
    //      }
    //  },
}
</script>

<template>
    <div>
        Review Page
       <div class="form-group">
     <label  class="text-muted" for="">Select rating from 1 to 5</label>
     <star-rating :rating="5" class="fa-3x" v-on:ratingchanged="review.rating=$event"></star-rating>
       </div>
       <div class="form-group">
     <label for="content"  class="text-muted">Describe your experience</label>
      <textarea  class="form-control" name="content" id="" cols="30" rows="10"></textarea>
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
    //  methods: {
    //      onRatingChanged(rating){
    //            console.log(rating);
    //      }
    //  },
}
</script>

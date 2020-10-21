<template>
    <div style="padding:1.25rem">
          <h4 class="text-uppercase text-secondary font-weight-bolder">Review List</h4>
          <div class="border-bottom d-none d-md-block" v-for="review in reviews" :key="review">
              <div class="row pt-4">
                  <div class="col-md-6">
                      Tanzim
                  </div>
                  <div class="col-md-6 d-flex justify-content-end">
                   {{ review.rating }}
                  </div>
              </div>
              <div class="row">
                  <div class="col-md-12">
                     {{ review.created_at |  fromNow }}
                      </div>
              </div>

                  <div class="col-md-12">
                     {{ review.content }}

                  </div>
              </div>
    </div>


</template>
<script>
import moment from 'moment';
export default {
props: {
    bookableId: String
  },
      data() {
          return {
              reviews:null,
              loading:false
          }
      },
      created() {
          this.loading=true;
         axios.get(`/api/bookables/${this.bookableId}/reviews`)
         .then(response=>this.reviews=response.data.data

         )
         .then(()=>this.loading=false)

         ;
      },
    //   filters:{
    //       fromNow(value){
    //          return
    //       }
    //   }
}
</script>
<style scoped>

</style>

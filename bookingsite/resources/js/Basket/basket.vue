<template>
    <div>
        <success v-if="success">
            Congratulations on your success
        </success>
              <div class="row" v-else>
                  <div class="col-md-8" v-if="itemsInBasket">
                         <div class="row">
                             <div class="col-md-6 form-group">
                                 <label for="first_name">First Names</label>
                                 <input type="text"
                                 name="first_name"
                                 v-model="customer.first_name"
                                 class="form-control"
                                  :class="[{'is-invalid': errorFor('customer.first_name')}]"
                                  id="" />
                                 <v-errors :errors="errorFor('customer.first_name')"></v-errors>

                             </div>
                              <div class="col-md-6 form-group">
                                 <label for="last_name">Last Name</label>
                                 <input
                                 type="text"
                                 name="last_name"
                                 v-model="customer.last_name"

                                 class="form-control"
                                 id=""
                                 :class="[{'is-invalid': errorFor('customer.last_name')}]"
                                  />



                                  <v-errors :errors="errorFor('customer.last_name')"></v-errors>
                             </div>

                         </div>
                         <div class="row">
                             <div class="col-md-12 form-group">
                                 <label for="email">Email</label>
                                 <input
                                 type="text"
                                 name="email"
                                 v-model="customer.email"
                                 class="form-control"
                                 id=""
                                 :class="[{'is-invalid': errorFor('customer.email')}]"
                                  />
                             <v-errors :errors="errorFor('customer.email')"></v-errors>


                             </div>

                         </div>
                         <div class="row">
                               <div class="col-md-6 form-group">
                                 <label for="city">Street</label>
                                 <input
                                 type="text"
                                 v-model="customer.street"
                                 name="city"
                                 class="form-control"
                                 id=""
                                :class="[{'is-invalid': errorFor('customer.street')}]"
                                  />



                                  <v-errors :errors="errorFor('customer.street')"></v-errors>


                             </div>
                              <div class="col-md-6 form-group">
                                 <label for="state">City</label>
                                 <input
                                 type="text"
                                 v-model="customer.city"
                                 name="state"
                                 class="form-control"
                                 id=""
                                  :class="[{'is-invalid': errorFor('customer.street')}]"
                                  />
                      <v-errors :errors="errorFor('customer.street')"></v-errors>

                             </div>

                         </div>
                             <div class="row">
                             <div class="col-md-6 form-group">
                                 <label for="country">Country</label>
                                 <input
                                 type="text"
                                 v-model="customer.country"
                                 name="country"
                                 class="form-control"
                                  :class="[{'is-invalid': errorFor('customer.country')}]"
                                  id=""
                                  />



                                  <v-errors :errors="errorFor('customer.country')"></v-errors>

                             </div>
                              <div class="col-md-4  form-group">
                                 <label for="state">State</label>
                                 <input
                                 type="text"
                                 v-model="customer.state"
                                 name="state"
                                 class="form-control"
                                 id=""
                                   :class="[{'is-invalid': errorFor('customer.state')}]"
                                  />
                             <v-errors :errors="errorFor('customer.state')"></v-errors>


                                 >
                             </div>
                              <div class="col-md-2  form-group">
                                 <label for="zip">Zip</label>
                                 <input
                                 type="text"
                                 v-model="customer.zip"
                                 name="zip"
                                 class="form-control" id=""
                                   :class="[{'is-invalid': errorFor('customer.zip')}]"
                                  />
                             <v-errors :errors="errorFor('customer.zip')"></v-errors>


                             </div>
                                <hr />
                         </div>
                         <hr />
                         <div class="row">
                             <div class="col-md-12 form-group">
                                 <button @click.prevent="book()"
                                 :disabled="loading"
                                  type="submit" class="btn btn-lg btn-primary btn-block">Book Now!</button>
                             </div>
                         </div>


                  </div>
                  <div class="col-md-8" v-else>
                        <div class="jumbotron jumbotron-fluid text-center">
                            <h1>Empty here</h1>
                        </div>
                  </div>
                  <div class="col-md-4">
                      <div class="d-flex justify-content-between">
                          <h6 class="text-uppercase text-secondary font-weight-bolder">Your cart</h6>
                          <h6 class="badge badge-secondary text-uppercase">
                              <span v-if="itemsInBasket">Items-{{itemsInBasket}}</span>
                              <span v-else>Empty</span>
                          </h6>
                      </div>
                      <transition-group name="fade">
                      <div v-for="item in basket" :key="item.bookable.id">
                          <div class="pt-2 pb-2 border-top d-flex justify-content-between">
                              <span>
                                  <router-link :to="{name:'bookable',params:{id:item.bookable.id}}">{{item.bookable.title}}</router-link>
                              </span>
                              <span class="font-weight-bold">${{item.price.total}}</span>
                          </div>
                          <div class="pt-2 pb-2  d-flex justify-content-between">
                              <span>
                                 From-{{item.dates.from}}
                              </span>
                              <span class="font-weight-bold">
                                  To-{{item.dates.to}}
                              </span>
                          </div>
                          <div class="pt-2 pb-2  d-flex justify-content-between">
                              <button class="btn btn-sm btn-outline-secondary" @click="$store.dispatch('removeFromBasket',item.bookable.id)" >
                                  <i class="fas fa-trash-alt"></i>
                              </button>
                          </div>
                      </div>
                      </transition-group>

                  </div>
              </div>
    </div>
</template>
<script>
import { mapState } from 'vuex';
import {mapGetters} from 'vuex';
import validationErrors from "./../shared/mixins/validationErrors";
export default {
    mixins:[validationErrors],
    data() {
        return {
            loading:false,
            bookingAttempted:false,
            customer:{
                first_name:null,
                last_name:null,
                email:null,
                street:null,
                city:null,
                country:null,
                state:null,
                zip:null
            }
        }
    },
    computed: {
    //   ...mapGetters([" itemsInBasket"]),
      ...mapGetters({
         itemsInBasket:"itemsInBasket"
     }),
        ...mapState({
            basket:state=>state.basket.items
        }),
        success(){
            return !this.loading && 0===this.itemsInBasket && this.bookingAttempted;
        }
    },
    methods: {
        async book(){
            this.loading=true;
            this.bookingAttempted=false;
            this.errors=null;
            try{
                await axios.post('/api/checkout',{
                    customer:this.customer,
                    bookings:this.basket.map(basketItem=>({
                        bookable_id:basketItem.bookable.id,
                        from:basketItem.dates.from,
                        to:basketItem.dates.to,
                    }))
                });
                     this.$store.dispatch("clearBasket");
            }catch(error){
                this.errors=error.response && error.response.data.errors;
            }
            this.loading=false;
            this.bookingAttempted=true;
        }
    },
}
</script>
<style scoped>
h6 .badge{
    font-size: 100%;
}
</style>

<template>
    <div>
              <div class="row">
                  <div class="col-md-8">
                         <div class="row">
                             <div class="col-md-6 form-group">
                                 <label for="first_name">First Names</label>
                                 <input type="text" name="first_name" class="form-control" id="">
                             </div>
                              <div class="col-md-6 form-group">
                                 <label for="last_name">Last Name</label>
                                 <input type="text" name="last_name" class="form-control" id="">
                             </div>

                         </div>
                         <div class="row">
                             <div class="col-md-12 form-group">
                                 <label for="email">Email</label>
                                 <input type="text" name="email" class="form-control" id="">
                             </div>

                         </div>
                         <div class="row">
                               <div class="col-md-6 form-group">
                                 <label for="city">Street</label>
                                 <input type="text" name="city" class="form-control" id="">
                             </div>
                              <div class="col-md-6 form-group">
                                 <label for="state">City</label>
                                 <input type="text" name="state" class="form-control" id="">
                             </div>

                         </div>
                             <div class="row">
                             <div class="col-md-6 form-group">
                                 <label for="country">Country</label>
                                 <input type="text" name="country" class="form-control" id="">
                             </div>
                              <div class="col-md-4  form-group">
                                 <label for="state">State</label>
                                 <input type="text" name="state" class="form-control" id="">
                             </div>
                              <div class="col-md-2  form-group">
                                 <label for="zip">Zip</label>
                                 <input type="text" name="zip" class="form-control" id="">
                             </div>
                                <hr />
                         </div>
                         <hr />
                         <div class="row">
                             <div class="col-md-12 form-group">
                                 <button type="submit" class="btn btn-lg btn-primary btn-block">Book Now!</button>
                             </div>
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
export default {
    computed: {
    //   ...mapGetters([" itemsInBasket"]),
      ...mapGetters({
         itemsInBasket:"itemsInBasket"
     }),
        ...mapState({
            basket:state=>state.basket.items
        })
    },

}
</script>
<style scoped>
h6 .badge{
    font-size: 100%;
}
</style>

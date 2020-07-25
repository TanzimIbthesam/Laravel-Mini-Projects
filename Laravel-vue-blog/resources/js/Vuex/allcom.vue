<template>
    <div>
         <div class="content">
             <div class="container-fluid">
                <h1> {{$store.getters.getCounter}}</h1>
             </div>
             <div>
                 <comone/>
                 <comtwo/>
                 <comthree/>


             </div>
             <div>
                 <Button type="info" size="small" @click="changeCounter">Change Counter</Button>
                 <Button type="info" size="small" @click="clickChange">Click to change</Button>


             </div>
         </div>
    </div>
</template>
<script>
import comone from './comone'
import comtwo from './comtwo'
import comthree from './comthree'
import comfour from './comfour'
import {mapGetters,mapActions} from 'vuex'
export default {
    data() {
        return {
            localVar:'Some value'

        }
    },
    components:{
        comone,
        comtwo,
        comthree,
        comfour
    },


     computed:{
               ...mapGetters(['getCounter'])
            },
              methods: {
        changeCounter(){
            // this.$store.commit('increaseCounter',1);
            this.$store.dispatch('increasetheCounter',1);
        },
        checkCounter(){
             console.log('I am running when counter is increasing');
        },
        ...mapActions(['clickChange'])

    },
    created(){
        console.log(this.$store.state.counter);
    },
       watch:{
          getCounter(value){
              console.log('Counter is changing',value);
              this.checkCounter();
              console.log(this.localVar);
          }
    },

}
</script>

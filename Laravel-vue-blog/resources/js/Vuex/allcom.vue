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
             </div>
         </div>
    </div>
</template>
<script>
import comone from './comone'
import comtwo from './comtwo'
import comthree from './comthree'
import {mapGetters,mapActions} from 'vuex'
export default {
    data() {
        return {

        }
    },
    components:{
        comone,
        comtwo,
        comthree
    },

     computed:{
               ...mapGetters(['getCounter'])
            },
              methods: {
        changeCounter(){
            // this.$store.commit('increaseCounter',1);
            this.$store.dispatch('increasetheCounter',1);
        },
        ...mapActions(
            ['increasetheCounter']
            )
    },
    created(){
        console.log(this.$store.state.counter);
    }

}
</script>

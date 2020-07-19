<template>
    <div>
         <div class="content">
             <div class="container-fluid">
                <h1>Current state of counter is {{$store.state.counter}}</h1>
             </div>
             <div>
                 <comone />
                 <comtwo />
                 <comthree />
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
export default {
    components:{
        comone,
        comtwo,
        comthree
    },
    methods: {
        changeCounter(){
            this.$store.commit('increaseCounter',1);
        }
    },

}
</script>

<template>
    <div>
                   <h1>Current state of counter is {{getCounter}}</h1>
    </div>
</template>

<script>
import {mapGetters} from 'vuex'
export default {
  computed:{
               ...mapGetters(['getCounter'])
            },
}
</script>

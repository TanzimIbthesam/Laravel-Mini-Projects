<template>
    <div>
       <bookablelistitem title="New Villa" content="Resort" :price=1000></bookablelistitem>
    </div>
</template>
<script>
import bookablelistitem from './bookablelistitem';
export default {
components:{
    bookablelistitem
},
beforeCreate(){
    console.log("Before Created");
},
created(){
    console.log("Created");
},
beforeMount(){
    console.log("Before Mount");
},
mounted(){
    console.log("Mounted");
},
beforeDestroy(){
    console.log("Before destroy");
},
destroy(){
    console.log("Destroyed");
}
}
</script>
<style lang="">

</style>

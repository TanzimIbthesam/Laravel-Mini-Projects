<template>
    <div>
       <bookablelistitem
       :title="bookableone.title"
      :content="bookableone.content"
       :price="bookableone.price">
       </bookablelistitem>
    </div>
</template>
<script>
import bookablelistitem from './bookablelistitem';
export default {
components:{
    bookablelistitem
},
data() {
    return {
        bookableone:{
            title:"New Villa",
            content:"Resort",
            price:1000
        }
    }
},
created() {
    console.log("Created");
    console.log(this.bookableone);
    setTimeout(() => {
     this.bookableone.title="Changed New Villa";
}, 2000);
},
}
</script>
<style lang="">

</style>

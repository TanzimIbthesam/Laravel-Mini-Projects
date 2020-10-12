<template>
    <div>
       <bookablelistitem
        v-if="bookableone !== null"
       :title="bookableone.title"
      :content="bookableone.content"
       :price="bookableone.price">
       </bookablelistitem>
       <bookablelistitem
       v-if="bookabletwo !== null"
       :title="bookabletwo.title"
      :content="bookabletwo.content"
       :price="bookabletwo.price">
       </bookablelistitem>
       <bookablelistitem
        v-if="bookablethree !== null"
       :title="bookablethree.title"
      :content="bookablethree.content"
       :price="bookablethree.price">
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
        bookableone:null,
        bookabletwo:null,
        bookablethree:null
    }
},
created() {
    console.log("Created");
    console.log(this.bookableone);
    setTimeout(() => {
            this.bookableone={
         'title':'Villa One',
         'content':'Content Two'
    };
    this.bookabletwo={
         'title':'Villa Two',
         'content':'Content  Two'
    };
    this.bookablethree={
         'title':'Villa Three',
         'content':'Content  Three'
    };

    }, 2000);




},
}
</script>
<style lang="">

</style>

<template>
    <div>
       <bookablelistitem
       :title="bookableone.title"
      :content="bookableone.content"
       :price="bookableone.price">
       </bookablelistitem>
       <bookablelistitem
       :title="bookabletwo.title"
      :content="bookabletwo.content"
       :price="bookabletwo.price">
       </bookablelistitem>
       <bookablelistitem
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

    setTimeout(() => {
        console.log("First change");
     this.bookableone.title="Changed New Villa";
     this.bookableone.content="Resort";
}, 2000);
    setTimeout(() => {
     this.bookabletwo.title="Changed New Villa two";
     this.bookabletwo.content="Resort two";
}, 5000);
    setTimeout(() => {
     this.bookablethree.title="Changed New Villa three";
     this.bookablethree.content="Resort three";
}, 8000);
},
}
</script>
<style lang="">

</style>

<template>
    <div>
            <h1 class="text-primary">Bookable list item</h1>
             <p class="text-primary">{{title}}</p>
             <p class="text-primary">{{content}}</p>
             <p class="text-primary">{{price}}</p>
    </div>
</template>
<script>
export default {
// props:['title','content','pri']
props:{
title:String,
content:String,
price:Number
}
}
</script>
<style lang="">

</style>

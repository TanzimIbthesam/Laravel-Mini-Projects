<template>
<div>


<div class="card"  v-for="bookable in bookables" :key="bookable">
    <div class="card-header">
           <h1 class="text-warning">{{bookable.title}}</h1>
    </div>
    <div class="card-body">
               <p class="text-primary">{{bookable.content}}</p>

    </div>


    </div>
    </div>




</template>
<script>
export default {
props:['bookables'],
mounted() {
    console.log(this.title);
},

}
</script>
<style lang="">

</style>

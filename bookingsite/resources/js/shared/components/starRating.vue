<template>
    <div class="d-flex">

         <i
         class="fas fa-star" v-for="star in fullStar"
         :key=" 'full'+star "
        @click="$emit('ratingchanged', star)"
         ></i>
         <i class="fas fa-star-half-alt" v-if="halfStar"></i>
         <i class
         ="far fa-star"
         v-for="star in emptyStar"
         :key=" 'empty'+star "
         @click="this.$emit('ratingchanged',fullStar+star)"
         ></i>
    </div>
</template>
<script>
export default {
    props:{
        rating:Number
    },
    computed:{
        halfStar(){
            // return false;
            const fraction=Math.round((this.rating-Math.floor(this.rating))*100);
            // console.log(fraction);

            return fraction>0 && fraction <50;
        },
        fullStar(){
            return Math.round(this.rating);
        },
        emptyStar(){
            return 5 -Math.ceil(this.rating);
        }
    },


}
</script>

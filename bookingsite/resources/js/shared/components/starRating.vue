<template>
    <div class="d-flex">
        Actual rating is -{{ rating }}
         <i class="fas fa-star" v-for="star in fullStar" :key=" 'full'+star "></i>
         <i class="fas fa-star-half-alt" v-if="halfStar"></i>
         <i class="far fa-star"  v-for="star in emptyStar" :key=" 'empty'+star "></i>
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
            console.log(fraction);

            return fraction>0 && fraction <50;
        },
        fullStar(){
            return Math.round(this.rating);
        },
        emptyStar(){
            return 5 -Math.ceil(this.rating);
        }
    },
    created(){
        const numbers=[0.9,4.0,4.4,4.5,4.6,4.9];

        // numbers.forEach(number => {
        //  console.log(`Round for ${number} is ${Math.round(number)}`);
        //    console.log(`Floor for ${number} is ${Math.floor(number)}`);
        //  console.log(`Ceil for ${number} is ${Math.ceil(number)}`);

        //  console.log("===========================");
        // });
    }

}
</script>

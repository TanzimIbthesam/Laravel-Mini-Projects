<template>
    <div>
            <h1 ref="myref">Hooks tutorial</h1>
             <p>My name is {{name}}</p>
    </div>
</template>
<script>
export default {
    data(){
        return{
            name:'Tanzim'
        }
    },
    beforeCreate(){
        console.log(`${this.name}`);
    },
    created(){
        console.log(`Create hooks ${this.name}`);
    },
    mounted(){
        console.log(this.$refs.myref);
    }
}
</script>

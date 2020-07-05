<template>
    <div>
            <button @click="increaseCount(1)">Click</button>

            <button @click="decreaseCounter(1)">Decrease</button>
             <p>Count-{{counter}}</p>

         {{counterwarning(counter)}}
                     <div v-for="(blog,index) in blogs" :key="index">
                         {{blog.title}}
                         {{blog.description}}

                     </div>
                     <button @click="submittedButton()">Add</button>
                     <div v-if="submitted">It is submitted</div>
                     <div v-else-if="!submitted">It is not submitted</div>
     </div>
</template>
<script>
export default {
   data() {
       return {
           counter:0,

           blogs:[],
           submitted:false

       }
   },
   methods:{
       increaseCount(counter){
          this.counter+=counter
          if(this.counter>5){
                this.counter=0;


          }
       },
       decreaseCounter(counter){
          this.counter-=counter
          if(this.counter>0 && this.counter<2){
              this.counter=0;

          }





          },
            counterwarning(counter){
           this.counter=counter;
           if(this.counter>4){
            return 'It cannot be greater than 5';
           }
           if(this.counter>0 && this.counter<2){
               return 'It cannot be negative';
           }


       },
      submittedButton(){
          this.submitted=!this.submitted
      }

   },
   created(){
let posts=[
           {title:'Hello World',description:'Lets describe it in details'},
            {title:'Hello World',description:'Lets describe it in details'}
       ]
       this.blogs=posts;

    //    this.blogs=posts;



   }

       }


</script>
<style scoped>
.button{
    padding:15px 35px ;
    background: antiquewhite;
    color: black;
    font-weight: bold;
    border-radius:5px;
    border: none;
    font-size:15px;
}
</style>

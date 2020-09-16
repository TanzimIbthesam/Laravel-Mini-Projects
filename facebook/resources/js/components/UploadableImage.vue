<template>
   <div>

        <img
        src="https://images.pexels.com/photos/46798/the-ball-stadion-football-the-pitch-46798.jpeg?auto=compress&cs=tinysrgb&h=650&w=940"
        class="object-cover w-full h-64"
        alt=""
         ref="userImage">
   </div>



</template>
<script>
import Dropzone from 'dropzone';
export default {
    props:[
            'imageWidth',
            'imageHeight',
            'location'
    ],
    data() {
        return {
            dropzone:null,
        }
    },
    mounted() {
        this.dropzone=new Dropzone(this.$refs.userImage,this.settings);
    },
    computed:{
        settings(){
            return{
                paramName:'image',
                url:'/api/user-images',
                acceptedFiles:'image/*',
                params:{
                    'width':this.imageWidth,
                    'height':this.imageHeight,
                    'location':this.location
                },
                headers:{
                    'X-CSRF-TOKEN':document.head.querySelector('meta[name=csrf-token]').content
                },
                success:(e,res)=>{
                  alert('Uploaded');
                }
            };
        }
    }

}
</script>

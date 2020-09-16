<template>
   <div>


      <img :src="imageObject.data.attributes.path"

             ref="userImage"
             :class="classes"
             :alt="alt">
   </div>



</template>
<script>
import Dropzone from 'dropzone';
export default {
    props:[
            'userImage',
            'imageWidth',
            'imageHeight',
            'location',
            'classes',
            'alt'
    ],
    data() {
        return {
            dropzone:null,
            uploadedImage:null,
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
                  this.uploadedImage=res;

                }
            };
        },
        imageObject(){
            return this.uploadedImage || this.userImage;
        }
    }

}
</script>

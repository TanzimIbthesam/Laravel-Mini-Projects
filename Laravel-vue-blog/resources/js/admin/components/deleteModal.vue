<template>
    <div>

 <Modal
 :value="getDeleteModalObj.showDeleteModal"
 width="360"
  :mask-closeable="false"
:closeable="false"
 >
        <p slot="header" style="color:#f60;text-align:center">
            <Icon type="ios-information-circle"></Icon>
            <span>Delete confirmation</span>
        </p>
        <div style="text-align:center">
           <p>Are you sure you want to Delete it?</p>
        </div>
        <div slot="footer">

            <Button type="error" :loading="isDeleting" :disabled="isDeleting"   size="large" @click="deleteTag">Delete</Button>
            <!-- <Button type="error"    size="large" @click="deleteTag">Delete</Button> -->

        </div>
    </Modal>
    </div>
</template>
<script>
import {mapGetters} from 'vuex'
export default {
    data(){
        return{
            isDeleting:false
        }

    },
    methods:{
  async deleteTag(){

    this.isDeleting=true;

    const res=await this.callApi('post',this.getDeleteModalObj.deleteUrl,this.getDeleteModalObj.data);
    if(res.status===200){

          this.$store.commit('setDeleteModal',true);
        this.success('Tags has been deleted successfully');
    }else{
        this.error();
        this.$store.commit('setDeleteModal',false);
    }
       this.isDeleting=false;

},
    },
    computed:{
        ...mapGetters(['getDeleteModalObj'])
    }

}
</script>
<style scoped>

</style>

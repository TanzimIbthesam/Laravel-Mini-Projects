<template>
    <div>

 <Modal :value="  getDeleteModalObj.showDeleteModal" width="360">
        <p slot="header" style="color:#f60;text-align:center">
            <Icon type="ios-information-circle"></Icon>
            <span>Delete confirmation</span>
        </p>
        <div style="text-align:center">
           <p>Are you sure you want to Delete it?</p>
        </div>
        <div slot="footer">
            <Button type="error" :loading="isDeleting" size="large" @click="deleteTag">Delete</Button>
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
            async deleteTag(tag,index){
                this.$store.commit('setDeleteModal')

}
    },
    computed:{
        ...mapGetters(['getDeleteModalObj'])
    }

}
</script>
<style scoped>

</style>

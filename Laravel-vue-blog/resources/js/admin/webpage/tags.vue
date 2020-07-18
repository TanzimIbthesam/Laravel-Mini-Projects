<template>
    <div>
       <div class="content">
			<div class="container-fluid">


				<!--~~~~~~~ TABLE ONE ~~~~~~~~~-->
				<div class="_1adminOverveiw_table_recent _box_shadow _border_radious _mar_b30 _p20">
					<p class="_title0">Tags<Button type="primary" @click="addModal = true">Add New Tag</Button></p>


					<div class="_overflow _table_div">



						<table class="_table">
								<!-- TABLE TITLE -->
							<tr>
								<th>Id</th>
								<th>TagName</th>
								<th>CreatedAt</th>
								<th>Action</th>
							</tr>
								<!-- TABLE TITLE -->


								<!-- ITEMS -->
								<tr v-for="(tag, index) in tags" :key="index">
								<td>{{tag.id}}</td>
								<td class="_table_name">{{tag.tagName}}</td>
								<td>{{tag.created_at}}</td>
								<td>

									<Button size="small" type="primary" v-on:click="showEditModal(tag,index)">Edit</Button>
									<Button type="error" size="small" @click="showDeletingModal(tag, index)"  >Delete</Button>


								</td>
							</tr>




						</table>

					</div>
				</div>
 <Modal
        v-model="addModal"
        title="Add Your Tags"
        :mask-closeable="false"
        :closeable="false"
        >
  <Input v-model="data.tagName" placeholder="Enter something..." style="width: 300px" />
        <div slot="footer">
            <Button type="default" v-on:click="addModal=false">Close</Button>
              <Button type="primary" @click="addTag" :disabled="isAdding" :loading="isAdding"> {{isAdding ? 'Adding..' : 'Add Tag'}}</Button>

        </div>

    </Modal>
    <!-- Tag Editing Modal  -->
<Modal
        v-model="editModal"
        title="Edit Tag"
        :mask-closeable="false"
        :closeable="false"
        >
  <Input v-model="editData.tagName" placeholder="Enter something..." style="width: 300px" />
        <div slot="footer">
            <Button type="default" v-on:click="editModal=false">Close</Button>
             	<Button type="primary" @click="editTag" :disabled="isAdding" :loading="isAdding">{{isAdding ? 'Editing..' : 'Edit tag'}}</Button>

        </div>

    </Modal>
    <!-- Tag Deleting Modal -->
    <Modal v-model=" showDeleteModal" width="360">
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
		</div>
    </div>
</template>
<script>
export default {
data(){
    return{
      data:{
          tagName:' ',

      },
     addModal:false,
     isAdding:false,
     editModal:false,
     tags:[],
     editData:{
         tagName:' ',

     },
     index : -1,
    showDeleteModal:false,
    isDeleting:false,
     deleteItem: {},
     deletingIndex:-1,

    }

},
  methods:{
   async addTag(){
     if(this.data.tagName.trim( )=='') return this.error('Tag Name is required')
     const res=await this.callApi('post','app/create_tag',this.data);
     if(res.status===201){
         this.tags.unshift(res.data);
         this.success('Tag has been added successfully');

         this.addModal=false;
     }else{
         if(res.status=422){
             if(res.data.errors.tagName){
                     this.index(res.data.errors.tagName[0]);
             }

         }else{
              this.error();
         }

     }
	// if(this.data.tagName.trim()=='') return this.e('Tag name is required')
},
  async editTag(){
     if(this.editData.tagName.trim( )=='') return this.error('Tag Name is required')
     const res=await this.callApi('post','app/edit_tag',this.editData);
     if(res.status===200){
         this.tags[this.index].tagName=this.editData.tagName
         this.success('Tag has been edited successfully');

         this.editModal=false;
     }else{
         if(res.status=422){
             if(res.data.errors.tagName){
                     this.index(res.data.errors.tagName[0]);
             }

         }else{
              this.error();
         }

     }
// 	// if(this.data.tagName.trim()=='') return this.e('Tag name is required')
// }


},

showEditModal(tag,index){
    // this.editData=tag
    // this.editModal=true
    let obj={
        id:tag.id,
        tagName:tag.tagName
    }
    this.editData=obj
    this.editModal=true
    this.index=index
    // console.log('Clicked')
    // console.log(this.editData);

},
async deleteTag(tag,index){
    this.isDeleting=true;
//     if(!confirm('Are you sure you want to delete this?')) return
//    tag.isDeleting=true
    // this.$set(tag,'isDeleting',true);
    const res=await this.callApi('post','app/delete_tag',this.deleteItem);
    if(res.status===200){
        this.tags.splice(this.deletingIndex,1);
        this.success('Tags has been deleted successfully');
    }else{
        this.error();
    }
     this.isDeleting=true;
       this.showDeleteModal=false;
},
showDeletingModal(tag,index){
       this.deleteItem=tag;
       this. deletingIndex=index;
       this.showDeleteModal=true;
}
},
async created(){
    // const res=await this.callApi('post', '/createtag' ,{tagName:'testtag'});
    const res=await this.callApi('get', 'app/get_tags');
    // console.log(res);
    if(res.status==200){
          this.tags = res.data;
    }else{
         this.error();
    }
}

}
</script>


<template>
    <div>
       <div class="content">
			<div class="container-fluid">


				<!--~~~~~~~ TABLE ONE ~~~~~~~~~-->
				<div class="_1adminOverveiw_table_recent _box_shadow _border_radious _mar_b30 _p20">
					<p class="_title0">Category<Button type="primary" @click="addModal = true">Add New Category</Button></p>


					<div class="_overflow _table_div">



						<table class="_table">
								<!-- TABLE TITLE -->
							<tr>
								<th>Id</th>
								<th>Category</th>
                                 <th>Category Image</th>
								<th>CreatedAt</th>
								<th>Action</th>
							</tr>
								<!-- TABLE TITLE -->


								<!-- ITEMS -->
								<tr v-for="(category, index) in categories" :key="index">
								<td>{{category.id}}</td>
                                 <td style="width:40px"><img :src="category.iconImage" alt=""></td>
								<td class="_table_name">{{category.categoryName}}</td>
								<td>{{category.created_at}}</td>
								<td>

									<Button size="small" type="primary" v-on:click="showEditModal(category,index)">Edit</Button>
									<Button type="error" size="small" @click="showDeletingModal(category, index)"  >Delete</Button>


								</td>
							</tr>




						</table>

					</div>
				</div>
                <!-- Add category Modal -->
 <Modal
        v-model="addModal"
        title="Add category"
        :mask-closeable="false"
        :closeable="false"

        >
  <div class="space"></div>
    <Input v-model="data.categoryName" placeholder="Add category" style="width: 300px" />
           <Upload
           ref="uploads"
           type="drag"
        :headers="{'x-csrf-token' : token,'X-Requested-With' : 'XMLHttpRequest' }"
        :on-success="handleSuccess"
        :on-error="handleError"
        :format="['jpg','jpeg','png']"

         :max-size="2048"
        :on-format-error="handleFormatError"
        :on-exceeded-size="handleMaxSize"
        action="/app/upload">
        <div style="padding: 20px 0">
            <Icon type="ios-cloud-upload" size="52" style="color: #3399ff"></Icon>
            <p>Click or drag files here to upload here</p>

        </div>
    </Upload>
    <div class="demo-upload-list" v-if="data.iconImage">

 <img :src="`${data.iconImage}`">
<div class="demo-upload-list-cover">
<Icon type="ios-trash-outline" @click="deleteImage"></Icon>
</div>





					</div>

        <div slot="footer">
            <Button type="default" v-on:click="addModal=false">Close</Button>
        <Button type="primary" @click="addCategory" :disabled="isAdding" :loading="isAdding"> {{isAdding ? 'Adding..' : 'Add Category'}}</Button>




        </div>

    </Modal>
    <!-- Category Editing Modal  -->
<Modal
        v-model="editModal"
        title="Edit Category"
        :mask-closeable="false"
        :closeable="false"
        >
  <Input v-model="editData.categoryName" placeholder="Add category Name" style="width: 300px" />
  <div class="space"></div>
   <Upload
          v-show="isIconImagenew"
           ref="editDataUploads"
           type="drag"
        :headers="{'x-csrf-token' : token,'X-Requested-With' : 'XMLHttpRequest' }"
        :on-success="handleSuccess"
        :on-error="handleError"
        :format="['jpg','jpeg','png']"

         :max-size="2048"
        :on-format-error="handleFormatError"
        :on-exceeded-size="handleMaxSize"
        action="/app/upload">
        <div style="padding: 20px 0">
            <Icon type="ios-cloud-upload" size="52" style="color: #3399ff"></Icon>
            <p>Click or drag files here to upload here</p>

        </div>
    </Upload>
      <div class="demo-upload-list" v-if="editData.iconImage">

 <img :src="`${editData.iconImage}`">
<div class="demo-upload-list-cover">
<Icon type="ios-trash-outline" @click="deleteImage(false)"></Icon>
</div>
</div>
<div slot="footer">
            <Button type="default" v-on:click="  closeEditModal">Close</Button>
        <Button type="primary" @click="editCategory" :disabled="isAdding" :loading="isAdding"> {{isAdding ? 'Editing..' : 'Edit Category'}}</Button>




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
          categoryName:' ',
          iconImage:' '

      },
     addModal:false,
     isAdding:false,
     editModal:false,
     categories:[],
     editData:{
          categoryName:' ',
          iconImage:' '

     },
     index : -1,
    showDeleteModal:false,
    isDeleting:false,
     deleteItem: {},
     deletingIndex:-1,
     token:'',
     isIconImagenew:false

    }

},
  methods:{
   async addCategory(){
     if(this.data.categoryName.trim( )=='') return this.error('Category Name is required');
     if(this.data.iconImage.trim( )=='') return this.error('Icon Image is required');
     this.data.iconImage=`/uploads/${this.data.iconImage}`;
     const res=await this.callApi('post','app/create_category',this.data);
     if(res.status===201){
         this.categories.unshift(res.data);
         this.success('Category been added successfully');
         this.data.categoryName='';
         this.data.iconImage='';
         this.addModal=false;
     }else{
         if(res.status=422){
             if(res.data.errors.categoryName){
                     this.index(res.data.errors.tagName[0]);
             }
             if(res.data.errors.iconImage){
                     this.index(res.data.errors.iconImage[0]);
             }

         }else{
              this.error();
         }

     }
	// if(this.data.tagName.trim()=='') return this.e('Tag name is required')
},
  async editCategory(){
     if(this.editData.categoryName.trim( )=='') return this.error('Category Name is required')
     if(this.editData.iconImage.trim( )=='') return this.error('Image is required')
     const res=await this.callApi('post','app/edit_category',this.editData);
     if(res.status===200){
         this.categories[this.index].categoryName=this.editData.categoryName;
         this.success('Category has been edited successfully');

         this.editModal=false;
     }else{
         if(res.status=422){
             if(res.data.errors.categoryName){
                     this.index(res.data.errors.categoryName[0]);
             }
             if(res.data.errors.iconImage){
                     this.index(res.data.errors.iconImage[0]);
             }

         }else{
              this.error();
         }

     }
// 	// if(this.data.tagName.trim()=='') return this.e('Tag name is required')
// }


},

showEditModal(category,index){
    // this.editData=tag
    // this.editModal=true
    // let obj={
    //     id:tag.id,
    //     tagName:tag.tagName
    // }
    this.editData=category
    this.editModal=true
    this.index=index
    this.isEditingItem=true
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
},
   handleSuccess (res, file) {
       res=`/uploads/${res}`;
            //    this.data.iconImage=res;
                 if (this.isEditingItem) {
        console.log("inside");
        return (this.editData.iconImage = res);
      }
    //   console.log(res);
   this.data.iconImage = res;
            },
   handleError (res, file) {
               console.log('res',res);
               console.log('file',file);
                 this.$Notice.warning({
                    title: 'The file format is wrong',
                    desc:`${file.errors.file.length ? file.errors.file[0] : 'Something went wrong'}`
                });
            },
            handleFormatError (file) {
                this.$Notice.warning({
                    title: 'The file format is incorrect',
                    desc: 'File format of ' + file.name + ' is incorrect, please select jpg or png.'
                });
            },
            handleMaxSize (file) {
                this.$Notice.warning({
                    title: 'Exceeding file size limit',
                    desc: 'File  ' + file.name + ' is too large, no more than 2M.'
                });
            },
            handleBeforeUpload () {
                const check = this.uploadList.length < 5;
                if (!check) {
                    this.$Notice.warning({
                        title: 'Up to five pictures can be uploaded.'
                    });
                }
},
 async deleteImage(isAdd=true){
     let image;
             if(!isAdd){
                 this.isIconImagenew=true;
                    image=this.editData.iconImage;
                this.editData.iconImage = "";
               this.$refs.uploads.clearFiles();
             }else{
                   image = this.data.iconImage;
        this.data.iconImage = "";
        this.$refs.uploads.clearFiles();

             }

               const res=await this.callApi('post','app/delete_image',{imageName:image});
               if(res.status!=200){
                   this.data.iconImage=image;
                   this.error('Something went wrong please try again');

               }


                },
                closeEditModal(){
                    this.isEditingItem=false;
                    this.editModal=false;
                }
},

async created(){
    this.token=window.Laravel.csrfToken
    // const res=await this.callApi('post', '/createtag' ,{tagName:'testtag'});
    const res=await this.callApi('get', 'app/get_category');
    // console.log(res);
    if(res.status==200){
          this.categories = res.data;
    }else{
         this.error();
    }
}

}
</script>


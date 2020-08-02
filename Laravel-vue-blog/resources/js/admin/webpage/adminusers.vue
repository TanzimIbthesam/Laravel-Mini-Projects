<template>
    <div>
       <div class="content">
			<div class="container-fluid">


				<!--~~~~~~~ TABLE ONE ~~~~~~~~~-->
				<div class="_1adminOverveiw_table_recent _box_shadow _border_radious _mar_b30 _p20">
					<p class="_title0">Tags<Button type="primary" @click="addModal = true">Add Admin</Button></p>


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
        title="Add admin"
        :mask-closeable="false"
        :closeable="false"
        >

     <Input v-model="data.fullName" type="text"  placeholder="Enter your name." style="width: 200px" /><br>
     <Input v-model="data.email" type="email"  placeholder="Enter email" style="width: 200px;margin:5px 0px" /><br>
     <Input v-model="data.password" type="password"  password placeholder="Enter your password" style="width: 200px" />
     <div class="space"></div>
     <Select v-model="data.userType" style="width:200px">
        <Option value="Admin">Admin New</Option>
        <Option value="Admin">Editor</Option>
    </Select>

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

     <deleteModal></deleteModal>
			</div>
		</div>
    </div>
</template>
<script>
import deleteModal from '../components/deleteModal'
import {mapGetters} from 'vuex'
export default {

data(){
    return{
      data:{
          fullName:' ',
          email:' ',
          password:' ',
          userType:' '

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
async deleteTag(){
    this.isDeleting=true;
//     if(!confirm('Are you sure you want to delete this?')) return
//    tag.isDeleting=true
    // this.$set(tag,'isDeleting',true);
    const res=await this.callApi('post','app/delete_tag',this.deleteItem);
    if(res.status===200){
        this.tags.splice(this.deletingIndex,1);

    }
     this.isDeleting=true;
       this.showDeleteModal=false;
},



      	showDeletingModal(tag, index){
			const deleteModalObj  =  {
				showDeleteModal: true,
				deleteUrl : 'app/delete_tag',
				data : tag,
				deletingIndex: index,
				isDeleted : false,
			}

			this.$store.commit('setdeletingModalObj', deleteModalObj)
			// console.log('delete method called')

    },



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
},
components:{
    deleteModal
},
computed:{
        ...mapGetters(['getDeleteModalObj'])
    },

  watch : {
		getDeleteModalObj(obj){
			if(obj.isDeleted){
				this.tags.splice(obj.deletingIndex,1)
			}
		}
},


}
</script>

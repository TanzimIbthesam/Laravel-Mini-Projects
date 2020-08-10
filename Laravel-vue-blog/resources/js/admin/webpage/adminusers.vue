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
                                 <th>Name</th>
								<th>Email</th>
								<th>User Type</th>
								<th>Created At</th>
                                 <th>Action</th>
							</tr>
								<!-- TABLE TITLE -->


								<!-- ITEMS -->
								<tr v-for="(user, index) in users" :key="index">
								<td>{{user.id}}</td>
								<td>{{user.fullname}}</td>
								<td>{{user.email}}</td>
								<td>{{user.userType}}</td>
								<td>{{user.created_at}}</td>
								<td>

									<Button size="small" type="primary" v-on:click="showEditModal(user,index)">Edit</Button>
									<Button type="error" size="small" @click="showDeletingModal(user, index)"  >Delete</Button>


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

      <label for="">Enter your name</label><br>
       <Input type="text"  v-model="data.fullname"   placeholder="Enter your name" style="width: 300px" /><br>
       <label for="">Enter your email</label><br>
     <Input type="email"  v-model="data.email"   placeholder="Enter email" style="width: 300px;margin:5px 0px" /><br>
     <label for="">Enter your password</label><br>
       <Input type="password" v-model="data.password"  placeholder="Enter your password" style="width: 300px" />




     <div class="space"></div>
     <Select v-model="data.userType" placeholder="Select admin type" style="width:200px">
        <Option value="Admin">Admin New</Option>
        <Option value="Editor">Editor</Option>
    </Select>

        <div slot="footer">
            <Button type="default" v-on:click="addModal=false">Close</Button>
              <Button type="primary" @click="addAdmin" :disabled="isAdding" :loading="isAdding">
                  {{isAdding ? 'Adding..' : 'Add Admin'}}</Button>

        </div>

    </Modal>
    <!-- <-- Tag Editing Modal  -->
<Modal
        v-model="editModal"
        title="Edit Users"
        :mask-closeable="false"
        :closeable="false"
        >
   <label for="">Enter your name</label><br>
       <Input type="text"  v-model="editData.fullname"   placeholder="Enter your name" style="width: 300px" /><br>
       <label for="">Enter your email</label><br>
     <Input type="email"  v-model="editData.email"   placeholder="Enter email" style="width: 300px;margin:5px 0px" /><br>
     <label for="">Enter your password</label><br>
       <Input type="password" v-model="editData.password"  placeholder="Enter your password" style="width: 300px" />
       <div class="space"></div>
     <Select v-model="editData.userType" placeholder="Select admin type" style="width:200px">
        <Option value="Admin">Admin New</Option>
        <Option value="Editor">Editor</Option>
    </Select>
 <div slot="footer">
            <Button type="default" v-on:click="editModal=false">Close</Button>
              <Button type="primary" @click="editAdmin" :disabled="isAdding" :loading="isAdding">
                  {{isAdding ? 'Editing..' : 'Edit Admin'}}</Button>

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
          fullname:' ',
          email:' ',
          password:' ',
          userType:' '

      },
     addModal:false,
     isAdding:false,
      users :[],
     editModal:false,
    //  tags:[],
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
   async addAdmin(){
    //  if(this.data.fullname.trim( )=='') return this.error('Full Name Name is required')
    //  if(this.data.email.trim( )=='') return this.error('Email is required')
    //  if(this.data.password.trim( )=='') return this.error('Password is required')
    //  if(this.data.userType.trim( )=='') return this.error('UserType is required')
     const res=await this.callApi('post','app/create_user',this.data);
     if(res.status===201){
         this.users.unshift(res.data);
         this.success('Admin has  has been added successfully');

         this.addModal=false;
     }else{
         if(res.status=422){
            // console.log(res.data.errors)
            for(let i in res.data.errors){
                this.error(res.data.errors[i][0]);
            }

         }else{
              this.error();
         }

     }
	// if(this.data.tagName.trim()=='') return this.e('Tag name is required')
},
  async editAdmin(){
        if(this.editData.fullname.trim( )=='') return this.error('Full Name Name is required')
        if(this.editData.email.trim( )=='') return this.error('Email is required')
        if(this.editData.userType.trim( )=='') return this.error('User Type is required')



     const res=await this.callApi('post','app/edit_user',this.editData);
     if(res.status===200){
        this.users[this.index] = this.editData
         this.success('Tag has been edited successfully');

         this.editModal=false;
     }else{
         if(res.status=422){
              for(let i in res.data.errors){
                this.error(res.data.errors[i][0]);
            }

         }else{
              this.error();
         }

     }
// 	// if(this.data.tagName.trim()=='') return this.e('Tag name is required')
// }


},

showEditModal(user,index){
    // this.editData=tag
    // this.editModal=true
   let obj = {
				id : user.id,
				fullname : user.fullname,
				email : user.email,
				userType : user.userType,
			}
			this.editData = obj
			this.editModal = true
			this.index = index
    // this.editData=obj
    // this.editModal=true
    // this.index=index
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
    const res=await this.callApi('get', 'app/get_users');
    // console.log(res);
    if(res.status==200){
          this.users = res.data;
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

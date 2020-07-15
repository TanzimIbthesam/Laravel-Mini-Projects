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

									<Button type="primary" size="small">Edit</Button>
									<Button type="error" size="small">Delete</Button>


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
    <!-- Tag Editing Modal -->
<!-- <Modal
        v-model="editModal"
        title="Edit Tag"
        :mask-closeable="false"
        :closeable="false"
        >
  <Input v-model="editData.tagName" placeholder="Enter something..." style="width: 300px" />
        <div slot="footer">
            <Button type="default" v-on:click="addModal=false">Close</Button>
              <Button type="primary" @click="addTag" :disabled="isAdding" :loading="isAdding"> {{isAdding ? 'Adding..' : 'Add Tag'}}</Button>

        </div>

    </Modal> -->
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
     tags:[]
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
//   async editTag(){
//      if(this.editData.tagName.trim( )=='') return this.error('Tag Name is required')
//      const res=await this.callApi('post','app/create_tag',this.data);
//      if(res.status===201){
//          this.success('Tag has been added successfully');

//          this.addModal=false;
//      }else{
//          if(res.status=422){
//              if(res.data.errors.tagName){
//                      this.index(res.data.errors.tagName[0]);
//              }

//          }else{
//               this.error();
//          }

//      }
// 	// if(this.data.tagName.trim()=='') return this.e('Tag name is required')
// }


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

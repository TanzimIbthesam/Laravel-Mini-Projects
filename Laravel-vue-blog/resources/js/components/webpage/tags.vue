<template>
    <div>
       <div class="content">
			<div class="container-fluid">

				<!--~~~~~~~ TABLE ONE ~~~~~~~~~-->
				<div class="_1adminOverveiw_table_recent _box_shadow _border_radious _mar_b30 _p20">
					<p class="_title0">Tags <Button type="primary" size="normal"> <Icon type="md-add" />  Add New tag</Button></p>


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
							<tr>
								<td>25-05-19</td>
								<td class="_table_name">Manhattan's art center "Shed" opening ceremony</td>
								<td>Economy</td>
								<td>
                                           <Button type="primary" size="small">Edit</Button>
                                           <Button type="error" size="small">Delete</Button>
									<!-- <button class="_btn _action_btn edit_btn1" type="button">Edit</button>

									<button class="_btn _action_btn make_btn1" type="button">Delete</button> -->
								</td>
							</tr>
								<!-- ITEMS -->

								<!-- ITEMS -->

								<!-- ITEMS -->

										<!-- ITEMS -->

								<!-- ITEMS -->

								<!-- ITEMS -->

								<!-- ITEMS -->

								<!-- ITEMS -->

								<!-- ITEMS -->


						</table>
					</div>
				</div>


			</div>
		</div>
    </div>
</template>
<script>
export default {
async created(){
    const res=await this.callApi('post','app/create_tag',{tagName:'testtag'});
    console.log(res);
    if(res.status==200){

    }
}
}
</script>

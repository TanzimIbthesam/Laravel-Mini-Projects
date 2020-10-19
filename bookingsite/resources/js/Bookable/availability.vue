<template>
    <div>
         <h4 class="text-uppercase text-secondary font-weight-bolder">Availability and prices</h4>
      <div class="form-row">
          <div class="form-group col-md-6">
            <label for="">From</label>
            <input @keyup.enter="check" type="text" name="from"  class="form-control form-control-sm"
             placeholder="Start date" v-model="from">
          </div>
          <div class="form-group col-md-6">
            <label for="">To</label>
            <input @keyup.enter="check"  type="text" name="to" class="form-control form-control-sm"
             placeholder="End date" v-model="to">
          </div>
          <button :disabled="loading" @click="check()" class="btn btn-secondary btn-block">Check </button>
      </div>
    </div>
</template>
<script>

export default {
data() {
    return {
        from:null,
        to:null,
        loading:false,
        status:null,
        errors:null
    }
},
methods:{
    check(){
        this.loading=true;
        this.errors=null;
        axios.get
        ('/api/bookables/${this.$route.params.id}/availability?from={this.from}&to={this.to}')
       .then(response=>{
           this.status=response.status
       })
       .catch(error=>{
            if(422===error.response.status){
                console.log(error.response.data.errors);
                this.errors=error.response.data.errors
            }
            this.status=error.response.status
       })
       .then(()=>(this.loading=false));

    }
}
}
</script>
<style scoped>
label{
    font-size: 0.7rem;
    text-transform: uppercase;
    color: gray;
    font-weight: cold;
}

</style>

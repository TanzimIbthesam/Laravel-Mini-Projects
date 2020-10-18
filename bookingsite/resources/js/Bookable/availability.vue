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
          <button @click="check()" class="btn btn-secondary btn-block">Check </button>
      </div>
    </div>
</template>
<script>

export default {
data() {
    return {
        from:null,
        to:null
    }
},
methods:{
    check(){
        alert('I will do something now');
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

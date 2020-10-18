<template>
    <div>
         <h4 class="text-uppercase text-secondary font-weight-bolder">Availability and prices</h4>
      <div class="form-row">
          <div class="form-group col-md-6">
            <label for="">From</label>
            <input type="text" name="from" id="" class="form-control form-control-sm"
             placeholder="Start date" v-model="from">
          </div>
          <div class="form-group col-md-6">
            <label for="">To</label>
            <input type="text" name="to" id="to" class="form-control form-control-sm"
             placeholder="End date" v-model="to">
          </div>
          <button class="btn btn-secondary btn-block">Check </button>
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

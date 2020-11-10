<template>
    <div class="d-flex w-50 m-auto align-items-center">
         <div class="card card-body">
            <form action="">
                <div class="form-group">
                    <label for="email">Email</label>
                     <input type="text"
                     name="email" id=""
                     class="form-control"
                     placeholder="Enter your email"
                     v-model="email"><br>
                      </div>
                      <div class="form-group">
                    <label for="password">Password</label>
                     <input
                     type="password"
                     name="" id=""
                     class="form-control"
                     placeholder="Enter your password"
                     v-model="password"><br>
                     </div>
                     <button class="btn btn-primary btn-lg btn-block">Login</button>
                          <hr />
                          <span class="text-nowrap">
                              No Account yet?
                              <router-link :to="{name:'home'}">Register</router-link>
                          </span><br>
                          <span class="text-nowrap">
                              Forgot your password?
                              <router-link :to="{name:'password'}">Reset Password</router-link>
                          </span>
                        </form>
                </div>
                </div>



</template>
<script>
export default {
 data() {
     return {
         email:null,
         password:null
     }
 },
}
</script>

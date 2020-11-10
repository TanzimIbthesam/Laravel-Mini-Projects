<template>
    <div class="d-flex w-50 m-auto align-items-center">
         <div class="card card-body">
            <form action="">
                <div class="form-group">
                    <label for="email">Email</label>
                     <input type="text"
                     name="email"
                     class="form-control"
                     :class="[{'is-invalid':errorFor('email')}]"
                     placeholder="Enter your email"
                     v-model="email"/>
                     <v-errors :errors="errorFor('email')"></v-errors>
                      </div>
                      <div class="form-group">
                    <label for="password">Password</label>
                     <input
                     type="password"
                     name=""
                     class="form-control"
                    :class="[{'is-invalid':errorFor('password')}]"

                     placeholder="Enter your password"
                     v-model="password"/>
                   <v-errors :errors=" errorFor('password')"></v-errors>
                     </div>
                     <button
                     type="submit"
                     :disabled="loading"
                     class="btn btn-primary btn-lg btn-block"
                     @click.prevent="login"
                     >Login</button>
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
import validationErrors from '../shared/mixins/validationErrors'
export default {
      mixins:[validationErrors],
 data() {

     return {
         email:null,
         password:null,
         loading:false
     }
 },
 methods: {
     async login(){
         this.loading=true;
         this.erros=null;
           try {
                await axios.get("/sanctim.csrf-cookie");
        await axios.post("/login",{
             email:this.email,
             password:this.password
        });
        await axios.get('/user')

           } catch (error) {
               this.errors=error.response && error.response.data.errors;

           }
         this.loading=false;
     }
 },
};
</script>


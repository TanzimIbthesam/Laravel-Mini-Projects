<template>
    <div class="d-flex w-50 m-auto align-items-center">
         <div class="card card-body">
            <form action="">
                <div class="form-group">
                    <label for="name">Name</label>
                     <input type="text"
                     name="name"
                     class="form-control"
                     :class="[{'is-invalid':errorFor('name')}]"
                     placeholder="Enter your name"
                     v-model="user.name"/>
                     <v-errors :errors="errorFor('name')"></v-errors>
                      </div>
                      <div class="form-group">
                    <label for="email">Email</label>
                     <input
                     type="password"
                     name="password"
                     class="form-control"
                    :class="[{'is-invalid':errorFor('email')}]"

                     placeholder="Enter your email"
                     v-model="user.email"/>
                   <v-errors :errors=" errorFor('email')"></v-errors>
                     </div>
                      <div class="form-group">
                    <label for="password">Enter your password</label>
                     <input
                     type="password"
                     name="password"
                     class="form-control"
                    :class="[{'is-invalid':errorFor('password')}]"

                     placeholder="Enter your password"
                     v-model="user.password"/>
                   <v-errors :errors=" errorFor('password')"></v-errors>
                     </div>
                     <div class="form-group">
                    <label for="name">Password Confirmation</label>
                     <input type="text"
                     name="password_confirmation"
                     class="form-control"
                     :class="[{'is-invalid':errorFor('password_confirmation')}]"
                     placeholder="Confirm your password"
                     v-model="user.password_confirmation"/>
                     <v-errors :errors="errorFor('password_confirmation')"></v-errors>
                      </div>
                     <button
                     type="submit"
                     :disabled="loading"
                     class="btn btn-primary btn-lg btn-block"
                     @click.prevent="register"
                     >Register</button>
                          <hr />
                          <span class="text-nowrap">
                              Already have an accountt?
                              <router-link :to="{name:'login'}">Login</router-link>
                          </span><br>

                        </form>
                </div>
                </div>



</template>
<script>
import validationErrors from '../shared/mixins/validationErrors';
import { logIn} from '../shared/utils/auth';
export default {
      mixins:[validationErrors],
 data() {

     return {
         user:{
             name:null,
         email:null,
         password:null,
         password_confirmation:null,
         },

         loading:false
     }
 },
 methods: {
     async register(){
         this.loading=true;
         this.erros=null;
           try {
                await axios.get("/sanctim.csrf-cookie");
        await axios.post("/login",{
             email:this.email,
             password:this.password
        });

              logIn();
              this.$store.dispatch('loadUser');
              this.$router.push({name:'home'});
           } catch (error) {
               this.errors=error.response && error.response.data.errors;

           }
         this.loading=false;
     }
 },
};
</script>


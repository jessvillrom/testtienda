
<template>
  
<div class="col-md-12">


<form @submit.prevent="login">
  <div class="form-group">
    <label for="exampleInputEmail1">Email </label>
    <input type="email" class="form-control" aria-describedby="emailHelp" placeholder="Enter email"  v-model="registro.email">
    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
  </div>

  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password"  v-model="registro.password">
  </div>

  <!-- <div class="form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Check me out</label>
  </div> -->
  <button type="submit" class="btn btn-primary">Ingresar</button>
</form>



</div>

</template>

<script>
export default {


    data(){
      return{
        // registros:[],
        registro:{email:'',name:'',password:''}
      }
    },

    methods:{
      registrar(){
      
        axios.post('api/regitrarse',this.registro)
         .then(response=>{

              console.log('deberiafuncionar');
             

            })
            .catch(error=>{
              console.log('Error y no se por que ');
                console.log(error);
            });


      }
    }




}
</script>
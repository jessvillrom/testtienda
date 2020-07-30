
<template>
  
<div class="col-md-12">


<form @submit.prevent="registrar">
  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" class="form-control" aria-describedby="emailHelp" placeholder="Enter email"  v-model="registro.email">
    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Nombre de la Tienda </label>
    <input type="text" class="form-control" placeholder="Ingrese el Nombre de la Tienda" v-model="registro.name">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password"  v-model="registro.password">
  </div>

  <!-- <div class="form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Check me out</label>
  </div> -->
  <button type="submit" class="btn btn-primary">Submit</button>
</form>

</div>

</template>

<script>
export default {


    data(){
      return{
        registros:[],
        registro:{email:'',name:'',password:''}
      }
    },

    methods:{
      registrar(){
        // console.log(this.registro.email,this.registro.name,this.registro.password);
        const params={
          email:this.registro.email,
          name:this.registro.name,
          password:this.registro.password
          
        }

        // console.log (params);
        // this.registro.email
        axios.post('/register', params)
         .then(response=>{

                this.registros.push(response.data)
                // console.log(response)

            })
            .catch(error=>{
                console.log(error);
            });


      }
    }


    //  mounted() {

    //      axios.get('/register')
    //         .then(response=>{

    //             console.log(response)

    //         })
    //         .catch(error=>{
    //             console.log(error);
    //         });
         
    //     }

}
</script>




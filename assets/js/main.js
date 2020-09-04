const app = new Vue({
  el: '#app',
  data: {
    title: 'App with Vue.js',
    name: "",
    pass: ""
  },
  methods: {
    validar(){

      if(this.name == "johan" && this.pass == "1234"){
        window.location.href = 'newPage.html'
      }else{
        Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: 'Datos incorrectos!',
          footer: '<p>¿No tienes cuenta? <a href="register.html">Registrate.</a></p>'
        })
      }

    }
  }
});

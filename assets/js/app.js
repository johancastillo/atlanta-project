const app = new Vue({
  el: "#app",
  data: {
    credito: "",
    anos: 15,
    downpayment: 3.5,
    intereses: "",
    geting: null,
    result: null,
    results: null
  },
  methods: {
    calcular(){
      const postData = {
        credito: this.credito,
        anos: this.anos,
        downpayment: this.downpayment,
        intereses: this.intereses
      };

      //Enviar datos del formulario a PHP mediante AJAX
      $.post('backend/calcular.php', postData, response =>{

        //Mensaje de exito al crear una nueva tarea
        Swal.fire({
          position: 'top-end',
          icon: 'success',
          title: 'Se aplicaron los calculos correctamente',
          showConfirmButton: false,
          timer: 1500
        });

        //Resetear campos de formularios al enviar datos
        $('#task-form').trigger('reset');


        this.geting = JSON.parse(response);
        this.result = this.geting.data;
        this.results = this.geting.table;
        console.log(this.results);
        //this.results = JSON.parse(response);

      });

    },
    generarPdf(){
      //Redireccionar a otra página con datos mediante POST
      $.redirect('backend/createPdf.php', {'credito': this.credito, 'apellido': 'Castillo'});
    }
  }
});

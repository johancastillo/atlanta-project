const app = new Vue({
  el: "#app",
  data: {
    credito: "",
    anos: 15,
    downpayment: 3.5,
    intereses: "",
    result: null,
    results: [
      {mes: 1, intereses: 24, amortizacion: 23, cuota_mensual: 150, capital_pendiente: 20},
      {mes: 2, intereses: 24, amortizacion: 23, cuota_mensual: 150, capital_pendiente: 20},
      {mes: 3, intereses: 24, amortizacion: 23, cuota_mensual: 150, capital_pendiente: 20},

    ]
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

        console.log(response);
        this.result = JSON.parse(response);
        console.log(this.result);

      });

    }
  }
});

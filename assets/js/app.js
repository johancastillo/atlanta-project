const app = new Vue({
  el: "#app",
  data: {
    credito: "",
    anos: 15,
    downpayment: 3.5,
    intereses: "",
    results: [
      {mes: 1, intereses: 24, amortizacion: 23, cuota_mensual: 150, capital_pendiente: 20},
      {mes: 2, intereses: 24, amortizacion: 23, cuota_mensual: 150, capital_pendiente: 20},
      {mes: 3, intereses: 24, amortizacion: 23, cuota_mensual: 150, capital_pendiente: 20},

    ]
  },
  methods: {
    calcular(){
      alert(result);
    }
  }
});

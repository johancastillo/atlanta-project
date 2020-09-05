const app = new Vue({
  el: "#app",
  data: {
    credito: "",
    anos: 15,
    downpayment: 3,5,
    intereses: ""
  },
  methods: {
    calcular(){
      alert(this.intereses);
    }
  }
});

const app = new Vue({
  el: "#app",
  data: {
    title: "Vue",
    edit: false,
    url: "";
  },
  created(){
    this.url = this.edit === false ? 'task-add.php' : 'task-edit.php';

    //Obtener tareas
    function fetchTasks(){
      $.ajax({
        url:'task-list.php',
        type: 'GET',
        success: function(response){
          let tasks = JSON.parse(response);
          //Plantilla HTML
          let template = '';
          tasks.map(task => {
            template += `
              <tr taskId="${task.id}">
                <td>${task.id}</td>
                <td>
                  ${task.name}
                </td>
                <td>${task.description}</td>
              </tr>
            `
          });

          //Insertar HTML en el DOM
          $('#tasks').html(template);

        }
      });
    };
  },
  methods: {
    guardar(){
      //Prevenir el comportamiento por defecto del evento submit
      e.preventDefault()
      //Enviar datos del formulario
      $.post(url, postData, response =>{
        //Obtener todas las tareas nuevamente al agregar una nueva
        fetchTasks();
        //Mensaje de exito al crear una nueva tarea
        if (this.edit) {
          Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'Tarea editada exitosamente',
            showConfirmButton: false,
            timer: 1500
          });
        }else{
          Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'Tarea agregada exitosamente',
            showConfirmButton: false,
            timer: 1500
          });
        }


        //Resetear campos de formularios al enviar datos
        $('#task-form').trigger('reset');

        this.edit = false;
      });
    });

    }
  }
});

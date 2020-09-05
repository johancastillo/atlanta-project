$(function(){

  let edit = false;

  console.log('JQuery is Working');
  $('#task-result').hide();

  $('#search').keyup(function(e){
    if($('#search').val()){
      let search = $('#search').val();
      $.ajax({
        url: 'task-search.php',
        type: 'POST',
        data: {search: search},
        success: function(response){
          let tasks = JSON.parse(response);
          let template = '';

          tasks.forEach(task => {
            template += `<li>
              ${task.name}
            </li>`
          });

          $('#container').html(template);
          $('#task-result').show();
        }
      })
    }
  });

  $('#task-form').submit(function(e){
    const postData = {
      name: $('#name').val(),
      description: $('#description').val(),
      id: $('#taskId').val()
    };

    //Validar la variable edit
    let url = edit === false ? 'task-add.php' : 'task-edit.php';

    //Prevenir el comportamiento por defecto del evento submit
    e.preventDefault()
    //Enviar datos del formulario
    $.post(url, postData, response =>{
      //Obtener todas las tareas nuevamente al agregar una nueva
      fetchTasks();
      //Mensaje de exito al crear una nueva tarea
      if (edit) {
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

      edit = false;
    });
  });

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

  //Eliminar tareas
  $(document).on('click', '.task-delete', function(){
    //Obtener la fila del boton clickeado
    let element = $(this)[0].parentElement.parentElement;
    //Seleccionar el elemento que tenga el atributo taskId
    let id = $(element).attr('taskId');

    Swal.fire({
      title: '¿Estás seguro de eliminar ésta tarea?',
      text: "Si eliminas, la información se perderá.",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Cancelar',
      confirmButtonText: 'Sí, eliminar'
      }).then((result) => {
        if (result.value) {
          //Enviar ID a eliminar al backend
          $.post('task-delete.php', {id}, function(response){
              fetchTasks();

              //Mostrar mensaje de exito
              Swal.fire(
                'Eliminado',
                'La tarea ha sido aliminada correctamente.',
                'success'
              )

          });

        }
      });

  });

  //Ejecutar la función fetchTasks al cargar la página
  fetchTasks();

  //operacion de editar tarea
  $(document).on('click', '.task-item', function(){
    let element = $(this)[0].parentElement.parentElement;
    let id = $(element).attr('taskId');
    //Enviar ID al backend
    $.post('task-single.php', {id}, function(response){
      const task = JSON.parse(response);

      //Mostrar los datos a editar en el formulario
      $('#name').val(task.name);
      $('#description').val(task.description);
      $('#taskId').val(task.id);

      edit = true;
    });

  });

});

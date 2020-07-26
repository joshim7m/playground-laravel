
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Laravel 5.8 Ajax Example</title>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body> 
  <div class="container">
   <div class="table-wrapper">
    <div class="table-title">
     <div class="row">
      <div class="col-sm-6"> 
        <h2>Manage <b>Tasks</b></h2>
         </div> 
         <div class="col-sm-6">
          <a onclick="event.preventDefault();
                            addTaskForm();" href="#"
                            class="btn btn-success" 
                            data-toggle="modal">
            <i class="fa fa-plus"></i>
             <span>Add New Task</span>
            </a> 
          </div>
           </div>
            </div> 
            <table class="table table-striped table-hover">
             <thead>
              <tr>
               <th>ID</th>
                <th>Task Name</th>
                <th>Description</th>
                <th>Done</th>
                <th>Actions</th> 
              </tr>
              </thead>
                 <tbody> 
                 @foreach($tasks as $task)
                  <tr>
                   <td>{{$task->id}}</td> 
                  <td>{{$task->name}}</td>
                  <td>{{$task->desc}}</td> 
                  <td>{{($task->done) ? 'Yes' : 'No'}}
                  </td>
                  <td>
                  <a onclick="event.preventDefault();
                              editTaskForm({{$task->id}});"
                              href="#" 
                              class="edit open-modal" 
                              data-toggle="modal" 
                              value="{{$task->id}}">
                    <i class="fa fa-pen" data-toggle="tooltip" title="Edit"> Edit
                      </i>
                     </a> 

                  <a onclick="event.preventDefault();
                                    deleteTaskForm({{$task->id}});" 
                                    href="#" 
                                    class="delete" 
                                    data-toggle="modal">
                 <i class="fa fa-trush" data-toggle="tooltip" title="Delete">
                    </i> Delete
                 </a> 
                 </td>
                 </tr> 
                 @endforeach 
                  </tbody>
                   </table>
            </div>
          </div>

          @include('task.add')
          @include('task.edit')
          @include('task.delete')


<script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> 
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 



<script>


$(document).ready(function() { 

  $("#btn-delete").click(function() {
     $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

      $.ajax({ 
        type: 'DELETE', 
        url: '/task/' + $("#frmDeleteTask input[name=task_id]").val(),
       dataType: 'json', 
       success: function(data) { 
        $("#frmDeleteTask .close").click(); 
        window.location.
        reload(); 
       }, 
        error: function(data) {
         console.log(data); 
        } 
       }); 
    });


$("#btn-edit").click(function() {
     $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } }); 

     $.ajax({ 
      type: 'PUT', 
      url: '/task/' + $("#frmEditTask input[name=task_id]").val(), 
      data: { 
        name: $("#frmEditTask input[name=name]").val(),
        desc: $("#frmEditTask input[name=desc]").val(), 
        done: $("#frmEditTask input[name=done]").val(), 
      }, 
       dataType: 'json', 

       success: function(data) {
        $('#frmEditTask').trigger("reset"); 
       $("#frmEditTask .close").click(); 
       window.location.reload(); 
      }, 

       error: function(data) { 
        var errors = $.parseJSON(data.responseText); 
        $('#edit-task-errors').html(''); 
        $.each(errors.messages, function(key, value) {
         $('#edit-task-errors').append('<li>' + value + '</li>'); });
          $("#edit-error-bag")
          .show(); 
        } 
        }); 
    }); 



  $("#btn-add").click(function() {
  $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } }); 

 $.ajax({ type: 'POST', 
  url: '/task', 
  data: { 
    name: $("#frmAddTask input[name=name]").val(), 
    desc: $("#frmAddTask input[name=desc]").val(),
    done: $("#frmAddTask input[name=done]").val(), 
    }, 
  dataType: 'json', 
  success: function(data) { 
    $('#frmAddTask').trigger("reset"); 
    $("#frmAddTask .close").click(); 
    window.location.reload(); 
  }, 

    error: function(data) {
     var errors = $.parseJSON(data.responseText);
      $('#add-task-errors').html(''); 
      $.each(errors.messages, function(key, value) {
       $('#add-task-errors')
       .append('<li>' + value + '</li>'); }); 
      $("#add-error-bag").show(); 
    } 
  });
}); 
}); 




function addTaskForm() { 
   $("#add-error-bag").hide(); 
   $('#addTaskModal').modal('show'); 
}

function editTaskForm(task_id) { 
    $.ajax({ 
      type: 'GET', 
      url: '/task/' + task_id, 
      success: function(data) {
     $("#edit-error-bag").hide(); 
     $("#frmEditTask input[name=name]").val(data.task.name); 
     $("#frmEditTask input[name=desc]").val(data.task.desc); 
     $("#frmEditTask input[name=done]").val(data.task.done); 
     $("#frmEditTask input[name=task_id]").val(data.task.id);
      $('#editTaskModal').modal('show'); 
    }, 

      error: function(data) {
       console.log(data); } 
     });
  }

  function deleteTaskForm(task_id) {
     $.ajax({ 
      type: 'GET', 
      url: '/task/' + task_id, 
      success: function(data) { 
      $("#frmDeleteTask #delete-title").html("Delete Task (" + data.task.name + ")?");
       $("#frmDeleteTask input[name=task_id]").val(data.task.id); 
       $('#deleteTaskModal').
       modal('show');
        }, 
       error: function(data) { 
        console.log(data); 
       } 
      });
    }


</script>
</body>
</html> 
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>

	<meta charset="utf-8">
	<title>Welcome to module users</title>

	<style type="text/css">

	::selection { background-color: #E13300; color: white; }
	::-moz-selection { background-color: #E13300; color: white; }

	body {
		background-color: #fff;
		margin: 40px;
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
	}

	a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
	}

	h1 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 19px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}

	code {
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 10px 12px 10px;
	}

	#body {
		margin: 0 15px 0 15px;
	}

	p.footer {
		text-align: right;
		font-size: 11px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}

	#container {
		margin: 10px;
		border: 1px solid #D0D0D0;
		box-shadow: 0 0 8px #D0D0D0;
	}

	.search_box
 	{
		width:100%;
		max-width: 650px;
		margin:0 auto;
		z-index: 9999999999 !important;
 	}
	.pac-container {
    	z-index: 9999999999 !important;
	}
	
	ul.ui-autocomplete {
    	z-index: 1100 !important;
	}
	</style>
</head>
<body>


	<h1 class="font-weight-bold">Asignaturas</h1>
	<div>
		<button class="btn btn-success float-left ml-3  mt-2" data-toggle="modal" data-target="#addSubject"> <i class="fas fa-plus"></i> Agregar Asginatura</button>
	</div>

<div class="modal fade" id="addSubject" tabindex="-1" role="dialog" aria-labelledby="addSubjectLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title font-weight-bold" id="addSubjectLabel">Agregar Asignatura</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body w-100">
	  <form id="subjectForm">
            <div class="form-group">
                <label for="code_input">Codigo</label>
                <input class ="form-control" type="number" id="code_input" placeholder="Ingrese codigo de la asignatura">
            </div>
	  		<div>
			  <input type="hidden" id="subject_code">
			</div>
			<div class="form-group ">
				<label for="exampleInputPassword1">Nombre de la asignatura</label>
    			<input class="form-control " type="text" id="name_input" placeholder="Nombre de la asignatura" />
            </div>
            <div class="form-group ">
				<label for="exampleInputPassword1">Asignar Docente</label>
    			<select name="selectProffesor" id="select_proffesor" class="form-control">
                    <?= $i=0; foreach($proffesors as $row):?>
                        <option value="<?= $row->id_usuario?>">
						<?= $row->nombres .' '. $row->apellido_paterno?>
                        </option>
                    <?= $i++;endforeach;?>
                </select>
			</div>


			<div class="form-group ">
				<label for="exampleInputPassword1">Semestre</label>
    			<select name="selectSemestre" id="select_semester" class="form-control">
                   
                        <option value="1">
                            1
                        </option>
						<option value="2">
                            2
                        </option>
                    
                </select>
			</div>
			
			<button type="submit"  class="btn btn-primary">Guardar</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
       
      </div>
    </div>
  </div>
</div>

<div id="modal_edit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addSubjectLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title font-weight-bold" id="addSubjectLabel">Agregar Asignatura</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body w-100">
	  <form id="subjectEditForm">
	  		<div class="form-group">
              <label for="exampleInputPassword1">Codigo de la asignatura</label>
			  <input class ="form-control" type="text" id="subject_code_edit"   placerholder="Codigo de la asignatura" disabled>
			</div>
			<div class="form-group ">
				<label for="exampleInputPassword1">Nombre de la asignatura</label>
    			<input class="form-control " type="text" id="name_input_edit" placeholder="Nombre de la asignatura" />
            </div>
            
            <div class="form-group ">
				<label for="exampleInputPassword1">Asignar Docente</label>
    			<select name="selectProffesor" id="select_proffesor1" class="form-control">
                    <?= $i=0; foreach($proffesors as $row):?>
                        <option value="<?= $row->id_usuario?>">
						<?= $row->nombres .' '. $row->apellido_paterno?>
                        </option>
                    <?= $i++;endforeach;?>
                </select>
			</div>


			<div class="form-group ">
				<label for="exampleInputPassword1">Semestre</label>
    			<select name="selectSemestre" id="select_semester1" class="form-control">
                   
                        <option value="1">
                            1
                        </option>
						<option value="2">
                            2
                        </option>
                    
                </select>
			</div>
			
			<button type="submit"  class="btn btn-primary">Guardar</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
       
      </div>
        </div>
    </div>
</div>



<div id="modal_add_student" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addSubjectLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title font-weight-bold" id="addSubjectLabel">Agregar Estudiantes</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body w-100">
	  <form id="subjectAddStudentForm">
	  		<div class="form-group ">
              <label for="exampleInputPassword1">Instancia Asignatura</label>
			<select name="instance_subject" id="instance_subject" class="form-control">
					
			</select>

			</div>
			
			<div class="form-group ">
				<label for="exampleInputPassword1">Matricula del estudiante</label>
    			<input class="form-control " type="text" id="matricula_input_add" placeholder="Matricula del estudiante" />
            </div>

			<div class="form-group ">
				<label for="exampleInputPassword1">Nombre del estudiante</label>
    			<input class="form-control " type="text" id="name_input_add" placeholder="Nombre del estudiante" />
            </div>

			<div class="row">
			<div class="col-6">

			<div class="form-group ">
				<label for="exampleInputPassword1">Apellido Paterno</label>
    			<input class="form-control " type="text" id="lastname1_input_add" placeholder="Apellido Paterno" />
            </div>

			</div>
			<div class="col-6">
			<div class="form-group ">
				<label for="exampleInputPassword1">Apellido Materno</label>
    			<input class="form-control " type="text" id="lastname2_input_add" placeholder="Apellido Materno" />
            </div>
			</div>
			
			</div>
			<button type="submit"  class="btn btn-primary">Guardar</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
       
      </div>
        </div>
    </div>
</div>










<div class="row w-100 p-5">
<?$i=1; foreach($subjects as $row):?>
<div class="col-3">

<div class="card" style="width: 20rem;">

  <div class="card-body">
    <h5 class="card-title"><?= $row->nombre?></h5>
    <h6 class="card-subtitle mb-2 text-muted mb-3"><?= $row->codigo?></h6>
	<button class="btn btn-primary float-right m-1" data-toggle="tooltip" data-placement="bottom" title="Ver asignatura" id="seeSubject" onclick="to_modal(<?=$row->id?>)"><i class="fas fa-eye"></i></button>
    <button class="btn btn-primary float-right m-1" id="addStudent" data-toggle="tooltip"  data-placement="bottom" title="Agregar estudiante" onclick="to_modal_add(<?=$row->id?>)"><i class="fas fa-user-graduate"></i></button>
    <button class="btn btn-primary float-right m-1" id="seeSubject" data-toggle="tooltip" data-placement="bottom" title="Editar asignatura" onclick="to_modal_edit(<?=$row->id?>)"><i class="fas fa-edit"></i></button>
  </div>
  
</div>

</div>
<?$i++;endforeach;?>



<script>





</script>


<script type="text/javascript">

    $(document).ready(function(){
		$("#subjectForm").on('submit',function(e){
			e.preventDefault();
			if($("#name_input").val()=='' || $("#code_input").val()=='')
			{
				alert("Campos obligatorios");
			}
			else
			{	
				let semester = $("#select_semester").val();
				let name = $("#name_input").val();
				let code = $("#code_input").val();
                let proffesor = $("#select_proffesor").val();

                console.log("datos: " + name + " "+ code + " "+ proffesor);

				$.ajax({
					url: "<?php echo base_url('subject/add_subject_with_instance'); ?>",
					method: "POST",
					data: {'name':name, 'code':code, 'proffesor': proffesor, 'semester': semester},
					success:function(respuesta){
						
						location.reload();
						console.lgo(respuesta);
					}
				});
			}

		}

		)
	});

    function to_modal_edit(index)
    {




       
		$.ajax({
				type: 'GET',
				dataType: "json",
				url: '<?= base_url('subject/subjects/');?>'+index,
				success: function(respuesta) {
					console.log(respuesta);
					$('#subject_code_edit').val(respuesta[0].codigo);
					$('#name_input_edit').val(respuesta[0].nombre);
					$("#modal_edit").modal('show');
				},
				error: function() {
					console.log("No se ha podido obtener la información");
				}
			});


        
    }





	function to_modal(index)
    {
      

		$(location).attr('href','<?= base_url('subject/show_subjects/')?>'+index);
        
    }




	function to_modal_add(index)
    {
        $("#subject_code_add").val($("#id"+index).val());
        $("#name_input_add").val($("#n"+index).val());
		

		$.ajax({
				type: 'GET',
				dataType: "json",
				url: '<?= base_url('subject/instances/');?>'+index,
				success: function(respuesta) {
					console.log(respuesta);
					for (let i in respuesta)
					{
						
						$("#instance_subject").append('<option value='+respuesta[i].id+'>'+respuesta[i].nombre+' '+respuesta[i].anho+'-'+respuesta[i].semestre+'</option>');
					}
					$("#modal_add_student").modal('show');
					$("#modal_add_student").on('hidden.bs.modal', function () {
							   
						$('option', '#instance_subject').remove();
              		});

				},
				error: function() {
					console.log("No se ha podido obtener la información");
				}
});


        
    }

	
			
	
    $(document).ready(function(){
		$("#subjectEditForm").on('submit',function(e){
			e.preventDefault();
			if($("#name_input_edit").val()=='')
			{
				alert("Campo obligatorios");
			}
			else
			{
				let name = $("#name_input_edit").val();
				let code = $("#subject_code_edit").val();
				let proffesor = $("#select_proffesor1").val();
				let semestre = $("#select_semester1").val();
				$.ajax({
					url: "<?php echo base_url('subject/edit_subject_with_instance'); ?>",
					method: "POST",
					data: {'name':name, 'code':code, 'proffesor': proffesor, 'semestre': semestre},
					success:function(){
						location.reload();
					}
				});
			}

		}

		)
	});




	$(document).ready(function(){
		$("#subjectAddStudentForm").on('submit',function(e){
			e.preventDefault();
			if($("#name_input_add").val()=='' || $("#matricula_input_add").val()=='' || $("#lastname1_input_add").val()=='' ||  $("#lastname2_input_add").val()=='')
			{
				alert("Campo obligatorios");
			}
			else
			{
				let id = $("#instance_subject").val();
				let matricula = $("#matricula_input_add").val();
				let name = $("#name_input_add").val();
				let lastname1 =  $("#lastname1_input_add").val();
				let lastname2 =  $("#lastname2_input_add").val();
				$.ajax({
					url: "<?php echo base_url('students/add_student'); ?>",
					method: "POST",
					data: {'matricula':matricula, 'nombre':name, 'apellido_p':lastname1, 'apellido_m':lastname2, 'subject_id': id},
					success:function(respuesta){

						console.log(respuesta);
						location.reload();
					}
				});
			}

		}

		)
	});




	


</script>
</body>
</html>
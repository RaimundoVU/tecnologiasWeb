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

<div id="container">
	<h1 class="font-weight-bold">Asignaturas</h1>
	<div>
		<button class="btn btn-success float-right mr-2 mb-2" data-toggle="modal" data-target="#addSubject">Agregar</button>
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
	  		<div>
			  <input type="hidden" id="subject_code">
			</div>
			<div class="form-group ui-widget">
				<label for="exampleInputPassword1">Nombre de la asignatura</label>
    			<input class="form-control " type="text" id="search_input" placeholder="Buscar Asignatura" autocomplete="off" />
			</div>
			
			<div class="form-group">
			<label for="exampleInputPassword1">Semestre</label>
				<select class="custom-select" id="semesterInput">
					<option selected>Escoja un Semestre</option>
					<option value="1">1</option>
					<option value="2">2</option>
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


	<div id="body">
	<table class="table table-white">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Codigo </th>
	  <th scope="col">Nombre </th>
	  <th scope="col">Semestre</th>
	  <th scope="col">Estado</th>
      <th scope="col">Opciones</th>
    </tr>
  </thead>
  <tbody>
  <? ?>
  <?$i=0; foreach($subjects as $row):?>
	<tr>
	<th scope="row"><? echo $i+1?></th>
	<td><input type="hidden" id="id<?=$i?>" value="<?=$row->id?>" readonly>
	<? echo $row->codigo?></td>
	<td><? echo $row->nombre ?></td>
	<td><? echo $row->anho?>-<? echo $row->semestre?></td>
	<td><? echo $row->estado ? 'Activo' : 'Cerrado';?></td>
	<td><button class="btn btn-primary" id="seeSubject" onclick="to_students(<?=$i?>)">Estudiantes</button> 
	<button class="btn btn-primary" onclick="openEvaluation(<?=$row->id?>)">Evaluaciones</button>
	<button class="btn btn-primary" onclick="openMonitoreo(<?=$row->id?>)">Monitorear</button>  
	<button class="btn btn-primary" onclick="openSubject(<?=$row->id?>)">Ver</button> 
	<button class="btn btn-primary" onclick="closeSubject(<?=$row->id?>)">Cerrar Modulo</button> 
	</tr>
	<?$i++;endforeach;?>
  </tbody>
</table>
	</div>

</div>

	
<script type="text/javascript">
	
	$(function() {
		$("#search_input").autocomplete({
			source: "<?php echo base_url('subject/fetch'); ?>",
			select: function( event, ui ) {
				event.preventDefault();
				$("#search_input").val(ui.item.value);
				$("#subject_code").val(ui.item.id);
			}
		});
	});

	$(document).ready(function(){
		$("#subjectForm").on('submit',function(e){
			e.preventDefault();
			if($("#subject_code").val()=='' || $("#semesterInput").val()=='')
			{
				alert("Campos obligatorios");
			}
			else
			{
				let semester = $("#semesterInput").val();
				let code = $("#subject_code").val();
				$.ajax({
					url: "<?php echo base_url('subject/add_subject_instance'); ?>",
					method: "POST",
					data: {'semester':semester, 'idSubject':code},
					success:function(){
						location.reload();
					}
				});
			}

		}

		)
	});

	function to_students(index)
	{
		let subject_id = $("#id"+index).val();
		window.location.replace("<?php echo base_url('students/subject/'); ?>" + subject_id);	
	}

	function openEvaluation(id) {
		window.location.replace("<?php echo base_url('evaluation/ev/'); ?>" + id);	
	}

	function openMonitoreo(id)
	{
		window.location.replace("<?php echo base_url('subject/monitoreo/'); ?>" + id);
	}

	function openSubject(id) {
		let subject_id = $("#id"+id).val();
		window.location.replace("<?php echo base_url('subject/detail/'); ?>" + subject_id);	
	}

	function closeSubject(id) {
		let code = id;
		$.post(
			"<?php echo base_url('subject/close_subject/'); ?>", {
				code: code,
			},
			function(data) {
				alert(data);
				$("#container").hide('slow');
				location.reload();
				$("#container").show('slow');
			}
		)
	}

	
</script>
</body>
</html>

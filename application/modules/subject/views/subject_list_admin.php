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
            <div class="form-group">
                <label for="code_input">Codigo</label>
                <input class ="form-control" type="number" id="code_input" placeholder="Ingrese codigo de la asignatura">
            </div>
	  		<div>
			  <input type="hidden" id="subject_code">
			</div>
			<div class="form-group ">
				<label for="exampleInputPassword1">Nombre de la asignatura</label>
    			<input class="form-control " type="text" id="name_input" placeholder="Buscar Asignatura" />
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
        <h5 class="modal-title font-weight-bold" id="addSubjectLabel">Editar Asignatura</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body w-100">
	  <form id="subjectEditForm">
	  		<div>
			  <input type="hidden" id="subject_code_edit">
			</div>
			<div class="form-group ">
				<label for="exampleInputPassword1">Nombre de la asignatura</label>
    			<input class="form-control " type="text" id="name_input_edit" placeholder="Editar Asignatura" />
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
	<td>
    <input type="hidden" id="n<?=$i?>" value="<?=$row->nombre?>" readonly>
    <p><? echo $row->nombre ?></p>
    </td>
	<td><button class="btn btn-primary" id="seeSubject" onclick="to_modal(<?=$i?>)">Editar</button>  
	</tr>
	<?$i++;endforeach;?>
  </tbody>
</table>
	</div>

</div>

	
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
				let name = $("#name_input").val();
				let code = $("#code_input").val();
				$.ajax({
					url: "<?php echo base_url('subject/add_subject'); ?>",
					method: "POST",
					data: {'name':name, 'code':code},
					success:function(){
						location.reload();
					}
				});
			}

		}

		)
	});

    function to_modal(index)
    {
        $("#subject_code_edit").val($("#id"+index).val());
        $("#name_input_edit").val($("#n"+index).val());
        $("#modal_edit").modal('show');
    }

    $(document).ready(function(){
		$("#subjectEditForm").on('submit',function(e){
			e.preventDefault();
			if($("#name_input_edit").val()=='' )
			{
				alert("Campo obligatorios");
			}
			else
			{
				let name = $("#name_input_edit").val();
				let code = $("#subject_code_edit").val();
				$.ajax({
					url: "<?php echo base_url('subject/edit_subject'); ?>",
					method: "POST",
					data: {'name':name, 'code':code},
					success:function(){
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
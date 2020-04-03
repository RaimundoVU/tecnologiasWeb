<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>Welcome to module students</title>

	<style type="text/css">
		::selection {
			background-color: #E13300;
			color: white;
		}

		::-moz-selection {
			background-color: #E13300;
			color: white;
		}

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

		ul.ui-autocomplete {
			z-index: 1100 !important;
		}
	</style>
</head>

<body id="student_body">
	<div id="container">
		<h1>Módulo Estudiantes</h1>
		<div>
			<div class="row pl-2 mb-4">
				<div class="col-lg-3">
				<button class="btn btn-primary" onclick="mostrarModal()">Agregar estudiante</button>
				<a class="btn btn-primary" href="<?php echo base_url(); ?>/students/export_excel/<?php echo($id_asig)?>">Exportar Excel</a>
				</div>
				
				<div class="col-lg-6">
				<input type="file" class="custom-file-input" id="validatedCustomFile" name="file">
				<label class="custom-file-label" for="validatedCustomFile">Elegir Archivo Excel...</label>
				
				</div>

				<div class="col-lg-1">

				<button type="submit" name="import" onclick="excel_upload()" class="float-right btn btn-primary">Importar</button>
				</div>
				
			</div>
		</div>
		<div id="body">
			<div id="listado">
				<table class="table">
					<th>Matricula</th>
					<th>Nombre</th>
					<th>Apellido Paterno</th>
					<th>Apellido Materno</th>
					<th></th>
					<th></th>
					<input type="hidden" id="id_asig" value=<?= "$id_asig" ?> readonly>
					<? $i = 0;
					foreach ($resultado as $row) : ?>
						<tr>
							<td>
								<input type="hidden" id="a<?= $i ?>" value=<?= "$row->matricula" ?> readonly>
								<p><?= $row->matricula ?></p>
							</td>
							<td>
								<input type="hidden" id="b<?= $i ?>" value=<?= "$row->nombre" ?> readonly>
								<p><?= $row->nombre ?></p>
							</td>
							<td>
								<input type="hidden" id="c<?= $i ?>" value=<?= "$row->apellido_paterno" ?> readonly>
								<p><?= $row->apellido_paterno ?></p>
							</td>
							<td>
								<input type="hidden" id="d<?= $i ?>" value=<?= "$row->apellido_materno" ?> readonly>
								<p><?= $row->apellido_materno ?></p>
							</td>
							<td><button class="btn btn-info" onclick="verResumen(<?= $i ?>)">Resumen</button></td>
							<td><button class="btn btn-info" onclick="editar(<?= $i ?>)">Editar</button></td>
						</tr>
					<? $i++;
					endforeach; ?>
				</table>
			</div>
		</div>

	</div>

</body>

<div id="student_modal" style="display: none;" class="modal" role="dialog">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5>Registrar estudiante</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="form-signin">

					<div class="form-group">
						<div class="form-group ui-widget">
							<input class="form-control " type="text" id="search_matricula" placeholder="Buscar Matricula" autocomplete="off" />
						</div>
					</div>
					<div class="form-group">
						<input type="text" class="form-control" id="nombre_estudiante" placeholder="Nombre Estudiante" name="nombre_estudiante" value="<?php echo set_value('nombre_estudiante'); ?>">
					</div>
					<div class="form-group">
						<input type="text" class="form-control" id="apellido_p" placeholder="Apellido Paterno" name="apellido paterno" value="<?php echo set_value('apellido_p'); ?>">
					</div>
					<div class="form-group">
						<input type="text" class="form-control" id="apellido_m" placeholder="Apellido Materno" name="apellido materno" value="<?php echo set_value('apellido_m'); ?>">
					</div>
				</div>
				<div class="modal-footer">
					<button class="btn btn-danger" data-dismiss="modal">Cancelar</button>
					<button class="btn btn-success" onclick="save_student()" id="upload">Guardar Estudiante</button>
				</div>
			</div>
		</div>
	</div>
</div>

<div id="edit_student_modal" style="display: none;" class="modal" role="dialog">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5>Editar</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="form-signin">

					<div class="form-group">
						<label for="matriculaEdit">Matricula</label>
						<input class="form-control" type="text" placeholder="" id="matriculaEdit" readonly>
					</div>

					<div class="form-group">
						<label for="nombreEdit">Nombre</label>
						<input class="form-control" type="text" id="nombreEdit">
					</div>

					<div class="form-group">
						<label for="apellidoPEdit">Apellido Paterno</label>
						<input class="form-control" type="text" id="apellidoPEdit">

					</div>

					<div class="form-group">
						<label for="apellidoMEdit">Apellido Materno</label>
						<input class="form-control" type="text" id="apellidoMEdit">
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button class="btn btn-warning" data-dismiss="modal">Cancelar</button>
				<button class="btn btn-success" onclick="guardarCambios()">Guardar</button>
			</div>
		</div>
	</div>
</div>

<div id="student_resume_modal" style="display: none;" class="modal" role="dialog">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h2 id ="studentName"></h2>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<h5>Asignaturas Cursadas</h5>
				<div id="resume-table">
				</div>
			<div class="modal-footer">
				<button class="btn btn-warning" data-dismiss="modal">Listo</button>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	var base_url = '<? echo base_url() ?>'

	$(function() {
		$("#search_matricula").autocomplete({
			source: base_url + 'students/fetch_matricula',
			select: function(event, ui) {
				event.preventDefault();
				$("#search_matricula").val(ui.item.value);
				$("#matricula").val(ui.item.value);
				$("#nombre_estudiante").val(ui.item.nombre);
				$("#apellido_p").val(ui.item.apellido_paterno);
				$("#apellido_m").val(ui.item.apellido_materno);
				//$("#subject_code").val(ui.item.id);
			}
		});
	});

	function reload_view() {
		$.post(
			base_url + "students/reload_view", {},
			function(url, data) {
				$("#container").html(url, data);
			}
		)
	}

	function mostrarModal() {
		$("#student_modal").modal('show');
	}

	function save_student() {
		let subject_id = $("#id_asig").val();
		var matricula = $("#search_matricula").val();
		var nombre_estudiante = $("#nombre_estudiante").val();
		var apellido_p = $("#apellido_p").val();
		var apellido_m = $("#apellido_m").val();
		$.post(
			base_url + "students/add_student", {
				matricula: matricula,
				nombre: nombre_estudiante,
				apellido_p: apellido_p,
				apellido_m: apellido_m,
				subject_id: subject_id
			},
			function() {
				$("#student_modal").modal('hide');
				$("#container").hide('slow');
				location.reload();
				$("#container").show('slow');
			}
		)
	}

	function excel_upload() {
		var file_data = $("#validatedCustomFile").prop("files")[0];
		var form_data = new FormData();
		form_data.append("file", file_data);
		form_data.append("subject_id", $("#id_asig").val());
		$.ajax({
			url: base_url + "students/excel_upload",
			type: "POST",
			data: form_data,
			processData: false,
			contentType: false,
			success: function(data) {
				$("#container").hide('slow');
				location.reload();
				alert(data);
				$("#container").show('slow');
			}
		});
	}

	function verResumen(indice) {
		var nombre = $("#b" + indice).val();
		var apellidoPaterno = $("#c" + indice).val();
		var apellidoMaterno = $("#d"+ indice).val();
		var matricula = $("#a" + indice).val();
		$("#studentName").text(nombre + " " + apellidoPaterno + " " +apellidoMaterno);
		$.post(
			base_url + "students/getStudentSubjects/",
			{
				matricula: matricula
			},
			function(url, res) {
				$("#resume-table").html(url, res);
				$("#student_resume_modal").modal('show');
			} 
		);
	}

	function editar(indice) {

		$("#matriculaEdit").val($("#a" + indice).val());
		$("#nombreEdit").val($("#b" + indice).val());
		$("#apellidoPEdit").val($("#c" + indice).val());
		$("#apellidoMEdit").val($("#d" + indice).val());
		$("#edit_student_modal").modal('show');
	}

	function guardarCambios() {
		var matricula = $("#matriculaEdit").val();
		var nombre = $("#nombreEdit").val();
		var apellido_paterno = $("#apellidoPEdit").val();
		var apellido_materno = $("#apellidoMEdit").val();
		$.post(
			base_url + "students/update_student", {
				matricula: matricula,
				nombre: nombre,
				apellido_paterno: apellido_paterno,
				apellido_materno: apellido_materno,
			},
			function() {
				$("#edit_student_modal").modal('hide');
				$("#container").hide('slow');
				location.reload();
				$("#container").show('slow');
			}
		)
	}
</script>

</html>
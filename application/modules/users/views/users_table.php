<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<style>
	.add-button {
		margin-bottom: 10px;
		margin-right: 10px;
	}
</style>

<div class="float-right">
	<button type="button" class="btn btn-success btn-sm add-button" onclick="open_modal_register()">
		Agregar
		<i class="fas fa-plus"></i>
	</button>
</div>

<table class="table">
	<thead>
		<tr>
			<th scope="col">#</th>
			<th scope="col">Nombres</th>
			<th scope="col">Apellido Paterno</th>
			<th scope="col">Apellido Materno</th>
			<th scope="col">Email</th>
			<th scope="col">Tipo</th>
			<th scope="col">Opciones</th>
		</tr>
	</thead>
	<tbody>
		<? $i = 0;
		foreach ($users as $user) : ?>
			<tr>
				<th scope="row"><?= $user->id_usuario ?>
					<input id="id_<?= $i ?>" type="hidden" readonly value="<?= $user->id_usuario ?>">
					<input id="password_<?= $i ?>" type="hidden" readonly value="<?= $user->clave ?>">
				</th>
				<td>
					<?= $user->nombres ?>
					<input id="name_<?= $i ?>" type="hidden" readonly value="<?= $user->nombres ?>">
				</td>
				<td>
					<?= $user->apellido_paterno ?>
					<input id="fathers_<?= $i ?>" type="hidden" readonly value="<?= $user->apellido_paterno ?>">

				</td>
				<td>
					<?= $user->apellido_materno ?>
					<input id="mothers_<?= $i ?>" type="hidden" readonly value="<?= $user->apellido_materno ?>">

				</td>
				<td>
					<?= $user->email ?>
					<input id="email_<?= $i ?>" type="hidden" readonly value="<?= $user->email ?>">

				</td>
				<td>
					<? if ($user->tipo == 1) : ?>
						Administrador
					<? elseif ($user->tipo == 2) : ?>
						Director de carrera
					<? else : ?>
						Docente
					<? endif; ?>
					<input id="type_<?= $i ?>" type="hidden" readonly value="<?= $user->tipo ?>">

				</td>
				<td>
					<button type="button" class="btn btn-warning btn-sm" onclick='open_modal_edit(<?= $i ?>)'>
						Editar
						<i class="fas fa-user-edit"></i>
					</button>
					<button type="button" class="btn btn-danger btn-sm" onclick="delete_user('<?= $user->id_usuario ?>')">Eliminar
						<i class="fas fa-user-times"></i>
					</button>
				</td>
			</tr>

		<? $i++;
		endforeach; ?>

	</tbody>
</table>





<!-- Modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModal" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">


			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Datos de usuario</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">

				<form id="addForm" onkeypress="key_press()">
					<div class="form-group">
						<input type="text" maxlength="82" class="form-control" id="names" placeholder="Nombres">
						<input type="hidden" class="form-control" readonly id="id" value="-1">
					</div>
					<div class="form-group">
						<div class="row">
							<div class="col">
								<input type="text" maxlength="40" class="form-control" id="last-name" placeholder="Apellido Paterno">
							</div>
							<div class="col">
								<input type="text" maxlength="40" class="form-control" id="last-name-mother" placeholder="Apellido Materno">
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<div class="col">
								<input type="email" maxlength="40" class="form-control" id="email" placeholder="Email">
							</div>
							<div class="col">
								<input type="password" maxlength="20" class="form-control" id="password" placeholder="Contraseña">
							</div>
						</div>
					</div>
					<div class="form-group">
						<select id="type" class="form-control form-control">
							<option value="" disabled selected hidden required>Seleccione tipo de usuario</option>
							<option value="1">Administrador</option>
							<option value="2">Director de Carrera</option>
							<option value="3">Docente</option>
						</select>
					</div>
					<!-- Alert form -->
					<div class="alert alert-danger alert-dismissible collapse" id="alert-form" style="margin: 10px">
						<strong>Error, formulario incompleto</strong>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
						<button type="button" onclick="handle_form()" id="register" class="btn btn-primary">Guardar
						</button>
					</div>
				</form>
			</div>

		</div>
	</div>
</div>


<script>
	function key_press() {
		$("#alert-form").hide();
	}

	function reset_form() {
		$('#addForm')[0].reset();
		$('#id').val(-1);
	}

	function handle_form() {

		const id = $('#id').val();
		if (id === '-1') { // is an add
			register_user();
		} else { // is an update
			update_user();
		}
	}

	function open_modal_edit(id) {
		$('#alert-form').hide();

		$('#id').val($('#id_' + id).val());
		$('#names').val($('#name_' + id).val());
		$("#last-name").val($('#fathers_' + id).val());
		$("#last-name-mother").val($('#mothers_' + id).val());
		$("#email").val($('#email_' + id).val());
		$("#password").val($('#password_' + id).val());
		$("#type").val($('#type_' + id).val());

		$('#addModal').modal('show');
	}

	function open_modal_register() {
		reset_form();

		$('#addModal').modal('show');
	}

	function register_user() {
		var name = $("#names").val();
		var last_name = $("#last-name").val();
		var last_name_mother = $("#last-name-mother").val();
		var email = $("#email").val();
		var pswd = $("#password").val();
		var type = $("#type").val();

		var valid = true;

		if (name === '') {
			console.log('name is undefined');
			valid = false;
		} else if (last_name === '') {
			console.log('last name is undefined');
			valid = false;
		} else if (last_name_mother === '') {
			console.log('last name mother is undefined');
			valid = false;
		} else if (email === '') {
			console.log('email is undefined');
			valid = false;
		} else if (pswd === '') {
			console.log('password is undefined');
			valid = false;
		} else if (type == undefined) {
			console.log('user type is undefined');
			valid = false;
		}

		if (!valid) {
			$("#alert-form").show();
			return;
		} else {
			$.post(
				'users/add_user', {
					names: name,
					last_name: last_name,
					mothers_last_name: last_name_mother,
					email: email,
					password: pswd,
					user_type: type
				},
				function(response) {
					$('#addModal').modal('hide');
					$('#users-table').hide();
					load_data();
					$('#users-table').show();
				}
			);
		}
	}

	function update_user() {
		var id = $('#id').val();
		var name = $("#names").val();
		var last_name = $("#last-name").val();
		var last_name_mother = $("#last-name-mother").val();
		var email = $("#email").val();
		var pswd = $("#password").val();
		var type = $("#type").val();

		var valid = true;

		if (name === '') {
			console.log('name is undefined');
			valid = false;
		} else if (last_name === '') {
			console.log('last name is undefined');
			valid = false;
		} else if (last_name_mother === '') {
			console.log('last name mother is undefined');
			valid = false;
		} else if (email === '') {
			console.log('email is undefined');
			valid = false;
		} else if (pswd === '') {
			console.log('password is undefined');
			valid = false;
		} else if (type == undefined) {
			console.log('user type is undefined');
			valid = false;
		}

		if (!valid) {
			$("#alert-form").show();
			return;
		} else {
			$.post(
				'users/update_user', {
					id: id,
					names: name,
					last_name: last_name,
					mothers_last_name: last_name_mother,
					email: email,
					password: pswd,
					user_type: type
				},
				function(response) {
					$('#addModal').modal('hide');
					$('#users-table').hide();
					load_data();
					$('#users-table').show();
				}
			);
		}
	}

	function delete_user(id) {
		//var user_id = $('#id_' + id).val();
		$.post(
			"users/delete_user", {
				id: id
			},
			function() {
				$('#users-table').hide();
				load_data();
				$('#users-table').show();
			}
		)
	}
</script>
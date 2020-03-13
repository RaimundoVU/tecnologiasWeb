<script type="text/javascript" src="<?= base_url('../js/jquery-3.4.1.js'); ?>"></script>
<script type="text/javascript" src="<?= base_url() ?>../js/bs/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>../css/bs/bootstrap.css">
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>../css/evaluation.css">
<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>


<div class="container">
<h2> Evaluaciones </h2>
	<button type="button" class="btn btn-primary" data-toggle="modal" data-target=".evModal">Agregar</button>
	<div class="modal fade evModal" tabindex="-1" role="dialog" aria-labelledby="labelModal" aria-hidden="true">
		<div class="modal-dialog">

			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="labelModal"> Agregar Evaluación</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div>
						<div>
							<label>Título</label>
							<input type="text" id="title" class="form-control">
						</div>
						<div>
							<label>Descripción</label>
							<input type="text" id="description" class="form-control">
						</div>
						<div>
							<div class="form-group">
								<label> Fecha </label>
								<input type='date' id="date" class="form-control" />
							</div>
						</div>

					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" id="close" data-dismiss="modal">Cerrar</button>
					<button type="button" onclick="saveEvaluation()" class="btn btn-primary">Agregar</button>
				</div>
			</div>
		</div>
	</div>
	<div id="evaluations-table">

	</div>
</div>




<script type="text/javascript">
	const site_url = '<?php echo  base_url(); ?>';
	load_data();
	var idSubject = <?php echo $id ?>;
	function load_data() {
		$.get(site_url + "evaluation/getEvaluations/<?php echo $id ?>", function(url, data) {
			$('#evaluations-table').html(url, data);
		});
	}

	function saveEvaluation() {
		var title = $("#title").val();
		var description = $("#description").val();
		var date = $("#date").val();
		console.log(date);
		$.post(site_url + "evaluation/save", {
			title: title,
			description: description,
			date: date,
			idSubject: idSubject
		}, function() {
			load_data();
            location.reload(true);
		});
	}
</script>
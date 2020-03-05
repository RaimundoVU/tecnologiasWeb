<script type="text/javascript" src="<?= base_url('../js/jquery-3.4.1.js'); ?>"></script>
  <script type="text/javascript" src="<?= base_url() ?>../js/bs/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="<?= base_url() ?>../css/bs/bootstrap.css">
<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
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
						<input type="text" class="form-control">
					</div>
					<div>
						<label>Descripción</label>
						<input type="text" class="form-control">
					</div>
					<div>
						<div class="form-group">
							<label> Fecha </label>
							<div class='input-group date' id='datetimepicker1'>
								<input type='text' class="form-control" />
								<span class="input-group-addon">
									<span>Click</span>
								</span>
							</div>
						</div>
					</div>
					
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
				<button type="button" class="btn btn-primary">Agregar</button>
			</div>
		</div>
	</div>
</div>
<div id="evaluations-table">

</div>

<script type="text/javascript">
const site_url = '<?php echo  base_url(); ?>';
    load_data();
    function load_data(){
        $.get(site_url + "/evaluation/getEvaluations",function(url, data){
            $('#evaluations-table').html(url, data);
        });
    }
	$(function() {
		$('#datetimepicker1').datetimepicker();
	});
</script>

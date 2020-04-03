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







<div class="container mt-3">
<h3 class="mb-5">Datalle de notas pendientes</h3>
    <table class="table">
        <thead class="thead-light">
            <tr>
                <th scope="col">Matricula</th>
                <th scope="col">Nombre</th>
                <th scope="col">Nota</th>
                <th scope="col">Observaciones</th>
                <th scope="col">Editar</th>

            </tr>
        </thead>
        <tbody>
        <?
		foreach ($grades as $grade): ?>
            <tr>
                <td>
                    <?= $grade->matricula ?>
					<input id="matricula_<?= $grade->matricula?>" type="hidden" readonly value="<?= $grade->matricula?>">
                </td>
                <td>
                    <?= $grade->nombre." ".$grade->apellido_paterno." ".$grade->apellido_materno?>
                <td>
                    <div style="color: <?php if ($grade->valor <4) {echo "red";} else { echo 'black';}?>"> <?= $grade->valor ?> </div>
					<input id="nota_<?= $grade->matricula?>" type="hidden" readonly value="<?= $grade->valor?>">
                </td>
                <td>
                    <?php if ($grade->observacion =="") {echo "No hay observaciones."; } else { echo $grade->observacion; }?>
					<input id="obs_<?= $grade->matricula?>" type="hidden" readonly value="<?= $grade->observacion?>">
                </td>
                <td>
                    <button onclick="openModalEdit(<?= $grade->matricula ?>)" class="btn btn-primary">Modificar</button>
                </td>
            </tr>
            <?endforeach; ?>
        </tbody>
    </table>
</div>







<div class="modal fade editModal" tabindex="-1" role="dialog" aria-labelledby="labelModal" aria-hidden="true">
	<div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="labelModal"> Editar Nota</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div>
                    <div>
                        <label>Nota</label>
                        <input type="number" step="0.1" min="0" max="7" id="editGrade" class="form-control">
                        <input id="idEdit" type="hidden" readonly value="">
                    </div>
                    <div>
                        <label>Observación</label>
                        <input type="text" id="editObs" class="form-control">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="close" data-dismiss="modal">Cancelar</button>
                <button type="button" onclick="updateGrade()" class="btn btn-primary">Editar</button>
            </div>
		</div>
	</div>
</div>
    
<script type="text/javascript">
    function openModalEdit(id){
        $("#editGrade").val($("#nota_"+id).val());
        $("#editObs").val($("#obs_"+id).val());
        $("#idEdit").val(id);

        $(".editModal").modal("show");
    }

    function updateGrade(){
        var grade = $("#editGrade").val();
        var obs = $("#editObs").val();
        var matricula = $("#idEdit").val();
        $.post("<?=base_url('grade/editGrade')?>", {
			grade: grade,
			obs: obs,
            matricula: matricula,
            idEvaluation: <?=$id_evaluacion?>
		}, function() {
			//$(".editModal").modal('hide');
            //load_data();
            location.reload();
		});
    }
</script>
</body>
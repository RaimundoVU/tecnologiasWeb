<div>
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
            idEvaluation: idEvaluation
		}, function() {
			$(".editModal").modal('hide');
            load_data();
            location.reload(true);
		});
    }
</script>

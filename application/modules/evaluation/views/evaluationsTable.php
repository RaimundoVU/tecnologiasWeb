<div>
    <table class="table">
        <thead class="thead-light">
            <tr>
                <th scope="col">Fecha</th>
                <th scope="col">Tópico</th>
                <th scope="col">Descripción</th>
                <th scope="col">Editar</th>
                <th scope="col">Notas</th>
            </tr>
        </thead>
        <tbody>
        <?
		foreach ($evaluations as $ev): ?>
            <tr>
                <td>
                    <?= $ev->fecha ?>
					<input id="fecha_<?= $ev->id_evaluacion?>" type="hidden" readonly value="<?= $ev->fecha?>">
                </td>
                <td>
                    <?= $ev->topico?>
					<input id="topico_<?= $ev->id_evaluacion?>" type="hidden" readonly value="<?= $ev->topico?>">
                <td>
                    <?= $ev->descripcion ?>
					<input id="descripcion_<?= $ev->id_evaluacion?>" type="hidden" readonly value="<?= $ev->descripcion?>">
                </td>
                <td>
                    <button class="btn btn-secundary" onclick="openModalEdit(<?= $ev->id_evaluacion ?>)">Editar</button>
                </td>
                <td>
                    <button class="btn btn-primary" onclick="openGrade(<?= $ev->id_evaluacion?>)">Asignar</button>
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
					<h5 class="modal-title" id="labelModal"> Editar Evaluación</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div>
						<div>
							<label>Tópico</label>
                            <input type="text" id="editTitle" class="form-control">
                            <input id="idEdit" type="hidden" readonly value="">
						</div>
						<div>
							<label>Descripción</label>
							<input type="text" id="editDescription" class="form-control">
						</div>
						<div>
							<div class="form-group">
								<label> Fecha </label>
								<input type='date' id="editDate" class="form-control" />
							</div>
						</div>

					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" id="close" data-dismiss="modal">Cerrar</button>
					<button type="button" onclick="updateEvaluation()" class="btn btn-primary">Editar</button>
				</div>
			</div>
		</div>
    </div>
    
<script type="text/javascript">
    function openModalEdit(id){
        $("#editTitle").val($("#topico_"+id).val());
        $("#editDescription").val($("#descripcion_"+id).val());
        $("#editDate").val($("#fecha_"+id).val());
        $("#idEdit").val(id);

        $(".editModal").modal("show");
    }

    function openGrade(id) {
        window.location.replace(site_url + "grade/evaluation/"+ id +"/"+ idSubject);
    }

    function updateEvaluation(){
        var title = $("#editTitle").val();
        var description = $("#editDescription").val();
        var date =  $("#editDate").val();
        var id = $("#idEdit").val();
        $.post(site_url + "evaluation/update", {
			title: title,
			description: description,
			date: date,
            idEv: id
		}, function() {
			$(".editModal").modal('hide');
            load_data();
            location.reload(true);
		});
    }
</script>

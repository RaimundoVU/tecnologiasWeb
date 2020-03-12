<div>
    <table class="table">
        <thead class="thead-light">
            <tr>
                <th scope="col">Fecha</th>
                <th scope="col">Título</th>
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
					<input id="fecha_<?= $ev->codigo_evaluacion?>" type="hidden" readonly value="<?= $ev->fecha?>">
                </td>
                <td>
                    <?= $ev->titulo ?>
					<input id="titulo_<?= $ev->codigo_evaluacion?>" type="hidden" readonly value="<?= $ev->titulo?>">
                <td>
                    <?= $ev->descripcion ?>
					<input id="descripcion_<?= $ev->codigo_evaluacion?>" type="hidden" readonly value="<?= $ev->descripcion?>">
                </td>
                <td>
                    <button class="btn btn-secundary" onclick="openModalEdit(<?= $ev->codigo_evaluacion ?>)">Editar</button>
                </td>
                <td>
                    <button class="btn btn-primary">Asignar</button>
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
							<label>Título</label>
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
					<button type="button" onclick="updateEvaluation()" class="btn btn-primary">Editarr</button>
				</div>
			</div>
		</div>
    </div>
    
<script type="text/javascript">
    function openModalEdit(id){
        $("#editTitle").val($("#titulo_"+id).val());
        $("#editDescription").val($("#descripcion_"+id).val());
        $("#editDate").val($("#fecha_"+id).val());
        $("#idEdit").val(id);

        $(".editModal").modal("show");
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
            reload_view();
		});
    }
</script>

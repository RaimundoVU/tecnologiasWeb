<div id="listado">
    <table class="table">
       
                <th>Código</th>
                <th>Nombre</th>
                <th>Año</th>
                <th>Semestre</th>
                <th></th>
       
        <?
        $i = 0;
		foreach ($asignaturas as $row): ?>
            <tr>
                <td>
                    <?= $row->codigo ?>
					<input id="codigo<?=$row->id_ins_asig ?>" type="hidden" readonly value="<?= $row->codigo?>">
                </td>
                <td>
                    <?= $row->nombre ?>
					<input id="nombre<?=$row->id_ins_asig ?>" type="hidden" readonly value="<?= $row->nombre?>">
                </td>
                <td>
                    <?= $row->anho ?>
					<input id="anho<?=$row->id_ins_asig ?>" type="hidden" readonly value="<?= $row->anho?>">
                </td>
                <td>
                    <?= $row->semestre ?>
					<input id="semestre<?=$row->id_ins_asig ?>" type="hidden" readonly value="<?= $row->semestre?>">
             
					<input id="matricula<?=$row->id_ins_asig ?>" type="hidden" readonly value="<?= $matricula?>">
                    <input id="instancia<?=$row->id_ins_asig ?>" type="hidden" readonly value="<?= $row->id_ins_asig?>">
                    <input id="asignatura<?=$row->id_ins_asig ?>" type="hidden" readonly value="<?= $row->id_asignatura?>">
               
                    <td><button class="btn btn-info" onclick="openModalResume(<?= $row->id_ins_asig ?>)">Notas</button></td>
                </td>
            </tr>
            <?  $i++;
                endforeach; ?>
    </table>
</div>
<div id="grades_modal" style="display: none;" class="modal" role="dialog">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5>Notas</h5>
				<button type="button" class="close" onclick="closeModal()" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div id="resume-grades">


                </div>
				<div class="modal-footer">
                    <button class="btn btn-warning" onclick="closeModal()">Listo</button>

				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
    function openModalResume(i){
        var instancia = $("#instancia" + i).val();
        var matricula = $("#matricula" + i).val();
        $.post(
			base_url + "students/getStudentGrades/",
			{
				matricula: matricula,
                id_ins_asig: instancia
			},
			function(url, res) {
                console.log(url);
				$("#resume-grades").html(url, res);
                $("#grades_modal").modal("show");
			} 
		);
    }

    function closeModal()
    {
        $("#grades_modal").modal("hide");
    }

</script>

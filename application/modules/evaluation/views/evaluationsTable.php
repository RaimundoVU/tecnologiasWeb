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
        <? $i = 0;
		foreach ($evaluations as $ev): ?>
            <tr>
                <td>
                    <?= $ev->fecha ?>
					<input id="fecha_<?= $i?>" type="hidden" readonly value="<?= $ev->fecha?>">
                </td>
                <td>
                    <?= $ev->titulo ?>
					<input id="titulo_<?= $i?>" type="hidden" readonly value="<?= $ev->titulo?>">
                <td>
                    <?= $ev->descripcion ?>
					<input id="descripcion_<?= $i?>" type="hidden" readonly value="<?= $ev->descripcion?>">
                </td>
                <td>
                    <button>edit</button>
                </td>
            </tr>
            <? $i++;
		endforeach; ?>
        </tbody>
    </table>
</div>

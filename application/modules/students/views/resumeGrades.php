<div id="listado">
    <? if(sizeof($grades) == 0) :
    ?>
        <h3>No hay notas.</h3>
    <? endif;?>
    <?
        foreach ($grades as $row) :
    ?>
    <div style ="border: 1px solid; margin: 20px">
        <h3 style="text-align: center;"><?= $row->topico?></h3>
        <div class="form-row" style="margin: 10px">
            <div class="form-group col-md-6">
                <label for="email">Nota</label>
                <input type="text" class="form-control" id="email" value="<?= $row->valor?>" readonly>
            </div>
            <div class="form-group col-md-6" >
                <label for="fecha">Fecha</label>
                <input type="text" class="form-control" id="fecha" value="<?= $row->fecha?>" readonly>
            </div>
        
        </div>
        <div class="form-group"  style="margin: 10px">
            <label for="observacion">Observación</label>
            <input type="text" class="form-control" id="observacion" value="<?= $row->observacion?>" readonly>
        </div>
    </div>
 
    <? endforeach;?>
</div>
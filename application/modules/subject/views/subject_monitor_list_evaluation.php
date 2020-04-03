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
<div class="container w-100">

<h3 class="mt-3">Monitoreo de Evaluaciones</h3>
<h5 class="mt-3"><?= $subjects[0]->nombre.' '.$subjects[0]->anho.'-'.$subjects[0]->semestre?></h5>
<div class="row w-100 p-5">
<?$i=1; foreach($evaluations as $row):?>
<div class="col-4">

<div class="card" style="width: 20rem;">

  <div class="card-body">
    <h5 class="card-title"><?= $row->titulo?></h5>
    <h6 class="card-subtitle mb-2 text-muted mb-3"><?= $row->fecha_ev?></h6>
    <?php 
    $fecha_evaluation = $row->fecha_ev;
    $fecha_limit = strtotime(date("d-m-Y",strtotime($fecha_evaluation."+ 2 week")));
    $fecha_actual = strtotime(date("d-m-Y"));
    if($row->num_sin_nota > 0){

        if ($fecha_limit < $fecha_actual)
        { ?>
            <p class="card-text badge badge-pill badge-danger">Hay notas atrasadas</p>
        <?php } else{ ?>
        
        
            <p class="card-text badge badge-pill badge-warning">Hay notas pendientes</p>
        
        
        <?php } 
        } else {?>
        <p class="card-text badge badge-pill badge-primary">Al dia</p>
    <?php }?>
<button class="btn btn-primary float-right m-1" data-toggle="tooltip" data-placement="bottom" title="Ver detalle" id="seeSubject" onclick="see_detail(<?=$row->id_ev?>)"><i class="fas fa-eye mr-2"></i>Ver</button>
  </div>
  
</div>

</div>
<?$i++;endforeach;?>


</div>
<script type="text/javascript">

function see_detail(id)
{
    window.location.replace("<?php echo base_url('grade/detail_monitor/'); ?>"+id);
}


</script>
</body>
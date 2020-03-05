<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to module students</title>

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
	</style>
</head>
<body>

<div id="container">
	<h1>Módulo Usuarios</h1>

	<div id="body">
	<table class="table">
      <th>Matricula</th>
	  <th>Nombre</th>
	  <th>Apellido Paterno</th>
	  <th>Apellido Materno</th>
	  <th></th>
	  <th></th>
	<?$i=0;foreach($resultado as $row):?>
		<tr>
			<td>
				<input type="hidden" id="a<?=$i?>" value=<?="$row->matricula"?> readonly>
				<p><?=$row->matricula?></p>
			</td>
			<td>
				<input type="hidden" id="b<?=$i?>" value=<?="$row->nombre"?> readonly>
				<p><?=$row->nombre?></p>
			</td>
			<td>
				<input type="hidden" id="c<?=$i?>" value=<?="$row->apellido_paterno"?> readonly>
				<p><?=$row->apellido_paterno?></p>
			</td>
			<td>
				<input type="hidden" id="d<?=$i?>" value=<?="$row->apellido_materno"?> readonly>
				<p><?=$row->apellido_materno?></p>
			</td>
			<td><button class="btn btn-secondary" onclick="editar(<?=$i?>)">Editar</button></td>
			<td><button class="btn btn-danger" onclick="eliminar(<?=$i?>)">Eliminar</button></td>
		</tr>
	<?$i++;endforeach;?>
</table>
	</div>

</div>

</body>
</html>
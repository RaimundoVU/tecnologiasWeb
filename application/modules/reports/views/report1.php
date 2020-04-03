<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<title></title>

	<style type="text/css">

	::selection { background-color: #E13300; color: white; }
	::-moz-selection { background-color: #E13300; color: white; }

	</style>
</head>
	<table class="table">
  <thead>
    <tr>
      <th scope="col">Nombre del Curso</th>
      <th scope="col">Semestre</th>
      <th scope="col">Año</th>
      <th scope="col">Promedio de notas</th>
    </tr>
  </thead>
  <tbody>
  <?$i=0; foreach($subjectData as $row):?>
	<tr>
	<td><? echo $row->nombre ?></td>
	<td><? echo $row->semestre?></td>
	<td><? echo $row->anho?></td>
	<td><? echo $row->promedio?></td>
	</tr>
	<?$i++;endforeach;?>
  </tbody>
</table>

	
<script type="text/javascript">

	
</script>
</body>
</html>

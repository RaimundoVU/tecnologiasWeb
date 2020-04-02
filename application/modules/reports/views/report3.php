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
	<table class="table table-white">
  <thead >
    <tr>
      <th scope="col">Apellido Paterno</th>
      <th scope="col">Apellido Materno</th>
      <th scope="col">Nombres</th>
      <th scope="col">Email</th>
	  <th scope="col">Asignatura</th>
	  <th scope="col">Año</th>
	  <th scope="col">Semestre</th>


    </tr>
  </thead>
  <tbody>
<?foreach($data as $row):  ?> 
  <tr>


	<td><?=$row->apellido_paterno?></td>
	<td><?=$row->apellido_materno?></td>
	<td><?=$row->nombres?></td>
	<td><?=$row->email?></td>
	<td><?=$row->nombre?></td>
	<td><?=$row->anho?></td>
	<td><?=$row->semestre?></td>

<?endforeach; ?>

	
  </tr>
	
  </tbody>
</table>

	
<script type="text/javascript">

	
</script>
</body>
</html>
<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <title></title>

  <style type="text/css">
    ::selection {
      background-color: #E13300;
      color: white;
    }

    ::-moz-selection {
      background-color: #E13300;
      color: white;
    }
  </style>
</head>
<div style="text-align: center">
	Este informe le dará a conocer todos las instancias de asignaturas que superan la cantidad de estudiantes ingresada.
</div>
<div>
  <div class="d-inline-block">
    <input id="inputCant" placeholder="Ingrese cantidad" class="form-control" type="text">
  </div>
  <div class="d-inline-block">
    <button class="btn btn-primary" onclick="searchSubjects()">Buscar</button>
  </div>
</div>

<div id="tableBody">

</div>

</table>
<script type="text/javascript">
  var base_url = '<? echo base_url() ?>'

  function searchSubjects() {
    var cant = $("#inputCant").val();
    console.log(cant);
    $.post(
      base_url + "reports/getSubjectsByCant", {
        cant: cant
      },
      function(data) {
        var res = '<table class="table table-white"><thead ><tr>' +
          '<th scope="col">ID</th>' +
          '<th scope="col">Codigo Asignatura</th>' +
          '<th scope="col">Nombre</th>' +
          '<th scope="col">Año</th>' +
          '<th scope="col">Semestre</th>' +
          '<th scope="col">Cantidad</th>' +
          '</tr></thead>';

        var json = JSON.parse(data);
        for (subjects in json) {
          res += "<tbody><td>" + json[subjects].id_ins + "</td>" +
            "<td>" + json[subjects].codigo + "</td>" +
            "<td>" + json[subjects].nombre + "</td>" +
            "<td>" + json[subjects].anho + "</td>" +
            "<td>" + json[subjects].sem + "</td>" +
            "<td>" + json[subjects].cant + "</td></tbody >";
        }
        $("#tableBody").html(res);
      });
  }
</script>
</body>

</html>
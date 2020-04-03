<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>Welcome to module reports</title>

	<style type="text/css">
		::selection {
			background-color: #E13300;
			color: white;
		}

		::-moz-selection {
			background-color: #E13300;
			color: white;
		}
		
		#title{
			margin-left: 20px;
			margin-top: 10px;
		}

		#title-report {
			text-align: center;
			margin-top: 30px;
		}

		#btnReport {
			width: 250px;
			margin-bottom: 20px;
		}

		.card {
			margin-left: 20px;
			margin-top: 30px;
			height: 100;
		}

		.containerReport{
			margin-top: 30px;
			margin-left: 20px;
			margin-right: 20px;
		}

	</style>
</head>

<div>
	

		<div class="row">
			<div class="col-3"><h3 id="title"> <b>Reportes</b> </h3>
				<div class="card section">
					<div class="card-body">
						<p class="card-text">
							<button id="btnReport" class="btn btn-success" onclick="getTable1()">Promedios por Curso</button>
							<button id="btnReport" class="btn btn-success" onclick="getTable2()">Asig. con cierta cant. de Est.</button>
							<button id="btnReport" class="btn btn-success" onclick="getTable3()">Docentes con notas atrasadas</button>
							<button id="btnReport" class="btn btn-success" onclick="getTable4()">Asignaturas por cantidad alumnos</button>
							<button id="btnReport" class="btn btn-success" onclick="getTable5()">Docentes por fecha</button>
						</p>
					</div>
				</div>

			</div>
			<div class="col">
				<h4 id="title-report"></h4>
				<div class="containerReport">
					<div id="reportContent"></div>
				</div>
				
			</div>
		</div>

	
</div>


<script type="text/javascript">
	var base_url = '<? echo base_url() ?>'

	function getTable1() {
		$('#title-report').html("Promedio de notas por curso");
		$.post(
             base_url + "reports/getTableReport1",
            function(data) {
                $("#reportContent").html(data)
              
            });
	}

	function getTable2() {
		$('#title-report').html("Listado de asignaturas con mas de x cantidad de estudiantes.");
		$.post(
             base_url + "reports/getTableReport2",
            function(data) {
                $("#reportContent").html(data)
              
            });
	}

	function getTable3() {
		$('#title-report').html("Listado de docentes con notas atrasadas");
		$.post(
             base_url + "reports/getTableReport3",
            function(data) {
                $("#reportContent").html(data)
              
            });
	}

	function getTable4() {
		$('#title-report').html("Asignaturas incritas");
		$.post(
             base_url + "reports/getTableReport4",
            function(data) {
                $("#reportContent").html(data)
              
            });
	}

	function getTable5() {
		$('#title-report').html("Docentes incorporados");
		$.post(
             base_url + "reports/getTableReport5",
            function(data) {
                $("#reportContent").html(data)
              
            });
	}
</script>

</html>
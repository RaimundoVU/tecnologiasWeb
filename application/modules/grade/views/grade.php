<script type="text/javascript" src="<?= base_url('../js/jquery-3.4.1.js'); ?>"></script>
<script type="text/javascript" src="<?= base_url() ?>../js/bs/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>../css/bs/bootstrap.css">
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>../css/evaluation.css">
<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>


<div class="container">

	<div id="evaluation-info"></div>
	<h4> Notas </h4>
	<div id="grade-table"></div>
</div>




<script type="text/javascript">
	const site_url = '<?php echo  base_url(); ?>';
	var idEvaluation = <?php echo $id ?>;
	var idSubject = <?php echo $idSubject ?>;
	loadEvaluationInfo();
	load_data();
	function load_data() {
		$.get(site_url + "grade/getGrades/<?php echo $id ?>/"+idSubject, function(url, data) {
			$('#grade-table').html(url, data);
		});
	}

	function loadEvaluationInfo(){
		$.get(site_url + "grade/evaluationInfo/<?php echo $id ?>", function(url, data) {
			$('#evaluation-info').html(url, data);
		});
	}

	function saveEvaluation() {
		var title = $("#title").val();
		var description = $("#description").val();
		var date = $("#date").val();
		console.log(date);
		$.post(site_url + "evaluation/save", {
			title: title,
			description: description,
			date: date,
			idEvaluation: idEvaluation
		}, function() {
			$(".evModal").modal('hide');
			load_data();
            location.reload(true);
		});
	}
</script>
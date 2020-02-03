<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
	<style>
		.add-button {
			margin-right: 20px;
			margin-bottom: 30px;
		}

	</style>

	<div id="container">
		<h1>Módulo Usuarios</h1>


		<div id="users-table">


		</div>

	</div>


<script type="text/javascript">
    var site_url = '<?php echo  site_url(); ?>';
    load_data();
    function load_data(){
        $.get(site_url + "/users/list_all",function(url, data){
            $('#users-table').html(url, data);
        });
    }
</script>

<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
	<div id="container">
		<h1>Módulo Usuarios</h1>


		<div id="users-table">


		</div>

	</div>


<script type="text/javascript">
    const site_url = '<?php echo  site_url(); ?>';
    load_data();
    function load_data(){
        $.get(site_url + "/users/list_all",function(url, data){
            $('#users-table').html(url, data);
        });
    }
</script>

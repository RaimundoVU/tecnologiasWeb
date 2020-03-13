<!--link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"!-->
<head>
  <meta charset="utf-8">
  <title>Tecnologías web - Proyecto</title>
  <script type="text/javascript" src="<?= base_url('../js/jquery-3.4.1.js'); ?>"></script>
  <script type="text/javascript" src="<?= base_url() ?>../js/bs/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="<?= base_url() ?>../css/bs/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="<?= base_url() ?>../css/login.css">
</head>
<body>
	<div class="container p-5">
		<div class="row">
			<div class="col-md-4 offset-md-4">
				<div class="card shadow p-3 mb-5 bg-white rounded">
					<div class="card-header">
						<h2>Login</h2>
					</div>
					<div class="card-body">
						<div id="body">
							<form method="post" action="<?php echo base_url(); ?>login/in">
								<div>
									<label>Email</label> 
									<input id = "email" class="form-control" type="email" name="email" placeholder="Ej: ejemplo@correo.com">
								</div>
								<div style="margin-top: 10px">
									<label>Contraseña</label> 
									<input class="form-control" type="password" name="password">
								</div>
								<button class="btn btn-primary" id="btnLogin" type="submit">Ingresar</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
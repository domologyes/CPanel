
<?php
include_once ('./include/config.php');

$services = shell_exec('/usr/sbin/service --status-all');
$service_arr = preg_split("/\\r\\n|\\r|\\n/", $services);
$active_services_arr = array();
$inactive_services_arr = array();

foreach($service_arr AS $a)
	{
	if (stristr($a, '[ + ]'))
		{
		$a = str_replace("[ + ]", '', $a);
		if (!empty($a)) $active_services_arr[] = trim($a);
		}
	  else
		{
		$a = str_replace("[ - ]", '', $a);
		if (!empty($a)) $inactive_services_arr[] = trim($a);
		}
	}

?>


<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="shortcut icon" href="./static/images/domologyes.png" type="image/png" />
	<link rel="icon" href="./static/images/cropped-cropped-Logo-domology-1-300x300.png" type="image/png" />
        <link rel="icon" href="./static/images/cropped-cropped-Logo-domology-1-150x150.png" type="image/png" />
	<title>DomologyES Acciones</title>
	<link href="./static/css.php" rel="stylesheet" type="text/css">
	<link href="./static/css/bootstrap.min.css" rel="stylesheet">
	<script src="./static/js.php" type="text/javascript"></script>

 <!-- http://bootstrap-confirmation.js.org/ -->

  <!--<link href="http://bootstrap-confirmation.js.org/assets/css/docs.min.css" rel="stylesheet">
  <link href="http://bootstrap-confirmation.js.org/assets/css/style.css" rel="stylesheet">-->

  <style>
    #content {
      background:#009ece;
      background:linear-gradient(135deg, #009ece, #003354);
    }
  </style>

 <!-- <script type="text/javascript" src="http://ff.kis.v2.scr.kaspersky-labs.com/35EB4CBC-64A0-B146-9AC6-CD6F67E7216D/main.js" charset="UTF-8"></script><script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
  <script src="https://netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
  <script src="http://bootstrap-confirmation.js.org/assets/js/docs.min.js"></script>-->
 <!-- fin confirmation -->

<style type="text/css">

	.bs-example {
    text-align:center;
	margin-top:10px;
	
	
	
}
    .bs-example2 {
    text-align:center;
	margin-top:5px;
	
	
	
}
	
	
.inlineblock { 
    display: inline-block;
    zoom: 1;
    display*: inline; /* ie hack */
    width: 50%;
}
</style>	
</head>

<body>
<div class="container">
	
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="./index.php"><img src="./static/images/domologyes.png" /><span style="padding-left:25px;">DomologyEs</span></a>
			</div>
			<div id="navbar" class="navbar-collapse collapse">
				<ul class="nav navbar-nav navbar-right">
					<li><a href="./index.php">Panel de Control</a></li>
					<li ><a href="./servicios.php">Servicios</a></li>
					<li><a href="./procesos.php">Procesos</a></li>
					<!--<li><a href="./phpinfo.php">PHP info</a></li>-->
					<li class="active"><a href="./acciones.php">Acciones</a></li>
					<!--<li><a href="./gpio.php">GPIO</a></li>
					<li><a href="./buttons.php">Buttons</a></li>-->
					<?php

if (LOGIN_REQUIRED == true)
	{
	echo '<li><a href="./logout.php">Salir</a></li>';
	}

?>
				</ul>
			</div><!--/.nav-collapse -->
		</div><!--/.container-fluid -->
	</nav>
	

					<div id="system-status" class="panel panel-default" style="margin-bottom: 5px">
						<div class="panel-heading">
							<h3 class="panel-title">Caja de Herramientas</h3>
						</div>
						<div class="panel-body">
							<!-- inicio bloque -->
								
    				
	    				<table class="table table-striped">
						  <thead>
						    <tr>
						      <th scope="col">#</th>
						      <th scope="col">Paquete</th>
						      <th scope="col">Descripción</th>
						      <th scope="col">Acción</th>
						    </tr>
						  </thead>
						  <tbody>
						    <tr>
						      <th scope="row">1</th>
						      <td>Htop</td>
						      <td><b>HTOP</b> Es un gestor de procesos avanzado que permite monitorizar los procesos en ejecución.</td>
						      <td>
						      		<!-- Prueba instalar/desinstalar -->
	    							<?php 
	    							$htop = '/usr/bin/htop';  
	    								if (file_exists($htop)) {
	    									if (isset($_POST['eliminar']))
											    {
											         exec('apt-get remove htop');

											    }
	    									echo " <button name='eliminar' class='btn btn-large btn-danger' data-toggle='confirmation' data-placement='right'
								        data-btn-ok-label='SI' data-btn-ok-icon='glyphicon glyphicon-ok'
								        data-btn-ok-class='btn-success'
								        data-btn-cancel-label='NO' data-btn-cancel-icon='glyphicon glyphicon-ban-circle'
								        data-btn-cancel-class='btn-danger'
								        data-title='¡ALERTA!' data-content='Estas seguro de que quieres ELIMINAR este servicio?'>
									  Eliminar
									</button>";
	    								} else {
	    									if (isset($_POST['instalar']))
											    {
											         exec('apt-get install htop');
											    }
									echo "<button name='instalar'class='btn btn-large btn-primary' data-toggle='confirmation' data-placement='right'
								        data-btn-ok-label='SI' data-btn-ok-icon='glyphicon glyphicon-ok'
								        data-btn-ok-class='btn-success'
								        data-btn-cancel-label='NO' data-btn-cancel-icon='glyphicon glyphicon-ban-circle'
								        data-btn-cancel-class='btn-danger'
								        data-title='ALERTA!' data-content='Estas seguro de que quieres instalar este servicio?'>  
									  Instalar
									</button>";
										}
								     ?>

								<!-- Fin prueba instalar/desinstalar -->

						      </td>
						    </tr>
						    <tr>
						      <th scope="row">2</th>
						      <td>MQTT</td>
						      <td>bla bla bla bla</td>
						      <td> 
						      		bla bla
						      </td>
						    </tr>
						    <tr>
						      <th scope="row">3</th>
						      <td>PiHole</td>
						      <td>bla bla bla</td>
						      <td>Instalar</td>
						    </tr>
						  </tbody>
						</table>
							<!-- fin bloque -->			
	    						
		</div>

	</div>
							
							
						
				
				
				
				<div id="system-status" class="panel panel-default" style="margin-bottom: 5px" >
					<div class="panel-heading">
						<h3 class="panel-title">Mantenimiento</h3>
					</div>
					<div class="panel-body">

								<div>
									<center>
									<a href="./index.php?bin=restart"><input type="submit" name="reiniciar HA" value ="Reiniciar HA" style="color:black;height:35px; width:100px"/></a>
								 	<a href="./index.php?bin=backup"><input type="submit" name="backup HA" value ="Backup HA" style="color:black;height:35px; width:100px"/></a>
									
									<a href="./index.php?bin=upgrade"><input type="submit" name="upgrade HA" value ="Actualizar HA" style="color:black;height:35px; width:100px"/></a>
									</center>
								</div>
						
					</div>
				
				
				</div>

				
				
				
		
</div>
<footer class="footer">
	<div class="container">
		<p class="text-muted"><a href="http://domology.es">DomologyES &copy;</a></p>
	</div>
</footer>
<div id="dialog-placeholder"></div>
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

<!-- Script para la confirmacion -->
 
  <script src="./static/js/bootstrap-confirmation.min.js"></script>

<style>
  .popover {
    max-width: 600px;
  }
</style>

<script>
  $('[data-toggle=confirmation]').confirmation();
  $('[data-toggle=confirmation-singleton]').confirmation({ singleton: true });
  $('[data-toggle=confirmation-popout]').confirmation({ popout: true });

  $('[data-toggle=confirmation-custom]').confirmation({
    buttons: [
      {
        label: 'Approved',
        class: 'btn btn-xs btn-success',
        icon: 'glyphicon glyphicon-ok'
      },
      {
        label: 'Rejected',
        class: 'btn btn-xs btn-danger',
        icon: 'glyphicon glyphicon-remove'
      },
      {
        label: 'Need review',
        class: 'btn btn-xs btn-warning',
        icon: 'glyphicon glyphicon-search'
      },
      {
        label: 'Decide later',
        class: 'btn btn-xs btn-default',
        icon: 'glyphicon glyphicon-time'
      }
    ]
  });
</script>

  
  <script src="./static/js/d3.v3.min.js"></script>
  <script src="./static/js/trianglify.min.js"></script>
  <script>trianglify('#009ece', '#003354');</script>
  

  
  <script>
    window.twttr = (function (d,s,id) {
      var t, js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return; js=d.createElement(s); js.id=id; js.async=1;
      js.src="./static/js/widgets.js"; fjs.parentNode.insertBefore(js, fjs);
      return window.twttr || (t = { _e: [], ready: function(f){ t._e.push(f) } });
    }(document, "script", "twitter-wjs"));
  </script>
<!-- Fin Script -->

</body>
</html>
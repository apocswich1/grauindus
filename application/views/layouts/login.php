<!DOCTYPE html>
<html lang="es">
	<head>
	<title><?php echo $this->layout->getTitle(); ?></title>
		<meta charset="utf-8" />
        <link rel="shortcut icon" href="<?php echo base_url(); ?>public/backend/img/favicon.ico" />
       <meta name="language" content="Spanish" />
	<meta name="copyright" content="www.cesarcancino.com" />
      <meta name="designer" content="César Cancino Zapata" />
    <meta name="author" content="www.cesarcancino.com" />
		<link rel="shortcut icon" href="<?php echo base_url(); ?>public/backend/img/favicon.ico" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>public/backend/css/bootstrap-cerulean.min.css" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>public/backend/css/admin.css" />
		<?php echo $this->layout->css; ?>
		<script src="<?php echo base_url(); ?>public/backend/js/jquery-1.8.1.min.js"></script>
        <script src="<?php echo base_url(); ?>public/backend/js/jquery-ui-1.9.0.custom.min.js"></script>
		<script src="<?php echo base_url(); ?>public/backend/js/bootstrap.min.js"></script>
		<script src="<?php echo base_url(); ?>public/backend/js/funciones.js"></script>
		<!--[if IE 7]>
			<script src="<?php echo base_url(); ?>public/backend/js/backend/admin-ie7.js"></script>
		<![endif]-->		
		<script type="text/javascript">var webroot = '<?php echo base_url(); ?>';</script>
		<?php echo $this->layout->js; ?> 
        	<script type="text/javascript">
			$(document).ready(function(){
				    $("#padre .input-xlarge").click(function (e) {
                		alert($(this).parent());
            		});
					
					
				
			});
			
		</script>
	</head>
	<body>
		<div class="container" id="contenedor">
            
			<div class="page-header">
       <a class="logo" href="<?php echo base_url(); ?>" title="Empresas Grau"><img src="<?php echo base_url(); ?>public/backend/img/logo_grau.png" width="150" height="50" /></a>
      </div>
			
           <div class="navbar admin-menu">
	<div class="navbar-inner">
		<ul class="nav">
			<!--
<a class="brand" href="<?php echo  base_url(); ?>" title="Alto Maipo">Alto Maipo</a>
-->

			
    <li class="dropdown <?php echo (in_array($this->router->class, array('usuarios')) ? 'active' : ''); ?>">
				<a class="dropdown-toggle" data-toggle="dropdown" href="<?php echo  base_url(); ?>usuarios">
					Usuarios <b class="caret"></b>
				</a>
				<ul class="dropdown-menu">
					<li><a href="<?php echo  base_url(); ?>usuarios/login" id="dropdown_ususarios" title="Login">Login</a></li>
				</ul>
			</li>
    
            
           
		
<ul class="nav pull-right">
			<li class="divider-vertical pull-right"></li>
			<li class=""><a href="http://www.grauindus.cl/" title="Sitio Web">Sitio Web</a></li>
		</ul>
</ul>
	</div>
</div>

			
            <div id="contenidos"><?php echo $content_for_layout; ?></div>
             <!--footer-->
            
        		<div class="navbar-inner" style="text-align: center;color:#ffffff;">
        		
        			
                     Todos los derechos reservados a Empresas Grau <?php echo date("Y")?>
                    <br />
                    Desarrollado por <a href="http://www.cesarcancino.com" target="_blank" title="Web Master César Cancino" style="color: #ffffff;text-decoration: none;">Web Master César Cancino</a>
                    
        		</div>
        	
            <!--fin footer-->
		</div>

	
		

	</body>
</html>
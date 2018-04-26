<!--<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.16/datatables.min.css"/>-->
 
<!--<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.16/datatables.min.js"></script>-->
<?php if ( $this->session->flashdata('ControllerMessage') != '' ) : ?>
<div class="alert alert-success"><?php echo $this->session->flashdata('ControllerMessage'); ?></div>
<?php endif; ?>
<div class="page-header"><h3>Solicitud de Cotizaciones ( <?php echo $cuantos?> en total)</h3></div>


<div class="control-group">
		<label class="control-label" for="usuario">Cliente</label>
		<div class="controls">
			<select name="cliente" class="chosen-select" onchange="enviaSelect('clientes_cotizacion',this.value);">
              
                 <option value="0">Seleccione.....</option>
                <?php
                $clientes=$this->clientes_model->getClientesNormal();
                
                foreach($clientes as $cliente)
                {
                    ?>
                    <option value="<?php echo $cliente->id?>"><?php echo $cliente->razon_social?></option>
                    <?php
                }
                ?>
               
            </select>
            
		</div>
	</div>
	
	
	<div class="control-group">
		<label class="control-label" for="usuario">Filtrar Por </label>
		<div class="controls">
			<select name="cliente" class="chosen-select" onchange="enviaSelect('clientes_cotizacion',this.value);">
              
                 <option value="Pendientes">Activas</option>
                 <option value="Liberadas">Liberadas</option>
                 <option value="Rechazadas">Rechazadas</option>
               
            </select>
            
		</div>
	</div>
        <h3>Estatus de Actividades</h3>
                 
       
    <div>
        <span style="color: #ff0000; font-size: 12px;"><B>Activo</B></span>->        
        <span style="color: #2fa4e7; font-size: 12px;"><B>Pendiente</B></span>->
        <span style="color: orange; font-size: 12px;"><B>Pendiente por Liberar</B> </span>->
        <span style="color: green; font-size: 12px;"><B>Liberado</B> </span>->
        <span style="color: black; font-size: 12px;"><B>No corresponde</B> </span>        
    </div>
<div style="text-align: right;">
    <div class="control-group">
	<label class="control-label" for="usuario">Filtrar</label>
	<div class="controls">
            <select name="perfil" onchange="enviaSelect('cotizaciones',this.value);">
                <option value="0">Seleccione.....</option>
                <option value="1">Nuevo</option>
                <option value="2">Repetición con cambios</option>
                <option value="3">Repetición sin cambios</option>
                <option value="4">Producto Genérico</option>
                <option value="6">Rechazados</option>
                <option value="5">Todos</option>                
            </select>
	</div>
    </div>
</div>
<div>
	<a class="btn btn-success pull-left" href="<?php echo base_url()?>cotizaciones/add">Agregar Solicitud de Cotización</a>
   <br /><br />
   <?php echo "<h1 style='font-size:14px; color:green'><span id='busqueda' style='margin-left:700px'>Mensaje</span></h1>"; //my code is here ?>
	<!-- Buscador -->
<!--    <div class="pull-right">
	<?php //echo form_open(base_url()."cotizaciones/search", array('class' => 'form-search pull-right')); ?>
		<input type="text" class="input-medium search-query" name="buscar" placeholder="Buscar" />
		<button type="submit" class="btn">Buscar</button>
		
	</form>
    </div>-->
    <!-- /Buscador -->

</div>
        <table class="table table-bordered table-striped indice display" id="example">
	<thead>
	<tr>
            <th>Número</th>
            <th>Número Antiguo</th>            
            <th>OT Antiguo</th>                
            <th>Fecha solicitud</th>
            <th>Cliente</th>
            <th>Producto</th>
            <th>Revisión</th>
            <th>PDF</th>            
            <th>Hoja Costos</th>
            <th>Cotización Cliente</th>
            <th>Detalle</th>
            <th>Acciones</th>
	</tr>
	</thead>
	<tbody>
	
	
	
	
	
    <?php
    foreach($datos as $dato)
    {
       
				  
	$archivo_cliente=$this->cotizaciones_model->getArchivoClientePorCotizacion($dato->id);
        if($dato->id_cliente==3000)
        {
            $cliente=$dato->nombre_cliente;
        }else
        {
           /// $cli=$this->clientes_model->getClientePorId($dato->id_cliente);
            $cli=$this->clientes_model->getClientePorIdBasico($dato->id_cliente);
            
            $cliente=$cli->razon_social;
        }
         switch($dato->estado)
        {
            case '1':
                $estado="Abierto";
                
            break;
             case '2':
                $estado="en proceso pendiente ingeniería";
            break;
             case '3':
                $estado="en proceso pendiente fotomecánica";
            break;
             case '4':
                $estado="información ratificada pendiente de cotización";
            break;
             case '5':
                $estado="cotización generada";
            break;
        }
        $ing=$this->cotizaciones_model->getCotizacionIngenieriaPorIdCotizacion($dato->id);
        $fotomecanica=$this->cotizaciones_model->getCotizacionFotomecanicaPorIdCotizacion($dato->id);
        $estadoCotizacion=$this->cotizaciones_model->getEstadoCotizacion($dato->id);
        $hoja=$this->cotizaciones_model->getHojaDeCostosPorIdCotizacion($dato->id);
        $orden=$this->cotizaciones_model->getOrdenDeCompraPorCotizacion($dato->id);
        $orden_produccion=$this->orden_model->getOrdenesPorCotizacion($dato->id);        

       
    ?>
    <tr> 
        <td><?php if(sizeof($ing)>=1 || sizeof($fotomecanica)>=1){echo "<a href='".base_url()."cotizaciones/view/".$dato->id."#'>".$dato->id."</a>";}else{echo "<a href='".base_url()."cotizaciones/editar_cotizacion/".$dato->id."#'>".$dato->id."</a>";}?></td>
        <td><?php echo $dato->ot_antigua?></td>       
        <td><?php echo $dato->ot_migrada?></td>                
        <td><?php echo $dato->fecha//echo fecha($dato->fecha)?></td>
        <td><?php echo $cliente?> <?php if($cli->estado==2){echo '(BLOQUEADO)';}?></td>
        <!--<td><?php //echo $dato->producto?></td> -->
        <td><?php if(sizeof($ing)>=1 || sizeof($fotomecanica)>=1){
            echo $ing->producto;
            echo "<br />aaa";exit();
        }else{
            echo $dato->producto;
            echo "<br />aaa";exit();
            
        }?></td>
        <td style="text-align: right; width: 160px;">
       <!--
 <a href="<?php // echo base_url()?>cotizaciones/estado/<?php // echo $dato->id?>/<?php // echo $pagina?>" title="Estado Cotización"><span style="font-size: 10px; font-weight: bold; color:<?php // if(sizeof($estadoCotizacion)==0){echo 'orange';}else{echo 'green';}?>">Estado Cotización</span><i class="icon-eye-open"></i></a>
        <br />
-->

          <?php
                if(sizeof($ing)>=1)
                {
                  switch($ing->estado)
                  {
                    case '0':
                        $colorIngenieria="color:orange";
                    break;
                    case '1':
                        $colorIngenieria="color:green";
                    break;
                    case '2':
                        $colorIngenieria="color:red";
                    break;
                  }  
                }else
                {
                  $colorIngenieria="";   
                }

            if($dato->condicion_del_producto == 'Repetición Con Cambios')
            {
                if ($dato->estado!=0){
                ?>
                <a href="<?php echo base_url()?>cotizaciones/revision_ingenieriaConCambio/<?php echo $dato->id?>/<?php echo $pagina?>" title="Revisión Ingeniería Con Cambio"><span style="font-size: 10px;font-weight: bold;<?php echo $colorIngenieria?>">Revisión Ingeniería Con Cambios</span><i class="icon-asterisk"></i></a>	
                <?php			
                }else{ ?>
                  <a href="<?php echo base_url()?>cotizaciones/revision_ingenieria/<?php echo $dato->id?>/<?php echo $pagina?>" title="Revisión Ingeniería"><span style="font-size: 10px;font-weight: bold;<?php echo $colorIngenieria?>">Revisión Ingeniería</span><i class="icon-asterisk"></i></a>	
                     <br />
                <?php }
            }else{
//                 if ($dato->estado!=0){?>
                     <a href="<?php echo base_url()?>cotizaciones/revision_ingenieria/<?php echo $dato->id?>/<?php echo $pagina?>" title="Revisión Ingeniería"><span style="font-size: 10px;font-weight: bold;<?php echo $colorIngenieria?>">Revisión Ingeniería</span><i class="icon-asterisk"></i></a>	
                     <br />
                 <?php
//                 }
            }
            if(sizeof($fotomecanica)>=1)
            {
              switch($fotomecanica->estado)
              {
                case '0':
				
				//adam 
				if($fotomecanica->guardar_con_comentarios !='')
				{
					$colorFotomecanica="color:orange";
				}
				else{
                    //$colorFotomecanica="color:orange";
                    $colorFotomecanica="color:orange";
				}	
				//adam	
					
                break;
                case '1':
                    $colorFotomecanica="color:green";
                break;
                case '2':
                    $colorFotomecanica="color:red";
                break;
              }  
            }else
            {
              $colorFotomecanica="";   
            }
//            if ($dato->estado!=0) { ?>
               <a href="<?php echo base_url()?>cotizaciones/revision_fotomecanica/<?php echo $dato->id?>/<?php echo $pagina?>" title="Revisión Fotomecánica"><span style="font-size: 10px; font-weight: bold;<?php echo $colorFotomecanica?>">Revisión Fotomecánica</span><i class="icon-film"></i></a>
            <?php
//            }
           
            if($dato->numero_molde!=11 && $dato->numero_molde!=12 && $dato->numero_molde!=13 && $dato->numero_molde!=14 && $dato->numero_molde!=15){
            if(sizeof($hoja)>=1 and $fotomecanica->estado==1 and $ing->estado==1)
            {
         ?>
		 
         <?php $orden=$this->cotizaciones_model->getOrdenDeCompraPorCotizacion($dato->id);?>
		 
		 		 		
		 <?php
            if(sizeof($orden)>=1)
            {
              switch($orden->estado)
              {
                case '0':
                    $colorOrden="color:orange";
                break;
                case '1':
                    $colorOrden="color:green";
                break;
                case '2':
                    $colorOrden="color:red";
                break;
              }  
            }else
            {
              $colorOrden="";   
            }
			  if($hoja->fecha != '0000-00-00')
			  {
					?>		  
					<br />
					<a href="<?php echo base_url()?>cotizaciones/orden_de_compra/<?php echo $dato->id?>/<?php echo $pagina?>" title="Ingreso Orden de Compra"><span style="font-size: 10px; font-weight: bold; <?php echo $colorOrden;?>">Ingreso Orden de Compra</span><i class="icon-shopping-cart"></i></a>
					<?php
			  }
            }}else{ ?>
                <a title="Ingreso Orden de Compra"><span style="font-size: 10px; font-weight: bold; <?php echo $colorOrden;?>">Cotizacion de Molde Fantasma</span></a>
            <?php
            }	
            ?>
            <?php
            //if( sizeof($fotomecanica)>0 and $fotomecanica->estado==1)
            if($dato->materialidad_solicita_muestra=='SI')
            {
                ?>
            <br />
            <?php $solicitaMuestra=$this->cotizaciones_model->getSolicitaMuestraPorCotizacion($dato->id);?>
            <a href="<?php echo base_url()?>cotizaciones/solicita_muestra/<?php echo $dato->id?>/<?php echo $pagina?>" title="Solicita Muestra"><span style="font-size: 10px;<?php if(sizeof($solicitaMuestra)>=1){echo 'color:#ff0000; font-weight: bold;';}?>">Solicita Muestra</span><i class="icon-tag"></i></a>
            <?php
            }
            ?>
			
			
			
            <?php
            $ordenesProduccion=$this->cotizaciones_model->getOrdenDeProduccionPorCotizacion($dato->id);
			//$ordenes=$this->orden_model->getOrdenesPorCotizacion($dato->id);
			if(sizeof($ordenesProduccion) >=1)
			{
					switch ($ordenesProduccion->estado)
					{ 
						case '0':
							$colorOrdenProduccion="orange";
						break;
						case '1':
							$colorOrdenProduccion="green";
						break;
						case '2':
							$colorOrdenProduccion="red";
						break;
					}
			}else
			{
							$colorOrdenProduccion="";
				
			}
            ?>
            
            <?php
            
            //if(sizeof($hoja)>0)
            if($fotomecanica->estado==1 and $ing->estado==1 and $orden->estado == 1 and sizeof($hoja)>=1)
            {
                ?>
                <br />
                <?php if($hoja->impreso==1){ ?>
                <a href="<?php echo base_url()?>ordenes/add/<?php echo $dato->id?>/<?php echo $pagina?>" title="Emisión Orden de Producción"><span style="font-size: 10px; font-weight: bold; color:<?php echo $colorOrdenProduccion?>">Emisión Orden de Producción</span> <i class="icon-cog"></i></a>
                <?php }else{ ?>
                <a href="#" onclick="alert('Debe imprimir primero la hoja de costos')" title="Emisión Orden de Producción"><span style="font-size: 10px; font-weight: bold; color:orange">Emisión Orden de Producción</span> <i class="icon-cog"></i></a>
                <?php } ?>
				
                <?php
            }
            ?>
        </td>
        <td style="text-align: center; width: 10px;">		
            <?php if ($archivo_cliente->archivo!=""){ ?>
		<a href='<?php echo base_url().$this->config->item('direccion_pdf').$archivo_cliente->archivo ?>' target="_blank"><img src="<?php echo base_url()."public/backend/img/"?>pdf.png" alt="PDF Cliente" title="PDF Cliente"></a>
            <?php } else { ?>    
		<img src="<?php echo base_url()."public/backend/img/"?>close_16.png" alt="No existe PDF de  Cliente" title="No existe PDF de  Cliente">
            <?php } ?>                <br />
            <?php if ($ing->archivo!=""){ ?>
		<a href='<?php echo base_url().$this->config->item('direccion_pdf').$ing->archivo ?>' target="_blank"><img src="<?php echo base_url()."public/backend/img/"?>pdf.png" alt="PDF Revisión Ingenieria" title="PDF Revisión Ingenieria"></a>
            <?php } else { ?>    
		<img src="<?php echo base_url()."public/backend/img/"?>close_16.png" alt="No existe PDF de  Revisión Ingenieria" title="No existe PDF de  Revisión Ingenieria">
            <?php } ?>                <br />
            <?php if ($orden->archivo!=""){ ?>
		<a href='<?php echo base_url().$this->config->item('direccion_pdf').$orden->archivo ?>' target="_blank"><img src="<?php echo base_url()."public/backend/img/"?>pdf.png" alt="PDF Orden de Compra" title="PDF Orden de Compra"></i></a>
            <?php } else { ?>    
		<img src="<?php echo base_url()."public/backend/img/"?>close_16.png" alt="No existe PDF de Orden de Compra" title="No existe PDF de Orden de Compra">
            <?php } ?>  
            <?php if ($orden_produccion->id!=""){ ?>
		<a href="<?php echo base_url()?>ordenes/pdf_orden/<?php echo $orden->id_cotizacion?>/<?php echo $orden->id?>" target="_blank"><img src="<?php echo base_url()."public/backend/img/"?>pdf.png" alt="PDF Orden de Producción" title="PDF Orden de Producción"></i></a>
            <?php } else { ?>    
		<img src="<?php echo base_url()."public/backend/img/"?>close_16.png" alt="No existe PDF de PDF Orden de Producción" title="No existe PDF de Orden de Producción">
            <?php } ?>  	                          
        </td>        
          <td style="text-align: center; width: 100px;">
                  <?php if($dato->condicion_del_producto == 'Repetición Sin Cambios'){
                      if($ing->estado==1 && $fotomecanica->estado==1){
                          if($ing->archivo!=""){ ?>
                              <a href="<?php echo base_url()?>cotizaciones/hoja_de_costos/<?php echo $dato->id?>/<?php echo $pagina?>" title="Hoja de Costos"><i class="icon-file"></i></a>
                         <?php }else{ ?>
                              <a href="javascript:void(0);" onclick="alert('Debe Incluir en Trazado de Ingeniería');" title="Hoja de Costos"><i class="icon-eye-close"></i></a>   
                         <?php }
                      }else{ ?>
                          <a href="javascript:void(0);" onclick="alert('Debe Completar Ingeniería y Fotomecanica');" title="Hoja de Costos"><i class="icon-eye-close"></i></a>   
                     <?php }
                  }?>
                  <?php if($dato->condicion_del_producto == 'Repetición Con Cambios'){
                      if($ing->estado==1 && $fotomecanica->estado==1){
                          if($ing->archivo!=""){ ?>
                              <a href="<?php echo base_url()?>cotizaciones/hoja_de_costos/<?php echo $dato->id?>/<?php echo $pagina?>" title="Hoja de Costos"><i class="icon-file"></i></a>
                         <?php }else{ ?>
                              <a href="javascript:void(0);" onclick="alert('Debe Incluir en Trazado de Ingeniería');" title="Hoja de Costos"><i class="icon-eye-close"></i></a>   
                         <?php }
                      }else{ ?>
                          <a href="javascript:void(0);" onclick="alert('Debe Completar Ingeniería y Fotomecanica');" title="Hoja de Costos"><i class="icon-eye-close"></i></a>   
                  <?php }
                  }?>
                  <?php if($dato->condicion_del_producto == 'Nuevo'){
                      if($ing->estado==1 && $fotomecanica->estado==1){
                          if($ing->archivo!=""){ ?>
                              <a href="<?php echo base_url()?>cotizaciones/hoja_de_costos/<?php echo $dato->id?>/<?php echo $pagina?>" title="Hoja de Costos"><i class="icon-file"></i></a>
                         <?php }else{ ?>
                              <a href="javascript:void(0);" onclick="alert('Debe Incluir en Trazado de Ingeniería');" title="Hoja de Costos"><i class="icon-eye-close"></i></a>   
                         <?php }
                      }else{ ?>
                          <a href="javascript:void(0);" onclick="alert('Debe Completar Ingeniería y Fotomecanica');" title="Hoja de Costos"><i class="icon-eye-close"></i></a>   
                  <?php }
                  }?>
                  <?php if($dato->condicion_del_producto == 'Repetici?n Sin Cambios'){
                      if($ing->estado==1 && $fotomecanica->estado==1){
                          if($ing->archivo!=""){ ?>
                              <a href="<?php echo base_url()?>cotizaciones/hoja_de_costos/<?php echo $dato->id?>/<?php echo $pagina?>" title="Hoja de Costos"><i class="icon-file"></i></a>
                         <?php }else{ ?>
                              <a href="javascript:void(0);" onclick="alert('Debe Incluir en Trazado de Ingeniería');" title="Hoja de Costos"><i class="icon-eye-close"></i></a>   
                         <?php }
                      }else{ ?>
                          <a href="javascript:void(0);" onclick="alert('Debe Completar Ingeniería y Fotomecanica');" title="Hoja de Costos"><i class="icon-eye-close"></i></a>   
                  <?php }
                  }?>
                  <?php if($dato->condicion_del_producto == 'Producto Genérico'){
                      if($ing->estado==1 && $fotomecanica->estado==1){
                          if($ing->archivo!=""){ ?>
                              <a href="<?php echo base_url()?>cotizaciones/hoja_de_costos/<?php echo $dato->id?>/<?php echo $pagina?>" title="Hoja de Costos"><i class="icon-file"></i></a>
                         <?php }else{ ?>
                              <a href="javascript:void(0);" onclick="alert('Debe Incluir en Trazado de Ingeniería');" title="Hoja de Costos"><i class="icon-eye-close"></i></a>   
                         <?php }
                      }else{ ?>
                          <a href="javascript:void(0);" onclick="alert('Debe Completar Ingeniería y Fotomecanica');" title="Hoja de Costos"><i class="icon-eye-close"></i></a>   
                  <?php }
                  }?>
          </td>
          <td style="text-align: center;">
            <?php
//            echo sizeof($ing);
//            echo sizeof($hoja);
//            echo sizeof($fotomecanica);
//            echo $ing->estado;
//            echo $fotomecanica->estado;
            //if(sizeof($ing)==0 || sizeof($fotomecanica)==0 || $ing->estado==2 || $fotomecanica->estado==2 || sizeof($hoja)==0)
            if(sizeof($ing)==0 || sizeof($fotomecanica)==0 || $ing->estado==2 || $fotomecanica->estado==2)
            {
                ?>
                <a href="#" onclick="alert('Debe completar los formularios de Ingeniería y Foto-Mécánica, y éstos deben estar liberados!!!'); return false;" title="Cotización de Cliente"><i class="icon-file"></i></a>
                <?php
            }else
            {
                if(sizeof($hoja)==0){?>
                <a href="#" onclick="alert('Debe completar la hoja de costos, y ésta debe haberse guardado!!!'); return false;" title="Cotización de Cliente"><i class="icon-file"></i></a>
                <?php        
                }else{
                ?>
                <a href="<?php echo base_url()?>cotizaciones/cotizacion_de_cliente/<?php echo $dato->id?>" title="Cotización de Cliente" target="_blank"><i class="icon-file"></i></a>
                <?php
            }}
            ?>
            	
         
         </td>
        <td style="text-align: center;">
            <a href="<?php echo base_url()?>cotizaciones/detalle_ajax/<?php echo $dato->id?>" title="<?php echo $dato->nombre?>" class="fancybox fancybox.ajax"><i class="icon-search"></i></a>	
            </td>
            
			<td>
					 <?php
					//Usuario 
					if( $this->session->userdata('perfil')!=2)
					{
					?>
			
                                            <?php
                                            if(sizeof($ing)==0 and sizeof($ordenes)==0)
                                            {
                                                    ?>
                                                    <a href="<?php echo base_url()?>cotizaciones/add/<?php echo $dato->id?>/<?php echo $pagina?>" title="Editar"><i class="icon-pencil"></i></a>	

                                                    <?php

                                            }else
                                            {
                                                    if($dato->condicion_del_producto == 'Repetición Sin Cambios' or $dato->condicion_del_producto == 'Repetición Con Cambios')
                                                    {
                                                            ?>
                                                            <a href="javascript:void(0);" title="Editar" onclick="alert('No se puede modificar ya ques es Repetición Con o Sin Cambio');"><i class="icon-remove-sign"></i></a>	
                                                            <?php 
                                                    }else{	
                                                    ?>
                                                    <a href="javascript:void(0);" title="Editar" onclick="alert('No se puede editar porque ya hay procesos abiertos');"><i class="icon-pencil"></i></a>	

                                                    <?php
                                                    }
                                            }
                                            ?>
									
					<?php
					}else{
					?>				
               	
								
							<a href="javascript:void(0);" title="Editar" onclick="alert('No puede Editar ya que no tiene los permisos necesarios');"><i class="icon-ban-circle"></i></a>	
				
					<?php
					}
					?>				
               	
            </td>
		
			<?php
    }
    ?>
    </tbody>
   
<!--     <tr>
        <td colspan="12" style="text-align: right;">
        <?php// echo $this->layout->element('admin_paginador'); ?>
        </td>
    </tr>-->
</table>
<script type="text/javascript" src="<?php echo base_url()?>public/frontend/js/chosen.jquery.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>public/frontend/js/prism.js"></script>
<script type="text/javascript">
    var config = {
      '.chosen-select'           : {},
      '.chosen-select-deselect'  : {allow_single_deselect:true},
      '.chosen-select-no-single' : {disable_search_threshold:10},
      '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
      '.chosen-select-width'     : {width:"95%"}
    }
    for (var selector in config) {
      $(selector).chosen(config[selector]);
    }
  </script>
<script type="text/javascript">
$(document).ready(function() {
	$(".fancybox").fancybox({
		openEffect	: 'none',
		closeEffect	: 'none'
	});
$('input').on('keyup',function(){
 alert();
});    
});


$(document).ready(function() {
    $('#example').DataTable( {
        "order": [[ 0, "desc" ]]
    } );
    } );

</script>
<script>
document.getElementById("fname").onkeyup = function() {myFunction()};

function myFunction() {
    var x = document.getElementById("example");
    x.value = x.value.toUpperCase();
}
</script>

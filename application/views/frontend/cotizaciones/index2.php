<!--<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.16/datatables.min.css"/>-->
 
<!--<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.16/datatables.min.js"></script>-->
<?php if ( $this->session->flashdata('ControllerMessage') != '' ) : ?>
<div class="alert alert-success"><?php echo $this->session->flashdata('ControllerMessage'); ?></div>
<?php endif; ?>
<div class="page-header"><h3>Solicitud de Cotizaciones ( <?php echo $cuantos?> en total)</h3>

    <div id="messages"></div>
</div>



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
    <a class="btn btn-success pull-left" href="<?php echo base_url()?>cotizaciones/add">Agregar Solicitud de Cotización</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a class="btn btn-warning" id="borrar" data-target="#exampleModal">Borrar Cotizaciones</a>
   <br /><br />
	<!-- Buscador -->
        <div class="centrar" style="text-align: center; color:#ffffff;; margin:0px auto; width: 400px; font-size: 16px; font-weight: bold; background-color: green;">
            <span id="mensaje"><?php if(sizeof($busqueda)>0){if($busqueda->estado==1){echo "La cotizacion ya pertenece al sistema rojo";}else{
                if($busqueda->estado==3 || $busqueda->estado==4){echo "La cotizacion se encuentra en ordenes cerradas en el sistema rojo";}
            }} ?></span>
    </div>
        
    <div class="pull-right">
	<?php echo form_open(base_url()."cotizaciones/search", array('class' => 'form-search pull-right')); ?>
        <input type="text" id="buscar_text" class="input-medium search-query" name="buscar" placeholder="Buscar" />
		<button id="buscar_index" type="submit" class="btn">Buscar</button>
	</form>
    </div><br /><br />
    <!-- /Buscador -->

</div>
        <table class="table table-bordered table-striped indice" id="example">
	<thead>
	<tr>
            <th>Número</th>
            <th>Número Antiguo</th>            
            <th>OT Antiguo</th>                
            <th id="cabecera" orden="desc">Fecha solicitud</th>
            <th>Cliente</th>
            <th>Producto</th>
            <th>Revisión</th>
            <th>PDF</th>            
            <th>Hoja Costos</th>
            <th>Cotización Cliente</th>
            <th>Detalle</th>
            <th>Acciones</th>
            <th>Del</th>
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
        $trazadosing=$this->trazados_model->getTrazadosPorId($dato->trazado);        

       
    ?>
        <tr elemento="<?php echo $dato->id ?>"> 
        <td><?php if(sizeof($ing)>=1 || sizeof($fotomecanica)>=1){echo "<a href='".base_url()."cotizaciones/view/".$dato->id."#'>".$dato->id."</a>";}else{echo "<a href='".base_url()."cotizaciones/editar_cotizacion/".$dato->id."#'>".$dato->id."</a>";}?></td>
        <td><?php echo $dato->ot_antigua?></td>       
        <td><?php echo $dato->ot_migrada?></td>                
        <td><?php echo $dato->fecha//echo fecha($dato->fecha)?></td>
        <td><?php echo $cliente?> <?php if($cli->estado==2){echo '(BLOQUEADO)';}?><br /><?php echo "Colores: ".$ing->colores?><br /><?php echo "Molde: ".$dato->numero_molde."<br />T1: ".$ing->tamano_a_imprimir_1." T2: ".$ing->tamano_a_imprimir_2?>
        <?php 
        if($dato->numero_molde==21){
        echo "<br />Trazado: ".$dato->trazado;
        }
        ?>
        </td>
        <!--<td><?php //echo $dato->producto?></td> -->
        <td><?php if(sizeof($ing)>=1 || sizeof($fotomecanica)>=1){
            echo $ing->producto;
            echo "<br />";
            if(sizeof($hoja)>0){
            echo "C1: ".$dato->cantidad_1." P1: ".number_format($hoja->valor_empresa,0,"",".");
            echo " - ";
            if($dato->cantidad_2!=1 && $dato->cantidad_2!=0){
            echo "C2: ".$dato->cantidad_2." P2: ".number_format($hoja->valor_empresa_2,0,"",".");
            echo " - ";}
            if($dato->cantidad_3!=1 && $dato->cantidad_3!=0){
            echo "C3: ".$dato->cantidad_3." P3: ".number_format($hoja->valor_empresa_3,0,"",".");
            echo " - ";}
            if($dato->cantidad_4!=1 && $dato->cantidad_4!=0){
            echo "C4: ".$dato->cantidad_4." P4: ".number_format($hoja->valor_empresa_4,0,"",".");
            echo " - ";}
            if($dato->rev==1 && $dato->fecha_rev!=""){
            echo "<label style='background-color:green; color:white; font-weight:bold;'>Reversada en fecha: ".fecha($dato->fecha_rev)."<br />"
                    . "Nro Ot: ".$orden->id."</label>";
            }
            }
        }else{
            echo $dato->producto;
            echo "<br />";
            if(sizeof($hoja)>0){
            echo "Cant 1: ".$dato->cantidad_1." Precio: ".number_format($hoja->valor_empresa,0,"",".");
            echo "<br />";
            if($dato->cantidad_2!=1 && $dato->cantidad_2!=0){
            echo "Cant 2: ".$dato->cantidad_2." Precio: ".number_format($hoja->valor_empresa_2,0,"",".");
            echo "<br />";}
            if($dato->cantidad_3!=1 && $dato->cantidad_3!=0){
            echo "Cant 3: ".$dato->cantidad_3." Precio: ".number_format($hoja->valor_empresa_3,0,"",".");
            echo "<br />";}
            if($dato->cantidad_4!=1 && $dato->cantidad_4!=0){
            echo "Cant 4: ".$dato->cantidad_4." Precio: ".number_format($hoja->valor_empresa_4,0,"",".");
            echo "<br />";}
            }
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
                <a href="<?php echo base_url()?>cotizaciones/revision_ingenieria/<?php echo $dato->id?>/<?php echo $pagina?>" title="Revisión Ingeniería"><span style="font-size: 10px;font-weight: bold;<?php echo $colorIngenieria?>">Revisión Ingeniería</span><i class="icon-asterisk"></i></a>	
                <br />
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
            if(sizeof($hoja)>=1 && $fotomecanica->estado==1 && $ing->estado==1)
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
                                        <?php if($hoja->impreso!=1){ ?>
                <a href="#" onclick="alert('Debe completar la hoja de costos, y ésta debe haberse guardado e impreso!!!'); return false;" title="Cotización de Cliente"><span style="font-size: 10px; font-weight: bold; color:<?php echo $colorOrdenProduccion?>">Ingreso Orden de Compra</span><i class="icon-shopping-cart"></i></a>
            <?php }else{ ?>
                		<a href="<?php echo base_url()?>cotizaciones/orden_de_compra/<?php echo $dato->id?>/<?php echo $pagina?>" title="Ingreso Orden de Compra"><span style="font-size: 10px; font-weight: bold; <?php echo $colorOrden;?>">Ingreso Orden de Compra</span><i class="icon-shopping-cart"></i></a>
            <?php } ?>
					<?php
			  }
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
                <a href="<?php echo base_url()?>ordenes/add/<?php echo $dato->id?>/<?php echo $pagina?>" title="Emisión Orden de Producción"><span style="font-size: 10px; font-weight: bold; color:<?php echo $colorOrdenProduccion?>">Emisión Orden de Producción</span> <i class="icon-cog"></i></a>
				
                <?php
            }
            ?>
        </td>
        <td style="text-align: center; width: 10px;">
             <?php $fot_pro=$this->produccion_model->getFotomecanicaPorTipo(1,$dato->id); ?>
            <?php $moldes2=$this->moldes_model->getMoldesPorId($dato->numero_molde); ?>
            <?php if ($fotomecanica->pdf_imagen_imprimir!=""){ ?>
		<a href='<?php echo base_url().$this->config->item('direccion_pdf').$fotomecanica->pdf_imagen_imprimir ?>' target="_blank"><img src="<?php echo base_url()."public/backend/img/"?>pdf.png" alt="PDF Imagen a Imprimir" title="PDF Imagen a Imprimir"></a>
            <?php } else { if($fot_pro->pdf_imagen!=""){ ?>    
		<a href='<?php echo base_url().$this->config->item('direccion_pdf').$fot_pro->pdf_imagen ?>' target="_blank"><img src="<?php echo base_url()."public/backend/img/"?>pdf.png" alt="PDF Imagen a Imprimir" title="PDF Imagen a Imprimir"></a>
            <?php } else { ?>    
		<img src="<?php echo base_url()."public/backend/img/"?>close_16.png" alt="No existe PDF de Imagen a Imprimir" title="No existe PDF de Imagen a Imprimir">
            <?php } } ?>                <br />
            <?php if ($archivo_cliente->archivo!=""){ ?>
		<a href='<?php echo base_url().$this->config->item('direccion_pdf').$archivo_cliente->archivo ?>' target="_blank"><img src="<?php echo base_url()."public/backend/img/"?>pdf.png" alt="PDF Cliente" title="PDF Cliente"></a>
            <?php } else { ?>    
		<img src="<?php echo base_url()."public/backend/img/"?>close_16.png" alt="No existe PDF de  Cliente" title="No existe PDF de  Cliente">
            <?php } ?>                <br />
            <?php if($moldes2->archivo!=""){ if($trazadosing->archivo!=""){ ?>
		<a href='<?php echo base_url().$this->config->item('direccion_pdf').$trazadosing->archivo ?>' target="_blank"><img src="<?php echo base_url()."public/backend/img/"?>pdf.png" alt="PDF Revisión Ingenieria" title="PDF Revisión Ingenieria"></a>
            <?php }else{ ?>
                <a href='<?php echo base_url().$this->config->item('direccion_pdf').$moldes2->archivo ?>' target="_blank"><img src="<?php echo base_url()."public/backend/img/"?>pdf.png" alt="PDF Revisión Ingenieria" title="PDF Revisión Ingenieria"></a>
            <?php } } else { if($trazadosing->archivo!=""){ ?>
            <a href='<?php echo base_url().$this->config->item('direccion_pdf').$trazadosing->archivo ?>' target="_blank"><img src="<?php echo base_url()."public/backend/img/"?>pdf.png" alt="PDF Revisión Ingenieria" title="PDF Revisión Ingenieria"></a>
            <?php } else {?>
		<img src="<?php echo base_url()."public/backend/img/"?>close_16.png" alt="No existe PDF de  Revisión Ingenieria" title="No existe PDF de  Revisión Ingenieria">
            <?php } } ?>                <br />
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
                  <?php $trazadosing=$this->trazados_model->getTrazadosPorId($dato->trazado); ?>
                  <?php if($dato->condicion_del_producto == 'Repetición Sin Cambios'){
                      if($ing->estado==1 && $fotomecanica->estado==1){
                          if($moldes2->archivo!="" || $trazadosing->archivo!=""){ ?>
                              <a href="<?php echo base_url()?>cotizaciones/hoja_de_costos_propia/<?php echo $dato->id?>/<?php echo $pagina?>" title="Hoja de Costos"><i class="icon-file"></i></a>
                         <?php }else{
                             if($ing->estan_los_moldes=="NO LLEVA" && $ing->hay_que_troquelar=="NO"){ ?>
                             <a href="<?php echo base_url()?>cotizaciones/hoja_de_costos_propia/<?php echo $dato->id?>/<?php echo $pagina?>" title="Hoja de Costos"><i class="icon-file"></i></a><?php if($hoja->impreso==1){echo "L";}?>
                             <?php }else{ ?>
                              <a href="javascript:void(0);" onclick="alert('Debe Incluir Trazado de Ingeniería');" title="Hoja de Costos"><i class="icon-eye-close"></i></a>   
                         <?php } }
                      }else{ ?>
                          <a href="javascript:void(0);" onclick="alert('Debe Completar Ingeniería y Fotomecanica');" title="Hoja de Costos"><i class="icon-eye-close"></i></a>   
                     <?php }
                  }?>
                  <?php if($dato->condicion_del_producto == 'Repetición Con Cambios'){
                      if($ing->estado==1 && $fotomecanica->estado==1){
                          if($moldes2->archivo!="" || $trazadosing->archivo!=""){ ?>
                              <a href="<?php echo base_url()?>cotizaciones/hoja_de_costos_propia/<?php echo $dato->id?>/<?php echo $pagina?>" title="Hoja de Costos"><i class="icon-file"></i></a><?php if($hoja->impreso==1){echo "L";}?>
                         <?php }else{
                             if($ing->estan_los_moldes=="NO LLEVA" && $ing->hay_que_troquelar=="NO"){ ?>
                             <a href="<?php echo base_url()?>cotizaciones/hoja_de_costos_propia/<?php echo $dato->id?>/<?php echo $pagina?>" title="Hoja de Costos"><i class="icon-file"></i></a><?php if($hoja->impreso==1){echo "L";}?>
                             <?php }else{ ?>
                              <a href="javascript:void(0);" onclick="alert('Debe Incluir en Trazado de Ingeniería');" title="Hoja de Costos"><i class="icon-eye-close"></i></a>   
                         <?php } }
                      }else{ ?>
                          <a href="javascript:void(0);" onclick="alert('Debe Completar Ingeniería y Fotomecanica');" title="Hoja de Costos"><i class="icon-eye-close"></i></a>   
                  <?php }
                  }?>
                  <?php if($dato->condicion_del_producto == 'Nuevo'){
                      if($ing->estado==1 && $fotomecanica->estado==1){
                          if($moldes2->archivo!="" || $trazadosing->archivo!=""){ ?>
                              <a href="<?php echo base_url()?>cotizaciones/hoja_de_costos_propia/<?php echo $dato->id?>/<?php echo $pagina?>" title="Hoja de Costos"><i class="icon-file"></i></a><?php if($hoja->impreso==1){echo "L";}?>
                         <?php }else{
                             if($ing->estan_los_moldes=="NO LLEVA" && $ing->hay_que_troquelar=="NO"){ ?>
                             <a href="<?php echo base_url()?>cotizaciones/hoja_de_costos_propia/<?php echo $dato->id?>/<?php echo $pagina?>" title="Hoja de Costos"><i class="icon-file"></i></a><?php if($hoja->impreso==1){echo "L";}?>
                             <?php }else{ ?>
                              <a href="javascript:void(0);" onclick="alert('Debe Incluir en Trazado de Ingeniería');" title="Hoja de Costos"><i class="icon-eye-close"></i></a>   
                         <?php } }
                      }else{ ?>
                          <a href="javascript:void(0);" onclick="alert('Debe Completar Ingeniería y Fotomecanica');" title="Hoja de Costos"><i class="icon-eye-close"></i></a>   
                  <?php }
                  }?>
                  <?php if($dato->condicion_del_producto == 'Repetici?n Sin Cambios'){
                      if($ing->estado==1 && $fotomecanica->estado==1){
                          if($moldes2->archivo!="" || $trazadosing->archivo!=""){ ?>
                              <a href="<?php echo base_url()?>cotizaciones/hoja_de_costos_propia/<?php echo $dato->id?>/<?php echo $pagina?>" title="Hoja de Costos"><i class="icon-file"></i></a><?php if($hoja->impreso==1){echo "L";}?>
                         <?php }else{
                             if($ing->estan_los_moldes=="NO LLEVA" && $ing->hay_que_troquelar=="NO"){ ?>
                             <a href="<?php echo base_url()?>cotizaciones/hoja_de_costos_propia/<?php echo $dato->id?>/<?php echo $pagina?>" title="Hoja de Costos"><i class="icon-file"></i></a><?php if($hoja->impreso==1){echo "L";}?>
                             <?php }else{ ?>
                              <a href="javascript:void(0);" onclick="alert('Debe Incluir en Trazado de Ingeniería');" title="Hoja de Costos"><i class="icon-eye-close"></i></a>   
                         <?php } }
                      }else{ ?>
                          <a href="javascript:void(0);" onclick="alert('Debe Completar Ingeniería y Fotomecanica');" title="Hoja de Costos"><i class="icon-eye-close"></i></a>   
                  <?php }
                  }?>
                  <?php if($dato->condicion_del_producto == 'Producto Genérico'){
                      if($ing->estado==1 && $fotomecanica->estado==1){
                          if($moldes2->archivo!="" || $trazadosing->archivo!=""){ ?>
                              <a href="<?php echo base_url()?>cotizaciones/hoja_de_costos_propia/<?php echo $dato->id?>/<?php echo $pagina?>" title="Hoja de Costos"><i class="icon-file"></i></a><?php if($hoja->impreso==1){echo "L";}?>
                         <?php }else{
                             if($ing->estan_los_moldes=="NO LLEVA" && $ing->hay_que_troquelar=="NO"){ ?>
                             <a href="<?php echo base_url()?>cotizaciones/hoja_de_costos_propia/<?php echo $dato->id?>/<?php echo $pagina?>" title="Hoja de Costos"><i class="icon-file"></i></a><?php if($hoja->impreso==1){echo "L";}?>
                             <?php }else{ ?>
                              <a href="javascript:void(0);" onclick="alert('Debe Incluir en Trazado de Ingeniería');" title="Hoja de Costos"><i class="icon-eye-close"></i></a>   
                         <?php } }
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
            {if($hoja->impreso!=1){ ?>
                <a href="#" onclick="alert('Debe completar la hoja de costos, y ésta debe haberse guardado e impreso!!!'); return false;" title="Cotización de Cliente"><i class="icon-file"></i></a>
            <?php }else{ ?>
                <a href="#" onclick="alert('Debe completar los formularios de Ingeniería y Foto-Mécánica, y éstos deben estar liberados!!!'); return false;" title="Cotización de Cliente"><i class="icon-file"></i></a>
            <?php }
            }else
            {
                if($hoja->impreso!=1){?>
                <a href="#" onclick="alert('Debe completar la hoja de costos, y ésta debe haberse guardado e impreso!!!'); return false;" title="Cotización de Cliente"><i class="icon-file"></i></a>
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
                                                            <a href="javascript:void(0);" title="Editar" onclick="alert('No se puede modificar ya que es Repetición Con o Sin Cambio');"><i class="icon-remove-sign"></i></a>	
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
            <th><input type="checkbox" name="todos" class="todos" id="<?php echo $dato->id?>"/></th>
		
			<?php
    }
    ?>
    </tbody>
    
    
    <tr>
        <td colspan="12" style="text-align: right;">
        <?php echo $this->layout->element('admin_paginador'); ?>
        </td>
    </tr>
</table>
          </div>
        </div>
    </div>
    <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Autorizar Borrado de Cotizaciones</h5>
        <button id="close" type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <input  autocomplete="off" type="password" id="password" title="password" name="pass" value="" placeholder="Indique el Password"/>
          <span id="mensajevalidacion" style="color:red;font-weight: bold"></span>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button id="confirmado" type="button" class="btn btn-primary" onclick="borrar_cotizaciones(<?php echo $datos->id ?>);">Borrar</button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript" src="<?php echo base_url()?>public/frontend/js/chosen.jquery.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>public/frontend/js/prism.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>public/mensajes/public/sockets-1.1.1.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>public/mensajes/public/sockets.js"></script>
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
        
        
        $("#cabecera").on('click',function(){
            var x = $(this).attr('orden');
            alert(x);
            window.location=webroot+"cotizaciones/orden/"+x;
        });
        
            
        $("#borrar").on('click',function(){    
        var cotizaciones=[];
        $("input:checkbox:checked").each(function(i) {
             cotizaciones.push($(this).attr('id'));
        });
             if(cotizaciones.length===0){    
             alert('Debe seleccionar al menos una cotizacion...');
             }else{    
             $('#exampleModal').modal({
                show: 'true'
             }); 
             
             }
         });
        
        $("#confirmado").on('click',function(){
        var cotizaciones=[];
        $("input:checkbox:checked").each(function(i) {
             cotizaciones.push($(this).attr('id'));
        });
        if($("#password").val()!=='999999'){
            alert("Clave erronea");
        }else{
        var ruta = webroot+'cotizaciones/borrar_items';
        $.post(ruta,{numeros:cotizaciones},(data)=>{
        
        if(data==0){
        alert("No se puede eliminar el registro porque ya existe una hoja de costos");
        }else{
        $("input:checkbox:checked").each(function(i) {
             $(this).parent().parent('tr').remove();
        });    
        alert(data);
        }
                
        });
        $('#exampleModal').modal('hide');
    } });
});

</script>


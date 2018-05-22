<link rel = "stylesheet" type = "text/css" href = "<?php echo base_url(); ?>css/datepicker.css">
<script type = 'text/javascript' src = "<?php echo base_url(); ?>js/bootstrap-datepicker.js"></script>
<script type = 'text/javascript' src = "<?php echo base_url(); ?>js/mis_funciones.js"></script>
<style>
    .ir-arriba {
	/*display:none;*/
	padding:20px;
	background:#024959;
	font-size:20px;
	color:#fff;
	cursor:pointer;
	position: fixed;
	bottom:20px;
	right:20px;
}
.ir-arriba2 {
	/*display:none;*/
	padding:20px;
	background:#024959;
	font-size:20px;
	color:#fff;
	cursor:pointer;
	position: fixed;
	top:20px;
	right:20px;
}
</style>
<span class="ir-arriba2 icon-arrow-up">↓</span>
    <?php 
	function getField($campo,$datos,$ing)
	{
		$listo=false;
		foreach ($ing as $key => $value) {

		//print_r(strrpos($key,$campo));
		if (strpos($key,$campo) !== false && strrpos($key,$campo)<2 && (strlen($key)<=strlen($campo))) {
			//print_r($value);//do something with the page count
			$listo=true;
			print_r($value);
			}
			
		}
	
		if($listo) return "";

		foreach ($datos as $key => $value) {

		//print_r(strrpos($key,$campo));
		if (strpos($key,$campo) !== false && strrpos($key,$campo)<2 && (strlen($key)<=strlen($campo))) {
			print_r($value);//do something with the page count  	
			//return $value;
			}
			
		}
		
			//print_r($datos->$campo);
		
		//$datos_tmp=$datos;
		//$ing_tmp=array_values($ing);
		//var_dump($datos[0]);
		// if ($ing==null))
		// {
			// print_r($datos[$campo]);
		// }else{
			// print_r($ing[$campo]);
		// }
	}
//        print_r($orden);
        $usuario=$this->usuarios_model->getUsuariosPorId($ing->quien);
        $cli=$this->clientes_model->getClientePorId($datos->id_cliente);
        
?>
<?php $this->layout->element('admin_mensaje_validacion'); ?>
<div id="contenidos">
<?php echo form_open_multipart(null, array('class' => 'form-horizontal','name'=>'form','id'=>'form')); ?>
<!-- Migas -->
    <ol  class= "breadcrumb" >  
      <li><a href="<?php echo base_url()?>cotizaciones/index/<?php echo $pagina?>">Cotizaciones &gt;&gt;</a></li>
      <li><a href="<?php echo base_url()?>cotizaciones/search_cot/<?php echo $id?>">Volver&gt;&gt;</a></li>
      <li>Ingreso Orden de Compra</li>
    </ol>
   <!-- /Migas -->
	<div class="page-header"><h3>Ingreso Orden de Compra</h3></div>
        <?php if (sizeof($orden)>0) { ?>
            <?php if($orden->estado==1){ ?>        
            <div style="background-color: #ec5c00; color:white; width: 100%;">&nbsp;&nbsp;Orden de Compra ya fue liberada en la fecha: <?php echo $orden->fecha; ?> por <?php echo $usuario->nombre;?></div>
            <?php } elseif($orden->estado==0){ ?>        
            <div style="background-color: #00d6ec; color:white; width: 100%;">&nbsp;&nbsp;Orden de Compra ya fue Guardada en la fecha: <?php echo $orden->fecha; ?> por <?php echo $usuario->nombre;?></div>
            <?php } ?>              
        <?php } ?> 

        <?php if($datos->ot_antigua!=""){ ?>        
        <div style="background-color: red; color:white; width: 100%;">&nbsp;&nbsp;Orden Migrada de Sistema Viejo: <?php echo $orden->fecha?>...</div>
        <?php } ?>           
	<p>
         <ul>
        <?php
         if($datos->id_cliente==3000)
        {
            $cliente=$datos->nombre_cliente;
        }else
        {
            $cli=$this->clientes_model->getClientePorId($datos->id_cliente);
            $cliente=$cli->razon_social;
        }
        $vendedor=$this->usuarios_model->getUsuariosPorId($datos->id_vendedor);
        ?>
            <li>Cliente : <b><?php echo $cliente?></b></li>
            <li>Cotización N° : <b><?php echo $id?></b></li>
            <li>Fecha : <b><?php echo fecha($datos->fecha)?></b></li>
            <li>Vendedor : <b><?php echo $vendedor->nombre?></b></li>
            <?php if($datos->trazado!=""){ ?>
            <li>Nro Trazado: <b><?php echo $datos->trazado ?></b></li>
            <?php } ?>
        </ul>
    </p>
    
    <table>
        <tr>
            <td>
                
    <h3>Orden de Compra Cliente</h3>
    <?php //echo $fotomecanica->producto; ?>
    <div class="control-group">
		<label class="control-label" for="usuario">Nombre Producto</label>
		<div class="controls">
			<input type="text" style="width: 600px;" id="titulo" name="nombre_producto" value="<?php echo $fotomecanica->producto;?>" placeholder="nombre_producto" /> 
            
		</div>
	</div>
    
    <?php //echo $fotomecanica->producto; ?>
    <div class="control-group">
		<label class="control-label" for="usuario">Nombre Producto para cliente (idéntico a la orden de compra)</label>
		<div class="controls">
                        <input type="text" style="width: 600px;" id="titulo" name="nombre_producto_cliente" value="<?php if($orden->nombre_producto_cliente==""){echo $fotomecanica->producto;}else{echo $orden->nombre_producto_cliente;}?>" placeholder="nombre_producto_cliente" /> 
		</div>
	</div>
    
    
   <?php if(sizeof($orden) == 0) {   ?>
    <div class="control-group" id="producto">
		<label class="control-label" for="usuario">Orden de Compra Cliente <strong style="color: red;">(*)</strong></label>
		<div class="controls">
			<input type="text" name="orden_de_compra" placeholder="Orden de Compra Cliente" value="<?php echo $datos->orden_de_compra_migrada?>" onkeypress="return alpha_con_numeros(event)" />
		</div>
	</div>    

   <?php }else { ?>
    <div class="control-group" id="producto">
		<label class="control-label" for="usuario">Orden de Compra Cliente <strong style="color: red;">(*)</strong></label>
		<div class="controls">
                    <input type="text" name="orden_de_compra" placeholder="Orden de Compra Cliente" value="<?php if(sizeof($orden)>0){echo $orden->orden_de_compra_cliente;}else{echo $_POST['orden_de_compra'];}?>" onkeypress="return alpha_con_numeros(event)" />
		</div>
	</div>    
	 
   <?php } ?>    
   
	<div class="control-group">
		<label class="control-label" for="usuario">Fecha Orden Cliente<strong style="color: red;">(*)</strong></label>
		<div class="controls">
                    <input type="date" name="fecha_orden_cliente" placeholder="Introduzca Fecha" value="<?php if($orden->fecha_orden_cliente!=""){$invert = explode("-",$orden->fecha_orden_cliente);
                    $fecha_invert = $invert[2]."-".$invert[1]."-".$invert[0];
                    echo invertirFecha($orden->fecha_orden_cliente);  }else{echo $_POST['fecha_orden_cliente'];} ?>">
		</div>
        </div>	
	<div class="control-group" id="producto">
		<label class="control-label" for="usuario">Codigo producto del Cliente:<strong style="color: red;"></strong></label>
		<div class="controls">
			<input type="text" style="width: 600px;" name="codigo_de_compra_cliente" placeholder="Codigo Orden de Compra Cliente" value="<?php if(sizeof($orden)>0){echo $orden->codigo_de_compra_cliente;}else{echo $_POST['codigo_de_compra_cliente'];}?>"  />
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Imagen de Orden de Compra del Cliente</label>
		<div class="controls">
			<input type="file" id="file" name="file" />
                        <?php
                       if($orden->archivo!="") { ?>
                           <a href="<?php echo base_url().$this->config->item('direccion_pdf').$orden->archivo ?>" target="_blank" title="Ver"><i class="icon-search"></i></a>
                       <?php } ?>                           
                        <?php if ($orden->archivo!=""){ ?>   
			<div id="nomarch" style="background-color: #ec5c00; color:white; width: 30%;">&nbsp;&nbsp;Archivo Ya fue Cargado con Exito...</div>
                        <?php  } else { ?>  
			<div id="nomarch">Seleccione el Archivo...</div>                        
                        <?php  }  ?>                           
         
		</div>
    </div>
    <div class="control-group">
		<label class="control-label" for="usuario">Informacion del Cliente</label>
		<div class="controls">
			<input type="file" id="file2" name="file2" />
                        <?php
                       if($archivo_cliente->archivo!="") { ?>
                           <a href="<?php echo base_url().$this->config->item('direccion_pdf').$archivo_cliente->archivo ?>" target="_blank" title="Ver"><i class="icon-search"></i></a>
                       <?php } ?>                           
                        <?php if ($archivo_cliente->archivo!=""){ ?>   
			<div id="nomarch" style="background-color: #ec5c00; color:white; width: 30%;">&nbsp;&nbsp;Archivo Ya fue Cargado con Exito...</div>
                        <?php  } else { ?>  
			<div id="nomarch">Seleccione el Archivo...</div>                        
                        <?php  }  ?>                           
         
		</div>
    </div>
    
    <div class="control-group" id="producto">
		<label class="control-label" for="usuario">Moldes</label>
		<div class="controls">
        <?php
        if(sizeof($orden)==0)
        {
            if ($fotomecanica->estan_los_moldes!="NO LLEVA")
            {
            ?>
                Tiene Molde : <input readonly="true" style="width: 600px;" type="text" id="tiene_molde" name="tiene_molde" placeholder="Molde" value="<?php echo $fotomecanica->estan_los_moldes?>" />
                <br>
                <?php 
                //echo $fotomecanica->estan_los_moldes;
                if ($fotomecanica->estan_los_moldes=="NO")
                {                    
                    $nombre_molde=$ing->nombre_molde." - Nro: ".$ing->numero_molde;  
                }
                elseif ($fotomecanica->estan_los_moldes=="MOLDE GENERICO")
                {                    
                    $molde=$this->moldes_model->getMoldesPorId($fotomecanica->numero_molde);  
                    $nombre_molde=$molde->nombre." - Nro: ".$molde->id;
                }                     
                elseif ($fotomecanica->estan_los_moldes=="MOLDE REGISTRADOS DEL CLIENTE")  
                {                    
                    $molde=$this->moldes_model->getMoldesPorId($fotomecanica->numero_molde);  
                    $nombre_molde=$molde->nombre." - Nro: ".$molde->id;
                }                  
                elseif ($fotomecanica->estan_los_moldes=="SI")  
                {                    
                    $molde=$this->moldes_model->getMoldesPorId($fotomecanica->numero_molde);  
                    $nombre_molde=$molde->nombre." - Nro: ".$molde->id;
                }                  
                ?>
                <?php if ($fotomecanica->estan_los_moldes=="NO") { ?>
                    <input readonly="true" style="width: 600px;" type="hidden" id="nombre_molde" size="250" name="nombre_molde" placeholder="Molde" value="<?php echo $nombre_molde?>" />
                <?php } else { ?>   
                    Nombre del Molde: <input readonly="true" style="width: 600px;" type="text" id="nombre_molde" size="250" name="nombre_molde" placeholder="Molde" value="<?php echo $nombre_molde; ?>" />
                <?php }  ?>                 
                <input readonly="true" type="hidden" id="id_molde" name="id_molde" placeholder="Molde" value="<?php echo $datos->numero_molde; ?>" />
            <?php
            }            
        }else
        {
            $molde=$this->moldes_model->getMoldesPorId($orden->id_molde);  
            $nombre_molde=$molde->nombre;    
            if ($fotomecanica->estan_los_moldes!="NO LLEVA")
            {            
            ?>
                Tiene Molde : <input readonly="true" style="width: 600px;" type="text" id="tiene_molde" name="tiene_molde" placeholder="Molde" value="<?php echo $orden->tiene_molde?>" />
                <br>
                Nombre : <input readonly="true" style="width: 600px;" type="text" id="nombre_molde" size="250" name="nombre_molde" placeholder="Molde" value="<?php echo $nombre_molde?>" />
                <input readonly="true" type="hidden" id="id_molde" name="id_molde" placeholder="Molde" value="<?php echo $orden->id_molde?>" />                
            <?php
            }
            else
            {            
            ?>
                Tiene Molde : <input readonly="true" style="width: 600px;" type="text" id="tiene_molde" name="tiene_molde" placeholder="Molde" value="<?php echo $fotomecanica->estan_los_moldes?>" />
                <br>
                <?php if ($fotomecanica->estan_los_moldes=="NO") { ?>
                    <input readonly="true" type="hidden" id="nombre_molde" size="250" name="nombre_molde" placeholder="Molde" value="<?php echo $nombre_molde?>" />
                <?php } else { ?>   
                    Nombre del Molde: <input readonly="true" style="width: 600px;" type="text" id="nombre_molde" size="250" name="nombre_molde" placeholder="Molde" value="<?php echo $nombre_molde?>" />
                <?php }  ?>                  
                <input readonly="true" type="hidden" id="id_molde" name="id_molde" placeholder="Molde" value="" />                
            <?php
            }                
        }
        ?>
		
	</div>
    </div>      
            </td>
            <td style="vertical-align: top">
                <h3>Informacion de Despacho</h3>
                <ul>
                 <li>Despacho: <?php if($datos->retira_cliente=='SI'){echo "Retiro Por Cuenta del Cliente";}else{echo "Por Nuestra Cuenta";}?></li>
                 <li>Despacho Fuera de Santiago: <?php if($datos->despacho_fuera_de_santiago=='SI'){echo "SI";}else{echo "NO";}?></li>
            <?php if($datos->despacho_fuera_de_santiago=='SI'){
     switch ($datos->distancia) {
         case 1:
             echo "<li>Distancia: 50 - 120 Km</li>";
             break;
         
         case 2:
             echo "<li>Distancia: 121 - 200 Km</li>";
             break;
         
         case 3:
             echo "<li>Distancia: 201 - 400 Km</li>";
             break;
         
         case 4:
             echo "<li>Distancia: 400 o mas Km</li>";
             break;

         default:
             break;
     }               
            }?>
            </li>
            <li>Total o Parcial: <?php if($datos->tota_o_parcial=='Parcial'){
                echo "Parcial";
            }else{
                echo "Total";
            }
            ?>
            </li>
            <?php if($datos->tota_o_parcial=='Parcial'){
                echo "<li>Despachos: ".$datos->cantidad_de_despachos." Despachos</li>";
            }
            ?>
            </li>
        </ul>
                <h3>Direccion</h3>
                <?php// print_r($cli) //my code is here ?>
                <ul>
                    <li>Region: <?php echo $cli->region_despacho ?></li>
                    <li>Ciudad: <?php echo $cli->ciudad_despacho ?> </li>
                    <li>Comuna:  <?php echo $cli->comuna_despacho ?></li>
                    <li>Direccion:  <?php echo $cli->direccion_despacho ?></li>
                </ul>
            </td>
        </tr>
    </table>
    
<!-- ------------------------------------------------------->
<?php
//Lleno los arrays de procesos especiales
    $folia1=$this->procesosespeciales_model->getDetalleProcesosPorId($fotomecanica->folia1_proceso_seletec);
    $folia2=$this->procesosespeciales_model->getDetalleProcesosPorId($fotomecanica->folia2_proceso_seletec);
    $folia3=$this->procesosespeciales_model->getDetalleProcesosPorId($fotomecanica->folia3_proceso_seletec);
    $cuno1=$this->procesosespeciales_model->getDetalleProcesosPorId($fotomecanica->cuno1_proceso_seletec);
    $cuno2=$this->procesosespeciales_model->getDetalleProcesosPorId($fotomecanica->cuno2_proceso_seletec);
    //Lleno los arrays de costos fijos
    $cffolia1=$this->procesosespeciales_model->getDetalleProcesosPorId($fotomecanica->folia1_molde_selected);
    $cffolia2=$this->procesosespeciales_model->getDetalleProcesosPorId($fotomecanica->folia2_molde_selected);
    $cffolia3=$this->procesosespeciales_model->getDetalleProcesosPorId($fotomecanica->folia3_molde_selected);
    $cfcuno1=$this->procesosespeciales_model->getDetalleProcesosPorId($fotomecanica->cuno1_molde_selected);
    $cfcuno2=$this->procesosespeciales_model->getDetalleProcesosPorId($fotomecanica->cuno2_molde_selected); 
    
    function trabajo($folia,$nombre){
        if($folia->caracteristicas!=""){
          $tupla='<div style="border: 1px solid #CCCCCC;">
                  <input type="hidden" name="'.$nombre.'" value="'.$folia->caracteristicas.'">
                  <label>'.$folia->caracteristicas.'</label>
                  </div>';
          echo $tupla;
        }
    }
    function proveedor1($folia,$nombre){
        if($folia->caracteristicas!=""){
          $tupla='<div class="radio" style="border: 1px solid #CCCCCC;">
      <label><input required value="'.$folia->proveedor_nombre_1.'" type="radio" name="'.$nombre.'">'.$folia->proveedor_nombre_1.'</label>
    </div>';
          echo $tupla;
        }
    }  
    function proveedor2($folia,$nombre){
        if($folia->caracteristicas!=""){
          $tupla='<div class="radio" style="border: 1px solid #CCCCCC;">
      <label><input required value="'.$folia->proveedor_nombre_2.'" type="radio" name="'.$nombre.'">'.$folia->proveedor_nombre_2.'</label>
    </div>';
          echo $tupla;
        }
    } 
    
    function printr($array){
    echo '<pre>';
    print_r($array);
    echo '</pre>';
}
//printr($array);
?> 
<div class="control-group">
  <h3>Seleccion de Proveedores</h3>
  <p>Seleccione los proveedores para los trabajos especiales.</p>  
  <div class="row col-sm-4" style="float:left; width: 300px; border: 1px solid #CCCCCC; margin-left: 50px;">
      <div style="border: 1px solid #CCCCCC;"><label><b>Trabajo</b></label></div>
    <?php trabajo($folia1,'nfolia1'); ?>
    <?php trabajo($cffolia1,'mnfolia1'); ?>
    <?php trabajo($folia2,'nfolia2'); ?>
    <?php trabajo($cffolia2,'mnfolia2'); ?>
    <?php trabajo($folia3,'nfolia3'); ?>
    <?php trabajo($cffolia3,'mnfolia3'); ?>
    <?php trabajo($cuno1,'ncuno1');  ?>
    <?php trabajo($cfcuno1,'mncuno1');  ?>
    <?php trabajo($cuno2,'ncuno2');  ?>
    <?php trabajo($cfcuno2,'mncuno2');  ?>
  </div>
    <div class="row col-sm-4" style="float:left; width: 300px; border: 1px solid #CCCCCC; margin-left: 2px; margin-right: 1px;">
      <div style="border: 1px solid #CCCCCC;"><label><b>Proveedor 1</b></label></div>
    <?php proveedor1($folia1,'pfolia1'); ?>
    <?php proveedor1($cffolia1,'mpfolia1'); ?>
    <?php proveedor1($folia2,'pfolia2'); ?>
    <?php proveedor1($cffolia2,'mpfolia2'); ?>
    <?php proveedor1($folia3,'pfolia3'); ?>
    <?php proveedor1($cffolia3,'mpfolia3'); ?>
    <?php proveedor1($cuno1,'pcuno1');  ?>
    <?php proveedor1($cfcuno1,'mpcuno1');  ?>
    <?php proveedor1($cuno2,'pcuno2');  ?>
    <?php proveedor1($cfcuno2,'mpcuno2');  ?>
    </div>
    <div class="row col-sm-4" style="float:left; width: 300px; border: 1px solid #CCCCCC; margin-left: 1px; margin-right: 2px;">
      <div style="border: 1px solid #CCCCCC;"><label><b>Proveedor 2</b></label></div>
    <?php proveedor2($folia1,'pfolia1'); ?>
    <?php proveedor2($cffolia1,'mpfolia1'); ?>
    <?php proveedor2($folia2,'pfolia2'); ?>
    <?php proveedor2($cffolia2,'mpfolia2'); ?>
    <?php proveedor2($folia3,'pfolia3'); ?>
    <?php proveedor2($cffolia3,'mpfolia3'); ?>
    <?php proveedor2($cuno1,'pcuno1');  ?>
    <?php proveedor2($cfcuno1,'mpcuno1');  ?>
    <?php proveedor2($cuno2,'pcuno2');  ?>
    <?php proveedor2($cfcuno2,'mpcuno2');  ?>
    </div>
</div>   
<div>    
 <div class="control-group" style="float:left; width: 300px; border: 1px solid #CCCCCC; margin-left: 50px;">
    <?php
    $prov = json_decode($orden->proveedores);
    //printr($prov);
    
    ?>
    <table>
        <tr><td><b>Trabajo</b></td></tr>
        <tr><td><?php echo $prov->folia1->nfolia1 ?></td></tr>
        <tr><td><?php echo $prov->cffolia1->mnfolia1 ?></td></tr>
        <tr><td><?php echo $prov->folia2->nfolia2 ?></td></tr>
        <tr><td><?php echo $prov->cffolia2->mnfolia2 ?></td></tr>
        <tr><td><?php echo $prov->folia3->nfolia3 ?></td></tr>
        <tr><td><?php echo $prov->cffolia3->mnfolia3 ?></td></tr>
        <tr><td><?php echo $prov->cuno1->ncuno1 ?></td></tr>
        <tr><td><?php echo $prov->cfcuno1->mncuno1 ?></td></tr>
        <tr><td><?php echo $prov->cuno2->ncuno2 ?></td></tr>
        <tr><td><?php echo $prov->cfcuno2->mncuno2 ?></td></tr>
    </table>
</div>
 <div class="control-group" style="float:left; width: 300px; border: 1px solid #CCCCCC; margin-left: 5px;">
    <?php
    $prov = json_decode($orden->proveedores);
    //printr($prov);
    
    ?>
    <table>
        <tr><td><b>Proveedor Asignado</b></td></tr>
        <tr><td>&nbsp;<?php echo $prov->folia1->pfolia1 ?></td></tr>
        <tr><td>&nbsp;<?php echo $prov->cffolia1->mpfolia1 ?></td></tr>
        <tr><td>&nbsp;<?php echo $prov->folia2->pfolia2 ?></td></tr>
        <tr><td>&nbsp;<?php echo $prov->cffolia2->mpfolia2 ?></td></tr>
        <tr><td>&nbsp;<?php echo $prov->folia3->pfolia3 ?></td></tr>
        <tr><td>&nbsp;<?php echo $prov->cffolia3->mpfolia3 ?></td></tr>
        <tr><td>&nbsp;<?php echo $prov->cuno1->pcuno1 ?></td></tr>
        <tr><td>&nbsp;<?php echo $prov->cfcuno1->mpcuno1 ?></td></tr>
        <tr><td>&nbsp;<?php echo $prov->cuno2->pcuno2 ?></td></tr>
        <tr><td>&nbsp;<?php echo $prov->cfcuno2->mpcuno2 ?></td></tr>
    </table>
</div>
</div>
<br /><br /><br /><br /><br /><br />
<br /><br /><br /><br /><br /><br />
<br />
<!-- ------------------------------------------------------->
   <h3>Otros datos</h3>

   <?php
    if(sizeof($orden) == 0)
	 {
   ?>
   
    <div class="control-group" id="producto">
		<label class="control-label" for="usuario">Cantidad de Cajas<strong style="color: red;">(*)</strong></label>
		<div class="controls">
			<input type="text" name="cantidad_de_cajas" placeholder="Cantidad de Cajas" value="<?php echo $datos->cantidad_1?>" onkeypress="return soloNumeros(event)" onblur="ValidarCantidadesDeAcuerdoRangoMargenCotizados('<?php echo $id?>');"/>
		</div>
	</div>
	<?php
	 }else
	 {
   ?>
	
    <div class="control-group" id="producto">
		<label class="control-label" for="usuario">Cantidad de Cajas<strong style="color: red;">(*)</strong></label>
		<div class="controls">
			<input type="text" name="cantidad_de_cajas" placeholder="Cantidad de Cajas" value="<?php echo $orden->cantidad_de_cajas?>" onkeypress="return soloNumeros(event)" onblur="ValidarCantidadesDeAcuerdoRangoMargenCotizados('<?php echo $id?>');" />
		</div>
	</div>
	<?php
	 }
   ?>
	
	
	 <!--cantidades_margen--> 
   <div id="cantidades_margen">


   </div>
   <!--cantidades_margen--> 
   
   
	<?php
	// Verificar Rango entre 10 % superior o inferior a los parametros contidad y precio
     ?>
	
	
	
	
	
   <?php
    if(sizeof($orden) == 0)
	 {
   ?>
 <div class="control-group" id="producto">
		<label class="control-label" for="usuario">Confirma Precio <strong style="color: red;">(*)</strong></label>
		<div class="controls">
			<input type="text" name="precio" placeholder="<?php echo $hoja->valor_empresa?>" value="<?php echo $hoja->valor_empresa?>" onkeypress="return soloNumeros(event)" onblur="ValidarPreciosDeAcuerdoRangoMargenCotizados('<?php echo $id?>');"/>
           <strong>Desde la H.C: </strong> $<?php echo number_format($hoja->valor_empresa,0,"",".")?>

		</div>
	</div>
	<?php
	 }else{
	?>	
       <div class="control-group" id="producto">
		<label class="control-label" for="usuario">Confirma Precio <strong style="color: red;">(*)</strong></label>
		<div class="controls">
			<input type="text" name="precio" placeholder="<?php echo $orden->precio?>" value="<?php echo $orden->precio?>" onblur="ValidarPreciosDeAcuerdoRangoMargenCotizados('<?php echo $id?>');"/>
           <strong>Desde la H.C: </strong> $<?php echo number_format($hoja->valor_empresa,0,"",".")?>
		   <strong>y O.C Confirma con: </strong> $<?php echo number_format($orden->precio,0,"",".")?>
		</div>
	</div>
	 
	<?php  
	 }
	?>
	
	
 <!--cantidades_margen--> 
   <div id="Confirma_precio">


   </div>
   <!--cantidades_margen--> 
	
	
	
    <div class="control-group">
		<label class="control-label" for="usuario">Cantidades solicitadas</label>
		<div class="controls">
                    <ul class="list-group">
                          <li class="list-group-item">Cantidad 1 :<?php echo number_format($datos->cantidad_1,0,'','.');?> <?php if(sizeof($hoja)==0){ echo "No se ha Registrado en Hoja de Costo";}else{echo "($".number_format($hoja->valor_empresa,0,'','.').")";}?></li>
                          <li class="list-group-item">Cantidad 2 :<?php echo number_format($datos->cantidad_2,0,'','.');?> <?php if(sizeof($hoja)==0){ echo "No se ha Registrado en Hoja de Costo";}else{echo "($".number_format($hoja->valor_empresa_2,0,'','.').")";}?></li>
                          <li class="list-group-item">Cantidad 3 :<?php echo number_format($datos->cantidad_3,0,'','.');?> <?php if(sizeof($hoja)==0){ echo "No se ha Registrado en Hoja de Costo";}else{echo "($".number_format($hoja->valor_empresa_3,0,'','.').")";}?></li>
                          <li class="list-group-item">Cantidad 4 :<?php if($datos->cantidad_4!=0){echo number_format($datos->cantidad_4,0,'','.');}else{echo 0;};?> <?php if(sizeof($hoja)==0){ echo "No se ha Registrado en Hoja de Costo";}else{echo "($".number_format($hoja->valor_empresa_4,0,'','.').")";}?></li>
                    </ul>
		</div>
	</div>
    
    
      <div class="control-group">
		<label class="control-label" for="usuario">Forma de Pago <strong style="color: red;">(*)</strong></label>
		<div class="controls">
			<select  id="forma_pago" name="forma_pago" style="width:400px">
                <option value="0">Seleccione.....</option>
                <?php
                foreach($formas as $forma)
                {
                    if (sizeof($orden)>0) {  ?>                
                    <option value="<?php echo $forma->id; ?>" <?php if($forma->id==$orden->id_forma_pago){echo 'selected="selected"';}?> <?php echo set_value_select(array(),'forma_pago','forma_pago',$forma->id);?>><?php echo '('.$forma->dias.' Dias ) '.$forma->forma_pago?></option>
                    <?php } else { ?>
                    <option value="<?php echo $forma->id; ?>" <?php if($forma->id==$cli->id_forma_pago){echo 'selected="selected"';}?> <?php echo set_value_select(array(),'forma_pago','forma_pago',$forma->id);?>><?php echo '('.$forma->dias.' Dias ) '.$forma->forma_pago?></option>
                    <?php }
                }                
                ?>                    
                
            </select>
            <?php echo '<strong>Desde la S.C: </strong>'.$datos->forma_pago?>
		</div>
	</div>
      <?php 
      $fecha = date('Y-m-j');
$nuevafecha = strtotime ( '+20 day' , strtotime ( $fecha ) ) ;
$nuevafecha = date ( 'Y-m-j' , $nuevafecha );
 
//echo $nuevafecha;
      ?>
    <div class="control-group" id="producto">
	<label class="control-label" for="usuario">Fecha Despacho Según Empresa<strong style="color: red;">(*)</strong></label>
		<div class="controls">
		<?php
	    if(sizeof($orden) >=1)
			{
		?>
                    <input type="date" name="fecha_despacho" value="<?php echo invertirFecha($nuevafecha);//$orden->fecha_despacho?>" />
		S.C (Creada):<?php echo $datos->fecha?>	- O.C:<?php echo $orden->fecha_despacho?>	
			
		<?php
		}else
		{
		?>
		<input type="date" name="fecha_despacho" value="<?php echo invertirFecha($nuevafecha);//$datos->fecha?>" />
		S.C (Creada):<?php echo $datos->fecha?>	
		
		<?php
			}
		?>
		</div>
	</div>
<div class="control-group">
		<label class="control-label" for="usuario">Fecha de Despacho Solicitada por Cliente<strong style="color: red;">(*)</strong></label>
		<div class="controls">
                    <input type="text" name="fecha_despacho_solicitada_cliente" class="datepicker" placeholder="Introduzca Fecha" value="<?php if($orden->fecha_despacho_solicitado_cliente!=""){$invert = explode("-",$orden->fecha_despacho_solicitado_cliente);
                    $fecha_invert = $invert[2]."-".$invert[1]."-".$invert[0];
                    echo $fecha_invert;}  ?>">
		</div>
        </div>    
     
    
     
      
      <div class="control-group">
		<label class="control-label" for="usuario">Despacho Fuera de Santiago</label>
		<div class="controls">
            <select name="forma_despacho">
                <?php if(sizeof($orden)){ ?>
                <option value="SI" <?php if($orden->forma_despacho=="SI"){echo 'selected="selected"';}?>>SI</option>
                <option value="NO" <?php if($orden->forma_despacho=="NO"){echo 'selected="selected"';}?>>NO</option>
                <?php }else{ ?>
                <option value="SI" <?php if($datos->despacho_fuera_de_santiago=="SI"){echo 'selected="selected"';}?>>SI</option>
                <option value="NO" <?php if($datos->despacho_fuera_de_santiago=="NO"){echo 'selected="selected"';}?>>NO</option>
                <?php } ?>
            </select>
            <?php //echo $datos->despacho_fuera_de_santiago?>
		</div>
	</div>
    <?php $cliente=$this->clientes_model->getClientePorId($datos->id_cliente); ?>    
    
    <div class="control-group">
		<label class="control-label" for="usuario">Total o Parcial</label>
		<div class="controls">
        <?php $totals=array("Total","Parcial","Despachos Semanales","Despachos Mensuales","Despachos Bimensuales","Despachos Trimestrales");?>
            <select name="total_o_parcial">
                <?php
                foreach($totals as $total)
                {
                    ?>
                    <option value="<?php echo $total?>" <?php if($datos->tota_o_parcial==$total){echo 'selected="selected"';}?>><?php echo $total?></option>
                    <?php
                }
                ?>
                
                
            </select>
            <?php echo $datos->tota_o_parcial?>
		</div>
	</div>
    <div class="control-group" id="producto">
		<label class="control-label" for="usuario">Horario Despacho</label>
		<div class="controls">
                    <?php 
                    if (sizeof($orden)>0) {  ?> 
			<input type="text" name="horario_despacho" placeholder="Horario Despacho" value="<?php echo $orden->horario_despacho;?>" />
                    <?php } else { ?>
			<input type="text" name="horario_despacho" placeholder="Horario Despacho" value="<?php echo $cliente->horario_despacho;?>" />
                    <?php }   ?>              
            <?php echo $cliente->horario_despacho?>
		</div>
	</div>
    
    <div class="control-group" id="producto">
		<label class="control-label" for="usuario">Cantidades (Sin es Parcial)</label>
		<div class="controls">
        <?php
        if(sizeof($orden)==0)
        {
            ?>
            	<input type="text" name="can_despacho_1" style="width: 100px;" id="can_despacho1" onkeypress="return soloNumeros(event)" onblur="formatear(this.value,this.id)" value="<?php echo $datos->can_despacho_1?>" /> - <input type="text" name="can_despacho_2" style="width: 100px;" id="can_despacho_2" onkeypress="return soloNumeros(event)" onblur="formatear(this.value,this.id)" value="<?php echo $datos->can_despacho_2?>" /> - <input type="text" name="can_despacho_3" style="width: 100px;" id="can_despacho_3" onkeypress="return soloNumeros(event)" onblur="formatear(this.value,this.id)" value="<?php echo $datos->can_despacho_3?>" />
            <?php
        }else
        {
            ?>
            	<input type="text" name="can_despacho_1" style="width: 100px;" id="can_despacho1" onkeypress="return soloNumeros(event)" onblur="formatear(this.value,this.id)" value="<?php echo $orden->cantidad_1?>" /> - <input type="text" name="can_despacho_2" style="width: 100px;" id="can_despacho_2" onkeypress="return soloNumeros(event)" onblur="formatear(this.value,this.id)" value="<?php echo $orden->cantidad_2?>" /> - <input type="text" name="can_despacho_3" style="width: 100px;" id="can_despacho_3" onkeypress="return soloNumeros(event)" onblur="formatear(this.value,this.id)" value="<?php echo $orden->cantidad_3?>" />
            <?php
        }
        ?>
		
	</div>
    </div>
   
 
    
    <div class="control-group">
		<label class="control-label" for="usuario">Forma de Facturar Distinta al Estándard</label>
		<div class="controls">
			<textarea id="contenido4" name="obs1" placeholder="Forma de Facturar Distinta al Estándard"><?php echo $orden->obs_facturar?></textarea>
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Condicones especiales para la cobranza</label>
		<div class="controls">
			<textarea id="contenido4" name="obs2" placeholder="Condicones especiales para la cobranza"><?php echo $orden->obs_condiciones_cobranza?></textarea>
		</div>
	</div>
   
    <div class="control-group">
		<label class="control-label" for="usuario">Nota especial aclaratoria</label>
		<div class="controls">
			<textarea id="contenido4" name="obs3" placeholder="Nota especial para aclaratoria de productos"><?php echo $orden->nota?></textarea>
		</div>
	</div>
    
    <div class="control-group" id="rechazo" style="display: none;"> 
		<label class="control-label" for="usuario">Por qué rechaza</label>
		<div class="controls">
			<textarea id="contenido4" name="glosa" placeholder="Observaciones"><?php echo getField("glosa",$datos,$ing) ?></textarea>
		</div>
	</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Desbloqueo de Orden</h5>
        <button id="close" type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <input type="password" id="password" title="password" name="pass" value="" placeholder="Indique el Password"/>
          <span id="mensajevalidacion" style="color:red;font-weight: bold"></span>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" onclick="desbloquear_orden(<?php echo $datos->id ?>);">Desbloquear</button>
      </div>
    </div>
  </div>
</div>
   
    <div class="control-group">
		<div class="form-actions">
            <input type="hidden" name="id" value="<?php echo $id?>" />
            <input type="hidden" name="pagina" value="<?php echo $pagina?>" />
            <input type="hidden" name="estado" />
			
			 <?php
				//Usuario 
				 if( $this->session->userdata('perfil')!=2)
					{
			?>
			
						<?php
						if(sizeof($cliente) >= 1 and $cliente->estado == 0 )
						{
							if($orden->estado == 1)
							{ ?>
            <strong id="mensajeorden">ORDEN DE COMPRA YA FUE LIBERADA &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><span id="candado" data-toggle="modal" data-target="#exampleModal" onnclick="desbloquear_orden(<?php echo $datos->id ?>);"><img width="20px" src="../../../public/frontend/images/padlock-lock-icon.png"></span>
                <!--<a href="<?php// echo base_url()?>cotizaciones/oc/<?php// echo $datos->id ?>"><img src="../../../public/frontend/images/ico-PDF.png"></a></strong>-->
							<?php }else{
						?>
						<input type="button" value="Guardar" class="btn <?php if($ing->estado==0){echo 'btn-warning';}?>" onclick="guardarFormularioAdd('0');" />
						<input type="button" value="Rechazar" class="btn <?php if($ing->estado==2){echo 'btn-warning';}?>" onclick="guardarFormularioAdd('2');" />
                                                <?php if ($orden->archivo!=""){ ?>   
                                                    <input type="button" value="Liberar" class="btn <?php if($ing->estado==1){echo 'btn-warning';}?>" onclick="guardarFormularioAdd('1');" />
                                                <?php  }else{ ?>                                                  
                                                    <input type="button" value="Liberar" class="btn <?php if($ing->estado==1){echo 'btn-warning';}?>" onclick="alert('No puede liberar hasta que incluya el archivo de orden de compra del cliente');" />
                                                <?php }
							}
						}else{
						?>
						<label for="usuario">1) Complete los <strong>datos</strong> del CLIENTE antes de emitir la O.C </label>	
						<label for="usuario">2) Verifique el estado de Cliente Como <strong>Activo</strong></label>	
						
						<ol class="breadcrumb">
						  <li><a href="<?php echo base_url()?>clientes/edit/<?php echo $datos->id_cliente?>/0"><strong>Ir a Cliente</strong></a></li>
						</ol>
						
						<?php
						//clientes/edit/6108/0
						//$datos->id_cliente
						echo '<script>ClienteFaltaDatos();</script>';
						}
						?>
		
			<?php
					}
			?>
		
		</div>
	</div>
    
</div>
<span class="ir-arriba icon-arrow-up">↑</span>
<script type="text/javascript">
    jQuery(document).ready
    (
        function ()
        {
            document.form.reset();
        document.form.cliente.focus();
        }
    );
    
	
$('.ir-arriba').click(function(){
		$('body, html').animate({
			scrollTop: '0px'
		}, 300);
	});
 
	$(window).scroll(function(){
//		if( $(this).scrollTop() > 0 ){
//			$('.ir-arriba').slideDown(300);
//		} else {
//			$('.ir-arriba').slideUp(300);
//		}
	});
        
	$('.ir-arriba2').click(function(){
		$('body, html').animate({
			scrollTop: '4700px'
		}, 300);
	});
 
	$(window).scroll(function(){
//		if( $(this).scrollTop() > 0 ){
//			$('.ir-arriba2').slideUp(300);
//		} else {
//			$('.ir-arriba2').slideDown(300);
//		}
	});
        

</script>


<style type="text/css">
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
<?php $this->layout->element('admin_mensaje_validacion'); ?>
<?php         
$usuario=$this->usuarios_model->getUsuariosPorId($ing->quien);
 ?>
<div id="contenidos">
<span class="ir-arriba2 icon-arrow-up">↓</span>
<?php echo form_open(null, array('class' => 'form-horizontal','name'=>'form','id'=>'form')); ?>
<!-- Migas -->
    <ol  class= "breadcrumb" >  
      <li><a href="<?php echo base_url()?>cotizaciones/index/<?php echo $pagina?>">Cotizaciones &gt;&gt;</a></li>
      <li><a href="<?php echo base_url()?>cotizaciones/search_cot/<?php echo $id?>">Volver&gt;&gt;</a></li>
      <li>Emisión Orden de Producción</li>
    </ol>
   <!-- /Migas -->
	<div class="page-header"><h3>Emisión Orden de Producción ( Cotización N° <?php echo $id?> )</h3></div>
            <?php if (sizeof($orden)>0) { ?>
                <?php if($orden->estado==1){ ?>        
                <div style="background-color: #ec5c00; color:white; width: 100%;">&nbsp;&nbsp;Emisión Orden de Producción ya fue liberada en la fecha: <?php echo $orden->fecha; ?> por <?php echo $usuario->nombre;?></div>
                <?php } elseif($orden->estado==0){ ?>        
                <div style="background-color: #00d6ec; color:white; width: 100%;">&nbsp;&nbsp;Emisión Orden de Producción ya fue Guardada en la fecha: <?php echo $orden->fecha; ?> por <?php echo $usuario->nombre;?></div>
                <?php } ?>              
            <?php } ?> 
            <?php if($datos->ot_antigua!=""){ ?>        
            <div style="background-color: red; color:white; width: 100%;">&nbsp;&nbsp;Orden Migrada de Sistema Viejo: <?php echo $orden->fecha?>...</div>
            <?php } ?>  
	 <p>
         <ul>
             <?php // echo print_r($datos); ?>
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
            <?php if($ordenDeCompra->nota!=""){echo "<li>Nota Aclaratoria: <b>$ordenDeCompra->nota</b></li>";}?>
            <?php if($ordenDeCompra->nota!=""){echo "<li>Nota Aclaratoria: <b>$ordenDeCompra->nota</b></li>";}?>
            <?php
            if($orden->estado=='1')
            {
                ?>
                <li>Fué enviado un mail a <strong><?php echo $vendedor->nombre?></strong> con fecha <strong><?php echo fecha($orden->fecha)?></strong></li>
                <?php
            }
            ?>
        </ul>
    </p>
    
     <?php
     if(sizeof($orden)==0)
     {
        ?>
        <?php
     }else
     {
        ?>
        
        <div class="control-group">
    		<label class="control-label" for="id_antiguo">Imprimir PDF de Orden de Producción</label>
    		<div class="controls">
            <?php if(($ordenDeCompra->id!="") &&  ($ordenDeCompra->id_cotizacion!="")) {?>
                <a href="<?php echo base_url().'ordenes/pdf_orden/'.$ordenDeCompra->id_cotizacion.'/'.$ordenDeCompra->id; ?>" target="_blank" title="Ver"><i class="icon-search"></i></a>
            <?php } else {  ?>
            	No Existe Archivo de Orden de Compra
            <?php }   ?>                      
            </div>
	    </div> 
       
        <?php
     }
     ?>
     <?php
     if(sizeof($ordenDeCompra)>=1)
     {
        ?>
        <div class="control-group">
		<label class="control-label" for="id_antiguo">Archivo de Orden de Compra</label>
		<div class="controls">
            <?php if(!empty($ordenDeCompra->archivo)) { ?>
            <a href="<?php echo base_url().$this->config->item('direccion_pdf').$ordenDeCompra->archivo ?>" target="_blank" title="Ver"><i class="icon-search"></i></a>
            <?php } else {  ?>
            	<a href='#'>No Existe Archivo de Orden de Compra</a>´
            <?php }   ?>                     
		</div>
	</div> 
        <?php
     }else
     {
        ?>
       <hr />
       <strong>NO HA SIDO CREADA AUN LA ORDEN DE COMPRA</strong>
       <hr />
        <?php
     }
     ?>
      
     <?php
     $producto_existe="";
     if(sizeof($orden)==0)
     {
        ?>
        <div class="control-group">
            <label class="control-label" for="usuario">Producto</label>
            <div class="controls">
            <?php
            if ($datos->producto_id==0)
            {
                $producto_existe=$this->productos_model->getProductoporCodigoMigracion($datos->id_cliente.'A'.$codigoNuevo);
//                print_r($datos);
                if(sizeof($producto_existe)>0)
                {             
                    if(sizeof($existeProducto)>0 && sizeof($existeProducto2)>0)
                    { 
                    ?>
                        <strong>Producto con Descripción Similar ya Existe: <ins><?php echo $ing->producto?></ins> con el código <ins><?php echo $existeProducto->codigo ?></ins></strong>
                    <?php
                    }
                } 
                else 
                {
                ?>
                        <strong>Se va a crear el producto : <ins><?php echo $ing->producto?></ins> con el código <ins><?php echo $datos->id_cliente.'A'.$codigoNuevo ?></ins></strong>
                <?php 
                } 
            }
            else 
            { 
                $producto_existe=$this->productos_model->getProductosPorId($datos->producto_id);                
                //$producto_existe=$this->productos_model->getProductosPorId($existeProducto->id);                
                ?>
                        <strong>Código Producto: <ins><a href="<?php echo base_url();?>productos/edit/<?php echo $producto_existe->id?>"><?php echo $producto_existe->codigo ?></a></ins></br> Creado en Cotización Nro: <ins><a href="<?php echo base_url();?>cotizaciones/revision_ingenieria/<?php echo $producto_existe->id_cotizacion?>"/><?php echo $producto_existe->id_cotizacion?></a></ins></strong>

            <?php
            }
            ?>
            </div>
	</div>
        <?php
     }else
     {
        ?>
        <div class="control-group">
		<label class="control-label" for="usuario">Producto Generado en Base de Datos</label>
		<div class="controls">
		
            <select name="producto_id" style="width: 600px;" class="chosen-select">
                <?php 
                foreach($productos as $producto)
                {
                    if(sizeof($orden)==0)
                    {
                        if($datos->producto_id==0)
                        {
                            $selected='';
                        }else
                        {
                            if($producto->id==$datos->producto_id)
                            {
                                $selected='selected="true"';
                            }else
                            {
                                $selected='';
                            }
                        }
                    }else
                    {
                        if($producto->id==$orden->producto_id)
                            {
                                $selected='selected="true"';
                            }else
                            {
                                $selected='';
                            }
                    }
                    ?>
                    <option value="<?php echo $producto->id?>" <?php echo $selected?>><?php echo $producto->nombre?></option>
                    <?php
                }
                ?>
            </select>
		</div>
	</div>
        <?php
     }
     ?>
        <div class="control-group">
		<label class="control-label" for="usuario">Archivo OC</label>
                <div class="controls">
<strong>Generar Archivo Ordenes de Compra&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url()?>cotizaciones/oc/<?php echo $datos->id ?>"><img src="../../../public/frontend/images/ico-PDF.png"></a></strong>
                </div>                    
        </div>
     <?php 
     $orden_compra_piezas=$this->piezas_adicionales_model->getPiezasAdicionalesOrdenCompraPorProveedores($datos->id,1);
        $orden_compra_piezas2=$this->piezas_adicionales_model->getPiezasAdicionalesOrdenCompraPorProveedores($datos->id,2);
            $orden_compra_piezas3=$this->piezas_adicionales_model->getPiezasAdicionalesOrdenCompraPorProveedores($datos->id,3);
      ?>
     <?php if ($datos->piezas_adicionales) { // si tiene piezas muestralo el formulario ?>    
	<div class="page-header"><h3>Piezas Adicionales</h3></div>       

    <div class="control-group">
		<label class="control-label" for="usuario">Piezas Adicionales</label>
		<div class="controls">
		<select name="piezas_adicionales1" class="chosen-select"  disabled="true">
                <option value="0">No lleva.....</option>
                 <?php
                $piezas=$this->cotizaciones_model->getPiezasAdicionales();
                foreach($piezas as $pieza)
                {
                    ?>
                    <option value="<?php echo $pieza->piezas_adicionales?>" <?php if($pieza->piezas_adicionales==$datos->piezas_adicionales){echo 'selected="true"';}?>><?php echo $pieza->piezas_adicionales?></option>
                    <?php
                }
                ?>
                </select>
                Proveedor:
                <?php
                    $arreglo_piezas_registrada1=$this->piezas_adicionales_model->getPiezasAdicionalesPorLive2($datos->piezas_adicionales);
                ?>                  
		<select name="proveedor1" class="chosen-select">
                <?php
                foreach($proveedores as $proveedor)
                { ?>
                    <option value="<?php echo $proveedor->id?>" <?php if($arreglo_piezas_registrada1->id_proveedor1==$proveedor->id){echo 'selected="selected"';}?>><?php echo $proveedor->nombre?></option>
                    <?php
                }
                ?>
                </select>                      
                <strong>Cantidad:</strong> 
		<input  readonly="true"  style="width: 35px;" type="text" id="titulo" name="cantidad1" value="<?php echo $datos->cantidad_1; ?>" placeholder="0" > 		
                <strong>Precio:</strong>    
                <?php $precio1=$this->piezas_adicionales_model->getPiezasAdicionalesPorLive($datos->piezas_adicionales); ?>
		<input style="width: 60px;" readonly="true"  type="text" id="titulo" name="precio_referencia_1" value="<?php echo $orden_compra_piezas->valor_compra; ?>" placeholder="0">
		<input style="width: 60px;" type="text" id="precio1" name="precio1" value="<?php if ($orden_compra_piezas->valor_compra!='') echo $orden_compra_piezas->valor_compra; else echo $orden_compra_piezas->valor_compra; ?>" placeholder="0">		
                </div>
	</div>
    
	 <div class="control-group">
		<label class="control-label" for="usuario">Piezas Adicionales 2</label>
		<div class="controls">
                    <select name="piezas_adicionales2" class="chosen-select" disabled="true">
                <option value="0">No lleva.....</option>
                <?php
                $piezas=$this->cotizaciones_model->getPiezasAdicionales();
                foreach($piezas as $pieza)
                {
                    ?>
                    <option value="<?php echo $pieza->piezas_adicionales?>" <?php if($pieza->piezas_adicionales==$datos->piezas_adicionales2){echo 'selected="selected"';}?>><?php echo $pieza->piezas_adicionales?></option>
                    <?php
                }
                ?>
                </select>
                Proveedor:
                <?php
                    $arreglo_piezas_registrada2=$this->piezas_adicionales_model->getPiezasAdicionalesPorLive2($datos->piezas_adicionales2);
                ?>                 
		<select name="proveedor2" class="chosen-select">
                <?php
                foreach($proveedores as $proveedor)
                { ?>
                    <option value="<?php echo $proveedor->id?>" <?php if($arreglo_piezas_registrada2->id_proveedor1==$proveedor->id){echo 'selected="selected"';}?>><?php echo $proveedor->nombre?></option>
                    <?php
                }
                ?>
                </select>                   
                <strong>Cantidad:</strong> 
		<input readonly="true"  style="width: 35px;" type="text" id="titulo" name="cantidad2" value="<?php echo $datos->cantidad_1; ?>" placeholder="0" > 		
                <strong>Precio:</strong>    
                <?php $precio2=$this->piezas_adicionales_model->getPiezasAdicionalesPorLive($datos->piezas_adicionales2); ?>
		<input style="width: 60px;" readonly="true"   type="text" id="titulo" name="precio_referencia_2" value="<?php echo $orden_compra_piezas2->valor_compra; ?>" placeholder="0">
		<input style="width: 60px;" type="text" id="precio2" name="precio2" value="<?php if ($orden_compra_piezas2->valor_compra!='') echo $orden_compra_piezas2->valor_compra; else echo $orden_compra_piezas2->valor_compra; ?>" placeholder="0">
 		</div>
	</div>
	
		<div class="control-group">
		<label class="control-label" for="usuario">Piezas Adicionales 3</label>
		<div class="controls">
                <select name="piezas_adicionales3" class="chosen-select"  disabled="true">
                <option value="0">No lleva.....</option>
                <?php
                $piezas=$this->cotizaciones_model->getPiezasAdicionales();
                foreach($piezas as $pieza)
                {
                    ?>
                    <option value="<?php echo $pieza->piezas_adicionales?>" <?php if($pieza->piezas_adicionales==$datos->piezas_adicionales3){echo 'selected="true"';}?>><?php echo $pieza->piezas_adicionales?></option>
                    <?php
                }
                ?>
                    ?>
                </select>
                Proveedor:
                <?php
                    $arreglo_piezas_registrada3=$this->piezas_adicionales_model->getPiezasAdicionalesPorLive2($datos->piezas_adicionales3);
                ?>
		<select name="proveedor3" class="chosen-select">
                <?php
                foreach($proveedores as $proveedor)
                { ?>
                    <option value="<?php echo $proveedor->id?>" <?php if($arreglo_piezas_registrada3->id_proveedor1==$proveedor->id){echo 'selected="true"';}?>><?php echo $proveedor->nombre?></option>
                    <?php
                }
                ?>
                </select>                      
                <strong>Cantidad:</strong> 
                <input readonly="true" style="width: 35px;" type="text" id="titulo" name="cantidad3" value="<?php echo $datos->cantidad_1; ?>" placeholder="0" > 		
                <strong>Precio:</strong>    
                <?php $precio3=$this->piezas_adicionales_model->getPiezasAdicionalesPorLive($datos->piezas_adicionales3); ?>
		<input style="width: 60px;" readonly="true"  type="text" id="titulo" name="precio_referencia_3" value="<?php echo $orden_compra_piezas3->valor_compra; ?>" placeholder="0">
		<input style="width: 60px;" type="text" id="precio3" name="precio3" value="<?php if ($orden_compra_piezas3->valor_compra!='') echo $orden_compra_piezas3->valor_compra; else echo $orden_compra_piezas3->valor_compra; ?>" placeholder="0">                
 		<input type="hidden" id="id_registro" name="id_registro" value="<?php echo $datos->id; ?>" placeholder="0">

		</div>
	</div>       
	<div class="control-group">
		<label class="control-label" for="usuario">Empresas que envia Orden:</label>
		<div class="controls">
                <select name="empresa" class="chosen-select">
                <option value="0">Seleccione.....</option>
                <?php
                $clientes_fastrack=$this->clientes_model->getClientesNormalFast();
                foreach($clientes_fastrack as $clientes)
                {
                    ?>
                    <option value="<?php echo $clientes->id?>" <?php if($clientes->id==$orden_compra_piezas->empresa){echo 'selected="true"';}?>><?php echo $clientes->razon_social?></option>
                    <?php
                }
                ?>
                    ?>
                </select>   
                    Quien la Emite
		<select name="envia" id="envia">
                <?php
                foreach($usuarios as $usuario2)
                {
                    ?>
                    <option value="<?php echo $usuario2->id?>" <?php if($orden_compra_piezas->envia==$usuario2->id){echo 'selected="true"';}?>><?php echo $usuario2->nombre?></option>
                    <?php
                }
                ?>  
                </select>                      
                    Quien la Recibe
		<select name="recibe" id="recibe">
                <?php
                foreach($usuarios as $usuario2)
                {
                    ?>
                    <option value="<?php echo $usuario2->id?>" <?php if($orden_compra_piezas->recibe==$usuario2->id){echo 'selected="true"';}?>><?php echo $usuario2->nombre?></option>
                    <?php
                }
                ?>       
                </select>                      
		</div>
	</div>                       
        
        
        <div class="control-group">
		<label class="control-label" for="id_antiguo">Tipo de Despacho</label>
		<div class="controls">
		<select name="tipo_despacho" id="tipo_despacho">
                    <option value="1" <?php if($orden_compra_piezas->tipo_despacho==1){echo 'selected="true"';}?>>Proveedor entrega en Nuestras Bodegas</option>                    
                    <option value="2" <?php if($orden_compra_piezas->tipo_despacho==2){echo 'selected="true"';}?>>Nosotros Retiramos</option>                    
                    <option value="3" <?php if($orden_compra_piezas->tipo_despacho==3){echo 'selected="true"';}?>>Proveedor Envia por Tercero por cuenta de él</option>                    
                    <option value="4" <?php if($orden_compra_piezas->tipo_despacho==4){echo 'selected="true"';}?>>Proveedor Envia por Tercero por cuenta Nuestra</option>                    
                </select>  
                    Sección:                    
		<select name="tipo_seccion" id="tipo_seccion">
                    <option value="1" <?php if($orden_compra_piezas->tipo_seccion==1){echo 'selected="true"';}?>>Mantención</option>                    
                    <option value="2" <?php if($orden_compra_piezas->tipo_seccion==2){echo 'selected="true"';}?>>Administración</option>                    
                    <option value="3" <?php if($orden_compra_piezas->tipo_seccion==3){echo 'selected="true"';}?>>Imprenta</option>                    
                    <option value="4" <?php if($orden_compra_piezas->tipo_seccion==4){echo 'selected="true"';}?>>Troquelado</option>                    
                    <option value="5" <?php if($orden_compra_piezas->tipo_seccion==5){echo 'selected="true"';}?>>Pegado</option>                    
                    <option value="6" <?php if($orden_compra_piezas->tipo_seccion==6){echo 'selected="true"';}?>>Corrugado</option>                    
                    <option value="7" <?php if($orden_compra_piezas->tipo_seccion==7){echo 'selected="true"';}?>>Otros</option>                          
                </select>                        
                </div>
	</div>          
        
        <div class="control-group">
		<label class="control-label" for="id_antiguo">Guardar Orden de Compra de Piezas Adicionales</label>
		<div class="controls">
        	<input type="button" value="Imprimir Orden de Compra de Piezas" class="btn <?php if($orden->estado==2){echo 'btn-warning';}?>" onclick="guardarOrdenCompraPiezas();" />
		</div>
	</div>         
	<div class="page-header"></div>          
     
     <?php } // si tiene piezas muestralo el formulario?>
    <input type="hidden" id="ncd" name="ncd" value="<?php echo $id; ?>" />
    <div class="control-group">
		<label class="control-label" for="usuario">Nombre Producto</label>
		<div class="controls">
			<input type="text" style="width: 600px;" id="titulo" name="nombre_producto_normal" value="<?php echo $ing->producto?>" placeholder="nombre_producto" <?php if($datos->condicion_del_producto=='Repetición Con Cambios'){echo '';}else{echo '';}?> /> <strong>(<?php echo $datos->condicion_del_producto?>)</strong>
		</div>
	</div>
    <div class="control-group">
		<label class="control-label" for="usuario">Nombre Producto Cliente</label>
		<div class="controls">
			<input type="text" style="width: 600px;" id="titulo" name="nombre_producto_cliente" value="<?php echo $ordenDeCompra->nombre_producto_cliente?>" placeholder="nombre_producto" <?php if($datos->condicion_del_producto=='Repetición Con Cambios'){echo '';}else{echo '';}?> />
		</div>
	</div>
        <div class="control-group">
		<label class="control-label" for="usuario">Observaciones</label>
		<div class="controls">
			<input type="text" style="width: 600px;" id="titulo" name="observaciones" value="<?php echo $_POST['observaciones'] ?>" placeholder="Observaciones"/>
		</div>
	</div>
	
    <div class="control-group">
		<label class="control-label" for="usuario">Cantidad Pedida</label>
		<div class="controls">
			<?php 
            if(sizeof($orden)!=0)
            {
		$cantidad_1=$ordenDeCompra->cantidad_de_cajas;
            }else
            {
                if(sizeof($ordenDeCompra)>0){
                $cantidad_1=$ordenDeCompra->cantidad_de_cajas;
                }else{
                $cantidad_1=$datos->cantidad_1;    
                }
            }
            ?>
            <input type="text" id="titulo" name="cantidad_pedida" value="<?php echo $cantidad_1?>" placeholder="Cantidad Pedida"  onkeypress="return soloNumeros(event)" /> 
		</div>
	</div>    
        <!--cantidades_margen--> 
   <div id="cantidades_margen">


   </div>
   <!--cantidades_margen--> 
     
    <div class="control-group">
		<label class="control-label" for="usuario">Valor</label>
		<div class="controls">
			<input type="text" id="titulo" name="valor" value="<?php echo $ordenDeCompra->precio ?>" readonly="true" onkeypress="return soloNumeros(event)"  />
		</div>
	</div>
   
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
                  <li class="list-group-item">Cantidad 4 :<?php if($datos->cantidad_4==0 || $datos->cantidad_4==""){echo "0";}else{ echo number_format($datos->cantidad_4,0,'','.');}?> <?php if(sizeof($hoja)==0){ echo "No se ha Registrado en Hoja de Costo";}else{echo "($".number_format($hoja->valor_empresa_4,0,'','.').")";}?></li>
              </ul>
		</div>
	</div>
    
   <div>    
     
     <?php include('parcialTrabajosEspecialesOrdenes.php'); ?>
<style type="text/css">
    .tabledark .titulocuadro{
        color:#ffffff;
        font-weight: bold;
        background-color: #006699;
    }
    .tabledark{
        width: 960px;
    }
    .tabledark tr td{
        padding: 4px;
        border: 1px solid #cccccc;
    }
</style>
<div class="control-group">
<h3>Seleccion de Proveedores Trabajos Externos y Trabajos Especiales</h3>
<table class="tabledark">
    <tr class="titulocuadro">
        <td>Trabajo</td>
        <td>Cantidad</td>
        <td>Precio</td>
        <td>Proveedor 1</td>
        <td>Proveedor 2</td>
    </tr>
    
    <?php $datoscantidad1 = $datos->cantidad_1; ?>
    <?php $uno=$this->cotizaciones_model->getOrdenesProveedoresPorNombre('uno',$datos->id); ?>
    <?php $dos=$this->cotizaciones_model->getOrdenesProveedoresPorNombre('dos',$datos->id); ?>
    <?php $tres=$this->cotizaciones_model->getOrdenesProveedoresPorNombre('tres',$datos->id); ?>
    <?php $pfolia1=$this->cotizaciones_model->getOrdenesProveedoresPorNombre('folia1',$datos->id); ?>
    <?php $pfolia2=$this->cotizaciones_model->getOrdenesProveedoresPorNombre('folia2',$datos->id); ?>
    <?php $pfolia3=$this->cotizaciones_model->getOrdenesProveedoresPorNombre('folia3',$datos->id); ?>
    <?php $pcffolia1=$this->cotizaciones_model->getOrdenesProveedoresPorNombre('cffolia1',$datos->id); ?>
    <?php $pcffolia2=$this->cotizaciones_model->getOrdenesProveedoresPorNombre('cffolia2',$datos->id); ?>
    <?php $pcffolia3=$this->cotizaciones_model->getOrdenesProveedoresPorNombre('cffolia3',$datos->id); ?>
    <?php $pcuno1=$this->cotizaciones_model->getOrdenesProveedoresPorNombre('cuno1',$datos->id); ?>
    <?php $pcuno2=$this->cotizaciones_model->getOrdenesProveedoresPorNombre('cuno2',$datos->id); ?>
    <?php $pcfcuno1=$this->cotizaciones_model->getOrdenesProveedoresPorNombre('cfcuno1',$datos->id); ?>
    <?php $pcfcuno2=$this->cotizaciones_model->getOrdenesProveedoresPorNombre('cfcuno2',$datos->id); ?>
    
    <?php if($acabado_4!=""){ ?>
    <tr>
        <td><?php echo $acabado_4;  ?></td>
        <td><?php echo $datoscantidad1;  ?></td>
        <td><?php echo $acabado_4Array->costo_compra;  ?></td>
        <td><input type="radio" name="uno" <?php if($uno->proveedor==$acabado_4Array->nombre_proveedor1){echo "checked";} ?> value="<?php echo $acabado_4Array->nombre_proveedor1;  ?>"><?php echo $acabado_4Array->nombre_proveedor1;  ?></td>
        <td><input type="radio" name="uno" <?php if($uno->proveedor==$acabado_4Array->nombre_proveedor2){echo "checked";} ?> value="<?php echo $acabado_4Array->nombre_proveedor2;  ?>"><?php echo $acabado_4Array->nombre_proveedor2;  ?></td>
    </tr>
    <?php }  ?>
    <?php if($acabado_5!=""){ ?>
    <tr>
        <td><?php echo $acabado_5;  ?></td>
        <td><?php echo $datoscantidad1;  ?></td>
        <td><?php echo $acabado_5Array->costo_compra;  ?></td>
        <td><input type="radio" name="dos"  <?php if($dos->proveedor==$acabado_5Array->nombre_proveedor1){echo "checked";} ?> value="<?php echo $acabado_5Array->nombre_proveedor1;  ?>"><?php echo $acabado_5Array->nombre_proveedor1;  ?></td>
        <td><input type="radio" name="dos"  <?php if($dos->proveedor==$acabado_5Array->nombre_proveedor2){echo "checked";} ?> value="<?php echo $acabado_5Array->nombre_proveedor2;  ?>"><?php echo $acabado_5Array->nombre_proveedor2;  ?></td>
    </tr>
    <?php }  ?>
    <?php if($acabado_6!=""){ ?>
    <tr>
        <td><?php echo $acabado_6;  ?></td>
        <td><?php echo $datoscantidad1;  ?></td>
        <td><?php echo $acabado_6Array->costo_compra;  ?></td>
        <td><input type="radio" name="tres"  <?php if($tres->proveedor==$acabado_6Array->nombre_proveedor1){echo "checked";} ?>  value="<?php echo $acabado_6Array->nombre_proveedor1;  ?>"><?php echo $acabado_6Array->nombre_proveedor1;  ?></td>
        <td><input type="radio" name="tres"  <?php if($tres->proveedor==$acabado_6Array->nombre_proveedor2){echo "checked";} ?>  value="<?php echo $acabado_6Array->nombre_proveedor2;  ?>"><?php echo $acabado_6Array->nombre_proveedor2;  ?></td>
    </tr>
    <?php }  ?>
    <?php if(sizeof($folia1)>0){ ?>
    <tr>
        <td><?php echo $folia1->caracteristicas;  ?></td>
        <td><?php echo $datoscantidad1;  ?></td>
        <td><?php echo $folia1->costo_compra;  ?></td>
        <td><input type="radio" name="folia1" <?php if($pfolia1->proveedor==$folia1->proveedor_nombre_1){echo "checked";} ?>  value="<?php echo $folia1->proveedor_nombre_1;  ?>"><?php echo $folia1->proveedor_nombre_1;  ?></td>
        <td><input type="radio" name="folia1" <?php if($pfolia1->proveedor==$folia1->proveedor_nombre_2){echo "checked";} ?> value="<?php echo $folia1->proveedor_nombre_2;  ?>"><?php echo $folia1->proveedor_nombre_2;  ?></td>
    </tr>
    <?php }  ?>
    <?php if(sizeof($cffolia1)>0){ ?>
    <tr>
        <td><?php echo $cffolia1->caracteristicas;  ?></td>
        <td><?php echo $datoscantidad1;  ?></td>
        <td><?php echo $cffolia1->costo_compra;  ?></td>
        <td><input type="radio" name="cffolia1" <?php if($pcffolia1->proveedor==$cffolia1->proveedor_nombre_1){echo "checked";} ?> value="<?php echo $cffolia1->proveedor_nombre_1;  ?>"><?php echo $cffolia1->proveedor_nombre_1;  ?></td>
        <td><input type="radio" name="cffolia1" <?php if($pcffolia1->proveedor==$cffolia1->proveedor_nombre_2){echo "checked";} ?> value="<?php echo $cffolia1->proveedor_nombre_2;  ?>"><?php echo $cffolia1->proveedor_nombre_2;  ?></td>
    </tr>
    <?php }  ?>
    <?php if(sizeof($folia2)>0){ ?>
    <tr>
        <td><?php echo $folia2->caracteristicas;  ?></td>
        <td><?php echo $datoscantidad1;  ?></td>
        <td><?php echo $folia2->costo_compra;  ?></td>
        <td><input type="radio" name="folia2" <?php if($pfolia2->proveedor==$folia2->proveedor_nombre_1){echo "checked";} ?> value="<?php echo $folia2->proveedor_nombre_1;  ?>"><?php echo $folia2->proveedor_nombre_1;  ?></td>
        <td><input type="radio" name="folia2" <?php if($pfolia2->proveedor==$folia2->proveedor_nombre_2){echo "checked";} ?> value="<?php echo $folia2->proveedor_nombre_2;  ?>"><?php echo $folia2->proveedor_nombre_2;  ?></td>
    </tr>
    <?php }  ?>
    <?php if(sizeof($cffolia2)>0){ ?>
    <tr>
        <td><?php echo $cffolia2->caracteristicas;  ?></td>
        <td><?php echo $datoscantidad1;  ?></td>
        <td><?php echo $cffolia2->costo_compra;  ?></td>
        <td><input type="radio" name="cffolia2" <?php if($pcffolia2->proveedor==$cffolia2->proveedor_nombre_1){echo "checked";} ?> value="<?php echo $cffolia2->proveedor_nombre_1;  ?>"><?php echo $cffolia2->proveedor_nombre_1;  ?></td>
        <td><input type="radio" name="cffolia2" <?php if($pcffolia2->proveedor==$cffolia2->proveedor_nombre_2){echo "checked";} ?> value="<?php echo $cffolia2->proveedor_nombre_2;  ?>"><?php echo $cffolia2->proveedor_nombre_2;  ?></td>
    </tr>
    <?php }  ?>
    <?php if(sizeof($folia3)>0){ ?>
    <tr>
        <td><?php echo $folia3->caracteristicas;  ?></td>
        <td><?php echo $datoscantidad1;  ?></td>
        <td><?php echo $folia3->costo_compra;  ?></td>
        <td><input type="radio" name="folia3" <?php if($pfolia3->proveedor==$folia3->proveedor_nombre_1){echo "checked";} ?> value="<?php echo $folia3->proveedor_nombre_1;  ?>"><?php echo $folia3->proveedor_nombre_1;  ?></td>
        <td><input type="radio" name="folia3" <?php if($pfolia3->proveedor==$folia3->proveedor_nombre_2){echo "checked";} ?> value="<?php echo $folia3->proveedor_nombre_2;  ?>"><?php echo $folia3->proveedor_nombre_2;  ?></td>
    </tr>
    <?php }  ?>
    <?php if(sizeof($cffolia3)>0){ ?>
    <tr>
        <td><?php echo $cffolia3->caracteristicas;  ?></td>
        <td><?php echo $datoscantidad1;  ?></td>
        <td><?php echo $cffolia3->costo_compra;  ?></td>
        <td><input type="radio" name="cffolia3" <?php if($pcffolia3->proveedor==$folia3->proveedor_nombre_1){echo "checked";} ?> value="<?php echo $cffolia3->proveedor_nombre_1;  ?>"><?php echo $cffolia3->proveedor_nombre_1;  ?></td>
        <td><input type="radio" name="cffolia3" <?php if($pcffolia3->proveedor==$folia3->proveedor_nombre_2){echo "checked";} ?> value="<?php echo $cffolia3->proveedor_nombre_2;  ?>"><?php echo $cffolia3->proveedor_nombre_2;  ?></td>
    </tr>
    <?php }  ?>
    <?php if(sizeof($cuno1)>0){ ?>
    <tr>
        <td><?php echo $cuno1->caracteristicas;  ?></td>
        <td><?php echo $datoscantidad1;  ?></td>
        <td><?php echo $cuno1->costo_compra;  ?></td>
        <td><input type="radio" name="cuno1" <?php if($pcuno1->proveedor==$cuno1->proveedor_nombre_1){echo "checked";} ?> value="<?php echo $cuno1->proveedor_nombre_1;  ?>"><?php echo $cuno1->proveedor_nombre_1;  ?></td>
        <td><input type="radio" name="cuno1" <?php if($pcuno1->proveedor==$cuno1->proveedor_nombre_2){echo "checked";} ?> value="<?php echo $cuno1->proveedor_nombre_2;  ?>"><?php echo $cuno1->proveedor_nombre_2;  ?></td>
    </tr>
    <?php }  ?>
    <?php if(sizeof($cfcuno1)>0){ ?>
    <tr>
        <td><?php echo $cfcuno1->caracteristicas;  ?></td>
        <td><?php echo $datoscantidad1;  ?></td>
        <td><?php echo $cfcuno1->costo_compra;  ?></td>
        <td><input type="radio" name="cfcuno1" <?php if($pcfcuno1->proveedor==$cfcuno1->proveedor_nombre_1){echo "checked";} ?> value="<?php echo $cfcuno1->proveedor_nombre_1;  ?>"><?php echo $cfcuno1->proveedor_nombre_1;  ?></td>
        <td><input type="radio" name="cfcuno1" <?php if($pcfcuno1->proveedor==$cfcuno1->proveedor_nombre_2){echo "checked";} ?> value="<?php echo $cfcuno1->proveedor_nombre_2;  ?>"><?php echo $cfcuno1->proveedor_nombre_2;  ?></td>
    </tr>
    <?php }  ?>
    <?php if(sizeof($cuno2)>0){ ?>
    <tr>
        <td><?php echo $cuno2->caracteristicas;  ?></td>
        <td><?php echo $datoscantidad1;  ?></td>
        <td><?php echo $cuno2->costo_compra;  ?></td>
        <td><input type="radio" name="cuno2" <?php if($pfolia2->proveedor==$folia2->proveedor_nombre_1){echo "checked";} ?> value="<?php echo $cuno2->proveedor_nombre_1;  ?>"><?php echo $cuno2->proveedor_nombre_1;  ?></td>
        <td><input type="radio" name="cuno2" <?php if($pfolia2->proveedor==$folia2->proveedor_nombre_2){echo "checked";} ?> value="<?php echo $cuno2->proveedor_nombre_2;  ?>"><?php echo $cuno2->proveedor_nombre_2;  ?></td>
    </tr>
    <?php }  ?>
    <?php if(sizeof($cfcuno2)>0){ ?>
    <tr>
        <td><?php echo $cfcuno2->caracteristicas;  ?></td>
        <td><?php echo $datoscantidad1;  ?></td>
        <td><?php echo $cfcuno2->costo_compra;  ?></td>
        <td><input type="radio" name="cfcuno2" <?php if($pcfcuno2->proveedor==$cfcuno2->proveedor_nombre_1){echo "checked";} ?> value="<?php echo $cfcuno2->proveedor_nombre_1;  ?>"><?php echo $cfcuno2->proveedor_nombre_1;  ?></td>
        <td><input type="radio" name="cfcuno2" <?php if($pcfcuno2->proveedor==$cfcuno2->proveedor_nombre_2){echo "checked";} ?> value="<?php echo $cfcuno2->proveedor_nombre_2;  ?>"><?php echo $cfcuno2->proveedor_nombre_2;  ?></td>
    </tr>
    <?php }  ?>
</table>
</div>
<!--**********************fin codigo nuevo-->
 <br />
 <br />
 <br />
 
    <?php //echo "<h1>" . $fotomecanica->estan_los_moldes . "</h1>";
    //echo "<h1>" . $fotomecanica->hay_que_troquelar . "</h1>";
   switch($fotomecanica->estan_los_moldes)
   {
        case 'SI':
            ?>
            <div class="control-group">
        		<label class="control-label" for="usuario">  </label>
        		<div class="controls">
                <hr />
                    <ul>
                        <li><strong>MOLDE ANTIGUO</strong></li>
                        <li>Sólo se puede modificar molde, entre los ya existentes.</li>
                    </ul>
                <hr />
                </div>
            </div>
            <?php
        break; 
        case 'NO':
            ?>
            <div class="control-group">
        		<label class="control-label" for="usuario">  </label>
        		<div class="controls">
                <hr />
                <ul><?php if($fotomecanica->hay_que_troquelar=="NO"){ ?>
                        <li><strong>NO LLEVA MOLDE</strong></li>
                <?php }else{ ?>
                        <li><strong>MOLDE NUEVO</strong></li>
                <?php } ?>
                        <!--<li>Sólo se puede modificar molde, entre los ya existentes.</li>-->
                    </ul>
                <hr />
                </div>
            </div>
            <?php
        break;
        case 'NO LLEVA':
            ?>
            <div class="control-group">
        		<label class="control-label" for="usuario">  </label>
        		<div class="controls">
                <hr />
                    <ul>
                        <li><strong>NO LLEVA MOLDE</strong></li>
                    </ul>
                <hr />
                </div>
            </div>
            <?php
		break;	
		case 'CLIENTE LO APORTA':
            ?>
            <div class="control-group">
        		<label class="control-label" for="usuario">  </label>
        		<div class="controls">
                <hr />
                    <ul>
                        <li><strong>CLIENTE LO APORTA</strong></li>
                    </ul>
                <hr />
                </div>
            </div>
            <?php
        break;
    ?>
    
    
    <?php }?>
   
    <?php
    if(sizeof($orden)==0)
    {
        
       // print_r($datos);
        ?> 
   <div class="control-group">
		<label class="control-label" for="usuario">¿Están los moldes?  </label>
		<div class="controls">
                    <?php 
                    if($fotomecanica->estan_los_moldes=="NO" && $datos->condicion_del_producto=="Nuevo"){ 
                        if($fotomecanica->hay_que_troquelar=="NO"){
                        $estan_los_moldes='NO LLEVA';
                        }else{
                        $estan_los_moldes='NO';    
                        }
                    } 
                    if($fotomecanica->estan_los_moldes=="NO" && $datos->condicion_del_producto=="Repetición Sin Cambios"){$estan_los_moldes= 'SI';} 
                    if($fotomecanica->estan_los_moldes=="NO" && $datos->condicion_del_producto=="Repetición Con Cambios"){$estan_los_moldes= 'NO';} 
                    if($fotomecanica->estan_los_moldes=="SI" && $datos->numero_molde=="1"){$estan_los_moldes= 'SI';} 
//                    if($fotomecanica->estan_los_moldes=="NO" and $datos->condicion_del_producto=="Producto Genérico"){$estan_los_moldes= 'SI';} 
                    if($fotomecanica->estan_los_moldes=="NUEVO"){$estan_los_moldes= 'NUEVO';}                     
                    if($fotomecanica->estan_los_moldes=="NO LLEVA"){$estan_los_moldes= 'NO LLEVA';}                     
                    if($fotomecanica->estan_los_moldes=="MOLDE GENERICO"){$estan_los_moldes= 'MOLDE GENERICO';}                     
                    if($fotomecanica->estan_los_moldes=="CLIENTE LO APORTA"){$estan_los_moldes= 'CLIENTE LO APORTA';}      
                    if($fotomecanica->estan_los_moldes=="MOLDE REGISTRADOS DEL CLIENTE"){$estan_los_moldes= 'MOLDE REGISTRADOS DEL CLIENTE';} 
//                  ?>
	                <input type="text" style="width: 600px;" name="estan_los_moldes" value="<?php  echo $estan_los_moldes?>"  readonly="true"/><strong>Código Molde <ins><a href="<?php echo base_url();?>moldes/edit/<?php echo $ordenDeCompra->id_molde?>"><?php echo $ordenDeCompra->id_molde?></a></ins>					
                        <input type="hidden" name="molde" value="<?php echo $ordenDeCompra->id_molde?>" readonly="true"/>					
		</div>
	</div>
    <?php
    }else
    {
    ?>
	<div class="control-group">
		<label class="control-label" for="usuario">¿Están los moldes?  </label>
		<div class="controls">
	              <input type="text" style="width: 600px;" name="estan_los_moldes" value="<?php echo $orden->tiene_molde?>"  readonly="true"/><strong>Código Molde <ins><a href="<?php echo base_url();?>moldes/edit/<?php echo $orden->id_molde?>"><?php echo $orden->id_molde?></a></ins>					
                      <input type="hidden" name="molde" value="<?php echo $orden->id_molde?>"  readonly="true"/>				
		</div>
	</div>
	<?php
	}
	?>
	
   
	
    <?php
    if(sizeof($orden)==0)
    {
//        if ($ing->nombre_molde!='')
//        {
        ?>
            <div class="control-group" id="crea_molde">
                <label class="control-label" for="usuario"><strong>Nombre Molde sugerido por ingeniería</strong></label>
                <div class="controls">
                    <?php if($estan_los_moldes=='NO' && $datos->trazado > 0){ ?>
                    <input type="text" style="width: 600px;" name="nombre_molde" style="width: 600px;" placeholder="Nombre Molde sugerido por ingeniería" value="<?php echo $ing->producto?>"/> 
                    <?php } else { if($estan_los_moldes=='NO LLEVA' && $fotomecanica->hay_que_troquelar=="NO"){ ?> 
                    <input type="text" style="width: 600px;" name="nombre_molde" style="width: 600px;" placeholder="Nombre Molde sugerido por ingeniería" value=""/> 
                    <?php }else{ ?>
                    <input type="text" style="width: 600px;" name="nombre_molde" style="width: 600px;" placeholder="Nombre Molde sugerido por ingeniería" value="<?php echo $ing->nombre_molde?>"/> 
                    <?php } }?>
                </div>
            </div>
        <?php
//        }
    }
    else
    {
        ?>
            <div class="control-group" id="crea_molde">
            <label class="control-label" for="usuario"><strong>Nombre Molde</strong></label>
                <div class="controls">
                    <input type="text" style="width: 600px;" name="nombre_molde" style="width: 600px;"  placeholder="Nombre Molde sugerido por ingeniería" value="<?php echo $orden->nombre_molde; ?>"/> 
                </div>
            </div>
        <?php
    }
    ?>
    <?php 
    $trazado = $this->trazados_model->getTrazadosPorId($datos->trazado); 
    if(sizeof($trazado)>0){
    ?>
       <div class="control-group" id="crea_molde">
                <label class="control-label" for="usuario"><strong>Estatus de Trazado</strong></label>
                <div class="controls">
                    <select name="estatus_trazado">
                        <option value="">Seleccione</option>
                        <option value="Provisorio" <?php if($trazado->estatus=='Provisorio'){echo 'selected="selected"';} ?>>Provisorio</option>
                        <option value="Definitivo" <?php if($trazado->estatus=='Definitivo'){echo 'selected="selected"';} ?>>Definitivo</option>
                    </select>
                </div>
            </div>
    <?php } ?>
       <div class="control-group">
		<label class="control-label" for="usuario">Fecha Entrega Segun cliente</label>
		<div class="controls">
                <?php
                if(sizeof($orden) >=1)
                {  ?>
                    <input type="date" id="titulo" name="fecha" value="<?php echo $orden->fecha_entrega?>" /> <br> O.C F.Despacho: ( <?php echo invierte_fecha($ordenDeCompra->fecha_despacho)?> ) <br> O.P F.Entrega: ( <?php echo invierte_fecha($orden->fecha_entrega)?> ) <br> O.P + 20:( <?php echo invierte_fecha($orden->fecha_20_dias)?> ) 
                <?php } else { ?>
                    <input type="date" id="titulo" name="fecha" value="<?php echo $ordenDeCompra->fecha_despacho?>" /> <br> O.C F.Despacho: ( <?php echo invierte_fecha($ordenDeCompra->fecha_despacho)?> ) <br> O.P F.Entrega: ( <?php echo invierte_fecha($orden->fecha_entrega)?> ) <br> O.P + 20:( <?php echo invierte_fecha($orden->fecha_20_dias)?> ) 
                <?php
                }
                ?>
		</div>
	</div>
    
    
    <div class="control-group">
		<label class="control-label" for="usuario">Forma Despacho</label>
		<div class="controls">
		
		
		
		
            <select name="tota_o_parcial" id="tota_o_parcial" onchange="fn_cb_totalOparcial(this.value,'cantidadesDespacho')">
                <option value="Total">Total</option>
                <option value="Parcial" <?php if($orden->tipo_entrega=="Parcial"){echo 'selected="true"';}?>>Parcial</option>
                <option value="despachos semanales">despachos semanales</option>
                <option value="despachos mensuales" <?php if($orden->tipo_entrega=="despachos mensuales"){echo 'selected="true"';}?>>despachos mensuales</option>
                <option value="despachos bimensuales" <?php if($orden->tipo_entrega=="despachos bimensuales"){echo 'selected="true"';}?>>despachos bimensuales</option>
                <option value="despachos trimestrales" <?php if($orden->tipo_entrega=="despachos trimestrales"){echo 'selected="true"';}?>>despachos trimestrales</option>
            </select><br>S.C: ( <?php echo $datos->tota_o_parcial?> ) <br> O.P: ( <?php echo $orden->tipo_entrega?> ) 
		</div>
	</div>
    <div class="control-group" id="producto">
           <div id="cantidadesDespacho" style="display: none;">
		<label class="control-label" id = "lblCantidadesTotalParcial" for="usuario">Cantidades (Si es Parcial)</label>
		<div class="controls" >
                    
			<input type="text" name="can_despacho_1" style="width: 100px;" id="can_despacho1" onkeypress="nextOnEnter(this,event);return soloNumeros(event)" onblur="formatear(this.value,this.id)" value="0" /> - <input type="text" name="can_despacho_2" style="width: 100px;" id="can_despacho_2" onkeypress="nextOnEnter(this,event);return soloNumeros(event)" onblur="formatear(this.value,this.id)" value="0" /> - <input type="text" name="can_despacho_3" style="width: 100px;" id="can_despacho_3" onkeypress="nextOnEnter(this,event);return soloNumeros(event)" onblur="formatear(this.value,this.id)" value="0" />
                </div>
                </div>
        </div>
    
     <div class="control-group">
		<label class="control-label" for="usuario">Forma Pago de la O.C</label>
		<div class="controls">
		<select name="forma_pago">
               <!--<option value="0">Seleccione.....</option>-->
                <?php
                //$formas=$this->clientes_model->getFormasPago();
                $formas=$this->clientes_model->getFormasPagoPorId2($ordenDeCompra->id_forma_pago);
                $f=$this->clientes_model->getFormasPagoPorId($orden->id_forma_pago);
                foreach($formas as $forma){
                    ?>
                    <option value="<?php echo $forma->id?>" <?php if($ordenDeCompra->id_forma_pago == $forma->id){echo 'selected="selected"';}?>><?php echo $forma->forma_pago?></option>
                    <?php
                }
                ?>
                
            </select> <br>(Desde SC : <?php echo $datos->forma_pago ?> ) <br> (Confirmado en OP : <?php echo $f->forma_pago ?> ) 
			
			
		</div>
	</div>
    
     
    <div class="control-group" id="rechazo" style="display: <?php if($orden->estado=='2'){echo 'block';}else{echo 'none';}?>;">
		<label class="control-label" for="usuario">Por qué rechaza</label>
		<div class="controls">
			<textarea id="contenido6" name="glosa"><?php echo $orden->glosa ?></textarea>
		</div>
	</div>

        <div class="control-group">
                <div>
		<label class="control-label" for="usuario">Estatus del Cliente</label>
                    <div class="controls" id="estatus"><img src="http://localhost/trabajo/public/frontend/images/esperar.gif" alt="Estatus del Cliente" title="Estatus del Cliente"></div>
                </div>
        </div>        
    
	<div class="control-group">
		<div class="form-actions">
		
		
		 <?php
	 //Usuario 
			if( $this->session->userdata('perfil')!=2)
			{
		?>
		
								<?php
								 if(sizeof($orden)==0)
								 {
								?>
						
							<input type="hidden" name="id" value="<?php echo $id?>" />
							<input type="hidden" name="pagina" value="<?php echo $pagina?>" />
							<input type="hidden" name="estado" />
							<input type="button" value="Guardar" class="btn <?php if($orden->estado==0){echo 'btn-warning';}?>" onclick="guardarFormularioAdd('0');" />
							<input type="button" value="Liberar" class="btn <?php if($orden->estado==1){echo 'btn-warning';}?>" onclick="guardarFormularioAdd('1');" />
							<input type="button" value="Rechazar" class="btn <?php if($orden->estado==2){echo 'btn-warning';}?>" onclick="guardarFormularioAdd('2');" />
								<?php
								}else
								{
								?>
							<input type="hidden" name="id" value="<?php echo $id?>" />
							<input type="hidden" name="pagina" value="<?php echo $pagina?>" />
							<input type="hidden" name="estado" />
							<input type="button" value="Guardar" class="btn <?php if($orden->estado==0){echo 'btn-warning';}?>" onclick="guardarFormularioAdd('0');" />
							<input type="button" value="Liberar" class="btn <?php if($orden->estado==1){echo 'btn-warning';}?>" onclick="guardarFormularioAdd('1');" />
							<input type="button" value="Rechazar" class="btn <?php if($orden->estado==2){echo 'btn-warning';}?>" onclick="guardarFormularioAdd('2');" />
								
								<?php
								}
								
								 if($orden->estado ==2)
								 {
								?>  

<!--							<input type="hidden" name="id" value="<?php //echo $id?>" />
							<input type="hidden" name="pagina" value="<?php //echo $pagina?>" />
							<input type="hidden" name="estado" />
							<input type="button" value="Guardar" class="btn <?php// if($orden->estado==0){echo 'btn-warning';}?>" onclick="guardarFormularioAdd('0');" />
							<input type="button" value="Liberar" class="btn <?php //if($orden->estado==1){echo 'btn-warning';}?>" onclick="guardarFormularioAdd('1');" />
							<input type="button" value="Rechazar" class="btn <?php// if($orden->estado==2){echo 'btn-warning';}?>" onclick="guardarFormularioAdd('2');" />-->

							
							
							
								<strong>OP Rechazada</strong>
						  
									<?php
								 }
									?>
            
			
			<?php
			}
			?>
			
		</div>
	</div>
    
</form>
<span class="ir-arriba icon-arrow-up">↑</span>
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
	
	window.onload = function() {
			ValidarCantidadesDeAcuerdoRangoMargenCotizadosOP('<?php echo $id?>');
			ValidarPreciosDeAcuerdoRangoMargenCotizadosOP('<?php echo $id?>');
		};
    verificar_estatus_cliente("<?php echo $cliente_arreglo->rut; ?>", "estatus");
    
    $('.ir-arriba').click(function(){
		$('body, html').animate({
			scrollTop: '0px'
		}, 300);
	});
 
	$('.ir-arriba2').click(function(){
		$('body, html').animate({
			scrollTop: '4700px'
		}, 300);
	});
        
$("input[type=radio]").on('click',function(){
    var datos = [];
    var datosv;
    var ruta='cotizaciones/ordenes_proveedores/';
    var id = $('#ncd').val();
    $("input[type=radio]:checked").each(function(i){    
    datos.push([$(this).attr('name'),$(this).val()]);
    });    
    
    $.post(webroot+ruta,{ datos:datos,id:id },function(resp){
        
    });
    //console.log(datos);
});       

  </script>
</div>

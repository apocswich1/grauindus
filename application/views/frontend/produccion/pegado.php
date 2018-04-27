    <head>

        <link type="text/css" rel="stylesheet" href="<?php echo base_url()?>public/backend/fancybox/jquery.fancybox.css" />
        <link type="text/css" rel="stylesheet" href="<?php echo base_url()?>public/frontend/css/etv2.css" />

        

    </head>


<?php
function cuantas_etiquetas($cant_caja, $paquetes){
    return $cant_caja / $paquetes;
}

function pintar_etiqueta($id,$ordenDeCompra,$datos,$producto,$cliente){
$valor = '        <div id="dina4">
            <div class="divp">  
                <div class="imagen">    
                <img width="110px" src="'.base_url().'public/frontend/images/Logo-Cartonajes-web.png" id="logo"/>
                </div>
                <div class="ot">    
                    <div>OT</div>
                    <div>'.$id.'</div>
                </div>
                <div class="codigo">    
                    <div>CODIGO</div>
                    <div class="cod">'.$producto->codigo.'</div>
                </div>
                <div class="titulo">    
                    ENVASES DE MICROCORRUGADO
                </div>
                <div class="cliente">    
                    Cliente:
                </div>
                <div class="nombre_cliente">    
                    '.$cliente.'
                </div>
                <div class="articulo">    
                    Articulo:
                </div>
                <div class="nombre_articulo">    
                    '.$datos->producto.'
                </div>
                <div class="paquete">    
                    Paquetes de: 
                </div>
                <div class="cantidad">    
                    <span style="font-size: 25px" class="paq">25</span> Unidades
                </div>
                <div class="fecha">    
                    '.(date('d-m-Y')).'
                </div>
            </div>
        </div>';

return $valor;
}
?>    
    

<?php $this->layout->element('admin_mensaje_validacion'); ?>
<div id="contenidos">
<?php echo form_open(null, array('class' => 'form-horizontal','name'=>'form','id'=>'form')); ?>
<!-- Migas -->
    <ol  class= "breadcrumb" >  
      <li><a href="<?php echo base_url()?>">Home &gt;&gt;</a></li>
      <?php
      switch($tipo)
      {
        case '1':
            ?>
            <li><a href="<?php echo base_url()?>produccion/cotizaciones/<?php echo $pagina?>">Órdenes de Producción &gt;&gt;</a></li>
            <li>Pegado - Orden de Producción N° <?php echo $ordenDeCompra->id?></li>
            <?php
        break;
        case '2':
            ?>
            <li><a href="<?php echo base_url()?>produccion/fast/<?php echo $pagina?>">Fast Track &gt;&gt;</a></li>
            <li>Pegado - Fast Track N° <?php echo $ordenDeCompra->id?></li>
            <?php
        break;
      }
      ?>
      
      
    </ol>
   <!-- /Migas -->
    <?php
      switch($tipo)
      {
        case '1':
            ?>
            <div class="page-header"><h3>Pegado - Orden de Producción N° <?php echo $ordenDeCompra->id?></h3></div>
            <ul>
                <?php
                $cli=$this->clientes_model->getClientePorId($datos->id_cliente);
                $cliente=$cli->razon_social;
                $vendedor=$this->vendedores_model->getVendedorPorId($datos->id_vendedor);
                if($orden->tiene_molde=='NO')
                {
                    $moldeNuevo='Molde Antiguo';
                }else
                {
                    $moldeNuevo='Molde nuevo';
                }
                $molde=$this->moldes_model->getMoldesPorId($orden->id_molde);
                $materialidad_1=$this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_1);
                $materialidad_2=$this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_2);
                $materialidad_3=$this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_3);
                ?>

    <table width="100%" border="0">
                    <tr>    
                        <td width="58%"><li>Cliente: <b><?php echo $cliente?></b></li></td>
                        <td colspan="2"><label id="option1" style="background-color: #0066cc; color: #fff; padding-left: 20px;font-size: 17px;text-align: center;">Impresion de Etiquetas</label></td>
                    </tr>
                    <tr>
                        <td width="58%"></td>
                        <td><li>Cantidad a Despachar: </li></td>
                        <td><input type="text" style="" name="paquetede1" id="paquetede1" value="<?php echo $ordenDeCompra->cantidad_de_cajas?>" />
de <?php echo $ordenDeCompra->cantidad_de_cajas?>                        
                        </td>
                        <td></td>
                    </tr>

                    <tr>
                        <td><li>Descripción : <b><?php echo $datos->producto?></b></li></td>
                        <td><li>Paquetes de: </li></td>
                <td><input type="text" style="" name="paquetede" value="<?php echo '25'; ?>" id="paquetede"/></td>
                    </tr>
                    <tr>
                        <td><li>Fecha Orden de Compra : <strong><?php echo fecha($ordenDeCompra->fecha)?></strong></li></td>
                        <td><li>¿Cuantas Etiquetas ?</li></td>
                <td><input type="text" style="" name="cuantoetiqueta" value="<?php echo cuantas_etiquetas($ordenDeCompra->cantidad_de_cajas, 25) ?>" id="cuantoetiqueta" readonly="true"/></td>
                    </tr>
                    <tr>
                        <td><li>Fecha Orden de Producción : <strong><?php echo fecha($orden->fecha)?></strong></li></td>
                        <td><li>Código Producto :</li></td>
                        <td><input type="text" style="" name="codigoproducto" value="<?php echo $producto->codigo;?>" id="codigoproducto"/></td>
                    </tr>                    
                    <tr>
                        <td><li>Condición del Producto : <strong><?php echo $datos->condicion_del_producto?></strong></li></td>
                        <td><li>Seleccione el Logo: </li></td>
                        <td>
                            <select name="empresa" id="empresa">
                                <option value="cartonajes">CARTONAJES</option>
                                <option value="tendencia">TENDENCIA</option>
                            </select>                    
                        </td>
                    </tr>                    
                    <tr>
                        <td><li>N° Molde : <?php echo $molde->nombre?> <a href="<?php echo base_url()?>public/uploads/moldes/<?php echo $molde->archivo?>" target="_blank"><?php echo $orden->id_molde?></a> (<?php echo $moldeNuevo?>)</li></td>
                        <td colspan="2" rowspan="5">
                            <?php 
                            echo pintar_etiqueta($id,$ordenDeCompra,$datos,$producto,$cliente); ?>
                        </td>
                    </tr>    
                    <tr>
                        <td><li>Molde por revés o al derecho : <?php echo $fotomecanica->troquel_por_atras?></li></td>
                    </tr>                    
                    <tr>
                        <td>
                            <?php if(!empty($ing->archivo)){?> 
                              <li>PDF trazado de Ingeniería <a href='<?php echo base_url(); ?>public/uploads/pdf_trazado/<?php echo $ing->archivo ?>' title="Descargar" target="_blank"><i class="icon-search"></i></a></li>
                              <?php }else
                              {
                                  ?>
                                  <li><strong>NO ESTÁ EL PDF DE TRAZADO DE INGENIERÍA</strong></li>
                                  <?php
                              }?>                        
                        </td>
                    </tr>                    
                    <tr>
                        <td>
                            <?php if(!empty($fotomecanica->archivo))
                             {
                             $archivoFotomecanica='SI';
                             ?> 
                             <li>PDF imagen <a href='<?php echo base_url(); ?>public/uploads/cotizacion_archivo_fotomecanica/<?php echo $fotomecanica->archivo ?>' title="Descargar" target="_blank"><i class="icon-search"></i></a></li>
                             <?php }else
                             {
                                 $archivoFotomecanica='NO';
                                 ?>
                                 <li><strong>NO ESTÁ EL PDF DE FOTOMECÁNICA</strong></li>
                                 <?php
                             }?>                                                        
                        </td>
                    </tr>                    
                    <tr>
                        <td>
                            <li>
                                <?php
                                if(sizeof($troquelado)==0)
                                   {
                                       ?>
                                       Situación : <strong>Pendiente</strong>
                                       <?php

                                   }else
                                   {
                                     switch($control->situacion)
                                     {
                                        case 'Liberada':
                                            ?>
                                            Situación : <strong>Liberada el <?php echo fecha_con_hora($control->fecha_liberada);?></strong>
                                            <?php
                                        break;
                                        case 'Activa':
                                            ?>
                                            Situación : <strong>Activa el <?php echo fecha_con_hora($control->fecha_activa);?></strong>
                                            <?php
                                        break;
                                     }
                                   }
                                ?>
                            </li>                        
                        </td>
                    </tr>                    
                    <tr>
                        <td>
                            <?php
                           if($troquelado->estado==1)
                           {
                               ?>
                               <li>Fecha liberación troquelado : <strong><?php echo fecha($troquelado->cuando)?></strong></li>
                               <?php
                           }
                           ?>                        
                        </td>
                        <td></td>
                        <td><input type="button" value="Imprimir" class="btn ver-etiqueta" id="ver-etiqueta" name="ver-etiqueta" /></td>
                    </tr>                      
                </table>                   

                    <li>Producto Id: <strong><?php echo $producto->codigo?></strong></li>
                    <li>Total pliegos cortados : <strong><?php echo $corte_cartulina->total_pliegos_cortados?></strong></li>
                    <li>Total pliegos producidos : <strong><?php echo $corrugado->total_pliegos_producidos?></strong></li>
                    <li>Total pliegos buenos (Imprenta producción) : <strong><?php echo $imprenta->total_pliegos_buenos?></strong></li>
                    <li>Total pliegos buenos (Emplacado) : <strong><?php echo $emplacado->total_pliegos_buenos?></strong></li>
                    <li>Total pliegos troquelado : <strong><?php echo $troquelado->total_pliegos_buenos?></strong></li>
                    <li>Total cajas del pedido : <strong><?php echo $orden->cantidad_pedida?></strong></li>
                    <li>Costo Pegado : <strong><?php echo $hoja->pegado?></strong></li>
                    <?php echo herramientas_funciones::MostrarBarniz($ing);  ?>                     
                    
                </ul>
                <hr />
            <?php
        break;
        case '2':
            ?>
            <div class="page-header"><h3>Pegado - Fast Track N° <?php echo $id?></h3></div>
            <ul>
                <?php
                 $cliente=$this->clientes_model->getClientePorId($datos->cliente);
                ?>
                    <li>Cliente : <b><?php echo $cliente->razon_social?></b></li>
                    <li>Descripción : <b><?php echo $datos->descripcion?></b></li>
                </ul>
                <hr />
            <?php
        break;
      }
      ?>
	<p>
         
    </p>
	
    <div class="control-group">
		<label class="control-label" for="usuario">Comentarios para una eventual repetición<strong style="color: red;">(*)</strong></label>
		<div class="controls">
            <input type="text" name="descripcion_del_trabajo" value="<?php echo set_value_input($control,'descripcion_del_trabajo',$control->descripcion_del_trabajo);?>" placeholder="Descripción del trabajo" />
       </div>
	</div> 
    
    <div class="control-group">
		<label class="control-label" for="usuario">Total cajas recibidas <strong style="color: red;">(*)</strong></label>
		<div class="controls">
            <input type="text" name="total_cajas_recibidas" value="<?php echo set_value_input($control,'total_cajas_recibidas',$control->total_cajas_recibidas);?>" placeholder="Total cajas recibidas" />
       </div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Para pegado <strong style="color: red;">(*)</strong></label>
		<div class="controls">
            <select name="para_pegado">
                <option value="Máquina" <?php if($control->para_pegado=='Máquina'){echo 'selected="true"';}?>>Máquina</option>
                <option value="Manual" <?php if($control->para_pegado=='Manual'){echo 'selected="true"';}?>>Manual</option>
            </select>
       </div>
	</div> 
    
    <div class="control-group">
		<label class="control-label" for="usuario">Empaquetado <strong style="color: red;">(*)</strong></label>
		<div class="controls">
            <select name="empaquetado">
                <option value="En Caja" <?php if($control->empaquetado=='En Caja'){echo 'selected="true"';}?>>En Caja</option>
                <option value="Empaquetado" <?php if($control->empaquetado=='Empaquetado'){echo 'selected="true"';}?>>Empaquetado</option>
                <option value="Paletizado" <?php if($control->empaquetado=='Paletizado'){echo 'selected="true"';}?>>Paletizado</option>
            </select>
       </div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Operador <strong style="color: red;">(*)</strong></label>
		<div class="controls">
			<select name="operador">
                <?php
                foreach($usuarios as $usuario)
                {
                    ?>
                    <option value="<?php echo $usuario->id?>" <?php if($control->maestro==$usuario->id){echo 'selected="true"';}?>><?php echo $usuario->nombre?></option>
                    <?php
                }
                ?>
            </select>
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Cantidad cajas buenas <strong style="color: red;">(*)</strong></label>
		<div class="controls">
            <input type="text" name="cantidad_cajas_buenas" value="<?php echo set_value_input($control,'cantidad_cajas_buenas',$control->cantidad_cajas_buenas);?>" placeholder="Cantidad cajas buenas" />
       </div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Código del producto <strong style="color: red;">(*)</strong></label>
		<div class="controls">
            <input type="text" name="codigo_del_producto" value="<?php echo set_value_input($control,'codigo_del_producto',$control->codigo_del_producto);?>" placeholder="Código del producto" />
       </div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Cantidad a empaquetar <strong style="color: red;">(*)</strong></label>
		<div class="controls">
            <input type="text" name="cantidad_a_empaquetar" value="<?php echo set_value_input($control,'cantidad_a_empaquetar',$control->cantidad_a_empaquetar);?>" placeholder="Cantidad a empaquetar" />
       </div>
	</div>
    <div class="control-group">
		<label class="control-label" for="usuario">Cantidad por paquete <strong style="color: red;">(*)</strong></label>
		<div class="controls">
            <input type="text" name="cantidad_por_paquete" value="<?php echo set_value_input($control,'cantidad_por_paquete',$control->cantidad_por_paquete);?>" placeholder="Cantidad por paquete" />
       </div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Total palet <strong style="color: red;">(*)</strong></label>
		<div class="controls">
            <input type="text" name="total_palet" value="<?php echo set_value_input($control,'total_palet',$control->total_palet);?>" placeholder="Total Palet" />
       </div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Cantidad por palet <strong style="color: red;">(*)</strong></label>
		<div class="controls">
            <input type="text" name="cantidad_por_palet" value="<?php echo set_value_input($control,'cantidad_por_palet',$control->cantidad_por_palet);?>" placeholder="Cantidad por Palet" />
       </div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Medidas del palet <strong style="color: red;">(*)</strong></label>
		<div class="controls">
            <input type="text" name="medidas_del_palet" value="<?php echo set_value_input($control,'medidas_del_palet',$control->medidas_del_palet);?>" placeholder="Medidas del palet" />
       </div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Entrega parcial o total <strong style="color: red;">(*)</strong></label>
		<div class="controls">
            <input type="text" name="entrega_parcial_o_total" value="<?php echo set_value_input($control,'entrega_parcial_o_total',$control->entrega_parcial_o_total);?>" placeholder="Entrega parcial o total" />
       </div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Cantidad pendiente <strong style="color: red;">(*)</strong></label>
		<div class="controls">
            <input type="text" name="cantidad_pendiente" value="<?php echo set_value_input($control,'cantidad_pendiente',$control->cantidad_pendiente);?>" placeholder="Cantidad pendiente" />
       </div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Número de orden de compra <strong style="color: red;">(*)</strong></label>
		<div class="controls">
            <input type="text" name="numero_orden_de_compra" value="<?php echo set_value_input($control,'numero_orden_de_compra',$control->numero_orden_de_compra);?>" placeholder="Número de orden de compra" />
       </div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Pegado manual o de máquina <strong style="color: red;">(*)</strong></label>
		<div class="controls">
            <select name="tipo_pegado">
                <option value="manual" <?php echo set_value_select($control,'tipo_pegado',$control->tipo_pegado,'manual');?>>Manual</option>
                <option value="de máquina" <?php echo set_value_select($control,'tipo_pegado',$control->tipo_pegado,'de máquina');?>>De máquina</option>
            </select>
       </div>
	</div>
    
    <div class="control-group" id="rechazo" style="display: <?php if($control->estado=='2'){echo 'block';}else{echo 'none';}?>;">
		<label class="control-label" for="usuario">Por qué rechaza</label>
		<div class="controls">
			<textarea id="contenido6" name="glosa"><?php echo $control->glosa?></textarea>
		</div>
	</div>
    
    
    
    
	<div class="control-group">
		<div class="form-actions">
            <input type="hidden" name="tipo" value="<?php echo $tipo?>" />
            <input type="hidden" name="pagina" value="<?php echo $pagina?>" />
            <input type="hidden" name="id" value="<?php echo $id?>" />
            <input type="hidden" name="id_cliente" value="<?php if($tipo==1){echo $datos->id_cliente;}else{echo $datos->cliente;}?>" />
			<input type="hidden" name="indicador" />
            <input type="hidden" name="estado" />
			<input type="button" value="Guardar" class="btn <?php if($control->estado==0){echo 'btn-warning';}?>" onclick="guardarFormularioAdd('0');" />
   		    <input type="button" value="Rechazar" class="btn <?php if($control->estado==2){echo 'btn-warning';}?>" onclick="guardarFormularioAdd('2');" />
            <input type="button" value="Liberar" class="btn <?php if($control->estado==1){echo 'btn-warning';}?>" onclick="guardarFormularioAdd('1');" />
			<input type="button" value="Parcial" class="btn <?php if($control->estado==3){echo 'btn-warning';}?>" onclick="guardarFormularioAdd('3');" />
		</div>
	</div>
</form>

<script type="text/javascript">
     jQuery(document).ready
    (
        function ()
        {                       
           function cuantaetiquetas(){
            var paquetede1 = $('#paquetede1').val();   //7200
            var paquetede = $('#paquetede').val();   //25
              $('#cuantoetiqueta').val(Math.round(paquetede1 / paquetede));  
            }
                
        
            document.form.reset();
      
        //imprimir etiquetas
            $(".ver-etiqueta").click(function() {                   
                var cantidad = Math.round($('#cuantoetiqueta').val() / 6);
                url = '<?php echo base_url()?>produccion/etiquetas_despacho/<?php echo $id ?>/'+$('#paquetede').val()+'/'+$('#codigoproducto').val()+'/'+cantidad+'/'+$('#empresa option:selected').val();
                window.open(url, '_blank');
                return false;                
            });


            $('#paquetede1').keyup(function(){                
                cuantaetiquetas();
            });            

            $('#paquetede').keyup(function(){                
                $('.paq').html($('#paquetede').val());
                cuantaetiquetas();
            });            

            $('#codigoproducto').keyup(function(){
             $('.cod').html($('#codigoproducto').val());
            });

            $('#empresa').change(function() {                
                if($('#empresa option:selected').val() == 'cartonajes') {
                    $("#logo").attr("src","<?php echo base_url()?>public/frontend/images/Logo-Cartonajes-web.png");
                }else{
                    $("#logo").attr("src","<?php echo base_url()?>public/frontend/images/Logo-Tendencia-web.png");
                }
            });        
            
        }
    );
    tinyMCE.init({
			theme : "advanced",
			mode : "textareas",
	});
    
</script>
</div>

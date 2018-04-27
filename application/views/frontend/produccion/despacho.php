    <head>

        <link type="text/css" rel="stylesheet" href="<?php echo base_url()?>public/backend/fancybox/jquery.fancybox.css" />
        <link type="text/css" rel="stylesheet" href="<?php echo base_url()?>public/frontend/css/etv2.css" />

        <script type="text/javascript" src="<?php echo base_url()?>public/backend/fancybox/jquery.fancybox.js"></script>      
        
        <script type="text/javascript">var ruta='<?php echo base_url();?>';</script>		
        <script type="text/javascript">
        $(document).ready(function() {
        	$(".fancybox").fancybox({
        		openEffect	: 'none',
        		closeEffect	: 'none'
        	});
            
        });
        </script>

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
            <li>Despacho - Orden de Producción N° <?php echo $ordenDeCompra->id ?></li>
            <?php
        break;
        case '2':
            ?>
            <li><a href="<?php echo base_url()?>produccion/fast/<?php echo $pagina?>">Fast Track &gt;&gt;</a></li>
            <li>Despacho - Fast Track N° <?php echo $id?></li>
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
            <div class="page-header"><h3>Despacho - Orden de Producción N° <?php echo $ordenDeCompra->id ?></h3></div>
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
                    </tr>

                    <tr>
                        <td><li>Descripción : <b><?php echo $datos->producto?></b></li></td>
                        <td><li>Paquetes de: </li></td>
                <td><input type="text" style="" name="paquetede" value="<?php echo '25'; ?>" id="paquetede"/></td>
                    </tr>
                    <tr>
                        <td><li>Cantidad de Cajas Solicitadas: <b><?php echo $ordenDeCompra->cantidad_de_cajas?></b></li></td>
                        <td><li>¿Cuantas Etiquetas ?</li></td>
                        <td><input type="text" style="" name="cuantoetiqueta" value="<?php echo cuantas_etiquetas($ordenDeCompra->cantidad_de_cajas, 25) ?>" id="cuantoetiqueta" readonly="true"/></td>
                    </tr>
                    <tr>
                        <td><li>Fecha Orden de Compra : <strong><?php echo fecha($ordenDeCompra->fecha)?></strong></li></td>
                        <td><li>Código Producto :</li></td>
                        <td><input type="text" style="" name="codigoproducto" value="<?php echo $producto->codigo;?>" id="codigoproducto"/></td>
                    </tr>                    
                    <tr>
                        <td><li>Fecha Orden de Producción : <strong><?php echo fecha($orden->fecha)?></strong></li></td>
                        <td><li>Seleccione el Logo: </li></td>
                        <td>
                            <select name="empresa" id="empresa">
                                <option value="cartonajes">CARTONAJES</option>
                                <option value="tendencia">TENDENCIA</option>
                            </select>                    
                        </td>
                    </tr>                    
                    <tr>
                        <td><li>Condición del Producto : <strong><?php echo $datos->condicion_del_producto?></strong></li></td>
                        <td colspan="2" rowspan="4">
                            <?php 
                            echo pintar_etiqueta($id,$ordenDeCompra,$datos,$producto,$cliente); ?>
                        </td>
                    </tr>    
                    <tr>
                        <td>
                            <?php if ($ordenDeCompra->archivo<>"") { ?>
                             <li>Orden de Compra N°: <?php echo $ordenDeCompra->orden_de_compra_cliente?> <a href="<?php echo base_url()?>public/uploads/cotizacion_orden_de_compra/<?php echo $ordenDeCompra->archivo  ?>" target="_blank"><?php echo $orden->id_molde?></a> </li>
                            <?php } else { ?>
                             <li>Orden de Compra N°: <?php echo $ordenDeCompra->orden_de_compra_cliente?> <strong>No hay PDF de Orden de Compra</strong></li>
                            <?php } ?>                    
                        </td>
                    </tr>                    
                    <tr>
                        <td><li>N° Molde : <?php echo $molde->nombre?> <a href="<?php echo base_url()?>public/uploads/moldes/<?php echo $molde->archivo?>" target="_blank"><?php echo $orden->id_molde?></a> (<?php echo $moldeNuevo?>)</li></td>
                    </tr>                    
                    <tr>
                        <td><li>Molde por revés o al derecho : <?php echo $fotomecanica->troquel_por_atras?></li></td>
                    </tr>                    
                    <tr>
                        <td>
                            <?php if(!empty($ing->archivo)){?> 
                            <li>PDF trazado de Ingeniería <a href='<?php echo base_url(); ?>public/uploads/pdf_trazado/<?php echo $ing->archivo ?>' title="Descargar" target="_blank"><i class="icon-search"></i></a></li>
                            <?php }else{ ?>
                                <li><strong>NO ESTÁ EL PDF DE TRAZADO DE INGENIERÍA</strong></li>
                            <?php } ?>
                                
                           <?php if(!empty($fotomecanica->archivo)){ $archivoFotomecanica='SI'; ?>                         
                            <?php }else{ $archivoFotomecanica='NO';?>
                                <li><strong>NO ESTÁ EL PDF DE FOTOMECÁNICA</strong></li>
                            <?php } ?>

                        </td>
                        <td></td>
                        <td><input type="button" value="Imprimir" class="btn ver-etiqueta" id="ver-etiqueta" name="ver-etiqueta" /></td>
                        
                    </tr>                    
                    <tr>
                        <td><li>PDF imagen <a href='<?php echo base_url(); ?>public/uploads/cotizacion_archivo_fotomecanica/<?php echo $fotomecanica->archivo ?>' title="Descargar" target="_blank"><i class="icon-search"></i></a></li></td>
                        <td></td>
                        <td></td>

                    </tr>                      
                </table>                                        
                    
                    <li>
                        <?php
                        if(sizeof($talleres_externos)==0 or sizeof($pegado)==0)
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
                    <li>Fecha Orden de Producción : <strong><?php echo fecha($orden->fecha)?></strong></li>
                    <li>Condición del Producto : <strong><?php echo $datos->condicion_del_producto?></strong></li>
                    <?php
                    if($fotomecanica->estado==1)
                    {
                        ?>
                        <li>Fecha liberación fotomecánica : <strong><?php echo fecha($fotomecanica->cuando)?></strong></li>
                        <?php
                    }
                    ?>
                    <li>Descripción de la placa : <strong><?php echo $materialidad_1->nombre?></strong></li>
                    <li>Gramaje de la placa : <strong><?php echo $materialidad_1->gramaje?></strong></li>
                     <li>Cantidad de golpes : <strong><?php echo number_format($hoja->placa_kilo,0,'','.');?></strong></li>
                     <li>Corrugado o Microcorrugado : <strong><?php echo $fotomecanica->materialidad_datos_tecnicos?></strong></li>
                     <li>Pegado Manual o De máquina : <strong><?php echo $pegado->tipo_pegado?></strong></li>
                </ul>
                <hr />
            <?php
        break;
        case '2':
            ?>
            <div class="page-header"><h3>Despacho - Fast Track N° <?php echo $id?></h3></div>
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
	
    <?php// print_r($control) //my code is here ?>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Número de Orden de Trabajo</label>
		<div class="controls">
            <input type="text" name="numero_de_orden_de_trabajo" value="<?php echo $orden->id;?>" readonly="true" />
       </div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Comentarios para una eventual repetición</label>
		<div class="controls">
                    <input type="text" style="width: 500px" name="descripcion_del_trabajo" value="<?php echo set_value_input($control,'descripcion_del_trabajo',$control->descripcion_del_trabajo);?>" />
       </div>
	</div> 
    
    <?php 
    $producto=$this->productos_model->getProductosPorId($orden->producto_id);
    ?>
    <div class="control-group">
		<label class="control-label" for="usuario">Código Producto</label>
		<div class="controls">
            <input type="text" name="codigo_producto" value="<?php echo $producto->codigo;?>" readonly="true" />
       </div>
	</div>
  
    <div class="control-group">
		<label class="control-label" for="usuario">Descripción del Producto (Ingeniería)</label>
                <div class="controls">
                    <input type="text" name="des" value="<?php echo $ing->producto;?>" readonly="true" style="width: 500px"/>
       </div>
	</div> 
    
    <div class="control-group">
		<label class="control-label" for="usuario">Fecha de Entrega a Despachar <strong style="color: red;">(*)</strong></label>
		<div class="controls">                    
                <?php 
                if ($control->fecha_de_entrega=='') {
                    $fecha = date('Y-m-d');
                }else{
                    $fecha = set_value_input($control,'fecha_de_entrega',$control->fecha_de_entrega);
                }
                        ?>
                    <input type="date" name="fecha_de_entrega" value="<?php echo $fecha?>" />
       </div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Cantidad de Cajas Solicitadas</label>
		<div class="controls">
                    <input type="text" id="cantidad_de_cajas" name="cantidad_de_cajas" value="<?php echo $ordenDeCompra->cantidad_de_cajas;?>" placeholder="Cantidad de cajas" readonly="true"/>
       </div>
	</div>

    <div class="control-group">
       <label class="control-label" for="usuario">Cantidad a Despachar <strong style="color: red;">(*)</strong></label>
	<div class="controls">
            <?php  
            //echo set_value_input($control,'cantidades_a_ingresar',$control->cantidades_a_ingresar);  
            ?>
            <input type="hidden" id="total_cajas_pendientes" name="total_cajas_pendientes" value="<?php if($control->total_cajas_pendientes==""){echo $ordenDeCompra->cantidad_de_cajas;}else{echo $control->total_cajas_pendientes;};?>"/>
            <input type="text" id="cantidades_a_ingresar" name="cantidades_a_ingresar" value="" placeholder="Cantidad a Despachar" /> de <b><?php if($control->total_cajas_pendientes==""){echo $ordenDeCompra->cantidad_de_cajas;}else{echo $control->total_cajas_pendientes;};?> Pendientes</b>
            
        </div>
	</div>
    
    

    <div class="control-group">
		<label class="control-label" for="usuario">Cantidad de Cajas Despachadas</label>
		<div class="controls">
            <input type="text" name="total_de_ingresos" value="<?php if($control->total_de_ingresos==""){echo 0;}else{echo $control->total_de_ingresos;}?>" placeholder="Total de ingresos" readonly="true" />
       </div>
	</div>

        <div class="control-group">
		<label class="control-label" for="usuario">Precio de Venta ($)</label>
		<div class="controls">
            <input type="text" name="precio_venta" value="<?php echo $ordenDeCompra->precio;?>" placeholder="Precio de venta" />
       </div>
	</div>
    
    
    <div class="control-group">
		<label class="control-label" for="usuario">Unidades por Paquete Oficial <strong style="color: red;">(*)</strong></label>
		<div class="controls">
                    <?php                   
                        $valor = (($control->unidades_por_paquete_oficial!='') ?  $control->unidades_por_paquete_oficial : 0);
                    ?>                                                            
                    <input type="text" name="unidades_por_paquete_oficial" value="<?php echo $valor; ?>" placeholder="Unidades por paquete oficial" readonly="true"/>
                    
       </div>
	</div>

    <div class="control-group">
		<label class="control-label" for="usuario">Unidades por Paquete Efectivas que trae este Ingreso <strong style="color: red;">(*)</strong></label>
		<div class="controls">
                    <?php                   
                        $valor = (($cotizacion->cantidad_especifica!='') ?  $cotizacion->cantidad_especifica : 0);
                    ?>                       
                    
                    <input type="text" name="unidades_paquete_efectivo" value="<?php echo $valor; ?>" placeholder="Unidades por paquete efectivas que trae este ingreso" readonly="true" />
       </div>
	</div>

    
    <div class="control-group">
		<label class="control-label" for="usuario">Paquetes por Palet</label>
		<div class="controls">
            <input type="text" name="paquetes_por_pallet" value="<?php echo $pegado->total_palet;?>" readonly="true" />
       </div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Medidas Palet</label>
		<div class="controls">
            <input type="text" name="medidas_de_pallet" value="<?php echo $pegado->medidas_del_palet;?>" readonly="true" />
       </div>
	</div>
       
<!--    <div class="control-group">
		<label class="control-label" for="usuario">Cantidad de cajas a ingresar hoy</label>
		<div class="controls">
            <input type="text" name="cantidad_cajas_a_ingresar_hoy" value="<?php// echo set_value_input($control,'total_cajas_ingresadas',$control->total_cajas_ingresadas);?>" placeholder="Cantidad de cajas a ingresar hoy" />
       </div>
	</div>-->
    <!-- div class="control-group">
	<label class="control-label" for="usuario">Cantidad de cajas a ingresar hoy</label>
	<div class="controls">
            <input type="text" name="ingreso_a_bodega" value="<?php //echo set_value_input($control,'ingreso_a_bodega',$control->ingreso_a_bodega);?>" />
        </div>
    </div -->
    
<!--div class="control-group">
		<label class="control-label" for="usuario">Listado de los ingresos con sus cantidades<strong style="color: red;">(*)</strong></label>
		<div class="controls">
            <input type="text" name="listado_ingresos_cantidades" value="<?php echo set_value_input($control,'listado_ingresos_cantidades',$control->listado_ingresos_cantidades);?>" placeholder="Listado de los ingresos con sus cantidades" />
           </div>
	</div-->
    
    
    
    
    
<!--     <div class="control-group">
		<label class="control-label" for="usuario">Cierra la orden</label>
		<div class="controls">
            <select name="cierra_la_orden">
                <option value="NO" <?php echo set_value_select($control,'cierra_la_orden',$control->cierra_la_orden,'NO');?>>NO</option>
                <option value="SI" <?php echo set_value_select($control,'cierra_la_orden',$control->cierra_la_orden,'SI');?>>SI</option>
            </select>
       </div>
	</div>  -->
	
	<hr>
	<div class="control-group">
		<!--<label class="control-label" for="usuario"><strong> <a href="<?php //echo base_url()?>produccion/guia_despachos/<?php //echo $id?>/<?php //echo $pagina?>" class="fancybox fancybox.ajax">Despacho</a></strong></label>-->
            <label class="control-label" for="usuario"><strong> <a href="#" id="despacho1" dato="" onclick="iradespacho2('<?php echo $id; ?>',this)" >Despacho</a></strong></label>
		<div class="controls">
           
                <!--<a href="<?php //echo base_url()?>produccion/guia_despachos/<?php //echo $id?>/<?php //echo $pagina?>" class="fancybox fancybox.ajax"><i class="icon-file range"></i></a>-->
                <a href="#" id="despacho" dato="" onclick="iradespacho('<?php echo $id; ?>',this)"><i class="icon-file range"></i></a>
            
       </div>
	
    <div class="control-group" id="rechazo" style="display: <?php if($control->estado=='2'){echo 'block';}else{echo 'none';}?>;">
		<label class="control-label" for="usuario">Por qué rechaza</label>
		<div class="controls">
			<textarea id="contenido6" name="glosa"><?php echo $control->glosa?></textarea>
		</div>
	</div>
    
<!-- 	<div class="control-group">
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
	</div> -->
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
</script>
</div>

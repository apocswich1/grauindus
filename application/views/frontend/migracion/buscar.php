<?php if ( $this->session->flashdata('ControllerMessage') != '' ) :     ?>

<div class="alert alert-success"><?php echo $this->session->flashdata('ControllerMessage'); ?></div>
<?php endif; ?>
<div class="page-header"><h3>Modulo de Migración</h3></div>
<div class="page-header"><h3>Resultados para el término <strong><?php echo $buscar?></strong></h3></div>


    <?php   //print_r($datos);  ?>
<div>
    <a onclick="migrar();" class="btn btn-success pull-left" href="<?php echo base_url()?>migracion/index/migrar/1">Actualizar Data</a>
    <br /><br />

</div>
	<!-- Buscador -->
    <div class="pull-right">
	<?php echo form_open(base_url()."migracion/buscar", array('class' => 'form-search pull-right')); ?>
		<input type="text" class="input-medium search-query" name="buscar" placeholder="Buscar" />
		<button type="submit" class="btn">Buscar</button>
		
	</form>
</div>
    <!-- /Buscador -->

<table class="table table-bordered table-striped indice">
	<thead>
            <tr>
                <th>Numero</th>
                <th>OT</th>                
                <th>Trabajo</th>
                <th>Fecha</th>
                <th>Cliente SV</th>
                <th>Cliente SN</th>                
                <th>Molde SN</th> 
                <th>Producto SN</th>                 
                <th>Rut</th>                        
                <th>Acciones</th>
            </tr>
	</thead>
	<tbody>
    <?php
    
   // print_r($datos);
    foreach($datos as $dato)
    { 
        $nro_molde="";
        $cliente_sv="";
        $productos_sn="";
        $rut_cliente_sv="";
        $trabajo_sv="";        
        $cliente_molde_creado="";
        $arreglo_cotizacion=$this->cotizaciones_model->getCotizacionPorIdAntiguo($dato->N_COSTO);
        $cliente=$this->clientes_model->getClientePorRutMigracion($dato->RUT);        
        
        if (sizeof($arreglo_cotizacion)==0)
        {
        ?>
        <td><?php echo $dato->N_COSTO; ?></td>
        <?php 
        $existe_ot="";
        if ($conn_access = odbc_connect ( "bdacces2", "", "")){ 
            $ssql = "select RUTQ AS rut,TRABAJOQ AS trabajo, Cproducto AS producto, NOMBREQ AS cliente, OPN AS ot,CODMOLDE AS nromolde from [RESPALDO HC] where [N COSTOQ] = ".$dato->N_COSTO."";
            if($rs_access = odbc_exec ($conn_access, $ssql)){ 
                $fila = odbc_fetch_object($rs_access);
                if ($fila->ot!='')
                {
                   $existe_ot="<strong>".$fila->ot."</strong>";
                   $nro_molde=$fila->nromolde;
                   $cliente_sv=$fila->cliente;
                   $rut_cliente_sv=$fila->rut;
                   $producto_sv=$fila->producto;                   
                   $trabajo_sv=$fila->trabajo;                       
                }
            }
        }   
        $molde_creado=$this->moldes_model->getMoldesPorId($nro_molde);
//        $cliente=$this->clientes_model->getClientePorRutMigracion($rut_cliente_sv);
        if (sizeof($molde_creado)>0)
            $cliente_molde_creado=$this->clientes_model->getClientePorId2($molde_creado->nombrecliente);        
        if ($producto_sv!='')
            $productos_sn=$this->productos_model->getProductoporCodigoMigracion($producto_sv);
        else
            $productos_sn="";
        
       
        ?>
        <td><?php echo $existe_ot; ?></td>        
        <td><?php echo $dato->TRABAJO; ?></td>
        <td><?php echo $dato->FECHA; ?></td>
        <td><?php echo $dato->NOMBRE; ?></td>
        <td><?php if (($existe_ot!='') and ($cliente->razon_social=='')) echo "<strong>RUT DE CLIENTE NO EXISTE EN SN</strong>"; else echo "<strong>".$cliente->razon_social."</strong>";  ?></td>        
        <td><?php if (sizeof($molde_creado)>0) { echo "<strong>".$molde_creado->nombre.", CODIGO:".$molde_creado->numero.", CLIENTE: ".$cliente_molde_creado->razon_social."<strong>";} else { echo "<strong>NO EXISTE</strong>"; } ?></td>
        <td><?php if ($productos_sn->nombre!='') { echo "<strong>".$productos_sn->nombre.", Codigo SN:".$productos_sn->codigo.", Codigo SV:".$producto_sv.", </br>Trabajo SV:".$trabajo_sv."</strong>"; } else { echo "<strong>NO EXISTE</strong>"; }?></td>
        <td><input onchange="update_rut_ajax_Migracion(this.value,'<?php echo $dato->id; ?>');" style="width: 100px;"  type="text" id="<?php echo $dato->id; ?>" name="<?php echo $dato->id; ?>" value="<?php echo $dato->RUT; ?>" />
            <img width="10%" height="10%" src="<?php echo base_url()."public/frontend/images/"?>save.png" alt="Guardar" title="Guardar"></td>        
        <td>
            <?php if (herramientas_funciones::verifica_RUT($dato->RUT)!=false)
            {
                if ((sizeof($cliente)==0) and ($existe_ot!=''))
                {
                ?>
                <div id="<?php echo $dato->id."div"?>"></div>	
                <?php
                }
                else 
                {
                ?>
                <div id="<?php echo $dato->id."div"?>">
                    <input type="submit" onclick="carga_ajax_Migrar_sv('<?php echo $dato->id; ?>');" value="Migrar" class="btn <?php if($dato->id!=""){echo 'btn-warning';}?>"/>
                    <!--<a href="<?php // echo base_url()?>migracion/registro/<?php // echo $dato->id?>" title="Migrar">Migrar</a>-->
                </div>	
                <?php                    
                }
            }
            else { ?>
            <div id="<?php echo $dato->id."_div"?>"><a href="<?php echo base_url()?>migracion/registro/<?php echo $dato->id?>" title="Migrar">Migrar </a></div>	
            <?php } ?>            
        </td>
        </tbody>
        <?php
        }
    }
    //odbc_close($conn_access);
    ?>
    
     <tr>
        <td colspan="10" style="text-align: right;">
        <?php echo $this->layout->element('admin_paginador'); ?>
        </td>
    </tr>
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
            
        });
        </script>

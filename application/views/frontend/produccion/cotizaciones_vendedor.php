<?php if ( $this->session->flashdata('ControllerMessage') != '' ) : ?>
<div class="alert alert-success"><?php echo $this->session->flashdata('ControllerMessage'); ?></div>

<?php endif; ?>
<?php if ($this->session->flashdata('error_op')) { ?>
        <div class="alert alert-danger"> <?= $this->session->flashdata('error_op') ?> </div>
    <?php } ?>
<?php if ($this->session->flashdata('success_op')) { ?>
        <div class="alert alert-success"> <?= $this->session->flashdata('success_op') ?> </div>
    <?php } ?>
<div class="span8">
    <div class="row">    
    <div>
        <span style="color: #ff0000; font-size: 12px;"><B>Activo</B></span>->        
        <span style="color: #2fa4e7; font-size: 12px;"><B>Pendiente</B></span>->
        <span style="color: orange; font-size: 12px;"><B>Pendiente por Liberar</B> </span>->
        <span style="color: green; font-size: 12px;"><B>Liberado</B> </span>->
        <span style="color: black; font-size: 12px;"><B>No corresponde</B> </span>        
    </div>
    </div>
</div>
<!--<div class="span3">
    <div class="row">    
    <input type="text" name="busqueda" id="busqueda" />
    </div>
</div>
<div class="span2">
    <div class="row">    
    <a class="btn btn-success">Buscar</a>
    </div>
</div>-->

<div id="principal" class="span1">
  <div class="row">
      <label><h5>Vendedor</h5></label>
  </div>
</div>
<div id="profile" class="span2"> 
  <div class="row">
      <select id="Vendedor" name="vendedor" style="width: 250px" onchange="carga_ajax_vendedor(this.value);">
        <option value="" selected="selected">Seleccione</option>
        <option value="">Listado General</option>
        <?php 
        $vendedores = $this->usuarios_model->getVendedores();
        foreach ($vendedores as $value) { 
        echo "<option value='$value->id'>$value->nombre</option>";
         } ?>
    </select>
      <!--<input type="button" value="imprimir" name="imprimir" onclick="alert();">-->
  </div>
</div>
<!--    <div>
        <span style="color: #ff0000; font-size: 12px;"><B>Activo</B></span>->        
        <span style="color: #2fa4e7; font-size: 12px;"><B>Pendiente</B></span>->
        <span style="color: orange; font-size: 12px;"><B>Pendiente por Liberar</B> </span>->
        <span style="color: green; font-size: 12px;"><B>Liberado</B> </span>->
        <span style="color: black; font-size: 12px;"><B>No corresponde</B> </span>        
    </div>-->
</br>
</br>
</br>
<ul class="nav nav-tabs">
  <li role="presentation" class="active"><a href="<?php echo base_url()?>produccion/cotizaciones">Órdenes de Producción</a></li>
  <li role="presentation"><a href="<?php echo base_url()?>produccion/fast">Fast Track</a></li>
</ul>
<div class="page-header"><h3>Órdenes de Producción por Vendedor( <?php echo $cuantos?> en total)</h3><a href="<?php echo base_url().'produccion/cotizaciones_lista/'.$list?>" target="_blank">Imprimir</a></div>
<div class="container-fluid">
<table class="table table-bordered table-striped indice" id="datatable">
	<thead>
		<tr>
             <th>OT</th>
             <th>Cotización</th>
             <th>OP</th>
             <th>Fecha solicitud</th>
	           <th>Cliente</th>
	           <th>Vendedor</th>
             <th>Producto</th>
             <th>V</th>
             <th>O</th>
<!--             <th>Fotomecánica</th>
             <th>Status</th>
             <th>Accion</th>-->
		</tr>
	</thead>
	<tbody>
    <?php
	
    foreach($datos as $dato)
    {
        $fotomecanica=$this->produccion_model->getFotomecanicaPorTipo(1,$dato->id);
        $control_cartulina=$this->produccion_model->getControlCartulinaPorTipo(1,$dato->id); 
        $control_papel=$this->produccion_model->getControlControlPapelPorTipo(1,$dato->id); 
        $control_onda=$this->produccion_model->getControlControlOndaPorTipo(1,$dato->id); 
        $control_liner=$this->produccion_model->getControlControlLinerPorTipo(1,$dato->id); 
        $confeccion_molde_troquel=$this->produccion_model->getConfeccionModelTroquelPorTipo(1,$dato->id); 
        $corte_cartulina=$this->produccion_model->getCorteCartulinaPorTipo(1,$dato->id);
        $corrugado=$this->produccion_model->getCorrugadoPorTipo(1,$dato->id);
        $imprenta_produccion=$this->produccion_model->getImprentaProduccionPorTipo(1,$dato->id);
        $servicios=$this->produccion_model->getServiciosPorImprentaPorTipo(1,$dato->id);
        $troquelado=$this->produccion_model->getTroqueladoPorTipo(1,$dato->id);
        $emplacado=$this->produccion_model->getEmplacadoPorTipo(1,$dato->id);
        $talleres_externos=$this->produccion_model->getTallerExternosPorTipo(1,$dato->id);
        $imprenta_programacion=$this->produccion_model->getImprentaProgramacionPorTipo(1,$dato->id);
        $desgajado=$this->produccion_model->getDesgajadoPorTipo(1,$dato->id);
        $pegado=$this->produccion_model->getPegadoPorTipo(1,$dato->id);
        $bodega=$this->produccion_model->getBodegaPorTipo(1,$dato->id);
        $fotomecanica2=$this->cotizaciones_model->getCotizacionFotomecanicaPorIdCotizacion($dato->id);
//        print_r($fotomecanica2);        
        $ing=$this->cotizaciones_model->getCotizacionIngenieriaPorIdCotizacion($dato->id);
        $cli=$this->clientes_model->getClientePorId($dato->id_cliente);
        $cliente=$cli->razon_social; 
        $bobinado_cartulina=$this->produccion_model->getBobinadoCartulinaPorTipo(1,$dato->id); 
        $bobinado_onda=$this->produccion_model->getBobinadoCartulinaOndaPorTipo(1,$dato->id); 
        $bobinado_liner=$this->produccion_model->getBobinadoCartulinaLinerPorTipo(1,$dato->id); 
		
		
	$archivo_cliente=$this->cotizaciones_model->getArchivoClientePorCotizacion($dato->id);
        $ing=$this->cotizaciones_model->getCotizacionIngenieriaPorIdCotizacion($dato->id);
        $orden=$this->cotizaciones_model->getOrdenDeCompraPorCotizacion($dato->id);
        $orden_produccion=$this->orden_model->getOrdenesPorCotizacion($dato->id);   
        $not=$this->orden_model->getNumeroOt($dato->id);            
	$vendedor=$this->usuarios_model->getUsuariosPorId($dato->id_vendedor);
        //$user=$this->usuarios_model->getUsuariosPorId($this->session->userdata('id'));	
		
		if($bodega->estado != '4')
		{
                    
    ?>
        <tr id="detalle<?php echo $dato->id?>">
        <td><?php echo $not->id_ot?></td>
        <td><?php echo $dato->id?></td>
        <td><?php echo $dato->id_op?></td>
        <td><?php echo fecha($dato->fecha)?></td>
        <td><?php echo $cliente?></td>
        <td id="<?php echo $dato->id ?>"><?php echo $vendedor->nombre?></td>
        <td><?php echo $dato->producto;?></td>
        <td style="width: 40px"><?php echo "<a href='#' onclick='colocar2($dato->id,document)' class='idc' val='".$dato->id."' data-toggle='modal' data-target='#myModalVendedor'><img src='".base_url()."public/frontend/images/edit.png' class='img_16' /></a>";?></td>
        <td style="width: 40px"><?php echo "<a href='#' onclick='colocar(this.id,document)' class='idco' id='".$dato->id."' val='".$dato->id."' data-toggle='modal' data-target='#myModalDespachar'><img src='".base_url()."public/frontend/images/edit.png' class='img_16 despacho' /></a>";?></td>
        
<!--             <td style="text-align: center;">
            <a href="<?php// echo base_url()?>produccion/pendientes_fotomecanica/<?php// echo $dato->id?>" title="Pendientes Fotomecánica" class="fancybox fancybox.ajax">Pendientes Fotomecánica</a>	
            </td>
             <td style="text-align: center;">
                 <?php
                  if($dato->vigencia==0){
                  //echo '<label style="background:red;color:white; height: 20px;text-align: center; vertical-align: center;width: 50px"  data-toggle="modal" data-target="#myModal">Nula</label>';	 
                  }
                  if($dato->vigencia==1){
                  //echo '<label style="background:green;color:white; height: 20px;text-align: center; vertical-align: center;width: 50px"  data-toggle="modal" data-target="#myModal">Activa</label>';	 
                  }
                  if($dato->vigencia==2){
                  //echo '<label style="background:orange;color:white; height: 20px;text-align: center; vertical-align: center;width: 50px"  data-toggle="modal" data-target="#myModal">Caduca</label>';	 
                  }
                  if($dato->vigencia==3){
                  //echo '<label style="background:blue;color:white; height: 20px;text-align: center; vertical-align: center;width: 50px"  data-toggle="modal" data-target="#myModal">Prueba</label>';	 
                  }
                  if($dato->vigencia==4){
                  //echo '<label style="background:black;color:white; height: 20px;text-align: center; vertical-align: center;width: 50px"  data-toggle="modal" data-target="#myModal">Cerrada por PT</label>';	 
                  }
                  ?>
            </td>
             <td style="text-align: center;">
                 <button type="button" class="" style="background-color: #ffcc33; border-radius: 5px; border-style: none" data-toggle="modal" data-target="#myModal" onclick="reversar(<?php echo $dato->id ?>)">Rev</button>
            </td>-->
		</tr>
            <?php 
		}
    }
	
            ?>
        </tbody>
</table></div>
   <!-- Modal -->
   <div class="modal fade" id="myModal" role="confirm">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Reversar Orden de Produccion <b id="nro_orden_modal"></b></h4>
        </div>
        <div class="modal-body">
            <form action="" method="post">
                <div class="form-group">    
                    <label>Password</label>
                    <input type="password" name="pass_reversar" />
                    <input id="numero_op" type="hidden" name="numero_op" />
            </div>
        </div>
        <div class="modal-footer">
            
            <button type="submit" class="btn btn-default">Si, quiero reversar</button>
            <button id="cerrar_modal_orden" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
          </form>
      </div>
    </div>
  </div>
   <!-- Modal -->
   <div class="modal fade" id="myModalVendedor" role="confirm" style="width: 500px">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Cambiar Vendedor de la Solicitud de Cotizacion <b id="nro_de_cotizacion"></b></h4>
        </div>
        <div class="modal-body">
            <!--<form action="" method="post">-->
                <div class="form-group">    
                    <select id="id_vendedor" name="id_vendedor">
                    <option value=""> --Seleccione-- </option>          
                    <?php 
                    $usuarios = $this->usuarios_model->getVendedores();
                    foreach ($usuarios as $value) { ?>
                        <option value="<?php echo $value->id ?>"><?php echo $value->nombre ?></option>          
                    <?php } ?>    
                    </select>
                    <input id="numero_ct" type="hidden" name="numero_ct" />
            </div>
        </div>
        <div class="modal-footer">
            
            <button id="cambiarlo" type="btn" class="btn btn-default">Cambiarlo</button>
            <button id="cerrar_modal_orden" type="btn" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
          </form>
      </div>
    </div>
  </div>
   <!-- Modal -->
   <div class="modal fade" id="myModalDespachar" role="confirm" style="width: 500px">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Cambiar Status a la Orden de Cotizacion <b id="nro_de_cotizacion_despacho"></b></h4>
        </div>
        <div class="modal-body">
            <!--<form action="" method="post">-->
                <div class="form-group">    
                    <select id="operacion" name="operacion">
                    <option value=""> --Seleccione-- </option>          
                    <option value="4">Anular Orden</option>          
                    <option value="3">Cerrar Orden</option>          
                      
                    </select>
                    <input id="numero_ctd" type="hidden" name="numero_ctd" />
            </div>
        </div>
        <div class="modal-footer">
            
            <button id="cerrar_orden" type="btn" class="btn btn-default">Procesar</button>
            <button id="cerrar_modal_orden" type="btn" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
          </form>
      </div>
    </div>
  </div>


<!--     <tr>
        <td colspan="10" style="text-align: right;">
        <?php// echo $this->layout->element('admin_paginador');
		//echo 'Hola'.$fotomecanica->materialidad_datos_tecnicos;		?>
        </td>
    </tr>-->

<script type="text/javascript">
$(document).ready(function() {
	$(".fancybox").fancybox({
		openEffect	: 'none',
		closeEffect	: 'none'
	});
        
        $("#datatable").DataTable({
            
        });
        
        $(".img_16").on('click',function(){
            var a=$(this).parent().attr('val');
//            $('#nro_de_cotizacion').text(a);
//            $('#numero_ct').val(a);
            
        });
        $(".despacho").on('click',function(){
            var a=$(this).parent().attr('val');
           // $('#nro_de_cotizacion_despacho').text(a);
           // $('#numero_cto').val(a);
            
        });
        
        $("#cambiarlo").on('click',function(){
            var valor1=$('#nro_de_cotizacion').text();
            var valor2=$('#numero_ct').val();
            var valor3=$('#id_vendedor').val();
            var ruta = webroot + 'produccion/vendedor';
            
            $.post(ruta, {valor1: valor1,valor2: valor2,valor3: valor3}, function (resp)
            {//alert(resp);
                $('#myModalVendedor').modal('hide');
                $('#'+valor2).text(resp);
            }); 
        });
        
        $("#cerrar_orden").on('click',function(){
            var valor1=$('#nro_de_cotizacion_despacho').text();
            var valor2=$('#numero_cto').val();
            var valor3=$('#operacion').val();
            var ruta = webroot + 'produccion/cerrar_orden';
            
//            alert(valor3);
            $.post(ruta, {valor1: valor1,valor2: valor2,valor3: valor3}, function (resp)
            {//alert(resp);
                $('#myModalDespachar').modal('hide');
                $('#detalle'+valor1).remove();
            }); 
        });
        
        

});
</script>


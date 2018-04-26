    <?php $despachos = $this->despachos_model->getDespachosPorId($id);  ?>
<?php $ordenDeCompra->cantidad_de_cajas //my code is here  ?>
<?php //print_r($cliente); //my code is here  ?>


<style type="text/css">
    #informacion_lateral{
        background-color: #cccccc;
        width: 400px;
        min-height: 200px;
        position: absolute;
        left: 560px;
        top: 400px;
    }
    
    #informacion_lateral #div1{
        text-align: center;
        background-color: #006699;
        color:#fff;
        font-weight: bold;
        height: 20px;
    }
    #informacion_lateral #div2{
        text-align: left;
        color:#000;
    }
    
    #div2 li{
        list-style: none;
        color: #666666;
        padding: 5px;
        font-weight: bold;
    }
    
    #div2 li a{
        list-style: none;
        color: #666666;
        padding: 5px;
        font-weight: bold;
    }
    
    #div2 ul{
        margin-top: 20px;
    }
</style>
<h3>Despacho para la OT  :<?php echo $datos->id?> &nbsp;&nbsp;&nbsp;Codigo de Producto  :<span id="codigo_producto"><?php echo $producto->codigo?></span></h3>
<hr style="width:1000px;" />
<div id="contenidos">
        <div id="informacion_lateral">
            <div id="div1">Detalles de Despachos</div>
            <div id="div2">
                <ul>
                    <?php foreach($despachos as $value) { 
                        echo "<li> <a>Despacho por: ".$value->cantidad_ingresada." en Fecha: ".fecha_con_slash($value->fecha)."</a></li>";
                     } ?>
                </ul>
            </div>
        </div>    
<?php echo form_open_multipart(null, array('class' => 'form-horizontal','name'=>'form','id'=>'form')); ?>

        
    <?php //echo "<h1>" . $dato . "</h1>"; //my code is here ?>
    <div class="control-group">
		<label class="control-label" for="usuario">Cliente: </label>
		<div class="controls">
                <input type="text" name="nombre_cliente"  placeholder="Nombre de Cliente" value="<?php echo $cliente->razon_social?>" readonly="true"/>
                Nro OC:
                <input type="text" name="orden_compra"  placeholder="Nombre de Cliente" value="<?php echo $datos->id ?>" readonly="true"/>
		</div>
	</div>
    <div class="control-group">
		<label class="control-label" for="usuario">Codigo del Producto: </label>
		<div class="controls">
                    <input type="text" name="codigo_producto"  placeholder="Codigo de producto" value="<?php echo $producto->codigo ?>" readonly="true"/>
		</div>
	</div>
    <div class="control-group">
		<label class="control-label" for="usuario">Cantidad de Despacho Anterior</label>
		<div class="controls">
                    <input type="text" name="total_cajas_anterior"  placeholder="Cantidad de despacho anterior" value="<?php if($despacho->cantidad_ingresada!=""){echo $despacho->cantidad_ingresada;}?>" readonly="true"/>
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Cantidad a Despachar</label>
		<div class="controls">
                    <input type="text" id="total_cajas" name="total_cajas"  placeholder="Total de cajas" value="<?php echo $dato ?>"/>
		</div>
	</div>
    <div class="control-group">
		<label class="control-label" for="usuario">Total Cajas Pendientes</label>
		<div class="controls">
                    <input type="text" name="total_cajas_pendientes"  placeholder="Total de cajas pendientes" value="<?php if($despacho->cantidad_faltante==""){echo $ordenDeCompra->cantidad_de_cajas;}else{echo $despacho->cantidad_faltante;} ?>" readonly="true"/>
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Cierra la Orden?</label>
		<div class="controls">
                    <select name="cierra_la_orden">
                        <option value="NO" <?php if($bodega->cierra_la_orden=="NO"){echo 'selected="true"';}?>>NO</option>
                        <option value="SI" <?php if($bodega->cierra_la_orden=="SI"){echo 'selected="true"';}?>>SI</option>
                        <option value="PARCIAL" <?php if($bodega->cierra_la_orden=="PARCIAL"){echo 'selected="true"';}?>>PARCIAL</option>
                    </select>
		</div>
	</div>
	
     <div class="control-group">
		<label class="control-label" for="usuario">Detalles para el despacho</label>
		<div class="controls">
			<input type="text" name="glosa" placeholder="Justificación"/>
		</div>
	</div>
     <div class="control-group">
		<label class="control-label" for="usuario">Precio</label>
		<div class="controls">
                    <input type="text" id="precio" name="precio" placeholder="precio" value="<?php echo $ordenDeCompra->precio; ?>" readonly="true"/>
		</div>
	</div>
     <div class="control-group">
		<label class="control-label" for="usuario"><b>Monto Total de Factura</b></label>
		<div class="controls">
			<input type="text" id="total_factura" name="total_factura" placeholder="total factura" readonly="true"/>
		</div>
	</div>
	
    <hr />
      <div class="control-group">
		<div class="form-actions">
         <input type="hidden" name="id" value="<?php echo $id?>" />
         
        <!-- <input type="hidden" name="url" value="<?php //echo base_url()?>produccion/pdf_despacho/<?php //echo $datos->id?>/1/1/Despachos"/>		  -->
			<input type="submit" value="Guardar" class="btn btn-default" />
		   
		</div>
	</div>
    
</div>

<script type="text/javascript">
$(document).ready(function(){
    $("#total_cajas").on("keyup",function(){    
    var c = $("#total_cajas").val();
    var p = $("#precio").val();
    $("#total_factura").val(c*p);
    
    });
    
    var uno = $("#total_cajas").val();
    var dos = $("#precio").val();
    //alert(uno*dos);
    $("#total_factura").val(uno*dos);
});
</script>
<?php if ( $this->session->flashdata('ControllerMessage') != '' ) : ?>

<div class="alert alert-success"><?php echo $this->session->flashdata('ControllerMessage'); ?></div>
<?php endif; ?>
<!-- Migas -->
    <ol  class= "breadcrumb" >  
      <li><a href="<?php echo base_url()?>ordenes/index/<?php echo $pagina?>">Órdenes de Producción &gt;&gt;</a></li>
      <li>Revisión de Órdenes de Producción Número <?php echo $id?></li>
    </ol>
   <!-- /Migas -->
<div class="page-header"><h3>Revisión de Órdenes de Producción Número <?php echo $id?></h3></div>



<!--
<div>
	<a class="btn btn-success pull-left" href="<?php echo base_url()?>vendedores/add">Agregar Vendedor</a>
    <br /><br />

</div>
-->

<table class="table table-bordered table-striped indice">
	<thead>
        <th>&nbsp;</th>
        <th>Cotización</th>
        <th>Orden de Producción</th>
        
    </thead>
	<tbody>
        <tr>
            <td>
                Precio
            </td>
            <td>2331</td>
            <td><?php echo number_format($datos->precio)?></td>
        </tr>
        <tr>
            <td>
                Forma de Pago
            </td>
            <td>
                <?php echo $cotizacion->forma_pago?>
            </td>
             <td>
                <?php echo $datos->forma_pago?>
            </td>
        </tr>
        <tr>
            <td>
                Fecha de Entrega
            </td>
        </tr>
        <tr>
            <td>
                Materialidad
            </td>
        </tr>
        <tr>
            <td>
                &nbsp;
            </td>
        </tr>
        <tr>
            <td>
                &nbsp;
            </td>
        </tr>
    </tbody>
    
     
</table>



<?php if ( $this->session->flashdata('ControllerMessage') != '' ) : ?>

<div class="alert alert-success"><?php echo $this->session->flashdata('ControllerMessage'); ?></div>
<?php endif; ?>
<ul class="nav nav-tabs">
  <li role="presentation"><a href="<?php echo base_url()?>produccion/cotizaciones">Órdenes de Producción</a></li>
  <li role="presentation" class="active"><a href="<?php echo base_url()?>produccion/fast">Fast Track</a></li>
</ul>
<div class="page-header"><h3>Fast Track</h3></div>


<table class="table table-bordered table-striped indice">
	<thead>
		<tr>
		
			  <th>Numero Fast Track</th>
			  <th>Cliente que solicita</th>
              <th>Contacto</th>
              <th>Procesos</th>
		      <th>Cantidad</th>
              <th>Materiales Cliente</th>
              <th>Empresa ejecutante</th>
              <th>Quién Autoriza</th>
              <th>Qué cliente externo es</th>
              <th>Revisión</th>
		</tr>
	</thead>
	<tbody>
    <?php
    foreach($datos as $dato)
    {
        $procesos=$this->fast_track_model->getProcesosPorFastTrack($dato->id);
        $cliente=$this->clientes_model->getClientePorId($dato->cliente);
        $quien_solicita=$this->clientes_model->getClientePorId($dato->quien_solicita);
        $quien_externo=$this->clientes_model->getClientePorId($dato->quien_externo);
        $fotomecanica=$this->produccion_model->getFotomecanicaPorTipo(2,$dato->id);
        $control_cartulina=$this->produccion_model->getControlCartulinaPorTipo(2,$dato->id);
    ?>
           <td><?php echo $dato->id?></td>
           <td><?php echo $cliente->razon_social?></td>
           <td><?php echo $dato->contacto?></td>
            <td style="width: 200px;">
                <ul>
                    <?php
                    foreach($procesos as $proceso)
                    {
                        ?>
                        <li><?php echo $proceso->nombre?></li>
                        <?php
                    }
                    ?>
                </ul>
            </td>
            <td><?php echo $dato->cantidad?></td>
            <td><?php echo $dato->materiales_cliente?></td>
            <td><?php echo $quien_solicita->razon_social?></td>
            <td>
                <?php
                if($dato->estado==1)
                {
                     $quien_autoriza=$this->usuarios_model->getUsuariosPorId($dato->quien_autoriza);
                     echo $quien_autoriza->nombre;
                }else
                {
                    echo "Pendiente por autorización";
                }
                ?>
            </td>
            <td><?php echo $quien_externo->razon_social?></td>
         	<td style="text-align: right; width: 300px;">
         
            <?php 
            if(sizeof($this->fast_track_model->getProcesosPorFastTrackSegunProcesos($dato->id,'Produccion Fotomecanica')) >= 1)
            {
            ?>
            <a href="<?php echo base_url()?>produccion/revision_fotomecanica/2/<?php echo $dato->id?>/<?php echo $pagina?>"><span style="font-size: 10px;color:green; font-weight: bold;">Producción Fotomecánica</span><i class="icon-film"></i></a><br />
            <?php
            }
            ?>
			
			<?php
			if(sizeof($this->fast_track_model->getProcesosPorFastTrackSegunProcesos($dato->id,'Control Cartulina')) >= 1)
			{
			?>						
			<a href="<?php echo base_url()?>produccion/control_cartulina/2/<?php echo $dato->id?>/<?php echo $pagina?>" title="Control Cartulina"><span style="font-size: 10px;color:red; font-weight: bold;">Control Cartulina</span><i class="icon-film"></i></a><br />						
			<?php						
			}           
            ?>
 
 
			<?php
			if(sizeof($this->fast_track_model->getProcesosPorFastTrackSegunProcesos($dato->id,'Bobinado Cartulina')) >= 1)
			{
			?>									
			<a href="<?php echo base_url()?>produccion/bobinado_cartulina/2/<?php echo $dato->id?>/<?php echo $pagina?>" title="Bobinado Cartulina"><span style="font-size: 10px;color:red; font-weight: bold;">Bobinado Cartulina</span><i class="icon-film"></i></a><br />									
			<?php									
			}							
			?>
 
 
			<?php
			if(sizeof($this->fast_track_model->getProcesosPorFastTrackSegunProcesos($dato->id,'Control Onda')) >= 1)
			{
			?>									
			<a href="<?php echo base_url()?>produccion/control_onda/2/<?php echo $dato->id?>/<?php echo $pagina?>" title="Control Onda"><span style="font-size: 10px;color:red; font-weight: bold;">Control Onda</span><i class="icon-film"></i></a><br />									
			<?php									
			}							
			?>
			
			
			<?php
			if(sizeof($this->fast_track_model->getProcesosPorFastTrackSegunProcesos($dato->id,'Control Liner')) >= 1)
			{
			?>									
			<a href="<?php echo base_url()?>produccion/control_liner/2/<?php echo $dato->id?>/<?php echo $pagina?>" title="Control Liner"><span style="font-size: 10px;color:red; font-weight: bold;">Control Liner</span><i class="icon-film"></i></a><br />									
			<?php									
			}							
			?>
			
			<?php
			if(sizeof($this->fast_track_model->getProcesosPorFastTrackSegunProcesos($dato->id,'Bobinado Onda')) >= 1)
			{
			?>									
			<a href="<?php echo base_url()?>produccion/bobinado_onda/2/<?php echo $dato->id?>/<?php echo $pagina?>" title="Bobinado Onda"><span style="font-size: 10px;color:red; font-weight: bold;">Bobinado Onda</span><i class="icon-film"></i></a><br />									
			<?php									
			}							
			?>
 
 
			<?php
			if(sizeof($this->fast_track_model->getProcesosPorFastTrackSegunProcesos($dato->id,'Bobinado Liner')) >= 1)
			{
			?>									
			<a href="<?php echo base_url()?>produccion/bobinado_liner/2/<?php echo $dato->id?>/<?php echo $pagina?>" title="Bobinado Liner"><span style="font-size: 10px;color:red; font-weight: bold;">Bobinado Liner</span><i class="icon-film"></i></a><br />									
			<?php									
			}							
			?>
 
			<?php
			if(sizeof($this->fast_track_model->getProcesosPorFastTrackSegunProcesos($dato->id,'Confeccion Molde de Troquel')) >= 1)
			{
			?>									
			<a href="<?php echo base_url()?>produccion/confeccion_molde_troquel/2/<?php echo $dato->id?>/<?php echo $pagina?>" title="Confeccion Molde de Troquel"><span style="font-size: 10px;color:red; font-weight: bold;">Confeccion Molde de Troquel</span><i class="icon-film"></i></a><br />									
			<?php									
			}							
			?>
			
			<?php
			if(sizeof($this->fast_track_model->getProcesosPorFastTrackSegunProcesos($dato->id,'Corte Cartulina')) >= 1)
			{
			?>									
			<a href="<?php echo base_url()?>produccion/corte_cartulina/2/<?php echo $dato->id?>/<?php echo $pagina?>" title="Corte Cartulina"><span style="font-size: 10px;color:red; font-weight: bold;">Corte Cartulina</span><i class="icon-film"></i></a><br />									
			<?php									
			}							
			?>
			
			
			<?php
			if(sizeof($this->fast_track_model->getProcesosPorFastTrackSegunProcesos($dato->id,'Imprenta Programacion')) >= 1)
			{
			?>									
			<a href="<?php echo base_url()?>produccion/imprenta_programacion/2/<?php echo $dato->id?>/<?php echo $pagina?>" title="Imprenta Programacion"><span style="font-size: 10px;color:red; font-weight: bold;">Imprenta Programacion</span><i class="icon-film"></i></a><br />									
			<?php									
			}							
			?>
			
			
			<?php
			if(sizeof($this->fast_track_model->getProcesosPorFastTrackSegunProcesos($dato->id,'Servicios de post Imprenta')) >= 1)
			{
			?>									
			<a href="<?php echo base_url()?>produccion/servicios_post_imprenta/2/<?php echo $dato->id?>/<?php echo $pagina?>" title="Servicios de post Imprenta"><span style="font-size: 10px;color:red; font-weight: bold;">Servicios de post Imprenta</span><i class="icon-film"></i></a><br />									
			<?php									
			}							
			?>
			
			<?php
			if(sizeof($this->fast_track_model->getProcesosPorFastTrackSegunProcesos($dato->id,'Corrugado')) >= 1)
			{
			?>									
			<a href="<?php echo base_url()?>produccion/corrugado/2/<?php echo $dato->id?>/<?php echo $pagina?>" title="Corrugado"><span style="font-size: 10px;color:red; font-weight: bold;">Corrugado</span><i class="icon-film"></i></a><br />									
			<?php									
			}							
			?>
			
			<?php
			if(sizeof($this->fast_track_model->getProcesosPorFastTrackSegunProcesos($dato->id,'Emplacado')) >= 1)
			{
			?>									
			<a href="<?php echo base_url()?>produccion/emplacado/2/<?php echo $dato->id?>/<?php echo $pagina?>" title="Emplacado"><span style="font-size: 10px;color:red; font-weight: bold;">Emplacado</span><i class="icon-film"></i></a><br />									
			<?php									
			}							
			?>
			
			<?php
			if(sizeof($this->fast_track_model->getProcesosPorFastTrackSegunProcesos($dato->id,'Troquelado')) >= 1)
			{
			?>									
			<a href="<?php echo base_url()?>produccion/troquelado/2/<?php echo $dato->id?>/<?php echo $pagina?>" title="Troquelado"><span style="font-size: 10px;color:red; font-weight: bold;">Troquelado</span><i class="icon-film"></i></a><br />									
			<?php									
			}							
			?>
			
			<?php
			if(sizeof($this->fast_track_model->getProcesosPorFastTrackSegunProcesos($dato->id,'Desgajado')) >= 1)
			{
			?>									
			<a href="<?php echo base_url()?>produccion/desgajado/2/<?php echo $dato->id?>/<?php echo $pagina?>" title="Desgajado"><span style="font-size: 10px;color:red; font-weight: bold;">Desgajado</span><i class="icon-film"></i></a><br />									
			<?php									
			}							
			?>
			
			
			<?php
			if(sizeof($this->fast_track_model->getProcesosPorFastTrackSegunProcesos($dato->id,'Talleres Externos')) >= 1)
			{
			?>									
			<a href="<?php echo base_url()?>produccion/talleres_externos/2/<?php echo $dato->id?>/<?php echo $pagina?>" title="Talleres Externos"><span style="font-size: 10px;color:red; font-weight: bold;">Talleres Externos</span><i class="icon-film"></i></a><br />									
			<?php									
			}							
			?>
			
			
			<?php
			if(sizeof($this->fast_track_model->getProcesosPorFastTrackSegunProcesos($dato->id,'Pegado')) >= 1)
			{
			?>									
			<a href="<?php echo base_url()?>produccion/pegado/2/<?php echo $dato->id?>/<?php echo $pagina?>" title="Pegado"><span style="font-size: 10px;color:red; font-weight: bold;">Pegado</span><i class="icon-film"></i></a><br />									
			<?php									
			}							
			?>
			
			<?php
			if(sizeof($this->fast_track_model->getProcesosPorFastTrackSegunProcesos($dato->id,'Bodega')) >= 1)
			{
			?>									
			<a href="<?php echo base_url()?>produccion/bodega/2/<?php echo $dato->id?>/<?php echo $pagina?>" title="Bodega"><span style="font-size: 10px;color:red; font-weight: bold;">Bodega</span><i class="icon-film"></i></a><br />									
			<?php									
			}							
			?>
			
		
 
            </td>
    </tbody>
    <?php
    }
    ?>
     <tr>
        <td colspan="12" style="text-align: right;">
        <?php echo $this->layout->element('admin_paginador'); ?>
        </td>
    </tr>
</table>

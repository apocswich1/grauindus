<?php if ( $this->session->flashdata('ControllerMessage') != '' ) : ?>
<div class="alert alert-success"><?php echo $this->session->flashdata('ControllerMessage'); ?></div>
<?php endif; ?>

<div class="page-header"><h3>Listado de Producción ( <?php echo number_format($cuantos,0,'','.')?> en total)</h3></div>
<table class="table table-bordered table-striped indice">
	<thead>
		<tr>
             <th>Cotización</th>
             <th>OP</th>
             <th>Fecha solicitud</th>
			 <th>Cliente</th>
             <th>Producto</th>
             <th>Revisión</th>
             <th>Fotomecánica</th>
		</tr>
	</thead>
	<tbody>
    <?php
    foreach($datos as $dato)
    {
        
        $fotomecanica=$this->produccion_model->getFotomecanicaPorTipo(1,$dato->id);
        $control_cartulina=$this->produccion_model->getControlCartulinaPorTipo(1,$dato->id); 
        $control_papel=$this->produccion_model->getControlControlPapelPorTipo(1,$dato->id); 
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
        $ing=$this->cotizaciones_model->getCotizacionIngenieriaPorIdCotizacion($dato->id);
        $cli=$this->clientes_model->getClientePorId($dato->id_cliente);
        $cliente=$cli->razon_social; 
       
    ?>
    <tr>
        <td><?php echo $dato->id?></td>
        <td><?php echo $dato->id_op?></td>
        <td><?php echo fecha($dato->fecha)?></td>
        <td><?php echo $cliente?></td>
        <td><?php echo $dato->producto?></td>
	   
        <td style="text-align: right; width: 200px;">
            <?php
            if(empty($fotomecanica2->archivo) or empty($ing->archivo))
            {
                ?>
                <a href="<?php echo base_url()?>produccion/archivos/<?php echo $dato->id?>/<?php echo $pagina?>" title="Archivos Ingeniería y Fotomecánica"><span style="font-size: 10px; font-weight: bold;">PDFs Pendientes</span><i class="icon-file"></i></a> <br />
                <?php
            }
            ?>
            <?php 
            if(sizeof($fotomecanica)>0)
            {
                switch($fotomecanica->situacion)
                {
                    case 'Pendiente':
                        $colorFotomecanica='red';
                    break;
                    case 'Activa':
                        $colorFotomecanica='green';
                    break;
                    case 'Liberada':
                        $colorFotomecanica='blue';
                    break;
                    case 'Cerrada':
                        $colorFotomecanica='#000000';
                    break;
                }
                ?>
                <a href="<?php echo base_url()?>produccion/revision_fotomecanica/1/<?php echo $dato->id?>/<?php echo $pagina?>"><span style="font-size: 10px;color:<?php echo $colorFotomecanica?>; font-weight: bold;">Revisión Fotomecánica</span><i class="icon-film"></i></a> <br />
                <?php
            }else
            {
                ?>
                <a href="<?php echo base_url()?>produccion/revision_fotomecanica/1/<?php echo $dato->id?>/<?php echo $pagina?>" title="Revisión Fotomecánica"><span style="font-size: 10px;color:red; font-weight: bold;">Revisión Fotomecánica</span><i class="icon-film"></i></a> <br />
                <?php
            }
            ?>
            <?php 
            if(sizeof($control_cartulina)==0)
            {
                ?>
               <a href="<?php echo base_url()?>produccion/control_cartulina/1/<?php echo $dato->id?>/<?php echo $pagina?>" title="Control Cartulina"><span style="font-size: 10px;color:red; font-weight: bold;">Control Cartulina</span><i class="icon-film"></i></a><br />
                <?php
            }else
            {
                ?>
                <a href="<?php echo base_url()?>produccion/control_cartulina/1/<?php echo $dato->id?>/<?php echo $pagina?>" title="Control Cartulina"><span style="font-size: 10px;color:green; font-weight: bold;">Control Cartulina</span><i class="icon-film"></i></a><br />
                
                <?php
            }
            ?>
            <?php 
            if(sizeof($control_cartulina)>0 and $control_cartulina->hay_que_bobinar=='SI')
            {
                ?>
               <a href="<?php echo base_url()?>produccion/bobinado_cartulina/1/<?php echo $dato->id?>/<?php echo $pagina?>" title="Bobinado Cartulina"><span style="font-size: 10px;color:red; font-weight: bold;">Bobinado Cartulina</span><i class="icon-film"></i></a><br />
                <?php
            }
            ?>
            <?php 
            if(sizeof($control_papel)>0 and $control_papel->para_bobinado2=='Para Bobinado')
            {
                ?>
               <a href="<?php echo base_url()?>produccion/bobinado_onda/1/<?php echo $dato->id?>/<?php echo $pagina?>" title="Bobinado Onda"><span style="font-size: 10px;color:red; font-weight: bold;">Bobinado Onda</span><i class="icon-film"></i></a><br />
                <?php
            }
            ?>
            <?php 
            if(sizeof($control_papel)>0 and $control_papel->para_bobinado=='Para Bobinado')
            {
                ?>
               <a href="<?php echo base_url()?>produccion/bobinado_liner/1/<?php echo $dato->id?>/<?php echo $pagina?>" title="Bobinado Liner"><span style="font-size: 10px;color:red; font-weight: bold;">Bobinado Liner</span><i class="icon-film"></i></a><br />
                <?php
            }
            ?>
             <?php 
            if(sizeof($control_papel)==0)
            {
                ?>
               <a href="<?php echo base_url()?>produccion/control_papel/1/<?php echo $dato->id?>/<?php echo $pagina?>" title="Control Papel"><span style="font-size: 10px;color:red; font-weight: bold;">Control Papel</span><i class="icon-film"></i></a><br />
                <?php
            }else
            {
                ?>
                <a href="<?php echo base_url()?>produccion/control_papel/1/<?php echo $dato->id?>/<?php echo $pagina?>" title="Control Papel"><span style="font-size: 10px;color:green; font-weight: bold;">Control Papel</span><i class="icon-film"></i></a><br />
                
                <?php
            }
            ?>
             <?php 
            if(sizeof($confeccion_molde_troquel)==0)
            {
                ?>
               <a href="<?php echo base_url()?>produccion/confeccion_molde_troquel/1/<?php echo $dato->id?>/<?php echo $pagina?>" title="Confección Molde de troquel"><span style="font-size: 10px;color:red; font-weight: bold;">Confección Molde de troquel</span><i class="icon-film"></i></a><br />
                <?php
            }else
            {
                ?>
                <a href="<?php echo base_url()?>produccion/confeccion_molde_troquel/1/<?php echo $dato->id?>/<?php echo $pagina?>" title="Confección Molde de troquel"><span style="font-size: 10px;color:green; font-weight: bold;">Confección Molde de troquel</span><i class="icon-film"></i></a><br />
                
                <?php
            }
            ?>
             
            <?php 
            if(sizeof($corte_cartulina)==0)
            {
                ?>
               <a href="<?php echo base_url()?>produccion/corte_cartulina/1/<?php echo $dato->id?>/<?php echo $pagina?>" title="Corte Cartulina"><span style="font-size: 10px;color:red; font-weight: bold;">Corte Cartulina</span><i class="icon-film"></i></a><br />
                <?php
            }else
            {
                ?>
                <a href="<?php echo base_url()?>produccion/corte_cartulina/1/<?php echo $dato->id?>/<?php echo $pagina?>" title="Corte Cartulina"><span style="font-size: 10px;color:green; font-weight: bold;">Corte Cartulina</span><i class="icon-film"></i></a><br />
                
                <?php
            }
            ?>
            <?php 
            if(sizeof($corrugado)==0)
            {
                ?>
               <a href="<?php echo base_url()?>produccion/corrugado/1/<?php echo $dato->id?>/<?php echo $pagina?>" title="Corrugado"><span style="font-size: 10px;color:red; font-weight: bold;">Corrugado</span><i class="icon-film"></i></a><br />
                <?php
            }else
            {
                ?>
                <a href="<?php echo base_url()?>produccion/corrugado/1/<?php echo $dato->id?>/<?php echo $pagina?>" title="Corrugado"><span style="font-size: 10px;color:green; font-weight: bold;">Corrugado</span><i class="icon-film"></i></a><br />
                
                <?php
            }
            ?>
             <?php 
            if(sizeof($imprenta_programacion)==0)
            {
                ?>
               <a href="<?php echo base_url()?>produccion/imprenta_programacion/1/<?php echo $dato->id?>/<?php echo $pagina?>" title="Imprenta Programación"><span style="font-size: 10px;color:red; font-weight: bold;">Imprenta Programación</span><i class="icon-film"></i></a><br />
                <?php
            }else
            {
                ?>
                <a href="<?php echo base_url()?>produccion/imprenta_programacion/1/<?php echo $dato->id?>/<?php echo $pagina?>" title="Imprenta Programación"><span style="font-size: 10px;color:green; font-weight: bold;">Imprenta Programación</span><i class="icon-film"></i></a><br />
                
                <?php
            }
            ?>
             
             <?php 
            if(sizeof($servicios)==0)
            {
                ?>
               <a href="<?php echo base_url()?>produccion/servicios_post_imprenta/1/<?php echo $dato->id?>/<?php echo $pagina?>" title="Servicios post imprenta"><span style="font-size: 10px;color:red; font-weight: bold;">Servicios post imprenta</span><i class="icon-film"></i></a><br />
                <?php
            }else
            {
                ?>
                <a href="<?php echo base_url()?>produccion/servicios_post_imprenta/1/<?php echo $dato->id?>/<?php echo $pagina?>" title="Servicios post imprenta"><span style="font-size: 10px;color:green; font-weight: bold;">Servicios post imprenta</span><i class="icon-film"></i></a><br />
                
                <?php
            }
            ?>
             <?php 
            if(sizeof($emplacado)==0)
            {
                ?>
               <a href="<?php echo base_url()?>produccion/emplacado/1/<?php echo $dato->id?>/<?php echo $pagina?>" title="Emplacado"><span style="font-size: 10px;color:red; font-weight: bold;">Emplacado</span><i class="icon-film"></i></a><br />
                <?php
            }else
            {
                ?>
                <a href="<?php echo base_url()?>produccion/emplacado/1/<?php echo $dato->id?>/<?php echo $pagina?>" title="Emplacado"><span style="font-size: 10px;color:green; font-weight: bold;">Emplacado</span><i class="icon-film"></i></a><br />
                
                <?php
            }
            ?>
            <?php 
            if(sizeof($imprenta_produccion)==0)
            {
                ?>
               <a href="<?php echo base_url()?>produccion/imprenta_produccion/1/<?php echo $dato->id?>/<?php echo $pagina?>" title="Imprenta Producción"><span style="font-size: 10px;color:red; font-weight: bold;">Imprenta Producción</span><i class="icon-film"></i></a><br />
                <?php
            }else
            {
                ?>
                <a href="<?php echo base_url()?>produccion/imprenta_produccion/1/<?php echo $dato->id?>/<?php echo $pagina?>" title="Imprenta Producción"><span style="font-size: 10px;color:green; font-weight: bold;">Imprenta Producción</span><i class="icon-film"></i></a><br />
                
                <?php
            }
            ?>
            <?php 
            if(sizeof($troquelado)==0)
            {
                ?>
               <a href="<?php echo base_url()?>produccion/troquelado/1/<?php echo $dato->id?>/<?php echo $pagina?>" title="Troquelado"><span style="font-size: 10px;color:red; font-weight: bold;">Troquelado</span><i class="icon-film"></i></a><br />
                <?php
            }else
            {
                ?>
                <a href="<?php echo base_url()?>produccion/troquelado/1/<?php echo $dato->id?>/<?php echo $pagina?>" title="Troquelado"><span style="font-size: 10px;color:green; font-weight: bold;">Troquelado</span><i class="icon-film"></i></a><br />
                
                <?php
            }
            ?>
            <?php 
            if(sizeof($talleres_externos)==0)
            {
                ?>
               <a href="<?php echo base_url()?>produccion/talleres_externos/1/<?php echo $dato->id?>/<?php echo $pagina?>" title="Talleres Externos"><span style="font-size: 10px;color:red; font-weight: bold;">Talleres Externos</span><i class="icon-film"></i></a><br />
                <?php
            }else
            {
                ?>
                <a href="<?php echo base_url()?>produccion/talleres_externos/1/<?php echo $dato->id?>/<?php echo $pagina?>" title="Talleres Externos"><span style="font-size: 10px;color:green; font-weight: bold;">Talleres Externos</span><i class="icon-film"></i></a><br />
                
                <?php
            }
            ?>
            <?php 
            if(sizeof($desgajado)==0)
            {
                ?>
               <a href="<?php echo base_url()?>produccion/desgajado/1/<?php echo $dato->id?>/<?php echo $pagina?>" title="Desgajado"><span style="font-size: 10px;color:red; font-weight: bold;">Desgajado</span><i class="icon-film"></i></a><br />
                <?php
            }else
            {
                ?>
                <a href="<?php echo base_url()?>produccion/desgajado/1/<?php echo $dato->id?>/<?php echo $pagina?>" title="Desgajado"><span style="font-size: 10px;color:green; font-weight: bold;">Desgajado</span><i class="icon-film"></i></a><br />
                
                <?php
            }
            ?>
             <?php 
            if(sizeof($pegado)==0)
            {
                ?>
               <a href="<?php echo base_url()?>produccion/pegado/1/<?php echo $dato->id?>/<?php echo $pagina?>" title="Pegado"><span style="font-size: 10px;color:red; font-weight: bold;">Pegado</span><i class="icon-film"></i></a><br />
                <?php
            }else
            {
                ?>
                <a href="<?php echo base_url()?>produccion/pegado/1/<?php echo $dato->id?>/<?php echo $pagina?>" title="Pegado"><span style="font-size: 10px;color:green; font-weight: bold;">Pegado</span><i class="icon-film"></i></a><br />
                
                <?php
            }
            ?>
            <?php 
            if(sizeof($bodega)==0)
            {
                ?>
               <a href="<?php echo base_url()?>produccion/bodega/1/<?php echo $dato->id?>/<?php echo $pagina?>" title="Bodega"><span style="font-size: 10px;color:red; font-weight: bold;">Bodega</span><i class="icon-film"></i></a><br />
                <?php
            }else
            {
                ?>
                <a href="<?php echo base_url()?>produccion/bodega/1/<?php echo $dato->id?>/<?php echo $pagina?>" title="Bodega"><span style="font-size: 10px;color:green; font-weight: bold;">Bodega</span><i class="icon-film"></i></a><br />
                
                <?php
            }
            ?>
            </td>
             <td style="text-align: center;">
            <a href="<?php echo base_url()?>produccion/pendientes_fotomecanica/<?php echo $dato->id?>" title="Pendientes Fotomecánica" class="fancybox fancybox.ajax">Pendientes Fotomecánica</a>	
            </td>
		</tr>
            <?php 
            }
            ?>
    </tbody>
   
     <tr>
        <td colspan="10" style="text-align: right;">
        <?php echo $this->layout->element('admin_paginador'); ?>
        </td>
    </tr>
</table>

<script type="text/javascript">
$(document).ready(function() {
	$(".fancybox").fancybox({
		openEffect	: 'none',
		closeEffect	: 'none'
	});
    
});
</script>


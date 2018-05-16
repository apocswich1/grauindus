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
      <label><h5>Vigencia</h5></label>
  </div>
</div>
<div id="profile" class="span2"> 
  <div class="row">
      <select id="vigencia" name="vigencia" style="width: 150px" onchange="carga_ajax_vigencia(this.value);">
        <option value="" selected="selected">Seleccione</option>
        <option value="0">Nula</option>
        <option value="1">Activa</option>
        <option value="2">Caduca</option>
        <option value="3">Solo Prueba</option>;;
        <option value="4">Cerrada por PT</option>
    </select>
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
<div class="page-header"><h3>Órdenes de Producción ( <?php echo $cuantos?> en total)<span style="padding-left: 150px">Ultima Órden Rechazada ( <?php $ult = $this->produccion_model->getUltimaRechazada(); if($ult->ot==""){echo "No hay ot rechazadas";}else{echo "Ot : ". $ult->ot;} ?> )</span></h3></div>
<div class="container-fluid">
<table class="table table-bordered table-striped indice" id="datatable">
    <thead>
        <tr>
             <th>OT</th>
             <th>Cotización</th>
             <!--<th>OP</th>-->
             <th>Fecha solicitud</th>
         <th>Cliente</th>
             <th>Producto</th>
             <th>Revisión</th>
             <th>Pdf</th>
             <th>Fotomecánica</th>
             <!--<th>Status</th>-->
             <th>Acción</th>
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
        $ing=$this->cotizaciones_model->getCotizacionIngenieriaPorIdCotizacion($dato->id);
        $cli=$this->clientes_model->getClientePorId($dato->id_cliente);
        $cliente=$cli->razon_social; 
        $bobinado_cartulina=$this->produccion_model->getBobinadoCartulinaPorTipo(1,$dato->id); 
        $bobinado_onda=$this->produccion_model->getBobinadoCartulinaOndaPorTipo(1,$dato->id); 
        $bobinado_liner=$this->produccion_model->getBobinadoCartulinaLinerPorTipo(1,$dato->id); 
                
        $molde=$this->cotizaciones_model->getMolde($dato->id_molde);
        /*echo '<pre>';
        print_r($molde->nombre);
        exit();
        */
        $archivo_cliente=$this->cotizaciones_model->getArchivoClientePorCotizacion($dato->id);
        $ing=$this->cotizaciones_model->getCotizacionIngenieriaPorIdCotizacion($dato->id);
        $orden=$this->cotizaciones_model->getOrdenDeCompraPorCotizacion($dato->id);
        $orden_produccion=$this->orden_model->getOrdenesPorCotizacion($dato->id);   
        $not=$this->orden_model->getNumeroOt($dato->id);            
        //print_r($orden);
        if($bodega->estado != '4')
        {
                    
    ?>
    <tr>
        <td><?php echo $not->id_ot?></td>
        <td><?php echo $dato->id?></td>
        <!--<td><?php //echo $dato->id_op?></td>-->
        <td><?php echo fecha($dato->fecha)?></td>
        <td><?php echo $cliente?>
            <br/>
            <b>Moldes: </b> <?php echo $molde->id." - ".$molde->nombre ?>
            <br/>
            <b>Colores: </b> <?php echo $fotomecanica2->colores ?>            
        </td>
        <!--<td><?php// echo $dato->producto;?></td>-->
        <td><?php if($fotomecanica2->producto != ""){echo $fotomecanica2->producto.'<br /><b>Cantidad:</b> '.$orden->cantidad_de_cajas.'<br /><b>Precio:</b> '.$orden->precio;}else{echo $dato->producto.'<br />Cantidad: '.$orden->cantidad_de_cajas.'<br />Precio: '.$orden->precio;}?></td>
        
       
        <td style="text-align: right; width: 200px;">
            <?php
            if($dato->estado==3){echo "Cerrada";}else{
            if(empty($fotomecanica2->archivo) or empty($ing->archivo))
            {
                ?>
                <a href="<?php echo base_url()?>produccion/archivos/<?php echo $dato->id?>/<?php echo $pagina?>/<?php echo $not->id_ot?>" title="Archivos Ingeniería y Fotomecánica"><span style="font-size: 10px; font-weight: bold;">PDFs Pendientes</span><i class="icon-file"></i></a> <br />
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
                        $colorFotomecanica='red';
                    break;
                    case 'Liberada':
                        $colorFotomecanica='green';
                    break;
                    case 'Cerrada':
                        $colorFotomecanica='#000000';
                    break;
                    case 'Guardar':
                        if($fotomecanica->estado==1){    
                        $colorFotomecanica='green';
                        }else{    
                        $colorFotomecanica='blue';
                        }
                    break;
                }
                ?>
                <a href="<?php echo base_url()?>produccion/revision_fotomecanica/1/<?php echo $dato->id?>/<?php echo $pagina?>/<?php echo $not->id_ot?>" title="Producción Fotomecánica"><span style="font-size: 10px;color:<?php echo $colorFotomecanica?>; font-weight: bold;">Producción Fotomecánica</span><i class="icon-film"></i></a> <br />
                <?php
            }else
            {
                ?>
                <a href="<?php echo base_url()?>produccion/revision_fotomecanica/1/<?php echo $dato->id?>/<?php echo $pagina?>/<?php echo $not->id_ot?>" title="Producción Fotomecánica"><span style="font-size: 10px;color:red; font-weight: bold;">Producción Fotomecánica</span><i class="icon-film"></i></a> <br />
                <?php
            }
            ?>
                <!--<h1><?php // echo $fotomecanica->situacion; ?></h1>-->
            
            <?php 
            if(sizeof($control_cartulina)==0 )
            {
                ?>
               <a href="<?php echo base_url()?>produccion/control_cartulina/1/<?php echo $dato->id?>/<?php echo $pagina?>/<?php echo $not->id_ot?>" title="Control Cartulina"><span style="font-size: 10px;color:red; font-weight: bold;">Control Cartulina</span><i class="icon-film"></i></a><br />
                <?php
            }else
            {
                if($control_cartulina->estado==0){ ?>
                <a href="<?php echo base_url()?>produccion/control_cartulina/1/<?php echo $dato->id?>/<?php echo $pagina?>/<?php echo $not->id_ot?>" title="Control Cartulina"><span style="font-size: 10px;color:blue; font-weight: bold;">Control Cartulina</span><i class="icon-film"></i></a><br />    
                    <?php
                }else{?>
                <a href="<?php echo base_url()?>produccion/control_cartulina/1/<?php echo $dato->id?>/<?php echo $pagina?>/<?php echo $not->id_ot?>" title="Control Cartulina"><span style="font-size: 10px;color:green; font-weight: bold;">Control Cartulina</span><i class="icon-film"></i></a><br />
                  <?php  
                } 
            }
            ?>
            
               <?php 
            //if($control_cartulina->situacion == 'Guardar')
           // {
                ?>
              <!-- <a href="<?php echo base_url()?>produccion/control_cartulina/1/<?php //echo $dato->id?>/<?php //echo $pagina?>" title="Control Cartulina"><span style="font-size: 10px;color:blue; font-weight: bold;">Control Cartulina</span><i class="icon-film"></i></a><br /> -->
                <?php
           // }           
                ?>
            
            
            <?php 
            if(sizeof($control_cartulina) > 0 and $control_cartulina->hay_que_bobinar == 'SI' and $bobinado_cartulina->estado == 0)
            {
            ?>
               <a href="<?php echo base_url()?>produccion/bobinado_cartulina/1/<?php echo $dato->id?>/<?php echo $pagina?>/<?php echo $not->id_ot?>" title="Bobinado Cartulina"><span style="font-size: 10px;color:red; font-weight: bold;">Bobinado Cartulina</span><i class="icon-film"></i></a><br />
            <?php
            }elseif($bobinado_cartulina->estado > 0 and $control_cartulina->hay_que_bobinar =='SI')
                
            {
            ?>  
               <a href="<?php echo base_url()?>produccion/bobinado_cartulina/1/<?php echo $dato->id?>/<?php echo $pagina?>/<?php echo $not->id_ot?>" title="Bobinado Cartulina"><span style="font-size: 10px;color:green; font-weight: bold;">Bobinado Cartulina</span><i class="icon-film"></i></a><br />      
            <?php
            }
            ?>
           
               <?php
    if($fotomecanica2->materialidad_datos_tecnicos == 'Cartulina-cartulina')
    {      
            if(sizeof($control_liner)==0)
            { ?>
               <a href="<?php echo base_url()?>produccion/control_cartulina2/1/<?php echo $dato->id?>/<?php echo $pagina?>/<?php echo $not->id_ot?>" title="Control Cartulina 2"><span style="font-size: 10px;color:red; font-weight: bold;">Control Cartulina Respaldo</span><i class="icon-film"></i></a><br />
                <?php
            }else
            { ?>
                <a href="<?php echo base_url()?>produccion/control_cartulina2/1/<?php echo $dato->id?>/<?php echo $pagina?>/<?php echo $not->id_ot?>" title="Control Cartulina 2"><span style="font-size: 10px;color:green; font-weight: bold;">Control Cartulina Respaldo</span><i class="icon-film"></i></a><br />
                
                <?php
            }
            if(sizeof($control_liner)> 0 and $control_liner->para_bobinado=='Para Bobinado' and $bobinado_liner->estado ==0)
            { ?>
               <a href="<?php echo base_url()?>produccion/bobinado_liner/1/<?php echo $dato->id?>/<?php echo $pagina?>/<?php echo $not->id_ot?>" title="Bobinado Liner"><span style="font-size: 10px;color:red; font-weight: bold;">Bobinado Liner</span><i class="icon-film"></i></a><br />
            <?php
            }elseif($bobinado_liner->estado >0  and $control_liner->para_bobinado =='Para Bobinado')
            {
                ?>
                     <a href="<?php echo base_url()?>produccion/bobinado_liner/1/<?php echo $dato->id?>/<?php echo $pagina?>/<?php echo $not->id_ot?>" title="Bobinado Liner"><span style="font-size: 10px;color:green; font-weight: bold;">Bobinado Liner</span><i class="icon-film"></i></a><br />
                <?php
            }
            ?>
                   <a href="<?php echo base_url()?>produccion/control_onda/1/<?php echo $dato->id?>/<?php echo $pagina?>/<?php echo $not->id_ot?>" title="Control Onda"><span style="font-size: 10px;color:red; font-weight: bold;">Control Onda</span><i class="icon-film"></i></a><br />
                   <a href="<?php echo base_url()?>produccion/control_liner/1/<?php echo $dato->id?>/<?php echo $pagina?>/<?php echo $not->id_ot?>" title="Control Onda"><span style="font-size: 10px;color:red; font-weight: bold;">Control Liner</span><i class="icon-film"></i></a><br />

            <?php    
        }else{
            if($fotomecanica2->materialidad_datos_tecnicos != 'Sólo Cartulina')
            {
                if(sizeof($control_onda)==0)
                { ?>
                   <a href="<?php echo base_url()?>produccion/control_onda/1/<?php echo $dato->id?>/<?php echo $pagina?>/<?php echo $not->id_ot?>" title="Control Onda"><span style="font-size: 10px;color:red; font-weight: bold;">Control Onda</span><i class="icon-film"></i></a><br />
                        <?php
                }else
                { if($control_onda->estado==0){?>
                   <a href="<?php echo base_url()?>produccion/control_onda/1/<?php echo $dato->id?>/<?php echo $pagina?>/<?php echo $not->id_ot?>" title="Control Onda"><span style="font-size: 10px;color:blue; font-weight: bold;">Control Onda</span><i class="icon-film"></i></a><br />
                <?php }else{?>
                   <a href="<?php echo base_url()?>produccion/control_onda/1/<?php echo $dato->id?>/<?php echo $pagina?>/<?php echo $not->id_ot?>" title="Control Onda"><span style="font-size: 10px;color:green; font-weight: bold;">Control Onda</span><i class="icon-film"></i></a><br />
                <?php
                }
            }}  
            ?>
            <?php 
            if($fotomecanica2->materialidad_datos_tecnicos != 'Sólo Cartulina')
            {

                    if(sizeof($control_onda)> 0 and $control_onda->para_bobinado=='Para Bobinado' and $bobinado_onda->estado ==0)
                    {
                            ?>
                       <a href="<?php echo base_url()?>produccion/bobinado_onda/1/<?php echo $dato->id?>/<?php echo $pagina?>/<?php echo $not->id_ot?>" title="Bobinado Onda"><span style="font-size: 10px;color:red; font-weight: bold;">Bobinado Onda</span><i class="icon-film"></i></a><br />
                            <?php
                    }elseif($bobinado_onda->estado >0  and $control_onda->para_bobinado =='Para Bobinado')
                    {
                            ?>
                             <a href="<?php echo base_url()?>produccion/bobinado_onda/1/<?php echo $dato->id?>/<?php echo $pagina?>/<?php echo $not->id_ot?>" title="Bobinado Onda"><span style="font-size: 10px;color:green; font-weight: bold;">Bobinado Onda</span><i class="icon-film"></i></a><br />
                            <?php
                    }
            }   
            if($fotomecanica2->materialidad_datos_tecnicos != 'Sólo Cartulina')
            {

                    if(sizeof($control_liner)==0)
                    {
                            ?>
                       <a href="<?php echo base_url()?>produccion/control_liner/1/<?php echo $dato->id?>/<?php echo $pagina?>/<?php echo $not->id_ot?>" title="Control Onda"><span style="font-size: 10px;color:red; font-weight: bold;">Control Liner</span><i class="icon-film"></i></a><br />
                            <?php
                    }else
                    {
                            ?>
                            <a href="<?php echo base_url()?>produccion/control_liner/1/<?php echo $dato->id?>/<?php echo $pagina?>/<?php echo $not->id_ot?>" title="Control Onda"><span style="font-size: 10px;color:green; font-weight: bold;">Control Liner</span><i class="icon-film"></i></a><br />
                            <?php
                    }
            }
            if($fotomecanica2->materialidad_datos_tecnicos != 'Sólo Cartulina')
            {
                    if(sizeof($control_liner)> 0 and $control_liner->para_bobinado=='Para Bobinado' and $bobinado_liner->estado ==0)
                    {
                            ?>
                       <a href="<?php echo base_url()?>produccion/bobinado_liner/1/<?php echo $dato->id?>/<?php echo $pagina?>/<?php echo $not->id_ot?>" title="Bobinado Liner"><span style="font-size: 10px;color:red; font-weight: bold;">Bobinado Liner</span><i class="icon-film"></i></a><br />
                            <?php
                    }elseif($bobinado_liner->estado >0  and $control_liner->para_bobinado =='Para Bobinado')
                    {
                            ?>
                             <a href="<?php echo base_url()?>produccion/bobinado_liner/1/<?php echo $dato->id?>/<?php echo $pagina?>/<?php echo $not->id_ot?>" title="Bobinado Liner"><span style="font-size: 10px;color:green; font-weight: bold;">Bobinado Liner</span><i class="icon-film"></i></a><br />
                            <?php
                    }
            }   
            if($fotomecanica2->materialidad_datos_tecnicos == 'Sólo Cartulina')
            {  ?>
                       <a href="<?php echo base_url()?>produccion/control_onda/1/<?php echo $dato->id?>/<?php echo $pagina?>/<?php echo $not->id_ot?>" title="Control Onda"><span style="font-size: 10px;color:black; font-weight: bold;">Control Onda</span><i class="icon-film"></i></a><br />
                       <a href="<?php echo base_url()?>produccion/control_liner/1/<?php echo $dato->id?>/<?php echo $pagina?>/<?php echo $not->id_ot?>" title="Control Liner"><span style="font-size: 10px;color:black; font-weight: bold;">Control Liner</span><i class="icon-film"></i></a><br />
                            <?php
            }            
    }// control cartlina
    ?>
            
            
             <?php 
            if(sizeof($confeccion_molde_troquel)==0)
            {
                ?>
               <a href="<?php echo base_url()?>produccion/confeccion_molde_troquel/1/<?php echo $dato->id?>/<?php echo $pagina?>/<?php echo $not->id_ot?>" title="Confección Molde de troquel"><span style="font-size: 10px;color:red; font-weight: bold;">Confección Molde de troquel</span><i class="icon-film"></i></a><br />
                <?php
            }else
            {
                ?>
                <a href="<?php echo base_url()?>produccion/confeccion_molde_troquel/1/<?php echo $dato->id?>/<?php echo $pagina?>/<?php echo $not->id_ot?>" title="Confección Molde de troquel"><span style="font-size: 10px;color:green; font-weight: bold;">Confección Molde de troquel</span><i class="icon-film"></i></a><br />
                
                <?php
            }
            ?>
             
            <?php 
            if(sizeof($corte_cartulina)==0)
            {
                ?>
               <a href="<?php echo base_url()?>produccion/corte_cartulina/1/<?php echo $dato->id?>/<?php echo $pagina?>/<?php echo $not->id_ot?>" title="Corte Cartulina"><span style="font-size: 10px;color:red; font-weight: bold;">Corte Cartulina</span><i class="icon-film"></i></a><br />
                <?php
            }else
            {
                ?>
                <a href="<?php echo base_url()?>produccion/corte_cartulina/1/<?php echo $dato->id?>/<?php echo $pagina?>/<?php echo $not->id_ot?>" title="Corte Cartulina"><span style="font-size: 10px;color:green; font-weight: bold;">Corte Cartulina</span><i class="icon-film"></i></a><br />
                
                <?php
            }
            ?>
              <?php 
            if(sizeof($imprenta_programacion)==0)
            {
                if ($fotomecanica2->colores>0) { ?>
                   <a href="<?php echo base_url()?>produccion/imprenta_programacion/1/<?php echo $dato->id?>/<?php echo $pagina?>/<?php echo $not->id_ot?>" title="Imprenta Programación"><span style="font-size: 10px;color:red; font-weight: bold;">Imprenta Programación</span><i class="icon-film"></i></a><br />
                    <?php } else {  ?>            
                   <a href="#" title="Imprenta Programación"><span style="font-size: 10px;color:red; font-weight: bold;">Imprenta Programación</span><i class="icon-film"></i></a><br />
                <?php }      
            }else
            {
                if ($fotomecanica2->colores>0) { ?>
                <a href="<?php echo base_url()?>produccion/imprenta_programacion/1/<?php echo $dato->id?>/<?php echo $pagina?>/<?php echo $not->id_ot?>" title="Imprenta Programación"><span style="font-size: 10px;color:green; font-weight: bold;">Imprenta Programación</span><i class="icon-film"></i></a><br />
                    <?php } else {  ?>            
                   <a href="#" title="Imprenta Programación"><span style="font-size: 10px;color:red; font-weight: bold;">Imprenta Programación</span><i class="icon-film"></i></a><br />
                <?php }   
              }
            ?>
            
            
            <?php 
            if(sizeof($imprenta_produccion)==0)
            {
                if ($fotomecanica2->colores>0) { ?>
               <a href="<?php echo base_url()?>produccion/imprenta_produccion/1/<?php echo $dato->id?>/<?php echo $pagina?>/<?php echo $not->id_ot?>" title="Imprenta Producción"><span style="font-size: 10px;color:red; font-weight: bold;">Imprenta Producción</span><i class="icon-film"></i></a><br />
                    <?php } else {  ?>            
               <a href="#" title="Imprenta Producción"><span style="font-size: 10px;color:red; font-weight: bold;">Imprenta Producción</span><i class="icon-film"></i></a><br />
                <?php }                     
            }else
            {
                if ($fotomecanica2->colores>0) { ?>
                <a href="<?php echo base_url()?>produccion/imprenta_produccion/1/<?php echo $dato->id?>/<?php echo $pagina?>/<?php echo $not->id_ot?>" title="Imprenta Producción"><span style="font-size: 10px;color:green; font-weight: bold;">Imprenta Producción</span><i class="icon-film"></i></a><br />
                    <?php } else {  ?>            
                <a href="#" title="Imprenta Producción"><span style="font-size: 10px;color:green; font-weight: bold;">Imprenta Producción</span><i class="icon-film"></i></a><br />
                <?php }                     
            }
            ?>
            
            
              <?php 
            if(sizeof($servicios)==0)
            {
                if ($fotomecanica2->colores>0) { ?>
               <a href="<?php echo base_url()?>produccion/servicios_post_imprenta/1/<?php echo $dato->id?>/<?php echo $pagina?>/<?php echo $not->id_ot?>" title="Servicios post imprenta"><span style="font-size: 10px;color:red; font-weight: bold;">Servicios post Imprenta</span><i class="icon-film"></i></a><br />
                    <?php } else {  ?>            
               <a href="#" title="Servicios post imprenta"><span style="font-size: 10px;color:red; font-weight: bold;">Servicios post Imprenta</span><i class="icon-film"></i></a><br />
                <?php }                       
            }else
            {
                if ($fotomecanica2->colores>0) { ?>
                <a href="<?php echo base_url()?>produccion/servicios_post_imprenta/1/<?php echo $dato->id?>/<?php echo $pagina?>/<?php echo $not->id_ot?>" title="Servicios post imprenta"><span style="font-size: 10px;color:green; font-weight: bold;">Servicios post Imprenta</span><i class="icon-film"></i></a><br />
                    <?php } else {  ?>            
                <a href="#" title="Servicios post imprenta"><span style="font-size: 10px;color:green; font-weight: bold;">Servicios post Imprenta</span><i class="icon-film"></i></a><br />
                <?php }                           
            }
            ?>
            
            
            <?php
              if($fotomecanica2->materialidad_datos_tecnicos == 'Cartulina-cartulina')
              {?>
                       <a href="<?php echo base_url()?>produccion/corrugado/1/<?php echo $dato->id?>/<?php echo $pagina?>/<?php echo $not->id_ot?>" title="Corrugado"><span style="font-size: 10px;color:black; font-weight: bold;">Corrugado</span><i class="icon-film"></i></a><br />
              <?php 
              }
              else
              { 
                    if($fotomecanica2->materialidad_datos_tecnicos == 'Sólo Cartulina')
                    { 
                    ?>
                        <a href="<?php echo base_url()?>produccion/corrugado/1/<?php echo $dato->id?>/<?php echo $pagina?>/<?php echo $not->id_ot?>" title="Corrugado"><span style="font-size: 10px;color:black; font-weight: bold;">Corrugado</span><i class="icon-film"></i></a><br />
                    <?php
                    } 
                    else 
                    {    
                        if(sizeof($corrugado)==0)
                        {                
                            ?>
                           <a href="<?php echo base_url()?>produccion/corrugado/1/<?php echo $dato->id?>/<?php echo $pagina?>/<?php echo $not->id_ot?>" title="Corrugado"><span style="font-size: 10px;color:red; font-weight: bold;">Corrugado</span><i class="icon-film"></i></a><br />
                            <?php
                        }else
                        {
                            ?>
                            <a href="<?php echo base_url()?>produccion/corrugado/1/<?php echo $dato->id?>/<?php echo $pagina?>/<?php echo $not->id_ot?>" title="Corrugado"><span style="font-size: 10px;color:green; font-weight: bold;">Corrugado</span><i class="icon-film"></i></a><br />

                            <?php
                        }
                    }                
                }
        ?>     
             
           
             <?php 
             
            if($fotomecanica2->materialidad_datos_tecnicos == 'Sólo Cartulina')
            { ?>
                <a href="<?php echo base_url()?>produccion/emplacado/1/<?php echo $dato->id?>/<?php echo $pagina?>/<?php echo $not->id_ot?>" title="Emplacado"><span style="font-size: 10px;color:black; font-weight: bold;">Emplacado</span><i class="icon-film"></i></a><br />            <?php
            }
            elseif ($fotomecanica2->materialidad_datos_tecnicos == 'Cartulina-cartulina')
            {
                    ?>
                   <a href="<?php echo base_url()?>produccion/emplacado/1/<?php echo $dato->id?>/<?php echo $pagina?>/<?php echo $not->id_ot?>" title="Emplacado"><span style="font-size: 10px;color:black; font-weight: bold;">Emplacado</span><i class="icon-film"></i></a><br />
                    <?php                
            }
            else {                
                if(sizeof($emplacado)==0)
                {
                    ?>
                   <a href="<?php echo base_url()?>produccion/emplacado/1/<?php echo $dato->id?>/<?php echo $pagina?>/<?php echo $not->id_ot?>" title="Emplacado"><span style="font-size: 10px;color:red; font-weight: bold;">Emplacado</span><i class="icon-film"></i></a><br />
                    <?php
                }else
                {
                    ?>
                    <a href="<?php echo base_url()?>produccion/emplacado/1/<?php echo $dato->id?>/<?php echo $pagina?>/<?php echo $not->id_ot?>" title="Emplacado"><span style="font-size: 10px;color:green; font-weight: bold;">Emplacado</span><i class="icon-film"></i></a><br />

                    <?php
                }
            }   
            ?>
         
            <?php 
            if(sizeof($troquelado)==0)
            {
                ?>
               <a href="<?php echo base_url()?>produccion/troquelado/1/<?php echo $dato->id?>/<?php echo $pagina?>/<?php echo $not->id_ot?>" title="Troquelado"><span style="font-size: 10px;color:red; font-weight: bold;">Troquelado</span><i class="icon-film"></i></a><br />
                <?php
            }else
            {
                ?>
                <a href="<?php echo base_url()?>produccion/troquelado/1/<?php echo $dato->id?>/<?php echo $pagina?>/<?php echo $not->id_ot?>" title="Troquelado"><span style="font-size: 10px;color:green; font-weight: bold;">Troquelado</span><i class="icon-film"></i></a><br />
                
                <?php
            }
            ?>
            
             <?php 
            if(sizeof($desgajado)==0)
            {
                ?>
               <a href="<?php echo base_url()?>produccion/desgajado/1/<?php echo $dato->id?>/<?php echo $pagina?>/<?php echo $not->id_ot?>" title="Desgajado"><span style="font-size: 10px;color:red; font-weight: bold;">Desgajado</span><i class="icon-film"></i></a><br />
                <?php
            }else
            {
                ?>
                <a href="<?php echo base_url()?>produccion/desgajado/1/<?php echo $dato->id?>/<?php echo $pagina?>/<?php echo $not->id_ot?>" title="Desgajado"><span style="font-size: 10px;color:green; font-weight: bold;">Desgajado</span><i class="icon-film"></i></a><br />
                
                <?php
            }
            ?>
            
            <?php 
            if(sizeof($talleres_externos)==0)
            {
                ?>
               <a href="<?php echo base_url()?>produccion/talleres_externos/1/<?php echo $dato->id?>/<?php echo $pagina?>/<?php echo $not->id_ot?>" title="Talleres Externos"><span style="font-size: 10px;color:red; font-weight: bold;">Talleres Externos</span><i class="icon-film"></i></a><br />
                <?php
            }else
            {
                ?>
                <a href="<?php echo base_url()?>produccion/talleres_externos/1/<?php echo $dato->id?>/<?php echo $pagina?>/<?php echo $not->id_ot?>" title="Talleres Externos"><span style="font-size: 10px;color:green; font-weight: bold;">Talleres Externos</span><i class="icon-film"></i></a><br />
                
                <?php
            }
            ?>
           
             <?php 
            if(sizeof($pegado)==0)
            {
                ?>
               <a href="<?php echo base_url()?>produccion/pegado/1/<?php echo $dato->id?>/<?php echo $pagina?>/<?php echo $not->id_ot?>" title="Pegado"><span style="font-size: 10px;color:red; font-weight: bold;">Pegado</span><i class="icon-film"></i></a><br />
                <?php
            }else
            {
                ?>
                <a href="<?php echo base_url()?>produccion/pegado/1/<?php echo $dato->id?>/<?php echo $pagina?>/<?php echo $not->id_ot?>" title="Pegado"><span style="font-size: 10px;color:green; font-weight: bold;">Pegado</span><i class="icon-film"></i></a><br />
                
                <?php
            }
            ?>
            <?php 
            if(sizeof($bodega)==0)
            {
                ?>
               <a href="<?php echo base_url()?>produccion/bodega/1/<?php echo $dato->id?>/<?php echo $pagina?>/<?php echo $not->id_ot?>" title="Bodega"><span style="font-size: 10px;color:red; font-weight: bold;">Bodega</span><i class="icon-film"></i></a><br />
                <?php
            }else
            {
                ?>
                <a href="<?php echo base_url()?>produccion/bodega/1/<?php echo $dato->id?>/<?php echo $pagina?>/<?php echo $not->id_ot?>" title="Bodega"><span style="font-size: 10px;color:green; font-weight: bold;">Bodega</span><i class="icon-film"></i></a><br />
                
                <?php
            }
            ?>
 <?php 
            if(sizeof($bodega)==0)
            {
                ?>
               <a href="<?php echo base_url()?>produccion/despacho/1/<?php echo $dato->id?>/<?php echo $pagina?>/<?php echo $not->id_ot?>" title="Despacho"><span style="font-size: 10px;color:red; font-weight: bold;">Despacho</span><i class="icon-film"></i></a><br />
                <?php
            }else
            {
                ?>
                <a href="<?php echo base_url()?>produccion/despacho/1/<?php echo $dato->id?>/<?php echo $pagina?>/<?php echo $not->id_ot?>" title="Despacho"><span style="font-size: 10px;color:green; font-weight: bold;">Despacho</span><i class="icon-film"></i></a><br />
                
                <?php
            }}
            ?>
        </td>
        <td style="text-align: center;">
           
  <?php if ($fotomecanica->pdf_imagen!=""){ ?>
  <!--?php if ($fotomecanica2->colores > 0){ ?-->  
        <a href='<?php echo base_url().$this->config->item('direccion_pdf').$fotomecanica->pdf_imagen?>' target="_blank"><img src="<?php echo base_url()."public/backend/img/"?>pdf.png" alt="PDF Cliente" title="PDF imagen a imprimir"></a>
            <?php } else { ?>    
        <!-- img src="<?php echo base_url()."public/backend/img/"?>close_16.png" alt="No se Imprime el PDF" title="No se Imprime el PDF"-->        
            <?php } ?>                <br />
  <?php if ($archivo_cliente->archivo!=""){ ?>
        <a href='<?php echo base_url().$this->config->item('direccion_pdf').$archivo_cliente->archivo ?>' target="_blank"><img src="<?php echo base_url()."public/backend/img/"?>pdf.png" alt="PDF Cliente" title="PDF Cliente"></a>
            <?php } else { ?>    
        <!-- img src="<?php echo base_url()."public/backend/img/"?>close_16.png" alt="No se Imprime el PDF" title="No se Imprime el PDF" -->
            <?php } ?>                <br />
            <?php if ($ing->archivo!=""){ ?>
        <a href='<?php echo base_url().$this->config->item('direccion_pdf').$ing->archivo ?>' target="_blank"><img src="<?php echo base_url()."public/backend/img/"?>pdf.png" alt="PDF Revisión Ingenieria" title="PDF Revisión Ingenieria"></a>
            <?php } else { ?>    
        <img src="<?php echo base_url()."public/backend/img/"?>close_16.png" alt="No existe PDF de  Revisión Ingenieria" title="No existe PDF de  Revisión Ingenieria">
            <?php } ?>                <br />
            <?php if ($orden->archivo!=""){ ?>
        <a href='<?php echo base_url().$this->config->item('direccion_pdf').$orden->archivo ?>' target="_blank"><img src="<?php echo base_url()."public/backend/img/"?>pdf.png" alt="PDF Orden de Compra" title="PDF Orden de Compra"></i></a>
            <?php } else { ?>    
        <img src="<?php echo base_url()."public/backend/img/"?>close_16.png" alt="No existe PDF de Orden de Compra" title="No existe PDF de Orden de Compra">
            <?php } ?>  
            <?php if ($orden->id_cotizacion!=""){ ?>
        <a href="<?php echo base_url()?>cotizaciones/hoja_de_costos/<?php echo $orden->id_cotizacion?>/<?php echo $orden->id?>" target="_blank"><img src="<?php echo base_url()."public/backend/img/"?>pdf.png" alt="Hoja de Costos" title="Hoja de Costos"></i></a>
            <?php } else { ?>    
        <img src="<?php echo base_url()."public/backend/img/"?>close_16.png" alt="No existe la hoja de costos" title="No existe la hoja de costos">
            <?php } ?>                           
            <?php if ($orden_produccion->id!=""){ ?>
        <a href="<?php echo base_url()?>ordenes/pdf_orden/<?php echo $orden->id_cotizacion?>/<?php echo $orden->id?>" target="_blank"><img src="<?php echo base_url()."public/backend/img/"?>pdf.png" alt="PDF Orden de Producción" title="PDF Orden de Producción"></i></a>
            <?php } else { ?>    
        <img src="<?php echo base_url()."public/backend/img/"?>close_16.png" alt="No existe PDF de PDF Orden de Producción" title="No existe PDF de Orden de Producción">
            <?php } ?>                           
            </td>
             <td style="text-align: center;">
            <a href="<?php echo base_url()?>produccion/pendientes_fotomecanica/<?php echo $dato->id?>" title="Pendientes Fotomecánica" class="fancybox fancybox.ajax">Pendientes Fotomecánica</a>   
            </td>
<!--             <td style="text-align: center;">
                 <?php
//                  if($dato->vigencia==0){
//                  echo '<label style="background:red;color:white; height: 20px;text-align: center; vertical-align: center;width: 50px"  data-toggle="modal" data-target="#myModal">Nula</label>';    
//                  }
//                  if($dato->vigencia==1){
//                  echo '<label style="background:green;color:white; height: 20px;text-align: center; vertical-align: center;width: 50px"  data-toggle="modal" data-target="#myModal">Activa</label>';    
//                  }
//                  if($dato->vigencia==2){
//                  echo '<label style="background:orange;color:white; height: 20px;text-align: center; vertical-align: center;width: 50px"  data-toggle="modal" data-target="#myModal">Caduca</label>';   
//                  }
//                  if($dato->vigencia==3){
//                  echo '<label style="background:blue;color:white; height: 20px;text-align: center; vertical-align: center;width: 50px"  data-toggle="modal" data-target="#myModal">Prueba</label>';     
//                  }
//                  if($dato->vigencia==4){
//                  echo '<label style="background:black;color:white; height: 20px;text-align: center; vertical-align: center;width: 50px"  data-toggle="modal" data-target="#myModal">Cerrada por PT</label>';    
//                  }
                  ?>
            </td>-->
             <td style="text-align: center;">
                 <?php  if($fotomecanica->situacion=="Liberada" || sizeof($control_cartulina) > 0 || sizeof($control_liner) > 0 || sizeof($control_onda) > 0 || sizeof($confeccion_molde_troquel) > 0 || sizeof($corte_cartulina) > 0 || sizeof($imprenta_programacion) > 0 || sizeof($imprenta_produccion) > 0 || sizeof($servicios) > 0 || sizeof($corrugado) > 0 || sizeof($emplacado) > 0 || sizeof($troquelado) > 0 || sizeof($desgajado) > 0 || sizeof($talleres_externos) > 0 || sizeof($pegado) > 0 || sizeof($bodega) > 0){ 
                 //echo '<label style="background:green;color:white; height: 20px;text-align: center; vertical-align: center;width: 50px">Mod</label>'; ?>
                 <?php }else{ ?>
                 <!--<button type="button" class="" style="background-color: #ffcc33; border-radius: 5px; border-style: none" data-toggle="modal" data-target="#myModal" onclick="reversar(<?php //echo $dato->id ?>)">Rev</button>-->
           <?php } ?>
                 <button type="button" class="" style="background-color: #ffcc33; border-radius: 5px; border-style: none" data-toggle="modal" data-target="#myModal" onclick="reversar(<?php echo $dato->id ?>)">Rev</button>
             </td>
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
          <h4 class="modal-title">Revisar la orden <b id="nro_orden_modal"></b></h4>
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
            
            <button type="submit" class="btn btn-default">Si, quiero revisar</button>
            <button id="cerrar_modal_orden" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
          </form>
      </div>
    </div>
  </div>
   <!-- Modal -->
   <div class="modal fade" id="myModalxxxx" role="confirm">
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

<!--     <tr>
        <td colspan="10" style="text-align: right;">
        <?php// echo $this->layout->element('admin_paginador');
        //echo 'Hola'.$fotomecanica->materialidad_datos_tecnicos;       ?>
        </td>
    </tr>-->

<script type="text/javascript">
$(document).ready(function() {
    $(".fancybox").fancybox({
        openEffect  : 'none',
        closeEffect : 'none'
    });
        
        $("#datatable").DataTable({
            
        });
});
</script>
<script type = 'text/javascript' src = "<?php echo base_url(); ?>js/mis_funciones.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>public/frontend/js/fnc_reving.js"></script>
<script type = 'text/javascript' src = "<?php echo base_url(); ?>public/frontend/bootstrap_file_input/"></script>
<link href="<?php echo base_url(); ?>public/frontend/bootstrap_file_input/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
<script src="<?php echo base_url(); ?>public/frontend/bootstrap_file_input/js/plugins/piexif.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>public/frontend/bootstrap_file_input/js/plugins/sortable.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>public/frontend/bootstrap_file_input/js/plugins/purify.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>public/frontend/bootstrap_file_input/js/fileinput.min.js"></script>
<script src="<?php echo base_url(); ?>public/frontend/bootstrap_file_input/themes/fa/theme.js"></script>
<script src="<?php echo base_url(); ?>public/frontend/bootstrap_file_input/js/locales/es.js"></script>
 <style type="text/css">
        .chosen-container-single .chosen-single{
    display: block;
    width: 70% !important;
    height: 100%;
    background: url('chosen-sprite.png') no-repeat 0px 2px;
}
.cliente{
    width: 70% !important;
}

.chosen-container .chosen-single{
    width: 70% !important;
}
.chosen-container .cli{
    width: 400px !important;
}
#molde_generico_chosen{
    width: 70% !important;
}

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

 
        .chosen-container-single .chosen-single{
    display: block;
    width: 70% !important;
    height: 100%;
    background: url('chosen-sprite.png') no-repeat 0px 2px;
}

#grupos{
    width: 800px;
    z-index: 9000;
    margin-top:50px;
    position: absolute;
    margin-left: 920px;
}
#grupos table{
    font-size: 11px;
    width: 580px;
}

#grupos table tr td{
    padding: 3px;
}

#grupos .title{
    text-align:center; color:white; font-weight: bold; background-color: #004c68;
}
</style>

    <script type="text/javascript">
        $('.chosen-single').chosen({
    width: "60%"
});
        </script>    
         <style type="text/css">
        .chosen-container-single .chosen-single{
    display: block;
    width: 70% !important;
    height: 100%;
    background: url('chosen-sprite.png') no-repeat 0px 2px;
}


.chosen-container{
    width: 800px !important;
}
#molde_generico_chosen{
    width: 100% !important;
}
</style>
    <script type="text/javascript">
        $('.chosen-single').chosen({
    width: "70%"
});
        </script>
<?php $fileerror = $this->session->flashdata('fileerror');?>
<?php if($fileerror==1 || $_POST['fileerror']==1){?>
<div id="pdfmalo" class="well well-small"><button type="button" class="close" data-dismiss="alert">x</button><ul><li>El archivo <strong>PDF</strong> sobrepasa el tamaño estimado de 1MB.</li>
</ul></div>
<?php } ?>
  <?php 

function getField($campo,$datos,$ing)
	{
		$listo=false;
		foreach ($ing as $key => $value) {

		//print_r(strrpos($key,$campo));
		if (strpos($key,$campo) !== false && strrpos($key,$campo)<2 && (strlen($key)<=strlen($campo))) {
			//print_r($value);//do something with the page count
			$listo=true;
			print_r($value);
			}
			
		}
	
		if($listo) return "";

		foreach ($datos as $key => $value) {

		//print_r(strrpos($key,$campo));
		if (strpos($key,$campo) !== false && strrpos($key,$campo)<2 && (strlen($key)<=strlen($campo))) {
			print_r($value);//do something with the page count  	
			}
			
		}
	}
        $usuario=$this->usuarios_model->getUsuariosPorId($ing->quien);
        
?>
<?php $this->layout->element('admin_mensaje_validacion'); ?>
        <style>
            .tablita{background-color: #fff; border: 0px;}
            .tablita tr:hover { background-color: #fff; border: 0px;}
            .tablita td { border: 0px;}
        </style>
<div id="contenidos">
<?php echo form_open_multipart(null, array('class' => 'form-horizontal','name'=>'form','id'=>'form')); ?>
<!-- Migas -->
    <ol  class= "breadcrumb" >  
      <li><a href="<?php echo base_url()?>cotizaciones/index/<?php echo $pagina ?>">Cotizaciones &gt;&gt;</a></li>
      <li><a href="<?php echo base_url()?>cotizaciones/search_cot/<?php echo $id?>">Volver&gt;&gt;</a></li>
      <li>Revisión Ingeniería</li>
    </ol>
   <!-- /Migas -->
   <!-- Indicador de colores -->
   <div>
        <span style="color: #ff0000; font-size: 12px;"><B>Activo</B></span>->        
        <span style="color: #2fa4e7; font-size: 12px;"><B>Pendiente</B></span>->
        <span style="color: orange; font-size: 12px;"><B>Pendiente por Liberar</B> </span>->
        <span style="color: green; font-size: 12px;"><B>Liberado</B> </span>->
        <span style="color: black; font-size: 12px;"><B>No corresponde</B> </span>        
    </div>
   <?php $glosa=$this->produccion_model->getFotomecanicaGlosa($datos->id);?>
   <!-- /fin de indicador de colores -->
	<div class="page-header"><h3>Revisión Ingeniería</h3></div>
        <?php if($ing->estado==1){ ?>        
        <div style="background-color: #ec5c00; color:white; width: 100%;">&nbsp;&nbsp;Revisión Ingeniería ya fue liberada en la fecha: <?php echo $datos->fecha?> por <?php echo $usuario->nombre;?></div>
        <?php } //elseif($ing->estado==0){ ?>        
        <?php if($ing->estado==2){ ?>        
        <div style="background-color: #ec5c00; color:white; width: 100%;">&nbsp;&nbsp;Revisión Fotomecánica Rechazó por: <?php echo $glosa->glosa;?></div>
        <?php } //elseif($ing->estado==0){ ?>        
        <?php if($datos->rev==1){ ?>        
        <div style="background-color: #ec5c00; color:white; width: 100%;">&nbsp;&nbsp;Pasó a revisión de molde en fecha: <?php echo $datos->fecha_revision_molde;?></div>
        <?php } //elseif($ing->estado==0){ ?>        
        
        <div id="mensajeajaxarriba"></div>
        <span class="ir-arriba2 icon-arrow-up">↓</span>
        <!--<div style="background-color: #00d6ec; color:white; width: 100%;">&nbsp;&nbsp;Revisión Ingeniería ya fue Guardada en la fecha: <?php echo $datos->fecha?> por <?php echo $usuario->nombre;?></div>-->
        <?php //} ?>      
        <?php if($datos->ot_antigua!=""){ ?>        
        <div style="background-color: red; color:white; width: 100%;">&nbsp;&nbsp;Orden Migrada de Sistema Viejo: <?php echo $datos->fecha?>...</div>
        <?php } ?>   
        <?php $moldes2=$this->moldes_model->getMoldesPorId($datos->numero_molde); 
                $clientes=$this->clientes_model->getClientesNormal();
                 if($datos->id_cliente==3000)
        {
            $cliente=$datos->nombre_cliente;
        }else
        {
            $cli=$this->clientes_model->getClientePorIdBasico($datos->id_cliente);
            $cliente=$cli->razon_social;
        }
        ?>
        <table class="tablita table-no-bordered">
        <tr>
            <td> <p>
                <table>
                    <tr>
                        <td colspan="2" <?php if($moldes2->tipo=='Exclusivo'){ echo 'style="background-color: orange;color:white;"'; } ?>><?php if($moldes2->tipo=='Exclusivo'){echo 'No se puede modificar el cliente por tener un molde "Exclusivo, debe cambiar el molde Nro '. $moldes2->id.' a generico y recordarlo para luego reasignar este mismo molde en la Revision Ingenieria"';}?></td>
                    </tr>
                    <tr>
                        <td><?php if($moldes2->tipo=='Exclusivo'){ echo "";}else{ ?>
                        Clientes: <?php } ?>
                        </td>
                        <td><?php if($moldes2->tipo=='Exclusivo'){ ?>
                            <input type="hidden" name="cliente" value="<?php echo $datos->id_cliente;?>">
                            <?php }else{ ?>
                            <select name="cliente" class="chosen-select cli">
                         <option value="0">Seleccione.....</option>
                <?php
                
                foreach($clientes as $cliente)
                {
                    ?>
                         <option value="<?php echo $cliente->id?>" <?php if($datos->id_cliente==$cliente->id){echo 'selected="selected"';}?>><?php echo $cliente->razon_social?></option>
                    <?php
                }
                ?>
                    </select> 
                            <?php } ?>
                        </td>
                    </tr>
                </table>
        <ul>
        <?php
         if($datos->id_cliente==3000)
        {
            $cliente=$datos->nombre_cliente;
        }else
        {
            $cli=$this->clientes_model->getClientePorIdBasico($datos->id_cliente);
            $cliente=$cli->razon_social;
        }
        
        if($datos->id_cliente_sec!="" && $datos->id_cliente_sec!=0){
        $cli_sec=$this->clientes_model->getClientePorIdBasico($datos->id_cliente_sec);
        $cliente_sec=$cli_sec->razon_social;
        }
        $vendedor=$this->usuarios_model->getUsuariosPorId($datos->id_vendedor);
        $trazadosing=$this->trazados_model->getTrazadosPorId($datos->trazado);
        //print_r($trazadosing);
        //echo $trazadosing->archivo;
        ?>
            <li>Cliente : <?php echo $cliente ?></li>
            <?php if($datos->id_cliente_sec!="" && $datos->id_cliente_sec!=0){ ?>
            <li>Cliente Secundario: <?php echo $cliente_sec ?></li>
            <?php } ?>
            <li>Cotización número : <?php echo $id ?></li>
            <!--<li>Condicion de Producto : <?php //echo $datos->condicion_del_producto." <a data-toggle='modal' data-target='#cambiar_condicion' class='fancybox fancybox.ajax'><img width='25px' src='".base_url()."public/frontend/images/edit.png' class='img_16' /></a>" ?></li>-->
            <li>Condicion de Producto : <?php echo $datos->condicion_del_producto; ?></li>
            <li>Fecha : <?php echo fecha($datos->fecha) ?></li>
            <li>Vendedor : <?php echo $vendedor->nombre ?></li>
            <?php if($datos->trazado!=""){ ?>
            <li>Nro Trazado: <?php echo $datos->trazado ?></li>
            <?php } ?>
            <li>Liberado: <?php echo $datos->fecha ?></li>
            <li>Retira Cliente: <?php if($datos->retira_cliente=='NO' || $datos->retira_cliente==''){echo "No, Lo Despacha la Empresa";}else{echo "Si, Retira el Cliente";}?></li>
            <li>Despacho Fuera de Santiago: <?php if($datos->despacho_fuera_de_santiago=='SI'){echo "SI";}else{echo "NO";}?></li>
            <li>Distancia: <?php if($datos->despacho_fuera_de_santiago=='SI'){
     switch ($datos->distancia) {
         case 1:
             echo "50 - 120 Km";
             break;
         
         case 2:
             echo "121 - 200 Km";
             break;
         
         case 3:
             echo "201 - 400 Km";
             break;
         
         case 4:
             echo "400 o mas Km";
             break;

         default:
             break;
     }               
            }else{
                echo "NO";
                
            }?>
            </li>
            <li>Total o Parcial: <?php if($datos->tota_o_parcial=='Parcial'){
                echo "Parcial";
            }else{
                echo "Total";
            }
            ?>
            </li>
            <?php if($datos->tota_o_parcial=='Parcial'){
                echo "<li>Despachos: ".$datos->cantidad_de_despachos." Despachos</li>";
            }
            ?>
            </li>
        </ul>
                </p>  
            </td>
            <td style="width:500px">
                
            </td>
            <td>
                 <h3>Detalles de Despacho</h3>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Retira Cliente</label>
		<div class="controls">
            <select name="retira_cliente">
                <option value="">Seleccione.....</option>                
                <?php  if (sizeof($datos)>0) {   ?>
                    <option value="NO" <?php if($datos->retira_cliente=="SI"){echo 'selected="true"';}?>>SI, Retira Cliente</option>
                    <option value="SI" <?php if($datos->retira_cliente=="NO"){echo 'selected="true"';}?>>Despacho Empresa</option>                    
                <?php } else {?>                    
                    <option value="SI" <?php if($_POST["retira_cliente"]=="SI"){echo 'selected="true"';}?>>SI, Retira Cliente</option>
                    <option value="NO" <?php if($_POST["retira_cliente"]=="NO"){echo 'selected="true"';}?>>Despacho Empresa</option>
                <?php } ?>                  
            </select>
        
		</div>
	</div>
    <div class="control-group">
		<label class="control-label" for="usuario">Despacho Fuera de Santiago</label>
		<div class="controls">
                <select name="despacho_fuera_de_santiago" onchange="distanciakm(this.value)">
                <option value="">Seleccione.....</option>                
                <?php  if (sizeof($datos)>0) {   ?>
                        <option value="NO" <?php if($datos->despacho_fuera_de_santiago=="NO"){echo 'selected="true"';}?>>NO</option>
                        <option value="SI" <?php if($datos->despacho_fuera_de_santiago=="SI"){echo 'selected="true"';}?>>SI</option>                    
                <?php } else {?>                    
                        <option value="NO" <?php if(($_POST["despacho_fuera_de_santiago"])=="NO"){echo 'selected="selected"';}?>>NO</option>
                        <option value="SI" <?php if(($_POST["despacho_fuera_de_santiago"])=="SI"){echo 'selected="selected"';}?>>SI</option>
                <?php } ?>   
            </select>
        
		</div>
	</div>
    <div class="control-group" id="distanciadiv" style="display:<?php if($datos->distancia==''){echo 'none';}else{echo 'block';}?>;">
		<label class="control-label" for="usuario">Rango de Distancia: Entre </label>
		<div class="controls">
                <div id="mostrar_texto_pieza_especial">
                    <select name="distancia" id="distancia">
                        <?php  if (sizeof($datos)>0) {   ?>
                    <option value="" <?php if($datos->distancia==""){echo 'selected="true"';}?>>Seleccione.....</option>
                    <option value="1" <?php if($datos->distancia=="1"){echo 'selected="true"';}?>>50 - 120 km</option>
                    <option value="2" <?php if($datos->distancia=="2"){echo 'selected="true"';}?>>121 - 200 km</option>                    
                    <option value="3" <?php if($datos->distancia=="3"){echo 'selected="true"';}?>>201 - 400 km</option>                    
                    <option value="4" <?php if($datos->distancia=="4"){echo 'selected="true"';}?>>Mas de 400 km</option>                    
                <?php } else {?>                    
                    <option value="" <?php if($_POST["distancia"]==""){echo 'selected="true"';}?>>seleccione.....</option>
                    <option value="1" <?php if($_POST["distancia"]=="1"){echo 'selected="true"';}?>>50 - 120 km</option>
                    <option value="2" <?php if($_POST["distancia"]=="2"){echo 'selected="true"';}?>>121 - 200 km</option>
                    <option value="3" <?php if($_POST["distancia"]=="3"){echo 'selected="true"';}?>>201 - 400 km</option>
                    <option value="4" <?php if($_POST["distancia"]=="4"){echo 'selected="true"';}?>>Mas de 400</option>
                <?php } ?>      
                    </select>
                </div>
                </div>
	</div>
      
      <div class="control-group">
		<label class="control-label"  for="usuario">Total o Parcial</label>
		<div class="controls">
                <select name="tota_o_parcial" id="tota_o_parcial" onchange="fn_cb_totalOparcial(this.value,'cantidadesDespacho')">
                <option value="">Seleccione.....</option>       
                <?php  if (sizeof($datos)>0) {   ?>
                    <option value="Total" <?php if($datos->tota_o_parcial=="Total"){echo 'selected="true"';}?>>Total</option>
                    <option value="Parcial" <?php if($datos->tota_o_parcial=="Parcial"){echo 'selected="true"';}?>>Parcial</option>
<!--                    <option value="despachos semanales" <?php //if($datos->tota_o_parcial=="despachos semanales"){echo 'selected="true"';}?>>despachos semanales</option>
                    <option value="despachos mensuales" <?php //if($datos->tota_o_parcial=="despachos mensuales"){echo 'selected="true"';}?>>despachos mensuales</option>
                    <option value="despachos bimensuales" <?php //if($datos->tota_o_parcial=="despachos bimensuales"){echo 'selected="true"';}?>>despachos bimensuales</option>-->
                    <!--<option value="despachos trimestrales" <?php //if($datos->tota_o_parcial=="despachos trimestrales"){echo 'selected="true"';}?>>despachos trimestrales</option>-->                        
                <?php } else {?>                    
                    <option value="Total" <?php if($_POST["tota_o_parcial"]=="Total"){echo 'selected="true"';}?>>Total</option>
                    <option value="Parcial" <?php if($_POST["tota_o_parcial"]=="Parcial"){echo 'selected="true"';}?>>Parcial</option>
<!--                    <option value="despachos semanales" <?php// if($_POST["tota_o_parcial"]=="despachos semanales"){echo 'selected="true"';}?>>despachos semanales</option>
                    <option value="despachos mensuales" <?php //if($_POST["tota_o_parcial"]=="despachos mensuales"){echo 'selected="true"';}?>>despachos mensuales</option>
                    <option value="despachos bimensuales" <?php //if($_POST["tota_o_parcial"]=="despachos bimensuales"){echo 'selected="true"';}?>>despachos bimensuales</option>-->
                    <!--<option value="despachos trimestrales" <?php //if($_POST["tota_o_parcial"]=="despachos trimestrales"){echo 'selected="true"';}?>>despachos trimestrales</option>-->
                <?php } ?>                     

            </select>
        
		</div>
	</div>
    
       <div class="control-group" id="producto">
           <div id="cantidadesDespacho"  <?php if($datos->tota_o_parcial!='Parcial'){echo 'style="display: none;"';} ?>>
		<label class="control-label" id = "lblCantidadesTotalParcial" for="usuario">Cantidad de Despachos (Si es Parcial)</label>
		<div class="controls" >
                <?php  //if (sizeof($datos)>0) {   ?>
			<!--<input type="text" value="<?php// echo $datos->can_despacho_1?>" name="can_despacho_1" style="width: 100px;" id="can_despacho1" onkeypress="return soloNumeros(event)" placeholder="%" onblur="validaParcial();" /> - <input type="text" value="<?php echo $datos->can_despacho_2?>" name="can_despacho_2" style="width: 100px;" id="can_despacho_2" onkeypress="return soloNumeros(event)" placeholder="%" onblur="validaParcial();" /> - <input type="text" value="<?php echo $datos->can_despacho_3?>" name="can_despacho_3" style="width: 100px;" id="can_despacho_3" onkeypress="return soloNumeros(event)" placeholder="%" onblur="validaParcial();" />-->
                <?php //} else {?>                    
			<!--<input type="text" value="<?php// echo $_POST["can_despacho_1"]?>" name="can_despacho_1" style="width: 100px;" id="can_despacho1" onkeypress="return soloNumeros(event)" placeholder="%" onblur="validaParcial();" /> - <input type="text" value="<?php echo $_POST["can_despacho_2"]?>" name="can_despacho_2" style="width: 100px;" id="can_despacho_2" onkeypress="return soloNumeros(event)" placeholder="%" onblur="validaParcial();" /> - <input value="<?php echo $_POST["can_despacho_3"]?>" type="text" name="can_despacho_3" style="width: 100px;" id="can_despacho_3" onkeypress="return soloNumeros(event)" placeholder="%" onblur="validaParcial();" />-->
                <?php// } ?>
                        <select name="cantidad_de_despachos">
                            <option value="1" <?php if($datos->cantidad_de_despachos==1){echo 'selected="selected"';} ?>>1 Despacho</option>
                            <option value="2" <?php if($datos->cantidad_de_despachos==2){echo 'selected="selected"';} ?>>2 Despachos</option>
                            <option value="3" <?php if($datos->cantidad_de_despachos==3){echo 'selected="selected"';} ?>>3 Despachos</option>
                            <option value="4" <?php if($datos->cantidad_de_despachos==4){echo 'selected="selected"';} ?>>4 Despachos</option>
                            <option value="5" <?php if($datos->cantidad_de_despachos==5){echo 'selected="selected"';} ?>>5 Despachos</option>
                            <option value="6" <?php if($datos->cantidad_de_despachos==6){echo 'selected="selected"';} ?>>6 Despachos</option>
                            <option value="7" <?php if($datos->cantidad_de_despachos==7){echo 'selected="selected"';} ?>>7 Despachos</option>
                            <option value="8" <?php if($datos->cantidad_de_despachos==8){echo 'selected="selected"';} ?>>8 Despachos</option>
                        </select>
                </div>
                </div>
        </div>
    <h3>Comercial</h3>
    
     <div class="control-group">
         <div id="sub_forma_pago">
		<label class="control-label" for="usuario" >Forma de Pago <strong style="color: red;">(*)</strong></label>
		<div class="controls" >
			<select name="forma_pago">
                            <option value="0">Seleccione.....</option>
                            <?php
                            $formas=$this->clientes_model->getFormasPago();
                            $cliente_forma_pago_id=$this->clientes_model->getClientePorIdBasico($datos->id_cliente);
                            foreach($formas as $forma)
                            {
                                if (sizeof($datos)>0) {   ?>
                                    <option value="<?php echo $forma->id; ?>" <?php if($datos->forma_pago==$forma->id){echo 'selected="true"';}?>><?php echo $forma->forma_pago; ?></option>
                                <?php } else {?>                    
                                    <option value="<?php echo $forma->id; ?>" <?php if($_POST["forma_pago"]==$forma->id){echo 'selected="selected"';}?>><?php echo $forma->forma_pago; ?></option>
                                <?php } 
                            }
                            ?>
                       </select>
		</div>
	</div>                
    </div>
            </td>
        </tr>
    </table>
         <?php
    if ($this->session->userdata('perfil') != 2) {
        ?>
    <div class="control-group">
            <label class="control-label" for="usuario"><strong>PDF Trazado Fotomecánic</strong>a</label>
            <div class="controls">
                <?php if ($fotomecanica->archivo == "") { ?>
                    <a href='#'>No Existe Archivo de Trazado Fotomecanica</a>
                <?php } else {
                    ?>
                    <a href='<?php echo base_url() . $this->config->item('direccion_pdf') . $fotomecanica->archivo ?>' target="_blank"><i class="icon-search"></i></a>
                <?php } ?>
                <?php //var_dump($ing); ?>
            </div>
        </div>
    <?php } ?>
    <hr />	
    <?php include('plantilla_trazado_ingenieria.php'); ?>
     <div  class="control-group">
        <label class="control-label" for="usuario" data-toggle="modal" data-target="#asociar_grupo"><a href="#" id="link_grupo">Crear Grupo a partir de cotizaciones</a></label>
    </div>
    <!-------------Logica de Grupos------------------------ >
     <?php 
        $existegrupo=$this->grupos_model->getExisteGrupo($id);
        $numero_en_grupo = 0;
        if(sizeof($existegrupo)>0){
            if($existegrupo->idc_01!="" || $existegrupo->idc_01!=null){
                $numero_en_grupo = $numero_en_grupo +1;
                $cotgrupo1=$this->cotizaciones_model->getHojaDeCostosPorIdCotizacionMatriz($existegrupo->idc_01);
                if(sizeof($cotgrupo1)>0){
                    $detallecotgrupo1 = "<tr>";
                    $detallecotgrupo1.= "<td align='center'>$cotgrupo1->id_cotizacion</td>";
                    $detallecotgrupo1.= "<td>$cotgrupo1->producto | C1:$cotgrupo1->cantidad_1,P1:$cotgrupo1->valor_empresa | C2:$cotgrupo1->cantidad_2,P2:$cotgrupo1->valor_empresa_2 | C3:$cotgrupo1->cantidad_3,P3:$cotgrupo1->valor_empresa_3 | C4:$cotgrupo1->cantidad_4,P4:$cotgrupo1->valor_empresa_4</td>";
                    $detallecotgrupo1.= "<td>$cotgrupo1->fecha</td>";
                    $detallecotgrupo1.= "<tr>";
                }else{
                    $detallecotgrupo1.= "<tr><td align='center'>$existegrupo->idc_01 </td><td colspan='2' align='center' align='center'>La cotizacion Nro: $existegrupo->idc_01 aun no tiene Hoja de Costos</td><tr>";
                }
            }
            
            if($existegrupo->idc_02!="" || $existegrupo->idc_02!=null){
                $numero_en_grupo = $numero_en_grupo +1;
                $cotgrupo2=$this->cotizaciones_model->getHojaDeCostosPorIdCotizacionMatriz($existegrupo->idc_02);
                if(sizeof($cotgrupo2)>0){
                    $detallecotgrupo2 = "<tr>";
                    $detallecotgrupo2.= "<td align='center'>$cotgrupo2->id_cotizacion</td>";
                    $detallecotgrupo2.= "<td>$cotgrupo2->producto | C1:$cotgrupo2->cantidad_1,P1:$cotgrupo2->valor_empresa | C2:$cotgrupo2->cantidad_2,P2:$cotgrupo2->valor_empresa_2 | C3:$cotgrupo2->cantidad_3,P3:$cotgrupo2->valor_empresa_3 | C4:$cotgrupo2->cantidad_4,P4:$cotgrupo2->valor_empresa_4</td>";
                    $detallecotgrupo2.= "<td>$cotgrupo2->fecha</td>";
                    $detallecotgrupo2.= "<tr>";
                }else{
                    $detallecotgrupo2.= "<tr><td align='center'>$existegrupo->idc_02 </td><td colspan='2' align='center'>La cotizacion Nro: $existegrupo->idc_02 aun no tiene Hoja de Costos</td><tr>";
                }
            }
            if($existegrupo->idc_03!="" || $existegrupo->idc_03!=null){
                $numero_en_grupo = $numero_en_grupo +1;
                $cotgrupo3=$this->cotizaciones_model->getHojaDeCostosPorIdCotizacionMatriz($existegrupo->idc_03);
                if(sizeof($cotgrupo3)>0){
                    $detallecotgrupo3 = "<tr>";
                    $detallecotgrupo3.= "<td align='center'>$cotgrupo3->id_cotizacion</td>";
                    $detallecotgrupo3.= "<td>$cotgrupo3->producto | C1:$cotgrupo3->cantidad_1,P1:$cotgrupo3->valor_empresa | C2:$cotgrupo3->cantidad_2,P2:$cotgrupo3->valor_empresa_2 | C3:$cotgrupo3->cantidad_3,P3:$cotgrupo3->valor_empresa_3 | C4:$cotgrupo3->cantidad_4,P4:$cotgrupo3->valor_empresa_4</td>";
                    $detallecotgrupo3.= "<td>$cotgrupo3->fecha</td>";
                    $detallecotgrupo3.= "<tr>";
                }else{
                    $detallecotgrupo3.= "<tr><td align='center'>$existegrupo->idc_03 </td><td colspan='2' align='center'>La cotizacion Nro: $existegrupo->idc_03 aun no tiene Hoja de Costos</td><tr>";
                }
            }
            if($existegrupo->idc_04!="" || $existegrupo->idc_04!=null){
                $numero_en_grupo = $numero_en_grupo +1;
                $cotgrupo4=$this->cotizaciones_model->getHojaDeCostosPorIdCotizacionMatriz($existegrupo->idc_04);
                if(sizeof($cotgrupo4)>0){
                    $detallecotgrupo4 = "<tr>";
                    $detallecotgrupo4.= "<td align='center'>$cotgrupo4->id_cotizacion</td>";
                    $detallecotgrupo4.= "<td>$cotgrupo4->producto | C1:$cotgrupo4->cantidad_1,P1:$cotgrupo4->valor_empresa | C2:$cotgrupo4->cantidad_2,P2:$cotgrupo4->valor_empresa_2 | C3:$cotgrupo4->cantidad_3,P3:$cotgrupo4->valor_empresa_3 | C4:$cotgrupo4->cantidad_4,P4:$cotgrupo4->valor_empresa_4</td>";
                    $detallecotgrupo4.= "<td>$cotgrupo4->fecha</td>";
                    $detallecotgrupo4.= "<tr>";
                }else{
                    $detallecotgrupo4.= "<tr><td align='center'>$existegrupo->idc_04 </td><td colspan='2' align='center'>La cotizacion Nro: $existegrupo->idc_04 aun no tiene Hoja de Costos</td><tr>";
                }
            }
            if($existegrupo->idc_05!="" || $existegrupo->idc_05!=null){
                $numero_en_grupo = $numero_en_grupo +1;
                $cotgrupo5=$this->cotizaciones_model->getHojaDeCostosPorIdCotizacionMatriz($existegrupo->idc_05);
                if(sizeof($cotgrupo5)>0){
                    $detallecotgrupo5 = "<tr>";
                    $detallecotgrupo5.= "<td align='center'>$cotgrupo5->id_cotizacion</td>";
                    $detallecotgrupo5.= "<td>$cotgrupo5->producto | C1:$cotgrupo5->cantidad_1,P1:$cotgrupo5->valor_empresa | C2:$cotgrupo5->cantidad_2,P2:$cotgrupo5->valor_empresa_2 | C3:$cotgrupo5->cantidad_3,P3:$cotgrupo5->valor_empresa_3 | C4:$cotgrupo5->cantidad_4,P4:$cotgrupo5->valor_empresa_4</td>";
                    $detallecotgrupo5.= "<td>$cotgrupo5->fecha</td>";
                    $detallecotgrupo5.= "<tr>";
                }else{
                    $detallecotgrupo5.= "<tr><td align='center'>$existegrupo->idc_05 </td><td colspan='2' align='center'>La cotizacion Nro: $existegrupo->idc_05 aun no tiene Hoja de Costos</td><tr>";
                }
            }
            if($existegrupo->idc_06!="" || $existegrupo->idc_06!=null){
                $numero_en_grupo = $numero_en_grupo +1;
                $cotgrupo6=$this->cotizaciones_model->getHojaDeCostosPorIdCotizacionMatriz($existegrupo->idc_06);
                if(sizeof($cotgrupo6)>0){
                    $detallecotgrupo6 = "<tr>";
                    $detallecotgrupo6.= "<td align='center'>$cotgrupo6->id_cotizacion</td>";
                    $detallecotgrupo6.= "<td>$cotgrupo6->producto | C1:$cotgrupo6->cantidad_1,P1:$cotgrupo6->valor_empresa | C2:$cotgrupo6->cantidad_2,P2:$cotgrupo6->valor_empresa_2 | C3:$cotgrupo6->cantidad_3,P3:$cotgrupo6->valor_empresa_3 | C4:$cotgrupo6->cantidad_4,P4:$cotgrupo6->valor_empresa_4</td>";
                    $detallecotgrupo6.= "<td>$cotgrupo6->fecha</td>";
                    $detallecotgrupo6.= "<tr>";
                }else{
                    $detallecotgrupo6.= "<tr><td align='center'>$existegrupo->idc_06 </td><td colspan='2' align='center'>La cotizacion Nro: $existegrupo->idc_06 aun no tiene Hoja de Costos</td><tr>";
                }
            }
            if($existegrupo->idc_07!="" || $existegrupo->idc_07!=null){
                $numero_en_grupo = $numero_en_grupo +1;
                $cotgrupo7=$this->cotizaciones_model->getHojaDeCostosPorIdCotizacionMatriz($existegrupo->idc_07);
                if(sizeof($cotgrupo7)>0){
                    $detallecotgrupo7 = "<tr>";
                    $detallecotgrupo7.= "<td align='center'>$cotgrupo7->id_cotizacion</td>";
                    $detallecotgrupo7.= "<td>$cotgrupo7->producto | C1:$cotgrupo7->cantidad_1,P1:$cotgrupo7->valor_empresa | C2:$cotgrupo7->cantidad_2,P2:$cotgrupo7->valor_empresa_2 | C3:$cotgrupo7->cantidad_3,P3:$cotgrupo7->valor_empresa_3 | C4:$cotgrupo7->cantidad_4,P4:$cotgrupo7->valor_empresa_4</td>";
                    $detallecotgrupo7.= "<td>$cotgrupo7->fecha</td>";
                    $detallecotgrupo7.= "<tr>";
                }else{
                    $detallecotgrupo7.= "<tr><td align='center'>$existegrupo->idc_07 </td><td colspan='2' align='center'>La cotizacion Nro: $existegrupo->idc_07 aun no tiene Hoja de Costos</td><tr>";
                }
            }
            if($existegrupo->idc_08!="" || $existegrupo->idc_08!=null){
                $numero_en_grupo = $numero_en_grupo +1;
                $cotgrupo8=$this->cotizaciones_model->getHojaDeCostosPorIdCotizacionMatriz($existegrupo->idc_08);
                if(sizeof($cotgrupo8)>0){
                    $detallecotgrupo8 = "<tr>";
                    $detallecotgrupo8.= "<td align='center'>$cotgrupo8->id_cotizacion</td>";
                    $detallecotgrupo8.= "<td>$cotgrupo8->producto | C1:$cotgrupo8->cantidad_1,P1:$cotgrupo8->valor_empresa | C2:$cotgrupo8->cantidad_2,P2:$cotgrupo8->valor_empresa_2 | C3:$cotgrupo8->cantidad_3,P3:$cotgrupo8->valor_empresa_3 | C4:$cotgrupo8->cantidad_4,P4:$cotgrupo8->valor_empresa_4</td>";
                    $detallecotgrupo8.= "<td>$cotgrupo8->fecha</td>";
                    $detallecotgrupo8.= "<tr>";
                }else{
                    $detallecotgrupo8.= "<tr><td align='center'>$existegrupo->idc_08 </td><td colspan='2' align='center'>La cotizacion Nro: $existegrupo->idc_08 aun no tiene Hoja de Costos</td><tr>";
                }
            }
            if($existegrupo->idc_09!="" || $existegrupo->idc_09!=null){
                $numero_en_grupo = $numero_en_grupo +1;
                $cotgrupo9=$this->cotizaciones_model->getHojaDeCostosPorIdCotizacionMatriz($existegrupo->idc_09);
                if(sizeof($cotgrupo9)>0){
                    $detallecotgrupo9 = "<tr>";
                    $detallecotgrupo9.= "<td align='center'>$cotgrupo9->id_cotizacion</td>";
                    $detallecotgrupo9.= "<td>$cotgrupo9->producto | C1:$cotgrupo9->cantidad_1,P1:$cotgrupo9->valor_empresa | C2:$cotgrupo9->cantidad_2,P2:$cotgrupo9->valor_empresa_2 | C3:$cotgrupo9->cantidad_3,P3:$cotgrupo9->valor_empresa_3 | C4:$cotgrupo9->cantidad_4,P4:$cotgrupo9->valor_empresa_4</td>";
                    $detallecotgrupo9.= "<td>$cotgrupo9->fecha</td>";
                    $detallecotgrupo9.= "<tr>";
                }else{
                    $detallecotgrupo9.= "<tr><td align='center'>$existegrupo->idc_09 </td><td colspan='2' align='center'>La cotizacion Nro: $existegrupo->idc_09 aun no tiene Hoja de Costos</td><tr>";
                }
            }
            if($existegrupo->idc_10!="" || $existegrupo->idc_10!=null){
                $numero_en_grupo = $numero_en_grupo +1;
                $cotgrupo10=$this->cotizaciones_model->getHojaDeCostosPorIdCotizacionMatriz($existegrupo->idc_10);
                if(sizeof($cotgrupo10)>0){
                    $detallecotgrupo10 = "<tr>";
                    $detallecotgrupo10.= "<td align='center'>$cotgrupo10->id_cotizacion</td>";
                    $detallecotgrupo10.= "<td>$cotgrupo10->producto | C1:$cotgrupo10->cantidad_1,P1:$cotgrupo10->valor_empresa | C2:$cotgrupo10->cantidad_2,P2:$cotgrupo10->valor_empresa_2 | C3:$cotgrupo10->cantidad_3,P3:$cotgrupo10->valor_empresa_3 | C4:$cotgrupo10->cantidad_4,P4:$cotgrupo10->valor_empresa_4</td>";
                    $detallecotgrupo10.= "<td>$cotgrupo10->fecha</td>";
                    $detallecotgrupo10.= "<tr>";
                }else{
                    $detallecotgrupo10.= "<tr><td align='center'>$existegrupo->idc_010 </td><td colspan='2' align='center'>La cotizacion Nro: $existegrupo->idc_010 aun no tiene Hoja de Costos</td><tr>";
                }
            }
        }  
        
        ?>
        <?php if(sizeof($existegrupo)>0) { ?>
    <!-------------Fin de Logica de Grupos----------------->
    <div class="control-group">
         <div id="grupos">
            
    <table class="">
                <tr>
                    <td colspan="3" class="title">Esta cotizacion pertenece a un grupo</td>
                </tr>
                <tr>
                    <td style="width:500px;" colspan="2"><b>Nombre de Grupo:</b> <?php echo $existegrupo->grupo; ?></td>
                    <td><b>Cantidad:</b> <?php echo $numero_en_grupo;  ?></td>
                </tr>
                <tr>
                    <td class="title" colspan="3" >Productos</td>
                </tr>
                <tr>
                    <td colspan="" style="text-align:center"><b>Nro</b></td>
                    <td colspan="" style="text-align:center"><b>Detalle de Cotizacion</b></td>
                    <td colspan="" style="text-align:center" ><b>Fecha</b></td>
                </tr>
                    <?php if($detallecotgrupo1!=""){echo $detallecotgrupo1; } ?>
                    <?php if($detallecotgrupo2!=""){echo $detallecotgrupo2; } ?>
                    <?php if($detallecotgrupo3!=""){echo $detallecotgrupo3; } ?>
                    <?php if($detallecotgrupo4!=""){echo $detallecotgrupo4; } ?>
                    <?php if($detallecotgrupo5!=""){echo $detallecotgrupo5; } ?>
                    <?php if($detallecotgrupo6!=""){echo $detallecotgrupo6; } ?>
                    <?php if($detallecotgrupo7!=""){echo $detallecotgrupo7; } ?>
                    <?php if($detallecotgrupo8!=""){echo $detallecotgrupo8; } ?>
                    <?php if($detallecotgrupo9!=""){echo $detallecotgrupo9; } ?>
                    <?php if($detallecotgrupo10!=""){echo $detallecotgrupo10; } ?>
    </table>
        </div>
    </div>   
        <?php }
        
//if($datos->numero_molde==""){
$moldes2=$this->moldes_model->getMoldesPorId($datos->numero_molde);    
//}else{
//$moldes2=$this->moldes_model->getMoldesPorId($datos->numero_molde);        
//}

?>
	
    <?php
    if ($this->session->userdata('perfil') != 2) {
    ?>
    <div class="control-group">
        <label class="control-label" for="usuario"><strong>PDF Archivo de Información Digital (Cliente)</strong></label>
		<div class="controls">
            <?php
             $archivo_cliente=$this->cotizaciones_model->getArchivoClientePorCotizacion($id);
            ?>
			<?php if ($archivo_cliente->archivo==""){ ?>
			      <a href='#'>No Existe Archivo de Información Digital (Cliente)</a>
		    <?php }
			      else{ ?>
				  <a href='<?php echo base_url().$this->config->item('direccion_pdf').$archivo_cliente->archivo ?>' title="Descargar" target="_blank"><i class="icon-search"></i></a>
				  <?php } ?>
				  <?php //var_dump($ing); ?>
		</div>
	</div>
	<?php }?>
    <hr />
<!--    <div  class="control-group">
        <label class="control-label" for="usuario" data-toggle="modal" data-target="#asociar_grupo"><a href="#" id="link_grupo">Crear Grupo a partir de cotizaciones</a></label>
    </div>-->
    <div id="asociar_grupo" class="modal fade">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Grupo de Cotizaciones </h4>
        </div>
           <style>
td, th {
    border: 1px solid #ddd;
    padding: 8px;
}

tr:nth-child(even){background-color: #f2f2f2;}

tr:hover {background-color: #ddd;}

th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: left;
    background-color: #444;
    color: white;
    height: 5px !important;
}
</style>
    <div class="modal-body">
    <div class="container-fluid">
        <table>
            <tr><td><strong id="mensaje_grupo">Nombre de Grupo</strong></td></tr>
            <tr><td><input type="text" name="nombregrupo" id="nombregrupo" style="width: 452px;" placeholder="Nombre grupo" value="" /></td></tr>
        </table><br />
        <table>
            <tr>
                <th colspan="4" style="background-color: #444; text-align: center;"><span style="color:#fff;">Cotizaciones Asignadas a Grupo</span></th>
            </tr>
            <tr>
                <td>Nro 1</td><td><input type="text" name="grupo" id="nro1" style="width: 155px;" placeholder="nro cotizacion" value="<?php echo $datos->id; ?>" /></td>
                <td>Nro 6</td><td><input type="text" name="grupo" id="nro6" style="width: 155px;" placeholder="nro cotizacion" value="" onkeypress="return soloNumeros(event);"/></td>
            </tr>
            <tr>
                <td>Nro 2</td><td><input type="text" name="grupo" id="nro2" style="width: 155px;" placeholder="nro cotizacion" value=""  onkeypress="return soloNumeros(event);"/></td>
                <td>Nro 7</td><td><input type="text" name="grupo" id="nro7" style="width: 155px;" placeholder="nro cotizacion" value=""  onkeypress="return soloNumeros(event);"/></td>
            </tr>
            <tr>
                <td>Nro 3</td><td><input type="text" name="grupo" id="nro3" style="width: 155px;" placeholder="nro cotizacion" value=""  onkeypress="return soloNumeros(event);"/></td>
                <td>Nro 8</td><td><input type="text" name="grupo" id="nro8" style="width: 155px;" placeholder="nro cotizacion" value=""  onkeypress="return soloNumeros(event);"/></td>
            </tr>
            <tr>
                <td>Nro 4</td><td><input type="text" name="grupo" id="nro4" style="width: 155px;" placeholder="nro cotizacion" value=""  onkeypress="return soloNumeros(event);"/></td>
                <td>Nro 9</td><td><input type="text" name="grupo" id="nro9" style="width: 155px;" placeholder="nro cotizacion" value=""  onkeypress="return soloNumeros(event);"/></td>
            </tr>
            <tr>
                <td>Nro 5</td><td><input type="text" name="grupo" id="nro5" style="width: 155px;" placeholder="nro cotizacion" value=""  onkeypress="return soloNumeros(event);"/></td>
                <td>Nro 10</td><td><input type="text" name="grupo" id="nro10" style="width: 155px;" placeholder="nro cotizacion" value=""  onkeypress="return soloNumeros(event);"/></td>
            </tr>
        </table>
    </div>
    </div>
    </div>
    
        <div class="modal-footer">
            <button type="button" id="crear" style="" class="btn btn-primary" onclick="crear_grupo_cotizacion()">Crear</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
    <div id="cambiar_condicion" class="modal fade">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Cambiar Condicion de Producto </h4>
        </div>
           <style>
td, th {
    border: 1px solid #ddd;
    padding: 8px;
}

tr:nth-child(even){background-color: #f2f2f2;}

tr:hover {background-color: #ddd;}

th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: left;
    background-color: #444;
    color: white;
    height: 5px !important;
}
</style>
    <div class="modal-body">
    <div class="container-fluid">
        <table width="500px">
            <tr><td><strong id="mensaje_grupo">Condicion</strong></td></tr>
                        <tr><td><select style="width:400px">
                                    <option value="Nuevo" <?php if($datos->condicion_del_producto == 'Nuevo'){echo 'selected="selected"';} ?>>Nuevo</option>
                                    <option value="Repetición Sin Cambios" <?php if($datos->condicion_del_producto == 'Repetición Sin Cambios'){echo 'selected="selected"';} ?>>Repetición Sin Cambios</option>
                                    <option value="Repetición Con Cambios" <?php if($datos->condicion_del_producto == 'Repetición Con Cambios'){echo 'selected="selected"';} ?>>Repetición Con Cambios</option>
                    </select></td></tr>
        </table><br />
        
    </div>
    </div>
    </div>
    
        <div class="modal-footer">
            <button type="button" id="crear" style="" class="btn btn-primary" onclick="cambiar_condicion(<?php echo $id ?>)">Cambiar</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
<!--    <br /><br /><br /><br /><br /><br /><br />
<br /><br /><br /><br /><br />-->
<div  class="control-group">
        <label class="control-label" for="usuario" data-toggle="modal" data-target="#comparativa_molde"><a href="#" id="link_grupo2">Comparativa</a></label>
    </div>
<div id="comparativa_molde" class="modal fade" style="width: 1200px;left: 500px;">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">
              <?php if(sizeof($moldes2)>0){echo "Informacion Comparativa del Molde: <span id='anumeromolde'>$moldes2->numero</span> - <span id='anombremolde'>$moldes2->nombre"; }else{echo "Hay que Confeccionar el Molde | Cliente: $cliente"; } ?>
              </h4>
          <input type="hidden" name="numero_de_molde" value="<?php echo $moldes2->numero; ?>" />
        </div>
           <style>
td, th {
    border: 1px solid #ddd;
    padding: 8px;
}

tr:nth-child(even){background-color: #f2f2f2;}

tr:hover {background-color: #ddd;}

th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: left;
    background-color: #444;
    color: white;
    height: 5px !important;
}

.error{
    border:red 2px solid;
}

.check{
    display: none;
}
</style>
<?php include 'valida_trazado_molde.php'; ?>
<div class="modal-body">
    <div class="container-fluid">
        <tabla>
            <tr>
                <td>
                    <span></span>
                </td>
            </tr>
        </tabla>
        <table>
            <tr>
                <th colspan="6" style="background-color: #444; text-align: center;"><span style="color:#fff;">Valores en el Molde</span>
                    </th>
                <th colspan="6" style="background-color: #444; text-align: center;"><span style="color:#fff;">Valores en Ingenieria</span>
                    </th>
            </tr>
            <tr>
                <td colspan="3">Unidades ("Producto Completo") por pliego </td><td colspan="3"><input type="text" name="unidades_por_pliego_molde" id="unidades_por_pliego_molde" style="width: 200px;" placeholder="unidades por pliego" value="<?php echo $moldes2->unidades_productos_completos; ?>"  onkeypress="return soloNumeros(event);"/></td>                
                <td colspan="3">Unidades ("Producto Completo") por pliego </td><td id="uno" colspan="3"><input type="text" name="unidades_por_pliego_ing" id="unidades_por_pliego_ing" style="width: 150px;" placeholder="unidades por pliego" value="<?php echo $ing->unidades_por_pliego; ?>"  onkeypress="return soloNumeros(event);"/>
                <img class="unocheck" style="display:none" src="<?php echo base_url(); ?>public/frontend/images/check.png" width="30px" /></td>
            </tr>
            <tr>
                <td colspan="3">Piezas totales en el pliego ( para desgajado )</td><td colspan="3"><input type="text" name="piezas_totales_molde" id="piezas_totales_molde" style="width: 200px;" placeholder="Piezas totales en el pliego" value="<?php echo $moldes2->piezas_totales; ?>"  onkeypress="return soloNumeros(event);"/></td>
                <td colspan="3">Piezas totales en el pliego ( para desgajado )</td><td id="dos" colspan="3"><input type="text" name="piezas_totales_ing" id="piezas_totales_ing" style="width: 150px;" placeholder="Piezas totales en el pliego" value="<?php echo $ing->piezas_totales_en_el_pliego; ?>"  onkeypress="return soloNumeros(event);"/>
                <img class="doscheck" style="display:none" src="<?php echo base_url(); ?>public/frontend/images/check.png" width="30px" /></td>
            </tr>
            <tr>
                <td colspan="6">Medidas de la Caja en Molde&nbsp;&nbsp;&nbsp;&nbsp;
<!--                <td colspan="2">-->
                &nbsp;L<input type="text" name="mcm1" id="mcm1" style="width: 30px;" placeholder="nro cotizacion" value="<?php echo $moldes2->medidas_de_las_cajas; ?>" />
                &nbsp;A<input type="text" name="mcm2" id="mcm2" style="width: 30px;" placeholder="nro cotizacion" value="<?php echo $moldes2->medidas_de_las_cajas_2; ?>" />
                &nbsp;H<input type="text" name="mcm3" id="mcm3" style="width: 30px;" placeholder="nro cotizacion" value="<?php  echo $moldes2->medidas_de_las_cajas_3;  ?>" />
                &nbsp;AT<input type="text" name="mcm4" id="mcm4" style="width: 30px;" placeholder="nro cotizacion" value="<?php  echo $moldes2->medidas_de_las_cajas_4;  ?>" /></td>
                <td id="tres" colspan="6">Medidas de la Caja en Ingenieria&nbsp;&nbsp;&nbsp;&nbsp;
                <!--<td colspan="2">-->
                &nbsp;L<input type="text" name="mci1" id="mci1" style="width: 30px;" placeholder="nro cotizacion" value="<?php  echo $ing->medidas_de_la_caja; ?>" />
                &nbsp;A<input type="text" name="mci2" id="mci2" style="width: 30px;" placeholder="nro cotizacion" value="<?php echo $ing->medidas_de_la_caja_2; ?>" />
                &nbsp;H<input type="text" name="mci3" id="mci3" style="width: 30px;" placeholder="nro cotizacion" value="<?php echo $ing->medidas_de_la_caja_3; ?>" />
                &nbsp;AT<input type="text" name="mci4" id="mci4" style="width: 30px;" placeholder="nro cotizacion" value="<?php echo $ing->medidas_de_la_caja_4; ?>" />
                <img class="trescheck" style="display:none" src="<?php echo base_url(); ?>public/frontend/images/check.png" width="30px" /></td>
            </tr>
            <tr>
                <td colspan="3">Distancia Cuchillo a Cuchillo</td>
                <td colspan="3"><input type="text" name="ccm1" id="ccm1" style="width: 55px;" placeholder="" value="<?php  echo $moldes2->cuchillocuchillo;  ?>"  onkeypress="return soloNumeros(event);"/> X
                <input type="text" name="ccm2" id="ccm2" style="width: 55px;" placeholder="" value="<?php  echo $moldes2->cuchillocuchillo2; ?>"  onkeypress="return soloNumeros(event);"/></td>
                <td colspan="3">Distancia Cuchillo a Cuchillo</td>
                <td id="cuatro" colspan="3"><input type="text" name="cci1" id="cci1" style="width: 55px;" placeholder="" value="<?php  echo $ing->tamano_cuchillo_1; ?>"   onkeypress="return soloNumerosConPuntos(event);"/> X
                <input type="text" name="cci2" id="cci2" style="width: 55px;" placeholder="" value="<?php  echo $ing->tamano_cuchillo_2; ?>"   onkeypress="return soloNumerosConPuntos(event);"/>
                <img class="cuatrocheck" style="display:none" src="<?php echo base_url(); ?>public/frontend/images/check.png" width="30px" /></td>
            </tr>
            <tr>
                <td colspan="3">Tamaño a imprimir Ancho por Largo (largo a cortar) </td>
                <td colspan="3"><input type="text" name="largo_molde_1" id="largo_molde_1" style="width: 55px;" placeholder="" value="<?php  echo $moldes2->ancho_bobina; ?>"  onkeypress="return soloNumeros(event);"/> X
                <input type="text" name="largo_molde_2" id="largo_molde_2" style="width: 55px;" placeholder="" value="<?php  echo $moldes2->largo_bobina; ?>"  onkeypress="return soloNumeros(event);"/></td>
                <td colspan="3">Tamaño a imprimir Ancho por Largo (largo a cortar) </td>
                <td id="cinco" colspan="3"><input type="text" name="ancho_ing_1" id="ancho_ing_1" style="width: 55px;" placeholder="" value="<?php  echo $ing->tamano_a_imprimir_1; ?>"  onkeypress="return soloNumeros(event);"/> X
                <input type="text" name="largo_ing_2" id="largo_ing_2" style="width: 55px;" placeholder="" value="<?php  echo $ing->tamano_a_imprimir_2; ?>"  onkeypress="return soloNumeros(event);"/>
                <img class="cincocheck" style="display:none" src="<?php echo base_url(); ?>public/frontend/images/check.png" width="30px" /></td>
            </tr>
        </table>
    </div>
    </div>
    </div>
    
        <div class="modal-footer">
            <!--<button type="button" id="crearlo" style="" class="btn btn-primary" value="" onclick="guardarFormularioAdd(this.value);">Modificar en Molde</button>-->
            
            <button type="button" id="crearlo2" style="" class="btn btn-primary" value="" onclick="guardarFormularioAdd2(this.value);">Crear</button>
            
            
            <a href="<?php echo base_url(); ?>moldes/edit/<?php echo $moldes2->id; ?>/0" id="modificarmolde" class="btn btn-primary">Modificar Molde</a>
            <button type="button" id="crearlo" style="" class="btn btn-primary" value="" onclick="guardarFormularioAdd2(this.value);">Crear</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            
        </div>
      </div>
    </div>
    <hr />
    <div class="control-group" id="producto">
		<label class="control-label" for="usuario">OP Asociadas <strong style="color: red;">(*)</strong></label>
		<div class="controls">
                    <select name="cantidad_ordenes" onchange="listaOrdenes('<?php echo base_url()?>ordenes/listado_cotizaciones',this.value,'<?php echo $datos->id_cliente?>','<?php echo $id?>','ordenes_de_producción');">
                       <option value="">Seleccione......</option>    
                        <?php if (sizeof($ing)>0)  { ?>
                            <option value="NO" <?php if($ing->cantidad_ordenes=='NO'){echo 'selected="true"';}?>>NO</option>
                            <option value="SI" <?php if($ing->cantidad_ordenes=='SI'){echo 'selected="true"';}?>>SI</option>
                        <?php } else { ?>
                            <option value="SI" <?php if(isset($_POST["cantidad_ordenes"]) and $_POST["cantidad_ordenes"]=='SI'){echo 'selected="selected"';}?>>SI</option> 
                            <option value="NO" <?php if(isset($_POST["cantidad_ordenes"]) and $_POST["cantidad_ordenes"]=='NO'){echo 'selected="selected"';}?>>NO</option>
                        <?php }  ?>                        

                    </select>
		</div>
	</div>
    
    
     <div class="control-group" id="producto">
		<label class="control-label" for="usuario">Cantidades Cotizadas</label><!--onkeypress="nextOnEnter(this,event);"-->
		<div class="controls">
                    <?php  if (sizeof($datos)>0) {   ?>
                    <input type="text" id="can1" name="can1" style="width: 100px;" id="can1" onkeypress="return soloNumeros(event)" placeholder="Cantidad 1" value="<?php echo $datos->cantidad_1?>" /> - <input type="text" id="can2" name="can2" id="can2" style="width: 100px;" onkeypress="return soloNumeros(event)" placeholder="Cantidad 2" value="<?php echo $datos->cantidad_2?>" /> - <input type="text" name="can3" id="can3" style="width: 100px;" onkeypress="return soloNumeros(event)" placeholder="Cantidad 3" value="<?php echo $datos->cantidad_3?>" /> - <input type="text" name="can4" id="can4" style="width: 100px;" onkeypress="return soloNumeros(event)" placeholder="Cantidad 4" value="<?php echo $datos->cantidad_4?>" />
                    <?php } ?>                        
		</div>
	</div> 
    <div class="control-group">
		<label class="control-label" for="usuario">Acepta Excedentes</label>
		<div class="controls">
		<select name="acepta_excedentes" style="width: 100px;" onchange="aceptaExcedentes();">
                            <option value="">Seleccione.....</option>
                      <?php  if (sizeof($datos)>0) {   ?>
                            <option value="SI" <?php if($datos->acepta_excedentes=="SI"){echo 'selected="true"';}?>>SI</option>
                            <option value="NO" <?php if($datos->acepta_excedentes=="NO"){echo 'selected="true"';}?>>NO</option>
                      <?php } else {?>                    
                            <option value="SI" <?php if(($_POST["acepta_excedentes"]) and $_POST["acepta_excedentes"]=='SI'){echo 'selected="selected"';}?>>SI</option>
                            <option value="NO" <?php if(($_POST["acepta_excedentes"]) and $_POST["acepta_excedentes"]=='NO'){echo 'selected="selected"';}?>>NO</option>
                    <?php } ?>                       

                </select> 
            <span id="acepta_excedentes">Acepta excedentes mas o menos 10%</span>
            <input type="hidden" name="acepta_excedentes_extra" value="Acepta pagar extra por cantidad exacta" readonly="true" />
            
        
		</div>
	</div>
    
    <!--órdenes de producción asociadas-->
    <div id="ordenes_de_producción" class="control-group"></div>
    <!--/órdenes de producción asociadas-->
    
	
	   <div id="div_condicion" style="display: none;">
     <div class="control-group">
		<!--<label class="control-label" for="usuario">Detalle de Cambios</label> -->
		<div class="controls">
			<!--<textarea id="contenido4" name="detalle_cambios" placeholder="Observaciones"><?php //echo set_value('detalle_cambios'); ?></textarea>-->
			
		</div>
	</div>
   </div>
	
	
	   <!--productos asociados--> 
   <div id="productos_asociados">


   </div>
   <!--productos asociados--> 
   <?php// print_r($nombreProducto) //my code is here ?>
   <div class="control-group" id="producto">
		<label class="control-label" for="usuario">Descripción del Producto, se debe revisar <strong style="color: red;">(*)</strong></label>
		<div class="controls">
                    <?php echo $datos->rev; //my code is here ?>
                    <?php if($fotomecanica->condicion_del_producto == 'Repetición Sin Cambios'){ ?>
                    <input style="width: 600px;" type="text" name="producto" readonly="readonly" placeholder="Descripción del Producto" onblur="ValidarNombreProducto();" value="<?php echo getField('producto',$datos,$ing)?>" onkeypress="return alpha_con_numeros(event)" /><a style="color:#BBBBBB"> [<?php echo $datos->producto ?>] </a>
                    <?php }else{ ?>
                    <input style="width: 600px;" type="text" name="producto" <?php  if($nombreProducto->codigo!="" && $datos->rev!=1){echo 'readonly="readonly"';}  ?> placeholder="Descripción del Producto" onblur="ValidarNombreProducto();" value="<?php echo getField('producto',$datos,$ing)?>" onkeypress="return alpha_con_numeros(event)" /><a style="color:#BBBBBB"> [<?php echo $datos->producto ?>] </a>
                    <?php } ?>
                <?php echo "<a>&nbsp;&nbsp;Codigo del Producto: ".$nombreProducto->codigo."</a>"; ?></div>
	</div>
  
  
     <div class="control-group" id="producto">
		<label class="control-label" for="usuario">Medidas de la caja<strong>(centímetros)</strong></label>
		<div class="controls">
                    <?php  //print_r($moldes2); ?>
		<?php if(sizeof($ing) >0) {echo $ing->medidas_de_las_cajas;?>                    
                   L  <input type="text" name="medidas_de_las_cajas"   id="medidas_de_las_cajas"   placeholder="L"  value="<?php if($ing->medidas_de_la_caja==""){echo $moldes2->medidas_de_las_cajas;}else{echo $ing->medidas_de_la_caja;}?>"   style="width: 50px;" onkeypress="return soloNumerosConPuntos(event)" onblur="funcionDeecimales('medidas_de_las_cajas',Formato);" />
                   A  <input type="text" name="medidas_de_las_cajas_2" id="medidas_de_las_cajas_2" placeholder="A"  value="<?php if($ing->medidas_de_la_caja_2==""){echo $moldes2->medidas_de_las_cajas_2;}else{echo $ing->medidas_de_la_caja_2;}?>" style="width: 50px;" onkeypress="return soloNumerosConPuntos(event)" onblur="funcionDeecimales('medidas_de_las_cajas_2',Formato);"/>
                   H  <input type="text" name="medidas_de_las_cajas_3" id="medidas_de_las_cajas_3" placeholder="H"  value="<?php if($ing->medidas_de_la_caja_3==""){echo $moldes2->medidas_de_las_cajas_3;}else{echo $ing->medidas_de_la_caja_3;}?>" style="width: 50px;" onkeypress="return soloNumerosConPuntos(event)" onblur="funcionDeecimales('medidas_de_las_cajas_3',Formato);"/>
                   AT <input type="text" name="medidas_de_las_cajas_4" id="medidas_de_las_cajas_4" placeholder="AT" value="<?php if($ing->medidas_de_la_caja_4==""){echo $moldes2->medidas_de_las_cajas_4;}else{echo $ing->medidas_de_la_caja_4;}?>" style="width: 50px;" onkeypress="return soloNumerosConPuntos(event)" onblur="funcionDeecimales('medidas_de_las_cajas_4',Formato);"/>
                <?php }else {?>  
                   L  <input type="text" name="medidas_de_las_cajas"   id="medidas_de_las_cajas"   placeholder="L"  value="<?php if($moldes2->medidas_de_las_cajas==""){if($datos->estan_los_moldes=="NO" && $datos->existe_trazado=="SI"){echo $trazadosing->medidas_de_las_cajas;}else{echo $_POST["medidas_de_las_cajas"];}}else{if($datos->estan_los_moldes=="NO" && $datos->existe_trazado=="SI"){echo $trazadosing->medidas_de_las_cajas;}else{echo $moldes2->medidas_de_las_cajas;}}?>"   style="width: 50px;" onkeypress="return soloNumerosConPuntos(event)" onblur="funcionDeecimales('medidas_de_las_cajas',Formato);" />
                   A  <input type="text" name="medidas_de_las_cajas_2" id="medidas_de_las_cajas_2" placeholder="A"  value="<?php if($moldes2->medidas_de_las_cajas_2==""){if($datos->estan_los_moldes=="NO" && $datos->existe_trazado=="SI"){echo $trazadosing->medidas_de_las_cajas_2;}else{echo $_POST["medidas_de_las_cajas_2"];}}else{if($datos->estan_los_moldes=="NO" && $datos->existe_trazado=="SI"){echo $trazadosing->medidas_de_las_cajas_2;}else{echo $moldes2->medidas_de_las_cajas_2;}}?>" style="width: 50px;" onkeypress="return soloNumerosConPuntos(event)" onblur="funcionDeecimales('medidas_de_las_cajas_2',Formato);"/>
                   H  <input type="text" name="medidas_de_las_cajas_3" id="medidas_de_las_cajas_3" placeholder="H"  value="<?php if($moldes2->medidas_de_las_cajas_3==""){if($datos->estan_los_moldes=="NO" && $datos->existe_trazado=="SI"){echo $trazadosing->medidas_de_las_cajas_3;}else{echo $_POST["medidas_de_las_cajas_3"];}}else{if($datos->estan_los_moldes=="NO" && $datos->existe_trazado=="SI"){echo $trazadosing->medidas_de_las_cajas_3;}else{echo $moldes2->medidas_de_las_cajas_3;}}?>" style="width: 50px;" onkeypress="return soloNumerosConPuntos(event)" onblur="funcionDeecimales('medidas_de_las_cajas_3',Formato);"/>
                   AT <input type="text" name="medidas_de_las_cajas_4" id="medidas_de_las_cajas_4" placeholder="AT" value="<?php if($moldes2->medidas_de_las_cajas_4==""){if($datos->estan_los_moldes=="NO" && $datos->existe_trazado=="SI"){echo $trazadosing->medidas_de_las_cajas_4;}else{echo $_POST["medidas_de_las_cajas_4"];}}else{if($datos->estan_los_moldes=="NO" && $datos->existe_trazado=="SI"){echo $trazadosing->medidas_de_las_cajas_4;}else{echo $moldes2->medidas_de_las_cajas_4;}}?>" style="width: 50px;" onkeypress="return soloNumerosConPuntos(event)" onblur="funcionDeecimales('medidas_de_las_cajas_4',Formato);"/>
                <?php }?>                     
		</div>
	</div>
    
   
    
    <div class="control-group">
		<label class="control-label" for="usuario">Largo y Ancho del Trazado</label>
		<div class="controls">
		<?php if(sizeof($ing) >0) {?>      
			ALETA<input type="text" name="aleta_pegado" placeholder="Aleta Pegado" onkeypress="return soloNumerosConPuntos(event)" value="<?php echo $ing->aleta_pegado;?>" style="width: 50px;" />
                        L<input type="text" name="largo_1" placeholder="Largo 1" onkeypress="return soloNumerosConPuntos(event)" value="<?php echo $ing->largo_1;?>" style="width: 50px;" />
                        A<input type="text" name="ancho_1" placeholder="Ancho 1" onkeypress="return soloNumerosConPuntos(event)" value="<?php echo $ing->ancho_1;?>" style="width: 50px;" />
                        H<input type="text" name="largo_2" placeholder="Largo 2" onkeypress="return soloNumerosConPuntos(event)" value="<?php echo $ing->largo_2;?>" style="width: 50px;" />
                        AT<input type="text" name="ancho_2" placeholder="Ancho 2" onkeypress="return soloNumerosConPuntos(event)" value="<?php echo $ing->ancho_2;?>" style="width: 50px;" />
                        Total suma : <?php echo number_format($ing->suma_largo_aleta,0,'','.')?>
                <?php } else {?>  
			ALETA<input type="text" name="aleta_pegado" placeholder="Aleta Pegado" onkeypress="return soloNumerosConPuntos(event)" value="<?php echo $_POST["aleta_pegado"];?>" style="width: 50px;" />
                        L<input type="text" name="largo_1" placeholder="Largo 1" onkeypress="return soloNumerosConPuntos(event)" value="<?php echo $_POST["largo_1"];?>" style="width: 50px;" />
                        A<input type="text" name="ancho_1" placeholder="Ancho 1" onkeypress="return soloNumerosConPuntos(event)" value="<?php echo $_POST["ancho_1"];?>" style="width: 50px;" />
                        H<input type="text" name="largo_2" placeholder="Largo 2" onkeypress="return soloNumerosConPuntos(event)" value="<?php echo $_POST["largo_2"];?>" style="width: 50px;" />
                        AT<input type="text" name="ancho_2" placeholder="Ancho 2" onkeypress="return soloNumerosConPuntos(event)" value="<?php echo $_POST["ancho_2"];?>" style="width: 50px;" />
                <?php }?>                      

		</div>
	</div>
    
        <div class="control-group">
        	<label class="control-label" for="usuario">Largo total de la caja</label>
		<div class="controls">
		<?php if(sizeof($ing) >0) {?>     
			<input type="text" name="largo_total_de_la_caja" placeholder="Largo total de la caja" onkeypress="return soloNumeros(event)" value="<?php echo $ing->largo_total_de_la_caja;?>" />
                <?php } else {?>  
			<input type="text" name="largo_total_de_la_caja" placeholder="Largo total de la caja" onkeypress="return soloNumeros(event)" value="<?php echo $_POST["largo_total_de_la_caja"];?>" />
                <?php }?>                      
		</div>    
        </div>
    <h3>Impresion <strong style="color: red;">(*)</strong></h3>
      <?php //print_r($ing);exit(); ?>
     <div class="control-group">
		<label class="control-label" for="usuario">Colores</label>
		<div class="controls">
			<select name="colores" onchange="colores_barniz(this.value);llevaBarnizFotomecanica();">
                <?php
                if($ing->colores=='')
                {
                    $colores=$datos->impresion_colores;
                }else
                {
                    $colores=$ing->colores;
                }
                for($i=0;$i<9;$i++)
                {
                    ?>
                    <option value="<?php echo $i?>" <?php if($colores==$i){echo 'selected="selected"';}?>><?php echo $i?></option>
                    <?php
                }
                ?>
                
                
            </select>
            <?php echo $datos->impresion_colores ?>
		</div>
	</div>
    <!-- Inicio de combo de color modificado -->
    <?php// echo sizeof($ing);?>
    <?php if($datos->condicion_del_producto=="Repetición Con Cambios"){ ?>
   <?php if(sizeof($ing)>0 && $ing->tiene_color_modificado=="SI"){?>
   <div class="control-group">
        <label class="control-label" for="usuario">Tiene Algun Color Modificado<strong style="color: red;">(*)</strong></label>
        <div class="controls">
            <select name="tiene_color_modificado_ing">
            <option value="" <?php echo set_value_select($ing,'tiene_color_modificado_ing',$ing->tiene_color_modificado,'');?>>Seleccione</option>
            <option value="NO" <?php echo set_value_select($ing,'tiene_color_modificado_ing',$ing->tiene_color_modificado,'NO');?>>NO</option>
            <option value="SI" <?php echo set_value_select($ing,'tiene_color_modificado_ing',$ing->tiene_color_modificado,'SI');?>>SI</option>
            </select>
        </div>
    </div>
    <div class="control-group" <?php if($ing->tiene_color_modificado<>'SI'){echo 'hidden=true'; }?> id="numero_color_modificado_ing">
        <label class="control-label" for="usuario">Numero de Colores<strong style="color: red;">(*)</strong></label>
        <div class="controls">
            <select name="numero_color_modificado_ing">
             <?php if (sizeof($ing)>0)  { ?>
            <option value="" <?php if($ing->numero_color_modificado==""){echo "selected='selected'";} ?>>Seleccione</option>
            <option value="1" <?php if($ing->numero_color_modificado=="1"){echo "selected='selected'";} ?>>1</option>
            <option value="2" <?php if($ing->numero_color_modificado=="2"){echo "selected='selected'";} ?>>2</option>
            <option value="3" <?php if($ing->numero_color_modificado=="3"){echo "selected='selected'";} ?>>3</option>
            <option value="4" <?php if($ing->numero_color_modificado=="4"){echo "selected='selected'";} ?>>4</option>
            <option value="5" <?php if($ing->numero_color_modificado=="5"){echo "selected='selected'";} ?>>5</option>
            <option value="6" <?php if($ing->numero_color_modificado=="6"){echo "selected='selected'";} ?>>6</option>
             <?php } else { ?>
            <option value="" <?php echo set_value_select($ing,'numero_color_modificado_ing',$ing->numero_color_modificado,'');?><?php if($_POST['numero_color_modificado_ing']==""){echo "selected=selected";} ?>>Seleccione</option>
            <option value="1" <?php echo set_value_select($ing,'numero_color_modificado_ing',$ing->numero_color_modificado,'1');?><?php if($_POST['numero_color_modificado_ing']=="1"){echo "selected=selected";} ?>>1</option>
            <option value="2" <?php echo set_value_select($ing,'numero_color_modificado_ing',$ing->numero_color_modificado,'2');?><?php if($_POST['numero_color_modificado_ing']=="2"){echo "selected=selected";} ?>>2</option>
            <option value="3" <?php echo set_value_select($ing,'numero_color_modificado_ing',$ing->numero_color_modificado,'3');?><?php if($_POST['numero_color_modificado_ing']=="3"){echo "selected=selected";} ?>>3</option>
            <option value="4" <?php echo set_value_select($ing,'numero_color_modificado_ing',$ing->numero_color_modificado,'4');?><?php if($_POST['numero_color_modificado_ing']=="4"){echo "selected=selected";} ?>>4</option>
            <option value="5" <?php echo set_value_select($ing,'numero_color_modificado_ing',$ing->numero_color_modificado,'5');?><?php if(isset($_POST["fondo_otro_color"]) && ($_POST['numero_color_modificado_ing']=="5")){echo "selected=selected";} ?>>5</option>
            <option value="6" <?php echo set_value_select($ing,'numero_color_modificado_ing',$ing->numero_color_modificado,'6');?><?php if($_POST['numero_color_modificado_ing']=="6"){echo "selected=selected";} ?>>6</option>
            <?php }  ?>
            </select>
        </div>
    </div>
             <?php } else {
   //  print_r($datos);
                 ?>
                <div class="control-group">
        <label class="control-label" for="usuario">Tiene Algun Color Modificado<strong style="color: red;">(*)</strong></label>
        <div class="controls">
            <select name="tiene_color_modificado_ing">
            <option value="" <?php echo set_value_select($datos,'tiene_color_modificado_ing',$datos->tiene_color_modificado,'');?>>Seleccione</option>
            <option value="NO" <?php echo set_value_select($datos,'tiene_color_modificado_ing',$datos->tiene_color_modificado,'NO');?>>NO</option>
            <option value="SI" <?php echo set_value_select($datos,'tiene_color_modificado_ing',$datos->tiene_color_modificado,'SI');?>>SI</option>
            </select>
        </div>
    </div>
    <div class="control-group" <?php if($datos->tiene_color_modificado<>'SI'){echo 'hidden=true'; }?> id="numero_color_modificado_ing">
        <label class="control-label" for="usuario">Numero de Colores<strong style="color: red;">(*)</strong></label>
        <div class="controls">
            <select name="numero_color_modificado_ing">
             <?php if (sizeof($datos)>0)  { ?>
            <option value="" <?php if($datos->numero_color_modificado==""){echo "selected='selected'";} ?>>Seleccione</option>
            <option value="1" <?php if($datos->numero_color_modificado=="1"){echo "selected='selected'";} ?>>1</option>
            <option value="2" <?php if($datos->numero_color_modificado=="2"){echo "selected='selected'";} ?>>2</option>
            <option value="3" <?php if($datos->numero_color_modificado=="3"){echo "selected='selected'";} ?>>3</option>
            <option value="4" <?php if($datos->numero_color_modificado=="4"){echo "selected='selected'";} ?>>4</option>
            <option value="5" <?php if($datos->numero_color_modificado=="5"){echo "selected='selected'";} ?>>5</option>
            <option value="6" <?php if($datos->numero_color_modificado=="6"){echo "selected='selected'";} ?>>6</option>
             <?php } else { ?>
            <option value="" <?php echo set_value_select($datos,'numero_color_modificado_ing',$datos->numero_color_modificado,'');?><?php if($_POST['numero_color_modificado_ing']==""){echo "selected=selected";} ?>>Seleccione</option>
            <option value="1" <?php echo set_value_select($datos,'numero_color_modificado_ing',$datos->numero_color_modificado,'1');?><?php if($_POST['numero_color_modificado_ing']=="1"){echo "selected=selected";} ?>>1</option>
            <option value="2" <?php echo set_value_select($datos,'numero_color_modificado_ing',$datos->numero_color_modificado,'2');?><?php if($_POST['numero_color_modificado_ing']=="2"){echo "selected=selected";} ?>>2</option>
            <option value="3" <?php echo set_value_select($datos,'numero_color_modificado_ing',$datos->numero_color_modificado,'3');?><?php if($_POST['numero_color_modificado_ing']=="3"){echo "selected=selected";} ?>>3</option>
            <option value="4" <?php echo set_value_select($datos,'numero_color_modificado_ing',$datos->numero_color_modificado,'4');?><?php if($_POST['numero_color_modificado_ing']=="4"){echo "selected=selected";} ?>>4</option>
            <option value="5" <?php echo set_value_select($datos,'numero_color_modificado_ing',$datos->numero_color_modificado,'5');?><?php if(isset($_POST["fondo_otro_color"]) && ($_POST['numero_color_modificado_ing']=="5")){echo "selected=selected";} ?>>5</option>
            <option value="6" <?php echo set_value_select($datos,'numero_color_modificado_ing',$datos->numero_color_modificado,'6');?><?php if($_POST['numero_color_modificado_ing']=="6"){echo "selected=selected";} ?>>6</option>
            <?php }  ?>
            </select>
        </div>
    </div>
    <?php } }?>
   
            <div id="que_es_esto" name="que_es_esto" class="control-group" style="display:none;">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <img src="<?php echo base_url().$this->config->item('direccion_pdf')."que_es_esto.png" ?>" alt="Smiley face" height="60%" width="60%">
                    
             </div>    
   
           <div class="control-group">
                     <label class="control-label" for="usuario">Lleva Fondo Otro Color</label>
                     <div class="controls">
                        <select name="fondo_otro_color" onchange="msg_fondo();calculo_ccac();" style="width: 150px;" >
                        <option value="">Seleccione......</option>  
                        <?php if (sizeof($ing)>0)  { ?>
                            <option value="SI" <?php if($ing->fondo_otro_color=="SI"){echo 'selected="selected"';}?>>Sì</option>
                            <option value="NO" <?php if($ing->fondo_otro_color=="NO"){echo 'selected="selected"';}?>>No</option>
                        <?php } else { ?>
                            <option value="SI" <?php if(isset($_POST["fondo_otro_color"]) and $_POST["fondo_otro_color"]=='SI'){echo 'selected="selected"';}?>>Sì</option> 
                            <option value="NO" <?php if(isset($_POST["fondo_otro_color"]) and $_POST["fondo_otro_color"]=='NO'){echo 'selected="selected"';}?>>No</option>
                        <?php }  ?>                               
                        </select> 	
                     </div>
             </div>   
   <!--Codigo agregado por ehndz (hay que imprimir contra la fibra)-->
           <div class="control-group">
                     <label class="control-label" for="usuario">Hay que Imprimir Contra la Fibra</label>
                     <div class="controls">
                        <select class="" id="imprimir_contra_la_fibra" name="imprimir_contra_la_fibra" onchange="return calculo_ccac_minimo();" style="width: 150px;" >
                        <option value="">Seleccione......</option>  
                        <?php if (sizeof($ing)>0)  { ?>
                            <option value="SI" <?php if($ing->imprimir_contra_la_fibra=="SI"){echo 'selected="selected"';}?>>Sí</option>
                            <option value="NO" <?php if($ing->imprimir_contra_la_fibra=="NO"){echo 'selected="selected"';}?>>No</option>
                        <?php } else { ?>
                            <option value="SI" <?php if(isset($_POST["imprimir_contra_la_fibra"]) and $_POST["imprimir_contra_la_fibra"]=='SI'){echo 'selected="selected"';}?>>Sí</option> 
                            <option value="NO" <?php if(isset($_POST["imprimir_contra_la_fibra"]) and $_POST["imprimir_contra_la_fibra"]=='NO'){echo 'selected="selected"';}?>>No</option>
                        <?php }  ?>                               
                        </select> 	
                     </div>
             </div>   
   <!--********************combos de barniz - agregado pot ehndz**********************-->
     <?php if($cotizacion->lleva_barniz != '' && $ing->ing_lleva_barniz == ''){?>
         <div class="control-group">
		<label class="control-label" for="usuario">Tipo de Barniz</label>
		<div class="controls">
                    <select id="ing_lleva_barniz" name="ing_lleva_barniz" style="width: 300px;">
                    <option value="">Seleccione.....</option>
                        <?php  if (sizeof($cotizacion)>0) {   ?>
                                <option value="Barniz Acuoso Brillante (Standar)" <?php if($cotizacion->lleva_barniz=="Barniz Acuoso Brillante (Standar)"){echo 'selected="true"';}?>>Barniz Acuoso Brillante (Standar)</option>
                                <option value="Barniz Acuoso Mate" <?php if($cotizacion->lleva_barniz=="Barniz Acuoso Mate"){echo 'selected="true"';}?>>Barniz Acuoso Mate</option>                    
                                <option value="Barniz Sobre Impresion" <?php if($cotizacion->lleva_barniz=="Barniz Sobre Impresion"){echo 'selected="true"';}?>>Barniz Sobre Impresión</option>                    
                                <option value="Laca UV" <?php if($cotizacion->lleva_barniz=="Laca UV"){echo 'selected="true"';}?>>Laca UV</option>                    
                                <option value="No Se" <?php if($cotizacion->lleva_barniz=="No Se"){echo 'selected="true"';}?>>No Se</option>                    
                                <option value="Nada" <?php if($cotizacion->lleva_barniz=="Nada"){echo 'selected="true"';}?>>Nada</option>                    
                        <?php } else {?>                    
                                <option value="Barniz Acuoso Brillante (Standar)" <?php if(($_POST["ing_lleva_barniz"])=="Barniz Acuoso Brillante (Standar)"){echo 'selected="selected"';}?>>Barniz Acuoso Brillante (Standar)</option>
                                <option value="Barniz Acuoso Mate" <?php if(($_POST["ing_lleva_barniz"])=="Barniz Acuoso Mate"){echo 'selected="selected"';}?>>Barniz Acuoso Mate</option>
                                <option value="Barniz Sobre Impresion" <?php if(($_POST["ing_lleva_barniz"])=="Barniz Sobre Impresion"){echo 'selected="selected"';}?>>Barniz Sobre Impresión</option>
                                <option value="Laca UV" <?php if(($_POST["ing_lleva_barniz"])=="Laca UV"){echo 'selected="selected"';}?>>Laca UV</option>
                                <option value="No Se" <?php if(($_POST["ing_lleva_barniz"])=="No Se"){echo 'selected="selected"';}?>>No Se</option>
                                <option value="Nada" <?php if(($_POST["ing_lleva_barniz"])=="Nada"){echo 'selected="selected"';}?>>Nada</option>
                        <?php } ?>                        
            </select> 
        
		</div>
	</div>
<div class="control-group" id="ing_reserva_barniz" <?php if($cotizacion->reserva_barniz==""){echo "hidden=true";}?>>
		<label class="control-label" for="usuario">Reserva</label>
		<div class="controls">
                    <select name="ing_reserva_barniz" style="width: 200px;">
                    <option value="">Seleccione.....</option>
                        <?php  if (sizeof($cotizacion)>0) {   ?>
                                <option value="Con Reserva" <?php if($cotizacion->reserva_barniz=="Con Reserva"){echo 'selected="true"';}?>>Con Reserva</option>
                                <option value="Sin Reserva" <?php if($cotizacion->reserva_barniz=="Sin Reserva"){echo 'selected="true"';}?>>Sin Reserva</option>                    
                        <?php } else {?>                    
                                <option value="Con Reserva" <?php if(($_POST["ing_reserva_barniz"])=="Con Reserva"){echo 'selected="selected"';}?>>Con Reserva</option>
                                <option value="Sin Reserva" <?php if(($_POST["ing_reserva_barniz"])=="Sin Reserva"){echo 'selected="selected"';}?>>Sin Reserva</option>
                        <?php } ?>                        
            </select> 
        
		</div>
	</div>
<div class="control-group"  id="ing_cala_caucho" <?php if($cotizacion->cala_caucho==""){echo "hidden=true";}?>>
		<label class="control-label" for="usuario">Cala Caucho</label>
		<div class="controls">
                    <select name="ing_cala_caucho" style="width: 200px;">
                    <option value="">Seleccione.....</option>
                        <?php  if (sizeof($cotizacion)>0) {   ?>
                                <option value="Si" <?php if($cotizacion->cala_caucho=="Si"){echo 'selected="true"';}?>>Si</option>
                                <option value="No" <?php if($cotizacion->cala_caucho=="No"){echo 'selected="true"';}?>>No</option>                    
                        <?php } else {?>                    
                                <option value="Si" <?php if(($_POST["ing_cala_caucho"])=="Si"){echo 'selected="selected"';}?>>Si</option>
                                <option value="No" <?php if(($_POST["ing_cala_caucho"])=="No"){echo 'selected="selected"';}?>>No</option>
                        <?php } ?>                        
            </select> 
        
		</div>
	</div>
     <?php }else{ ?>
         <div class="control-group">
		<label class="control-label" for="usuario">Tipo de Barniz</label>
		<div class="controls">
                    <select id="ing_lleva_barniz" name="ing_lleva_barniz" style="width: 200px;" onchange="cambiobarniz(this);">
                    <option value="">Seleccione.....</option>
                        <?php  if (sizeof($ing)>0) {   ?>
                                <option value="Barniz Acuoso Brillante (Standar)" <?php if($ing->ing_lleva_barniz=="Barniz Acuoso Brillante (Standar)"){echo 'selected="true"';}?>>Barniz Acuoso Brillante (Standar)</option>
                                <option value="Barniz Acuoso Mate" <?php if($ing->ing_lleva_barniz=="Barniz Acuoso Mate"){echo 'selected="true"';}?>>Barniz Acuoso Mate</option>
                                <option value="Barniz Sobre Impresion" <?php if($ing->ing_lleva_barniz=="Barniz Sobre Impresion"){echo 'selected="true"';}?>>Barniz Sobre Impresión</option>                    
                                <option value="Laca UV" <?php if($ing->ing_lleva_barniz=="Laca UV"){echo 'selected="true"';}?>>Laca UV</option>                    
                                <option value="No Se" <?php if($ing->ing_lleva_barniz=="No Se"){echo 'selected="true"';}?>>No Se</option>                    
                                <option value="Nada" <?php if($ing->ing_lleva_barniz=="Nada"){echo 'selected="true"';}?>>Nada</option>                    
                        <?php } else {?>                    
                                <option value="Barniz Acuoso Brillante (Standar)" <?php if(($_POST["ing_lleva_barniz"])=="Barniz Acuoso Brillante (Standar)"){echo 'selected="selected"';}?>>Barniz Acuoso Brillante (Standar)</option>
                                <option value="Barniz Acuoso Mate" <?php if(($_POST["ing_lleva_barniz"])=="Barniz Acuoso Mate"){echo 'selected="selected"';}?>>Barniz Acuoso Mate</option>
                                <option value="Barniz Sobre Impresion" <?php if(($_POST["ing_lleva_barniz"])=="Barniz Sobre Impresion"){echo 'selected="selected"';}?>>Barniz Sobre Impresión</option>
                                <option value="Laca UV" <?php if(($_POST["ing_lleva_barniz"])=="Laca UV"){echo 'selected="selected"';}?>>Laca UV</option>
                                <option value="No Se" <?php if(($_POST["ing_lleva_barniz"])=="No Se"){echo 'selected="selected"';}?>>No Se</option>
                                <option value="Nada" <?php if(($_POST["ing_lleva_barniz"])=="Nada"){echo 'selected="selected"';}?>>Nada</option>
                        <?php } ?>                        
            </select> 
        
		</div>
	</div>
<div class="control-group" id="ing_reserva_barniz" <?php if($ing->ing_reserva_barniz==""){echo "hidden=true";}?>>
		<label class="control-label" for="usuario">Reserva</label>
		<div class="controls">
                    <select name="ing_reserva_barniz" style="width: 200px;" onchange="cambioreserva(this);">
                    <option value="">Seleccione.....</option>
                        <?php  if (sizeof($ing)>0) {   ?>
                                <option value="Con Reserva" <?php if($ing->ing_reserva_barniz=="Con Reserva"){echo 'selected="true"';}?>>Con Reserva</option>
                                <option value="Sin Reserva" <?php if($ing->ing_reserva_barniz=="Sin Reserva"){echo 'selected="true"';}?>>Sin Reserva</option>                    
                        <?php } else {?>                    
                                <option value="Con Reserva" <?php if(($_POST["ing_reserva_barniz"])=="Con Reserva"){echo 'selected="selected"';}?>>Con Reserva</option>
                                <option value="Sin Reserva" <?php if(($_POST["ing_reserva_barniz"])=="Sin Reserva"){echo 'selected="selected"';}?>>Sin Reserva</option>
                        <?php } ?>                        
            </select> 
        
		</div>
	</div>
<div class="control-group"  id="ing_cala_caucho" <?php if($ing->ing_cala_caucho==""){echo "hidden=true";}?>>
		<label class="control-label" for="usuario">Cala Caucho</label>
		<div class="controls">
		<select name="ing_cala_caucho" style="width: 200px;">
                    <option value="">Seleccione.....</option>
                        <?php  if (sizeof($ing)>0) {   ?>
                                <option value="Si" <?php if($ing->ing_cala_caucho=="Si"){echo 'selected="true"';}?>>Si</option>
                                <option value="No" <?php if($ing->ing_cala_caucho=="No"){echo 'selected="true"';}?>>No</option>                    
                        <?php } else {?>                    
                                <option value="Si" <?php if(($_POST["ing_cala_caucho"])=="Si"){echo 'selected="selected"';}?>>Si</option>
                                <option value="No" <?php if(($_POST["ing_cala_caucho"])=="No"){echo 'selected="selected"';}?>>No</option>
                        <?php } ?>                        
            </select> 
        
		</div>
	</div>
    <?php }
         ?>
   
   
   <!--***********************************************************-->
   
   	    <div class="control-group">
		<label class="control-label" for="usuario">Lleva Fondo Negro</label>
		<div class="controls">
                    <select class="comprobacion" id="lleva_fondo_negro" name="lleva_fondo_negro" style="width: 100px;" onchange="llevafondo(this.value);msg_fondo();calculo_ccac_minllevafondoimo();">
                    <option value="">Seleccione......</option>   
                    <?php if(sizeof($ing)>0) { ?>
                        <option value="NO" <?php if($ing->lleva_fondo_negro=="NO"){echo 'selected="selected"';}?>>NO</option>
                        <option value="SI" <?php if($ing->lleva_fondo_negro=="SI"){echo 'selected="selected"';}?>>SI</option>
                    <?php } else { ?>                
                        <option value="NO" <?php if($datos->tiene_fondo=="NO"){echo 'selected="selected"';}?>>NO</option>
                        <option value="SI" <?php if($datos->tiene_fondo=="SI"){echo 'selected="selected"';}?>>SI</option>                
                    <?php }  ?>                     
                    </select> 
        	<div id="msg_lleva_fondo_negro"> </div>
                <div class="pull-right span6"><h1 id="valorccac"></h1></div>
		</div>
            </div>
    <?php
    if ($ing->imagen_impresion=='')
    {        
        $imagen_impresion=$datos->proceso_fondo; 
    }
    else {
        $imagen_impresion=$ing->imagen_impresion; 
    }
    ?>   
   
      	    <div class="control-group">
		<label class="control-label" for="usuario">Imagen Impresión</label>
		<div class="controls">
		<select class="comprobacion" id="imagen_impresion" name="imagen_impresion" style="width: 100px;" onchange="msg_fondo();calculo_ccac_minimo();">
                    <option value="">Seleccione......</option>   
                    <option value="CE" <?php if($imagen_impresion=="CE"){echo 'selected="selected"';}?>>Al CENTRO</option>
                    <option value="CO" <?php if($imagen_impresion=="CO"){echo 'selected="selected"';}?>>AL CORTE</option>
                    <option value="NO" <?php if($imagen_impresion=="NO"){echo 'selected="selected"';}?>>NO SE SABE</option>
                </select> 
                    <a onclick="ver_informacion('que_es_esto');">Que es esto?</a>

		</div>
		</div>
   <h3>Troquelado <strong style="color: red;">(*)</strong></h3>
    
     <div class="control-group" id="div_hay_que_troquelar">
		<label class="control-label" for="usuario">Hay que Troquelar?</label>
		<div class="controls">
			<select name="hay_que_troquelar" style="width: 100px;" onchange="">
                        <?php
                        if($ing->hay_que_troquelar=="" && $datos->hay_que_troquelar!=""){
                            
                         if (sizeof($datos)>0)  { ?>
                            <option value="SI" <?php if($datos->hay_que_troquelar=='SI'){echo 'selected="true"';}?>>SI</option> 
                            <option value="NO" <?php if($datos->hay_que_troquelar=="NO"){echo 'selected="true"';}?>>NO</option>
                            <option value="NO SE" <?php if($datos->hay_que_troquelar=="NO SE"){echo 'selected="true"';}?>>NO SE</option>
                        <?php } else { ?>
                            <option value="SI" <?php if(($_POST["hay_que_troquelar"])=='SI'){echo 'selected="selected"';}?>>SI</option> 
                            <option value="NO" <?php if(($_POST["hay_que_troquelar"])=='NO'){echo 'selected="selected"';}?>>NO</option>
                            <option value="NO SE" <?php if(($_POST["hay_que_troquelar"])=='NO SE'){echo 'selected="selected"';}?>>NO SE</option>
                        <?php }  
                        }else{
                            if (sizeof($ing)>0)  { ?>
                            <option value="SI" <?php if($ing->hay_que_troquelar=='SI'){echo 'selected="true"';}?>>SI</option> 
                            <option value="NO" <?php if($ing->hay_que_troquelar=="NO"){echo 'selected="true"';}?>>NO</option>
                            <option value="NO SE" <?php if($ing->hay_que_troquelar=="NO SE"){echo 'selected="true"';}?>>NO SE</option>
                        <?php } else { ?>
                            <option value="SI" <?php if(($_POST["hay_que_troquelar"])=='SI'){echo 'selected="selected"';}?>>SI</option> 
                            <option value="NO" <?php if(($_POST["hay_que_troquelar"])=='NO'){echo 'selected="selected"';}?>>NO</option>
                            <option value="NO SE" <?php if(($_POST["hay_que_troquelar"])=='NO SE'){echo 'selected="selected"';}?>>NO SE</option>
                        <?php }
                        }
                        ?>   
                        </select> </div>
        </div>
   <div class="control-group">
		<label class="control-label" for="id_antiguo">Lleva troquelado?</label>
		<div class="controls">
		<?php
          //  print_r($datos);exit();
		if(sizeof($ing)==0) { ?>
		<input type="text" name="lleva_troquelado"  value="<?php if($datos->estan_los_moldes=="MOLDE REGISTRADOS DEL CLIENTE"){echo 'SI';} if($datos->estan_los_moldes=="MOLDE GENERICO"){echo 'SI';} if($datos->estan_los_moldes=="SI"){echo 'SI';} if($datos->estan_los_moldes=="NO" && $datos->hay_que_troquelar=="NO"){echo 'NO';} if($datos->estan_los_moldes=="NO" && $datos->hay_que_troquelar=="SI"){echo 'SI';} if($datos->estan_los_moldes=="NO LLEVA"){echo 'NO';} if($datos->estan_los_moldes=="CLIENTE LO APORTA"){echo 'SI';} ?>" />
		<?php } elseif(sizeof($ing)>= 1) { ?>
		<input type="text" name="lleva_troquelado"  value="<?php echo $ing->lleva_troquelado ?>" />
		<?php } ?>
		</div>
	</div> 
    
    <div class="control-group" id="hacer_troquel" style="display: block;">
		<label class="control-label" for="id_antiguo">Hay que hacer troquel</label>
		<div class="controls">
		<?php //echo $datos->estan_los_moldes;
                if(sizeof($ing)>0) 
                { 
                    $hacer_troquel=$ing->hacer_troquel;
                }
                else
	        {
                    if($datos->estan_los_moldes=="MOLDE GENERICO")
                        $hacer_troquel='NO';
                    if($datos->estan_los_moldes=="MOLDE REGISTRADOS DEL CLIENTE")
                        $hacer_troquel='NO';
                    if($datos->estan_los_moldes=="SI")
                        $hacer_troquel='NO';
                    if($datos->estan_los_moldes=="NO" && $datos->hay_que_troquelar=="SI")
                        $hacer_troquel='SI';
                    if($datos->estan_los_moldes=="NO" && $datos->hay_que_troquelar=="NO")
                        $hacer_troquel='NO';
                    if($datos->estan_los_moldes=="NO LLEVA")
                        $hacer_troquel='NO';
                    if($datos->estan_los_moldes=="CLIENTE LO APORTA")
                        $hacer_troquel='NO';
                }                    
                ?>
                    <input type="text" id="dato_hacer_troquel" name="hacer_troquel"  value="<?php echo $hacer_troquel; ?>" />
                    
		</div>
                <?php $molde=$this->moldes_model->getMoldesPorId($datos->numero_molde) ?>
                
                <?php $distancia=$molde->cuchillocuchillo." X ".$molde->cuchillocuchillo2; ?>
	</div> 
        <div class="control-group">
                <label class="control-label" for="usuario">Lleva desgajado automatico:</label>
                <div class="controls">
                        <select name="desgajado_automatico" style="width: 150px;" onchange="">
<!--                        <option value="">Seleccione......</option>-->
                        <?php if (sizeof($ing)>0)  { ?>
                            <option value="NO" <?php if($ing->desgajado_automatico=="NO"){echo 'selected="selected"';}?>>NO</option>
                            <option value="SI" <?php if($ing->desgajado_automatico=="SI"){echo 'selected="selected"';}?>>SI</option>
                            <option value="POR DEFINIR" <?php if($ing->desgajado_automatico=="POR DEFINIR"){echo 'selected="selected"';}?>>POR DEFINIR</option>
                        <?php } else { ?>
                            <option value="NO" <?php if(isset($_POST["desgajado_automatico"]) && $_POST["desgajado_automatico"]=='NO'){echo 'selected="selected"';}?>>NO</option>
                            <option value="SI" <?php if(isset($_POST["desgajado_automatico"]) && $_POST["desgajado_automatico"]=='SI'){echo 'selected="selected"';}?>>SI</option> 
                            <option value="POR DEFINIR" <?php if(isset($_POST["desgajado_automatico"]) && $_POST["desgajado_automatico"]=='NO'){echo 'selected="selected"';}?>>POR DEFINIR</option>
                        <?php }  ?>                                                    
                        </select> 			
                </div>
             </div>
    <div class="control-group" id="producto">
		<label class="control-label" for="usuario">Unidades ("Producto Completo") por pliego <strong style="color: red;">(*)</strong></label>
		<div class="controls">
		<?php if(sizeof($ing) >0) {?>  
			<!--<input type="text" name="unidades_por_pliego" placeholder="Unidades por pliego" id="unidades_por_pliego" onkeypress="return soloNumeros(event)" value="<?php //echo $ing->unidades_por_pliego;?>" /><a style="color:#BBBBBB"> [<?php //echo number_format($datos->unidades_por_pliego,0,'','.')?>] </a>-->
                        <input type="text" name="unidades_por_pliego" placeholder="Unidades por pliego" id="unidades_por_pliego" onkeypress="return soloNumeros(event)" value="<?php if($ing->unidades_por_pliego!=""){echo $ing->unidades_por_pliego;}else{if($moldes2->unidades_productos_completos!=""){if($trazadosing->unidades_productos_completos==""){echo $moldes2->unidades_productos_completos;}else{echo $trazadosing->unidades_productos_completos;}}else{echo $_POST["unidades_por_pliego"];}}?>" /><a style="color:#BBBBBB"> [<?php echo number_format($datos->unidades_por_pliego,0,'','.')?>] </a>
                <?php } else {?>  
                        <input type="text" name="unidades_por_pliego" placeholder="Unidades por pliego" id="unidades_por_pliego" onkeypress="return soloNumeros(event)" value="<?php if($moldes2->unidades_productos_completos!=""){if($trazadosing->unidades_productos_completos==""){echo $moldes2->unidades_productos_completos;}else{echo $trazadosing->unidades_productos_completos;}}else{if($trazadosing->unidades_productos_completos!=""){echo $trazadosing->unidades_productos_completos;}else{echo $_POST["unidades_por_pliego"];}}?>" /><a style="color:#BBBBBB"> [<?php echo number_format($datos->unidades_por_pliego,0,'','.')?>] </a>
                <?php }?>                       
         
		</div>
	</div>
    
   <div class="control-group" id="producto">
		<label class="control-label" for="usuario">Piezas totales en el pliego ( para desgajado )<strong style="color: red;">(*)</strong></label>
		<div class="controls">
                    <?php if(sizeof($ing)>0) { ?>
                        <input type="text" name="piezas_totales_en_el_pliego" placeholder="piezas totales en el pliego (para desgajado)" id="piezas_totales_en_el_pliego" onkeypress="return soloNumeros(event)" onblur="formatear(this.value,this.id); PiezasTotales(this.value);" value="<?php if($ing->unidades_por_pliego!=""){echo $ing->piezas_totales_en_el_pliego;}else{if($moldes2->piezas_totales!=""){if($trazadosing->piezas_totales!=""){echo $trazadosing->piezas_totales;}else{echo $moldes2->piezas_totales;}}else{echo $datos->piezas_totales_en_el_pliego;}}?>" /> <a style="color:#BBBBBB"> [<?php if($ing->piezas_totales_en_el_pliego!=0){echo number_format($ing->piezas_totales_en_el_pliego,0,'','.');}?>] </a>
                    <?php } elseif(sizeof($datos)>0) { ?>
                        <input type="text" name="piezas_totales_en_el_pliego" placeholder="piezas totales en el pliego (para desgajado)" id="piezas_totales_en_el_pliego" onkeypress="return soloNumeros(event)" onblur="formatear(this.value,this.id); PiezasTotales(this.value);" value="<?php if($moldes2->piezas_totales!=""){if($trazadosing->piezas_totales!=""){echo $trazadosing->piezas_totales;}else{echo $moldes2->piezas_totales;}}else{if($trazadosing->piezas_totales!=""){echo $trazadosing->piezas_totales;}else{echo $datos->piezas_totales_en_el_pliego;}}?>" /><a style="color:#BBBBBB"> [<?php if($datos->piezas_totales_en_el_pliego!=0){echo number_format($datos->piezas_totales_en_el_pliego,0,'','.');}?>] </a>
                    <?php } else { ?>                
			<input type="text" name="piezas_totales_en_el_pliego" placeholder="piezas totales en el pliego (para desgajado)" id="piezas_totales_en_el_pliego" onkeypress="return soloNumeros(event)" onblur="formatear(this.value,this.id); PiezasTotales(this.value);" value="<?php echo $_POST["piezas_totales_en_el_pliego"] ?>" /><a style="color:#BBBBBB"> [<?php echo number_format($_POST["piezas_totales_en_el_pliego"],0,'','.')?>] </a>
                    <?php }  ?>                     
         
		</div>
	</div>
    
	<?php
	if((sizeof($ing)>0) && ($ing->estan_los_moldes!="NO LLEVA"))
	{ 
	?>
            <div class="control-group">
                <label class="control-label" for="usuario">Lleva Troquel por atrás (reverso):</label>
                <div class="controls">
                        <select name="troquel_por_atras" style="width: 260px;" onchange="llevafondo2(this.value);">
                        <option value="">Seleccione......</option>
                        <?php if (sizeof($ing)>0){ ?>
                            <option value="SI" <?php if($ing->troquel_por_atras=="SI"){echo 'selected="selected"';}?>>Por atrás, margen izquierdo, retiro</option>
                            <option value="NO" <?php if($ing->troquel_por_atras=="NO"){echo 'selected="selected"';}?>>Por adelante, margen derecho, tiro</option>
                            <option value="" <?php if($ing->troquel_por_atras==""){echo 'selected="selected"';}?>>Por definir</option>
                            <option value="NO LLEVA" <?php if($ing->troquel_por_atras=="NO LLEVA"){echo 'selected="selected"';}?>>No lleva</option>
                        <?php } else { ?>
                            <option value="SI" <?php if(isset($_POST["troquel_por_atras"]) && $_POST["troquel_por_atras"]=='SI'){echo 'selected="selected"';}?>>Por atrás, margen izquierdo, retiro</option> 
                            <option value="NO" <?php if(isset($_POST["troquel_por_atras"]) && $_POST["troquel_por_atras"]=='NO'){echo 'selected="selected"';}?>>Por adelante, margen derecho, tiro</option>
                            <option value="" <?php if(isset($_POST["troquel_por_atras"]) && $_POST["troquel_por_atras"]==''){echo 'selected="selected"';}?>>Por definir</option>
                            <option value="NO LLEVA" <?php if(isset($_POST["troquel_por_atras"]) && $_POST["troquel_por_atras"]=='NO LLEVA'){echo 'selected="selected"';}?>>No lleva</option>
                        <?php }  ?>                                                    
                        </select>
                    <span id="etiquetatroquel" style="color:red"></span>
                </div>
             </div>
	<?php
	} else {
	?>
        <div class="control-group">
            <label class="control-label" for="usuario">Lleva Troquel por atrás  (reverso):</label>
            <div class="controls">
		<?php //if(sizeof($ing) >0) {?>  
                <!--<input type="text" name="troquel_por_atras" placeholder="troquel_por_atras" readonly="true" value="<?php //echo $ing->troquel_por_atras;?>" />--> 
                <?php// } else {?>  
                <!--<input type="text" name="troquel_por_atras" placeholder="troquel_por_atras" readonly="true" value="<?php// echo $_POST["troquel_por_atras"];?>" />--> 
                <?php //}?>      
                <select name="troquel_por_atras" style="width: 250px;" onchange="llevafondo2(this.value);">
                        <option value="">Seleccione......</option>
                        <?php if (sizeof($ing)>0)  { ?>
                            <option value="SI" <?php if($ing->troquel_por_atras=="SI"){echo 'selected="selected"';}?>>Por atrás, margen izquierdo, retiro</option>
                            <option value="NO" <?php if($ing->troquel_por_atras=="NO"){echo 'selected="selected"';}?>>Por adelante, margen derecho, tiro</option>
                            <option value="" <?php if($ing->troquel_por_atras==""){echo 'selected="selected"';}?>>Por definir</option>
                            <option value="NO LLEVA" <?php if($ing->troquel_por_atras==""){echo 'selected="selected"';}?>>No lleva</option>
                        <?php } else { ?>
                            <option value="SI" <?php if(isset($_POST["troquel_por_atras"]) && $_POST["troquel_por_atras"]=='SI'){echo 'selected="selected"';}?>>Por atrás, margen izquierdo, retiro</option> 
                            <option value="NO" <?php if(isset($_POST["troquel_por_atras"]) && $_POST["troquel_por_atras"]=='NO'){echo 'selected="selected"';}?>>Por adelante, margen derecho, tiro</option>
                            <option value="" <?php if(isset($_POST["troquel_por_atras"]) && $_POST["troquel_por_atras"]==''){echo 'selected="selected"';}?>>Por definir</option>
                            <option value="NO LLEVA" <?php if(isset($_POST["troquel_por_atras"]) && $_POST["troquel_por_atras"]=='NO LLEVA'){echo 'selected="selected"';}?>>No lleva</option>
                        <?php }  ?>                                                    
                        </select> 
                        <span id="etiquetatroquel" style="color:red"></span>
            </div>
	</div>
	<?php
	}
	?>
  
    <?php
// print_r($datos);
    $estan="NO";
    if(sizeof($ing)>0)
    {
        if(($ing->estan_los_moldes=="NO") || ($ing->estan_los_moldes=="NO LLEVA"))
        {
            $estan_los_moldes="NO"; 
        }            
        else
        {    
             if ($ing->estan_los_moldes!='')
            {
                $estan_los_moldes=$ing->estan_los_moldes;
                if ($estan_los_moldes=='MOLDE GENERICO'){ $estan="SI";}
                //elseif ($estan_los_moldes=='SI') $estan="SI";                    
                else{
                    if($estan_los_moldes=='MOLDE REGISTRADOS DEL CLIENTE'){
                        $estan="SI"; 
                    }else{ 
                            $estan="NO";
                        }}
                $numero_moldes=$ing->numero_molde;        
            }
        }
    }
    else
    {
        if(($datos->estan_los_moldes=="NO") || ($datos->estan_los_moldes=="NO LLEVA"))
        {
            $estan_los_moldes="NO"; 
            $estan="NO";
        }            
        else
        {        
            if ($datos->estan_los_moldes!='')
            {
                $estan_los_moldes=$datos->estan_los_moldes;
                if ($estan_los_moldes=='MOLDE GENERICO') $estan="SI";
                elseif ($estan_los_moldes=='MOLDE REGISTRADOS DEL CLIENTE') $estan="SI";                    
                else $estan="NO";             
                $numero_moldes=$datos->numero_molde;      
            }
        }
    }    
    $moldes=$this->moldes_model->getMoldes2();
    $moldes_clientes=$this->moldes_model->getMoldesClientes($datos->id_cliente);    
    
    /*******************************/
    echo "<input type='hidden' id='cucu1' value='".$moldes2->cuchillocuchillo."'/>";
    echo "<input type='hidden' id='cucu2' value='".$moldes2->cuchillocuchillo2."'/>";
    echo "<input type='hidden' id='abobina' value='".$moldes2->ancho_bobina."'/>";
    echo "<input type='hidden' id='lbobina' value='".$moldes2->largo_bobina."'/>";
    echo "<input type='hidden' id='mdlc' value='".$moldes2->medidas_de_las_cajas."'/>";
    echo "<input type='hidden' id='mdlc2' value='".$moldes2->medidas_de_las_cajas_2."'/>";
    echo "<input type='hidden' id='mdlc3' value='".$moldes2->medidas_de_las_cajas_3."'/>";
    echo "<input type='hidden' id='mdlc4' value='".$moldes2->medidas_de_las_cajas_4."'/>";
    echo "<input type='hidden' id='upcm' value='".$moldes2->unidades_productos_completos."'/>";
    echo "<input type='hidden' id='ptm' value='".$moldes2->piezas_totales."'/>";
    echo "<input type='hidden' name='nm' id='nm' value='".$datos->numero_molde."'/>";
    echo "<input type='hidden' id='cp' value='".$datos->condicion_del_producto."'/>";
    
//    echo "<h1>" . $datos->condicion_del_producto . "</h1>";
//    echo "<h1>" . $datos->numero_molde . "aa</h1>";
    
    
    
    
    
    /*******************************/
    ?>
   <div class="control-group" id="producto">
       <!-----------------------------------------------Contenido en Mantenimiento------------------------------------------------------<br /><br />-->
       <?php include('parcialMoldesTrazados.php'); ?>
       <!------------------------------------------------------------------------------------------------------------------------------------------->
   </div>
        
   <div id="div_existe_trazado" <?php if($datos->existe_trazado=="SI" && $estan_los_moldes=='NO'){echo '';}else{echo 'hidden="true"';}  ?>>
      <div class="control-group">
		<label class="control-label" for="usuario">Existe el trazado?</label>
		<div class="controls">
			<select id="existe_trazado" name="existe_trazado" style="width: 150px;" onchange="">
                            <option value="">-- Seleccione --</option> 
                        <?php if (sizeof($datos)>0)  { ?>
                            <option value="SI" <?php if($datos->existe_trazado=='SI'){echo 'selected="true"';}?>>SI</option> 
                            <option value="NO" <?php if($datos->existe_trazado=="NO"){echo 'selected="true"';}?>>NO</option>
                        <?php } else { ?>
                            <option value="SI" <?php if(($_POST["existe_trazado"])=='SI'){echo 'selected="selected"';}?>>SI</option> 
                            <option value="NO" <?php if(($_POST["existe_trazado"])=='NO'){echo 'selected="selected"';}?>>NO</option>
                        <?php }  ?>   
                        </select> </div>
    </div>
    </div>
    <div id="div_trazado_bloque" <?php if($datos->existe_trazado=="SI" && $estan_los_moldes=='NO'){echo '';}else{echo 'hidden="true"';}  ?>>
    <h3>Trazados <strong style="color: red;">(*)</strong></h3>
    <div class="control-group" id="div">
		<label class="control-label" for="usuario">Trazados?</label>
		<div class="controls">
                    <select name="trazados" class="chosen-select">
                        <option value="0">Seleccione.....</option>
                              <?php
                                $trazados=$this->trazados_model->getTrazados2();
                                foreach($trazados as $traza)
                                {
                                    if (sizeof($datos)>0) {  ?>
                                        <option value="<?php echo $traza->id?>" <?php if($datos->trazado==$traza->id){echo 'selected="selected"';}?>><?php echo $traza->nombre?> (N° <?php echo $traza->numero;?>)</option>
                                    <?php } else { ?>
                                        <option value="<?php echo $traza->id?>" <?php if($_POST["trazados"]==$traza->id){echo 'selected="selected"';}?>><?php echo $traza->nombre?> (N° <?php echo $traza->numero;?>)</option>
                                    <?php }
                                }
                          
                              ?>
                        </select> </div>
    </div>
    </div>
    <?php
    if(sizeof($ing)==0)
    {
        ?>
        <div class="control-group" id="crea_molde" style="display: <?php if($datos->estan_los_moldes=="NO" && $datos->condicion_del_producto=="Nuevo"){echo 'block';}else{echo 'none';}?>;">
		<label class="control-label" for="usuario"><strong>Nombre Molde sugerido:</strong><strong style="color: red;">(*)</strong></label>
		<div class="controls">
                    <?php if($datos->trazado!=0 || $datos->trazado!=""){
                        $trazados=$this->trazados_model->getTrazados2();
                                foreach($trazados as $traza)
                                {
                                    if($datos->trazado==$traza->id){ ?>
                                    <input style="width: 400px;" type="text" name="nombre_molde" placeholder="Nombre Molde sugerido" value="<?php echo $traza->nombre;?>" /> 
                                    <?php }
                                }
                    }else{ ?>
                       <input style="width: 400px;" type="text" name="nombre_molde" placeholder="Nombre Molde sugerido" value="<?php echo $datos->nombre_molde; ?>" /> 
                    <?php } ?>    
                    
		</div>
		</div>
        <?php
    }
    else if(sizeof($ing)>0)
    {
        if($ing->estan_los_moldes=="NO" && $datos->condicion_del_producto=="Nuevo"){?>        
        <div class="control-group" id="crea_molde">
            <label class="control-label" for="usuario"><strong id="nombre_molde_texto">Nombre Molde sugerido</strong><strong style="color: red;">(*)</strong></label>
		<div class="controls">
			<input style="width: 600px;" type="text" name="nombre_molde" placeholder="Nombre Molde sugerido" value="<?php echo $ing->nombre_molde?>" /> 
		</div>
	</div>
        <?php
        } else { if($ing->estan_los_moldes=="NO LLEVA" && $datos->condicion_del_producto=="Nuevo"){ ?>
            <div class="control-group" id="crea_molde">
		<label class="control-label" for="usuario"><strong>Nombre Molde sugerido</strong></label>
		<div class="controls">
                    <input style="width: 600px;" readonly="true" type="text" name="nombre_molde" placeholder="Nombre Molde sugerido" value="" /> 
		</div>
	</div>
        <?php }else{ ?>
        <div class="control-group" id="crea_molde">
            <label class="control-label" for="usuario"><strong id="texto_nm_sugerido"><?php if(sizeof($moldes2)>0 && $moldes2->id != 1 && $moldes2->id != 21){echo "Nombre Molde:";}else{echo "Nombre Molde Sugerido:";}?></strong></label>
		<div class="controls">
                    <input style="width: 600px;" readonly="true" type="text" name="nombre_molde" placeholder="Nombre Molde sugerido" value="<?php echo $ing->nombre_molde?>" /> 
		</div>
	</div>            
        <?php }}
    }
    ?>   
    
   <div class="control-group" id="metroDeCuchillo" style="display: <?php if($datos->estan_los_moldes=="NO" and $datos->condicion_del_producto!="Repetición Sin Cambios"){echo 'block';}else{echo 'none';}?>;">
		<label class="control-label" for="usuario">Metros de cuchillo</label>
		<div class="controls">
                    <?php if(sizeof($ing)>0) { ?>
			<input type="text" name="metros_de_cuchillo" id="metros_de_cuchillo" placeholder="Metros de cuchillo" id="metros_de_cuchillo" onkeypress="return soloNumeros(event)" onblur="formatear(this.value,this.id)" value="<?php echo $ing->metros_de_cuchillo; ?>" /><a style="color:#BBBBBB"> [<?php echo $datos->metros_de_cuchillo?>] </a>
                    <?php } elseif(sizeof($datos)>0) { ?>
			<input type="text" name="metros_de_cuchillo" id="metros_de_cuchillo" placeholder="Metros de cuchillo" id="metros_de_cuchillo" onkeypress="return soloNumeros(event)" onblur="formatear(this.value,this.id)" value="<?php echo $datos->metros_de_cuchillo; ?>" /><a style="color:#BBBBBB"> [<?php echo $datos->metros_de_cuchillo?>] </a>
                    <?php } else { ?>                
			<input type="text" name="metros_de_cuchillo" id="metros_de_cuchillo" placeholder="Metros de cuchillo" id="metros_de_cuchillo" onkeypress="return soloNumeros(event)" onblur="formatear(this.value,this.id)" value="<?php echo $_POST["metros_de_cuchillo"]; ?>" /><a style="color:#BBBBBB"> [<?php echo $datos->metros_de_cuchillo?>] </a>
                    <?php }  ?>                       
		</div>
	</div>
    
  <div class="control-group">
        <div class="span4 control-group"></div>
        <div class="span8 control-group"><h3><b><a onclick="ver_informacion('restricciones_ccac');">Click para ver Calculo de Restricciones CCAC</a></b></h3></div>
</div>
        <div id="restricciones_ccac" style="display:none;">
        <div class="control-group" style="border:1px">
            <table>
                <tr>
                    <td>
                        <table border="1">
                            <th>Imagen al Centro Pinza Adentro</th>
                            <tr><td>pinza 5mm</td></tr>
                            <tr><td>cola 5mm</td></tr>
                            <tr><td>CCAC MIN 10mm</td></tr>
                        </table>
                    </td>
                    <td>
                        <table border="1">
                            <th>Imagen al Corte Sin Fondo</th>
                            <tr><td>pinza 15mm</td></tr>
                            <tr><td>cola 5mm</td></tr>
                            <tr><td>CCAC MIN 20mm</td></tr>
                        </table>
                    </td>
                    <td>
                        <table border="1">
                            <th>Con Fondo</th>
                            <tr><td>pinza 15mm</td></tr>
                            <tr><td>cola 15mm</td></tr>
                            <tr><td>CCAC MIN 25mm</td></tr>
                        </table>    
                    </td>
                    <td>
                        <table border="1">
                            <th>Imprimir con la Fibra</th>
                            <tr><td>pinza 15mm</td></tr>
                            <tr><td>cola 30mm</td></tr>
                            <tr><td>CCAC MIN 45mm</td></tr>
                        </table>
                    </td>
                </tr>
            </table>
        </div>
    </div>
   <?php include('calculo_ccac.php'); ?>
   <table border='0' class="tablita table-no-bordered">
       <tr>
           <td>
               <div class="control-group" id="distancia_en_molde"  style="<?php if($ing->estan_los_moldes=="NO LLEVA"){echo "display:none";}?>">
                   <label class="control-label" for="usuario">Distancia en molde:<strong style="color: red;">(*<?php echo $distancia; ?>) Molde Nro: <?php echo $moldes2->id  ?> </strong></label>    
               </div>
               <div class="control-group" id="distanciacc" style="<?php if($ing->estan_los_moldes=="NO LLEVA"){echo "display:none";}?>">
                   <label class="control-label" for="usuario">Distancia cuchillo a cuchillo<strong style="color: red;">(*)</strong></label>
                   <div class="controls">
                       <input id="tamano_cuchillo_1" type="text" name="tamano_cuchillo_1" style="width: 100px;"  value="<?php echo $tamano_cuchillo_1 ?>" placeholder="0" onkeyup="return calculo_ccac_minimo()" onkeypress="return soloNumerosConPuntos(event),calculo_ccac_minimo();" /> X 
                       <input id="tamano_cuchillo_2" type="text" name="tamano_cuchillo_2" style="width: 100px;" value="<?php echo $tamano_cuchillo_2 ?>" placeholder="0" onkeyup="return calculo_ccac_minimo()" onkeypress="return soloNumerosConPuntos(event),calculo_ccac_minimo();" /> Cms. 
                   </div>
               </div>
               <div class="control-group" id="lacortar">
                   <label class="control-label" for="usuario">Largo a Cortar x Tamaño a Cortar<strong style="color: red;">(*)</strong></label>
                   <div class="controls">
                       <input id="tamano_1" type="text" name="tamano_1" style="width: 100px;"  value="<?php echo $tamano_1 ?>" placeholder="0" onkeypress="return soloNumerosConPuntos(event),calculo_ccac_minimo();" /> X 
                       <input id="tamano_2" type="text" name="tamano_2" style="width: 100px;" value="<?php echo $tamano_2 ?>" placeholder="0" onkeypress="return soloNumerosConPuntos(event),calculo_ccac_minimo();" /> Cms. 
                   </div>
               </div>
               <div class="control-group" id="lacortar2" style="display:none">
                   <label class="control-label" for="usuario">Largo a Cortar x Tamaño a Cortar2<strong style="color: red;">(*)</strong></label>
                   <div class="controls">
                       <input id="tamano_1" type="text" name="tamano_1" style="width: 100px;"  value="<?php echo $tamano_1 ?>" placeholder="0" /> X 
                       <input id="tamano_2" type="text" name="tamano_2" style="width: 100px;" value="<?php echo $tamano_2 ?>" placeholder="0" /> Cms. 
                   </div>
               </div>
               <div class="control-group" id="calccac" style="<?php if($ing->estan_los_moldes=="NO LLEVA"){echo "display:none";}?>">
                   <label class="control-label" for="usuario">Calculo CCAC</label>
                   <div class="controls">
                       <input type="text" id="ccac_1" name="ccac_1" style="width: 100px;"  value="<?php echo $ccac_1 ?>" placeholder="0" onkeypress="return soloNumerosConPuntos(event);" /> X 
                       <input type="text" id="ccac_2" name="ccac_2" style="width: 100px;" value="<?php echo $ccac_2 ?>" placeholder="0" onkeypress="return soloNumerosConPuntos(event);" /> Cms. 
                   </div>
               </div>
               </td>
               <td  style="<?php if($ing->estan_los_moldes=="NO LLEVA"){echo "display:none";}?>"><h3 id="msgccac"></h3>
               <ul id='rccac' style="list-style: none">
                   <li id='etiquetaicf'></li>
                   <li id="etiquetatfn"></li>
                   <li id="etiquetaimp"></li>
                   <li id="etiquetaccacmin"></li>
                   <li id="alertaccacmin"></li>
               </ul>
           </td>
       </tr>
   </table>
               <!------------------------------------------------------------------------------------------------------------------->
<h3>Materialidad <strong style="color: red;">(*)</strong></h3>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Datos Técnicos</label>
		<div class="controls">
                    <select style="width: 400px;" id="materialidad" name="datos_tecnicos" onchange="carga_ajax4('<?php echo base_url();?>cotizaciones/materialidad',this.value,'materialidad');">
                <option value="">Seleccione.....</option>
                <?php
                $datosTecnicos=$this->datos_tecnicos_model->getDatosTecnicos();
                if (sizeof($ing)>0) {  
                    switch($ing->materialidad_datos_tecnicos)
                    {                
                        case 'Microcorrugado': $datos_tecnicos=1; break;
                        case 'Corrugado': $datos_tecnicos=2; break;
                        case 'Cartulina-cartulina': $datos_tecnicos=3; break;
                        case 'Sólo Cartulina': $datos_tecnicos=4; break;
                        case 'Onda a la Vista (MicroCorrugado/Corrugado)': $datos_tecnicos=5; break;
                        case 'otro': $datos_tecnicos=6; break;
                        case 'Se solicita proposición': $datos_tecnicos=7; break;
                        case 'Onda a la Vista (Corrugado/Corrugado)': $datos_tecnicos=9; break;
                        case 'Onda a la Vista (MicroCorrugado/MicroCorrugado)': $datos_tecnicos=10; break; 
                    }
                }
                else 
                {
                    switch($datos->materialidad_datos_tecnicos)
                    {                
                        case 'Microcorrugado': $datos_tecnicos=1; break;
                        case 'Corrugado': $datos_tecnicos=2; break;
                        case 'Cartulina-cartulina': $datos_tecnicos=3; break;
                        case 'Sólo Cartulina': $datos_tecnicos=4; break;
                        case 'Onda a la Vista (MicroCorrugado/Corrugado)': $datos_tecnicos=5; break;
                        case 'otro': $datos_tecnicos=6; break;
                        case 'Se solicita proposición': $datos_tecnicos=7; break;
                        case 'Onda a la Vista (Corrugado/Corrugado)': $datos_tecnicos=9; break;
                        case 'Onda a la Vista (MicroCorrugado/MicroCorrugado)': $datos_tecnicos=10; break; 
                    }
                }
                foreach($datosTecnicos as $datosTecnico){
                    if (sizeof($ing)>0) {  ?>                
                    <option value="<?php echo $datosTecnico->id?>" <?php if($datos_tecnicos==$datosTecnico->id){echo 'selected="true"';}?>><?php echo $datosTecnico->datos_tecnicos?></option>
                    <?php } else { ?>
                    <option value="<?php echo $datosTecnico->id?>" <?php if($datos_tecnicos==$datosTecnico->id){echo 'selected="true"';}?>><?php echo $datosTecnico->datos_tecnicos?></option>
                    <?php }
                }
                ?>
                </select>
		</div>
	</div>
    
    <div id="materialidad">
          <div class="control-group">
    		<label class="control-label" for="usuario">Tapas (Placas)</label>
    		<div class="controls">
                    <select id="mate1" name="materialidad_1" class="chosen-select" style="width: 300px">
                    <option value="0">Seleccione......</option>
                    <?php
                    $tapas=$this->materiales_model->getMaterialesSelectCartulina();
                    foreach($tapas as $tapa){
                    if (sizeof($ing)>0) {  ?>                
                        <?php if($ing->id_mat_placa1!=""){?>
                        <option value="<?php echo $tapa->id?>" <?php if($ing->id_mat_placa1==$tapa->id){echo 'selected="true"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->materiales_tipo?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
                        <?php }else{ ?>
                        <option value="<?php echo $tapa->id?>" <?php if($datos->id_mat_placa1==$tapa->id){echo 'selected="true"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->materiales_tipo?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
                        <?php } ?>
                    <?php } else { ?>
                        <!--<option value="<?php// echo $tapa->nombre?>" <?php //if($datos->materialidad_1==$tapa->nombre){echo 'selected="true"';}?>><?php //echo $tapa->gramaje?> ( <?php //echo $tapa->materiales_tipo?> - $<?php //echo $tapa->precio?> ) (<?php //echo $tapa->reverso?>)</option>-->
                        <option value="<?php echo $tapa->id?>" <?php if($datos->id_mat_placa1==$tapa->id){echo 'selected="true"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->materiales_tipo?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
                    <?php }
                    }
                    ?>
                </select>
                    <a style="text-decoration: none">
                    <?php
                    $tapas=$this->materiales_model->getMaterialesSelectOnda();
                    foreach($tapas as $tapa){
                    if (sizeof($datos)>0) { 
                         if($datos->id_mat_placa1==$tapa->id){ echo "$tapa->gramaje ( $tapa->materiales_tipo - $ $tapa->precio ) ( $tapa->reverso)";
                     } 
                    }}
                    ?>
                </a>
    		</div>
    	</div>
        <?php 
            if (sizeof($ing)>0) {  
               if ($ing->materialidad_datos_tecnicos=="Cartulina-cartulina") 
               { 
                   $div_materialidad2='style="display: none;"'; 
               }
               elseif ($ing->materialidad_datos_tecnicos=="Sólo Cartulina") 
               { 
                   $div_materialidad2='style="display: none;"'; 
               } 
               else 
               { 
                   $div_materialidad2='style="display: block;"'; 
               }                
            }
            elseif (sizeof($datos)>0) 
            {
               if ($datos->materialidad_datos_tecnicos=="Cartulina-cartulina") 
               { 
                   $div_materialidad2='style="display: none;"'; 
               }
               elseif ($datos->materialidad_datos_tecnicos=="Sólo Cartulina") 
               { 
                   $div_materialidad2='style="display: none;"'; 
               } 
               else 
               { 
                   $div_materialidad2='style="display: block;"'; 
               }                
            }
            else
            {
               if ($_POST["datos_tecnicos"]==3) 
               { 
                   $div_materialidad2='style="display: none;"'; 
               }
               elseif ($_POST["datos_tecnicos"]==4) 
               { 
                   $div_materialidad2='style="display: none;"'; 
               } 
               else 
               { 
                   $div_materialidad2='style="display: block;"'; 
               }                 
            }            
        ?>
                <div class="control-group" id="div_materialidad_2" <?php echo $div_materialidad2; ?>>
    		<label class="control-label" for="usuario">Onda</label>
    		<div class="controls">
                    <select id="mate2"  name="materialidad_2" class="chosen-select" style="width: 300px">
                    <option value="0">Seleccione......</option>
                    <?php
                    $tapas=$this->materiales_model->getMaterialesSelectOnda();
                    foreach($tapas as $tapa){
                    if (sizeof($ing)>0) {  ?>                
                        <option value="<?php echo $tapa->id?>" <?php if($ing->id_mat_onda2==$tapa->id){echo 'selected="true"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->materiales_tipo?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
                        <!--<option value="<?php// echo $tapa->nombre?>" <?php //if($ing->materialidad_2==$tapa->nombre){echo 'selected="true"';}?>><?php //echo $tapa->gramaje?> ( <?php //echo $tapa->materiales_tipo?> - $<?php //echo $tapa->precio?> ) (<?php //echo $tapa->reverso?>)</option>-->
                    <?php } else { ?>
                        <option value="<?php echo $tapa->id?>" <?php if($datos->id_mat_onda2==$tapa->id){echo 'selected="true"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->materiales_tipo?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
                        <!--<option value="<?php //echo $tapa->nombre?>" <?php //if($datos->materialidad_2==$tapa->nombre){echo 'selected="true"';}?>><?php //echo $tapa->gramaje?> ( <?php //echo $tapa->materiales_tipo?> - $<?php //echo $tapa->precio?> ) (<?php //echo $tapa->reverso?>)</option>-->
                    <?php }
                    }
                    ?>
                </select>
               <a style="text-decoration: none">
                    <?php
                    $tapas=$this->materiales_model->getMaterialesSelectOnda();
                    foreach($tapas as $tapa){
                    if (sizeof($datos)>0) { 
                         if($datos->id_mat_onda2==$tapa->id){ echo "$tapa->gramaje ( $tapa->materiales_tipo - $ $tapa->precio ) ( $tapa->reverso)";
                     } 
                    }}
                    ?>
                </a>
    		</div>
    	</div>
        
        <?php 
            if (sizeof($ing)>0) {  
               if ($ing->materialidad_datos_tecnicos=="Sólo Cartulina") 
               { 
                   $div_materialidad3='style="display: none;"'; 
               } else { 
                   $div_materialidad3='style="display: block;"'; 
               } 
            }
            elseif (sizeof($datos)>0) 
            {
               if ($datos->materialidad_datos_tecnicos=="Sólo Cartulina") 
               { 
                   $div_materialidad3='style="display: none;"'; 
               } else { 
                   $div_materialidad3='style="display: block;"'; 
               } 
            }
            else
            {
               if ($_POST["datos_tecnicos"]==4) 
               { 
                   $div_materialidad3='style="display: none;"'; 
               } else { 
                   $div_materialidad3='style="display: block;"'; 
               } 
            }            
        ?>        
                <div class="control-group" id="div_materialidad_3" <?php echo $div_materialidad3; ?>>
    		<label class="control-label" for="usuario">Liner</label>
    		<div class="controls">
    		<select id="mate3"  name="materialidad_3" class="chosen-select" style="width: 300px">
                    <option value="0">Seleccione......</option>
                    <?php
                    $tapas=$this->materiales_model->getMaterialesSelectOnda();
                    foreach($tapas as $tapa){
                    if (sizeof($ing)>0) {  ?>                
                        <option value="<?php echo $tapa->id?>" <?php if($ing->id_mat_liner3==$tapa->id){echo 'selected="true"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->materiales_tipo?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
                        <!--<option value="<?php //echo $tapa->nombre?>" <?php //if($ing->materialidad_3==$tapa->nombre){echo 'selected="true"';}?>><?php// echo $tapa->gramaje?> ( <?php //echo $tapa->materiales_tipo?> - $<?php// echo $tapa->precio?> ) (<?php //echo $tapa->reverso?>)</option>-->
                    <?php } else { ?>
                        <option value="<?php echo $tapa->id?>" <?php if($datos->id_mat_liner3==$tapa->id){echo 'selected="true"';}?>><?php echo $tapa->gramaje?> ( <?php echo $tapa->materiales_tipo?> - $<?php echo $tapa->precio?> ) (<?php echo $tapa->reverso?>)</option>
                        <!--<option value="<?php //echo $tapa->nombre?>" <?php// if($datos->materialidad_3==$tapa->nombre){echo 'selected="true"';}?>><?php //echo $tapa->gramaje?> ( <?php //echo $tapa->materiales_tipo?> - $<?php //echo $tapa->precio?> ) (<?php //echo $tapa->reverso?>)</option>-->
                    <?php }
                    }
                    ?>                    
                </select>
                <a style="text-decoration: none">
                    <?php
                    $tapas=$this->materiales_model->getMaterialesSelectOnda();
                    foreach($tapas as $tapa){
                    if (sizeof($datos)>0) { 
                         if($datos->id_mat_liner3==$tapa->id){ echo "$tapa->gramaje ( $tapa->materiales_tipo - $ $tapa->precio ) ( $tapa->reverso)";
                     } 
                    }}
                    ?>
                </a>
    		</div>
    	</div>
        
    <input type="hidden" name="materialidad_4" value="No Aplica" />         
    <input type="hidden" name="materialidad_eleccion" value="tapa_mono" />
        
        
        
    </div>
    <h3>Trabajos Internos</h3>        
    
    <div class="control-group">
	<label class="control-label" for="usuario">Acabado Impresión interno 1</label>
	<div class="controls">
            <?php
            if($ing->acabado_impresion_1=='')
            {
               $aca1=$datos->impresion_acabado_impresion_1;   
            }else
            {
                $aca1=$ing->acabado_impresion_1;
            }
            ?>
            <select name="acabado_impresion_1" onchange="carga_ajax_obtenerKilos(this.value,'variable_externo_1'); carga_ajax_obtenerInfoTrabajosInternos(this.value,'infoPrecio1');" style="width: 500px;"><!--onchange="llevaBarnizFotomecanica2();"-->
                <option value="">Seleccione......</option>                            
                <?php
                foreach($internos as $interno)
                {
                ?>
                <option value="<?php echo $interno->id?>" <?php if($aca1==$interno->id){echo 'selected="selected"';}?>><?php echo $interno->caracteristicas?></option>
                <?php
                }
                ?>
            </select><a href="#" id="infoPrecio1"></a>
            <?php  $variable1=$this->acabados_model->getAcabadosPorId2($aca1); ?> 
            </br>
            <div id="variable_externo_1" <?php if($ing->input_variable_externo_1==0) { ?> style="display:none;"<?php }?>>
            	<input type="text" name="input_variable_externo_1"  value="<?php echo $ing->input_variable_externo_1; ?>" />&nbsp;&nbsp;  <?php echo $variable1 ?>
            </div>            
	</div>
    </div>

    <div class="control-group">
		<label class="control-label" for="usuario">Acabado Impresión interno 2</label>
		<div class="controls">
        <?php
            if($ing->acabado_impresion_2=='')
            {
               $aca2=$datos->impresion_acabado_impresion_2;   
            }else
            {
                $aca2=$ing->acabado_impresion_2;
            }
            ?>
                <select name="acabado_impresion_2" onchange="carga_ajax_obtenerKilos(this.value,'variable_externo_2'); carga_ajax_obtenerInfoTrabajosInternos(this.value,'infoPrecio2')" style="width: 500px;">
                <option value="">Seleccione......</option>                            
                <?php
                foreach($internos as $interno)
                {
                ?>
                <option value="<?php echo $interno->id?>" <?php if($aca2==$interno->id){echo 'selected="selected"';}?>><?php echo $interno->caracteristicas?></option>
                <?php
                }
                ?>
            </select><a href="#" id="infoPrecio2"></a>
            <?php  $variable2=$this->acabados_model->getAcabadosPorId2($aca2); ?> 
            </br>
            <div id="variable_externo_2" <?php if($ing->input_variable_externo_2==0) { ?> style="display:none;"<?php }?>>
            	<input type="text" name="input_variable_externo_2"  value="<?php echo $ing->input_variable_externo_2; ?>" />&nbsp;&nbsp;  <?php echo $variable2 ?>   
            </div>                    
		</div>
	</div>
     <div class="control-group">
		<label class="control-label" for="usuario">Acabado Impresión interno 3</label>
		<div class="controls">
        <?php
            if($ing->acabado_impresion_3=='')
            {
               $aca3=$datos->impresion_acabado_impresion_3;   
            }else
            {
                $aca3=$ing->acabado_impresion_3;
            }
            ?>
		<select name="acabado_impresion_3" onchange="procesosInternos();carga_ajax_obtenerKilos(this.value,'variable_externo_3'); carga_ajax_obtenerInfoTrabajosInternos(this.value,'infoPrecio3');"  style="width: 500px;">
                <option value="">Seleccione......</option>                         
                <?php
                foreach($internos as $interno)
                {
                ?>
                <option value="<?php echo $interno->id?>" <?php if($aca3==$interno->id){echo 'selected="selected"';}?>><?php echo $interno->caracteristicas?></option>
                <?php
                }
                ?>
                </select><a href="#" id="infoPrecio3"></a>
            <?php  $variable3=$this->acabados_model->getAcabadosPorId2($aca3); ?> 
            </br>
            <div id="variable_externo_3" <?php if($ing->input_variable_externo_3==0) { ?> style="display:none;"<?php }?>>
            	<input type="text" name="input_variable_externo_3"  value="<?php echo $ing->input_variable_externo_3; ?>" />&nbsp;&nbsp;<?php echo $variable3 ?>    
            </div>                    
		</div>
	</div>
    
    <h3>Trabajos Externos</h3>    
    
    <div class="control-group">
	<label class="control-label" for="usuario">Acabado Impresión Externo 1</label>
	<div class="controls">
        <?php
            if($ing->acabado_impresion_4=='')
            {
               $aca4=$datos->impresion_acabado_impresion_4;   
            }else
            {
                $aca4=$ing->acabado_impresion_4;
            }
            ?>
            <select name="acabado_impresion_4" class="chosen-select" onchange="carga_ajax_obtenerKilos(this.value,'variable_externo_4');carga_ajax_obtenerInfo(this.value,'infoNueva');"  style="width: 600px;">
                <option value="">Seleccione......</option>                     
                <?php
                foreach($externos as $externo)
                {
                ?>
                <option value="<?php echo $externo->id?>" <?php if($aca4==$externo->id){echo 'selected="selected"';}?>><?php echo strtoupper($externo->caracteristicas).' ( VALOR: '.$externo->valor_venta.' ) '.$externo->unv ?></option>
                <?php
                }
                ?>
            </select><a href="#" id="infoNueva"></a>
            <?php  $variable4=$this->acabados_model->getAcabadosPorId2($aca4); ?> 
            </br>
            <div id="variable_externo_4" <?php if($ing->input_variable_externo_4==0) { ?> style="display:none;"<?php }?>>
            	<input type="text" name="input_variable_externo_4"  value="<?php echo $ing->input_variable_externo_4; ?>" />&nbsp;&nbsp;  <?php echo $variable4 ?>   
            </div>
	</div>
    </div>

    <div class="control-group">
		<label class="control-label" for="usuario">Acabado Impresión Externo 2</label>
		<div class="controls">
        <?php
            if($ing->acabado_impresion_5=='')
            {
               $aca5=$datos->impresion_acabado_impresion_5;   
            }else
            {
                $aca5=$ing->acabado_impresion_5;
            }
            ?>
                    <select name="acabado_impresion_5" class="chosen-select" onchange="carga_ajax_obtenerKilos(this.value,'variable_externo_5');carga_ajax_obtenerInfo(this.value,'infoNueva2');"  style="width: 500px;">
                <option value="">Seleccione......</option>                     
                <?php
                foreach($externos as $externo)
                {
                ?>
                <option value="<?php echo $externo->id?>" <?php if($aca5==$externo->id){echo 'selected="selected"';}?>><?php echo strtoupper($externo->caracteristicas).' ( VALOR: '.$externo->valor_venta.' ) '.$externo->unv ?></option>
                <?php
                }
                ?>
            </select><a href="#" id="infoNueva2"></a>
            <?php  $variable5=$this->acabados_model->getAcabadosPorId2($aca5); ?> 
            </br>
            <div id="variable_externo_5" <?php if($ing->input_variable_externo_5==0)  { ?> style="display:none;"<?php }?>>
            	<input type="text" name="input_variable_externo_5"  value="<?php echo $ing->input_variable_externo_5; ?>" /> &nbsp;&nbsp; <?php echo $variable5 ?>   
            </div>            
		</div>
	</div>
    
       <div class="control-group">
		<label class="control-label" for="usuario">Acabado Impresión Externo 3</label>
		<div class="controls">
        <?php
            if($ing->acabado_impresion_6=='')
            {
               $aca6=$datos->impresion_acabado_impresion_6;   
            }else
            {
                $aca6=$ing->acabado_impresion_6;
            }
            ?>
                    <select name="acabado_impresion_6" class="chosen-select" onchange="procesosExternos();carga_ajax_obtenerKilos(this.value,'variable_externo_6');carga_ajax_obtenerInfo(this.value,'infoNueva3');"  style="width: 500px;">
                <option value="">Seleccione......</option>                     
                <?php
                foreach($externos as $externo)
                {
                ?>
                <option value="<?php echo $externo->id?>" <?php if($aca6==$externo->id){echo 'selected="selected"';}?>><?php echo strtoupper($externo->caracteristicas).' ( VALOR: '.$externo->valor_venta.' ) '.$externo->unv ?></option>
                <?php
                }
                ?>
            </select><a href="#" id="infoNueva3"></a>
            <?php  $variable6=$this->acabados_model->getAcabadosPorId2($aca6); ?> 
            </br>
            <div id="variable_externo_6" <?php if($ing->input_variable_externo_6==0) { ?> style="display:none;"<?php }?>>
            	<input type="text" name="input_variable_externo_6"  value="<?php echo $ing->input_variable_externo_6; ?>" /> &nbsp;&nbsp;<?php echo $variable6 ?>   
            </div>               
		</div>
	</div>
    
    
    
     <h3>Procesos Especiales</h3>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Folia</label>
		<div class="controls">
                    <select name="folia" style="width: 100px;" onchange="cambiaFolia_Cotizacion(); cambiaFolia();">
                        <?php
                        if(sizeof($ing)==0)
                        {
                            $procesos_especiales=$datos->procesos_especiales_folia;
                            ?>
                            <option value="NO" <?php if($datos->procesos_especiales_folia=="NO"){echo 'selected="true"';}?>>NO</option>
                            <option value="SI" <?php if($datos->procesos_especiales_folia=="SI"){echo 'selected="true"';}?>>SI</option>
                            <?php
                        }else
                        {
                            $procesos_especiales=$ing->procesos_especiales_folia;
                            ?>
                            <option value="NO" <?php if($ing->procesos_especiales_folia=="NO"){echo 'selected="true"';}?>>NO</option>
                            <option value="SI" <?php if($ing->procesos_especiales_folia=="SI"){echo 'selected="true"';}?>>SI</option>
                            <?php            
                        }
                        ?>
                    </select> 
                    <span id="folia_se_a" style="display: <?php if($procesos_especiales=='SI'){echo 'block';}else{echo 'none';}?>;">
                        <select name="folia_se" id="folia_se" onchange="repeticion(this);">
                        <?php
                        if(sizeof($ing)==0)
                        {
                        ?>
                            <option value="Nuevo" <?php if($datos->procesos_especiales_folia_valor=="Nuevo"){echo 'selected="true"';}?>>Nuevo</option>
                            <option value="Repetición" <?php if($datos->procesos_especiales_folia_valor=="Repetición"){echo 'selected="true"';}?>>Repetición</option>                
                        <?php
                        }else
                        {
                        ?>
                            <option value="Nuevo" <?php if($ing->procesos_especiales_folia_valor=="Nuevo"){echo 'selected="true"';}?>>Nuevo</option>
                            <option value="Repetición" <?php if($ing->procesos_especiales_folia_valor=="Repetición"){echo 'selected="true"';}?>>Repetición</option>
                        <?php
                        }
                        ?>
                    </select>
                    </span>
                    <div id="folia1_proceso" style="display:<?php if($procesos_especiales=="SI"){echo 'block';}else{echo 'none';}?>;"> <strong>&nbsp;Proceso Especial (golpe): &nbsp;</strong>                      
                        <select name="folia1_proceso_seletec"  style="width: 500px;" onchange="carga_ajax_obtenerInfoProcesos(this.value,'pt1');">
                            <option value="0">Seleccione......</option>
                            <?php
                            $procesos=$this->procesosespeciales_model->getProcesosEspecialesCotizacion();                
                            if(sizeof($ing)==0){
                            foreach($procesos as $pro)
                            {
                                ?>
                                <option value="<?php echo $pro->id; ?>" title="Procesos <?php echo $pro->caracteristicas; ?>" <?php if($pro->id==$datos->folia1_proceso_seletec){echo 'selected="selected"';}?>><?php echo $pro->caracteristicas; ?> (Valor Venta: <?php echo $pro->valor_venta; ?>)</option>
                                <?php
                            }}else{
                             foreach($procesos as $pro)
                            {
                                ?>
                                <option value="<?php echo $pro->id; ?>" title="Procesos <?php echo $pro->caracteristicas; ?>" <?php if($pro->id==$ing->folia1_proceso_seletec){echo 'selected="selected"';}?>><?php echo $pro->caracteristicas; ?> (Valor Venta: <?php echo $pro->valor_venta; ?>)</option>
                                <?php
                            }   
                            }
                            ?>
                        </select><a id="pt1"></a>            
                    </div><br>
                    <div id="folia1_molde_selected" style="display:<?php if($procesos_especiales=="SI"){echo 'block';}else{echo 'none';}?>;"> <strong>&nbsp;Proceso Especial (molde): &nbsp;</strong>                      
                        <select name="folia1_molde_selected"  style="width: 500px;" onchange="carga_ajax_obtenerInfoProcesos(this.value,'ptm1');">
                            <option value="0">Seleccione......</option>
                            <?php
                            $procesos=$this->procesosespeciales_model->getProcesosEspecialesCotizacion();                
                            if(sizeof($ing)==0){
                            foreach($procesos as $pro)
                            {
                                ?>
                                <option value="<?php echo $pro->id; ?>" title="Procesos <?php echo $pro->caracteristicas; ?>" <?php if($pro->id==$datos->folia1_molde_selected){echo 'selected="selected"';}?>><?php echo $pro->caracteristicas; ?> (Valor Venta: <?php echo $pro->valor_venta; ?>)</option>
                                <?php
                            }}else{
                             foreach($procesos as $pro)
                            {
                                ?>
                                <option value="<?php echo $pro->id; ?>" title="Procesos <?php echo $pro->caracteristicas; ?>" <?php if($pro->id==$ing->folia1_molde_selected){echo 'selected="selected"';}?>><?php echo $pro->caracteristicas; ?> (Valor Venta: <?php echo $pro->valor_venta; ?>)</option>
                                <?php
                            }   
                            }
                            ?>
                        </select><a id="ptm1"></a>            
                    </div>
		</div>                
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Folia 2</label>
		<div class="controls">
		<select name="folia_2" style="width: 100px;" onchange="cambiaFolia2_Cotizacion(); cambiaFolia2();">
                <?php
                if(sizeof($ing)==0)
                {
                    $procesos_especiales2=$datos->procesos_especiales_folia_2;
                    ?>
                    <option value="NO" <?php if($datos->procesos_especiales_folia_2=="NO"){echo 'selected="true"';}?>>NO</option>
                    <option value="SI" <?php if($datos->procesos_especiales_folia_2=="SI"){echo 'selected="true"';}?>>SI</option>
                    <?php
                }else
                {
                    $procesos_especiales2=$ing->procesos_especiales_folia_2;
                    ?>
                    <option value="NO" <?php if($ing->procesos_especiales_folia_2=="NO"){echo 'selected="true"';}?>>NO</option>
                    <option value="SI" <?php if($ing->procesos_especiales_folia_2=="SI"){echo 'selected="true"';}?>>SI</option>
                    <?php            
                }
                ?>
                </select> 
                <span id="folia_se_2_a" style="display: <?php if($procesos_especiales2=='SI'){echo 'block';}else{echo 'none';}?>;">
                <select name="folia_se_2">
                <?php
                    if(sizeof($ing)==0)
                    {
                    ?>
                        <option value="Nuevo" <?php if($datos->procesos_especiales_folia_2_valor=="Nuevo"){echo 'selected="true"';}?>>Nuevo</option>
                        <option value="Repetición" <?php if($datos->procesos_especiales_folia_2_valor=="Repetición"){echo 'selected="true"';}?>>Repetición</option>                                          
                    <?php
                    }else
                    {
                    ?>
                        <option value="Nuevo" <?php if($ing->procesos_especiales_folia_2_valor=="Nuevo"){echo 'selected="true"';}?>>Nuevo</option>
                        <option value="Repetición" <?php if($ing->procesos_especiales_folia_2_valor=="Repetición"){echo 'selected="true"';}?>>Repetición</option>
                    <?php
                    }
                    ?>
                </select>
                </span><div id="folia2_proceso" style="display:<?php if($procesos_especiales2=="SI"){echo 'block';}else{echo 'none';}?>;"><strong>&nbsp;Proceso Especial (golpe):&nbsp; </strong>                   
                        <select name="folia2_proceso_seletec"  style="width: 500px;" onchange="carga_ajax_obtenerInfoProcesos(this.value,'pt2');">
                            <option value="0">Seleccione......</option>
                            <?php
                            $procesos=$this->procesosespeciales_model->getProcesosEspecialesCotizacion();    
                            if(sizeof($ing)==0){
                            foreach($procesos as $pro)
                            {
                                ?>
                                <option value="<?php echo $pro->id; ?>" title="Procesos <?php echo $pro->caracteristicas; ?>" <?php if($pro->id==$datos->folia2_proceso_seletec){echo 'selected="selected"';}?>><?php echo $pro->caracteristicas; ?> (Valor Venta: <?php echo $pro->valor_venta; ?>)</option>
                                <?php
                            }}else{
                             foreach($procesos as $pro)
                            {
                                ?>
                                <option value="<?php echo $pro->id; ?>" title="Procesos <?php echo $pro->caracteristicas; ?>" <?php if($pro->id==$ing->folia2_proceso_seletec){echo 'selected="selected"';}?>><?php echo $pro->caracteristicas; ?> (Valor Venta: <?php echo $pro->valor_venta; ?>)</option>
                                <?php
                            }   
                            }
                            ?>
                        </select><a id="pt2"></a>            
                    </div><br>
                    <div id="folia2_molde_selected" style="display:<?php if($procesos_especiales=="SI"){echo 'block';}else{echo 'none';}?>;"> <strong>&nbsp;Proceso Especial (molde): &nbsp;</strong>                      
                        <select name="folia2_molde_selected"  style="width: 500px;" onchange="carga_ajax_obtenerInfoProcesos(this.value,'ptm2');">
                            <option value="0">Seleccione......</option>
                            <?php
                            $procesos=$this->procesosespeciales_model->getProcesosEspecialesCotizacion();                
                            if(sizeof($ing)==0){
                            foreach($procesos as $pro)
                            {
                                ?>
                                <option value="<?php echo $pro->id; ?>" title="Procesos <?php echo $pro->caracteristicas; ?>" <?php if($pro->id==$datos->folia2_molde_selected){echo 'selected="selected"';}?>><?php echo $pro->caracteristicas; ?> (Valor Venta: <?php echo $pro->valor_venta; ?>)</option>
                                <?php
                            }}else{
                             foreach($procesos as $pro)
                            {
                                ?>
                                <option value="<?php echo $pro->id; ?>" title="Procesos <?php echo $pro->caracteristicas; ?>" <?php if($pro->id==$ing->folia2_molde_selected){echo 'selected="selected"';}?>><?php echo $pro->caracteristicas; ?> (Valor Venta: <?php echo $pro->valor_venta; ?>)</option>
                                <?php
                            }   
                            }
                            ?>
                        </select><a id="ptm2"></a>            
                    </div>
		</div>                
	</div>
    
    <div class="control-group">
            <label class="control-label" for="usuario">Folia 3</label>
            <div class="controls">
		<select name="folia_3" style="width: 100px;" onchange="cambiaFolia3_Cotizacion(); cambiaFolia3();">
                <?php
                if(sizeof($ing)==0)
                {
                    $procesos_especiales3=$datos->procesos_especiales_folia_3;
                ?>
                    <option value="NO" <?php if($datos->procesos_especiales_folia_3=="NO"){echo 'selected="true"';}?>>NO</option>
                    <option value="SI" <?php if($datos->procesos_especiales_folia_3=="SI"){echo 'selected="true"';}?>>SI</option>
                <?php
                }else
                {
                    $procesos_especiales3=$ing->procesos_especiales_folia_3;
                ?>
                    <option value="NO" <?php if($ing->procesos_especiales_folia_3=="NO"){echo 'selected="true"';}?>>NO</option>
                    <option value="SI" <?php if($ing->procesos_especiales_folia_3=="SI"){echo 'selected="true"';}?>>SI</option>
                <?php            
                }
                ?>
                </select> 
                <span id="folia_se_3_a" style="display: <?php if($procesos_especiales3=='SI'){echo 'block';}else{echo 'none';}?>;">
                <select name="folia_se_3">
                <?php
                    if(sizeof($ing)==0)
                    {
                    ?>
                        <option value="Nuevo" <?php if($datos->procesos_especiales_folia_3_valor=="Nuevo"){echo 'selected="true"';}?>>Nuevo</option>
                        <option value="Repetición" <?php if($datos->procesos_especiales_folia_3_valor=="Repetición"){echo 'selected="true"';}?>>Repetición</option>                                           
                    <?php
                    }else
                    {
                    ?>
                        <option value="Nuevo" <?php if($ing->procesos_especiales_folia_3_valor=="Nuevo"){echo 'selected="true"';}?>>Nuevo</option>
                        <option value="Repetición" <?php if($ing->procesos_especiales_folia_3_valor=="Repetición"){echo 'selected="true"';}?>>Repetición</option>
                    <?php
                    }
                    ?>
                </select>
                </span><div id="folia3_proceso" style="display:<?php if($procesos_especiales3=="SI"){echo 'block';}else{echo 'none';}?>;"><strong>&nbsp;Proceso Especial (golpe):&nbsp; </strong>                          
                    <select name="folia3_proceso_seletec"  style="width: 500px;" onchange="carga_ajax_obtenerInfoProcesos(this.value,'pt3'); cambiaFolia3()">
                            <option value="0">Seleccione......</option>
                            <?php
                            $procesos=$this->procesosespeciales_model->getProcesosEspecialesCotizacion(); 
                            if(sizeof($ing)==0){
                            foreach($procesos as $pro)
                            {
                                ?>
                                <option value="<?php echo $pro->id; ?>" title="Procesos <?php echo $pro->caracteristicas; ?>" <?php if($pro->id==$datos->folia3_proceso_seletec){echo 'selected="selected"';}?>><?php echo $pro->caracteristicas; ?> (Valor Venta: <?php echo $pro->valor_venta; ?>)</option>
                                <?php
                            }}else{
                             foreach($procesos as $pro)
                            {
                                ?>
                                <option value="<?php echo $pro->id; ?>" title="Procesos <?php echo $pro->caracteristicas; ?>" <?php if($pro->id==$ing->folia3_proceso_seletec){echo 'selected="selected"';}?>><?php echo $pro->caracteristicas; ?> (Valor Venta: <?php echo $pro->valor_venta; ?>)</option>
                                <?php
                            }   
                            }
                            ?>
                        </select><a id="pt3"></a>            
                    </div><br>
                    <div id="folia3_molde_selected" style="display:<?php if($procesos_especiales3=="SI"){echo 'block';}else{echo 'none';}?>;"> <strong>&nbsp;Proceso Especial (molde): &nbsp;</strong>                      
                        <select name="folia3_molde_selected"  style="width: 500px;" onchange="carga_ajax_obtenerInfoProcesos(this.value,'ptm3');">
                            <option value="0">Seleccione......</option>
                            <?php
                            $procesos=$this->procesosespeciales_model->getProcesosEspecialesCotizacion();                
                            if(sizeof($ing)==0){
                            foreach($procesos as $pro)
                            {
                                ?>
                                <option value="<?php echo $pro->id; ?>" title="Procesos <?php echo $pro->caracteristicas; ?>" <?php if($pro->id==$datos->folia3_molde_selected){echo 'selected="selected"';}?>><?php echo $pro->caracteristicas; ?> (Valor Venta: <?php echo $pro->valor_venta; ?>)</option>
                                <?php
                            }}else{
                             foreach($procesos as $pro)
                            {
                                ?>
                                <option value="<?php echo $pro->id; ?>" title="Procesos <?php echo $pro->caracteristicas; ?>" <?php if($pro->id==$ing->folia3_molde_selected){echo 'selected="selected"';}?>><?php echo $pro->caracteristicas; ?> (Valor Venta: <?php echo $pro->valor_venta; ?>)</option>
                                <?php
                            }   
                            }
                            ?>
                        </select><a id="ptm3"></a>            
                    </div>
		</div>                
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Cuño</label>
		<div class="controls">
		<select name="cuno" style="width: 100px;" onchange="cambiaCunoIng();">
                <?php
                if(sizeof($ing)==0)
                {
                    $procesos_especiales4=$datos->procesos_especiales_cuno;
                ?>
                    <option value="NO" <?php if($datos->procesos_especiales_cuno=="NO"){echo 'selected="true"';}?>>NO</option>
                    <option value="SI" <?php if($datos->procesos_especiales_cuno=="SI"){echo 'selected="true"';}?>>SI</option>
                <?php
                }else
                {
                    $procesos_especiales4=$ing->procesos_especiales_cuno;
                ?>
                    <option value="NO" <?php if($ing->procesos_especiales_cuno=="NO"){echo 'selected="true"';}?>>NO</option>
                    <option value="SI" <?php if($ing->procesos_especiales_cuno=="SI"){echo 'selected="true"';}?>>SI</option>
                <?php            
                }
                ?>
                
                
            </select> 
            <span id="cuno_se_a" style="display: <?php if($procesos_especiales4=='SI'){echo 'block';}else{echo 'none';}?>;">
            <select name="cuno_se">
                <?php
                if(sizeof($ing)==0)
                {
                ?>
                    <option value="Nuevo" <?php if($datos->procesos_especiales_cuno_valor=="Nuevo"){echo 'selected="true"';}?>>Nuevo</option>
                    <option value="Repetición" <?php if($datos->procesos_especiales_cuno_valor=="Repetición"){echo 'selected="true"';}?>>Repetición</option>                                         
                <?php
                }else
                {
                ?>
                    <option value="Nuevo" <?php if($ing->procesos_especiales_cuno_valor=="Nuevo"){echo 'selected="true"';}?>>Nuevo</option>
                    <option value="Repetición" <?php if($ing->procesos_especiales_cuno_valor=="Repetición"){echo 'selected="true"';}?>>Repetición</option>
                <?php
                }
                ?>
            </select>
            </span><div id="cuno1_proceso" style="display:<?php if($procesos_especiales4=="SI"){echo 'block';}else{echo 'none';}?>;"><strong>&nbsp;Proceso Especial (golpe):&nbsp; </strong>                        
                        <select name="cuno1_proceso_seletec"  style="width: 500px;" onchange="carga_ajax_obtenerInfoProcesos(this.value,'pt4');">
                            <option value="0">Seleccione......</option>
                            <?php
                            $procesos=$this->procesosespeciales_model->getProcesosEspecialesCotizacion(); 
                            if(sizeof($ing)==0){
                            foreach($procesos as $pro)
                            {
                                ?>
                                <option value="<?php echo $pro->id; ?>" title="Procesos <?php echo $pro->caracteristicas; ?>" <?php if($pro->id==$datos->cuno1_proceso_seletec){echo 'selected="selected"';}?>><?php echo $pro->caracteristicas; ?> (Valor Venta: <?php echo $pro->valor_venta; ?>)</option>
                                <?php
                            }}else{
                            foreach($procesos as $pro)
                            {
                                ?>
                                <option value="<?php echo $pro->id; ?>" title="Procesos <?php echo $pro->caracteristicas; ?>" <?php if($pro->id==$ing->cuno1_proceso_seletec){echo 'selected="selected"';}?>><?php echo $pro->caracteristicas; ?> (Valor Venta: <?php echo $pro->valor_venta; ?>)</option>
                                <?php
                            }    
                            }
                            ?>
                        </select><a id="pt4"></a>            
                    </div><br>         
                <div id="cuno1_molde_selected" style="display:<?php if($procesos_especiales4=="SI"){echo 'block';}else{echo 'none';}?>;"><strong>&nbsp;Proceso Especial (molde):&nbsp; </strong>                        
                        <select name="cuno1_molde_selected"  style="width: 500px;" onchange="carga_ajax_obtenerInfoProcesos(this.value,'ptm4');">
                            <option value="0">Seleccione......</option>
                            <?php
                            $procesos=$this->procesosespeciales_model->getProcesosEspecialesCotizacion(); 
                            if(sizeof($ing)==0){
                            foreach($procesos as $pro)
                            {
                                ?>
                                <option value="<?php echo $pro->id; ?>" title="Procesos <?php echo $pro->caracteristicas; ?>" <?php if($pro->id==$datos->cuno1_molde_selected){echo 'selected="selected"';}?>><?php echo $pro->caracteristicas; ?> (Valor Venta: <?php echo $pro->valor_venta; ?>)</option>
                                <?php
                            }}else{
                            foreach($procesos as $pro)
                            {
                                ?>
                                <option value="<?php echo $pro->id; ?>" title="Procesos <?php echo $pro->caracteristicas; ?>" <?php if($pro->id==$ing->cuno1_molde_selected){echo 'selected="selected"';}?>><?php echo $pro->caracteristicas; ?> (Valor Venta: <?php echo $pro->valor_venta; ?>)</option>
                                <?php
                            }    
                            }
                            ?>
                        </select><a id="ptm4"></a>            
                    </div>         
                 
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Cuño 2</label>
		<div class="controls">
		<select name="cuno_2" style="width: 100px;" onchange="cambiaCuno2();">
                <?php
                if(sizeof($ing)==0)
                {
                    $procesos_especiales5=$datos->procesos_especiales_cuno_2;
                    ?>
                    <option value="NO" <?php if($datos->procesos_especiales_cuno_2=="NO"){echo 'selected="true"';}?>>NO</option>
                    <option value="SI" <?php if($datos->procesos_especiales_cuno_2=="SI"){echo 'selected="true"';}?>>SI</option>
                    <?php
                }else
                {
                    $procesos_especiales5=$ing->procesos_especiales_cuno_2;
                    ?>
                    <option value="NO" <?php if($ing->procesos_especiales_cuno_2=="NO"){echo 'selected="true"';}?>>NO</option>
                    <option value="SI" <?php if($ing->procesos_especiales_cuno_2=="SI"){echo 'selected="true"';}?>>SI</option>
                    <?php            
                }
                ?>
                
                
            </select> 
            <span id="cuno_se_2_a" style="display: <?php if($procesos_especiales5=='SI'){echo 'block';}else{echo 'none';}?>;">
            <select name="cuno_se_2">
            <?php
                if(sizeof($ing)==0)
                {
                ?>
                    <option value="Nuevo" <?php if($datos->procesos_especiales_cuno_2_valor=="Nuevo"){echo 'selected="true"';}?>>Nuevo</option>
                    <option value="Repetición" <?php if($datos->procesos_especiales_cuno_2_valor=="Repetición"){echo 'selected="true"';}?>>Repetición</option>                                          
                <?php
                }else
                {
                ?>
                    <option value="Nuevo" <?php if($ing->procesos_especiales_cuno_2_valor=="Nuevo"){echo 'selected="true"';}?>>Nuevo</option>
                    <option value="Repetición" <?php if($ing->procesos_especiales_cuno_2_valor=="Repetición"){echo 'selected="true"';}?>>Repetición</option>
                <?php
                }
                ?>
            </select>
            </span><div id="cuno2_proceso" style="display:<?php if($procesos_especiales5=="SI"){echo 'block';}else{echo 'none';}?>;"><strong>&nbsp;Proceso Especial (golpe):&nbsp; </strong>                          
                        <select name="cuno2_proceso_seletec" style="width: 500px;" onchange="carga_ajax_obtenerInfoProcesos(this.value,'pt5');">
                            <option value="0">Seleccione......</option>
                            <?php
                            $procesos=$this->procesosespeciales_model->getProcesosEspecialesCotizacion();
                            if(sizeof($ing)==0){
                            foreach($procesos as $pro)
                            {
                                ?>
                                <option value="<?php echo $pro->id; ?>" title="Procesos <?php echo $pro->caracteristicas; ?>" <?php if($pro->id==$datos->cuno2_proceso_seletec){echo 'selected="selected"';}?>><?php echo $pro->caracteristicas; ?> (Valor Venta: <?php echo $pro->valor_venta; ?>)</option>
                                <?php
                            }}else{
                            foreach($procesos as $pro)
                            {
                                ?>
                                <option value="<?php echo $pro->id; ?>" title="Procesos <?php echo $pro->caracteristicas; ?>" <?php if($pro->id==$ing->cuno2_proceso_seletec){echo 'selected="selected"';}?>><?php echo $pro->caracteristicas; ?> (Valor Venta: <?php echo $pro->valor_venta; ?>)</option>
                                <?php
                            }    
                            }
                            ?>
                        </select><a id="pt5"></a>            
                    </div><br>         
                <div id="cuno2_molde_selected" style="display:<?php if($procesos_especiales5=="SI"){echo 'block';}else{echo 'none';}?>;"><strong>&nbsp;Proceso Especial (molde):&nbsp; </strong>                        
                        <select name="cuno2_molde_selected"  style="width: 500px;" onchange="carga_ajax_obtenerInfoProcesos(this.value,'ptm5');">
                            <option value="0">Seleccione......</option>
                            <?php
                            $procesos=$this->procesosespeciales_model->getProcesosEspecialesCotizacion(); 
                            if(sizeof($ing)==0){
                            foreach($procesos as $pro)
                            {
                                ?>
                                <option value="<?php echo $pro->id; ?>" title="Procesos <?php echo $pro->caracteristicas; ?>" <?php if($pro->id==$datos->cuno2_molde_selected){echo 'selected="selected"';}?>><?php echo $pro->caracteristicas; ?> (Valor Venta: <?php echo $pro->valor_venta; ?>)</option>
                                <?php
                            }}else{
                            foreach($procesos as $pro)
                            {
                                ?>
                                <option value="<?php echo $pro->id; ?>" title="Procesos <?php echo $pro->caracteristicas; ?>" <?php if($pro->id==$ing->cuno2_molde_selected){echo 'selected="selected"';}?>><?php echo $pro->caracteristicas; ?> (Valor Venta: <?php echo $pro->valor_venta; ?>)</option>
                                <?php
                            }    
                            }
                            ?>
                        </select><a id="ptm5"></a>            
                    </div>         
                 
		</div>
	</div>
    
    <h3>Piezas Adicionales</h3>
    
    
    <div class="control-group">
        <label class="control-label" for="usuario">Lleva Mica</label>
        <div class="controls">
                <select name="lleva_mica" id="lleva_mica" style="width: 100px;" onchange="ver_informacion('largo_ancho_mica');">
                    <option value="">Seleccione......</option>    
                    <?php if(sizeof($ing)>0) { ?>
                        <option value="NO" <?php if($ing->lleva_mica=="NO"){echo 'selected="selected"';}?>>NO</option>
                        <option value="SI" <?php if($ing->lleva_mica=="SI"){echo 'selected="selected"';}?>>SI</option>
                    <?php } else { ?>   
                        <option value="NO" <?php if($_POST["lleva_mica"]=="NO"){echo 'selected="selected"';}?>>NO</option>
                        <option value="SI" <?php if($_POST["lleva_mica"]=="SI"){echo 'selected="selected"';}?>>SI</option>                    
                    <?php }  ?>                     
                </select> 
        </div>
    </div>    
    <?php  //echo print_r($ing);  ?>
    <div class="control-group" id="largo_ancho_mica" <?php if  ((trim($ing->lleva_mica)=="NO") || ($ing->lleva_mica==''))  {?> style="display:none;" <?php } ?>>
		<label class="control-label" for="usuario"><strong>Tamaño Mica Ancho x Largo :</strong><strong style="color: red;">(*)</strong></label>
		<div class="controls">
                    <?php if(sizeof($ing)>0) { ?>
			<input type="text" name="largo_mica" onblur="tamano2NoMasDe100();" style="width: 100px;" id="largo_mica" onkeypress="return soloNumerosConPuntos(event)"  value="<?php echo $ing->largo_mica; ?>" placeholder="0" onblur="tamano1NoMasDe100(); funcionDecimales('largo_mica',Formato);" /> X <input type="text" name="ancho_mica" id="ancho_mica" style="width: 100px;" onkeypress="return soloNumerosConPuntos(event)" value="<?php echo $ing->ancho_mica; ?>" placeholder="0" onblur="tamano2NoMasDe100(); funcionDecimales('ancho_mica',Formato);" /> Cms
                    <?php } else { ?>   
			<input type="text" name="largo_mica" onblur="tamano2NoMasDe100();" style="width: 100px;" id="largo_mica" onkeypress="return soloNumerosConPuntos(event)"  value="<?php echo $_POST["largo_mica"]; ?>" placeholder="0" onblur="tamano1NoMasDe100(); funcionDecimales('largo_mica',Formato);" /> X <input type="text" name="ancho_mica" id="ancho_mica" style="width: 100px;" onkeypress="return soloNumerosConPuntos(event)" value="<?php echo $_POST["ancho_mica"]; ?>" placeholder="0" onblur="tamano2NoMasDe100(); funcionDecimales('ancho_mica',Formato);" /> Cms
                    <?php }  ?>                       
		</div>
	</div>    
    
    <div class="control-group">
		<label class="control-label" for="usuario">Piezas Adicionales</label>
		<div class="controls">
                    <!--descripcion_piezas('piezas_adicionales','descripcion_pieza');-->
                    <select name="piezas_adicionales" id="piezas_adicionales" class="chosen-select" onchange="carga_ajax_obtenerInfoPiezas(this.value,'infoPrecioP1');">
                <option value="0">No lleva.....</option>
                 <?php
                $piezas=$this->cotizaciones_model->getPiezasAdicionales();
                foreach($piezas as $pieza)
                {
                    if(sizeof($ing)==0)
                    {
                        $piezas_adicionales=$datos->piezas_adicionales;
                    }else
                    {
                        $piezas_adicionales=$ing->piezas_adicionales;
                    }
                   
                    ?>
                    <option class="piezas_adicionales" value="<?php echo $pieza->piezas_adicionales?>" <?php if($piezas_adicionales==$pieza->piezas_adicionales){echo 'selected="true"';} echo 'descripcion="'.$pieza->valor_venta.' '.$pieza->unidades_de_venta.'"'?>><?php echo $pieza->piezas_adicionales.' Precio:'.$pieza->valor_venta ?></option>
                    <?php
                }
                ?>
                        </select><a href="#" id="infoPrecioP1"></a><a id="descripcion_pieza" style="color:#BBBBBB"> [<?php echo $ing->piezas_adicionales; ?>] </a>
                        
		</div>
	</div>
    
	 <div class="control-group">
		<label class="control-label" for="usuario">Piezas Adicionales 2</label>
		<div class="controls">
			<select name="piezas_adicionales2" id="piezas_adicionales2" class="chosen-select" onchange="carga_ajax_obtenerInfoPiezas(this.value,'infoPrecioP2');">
                <option value="0">No lleva.....</option>
                 <?php
                $piezas=$this->cotizaciones_model->getPiezasAdicionales();
                foreach($piezas as $pieza)
                {
                    if(sizeof($ing)==0)
                    {
                        $piezas_adicionales=$datos->piezas_adicionales2;
                    }else
                    {
                        $piezas_adicionales=$ing->piezas_adicionales2;
                    }
                   
                    ?>
                    <option value="<?php echo $pieza->piezas_adicionales?>" <?php if($piezas_adicionales==$pieza->piezas_adicionales){echo 'selected="true"';} echo 'descripcion="'.$pieza->valor_venta.' '.$pieza->unidades_de_venta.'"'?>><?php echo $pieza->piezas_adicionales.' Precio:'.$pieza->valor_venta ?></option>
                    <?php
                }
                ?>
                        </select><a href="#" id="infoPrecioP2"></a><a id="descripcion_pieza2" style="color:#BBBBBB"> [<?php echo $ing->piezas_adicionales2; ?>] </a>
		</div>
	</div>
	
		 <div class="control-group">
		<label class="control-label" for="usuario">Piezas Adicionales 3</label>
		<div class="controls">
		<select name="piezas_adicionales3" id="piezas_adicionales3" class="chosen-select" onchange="carga_ajax_obtenerInfoPiezas(this.value,'infoPrecioP3');">
                <option value="0">No lleva.....</option>
                 <?php
                $piezas=$this->cotizaciones_model->getPiezasAdicionales();
                foreach($piezas as $pieza)
                {
                    if(sizeof($ing)==0)
                    {
                        $piezas_adicionales=$datos->piezas_adicionales3;
                    }else
                    {
                        $piezas_adicionales=$ing->piezas_adicionales3;
                    }
                   
                    ?>
                    <option value="<?php echo $pieza->piezas_adicionales?>" <?php if($piezas_adicionales==$pieza->piezas_adicionales){echo 'selected="true"';} echo 'descripcion="'.$pieza->valor_venta.' '.$pieza->unidades_de_venta.'"'?>><?php echo $pieza->piezas_adicionales.' Precio:'.$pieza->valor_venta ?></option>
                    <?php
                }
                ?>
                </select><a href="#" id="infoPrecioP3"></a><a id="descripcion_pieza3"  style="color:#BBBBBB"> [<?php echo $ing->piezas_adicionales3; ?>] </a>
		</div>
	</div>
	
    <div class="control-group" id="producto">
		<label class="control-label" for="usuario">Detalle Piezas Adicionales</label>
		<div class="controls">
                    <?php if(sizeof($ing)>0) { ?>
			<input type="text" name="detalle_piezas_adicionales" placeholder="Detalle Piezas Adicionales" value="<?php echo $ing->detalle_piezas_adicionales?>" />
                    <?php } else { ?>   
			<input type="text" name="detalle_piezas_adicionales" placeholder="Detalle Piezas Adicionales" value="<?php echo $_POST["detalle_piezas_adicionales"]?>" />
                    <?php }  ?>                      
         
		</div>
	</div>
    
     <div class="control-group">
		<label class="control-label" for="usuario">Comentarios Piezas Adicionales</label>
		<div class="controls">
                 <?php
                 if(sizeof($ing)>0)
                    {
                        $comentario_piezas_adicionales=strip_tags($ing->comentario_piezas_adicionales);
                    }elseif(sizeof($datos)>0)
                    {
                        $comentario_piezas_adicionales=strip_tags($datos->comentario_piezas_adicionales);
                    } 
                    else {
                        $comentario_piezas_adicionales=$_POST["comentario_piezas_adicionales"];
                    }
                    ?>                    
                    <textarea id="contenido5" name="comentario_piezas_adicionales" placeholder="Observaciones"><?php echo $comentario_piezas_adicionales?></textarea>
		</div>
	</div>
    
    
    <h3>Pegado</h3>
    
      
    <div class="control-group">
		<label class="control-label" for="usuario">Pegado</label>
		<div class="controls">
		<select name="pegado" onchange="ValidarPegado(this.value)">
                    <option value="">Seleccione......</option>    
                    <?php if(sizeof($ing)>0) { ?>
                        <option value="SI" <?php if($ing->pegado=="SI"){echo 'selected="selected"';}?>>SI</option>
                        <option value="NO" <?php if($ing->pegado=="NO"){echo 'selected="selected"';}?>>NO</option>
                    <?php } else { ?>   
                        <option value="SI" <?php if($_POST["pegado"]=="SI"){echo 'selected="selected"';}?>>SI</option>
                        <option value="NO" <?php if($_POST["pegado"]=="NO"){echo 'selected="selected"';}?>>NO</option>                
                    <?php }  ?>                   
                </select>
            <br />
		</div>
	</div>
    
    
    <div class="control-group" id="adhesivo">
		<label class="control-label" for="id_antiguo">Adhesivos</label>
		<div class="controls">
		    <select name="adhesivo" onchange="pegadoyAdhesivos2(this.value)">
                    <option value="">Seleccione......</option>                        
                   <?php
                   foreach($adhesivos as $adhesivo)
                   {
                    ?>
                    <?php if(sizeof($ing)>0) { ?>
                        <option value="<?php echo $adhesivo->id?>" <?php if($ing->id_adhesivo==$adhesivo->id){echo 'selected="selected"';}?>><?php echo $adhesivo->nombre?> (<?php echo $adhesivo->codigo?>)</option>
                    <?php } else { ?>   
                        <option value="<?php echo $adhesivo->id?>" <?php if($_POST["adhesivo"]==$adhesivo->id){echo 'selected="selected"';}?>><?php echo $adhesivo->nombre?> (<?php echo $adhesivo->codigo?>)</option>
                    <?php }  ?>   
                    <?php
                   }
                   ?>
            </select>
	
		</div>
	</div> 
    
     <div class="control-group" style="display: <?php if($ing->id_adhesivo==2){echo 'block';}?>;" id="lleva_aletas">
		<label class="control-label" for="usuario">Lleva aletas dobladas</label>
		<div class="controls">
		<select name="lleva_aletas">
                    <option value="">Seleccione......</option>   
                    <?php if(sizeof($ing)>0) { ?>
                        <option value="SI" <?php if($ing->lleva_aletas=="SI"){echo 'selected="selected"';}?>>SI</option>
                        <option value="NO" <?php if($ing->lleva_aletas=="NO"){echo 'selected="selected"';}?>>NO</option>
                    <?php } else { ?>   
                        <option value="SI" <?php if($_POST["lleva_aletas"]=="SI"){echo 'selected="selected"';}?>>SI</option>
                        <option value="NO" <?php if($_POST["lleva_aletas"]=="NO"){echo 'selected="selected"';}?>>NO</option>                
                    <?php }  ?>                        
                </select> 
		</div>
	</div>
    
    <div class="control-group" style="display: <?php if($ing->id_adhesivo==2){echo 'block';}?>;" id="total_aplicaciones_adhesivo">
		<label class="control-label" for="usuario">Total de aplicaciones con este adhesivo</label>
		<div class="controls">
                    <?php if(sizeof($ing)>0) { ?>
                        <input type="text" name="total_aplicaciones_adhesivo" value="<?php echo $ing->total_aplicaciones_adhesivo?>" placeholder="Total de aplicaciones con este adhesivo" />
                    <?php } else { ?>   
                        <input type="text" name="total_aplicaciones_adhesivo" value="<?php echo $_POST["total_aplicaciones_adhesivo"]?>" placeholder="Total de aplicaciones con este adhesivo" />
                   <?php }  ?>                      
		</div>
	</div>

    
    <div class="control-group" id="doblado">
		<label class="control-label" for="usuario">Doblado</label>
		<div class="controls">
                <select name="doblado">
                <option value="">Seleccione......</option>                            
                    <?php if(sizeof($ing)>0) { ?>
                        <option value="SI" <?php if($ing->doblado=="SI"){echo 'selected="selected"';}?>>SI</option>
                        <option value="NO" <?php if($ing->doblado=="NO"){echo 'selected="selected"';}?>>NO</option>
                    <?php } else { ?>   
                        <option value="SI" <?php if($_POST["doblado"]=="SI"){echo 'selected="selected"';}?>>SI</option>
                        <option value="NO" <?php if($_POST["doblado"]=="NO"){echo 'selected="selected"';}?>>NO</option>                
                    <?php }  ?>                  
                </select>
            <br />
		</div>
	</div>
    
    <div class="control-group" id="empaquetado">
		<label class="control-label" for="usuario">Empaquetado</label>
		<div class="controls">
		<select name="empaquetado">
                    <option value="">Seleccione......</option> 
                    <?php if(sizeof($ing)>0) { ?>
                        <option value="SI" <?php if($ing->empaquetado=="SI"){echo 'selected="selected"';}?>>SI</option>
                        <option value="NO" <?php if($ing->empaquetado=="NO"){echo 'selected="selected"';}?>>NO</option>
                    <?php } else { ?>   
                        <option value="SI" <?php if($_POST["empaquetado"]=="SI"){echo 'selected="selected"';}?>>SI</option>
                        <option value="NO" <?php if($_POST["empaquetado"]=="NO"){echo 'selected="selected"';}?>>NO</option>                
                    <?php }  ?>                      
                </select>
            <br />
		</div>
	</div>

    <div class="control-group" id="pegado_puntos">
		<label class="control-label" for="usuario">Pegado puntos</label>
		<div class="controls">
		<select name="pegado_puntos">
                <option value="">Seleccione......</option> 
                    <?php if(sizeof($ing)>0) { ?>
                        <option value="1" <?php if($ing->pegado_puntos=="1"){echo 'selected="selected"';}?>>1 Punto</option>
                        <option value="2" <?php if($ing->pegado_puntos=="2"){echo 'selected="selected"';}?>>2 Punto</option>
                        <option value="3" <?php if($ing->pegado_puntos=="3"){echo 'selected="selected"';}?>>3 Punto</option>
                        <option value="4" <?php if($ing->pegado_puntos=="4"){echo 'selected="selected"';}?>>4 Punto</option>
                        <option value="5" <?php if($ing->pegado_puntos=="5"){echo 'selected="selected"';}?>>5 Punto</option>
                        <option value="6" <?php if($ing->pegado_puntos=="6"){echo 'selected="selected"';}?>>6 Punto</option>
                    <?php } else { ?>   
                        <option value="1" <?php if($_POST["pegado_puntos"]=="1"){echo 'selected="selected"';}?>>1 Punto</option>
                        <option value="2" <?php if($_POST["pegado_puntos"]=="2"){echo 'selected="selected"';}?>>2 Punto</option>
                        <option value="3" <?php if($_POST["pegado_puntos"]=="3"){echo 'selected="selected"';}?>>3 Punto</option>
                        <option value="4" <?php if($_POST["pegado_puntos"]=="4"){echo 'selected="selected"';}?>>4 Punto</option>
                        <option value="5" <?php if($_POST["pegado_puntos"]=="5"){echo 'selected="selected"';}?>>5 Punto</option>
                        <option value="6" <?php if($_POST["pegado_puntos"]=="6"){echo 'selected="selected"';}?>>6 Punto</option>
                    <?php }  ?>                   
            </select>
		</div>
	</div>
    
    <div class="control-group" id="cm_pegado_puntos">
		<label class="control-label" for="usuario">Centímetros de línea de pegado</label>
		<div class="controls">
                    <?php if(sizeof($ing)>0) { ?>
                        <input type="text" name="pegado_cantidad_puntos" value="<?php echo $ing->pegado_cantidad_puntos?>" />
                    <?php } else { ?>   
                        <input type="text" name="pegado_cantidad_puntos" value="<?php echo $_POST["pegado_cantidad_puntos"]?>" />
                    <?php }  ?>                      
		</div>
	</div>
    
    <div class="control-group" id="tipo_fondo">
		<label class="control-label" for="usuario">Tipo fondo</label>
		<div class="controls">
                <select name="tipo_fondo">
                    <option value="">Seleccione......</option> 
                    <?php if(sizeof($ing)>0) { ?>
                        <option value="Automático" <?php if($ing->tipo_fondo=="Automático"){echo 'selected="selected"';}?>>Automático</option>
                        <option value="Americano" <?php if($ing->tipo_fondo=="Americano"){echo 'selected="selected"';}?>>Americano</option>
                        <option value="De solapa" <?php if($ing->tipo_fondo=="De solapa"){echo 'selected="selected"';}?>>De solapa</option>
                        <option value="Otro" <?php if($ing->tipo_fondo=="Otro"){echo 'selected="selected"';}?>>Otro</option>
                    <?php } else { ?>
                        <option value="Automático" <?php if($_POST["tipo_fondo"]=="Automático"){echo 'selected="selected"';}?>>Automático</option>
                        <option value="Americano" <?php if($_POST["tipo_fondo"]=="Americano"){echo 'selected="selected"';}?>>Americano</option>
                        <option value="De solapa" <?php if($_POST["tipo_fondo"]=="De solapa"){echo 'selected="selected"';}?>>De solapa</option>
                        <option value="Otro" <?php if($_POST["tipo_fondo"]=="Otro"){echo 'selected="selected"';}?>>Otro</option>
                    <?php }  ?>                      

            </select>
            
		</div>
	</div>

    <div class="control-group"  id="tamano_pieza_a_empaquetar">
		<label class="control-label" for="usuario">Tamaño de pieza a empaquetar</label>
		<div class="controls">
                    <?php if(sizeof($ing)>0) { ?>
			<input type="text" name="tamano_pieza_a_empaquetar_ancho" style="width: 100px;" onkeypress="return soloNumeros(event)" value="<?php echo $ing->tamano_pieza_a_empaquetar_ancho ?>" placeholder="0" /> X <input type="text" name="tamano_pieza_a_empaquetar_largo" style="width: 100px;" onkeypress="return soloNumeros(event)" value="<?php echo getField('tamano_pieza_a_empaquetar_largo',$datos,$ing) ?>" placeholder="0" /> 
                    <?php } else { ?>
			<input type="text" name="tamano_pieza_a_empaquetar_ancho" style="width: 100px;" onkeypress="return soloNumeros(event)" value="<?php echo $_POST["tamano_pieza_a_empaquetar_ancho"] ?>" placeholder="0" /> X <input type="text" name="tamano_pieza_a_empaquetar_largo" style="width: 100px;" onkeypress="return soloNumeros(event)" value="<?php echo $_POST['tamano_pieza_a_empaquetar_largo']//getField('tamano_pieza_a_empaquetar_largo',$datos,$ing) ?>" placeholder="0" /> 
                    <?php }  ?>                       
		</div>
	</div>
    
    <div class="control-group" id="es_para_maquina">
		<label class="control-label" for="usuario">Es para máquina? (Pegado automatico)</label>
		<div class="controls">
			<select name="es_una_maquina">
                    <option value="">Seleccione......</option> 
                    <?php if(sizeof($ing)>0) { ?>
                        <option value="NO" <?php if($ing->es_una_maquina=="NO"){echo 'selected="selected"';}?>>NO</option>
                        <option value="SI" <?php if($ing->es_una_maquina=="SI"){echo 'selected="selected"';}?>>SI</option>
                    <?php } else { ?>   
                        <option value="SI" <?php if($_POST["es_una_maquina"]=="SI"){echo 'selected="selected"';}?>>SI</option>
                        <option value="NO" <?php if($_POST["es_una_maquina"]=="NO"){echo 'selected="selected"';}?>>NO</option>                
                    <?php }  ?>                      

                
            </select>
		</div>
	</div>
     <h3>Otros datos</h3>
    
    <div class="control-group" id="producto">
		<label class="control-label" for="usuario">Es impresión compartida? (% porcentaje de cada producto)</label>
		<div class="controls">
                    <?php if(sizeof($ing)>0) { ?>
			<input type="text" name="impresion_compartida" placeholder="Es impresión compartida? (% porcentaje de cada producto)" id="impresion_compartida" onkeypress="return soloNumeros(event)" onblur="formatear(this.value,this.id)" value="<?php echo $ing->impresion_compartida?>" />
                    <?php } else { ?>
			<input type="text" name="impresion_compartida" placeholder="Es impresión compartida? (% porcentaje de cada producto)" id="impresion_compartida" onkeypress="return soloNumeros(event)" onblur="formatear(this.value,this.id)" value="<?php echo $_POST["impresion_compartida"]?>" />
                    <?php }  ?>                      
         
		</div>
	</div>
    
     <div class="control-group">
		<label class="control-label" for="usuario"><strong>El producto final contiene otras cotizaciones?</strong></label>
		<div class="controls">
		<select name="contiene_otras_cotizaciones" style="width: 100px;" onchange="cotizaciones_grupales(this.value);">
                 <option value="">Seleccione......</option>   
                    <?php if(sizeof($ing)>0) { ?>
                        <option value="NO" <?php if($ing->contiene_otras_cotizaciones=="NO"){echo 'selected="selected"';}?>>NO</option>
                        <option value="SI" <?php if($ing->contiene_otras_cotizaciones=="SI"){echo 'selected="selected"';}?>>SI</option>
                        <option value="Primera" <?php if($ing->contiene_otras_cotizaciones=="Primera"){echo 'selected="selected"';}?>>SI, es la primera</option>
                    <?php } else { ?> 
                        <option value="NO" <?php if($_POST["contiene_otras_cotizaciones"]=="NO"){echo 'selected="selected"';}?>>NO</option>
                        <option value="SI" <?php if($_POST["contiene_otras_cotizaciones"]=="SI"){echo 'selected="selected"';}?>>SI</option>
                        <option value="Primera" <?php if($_POST["contiene_otras_cotizaciones"]=="Primera"){echo 'selected="selected"';}?>>SI, es la primera</option>
                    <?php }  ?>                       

                </select> 
		<div id="grupales_numero_cotizacion" style="visibility: hidden">	
                    <?php if(sizeof($ing)>0) { ?>
                        N°<input type="text" name="numero_cotizacion" placeholder="Número cotización" onkeypress="return soloNumeros(event)" value="<?php echo $ing->numero_cotizacion?>" />
                    <?php } else { ?>
                        N°<input type="text" name="numero_cotizacion" placeholder="Número cotización" onkeypress="return soloNumeros(event)" value="<?php echo $_POST["numero_cotizacion"]?>" />
                    <?php }  ?>                       
		</div>	
        <div id="grupales" style="visibility: hidden">
			<input type="text" name="nombre_grupo" placeholder="Nombre cotización grupal"/>
		</div>
		</div>
	</div>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Trabajos adicionales</label>
		<div class="controls">
		<select name="trabajos_adicionales" style="width: 100px;">
                <option value="">Seleccione......</option> 
                    <?php if(sizeof($ing)>0) { ?>
                        <option value="NO" <?php if($ing->trabajos_adicionales=="NO"){echo 'selected="selected"';}?>>NO</option>
                        <option value="SI" <?php if($ing->trabajos_adicionales=="SI"){echo 'selected="selected"';}?>>SI</option>
                    <?php } else { ?>   
                        <option value="SI" <?php if($_POST["trabajos_adicionales"]=="SI"){echo 'selected="selected"';}?>>SI</option>
                        <option value="NO" <?php if($_POST["trabajos_adicionales"]=="NO"){echo 'selected="selected"';}?>>NO</option>                
                    <?php }  ?>                   
                </select> 
                    <?php if(sizeof($ing)>0) { ?>
                        <input type="text" name="trabajos_adicionales_glosa" placeholder="Especifique Trabajos" value="<?php echo $ing->trabajos_adicionales_glosa?>" />
                    <?php } else { ?>   
                        <input type="text" name="trabajos_adicionales_glosa" placeholder="Especifique Trabajos" value="<?php echo $_POST["trabajos_adicionales"]?>" />
                    <?php }  ?>                      
        
		</div>
	</div>
  	  <h3>Ingrese archivo de: Información Digital (Cliente)</h3>
    
    <div class="control-group">
		<label class="control-label" for="usuario">Información Digital</label>
		<div class="controls">
			<input type="file" id="file2" name="file2" />  
                        <?php if ($archivo_cliente->archivo!=""){ ?>   
			<div id="nomarch" style="background-color: #ec5c00; color:white; width: 30%;">&nbsp;&nbsp;Archivo Ya fue Cargado con Exito...</div>
                        <?php  } else { ?>  
			<div id="nomarch">Seleccione el Archivo...</div>                        
                        <?php  }  ?>   
		</div>
	</div>	
		
	<?php	
	//} 
	?>
	
    
    <div class="control-group" id="rechazo" style="display: <?php if($ing->estado=='8'){echo 'block';}else{echo 'none';}?>;"> 
		<label class="control-label" for="usuario">Por qué rechaza</label>
		<div class="controls">
                    <?php if(sizeof($ing)>0) { ?>
			<textarea id="contenido6" name="glosa" placeholder="Observaciones"><?php echo $ing->contenido6 ?></textarea>
                    <?php } else { ?>   
			<textarea id="contenido6" name="glosa" placeholder="Observaciones"><?php echo $_POST["contenido6"] ?></textarea>
                    <?php }  ?> 
		</div>
	</div>
          <input id="fileerror" name="fileerror" type="hidden" value="" />
	 <?php
	 //Usuario 
	if( $this->session->userdata('perfil')!=2) { ?>
	
	
    <?php //echo "<h1>" . $datos->lleva_troquel . "</h1>";
    $orden=$this->orden_model->getOrdenesPorCotizacion($id);
    $ordenDeCompra=$this->cotizaciones_model->getOrdenDeCompraPorCotizacion($id);
    
    if( sizeof($orden)==0 && $ordenDeCompra->estado == 0 || $ordenDeCompra->estado == 2 ) { ?>
          <div class="control-group">
                      <div class="form-actions">
                          <input type="hidden" name="id" value="<?php echo $id ?>" />
                          <input type="hidden" name="pagina" value="<?php echo $pagina ?>" />
                          <input type="hidden" name="estado" />
                          <div id="botones"> <?php include 'plantilla_botones.php'; //my code is here ?></div>
                          <div id="botones2" style="display:none"> 
                          <input id="guardar" type="button" value="Guardar" class="btn btn-success" onclick="guardarFormularioAdd2(0);"/>
                          <input id="liberar" type="button" value="Liberar" class="btn btn-warning" onclick="guardarFormularioAdd2(1);"/>
                          </div>
                      </div>
                      <ol  class= "breadcrumb" style="left:250px">  
                          <li><a href="<?php echo base_url() ?>cotizaciones/index/<?php echo $pagina ?>">Cotizaciones &gt;&gt;</a></li>
                          <li>Revisión Ingeniería</li>
                      </ol>
                  </div>
    <?php } else { ?>
       <?php  if($datos->rev==1 || $ing->estado!=1){?>
            <div class="control-group">
                <div class="form-actions">
                    <input type="hidden" name="id" value="<?php echo $id?>" />
                    <input type="hidden" name="pagina" value="<?php echo $pagina?>" />
                    <input type="hidden" name="estado" />
                    <input id="guardar" type="button" value="Guardar" class="btn btn-success" onclick="guardarFormularioAdd2(0);"/>
                    <input id="liberar" type="button" value="Liberar" class="btn <?php if($ing->estado==1){echo 'btn-warning';}?>"  data-toggle="modal" data-target="" onclick="guardarFormularioAdd2(1);" />
                </div></div>
            <?php }else{ ?>
        <div class="control-group">
            <div class="form-actions">
                <strong>NO SE PUEDE GRABAR PORQUE YA FUE ECHA LA ORDEN DE COMPRA</strong>
            </div>
        </div>    
       <?php } } ?>
    <?php
	 //Usuario 
    }
	 ?>
 <span class="ir-arriba icon-arrow-up">↑</span>
<div id="mensajeajax" class="control-group"></div>
</div>
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
    jQuery(document).ready
    (
                     
        function ()
        {
            document.form.reset();
        //document.form.cliente.focus();
        }
    );
   
    
</script>
<script type="text/javascript">
$(document).ready(function() {
	$(".fancybox").fancybox({
		openEffect	: 'none',
		closeEffect	: 'none'
	});
});
</script>

<script type="text/javascript">

 var Formato = /^\s*-?[1-9]\d*(\.\d{1,2})?\s*$/;

 function funcionDecimales(id, restrictionType) 
 {

  var evaluar = document.getElementById(id).value;
  
  if(evaluar!=='')
  {
   if(restrictionType.test(evaluar)){
   //  alert('Correcto!'); 
   }else{
        document.getElementById(id).value = "";
   }
  }
  return;
    
 }  
 </script>
 
 <script type="text/javascript">
	
$("select[name=tiene_color_modificado_ing]").change(function(){
     var colorOption = $(this).val();
     //alert(colorOption);
     if(colorOption == "SI"){
         $("#numero_color_modificado_ing").show(500);
     }else{
         $("select[name=numero_color_modificado_ing]").val("");
         $("#numero_color_modificado_ing").hide(500);
     }
 });
 

 
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
 
$("select[name=select_estan_los_moldes]").on('change',function(){

var x = this.value;

switch (x) {
    case 'NO':
        $('#div_existe_trazado').show();
        $('#div_trazado_bloque').show();
        break;

    default:
        $('#div_existe_trazado').hide();
        $('#div_trazado_bloque').hide();
        break;
}

});

$("select[name=select_estan_los_moldes_genericos]").on('change',function(){

var x = this.value;

switch (x) {
    case 'NO':
        $('#div_existe_trazado').show();
        $('#div_trazado_bloque').show();
        break;

    default:
        $('#div_existe_trazado').hide();
        $('#div_trazado_bloque').hide();
        break;
}

});
</script>
<script>
 $("select[name=trazados]").on("change",function(){
        var x = this.value;
        var ruta = "../../../trazados/datos/";

    $.post(ruta,{valor1:x},function(resp){
               
    var myObj = $.parseJSON(resp);
              
    switch (myObj.materialidad_opcion1) {
    case '1':
        var materialidad = 'microcorrugado';
        break;
    case '2':
        var materialidad = 'corrugado';
        break;
    case '3':
        var materialidad = 'Cartulina-cartulina';
        break;
    case '4':
        var materialidad = 'Solo cartulina';
        break;
    default:
        var materialidad = '-- Seleccione --';
        break;
    }
                //alert(myObj.unidades_productos_completos+'-'+myObj.piezas_totales);
               var m1 = myObj.mat1+' ( '+myObj.matt1+" - $"+myObj.precio1+" ) ( "+myObj.reverso1+" )"; 
               var m2 = myObj.mat2+' ( '+myObj.matt2+" - $"+myObj.precio2+" ) ( "+myObj.reverso2+" )";
               var m3 = myObj.mat3+' ( '+myObj.matt3+" - $"+myObj.precio3+" ) ( "+myObj.reverso3+" )";
                $("input[name=unidades_por_pliego]").val(myObj.unidades_productos_completos);
                $("input[name=piezas_totales_en_el_pliego]").val(myObj.piezas_totales);
                $("select[name=datos_tecnicos]").val(myObj.materialidad_opcion1);
                $("select[name=materialidad_1]").val(myObj.placa1);
                $("select[name=materialidad_2]").val(myObj.onda1);
                $("select[name=materialidad_3]").val(myObj.liner1);
                $("select[name=materialidad_1]").siblings('div').find('span').html(m1);
                $("select[name=materialidad_2]").siblings('div').find('span').html(m2);
                $("select[name=materialidad_3]").siblings('div').find('span').html(m3);
                $("#medidas_de_las_cajas").val(myObj.medidas_de_las_cajas);
                $("#medidas_de_las_cajas_2").val(myObj.medidas_de_las_cajas_2);
                $("#medidas_de_las_cajas_3").val(myObj.medidas_de_las_cajas_3);
                $("#medidas_de_las_cajas_4").val(myObj.medidas_de_las_cajas_4);
                $("input[name=tamano_cuchillo_1]").val(myObj.cuchillocuchillo);
                $("input[name=tamano_cuchillo_2]").val(myObj.cuchillocuchillo2);
                $("#tamano_1").val(myObj.ancho_bobina);
                $("#tamano_2").val(myObj.largo_bobina);
                $("#ccac_1").val((myObj.ancho_bobina-myObj.cuchillocuchillo)*10);
                $("#ccac_2").val((myObj.largo_bobina-myObj.cuchillocuchillo2)*10);
                $("input[name=nombre_molde]").val(myObj.nombre);
                
        });   
    });
    
       
    $("#fn").html('<h4>FONDO NEGRO '+fn+' '+fnv+'</h4>');
    $("#im").html('<h4>IMG IMPRESION '+imv+'</h4>');
    $("#pr").html('<h4>IMPRESION CONTRA LA FIBRA '+pr+prv+'</h4>');
    /*$("#ccacmin").html('<h4 style="color:green">Distancia '+ccacmin+'</h4>');*/
    $("#vccacminimo").val(vccacmin);
    $("select[name=hay_que_troquelar]").on('change',()=>{
        var a=$("select[name=hay_que_troquelar]").val();
       //alert($("select[name=hay_que_troquelar]").val());
    $("input[name=lleva_troquelado]").val(a);
    $("input[name=hacer_troquel").val(a);
    if(a=='NO'){
    $("select[name=troquel_por_atras").val('NO LLEVA');
    $("select[name=troquel_por_atras").prop('disabled',true);
    $("select[name=select_estan_los_moldes").val('NO LLEVA');
    $("select[name=select_estan_los_moldes").prop('disabled',true);
    }else{
    $("select[name=troquel_por_atras").prop('disabled',false);
    $("select[name=troquel_por_atras").val('');
    $("select[name=select_estan_los_moldes").val('');
    $("select[name=select_estan_los_moldes_genericos").val('NO');
    $("select[name=select_estan_los_moldes").prop('disabled',false);
    }
    });
    
    $('#lleva_fondo_negro').on('change',()=>{
       if($('#lleva_fondo_negro').val()=="SI"){
        $('select[name=troquel_por_atras]').val('NO')
        $('#etiquetatroquel').text('No Puede ser retiro porque lleva fondo negro');
        $('select[name=troquel_por_atras]').prop('disabled',false);
        $("select[name=troquel_por_atras] option[value='SI']").attr("disabled",false);
    }else{
        $('select[name=troquel_por_atras]').prop('disabled',false);
        $('#etiquetatroquel').text('');
        $("select[name=troquel_por_atras] option[value='SI']").removeAttr("disabled");
    }
    });
    
    
    if($("select[name=hay_que_troquelar]").val()=="NO"){
     $("select[name=select_estan_los_moldes] option[value='NO LLEVA']").attr("selected","true");
     $("input[name=lleva_troquelado]").val("NO");
     if($("input[name=hacer_troquel]").val()==""){
     $("input[name=hacer_troquel]").val("NO"); }
    }else{
     if($("select[name=hay_que_troquelar]").val()=="SI" && $("input[name=nm]").val()==""){
     $("select[name=select_estan_los_moldes]").val("");
     $("select[name=select_estan_los_moldes] option[value='NO LLEVA']").removeAttr("selected");
     $("input[name=lleva_troquelado]").val("SI");
     $("#dato_hacer_troquel").val("SI");
     }else{
        if($("select[name=hay_que_troquelar]").val()=="SI" && $("input[name=nm]").val()!==""){
     $("select[name=select_estan_los_moldes]").val("SI");
     $("select[name=select_estan_los_moldes] option[value='NO LLEVA']").removeAttr("selected");
     $("input[name=lleva_troquelado]").val("SI");
     if($("input[name=nm]").val()=="21" || ($("select[name=existe_trazado]").val()=="SI")){
     $("#dato_hacer_troquel").val("SI");
        }else{
     $("#dato_hacer_troquel").val("NO");       
        }
        }
      }
     }
</script>
<script type = 'text/javascript' src = "<?php echo base_url(); ?>js/fnc_reving.js"></script>
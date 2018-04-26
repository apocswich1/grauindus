<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ordenes extends CI_Controller {


    private $session_id;
    public function __construct()
    {
        parent::__construct();
        $this->layout->setLayout('backend');
      
    }
    public function index()
    {
         if($this->session->userdata('id'))
        {
            if($this->uri->segment(3))
            {
                $pagina=$this->uri->segment(3);
            }else
            {
               $pagina=0;
            }
            $porpagina=10;
        $datos=$this->orden_model->getOrdenesPaginacion($pagina,$porpagina,"limit");
        $cuantos=$this->orden_model->getOrdenesPaginacion($pagina,$porpagina,"cuantos");
        $config['base_url'] = base_url().'ordenes/index';
            $config['total_rows'] = $cuantos;
            $config['per_page'] = $porpagina;
            $config['uri_segment'] = '3';
            $config['num_links'] = '4';
            $config['first_link'] = 'Primero';
            $config['next_link'] = 'Siguiente';
            $config['prev_link'] = 'Anterior';
            $config['last_link'] = 'Ultimo';
            $config['full_tag_open'] = '<ul class="pagination">';
            $config['full_tag_close'] = '</ul>';
            $config['first_tag_open'] = '<li>';
            $config['first_tag_close'] = '</li>';
            $config['last_tag_open'] = '<li>';
            $config['last_tag_close'] = '</li>';
            $config['next_tag_open'] = '<li>';
            $config['next_tag_close'] = '</li>';
            $config['prev_tag_open'] = '<li>';
            $config['prev_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li><a><b>';
            $config['cur_tag_close'] = '</b></a></li>';
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            $this->pagination->initialize($config);
              
            $this->layout->view('index',compact("datos","id","pagina")); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
    }
    public function add($id=null,$pagina=null)
    {
         if($this->session->userdata('id'))
        {
            if(!$id){show_404();}
        $datos=$this->cotizaciones_model->getCotizacionPorId($id);
        //print_r($datos);exit;
        $ing=$this->cotizaciones_model->getCotizacionIngenieriaPorIdCotizacion($id);
        $fotomecanica=$this->cotizaciones_model->getCotizacionFotomecanicaPorIdCotizacion($id);
        $cotizacionPresupuesto=$this->cotizaciones_model->getCotizacionCotizacionPrespuestoPorIdCotizacion($id);
        $impresionPresupuesto=$this->cotizaciones_model->getCotizacionImpresionPresupuestoPorIdCotizacion($id);
        $vendedor=$this->vendedores_model->getVendedorPorId($datos->id_vendedor);
        if($this->input->post())
        {
            if($this->form_validation->run("ad_orden_de_produccion"))
            {
                            
                            $cliente=$this->input->post("cliente",true);
                            if($cliente==3000)
                            {
                                $this->session->set_flashdata('ControllerMessage', 'Debe crear al cliente primero.');
					           redirect(base_url().'ordenes/add/'.$this->input->post("id",true)."/".$this->input->post("pagina",true),  301);
                            }
                            $data=array
                                 (
                                    "id_usuario"=>$this->session->userdata('id'),
                                     "id_cotizacion"=>$this->input->post("id",true),
                                    "id_cliente"=>$this->input->post("cliente",true),
                                    "producto"=>$this->input->post("producto",true),
                                    "generico"=>"0",
                                    "id_vendedor"=>$this->input->post("vendedor",true),
                                    "condicion_del_producto"=>$this->input->post("condicion_del_producto",true),
                                    "cantidad"=>$this->input->post("cantidad",true),
                                    "precio"=>$this->input->post("precio",true),
                                    "acepta_excedentes"=>$this->input->post("acepta_excedentes",true),
                                    "piezas_adicionales"=>$this->input->post("piezas_adicionales",true),
                                    "materialidad_datos_tecnicos"=>$this->input->post("datos_tecnicos",true),
                                    "materialidad_1"=>$this->input->post("materialidad_1",true),
                                    "materialidad_2"=>$this->input->post("materialidad_2",true),
                                    "materialidad_eleccion"=>$this->input->post("materialidad_eleccion",true),
                                    "colores"=>$this->input->post("colores",true),
                                    "colores_metalicos"=>$this->input->post("colores_metalicos",true),
                                    "acabado_impresion_1"=>$this->input->post("acabado_impresion_1",true),
                                    "acabado_impresion_2"=>$this->input->post("acabado_impresion_2",true),
                                    "acabado_impresion_3"=>$this->input->post("acabado_impresion_3",true),
                                    "acabado_impresion_4"=>$this->input->post("acabado_impresion_4",true),
                                    "folia"=>$this->input->post("folia",true),
                                    "folia_se"=>$this->input->post("folia_se",true),
                                    "cuno"=>$this->input->post("cuno",true),
                                    "cuno_se"=>$this->input->post("cuno_se",true),
                                    "producto_se_entrega_armado"=>$this->input->post("producto_se_entrega_armado",true),
                                    "tiene_desgajado"=>$this->input->post("tiene_desgajado",true),
                                    "montaje_pieza_especial"=>$this->input->post("montaje_pieza_especial",true),
                                    "pegado_instrucciones"=>$this->input->post("pegado_instrucciones",true),
                                    "cantidad_especifica"=>$this->input->post("cantidad_especifica",true),
                                    "envasado"=>$this->input->post("envasado",true),
                                    "fecha_despacho"=>$this->input->post("fecha_despacho",true),
                                    "despacho_fuera_de_santiago"=>$this->input->post("despacho_fuera_de_santiago",true),
                                    "retira_cliente"=>$this->input->post("retira_cliente",true),
                                    "total_o_parcial"=>$this->input->post("tota_o_parcial",true),
                                    "can_despacho_1"=>$this->input->post("can_despacho_1",true),
                                    "can_despacho_2"=>$this->input->post("can_despacho_2",true),
                                    "can_despacho_3"=>$this->input->post("can_despacho_3",true),
                                    "forma_pago"=>$this->input->post("forma_pago",true),
                                    "comision_agencia"=>$this->input->post("comision_agencia",true),
                                    "costo_comercial"=>$this->input->post("costo_comercial",true),
                                    "persona_que_firma"=>$this->input->post("persona_que_firma",true),
                                    "numero_orden"=>$this->input->post("numero_orden",true),
                                    "fecha"=>date("Y-m-d"),
                                    "estado"=>"1",
                                 );
                             
                              $guardar=$this->orden_model->insertar($data);
                            if($guardar)
                            {
                                $this->session->set_flashdata('ControllerMessage', 'Se ha agregado el registro exitosamente.');
					           redirect(base_url().'ordenes',  301); 
                            }else
                            {
                               $this->session->set_flashdata('ControllerMessage', 'El login ingresado ya existe en la base de datos.');
					           redirect(base_url().'ordenes/add',  301);
                            }
            }
        }
         $this->layout->css
            (
                array
                (
                    base_url()."public/backend/css/calendario.css",
                    base_url()."public/backend/fancybox/jquery.fancybox.css",
                   // base_url()."public/frontend/css/bootstrap-chosen.less"
                )
            );        
            $this->layout->js
            (
                array
                (
                    base_url()."public/backend/js/calendar.js",
                    base_url()."public/backend/js/calendar-setup.js",
                    base_url()."public/backend/js/calendar-es.js",
                    base_url().'public/backend/js/tiny_mce/tiny_mce.js',
                    base_url()."public/frontend/js/dar_formato.js",
                    base_url()."public/backend/fancybox/jquery.fancybox.js",
                   // "http://harvesthq.github.io/chosen/chosen.jquery.js"
                )
            );    
            $tipos=$this->materiales_model->getMaterialesTipo();
            $vendedores=$this->vendedores_model->getVendedoresSelect();
            
            $this->layout->view('add',compact("datos","id","pagina","vendedores","tipos","cotizacionPresupuesto","impresionPresupuesto")); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
    }
    public function edit($id=null,$pagina=null)
    {
         if($this->session->userdata('id'))
        { 
            if(!$id){show_404();}
        $datos=$this->orden_model->getOrdenesPorClientePorId($id);
         $cotizacion=$this->cotizaciones_model->getCotizacionPorId($datos->id_cotizacion);
         //print_r($cotizacion);exit;
         $impresionPresupuesto=$this->cotizaciones_model->getCotizacionImpresionPresupuestoPorIdCotizacion($datos->id_cotizacion);
         if($this->input->post())
            {
                if($this->form_validation->run("ad_orden_de_produccion"))
                {
                    $data=array
                                 (
                                    "id_usuario"=>$this->session->userdata('id'),
                                     "id_cotizacion"=>$this->input->post("id",true),
                                    "id_cliente"=>$this->input->post("cliente",true),
                                    "producto"=>$this->input->post("producto",true),
                                    "generico"=>"0",
                                    "id_vendedor"=>$this->input->post("vendedor",true),
                                    "condicion_del_producto"=>$this->input->post("condicion_del_producto",true),
                                    "cantidad"=>$this->input->post("cantidad",true),
                                    "precio"=>$this->input->post("precio",true),
                                    "acepta_excedentes"=>$this->input->post("acepta_excedentes",true),
                                    "piezas_adicionales"=>$this->input->post("piezas_adicionales",true),
                                    "materialidad_datos_tecnicos"=>$this->input->post("datos_tecnicos",true),
                                    "materialidad_1"=>$this->input->post("materialidad_1",true),
                                    "materialidad_2"=>$this->input->post("materialidad_2",true),
                                    "materialidad_eleccion"=>$this->input->post("materialidad_eleccion",true),
                                    "colores"=>$this->input->post("colores",true),
                                    "colores_metalicos"=>$this->input->post("colores_metalicos",true),
                                    "acabado_impresion_1"=>$this->input->post("acabado_impresion_1",true),
                                    "acabado_impresion_2"=>$this->input->post("acabado_impresion_2",true),
                                    "acabado_impresion_3"=>$this->input->post("acabado_impresion_3",true),
                                    "acabado_impresion_4"=>$this->input->post("acabado_impresion_4",true),
                                    "folia"=>$this->input->post("folia",true),
                                    "folia_se"=>$this->input->post("folia_se",true),
                                    "cuno"=>$this->input->post("cuno",true),
                                    "cuno_se"=>$this->input->post("cuno_se",true),
                                    "producto_se_entrega_armado"=>$this->input->post("producto_se_entrega_armado",true),
                                    "tiene_desgajado"=>$this->input->post("tiene_desgajado",true),
                                    "montaje_pieza_especial"=>$this->input->post("montaje_pieza_especial",true),
                                    "pegado_instrucciones"=>$this->input->post("pegado_instrucciones",true),
                                    "cantidad_especifica"=>$this->input->post("cantidad_especifica",true),
                                    "envasado"=>$this->input->post("envasado",true),
                                    "fecha_despacho"=>$this->input->post("fecha_despacho",true),
                                    "despacho_fuera_de_santiago"=>$this->input->post("despacho_fuera_de_santiago",true),
                                    "retira_cliente"=>$this->input->post("retira_cliente",true),
                                    "total_o_parcial"=>$this->input->post("tota_o_parcial",true),
                                    "can_despacho_1"=>$this->input->post("can_despacho_1",true),
                                    "can_despacho_2"=>$this->input->post("can_despacho_2",true),
                                    "can_despacho_3"=>$this->input->post("can_despacho_3",true),
                                    "forma_pago"=>$this->input->post("forma_pago",true),
                                    "comision_agencia"=>$this->input->post("comision_agencia",true),
                                    "costo_comercial"=>$this->input->post("costo_comercial",true),
                                    "persona_que_firma"=>$this->input->post("persona_que_firma",true),
                                    "numero_orden"=>$this->input->post("numero_orden",true),
                                    "estado"=>"1",
                                 );
                             
                              $guardar=$this->orden_model->update($data, $this->input->post("id",true));
                            if($guardar)
                            {
                                $this->session->set_flashdata('ControllerMessage', 'Se ha editado el registro exitosamente.');
					           redirect(base_url().'ordenes/index/'.$this->input->post("pagina",true),  301); 
                            }else
                            {
                               $this->session->set_flashdata('ControllerMessage', 'El login ingresado ya existe en la base de datos.');
					           redirect(base_url().'ordenes/add',  301);
                            }
                }
             }   
            $this->layout->css
            (
                array
                (
                    base_url()."public/backend/css/calendario.css",
                    base_url()."public/backend/fancybox/jquery.fancybox.css",
                   // base_url()."public/frontend/css/bootstrap-chosen.less"
                )
            );        
            $this->layout->js
            (
                array
                (
                    base_url()."public/backend/js/calendar.js",
                    base_url()."public/backend/js/calendar-setup.js",
                    base_url()."public/backend/js/calendar-es.js",
                    base_url().'public/backend/js/tiny_mce/tiny_mce.js',
                    base_url()."public/frontend/js/dar_formato.js",
                    base_url()."public/backend/fancybox/jquery.fancybox.js",
                   // "http://harvesthq.github.io/chosen/chosen.jquery.js"
                )
            );    
            $tipos=$this->materiales_model->getMaterialesTipo();
            $vendedores=$this->vendedores_model->getVendedoresSelect();
            $this->layout->view('edit',compact("datos","id","pagina","vendedores","tipos","cotizacion","impresionPresupuesto"));
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
    }
      public function revision($id=null,$pagina=null)
    {
         if($this->session->userdata('id'))
        { 
            if(!$id){show_404();}
        $datos=$this->orden_model->getOrdenesPorClientePorId($id);
         $cotizacion=$this->cotizaciones_model->getCotizacionPorId($datos->id_cotizacion);
         $this->layout->view('revision',compact("datos","id","pagina","cotizacion"));
         }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
        
    }
    public function detalle($id=null)
    {
         if($this->session->userdata('id'))
        {
             $this->load->library('javascript');
            $this->load->library('javascript', array('js_library_driver' => 'scripto', 'autoload' => FALSE));
            $this->layout->setLayout('template_ajax');
            //$id=$this->input->post("valor1",true);
            $datos=$this->orden_model->getOrdenesPorClientePorId($id);
            //print_r($datos);exit;
            $this->layout->view('detalle',compact("datos","id")); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
        
    }
      public function detalle_pdf($id=null,$orden=null)
	{
	    if($this->session->userdata('id'))
        {
        if(!$id){show_404();}
        $datos=$this->cotizaciones_model->getCotizacionPorId($id);
		//
		$vendedor=$this->vendedores_model->getVendedorPorId($datos->id_vendedor);
		$vcliente=$this->clientes_model->getClientePorId2($datos->id_cliente);
		$vcliente3=$this->clientes_model->getClientePorId3($datos->id_cliente);
		$usuario=$this->usuarios_model->getUsuariosPorId($datos->id_usuario);
		
		$ing=$this->cotizaciones_model->getCotizacionIngenieriaPorIdCotizacion($datos->id);
		
		$fotomecanica=$this->cotizaciones_model->getCotizacionFotomecanicaPorIdCotizacion($id);
		
	   // $vmolde1=$this->moldes_model->getMoldesPorId($fotomecanica->numero_molde);
		$vmolde1=$this->cotizaciones_model->getMoldesPorId($fotomecanica->numero_molde);
		
		if($ing->archivo ==NUll)
		{
			$vpdf="NO";
	    }
		else
		{
			$vpdf="SI";
		}
		
		
        if(sizeof($datos)==0){show_404();}
        $impresionPresupuesto=$this->cotizaciones_model->getCotizacionImpresionPresupuestoPorIdCotizacion($id);
         if($datos->id_cliente==3000)
            {
                $cliente=$datos->nombre_cliente;
                $correo="";
                $direccion="";
                $ciudad="";
                $comuna="";
                $rut="";
                $telefono="";
                
            }else
            {
                $cli=$this->clientes_model->getClientePorId($datos->id_cliente);
                $cliente=$cli->razon_social;
                $correo=$cli->correo;
                $direccion=$cli->direccion;
                $ciudad=$cli->ciudad;
                $comuna=$cli->comuna;
                $rut=$cli->rut;
                $telefono=$cli->telefono;
                
                $contacto=$this->clientes_model->geContactosClientePorIdUltimo($datos->id);
            }
            //$vendedor=$this->vendedores_model->getVendedorPorId($datos->id_vendedor);
			//$vcliente=$this->clientes_model->getClientePorId($datos->id_cliente);
			
			
         $cuerpo='<!doctype html>
			<html> 
            <head>
            <meta charset="utf-8" />
            
<style type="text/css">
    .tabla
    {
         border: #000099; border-style: solid; border-top-width: 1px; border-right-width: 1px; border-bottom-width: 1px; border-left-width: 1px; width: 1200px;
    }
	

</style>
            </head>
			<body>';
	//Inicio Contenido Cuerpo	//<h1>Orden de Produccion</h1>
	//  <td colspan="3">Vendedor: '.$vendedor->nombre.' </td>
$cuerpo='	
		
 
<table >

<tr>
<td><font size="1">Codigo Producto:NNNNANNN NNNNANNN</font></td>
 <td>&nbsp; </td>
</tr>

<tr>
<td></td>
<td colspan="4"><center><b>O.T.N:'.$datos->id.'</b></center></td>  
<td></td>
<td>O.T Anexa: 0</td>
<td></td>
</tr>



<tr>
 <td colspan="2"><b><span style="font-size: 13px;">ORDEN DE PRODUCCION DISEÑO </span></b></td>
  <td><font size="3">Fecha:'.$datos->fecha.'</font></td>
  <td><font size="3">ENT:'.$datos->fecha.'</font></td>
</tr> 
 
 
<tr>
  <td colspan="3">Cliente: '.$vcliente->razon_social.'</td> 
  <td>OC:12345</td>
  <td colspan="3">Vendedor: '.$vendedor->nombre.'</td>
  <td>HC:'.$datos->id.'</td> 
  <td></td> 
</tr>
 
<tr>
  <td>Cantidad: '.$datos->cantidad_1.'</td>
</tr>


<tr>
  <td colspan="5">Trabajo:'.$datos->comentario_medidas.', '.$ing->medidas_de_la_caja.' </td>
   <td>&nbsp; </td>
    <td>&nbsp; </td>
	 <td>&nbsp; </td>
	  <td>&nbsp; </td>
</tr>
 
<tr>
 <td>&nbsp; </td>
</tr>
 
<tr>
  <td colspan="3"><b><u>'.$datos->materialidad_2.'</u></b></td>
</tr>

 <tr>
 <td>&nbsp; </td>
</tr> 

<tr>
  <td colspan="2">'.$usuario->nombre.'</td>
   <td>&nbsp; </td> 
   <td>&nbsp; </td>
</tr>

<tr>
  <td>Tamaño:'.$ing->medidas_de_la_caja.' </td>
  <td colspan="2">Tamaño Pliego:'.$ing->tamano_a_imprimir_1.' X '.$ing->tamano_a_imprimir_2.'CM</td> 
  <td colspan="2">Unidad/Pliego:'.$ing->unidades_por_pliego.'</td>
  <td colspan="2">Piezas/Unidad:'.$ing->piezas_adicionales.'</td>
  <td>&nbsp; </td> 
  <td>&nbsp; </td>
</tr>


<tr>
  <td colspan="3">Placa:'.$ing->materialidad_1.'</td>
  <td>Onda:</td>
  <td>Colores:'.$datos->impresion_colores.'</td>
  <td>Barniz:</td>
</tr>

<tr>
  <td>Termolaminado:</td>
  <td>Reserva:</td>
  <td>Trazado:'.$vpdf.'</td>
  <td colspan="2">Cromalin:'.$datos->impresion_hacer_cromalin.'</td>
  <td colspan="2">Repeticion:'.$datos->condicion_del_producto.'</td>
</tr>

<tr>
  <td>Observaciones:</td>

</tr>

<tr>
<td colspan="8"><hr size="2"> </hr></td>
</tr>



<tr>

  <td colspan="3"><b><span style="font-size: 13px;">Orden DE PRODUCCION FOTOMECANICA</span></b></td>
  <td colspan="1"><span style="font-size: 11px;">O.T.N:'.$datos->id.'</span></td>    
  <td><span style="font-size: 11px;">HC:'.$datos->id.'</span></td>
  <td>&nbsp; </td> 
  <td><span style="font-size: 11px;">Fecha:'.$datos->fecha.'</span></td>
<br><br>
</tr>
 
 

<tr>
 <td colspan="3">Cliente:'.$vcliente->razon_social.'</td>
  <td colspan="3">Vendedor:'.$vendedor->nombre.'</td>
</tr>


<tr>
  <td colspan="5">Trabajo:'.$datos->comentario_medidas.', '.$ing->medidas_de_la_caja.' </td>
   <td>&nbsp; </td>
    <td>&nbsp; </td>
	 <td>&nbsp; </td>
	  <td>&nbsp; </td>
</tr>

<tr>
 <td>Repeticion:'.$datos->condicion_del_producto.'</td>
   <td>&nbsp; </td>  
 <td colspan="3">Cantidad:'.$datos->cantidad_1.' Unidades</td>
 <td colspan="3">Tamaño:'.$ing->medidas_de_la_caja.'</td> 
 
</tr>



<tr>
      <td>&nbsp; </td>  
      <td>&nbsp; </td> 
      
  <td colspan="3">Tamaño Pliego: '.$ing->tamano_a_imprimir_1.' X '.$ing->tamano_a_imprimir_2.' CM</td>
  <td colspan="3">Unidad/Pliego:'.$ing->unidades_por_pliego.'</td>
</tr>


<tr>
  <td colspan="3">Placa:'.$ing->materialidad_1.'</td>
  <td>Onda:</td>
  <td>&nbsp; </td> 
  <td>Colores:'.$datos->impresion_colores.'</td>
</tr>


<tr>
  <td>Barniz:</td>
  <td>Termolaminado:</td>
   <td>&nbsp; </td> 
  <td>Reserva:</td>
</tr>

<tr>
  <td>Trazado:'.$vpdf.'</td>
  <td>Montaje:'.$datos->montaje_pieza_especial.'</td>
   <td>&nbsp; </td> 
  <td colspan="2">Planchas:</td>
</tr>




<tr>
  <td>Observaciones:</td>

</tr>

<tr>
<td colspan="8"><hr size="2"> </hr></td>
</tr>



<tr>

  <td colspan="3"><b><span style="font-size: 13px;">ORDEN DE PRODUCCION</span></b></td>
  <td colspan="1"><span style="font-size: 11px;">O.T.N:'.$datos->id.'</span></td>    
  <td><span style="font-size: 11px;">HC:'.$datos->id.'</span></td>
   <td>&nbsp; </td> 
  <td><span style="font-size: 11px;">Fecha:'.$datos->fecha.'</span></td>
<br><br>
</tr>

<tr>
  <td colspan="5">Trabajo:'.$datos->comentario_medidas.', '.$ing->medidas_de_la_caja.' </td>
   <td>&nbsp; </td>
    <td>&nbsp; </td>
	 <td>&nbsp; </td>
	  <td>&nbsp; </td>
</tr>


<tr>
  <td colspan="2">Vendedor:'.$vendedor->nombre.'</td>
  <td colspan="2">Placa: </td>
   <td>Repeticion:'.$datos->condicion_del_producto.'</td>
</tr>

  
<tr>
  <td colspan="3">Placa:'.$ing->materialidad_1.'</td>
  <td colspan="3">Tamaño Placa:'.$ing->tamano_a_imprimir_1.' X '.$ing->tamano_a_imprimir_2.'CM</td>
</tr>

<tr>
  <td>Colores:'.$datos->impresion_colores.'</td>
  <td>Barniz:</td>
  <td>Termolaminado:</td>
    <td>&nbsp; </td>
  <td>Reserva:</td>
</tr>

<tr>
 <td colspan="3">Lugar Impresion: Fabrica</td>
</tr>

<tr>
  <td>Observaciones:</td>

</tr>

<tr>
<td colspan="8"><hr size="2"> </hr></td>
</tr>



<tr>
  <td colspan="3"><b><span style="font-size: 13px;">ORDEN DE PRODUCCION MOLDE</span></b></td>
  <td colspan="1"><span style="font-size: 11px;">O.T.N:'.$datos->id.'</span></td>    
  <td><span style="font-size: 11px;">HC:'.$datos->id.'</span></td>
</tr>

<tr>
    <td>Molde:'.$fotomecanica->numero_molde.' </td>
    <td>&nbsp; </td>
    <td colspan="5">Nombre Molde:'.$vmolde1->nombremolde.'</td>
</tr>  

<tr>
 <td colspan="3">Medida:'.$vmolde1->tamano_caja.'</td>
    <td>&nbsp; </td>
 <td colspan="3">Corte Cuchillo a Cuchillo:'.$vmolde1->cuchillocuchillo.'</td>
</tr>


<tr>
  <br>
<td>&nbsp; </td> 
<td>&nbsp; </td> 
<td>&nbsp; </td> 
<td>&nbsp; </td> 
<td>&nbsp; </td> 
<td>&nbsp; </td> 
<td>&nbsp; </td> 
<td>&nbsp; </td> 
<td>&nbsp; </td> 
</tr>




<tr>
<td colspan="3">Cliente:'.$vcliente->razon_social.'</td>
<td colspan="2"><center><b>O.T.N:'.$datos->id.'</b></center></td>  
<td colspan="2">O.T Anexa: 0</td>
</tr>

<tr>
<td colspan="8"><hr size="2"> </hr></td>
</tr>

<tr>
  <td colspan="2">Cantidad:'.$datos->cantidad_1.' Unidad</td>
    <td colspan="5">Trabajo:'.$datos->comentario_medidas.', '.$ing->medidas_de_la_caja.'</td>
	<br><br>
</tr>

<tr>
  <td colspan="3"><b>'.$datos->materialidad_2.'</b></td>
  <br>
</tr>

<tr>
  <td colspan="3"><b><u>Corte Placa</u></b></td>
</tr>


<tr>
  <td colspan="2">Cantidad: 500 </td>
   <td colspan="2">Medida: 100x100 CM </td>
     <td colspan="3">Placa: "Papel encolado 500"</td>
</tr>

<tr>
  <td colspan="3"><b><u>Corte Onda</u></b></td>
    <td colspan="3"><b><u>Ancho Corrugado </u></b> 0 </td>
</tr>
 
<tr>
  <td colspan="2">Cantidad: 300 Pliegos </td>
   <td colspan="2">Medida: 100x100 CM </td>
     <td colspan="3">Material: 1161 Onda 160 GR/M2 Liner</td>
</tr>

<tr>
<td colspan="8"><hr size="2"> </hr></td>
</tr>


<tr>
  <td colspan="1"><b><u>Emplacado:</u></b></td>
   <td colspan="6">'.$datos->comentario_medidas.', '.$ing->medidas_de_la_caja.'</td>
</tr>

<tr>
   <td colspan="5">Trabajo:'.$datos->comentario_medidas.', '.$ing->medidas_de_la_caja.'</td>   
</tr>


<tr>
	<td>O.T.N: '.$datos->id.'</td>  
	<td colspan="2">Fecha:'.$datos->fecha.'</td>
	 <td colspan="3">Placa:'.$ing->materialidad_1.'</td>	 
</tr>




<tr>
  <td colspan="2">Cantidad:'.$datos->cantidad_1.'  Pliegos </td>
   <td colspan="2">Medida:'.$ing->tamano_a_imprimir_1.' X '.$ing->tamano_a_imprimir_2.' CM </td>
       <td colspan="3">Material:'.$datos->materialidad_2.'-'.$ing->materialidad_1.'</td>
</tr>



<tr>
<td colspan="8"><hr size="2"> </hr></td>
</tr>


<tr>
  <td colspan="1"><b><u>Troquelado:</u></b></td>
   <td colspan="6">Trabajo:'.$datos->comentario_medidas.', '.$ing->medidas_de_la_caja.'</td>
</tr>



<tr>
	<td>O.T.N:'.$datos->id.'</td>  
	<td colspan="2">Fecha:'.$datos->fecha.'</td>
</tr>

<tr>
<td colspan="2">Cantidad:'.$datos->cantidad_1.' Pliegos </td>
<td colspan="2">Medida:'.$ing->tamano_a_imprimir_1.' X '.$ing->tamano_a_imprimir_2.'CM</td>
<td colspan="4">Molde:'.$vmolde1->nombremolde.'</td>
</tr>


<tr>
<td colspan="2">Salen:'.$datos->cantidad_1.' Unidad </td>
<td colspan="2"></td>
<td colspan="3">Nº: '.$fotomecanica->numero_molde.'</td>
</tr>


<tr>
<td colspan="8"><hr size="2"> </hr></td>
</tr>


<tr>
  <td colspan="4"><b><u>Orden de prduccion para pegado y empaquetado</u></b></td>
	<td>O.T.N: '.$datos->id.'</td>  
	<td colspan="2">Fecha:'.$datos->fecha.'</td>
</tr>


<tr>
  <td colspan="2">Cantidad:'.$datos->cantidad_1.'</td>  
   <td colspan="2">Empaquetar de:  UNID</td> 
   <td colspan="2">Total Pqtes: </td>    
</tr>

<tr>
  <td colspan="2">Autoadhesivo:  </td>  
   <td colspan="3">Tipo Pegado:'.$ing->tipo_de_pegado.'</td> 
</tr>



<tr>
<td colspan="8"><hr size="2"> </hr></td>
</tr>


<tr>
  <td colspan="4"><b><u>Instrucciones para despacho orden</u></b></td>
	<td>O.T.N: '.$datos->id.'</td>  
	<td colspan="2">Fecha:'.$datos->fecha.'</td>
</tr>



<tr>
 <td colspan="2">Cliente:'.$vcliente->razon_social.'</td>
  <td colspan="2">Rut:'.$vcliente->rut.'</td>
    <td colspan="2">O/Compra: </td>
</tr>


<tr>
 <td colspan="2">Direccion:'.$vcliente->direccion.'</td>
  <td colspan="2">Fono/Fax: '.$vcliente->telefono.'</td>
</tr>

<tr>
 <td colspan="2">Comuna:'.$vcliente3->comuna.'</td>
  <td colspan="2">Ciudad:'.$vcliente3->ciudad.'</td>
  <td colspan="3">Vendedor:'.$vendedor->nombre.'</td>
</tr>


<tr>
 <td colspan="2">Forma de Pago: '.$vcliente3->pago.'</td>
</tr>



<tr>
 <td colspan="4">Trabajo:'.$datos->comentario_medidas.', '.$ing->medidas_de_la_caja.'</td>
  <td colspan="2">CProducto: NNNNANNN</td>
</tr>




<tr>
  <td colspan="2">Precio Unidad: 0 mas IVA</td>
    <td colspan="2">Transporte: Fabrica</td>
</tr>

<tr>
  <td colspan="4">Despacho a: "Aqui el despacho"</td>
    <td colspan="2">Total Pedido:'.$datos->cantidad_1.'</td>
</tr>

<tr>
  <td colspan="4">Forma de Entrega:'.$datos->total_o_parcial.'</td>
    <td colspan="2">Seda: </td>
</tr>

<tr>
  <td>Observaciones:</td>
<br><br>
</tr>





</table>



   '; //Fin cuerpo Hoja 1 _____________________________________________________________________________________
   
   
    //Fin Contenidos Cuerpo
      $cuepo.='</body></html>';
            //echo $cuerpo;exit;
		$mpdf=new mPDF(); 
		$nombre="Cotización de Cliente ".$id." ".date("Y-m-d H:i:s").".pdf";
		$mpdf->WriteHTML($cuerpo);
		$mpdf->Output($nombre,'I');
		exit;
            
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
    }
    
}


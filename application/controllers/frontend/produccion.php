<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Produccion extends CI_Controller {

    private $session_id;
    public function __construct()
    {
        parent::__construct();
        $this->layout->setLayout('backend_rojo');
      
    }
    
    public function cotizaciones_vendedor($id=null)
	{
        
        $vendedores=$this->vendedores_model->getVendedoresSelect();
      // print_r($_POST);exit();
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
        
        if($id==""){    
        $datos=$this->orden_model->getOrdenesConCotizacionPaginacion($pagina,$porpagina,"limit");
        }else{
        $datos=$this->orden_model->getOrdenesConCotizacionVendedorPaginacion($pagina,$porpagina,"limit",$id);    
        }
        
        $list = $id;
        $config['base_url'] = base_url().'produccion/cotizaciones';
//            $config['total_rows'] = $cuantos;
//            $config['per_page'] = $porpagina;
//            $config['uri_segment'] = '3';
//            $config['num_links'] = '4';
//            $config['first_link'] = 'Primero';
//            $config['next_link'] = 'Siguiente';
//            $config['prev_link'] = 'Anterior';
//            $config['last_link'] = 'Ultimo';
//            $config['full_tag_open'] = '<ul class="pagination">';
//            $config['full_tag_close'] = '</ul>';
//            $config['first_tag_open'] = '<li>';
//            $config['first_tag_close'] = '</li>';
//            $config['last_tag_open'] = '<li>';
//            $config['last_tag_close'] = '</li>';
//            $config['next_tag_open'] = '<li>';
//            $config['next_tag_close'] = '</li>';
//            $config['prev_tag_open'] = '<li>';
//            $config['prev_tag_close'] = '</li>';
//            $config['cur_tag_open'] = '<li><a><b>';
//            $config['cur_tag_close'] = '</b></a></li>';
//            $config['num_tag_open'] = '<li>';
//            $config['num_tag_close'] = '</li>';
//            $this->pagination->initialize($config);
            $this->layout->css
            (
                array
                (
                    base_url()."public/backend/fancybox/jquery.fancybox.css",
                     base_url()."public/frontend/css/prism.css",
                    base_url()."public/frontend/css/chosen.css",
                )
            );
            $this->layout->js
            (
                array
                (
                    base_url()."public/backend/fancybox/jquery.fancybox.js"
                )
            ); 
            $this->layout->view('cotizaciones_vendedor',compact('datos','cuantos','pagina','vendedores','list')); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
        
	}
    public function cotizaciones_cerradas($id=null)
	{
        
        $vendedores=$this->vendedores_model->getVendedoresSelect();
      // print_r($_POST);exit();
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
        
        if($id==""){    
        $datos=$this->orden_model->getOrdenesConCotizacionPaginacionCerradas($pagina,$porpagina,"limit");
        }else{
        $datos=$this->orden_model->getOrdenesConCotizacionVendedorPaginacionCerradas($pagina,$porpagina,"limit",$id);    
        }
        
        $list = $id;
        $config['base_url'] = base_url().'produccion/cotizaciones';

            $this->layout->css
            (
                array
                (
                    base_url()."public/backend/fancybox/jquery.fancybox.css",
                     base_url()."public/frontend/css/prism.css",
                    base_url()."public/frontend/css/chosen.css",
                )
            );
            $this->layout->js
            (
                array
                (
                    base_url()."public/backend/fancybox/jquery.fancybox.js"
                )
            ); 
            $this->layout->view('cotizaciones_cerradas',compact('datos','cuantos','pagina','vendedores','list')); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
        
	}
    public function cotizaciones_lista($id=null)
	{
        
        $vendedores=$this->vendedores_model->getVendedorPorId($id);
        $nombrevendedor=$vendedores->nombre;
      // print_r($_POST);exit();
        if($this->session->userdata('id'))
        {          
            if($this->uri->segment(3))
            {
                $pagina=$this->uri->segment(3);
            }else
            {
               $pagina=0;
            }
            $porpagina=4000;
        
        if($id==""){    
        $datos=$this->orden_model->getOrdenesConCotizacionPaginacion($pagina,$porpagina,"limit");
        }else{
        $datos=$this->orden_model->getOrdenesConCotizacionVendedorPaginacion($pagina,$porpagina,"limit",$id);    
        }
        
        
        $list = $id;
        $config['base_url'] = base_url().'produccion/cotizaciones';

            $this->layout->css
            (
                array
                (
                    base_url()."public/backend/fancybox/jquery.fancybox.css",
                    base_url()."public/frontend/css/prism.css",
                    base_url()."public/frontend/css/chosen.css",
                )
            );
            $this->layout->js
            (
                array
                (
                    base_url()."public/backend/fancybox/jquery.fancybox.js"
                )
            ); 
            //$this->layout->view('cotizaciones_cliente',compact('datos','cuantos','pagina','vendedores','list')); 
            $cuerpo.="<table border='' style='width:900px'><tr>"
                    . "<td align='right'><b>FECHA: </b>"
                    . date('d-m-Y')
                    . "<b> Hora: </b>".date('H:m')
                    . "</tr></table><br/>";
            if($id==""){
            $cuerpo.="<table border='1' style='width:900px'><tr>"
                    . "<td align='center'><b>LISTADO GENERAL DE ORDENES</b>"
                    . "&nbsp;&nbsp;</td>"
                    . "</tr></table><br/>";    
            }else{
            $cuerpo.="<table border='1' style='width:900px'><tr>"
                    . "<td align='center'><b>LISTADO DE ORDENES</b>"
                    . "&nbsp;&nbsp;</td></tr>"
                    . "<tr><td><b>VENDEDOR:</b>"
                    . "&nbsp;&nbsp;$nombrevendedor</td>"
                    . "</tr></table><br/>";    
            }
            
            if($id==""){
            $cuerpo.="<table border='1' style='width:900px'><tr class='titulo'>"
                    . "<td align='center'><b>OT</b></td>"
                    . "<td align='center'><b>COTIZACION</b></td>"
                    . "<td align='center'><b>OP</b></td>"
                    . "<td align='center'><b>FECHA SOLICITUD</b></td>"
                    . "<td><b>CLIENTE</td>"
                    . "<td><b>VENDEDOR</td>"
                    . "<td><b>PRODUCTO</b></td>"
                    . "<td><b>CANTIDAD</b></td>"
                    . "<td><b>FALTANTE</b></td>"
                    . "<td><b>PRECIO</b></td>"
                    . "<td><b>PARCIAL</b></td>"
                    . "</tr>";
            }else{
                $cuerpo.="<table border='1' style='width:900px'><tr class='titulo'>"
                    . "<td align='center'><b>OT</b></td>"
                    . "<td align='center'><b>COTIZ</b></td>"
                    . "<td align='center'><b>OP</b></td>"
                    . "<td align='center'><b>F.SOLICITUD</b></td>"
                    . "<td><b>CLIENTE</td>"
                    . "<td><b>PRODUCTO</b></td>"
                    . "<td><b>CANTIDAD</b></td>"
                    . "<td><b>FALTANTE</b></td>"
                    . "<td><b>PRECIO</b></td>"
                    . "<td><b>PARCIAL</b></td>"
                    . "<td><b>STOCK</b></td>"
                    . "<td><b>F.ENTREGA</b></td>"                        
                    . "<td WIDTH='100px'><b>ESTADO</b></td>"                        
                    . "</tr>";
            }
            
            
            if($id==""){
                foreach ($datos as $value) {
                    $vendedores=$this->vendedores_model->getVendedorPorId($value->id_vendedor);
                    $nombrevendedor=$vendedores->nombre;
                    $cli=$this->clientes_model->getClientePorId($value->id_cliente);
                    $cliente=$cli->razon_social; 
                    $not=$this->orden_model->getNumeroOt($value->id); 
                    $estatus = $this->orden_model->getDescripcionTrabajo($value->id);
                    $ult=$this->despachos_model->getDespachosUltimoRegistro($value->id); 
                    $cantidadfaltante = "";
                    if($ult->cantidad_faltante!=''){$cantidadfaltante = $ult->cantidad_faltante;}
                    $cuerpo.="<tr><td align='center'>$not->id_ot</td>"
                        . "<td align='center'>$value->id</td>"
                        . "<td align='center'>$value->id_op</td>"
                        . "<td align='center'>$value->fecha</td>"
                        . "<td>$cliente</td>"
                        . "<td>$nombrevendedor</td>"
                        . "<td>$value->nombre_producto_normal</td>"
                        . "<td>$value->cantidad_pedida</td>"
                        . "<td>".$cantidadfaltante."</td>"
                        . "<td>$value->valor</td>"
                        . "<td>$ult->cierra_la_orden</td>"
                        . "<td>".($stock = $value->cantidad_pedida - $cantidadfaltante)."</td>"
                        . "<td>".fecha_con_slash($value->fecha_entrega)."</td>"
                        . "<td>$estatus->descripcion_del_trabajo</td></tr>";                

                   // if (($stock) > 0){
                        $monto += ($value->valor) * ($cantidadfaltante);
                        
                   // }                                            
                }
                
            }else{
                //echo '<pre>';
                //echo $estatus->descripcion_del_trabajo;
               //print_r($value);
               // exit();  

                foreach ($datos as $value) {
                    $vendedores=$this->vendedores_model->getVendedorPorId($value->id_vendedor);
                    $nombrevendedor=$vendedores->nombre;
                    $cli=$this->clientes_model->getClientePorId($value->id_cliente);
                    $cliente=$cli->razon_social; 
                    $not=$this->orden_model->getNumeroOt($value->id); 
                    $estatus = $this->orden_model->getDescripcionTrabajo($value->id);
                    //echo '<pre>';
                    //echo $estatus->descripcion_del_trabajo;
                   //print_r($value);
                   // exit();               
                    $ult=$this->despachos_model->getDespachosUltimoRegistro($value->id); 
                    $cantidadfaltante = "";
                    if($ult->cantidad_faltante!=''){$cantidadfaltante = $ult->cantidad_faltante;}else{$cantidadfaltante = $value->cantidad_pedida;}
                    $cuerpo.="<tr><td align='center'>$not->id_ot</td>"
                        . "<td align='center'>$value->id</td>"
                        . "<td align='center'>$value->id_op</td>"
                        . "<td align='center'>".fecha_con_slash($value->fecha)."</td>"
                        . "<td>$cliente</td>"
                        . "<td>$value->nombre_producto_normal</td>"
                        . "<td>$value->cantidad_pedida</td>"
                        . "<td>".$cantidadfaltante."</td>"
                        . "<td>$value->valor</td>"
                        . "<td>$ult->cierra_la_orden</td></tr>"
                        . "<td>".($stock = $value->cantidad_pedida - $cantidadfaltante)."</td>"
                        . "<td>".fecha_con_slash($value->fecha_entrega)."</td>"
                        . "<td>$estatus->descripcion_del_trabajo</td></tr>";                

                    //if ($stock > 0){
                        $monto += $value->valor*$cantidadfaltante;
                    //}                                
                }            
            }

           $cuerpo.="</table>";
            /*
            if($id!=""){    
                $monto=$this->orden_model->getMontoOrdenesPorVendedor($id); 
            }else{
                $monto=$this->orden_model->getMontoOrdenes();     
            }*/
            
            $cuerpo.="<table border='0' >"
                    . "<tr><td  ></td>"
                    . "<td>Total (F*P): $monto</td><td></td><td></td>"
                    . "</tr></table>";
            
            $this->mpdf->AddPage('L');
            $css1 = file_get_contents('public/frontend/css/listado.css');
            $css2 = file_get_contents('bootstrap/bootstrap.css');
            $this->mpdf->WriteHTML($css2,1);
            $this->mpdf->WriteHTML($css1,1);
            $this->mpdf->WriteHTML($cuerpo);

            $this->mpdf->Output();
            exit;
        
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
        
	}
    public function cotizaciones_lista_cerradas($id=null)
	{
        
        $vendedores=$this->vendedores_model->getVendedorPorId($id);
        $nombrevendedor=$vendedores->nombre;
      // print_r($_POST);exit();
        if($this->session->userdata('id'))
        {          
            if($this->uri->segment(3))
            {
                $pagina=$this->uri->segment(3);
            }else
            {
               $pagina=0;
            }
            $porpagina=4000;
        
        if($id==""){    
        $datos=$this->orden_model->getOrdenesConCotizacionPaginacionCerradas($pagina,$porpagina,"limit");
        }else{
        $datos=$this->orden_model->getOrdenesConCotizacionVendedorPaginacionCerradas($pagina,$porpagina,"limit",$id);    
        }
        
        
        $list = $id;
        $config['base_url'] = base_url().'produccion/cotizaciones';

            $this->layout->css
            (
                array
                (
                    base_url()."public/backend/fancybox/jquery.fancybox.css",
                     base_url()."public/frontend/css/prism.css",
                    base_url()."public/frontend/css/chosen.css",
                )
            );
            $this->layout->js
            (
                array
                (
                    base_url()."public/backend/fancybox/jquery.fancybox.js"
                )
            ); 
            //$this->layout->view('cotizaciones_cliente',compact('datos','cuantos','pagina','vendedores','list')); 
            $cuerpo.="<table border='' style='width:900px'><tr>"
                    . "<td align='right'><b>FECHA: </b>"
                    . date('d-m-Y')
                    . "<b> Hora: </b>".date('H:m')
                    . "</tr></table><br/>";        
            if($id==""){
            $cuerpo.="<table border='1' style='width:900px'><tr>"
                    . "<td align='center'><b>LISTADO GENERAL DE ORDENES CERRADAS</b>"
                    . "&nbsp;&nbsp;</td>"
                    . "</tr></table><br/>";    
            }else{
            $cuerpo.="<table border='1' style='width:900px'><tr>"
                    . "<td align='center'><b>LISTADO DE ORDENES CERRADAS POR VENDEDOR</b>"
                    . "&nbsp;&nbsp;</td></tr>"
                    . "<tr><td><b>VENDEDOR:</b>"
                    . "&nbsp;&nbsp;$nombrevendedor</td>"
                    . "</tr></table><br/>";    
            }
            
            if($id==""){
            $cuerpo.="<table border='1' style='width:900px'><tr class='titulo'>"
                    . "<td align='center'><b>OT</b></td>"
                    . "<td align='center'><b>COTIZACION</b></td>"
                    . "<td align='center'><b>MOLDE</b></td>"
                    . "<td align='center'><b>CANTIDAD</b></td>"
                    . "<td align='center'><b>PRECIO</b></td>"
                    . "<td align='center'><b>TAMAñO</b></td>"
                    . "<td align='center'><b>OP</b></td>"
                    . "<td align='center'><b>FECHA SOLICITUD</b></td>"
                    . "<td><b>CLIENTE</td>"
                    . "<td><b>VENDEDOR</td>"
                    . "<td><b>PRODUCTO</b></td>"
                    . "</tr>";
            }else{
                $cuerpo.="<table border='1' style='width:900px'><tr class='titulo'>"
                    . "<td align='center'><b>OT</b></td>"
                    . "<td align='center'><b>COTIZACION</b></td>"
                    . "<td align='center'><b>OP</b></td>"
                    . "<td align='center'><b>FECHA SOLICITUD</b></td>"
                    . "<td><b>CLIENTE</td>"
                    . "<td><b>PRODUCTO</b></td>"
                    . "</tr>";
            }
            
            
            if($id==""){
            foreach ($datos as $value) {
                $vendedores=$this->vendedores_model->getVendedorPorId($value->id_vendedor);
                $nombrevendedor=$vendedores->nombre;
                $cli=$this->clientes_model->getClientePorId($value->id_cliente);
                $cliente=$cli->razon_social; 
                $not=$this->orden_model->getNumeroOt($value->id); 
                $cuerpo.="<tr><td align='center'>$not->id_ot</td>"
                    . "<td align='center'>$value->id</td>"
                    . "<td align='center'>$value->id_molde</td>"
                    . "<td align='center'>$value->cantidad_pedida</td>"
                    . "<td align='center'>$value->precio</td>"
                    . "<td align='center'>$value->tamano_a_imprimir_1 x $value->tamano_a_imprimir_2</td>"
                    . "<td align='center'>$value->id_op</td>"
                    . "<td align='center'>$value->fecha</td>"
                    . "<td>$cliente</td>"
                    . "<td>$nombrevendedor</td>"
                    . "<td>$value->nombre_producto_normal</td></tr>";
            }}else{
                foreach ($datos as $value) {
                $vendedores=$this->vendedores_model->getVendedorPorId($value->id_vendedor);
                $nombrevendedor=$vendedores->nombre;
                $cli=$this->clientes_model->getClientePorId($value->id_cliente);
                $cliente=$cli->razon_social; 
                $not=$this->orden_model->getNumeroOt($value->id); 
                $cuerpo.="<tr><td align='center'>$not->id_ot</td>"
                    . "<td align='center'>$value->id</td>"
                    . "<td align='center'>$value->id_op</td>"
                    . "<td align='center'>$value->fecha</td>"
                    . "<td>$cliente</td>"
                    . "<td>$value->nombre_producto_normal</td></tr>";
            }}
            $cuerpo.="</table>";

            
            $this->mpdf->SetDisplayMode('fullpage');
            $css1 = file_get_contents('public/frontend/css/listado.css');
            $css2 = file_get_contents('bootstrap/bootstrap.css');
            $this->mpdf->WriteHTML($css2,1);
            $this->mpdf->WriteHTML($css1,1);
    		$this->mpdf->WriteHTML($cuerpo);
    		$this->mpdf->Output();
    		exit;
        
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
        
	}
        
        public function vendedor()
    {
        $id=$this->input->post("valor1",true);
        $valor3 = $this->input->post("valor3",true);
        $usuarios = $this->usuarios_model->getUsuariosPorId($valor3);
        if($this->input->post())
        {
             $data=array
            (
                "id_vendedor"=>$this->input->post("valor3",true),
            );

            $this->db->where('id', $id);
            $this->db->update("cotizaciones",$data);
            
            echo $usuarios->nombre;
            } 
    }
     
    public function cerrar_orden()
    {
        $id=$this->input->post("valor1",true);
        $operacion=$this->input->post("valor3",true);
        if($operacion==3){
        $estado=3;
        }else{
          if($operacion==4){
        $estado=4;
        }else{
         if($operacion==1){
        $estado=1;
        }   
        }}
        if($this->input->post())
        {
             $data=array
            (
                "estado"=>$estado,
            );

            $this->db->where('id_cotizacion', $id);
            $this->db->update("orden_de_produccion",$data);
            
            echo "Orden Cerrada";
            } 
    }
    public function fecha_confeccion()
    {
        $dato=$this->input->post("dato",true);
        $conf=$this->input->post("conf",true);
        $modo=$this->input->post("modo",true);
        
        if($this->input->post())
        {
            if($modo==1){
             $data=array
            (
                "conf_sal_pel"=>$conf,
                "fecha_conf_sal_pel"=>date('Y-m-d'),
            );
            $valor ="  Fecha: ".date('Y-m-d');
            }else{
             $data=array
            (
                "conf_sal_pel"=>$conf,
            );  
            $valor='';
            }
            $this->db->where('id_nodo', $dato);
            $this->db->update("produccion_fotomecanica",$data);
            
            echo $valor;
            } 
    }
    public function fecha_status()
    {
        $dato=$this->input->post("dato",true);
        $conf=$this->input->post("conf",true);
        $modo=$this->input->post("modo",true);
        
        if($this->input->post())
        {
            if($modo==1){
             $data=array
            (
                "status_linea"=>$conf,
                "fecha_conf_desg"=>date('Y-m-d'),
            );
            $valor ="  Fecha: ".date('Y-m-d');
            }else{
             $data=array
            (
                "status_linea"=>$conf,
            );  
            $valor='';
            }
            $this->db->where('id_nodo', $dato);
            $this->db->update("produccion_fotomecanica",$data);
            
            echo $valor;
            } 
    }
    
    public function desgajado_automatico()
    {
        $dato=$this->input->post("dato",true);
        $conf=$this->input->post("conf",true);
        
        if($this->input->post())
        {
            
             $data=array
            (
                "desgajado_automatico"=>$conf,
            );  
            
            $this->db->where('id_cotizacion', $dato);
            $this->db->update("cotizacion_ingenieria",$data);
            
            } 
    }
        
    public function cotizaciones()
	{
        if($this->input->post("pass_reversar",true)){
            if($this->input->post("pass_reversar",true)=="123123"){
                 $id=$this->input->post("numero_op",true);
                 $fotomecanica=$this->produccion_model->reversarOp($id);
                 $this->session->set_flashdata('success_op', 'Se reverso la orden de produccion con exito!!');
                 redirect(base_url().'produccion/cotizaciones/',  301);      
            }else{
                 $data=array
                (
                    "op"=>$this->input->post("numero_op",true),
                );
//                $this->db->where('id_cotizacion', $this->input->post('id',true));
//                $this->db->update("cotizacion_fotomecanica",$data2);
                 $this->session->set_flashdata('error_op', 'No se ha podido reversar la orden de produccion');
                 redirect(base_url().'produccion/cotizaciones/',  301);  
            }
        }
      // print_r($_POST);exit();
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
        $datos=$this->orden_model->getOrdenesConCotizacionPaginacion($pagina,$porpagina,"limit");
       // $cuantos=$this->orden_model->getOrdenesConCotizacionPaginacion($pagina,$porpagina,"cuantos");
        
	//	$cuantosCerrados=$this->produccion_model->getpaguinacionBodegaCerrados();
		
	//	$cuantos = $cuantos - $cuantosCerrados;
        /*
        $datos=$this->cotizaciones_model->getCotizacionesProduccionPaginacion($pagina,$porpagina,"limit");
        $cuantos=$this->cotizaciones_model->getCotizacionesProduccionPaginacion($pagina,$porpagina,"cuantos");
        */
        $config['base_url'] = base_url().'produccion/cotizaciones';
//            $config['total_rows'] = $cuantos;
//            $config['per_page'] = $porpagina;
//            $config['uri_segment'] = '3';
//            $config['num_links'] = '4';
//            $config['first_link'] = 'Primero';
//            $config['next_link'] = 'Siguiente';
//            $config['prev_link'] = 'Anterior';
//            $config['last_link'] = 'Ultimo';
//            $config['full_tag_open'] = '<ul class="pagination">';
//            $config['full_tag_close'] = '</ul>';
//            $config['first_tag_open'] = '<li>';
//            $config['first_tag_close'] = '</li>';
//            $config['last_tag_open'] = '<li>';
//            $config['last_tag_close'] = '</li>';
//            $config['next_tag_open'] = '<li>';
//            $config['next_tag_close'] = '</li>';
//            $config['prev_tag_open'] = '<li>';
//            $config['prev_tag_close'] = '</li>';
//            $config['cur_tag_open'] = '<li><a><b>';
//            $config['cur_tag_close'] = '</b></a></li>';
//            $config['num_tag_open'] = '<li>';
//            $config['num_tag_close'] = '</li>';
//            $this->pagination->initialize($config);
            $this->layout->css
            (
                array
                (
                    base_url()."public/backend/fancybox/jquery.fancybox.css",
                     base_url()."public/frontend/css/prism.css",
                    base_url()."public/frontend/css/chosen.css",
                )
            );
            $this->layout->js
            (
                array
                (
                    base_url()."public/backend/fancybox/jquery.fancybox.js"
                )
            ); 
            $this->layout->view('cotizaciones',compact('datos','cuantos','pagina')); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
        
	}
        
    public function cotizacionesVigencia($id)
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
        $datos=$this->orden_model->getOrdenesConCotizacionPaginacionVigencia($pagina,$porpagina,$id,"limit");
        $cuantos=$this->orden_model->getOrdenesConCotizacionPaginacionVigencia($pagina,$porpagina,$id,"cuantos");
       
		$cuantosCerrados=$this->produccion_model->getpaguinacionBodegaCerrados();
		
		$cuantos = $cuantos - $cuantosCerrados;
        /*
        $datos=$this->cotizaciones_model->getCotizacionesProduccionPaginacion($pagina,$porpagina,"limit");
        $cuantos=$this->cotizaciones_model->getCotizacionesProduccionPaginacion($pagina,$porpagina,"cuantos");
        */
        $config['base_url'] = base_url().'produccion/cotizaciones';
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
            $this->layout->css
            (
                array
                (
                    base_url()."public/backend/fancybox/jquery.fancybox.css",
                     base_url()."public/frontend/css/prism.css",
                    base_url()."public/frontend/css/chosen.css",
                )
            );
            $this->layout->js
            (
                array
                (
                    base_url()."public/backend/fancybox/jquery.fancybox.js"
                )
            ); 
            $this->layout->view('cotizaciones',compact('datos','cuantos','pagina')); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
        
	}
        
    public function fast()
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
        $datos=$this->fast_track_model->getFastTrackProduccionPaginacion($pagina,$porpagina,"limit");
        $cuantos=$this->fast_track_model->getFastTrackProduccionPaginacion($pagina,$porpagina,"cuantos");
        $config['base_url'] = base_url().'produccion/fast';
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
            $this->layout->css
            (
                array
                (
                    base_url()."public/backend/fancybox/jquery.fancybox.css",
                     base_url()."public/frontend/css/prism.css",
                    base_url()."public/frontend/css/chosen.css",
                )
            );
            $this->layout->js
            (
                array
                (
                    base_url()."public/backend/fancybox/jquery.fancybox.js"
                )
            ); 
            $this->layout->view('fast',compact('datos','cuantos','pagina')); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
        
	}
    public function archivos($id=null,$pagina=null)
	{
        if($this->session->userdata('id'))
        {
            if(!$id){show_404();}
            $fotomecanica=$this->cotizaciones_model->getCotizacionFotomecanicaPorIdCotizacion($id);
            $ing=$this->cotizaciones_model->getCotizacionIngenieriaPorIdCotizacion($id);
            if($this->input->post())
            {
                //ingeniería
                if($this->input->post('pdf_ing',true)=='SI')
                {
                    $pdf_ing=$this->input->post('file',true);
                }else
                {
                      $config['upload_path'] = './'.$this->config->item('direccion_pdf');
                      $config['allowed_types'] = 'pdf|jpg|png|jpeg|gif';
                      $config['max_size'] = '51200'; //550 x 138
                      $config['encrypt_name'] = true; 
                      $this->load->library('upload', $config);
                      $this->upload->do_upload('file');
                      $ima = $this->upload->data();
                      $pdf_ing = $ima['file_name'];
                }
                $data1=array
                (
                    "archivo"=>$pdf_ing,
                );
                $this->db->where('id_cotizacion', $this->input->post('id',true));
                $this->db->update("cotizacion_ingenieria",$data1);
                //fotomecánica
                if($this->input->post('pdf_fotomecanica',true)=='SI')
                {
                    $pdf_fotomecanica=$this->input->post('file',true);
                }else
                {
                      $config2['upload_path'] = './'.$this->config->item('direccion_pdf');
                      $config2['allowed_types'] = 'pdf|jpg|png|jpeg|gif';
                      $config2['max_size'] = '51200'; //550 x 138
                      $config2['encrypt_name'] = true; 
                      $this->load->library('upload', $config2);
                      $this->upload->do_upload('file2');
                      $ima2 = $this->upload->data();
                      $pdf_fotomecanica = $ima2['file_name'];
                }
                $data2=array
                (
                    "archivo"=>$pdf_fotomecanica,
                );
                $this->db->where('id_cotizacion', $this->input->post('id',true));
                $this->db->update("cotizacion_fotomecanica",$data2);
                //salgo de acá
                 $this->session->set_flashdata('ControllerMessage', 'Se han actualizado los archivos de Ingeniería y Fotomecánica');
                 redirect(base_url().'produccion/cotizaciones/'.$this->input->post('pagina',true),  301);    
            }
            $this->layout->js
            (
                array
                (
                        //base_url().'public/backend/js/tiny_mce/tiny_mce.js',
                        base_url()."public/backend/js/bootstrap.file-input.js"
                )
            );   
            $this->layout->view('archivos',compact('datos','fotomecanica','ing','pagina','id')); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
        
	}
    /**
     * Revisión fotomecánica
     * */
    public function pendientes_fotomecanica($id=null)
    {
        if($this->session->userdata('id'))
        {
            if(!$id){show_404();}
            $datos=$this->cotizaciones_model->getCotizacionPorId($id);
            $fotomecanica=$this->produccion_model->getFotomecanicaPorTipo(1,$id);
            $this->layout->setLayout('template_ajax');
            $this->layout->view('pendientes_fotomecanica',compact('fotomecanica','datos','id')); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
    }
    
    
    public function revision_fotomecanica($tipo=null,$id=null,$pagina=null)
    {
         if($this->session->userdata('id'))
        {
            if(!$id){show_404();}
            
            switch($tipo)
                    {
                        case '1':
                            $datos=$this->cotizaciones_model->getCotizacionPorId($id);
                        break;
                         case '2':
                            $datos=$this->fast_track_model->getFastTrackPorId($id);
                        break;
                    }      
            $ordenDeCompra=$this->cotizaciones_model->getOrdenDeCompraPorCotizacion($id);
            $orden=$this->orden_model->getOrdenesPorCotizacion($id);
            $fotomecanica=$this->produccion_model->getFotomecanicaPorTipo($tipo,$id);
            $fotomecanica2=$this->cotizaciones_model->getCotizacionFotomecanicaPorIdCotizacion($id);
            $ing=$this->cotizaciones_model->getCotizacionIngenieriaPorIdCotizacion($id);
            
            /*materialidad*/
            $hoja=$this->cotizaciones_model->getHojaDeCostosPorIdCotizacion($id);            
            $tapa = $this->materiales_model->getMaterialesPorNombre($fotomecanica2->materialidad_1);
            $monda = $this->materiales_model->getMaterialesPorNombre($fotomecanica2->materialidad_2);
            $mliner = $this->materiales_model->getMaterialesPorNombre($fotomecanica2->materialidad_3);            
            $materialidad_1=$this->materiales_model->getMaterialesPorNombre($fotomecanica2->materialidad_1);
            $materialidad_2=$this->materiales_model->getMaterialesPorNombre($fotomecanica2->materialidad_2);
            $materialidad_3=$this->materiales_model->getMaterialesPorNombre($fotomecanica2->materialidad_3);            
//            exit(print_r($tapa));


            
            //print_r($fotomecanica);exit;
            if(sizeof($datos)==0){show_404();}

            ////// GUARDADO ///////
            if($this->input->post())
            {
            //echo $this->input->post('estado',true); exit();    
            if($this->input->post('estado',true)=='1' || $this->input->post('estado',true)=='0')
            {                       
                    if($this->input->post('estado',true)=='1')
                    {
                        if($this->input->post('envio_vb_maqueta',true)=='NO' or $this->input->post('envio_vb_color',true)=='NO' or $this->input->post('envio_vb_estructura',true)=='NO' and $this->input->post('entrega_a_fabricacion_a_linea_de_troquel',true)=='NO' or $this->input->post('confeccion_de_planchas',true)=='NO')
                        {
                            $this->session->set_flashdata('ControllerMessage', 'Para liberar deben estar en SI : VB Maqueta, VB Color, VB Estructura, Entrega a fabricación a línea de troquel y Confección de Planchas');
                            redirect(base_url().'produccion/revision_fotomecanica/'.$this->input->post('tipo',true)."/".$this->input->post('id',true)."/".$this->input->post('pagina',true),  301);    
                        }
                    }
                                       
                                    $pf=$this->produccion_model->getFotomecanicaPorTipo($tipo,$id);
				    //if(empty($pf->pdf_imagen))
				    if(empty($_FILES["file"]["name"]))
                                    {//exit();
                                    //if(sizeof($ing->archivo) > 0)
                                    if($pf->pdf_imagen<>"")
				    {
				    $file_name=$pf->pdf_imagen;	
				    }else{
				    $file_name="";	
				    }
                                    }else
                                    {
                                    $error=NULL;
                                   //valido la foto
                                    $config['upload_path'] = $this->config->item('direccion_pdf');
                                    $config['allowed_types'] = 'pdf|jpg|png|jpeg|gif';
                                    $config['max_size'] = '51200'; //550 x 138
                                    $config['encrypt_name'] = true; 
                                     $this->load->library('upload', $config);
                                     if ( ! $this->upload->do_upload('file'))
                                        {
                                            $error = array('error' => $this->upload->display_errors());
                                            $this->session->set_flashdata('mensaje', $error["error"]);
                                            $this->session->set_flashdata('css',"danger");
                                            redirect(base_url().'produccion/revision_fotomecanica/'.$this->input->post("id",true)."/".$this->input->post("pagina",true),  301);
                                            
                                        }
                                        
                                            $ima = $this->upload->data();
                                            $file_name = $ima['file_name'];
                                            //$file_name = $pf->pdf_imagen;
                                      }
							
                    if($this->input->post('recepcion_ot',true)=="Aprobada") {
                        if ($this->input->post('input_fecha_recepcion_ot_aprobado',true)=='0000-00-00') {
                            $recepcion_ot_aprobado_fecha=date("Y-m-d");
                            $comentario_rechazo           = '';
                            $fecha_rechazada_recepcion_OT = '';
                        } else {
                            $recepcion_ot_aprobado_fecha=$this->input->post('input_fecha_recepcion_ot_aprobado',true); 
                            $comentario_rechazo           = '';
                            $fecha_rechazada_recepcion_OT = '';
                        }
                    } elseif($this->input->post('recepcion_ot',true)=="Por Revisar") {
                        $recepcion_ot_aprobado_fecha  = "0000-00-00";
                        $comentario_rechazo           = "";
                        $fecha_rechazada_recepcion_OT = "";
                    } else {
                        $recepcion_ot_aprobado_fecha="0000-00-00";
                    }

                            		 
				   if($this->input->post('revision_trazado',true)=="Aprobada") {
                    if ($this->input->post('input_fecha_trazado_aprobado',true)=='0000-00-00') {
                        $revision_trazado=date("Y-m-d");
                    } else {
                        $revision_trazado=$this->input->post('input_fecha_trazado_aprobado',true); 
                    }
                   } else {
                        $revision_trazado="0000-00-00";
                   }

                   if($this->input->post('recepcion_maqueta',true)=="Recepcion Aprobada") {
                    if ($this->input->post('input_fecha_maqueta_aprobado',true)=='0000-00-00') {
                        $fecha_recepcion_maqueta=date("Y-m-d");
                    } else {
                        $fecha_recepcion_maqueta=$this->input->post('input_fecha_maqueta_aprobado',true); 
                    }
                   } else {
                        $fecha_recepcion_maqueta="0000-00-00";
                   }

                   if($this->input->post('revision_de_imagen',true)=="Aprobado") {
                    if ($this->input->post('input_fecha_imagen_aprobado',true)=='0000-00-00') {
                        $revision_de_imagen=date("Y-m-d");
                    } else {
                        $revision_de_imagen=$this->input->post('input_fecha_imagen_aprobado',true); 
                    }
                   } else {
                        $revision_de_imagen="0000-00-00";
                   }

                   if($this->input->post('montaje_digital',true)=="Aprobado") {
                    if ($this->input->post('input_fecha_montaje_aprobado',true)=='0000-00-00') {
                        $montaje_digital_fecha=date("Y-m-d");
                    } else {
                        $montaje_digital_fecha=$this->input->post('input_fecha_montaje_aprobado',true); 
                    }
                   } else {
                        $montaje_digital_fecha="0000-00-00";
                   }

                   if($this->input->post('prueba_color',true)=="Aprobado") {
                    if ($this->input->post('input_fecha_prueba_color_aprobado',true)=='0000-00-00') {
                        $prueba_color_fecha=date("Y-m-d");
                    } else {
                        $prueba_color_fecha=$this->input->post('input_fecha_prueba_color_aprobado',true); 
                    }
                   } else {
                        $prueba_color_fecha="0000-00-00";
                   }
                   
                   if($this->input->post('arte_diseno',true)=="Aprobado") {
                    if ($this->input->post('input_fecha_arte_diseno_aprobado',true)=='0000-00-00') {
                        $arte_diseno_fecha=date("Y-m-d");
                    } else {
                        $arte_diseno_fecha=$this->input->post('input_fecha_arte_diseno_aprobado',true); 
                    }
                   } else {
                        $arte_diseno_fecha="0000-00-00";
                   }
                   
                   if($this->input->post('conf_sal_pel',true)=="Entregado") {
                    if ($this->input->post('input_fecha_conf_sal_pel_aprobado',true)=='0000-00-00') {
                        $conf_sal_pel_fecha=date("Y-m-d");
                    } else {
                        $conf_sal_pel_fecha=$this->input->post('input_fecha_conf_sal_pel_aprobado',true); 
                    }
                   } else {
                        $conf_sal_pel_fecha="0000-00-00";
                   }

                   if($this->input->post('conf_sal_pel_desgajado',true)=="Entregado") {
                    if ($this->input->post('input_fecha_conf_sal_pel_desgajado_aprobado',true)=='0000-00-00') {
                        $conf_sal_pel_desgajado_fecha=date("Y-m-d");
                    } else {
                        $conf_sal_pel_desgajado_fecha=$this->input->post('input_fecha_conf_sal_pel_desgajado_aprobado',true); 
                    }
                   } else {
                        $conf_sal_pel_desgajado_fecha="0000-00-00";
                   }

                   if($this->input->post('sobre_desarrollo',true)=="Entregado") {
                    if ($this->input->post('input_fecha_sobre_desarrollo_aprobado',true)=='0000-00-00') {
                        $sobre_desarrollo_fecha=date("Y-m-d");
                    } else {
                        $sobre_desarrollo_fecha=$this->input->post('input_fecha_sobre_desarrollo_aprobado',true); 
                    }
                   } else {
                        $sobre_desarrollo_fecha="0000-00-00";
                   }


                   if($this->input->post('preparacion_de_archivos',true)=="SI")
                   {
                       $preparacion_de_archivos=date("Y-m-d");
                   }else
                   {
                       $preparacion_de_archivos="0000-00-00"; 
                   }
                   if($this->input->post('envio_vb_cliente',true)=="SI")
                   {
                       $envio_vb_cliente=date("Y-m-d");
                       if($tipo=='1')
                       {
                           $vendedor=$this->usuarios_model->getUsuariosPorId($datos->id_vendedor);
                           $config['mailtype'] = 'html';
                           $this->email->initialize($config);
                           $this->email->from("contacto@grauindus.cl", 'Cartonajes Grau');
                           $this->email->to($vendedor->correo); 
                           $this->email->bcc('respaldocorreos@grauindus.cl');
                           $this->email->subject('Mensaje de Cartonajes Grau');
                           $html='<h2>Nuevo Mensaje:</h2>';
                           $html.='La cotización N°'.$this->input->post('id',true).' ha recibido el VB del vendedor '.$vendedor->nombre.', con la glosa:<br/>'.$this->input->post("glosa",true);
                           $this->email->message($html);   
                           $this->email->send();
                       }
                       
                   }else
                   {
                       $envio_vb_cliente="0000-00-00"; 
                   }
                   if($this->input->post('recepcion_vb_cliente_1',true))
                   {
                       $recepcion_vb_cliente_1=date("Y-m-d");
                   }else
                   {
                       $recepcion_vb_cliente_1="0000-00-00"; 
                   }
                   if($this->input->post('envio_vb_cliente_2',true)=="SI")
                   {
                       $envio_vb_cliente_2=date("Y-m-d");
                   }else
                   {
                       $envio_vb_cliente_2="0000-00-00"; 
                   }
                   if($this->input->post('envio_vb_cliente_3',true)=="SI")
                   {
                       $envio_vb_cliente_3=date("Y-m-d");
                   }else
                   {
                       $envio_vb_cliente_3="0000-00-00"; 
                   }
                   if($this->input->post('envio_vb_vendedor',true)=="SI")
                   {
                       $envio_vb_vendedor=date("Y-m-d");
                   }else
                   {
                       $envio_vb_vendedor="0000-00-00"; 
                   }
                   if($this->input->post('recepcion_vb_vendedor_1',true))
                   {
                       $recepcion_vb_vendedor_1=date("Y-m-d");
                   }else
                   {
                       $recepcion_vb_vendedor_1="0000-00-00"; 
                   }
                   if($this->input->post('envio_vb_vendedor_2',true)=="SI")
                   {
                       $envio_vb_vendedor_2=date("Y-m-d");
                   }else
                   {
                       $envio_vb_vendedor_2="0000-00-00"; 
                   }
                   if($this->input->post('envio_vb_vendedor_3',true)=="SI")
                   {
                       $envio_vb_vendedor_3=date("Y-m-d");
                   }else
                   {
                       $envio_vb_vendedor_3="0000-00-00"; 
                   }
                   if($this->input->post('correcciones',true)=="SI")
                   {
                       $correcciones=date("Y-m-d");
                   }else
                   {
                       $correcciones="0000-00-00"; 
                   }
                   if($this->input->post('confeccion_de_peliculas',true)=="SI")
                   {
                       $confeccion_de_peliculas=date("Y-m-d");
                   }else
                   {
                       $confeccion_de_peliculas="0000-00-00"; 
                   }
                   if($this->input->post('confeccion_de_planchas',true)=="SI")
                   {
                       $confeccion_de_planchas=date("Y-m-d");
                   }else
                   {
                       $confeccion_de_planchas="0000-00-00"; 
                   }
                   if($this->input->post('recepcion_parcial',true)=="SI")
                   {
                       $recepcion_parcial=date("Y-m-d");
                   }else
                   {
                       $recepcion_parcial="0000-00-00"; 
                   }
                   if($this->input->post('recepcion_total',true)=="SI")
                   {
                       $recepcion_total=date("Y-m-d");
                   }else
                   {
                       $recepcion_total="0000-00-00"; 
                   }
                   if($this->input->post('envio_vb_maqueta',true)=="SI")
                   {
                       $envio_vb_maqueta=date("Y-m-d");
                   }else
                   {
                       $envio_vb_maqueta="0000-00-00"; 
                   }
                   if($this->input->post('envio_vb_color',true)=="SI")
                   {
                       $envio_vb_color=date("Y-m-d");
                   }else
                   {
                       $envio_vb_color="0000-00-00"; 
                   }
                   if($this->input->post('envio_vb_estructura',true)=="SI")
                   {
                       $envio_vb_estructura=date("Y-m-d");
                   }else
                   {
                       $envio_vb_estructura="0000-00-00"; 
                   }
                   if(sizeof($fotomecanica)==0)
                   {
                        switch ($this->input->post('estado', true)) {
                            case '1': //Liberra
                                $situacion = 'Liberada';
                                $fecha_pendiente = '0000-00-00';
                                $fecha_liberada = date('Y-m-d H:i:s');
                                $fecha_activa = '0000-00-00';
                                $fecha_orden_cerrada = '0000-00-00';
                                break;
                            case '0': //guardar
                                $situacion = 'Guardar';
                                $fecha_pendiente = '0000-00-00';
                                $fecha_liberada = '0000-00-00';
                                $fecha_activa = $orden->fecha;
                                $fecha_orden_cerrada = '0000-00-00';
                                break;
                            case '2': // rechazar
                                $situacion = 'Rechazar';
                                $fecha_pendiente = date('Y-m-d H:i:s');
                                $fecha_liberada = '0000-00-00';
                                $fecha_activa = '0000-00-00';
                                $fecha_orden_cerrada = '0000-00-00';
                                break;
                        }
                    }else
                   {
                  // echo $this->input->post('estado', true);
                     //switch($fotomecanica->estado)
                     switch($this->input->post('estado', true))
                     {
                        case 1: //Liberra
                            $situacion='Liberada';
                            $fecha_pendiente='0000-00-00';
                            $fecha_liberada=date('Y-m-d H:i:s');
                            $fecha_activa='0000-00-00';
                            $fecha_orden_cerrada='0000-00-00';
                        break;
                        case 0: //guardar
                            $situacion='Guardar';
                            $fecha_pendiente='0000-00-00';
                            $fecha_liberada='0000-00-00';
                            $fecha_activa=$orden->fecha;
                            $fecha_orden_cerrada='0000-00-00';
                        break;
                        case 2: // rechazar
                            $situacion='Rechazar';
                            $fecha_pendiente=date('Y-m-d H:i:s');
                            $fecha_liberada='0000-00-00';
                            $fecha_activa='0000-00-00';
                            $fecha_orden_cerrada='0000-00-00';
                        break;
						
                     }
                   }


                 //  echo $situacion;
                    if($this->input->post('recepcion_ot',true)=="Aprobada") {
                        if ($this->input->post('input_fecha_recepcion_ot_aprobado',true)=='0000-00-00') {
                            $data=array
                            (
                               "id_usuario"=>$this->session->userdata('id'),
                               "tipo"=>$this->input->post('tipo',true),
                               "id_nodo"=>$this->input->post('id',true),
                               
                               "situacion"          =>$situacion,
                               "fecha_pendiente"    =>$fecha_pendiente,
                               "fecha_liberada"     =>$fecha_liberada,
                               "fecha_activa"       =>$fecha_activa,
                               "fecha_orden_cerrada"=>$fecha_orden_cerrada,
                               "estado"             =>$this->input->post('estado',true),
                               "fecha"              =>date("Y-m-d"),
                               'quien'              =>$this->session->userdata('id'),
                               'cuando'             =>date("Y-m-d"),
                               "correcciones_fecha" =>date("Y-m-d"),
                               "pdf_imagen"         =>$file_name,
                               "correcciones_id_usuario"=>$this->session->userdata('id'),
                               "peliculas_para_imprimir"=>$this->input->post('peliculas_para_imprimir',true),
                               "comentario_fotomecanica"=>$this->input->post('comentario_fotomecanica',true),
                               "recepcion_ot"           =>$this->input->post('recepcion_ot',true),
                               "revision_trazado"       =>$this->input->post('revision_trazado',true),
                               "recepcion_maqueta"      =>$this->input->post('recepcion_maqueta',true),
                               "revision_imagen"        =>$this->input->post('revision_de_imagen',true),
                               "montaje_digital"        =>$this->input->post('montaje_digital',true),
                               "prueba_color"           =>$this->input->post('prueba_color',true),
                               "arte_diseno"            =>$this->input->post('arte_diseno',true),
                               "conf_sal_pel"           =>$this->input->post('conf_sal_pel',true),
                               "sobre_desarrollo"       =>$this->input->post('sobre_desarrollo',true),
                               "para_maquina"           =>$this->input->post('para_maquina',true),
                               "correcciones"           =>$this->input->post('correcciones',true),
                               "recepcion_ot_aprobado_fecha"=>$recepcion_ot_aprobado_fecha,
                               "revision_trazado_fecha"=>$revision_trazado,
                               "recepcion_maqueta_fecha"=>$fecha_recepcion_maqueta,

                               "revision_de_imagen_fecha"=>$revision_de_imagen,
                               "montaje_digital_fecha"=>$montaje_digital_fecha,
                               "prueba_color_fecha"=>$prueba_color_fecha,
                               "arte_diseno_fecha"=>$arte_diseno_fecha,
                               "conf_sal_pel_fecha"=>$conf_sal_pel_fecha,
                               "conf_sal_pel_desgajado"=>$this->input->post('conf_sal_pel_desgajado',true),
                               "conf_sal_pel_desgajado_fecha"=>$conf_sal_pel_desgajado_fecha,
                               "sobre_desarrollo_fecha"=>$sobre_desarrollo_fecha,
                               "comentario_rechazo"=>'',
                               "fecha_rechazada_recepcion_OT"=>'',
                            );  
                        } else {
                            $data=array
                            (
                               "id_usuario"=>$this->session->userdata('id'),
                               "tipo"=>$this->input->post('tipo',true),
                               "id_nodo"=>$this->input->post('id',true),
                               
                               "situacion"          =>$situacion,
                               "fecha_pendiente"    =>$fecha_pendiente,
                               "fecha_liberada"     =>$fecha_liberada,
                               "fecha_activa"       =>$fecha_activa,
                               "fecha_orden_cerrada"=>$fecha_orden_cerrada,
                               "estado"             =>$this->input->post('estado',true),
                               "fecha"              =>date("Y-m-d"),
                               'quien'              =>$this->session->userdata('id'),
                               'cuando'             =>date("Y-m-d"),
                               "correcciones_fecha" =>date("Y-m-d"),
                               "pdf_imagen"         =>$file_name,
                               "correcciones_id_usuario"=>$this->session->userdata('id'),
                               "peliculas_para_imprimir"=>$this->input->post('peliculas_para_imprimir',true),
                               "comentario_fotomecanica"=>$this->input->post('comentario_fotomecanica',true),
                               "recepcion_ot"           =>$this->input->post('recepcion_ot',true),
                               "revision_trazado"       =>$this->input->post('revision_trazado',true),
                               "recepcion_maqueta"      =>$this->input->post('recepcion_maqueta',true),
                               "revision_imagen"        =>$this->input->post('revision_de_imagen',true),
                               "montaje_digital"        =>$this->input->post('montaje_digital',true),
                               "prueba_color"           =>$this->input->post('prueba_color',true),
                               "arte_diseno"            =>$this->input->post('arte_diseno',true),
                               "conf_sal_pel"           =>$this->input->post('conf_sal_pel',true),
                               "sobre_desarrollo"       =>$this->input->post('sobre_desarrollo',true),
                               "para_maquina"           =>$this->input->post('para_maquina',true),
                               "correcciones"           =>$this->input->post('correcciones',true),
                               "recepcion_ot_aprobado_fecha"=>$recepcion_ot_aprobado_fecha,
                               "revision_trazado_fecha"=>$revision_trazado,
                               "recepcion_maqueta_fecha"=>$fecha_recepcion_maqueta,
                               "revision_de_imagen_fecha"=>$revision_de_imagen,
                               "montaje_digital_fecha"=>$montaje_digital_fecha,
                               "prueba_color_fecha"=>$prueba_color_fecha,
                               "arte_diseno_fecha"=>$arte_diseno_fecha,
                               "conf_sal_pel_fecha"=>$conf_sal_pel_fecha,
                               "conf_sal_pel_desgajado"=>$this->input->post('conf_sal_pel_desgajado',true),
                               "conf_sal_pel_desgajado_fecha"=>$conf_sal_pel_desgajado_fecha,
                               "sobre_desarrollo_fecha"=>$sobre_desarrollo_fecha,
                               "comentario_rechazo"=>'',
                               "fecha_rechazada_recepcion_OT"=>'',
                            );  
                        }
                    } elseif($this->input->post('recepcion_ot',true)=="Por Revisar") {
                        $data=array
                        (
                           "id_usuario"=>$this->session->userdata('id'),
                           "tipo"=>$this->input->post('tipo',true),
                           "id_nodo"=>$this->input->post('id',true),
                           
                           "situacion"          =>$situacion,
                           "fecha_pendiente"    =>$fecha_pendiente,
                           "fecha_liberada"     =>$fecha_liberada,
                           "fecha_activa"       =>$fecha_activa,
                           "fecha_orden_cerrada"=>$fecha_orden_cerrada,
                           "estado"             =>$this->input->post('estado',true),
                           "fecha"              =>date("Y-m-d"),
                           'quien'              =>$this->session->userdata('id'),
                           'cuando'             =>date("Y-m-d"),
                           "correcciones_fecha" =>date("Y-m-d"),
                           "pdf_imagen"         =>$file_name,
                           "correcciones_id_usuario"=>$this->session->userdata('id'),
                           "peliculas_para_imprimir"=>$this->input->post('peliculas_para_imprimir',true),
                           "comentario_fotomecanica"=>$this->input->post('comentario_fotomecanica',true),
                           "recepcion_ot"           =>$this->input->post('recepcion_ot',true),
                           "revision_trazado"       =>$this->input->post('revision_trazado',true),
                           "recepcion_maqueta"      =>$this->input->post('recepcion_maqueta',true),
                           "revision_imagen"        =>$this->input->post('revision_de_imagen',true),
                           "montaje_digital"        =>$this->input->post('montaje_digital',true),
                           "prueba_color"           =>$this->input->post('prueba_color',true),
                           "arte_diseno"            =>$this->input->post('arte_diseno',true),
                           "conf_sal_pel"           =>$this->input->post('conf_sal_pel',true),
                           "sobre_desarrollo"       =>$this->input->post('sobre_desarrollo',true),
                           "para_maquina"           =>$this->input->post('para_maquina',true),
                           "correcciones"           =>$this->input->post('correcciones',true),
                           "recepcion_ot_aprobado_fecha"=>$recepcion_ot_aprobado_fecha,
                           "revision_trazado_fecha"=>$revision_trazado,
                           "recepcion_maqueta_fecha"=>$fecha_recepcion_maqueta,

                           "revision_de_imagen_fecha"=>$revision_de_imagen,
                           "montaje_digital_fecha"=>$montaje_digital_fecha,
                           "prueba_color_fecha"=>$prueba_color_fecha,
                           "arte_diseno_fecha"=>$arte_diseno_fecha,
                           "conf_sal_pel_fecha"=>$conf_sal_pel_fecha,
                           "conf_sal_pel_desgajado"=>$this->input->post('conf_sal_pel_desgajado',true),
                           "conf_sal_pel_desgajado_fecha"=>$conf_sal_pel_desgajado_fecha,
                           "sobre_desarrollo_fecha"=>$sobre_desarrollo_fecha,
                           "comentario_rechazo"=>'',
                           "fecha_rechazada_recepcion_OT"=>'',
                        );  
                    } else {
                        $data=array
                        (
                           "id_usuario"=>$this->session->userdata('id'),
                           "tipo"=>$this->input->post('tipo',true),
                           "id_nodo"=>$this->input->post('id',true),
                           
                           "situacion"          =>$situacion,
                           "fecha_pendiente"    =>$fecha_pendiente,
                           "fecha_liberada"     =>$fecha_liberada,
                           "fecha_activa"       =>$fecha_activa,
                           "fecha_orden_cerrada"=>$fecha_orden_cerrada,
                           "estado"             =>$this->input->post('estado',true),
                           "fecha"              =>date("Y-m-d"),
                           'quien'              =>$this->session->userdata('id'),
                           'cuando'             =>date("Y-m-d"),
                           "correcciones_fecha" =>date("Y-m-d"),
                           "pdf_imagen"         =>$file_name,
                           "correcciones_id_usuario"=>$this->session->userdata('id'),
                           "peliculas_para_imprimir"=>$this->input->post('peliculas_para_imprimir',true),
                           "comentario_fotomecanica"=>$this->input->post('comentario_fotomecanica',true),
                           "recepcion_ot"           =>$this->input->post('recepcion_ot',true),
                           "revision_trazado"       =>$this->input->post('revision_trazado',true),
                           "recepcion_maqueta"      =>$this->input->post('recepcion_maqueta',true),
                           "revision_imagen"        =>$this->input->post('revision_de_imagen',true),
                           "montaje_digital"        =>$this->input->post('montaje_digital',true),
                           "prueba_color"           =>$this->input->post('prueba_color',true),
                           "arte_diseno"            =>$this->input->post('arte_diseno',true),
                           "conf_sal_pel"           =>$this->input->post('conf_sal_pel',true),
                           "sobre_desarrollo"       =>$this->input->post('sobre_desarrollo',true),
                           "para_maquina"           =>$this->input->post('para_maquina',true),
                           "correcciones"           =>$this->input->post('correcciones',true),
                           "recepcion_ot_aprobado_fecha"=>$recepcion_ot_aprobado_fecha,
                           "revision_trazado_fecha"=>$revision_trazado,
                           "recepcion_maqueta_fecha"=>$fecha_recepcion_maqueta,

                           "revision_de_imagen_fecha"=>$revision_de_imagen,
                           "montaje_digital_fecha"=>$montaje_digital_fecha,
                           "prueba_color_fecha"=>$prueba_color_fecha,
                           "arte_diseno_fecha"=>$arte_diseno_fecha,
                           "conf_sal_pel_fecha"=>$conf_sal_pel_fecha,
                           "conf_sal_pel_desgajado"=>$this->input->post('conf_sal_pel_desgajado',true),
                           "conf_sal_pel_desgajado_fecha"=>$conf_sal_pel_desgajado_fecha,
                           "sobre_desarrollo_fecha"=>$sobre_desarrollo_fecha,
                        );  
                    }
			}				

//ALTER TABLE `p7000190_grau`.`produccion_fotomecanica` ADD COLUMN `recepcion_ot` VARCHAR(45) NULL  AFTER `comentario_fotomecanica` , ADD COLUMN `recepcion_trazado` VARCHAR(100) NULL  AFTER `recepcion_ot` , ADD COLUMN `revision_imagen` VARCHAR(100) NULL  AFTER `recepcion_trazado` , ADD COLUMN `montaje_digital` VARCHAR(45) NULL  AFTER `revision_imagen` , ADD COLUMN `prueba_color` VARCHAR(45) NULL  AFTER `montaje_digital` , ADD COLUMN `arte_diseno` VARCHAR(100) NULL  AFTER `prueba_color` , ADD COLUMN `conf_sal_pel` VARCHAR(100) NULL  AFTER `arte_diseno` , ADD COLUMN `sobre_desarrollo` VARCHAR(100) NULL  AFTER `conf_sal_pel` ;
//ALTER TABLE `p7000190_grau`.`produccion_fotomecanica` ADD COLUMN `recepcion_maqueta` VARCHAR(100) NULL  AFTER `sobre_desarrollo` ;
//ALTER TABLE `p7000190_grau`.`produccion_fotomecanica` ADD COLUMN `comentario_rechazo` VARCHAR(1000) NULL  AFTER `sobre_desarrollo` ;            
            
// echo '<pre>';
// print_r($data);
// exit();
			//Rechazar
		    if($this->input->post("estado",true)==2)  /// RECHAZAR
            {
                    //////////////////////                
                    $vendedor = $this->usuarios_model->getUsuariosPorId($datos->id_vendedor);
                    $user = $this->usuarios_model->getUsuariosPorId($this->session->userdata('id'));
                    $config['mailtype'] = 'html';
                    $this->email->initialize($config);
                    $this->email->from("contacto@grauindus.cl", 'Cartonajes Grau');
                    //$this->email->to($vendedor->correo); 
                    $this->email->to(array($vendedor->correo, 'contactos_fotomecanica@grauindus.cl', 'contactos_ingenieria@grauindus.cl', 'contactos_cotizador@grauindus.cl'));
                    $this->email->bcc('respaldocorreos@grauindus.cl');
                    $this->email->subject('Mensaje de Cartonajes Grau');
                    $html = '<h2>Orden de Producción: Revisión Fotomecanica:</h2>';
                    $html .= 'La Orden de Producción N°' . $this->input->post('id', true) . ' ha sido rechazada, con la glosa:<br/>' . $this->input->post("glosa", true) . '<br><br> Rechazado Por: ' . $user->nombre;
                    $this->email->message($html);
                    $this->email->send();
                    //////////////////////

                    $op = $this->orden_model->getOrdenesPorId($id);										

		            //ING cotizacion_ingenieria
                    //$data2 = array("estado" => $this->input->post("estado", true),);  //2 RECHAZADO
                        $this->db->where('id_cotizacion', $this->input->post('id', true));
                        $this->db->update("cotizacion_ingenieria", $data);

                    //FOTO cotizacion_fotomecanica
                    $data2 = array("estado" => $this->input->post("estado", true),);  //2 RECHAZADO
                        $this->db->where('id_cotizacion', $this->input->post('id', true));
                        $this->db->update("cotizacion_fotomecanica", $data2);

                    //HC = hoja_de_costos_datos
                    $data3 = array("fecha" => '0000-00-00', );
                        $this->db->where('id_cotizacion', $this->input->post('id', true));
                        $this->db->update("hoja_de_costos_datos", $data3);

                    //OC = cotizaciones_orden_de_compra
                    $data4 = array("estado" => $this->input->post("estado", true), );
                        $this->db->where('id_cotizacion', $this->input->post('id', true));
                        $this->db->update("cotizaciones_orden_de_compra", $data4);

                    //op = orden_de_produccion
                    $data6 = array("estado" => $this->input->post("estado", true), );
                        $this->db->where('id_cotizacion', $this->input->post("id", true));
                        $this->db->update("orden_de_produccion", $data6);

                    //op foto = produccion_fotomecanica
		            $data5 = array(
                        "estado" => $this->input->post("estado", true),
                        "situacion" => "Rechaza",
                        "glosa" => $this->input->post("glosa", true), );

                        $this->db->where('id_nodo', $this->input->post('id', true));
                        $this->db->update("produccion_fotomecanica", $data5);

            }  /// FIN RECHAZAR


                    $arch=array('archivo'=>$file_name, );			
                    if(sizeof($fotomecanica)==0){
                        $this->db->insert("produccion_fotomecanica",$data);
                    }else{
                        $this->db->update('produccion_fotomecanica', $data, array('tipo' => $this->input->post('tipo',true),'id_nodo'=>$this->input->post('id',true)));                       
                    }    

                    $this->db->update("cotizacion_fotomecanica",$arch, array('id_cotizacion'=>$this->input->post('id',true)));

                    switch($tipo)
                    {
                        case '1':   //cotizaciones
                            $this->session->set_flashdata('ControllerMessage', 'Se ha guardado el registro exitosamente.');					            
                            redirect(base_url().'produccion/cotizaciones/'.$this->input->post('pagina',true),  301);
                        break;
                         case '2':  //fast
                            $this->session->set_flashdata('ControllerMessage', 'Se ha guardado el registro exitosamente.');					            
                            redirect(base_url().'produccion/fast/'.$this->input->post('pagina',true),  301);
                        break;
                    }             
                    
            }
             $this->layout->js(
                array(base_url()."public/backend/js/bootstrap.file-input.js"));   

            $this->layout->view('revision_fotomecanica',compact('datos','fotomecanica','tipo','id','pagina','ordenDeCompra','orden','fotomecanica2','ing','tapa','materialidad_1','hoja','monda','mliner','materialidad_2','materialidad_3')); 

        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
    }
	
	
	
	
	
	/**
     * Control Cartulina
     * */
     public function control_cartulina($tipo=null,$id=null,$pagina=null)
	{
        if($this->session->userdata('id'))
        {
          
            if(!$tipo or !$id){show_404();}
           switch($tipo)
                    {
                        case '1':
                            $datos=$this->cotizaciones_model->getCotizacionPorId($id);
                        break;
                         case '2':
                            $datos=$this->fast_track_model->getFastTrackPorId($id);
                        break;
                    }      
			if(sizeof($datos)==0){show_404();}
            $control_cartulina=$this->produccion_model->getControlCartulinaPorTipo($tipo,$id);
            $cotizacion=$this->cotizaciones_model->getCotizacionPorId($id);
            $ing=$this->cotizaciones_model->getCotizacionIngenieriaPorIdCotizacion($id);
            $fotomecanica=$this->cotizaciones_model->getCotizacionFotomecanicaPorIdCotizacion($id);
            $fotomecanica2=$this->produccion_model->getFotomecanicaPorTipo($tipo,$id);
            $hoja=$this->cotizaciones_model->getHojaDeCostosPorIdCotizacion($id);
            $ordenDeCompra=$this->cotizaciones_model->getOrdenDeCompraPorCotizacion($id);
            $orden=$this->orden_model->getOrdenesPorCotizacion($id);
            $bobinas=$this->bobinas_model->getBobinasPorId($id);
            
            
            /*materialidad*/
            $tapa = $this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_1);
            $monda = $this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_2);
            $mliner = $this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_3);            
            $materialidad_1=$this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_1);
            $materialidad_2=$this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_2);
            $materialidad_3=$this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_3); 
            
//            print_r($tapa);
            
            
            if($this->input->post())
            {
                if($this->form_validation->run('control_cartulina'))
                {
                    $total_kilos_restantes_parcial_1    =$this->input->post('total_kilos_restantes'             ,true);
                    $numero_de_bobina                   =$this->input->post('numero_de_bobina'                  ,true);
                    $numero_de_bobina2                  =$this->input->post('numero_de_bobina2'                 ,true);
                    $numero_de_bobina3                  =$this->input->post('numero_de_bobina3'                 ,true);
                    $total_de_bobinas                   =$this->input->post('total_de_bobinas'                  ,true);
                    $quien_sabe_ubicacion_de_la_bobina  =$this->input->post('quien_sabe_ubicacion_de_la_bobina' ,true);
                    $menu_bobina_pliego                 =$this->input->post('menu_bobina_pliego'                ,true);

                    $existencia                                    =$this->input->post('existencia'                                   ,true);
                    $Proveedor_CompraTotal                         =$this->input->post('Proveedor_CompraTotal'                        ,true); 
                    $MaterialComprado_CompraTotal                  =$this->input->post('MaterialComprado_CompraTotal'                 ,true); 
                    $Ancho_CompraTotal                             =$this->input->post('Ancho_CompraTotal'                            ,true); 
                    $Kilos_CompraTotal                             =$this->input->post('Kilos_CompraTotal'                            ,true); 
                    $FechaEstimada_CompraTotal                     =$this->input->post('FechaEstimada_CompraTotal'                    ,true); 
                    $FechaRecepcion_CompraTotal                    =$this->input->post('FechaRecepcion_CompraTotal'                   ,true); 
                    $Opciones_StockParcial                         =$this->input->post('Opciones_StockParcial'                        ,true); 
                    $KilosEnStock_ComprarSaldo_StockParcial        =$this->input->post('KilosEnStock_ComprarSaldo_StockParcial'       ,true);
                    $Proveedor_ComprarSaldo_StockParcial           =$this->input->post('Proveedor_ComprarSaldo_StockParcial'          ,true); 
                    $MaterialComprado_ComprarSaldo_StockParcial    =$this->input->post('MaterialComprado_ComprarSaldo_StockParcial'   ,true); 
                    $Ancho_ComprarSaldo_StockParcial               =$this->input->post('Ancho_ComprarSaldo_StockParcial'              ,true); 
                    $Kilos_ComprarSaldo_StockParcial               =$this->input->post('Kilos_ComprarSaldo_StockParcial'              ,true); 
                    $FechaEstimada_ComprarSaldo_StockParcial       =$this->input->post('FechaEstimada_ComprarSaldo_StockParcial'      ,true); 
                    $FechaRecepcion_ComprarSaldo_StockParcial      =$this->input->post('FechaRecepcion_ComprarSaldo_StockParcial'     ,true); 
                    $Proveedor_ComprarParcial                      =$this->input->post('Proveedor_ComprarParcial'                     ,true); 
                    $MaterialComprado_ComprarParcial               =$this->input->post('MaterialComprado_ComprarParcial'              ,true); 
                    $Ancho_ComprarParcial                          =$this->input->post('Ancho_ComprarParcial'                         ,true); 
                    $Kilos_ComprarParcial                          =$this->input->post('Kilos_ComprarParcial'                         ,true); 
                    $FechaEstimada_ComprarParcial                  =$this->input->post('FechaEstimada_ComprarParcial'                 ,true); 
                    $FechaRecepcion_ComprarParcial                 =$this->input->post('FechaRecepcion_ComprarParcial'                ,true); 
                    $Opciones_ComprarParcial                       =$this->input->post('Opciones_ComprarParcial'                      ,true); 
                    $Proveedor_ComprarSaldo_ComprarParcial         =$this->input->post('Proveedor_ComprarSaldo_ComprarParcial'        ,true); 
                    $MaterialComprado_ComprarSaldo_ComprarParcial  =$this->input->post('MaterialComprado_ComprarSaldo_ComprarParcial' ,true); 
                    $Ancho_ComprarSaldo_ComprarParcial             =$this->input->post('Ancho_ComprarSaldo_ComprarParcial'            ,true); 
                    $Kilos_ComprarSaldo_ComprarParcial             =$this->input->post('Kilos_ComprarSaldo_ComprarParcial'            ,true); 
                    $FechaEstimada_ComprarSaldo_ComprarParcial     =$this->input->post('FechaEstimada_ComprarSaldo_ComprarParcial'    ,true); 
                    $FechaRecepcion_ComprarSaldo_ComprarParcial    =$this->input->post('FechaRecepcion_ComprarSaldo_ComprarParcial'   ,true);
                    $kilos_bobina_seleccionada2                    =$this->input->post('kilos_bobina_seleccionada2'                   ,true);
                    $kilos_bobina_seleccionada3                    =$this->input->post('kilos_bobina_seleccionada3'                   ,true); 
                    $total_kilos_ingresados                        =$this->input->post('total_kilos_ingresados'                       ,true);
                    $ancho_seleccionado_de_bobina2                 =$this->input->post('ancho_seleccionado_de_bobina2'                ,true);
                    $ancho_seleccionado_de_bobina3                 =$this->input->post('ancho_seleccionado_de_bobina3'                ,true);
                    $total_metros_ingresados                       =$this->input->post('total_metros_ingresados'                      ,true);
                    $hay_que_bobinar                              =$this->input->post('hay_que_bobinar'                              ,true);

                    if(sizeof($control_cartulina)==0)
                   {
                            $situacion='Pendiente';
                            $fecha_pendiente=date('Y-m-d H:i:s');
                            $fecha_liberada='0000-00-00';
                            $fecha_activa='0000-00-00';
                            $fecha_orden_cerrada='0000-00-00';
                   }else
                   {}
                     switch($this->input->post('estado',true))
                     {
                        case '1':
                            $situacion='Liberada';
                            $fecha_pendiente='0000-00-00';
                            $fecha_liberada=date('Y-m-d H:i:s');
                            $fecha_activa='0000-00-00';
                            $fecha_orden_cerrada='0000-00-00';
                            $input_restante='';
                        break;
                        case '0':
                            $situacion='Guardar';
                            $fecha_pendiente='0000-00-00';
                            $fecha_activa=date('Y-m-d H:i:s');
                            $fecha_orden_cerrada='0000-00-00';
                            $input_restante=$this->input->post('input_restante',true);
                            $fecha_liberada='0000-00-00';
                            $fecha_liberada_parcial_2 ='';
                            $fecha_liberada_parcial_3 ='';

                            $total_kilos_ingresados_parcial_2   ='';
                            $total_kilos_restantes_parcial_2    ='';
                            $total_metros_restantes_parcial_2   ='';

                            $total_kilos_ingresados_parcial_3   ='';
                            $total_kilos_restantes_parcial_3    ='';
                            $total_metros_restantes_parcial_3   ='';
                        break;
                        case '2':
                            $situacion='Activa';
                            $fecha_pendiente='0000-00-00';
                            $fecha_liberada='0000-00-00';
                            $fecha_activa=date('Y-m-d H:i:s');
                            $fecha_orden_cerrada='0000-00-00';
                        break;
                        case '3':
                            $situacion='Parcial';
                            $fecha_pendiente='0000-00-00';
                            $fecha_liberada=date('Y-m-d H:i:s');
                            $fecha_activa= '0000-00-00'; //date('Y-m-d H:i:s');
                            $fecha_orden_cerrada='0000-00-00';
                            $input_restante=$this->input->post('input_restante',true);

                            if ($this->input->post('fecha_liberada_parcial_1',true)==null || $this->input->post('fecha_liberada_parcial_1',true)=='0000-00-00 00:00:00') {
                                $fecha_liberada           =date('Y-m-d H:i:s');
                                $fecha_liberada_parcial_2 ='';
                                $fecha_liberada_parcial_3 ='';


                                $total_kilos_ingresados_parcial_1   =$this->input->post('total_kilos_ingresados',true);
                                $total_kilos_restantes_parcial_1    =$this->input->post('total_kilos_restantes',true);
                                $total_metros_restantes_parcial_1   =$this->input->post('total_metros_restantes',true);
                                
                                $total_kilos_ingresados_parcial_2   ='';
                                $total_kilos_restantes_parcial_2    ='';
                                $total_metros_restantes_parcial_2   ='';

                                $total_kilos_ingresados_parcial_3   ='';
                                $total_kilos_restantes_parcial_3    ='';
                                $total_metros_restantes_parcial_3   ='';

                            }elseif ($this->input->post('fecha_liberada_parcial_2',true)==null || $this->input->post('fecha_liberada_parcial_2',true)=='0000-00-00 00:00:00') {
                                $fecha_liberada           =$this->input->post('fecha_liberada_parcial_1',true);
                                $fecha_liberada_parcial_2 =date('Y-m-d H:i:s');
                                $fecha_liberada_parcial_3 ='';

                                $total_kilos_ingresados_parcial_1   =$this->input->post('total_kilos_ingresados_parcial_1',true);
                                $total_kilos_restantes_parcial_1    =$this->input->post('total_kilos_restantes_parcial_1',true);
                                $total_metros_restantes_parcial_1   =$this->input->post('total_metros_restantes_parcial_1',true);
                                
                                $total_kilos_ingresados_parcial_2   =$this->input->post('total_kilos_ingresados',true);
                                $total_kilos_restantes_parcial_2    =$this->input->post('total_kilos_restantes',true);
                                $total_metros_restantes_parcial_2   =$this->input->post('total_metros_restantes',true);

                                $total_kilos_ingresados_parcial_3   ='';
                                $total_kilos_restantes_parcial_3    ='';
                                $total_metros_restantes_parcial_3   ='';

                            }else{
                                $fecha_liberada           =$this->input->post('fecha_liberada_parcial_1',true);
                                $fecha_liberada_parcial_2 =$this->input->post('fecha_liberada_parcial_2',true);
                                $fecha_liberada_parcial_3 =date('Y-m-d H:i:s');

                                $total_kilos_ingresados_parcial_1   =$this->input->post('total_kilos_ingresados_parcial_1',true);
                                $total_kilos_restantes_parcial_1    =$this->input->post('total_kilos_restantes_parcial_1',true);
                                $total_metros_restantes_parcial_1   =$this->input->post('total_metros_restantes_parcial_1',true);
                                
                                $total_kilos_ingresados_parcial_2   =$this->input->post('total_kilos_ingresados_parcial_2',true);
                                $total_kilos_restantes_parcial_2    =$this->input->post('total_kilos_restantes_parcial_2',true);
                                $total_metros_restantes_parcial_2   =$this->input->post('total_metros_restantes_parcial_2',true);

                                $total_kilos_ingresados_parcial_3   =$this->input->post('total_kilos_ingresados',true);
                                $total_kilos_restantes_parcial_3    =$this->input->post('total_kilos_restantes' ,true);
                                $total_metros_restantes_parcial_3   =$this->input->post('total_metros_restantes',true);
                            }
                        break;
                        case '4':
                            $situacion='Reversar';
                            $fecha_pendiente='0000-00-00';
                            $fecha_liberada='0000-00-00';
                            $fecha_activa= '0000-00-00';
                            $fecha_orden_cerrada='0000-00-00';
                            $input_restante='';
                            $fecha_liberada           ='';
                            $fecha_liberada_parcial_2 ='';
                            $fecha_liberada_parcial_3 ='';

                            $numero_de_bobina='';
                            $numero_de_bobina2='';
                            $numero_de_bobina3='';
                            $total_de_bobinas='';
                            $quien_sabe_ubicacion_de_la_bobina='';

                            $total_kilos_ingresados_parcial_1   ='';
                            $total_kilos_restantes_parcial_1    ='';
                            $total_metros_restantes_parcial_1   ='';
                            
                            $total_kilos_ingresados_parcial_2   ='';
                            $total_kilos_restantes_parcial_2    ='';
                            $total_metros_restantes_parcial_2   ='';

                            $total_kilos_ingresados_parcial_3   ='';
                            $total_kilos_restantes_parcial_3    ='';
                            $total_metros_restantes_parcial_3   ='';
                            $total_kilos_ingresados             ='';
                            $ancho_seleccionado_de_bobina2      ='';
                            $ancho_seleccionado_de_bobina3      ='';
                            $total_metros_ingresados            ='';
                            $hay_que_bobinar                    ='';

                            $kilos_bobina_seleccionada2                    ='';
                            $kilos_bobina_seleccionada3                    ='';

                            $existencia                                    ='';
                            $Proveedor_CompraTotal                         ='';
                            $MaterialComprado_CompraTotal                  ='';
                            $Ancho_CompraTotal                             ='';
                            $Kilos_CompraTotal                             ='';
                            $FechaEstimada_CompraTotal                     ='';
                            $FechaRecepcion_CompraTotal                    ='';
                            $Opciones_StockParcial                         ='';
                            $Proveedor_ComprarSaldo_StockParcial           ='';
                            $KilosEnStock_ComprarSaldo_StockParcial        ='';
                            $MaterialComprado_ComprarSaldo_StockParcial    ='';
                            $Ancho_ComprarSaldo_StockParcial               ='';
                            $Kilos_ComprarSaldo_StockParcial               ='';
                            $FechaEstimada_ComprarSaldo_StockParcial       ='';
                            $FechaRecepcion_ComprarSaldo_StockParcial      ='';
                            $Proveedor_ComprarParcial                      ='';
                            $MaterialComprado_ComprarParcial               ='';
                            $Ancho_ComprarParcial                          ='';
                            $Kilos_ComprarParcial                          ='';
                            $FechaEstimada_ComprarParcial                  ='';
                            $FechaRecepcion_ComprarParcial                 ='';
                            $Opciones_ComprarParcial                       ='';
                            $Proveedor_ComprarSaldo_ComprarParcial         ='';
                            $MaterialComprado_ComprarSaldo_ComprarParcial  ='';
                            $Ancho_ComprarSaldo_ComprarParcial             ='';
                            $Kilos_ComprarSaldo_ComprarParcial             ='';
                            $FechaEstimada_ComprarSaldo_ComprarParcial     ='';
                            $FechaRecepcion_ComprarSaldo_ComprarParcial    ='';
                            $menu_bobina_pliego                            ='';
                        break;
                     }                    


                  // gramaje_seleccionado
  
                    if($this->input->post('gramaje',true) != $this->input->post('gramaje_seleccionado',true) or $ing->tamano_a_imprimir_1 != $this->input->post('ancho_seleccionado_de_bobina',true))
                    {
                            //$kilos1=$this->produccion_model->MermasParaProduccion($this->input->post('id',true),$this->input->post('gramaje_seleccionado',true),$this->input->post('ancho_seleccionado_de_bobina',true));
                            $gramajeSeleccionado = $this->input->post('gramaje_seleccionado',true);
                            $kilos11=$this->produccion_model->MermasParaProduccion($this->input->post('id',true),$this->input->post('gramaje_seleccionado',true),$this->input->post('ancho_seleccionado_de_bobina',true));
                            $kilos1 = str_replace('.', '', $kilos11);
                    }else{

                            $kilos1 = $this->input->post('total_kilos',true);
                            $gramajeSeleccionado = $this->input->post('gramaje',true);

                    }
                    $invert = explode("-",$this->input->post('fecha_estimada_recepcion',true));
                    $fecha_estimada_recepcion = $invert[2]."-".$invert[1]."-".$invert[0]; 
                     
                    $invert2 = explode("-",$this->input->post('fecha_recepcionada',true));
                    $fecha_recepcionada = $invert[2]."-".$invert[1]."-".$invert[0]; 

                    //Resetea los valores dependiendo del valor del select "existencia"
                    

                    if ($existencia == 'Hay stock total') {

                        $Proveedor_CompraTotal                         =''; 
                        $MaterialComprado_CompraTotal                  =''; 
                        $Ancho_CompraTotal                             =''; 
                        $Kilos_CompraTotal                             =''; 
                        $FechaEstimada_CompraTotal                     =''; 
                        $FechaRecepcion_CompraTotal                    =''; 

                        $Opciones_StockParcial                         =''; 
                        $KilosEnStock_ComprarSaldo_StockParcial        ='';
                        $Proveedor_ComprarSaldo_StockParcial           =''; 
                        $MaterialComprado_ComprarSaldo_StockParcial    =''; 
                        $Ancho_ComprarSaldo_StockParcial               =''; 
                        $Kilos_ComprarSaldo_StockParcial               =''; 
                        $FechaEstimada_ComprarSaldo_StockParcial       =''; 
                        $FechaRecepcion_ComprarSaldo_StockParcial      =''; 

                        $Proveedor_ComprarParcial                      =''; 
                        $MaterialComprado_ComprarParcial               =''; 
                        $Ancho_ComprarParcial                          =''; 
                        $Kilos_ComprarParcial                          =''; 
                        $FechaEstimada_ComprarParcial                  =''; 
                        $FechaRecepcion_ComprarParcial                 =''; 
                        $Opciones_ComprarParcial                       =''; 
                        $Proveedor_ComprarSaldo_ComprarParcial         =''; 
                        $MaterialComprado_ComprarSaldo_ComprarParcial  =''; 
                        $Ancho_ComprarSaldo_ComprarParcial             =''; 
                        $Kilos_ComprarSaldo_ComprarParcial             =''; 
                        $FechaEstimada_ComprarSaldo_ComprarParcial     =''; 
                        $FechaRecepcion_ComprarSaldo_ComprarParcial    =''; 

                    } elseif ($existencia == 'Comprar Total') {

                        $Opciones_StockParcial                         =''; 
                        $Proveedor_ComprarSaldo_StockParcial           =''; 
                        $KilosEnStock_ComprarSaldo_StockParcial        ='';
                        $MaterialComprado_ComprarSaldo_StockParcial    =''; 
                        $Ancho_ComprarSaldo_StockParcial               ='';
                        $Kilos_ComprarSaldo_StockParcial               ='';  
                        $FechaEstimada_ComprarSaldo_StockParcial       =''; 
                        $FechaRecepcion_ComprarSaldo_StockParcial      =''; 

                        $Proveedor_ComprarParcial                      =''; 
                        $MaterialComprado_ComprarParcial               =''; 
                        $Ancho_ComprarParcial                          =''; 
                        $Kilos_ComprarParcial                          =''; 
                        $FechaEstimada_ComprarParcial                  =''; 
                        $FechaRecepcion_ComprarParcial                 =''; 
                        $Opciones_ComprarParcial                       =''; 
                        $Proveedor_ComprarSaldo_ComprarParcial         =''; 
                        $MaterialComprado_ComprarSaldo_ComprarParcial  =''; 
                        $Ancho_ComprarSaldo_ComprarParcial             =''; 
                        $Kilos_ComprarSaldo_ComprarParcial             =''; 
                        $FechaEstimada_ComprarSaldo_ComprarParcial     =''; 
                        $FechaRecepcion_ComprarSaldo_ComprarParcial    ='';

                    } elseif ($existencia == 'Stock Parcial') {

                        $Proveedor_CompraTotal                         =''; 
                        $MaterialComprado_CompraTotal                  =''; 
                        $Ancho_CompraTotal                             ='';
                        $Kilos_CompraTotal                             =''; 
                        $FechaEstimada_CompraTotal                     =''; 
                        $FechaRecepcion_CompraTotal                    ='';

                        $Proveedor_ComprarParcial                      =''; 
                        $MaterialComprado_ComprarParcial               =''; 
                        $Ancho_ComprarParcial                          ='';
                        $Kilos_ComprarParcial                          ='';  
                        $FechaEstimada_ComprarParcial                  =''; 
                        $FechaRecepcion_ComprarParcial                 =''; 
                        $Opciones_ComprarParcial                       =''; 
                        $Proveedor_ComprarSaldo_ComprarParcial         =''; 
                        $MaterialComprado_ComprarSaldo_ComprarParcial  =''; 
                        $Ancho_ComprarSaldo_ComprarParcial             ='';
                        $Kilos_ComprarSaldo_ComprarParcial             ='';  
                        $FechaEstimada_ComprarSaldo_ComprarParcial     =''; 
                        $FechaRecepcion_ComprarSaldo_ComprarParcial    ='';

                    } elseif ($existencia == 'Comprar Parcial') {

                        $Proveedor_CompraTotal                         =''; 
                        $MaterialComprado_CompraTotal                  =''; 
                        $Ancho_CompraTotal                             =''; 
                        $Kilos_CompraTotal                             =''; 
                        $FechaEstimada_CompraTotal                     =''; 
                        $FechaRecepcion_CompraTotal                    =''; 

                        $Opciones_StockParcial                         =''; 
                        $Proveedor_ComprarSaldo_StockParcial           =''; 
                        $KilosEnStock_ComprarSaldo_StockParcial        ='';
                        $MaterialComprado_ComprarSaldo_StockParcial    =''; 
                        $Ancho_ComprarSaldo_StockParcial               =''; 
                        $Kilos_ComprarSaldo_StockParcial               =''; 
                        $FechaEstimada_ComprarSaldo_StockParcial       =''; 
                        $FechaRecepcion_ComprarSaldo_StockParcial      =''; 
                        
                    }

                    if ($Opciones_ComprarParcial=='Se produce parcial') {
                        $Proveedor_ComprarSaldo_ComprarParcial         =''; 
                        $MaterialComprado_ComprarSaldo_ComprarParcial  =''; 
                        $Ancho_ComprarSaldo_ComprarParcial             ='';
                        $Kilos_ComprarSaldo_ComprarParcial             ='';  
                        $FechaEstimada_ComprarSaldo_ComprarParcial     =''; 
                        $FechaRecepcion_ComprarSaldo_ComprarParcial    ='';
                    }

                    $data=array
                    (
                        "id_usuario"=>$this->session->userdata('id'),
                        "tipo"=>$this->input->post('tipo',true),
                        "id_nodo"=>$this->input->post('id',true),
                        "id_cliente"=>$this->input->post('id_cliente',true),
                        "orden_de_trabajo"=>$this->input->post('id',true),
                        "descripcion_del_trabajo"=>$this->input->post('descripcion_del_trabajo_referencia',true),
                        "dimensionar_a_ancho"=>$this->input->post('dimensionar_a_ancho',true),
                        "dimensionar_a_largo"=>$this->input->post('dimensionar_a_largo',true),
                        "ancho_de_bobina"=>$this->input->post('ancho_de_bobina',true),
                        "gramaje"=>$gramajeSeleccionado,
                        "total_pliegos"=>$this->input->post('total_pliegos',true),
                        "total_kilos"=>$this->input->post('total_kilos',true),//$kilos1,
                        "unidades_por_pliego"=>$this->input->post('unidades_por_pliego',true),
                        "descripcion_de_la_tapa"=>$this->input->post('descripcion_de_la_tapa',true),
                        "descripcion_de_la_tapa2"=>$this->input->post('descripcion_de_la_tapa2',true),
                        "numero_de_bobina"=>$numero_de_bobina,
                        "numero_de_bobina2"=>$numero_de_bobina2,
                        "numero_de_bobina3"=>$numero_de_bobina3,
                        "total_de_bobinas"=>$total_de_bobinas,
                        "quien_sabe_ubicacion_de_la_bobina"=>$quien_sabe_ubicacion_de_la_bobina,
                        "estado"=>$this->input->post('estado',true),
                        "quien"=>$this->session->userdata('id'),
                        "cuando"=>date("Y-m-d"),
                        "glosa"=>$this->input->post('glosa',true),
                        "hay_en_stock"=>$this->input->post('hay_en_stock',true),
                        "preguntar_stock_a"=>$this->input->post('preguntar_stock_a',true),
                        "stock_opciones"=>$this->input->post('stock_opciones',true),
                        "proveedor"=>$this->input->post('proveedor',true),
                        "fecha_estimada_recepcion"=>$fecha_estimada_recepcion,
                        "gramaje_seleccionado"=>$this->input->post('gramaje_seleccionado',true),
                        "ancho_seleccionado_de_bobina"=>$this->input->post('ancho_seleccionado_de_bobina',true),
                        "cantidad_total_o_parcial"=>$this->input->post('cantidad_total_o_parcial',true),
                        "situacion"=>$situacion,
                        "fecha_pendiente"=>$fecha_pendiente,
                        "fecha_liberada"=>$fecha_liberada,
                        "fecha_activa"=>$fecha_activa,
                        "fecha_orden_cerrada"=>$fecha_orden_cerrada,
                        "hay_que_bobinar"=>$hay_que_bobinar,
                        "total_kilos2"=>$this->input->post('total_kilos2',true),
                        "bobinar_ancho_cartulina1"=>$this->input->post('bobinar_ancho_cartulina1',true),                        
                        "bobinar_ancho_cartulina2"=>$this->input->post('bobinar_ancho_cartulina2',true),                        
                        "bobinar_ancho_cartulina3"=>$this->input->post('bobinar_ancho_cartulina3',true),
                        "kilos_bobina_seleccionada"=>$this->input->post('kilos_bobina_seleccionada',true),
                        "total_metros"=>$this->input->post('total_metros',true),
                        "kilos_orden_a_bobinar"=>$this->input->post('kilos_orden_a_bobinar',true),  
                        "segunda_bobina_adicional_ancho"=>$this->input->post('segunda_bobina_adicional_ancho',true), 
                        "segunda_bobina_adicional_kilos"=>$this->input->post('segunda_bobina_adicional_kilos',true), 
                        "tercera_bobina_adicional_ancho"=>$this->input->post('tercera_bobina_adicional_ancho',true), 
                        "tercera_bobina_adicional_kilos"=>$this->input->post('tercera_bobina_adicional_kilos',true), 
                        "cuarta_bobina_adicional_ancho"=>$this->input->post('cuarta_bobina_adicional_ancho',true), 
                        "cuarta_bobina_adicional_kilos"=>$this->input->post('cuarta_bobina_adicional_kilos',true), 
                        "quien_compra"=>$this->input->post('quien_compra',true), 
                        "recepcionados"=>$this->input->post('recepcionados',true), 
                        "fecha_recepcionada"=>$fecha_recepcionada, 
                        "segunda_bobinar"=>$this->input->post('segunda_bobinar',true), 
                        "tercera_bobinar"=>$this->input->post('tercera_bobinar',true), 
                        "cuarta_bobinar"=>$this->input->post('cuarta_bobinar',true), 

                        //Raul Escalona
                        "existencia"                                    =>$existencia,
                        "Proveedor_CompraTotal"                         =>$Proveedor_CompraTotal,
                        "MaterialComprado_CompraTotal"                  =>$MaterialComprado_CompraTotal,
                        "Ancho_CompraTotal"                             =>$Ancho_CompraTotal,
                        "Kilos_CompraTotal"                             =>$Kilos_CompraTotal,
                        "FechaEstimada_CompraTotal"                     =>$FechaEstimada_CompraTotal,
                        "FechaRecepcion_CompraTotal"                    =>$FechaRecepcion_CompraTotal,
                        "Opciones_StockParcial"                         =>$Opciones_StockParcial,
                        "KilosEnStock_ComprarSaldo_StockParcial"        =>$KilosEnStock_ComprarSaldo_StockParcial,
                        "Proveedor_ComprarSaldo_StockParcial"           =>$Proveedor_ComprarSaldo_StockParcial,
                        "MaterialComprado_ComprarSaldo_StockParcial"    =>$MaterialComprado_ComprarSaldo_StockParcial,
                        "Ancho_ComprarSaldo_StockParcial"               =>$Ancho_ComprarSaldo_StockParcial,
                        "Kilos_ComprarSaldo_StockParcial"               =>$Kilos_ComprarSaldo_StockParcial,
                        "FechaEstimada_ComprarSaldo_StockParcial"       =>$FechaEstimada_ComprarSaldo_StockParcial,
                        "FechaRecepcion_ComprarSaldo_StockParcial"      =>$FechaRecepcion_ComprarSaldo_StockParcial,
                        "Proveedor_ComprarParcial"                      =>$Proveedor_ComprarParcial,
                        "MaterialComprado_ComprarParcial"               =>$MaterialComprado_ComprarParcial,
                        "Ancho_ComprarParcial"                          =>$Ancho_ComprarParcial,
                        "Kilos_ComprarParcial"                          =>$Kilos_ComprarParcial,
                        "FechaEstimada_ComprarParcial"                  =>$FechaEstimada_ComprarParcial,
                        "FechaRecepcion_ComprarParcial"                 =>$FechaRecepcion_ComprarParcial,
                        "Opciones_ComprarParcial"                       =>$Opciones_ComprarParcial,
                        "Proveedor_ComprarSaldo_ComprarParcial"         =>$Proveedor_ComprarSaldo_ComprarParcial,
                        "MaterialComprado_ComprarSaldo_ComprarParcial"  =>$MaterialComprado_ComprarSaldo_ComprarParcial, 
                        "Ancho_ComprarSaldo_ComprarParcial"             =>$Ancho_ComprarSaldo_ComprarParcial,
                        "Kilos_ComprarSaldo_ComprarParcial"             =>$Kilos_ComprarSaldo_ComprarParcial,
                        "FechaEstimada_ComprarSaldo_ComprarParcial"     =>$FechaEstimada_ComprarSaldo_ComprarParcial,
                        "FechaRecepcion_ComprarSaldo_ComprarParcial"    =>$FechaRecepcion_ComprarSaldo_ComprarParcial,
                        
                        "gramaje_seleccionado2"                         =>$this->input->post('gramaje_seleccionado2'                        ,true),
                        "ancho_seleccionado_de_bobina2"                 =>$ancho_seleccionado_de_bobina2,
                        "kilos_bobina_seleccionada2"                    =>$kilos_bobina_seleccionada2,
                        "gramaje_seleccionado3"                         =>$this->input->post('gramaje_seleccionado3'                        ,true),
                        "ancho_seleccionado_de_bobina3"                 =>$ancho_seleccionado_de_bobina3,
                        "descripcion_de_la_tapa3"                       =>$this->input->post('descripcion_de_la_tapa3'                      ,true),
                        "kilos_bobina_seleccionada3"                    =>$kilos_bobina_seleccionada3,
                        "input_restante"                                =>$input_restante,
                        "total_kilos_ingresados"                        =>$total_kilos_ingresados,
                        //"total_kilos_restantes"                         =>$this->input->post('total_kilos_restantes'                      ,true),
                        "fecha_liberada"                                =>$fecha_liberada,
                        "fecha_liberada_parcial_2"                      =>$fecha_liberada_parcial_2,
                        "fecha_liberada_parcial_3"                      =>$fecha_liberada_parcial_3,

                        "total_kilos_ingresados"                        =>$total_kilos_ingresados_parcial_1,
                        "total_kilos_restantes "                        =>$total_kilos_restantes_parcial_1,
                        "total_metros_restantes"                        =>$total_metros_restantes_parcial_1,
                        "total_kilos_ingresados_parcial_2"              =>$total_kilos_ingresados_parcial_2,
                        "total_kilos_restantes_parcial_2 "              =>$total_kilos_restantes_parcial_2,
                        "total_metros_restantes_parcial_2"              =>$total_metros_restantes_parcial_2,
                        "total_kilos_ingresados_parcial_3"              =>$total_kilos_ingresados_parcial_3,
                        "total_kilos_restantes_parcial_3 "              =>$total_kilos_restantes_parcial_3,
                        "total_metros_restantes_parcial_3"              =>$total_metros_restantes_parcial_3,
                        "menu_bobina_pliego"                            =>$menu_bobina_pliego,
                        "total_metros_ingresados"                       =>$total_metros_ingresados
                        );
                    
                    $bobina = array(
                        "id_nodo"=>$this->input->post('id',true),
                        //"descripcion"=>$this->input->post('descripcion_de_la_tapa2',true),
                        "gramaje"=>$this->input->post('gramaje_seleccionado2',true),
                        "kilos"=>$this->input->post('kilos_bobina_seleccionada2',true),
                        "ancho"=>$this->input->post('ancho_seleccionado_de_bobina2',true),
                    );
                    //exit(print_r($bobina));exit();
                    if(sizeof($bobinas)==0)
                    {
                        $this->db->insert("bobinas",$bobina);
                    }else{
                        $this->db->update('bobinas', $bobina, array('id_nodo'=>$this->input->post('id',true)));
                    } 
                    
                    if(sizeof($control_cartulina)==0)
                    {
                        $this->db->insert("produccion_control_cartulina",$data);   
                    }else
                    {
                        $this->db->update('produccion_control_cartulina', $data, array('tipo' => $this->input->post('tipo',true),'id_nodo'=>$this->input->post('id',true)));
                    }    
                    $kilosCartulinaParcial=$this->produccion_model->MermasParaProduccion($this->input->post('id',true),$this->input->post('gramaje_seleccionado',true),$this->input->post('ancho_seleccionado_de_bobina',true));
                    
                    $invert = explode("-",$this->input->post('fecha_estimada_recepcion',true));
                    $fecha_estimada_recepcion = $invert[2]."-".$invert[1]."-".$invert[0]; 
                    $invert2 = explode("-",$this->input->post('fecha_recepcionada',true));
                    $fecha_recepcionada = $invert[2]."-".$invert[1]."-".$invert[0]; 
                    
                    $data2=array
                    (              
                        "id_usuario"=>$this->session->userdata('id'),
                        "tipo"=>$this->input->post('tipo',true),
                        "id_nodo"=>$this->input->post('id',true),
                        "id_cliente"=>$this->input->post('id_cliente',true),
                        "orden_de_trabajo"=>$this->input->post('id',true),
                        "descripcion_del_trabajo"=>$this->input->post('descripcion_del_trabajo_referencia',true),
                        "dimensionar_a_ancho"=>$this->input->post('dimensionar_a_ancho',true),
                        "dimensionar_a_largo"=>$this->input->post('dimensionar_a_largo',true),
                        "ancho_de_bobina"=>$this->input->post('ancho_de_bobina',true),
                        "gramaje"=>$gramajeSeleccionado,
                        "total_pliegos"=>$this->input->post('total_pliegos',true),
                        "total_kilos"=>$kilos1,
                        "unidades_por_pliego"=>$this->input->post('unidades_por_pliego',true),
                        "descripcion_de_la_tapa"=>$this->input->post('descripcion_de_la_tapa',true),
                        //"descripcion_de_la_tapa2"=>$this->input->post('descripcion_de_la_tapa2',true),
                        "numero_de_bobina"=>$this->input->post('numero_de_bobina',true),
                        //"numero_de_bobina2"=>$this->input->post('numero_de_bobina2',true),
                        "total_de_bobinas"=>$this->input->post('total_de_bobinas',true),
                        "quien_sabe_ubicacion_de_la_bobina"=>$this->input->post('quien_sabe_ubicacion_de_la_bobina',true),
                        "estado"=>$this->input->post('estado',true),
                        "quien"=>$this->session->userdata('id'),
                        "cuando"=>date("Y-m-d"),
                        "glosa"=>$this->input->post('glosa',true),
                        "hay_en_stock"=>$this->input->post('hay_en_stock',true),
                        "preguntar_stock_a"=>$this->input->post('preguntar_stock_a',true),
                        "stock_opciones"=>$this->input->post('stock_opciones',true),
                        "proveedor"=>$this->input->post('proveedor',true),
                        "fecha_estimada_recepcion"=>$fecha_estimada_recepcion,
                        "gramaje_seleccionado"=>$this->input->post('gramaje_seleccionado',true),
                        "ancho_seleccionado_de_bobina"=>$this->input->post('ancho_seleccionado_de_bobina',true),
                        "cantidad_total_o_parcial"=>$this->input->post('cantidad_total_o_parcial',true),
                        "situacion"=>$situacion,
                        "fecha_pendiente"=>$fecha_pendiente,
                        "fecha_liberada"=>$fecha_liberada,
                        "fecha_activa"=>$fecha_activa,
                        "fecha_orden_cerrada"=>$fecha_orden_cerrada,
                        "hay_que_bobinar"=>$this->input->post('hay_que_bobinar',true),               
                        "total_kilos2"=>$this->input->post('total_kilos2',true),     
                        //"bobinar_ancho_cartulina1"=>$this->input->post('bobinar_ancho_cartulina1',true),                        
                        //"bobinar_ancho_cartulina2"=>$this->input->post('bobinar_ancho_cartulina2',true),                        
                        //"bobinar_ancho_cartulina3"=>$this->input->post('bobinar_ancho_cartulina3',true),      
                        //"kilos_bobina_seleccionada"=>$this->input->post('kilos_bobina_seleccionada',true),
                        //"total_metros"=>$this->input->post('total_metros',true), 
                        //"kilos_bobina_seleccionada"=>$this->input->post('kilos_bobina_seleccionada',true),                         
                        //"quien_compra"=>$this->input->post('quien_compra',true),
                        //"recepcionados"=>$this->input->post('recepcionados',true), 
                        //"fecha_recepcionada"=>$fecha_recepcionada,
                        //"segunda_bobinar"=>$this->input->post('segunda_bobinar',true), 
                        //"tercera_bobinar"=>$this->input->post('tercera_bobinar',true), 
                        //"cuarta_bobinar"=>$this->input->post('cuarta_bobinar',true), 
                    );
                    
                    $bobina = array(
                        "id_nodo"=>$this->input->post('id',true),
                        "descripcion"=>$this->input->post('descripcion_de_la_tapa2',true),
                        "gramaje"=>$this->input->post('gramaje_seleccionado2',true),
                        "kilos"=>$this->input->post('kilos_bobina_seleccionada2',true),
                        "ancho"=>$this->input->post('ancho_seleccionado_de_bobina2',true),
                    );
                    
                    
                    //exit(print_r($bobina));exit();
//                    exit(print_r($data));					
					//Parcial 
                                        if($this->input->post('estado',true) == '3')
                                        {
                                            $this->db->insert("produccion_control_cartulina_parcial",$data2);
                                        }
					//Parcial Fin
					//Liberar + Total
					$hayparcial=$this->produccion_model->getParcialControlCartulina($this->input->post('id',true));
					if($this->input->post('total_o_parcial',true) == 'Total' and $hayparcial->sum > 0)
					{
							//$hayparcial=$this->produccion_model->getParcialControlCartulina($this->input->post('id',true));
							$pendiente = $this->input->post('total_kilos',true) - $hayparcial->sum;
							$data1=array
							(								
                                                            "estado"=>1,
                                                            "situacion"=>'Liberada',
                                                            "fecha_liberada"=>date('Y-m-d H:i:s'),	
                                                            "fecha_pendiente"=>'0000-00-00',
                                                            "fecha_activa"=>'0000-00-00',
                                                            "fecha_orden_cerrada"=>'0000-00-00',	
							);
							
						$this->db->update('produccion_control_cartulina', $data1, array('tipo' => $this->input->post('tipo',true),'id_nodo'=>$this->input->post('id',true)));
						$this->db->update('bobinas', $bobinas, array('id_nodo'=>$this->input->post('id',true)));
						/*$data3=array
							(								
								    "id_usuario"=>$this->session->userdata('id'),
									"tipo"=>$this->input->post('tipo',true),
									"id_nodo"=>$this->input->post('id',true),
									"id_cliente"=>$this->input->post('id_cliente',true),
									"orden_de_trabajo"=>$this->input->post('id',true),
									"descripcion_del_trabajo"=>$this->input->post('descripcion_del_trabajo',true),
									"dimensionar_a_ancho"=>$this->input->post('dimensionar_a_ancho',true),
									"dimensionar_a_largo"=>$this->input->post('dimensionar_a_largo',true),
									"ancho_de_bobina"=>$this->input->post('ancho_de_bobina',true),
									"gramaje"=>$gramajeSeleccionado,
									"total_pliegos"=>$this->input->post('total_pliegos',true),
									"total_kilos"=>$this->input->post('total_kilos',true),
									"unidades_por_pliego"=>$this->input->post('unidades_por_pliego',true),
									"descripcion_de_la_tapa"=>$this->input->post('descripcion_de_la_tapa',true),
									"numero_de_bobina"=>$this->input->post('numero_de_bobina',true),
									"total_de_bobinas"=>$this->input->post('total_de_bobinas',true),
									"quien_sabe_ubicacion_de_la_bobina"=>$this->input->post('quien_sabe_ubicacion_de_la_bobina',true),
									"estado"=>3,
									"quien"=>$this->session->userdata('id'),
									"cuando"=>date("Y-m-d"),
									"glosa"=>$this->input->post('glosa',true),
									"hay_en_stock"=>$this->input->post('hay_en_stock',true),
									"preguntar_stock_a"=>$this->input->post('preguntar_stock_a',true),
									"stock_opciones"=>$this->input->post('stock_opciones',true),
									"proveedor"=>$this->input->post('proveedor',true),
									"fecha_estimada_recepcion"=>$this->input->post('fecha_estimada_recepcion',true),
									"gramaje_seleccionado"=>$this->input->post('gramaje_seleccionado',true),
									"ancho_seleccionado_de_bobina"=>$this->input->post('ancho_seleccionado_de_bobina',true),
									"cantidad_total_o_parcial"=>$this->input->post('cantidad_total_o_parcial',true),
									"situacion"=>'Parcial',
									"fecha_pendiente"=>$fecha_pendiente,
									"fecha_liberada"=>$fecha_liberada,
									"fecha_activa"=>$fecha_activa,
									"fecha_orden_cerrada"=>$fecha_orden_cerrada,
									"hay_que_bobinar"=>$this->input->post('hay_que_bobinar',true),               
									"total_kilos2"=>$pendiente,  
							);
						*/
					      // $this->db->insert("produccion_control_cartulina_parcial",$data3);
						   
						   
                                                $data4=array
                                                     (								
                                                        "estado"=>1,
                                                        "situacion"=>'Liberada',
                                                        "fecha_liberada"=>date('Y-m-d H:i:s'),	
                                                        "fecha_pendiente"=>'0000-00-00',
                                                        "fecha_activa"=>'0000-00-00',
                                                        "fecha_orden_cerrada"=>'0000-00-00',
                                                     );
						$this->db->update('produccion_control_cartulina_parcial', $data4, array('tipo' => $this->input->post('tipo',true),'id_nodo'=>$this->input->post('id',true)));
					
					}					
					//Liberra Total fin
					
					
                    switch($tipo)
                    {
                        case '1':
                            $this->session->set_flashdata('ControllerMessage', 'Se ha guardado el registro exitosamente.');					            
                            redirect(base_url().'produccion/cotizaciones/'.$this->input->post('pagina',true),  301);
                        break;
                         case '2':
                            $this->session->set_flashdata('ControllerMessage', 'Se ha guardado el registro exitosamente.');					            
                            redirect(base_url().'produccion/fast/'.$this->input->post('pagina',true),  301);
                        break;
                    }   
                }
            }
            $this->layout->css
            (
                array
                (
                    base_url()."public/backend/css/calendario.css",
                    base_url()."public/backend/fancybox/jquery.fancybox.css",
                    base_url()."public/frontend/css/prism.css",
                    base_url()."public/frontend/css/chosen.css",
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
                    base_url()."public/backend/js/bootstrap.file-input.js",                    
                    base_url()."public/backend/fancybox/jquery.fancybox.js",
                    
                   
                )
            );            
            $usuarios=$this->usuarios_model->getUsuarios();
            $this->layout->view("control_cartulina",compact('usuarios','datos','tipo','pagina','id','control_cartulina','ing','fotomecanica','hoja','fotomecanica2','orden','ordenDeCompra','tapa','monda','mliner','materialidad_1','materialidad_2','materialidad_3','bobinas')); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
        
	}

    /**
     * Bobinado cartulina
     * */
	 public function bobinado_cartulina($tipo=null,$id=null,$pagina=null)
	{
        if($this->session->userdata('id'))
        {
          
            if(!$tipo or !$id){show_404();}
           switch($tipo)
                    {
                        case '1':
                            $datos=$this->cotizaciones_model->getCotizacionPorId($id);
                        break;
                         case '2':
                            $datos=$this->fast_track_model->getFastTrackPorId($id);
                        break;
                    }      
			if(sizeof($datos)==0){show_404();}
            $control=$this->produccion_model->getBobinadoCartulinaPorTipo($tipo,$id);
            $orden=$this->orden_model->getOrdenesPorCotizacion($id);
	    $fotomecanica=$this->produccion_model->getFotomecanicaPorTipo($tipo,$id);
            $fotomecanica2=$this->cotizaciones_model->getCotizacionFotomecanicaPorIdCotizacion($id);
            $ing=$this->cotizaciones_model->getCotizacionIngenieriaPorIdCotizacion($id);
            $control_cartulina=$this->produccion_model->getControlCartulinaPorTipo($tipo,$id);
//            print_r($control_cartulina);
            $hoja=$this->cotizaciones_model->getHojaDeCostosPorIdCotizacion($id);
            if($this->input->post())
            {
                if($this->form_validation->run('produccion_bobinado'))
                {
                        if(sizeof($control_cartulina)==0)
                       {
                                $situacion='Activa';
                                $fecha_pendiente='0000-00-00';
                                $fecha_liberada='0000-00-00';
                                $fecha_activa=date('Y-m-d H:i:s');
                                $fecha_orden_cerrada='0000-00-00';
                       }else
                       {}
                           switch($this->input->post('estado',true))
                         {
                            case '1':
                                $situacion='Liberada';
                                $fecha_pendiente='0000-00-00';
                                $fecha_liberada=date('Y-m-d H:i:s');
                                $fecha_activa='0000-00-00';
                                $fecha_orden_cerrada='0000-00-00';
                            break;
                            case '0':
                                $situacion='Guardar';
                                $fecha_pendiente='0000-00-00';
                                $fecha_liberada='0000-00-00';
                                $fecha_activa=date('Y-m-d H:i:s');
                                $fecha_orden_cerrada='0000-00-00';
                            break;
                            case '2':
                                $situacion='Rechazado';
                                $fecha_pendiente='0000-00-00';
                                $fecha_liberada='0000-00-00';
                                $fecha_activa=date('Y-m-d H:i:s');
                                $fecha_orden_cerrada='0000-00-00';
                            break;
							   case '3':
                                $situacion='Parcial';
                                $fecha_pendiente='0000-00-00';
                                $fecha_liberada='0000-00-00';
                                $fecha_activa=date('Y-m-d H:i:s');
                                $fecha_orden_cerrada='0000-00-00';
                            break;
                         }
                       
					   $hayparcial=$this->produccion_model->getParcialControlCartulina($id);
					   if(sizeof($hayparcial->sum)==0)
						{
								$totalKilos = $this->input->post("total_kilos_a_bobinar",true);
						}
						else
						{
								$totalKilos = $hayparcial->sum;
						}
						
						
						/*
						  if($this->input->post('gramaje',true) != $this->input->post('gramaje_seleccionado',true) or $ing->tamano_a_imprimir_1 != $this->input->post('ancho_seleccionado_de_bobina',true))
				  {
					  //$kilos1=$this->produccion_model->MermasParaProduccion($this->input->post('id',true),$this->input->post('gramaje_seleccionado',true),$this->input->post('ancho_seleccionado_de_bobina',true));
					  $gramajeSeleccionado = $this->input->post('gramaje_seleccionado',true);
					  $kilos11=$this->produccion_model->MermasParaProduccion($this->input->post('id',true),$this->input->post('gramaje_seleccionado',true),$this->input->post('ancho_seleccionado_de_bobina',true));
					  $kilos1 = str_replace('.', '', $kilos11);
				  }else{
					  
					  $kilos1 = $this->input->post('total_kilos',true);
					  $gramajeSeleccionado = $this->input->post('gramaje',true);
					  
				  }
				  */
					   
					   
                    $data=array
                    (
                        "id_usuario"=>$this->session->userdata('id'),
                        "tipo"=>$this->input->post('tipo',true),
                        "id_nodo"=>$this->input->post('id',true),
                        "id_cliente"=>$this->input->post('id_cliente',true),
                        "orden_de_trabajo"=>$this->input->post('id',true),
                        "descripcion_del_trabajo"=>$this->input->post('descripcion_del_trabajo',true),
                        "descripcion_cartulina"=>$this->input->post('descripcion_cartulina',true),
                        "datos_tecnicos"=>$this->input->post('datos_tecnicos',true),
                        "ancho_seleccionado_cartulina"=>$this->input->post('ancho_seleccionado_cartulina',true),
                        
                        "ancho_a_bobinar"=>$this->input->post('ancho_a_bobinar',true),
                        "medida_final_pliego_a_cortar"=>$this->input->post("medida_final_pliego_a_cortar",true),
                        "gramaje_seleccionado"=>$this->input->post("gramaje_seleccionado",true),
                        "total_pliegos_para_la_orden"=>$this->input->post("total_pliegos_para_la_orden",true),
                        "total_kilos_a_bobinar" => $totalKilos,
                        "total_bobinas"=>$this->input->post("total_bobinas",true),
                        "total_o_parcial"=>$this->input->post("total_o_parcial",true),
                        //"total_kilos"=>$this->input->post("total_kilos",true),
                        "operador"=>$this->input->post('operador',true),
                        "ayudante"=>$this->input->post('ayudante',true),
                        "estado"=>$this->input->post('estado',true),
                        "quien"=>$this->session->userdata('id'),
                        "cuando"=>date("Y-m-d"),
                        "glosa"=>$this->input->post('glosa',true),
                        "situacion"=>$situacion,
                        "fecha_pendiente"=>$fecha_pendiente,
                        "fecha_liberada"=>$fecha_liberada,
                        "fecha_activa"=>$fecha_activa,
                        "fecha_orden_cerrada"=>$fecha_orden_cerrada,
                        "total_kilos"=>$this->input->post('total_kilos',true),						
                    );
                    if(sizeof($control)==0)
                    {
                        $this->db->insert("produccion_bobinado_cartunila",$data);
                        
                    }else
                    {
                        $this->db->update('produccion_bobinado_cartunila', $data, array('tipo' => $this->input->post('tipo',true),'id_nodo'=>$this->input->post('id',true)));
                       
                    }    
					
					
					
					//Parcial				
					
					$data2=array
                    (              
                        "id_usuario"=>$this->session->userdata('id'),
                        "tipo"=>$this->input->post('tipo',true),
                        "id_nodo"=>$this->input->post('id',true),
                        "id_cliente"=>$this->input->post('id_cliente',true),
                        "orden_de_trabajo"=>$this->input->post('id',true),
                        "descripcion_del_trabajo"=>$this->input->post('descripcion_del_trabajo',true),
                        "descripcion_cartulina"=>$this->input->post('descripcion_cartulina',true),
                        "datos_tecnicos"=>$this->input->post('datos_tecnicos',true),
                        "ancho_seleccionado_cartulina"=>$this->input->post('ancho_seleccionado_cartulina',true),
                        
                        "ancho_a_bobinar"=>$this->input->post('ancho_a_bobinar',true),
                        "medida_final_pliego_a_cortar"=>$this->input->post("medida_final_pliego_a_cortar",true),
                        "gramaje_seleccionado"=>$this->input->post("gramaje_seleccionado",true),
                        "total_pliegos_para_la_orden"=>$this->input->post("total_pliegos_para_la_orden",true),
                        "total_kilos_a_bobinar"=>$totalKilos,
                        "total_bobinas"=>$this->input->post("total_bobinas",true),
                        "total_o_parcial"=>$this->input->post("total_o_parcial",true),
						//"total_kilos"=>$this->input->post("total_kilos",true),
                        "operador"=>$this->input->post('operador',true),
                        "ayudante"=>$this->input->post('ayudante',true),
                        "estado"=>$this->input->post('estado',true),
                        "quien"=>$this->session->userdata('id'),
                        "cuando"=>date("Y-m-d"),
                        "glosa"=>$this->input->post('glosa',true),
                        "situacion"=>$situacion,
                        "fecha_pendiente"=>$fecha_pendiente,
                        "fecha_liberada"=>$fecha_liberada,
                        "fecha_activa"=>$fecha_activa,
                        "fecha_orden_cerrada"=>$fecha_orden_cerrada,         
						"total_kilos"=>$this->input->post('total_kilos',true),						
                    );
					
						 if($this->input->post('estado',true) == '3')
						 {
								$this->db->insert("produccion_bobinado_cartunila_parcial",$data2);
						
						 }
					//Parcial Fin

					
						//Liberar + Total
					
					$hayparcial2=$this->produccion_model->getParcialBobinadoCartulinaSuma($this->input->post('id',true));
					
					if($this->input->post('total_o_parcial',true) == 'Total' and $hayparcial2->sum > 0)
					{		
							$data1=array
							(								
								"estado"=>1,
								"situacion"=>'Liberada',
						    	"fecha_liberada"=>date('Y-m-d H:i:s'),	
								"fecha_pendiente"=>'0000-00-00',
								"fecha_activa"=>'0000-00-00',
								"fecha_orden_cerrada"=>'0000-00-00',
							);
							
		$this->db->update('produccion_bobinado_cartunila', $data1, array('tipo' => $this->input->post('tipo',true),'id_nodo'=>$this->input->post('id',true)));
 
						   $data4=array
							(								
								"estado"=>1,
								"situacion"=>'Liberada',
								"fecha_liberada"=>date('Y-m-d H:i:s'),	
								"fecha_pendiente"=>'0000-00-00',
								"fecha_activa"=>'0000-00-00',
								"fecha_orden_cerrada"=>'0000-00-00',
							);
							
	 $this->db->update('produccion_bobinado_cartunila_parcial', $data4, array('tipo' => $this->input->post('tipo',true),'id_nodo'=>$this->input->post('id',true)));
					
					}					
					//Liberra Total fin
					
					
					
					
                    switch($tipo)
                    {
                        case '1':
                            $this->session->set_flashdata('ControllerMessage', 'Se ha guardado el registro exitosamente.');					            redirect(base_url().'produccion/cotizaciones/'.$this->input->post('pagina',true),  301);
                        break;
                         case '2':
                            $this->session->set_flashdata('ControllerMessage', 'Se ha guardado el registro exitosamente.');					            redirect(base_url().'produccion/fast/'.$this->input->post('pagina',true),  301);
                        break;
                    }   
                }
            }
//            print_r($control_cartulina);
            $usuarios2=$this->usuarios_model->getUsuariosPorTipo(8);
            $usuarios=$this->usuarios_model->getUsuariosPorTipo(9);
            $this->layout->view("bobinado_cartulina",compact('usuarios','datos','tipo','pagina','id','control','ing','usuarios2','orden','fotomecanica','fotomecanica2','control_cartulina','hoja')); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
        
	}
	
	
    /**
     * Bobinado onda
     * */
	 public function bobinado_onda($tipo=null,$id=null,$pagina=null)
	{
        if($this->session->userdata('id'))
        {
          
            if(!$tipo or !$id){show_404();}
           switch($tipo)
                    {
                        case '1':
                            $datos=$this->cotizaciones_model->getCotizacionPorId($id);
                        break;
                         case '2':
                            $datos=$this->fast_track_model->getFastTrackPorId($id);
                        break;
                    }      
            if(sizeof($datos)==0){show_404();}
            $control=$this->produccion_model->getBobinadoCartulinaOndaPorTipo($tipo,$id);
            $ordenDeCompra=$this->cotizaciones_model->getOrdenDeCompraPorCotizacion($id);
            $orden=$this->orden_model->getOrdenesPorCotizacion($id);
            $fotomecanica=$this->produccion_model->getFotomecanicaPorTipo($tipo,$id);
            $fotomecanica2=$this->cotizaciones_model->getCotizacionFotomecanicaPorIdCotizacion($id);
            $ing=$this->cotizaciones_model->getCotizacionIngenieriaPorIdCotizacion($id);
            $control_cartulina=$this->produccion_model->getControlCartulinaPorTipo($tipo,$id);
            $control_onda=$this->produccion_model->getControlControlOndaPorTipo($tipo,$id);
            $hoja=$this->cotizaciones_model->getHojaDeCostosPorIdCotizacion($id);
            if($this->input->post())
            {
                if($this->form_validation->run('produccion_bobinado'))
                {
                         if(sizeof($control_onda)==0)
                       {
                                $situacion='Pendiente';
                                $fecha_pendiente=date('Y-m-d H:i:s');
                                $fecha_liberada='0000-00-00';
                                $fecha_activa='0000-00-00';
                                $fecha_orden_cerrada='0000-00-00';
                       }else
                       {
                          switch($this->input->post('estado',true))
                         {
                            case '1':
                                $situacion='Liberada';
                                $fecha_pendiente='0000-00-00';
                                $fecha_liberada=date('Y-m-d H:i:s');
                                $fecha_activa='0000-00-00';
                                $fecha_orden_cerrada='0000-00-00';
                            break;
                            case '0':
                                $situacion='Activa';
                                $fecha_pendiente='0000-00-00';
                                $fecha_liberada='0000-00-00';
                                $fecha_activa=date('Y-m-d H:i:s');
                                $fecha_orden_cerrada='0000-00-00';
                            break;
                            case '2':
                                $situacion='Activa';
                                $fecha_pendiente='0000-00-00';
                                $fecha_liberada='0000-00-00';
                                $fecha_activa=date('Y-m-d H:i:s');
                                $fecha_orden_cerrada='0000-00-00';
                            break;
							case '3':
                                $situacion='Parcial';
                                $fecha_pendiente='0000-00-00';
                                $fecha_liberada='0000-00-00';
                                $fecha_activa=date('Y-m-d H:i:s');
                                $fecha_orden_cerrada='0000-00-00';
                            break;
                            
                         }
                       }
                    $data=array
                    (
					
                        "id_usuario"=>$this->session->userdata('id'),
                        "tipo"=>$this->input->post('tipo',true),
                        "id_nodo"=>$this->input->post('id',true),
                        "id_cliente"=>$this->input->post('id_cliente',true),
                        "orden_de_trabajo"=>$this->input->post('id',true),
                        "descripcion_del_trabajo"=>$this->input->post('descripcion_del_trabajo',true),
                        "descripcion_onda"=>$this->input->post('descripcion_onda',true),
                        "datos_tecnicos"=>$this->input->post('datos_tecnicos',true),
                        "ancho_seleccionado_onda"=>$this->input->post('ancho_seleccionado_de_bobina',true),
                        "ancho_a_bobinar"=>$this->input->post('ancho_a_bobinar',true),
                        "medida_final_pliego_a_cortar"=>$this->input->post("medida_final_pliego_a_cortar",true),
                        "gramaje_seleccionado"=>$this->input->post("gramaje_seleccionado",true),
                        "total_pliegos_para_la_orden"=>$this->input->post("total_pliegos_para_la_orden",true),
                        "total_kilos_a_bobinar"=>$this->input->post("total_kilos_a_bobinar",true),
                        "total_bobinas"=>$this->input->post("total_bobinas",true),
                        "total_o_parcial"=>$this->input->post("total_o_parcial",true),
                        "operador"=>$this->input->post('operador',true),
                        "ayudante"=>$this->input->post('ayudante',true),
                        "estado"=>$this->input->post('estado',true),
                        "quien"=>$this->session->userdata('id'),
                        "cuando"=>date("Y-m-d"),
                        "glosa"=>$this->input->post('glosa',true),
                        "situacion"=>$situacion,
                        "fecha_pendiente"=>$fecha_pendiente,
                        "fecha_liberada"=>$fecha_liberada,
                        "fecha_activa"=>$fecha_activa,
                        "fecha_orden_cerrada"=>$fecha_orden_cerrada,
			"total_kilos"=>$this->input->post('total_kilos',true),
                        
                    );
                    if(sizeof($control)==0)
                    {
                        $this->db->insert("produccion_bobinado_onda",$data);
                        
                    }else
                    {
                        $this->db->update('produccion_bobinado_onda', $data, array('tipo' => $this->input->post('tipo',true),'id_nodo'=>$this->input->post('id',true)));
                       
                    }    
					
					
					
						
					//Parcial				
					
					$data2=array
                    (              
                        "id_usuario"=>$this->session->userdata('id'),
                        "tipo"=>$this->input->post('tipo',true),
                        "id_nodo"=>$this->input->post('id',true),
                        "id_cliente"=>$this->input->post('id_cliente',true),
                        "orden_de_trabajo"=>$this->input->post('id',true),
                        "descripcion_del_trabajo"=>$this->input->post('descripcion_del_trabajo',true),
                        "descripcion_onda"=>$this->input->post('descripcion_onda',true),
                        "datos_tecnicos"=>$this->input->post('datos_tecnicos',true),
                        "ancho_seleccionado_onda"=>$this->input->post('ancho_seleccionado_de_bobina',true),
                        
                        "ancho_a_bobinar"=>$this->input->post('ancho_a_bobinar',true),
                        "medida_final_pliego_a_cortar"=>$this->input->post("medida_final_pliego_a_cortar",true),
                        "gramaje_seleccionado"=>$this->input->post("gramaje_seleccionado",true),
                        "total_pliegos_para_la_orden"=>$this->input->post("total_pliegos_para_la_orden",true),
                        "total_kilos_a_bobinar"=>$this->input->post("total_kilos_a_bobinar",true),
                        "total_bobinas"=>$this->input->post("total_bobinas",true),
                        "total_o_parcial"=>$this->input->post("total_o_parcial",true),
                        "operador"=>$this->input->post('operador',true),
                        "ayudante"=>$this->input->post('ayudante',true),
                        "estado"=>$this->input->post('estado',true),
                        "quien"=>$this->session->userdata('id'),
                        "cuando"=>date("Y-m-d"),
                        "glosa"=>$this->input->post('glosa',true),
                        "situacion"=>$situacion,
                        "fecha_pendiente"=>$fecha_pendiente,
                        "fecha_liberada"=>$fecha_liberada,
                        "fecha_activa"=>$fecha_activa,
                        "fecha_orden_cerrada"=>$fecha_orden_cerrada,	
						"total_kilos"=>$this->input->post('total_kilos',true),
                    );
					
						 if($this->input->post('estado',true) == '3')
						 {
								 $this->db->insert("produccion_bobinado_onda_parcial",$data);
						
						 }
					//Parcial Fin
					
					
					//Liberar + Total
					
					$hayparcial2=$this->produccion_model->getParcialBobinadoOndaSuma($this->input->post('id',true));
					
					if($this->input->post('total_o_parcial',true) == 'Total' and $hayparcial2->sum > 0 and $this->input->post('estado',true) == 1)
					{		
							$data1=array
							(								
								"estado"=>1,
								"situacion"=>'Liberada',
						    	"fecha_liberada"=>date('Y-m-d H:i:s'),	
								"fecha_pendiente"=>'0000-00-00',
								"fecha_activa"=>'0000-00-00',
								"fecha_orden_cerrada"=>'0000-00-00',
							);
							
		$this->db->update('produccion_bobinado_onda', $data1, array('tipo' => $this->input->post('tipo',true),'id_nodo'=>$this->input->post('id',true)));
 
						   $data4=array
							(								
								"estado"=>1,
								"situacion"=>'Liberada',
								"fecha_liberada"=>date('Y-m-d H:i:s'),	
								"fecha_pendiente"=>'0000-00-00',
								"fecha_activa"=>'0000-00-00',
								"fecha_orden_cerrada"=>'0000-00-00',
							);
							
	 $this->db->update('produccion_bobinado_onda_parcial', $data4, array('tipo' => $this->input->post('tipo',true),'id_nodo'=>$this->input->post('id',true)));
					
					}					
					//Liberra Total fin
					
					
                    switch($tipo)
                    {
                        case '1':
                            $this->session->set_flashdata('ControllerMessage', 'Se ha guardado el registro exitosamente.');					            redirect(base_url().'produccion/cotizaciones/'.$this->input->post('pagina',true),  301);
                        break;
                         case '2':
                            $this->session->set_flashdata('ControllerMessage', 'Se ha guardado el registro exitosamente.');					            redirect(base_url().'produccion/fast/'.$this->input->post('pagina',true),  301);
                        break;
                    }   
                }
            }
            $usuarios2=$this->usuarios_model->getUsuariosPorTipo(8);
            $usuarios=$this->usuarios_model->getUsuariosPorTipo(9);
            $this->layout->view("bobinado_onda",compact('usuarios','datos','tipo','pagina','id','control','ing','usuarios2','orden','fotomecanica','fotomecanica2','control_cartulina','hoja','control_onda','ordenDeCompra')); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
        
	}
    /**
     * Bobinado liner
     * */
	 public function bobinado_liner($tipo=null,$id=null,$pagina=null)
	{
        if($this->session->userdata('id'))
        {
          
            if(!$tipo or !$id){show_404();}
           switch($tipo)
                    {
                        case '1':
                            $datos=$this->cotizaciones_model->getCotizacionPorId($id);
                        break;
                         case '2':
                            $datos=$this->fast_track_model->getFastTrackPorId($id);
                        break;
                    }      
			if(sizeof($datos)==0){show_404();}
            $control=$this->produccion_model->getBobinadoCartulinaLinerPorTipo($tipo,$id);
            $ordenDeCompra=$this->cotizaciones_model->getOrdenDeCompraPorCotizacion($id);
            $orden=$this->orden_model->getOrdenesPorCotizacion($id);
            $fotomecanica=$this->produccion_model->getFotomecanicaPorTipo($tipo,$id);
            $fotomecanica2=$this->cotizaciones_model->getCotizacionFotomecanicaPorIdCotizacion($id);
            $ing=$this->cotizaciones_model->getCotizacionIngenieriaPorIdCotizacion($id);
            $control_cartulina=$this->produccion_model->getControlCartulinaPorTipo($tipo,$id);
            $control_liner=$this->produccion_model->getControlControlLinerPorTipo($tipo,$id);
            $bobinado_liner=$this->produccion_model->getBobinadolLinerPorTipo($tipo,$id);
            $hoja=$this->cotizaciones_model->getHojaDeCostosPorIdCotizacion($id);
            if($this->input->post())
            {
                if($this->form_validation->run('produccion_bobinado'))
                {
                        if(sizeof($control_liner)==0)
                       {
                                $situacion='Pendiente';
                                $fecha_pendiente=date('Y-m-d H:i:s');
                                $fecha_liberada='0000-00-00';
                                $fecha_activa='0000-00-00';
                                $fecha_orden_cerrada='0000-00-00';
                       }else
                       {}
                         switch($this->input->post('estado',true))
                         {
                            case '1':
                                $situacion='Liberada';
                                $fecha_pendiente='0000-00-00';
                                $fecha_liberada=date('Y-m-d H:i:s');
                                $fecha_activa='0000-00-00';
                                $fecha_orden_cerrada='0000-00-00';
                            break;
                            case '0':
                                $situacion='Activa';
                                $fecha_pendiente='0000-00-00';
                                $fecha_liberada='0000-00-00';
                                $fecha_activa=date('Y-m-d H:i:s');
                                $fecha_orden_cerrada='0000-00-00';
                            break;
                            case '2':
                                $situacion='Activa';
                                $fecha_pendiente='0000-00-00';
                                $fecha_liberada='0000-00-00';
                                $fecha_activa=date('Y-m-d H:i:s');
                                $fecha_orden_cerrada='0000-00-00';
                            break;
							case '3':
                                $situacion='Parcial';
                                $fecha_pendiente='0000-00-00';
                                $fecha_liberada='0000-00-00';
                                $fecha_activa=date('Y-m-d H:i:s');
                                $fecha_orden_cerrada='0000-00-00';
                            break;
                         }
                       
					   
                    $data=array
                    (
                        "id_usuario"=>$this->session->userdata('id'),
                        "tipo"=>$this->input->post('tipo',true),
                        "id_nodo"=>$this->input->post('id',true),
                        "id_cliente"=>$this->input->post('id_cliente',true),
                        "orden_de_trabajo"=>$this->input->post('id',true),
                        "descripcion_del_trabajo"=>$this->input->post('descripcion_del_trabajo',true),
                        "descripcion_liner"=>$this->input->post('descripcion_liner',true),
                        "datos_tecnicos"=>$this->input->post('datos_tecnicos',true),
                        "ancho_seleccionado_de_bobina"=>$this->input->post('ancho_seleccionado_de_bobina',true),
                        
                        "ancho_a_bobinar"=>$this->input->post('ancho_a_bobinar',true),
                        "medida_final_pliego_a_cortar"=>$this->input->post("medida_final_pliego_a_cortar",true),
                        "gramaje_seleccionado"=>$this->input->post("gramaje_seleccionado",true),
                        "total_pliegos_para_la_orden"=>$this->input->post("total_pliegos_para_la_orden",true),
                        "total_kilos_a_bobinar"=>$this->input->post("total_kilos_a_bobinar",true),
                        "total_bobinas"=>$this->input->post("total_bobinas",true),
                        "total_o_parcial"=>$this->input->post("total_o_parcial",true),
                        "operador"=>$this->input->post('operador',true),
                        "ayudante"=>$this->input->post('ayudante',true),
                        "estado"=>$this->input->post('estado',true),
                        "quien"=>$this->session->userdata('id'),
                        "cuando"=>date("Y-m-d"),
                        "glosa"=>$this->input->post('glosa',true),
                        "situacion"=>$situacion,
                        "fecha_pendiente"=>$fecha_pendiente,
                        "fecha_liberada"=>$fecha_liberada,
                        "fecha_activa"=>$fecha_activa,
                        "fecha_orden_cerrada"=>$fecha_orden_cerrada,
						"total_kilos2"=>$this->input->post('total_kilos2',true),
						"total_kilos"=> $this->input->post('total_kilos',true),
                    );
                    if(sizeof($control)==0)
                    {
                        $this->db->insert("produccion_bobinado_liner",$data);
                        
                    }else
                    {
                        $this->db->update('produccion_bobinado_liner', $data, array('tipo' => $this->input->post('tipo',true),'id_nodo'=>$this->input->post('id',true)));
                       
                    }    
					
						//Parcial				
					
					$data2=array
                    (              
                         "id_usuario"=>$this->session->userdata('id'),
                        "tipo"=>$this->input->post('tipo',true),
                        "id_nodo"=>$this->input->post('id',true),
                        "id_cliente"=>$this->input->post('id_cliente',true),
                        "orden_de_trabajo"=>$this->input->post('id',true),
                        "descripcion_del_trabajo"=>$this->input->post('descripcion_del_trabajo',true),
                        "descripcion_liner"=>$this->input->post('descripcion_liner',true),
                        "datos_tecnicos"=>$this->input->post('datos_tecnicos',true),
                        "ancho_seleccionado_de_bobina"=>$this->input->post('ancho_seleccionado_de_bobina',true),
                        
                        "ancho_a_bobinar"=>$this->input->post('ancho_a_bobinar',true),
                        "medida_final_pliego_a_cortar"=>$this->input->post("medida_final_pliego_a_cortar",true),
                        "gramaje_seleccionado"=>$this->input->post("gramaje_seleccionado",true),
                        "total_pliegos_para_la_orden"=>$this->input->post("total_pliegos_para_la_orden",true),
                        "total_kilos_a_bobinar"=>$this->input->post("total_kilos_a_bobinar",true),
                        "total_bobinas"=>$this->input->post("total_bobinas",true),
                        "total_o_parcial"=>$this->input->post("total_o_parcial",true),
                        "operador"=>$this->input->post('operador',true),
                        "ayudante"=>$this->input->post('ayudante',true),
                        "estado"=>$this->input->post('estado',true),
                        "quien"=>$this->session->userdata('id'),
                        "cuando"=>date("Y-m-d"),
                        "glosa"=>$this->input->post('glosa',true),
                        "situacion"=>$situacion,
                        "fecha_pendiente"=>$fecha_pendiente,
                        "fecha_liberada"=>$fecha_liberada,
                        "fecha_activa"=>$fecha_activa,
                        "fecha_orden_cerrada"=>$fecha_orden_cerrada,
						"total_kilos2"=>$this->input->post('total_kilos2',true),
						"total_kilos"=> $this->input->post('total_kilos',true),
                    );
					
						 if($this->input->post('estado',true) == '3')
						 {
								 $this->db->insert("produccion_bobinado_liner_parcial",$data);
						
						 }
					//Parcial Fin
					
					
					
							
					//Liberar + Total
					
					$hayparcial2=$this->produccion_model->getParcialBobinadoLinerSuma($this->input->post('id',true));
					
					if($this->input->post('total_o_parcial',true) == 'Total' and $hayparcial2->sum > 0 and $this->input->post('estado',true) == 1)
					{		
							$data1=array
							(								
								"estado"=>1,
								"situacion"=>'Liberada',
						    	"fecha_liberada"=>date('Y-m-d H:i:s'),	
								"fecha_pendiente"=>'0000-00-00',
								"fecha_activa"=>'0000-00-00',
								"fecha_orden_cerrada"=>'0000-00-00',
							);
							
	$this->db->update('produccion_bobinado_liner', $data1, array('tipo' => $this->input->post('tipo',true),'id_nodo'=>$this->input->post('id',true)));
 
						   $data4=array
							(								
								"estado"=>1,
								"situacion"=>'Liberada',
								"fecha_liberada"=>date('Y-m-d H:i:s'),	
								"fecha_pendiente"=>'0000-00-00',
								"fecha_activa"=>'0000-00-00',
								"fecha_orden_cerrada"=>'0000-00-00',
							);
							
	 $this->db->update('produccion_bobinado_liner_parcial', $data4, array('tipo' => $this->input->post('tipo',true),'id_nodo'=>$this->input->post('id',true)));
					
					}					
					//Liberra Total fin
					
					
					
                    switch($tipo)
                    {
                        case '1':
                            $this->session->set_flashdata('ControllerMessage', 'Se ha guardado el registro exitosamente.');					            redirect(base_url().'produccion/cotizaciones/'.$this->input->post('pagina',true),  301);
                        break;
                         case '2':
                            $this->session->set_flashdata('ControllerMessage', 'Se ha guardado el registro exitosamente.');					            redirect(base_url().'produccion/fast/'.$this->input->post('pagina',true),  301);
                        break;
                    }   
                }
            }
            $usuarios2=$this->usuarios_model->getUsuariosPorTipo(8);
            $usuarios=$this->usuarios_model->getUsuariosPorTipo(9);
            $this->layout->view("bobinado_liner",compact('usuarios','datos','tipo','pagina','id','control','ing','usuarios2','orden','fotomecanica','fotomecanica2','control_cartulina','hoja','control_liner','bobinado_liner')); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
        
	}
    /**
     * Control Liner 
     * */
	 public function control_liner($tipo=null,$id=null,$pagina=null)
	{
        if($this->session->userdata('id'))
        {
          
            if(!$tipo or !$id){show_404();}
           switch($tipo)
                    {
                        case '1':
                            $datos=$this->cotizaciones_model->getCotizacionPorId($id);
                        break;
                         case '2':
                            $datos=$this->fast_track_model->getFastTrackPorId($id);
                        break;
                    }      
			if(sizeof($datos)==0){show_404();}
            $control_liner=$this->produccion_model->getControlControlLinerPorTipo($tipo,$id);
            $ing=$this->cotizaciones_model->getCotizacionIngenieriaPorIdCotizacion($id);
            $fotomecanica2=$this->cotizaciones_model->getCotizacionFotomecanicaPorIdCotizacion($id);
            $orden=$this->orden_model->getOrdenesPorCotizacion($id);
            $hoja=$this->cotizaciones_model->getHojaDeCostosPorIdCotizacion($id);
            $fotomecanica=$this->produccion_model->getFotomecanicaPorTipo($tipo,$id);
            $ordenDeCompra=$this->cotizaciones_model->getOrdenDeCompraPorCotizacion($id);
            
            /*materialidad*/
            $hoja=$this->cotizaciones_model->getHojaDeCostosPorIdCotizacion($id);            
            $tapa = $this->materiales_model->getMaterialesPorNombre($fotomecanica2->materialidad_1);
            $monda = $this->materiales_model->getMaterialesPorNombre($fotomecanica2->materialidad_2);
            $mliner = $this->materiales_model->getMaterialesPorNombre($fotomecanica2->materialidad_3);            
            $materialidad_1=$this->materiales_model->getMaterialesPorNombre($fotomecanica2->materialidad_1);
            $materialidad_2=$this->materiales_model->getMaterialesPorNombre($fotomecanica2->materialidad_2);
            $materialidad_3=$this->materiales_model->getMaterialesPorNombre($fotomecanica2->materialidad_3);            
            $control_onda=$this->produccion_model->getControlControlOndaPorTipo($tipo,$id);
//            print_r($control_onda);

            if ($control_liner->ancho_a_usar_liner=='')
            {    
                if ($control_onda->ancho_a_usar_onda!='')            
                {
                    $ancho_a_usar_liner= $control_onda->ancho_a_usar_onda;
                    $ancho_a_usar_onda= $control_onda->ancho_a_usar_onda;
                    
                }
                else{
                    $ancho_a_usar_liner= herramientas_funciones::ancho_bobina_usar($ing->tamano_a_imprimir_1);
                    $ancho_a_usar_onda= $ancho_a_usar_liner;
                }                
            }
            else{
                $ancho_a_usar_liner=$control_liner->ancho_a_usar_liner;
                $ancho_a_usar_onda= $control_onda->ancho_a_usar_onda;
            }
           
            
            if($this->input->post())
            {
                if($this->form_validation->run('control_liner'))
                {
                    if(sizeof($fotomecanica)==0)
                   {
                            $situacion='Pendiente';
                            $fecha_pendiente=date('Y-m-d H:i:s');
                            $fecha_liberada='0000-00-00';
                            $fecha_activa='0000-00-00';
                            $fecha_orden_cerrada='0000-00-00';
                   }else
                   {}
                     switch($this->input->post('estado',true))
                     {
                        case '1':
                            $situacion='Liberada';
                            $fecha_pendiente='0000-00-00';
                            $fecha_liberada=date('Y-m-d H:i:s');
                            $fecha_activa='0000-00-00';
                            $fecha_orden_cerrada='0000-00-00';
                        break;
                        case '0':
                            $situacion='Activa';
                            $fecha_pendiente='0000-00-00';
                            $fecha_liberada='0000-00-00';
                            $fecha_activa=date('Y-m-d H:i:s');
                            $fecha_orden_cerrada='0000-00-00';
                        break;
                        case '2':
                            $situacion='Activa';
                            $fecha_pendiente='0000-00-00';
                            $fecha_liberada='0000-00-00';
                            $fecha_activa=date('Y-m-d H:i:s');
                            $fecha_orden_cerrada='0000-00-00';
                        break;
						case '3':
                            $situacion='Parcial';
                            $fecha_pendiente='0000-00-00';
                            $fecha_liberada='0000-00-00';
                            $fecha_activa=date('Y-m-d H:i:s');
                            $fecha_orden_cerrada='0000-00-00';
                        break;
                     }
				   
				     if($this->input->post('gramaje',true) != $this->input->post('gramaje_seleccionado',true)  and $ing->tamano_a_imprimir_1 != $this->input->post('ancho_seleccionado_de_bobina',true))
				  {
					  $kilos1=$this->produccion_model->LlamarKilosLiner($this->input->post('id',true),$this->input->post('gramaje_seleccionado',true),$this->input->post('ancho_seleccionado_de_bobina',true));
					  $gramajeSeleccionado = $this->input->post('gramaje_seleccionado',true);
				  }else{
					  $kilos1 = $this->input->post('kilo_liner',true);
					  $gramajeSeleccionado = $this->input->post('gramaje',true);
				  }
				   
				   
				   
                    $data=array
                    (
                        "id_usuario"=>$this->session->userdata('id'),
                        "tipo"=>$this->input->post('tipo',true),
                        "id_nodo"=>$this->input->post('id',true),
                        "id_cliente"=>$this->input->post('id_cliente',true),
                        "orden_de_trabajo"=>$this->input->post('id',true),
                        "descripcion_del_trabajo"=>$this->input->post('descripcion_del_trabajo',true),
                        "ancho_seleccionado_de_bobina"=>$gramajeSeleccionado,
						
                        "para_bobinado"=>$this->input->post('para_bobinado',true),
                        "ancho_de_bobina"=>$this->input->post('ancho_de_bobina',true),
                        "ancho_a_usar_liner"=>$this->input->post('ancho_a_usar_liner',true),
                        "ancho_seleccionado_de_bobina"=>$this->input->post('ancho_seleccionado_de_bobina',true),
                        "gramaje_liner"=>$this->input->post('gramaje_liner',true),
                        "ubicacion_liner"=>$this->input->post('ubicacion_liner',true),
                        "preguntar_a_liner"=>$this->input->post('preguntar_a_liner',true),
                        "numero_bobina_liner"=>$this->input->post('numero_bobina_liner',true),
                        "estado"=>$this->input->post('estado',true),
                        "quien"=>$this->session->userdata('id'),
                        "cuando"=>date("Y-m-d"),
                        "glosa"=>$this->input->post('glosa',true),
                        "situacion"=>$situacion,
                        "fecha_pendiente"=>$fecha_pendiente,
                        "fecha_liberada"=>$fecha_liberada,
                        "fecha_activa"=>$fecha_activa,
                        "fecha_orden_cerrada"=>$fecha_orden_cerrada,
                        "gramaje_seleccionado"=>$this->input->post('gramaje_seleccionado',true),
                        "gramaje_seleccionado"=>$this->input->post("gramaje_seleccionado",true),
                        "hay_que_comprar_liner"=>$this->input->post('hay_que_comprar_liner',true),
                        "proveedor"=>$this->input->post('proveedor',true),
                        "fecha_estimada_de_entrega"=>$this->input->post('fecha_estimada_de_entrega',true),
                        "total_kilos2"=>$this->input->post('total_kilos2',true),
                        "total_kilos"=>$kilos1,
                        "bobinar_ancho_liner"=>$this->input->post('bobinar_ancho_liner',true),     
                        "bobinar_ancho_cartulina1"=>$this->input->post('bobinar_ancho_cartulina1',true),                        
                        "bobinar_ancho_cartulina2"=>$this->input->post('bobinar_ancho_cartulina2',true),                        
                        "bobinar_ancho_cartulina3"=>$this->input->post('bobinar_ancho_cartulina3',true),
                        "kilos_bobina_seleccionada"=>$this->input->post('kilos_bobina_seleccionada',true),
                        "total_metros"=>$this->input->post('total_metros',true),
                        "kilos_bobina_seleccionada"=>$this->input->post('kilos_bobina_seleccionada',true),                        
                    );
//                    print_r($data);
//                    exit();
                    if(sizeof($control_liner)==0)
                    {
                        $this->db->insert("produccion_control_liner",$data);
                        
                    }else
                    {
                        $this->db->update('produccion_control_liner', $data, array('tipo' => $this->input->post('tipo',true),'id_nodo'=>$this->input->post('id',true)));
                       
                    }    
					
					
					
					//Parcial				
					
					$data2=array
                    (              
                       "id_usuario"=>$this->session->userdata('id'),
                        "tipo"=>$this->input->post('tipo',true),
                        "id_nodo"=>$this->input->post('id',true),
                        "id_cliente"=>$this->input->post('id_cliente',true),
                        "orden_de_trabajo"=>$this->input->post('id',true),
                        "descripcion_del_trabajo"=>$this->input->post('descripcion_del_trabajo',true),
                        "ancho_seleccionado_de_bobina"=>$gramajeSeleccionado,
						
                        "para_bobinado"=>$this->input->post('para_bobinado',true),
                        "ancho_de_bobina"=>$this->input->post('ancho_de_bobina',true),
                        "ancho_a_usar_liner"=>$this->input->post('ancho_a_usar_liner',true),
                        "gramaje_liner"=>$this->input->post('gramaje_liner',true),
                        "ubicacion_liner"=>$this->input->post('ubicacion_liner',true),
                        "preguntar_a_liner"=>$this->input->post('preguntar_a_liner',true),
                        "numero_bobina_liner"=>$this->input->post('numero_bobina_liner',true),
                        "estado"=>$this->input->post('estado',true),
                        "quien"=>$this->session->userdata('id'),
                        "cuando"=>date("Y-m-d"),
                        "glosa"=>$this->input->post('glosa',true),
                        "situacion"=>$situacion,
                        "fecha_pendiente"=>$fecha_pendiente,
                        "fecha_liberada"=>$fecha_liberada,
                        "fecha_activa"=>$fecha_activa,
                        "fecha_orden_cerrada"=>$fecha_orden_cerrada,
                        "gramaje_seleccionado"=>$this->input->post('gramaje_seleccionado',true),
                        "ancho_seleccionado_de_bobina"=>$this->input->post('ancho_seleccionado_de_bobina',true),
                        "gramaje_seleccionado"=>$this->input->post("gramaje_seleccionado",true),
                        "hay_que_comprar_liner"=>$this->input->post('hay_que_comprar_liner',true),
                        "proveedor"=>$this->input->post('proveedor',true),
                        "fecha_estimada_de_entrega"=>$this->input->post('fecha_estimada_de_entrega',true),
                        "total_kilos2"=>$this->input->post('total_kilos2',true),
                        "total_kilos"=>$kilos1,
                        "bobinar_ancho_liner"=>$this->input->post('bobinar_ancho_liner',true),   
                        "bobinar_ancho_cartulina1"=>$this->input->post('bobinar_ancho_cartulina1',true),                        
                        "bobinar_ancho_cartulina2"=>$this->input->post('bobinar_ancho_cartulina2',true),                        
                        "bobinar_ancho_cartulina3"=>$this->input->post('bobinar_ancho_cartulina3',true),
                        "kilos_bobina_seleccionada"=>$this->input->post('kilos_bobina_seleccionada',true),
                        "total_metros"=>$this->input->post('total_metros',true),
                        "kilos_bobina_seleccionada"=>$this->input->post('kilos_bobina_seleccionada',true),                                            
                    );
					
						 if($this->input->post('estado',true) == '3')
						 {
								 $this->db->insert("produccion_control_liner_parcial",$data2);
						
						 }
					//Parcial Fin
					
							//Liberar + Total
					
					$hayparcial2=$this->produccion_model->getParcialControlLinerSuma($this->input->post('id',true));
					
					
					if($this->input->post('total_o_parcial',true) == 'Total' and $hayparcial2->sum > 0 and $this->input->post('estado',true) == 1)
					{		
							$data1=array
							(								
								"estado"=>1,
								"situacion"=>'Liberada',
						    	"fecha_liberada"=>date('Y-m-d H:i:s'),	
								"fecha_pendiente"=>'0000-00-00',
								"fecha_activa"=>'0000-00-00',
								"fecha_orden_cerrada"=>'0000-00-00',
							);
							
	$this->db->update('produccion_control_liner', $data1, array('tipo' => $this->input->post('tipo',true),'id_nodo'=>$this->input->post('id',true)));
 
						   $data4=array
							(								
								"estado"=>1,
								"situacion"=>'Liberada',
								"fecha_liberada"=>date('Y-m-d H:i:s'),	
								"fecha_pendiente"=>'0000-00-00',
								"fecha_activa"=>'0000-00-00',
								"fecha_orden_cerrada"=>'0000-00-00',
							);
							
	 $this->db->update('produccion_control_liner_parcial', $data4, array('tipo' => $this->input->post('tipo',true),'id_nodo'=>$this->input->post('id',true)));
					
					}					
					//Liberra Total fin
					
					
					
					
                    switch($tipo)
                    {
                        case '1':
                            $this->session->set_flashdata('ControllerMessage', 'Se ha guardado el registro exitosamente.');					            redirect(base_url().'produccion/cotizaciones/'.$this->input->post('pagina',true),  301);
                        break;
                         case '2':
                            $this->session->set_flashdata('ControllerMessage', 'Se ha guardado el registro exitosamente.');					            redirect(base_url().'produccion/fast/'.$this->input->post('pagina',true),  301);
                        break;
                    }   
                }
            }
            $usuarios=$this->usuarios_model->getUsuarios();
            $this->layout->view("control_liner",compact('usuarios','datos','tipo','pagina','id','control_liner','fotomecanica','fotomecanica2','ordenDeCompra','ing','orden','hoja','tapa','monda','mliner','materialidad_1','materialidad_2','materialidad_3','ancho_a_usar_liner','ancho_a_usar_onda')); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
        
	}
	
	 public function control_cartulina2($tipo=null,$id=null,$pagina=null)
	{
        if($this->session->userdata('id'))
        {
          
            if(!$tipo or !$id){show_404();}
           switch($tipo)
                    {
                        case '1':
                            $datos=$this->cotizaciones_model->getCotizacionPorId($id);
                        break;
                         case '2':
                            $datos=$this->fast_track_model->getFastTrackPorId($id);
                        break;
                    }      
			if(sizeof($datos)==0){show_404();}
            $control_liner=$this->produccion_model->getControlControlLinerPorTipo($tipo,$id);
            $ing=$this->cotizaciones_model->getCotizacionIngenieriaPorIdCotizacion($id);
            $fotomecanica2=$this->cotizaciones_model->getCotizacionFotomecanicaPorIdCotizacion($id);
            $orden=$this->orden_model->getOrdenesPorCotizacion($id);
            $hoja=$this->cotizaciones_model->getHojaDeCostosPorIdCotizacion($id);
            $fotomecanica=$this->produccion_model->getFotomecanicaPorTipo($tipo,$id);
            $ordenDeCompra=$this->cotizaciones_model->getOrdenDeCompraPorCotizacion($id);
            if($this->input->post())
            {
                if($this->form_validation->run('control_liner'))
                {
                    if(sizeof($fotomecanica)==0)
                   {
                            $situacion='Pendiente';
                            $fecha_pendiente=date('Y-m-d H:i:s');
                            $fecha_liberada='0000-00-00';
                            $fecha_activa='0000-00-00';
                            $fecha_orden_cerrada='0000-00-00';
                   }else
                   {
                     switch($tipo)
                     {
                        case '1':
                            $situacion='Liberada';
                            $fecha_pendiente='0000-00-00';
                            $fecha_liberada=date('Y-m-d H:i:s');
                            $fecha_activa='0000-00-00';
                            $fecha_orden_cerrada='0000-00-00';
                        break;
                        case '0':
                            $situacion='Activa';
                            $fecha_pendiente='0000-00-00';
                            $fecha_liberada='0000-00-00';
                            $fecha_activa=date('Y-m-d H:i:s');
                            $fecha_orden_cerrada='0000-00-00';
                        break;
                        case '2':
                            $situacion='Activa';
                            $fecha_pendiente='0000-00-00';
                            $fecha_liberada='0000-00-00';
                            $fecha_activa=date('Y-m-d H:i:s');
                            $fecha_orden_cerrada='0000-00-00';
                        break;
						case '3':
                            $situacion='Parcial';
                            $fecha_pendiente='0000-00-00';
                            $fecha_liberada='0000-00-00';
                            $fecha_activa=date('Y-m-d H:i:s');
                            $fecha_orden_cerrada='0000-00-00';
                        break;
                     }
                   }
				   
				     if($this->input->post('gramaje',true) != $this->input->post('gramaje_seleccionado',true)  and $ing->tamano_a_imprimir_1 != $this->input->post('ancho_seleccionado_de_bobina',true))
				  {
					  $kilos1=$this->produccion_model->LlamarKilosLiner($this->input->post('id',true),$this->input->post('gramaje_seleccionado',true),$this->input->post('ancho_seleccionado_de_bobina',true));
					  $gramajeSeleccionado = $this->input->post('gramaje_seleccionado',true);
				  }else{
					  $kilos1 = $this->input->post('kilo_liner',true);
					  $gramajeSeleccionado = $this->input->post('gramaje',true);
				  }
				   
				   
				   
                    $data=array
                    (
                        "id_usuario"=>$this->session->userdata('id'),
                        "tipo"=>$this->input->post('tipo',true),
                        "id_nodo"=>$this->input->post('id',true),
                        "id_cliente"=>$this->input->post('id_cliente',true),
                        "orden_de_trabajo"=>$this->input->post('id',true),
                        "descripcion_del_trabajo"=>$this->input->post('descripcion_del_trabajo',true),
                        "ancho_seleccionado_de_bobina"=>$gramajeSeleccionado,
						
                        "para_bobinado"=>$this->input->post('para_bobinado',true),
                        "ancho_de_bobina"=>$this->input->post('ancho_de_bobina',true),
                        "ancho_a_usar_liner"=>$this->input->post('ancho_a_usar_liner',true),
                        "gramaje_liner"=>$this->input->post('gramaje_liner',true),
                        "ubicacion_liner"=>$this->input->post('ubicacion_liner',true),
                        "preguntar_a_liner"=>$this->input->post('preguntar_a_liner',true),
                        "numero_bobina_liner"=>$this->input->post('numero_bobina_liner',true),
                        "estado"=>$this->input->post('estado',true),
                        "quien"=>$this->session->userdata('id'),
                        "cuando"=>date("Y-m-d"),
                        "glosa"=>$this->input->post('glosa',true),
                        "situacion"=>$situacion,
                        "fecha_pendiente"=>$fecha_pendiente,
                        "fecha_liberada"=>$fecha_liberada,
                        "fecha_activa"=>$fecha_activa,
                        "fecha_orden_cerrada"=>$fecha_orden_cerrada,
                        "gramaje_seleccionado"=>$this->input->post('gramaje_seleccionado',true),
                        "ancho_seleccionado_de_bobina"=>$this->input->post('ancho_seleccionado_de_bobina',true),
                        "gramaje_seleccionado"=>$this->input->post("gramaje_seleccionado",true),
                        "hay_que_comprar_liner"=>$this->input->post('hay_que_comprar_liner',true),
                        "proveedor"=>$this->input->post('proveedor',true),
                        "fecha_estimada_de_entrega"=>$this->input->post('fecha_estimada_de_entrega',true),
						"total_kilos2"=>$this->input->post('total_kilos2',true),
						"total_kilos"=>$kilos1,
                    );
                    if(sizeof($control_liner)==0)
                    {
                        $this->db->insert("produccion_control_liner",$data);
                        
                    }else
                    {
                        $this->db->update('produccion_control_liner', $data, array('tipo' => $this->input->post('tipo',true),'id_nodo'=>$this->input->post('id',true)));
                       
                    }    
					
					
					
					//Parcial				
					
					$data2=array
                    (              
                       "id_usuario"=>$this->session->userdata('id'),
                        "tipo"=>$this->input->post('tipo',true),
                        "id_nodo"=>$this->input->post('id',true),
                        "id_cliente"=>$this->input->post('id_cliente',true),
                        "orden_de_trabajo"=>$this->input->post('id',true),
                        "descripcion_del_trabajo"=>$this->input->post('descripcion_del_trabajo',true),
                        "ancho_seleccionado_de_bobina"=>$gramajeSeleccionado,
						
                        "para_bobinado"=>$this->input->post('para_bobinado',true),
                        "ancho_de_bobina"=>$this->input->post('ancho_de_bobina',true),
                        "ancho_a_usar_liner"=>$this->input->post('ancho_a_usar_liner',true),
                        "gramaje_liner"=>$this->input->post('gramaje_liner',true),
                        "ubicacion_liner"=>$this->input->post('ubicacion_liner',true),
                        "preguntar_a_liner"=>$this->input->post('preguntar_a_liner',true),
                        "numero_bobina_liner"=>$this->input->post('numero_bobina_liner',true),
                        "estado"=>$this->input->post('estado',true),
                        "quien"=>$this->session->userdata('id'),
                        "cuando"=>date("Y-m-d"),
                        "glosa"=>$this->input->post('glosa',true),
                        "situacion"=>$situacion,
                        "fecha_pendiente"=>$fecha_pendiente,
                        "fecha_liberada"=>$fecha_liberada,
                        "fecha_activa"=>$fecha_activa,
                        "fecha_orden_cerrada"=>$fecha_orden_cerrada,
                        "gramaje_seleccionado"=>$this->input->post('gramaje_seleccionado',true),
                        "ancho_seleccionado_de_bobina"=>$this->input->post('ancho_seleccionado_de_bobina',true),
                        "gramaje_seleccionado"=>$this->input->post("gramaje_seleccionado",true),
                        "hay_que_comprar_liner"=>$this->input->post('hay_que_comprar_liner',true),
                        "proveedor"=>$this->input->post('proveedor',true),
                        "fecha_estimada_de_entrega"=>$this->input->post('fecha_estimada_de_entrega',true),
						"total_kilos2"=>$this->input->post('total_kilos2',true),
						"total_kilos"=>$kilos1,
                    );
					
						 if($this->input->post('estado',true) == '3')
						 {
								 $this->db->insert("produccion_control_liner_parcial",$data);
						
						 }
					//Parcial Fin
					
							//Liberar + Total
					
					$hayparcial2=$this->produccion_model->getParcialBobinadoLinerSuma($this->input->post('id',true));
					
					if($this->input->post('total_o_parcial',true) == 'Total' and $hayparcial2->sum > 0 and $this->input->post('estado',true) == 1)
					{		
							$data1=array
							(								
								"estado"=>1,
								"situacion"=>'Liberada',
						    	"fecha_liberada"=>date('Y-m-d H:i:s'),	
								"fecha_pendiente"=>'0000-00-00',
								"fecha_activa"=>'0000-00-00',
								"fecha_orden_cerrada"=>'0000-00-00',
							);
							
	$this->db->update('produccion_control_liner', $data1, array('tipo' => $this->input->post('tipo',true),'id_nodo'=>$this->input->post('id',true)));
 
						   $data4=array
							(								
								"estado"=>1,
								"situacion"=>'Liberada',
								"fecha_liberada"=>date('Y-m-d H:i:s'),	
								"fecha_pendiente"=>'0000-00-00',
								"fecha_activa"=>'0000-00-00',
								"fecha_orden_cerrada"=>'0000-00-00',
							);
							
	 $this->db->update('produccion_control_liner_parcial', $data4, array('tipo' => $this->input->post('tipo',true),'id_nodo'=>$this->input->post('id',true)));
					
					}					
					//Liberra Total fin
					
					
					
					
                    switch($tipo)
                    {
                        case '1':
                            $this->session->set_flashdata('ControllerMessage', 'Se ha guardado el registro exitosamente.');					            redirect(base_url().'produccion/cotizaciones/'.$this->input->post('pagina',true),  301);
                        break;
                         case '2':
                            $this->session->set_flashdata('ControllerMessage', 'Se ha guardado el registro exitosamente.');					            redirect(base_url().'produccion/fast/'.$this->input->post('pagina',true),  301);
                        break;
                    }   
                }
            }
            $usuarios=$this->usuarios_model->getUsuarios();
            $this->layout->view("control_liner",compact('usuarios','datos','tipo','pagina','id','control_liner','fotomecanica','fotomecanica2','ordenDeCompra','ing','orden','hoja')); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
        
	}
	
	
	
	public function control_onda($tipo=null,$id=null,$pagina=null)
	{
        if($this->session->userdata('id'))
        {
          
            if(!$tipo or !$id){show_404();}
            switch($tipo)
            {
                case '1':
                    $datos=$this->cotizaciones_model->getCotizacionPorId($id);
                break;
                 case '2':
                    $datos=$this->fast_track_model->getFastTrackPorId($id);
                break;
            }      
            if(sizeof($datos)==0){show_404();}
            $datos=$this->cotizaciones_model->getCotizacionPorId($id);            
            $control_onda=$this->produccion_model->getControlControlOndaPorTipo($tipo,$id);
            $ing=$this->cotizaciones_model->getCotizacionIngenieriaPorIdCotizacion($id);
            $fotomecanica2=$this->cotizaciones_model->getCotizacionFotomecanicaPorIdCotizacion($id);
            $orden=$this->orden_model->getOrdenesPorCotizacion($id);
            $hoja=$this->cotizaciones_model->getHojaDeCostosPorIdCotizacion($id);
            $fotomecanica=$this->produccion_model->getFotomecanicaPorTipo($tipo,$id);
            $ordenDeCompra=$this->cotizaciones_model->getOrdenDeCompraPorCotizacion($id);
            
            /*materialidad*/
            $tapa = $this->materiales_model->getMaterialesPorNombre($fotomecanica2->materialidad_1);
            $monda = $this->materiales_model->getMaterialesPorNombre($fotomecanica2->materialidad_2);
            $mliner = $this->materiales_model->getMaterialesPorNombre($fotomecanica2->materialidad_3);            
            $materialidad_1=$this->materiales_model->getMaterialesPorNombre($fotomecanica2->materialidad_1);
            $materialidad_2=$this->materiales_model->getMaterialesPorNombre($fotomecanica2->materialidad_2);
            $materialidad_3=$this->materiales_model->getMaterialesPorNombre($fotomecanica2->materialidad_3);
            if ($control_onda->ancho_a_usar_onda=='')
            {
                $ancho_bobina_a_usar= herramientas_funciones::ancho_bobina_usar($ing->tamano_a_imprimir_1);
            }else
                $ancho_bobina_a_usar= $control_onda->ancho_a_usar_onda;
                
            if($this->input->post())
            {
                if($this->form_validation->run('control_onda'))
                {
                    if(sizeof($fotomecanica)==0)
                   {
                            $situacion='Pendiente';
                            $fecha_pendiente=date('Y-m-d H:i:s');
                            $fecha_liberada='0000-00-00';
                            $fecha_activa='0000-00-00';
                            $fecha_orden_cerrada='0000-00-00';
                   }else
                   {}
                     switch($this->input->post('estado',true))
                     {
                        case '1':
                            $situacion='Liberada';
                            $fecha_pendiente='0000-00-00';
                            $fecha_liberada=date('Y-m-d H:i:s');
                            $fecha_activa='0000-00-00';
                            $fecha_orden_cerrada='0000-00-00';
                        break;
                        case '0':
                            $situacion='Activa';
                            $fecha_pendiente='0000-00-00';
                            $fecha_liberada='0000-00-00';
                            $fecha_activa=date('Y-m-d H:i:s');
                            $fecha_orden_cerrada='0000-00-00';
                        break;
                        case '2':
                            $situacion='Activa';
                            $fecha_pendiente='0000-00-00';
                            $fecha_liberada='0000-00-00';
                            $fecha_activa=date('Y-m-d H:i:s');
                            $fecha_orden_cerrada='0000-00-00';
                        break;
						case '3':
                            $situacion='Parcial';
                            $fecha_pendiente='0000-00-00';
                            $fecha_liberada='0000-00-00';
                            $fecha_activa=date('Y-m-d H:i:s');
                            $fecha_orden_cerrada='0000-00-00';
                        break;
                     }
                  if($this->input->post('gramaje',true) != $this->input->post('gramaje_seleccionado',true)  and $ing->tamano_a_imprimir_1 != $this->input->post('ancho_seleccionado_de_bobina',true))
                  {

                          $gramajeSeleccionado = $this->input->post('gramaje_seleccionado',true);
                          $kilos11=$this->produccion_model->LlamarKilosOnda($this->input->post('id',true),$this->input->post('gramaje_seleccionado',true),$this->input->post('ancho_seleccionado_de_bobina',true));
                          $kilos1 = str_replace('.', '', $kilos11);
                  }else{

                          $kilos1 = $this->input->post('kilo_onda',true);
                          $gramajeSeleccionado = $this->input->post('gramaje',true);

                  }
                    $data=array
                    (
                        "id_usuario"=>$this->session->userdata('id'),
                        "tipo"=>$this->input->post('tipo',true),
                        "id_nodo"=>$this->input->post('id',true),
                        "id_cliente"=>$this->input->post('id_cliente',true),
                        "orden_de_trabajo"=>$this->input->post('id',true),
                        "descripcion_del_trabajo"=>$this->input->post('descripcion_del_trabajo',true),
                        "ancho_a_usar_onda"=>$this->input->post('ancho_a_usar_onda',true),
                        "gramaje_onda"=>$gramajeSeleccionado,
                        "ubicacion_onda"=>$this->input->post('ubicacion_onda',true),
                        "preguntar_a_onda"=>$this->input->post('preguntar_a_onda',true),
                        "numero_bobina_onda"=>$this->input->post('numero_bobina_onda',true),
                        "para_bobinado"=>$this->input->post('para_bobinado',true),
                        "ancho_de_bobina"=>$this->input->post('ancho_de_bobina',true),
                        "estado"=>$this->input->post('estado',true),
                        "quien"=>$this->session->userdata('id'),
                        "cuando"=>date("Y-m-d"),
                        "glosa"=>$this->input->post('glosa',true),
                        "situacion"=>$situacion,
                        "fecha_pendiente"=>$fecha_pendiente,
                        "fecha_liberada"=>$fecha_liberada,
                        "fecha_activa"=>$fecha_activa,
                        "fecha_orden_cerrada"=>$fecha_orden_cerrada,
                        "gramaje_seleccionado"=>$this->input->post('gramaje_seleccionado',true),
                        "ancho_seleccionado_de_bobina"=>$this->input->post('ancho_seleccionado_de_bobina',true),
                        "hay_que_comprar_onda"=>$this->input->post('hay_que_comprar_onda',true),
                        "proveedor"=>$this->input->post('proveedor',true),
                        "fecha_estimada_de_entrega"=>$this->input->post('fecha_estimada_de_entrega',true),
                        "total_kilos2"=>$this->input->post('total_kilos2',true),
			"total_kilos"=>$kilos1,
			"ancho_seleccionado_recomendada"=>$this->input->post('ancho_seleccionado_recomendada',true),                  
                    );
                    if(sizeof($control_onda)==0)
                    {

                        $this->db->insert("produccion_control_onda",$data);
                    }else
                    {
//                        exit(print_r($data)."aqui2");               
                        $this->db->update('produccion_control_onda', $data, array('tipo' => $this->input->post('tipo',true),'id_nodo'=>$this->input->post('id',true)));
                       
                    }    
                    $data2=array
                    (              
                     "id_usuario"=>$this->session->userdata('id'),
                        "tipo"=>$this->input->post('tipo',true),
                        "id_nodo"=>$this->input->post('id',true),
                        "id_cliente"=>$this->input->post('id_cliente',true),
                        "orden_de_trabajo"=>$this->input->post('id',true),
                        "descripcion_del_trabajo"=>$this->input->post('descripcion_del_trabajo',true),
                        "ancho_a_usar_onda"=>$this->input->post('ancho_a_usar_onda',true),
                        "gramaje_onda"=>$gramajeSeleccionado,
                        "ubicacion_onda"=>$this->input->post('ubicacion_onda',true),
                        "preguntar_a_onda"=>$this->input->post('preguntar_a_onda',true),
                        "numero_bobina_onda"=>$this->input->post('numero_bobina_onda',true),
                        "para_bobinado"=>$this->input->post('para_bobinado',true),
                        "ancho_de_bobina"=>$this->input->post('ancho_de_bobina',true),
                        "estado"=>$this->input->post('estado',true),
                        "quien"=>$this->session->userdata('id'),
                        "cuando"=>date("Y-m-d"),
                        "glosa"=>$this->input->post('glosa',true),
                        "situacion"=>$situacion,
                        "fecha_pendiente"=>$fecha_pendiente,
                        "fecha_liberada"=>$fecha_liberada,
                        "fecha_activa"=>$fecha_activa,
                        "fecha_orden_cerrada"=>$fecha_orden_cerrada,
                        "gramaje_seleccionado"=>$this->input->post('gramaje_seleccionado',true),
                        "ancho_seleccionado_de_bobina"=>$this->input->post('ancho_seleccionado_de_bobina',true),
                        "hay_que_comprar_onda"=>$this->input->post('hay_que_comprar_onda',true),
                        "proveedor"=>$this->input->post('proveedor',true),
                        "fecha_estimada_de_entrega"=>$this->input->post('fecha_estimada_de_entrega',true),
                        "total_kilos2"=>$this->input->post('total_kilos2',true),
                        "total_kilos"=>$kilos1,
			"ancho_seleccionado_recomendada"=>$this->input->post('ancho_seleccionado_recomendada',true),                  
                    );
					
                    if($this->input->post('estado',true) == '3')
                    {
                        $this->db->insert("produccion_control_onda_parcial",$data2);
                    }
                    $hayparcial=$this->produccion_model->getParcialControlOndaSuma($this->input->post('id',true));
                    if($this->input->post('total_o_parcial',true) == 'Total' and $hayparcial->sum > 0)
                    {
                        $data1=array
                        (								
                                "estado"=>1,
                                "situacion"=>'Liberada',
                                "fecha_liberada"=>date('Y-m-d H:i:s'),	
                                "fecha_pendiente"=>'0000-00-00',
                                "fecha_activa"=>'0000-00-00',
                                "fecha_orden_cerrada"=>'0000-00-00',	
                        );
			$this->db->update('produccion_control_onda', $data1, array('tipo' => $this->input->post('tipo',true),'id_nodo'=>$this->input->post('id',true)));
                        $data4=array
                        (								
                                "estado"=>1,
                                "situacion"=>'Liberada',
                                "fecha_liberada"=>date('Y-m-d H:i:s'),	
                                "fecha_pendiente"=>'0000-00-00',
                                "fecha_activa"=>'0000-00-00',
                                "fecha_orden_cerrada"=>'0000-00-00',
                        );
			$this->db->update('produccion_control_onda_parcial', $data4, array('tipo' => $this->input->post('tipo',true),'id_nodo'=>$this->input->post('id',true)));
                    }					
		//Liberra Total fin
                    switch($tipo)
                    {
                        case '1':
                            $this->session->set_flashdata('ControllerMessage', 'Se ha guardado el registro exitosamente.');					            redirect(base_url().'produccion/cotizaciones/'.$this->input->post('pagina',true),  301);
                        break;
                         case '2':
                            $this->session->set_flashdata('ControllerMessage', 'Se ha guardado el registro exitosamente.');					            redirect(base_url().'produccion/fast/'.$this->input->post('pagina',true),  301);
                        break;
                    }   
		//redirect(base_url().'produccion/cotizaciones/'.$this->input->post('pagina',true),  301);
                }
            }
            $usuarios=$this->usuarios_model->getUsuarios();
            $this->layout->view("control_onda",compact('usuarios','datos','tipo','pagina','id','control_onda','fotomecanica','fotomecanica2','ordenDeCompra','ing','orden','hoja','tapa','monda','mliner','materialidad_1','materialidad_2','materialidad_3','ancho_bobina_a_usar')); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
        
	}
    /**
     * Confección Molde de troquel
     * */
	 public function confeccion_molde_troquel($tipo=null,$id=null,$pagina=null)
	{
        if($this->session->userdata('id'))
        {
          
            if(!$tipo or !$id){show_404();}
           switch($tipo)
                    {
                        case '1':
                            $datos=$this->cotizaciones_model->getCotizacionPorId($id);
                        break;
                         case '2':
                            $datos=$this->fast_track_model->getFastTrackPorId($id);
                        break;
                    }      
            if(sizeof($datos)==0){show_404();}
            $control=$this->produccion_model->getConfeccionModelTroquelPorTipo($tipo,$id);
            $ing=$this->cotizaciones_model->getCotizacionIngenieriaPorIdCotizacion($id);
            $orden=$this->orden_model->getOrdenesPorCotizacion($id);
            $hoja=$this->cotizaciones_model->getHojaDeCostosPorIdCotizacion($id);
            $fotomecanica=$this->produccion_model->getFotomecanicaPorTipo($tipo,$id);

            $fotomecanica2=$this->cotizaciones_model->getCotizacionFotomecanicaPorIdCotizacion($id);            
            $ordenDeCompra=$this->cotizaciones_model->getOrdenDeCompraPorCotizacion($id);
            
            $tapa = $this->materiales_model->getMaterialesPorNombre($fotomecanica2->materialidad_1);
//            exit(print_r($tapa));
            $monda = $this->materiales_model->getMaterialesPorNombre($fotomecanica2->materialidad_2);
            $mliner = $this->materiales_model->getMaterialesPorNombre($fotomecanica2->materialidad_3);            
            $materialidad_1=$this->materiales_model->getMaterialesPorNombre($fotomecanica2->materialidad_1);
            $materialidad_2=$this->materiales_model->getMaterialesPorNombre($fotomecanica2->materialidad_2);
            $materialidad_3=$this->materiales_model->getMaterialesPorNombre($fotomecanica2->materialidad_3);             
            if($this->input->post())
            {
                if($this->form_validation->run('confeccion_molde_troquel'))
                {
                    if(sizeof($fotomecanica)==0)
                   {
                            $situacion='Pendiente';
                            $fecha_pendiente=date('Y-m-d H:i:s');
                            $fecha_liberada='0000-00-00';
                            $fecha_activa='0000-00-00';
                            $fecha_orden_cerrada='0000-00-00';
                   }else
                   {
                     switch($this->input->post('estado',true))
                     {
                        case '1':
                            $situacion='Liberada';
                            $fecha_pendiente='0000-00-00';
                            $fecha_liberada=date('Y-m-d H:i:s');
                            $fecha_activa='0000-00-00';
                            $fecha_orden_cerrada='0000-00-00';
                        break;
                        case '0':
                            $situacion='Guardar';
                            $fecha_pendiente='0000-00-00';
                            $fecha_liberada='0000-00-00';
                            $fecha_activa= date('Y-m-d H:i:s');
                            $fecha_orden_cerrada='0000-00-00';
                        break;
                        case '2':
                            $situacion='Rechazar';
                            $fecha_pendiente='0000-00-00';
                            $fecha_liberada='0000-00-00';
                            $fecha_activa='0000-00-00';//date('Y-m-d H:i:s');
                            $fecha_orden_cerrada='0000-00-00';
                        break;
						case '':
                            $situacion='Activa';
                            $fecha_pendiente='0000-00-00';
                            $fecha_liberada='0000-00-00';
                            $fecha_activa=date('Y-m-d H:i:s');
                            $fecha_orden_cerrada='0000-00-00';
                        break;
                     }
                   }
                    $data=array
                    (
                        "id_usuario"=>$this->session->userdata('id'),
                        "tipo"=>$this->input->post('tipo',true),
                        "id_nodo"=>$this->input->post('id',true),
                        "id_cliente"=>$this->input->post('id_cliente',true),
                        "orden_de_trabajo"=>$this->input->post('id',true),
                        "descripcion_del_trabajo"=>$this->input->post('descripcion_del_trabajo',true),
                        "hay_madera"=>$this->input->post('hay_madera',true),
                        "hay_cuchillos"=>$this->input->post('hay_cuchillos',true),
                        "calado"=>$this->input->post('calado',true),
                        "confeccion_de_chuchillo"=>$this->input->post('confeccion_de_chuchillo',true),
                        "armado_de_molde"=>$this->input->post('armado_de_molde',true),
                        "molde_listo"=>$this->input->post('molde_listo',true),
                        "existe_pdf_ingenieria"=>$this->input->post("existe_pdf_ingenieria",true),
                        "estado"=>$this->input->post('estado',true),
                        "quien"=>$this->session->userdata('id'),
                        "cuando"=>date("Y-m-d"),
                        "glosa"=>$this->input->post('glosa',true),
                        //"hay_que_hacer_molde"=>$this->input->post("hay_que_hacer_molde",true),
                        "tamano_cuchillo_1"=>$this->input->post('tamano_cuchillo_1',true),
                        "tamano_cuchillo_2"=>$this->input->post('tamano_cuchillo_2',true),
                        "tamano_cuchillo_2"=>$this->input->post('tamano_cuchillo_2',true),
                        "situacion"=>$situacion,
                        "fecha_pendiente"=>$fecha_pendiente,
                        "fecha_liberada"=>$fecha_liberada,
                        "fecha_activa"=>$fecha_activa,
                        "fecha_orden_cerrada"=>$fecha_orden_cerrada,
                        "molde_revision"=>$this->input->post('molde_revision',true),
                        "molde_para_revision"=>$this->input->post('molde_para_revision',true),
                    );
                    if(sizeof($control)==0)
                    {
                        $this->db->insert("produccion_confeccion_molde_troquel",$data);
                        
                    }else
                    {
                        $this->db->update('produccion_confeccion_molde_troquel', $data, array('tipo' => $this->input->post('tipo',true),'id_nodo'=>$this->input->post('id',true)));
                       
                    }    
                    $cuchillocuchillo=$this->input->post('cuchillocuchillo',true);
                    $cuchillocuchillo2=$this->input->post('cuchillocuchillo2',true);
                    if(empty($cuchillocuchillo) and empty($cuchillocuchillo2))
                    {
                        $arrayMolde=array
                        (
                            'cuchillocuchillo'=>$this->input->post('tamano_cuchillo_1',true),
                            'cuchillocuchillo2'=>$this->input->post('tamano_cuchillo_2',true),
                        );
                        $this->db->where('id', $this->input->post('id_molde',true));
                        $this->db->update("moldes_grau",$arrayMolde);
                    }
                    switch($tipo)
                    {
                        case '1':
                            $this->session->set_flashdata('ControllerMessage', 'Se ha guardado el registro exitosamente.');					            redirect(base_url().'produccion/cotizaciones/'.$this->input->post('pagina',true),  301);
                        break;
                         case '2':
                            $this->session->set_flashdata('ControllerMessage', 'Se ha guardado el registro exitosamente.');					            redirect(base_url().'produccion/fast/'.$this->input->post('pagina',true),  301);
                        break;
                    }   
                }
            }
            $this->layout->view("confeccion_molde_troquel",compact('usuarios','datos','tipo','pagina','id','control','ing','fotomecanica','fotomecanica2','orden','ordenDeCompra','hoja','tapa','materialidad_1','hoja','monda','mliner','materialidad_2','materialidad_3','fotomecanica2')); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
        
	}
    
    /**
     * Confección Corte Cartulina
     * */
	 public function corte_cartulina($tipo=null,$id=null,$pagina=null)
	{
        if($this->session->userdata('id'))
        {
            if(!$tipo or !$id){show_404();}
           switch($tipo)
                    {
                        case '1':
                            $datos=$this->cotizaciones_model->getCotizacionPorId($id);
                        break;
                         case '2':
                            $datos=$this->fast_track_model->getFastTrackPorId($id);
                        break;
                    }      
			if(sizeof($datos)==0){show_404();}
                        $control=$this->produccion_model->getCorteCartulinaPorTipo($tipo,$id);
                        $ing=$this->cotizaciones_model->getCotizacionIngenieriaPorIdCotizacion($id);
                        $fotomecanica=$this->produccion_model->getFotomecanicaPorTipo($tipo,$id);
                        $control_cartulina=$this->produccion_model->getControlCartulinaPorTipo($tipo,$id);
                        $control_cartulina_parcial=$this->produccion_model->getControlCartulinaParcialPorTipo($tipo,$id);
                        $bobinado_cartulina=$this->produccion_model->getBobinadoCartulinaPorTipo($tipo,$id);
                        $fotomecanica2=$this->cotizaciones_model->getCotizacionFotomecanicaPorIdCotizacion($id);
                        $orden=$this->orden_model->getOrdenesPorCotizacion($id);
                        $ordenDeCompra=$this->cotizaciones_model->getOrdenDeCompraPorCotizacion($id);
                        $hoja=$this->cotizaciones_model->getHojaDeCostosPorIdCotizacion($id);
//echo $id;

                        $tapa = $this->materiales_model->getMaterialesPorNombre($fotomecanica2->materialidad_1);
                        $monda = $this->materiales_model->getMaterialesPorNombre($fotomecanica2->materialidad_2);
                        $mliner = $this->materiales_model->getMaterialesPorNombre($fotomecanica2->materialidad_3);            
                        $materialidad_1=$this->materiales_model->getMaterialesPorNombre($fotomecanica2->materialidad_1);
                        $materialidad_2=$this->materiales_model->getMaterialesPorNombre($fotomecanica2->materialidad_2);
                        $materialidad_3=$this->materiales_model->getMaterialesPorNombre($fotomecanica2->materialidad_3);                         
                        $total_kilos_control_cartulina=$this->produccion_model->MermasParaProduccion($id,$control_cartulina->ancho_de_bobina,$materialidad_1->gramaje);                        
                        
                        
            if($this->input->post())
            {
                if($this->form_validation->run('corte_cartulina'))
                {
                    if(sizeof($control_cartulina)==0 or sizeof($bobinado_cartulina)==0)
                       {
						   
						   
						   if($this->input->post('estado',true) == 3)
						   {
							   $situacion='Parcial';
                                $fecha_pendiente=date('Y-m-d H:i:s');
                                $fecha_liberada='0000-00-00';
                                $fecha_activa='0000-00-00';
                                $fecha_orden_cerrada='0000-00-00';
							   
						   }else
						   {
                                $situacion='Pendiente';
                                $fecha_pendiente=date('Y-m-d H:i:s');
                                $fecha_liberada='0000-00-00';
                                $fecha_activa='0000-00-00';
                                $fecha_orden_cerrada='0000-00-00';
						   }
                       }else
                       {}
                         switch($this->input->post('estado',true))
                         {
                            case '1':
                                $situacion='Liberada';
                                $fecha_pendiente='0000-00-00';
                                $fecha_liberada=date('Y-m-d H:i:s');
                                $fecha_activa='0000-00-00';
                                $fecha_orden_cerrada='0000-00-00';
                            break;
                            case '0':
                                $situacion='Activa';
                                $fecha_pendiente='0000-00-00';
                                $fecha_liberada='0000-00-00';
                                $fecha_activa=date('Y-m-d H:i:s');
                                $fecha_orden_cerrada='0000-00-00';
                            break;
                            case '2':
                                $situacion='Activa';
                                $fecha_pendiente='0000-00-00';
                                $fecha_liberada='0000-00-00';
                                $fecha_activa=date('Y-m-d H:i:s');
                                $fecha_orden_cerrada='0000-00-00';
                            break;
							 case '':
                                $situacion='Activa';
                                $fecha_pendiente='0000-00-00';
                                $fecha_liberada='0000-00-00';
                                $fecha_activa=date('Y-m-d H:i:s');
                                $fecha_orden_cerrada='0000-00-00';
                            break;
							 case '3':
                                $situacion='Parcial';
                                $fecha_pendiente='0000-00-00';
                                $fecha_liberada='0000-00-00';
                                $fecha_activa=date('Y-m-d H:i:s');
                                $fecha_orden_cerrada='0000-00-00';
                            break;
                         }
                       
                    $data=array
                    (
                        "id_usuario"=>$this->session->userdata('id'),
                        "tipo"=>$this->input->post('tipo',true),
                        "id_nodo"=>$this->input->post('id',true),
                        "id_cliente"=>$this->input->post('id_cliente',true),
                        "orden_de_trabajo"=>$this->input->post('id',true),
                        "descripcion_del_trabajo"=>$this->input->post('descripcion_del_trabajo',true),
                        "ancho_bobina"=>$this->input->post('ancho_bobina',true),
                        "largo_a_cortar"=>$this->input->post('largo_a_cortar',true),
                        "ancho_a_cortar"=>$this->input->post('ancho_a_cortar',true),
                        "total_pliegos_a_cortar"=>$this->input->post('total_pliegos_a_cortar',true),
                        "total_kilos"=>$this->input->post('total_kilos',true),
                        "operador"=>$this->input->post('operador',true),
                        "numero_de_tarimas"=>$this->input->post('numero_de_tarimas',true),
                        "estado"=>$this->input->post('estado',true),
                        "quien"=>$this->session->userdata('id'),
                        "cuando"=>date("Y-m-d"),
                        "glosa"=>$this->input->post('glosa',true),
                        "total_o_parcial"=>$this->input->post('total_o_parcial',true),
                        "situacion"=>$situacion,
                        "fecha_pendiente"=>$fecha_pendiente,
                        "fecha_liberada"=>$fecha_liberada,
                        "fecha_activa"=>$fecha_activa,
                        "fecha_orden_cerrada"=>$fecha_orden_cerrada,
                        "total_pliegos_cortados"=>$this->input->post('total_pliegos_cortados',true),
                        "ancho_realmente_cortado"=>$this->input->post('ancho_realmente_cortado',true),
                        "largo_realmente_cortado"=>$this->input->post('largo_realmente_cortado',true),
                        "can_despacho_1"=>$this->input->post('can_despacho_1',true),
                        "gramaje_tapa_realmente_cortado"=>$this->input->post('gramaje_tapa_realmente_cortado',true),
                    );
                    if(sizeof($control)==0)
                    {
                        $this->db->insert("produccion_corte_cartulina",$data);
                        
                    }else
                    {
                        $this->db->update('produccion_corte_cartulina', $data, array('tipo' => $this->input->post('tipo',true),'id_nodo'=>$this->input->post('id',true)));
                       
                    }    
					
					
							//Parcial				
					
					$data2=array
                    (              
                    "id_usuario"=>$this->session->userdata('id'),
                        "tipo"=>$this->input->post('tipo',true),
                        "id_nodo"=>$this->input->post('id',true),
                        "id_cliente"=>$this->input->post('id_cliente',true),
                        "orden_de_trabajo"=>$this->input->post('id',true),
                        "descripcion_del_trabajo"=>$this->input->post('descripcion_del_trabajo',true),
                        "ancho_bobina"=>$this->input->post('ancho_bobina',true),
                        "largo_a_cortar"=>$this->input->post('largo_a_cortar',true),
                        "ancho_a_cortar"=>$this->input->post('ancho_a_cortar',true),
                        "total_pliegos_a_cortar"=>$this->input->post('total_pliegos_a_cortar',true),
                        "total_kilos"=>$this->input->post('total_kilos',true),
                        "operador"=>$this->input->post('operador',true),
                        "numero_de_tarimas"=>$this->input->post('numero_de_tarimas',true),
                        "estado"=>$this->input->post('estado',true),
                        "quien"=>$this->session->userdata('id'),
                        "cuando"=>date("Y-m-d"),
                        "glosa"=>$this->input->post('glosa',true),
                        "total_o_parcial"=>$this->input->post('total_o_parcial',true),
                        "situacion"=>$situacion,
                        "fecha_pendiente"=>$fecha_pendiente,
                        "fecha_liberada"=>$fecha_liberada,
                        "fecha_activa"=>$fecha_activa,
                        "fecha_orden_cerrada"=>$fecha_orden_cerrada,
                        "total_pliegos_cortados"=>$this->input->post('total_pliegos_cortados',true),
                        "ancho_realmente_cortado"=>$this->input->post('ancho_realmente_cortado',true),
                        "largo_realmente_cortado"=>$this->input->post('largo_realmente_cortado',true),
                        "can_despacho_1"=>$this->input->post('can_despacho_1',true),

                    );
					
						 if($this->input->post('estado',true) == '3')
						 {
								 $this->db->insert("produccion_corte_cartulina_parcial",$data);
						
						 }
					//Parcial Fin
					
					
					
                    switch($tipo)
                    {
                        case '1':
                            $this->session->set_flashdata('ControllerMessage', 'Se ha guardado el registro exitosamente.');					            redirect(base_url().'produccion/cotizaciones/'.$this->input->post('pagina',true),  301);
                        break;
                         case '2':
                            $this->session->set_flashdata('ControllerMessage', 'Se ha guardado el registro exitosamente.');					            redirect(base_url().'produccion/fast/'.$this->input->post('pagina',true),  301);
                        break;
                    }   
                }
            }
            $usuarios=$this->usuarios_model->getUsuariosPorTipo(8);
            $this->layout->view("corte_cartulina",compact('usuarios','datos','tipo','pagina','id','control','ing','fotomecanica','control_cartulina','bobinado_cartulina','fotomecanica2','ordenDeCompra','orden','hoja','control_cartulina_parcial','tapa','monda','mliner','materialidad_1','materialidad_2','materialidad_3','total_kilos_control_cartulina')); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
        
	}
    /**
     * Corrugado
     * */
	 public function corrugado($tipo=null,$id=null,$pagina=null)
	{
        if($this->session->userdata('id'))
        {
          
            if(!$tipo or !$id){show_404();}
           switch($tipo)
                    {
                        case '1':
                            $datos=$this->cotizaciones_model->getCotizacionPorId($id);
                        break;
                         case '2':
                            $datos=$this->fast_track_model->getFastTrackPorId($id);
                        break;
                    }      
			if(sizeof($datos)==0){show_404();}
            $control=$this->produccion_model->getCorrugadoPorTipo($tipo,$id);
            $ing=$this->cotizaciones_model->getCotizacionIngenieriaPorIdCotizacion($id);
            $fotomecanica=$this->cotizaciones_model->getCotizacionFotomecanicaPorIdCotizacion($id);
            $fotomecanica2=$this->produccion_model->getFotomecanicaPorTipo($tipo,$id);
            $hoja=$this->cotizaciones_model->getHojaDeCostosPorIdCotizacion($id);
            $ordenDeCompra=$this->cotizaciones_model->getOrdenDeCompraPorCotizacion($id);
            //print_r($fotomecanica);exit;
            $orden=$this->orden_model->getOrdenesPorCotizacion($id);
            $confeccion_molde_troquel=$this->produccion_model->getConfeccionModelTroquelPorTipo($tipo,$id);
            $bobinado_onda=$this->produccion_model->getBobinadoCartulinaOndaPorTipo($tipo,$id);
            $bobinado_liner=$this->produccion_model->getBobinadoCartulinaLinerPorTipo($tipo,$id);
            $control_papel=$this->produccion_model->getControlControlPapelPorTipo($tipo,$id);
            $imprenta_produccion=$this->produccion_model->getImprentaProduccionPorTipo($tipo,$id);
            $corte_cartulina=$this->produccion_model->getCorteCartulinaPorTipo($tipo,$id);
            $control_cartulina=$this->produccion_model->getControlCartulinaPorTipo($tipo,$id);
            
            
            
            /*materialidad*/
            $tapa = $this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_1);
            $monda = $this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_2);
            $mliner = $this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_3);            
            $materialidad_1=$this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_1);
            $materialidad_2=$this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_2);
            $materialidad_3=$this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_3);  
            $total_kilos_control_cartulina=$this->produccion_model->MermasParaProduccion($id,$control_cartulina->ancho_de_bobina,$materialidad_1->gramaje);                        

            $pinza = $this->produccion_model->getLargoDePinzas($id);
            
            if($this->input->post())
            {
                if($this->form_validation->run('produccion_corrugado'))
                {
                     if(sizeof($control_papel)==0 or sizeof($bobinado_onda)==0 or sizeof($bobinado_onda)==0)
                   {
                            $situacion='Pendiente';
                            $fecha_pendiente=date('Y-m-d H:i:s');
                            $fecha_liberada='0000-00-00';
                            $fecha_activa='0000-00-00';
                            $fecha_orden_cerrada='0000-00-00';
                   }else
                   {}
                     switch($this->input->post('estado',true))
                     {
                        case '1':
                            $situacion='Liberada';
                            $fecha_pendiente='0000-00-00';
                            $fecha_liberada=date('Y-m-d H:i:s');
                            $fecha_activa='0000-00-00';
                            $fecha_orden_cerrada='0000-00-00';
                        break;
                        case '0':
                            $situacion='Activa';
                            $fecha_pendiente='0000-00-00';
                            $fecha_liberada='0000-00-00';
                            $fecha_activa=date('Y-m-d H:i:s');
                            $fecha_orden_cerrada='0000-00-00';
                        break;
                        case '2':
                            $situacion='Activa';
                            $fecha_pendiente='0000-00-00';
                            $fecha_liberada='0000-00-00';
                            $fecha_activa=date('Y-m-d H:i:s');
                            $fecha_orden_cerrada='0000-00-00';
                        break;
						case '3':
                            $situacion='Parcial';
                            $fecha_pendiente='0000-00-00';
                            $fecha_liberada='0000-00-00';
                            $fecha_activa=date('Y-m-d H:i:s');
                            $fecha_orden_cerrada='0000-00-00';
                        break;
                     }
                   
                    $data=array
                    (
                        "id_usuario"=>$this->session->userdata('id'),
                        "tipo"=>$this->input->post('tipo',true),
                        "id_nodo"=>$this->input->post('id',true),
                        "id_cliente"=>$this->input->post('id_cliente',true),
                        "orden_de_trabajo"=>$this->input->post('id',true),
                        "descripcion_del_trabajo"=>$this->input->post('descripcion_del_trabajo',true),
                        "datos_tecnicos"=>$fotomecanica->datos_tecnicos,
                        "onda_a_usar"=>$this->input->post('onda_a_usar',true),
                        "ancho_de_onda_a_usar"=>$this->input->post('ancho_de_onda_a_usar',true),
                        "liner_a_usar"=>$this->input->post('liner_a_usar',true),
                        "ancho_de_liner_a_usar"=>$this->input->post('ancho_de_liner_a_usar',true),
                        "tamano_a_fabricar"=>$this->input->post('tamano_a_fabricar',true),
                        "tamano_1"=>$this->input->post('tamano_1',true),
                        "tamano_2"=>$this->input->post('tamano_2',true),
                        "tamano_cuchillo_1"=>$this->input->post('tamano_cuchillo_1',true),
                        "tamano_cuchillo_2"=>$this->input->post('tamano_cuchillo_2',true),
                        "pinza"=>$this->input->post('pinza',true),
                        "reverso_a_usar"=>$this->input->post('reverso_a_usar',true),
                        "total_pliegos_a_fabricar"=>$this->input->post('total_pliegos_a_fabricar',true),
                        "operador"=>$this->input->post('operador',true),
                        "ayudante_1"=>$this->input->post('ayudante_1',true),
                        "ayudante_2"=>$this->input->post('ayudante_2',true),
                        "ayudante_3"=>$this->input->post('ayudante_3',true),
                        "total_pliegos_producidos"=>$this->input->post('total_pliegos_producidos',true),
                        "total_tarimas_producidas"=>$this->input->post('total_tarimas_producidas',true),
                        "estado"=>$this->input->post('estado',true),
                        "quien"=>$this->session->userdata('id'),
                        "cuando"=>date("Y-m-d"),
                        "glosa"=>$this->input->post('glosa',true),
                        "ancho_a_corrugar"=>$this->input->post('ancho_a_corrugar',true),
                        "situacion"=>$situacion,
                        "fecha_pendiente"=>$fecha_pendiente,
                        "fecha_liberada"=>$fecha_liberada,
                        "fecha_activa"=>$fecha_activa,
                        "fecha_orden_cerrada"=>$fecha_orden_cerrada,
                        "total_o_parcial"=>$this->input->post('total_o_parcial',true),
                        "can_despacho_1"=>$this->input->post('can_despacho_1',true),
                        "can_despacho_2"=>$this->input->post('can_despacho_2',true),
                        "can_despacho_3"=>$this->input->post('can_despacho_3',true),
                    );
                    if(sizeof($control)==0)
                    {
                        $this->db->insert("produccion_corrugado",$data);
                        
                    }else
                    {
                        $this->db->update('produccion_corrugado', $data, array('tipo' => $this->input->post('tipo',true),'id_nodo'=>$this->input->post('id',true)));
                       
                    }    
					
					//Parcial				
					
					$data2=array
                    (              
                  
                        "id_usuario"=>$this->session->userdata('id'),
                        "tipo"=>$this->input->post('tipo',true),
                        "id_nodo"=>$this->input->post('id',true),
                        "id_cliente"=>$this->input->post('id_cliente',true),
                        "orden_de_trabajo"=>$this->input->post('id',true),
                        "descripcion_del_trabajo"=>$this->input->post('descripcion_del_trabajo',true),
                        "datos_tecnicos"=>$fotomecanica->datos_tecnicos,
                        "onda_a_usar"=>$this->input->post('onda_a_usar',true),
                        "ancho_de_onda_a_usar"=>$this->input->post('ancho_de_onda_a_usar',true),
                        "liner_a_usar"=>$this->input->post('liner_a_usar',true),
                        "ancho_de_liner_a_usar"=>$this->input->post('ancho_de_liner_a_usar',true),
                        "tamano_a_fabricar"=>$this->input->post('tamano_a_fabricar',true),
                        "tamano_1"=>$this->input->post('tamano_1',true),
                        "tamano_2"=>$this->input->post('tamano_2',true),
                        "tamano_cuchillo_1"=>$this->input->post('tamano_cuchillo_1',true),
                        "tamano_cuchillo_2"=>$this->input->post('tamano_cuchillo_2',true),
                        "pinza"=>$this->input->post('pinza',true),
                        "reverso_a_usar"=>$this->input->post('reverso_a_usar',true),
                        "total_pliegos_a_fabricar"=>$this->input->post('total_pliegos_a_fabricar',true),
                        "operador"=>$this->input->post('operador',true),
                        "ayudante_1"=>$this->input->post('ayudante_1',true),
                        "ayudante_2"=>$this->input->post('ayudante_2',true),
                        "ayudante_3"=>$this->input->post('ayudante_3',true),
                        "total_pliegos_producidos"=>$this->input->post('total_pliegos_producidos',true),
                        "total_tarimas_producidas"=>$this->input->post('total_tarimas_producidas',true),
                        "estado"=>$this->input->post('estado',true),
                        "quien"=>$this->session->userdata('id'),
                        "cuando"=>date("Y-m-d"),
                        "glosa"=>$this->input->post('glosa',true),
                        "ancho_a_corrugar"=>$this->input->post('ancho_a_corrugar',true),
                        "situacion"=>$situacion,
                        "fecha_pendiente"=>$fecha_pendiente,
                        "fecha_liberada"=>$fecha_liberada,
                        "fecha_activa"=>$fecha_activa,
                        "fecha_orden_cerrada"=>$fecha_orden_cerrada,
                        "total_o_parcial"=>$this->input->post('total_o_parcial',true),
                        "can_despacho_1"=>$this->input->post('can_despacho_1',true),
                        "can_despacho_2"=>$this->input->post('can_despacho_2',true),
                        "can_despacho_3"=>$this->input->post('can_despacho_3',true),
                    );
					
						 if($this->input->post('estado',true) == '3')
						 {
								$this->db->insert("produccion_corrugado_parcial",$data);
						
						 }
					//Parcial Fin
					
					
                    switch($tipo)
                    {
                        case '1':
                            $this->session->set_flashdata('ControllerMessage', 'Se ha guardado el registro exitosamente.');					            redirect(base_url().'produccion/cotizaciones/'.$this->input->post('pagina',true),  301);
                        break;
                         case '2':
                            $this->session->set_flashdata('ControllerMessage', 'Se ha guardado el registro exitosamente.');					            redirect(base_url().'produccion/fast/'.$this->input->post('pagina',true),  301);
                        break;
                    }   
                }
            }
            $usuarios2=$this->usuarios_model->getUsuariosPorTipo(8);
            $usuarios=$this->usuarios_model->getUsuariosPorTipo(9);
            $this->layout->view("corrugado",compact('usuarios','datos','tipo','pagina','id','control','ing','usuarios2','orden','fotomecanica','confeccion_molde_troquel','fotomecanica2','ordenDeCompra','hoja','bobinado_liner','bobinado_onda','control_papel','imprenta_produccion','tapa','materialidad_1','hoja','monda','mliner','materialidad_2','materialidad_3','corte_cartulina','control_cartulina','total_kilos_control_cartulina','pinza')); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
        
	}
    /**
     * Imprenta Producción
     * */
	 public function imprenta_produccion($tipo=null,$id=null,$pagina=null)
	{
        if($this->session->userdata('id'))
        {
          
            if(!$tipo or !$id){show_404();}
           switch($tipo)
                    {
                        case '1':
                            $datos=$this->cotizaciones_model->getCotizacionPorId($id);
                        break;
                         case '2':
                            $datos=$this->fast_track_model->getFastTrackPorId($id);
                        break;
                    }      
                    if(sizeof($datos)==0){show_404();}
                    $control=$this->produccion_model->getImprentaProduccionPorTipo($tipo,$id);
                    $ing=$this->cotizaciones_model->getCotizacionIngenieriaPorIdCotizacion($id);
                    $fotomecanica=$this->cotizaciones_model->getCotizacionFotomecanicaPorIdCotizacion($id);
                    $fotomecanica2=$this->produccion_model->getFotomecanicaPorTipo($tipo,$id);

                    $cotizacion=$this->cotizaciones_model->getCotizacionPorId($id);
                    $hoja=$this->cotizaciones_model->getHojaDeCostosPorIdCotizacion($id);
                    $emplacado=$this->produccion_model->getEmplacadoPorTipo($tipo,$id);
                    $corte_cartulina=$this->produccion_model->getCorteCartulinaPorTipo($tipo,$id);
                    $ordenDeCompra=$this->cotizaciones_model->getOrdenDeCompraPorCotizacion($id);
                    $orden=$this->orden_model->getOrdenesPorCotizacion($id);
                    $imprenta_programacion=$this->produccion_model->getImprentaProgramacionPorTipo($tipo,$id);
                    $control_cartulina=$this->produccion_model->getControlCartulinaPorTipo($tipo,$id);
                    $confeccion_molde_troquel=$this->produccion_model->getConfeccionModelTroquelPorTipo($tipo,$id);
                    /*materialidad*/
                    $tapa = $this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_1);

                    $monda = $this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_2);
                    $mliner = $this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_3);            
                    $materialidad_1=$this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_1);
                    $materialidad_2=$this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_2);
                    $materialidad_3=$this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_3);            
                    $total_kilos_control_cartulina=$this->produccion_model->MermasParaProduccion($id,$control_cartulina->ancho_de_bobina,$materialidad_1->gramaje);                        

                    $pinza = $this->produccion_model->getLargoDePinzas($id);
            
            if($this->input->post())
            {
                if($this->form_validation->run('impresion_produccion'))
                {
                    if(sizeof($corte_cartulina)==0 or sizeof($imprenta_programacion)==0 or sizeof($control_cartulina)==0)
                   {
                            $situacion='Pendiente';
                            $fecha_pendiente=date('Y-m-d H:i:s');
                            $fecha_liberada='0000-00-00';
                            $fecha_activa='0000-00-00';
                            $fecha_orden_cerrada='0000-00-00';
                   }else
                   {}
                     switch($control->estado)
                     {
                        case '1':
                            $situacion='Liberada';
                            $fecha_pendiente='0000-00-00';
                            $fecha_liberada=date('Y-m-d H:i:s');
                            $fecha_activa='0000-00-00';
                            $fecha_orden_cerrada='0000-00-00';
                        break;
                        case '0':
                            $situacion='Activa';
                            $fecha_pendiente='0000-00-00';
                            $fecha_liberada='0000-00-00';
                            $fecha_activa=date('Y-m-d H:i:s');
                            $fecha_orden_cerrada='0000-00-00';
                        break;
                        case '2':
                            $situacion='Activa';
                            $fecha_pendiente='0000-00-00';
                            $fecha_liberada='0000-00-00';
                            $fecha_activa=date('Y-m-d H:i:s');
                            $fecha_orden_cerrada='0000-00-00';
                        break;
                        default:
                            $situacion='Activa';
                            $fecha_pendiente='0000-00-00';
                            $fecha_liberada='0000-00-00';
                            $fecha_activa=date('Y-m-d H:i:s');
                            $fecha_orden_cerrada='0000-00-00';
                        break;
						case '':
                                $situacion='Activa';
                                $fecha_pendiente='0000-00-00';
                                $fecha_liberada='0000-00-00';
                                $fecha_activa=date('Y-m-d H:i:s');
                                $fecha_orden_cerrada='0000-00-00';
                            break;
                            case '3':
                                $situacion='Parcial';
                                $fecha_pendiente='0000-00-00';
                                $fecha_liberada='0000-00-00';
                                $fecha_activa=date('Y-m-d H:i:s');
                                $fecha_orden_cerrada='0000-00-00';
                            break;
                        
                     }
                   
                    $data=array
                    (
                        "id_usuario"=>$this->session->userdata('id'),
                        "tipo"=>$this->input->post('tipo',true),
                        "id_nodo"=>$this->input->post('id',true),
                        "id_cliente"=>$this->input->post('id_cliente',true),
                        "orden_de_trabajo"=>$this->input->post('id',true),
                        "descripcion_del_trabajo"=>$this->input->post('descripcion_del_trabajo',true),
                        "colores"=>$this->input->post('colores',true),
                        "colores_metalicos"=>$this->input->post('colores_metalicos',true),
                        "tamano_a_imprimir_1"=>$this->input->post('tamano_a_imprimir_1',true),
                        "tamano_a_imprimir_2"=>$this->input->post('tamano_a_imprimir_2',true),
                        "tipo_cartulina"=>$this->input->post('tipo_cartulina',true),
                        "gramaje"=>$this->input->post('gramaje',true),
                        "barniz"=>$this->input->post('barniz',true),
                        "laca"=>$this->input->post('laca',true),
                        "cantidad_a_imprimir"=>$this->input->post('cantidad_a_imprimir',true),
                        "maestro"=>$this->input->post('maestro',true),
                        "ayudante_1"=>$this->input->post('ayudante_1',true),
                        "ayudante_2"=>$this->input->post('ayudante_2',true),
                        "ayudante_3"=>$this->input->post('ayudante_3',true),
                        "total_pliegos_buenos"=>$this->input->post('total_pliegos_buenos',true),
                        "total_merma"=>$this->input->post('total_merma',true),
                        "largo_de_pinza"=>$this->input->post('largo_de_pinza',true),
//                        "impresion_para_trabajo"=>$this->input->post('impresion_para_trabajo',true),
                        "estado"=>$this->input->post('estado',true),
                        "quien"=>$this->session->userdata('id'),
                        "cuando"=>date("Y-m-d"),
                        "glosa"=>$this->input->post('glosa',true),
//                        "tamano_real_cartulina"=>$this->input->post('tamano_real_cartulina',true),
                        "gato"=>$this->input->post('gato',true),
                        "total_o_parcial"=>$this->input->post('total_o_parcial',true),
                        "situacion"=>$situacion,
                        "fecha_pendiente"=>$fecha_pendiente,
                        "fecha_liberada"=>$fecha_liberada,
                        "fecha_activa"=>$fecha_activa,
                        "fecha_orden_cerrada"=>$fecha_orden_cerrada,
			"can_parcial"=>$this->input->post('can_parcial',true),
			"comentarios_produccion"=>$this->input->post('comentarios_produccion',true),    
			"largo_de_pinza_gato"=>$this->input->post('largo_de_pinza_gato',true),   
                        "largo_de_pinza_por_cola"=>$this->input->post('largo_de_pinza_por_cola',true),   
			"largo_de_pinza_gato_derecho"=>$this->input->post('largo_de_pinza_gato_derecho',true),   
			"largo_de_pinza_gato_izquierdo"=>$this->input->post('largo_de_pinza_gato_izquierdo',true),   
                        "tiempo_de_arreglo"=>$this->input->post('tiempo_de_arreglo',true),
                        "tiempo_de_produccion"=>$this->input->post('tiempo_de_produccion',true),
                        "tiempo_de_preparacion"=>$this->input->post('tiempo_de_preparacion',true),
                        "tiempo_de_mantencion"=>$this->input->post('tiempo_de_mantencion',true),    
                        "formula_de_tinta"=>$this->input->post('formula_de_tinta',true),
                        "cuerpo1"=>$this->input->post('cuerpo1',true),    
                        "cuerpo2"=>$this->input->post('cuerpo2',true),
                        "cuerpo3"=>$this->input->post('cuerpo3',true),   
                        "cuerpo4"=>$this->input->post('cuerpo4',true),    
                        "cuerpo5"=>$this->input->post('cuerpo5',true),
                        "cuerpo6"=>$this->input->post('cuerpo6',true),
                        "total_pliegos_malos"=>$this->input->post('total_pliegos_malos',true),                        
                    );
                    if(sizeof($control)==0)
                    {
                        $this->db->insert("produccion_imprenta_produccion",$data);
                        
                    }else
                    {
                        $this->db->update('produccion_imprenta_produccion', $data, array('tipo' => $this->input->post('tipo',true),'id_nodo'=>$this->input->post('id',true)));
                       
                    }    
					
					
					
					//Parcial				
					
			$data2=array
                    (              
                   "id_usuario"=>$this->session->userdata('id'),
                        "tipo"=>$this->input->post('tipo',true),
                        "id_nodo"=>$this->input->post('id',true),
                        "id_cliente"=>$this->input->post('id_cliente',true),
                        "orden_de_trabajo"=>$this->input->post('id',true),
                        "descripcion_del_trabajo"=>$this->input->post('descripcion_del_trabajo',true),
                        "colores"=>$this->input->post('colores',true),
                        "colores_metalicos"=>$this->input->post('colores_metalicos',true),
                        "tamano_a_imprimir_1"=>$this->input->post('tamano_a_imprimir_1',true),
                        "tamano_a_imprimir_2"=>$this->input->post('tamano_a_imprimir_2',true),
                        "tipo_cartulina"=>$this->input->post('tipo_cartulina',true),
                        "gramaje"=>$this->input->post('gramaje',true),
                        "barniz"=>$this->input->post('barniz',true),
                        "laca"=>$this->input->post('laca',true),
                        "cantidad_a_imprimir"=>$this->input->post('cantidad_a_imprimir',true),
                        "maestro"=>$this->input->post('maestro',true),
                        "ayudante_1"=>$this->input->post('ayudante_1',true),
                        "ayudante_2"=>$this->input->post('ayudante_2',true),
                        "ayudante_3"=>$this->input->post('ayudante_3',true),
                        "total_pliegos_buenos"=>$this->input->post('total_pliegos_buenos',true),
                        "total_merma"=>$this->input->post('total_merma',true),
                        "largo_de_pinza"=>$this->input->post('largo_de_pinza',true),
//                        "impresion_para_trabajo"=>$this->input->post('impresion_para_trabajo',true),
                        "estado"=>$this->input->post('estado',true),
                        "quien"=>$this->session->userdata('id'),
                        "cuando"=>date("Y-m-d"),
                        "glosa"=>$this->input->post('glosa',true),
                        "tamano_real_cartulina"=>0,                                            
//                        "tamano_real_cartulina"=>$this->input->post('tamano_real_cartulina',true),
                        "gato"=>$this->input->post('gato',true),
                        "total_o_parcial"=>$this->input->post('total_o_parcial',true),
                        "situacion"=>$situacion,
                        "fecha_pendiente"=>$fecha_pendiente,
                        "fecha_liberada"=>$fecha_liberada,
                        "fecha_activa"=>$fecha_activa,
                        "fecha_orden_cerrada"=>$fecha_orden_cerrada,
			"can_parcial"=>$this->input->post('can_parcial',true),
                    );
					
                    if($this->input->post('estado',true) == '3')
                    {
                      $this->db->insert("produccion_imprenta_produccion_parcial",$data);
                    }
                    switch($tipo)
                    {
                        case '1':
                            $this->session->set_flashdata('ControllerMessage', 'Se ha guardado el registro exitosamente.');					            redirect(base_url().'produccion/cotizaciones/'.$this->input->post('pagina',true),  301);
                        break;
                         case '2':
                            $this->session->set_flashdata('ControllerMessage', 'Se ha guardado el registro exitosamente.');					            redirect(base_url().'produccion/fast/'.$this->input->post('pagina',true),  301);
                        break;
                    }   
                }
            }
            $usuarios=$this->usuarios_model->getUsuariosPorTipo(9);
            $usuarios2=$this->usuarios_model->getUsuariosPorTipo(10);
            $this->layout->view("imprenta_produccion",compact('usuarios','datos','tipo','pagina','id','control','ing','fotomecanica','cotizacion','hoja','usuarios2','emplacado','corte_cartulina','fotomecanica2','ordenDeCompra','orden','imprenta_programacion','control_cartulina','confeccion_molde_troquel','tapa','materialidad_1','hoja','monda','mliner','materialidad_2','materialidad_3','total_kilos_control_cartulina','pinza')); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
        
	}
    /**
     * Servicios post imprenta
     * */
	 public function servicios_post_imprenta($tipo=null,$id=null,$pagina=null)
	{
        if($this->session->userdata('id'))
        {
          
            if(!$tipo or !$id){show_404();}
           switch($tipo)
            {
                case '1':
                    $datos=$this->cotizaciones_model->getCotizacionPorId($id);
                break;
                 case '2':
                    $datos=$this->fast_track_model->getFastTrackPorId($id);
                break;
            }      
            if(sizeof($datos)==0){show_404();}
            $control=$this->produccion_model->getServiciosPorImprentaPorTipo($tipo,$id);
            $ing=$this->cotizaciones_model->getCotizacionIngenieriaPorIdCotizacion($id);
            $fotomecanica=$this->cotizaciones_model->getCotizacionFotomecanicaPorIdCotizacion($id);
            $ordenes_compras_trabajos_externos=$this->acabados_model->get_ordenes_compras_trabajos_externos($id);
            
            
            $fotomecanica2=$this->produccion_model->getFotomecanicaPorTipo($tipo,$id);
            $cotizacion=$this->cotizaciones_model->getCotizacionPorId($id);
            $hoja=$this->cotizaciones_model->getHojaDeCostosPorIdCotizacion($id);
            $ordenDeCompra=$this->cotizaciones_model->getOrdenDeCompraPorCotizacion($id);
            $orden=$this->orden_model->getOrdenesPorCotizacion($id);
            $imprenta_produccion=$this->produccion_model->getImprentaProduccionPorTipo($tipo,$id);
            $corte_cartulina=$this->produccion_model->getCorteCartulinaPorTipo($tipo,$id);
            $imprenta_programacion=$this->produccion_model->getImprentaProgramacionPorTipo($tipo,$id);
            
            $confeccion_molde_troquel=$this->produccion_model->getConfeccionModelTroquelPorTipo($tipo,$id);
            /*materialidad*/
            $tapa = $this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_1);
            $monda = $this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_2);
            $mliner = $this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_3);            
            $materialidad_1=$this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_1);
            $materialidad_2=$this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_2);
            $materialidad_3=$this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_3);            
            $total_kilos_control_cartulina=$this->produccion_model->MermasParaProduccion($id,$control_cartulina->ancho_de_bobina,$materialidad_1->gramaje);                        
            $externos=$this->acabados_model->getAcabados2PorTipo("Externo");
            $proveedores=$this->proveedores_model->getProveedores();    
            $usuarios_orden_compra=$this->usuarios_model->getUsuariosPorTipo(8);      
//            exit(print_r($usuarios));
            
                        
            
            if($this->input->post())
            {
                if($this->form_validation->run('servicios_post_imprenta'))
                {
                    if(sizeof($imprenta_produccion)==0)
                   {
                            $situacion='Pendiente';
                            $fecha_pendiente=date('Y-m-d H:i:s');
                            $fecha_liberada='0000-00-00';
                            $fecha_activa='0000-00-00';
                            $fecha_orden_cerrada='0000-00-00';
                   }else
                   {}
                     switch($this->input->post('estado',true))
                     {
                        case '1':
                            $situacion='Liberada';
                            $fecha_pendiente='0000-00-00';
                            $fecha_liberada=date('Y-m-d H:i:s');
                            $fecha_activa='0000-00-00';
                            $fecha_orden_cerrada='0000-00-00';
                        break;
                        case '0':
                            $situacion='Activa';
                            $fecha_pendiente='0000-00-00';
                            $fecha_liberada='0000-00-00';
                            $fecha_activa=date('Y-m-d H:i:s');
                            $fecha_orden_cerrada='0000-00-00';
                        break;
                        case '2':
                            $situacion='Activa';
                            $fecha_pendiente='0000-00-00';
                            $fecha_liberada='0000-00-00';
                            $fecha_activa=date('Y-m-d H:i:s');
                            $fecha_orden_cerrada='0000-00-00';
                        break;
                        default:
                            $situacion='Activa';
                            $fecha_pendiente='0000-00-00';
                            $fecha_liberada='0000-00-00';
                            $fecha_activa=date('Y-m-d H:i:s');
                            $fecha_orden_cerrada='0000-00-00';
                        break;
			case '':
                                $situacion='Activa';
                                $fecha_pendiente='0000-00-00';
                                $fecha_liberada='0000-00-00';
                                $fecha_activa=date('Y-m-d H:i:s');
                                $fecha_orden_cerrada='0000-00-00';
                        break;
			case '3':
                                $situacion='Parcial';
                                $fecha_pendiente='0000-00-00';
                                $fecha_liberada='0000-00-00';
                                $fecha_activa=date('Y-m-d H:i:s');
                                $fecha_orden_cerrada='0000-00-00';
                        break;
                        
                     }
                   
                    $data=array
                    (
                        "id_usuario"=>$this->session->userdata('id'),
                        "tipo"=>$this->input->post('tipo',true),
                        "id_nodo"=>$this->input->post('id',true),
                        "id_cliente"=>$this->input->post('id_cliente',true),
                        "orden_de_trabajo"=>$this->input->post('id',true),
                        "descripcion_del_trabajo"=>$this->input->post('descripcion_del_trabajo',true),
                        "si_no"=>$this->input->post('si_no',true),
                        "descripcion_trabajo_externo"=>$this->input->post('descripcion_trabajo_externo',true),
                        "proveedor"=>$this->input->post('proveedor',true),
                        "direccion_proveedor"=>$this->input->post('direccion_proveedor',true),
                        "horario_proveedor"=>$this->input->post('horario_proveedor',true),
                        "despachador"=>$this->input->post('despachador',true),
                        "camion_de_despacho"=>$this->input->post('camion_de_despacho',true),
                        "chofer"=>$this->input->post('chofer',true),
                        "estado"=>$this->input->post('estado',true),
                        "quien"=>$this->session->userdata('id'),
                        "cuando"=>date("Y-m-d"),
                        "glosa"=>$this->input->post('glosa',true),
                        "situacion"=>$situacion,
                        "fecha_pendiente"=>$fecha_pendiente,
                        "fecha_liberada"=>$fecha_liberada,
                        "fecha_activa"=>$fecha_activa,
                        "fecha_orden_cerrada"=>$fecha_orden_cerrada,
                        "tamano_cartulina"=>$this->input->post('tamano_cartulina',true),
                        "cantidad_de_pliegos"=>$this->input->post('cantidad_de_pliegos',true),
                        "instrucciones_de_despacho"=>$this->input->post('instrucciones_de_despacho',true),
                        "fecha_recepcion_pedido"=>$this->input->post('fecha_recepcion_pedido',true),
                        "total_o_parcial"=>$this->input->post('total_o_parcial',true),
                        "can_despacho_1"=>$this->input->post('can_despacho_1',true),
                        "can_despacho_2"=>$this->input->post('can_despacho_2',true),
                        "can_despacho_3"=>$this->input->post('can_despacho_3',true),
                        "id_proveedor_acabado_1"=>$this->input->post('id_proveedor_acabado_1',true),
                        "id_proveedor_acabado_2"=>$this->input->post('id_proveedor_acabado_2',true),
                        "id_proveedor_acabado_3"=>$this->input->post('id_proveedor_acabado_3',true),   
                        "comentarios_acabados_1"=>$this->input->post('comentarios_acabados_1',true),
                        "comentarios_acabados_2"=>$this->input->post('comentarios_acabados_2',true),
                        "comentarios_acabados_3"=>$this->input->post('comentarios_acabados_3',true),   
                    );
                    if(sizeof($control)==0)
                    {
                        $this->db->insert("produccion_servicios_post_imprenta",$data);
                        
                    }else
                    {
                        $this->db->update('produccion_servicios_post_imprenta', $data, array('tipo' => $this->input->post('tipo',true),'id_nodo'=>$this->input->post('id',true)));
                       
                    }    
					
					//Parcial				
					
                    $data2=array
                    (              
			"id_usuario"=>$this->session->userdata('id'),
                        "tipo"=>$this->input->post('tipo',true),
                        "id_nodo"=>$this->input->post('id',true),
                        "id_cliente"=>$this->input->post('id_cliente',true),
                        "orden_de_trabajo"=>$this->input->post('id',true),
                        "descripcion_del_trabajo"=>$this->input->post('descripcion_del_trabajo',true),
                        "si_no"=>$this->input->post('si_no',true),
                        "descripcion_trabajo_externo"=>$this->input->post('descripcion_trabajo_externo',true),
                        "proveedor"=>$this->input->post('proveedor',true),
                        "direccion_proveedor"=>$this->input->post('direccion_proveedor',true),
                        "horario_proveedor"=>$this->input->post('horario_proveedor',true),
                        "despachador"=>$this->input->post('despachador',true),
                        "camion_de_despacho"=>$this->input->post('camion_de_despacho',true),
                        "chofer"=>$this->input->post('chofer',true),
                        "estado"=>$this->input->post('estado',true),
                        "quien"=>$this->session->userdata('id'),
                        "cuando"=>date("Y-m-d"),
                        "glosa"=>$this->input->post('glosa',true),
                        "situacion"=>$situacion,
                        "fecha_pendiente"=>$fecha_pendiente,
                        "fecha_liberada"=>$fecha_liberada,
                        "fecha_activa"=>$fecha_activa,
                        "fecha_orden_cerrada"=>$fecha_orden_cerrada,
                        "tamano_cartulina"=>$this->input->post('tamano_cartulina',true),
                        "cantidad_de_pliegos"=>$this->input->post('cantidad_de_pliegos',true),
                        "instrucciones_de_despacho"=>$this->input->post('instrucciones_de_despacho',true),
                        "fecha_recepcion_pedido"=>$this->input->post('fecha_recepcion_pedido',true),
                        "total_o_parcial"=>$this->input->post('total_o_parcial',true),
                        "can_despacho_1"=>$this->input->post('can_despacho_1',true),
                        "can_despacho_2"=>$this->input->post('can_despacho_2',true),
                        "can_despacho_3"=>$this->input->post('can_despacho_3',true),
                    );
					
                    if($this->input->post('estado',true) == '3')
                    {
                                    $this->db->insert("produccion_servicios_post_imprenta_parcial",$data);

                    }
					//Parcial Fin
					
                    switch($tipo)
                    {
                        case '1':
                            $this->session->set_flashdata('ControllerMessage', 'Se ha guardado el registro exitosamente.');					            redirect(base_url().'produccion/cotizaciones/'.$this->input->post('pagina',true),  301);
                        break;
                         case '2':
                            $this->session->set_flashdata('ControllerMessage', 'Se ha guardado el registro exitosamente.');					            redirect(base_url().'produccion/fast/'.$this->input->post('pagina',true),  301);
                        break;
                    }   
                }
            }
            $usuarios=$this->usuarios_model->getUsuariosPorTipo(3);
            $this->layout->view("servicios_post_imprenta",compact('usuarios','datos','tipo','pagina','id','control','ing','fotomecanica','cotizacion','hoja','ordenDeCompra','orden','fotomecanica2','imprenta_produccion','corte_cartulina','fotomecanica2','ordenDeCompra','orden','imprenta_programacion','control_cartulina','confeccion_molde_troquel','tapa','materialidad_1','hoja','monda','mliner','materialidad_2','materialidad_3','total_kilos_control_cartulina','externos','proveedores','usuarios_orden_compra','ordenes_compras_trabajos_externos')); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
        
	}
    /**
     * Emplacado
     * */
	 public function emplacado($tipo=null,$id=null,$pagina=null)
	{
        if($this->session->userdata('id'))
        {
          
            if(!$tipo or !$id){show_404();}
           switch($tipo)
                    {
                        case '1':
                            $datos=$this->cotizaciones_model->getCotizacionPorId($id);
                        break;
                         case '2':
                            $datos=$this->fast_track_model->getFastTrackPorId($id);
                        break;
                    }      
			if(sizeof($datos)==0){show_404();}
            $control=$this->produccion_model->getEmplacadoPorTipo($tipo,$id);
            $corrugado=$this->produccion_model->getCorrugadoPorTipo($tipo,$id);
            $imprenta=$this->produccion_model->getImprentaProduccionPorTipo($tipo,$id);
            $imprenta_programacion=$this->produccion_model->getImprentaProgramacionPorTipo($tipo,$id);
            $servicios=$this->produccion_model->getServiciosPorImprentaPorTipo($tipo,$id);
            $ing=$this->cotizaciones_model->getCotizacionIngenieriaPorIdCotizacion($id);
            $fotomecanica=$this->cotizaciones_model->getCotizacionFotomecanicaPorIdCotizacion($id);
            $fotomecanica2=$this->produccion_model->getFotomecanicaPorTipo($tipo,$id);
            $confeccion_molde_troquel=$this->produccion_model->getConfeccionModelTroquelPorTipo($tipo,$id);
            $cotizacion=$this->cotizaciones_model->getCotizacionPorId($id);
            $hoja=$this->cotizaciones_model->getHojaDeCostosPorIdCotizacion($id);
            $ordenDeCompra=$this->cotizaciones_model->getOrdenDeCompraPorCotizacion($id);
            $orden=$this->orden_model->getOrdenesPorCotizacion($id);
            $corte_cartulina=$this->produccion_model->getCorteCartulinaPorTipo($tipo,$id);
            $control_cartulina=$this->produccion_model->getControlCartulinaPorTipo($tipo,$id);
            
            
            
            /*materialidad*/
            $tapa = $this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_1);
            $monda = $this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_2);
            $mliner = $this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_3);            
            $materialidad_1=$this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_1);
            $materialidad_2=$this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_2);
            $materialidad_3=$this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_3);  
            $total_kilos_control_cartulina=$this->produccion_model->MermasParaProduccion($id,$control_cartulina->ancho_de_bobina,$materialidad_1->gramaje);                        
            
            $pinza = $this->produccion_model->getLargoDePinzas($id);
            if($this->input->post())
            {
                if($this->form_validation->run('produccion_emplacado'))
                {
                    if(sizeof($imprenta)==0 or sizeof($imprenta_programacion)==0 or sizeof($corrugado)==0)
                   {
                            $situacion='Pendiente';
                            $fecha_pendiente=date('Y-m-d H:i:s');
                            $fecha_liberada='0000-00-00';
                            $fecha_activa='0000-00-00';
                            $fecha_orden_cerrada='0000-00-00';
                   }else
                   {}
                     switch($this->input->post('estado',true))
                     {
                        case '1':
                            $situacion='Liberada';
                            $fecha_pendiente='0000-00-00';
                            $fecha_liberada=date('Y-m-d H:i:s');
                            $fecha_activa='0000-00-00';
                            $fecha_orden_cerrada='0000-00-00';
                        break;
                        case '0':
                            $situacion='Activa';
                            $fecha_pendiente='0000-00-00';
                            $fecha_liberada='0000-00-00';
                            $fecha_activa=date('Y-m-d H:i:s');
                            $fecha_orden_cerrada='0000-00-00';
                        break;
                        case '2':
                            $situacion='Activa';
                            $fecha_pendiente='0000-00-00';
                            $fecha_liberada='0000-00-00';
                            $fecha_activa=date('Y-m-d H:i:s');
                            $fecha_orden_cerrada='0000-00-00';
                        break;
                        default:
                            $situacion='Activa';
                            $fecha_pendiente='0000-00-00';
                            $fecha_liberada='0000-00-00';
                            $fecha_activa=date('Y-m-d H:i:s');
                            $fecha_orden_cerrada='0000-00-00';
                        break;
						case '':
                                $situacion='Activa';
                                $fecha_pendiente='0000-00-00';
                                $fecha_liberada='0000-00-00';
                                $fecha_activa=date('Y-m-d H:i:s');
                                $fecha_orden_cerrada='0000-00-00';
                            break;
							 case '3':
                                $situacion='Parcial';
                                $fecha_pendiente='0000-00-00';
                                $fecha_liberada='0000-00-00';
                                $fecha_activa=date('Y-m-d H:i:s');
                                $fecha_orden_cerrada='0000-00-00';
                            break;
                        
                     }
                     
                    $data=array
                    (
                        "id_usuario"=>$this->session->userdata('id'),
                        "tipo"=>$this->input->post('tipo',true),
                        "id_nodo"=>$this->input->post('id',true),
                        "id_cliente"=>$this->input->post('id_cliente',true),
                        "orden_de_trabajo"=>$this->input->post('id',true),
                        "descripcion_del_trabajo"=>$this->input->post('descripcion_del_trabajo',true),
                        "total_pliegos_de_corrugado"=>$this->input->post('total_pliegos_de_corrugado',true),
                        "total_pliegos_de_imprenta"=>$this->input->post('total_pliegos_de_imprenta',true),
                        "operador"=>$this->input->post('operador',true),
                        "ayudante_1"=>$this->input->post('ayudante_1',true),
                        "ayudante_2"=>$this->input->post('ayudante_2',true),
                        "total_pliegos_buenos"=>$this->input->post('total_pliegos_buenos',true),
                        "estado"=>$this->input->post('estado',true),
                        "quien"=>$this->session->userdata('id'),
                        "cuando"=>date("Y-m-d"),
                        "glosa"=>$this->input->post('glosa',true),
                        "ccac1"=>$this->input->post('ccac1',true),
                        "ccac2"=>$this->input->post('ccac2',true),
                        "situacion"=>$situacion,
                        "fecha_pendiente"=>$fecha_pendiente,
                        "fecha_liberada"=>$fecha_liberada,
                        "fecha_activa"=>$fecha_activa,
                        "fecha_orden_cerrada"=>$fecha_orden_cerrada,
                        "total_o_parcial"=>$this->input->post('total_o_parcial',true),
                        "can_despacho_1"=>$this->input->post('can_despacho_1',true),
                        "can_despacho_2"=>$this->input->post('can_despacho_2',true),
                        "can_despacho_3"=>$this->input->post('can_despacho_3',true),
                    );
                    if(sizeof($control)==0)
                    {
                        $this->db->insert("produccion_emplacado",$data);
                        
                    }else
                    {
                        $this->db->update('produccion_emplacado', $data, array('tipo' => $this->input->post('tipo',true),'id_nodo'=>$this->input->post('id',true)));
                       
                    }    
					
							
					//Parcial				
					
					$data2=array
                    (              
						"id_usuario"=>$this->session->userdata('id'),
                        "tipo"=>$this->input->post('tipo',true),
                        "id_nodo"=>$this->input->post('id',true),
                        "id_cliente"=>$this->input->post('id_cliente',true),
                        "orden_de_trabajo"=>$this->input->post('id',true),
                        "descripcion_del_trabajo"=>$this->input->post('descripcion_del_trabajo',true),
                        "total_pliegos_de_corrugado"=>$this->input->post('total_pliegos_de_corrugado',true),
                        "total_pliegos_de_imprenta"=>$this->input->post('total_pliegos_de_imprenta',true),
                        "operador"=>$this->input->post('operador',true),
                        "ayudante_1"=>$this->input->post('ayudante_1',true),
                        "ayudante_2"=>$this->input->post('ayudante_2',true),
                        "total_pliegos_buenos"=>$this->input->post('total_pliegos_buenos',true),
                        "estado"=>$this->input->post('estado',true),
                        "quien"=>$this->session->userdata('id'),
                        "cuando"=>date("Y-m-d"),
                        "glosa"=>$this->input->post('glosa',true),
                        "ccac1"=>$this->input->post('ccac1',true),
                        "ccac2"=>$this->input->post('ccac2',true),
                        "situacion"=>$situacion,
                        "fecha_pendiente"=>$fecha_pendiente,
                        "fecha_liberada"=>$fecha_liberada,
                        "fecha_activa"=>$fecha_activa,
                        "fecha_orden_cerrada"=>$fecha_orden_cerrada,
                        "total_o_parcial"=>$this->input->post('total_o_parcial',true),
                        "can_despacho_1"=>$this->input->post('can_despacho_1',true),
                        "can_despacho_2"=>$this->input->post('can_despacho_2',true),
                        "can_despacho_3"=>$this->input->post('can_despacho_3',true),
                    );
					
						 if($this->input->post('estado',true) == '3')
						 {
								 $this->db->insert("produccion_emplacado_parcial",$data);
						
						 }
					//Parcial Fin
					
                    switch($tipo)
                    {
                        case '1':
                            $this->session->set_flashdata('ControllerMessage', 'Se ha guardado el registro exitosamente.');					            redirect(base_url().'produccion/cotizaciones/'.$this->input->post('pagina',true),  301);
                        break;
                         case '2':
                            $this->session->set_flashdata('ControllerMessage', 'Se ha guardado el registro exitosamente.');					            redirect(base_url().'produccion/fast/'.$this->input->post('pagina',true),  301);
                        break;
                    }   
                }
            }
            $usuarios=$this->usuarios_model->getUsuariosPorTipo(8);
            $usuarios2=$this->usuarios_model->getUsuariosPorTipo(9);
            $this->layout->view("emplacado",compact('usuarios','datos','tipo','pagina','id','control','ing','fotomecanica','cotizacion','hoja','corrugado','imprenta','confeccion_molde_troquel','servicios','usuarios2','ordenDeCompra','orden','fotomecanica2','imprenta_programacion','corte_cartulina','tapa','materialidad_1','hoja','monda','mliner','materialidad_2','materialidad_3','control_cartulina','total_kilos_control_cartulina','pinza')); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
        
	}
    /**
     * Troquelado
     * */
	 public function troquelado($tipo=null,$id=null,$pagina=null)
	{
        if($this->session->userdata('id'))
        {
          
            if(!$tipo or !$id){show_404();}
           switch($tipo)
                    {
                        case '1':
                            $datos=$this->cotizaciones_model->getCotizacionPorId($id);
                        break;
                         case '2':
                            $datos=$this->fast_track_model->getFastTrackPorId($id);
                        break;
                    }      
			if(sizeof($datos)==0){show_404();}
            $control=$this->produccion_model->getTroqueladoPorTipo($tipo,$id);
            $control_cartulina=$this->produccion_model->getControlCartulinaPorTipo($tipo,$id);
            $ing=$this->cotizaciones_model->getCotizacionIngenieriaPorIdCotizacion($id);
            $fotomecanica=$this->cotizaciones_model->getCotizacionFotomecanicaPorIdCotizacion($id);
            $fotomecanica2=$this->produccion_model->getFotomecanicaPorTipo($tipo,$id);
            $cotizacion=$this->cotizaciones_model->getCotizacionPorId($id);
            $hoja=$this->cotizaciones_model->getHojaDeCostosPorIdCotizacion($id);
            $orden=$this->orden_model->getOrdenesPorCotizacion($id);
            $emplacado=$this->produccion_model->getEmplacadoPorTipo($tipo,$id);
            $ordenDeCompra=$this->cotizaciones_model->getOrdenDeCompraPorCotizacion($id);
            $confeccion_molde_troquel=$this->produccion_model->getConfeccionModelTroquelPorTipo($tipo,$id);
            $corte_cartulina=$this->produccion_model->getCorteCartulinaPorTipo($tipo,$id);
            $corrugado=$this->produccion_model->getCorrugadoPorTipo($tipo,$id);
            $imprenta=$this->produccion_model->getImprentaProduccionPorTipo($tipo,$id);
            
            /*materialidad*/
            $hoja=$this->cotizaciones_model->getHojaDeCostosPorIdCotizacion($id);            
            $tapa = $this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_1);
            $monda = $this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_2);
            $mliner = $this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_3);            
            $materialidad_1=$this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_1);
            $materialidad_2=$this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_2);
            $materialidad_3=$this->materiales_model->getMaterialesPorNombre($fotomecanica->materialidad_3);

            $pinza = $this->produccion_model->getLargoDePinzas($id);
            if($this->input->post())
            {
                if($this->form_validation->run('produccion_troquelado'))
                {
                    if(sizeof($emplacado)==0)
                   {
                            $situacion='Pendiente';
                            $fecha_pendiente=date('Y-m-d H:i:s');
                            $fecha_liberada='0000-00-00';
                            $fecha_activa='0000-00-00';
                            $fecha_orden_cerrada='0000-00-00';
                   }else
                   {}
                     switch($this->input->post('estado',true))
                     {
                        case '1':
                            $situacion='Liberada';
                            $fecha_pendiente='0000-00-00';
                            $fecha_liberada=date('Y-m-d H:i:s');
                            $fecha_activa='0000-00-00';
                            $fecha_orden_cerrada='0000-00-00';
                        break;
                        case '0':
                            $situacion='Activa';
                            $fecha_pendiente='0000-00-00';
                            $fecha_liberada='0000-00-00';
                            $fecha_activa=date('Y-m-d H:i:s');
                            $fecha_orden_cerrada='0000-00-00';
                        break;
                        case '2':
                            $situacion='Activa';
                            $fecha_pendiente='0000-00-00';
                            $fecha_liberada='0000-00-00';
                            $fecha_activa=date('Y-m-d H:i:s');
                            $fecha_orden_cerrada='0000-00-00';
                        break;
						case '':
                                $situacion='Activa';
                                $fecha_pendiente='0000-00-00';
                                $fecha_liberada='0000-00-00';
                                $fecha_activa=date('Y-m-d H:i:s');
                                $fecha_orden_cerrada='0000-00-00';
                            break;
							 case '3':
                                $situacion='Parcial';
                                $fecha_pendiente='0000-00-00';
                                $fecha_liberada='0000-00-00';
                                $fecha_activa=date('Y-m-d H:i:s');
                                $fecha_orden_cerrada='0000-00-00';
                            break;
                     }
                   
                    $data=array
                    (
                        "id_usuario"=>$this->session->userdata('id'),
                        "tipo"=>$this->input->post('tipo',true),
                        "id_nodo"=>$this->input->post('id',true),
                        "id_cliente"=>$this->input->post('id_cliente',true),
                        "orden_de_trabajo"=>$this->input->post('id',true),
                        "descripcion_del_trabajo"=>$this->input->post('descripcion_del_trabajo',true),
                        "numero_molde_troquel"=>$this->input->post('numero_molde_troquel',true),
                        "total_pliegos_a_troquelar"=>$this->input->post('total_pliegos_a_troquelar',true),
                        "total_pliegos_recibidos_de_emplacado"=>$this->input->post('total_pliegos_recibidos_de_emplacado',true),
                        "operador"=>$this->input->post('operador',true),
                        "ayudante_1"=>$this->input->post('ayudante_1',true),
                        "total_pliegos_buenos"=>$this->input->post('total_pliegos_buenos',true),
                        "merma"=>$this->input->post('merma',true),
                        "estado"=>$this->input->post('estado',true),
                        "quien"=>$this->session->userdata('id'),
                        "cuando"=>date("Y-m-d"),
                        "glosa"=>$this->input->post('glosa',true),
                        "tipo_maquina"=>$this->input->post('tipo_maquina',true),
                        "total_o_parcial"=>$this->input->post("total_o_parcial",true),
                        "situacion"=>$situacion,
                        "fecha_pendiente"=>$fecha_pendiente,
                        "fecha_liberada"=>$fecha_liberada,
                        "fecha_activa"=>$fecha_activa,
                        "fecha_orden_cerrada"=>$fecha_orden_cerrada,
                        "can_despacho_1"=>$this->input->post('can_despacho_1',true),
                        "can_despacho_2"=>$this->input->post('can_despacho_2',true),
                        "can_despacho_3"=>$this->input->post('can_despacho_3',true),
                    );
                    if(sizeof($control)==0)
                    {
                        $this->db->insert("produccion_troquelado",$data);
                        
                    }else
                    {
                        $this->db->update('produccion_troquelado', $data, array('tipo' => $this->input->post('tipo',true),'id_nodo'=>$this->input->post('id',true)));
                       
                    }   

						//Parcial				
					
					$data2=array
                    (              
						   "id_usuario"=>$this->session->userdata('id'),
                        "tipo"=>$this->input->post('tipo',true),
                        "id_nodo"=>$this->input->post('id',true),
                        "id_cliente"=>$this->input->post('id_cliente',true),
                        "orden_de_trabajo"=>$this->input->post('id',true),
                        "descripcion_del_trabajo"=>$this->input->post('descripcion_del_trabajo',true),
                        "numero_molde_troquel"=>$this->input->post('numero_molde_troquel',true),
                        "total_pliegos_a_troquelar"=>$this->input->post('total_pliegos_a_troquelar',true),
                        "total_pliegos_recibidos_de_emplacado"=>$this->input->post('total_pliegos_recibidos_de_emplacado',true),
                        "operador"=>$this->input->post('operador',true),
                        "ayudante_1"=>$this->input->post('ayudante_1',true),
                        "total_pliegos_buenos"=>$this->input->post('total_pliegos_buenos',true),
                        "merma"=>$this->input->post('merma',true),
                        "estado"=>$this->input->post('estado',true),
                        "quien"=>$this->session->userdata('id'),
                        "cuando"=>date("Y-m-d"),
                        "glosa"=>$this->input->post('glosa',true),
                        "tipo_maquina"=>$this->input->post('tipo_maquina',true),
                        "total_o_parcial"=>$this->input->post("total_o_parcial",true),
                        "situacion"=>$situacion,
                        "fecha_pendiente"=>$fecha_pendiente,
                        "fecha_liberada"=>$fecha_liberada,
                        "fecha_activa"=>$fecha_activa,
                        "fecha_orden_cerrada"=>$fecha_orden_cerrada,
                        "can_despacho_1"=>$this->input->post('can_despacho_1',true),
                        "can_despacho_2"=>$this->input->post('can_despacho_2',true),
                        "can_despacho_3"=>$this->input->post('can_despacho_3',true),
                    );
					
						 if($this->input->post('estado',true) == '3')
						 {
								 $this->db->insert("produccion_troquelado_parcial",$data);
						
						 }
					//Parcial Fin

					
                    switch($tipo)
                    {
                        case '1':
                            $this->session->set_flashdata('ControllerMessage', 'Se ha guardado el registro exitosamente.');					            redirect(base_url().'produccion/cotizaciones/'.$this->input->post('pagina',true),  301);
                        break;
                         case '2':
                            $this->session->set_flashdata('ControllerMessage', 'Se ha guardado el registro exitosamente.');					            redirect(base_url().'produccion/fast/'.$this->input->post('pagina',true),  301);
                        break;
                    }   
                }
            }
            $usuarios=$this->usuarios_model->getUsuariosPorTipo(8);
            $usuarios2=$this->usuarios_model->getUsuariosPorTipo(9);
            $this->layout->view("troquelado",compact('usuarios','datos','tipo','pagina','id','control','ing','fotomecanica','cotizacion','hoja','control_cartulina','orden','emplacado','usuarios2','ordenDeCompra','fotomecanica2','confeccion_molde_troquel','corte_cartulina','corrugado','imprenta','tapa','materialidad_1','monda','mliner','materialidad_2','materialidad_3','pinza'));  
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
        
	}
    /**
     * Talleres externos
     * */
	 public function talleres_externos($tipo=null,$id=null,$pagina=null)
	{
        if($this->session->userdata('id'))
        {
          
            if(!$tipo or !$id){show_404();}
           switch($tipo)
                    {
                        case '1':
                            $datos=$this->cotizaciones_model->getCotizacionPorId($id);
                        break;
                         case '2':
                            $datos=$this->fast_track_model->getFastTrackPorId($id);
                        break;
                    }      
			if(sizeof($datos)==0){show_404();}
            $pliegos=$this->produccion_model->getImprentaProduccionPorTipo($tipo,$id);
            $control=$this->produccion_model->getTallerExternosPorTipo($tipo,$id);
            $ing=$this->cotizaciones_model->getCotizacionIngenieriaPorIdCotizacion($id);
            $fotomecanica=$this->cotizaciones_model->getCotizacionFotomecanicaPorIdCotizacion($id);
            $cotizacion=$this->cotizaciones_model->getCotizacionPorId($id);
            $hoja=$this->cotizaciones_model->getHojaDeCostosPorIdCotizacion($id);
            $fotomecanica2=$this->produccion_model->getFotomecanicaPorTipo($tipo,$id);
            $ordenDeCompra=$this->cotizaciones_model->getOrdenDeCompraPorCotizacion($id);
            $orden=$this->orden_model->getOrdenesPorCotizacion($id);
            $troquelado=$this->produccion_model->getTroqueladoPorTipo($tipo,$id);
            $corte_cartulina=$this->produccion_model->getCorteCartulinaPorTipo($tipo,$id);
            $producto=$this->productos_model->getProductosPorId($orden->producto_id);
            if($this->input->post())
            {
//                $config = array(
//                    'produccion_talleres_externos'
//		=> array(
//			
//             //array('field' => 'descripcion_del_trabajo','label' => 'Comentarios para una eventual repetición','rules' => 'required|is_string|trim|xss_clean'),
//            array('field' => 'descripcion_trabajo_externo','label' => 'Descripción trabajo externo','rules' => 'required|is_string|trim|xss_clean'),
//            array('field' => 'direccion_proveedor','label' => 'Dirección proveedor','rules' => 'required|is_string|trim|xss_clean'),
//            array('field' => 'horario_proveedor','label' => 'Horario proveedor','rules' => 'required|is_string|trim|xss_clean'),
//            array('field' => 'despachador','label' => 'Despachador','rules' => 'required|is_string|trim|xss_clean'),
//            array('field' => 'camion_de_despacho','label' => 'Camión de despacho','rules' => 'required|is_string|trim|xss_clean'),
//            array('field' => 'chofer','label' => 'Chofer','rules' => 'required|is_string|trim|xss_clean'),
//            ),);
                $reglas=$this->input->post('regla');
               
                //exit();
                $j=1;
                $k=1;
                $l=1;
                $arreglo=[];
                $arreglo2=[];
                $paquete=[];
                for($i=1;$i<=20;$i++){
                    if(isset($_POST["proveedor$i"])){        
                        $this->form_validation->set_rules("proveedor$i","Proveedor $i",'required|is_string|trim|xss_clean');    
                    }
                }
                for($i=1;$i<=20;$i++){
                    if(isset($_POST["cantidad$i"])){        
                        $this->form_validation->set_rules("cantidad$i","Cantidad $i",'required|is_string|trim|xss_clean');    
                    }
                }
                for($i=1;$i<=20;$i++){
                    if(isset($_POST["proveedor$i"]) && $_POST["proveedor$i"]!=""){        
                        $arreglo[$j]=$_POST["proveedor$i"];
                        $arreglo2[$j]=$_POST["cantidad$i"];
                        $j++;
                    }
                }
                for($t=1;$t<=20;$t++){
                    if(isset($_POST["cantidad$t"]) && $_POST["cantidad$t"]!="" && isset($_POST["proveedor$t"]) && $_POST["proveedor$t"]!=""){        
                        $paquete[$l]=(["p$l"=>$_POST["proveedor$t"],"c$l"=>$_POST["cantidad$t"],"d$l"=>$_POST["idireccion$t"],"h$l"=>$_POST["ihorario$t"]]);
                        $paquete2[$l]=(["p$l"=>$arreglo[$i],"c$l"=>$arreglo2[$i],"d$l"=>$arreglo2[$i],"h$l"=>$arreglo2[$i]]);
                        $l++;
                    }
                }
                
                $paquete = json_encode($paquete);
                $switch=$this->input->post('parcial',true);
                
                $this->form_validation->set_rules('descripcion_trabajo_externo','Descripcion trabajo externo','required|is_string|trim|xss_clean');
//                $this->form_validation->set_rules('direccion_proveedor','Dirección proveedor','required|is_string|trim|xss_clean');
//                $this->form_validation->set_rules('horario_proveedor','Horario proveedor','required|is_string|trim|xss_clean');
                $this->form_validation->set_rules('despachador','Despachador','required|is_string|trim|xss_clean');
                $this->form_validation->set_rules('camion_de_despacho','Camión de despacho','required|is_string|trim|xss_clean');
                $this->form_validation->set_rules('chofer','Chofer','required|is_string|trim|xss_clean');
                
                if($this->form_validation->run())
                {
                    if(sizeof($troquelado)==0)
                   {
                            $situacion='Pendiente';
                            $fecha_pendiente=date('Y-m-d H:i:s');
                            $fecha_liberada='0000-00-00';
                            $fecha_activa='0000-00-00';
                            $fecha_orden_cerrada='0000-00-00';
                   }else
                   {}
                     switch($this->input->post('estado',true))
                     {
                        case '1':
                            $situacion='Liberada';
                            $fecha_pendiente='0000-00-00';
                            $fecha_liberada=date('Y-m-d H:i:s');
                            $fecha_activa='0000-00-00';
                            $fecha_orden_cerrada='0000-00-00';
                        break;
                        case '0':
                            $situacion='Activa';
                            $fecha_pendiente='0000-00-00';
                            $fecha_liberada='0000-00-00';
                            $fecha_activa=date('Y-m-d H:i:s');
                            $fecha_orden_cerrada='0000-00-00';
                        break;
                        case '2':
                            $situacion='Activa';
                            $fecha_pendiente='0000-00-00';
                            $fecha_liberada='0000-00-00';
                            $fecha_activa=date('Y-m-d H:i:s');
                            $fecha_orden_cerrada='0000-00-00';
                        break;
                        default:
                             $situacion='Activa';
                            $fecha_pendiente='0000-00-00';
                            $fecha_liberada='0000-00-00';
                            $fecha_activa=date('Y-m-d H:i:s');
                            $fecha_orden_cerrada='0000-00-00';
                        break;
						case '':
                                $situacion='Activa';
                                $fecha_pendiente='0000-00-00';
                                $fecha_liberada='0000-00-00';
                                $fecha_activa=date('Y-m-d H:i:s');
                                $fecha_orden_cerrada='0000-00-00';
                            break;
							 case '3':
                                $situacion='Parcial';
                                $fecha_pendiente='0000-00-00';
                                $fecha_liberada='0000-00-00';
                                $fecha_activa=date('Y-m-d H:i:s');
                                $fecha_orden_cerrada='0000-00-00';
                            break;
                     }
                   
                    $data=array
                    (
                        "id_usuario"=>$this->session->userdata('id'),
                        "tipo"=>$this->input->post('tipo',true),
                        "id_nodo"=>$this->input->post('id',true),
                        "id_cliente"=>$this->input->post('id_cliente',true),
                        "orden_de_trabajo"=>$this->input->post('id',true),
                        "descripcion_del_trabajo"=>$this->input->post('descripcion_del_trabajo',true),
                        "si_no"=>$this->input->post('si_no',true),
                        "descripcion_trabajo_externo"=>$this->input->post('descripcion_trabajo_externo',true),
                        "proveedor"=>$this->input->post('proveedor',true),
                        "direccion_proveedor"=>$this->input->post('direccion_proveedor',true),
                        "horario_proveedor"=>$this->input->post('horario_proveedor',true),
                        "despachador"=>$this->input->post('despachador',true),
                        "camion_de_despacho"=>$this->input->post('camion_de_despacho',true),
                        "chofer"=>$this->input->post('chofer',true),
                        "estado"=>$this->input->post('estado',true),
                        "quien"=>$this->session->userdata('id'),
                        "cuando"=>date("Y-m-d"),
                        "glosa"=>$this->input->post('glosa',true),
                        "situacion"=>$situacion,
                        "fecha_pendiente"=>$fecha_pendiente,
                        "fecha_liberada"=>$fecha_liberada,
                        "fecha_activa"=>$fecha_activa,
                        "fecha_orden_cerrada"=>$fecha_orden_cerrada,
                        "cantidad_a_pegar"=>$this->input->post('cantidad_a_pegar',true),
                        "unidades_por_paquete"=>$this->input->post('unidades_por_paquete',true),
                        "precio"=>$this->input->post('precio',true),
                        "parcial"=>$paquete,
                        "switch"=>$switch,
                    );
             
                    if(sizeof($control)==0)
                    {
                        $this->db->insert("produccion_talleres_externos",$data);
                        
                    }else
                    {
                        $this->db->update('produccion_talleres_externos', $data, array('tipo' => $this->input->post('tipo',true),'id_nodo'=>$this->input->post('id',true)));
                       
                    }   


					//Parcial				
					
					$data2=array
                    (              
                         "id_usuario"=>$this->session->userdata('id'),
                        "tipo"=>$this->input->post('tipo',true),
                        "id_nodo"=>$this->input->post('id',true),
                        "id_cliente"=>$this->input->post('id_cliente',true),
                        "orden_de_trabajo"=>$this->input->post('id',true),
                        "descripcion_del_trabajo"=>$this->input->post('descripcion_del_trabajo',true),
                        "si_no"=>$this->input->post('si_no',true),
                        "descripcion_trabajo_externo"=>$this->input->post('descripcion_trabajo_externo',true),
                        "proveedor"=>$this->input->post('proveedor',true),
                        "direccion_proveedor"=>$this->input->post('direccion_proveedor',true),
                        "horario_proveedor"=>$this->input->post('horario_proveedor',true),
                        "despachador"=>$this->input->post('despachador',true),
                        "camion_de_despacho"=>$this->input->post('camion_de_despacho',true),
                        "chofer"=>$this->input->post('chofer',true),
                        "estado"=>$this->input->post('estado',true),
                        "quien"=>$this->session->userdata('id'),
                        "cuando"=>date("Y-m-d"),
                        "glosa"=>$this->input->post('glosa',true),
                        "situacion"=>$situacion,
                        "fecha_pendiente"=>$fecha_pendiente,
                        "fecha_liberada"=>$fecha_liberada,
                        "fecha_activa"=>$fecha_activa,
                        "fecha_orden_cerrada"=>$fecha_orden_cerrada,
                        "cantidad_a_pegar"=>$this->input->post('cantidad_a_pegar',true),
                        "unidades_por_paquete"=>$this->input->post('unidades_por_paquete',true),
                        "precio"=>$this->input->post('precio',true),
                    );
					
						 if($this->input->post('estado',true) == '3')
						 {
								$this->db->insert("produccion_talleres_externos_parcial",$data);
						
						 }
					//Parcial Fin
					
					

					
                    switch($tipo)
                    {
                        case '1':
                            $this->session->set_flashdata('ControllerMessage', 'Se ha guardado el registro exitosamente.');					            redirect(base_url().'produccion/cotizaciones/'.$this->input->post('pagina',true),  301);
                        break;
                         case '2':
                            $this->session->set_flashdata('ControllerMessage', 'Se ha guardado el registro exitosamente.');					            redirect(base_url().'produccion/fast/'.$this->input->post('pagina',true),  301);
                        break;
                    }   
                }
            }
            $this->layout->css
            (
                array
                (
                    base_url()."public/backend/css/calendario.css",
                    base_url()."public/backend/fancybox/jquery.fancybox.css",
                    base_url()."public/frontend/css/prism.css",
                    base_url()."public/frontend/css/chosen.css",
                )
            );        
            $this->layout->js
            (
                array
                (
                    base_url()."public/backend/js/calendar.js",
                    base_url()."public/backend/js/calendar-setup.js",
                    base_url()."public/backend/js/calendar-es.js",
                   // base_url().'public/backend/js/tiny_mce/tiny_mce.js',
                    base_url()."public/frontend/js/dar_formato.js",
                    base_url()."public/backend/js/bootstrap.file-input.js",                    
                    base_url()."public/backend/fancybox/jquery.fancybox.js",
                    
                   
                )
            );            
            $usuarios=$this->usuarios_model->getUsuariosPorTipo(3);
            $usuarioscombo=$this->usuarios_model->getUsuarios();
            $this->layout->view("talleres_externos",compact('usuarios','usuarioscombo','datos','tipo','pagina','id','control','ing','fotomecanica','cotizacion','hoja','control_cartulina','fotomecanica2','ordenDeCompra','orden','troquelado','corte_cartulina','pliegos','producto','reglas','paquete')); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
        
	}
        
        
    /**
    /** Producion talleres oc*/
     public function oc_produccion_talleres($id)
    {
         if($this->session->userdata('id'))
        { 
             
              $pliegos=$this->produccion_model->getImprentaProduccionPorTipo($tipo,$id);
            $control=$this->produccion_model->getTallerExternosPorTipo(1,$id);
            $ing=$this->cotizaciones_model->getCotizacionIngenieriaPorIdCotizacion($id);
            $fotomecanica=$this->cotizaciones_model->getCotizacionFotomecanicaPorIdCotizacion($id);
            $cotizacion=$this->cotizaciones_model->getCotizacionPorId($id);
            $hoja=$this->cotizaciones_model->getHojaDeCostosPorIdCotizacion($id);
            $fotomecanica2=$this->produccion_model->getFotomecanicaPorTipo($tipo,$id);
            $ordenDeCompra=$this->cotizaciones_model->getOrdenDeCompraPorCotizacion($id);
            $orden=$this->orden_model->getOrdenesPorCotizacion($id);
            $troquelado=$this->produccion_model->getTroqueladoPorTipo($tipo,$id);
            $corte_cartulina=$this->produccion_model->getCorteCartulinaPorTipo($tipo,$id);
            $producto=$this->productos_model->getProductosPorId($orden->producto_id);
             //Arrays de datos para la vista
                function array_oc($p,$folia,$proveedor,$datos,$procesosespeciales,$correlativo){
                $precio=$folia->costo_compra;
                if($folia->codigo==111 || $folia->codigo==113){
                $descripcion=$folia->caracteristicas." (Monto Fijo)";
                $total=$precio;
                $total=$folia->costo_compra;    
                }else{
                $descripcion=$folia->caracteristicas;
                $total=$datos->cantidad_1*$precio;
                //$total=$folia->costo_compra*$cantidad;       
                }
                $contacto=$proveedor->contacto;
                $codigo=$folia->codigo;
                $razon=$proveedor->nombre;
                $formapago=$proveedor->forma_pago;
                $direccion="Santiago";
                $ciudad="Santiago";
                $telefono=$proveedor->telefono;
                $cuenta=$proveedor->num_cuenta;
                $correo=$proveedor->correo;
                $tipocuenta=$proveedor->tipo_cuenta;
                if($tipocuenta==1){$tipocuenta="Cuenta Corriente";}
                if($tipocuenta==2){$tipocuenta="Cuenta Vista";}
                if($tipocuenta==3){$tipocuenta="Cuenta Rut";}
                if($tipocuenta==4){$tipocuenta="Cuenta Ahorro";}

                    $data = array(
                        'descripcion'=>$descripcion,
                        'contacto'=>$contacto,
                        'codigo'=>$codigo,
                        'precio'=>$precio,
                        'total'=>$total,
                        'razon'=>$razon,
                        'formapago'=>$formapago,
                        'direccion'=>$direccion,
                        'ciudad'=>$ciudad,
                        'telefono'=>$telefono,
                        'cuenta'=>$cuenta,
                        'correo'=>$correo,
                        'tipocuenta'=>$tipocuenta,
                        'cantidad'=>$datos->cantidad_1,
                        'cotizacion'=>$datos->id,
                        'grupo'=>$procesosespeciales,
                        'correlativo'=>$correlativo,
                    );

                    return $data;
                }
             $control2=$control;
             $this->load->library('mPDF');
             $css= file_get_contents('public/frontend/css/oc.css');
             
             $this->mPDF->pdf = new mPDF();
             $correlativo++;
             $var = json_decode($control->parcial,true);
             for($i=1;$i<=count($var);$i++){
             $control = $var[$i];
             $n= $i;
             $html=$this->load->view('frontend/produccion/oc_produccion_talleres', compact('control','n','control2','id'),true); 
             $this->mPDF->pdf->AddPage('P','','','','',5,5,10,10,10,10);
             $this->mPDF->pdf->WriteHTML($css,1);
             $this->mPDF->pdf->WriteHTML($html);
             }
            
//             if($procesosespeciales<=0){
//             $this->session->set_flashdata('ControllerMessage', 'Esta orden no posee trabajos especiales.');
//             redirect(base_url().'produccion/talleres_externos/'.$idc,  301);
            // }else{    
             $this->mPDF->pdf->Output();
             //}
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
        
        
	}
     public function etiquetas_talleres($id)
    {
         if($this->session->userdata('id'))
        { 
             
              $pliegos=$this->produccion_model->getImprentaProduccionPorTipo($tipo,$id);
            $control=$this->produccion_model->getTallerExternosPorTipo(1,$id);
            $ing=$this->cotizaciones_model->getCotizacionIngenieriaPorIdCotizacion($id);
            $fotomecanica=$this->cotizaciones_model->getCotizacionFotomecanicaPorIdCotizacion($id);
            $cotizacion=$this->cotizaciones_model->getCotizacionPorId($id);
            $hoja=$this->cotizaciones_model->getHojaDeCostosPorIdCotizacion($id);
            $fotomecanica2=$this->produccion_model->getFotomecanicaPorTipo($tipo,$id);
            $ordenDeCompra=$this->cotizaciones_model->getOrdenDeCompraPorCotizacion($id);
            $orden=$this->orden_model->getOrdenesPorCotizacion($id);
            $troquelado=$this->produccion_model->getTroqueladoPorTipo($tipo,$id);
            $corte_cartulina=$this->produccion_model->getCorteCartulinaPorTipo($tipo,$id);
            $producto=$this->productos_model->getProductosPorId($orden->producto_id);
             //Arrays de datos para la vista
                function array_oc($p,$folia,$proveedor,$datos,$procesosespeciales,$correlativo){
                $precio=$folia->costo_compra;
                if($folia->codigo==111 || $folia->codigo==113){
                $descripcion=$folia->caracteristicas." (Monto Fijo)";
                $total=$precio;
                $total=$folia->costo_compra;    
                }else{
                $descripcion=$folia->caracteristicas;
                $total=$datos->cantidad_1*$precio;
                //$total=$folia->costo_compra*$cantidad;       
                }
                $contacto=$proveedor->contacto;
                $codigo=$folia->codigo;
                $razon=$proveedor->nombre;
                $formapago=$proveedor->forma_pago;
               
                    $data = array(
                        'descripcion'=>$descripcion,
                        'contacto'=>$contacto,
                        'codigo'=>$codigo,
                        'precio'=>$precio,
                    );

                    return $data;
                }
             $control2=$control;
             $this->load->library('mPDF');
             $css= file_get_contents('public/frontend/css/et.css');
             $this->mPDF->pdf = new mPDF();
             $correlativo++;
             $var = json_decode($control->parcial,true);
             for($i=1;$i<=1;$i++){
             $control = $var[$i];
             $n= $i;
             $html=$this->load->view('frontend/produccion/etiquetas_talleres', compact('control','n','control2','id'),true); 
             $this->mPDF->pdf->AddPage('L','letter','','','',4,1,5,1,0,0);
             $this->mPDF->pdf->WriteHTML($css,1);
             $this->mPDF->pdf->WriteHTML($html);
             }
            
//             if($procesosespeciales<=0){
//             $this->session->set_flashdata('ControllerMessage', 'Esta orden no posee trabajos especiales.');
//             redirect(base_url().'produccion/talleres_externos/'.$idc,  301);
            // }else{    
             $this->mPDF->pdf->Output();
             //}
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
        
        
	}
    /**
     * Imprenta programación
     * */
	 public function imprenta_programacion($tipo=null,$id=null,$pagina=null)
	{
        if($this->session->userdata('id'))
        {
          
            if(!$tipo or !$id){show_404();}
           switch($tipo)
                    {
                        case '1':
                            $datos=$this->cotizaciones_model->getCotizacionPorId($id);
                        break;
                         case '2':
                            $datos=$this->fast_track_model->getFastTrackPorId($id);
                        break;
                    }      
			if(sizeof($datos)==0){show_404();}
                        
            $control=$this->produccion_model->getImprentaProgramacionPorTipo($tipo,$id);
            $control_cartulina=$this->produccion_model->getControlCartulinaPorTipo($tipo,$id);
            $cotizacion=$this->cotizaciones_model->getCotizacionPorId($id);
            $ing=$this->cotizaciones_model->getCotizacionIngenieriaPorIdCotizacion($id);
            $fotomecanica2=$this->cotizaciones_model->getCotizacionFotomecanicaPorIdCotizacion($id);
//            print_r($ing);
            $fotomecanica=$this->produccion_model->getFotomecanicaPorTipo($tipo,$id);
            $hoja=$this->cotizaciones_model->getHojaDeCostosPorIdCotizacion($id);
            $ordenDeCompra=$this->cotizaciones_model->getOrdenDeCompraPorCotizacion($id);
            $orden=$this->orden_model->getOrdenesPorCotizacion($id);
            $corte_cartulina=$this->produccion_model->getCorteCartulinaPorTipo($tipo,$id);
            
            
            $tapa = $this->materiales_model->getMaterialesPorNombre($fotomecanica2->materialidad_1);
            $monda = $this->materiales_model->getMaterialesPorNombre($fotomecanica2->materialidad_2);
            $mliner = $this->materiales_model->getMaterialesPorNombre($fotomecanica2->materialidad_3);            
            $materialidad_1=$this->materiales_model->getMaterialesPorNombre($fotomecanica2->materialidad_1);
            $materialidad_2=$this->materiales_model->getMaterialesPorNombre($fotomecanica2->materialidad_2);
            $materialidad_3=$this->materiales_model->getMaterialesPorNombre($fotomecanica2->materialidad_3); 
            $internos=$this->acabados_model->getAcabados2PorTipo("Interno");
            $externos=$this->acabados_model->getAcabados2PorTipo("Externo");
            $proveedores=$this->proveedores_model->getProveedores();     
            $total_kilos_control_cartulina=$this->produccion_model->MermasParaProduccion($id,$control_cartulina->ancho_de_bobina,$materialidad_1->gramaje);                        
            
            
            if($this->input->post())
            {
                if($this->form_validation->run('imprenta_programacion'))
                {
                    if(sizeof($control_cartulina)==0)
                   {
                            $situacion='Pendiente';
                            $fecha_pendiente=date('Y-m-d H:i:s');
                            $fecha_liberada='0000-00-00';
                            $fecha_activa='0000-00-00';
                            $fecha_orden_cerrada='0000-00-00';
                   }else
                   {
                     switch($control->estado)
                     {
                        case '1':
                            $situacion='Liberada';
                            $fecha_pendiente='0000-00-00';
                            $fecha_liberada=date('Y-m-d H:i:s');
                            $fecha_activa='0000-00-00';
                            $fecha_orden_cerrada='0000-00-00';
                        break;
                        case '0':
                            $situacion='Activa';
                            $fecha_pendiente='0000-00-00';
                            $fecha_liberada='0000-00-00';
                            $fecha_activa=date('Y-m-d H:i:s');
                            $fecha_orden_cerrada='0000-00-00';
                        break;
                        case '2':
                            $situacion='Activa';
                            $fecha_pendiente='0000-00-00';
                            $fecha_liberada='0000-00-00';
                            $fecha_activa=date('Y-m-d H:i:s');
                            $fecha_orden_cerrada='0000-00-00';
                        break;
						case '':
                                $situacion='Activa';
                                $fecha_pendiente='0000-00-00';
                                $fecha_liberada='0000-00-00';
                                $fecha_activa=date('Y-m-d H:i:s');
                                $fecha_orden_cerrada='0000-00-00';
                            break;
							 
                        
                     }
                   }
                    $data=array
                    (
                        "id_usuario"=>$this->session->userdata('id'),
                        "tipo"=>$this->input->post('tipo',true),
                        "id_nodo"=>$this->input->post('id',true),
                        "id_cliente"=>$this->input->post('id_cliente',true),
                        "orden_de_trabajo"=>$this->input->post('id',true),
                        "descripcion_del_trabajo"=>$this->input->post('descripcion_del_trabajo',true),
                        "tamano_a_imprimir_1"=>$this->input->post('tamano_a_imprimir_1',true),
                        "tamano_a_imprimir_2"=>$this->input->post('tamano_a_imprimir_2',true),
                        "colores"=>$this->input->post('colores',true),
                        "procesos_adicionales"=>$this->input->post('procesos_adicionales',true),
                        "maquina"=>$this->input->post('maquina',true),
                        "estado"=>$this->input->post('estado',true),
                        "quien"=>$this->session->userdata('id'),
                        "cuando"=>date("Y-m-d"),
                        "glosa"=>$this->input->post('glosa',true),
                        "troquel"=>$this->input->post('troquel',true),
                        "proveedor"=>$this->input->post('proveedor',true),
                        "situacion"=>$situacion,
                        "fecha_pendiente"=>$fecha_pendiente,
                        "fecha_liberada"=>$fecha_liberada,
                        "fecha_activa"=>$fecha_activa,
                        "fecha_orden_cerrada"=>$fecha_orden_cerrada,
                        "descripcion_cartulina"=>$this->input->post('descripcion_cartulina',true),
                        "cantidad"=>$this->input->post('cantidad',true),
                        "gramaje"=>$this->input->post('gramaje',true),
                        "total_o_parcial"=>$this->input->post('total_o_parcial',true),
                        "can_despacho_1"=>$this->input->post('can_despacho_1',true),
                        "can_despacho_2"=>$this->input->post('can_despacho_2',true),
                        "can_despacho_3"=>$this->input->post('can_despacho_3',true),
                        "id_proveedor_acabado_1"=>$this->input->post('id_proveedor_acabado_1',true),
                        "id_proveedor_acabado_2"=>$this->input->post('id_proveedor_acabado_2',true),
                        "id_proveedor_acabado_3"=>$this->input->post('id_proveedor_acabado_3',true),  
                        "comentarios_imprenta"=>$this->input->post('comentarios_imprenta',true),                          
                    );
                    if(sizeof($control)==0)
                    {
                        $this->db->insert("produccion_imprenta_programacion",$data);
                        
                    }else
                    {
                        $this->db->update('produccion_imprenta_programacion', $data, array('tipo' => $this->input->post('tipo',true),'id_nodo'=>$this->input->post('id',true)));
                       
                    }    
                    switch($tipo)
                    {
                        case '1':
                            $this->session->set_flashdata('ControllerMessage', 'Se ha guardado el registro exitosamente.');					            
                            redirect(base_url().'produccion/cotizaciones/'.$this->input->post('pagina',true),  301);
                        break;
                         case '2':
                            $this->session->set_flashdata('ControllerMessage', 'Se ha guardado el registro exitosamente.');					            
                             redirect(base_url().'produccion/fast/'.$this->input->post('pagina',true),  301);
                        break;
                    }   
                }
            }
            $usuarios=$this->usuarios_model->getUsuariosPorTipo(3);
            $this->layout->view("imprenta_programacion",compact('usuarios','datos','tipo','pagina','id','control','ing','fotomecanica','cotizacion','hoja','control_cartulina','fotomecanica2','ordenDeCompra','orden','corte_cartulina','tapa','monda','mliner','materialidad_1','materialidad_2','materialidad_3','internos','externos','proveedores','total_kilos_control_cartulina')); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
        
	}
    /**
     * Desgajado
     * */
	 public function desgajado($tipo=null,$id=null,$pagina=null)
	{
        if($this->session->userdata('id'))
        {
          
            if(!$tipo or !$id){show_404();}
           switch($tipo)
                    {
                        case '1':
                            $datos=$this->cotizaciones_model->getCotizacionPorId($id);
                        break;
                         case '2':
                            $datos=$this->fast_track_model->getFastTrackPorId($id);
                        break;
                    }      
			if(sizeof($datos)==0){show_404();}
            $control=$this->produccion_model->getDesgajadoPorTipo($tipo,$id);
            $ing=$this->cotizaciones_model->getCotizacionIngenieriaPorIdCotizacion($id);
            $fotomecanica=$this->cotizaciones_model->getCotizacionFotomecanicaPorIdCotizacion($id);
            $troquelado=$this->produccion_model->getTroqueladoPorTipo($tipo,$id);
            $cotizacion=$this->cotizaciones_model->getCotizacionPorId($id);
            $hoja=$this->cotizaciones_model->getHojaDeCostosPorIdCotizacion($id);
            $orden=$this->orden_model->getOrdenesPorCotizacion($id);
	        $ordenDeCompra=$this->cotizaciones_model->getOrdenDeCompraPorCotizacion($id);
            $fotomecanica2=$this->produccion_model->getFotomecanicaPorTipo($tipo,$id);
            $corte_cartulina=$this->produccion_model->getCorteCartulinaPorTipo($tipo,$id);
            $corrugado=$this->produccion_model->getCorrugadoPorTipo($tipo,$id);
            $imprenta=$this->produccion_model->getImprentaProduccionPorTipo($tipo,$id);
            $emplacado=$this->produccion_model->getEmplacadoPorTipo($tipo,$id);
            if($this->input->post())
            {
                if($this->form_validation->run('produccion_desgajado'))
                {
                     if(sizeof($troquelado)==0)
                   {
                            $situacion='Pendiente';
                            $fecha_pendiente=date('Y-m-d H:i:s');
                            $fecha_liberada='0000-00-00';
                            $fecha_activa='0000-00-00';
                            $fecha_orden_cerrada='0000-00-00';
                   }else
                   {}
                     switch($this->input->post('estado',true))
                     {
                        case '1':
                            $situacion='Liberada';
                            $fecha_pendiente='0000-00-00';
                            $fecha_liberada=date('Y-m-d H:i:s');
                            $fecha_activa='0000-00-00';
                            $fecha_orden_cerrada='0000-00-00';
                        break;
                        case '0':
                            $situacion='Activa';
                            $fecha_pendiente='0000-00-00';
                            $fecha_liberada='0000-00-00';
                            $fecha_activa=date('Y-m-d H:i:s');
                            $fecha_orden_cerrada='0000-00-00';
                        break;
                        case '2':
                            $situacion='Activa';
                            $fecha_pendiente='0000-00-00';
                            $fecha_liberada='0000-00-00';
                            $fecha_activa=date('Y-m-d H:i:s');
                            $fecha_orden_cerrada='0000-00-00';
                        break;
                        default:
                            $situacion='Activa';
                            $fecha_pendiente='0000-00-00';
                            $fecha_liberada='0000-00-00';
                            $fecha_activa=date('Y-m-d H:i:s');
                            $fecha_orden_cerrada='0000-00-00';
                            break;
								case '':
                                $situacion='Activa';
                                $fecha_pendiente='0000-00-00';
                                $fecha_liberada='0000-00-00';
                                $fecha_activa=date('Y-m-d H:i:s');
                                $fecha_orden_cerrada='0000-00-00';
                            break;
							 case '3':
                                $situacion='Parcial';
                                $fecha_pendiente='0000-00-00';
                                $fecha_liberada='0000-00-00';
                                $fecha_activa=date('Y-m-d H:i:s');
                                $fecha_orden_cerrada='0000-00-00';
                            break;
                     
                   }
                    $data=array
                    (
                        "id_usuario"=>$this->session->userdata('id'),
                        "tipo"=>$this->input->post('tipo',true),
                        "id_nodo"=>$this->input->post('id',true),
                        "id_cliente"=>$this->input->post('id_cliente',true),
                        "orden_de_trabajo"=>$this->input->post('id',true),
                        "descripcion_del_trabajo"=>$this->input->post('descripcion_del_trabajo',true),
                        "numero_de_pliegos"=>$this->input->post('numero_de_pliegos',true),
                        "unidades_de_caja_por_pliego"=>$this->input->post('unidades_de_caja_por_pliego',true),
                        "total_piezas_por_pliego"=>$this->input->post('total_piezas_por_pliego',true),
                        "total_cajas_a_entregar"=>$this->input->post('total_cajas_a_entregar',true),
                        "operador"=>$this->input->post('operador',true),
                        "merma"=>$this->input->post('merma',true),
                        "estado"=>$this->input->post('estado',true),
                        "quien"=>$this->session->userdata('id'),
                        "cuando"=>date("Y-m-d"),
                        "glosa"=>$this->input->post('glosa',true),
                        "total_pliegos_troquelado"=>$this->input->post('total_pliegos_troquelado',true),
                        "total_piezas_a_desgajar"=>$this->input->post('total_piezas_a_desgajar',true),
                        "total_cajas_a_desgajar"=>$this->input->post('total_cajas_a_desgajar',true),
                        "total_desgajado"=>$this->input->post('total_desgajado',true),
                        "total_o_parcial"=>$this->input->post('total_o_parcial',true),
                        "situacion"=>$situacion,
                        "fecha_pendiente"=>$fecha_pendiente,
                        "fecha_liberada"=>$fecha_liberada,
                        "fecha_activa"=>$fecha_activa,
                        "fecha_orden_cerrada"=>$fecha_orden_cerrada,
                    );
                    if(sizeof($control)==0)
                    {
                        $this->db->insert("produccion_desgajado",$data);
                        
                    }else
                    {
                        $this->db->update('produccion_desgajado', $data, array('tipo' => $this->input->post('tipo',true),'id_nodo'=>$this->input->post('id',true)));
                       
                    }    
					
					
					//Parcial				
					
					$data2=array
                    (              
                       "id_usuario"=>$this->session->userdata('id'),
                        "tipo"=>$this->input->post('tipo',true),
                        "id_nodo"=>$this->input->post('id',true),
                        "id_cliente"=>$this->input->post('id_cliente',true),
                        "orden_de_trabajo"=>$this->input->post('id',true),
                        "descripcion_del_trabajo"=>$this->input->post('descripcion_del_trabajo',true),
                        "numero_de_pliegos"=>$this->input->post('numero_de_pliegos',true),
                        "unidades_de_caja_por_pliego"=>$this->input->post('unidades_de_caja_por_pliego',true),
                        "total_piezas_por_pliego"=>$this->input->post('total_piezas_por_pliego',true),
                        "total_cajas_a_entregar"=>$this->input->post('total_cajas_a_entregar',true),
                        "operador"=>$this->input->post('operador',true),
                        "merma"=>$this->input->post('merma',true),
                        "estado"=>$this->input->post('estado',true),
                        "quien"=>$this->session->userdata('id'),
                        "cuando"=>date("Y-m-d"),
                        "glosa"=>$this->input->post('glosa',true),
                        "total_pliegos_troquelado"=>$this->input->post('total_pliegos_troquelado',true),
                        "total_piezas_a_desgajar"=>$this->input->post('total_piezas_a_desgajar',true),
                        "total_cajas_a_desgajar"=>$this->input->post('total_cajas_a_desgajar',true),
                        "total_desgajado"=>$this->input->post('total_desgajado',true),
                        "total_o_parcial"=>$this->input->post('total_o_parcial',true),
                        "situacion"=>$situacion,
                        "fecha_pendiente"=>$fecha_pendiente,
                        "fecha_liberada"=>$fecha_liberada,
                        "fecha_activa"=>$fecha_activa,
                        "fecha_orden_cerrada"=>$fecha_orden_cerrada,
                    );
					
						 if($this->input->post('estado',true) == '3')
						 {
								$this->db->insert("produccion_desgajado_parcial",$data2);
						
						 }
					//Parcial Fin
					
					
					
                    switch($tipo)
                    {
                        case '1':
                            $this->session->set_flashdata('ControllerMessage', 'Se ha guardado el registro exitosamente.');					            redirect(base_url().'produccion/cotizaciones/'.$this->input->post('pagina',true),  301);
                        break;
                         case '2':
                            $this->session->set_flashdata('ControllerMessage', 'Se ha guardado el registro exitosamente.');					            redirect(base_url().'produccion/fast/'.$this->input->post('pagina',true),  301);
                        break;
                    }   
                }
            }
            $usuarios=$this->usuarios_model->getUsuariosPorTipo(8);
            $this->layout->view("desgajado",compact('usuarios','datos','tipo','pagina','id','control','ing','fotomecanica','cotizacion','hoja','troquelado','orden','ordenDeCompra','fotonecanica2','corte_cartulina','imprenta','corrugado','emplacado')); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
        
	}
    /**
     * Pegado
     * */
	 public function pegado($tipo=null,$id=null,$pagina=null)
	{
        if($this->session->userdata('id'))
        {
          
            if(!$tipo or !$id){show_404();}
           switch($tipo)
                    {
                        case '1':
                            $datos=$this->cotizaciones_model->getCotizacionPorId($id);
                        break;
                         case '2':
                            $datos=$this->fast_track_model->getFastTrackPorId($id);
                        break;
                    }      
			if(sizeof($datos)==0){show_404();}
            $control=$this->produccion_model->getPegadoPorTipo($tipo,$id);
            $ing=$this->cotizaciones_model->getCotizacionIngenieriaPorIdCotizacion($id);
            $fotomecanica=$this->cotizaciones_model->getCotizacionFotomecanicaPorIdCotizacion($id);
            $troquelado=$this->produccion_model->getTroqueladoPorTipo($tipo,$id);
            $cotizacion=$this->cotizaciones_model->getCotizacionPorId($id);
            $fotomecanica2=$this->produccion_model->getFotomecanicaPorTipo($tipo,$id);
            $hoja=$this->cotizaciones_model->getHojaDeCostosPorIdCotizacion($id);
            $ordenDeCompra=$this->cotizaciones_model->getOrdenDeCompraPorCotizacion($id);
            $orden=$this->orden_model->getOrdenesPorCotizacion($id);
            $troquelado=$this->produccion_model->getTroqueladoPorTipo($tipo,$id);
            $corte_cartulina=$this->produccion_model->getCorteCartulinaPorTipo($tipo,$id);
            $corrugado=$this->produccion_model->getCorrugadoPorTipo($tipo,$id);
            $imprenta=$this->produccion_model->getImprentaProduccionPorTipo($tipo,$id);
            $emplacado=$this->produccion_model->getEmplacadoPorTipo($tipo,$id);
            $producto=$this->productos_model->getProductosPorId($orden->producto_id);
            //print_r($producto);exit();
            if($this->input->post())
            {
                if($this->form_validation->run('produccion_pegado'))
                {
                    if(sizeof($troquelado)==0)
                   {
                            $situacion='Pendiente';
                            $fecha_pendiente=date('Y-m-d H:i:s');
                            $fecha_liberada='0000-00-00';
                            $fecha_activa='0000-00-00';
                            $fecha_orden_cerrada='0000-00-00';
                   }else
                   {}
			   
			   
			   
                     switch($this->input->post('estado',true))
                     {
                        case '1':
                            $situacion='Liberada';
                            $fecha_pendiente='0000-00-00';
                            $fecha_liberada=date('Y-m-d H:i:s');
                            $fecha_activa='0000-00-00';
                            $fecha_orden_cerrada='0000-00-00';
                        break;
                        case '0':
                            $situacion='Activa';
                            $fecha_pendiente='0000-00-00';
                            $fecha_liberada='0000-00-00';
                            $fecha_activa=date('Y-m-d H:i:s');
                            $fecha_orden_cerrada='0000-00-00';
                        break;
                        case '2':
                            $situacion='Activa';
                            $fecha_pendiente='0000-00-00';
                            $fecha_liberada='0000-00-00';
                            $fecha_activa=date('Y-m-d H:i:s');
                            $fecha_orden_cerrada='0000-00-00';
                        break;
                        default:
                            $situacion='Activa';
                            $fecha_pendiente='0000-00-00';
                            $fecha_liberada='0000-00-00';
                            $fecha_activa=date('Y-m-d H:i:s');
                            $fecha_orden_cerrada='0000-00-00';
                        break;

							 case '3':
                                $situacion='Parcial';
                                $fecha_pendiente='0000-00-00';
                                $fecha_liberada='0000-00-00';
                                $fecha_activa=date('Y-m-d H:i:s');
                                $fecha_orden_cerrada='0000-00-00';
                            break;
                     }
                   
				   
				   
				   
				   
				   
                    $data=array
                    (
                        "id_usuario"=>$this->session->userdata('id'),
                        "tipo"=>$this->input->post('tipo',true),
                        "id_nodo"=>$this->input->post('id',true),
                        "id_cliente"=>$this->input->post('id_cliente',true),
                        "orden_de_trabajo"=>$this->input->post('id',true),
                        "descripcion_del_trabajo"=>$this->input->post('descripcion_del_trabajo',true),
                        "total_cajas_recibidas"=>$this->input->post('total_cajas_recibidas',true),
                        "para_pegado"=>$this->input->post('para_pegado',true),
                        "empaquetado"=>$this->input->post('empaquetado',true),
                        "operador"=>$this->input->post('operador',true),
                        "cantidad_cajas_buenas"=>$this->input->post('cantidad_cajas_buenas',true),
                        "codigo_del_producto"=>$this->input->post('codigo_del_producto',true),
                        "cantidad_a_empaquetar"=>$this->input->post('cantidad_a_empaquetar',true),
                        "total_palet"=>$this->input->post('total_palet',true),
                        "cantidad_por_palet"=>$this->input->post('cantidad_por_palet',true),
                        "medidas_del_palet"=>$this->input->post('medidas_del_palet',true),
                        "entrega_parcial_o_total"=>$this->input->post('entrega_parcial_o_total',true),
                        "cantidad_pendiente"=>$this->input->post('cantidad_pendiente',true),
                        "numero_orden_de_compra"=>$this->input->post('numero_orden_de_compra',true),
                        "numero_orden_de_compra"=>$this->input->post('numero_orden_de_compra',true),
                        "estado"=>$this->input->post('estado',true),
                        "quien"=>$this->session->userdata('id'),
                        "cuando"=>date("Y-m-d"),
                        "glosa"=>$this->input->post('glosa',true),
                        "situacion"=>$situacion,
                        "fecha_pendiente"=>$fecha_pendiente,
                        "fecha_liberada"=>$fecha_liberada,
                        "fecha_activa"=>$fecha_activa,
                        "fecha_orden_cerrada"=>$fecha_orden_cerrada,
                        "tipo_pegado"=>$this->input->post("tipo_pegado",true),
                        "cantidad_por_paquete"=>$this->input->post("cantidad_por_paquete",true),
                    );
                    if(sizeof($control)==0)
                    {
                        $this->db->insert("produccion_pegado",$data);
                        
                    }else
                    {
                        $this->db->update('produccion_pegado', $data, array('tipo' => $this->input->post('tipo',true),'id_nodo'=>$this->input->post('id',true)));
                       
                    }    
					
					//Parcial				
					
					$data2=array
                    (              
                        "id_usuario"=>$this->session->userdata('id'),
                        "tipo"=>$this->input->post('tipo',true),
                        "id_nodo"=>$this->input->post('id',true),
                        "id_cliente"=>$this->input->post('id_cliente',true),
                        "orden_de_trabajo"=>$this->input->post('id',true),
                        "descripcion_del_trabajo"=>$this->input->post('descripcion_del_trabajo',true),
                        "total_cajas_recibidas"=>$this->input->post('total_cajas_recibidas',true),
                        "para_pegado"=>$this->input->post('para_pegado',true),
                        "empaquetado"=>$this->input->post('empaquetado',true),
                        "operador"=>$this->input->post('operador',true),
                        "cantidad_cajas_buenas"=>$this->input->post('cantidad_cajas_buenas',true),
                        "codigo_del_producto"=>$this->input->post('codigo_del_producto',true),
                        "cantidad_a_empaquetar"=>$this->input->post('cantidad_a_empaquetar',true),
                        "total_palet"=>$this->input->post('total_palet',true),
                        "cantidad_por_palet"=>$this->input->post('cantidad_por_palet',true),
                        "medidas_del_palet"=>$this->input->post('medidas_del_palet',true),
                        "entrega_parcial_o_total"=>$this->input->post('entrega_parcial_o_total',true),
                        "cantidad_pendiente"=>$this->input->post('cantidad_pendiente',true),
                        "numero_orden_de_compra"=>$this->input->post('numero_orden_de_compra',true),
                        "numero_orden_de_compra"=>$this->input->post('numero_orden_de_compra',true),
                        "estado"=>$this->input->post('estado',true),
                        "quien"=>$this->session->userdata('id'),
                        "cuando"=>date("Y-m-d"),
                        "glosa"=>$this->input->post('glosa',true),
                        "situacion"=>$situacion,
                        "fecha_pendiente"=>$fecha_pendiente,
                        "fecha_liberada"=>$fecha_liberada,
                        "fecha_activa"=>$fecha_activa,
                        "fecha_orden_cerrada"=>$fecha_orden_cerrada,
                        "tipo_pegado"=>$this->input->post("tipo_pegado",true),
                        "cantidad_por_paquete"=>$this->input->post("cantidad_por_paquete",true),
                    );
					
						 if($this->input->post('estado',true) == '3')
						 {
								$this->db->insert("produccion_pegado_parcial",$data2);
						
						 }
					//Parcial Fin
                    switch($tipo)
                    {
                        case '1':
                            $this->session->set_flashdata('ControllerMessage', 'Se ha guardado el registro exitosamente.');					            redirect(base_url().'produccion/cotizaciones/'.$this->input->post('pagina',true),  301);
                        break;
                         case '2':
                            $this->session->set_flashdata('ControllerMessage', 'Se ha guardado el registro exitosamente.');					            redirect(base_url().'produccion/fast/'.$this->input->post('pagina',true),  301);
                        break;
                    }   
                }
            }
            $usuarios=$this->usuarios_model->getUsuariosPorTipo(8);
            $this->layout->view("pegado",compact('usuarios','datos','tipo','pagina','id','control','ing','fotomecanica','cotizacion','hoja','troquelado','fotomecanica2','ordenDeCompra','orden','troquelado','corte_cartulina','imprenta','emplacado','corrugado','producto')); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
        
	}
    /**
     * Pegado
     * */
	 public function bodega($tipo=null,$id=null,$pagina=null,$ot=null)
	{ 
        if($this->session->userdata('id'))
        {                      
           if(!$tipo or !$id){show_404();}
           switch($tipo)
            {
                case '1':
                    $datos=$this->cotizaciones_model->getCotizacionPorId($id);
                break;
                 case '2':
                    $datos=$this->fast_track_model->getFastTrackPorId($id);
                break;
            }      
            if(sizeof($datos)==0){show_404();}
            $control=$this->produccion_model->getBodegaPorTipo($tipo,$id);
            $ing=$this->cotizaciones_model->getCotizacionIngenieriaPorIdCotizacion($id);
            $fotomecanica=$this->cotizaciones_model->getCotizacionFotomecanicaPorIdCotizacion($id);
            $fotomecanica2=$this->produccion_model->getFotomecanicaPorTipo($tipo,$id);
            $troquelado=$this->produccion_model->getTroqueladoPorTipo($tipo,$id);
            $cotizacion=$this->cotizaciones_model->getCotizacionPorId($id);
            $hoja=$this->cotizaciones_model->getHojaDeCostosPorIdCotizacion($id);
            $pegado=$this->produccion_model->getPegadoPorTipo($tipo,$id);
            $talleres_externos=$this->produccion_model->getTallerExternosPorTipo($tipo,$id);
            $ordenDeCompra=$this->cotizaciones_model->getOrdenDeCompraPorCotizacion($id);
            $orden=$this->orden_model->getOrdenesPorCotizacion($id);            
            $producto=$this->productos_model->getProductosPorId($orden->producto_id);
            if($this->input->post())
            {
                if($this->form_validation->run('produccion_bodega'))
                {
                    if(sizeof($talleres_externos)==0 or sizeof($pegado)==0)
                   {
                            $situacion='Pendiente';
                            $fecha_pendiente=date('Y-m-d H:i:s');
                            $fecha_liberada='0000-00-00';
                            $fecha_activa='0000-00-00';
                            $fecha_orden_cerrada='0000-00-00';
                   }else
                   {}
                     switch($this->input->post('estado',true))
                     {
                        case '1':
                            $situacion='Liberada';
                            $fecha_pendiente='0000-00-00';
                            $fecha_liberada=date('Y-m-d H:i:s');
                            $fecha_activa='0000-00-00';
                            $fecha_orden_cerrada='0000-00-00';
                        break;
                        case '0':
                            $situacion='Activa';
                            $fecha_pendiente='0000-00-00';
                            $fecha_liberada='0000-00-00';
                            $fecha_activa=date('Y-m-d H:i:s');
                            $fecha_orden_cerrada='0000-00-00';
                        break;
                        case '2':
                            $situacion='Activa';
                            $fecha_pendiente='0000-00-00';
                            $fecha_liberada='0000-00-00';
                            $fecha_activa=date('Y-m-d H:i:s');
                            $fecha_orden_cerrada='0000-00-00';
                        break;
                        default:
                            $situacion='Activa';
                            $fecha_pendiente='0000-00-00';
                            $fecha_liberada='0000-00-00';
                            $fecha_activa=date('Y-m-d H:i:s');
                            $fecha_orden_cerrada='0000-00-00';
                        break;
						 case '3':
                            $situacion='Parcial';
                            $fecha_pendiente='0000-00-00';
                            $fecha_liberada='0000-00-00';
                            $fecha_activa=date('Y-m-d H:i:s');
                            $fecha_orden_cerrada='0000-00-00';
                        break;
                     }
                   
                    
                    //$total_de_ingresos = $this->input->post('cantidades_a_ingresar',true)+$control->total_de_ingresos;
                    //$total_cajas_pendientes = $ordenDeCompra->cantidad_de_cajas+$total_de_ingresos;
                    
                     
                    $total_de_ingresos = $this->input->post('cantidades_a_ingresar',true)+$control->total_de_ingresos;
                    $total_cajas_pendientes = $ordenDeCompra->cantidad_de_cajas-$total_de_ingresos;

                    $data=array
                    (
                        "id_usuario"=>$this->session->userdata('id'),
                        "tipo"=>$this->input->post('tipo',true),
                        "id_nodo"=>$this->input->post('id',true),
                        "id_cliente"=>$this->input->post('id_cliente',true),
                        "orden_de_trabajo"=>$this->input->post('id',true),
                        "descripcion_del_trabajo"=>$this->input->post('descripcion_del_trabajo',true),
                        "fecha_de_entrega"=>$this->input->post('fecha_de_entrega',true),
                        "ingreso_a_bodega"=>$this->input->post('ingreso_a_bodega',false),
                        "numero_de_orden_de_trabajo"=>$this->input->post('numero_de_orden_de_trabajo',true),
                        "cantidad_de_cajas"=>$this->input->post('cantidad_de_cajas',true),
                        "precio_venta"=>$this->input->post('precio_venta',true),
                        "codigo_producto"=>$this->input->post('codigo_producto',true),
                        "unidades_por_paquete_oficial"=>$this->input->post('unidades_por_paquete_oficial',true),
                        "unidades_paquete_efectivo"=>$this->input->post('unidades_paquete_efectivo',true),
                        "paquetes_por_pallet"=>$this->input->post('paquetes_por_pallet',true),
                        "medidas_de_pallet"=>$this->input->post('medidas_de_pallet',true),
                        //"total_de_ingresos"=>$this->input->post('total_de_ingresos',true),
                        "total_de_ingresos"=>$total_de_ingresos,
                        "total_cajas_ingresadas"=>$this->input->post('total_cajas_ingresadas',true),
                        "listado_ingresos_cantidades"=>$this->input->post('listado_ingresos_cantidades',true),
                        "cantidades_a_ingresar"=>$this->input->post('cantidades_a_ingresar',true),
                        "total_cajas_pendientes"=>$total_cajas_pendientes,
                        "cierra_la_orden"=>$this->input->post('cierra_la_orden',true),
                        "estado"=>$this->input->post('estado',true),
                        "quien"=>$this->session->userdata('id'),
                        "cuando"=>date("Y-m-d"),
                        "glosa"=>$this->input->post('glosa',true),
                        "situacion"=>$situacion,
                        "fecha_pendiente"=>$fecha_pendiente,
                        "fecha_liberada"=>$fecha_liberada,
                        "fecha_activa"=>$fecha_activa,
                        "fecha_orden_cerrada"=>$fecha_orden_cerrada,
                    );
                    
                  //  print_r($data);exit();
                    
                    if(sizeof($control)==0)
                    {
                        $this->db->insert("produccion_bodega",$data);                        
                    }else
                    {
                        $this->db->update('produccion_bodega', $data, array('tipo' => $this->input->post('tipo',true),'id_nodo'=>$this->input->post('id',true)));                       
                    }    
					
		//Parcial				
					
		   $data2=array
                    (              
                        "id_usuario"=>$this->session->userdata('id'),
                        "tipo"=>$this->input->post('tipo',true),
                        "id_nodo"=>$this->input->post('id',true),
                        "id_cliente"=>$this->input->post('id_cliente',true),
                        "orden_de_trabajo"=>$this->input->post('id',true),
                        "descripcion_del_trabajo"=>$this->input->post('descripcion_del_trabajo',true),
                        "fecha_de_entrega"=>$this->input->post('fecha_de_entrega',true),
                        "ingreso_a_bodega"=>$this->input->post('ingreso_a_bodega',false),
                        "numero_de_orden_de_trabajo"=>$this->input->post('numero_de_orden_de_trabajo',true),
                        "cantidad_de_cajas"=>$this->input->post('cantidad_de_cajas',true),
                        "precio_venta"=>$this->input->post('precio_venta',true),
                        "codigo_producto"=>$this->input->post('codigo_producto',true),
                        "unidades_por_paquete_oficial"=>$this->input->post('unidades_por_paquete_oficial',true),
                        "unidades_paquete_efectivo"=>$this->input->post('unidades_paquete_efectivo',true),
                        "paquetes_por_pallet"=>$this->input->post('paquetes_por_pallet',true),
                        "medidas_de_pallet"=>$this->input->post('medidas_de_pallet',true),
                        "total_de_ingresos"=>$this->input->post('total_de_ingresos',true),
                        "total_cajas_ingresadas"=>$this->input->post('total_cajas_ingresadas',true),
                        "listado_ingresos_cantidades"=>$this->input->post('listado_ingresos_cantidades',true),
                        "cantidades_a_ingresar"=>$this->input->post('cantidades_a_ingresar',true),
                        "total_cajas_pendientes"=>$this->input->post('total_cajas_pendientes',true),
                        "cierra_la_orden"=>$this->input->post('cierra_la_orden',true),
                        "estado"=>$this->input->post('estado',true),
                        "quien"=>$this->session->userdata('id'),
                        "cuando"=>date("Y-m-d"),
                        "glosa"=>$this->input->post('glosa',true),
                        "situacion"=>$situacion,
                        "fecha_pendiente"=>$fecha_pendiente,
                        "fecha_liberada"=>$fecha_liberada,
                        "fecha_activa"=>$fecha_activa,
                        "fecha_orden_cerrada"=>$fecha_orden_cerrada,
                    );
					
                    if($this->input->post('estado',true) == '3')
                    {
                        $this->db->insert("produccion_bodega_parcial",$data);
                    }
		
                    //Parcial Fin										
                    switch($tipo)
                    {
                        case '1':
                            $this->session->set_flashdata('ControllerMessage', 'Se ha guardado el registro exitosamente.');					            
                            redirect(base_url().'produccion/cotizaciones/'.$this->input->post('pagina',true),  301);
                        break;
                         case '2':
                            $this->session->set_flashdata('ControllerMessage', 'Se ha guardado el registro exitosamente.');					            
                            redirect(base_url().'produccion/fast/'.$this->input->post('pagina',true),  301);
                        break;
                    }   
                }
            }
            $usuarios=$this->usuarios_model->getUsuariosPorTipo(3);
            $this->layout->view("bodega",compact('usuarios','datos','tipo','pagina','id','control','ing','fotomecanica','cotizacion','hoja','troquelado','orden','pegado','fotomecanica2','ordenDeCompra','talleres_externos','producto')); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
        
	}
			
	    public function listadoproduccion()
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
            
              $this->layout->css
            (
                array
                (
                    base_url()."public/backend/fancybox/jquery.fancybox.css"
                )
            );
            $this->layout->js
            (
                array
                (
                    base_url()."public/backend/fancybox/jquery.fancybox.js"
                )
            );
            $this->layout->view('listadoproduccion'); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
    }
	
	
	
	
	 public function validarListadoProduccionPorModulo()
				{
					if($this->session->userdata('id'))
					{
						$this->layout->setLayout('template_ajax');
						
				
						
						
						//Fotomecanica
						if($this->input->post('valor2',true) == 'Fotomecanica')
						{
							
						$nop = $this->input->post('valor1',true);
							
						$this->layout->view('ajax_listado_fotomecanica',compact('nop','valor2')); 	
					
						}
						
						//Listado Control Cartulina 
						if($this->input->post('valor2',true) == 'Listado Control Cartulina')
						{
							$nop = $this->input->post('valor1',true);
							$Buscar_estado = $this->input->post('valor3',true);
							$vendedor = $this->input->post('valor4',true);

						$this->layout->view('ajax_listado_cartulinas_general',compact('nop','valor2','Buscar_estado','vendedor')); 							
						}
						
						/*
						//Control Cartulina
						if($this->input->post('valor2',true) == 'Control Cartulina')
						{
							$nop = $this->input->post('valor1',true);
							
							
						$this->layout->view('ajax_listado_ccartulina',compact('nop','valor2')); 	
						
						}
						*/
						/*
						//Control Cartulina Estado
						if($this->input->post('valor2',true) == 'Control Cartulina Estado')
						{
							$nop = $this->input->post('valor1',true);
						$this->layout->view('ajax_listado_ccartulina_estado',compact('nop','valor2')); 	
						}
						*/
						
						
						//Listado Bobindado Cartulina
						if($this->input->post('valor2',true) == 'Listado Bobinado Cartulina')
						{
							$nop = $this->input->post('valor1',true);
							$Buscar_estado = $this->input->post('valor3',true);
							$vendedor = $this->input->post('valor4',true);
							
						$this->layout->view('ajax_listado_bobinado_cartulina_general',compact('nop','valor2','Buscar_estado','vendedor'));	
						}
						
						/*
						//Bobindado Cartulina
						if($this->input->post('valor2',true) == 'Bobinado Cartulina')
						{
							$nop = $this->input->post('valor1',true);
						$this->layout->view('ajax_listado_bobinadocartulina',compact('nop','valor2')); 	
						}
						
							//Bobindado Cartulina Estado
						if($this->input->post('valor2',true) == 'Bobinado Cartulina Estado')
						{
							$nop = $this->input->post('valor1',true);
						$this->layout->view('ajax_listado_bobinadocartulina_estado',compact('nop','valor2')); 	
						}
						
						*/
						
						//Listado Control Onda 
						if($this->input->post('valor2',true) == 'Listado Control Onda')
						{
							$nop = $this->input->post('valor1',true);
							$Buscar_estado = $this->input->post('valor3',true);
							$vendedor = $this->input->post('valor4',true);

						$this->layout->view('ajax_listado_onda_general',compact('nop','valor2','Buscar_estado','vendedor')); 							
						}
						
						
						/*
						//Control Onda
						if($this->input->post('valor2',true) == 'Control Onda')
						{
							$nop = $this->input->post('valor1',true);
						$this->layout->view('ajax_listado_conda',compact('nop','valor2')); 	
						}
						
						//Control Onda Estado
						if($this->input->post('valor2',true) == 'Control Onda Estado')
						{
							
						$nop = $this->input->post('valor1',true);
					      $this->layout->view('ajax_listado_conda_estado',compact('nop','valor2')); 
                    
						}
						*/
						
						//Bobindado Onda
						if($this->input->post('valor2',true) == 'Bobinado Onda')
						{
						$nop = $this->input->post('valor1',true);
						$this->layout->view('ajax_listado_bobinadoonda',compact('nop','valor2')); 	
						}
						
						
						
						//Bobindado Onda Estado
						if($this->input->post('valor2',true) == 'Bobinado Onda Estado')
						{
							$nop = $this->input->post('valor1',true);
						$this->layout->view('ajax_listado_bobinadoonda_estado',compact('nop','valor2')); 	
						}
						
						
						
						
						//Listado Control Liner 
						if($this->input->post('valor2',true) == 'Listado Control Liner')
						{
							$nop = $this->input->post('valor1',true);
							$Buscar_estado = $this->input->post('valor3',true);
							$vendedor = $this->input->post('valor4',true);

						$this->layout->view('ajax_listado_liner_general',compact('nop','valor2','Buscar_estado','vendedor')); 							
						}
						
						
						//Control Liner
						if($this->input->post('valor2',true) == 'Control Liner')
						{
						$this->layout->view('ajax_listado_cliner',compact('valor1','valor2')); 	
						}
						
						//Control Liner Estado
						if($this->input->post('valor2',true) == 'Control Liner Estado')
						{
						$this->layout->view('ajax_listado_cliner_estado',compact('valor1','valor2')); 	
						}
						
						
						
						//Bobindado Liner
						if($this->input->post('valor2',true) == 'Bobinado Liner')
						{
						$this->layout->view('ajax_listado_bobinadoliner',compact('valor1','valor2')); 	
						}
						
						//Bobindado Liner Estado
						if($this->input->post('valor2',true) == 'Bobinado Liner Estado')
						{
						$this->layout->view('ajax_listado_bobinadoliner_Estado',compact('valor1','valor2')); 	
						}
						
						
						
						
						//Confeccion Molde Troquel
						if($this->input->post('valor2',true) == 'Confeccion Molde Troquel')
						{
						$this->layout->view('ajax_listado_confeccion_molde_troquel',compact('valor1','valor2')); 	
						}
						
						
						
						
						
						
						//Corte Cartulina
						if($this->input->post('valor2',true) == 'Corte Cartulina')
						{
						$this->layout->view('ajax_listado_corte_cartulina',compact('valor1','valor2')); 	
						}
						
						//Corte Cartulina Estado
						if($this->input->post('valor2',true) == 'Corte Cartulina Estado')
						{
						$this->layout->view('ajax_listado_corte_cartulina_estado',compact('valor1','valor2')); 	
						}
						
						
						
						//Imprenta Programacion
						if($this->input->post('valor2',true) == 'Imprenta Programacion')
						{
						$this->layout->view('ajax_listado_imprenta_programacion_estado',compact('valor1','valor2')); 	
						}
						
						
						//Imprenta Produccion
						if($this->input->post('valor2',true) == 'Imprenta Produccion')
						{
						$this->layout->view('ajax_listado_imprenta_produccion',compact('valor1','valor2')); 	
						}
						//Imprenta Produccion Estado
						if($this->input->post('valor2',true) == 'Imprenta Produccion Estado')
						{
						$this->layout->view('ajax_listado_imprenta_produccion_estado',compact('valor1','valor2')); 	
						}
						
						
						//Servicios Post Imprenta
						if($this->input->post('valor2',true) == 'Servicios Post Imprenta')
						{
						$this->layout->view('ajax_listado_servicios_post_imprenta',compact('valor1','valor2')); 	
						}
						
						//Servicios Post Imprenta Estado
						if($this->input->post('valor2',true) == 'Servicios Post Imprenta Estado')
						{
						$this->layout->view('ajax_listado_servicios_post_imprenta_estado',compact('valor1','valor2')); 	
						}
							

						
							//Corrugado
						if($this->input->post('valor2',true) == 'Corrugado')
						{
						$this->layout->view('ajax_listado_corrugado',compact('valor1','valor2')); 	
						}
						
							//Corrugado Estado
						if($this->input->post('valor2',true) == 'Corrugado Estado')
						{
						$this->layout->view('ajax_listado_corrugado_estado',compact('valor1','valor2')); 	
						}
						
						
						//Emplacado
						if($this->input->post('valor2',true) == 'Emplacado')
						{
						$this->layout->view('ajax_listado_emplacado',compact('valor1','valor2')); 	
						}
						
						//Emplacado Estado
						if($this->input->post('valor2',true) == 'Emplacado Estado')
						{
						$this->layout->view('ajax_listado_emplacado_estado',compact('valor1','valor2')); 	
						}
						
						
						
						
						
						//Troquelado
						if($this->input->post('valor2',true) == 'Troquelado')
						{
						$this->layout->view('ajax_listado_troquelado',compact('valor1','valor2')); 	
						}
						
						
						//Troquelado Estado
						if($this->input->post('valor2',true) == 'Troquelado Estado')
						{
						$this->layout->view('ajax_listado_troquelado_estado',compact('valor1','valor2')); 	
						}
						
							//Taller Pegado Externo
						if($this->input->post('valor2',true) == 'Taller Pegado Externo')
						{
						$this->layout->view('ajax_listado_taller_pegado_externo',compact('valor1','valor2')); 	
						}
						
							//Taller Pegado Externo estado
						if($this->input->post('valor2',true) == 'Taller Pegado Externo Estado')
						{
						$this->layout->view('ajax_listado_taller_pegado_externo_estado',compact('valor1','valor2')); 	
						}
						
						
						//Desgajado
						if($this->input->post('valor2',true) == 'Desgajado')
						{
						$this->layout->view('ajax_listado_desgajado',compact('valor1','valor2')); 	
						}
						
						
						
						//Desgajado Estado
						if($this->input->post('valor2',true) == 'Desgajado Estado')
						{
						$this->layout->view('ajax_listado_desgajado_estado',compact('valor1','valor2')); 	
						}
						
						
						 //Pegado
						if($this->input->post('valor2',true) == 'Pegado')
						{
						$this->layout->view('ajax_listado_pegado',compact('valor1','valor2')); 	
						}
						 //Pegado Estado
						if($this->input->post('valor2',true) == 'Pegado Estado')
						{
						$this->layout->view('ajax_listado_pegado_estado',compact('valor1','valor2')); 	
						}


						//Bodega Parcial
						if($this->input->post('valor2',true) == 'Bodega Ingreso Parciales')
						{
						$this->layout->view('ajax_listado_bodega_parcial',compact('valor1','valor2')); 	
						}
						
						//Bodega Estado
						if($this->input->post('valor2',true) == 'Bodega Estado')
						{
						$this->layout->view('ajax_listado_bodega_estado',compact('valor1','valor2')); 	
						}
						
							//Bodega Trato pegado
						if($this->input->post('valor2',true) == 'Bodega Trato pegado' and $this->input->post('valor4',true) != '')
						{
							
							$desde =$this->input->post('valor1',true);
							$hasta =$this->input->post('valor3',true);
							$operador1 =$this->input->post('valor4',true);
							
							
							//echo $operador1;exit;
						$this->layout->view('ajax_listado_bodega_pegado',compact('desde','valor2','hasta','operador1')); 	
						}
						
						
						
						
				//		$this->layout->view('ajax_listado_fotomecanica',compact('valor1','valor2')); 
					}else
					{
						redirect(base_url().'usuarios/login',  301);
					}
					
				}
	
	
	//Filtro para pagina
	   public function listadoproduccionFotomecanica()
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
			$datos=$this->orden_model->getOrdenesConCotizacionPaginacion2($pagina,$porpagina,"limit");
			$cuantos=$this->orden_model->getOrdenesConCotizacionPaginacion2($pagina,$porpagina,"cuantos");
			$config['base_url'] = base_url().'produccion/listadoproduccionFotomecanica';
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
              $this->layout->css
            (
                array
                (
                    base_url()."public/backend/fancybox/jquery.fancybox.css"
                )
            );
            $this->layout->js
            (
                array
                (
                    base_url()."public/backend/fancybox/jquery.fancybox.js"
                )
            );
			
            $this->layout->view('listadoproduccionFotomecanica',compact("datos","id","pagina")); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
    }
	
	
	 public function listadoproduccionPegado()
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
			$datos=$this->orden_model->getOrdenesConCotizacionPaginacion2($pagina,$porpagina,"limit");
			$cuantos=$this->orden_model->getOrdenesConCotizacionPaginacion2($pagina,$porpagina,"cuantos");
			$config['base_url'] = base_url().'produccion/listadoproduccionPegado';
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
              $this->layout->css
            (
                array
                (
                    base_url()."public/backend/fancybox/jquery.fancybox.css"
                )
            );
            $this->layout->js
            (
                array
                (
                    base_url()."public/backend/fancybox/jquery.fancybox.js"
                )
            );
			
            $this->layout->view('listadoproduccionPegado',compact("datos","id","pagina")); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
    }
	
	public function listadoproduccionDesgajado()
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
			$datos=$this->orden_model->getOrdenesConCotizacionPaginacion2($pagina,$porpagina,"limit");
			$cuantos=$this->orden_model->getOrdenesConCotizacionPaginacion2($pagina,$porpagina,"cuantos");
			$config['base_url'] = base_url().'produccion/listadoproduccionDesgajado';
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
              $this->layout->css
            (
                array
                (
                    base_url()."public/backend/fancybox/jquery.fancybox.css"
                )
            );
            $this->layout->js
            (
                array
                (
                    base_url()."public/backend/fancybox/jquery.fancybox.js"
                )
            );
			
            $this->layout->view('listadoproduccionDesgajado',compact("datos","id","pagina")); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
    }
	
	
	public function listadoproduccionCCartulina()
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
			$datos=$this->orden_model->getOrdenesConCotizacionPaginacion2($pagina,$porpagina,"limit");
			$cuantos=$this->orden_model->getOrdenesConCotizacionPaginacion2($pagina,$porpagina,"cuantos");
			$config['base_url'] = base_url().'produccion/listadoproduccionCCartulina';
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
              $this->layout->css
            (
                array
                (
                    base_url()."public/backend/fancybox/jquery.fancybox.css"
                )
            );
            $this->layout->js
            (
                array
                (
                    base_url()."public/backend/fancybox/jquery.fancybox.js"
                )
            );
			
            $this->layout->view('listadoproduccionCCartulina',compact("datos","id","pagina")); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
    }
	
	public function listadoproduccionCCartulina_estado()
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
			$datos=$this->orden_model->getCCartulinaEstadoConCotizacionPaginacion($pagina,$porpagina,"limit");
			$cuantos=$this->orden_model->getCCartulinaEstadoConCotizacionPaginacion($pagina,$porpagina,"cuantos");
			$config['base_url'] = base_url().'produccion/listadoproduccionCCartulina_estado';
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
              $this->layout->css
            (
                array
                (
                    base_url()."public/backend/fancybox/jquery.fancybox.css"
                )
            );
            $this->layout->js
            (
                array
                (
                    base_url()."public/backend/fancybox/jquery.fancybox.js"
                )
            );
			
            $this->layout->view('listadoproduccionCCartulina_estado',compact("datos","id","pagina")); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
    }
	
	public function listadoproduccionbobinadocartulina()
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
			$datos=$this->produccion_model->getBobinadoCartulinaConCotizacionPaginacion($pagina,$porpagina,"limit");
			$cuantos=$this->produccion_model->getBobinadoCartulinaConCotizacionPaginacion($pagina,$porpagina,"cuantos");
			$config['base_url'] = base_url().'produccion/listadoproduccionbobinadocartulina';
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
              $this->layout->css
            (
                array
                (
                    base_url()."public/backend/fancybox/jquery.fancybox.css"
                )
            );
            $this->layout->js
            (
                array
                (
                    base_url()."public/backend/fancybox/jquery.fancybox.js"
                )
            );
			
            $this->layout->view('listadoproduccionbobinadocartulina',compact("datos","id","pagina")); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
    }
	
	public function listadoproduccionbobinadocartulina_estado()
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
			$datos=$this->produccion_model->getBobinadoCartulinaEstadoConCotizacionPaginacion($pagina,$porpagina,"limit");
			$cuantos=$this->produccion_model->getBobinadoCartulinaEstadoConCotizacionPaginacion($pagina,$porpagina,"cuantos");
			$config['base_url'] = base_url().'produccion/listadoproduccionbobinadocartulina_estado';
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
              $this->layout->css
            (
                array
                (
                    base_url()."public/backend/fancybox/jquery.fancybox.css"
                )
            );
            $this->layout->js
            (
                array
                (
                    base_url()."public/backend/fancybox/jquery.fancybox.js"
                )
            );
			
            $this->layout->view('listadoproduccionbobinadocartulina_estado',compact("datos","id","pagina")); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
    }
	
	public function listadoproduccionbobinadoonda()
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
			$datos=$this->produccion_model->getBobinadoOndaConCotizacionPaginacion($pagina,$porpagina,"limit");
			$cuantos=$this->produccion_model->getBobinadoOndaConCotizacionPaginacion($pagina,$porpagina,"cuantos");
			$config['base_url'] = base_url().'produccion/listadoproduccionbobinadoonda';
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
              $this->layout->css
            (
                array
                (
                    base_url()."public/backend/fancybox/jquery.fancybox.css"
                )
            );
            $this->layout->js
            (
                array
                (
                    base_url()."public/backend/fancybox/jquery.fancybox.js"
                )
            );
			
            $this->layout->view('listadoproduccionbobinadoonda',compact("datos","id","pagina")); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
    }
	
	
	
	
	
	
	
	
	
	public function listadoproduccionCOnda()
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
			$datos=$this->produccion_model->getCOndaConCotizacionPaginacion($pagina,$porpagina,"limit");
			$cuantos=$this->produccion_model->getCOndaConCotizacionPaginacion($pagina,$porpagina,"cuantos");
			$config['base_url'] = base_url().'produccion/listadoproduccionCOnda';
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
              $this->layout->css
            (
                array
                (
                    base_url()."public/backend/fancybox/jquery.fancybox.css"
                )
            );
            $this->layout->js
            (
                array
                (
                    base_url()."public/backend/fancybox/jquery.fancybox.js"
                )
            );
			
            $this->layout->view('listadoproduccionCOnda',compact("datos","id","pagina")); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
    }
	
	
	
	
	
	public function listadoproduccionCLiner()
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
			$datos=$this->produccion_model->getCLinerConCotizacionPaginacion($pagina,$porpagina,"limit");
			$cuantos=$this->produccion_model->getCLinerConCotizacionPaginacion($pagina,$porpagina,"cuantos");
			$config['base_url'] = base_url().'produccion/listadoproduccionCLiner';
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
              $this->layout->css
            (
                array
                (
                    base_url()."public/backend/fancybox/jquery.fancybox.css"
                )
            );
            $this->layout->js
            (
                array
                (
                    base_url()."public/backend/fancybox/jquery.fancybox.js"
                )
            );
			
            $this->layout->view('listadoproduccionCLiner',compact("datos","id","pagina")); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
    }
	
	
	public function listadoproduccionbobinadoliner()
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
			$datos=$this->produccion_model->getBobinadoLinerConCotizacionPaginacion($pagina,$porpagina,"limit");
			$cuantos=$this->produccion_model->getBobinadoLinerConCotizacionPaginacion($pagina,$porpagina,"cuantos");
			$config['base_url'] = base_url().'produccion/listadoproduccionbobinadoliner';
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
              $this->layout->css
            (
                array
                (
                    base_url()."public/backend/fancybox/jquery.fancybox.css"
                )
            );
            $this->layout->js
            (
                array
                (
                    base_url()."public/backend/fancybox/jquery.fancybox.js"
                )
            );
			
            $this->layout->view('listadoproduccionbobinadoliner',compact("datos","id","pagina")); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
    }
	
	
	
		public function listadoproduccioncorte_cartulina()
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
			$datos=$this->produccion_model->getCorteCartulinaConCotizacionPaginacion($pagina,$porpagina,"limit");
			$cuantos=$this->produccion_model->getCorteCartulinaConCotizacionPaginacion($pagina,$porpagina,"cuantos");
			$config['base_url'] = base_url().'produccion/listadoproduccioncorte_cartulina';
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
              $this->layout->css
            (
                array
                (
                    base_url()."public/backend/fancybox/jquery.fancybox.css"
                )
            );
            $this->layout->js
            (
                array
                (
                    base_url()."public/backend/fancybox/jquery.fancybox.js"
                )
            );
			
            $this->layout->view('listadoproduccioncorte_cartulina',compact("datos","id","pagina")); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
    }
	
	
    public function listadoproduccion_imprenta_produccion()
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
			$datos=$this->produccion_model->getImprentaProduccionConCotizacionPaginacion($pagina,$porpagina,"limit");
			$cuantos=$this->produccion_model->getImprentaProduccionConCotizacionPaginacion($pagina,$porpagina,"cuantos");
			$config['base_url'] = base_url().'produccion/listadoproduccion_imprenta_produccion';
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
              $this->layout->css
            (
                array
                (
                    base_url()."public/backend/fancybox/jquery.fancybox.css"
                )
            );
            $this->layout->js
            (
                array
                (
                    base_url()."public/backend/fancybox/jquery.fancybox.js"
                )
            );
			
            $this->layout->view('listadoproduccion_imprenta_produccion',compact("datos","id","pagina")); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
    }
	
	
	 public function listadoproduccion_servicios_post_imprenta()
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
			$datos=$this->produccion_model->getImprentaProduccionConCotizacionPaginacion($pagina,$porpagina,"limit");
			$cuantos=$this->produccion_model->getImprentaProduccionConCotizacionPaginacion($pagina,$porpagina,"cuantos");
			$config['base_url'] = base_url().'produccion/listadoproduccion_servicios_post_imprenta';
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
              $this->layout->css
            (
                array
                (
                    base_url()."public/backend/fancybox/jquery.fancybox.css"
                )
            );
            $this->layout->js
            (
                array
                (
                    base_url()."public/backend/fancybox/jquery.fancybox.js"
                )
            );
			
            $this->layout->view('listadoproduccion_servicios_post_imprenta',compact("datos","id","pagina")); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
    }
	
	
	 public function listadoproduccion_corrugado()
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
			$datos=$this->produccion_model->getCorrugadoCotizacionPaginacion($pagina,$porpagina,"limit");
			$cuantos=$this->produccion_model->getCorrugadoCotizacionPaginacion($pagina,$porpagina,"cuantos");
			$config['base_url'] = base_url().'produccion/listadoproduccion_corrugado';
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
              $this->layout->css
            (
                array
                (
                    base_url()."public/backend/fancybox/jquery.fancybox.css"
                )
            );
            $this->layout->js
            (
                array
                (
                    base_url()."public/backend/fancybox/jquery.fancybox.js"
                )
            );
			
            $this->layout->view('listadoproduccion_corrugado',compact("datos","id","pagina")); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
    }
	
	
	
	 public function listadoproduccion_emplacado()
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
			$datos=$this->produccion_model->getEmplacadoCotizacionPaginacion($pagina,$porpagina,"limit");
			$cuantos=$this->produccion_model->getEmplacadoCotizacionPaginacion($pagina,$porpagina,"cuantos");
			$config['base_url'] = base_url().'produccion/listadoproduccion_emplacado';
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
              $this->layout->css
            (
                array
                (
                    base_url()."public/backend/fancybox/jquery.fancybox.css"
                )
            );
            $this->layout->js
            (
                array
                (
                    base_url()."public/backend/fancybox/jquery.fancybox.js"
                )
            );
			
            $this->layout->view('listadoproduccion_emplacado',compact("datos","id","pagina")); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
    }
	
	
	
	
	 public function listadoproduccion_troquelado()
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
			$datos=$this->produccion_model->getTroqueladoCotizacionPaginacion($pagina,$porpagina,"limit");
			$cuantos=$this->produccion_model->getTroqueladoCotizacionPaginacion($pagina,$porpagina,"cuantos");
			$config['base_url'] = base_url().'produccion/listadoproduccion_troquelado';
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
              $this->layout->css
            (
                array
                (
                    base_url()."public/backend/fancybox/jquery.fancybox.css"
                )
            );
            $this->layout->js
            (
                array
                (
                    base_url()."public/backend/fancybox/jquery.fancybox.js"
                )
            );
			
            $this->layout->view('listadoproduccion_troquelado',compact("datos","id","pagina")); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
    }
	
    
    public function guia_despachos($id=null,$dato=null,$pagina=null)
    {
        if(!$id){show_404();}
        $datos=$this->orden_model->getOrdenesPorCotizacionPorId2($id);
        $bodega=$this->produccion_model->getBodegaPorIdnodo($id);
        $cot=$this->cotizaciones_model->getCotizacionPorId($id);
	$cliente=$this->clientes_model->getClientePorIdParaDespacho($cot->id_cliente);	
        $orden=$this->orden_model->getOrdenesPorCotizacion($id);     
        $ordenDeCompra=$this->cotizaciones_model->getOrdenDeCompraPorCotizacion($id);
        $producto=$this->productos_model->getProductosPorId($orden->producto_id);
        
        
        $despacho = $this->despachos_model->getDespachosUltimoRegistro($ordenDeCompra->id_cotizacion);
        
        if($despacho->cantidad_faltante=="" || $despacho->cantidad_faltante==0){    
        $cantidad_faltante = $ordenDeCompra->cantidad_de_cajas - $this->input->post('total_cajas',true);
        }else{
        $cantidad_faltante = $despacho->cantidad_faltante - $this->input->post('total_cajas',true);    
        }
        
        $datosdespacho = array(
            'id_nodo'=>$ordenDeCompra->id_cotizacion,
            'cantidad_total'=>$ordenDeCompra->cantidad_de_cajas,
            'cantidad_ingresada'=>$this->input->post('total_cajas',true),
            'cantidad_faltante'=>$cantidad_faltante,
            'fecha'=>date('Y-m-d'),
            'cierra_la_orden'=>$this->input->post('cierra_la_orden',true),
        );
        
       // print_r($datosdespacho);exit();
        
        if($this->input->post())
        {
           if($this->input->post('cierra_la_orden',true)=="SI"){
            $cierralaorden = array(
                'estado'=>3
                );
            //echo $id;
              //  print_r($cierralaorden);exit();
            $this->db->where('id_cotizacion', $id);
            $this->db->update("orden_de_produccion",$cierralaorden);
           // echo $this->db->last_query();
            } 
            
           if($this->input->post('glosa',true)==""){$glosa="Despacho";}else{$glosa = $this->input->post('glosa',true);};
           $total_cajas = $this->input->post('total_cajas',true);
           $total_factura = $this->input->post('total_factura',true);
           

            $this->db->insert("despacho",$datosdespacho);
             // $this->db->insert("hoja_de_costos",$data2);
             //$this->session->set_flashdata('ControllerMessage', 'Se ha modificado el registro exitosamente.');
             //redirect($this->input->post("url",true),  301);
			 
			 
			 //echo $glosa;exit;
		 //$this->layout->view(redirect($this->input->post("url",true)));
		 
		redirect(base_url().'produccion/pdf_despacho/'.$datos->id.'/'.$total_cajas.'/'.$glosa.'/'.$total_factura.'/Despacho',  301);		 
        }
       $this->layout->view('guia_despachos',compact('id','pagina','datos','bodega','cliente','orden','ordenDeCompra','producto','despacho','dato'));  
      
		
    }
	
	
	
	
	 public function listadoproduccion_confeccion_molde_troquel()
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
			$datos=$this->produccion_model->getConfeccionMoldeTroquelCotizacionPaginacion($pagina,$porpagina,"limit");
			$cuantos=$this->produccion_model->getConfeccionMoldeTroquelCotizacionPaginacion($pagina,$porpagina,"cuantos");
			$config['base_url'] = base_url().'produccion/listadoproduccion_confeccion_molde_troquel';
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
              $this->layout->css
            (
                array
                (
                    base_url()."public/backend/fancybox/jquery.fancybox.css"
                )
            );
            $this->layout->js
            (
                array
                (
                    base_url()."public/backend/fancybox/jquery.fancybox.js"
                )
            );
			
            $this->layout->view('listadoproduccion_confeccion_molde_troquel',compact("datos","id","pagina")); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
    }
	
	//ETIQUETAS
	
	public function pdf_etiqueta($id=null,$ide=null,$usu=null)
    {
        if($this->session->userdata('id'))
        {
            if(!$id or !$ide){show_404();}

			$datos=$this->produccion_model->getPegadoParcialPorId($ide,$usu);
			$orden=$this->orden_model->getOrdenesPorId($id);
			$producto=$this->productos_model->getProductosPorNombre($orden->nombre_producto_normal);
			
			
           //if(sizeof($datos)==0){show_404();}
           
	
	
            $cuerpo=' <!DOCTYPE html>
			<html>
				<head>
					<meta charset="utf-8" />
					
			<link type="text/css" rel="stylesheet" href="'.base_url().'bootstrap/etiquetas.css" />
			
					
				</head>
				<body>';
				
				
    $cuerpo.='
	
	<div >
            <header>
		
                <div>
				<table>
				<tr>
							<td>
							<h1><span id="titulo">Cartonajes Grau </span></h1>
							</td>
				</tr>
				
				
					<tr>
							
							
							
							<td class="centro">
							<h1><span id="titulo" >
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							Etiquetas de Pegado</span>
							</h1>
							</td>
							
				</tr>
				
                </table>
       </div>
                      
            </header>
                <!--separador 20-->
                    <div class="separador_20"></div>
                <!--/separador 20-->

				
				';
            
			
			//->select("ppp.orden_de_trabajo,usu.nombre,ppp.descripcion_del_trabajo,ppp.cantidad_cajas_buenas,cli.razon_social,ppp.cuando,op.id as id_op,hcd.pegado,ppp.operador")
			for ($i = 1; $i <= 4; $i++) {
			
	$cuerpo.='		
			
			<br>
			<br>
			<table border="1">

			
				<TR>
					<TD COLSPAN=3 >
						
										<table border="0">
									
										
											<TR>
												<TH COLSPAN=3>CARTONAJES GRAU</TH> 
												<TH COLSPAN=15>OT</TH> 

												<TH COLSPAN=15>CODIGO</TH> 

											</TR>
											
											
											<TR>
												<TD COLSPAN=3></TD> 

												<TD COLSPAN=15>'.$id.'</TD> 

												<TD COLSPAN=15>'.$producto->codigo.'</TD> 
 
											</TR>
											
											
										   <TR>
												<TD COLSPAN=35>Tipo material: '.$datos->materialidad_datos_tecnicos.'</TD> 
											</TR>
											
											  <TR>
												<TH COLSPAN=1>Cliente:</TH> 											
												<TD COLSPAN=35>'.$datos->razon_social.'</TD> 											
											</TR>
											
											  <TR>
												<TH COLSPAN=1>Producto:</TH> 												
												<TD COLSPAN=35>'.$producto->nombre.'</TD> 												
											</TR>
											
											
											<TR>
												<TH COLSPAN=1>Paquetes de:</TH> 											
												<TD COLSPAN=3>'.$datos->cantidad_a_empaquetar.'</TD> 											
												<TH COLSPAN=15>UNIDADES</TH> 																						
											</TR>

											<TR>
												<TH COLSPAN=1>OPERADOR:</TH> 											
												<TD COLSPAN=15>'.$datos->nombre.'</TD> 	
                                                <TH COLSPAN=1>Fecha emisión:</TH> 											
												<TD COLSPAN=15>'.date("d/m/Y").'</TD> 												
											</TR>
											
											
										</table>
					
					      
					      
					</TD> 
					
					
					<TD COLSPAN=3>
									
									
								<table border="0">
									
										
											<TR>
												<TH COLSPAN=3>CARTONAJES GRAU</TH> 
												<TH COLSPAN=15>OT</TH> 

												<TH COLSPAN=15>CODIGO</TH> 

											</TR>
											
											
											<TR>
												<TD COLSPAN=3></TD> 

												<TD COLSPAN=15>'.$id.'</TD> 

												<TD COLSPAN=15>'.$producto->codigo.'</TD> 
 
											</TR>
											
											
										   <TR>
												<TD COLSPAN=35>Tipo material: '.$datos->materialidad_datos_tecnicos.'</TD> 
											</TR>
											
											  <TR>
												<TH COLSPAN=1>Cliente:</TH> 											
												<TD COLSPAN=35>'.$datos->razon_social.'</TD> 											
											</TR>
											
											  <TR>
												<TH COLSPAN=1>Producto:</TH> 												
												<TD COLSPAN=35>'.$producto->nombre.'</TD> 												
											</TR>
											
											
											<TR>
												<TH COLSPAN=1>Paquetes de:</TH> 											
												<TD COLSPAN=3>'.$datos->cantidad_a_empaquetar.'</TD> 											
												<TH COLSPAN=15>UNIDADES</TH> 																						
											</TR>

											<TR>
												<TH COLSPAN=1>OPERADOR:</TH> 											
												<TD COLSPAN=15>'.$datos->nombre.'</TD> 	
                                                <TH COLSPAN=1>Fecha emisión:</TH> 											
												<TD COLSPAN=15>'.date("d/m/Y").'</TD> 												
											</TR>
											
											
										</table>
					</TD> 
					

				</TR>
				
				
			 <!--separador 20-->
                    <div class="separador_20"></div>
                <!--/separador 20-->

			</table>
			
             ';
                
			} //for 4
		
    $cuerpo.='</body>
</html>';
		
		
        $this->mpdf->SetDisplayMode('fullpage');
        $css1 = file_get_contents('bootstrap/etiquetas.css');
       // $css2 = file_get_contents('bootstrap/bootstrap.css');
            //$this->mpdf->WriteHTML($css2,1);
            $this->mpdf->WriteHTML($css1,1);
    		$this->mpdf->WriteHTML($cuerpo);
    		$this->mpdf->Output();
    		exit;
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
    }
	
	public function pdf_despacho($id=null,$cant=null,$glosa=null,$total_factura=null,$despacho=null)
    {
        if($this->session->userdata('id'))
        {
            if(!$id ){show_404();}

		$orden=$this->orden_model->getOrdenesPorCotizacionPorId($id);
		$hoja=$this->cotizaciones_model->getValoresCotizadasHojaDeCosto($orden->id_cotizacion);
		$cotizaciones=$this->cotizaciones_model->getCotizacionPorId($orden->id_cotizacion);
		
		$oc=$this->cotizaciones_model->getOrdenDeCompraPorCotizacion($orden->id_cotizacion);
		
		$forma_pago=$this->clientes_model->getFormasPagoPorId($oc->id_forma_pago);
		$despachos = $this->despachos_model->getDespachosPorId($orden->id_cotizacion);
		$ultimodespacho = $this->despachos_model->getDespachosUltimoRegistro($orden->id_cotizacion);
		$cliente=$this->clientes_model->getClientePorIdParaDespacho($cotizaciones->id_cliente);
                $bodega=$this->produccion_model->getBodegaPorIdnodo($id);
			
			
       // print_r($despachos);exit();	
           //if(sizeof($datos)==0){show_404();}
           
	
	
            $cuerpo=' <!DOCTYPE html>
			<html>
				<head>
					<meta charset="utf-8" />
					
			<link type="text/css" rel="stylesheet" href="'.base_url().'bootstrap/despacho.css" />
			
					
				</head>
				<body>';
				
				
    $cuerpo.='
	
	<div >
            <header>
		
                <div>
				<table>
				<tr>
							<td>
							<h1><span id="titulo"> </span></h1>
							</td>
				</tr>
				
				
					<tr>
							
							
							
							<td >
							<h1 style="font-size:18px"><span id="titulo" >
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							
							Instrucciones para Despacho de Bodega
							
							</span>
							</h1>
							</td>
							
				</tr>
				
                </table>
       </div>
                      
            </header>
                <!--separador 20-->
                    <div class="separador_20"></div>
                <!--/separador 20-->

				
				';
            
			
			
			
			
	$cuerpo.='			
		<table >		
			<tr>
				<td>
						<table>									
						<TR>	
						
						<td > </td><td > </td><td > </td><td > </td><td > </td><td > </td><td > </td><td > </td>
						<td > </td><td > </td><td > </td><td > </td><td > </td><td > </td><td > </td><td > </td>
						<td > </td><td > </td><td > </td><td > </td><td > </td><td > </td><td > </td><td > </td>
						<td > </td><td > </td><td > </td><td > </td><td > </td><td > </td><td > </td><td > </td>
						<td>
									<table align="center">
						.						<tr>
												<td class="centro titulo2 fuente3">Cartonajes Grau </td>
												</tr>
												
												<tr>
												<td class="centro">FABRICA DE CAJAS Y CARTONES </td>
												</tr>
												
												<tr>
												<td class="centro">JUAN FRANCISCO RIVAS #9435 LA CISTERNA</td>
												</tr>
												
												<tr>
												<td class="centro">FONO: 224959500</td>
												</tr>
									</table>
						</td>
						
		
	
						<td > </td><td > </td><td > </td><td > </td><td > </td><td > </td><td > </td><td > </td>
						<td > </td><td > </td><td > </td><td > </td><td > </td><td > </td><td > </td><td > </td>
						<td > </td><td > </td><td > </td><td > </td><td > </td><td > </td><td > </td><td > </td>
						<td > </td><td > </td><td > </td><td > </td><td > </td><td > </td><td > </td><td > </td>
						<td > </td><td > </td><td > </td><td > </td><td > </td><td > </td><td > </td><td > </td>
						<td > </td><td > </td><td > </td><td > </td><td > </td><td > </td><td > </td><td > </td>

						
						

							<td COLSPAN=10> </td>	

							
							<td>

											<table border="1" align="center">									
											<tr>				
												<td>Despacho Bodega Numero </td>																		
											</tr>
											
											<tr>				
												<td><strong>N: '.$id.' </strong></td>																		
											</tr>
											
											</table>

							</td>		
							
						</TR>
						
						</table>	
				</td>
			</tr>	
		</table><br /><br /><br />	
                <table style="900px; border:1px solid;">
                                <tr class="titulo"><td colspan="2"><b>Informacion de Cliente</b></td><td colspan="3"><b>Informacion de Despacho</b></td></tr>
                                <tr><td>Fecha: </td><td>'.$orden->fecha.'</td><td>&nbsp;&nbsp;</td>
                                <td>Contacto: </td><td>'.$cliente->contacto.'</td>
                                </tr>
                                <tr><td>Hora Despacho: </td><td>'.$cliente->horario_despacho.'</td><td>&nbsp;&nbsp;</td>
                                <td>Forma de Pago: </td><td>'.$forma_pago->forma_pago.'</td>
                                </tr>
                                <tr><td>Nombre: </td><td>'.$cliente->nombre_fantasia.'</td><td>&nbsp;&nbsp;</td>
                                <td>Region: </td><td>'.$cliente->region.'</td>
                                </tr>
                                <tr><td>Rut: </td><td>'.$cliente->rut.'</td><td>&nbsp;&nbsp;</td>
                                <td>Ciudad: </td><td>'.$cliente->ciudad.'</td>
                                </tr>
                                <tr><td>Ciudad: </td><td>'.$cliente->ciudad.'</td><td>&nbsp;&nbsp;</td>
                                <td>Comuna:</td><td>'.$cliente->comuna.'</td>
                                </tr>
                                <tr><td>Direccion: </td><td>'.$cliente->direccion.'</td><td>&nbsp;&nbsp;</td>
                                <td>Direccion: </td><td>'.$cliente->direccion_despacho.'</td>
                                </tr>
                                <tr><td>Comuna: </td><td>'.$cliente->comuna.'</td><td>&nbsp;&nbsp;</td>
                                <td>Horario: </td><td>'.$cliente->horario_despacho.'</td>
                                </tr>
                                <tr><td>Telefono: </td><td>'.$cliente->telefono.'</td><td>&nbsp;&nbsp;</td>
                                <td></td><td></td>
                                </tr>
                                <tr><td>Contacto Despacho: </td><td>'.$cliente->contacto.'</td><td>&nbsp;&nbsp;</td>
                                <td colspan="2" class="titulo" style="color:#fff;font-weight:bold;">Informacion General de la Orden</td>
                                </tr>
                                <tr><td>Vendedor: </td><td>'.$cliente->venom.'</td><td>&nbsp;&nbsp;</td>
                                <td>Cantidad Pedida: </td><td>'.$ultimodespacho->cantidad_total.'</td>
                                </tr>
                                <tr><td>Tipo de Pago: </td><td>'.$forma_pago->forma_pago.'</td><td>&nbsp;&nbsp;</td>
                                <td>Cantidad Faltante: </td><td>'.$ultimodespacho->cantidad_faltante.'</td>
                                </tr>
                                <tr><td>Detalles: </td><td>'.$glosa.'</td><td>&nbsp;&nbsp;</td>
                                <td></td><td></td>
                                </tr>
                                </table>
				
			 <!--separador 20-->
                    <div class="separador_20"></div>
                <!--/separador 20-->
                        <table style="900px; border:1px solid;">
                        <tr class="titulo">
                        <td colspan="8" align="center">Despachos Anteriores</td></tr>
                        <tr class="titulo">
                        <td>Op</td>
                        <td>Pedidas</td>
                        <td>Ingresadas</td>
                        <td>Faltantes</td>
                        <td>Descripcion del Producto</td>
                        <td>Precio Unitario</td>
                        <td>Total Despacho</td>
                        <td>Fecha</td>
                        </tr>';
                        foreach ($despachos as $value) {
                        $cuerpo.='<tr>
                        <td>'.$id.'</td>
                        <td>'.$value->cantidad_total.'</td>
                        <td>'.$value->cantidad_ingresada.'</td>
                        <td>'.$value->cantidad_faltante.'</td>
                        <td>'.$orden->nombre_producto_normal.'</td>
                        <td>'.$hoja->valor_empresa.'</td>
                        <td>'.number_format($total_factura,0,'','.').'</td>
                        <td>'.$value->fecha.'</td>
                        </tr>';
                        }
                       $cuerpo.=' </table>
                <!--/separador 20-->
                <div class="separador_20"></div>
                        <table style="900px; border:1px solid;">
                        <tr class="titulo">
                        <td colspan="5" align="center">Despacho Actual</td></tr>
                        <tr class="titulo">
                        <td>Op</td>
                        <td>Cantidad</td>
                        <td>Descripcion del Producto</td>
                        <td>Precio Unitario</td>
                        <td>Total Despacho</td>
                        </tr>
                        <tr>
                        <td>'.$id.'</td>
                        <td>'.$cant.'</td>
                        <td>'.$orden->nombre_producto_normal.'</td>
                        <td>'.$hoja->valor_empresa.'</td>
                        <td>'.number_format($total_factura,0,'','.').'</td>
                        </tr>
                        </table>
                        
			</table>
			
					<br>
					<br>

			 <!--separador 20-->
                    <div class="separador_20"></div>
                <!--/separador 20-->

			</table>
			
             ';
                
		
		
			$cuerpo.='</body>
		</html>';
				
		
        $this->mpdf->SetDisplayMode('fullpage');
       // $css1 = file_get_contents('bootstrap/etiquetas.css');
       // $css2 = file_get_contents('bootstrap/bootstrap.css');
            //$this->mpdf->WriteHTML($css2,1);
            $css1 = file_get_contents('public/frontend/css/despacho.css');
            $css2 = file_get_contents('bootstrap/bootstrap.css');
            $this->mpdf->WriteHTML($css2,1);
            $this->mpdf->WriteHTML($css1,1);
    		$this->mpdf->WriteHTML($cuerpo);
    		$this->mpdf->Output();
    		exit;
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
    }
	
	
	
	
	
	
	 public function BuscarKilosCartulina()
				{
					if($this->session->userdata('id'))
					{
						$this->layout->setLayout('template_ajax');
						
							$id	 =$this->input->post('valor1',true);
							$ngramaje =$this->input->post('valor2',true);
							$ancho =$this->input->post('valor3',true);
							
//						echo "id=".$id."  "."ngramaje=".$ngramaje."  "."ancho=".$ancho."  ";
						$kilos1=$this->produccion_model->MermasParaProduccion($id,$ngramaje,$ancho);
						
						
						$this->layout->view('ajaxNuevoPlacaKilo',compact('kilos1')); 
						
					}else
					{
						redirect(base_url().'usuarios/login',  301);
					}
					
				}
	
	
	public function BuscarKilosOnda()
				{
					if($this->session->userdata('id'))
					{
						$this->layout->setLayout('template_ajax');
						
							$id	 =$this->input->post('valor1',true);
							$ngramaje =$this->input->post('valor2',true);
							$ancho =$this->input->post('valor3',true);
							
						
						$kilos1=$this->produccion_model->LlamarKilosOnda($id,$ngramaje,$ancho);
						
						
						$this->layout->view('ajaxNuevoOndaKilo',compact('kilos1')); 
						
					}else
					{
						redirect(base_url().'usuarios/login',  301);
					}
					
				}
	
		public function BuscarKilosLiner()
				{
					if($this->session->userdata('id'))
					{
						$this->layout->setLayout('template_ajax');
						
							$id	 =$this->input->post('valor1',true);
							$ngramaje =$this->input->post('valor2',true);
							$ancho =$this->input->post('valor3',true);
							
						
						$kilos1=$this->produccion_model->LlamarKilosLiner($id,$ngramaje,$ancho);
						
						
						$this->layout->view('ajaxNuevoLinerKilo',compact('kilos1')); 
						
					}else
					{
						redirect(base_url().'usuarios/login',  301);
					}
					
				}
	
	
	public function ListadoFotomecanica()
	{
	    if($this->session->userdata('id'))
        {
			
			
			//$datos=$this->orden_model->getOrdenesConCotizacionPaginacion2($pagina,$porpagina,"limit");
			$datos=$this->orden_model->getOrdenesConCotizacionPaginacion2(1,1000,"limit");
			
        $cuerpo='<!doctype html>
			<html> 
            <head>
             <meta charset="utf-8" />
            </head>
			<body>';
         
    
   
		   $cuerpo.='
		   <div class="page-header"><h3>Listado de Producción Fotomecanica</h3></div>
		   
		   <table border="1" style="font-size:10px">
					  <tr>
								  
								  <td style="width: 60px;"><b>Número Orden</b></td>
								  <td style="width: 200px;"><b>Cliente</b></td>
								  <td style="width: 200px;"><b>Detallle</b></td>
								  <td style="width: 100px;"><b>Fecha Emisión</b></td>
								  <td style="width: 80px;"><b>Vendedor</b></td>
								  <td style="width: 80px;"><b>Estado</b></td>
					  </tr>
					  
			</table>		  
            ';
  
  
  $cuerpo.=' <table border="1" style="font-size:10px"> ';
  foreach($datos as $dato)
    {
		$f=$this->clientes_model->getFormasPagoPorId($dato->id_forma_pago);
        $quien=$this->usuarios_model->getUsuariosPorId($dato->quien_autoriza);
		$estadoFotomecanica=$this->orden_model->getOrdenesPorCotizacionEstado($dato->id);
  
  
		$bodega=$this->produccion_model->getBodegaPorTipo(1,$dato->id);
  
		if($bodega->estado != '4')
		{
			if($estadoFotomecanica == null)
			{
				$estado = 'Activa';
				
			}else{
				$estado = 'Liberada';
				
			}
		   $cuerpo.='
		   
				  <tr>
						 
						 <td style="width: 60px;">'.$dato->id_op.'</td>
						 <td style="width: 200px;">'.$dato->razon_social.'</td>
						 <td style="width: 200px;">'.$dato->nombre_producto_normal.'</td>
						 <td style="width: 100px;">'.fecha($dato->fecha).'</td>
						 <td style="width: 80px;">'.$dato->nombre.'</td>
						 ';
						 
						 
			  $cuerpo.=' <td style="width: 80px;">'.$estado.'</td>';
						 
						 
			$cuerpo.='			 
				  </tr>
		  ';
		  
		}
	}
  
      $cuerpo.='</table>';
	  $cuepo.='</body>';
	  $cuepo.='</html>';

        //echo $cuerpo;exit;
		//$mpdf=new mPDF(); 
		//$nombre="Listado fotomecanica ".$id." ".date("Y-m-d H:i:s").".pdf";
		$nombre="Listado fotomecanica".date("Y-m-d H:i:s").".pdf";
		$this->mpdf->WriteHTML($cuerpo);
		$this->mpdf->Output($nombre,'I');
		exit;
            
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
    }
	
    public function ajax_obtenerGramaje()
    {
//        exit($this->input->post("valor",true).'hola');
        $div=$this->input->post("div",true);
        $this->load->library('javascript');
        $this->load->library('javascript', array('js_library_driver' => 'scripto', 'autoload' => FALSE));
        $this->layout->setLayout('template_ajax');
        $datos=$this->materiales_model->getMaterialesGramajePorLike($this->input->post("valor",true));
        $this->layout->view('ajax_obtenerGramaje',compact("datos","div")); 
    }     
    public function ajax_obtenerGramaje2()
    {
//        exit($this->input->post("valor",true).'hola');
        $div=$this->input->post("div",true);
        $this->load->library('javascript');
        $this->load->library('javascript', array('js_library_driver' => 'scripto', 'autoload' => FALSE));
        $this->layout->setLayout('template_ajax');
        $datos=$this->materiales_model->getMaterialesGramajePorLike($this->input->post("valor",true));
        $this->layout->view('ajax_obtenerGramaje2',compact("datos","div")); 
    }     

    public function ajax_obtenerGramaje3()
    {
//        exit($this->input->post("valor",true).'hola');
        $div=$this->input->post("div",true);
        $this->load->library('javascript');
        $this->load->library('javascript', array('js_library_driver' => 'scripto', 'autoload' => FALSE));
        $this->layout->setLayout('template_ajax');
        $datos=$this->materiales_model->getMaterialesGramajePorLike($this->input->post("valor",true));
        $this->layout->view('ajax_obtenerGramaje3',compact("datos","div")); 
    }     
	
    
    public function cotizaciones_cartulina_liberar()
    {
        if($this->session->userdata('id'))
        {
            $datos=$this->orden_model->getResumenControlCartulinaPorLiberar();

            $cuerpo=' <!DOCTYPE html>
			<html>
                        <head>
                            <meta charset="utf-8" />
                            <link type="text/css" rel="stylesheet" href="'.base_url().'bootstrap/despacho.css" />
                        </head>
                        <body>
                        <h3><p class="text-center">RESUMEN CORTE CARTULINA POR LIBERAR</p></h3>
                    <p class="text-right">Fecha: '.date('d-m-Y').'</p>

                         <table border="1" width="100%">
                            <tr>
                                <td>OT</td>
                                <td width="80px">Fecha</td>
                                <td >Cliente</td>
                                <td>Producto</td>
                                <td>Cartulina</td>
                                <td>Reverso</td>
                                <td>Gramaje</td>
                                <td>Ancho</td>
                                <td>Largo</td>
                                <td>Cantidad</td>
                                <td>Merma</td>
                                <td>Total Pliegos</td>
                                <td>Kilos</td>
                                <td>Estatus</td>
                                <td>Despacho Parciales</td>                                                                
                            </tr>';
             
            foreach ($datos as $dato) {
/*
                            if($ordenDeCompra->cantidad_de_cajas==$datos->cantidad_1){
                                $merma = $hoja->total_merma;
                            }else if($ordenDeCompra->cantidad_de_cajas==$datos->cantidad_2){
                                $merma = $hoja->total_merma2;
                            }else if($ordenDeCompra->cantidad_de_cajas==$datos->cantidad_3){
                                $merma = $hoja->total_merma3;
                            }else if($ordenDeCompra->cantidad_de_cajas==$datos->cantidad_4){
                                $merma = $hoja->total_merma3;
                            }*/

                            $total_pliegos = ($dato->cantidad)/($dato->unidades_por_pliego) + $dato->total_merma;

                            $kilos_total = round(($total_pliegos * $dato->gramaje * $dato->ancho * $dato->largo) / 10000000);


                            $cuerpo .='<tr>
                                <td>'.$dato->ot.'</td>
                                <td>'.$dato->fecha.'</td>
                                <td>'.$dato->razon_social.'</td>
                                <td>'.$dato->producto.'</td>
                                <td>'.$dato->cartulina.'</td>
                                <td>'.$dato->reverso.'</td>
                                <td>'.$dato->gramaje.'</td>
                                <td>'.$dato->ancho.'</td>
                                <td>'.$dato->largo.'</td>
                                <td>'.($dato->cantidad)/($dato->unidades_por_pliego).'</td>
                                <td>'.$dato->total_merma.'</td>
                                <td>'.$total_pliegos.'</td>
                                <td>'.$kilos_total.'</td>
                                <td></td>                                    
                                <td></td>                                    
                            </tr>';
            }
            $cuerpo .='</table></body>
                      </html>';

		
            $this->mpdf->SetDisplayMode('fullpage');
            $this->mpdf->AddPage('L');
            $css1 = file_get_contents('public/frontend/css/despacho.css');
            $css2 = file_get_contents('bootstrap/bootstrap.css');
            $this->mpdf->WriteHTML($css2,1);
            $this->mpdf->WriteHTML($css1,1);
            $this->mpdf->WriteHTML($cuerpo);
            $this->mpdf->Output();
    		exit;
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
    }

    public function resumen_control_liner($id=null)
    {
        if($this->session->userdata('id'))
        {
            $datos=$this->orden_model->getResumenControlCartulinaPorLiberar();
            

            $cuerpo=' <!DOCTYPE html>
            <html>
                        <head>
                            <meta charset="utf-8" />
                            <link type="text/css" rel="stylesheet" href="'.base_url().'bootstrap/despacho.css" />
                        </head>
                        <body>
                        <h3><p class="text-center">RESUMEN CONTROL LINER</p></h3>
                    <p class="text-right">Fecha: '.date('d-m-Y').'</p>

                         <table border="1" width="100%">
                            <tr>
                                <td>OT</td>
                                <td width="80px">Fecha</td>
                                <td >Cliente</td>
                                <td>Producto</td>
                                <td>Tipo de material</td>
                                <td>Reverso</td>
                                <td>Gramaje</td>
                                <td>Ancho</td>
                                <td>Largo</td>
                                <td>Cantidad</td>
                                <td>Merma</td>
                                <td>Total Pliegos</td>
                                <td>Kilos</td>
                                <td>Estatus</td>
                                <td>Despacho Parciales</td>                                                                
                            </tr>';
            foreach ($datos as $dato) {
                    $id=$dato->id_cotizacion;
                    $fotomecanica=$this->cotizaciones_model->getCotizacionFotomecanicaPorIdCotizacion($id);
                    $ordenDeCompra=$this->cotizaciones_model->getOrdenDeCompraPorCotizacion($id);
                    $mliner = $this->materiales_model->getMaterialesPorId($fotomecanica->id_mat_liner3);
                    $monda = $this->materiales_model->getMaterialesPorId($fotomecanica->id_mat_onda2);
                    
                        /*
                        if($ordenDeCompra->cantidad_de_cajas==$datos->cantidad_1){
                            $merma = $hoja->total_merma;
                        }else if($ordenDeCompra->cantidad_de_cajas==$datos->cantidad_2){
                            $merma = $hoja->total_merma2;
                        }else if($ordenDeCompra->cantidad_de_cajas==$datos->cantidad_3){
                            $merma = $hoja->total_merma3;
                        }else if($ordenDeCompra->cantidad_de_cajas==$datos->cantidad_4){
                            $merma = $hoja->total_merma3;
                        }*/

                        $total_pliegos = ($dato->cantidad)/($dato->unidades_por_pliego) + $dato->total_merma;

                        $kilos_total = round(($total_pliegos * $dato->gramaje * $dato->ancho * $dato->largo) / 10000000);

                        //$mermaonda=(($ordenDeCompra->cantidad_de_cajas/$dato->unidades_por_pliego)*0.04)+104;
                        $mermaonda=(($ordenDeCompra->cantidad_de_cajas/$dato->unidades_por_pliego)*0.04)+104;
                        $pliegosliner=($ordenDeCompra->cantidad_de_cajas/$dato->unidades_por_pliego)+(($ordenDeCompra->cantidad_de_cajas/$dato->unidades_por_pliego)*0.04)+104;
                        $pliegosonda=($ordenDeCompra->cantidad_de_cajas/$dato->unidades_por_pliego)+(($ordenDeCompra->cantidad_de_cajas/$dato->unidades_por_pliego)*0.04)+104;
                        $kiloliner = number_format((($dato->tamano_a_imprimir_1 * $dato->tamano_a_imprimir_2 * $monda->gramaje * $pliegosonda)/10000000),0,"",".");
                        /*
                            
                                <td align="center">'.$mliner->materiales_tipo.'</td>'
                                        . '<td align="center">'.$mliner->gramaje.'</td>'
                                        . '<td align="center">'.$ordenDeCompra->cantidad_de_cajas/$ing->unidades_por_pliego.'</td>'
                                        . '<td align="center">'.$mermaliner.'</td>'
                                        . '<td align="center">'.$pliegosliner.'</td>'
                                        . '<td align="center">'.$kiloliner.'</td>
                                <tr>';
                        */

                        $cuerpo .='<tr>
                            <td>'.$dato->ot.'</td>
                            <td>'.$dato->fecha.'</td>
                            <td>'.$dato->razon_social.'</td>
                            <td>'.$dato->producto.'</td>
                            <td>'.$mliner->materiales_tipo.'</td>
                            <td>'.$dato->reverso.'</td>
                            <td>'.$mliner->gramaje.'</td>
                            <td>'.$dato->ancho.'</td>
                            <td>'.$dato->largo.'</td>
                            <td>'.($dato->cantidad)/($dato->unidades_por_pliego).'</td>
                            <td>'.$mermaonda.'</td>
                            <td>'.$kilos_total.'</td>
                            <td>'.$kiloliner.'</td>
                            <td></td>                                    
                            <td></td>                                    
                        </tr>';
                    
            }
            $cuerpo .='</table></body>
                      </html>';

        
            $this->mpdf->SetDisplayMode('fullpage');
            $this->mpdf->AddPage('L');
            $css1 = file_get_contents('public/frontend/css/despacho.css');
            $css2 = file_get_contents('bootstrap/bootstrap.css');
            $this->mpdf->WriteHTML($css2,1);
            $this->mpdf->WriteHTML($css1,1);
            $this->mpdf->WriteHTML($cuerpo);
            $this->mpdf->Output();
            exit;
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
    }

    public function resumen_control_onda($id=null)
    {
        if($this->session->userdata('id'))
        {
            $datos=$this->orden_model->getResumenControlCartulinaPorLiberar();
            

            $cuerpo=' <!DOCTYPE html>
            <html>
                        <head>
                            <meta charset="utf-8" />
                            <link type="text/css" rel="stylesheet" href="'.base_url().'bootstrap/despacho.css" />
                        </head>
                        <body>
                        <h3><p class="text-center">RESUMEN CONTROL ONDA</p></h3>
                    <p class="text-right">Fecha: '.date('d-m-Y').'</p>

                         <table border="1" width="100%">
                            <tr>
                                <td>OT</td>
                                <td width="80px">Fecha</td>
                                <td >Cliente</td>
                                <td>Producto</td>
                                <td>Tipo de material</td>
                                <td>Reverso</td>
                                <td>Gramaje</td>
                                <td>Ancho</td>
                                <td>Largo</td>
                                <td>Cantidad</td>
                                <td>Merma</td>
                                <td>Total Pliegos</td>
                                <td>Kilos</td>
                                <td>Estatus</td>
                                <td>Despacho Parciales</td>                                                                
                            </tr>';
            foreach ($datos as $dato) {
                    $id=$dato->id_cotizacion;
                    $fotomecanica=$this->cotizaciones_model->getCotizacionFotomecanicaPorIdCotizacion($id);
                    $ordenDeCompra=$this->cotizaciones_model->getOrdenDeCompraPorCotizacion($id);
                    $monda = $this->materiales_model->getMaterialesPorId($fotomecanica->id_mat_onda2);
                    
                        /*
                        if($ordenDeCompra->cantidad_de_cajas==$datos->cantidad_1){
                            $merma = $hoja->total_merma;
                        }else if($ordenDeCompra->cantidad_de_cajas==$datos->cantidad_2){
                            $merma = $hoja->total_merma2;
                        }else if($ordenDeCompra->cantidad_de_cajas==$datos->cantidad_3){
                            $merma = $hoja->total_merma3;
                        }else if($ordenDeCompra->cantidad_de_cajas==$datos->cantidad_4){
                            $merma = $hoja->total_merma3;
                        }*/

                        $total_pliegos = ($dato->cantidad)/($dato->unidades_por_pliego) + $dato->total_merma;

                        $kilos_total = round(($total_pliegos * $dato->gramaje * $dato->ancho * $dato->largo) / 10000000);

                        //$mermaonda=(($ordenDeCompra->cantidad_de_cajas/$dato->unidades_por_pliego)*0.04)+104;
                        $mermaonda=(($ordenDeCompra->cantidad_de_cajas/$dato->unidades_por_pliego)*0.04)+104;
                        $pliegosonda=($ordenDeCompra->cantidad_de_cajas/$dato->unidades_por_pliego)+(($ordenDeCompra->cantidad_de_cajas/$dato->unidades_por_pliego)*0.04)+104;
                        $kiloonda = number_format((($dato->tamano_a_imprimir_1 * $dato->tamano_a_imprimir_2 * $monda->gramaje * $pliegosonda)/10000000)*1.37,0,"",".");
                        /*
                            <td align="center">'.$monda->materiales_tipo.'</td>'
                                . '<td align="center">'.$monda->gramaje.'</td>'
                                . '<td align="center">'.$ordenDeCompra->cantidad_de_cajas/$ing->unidades_por_pliego.'</td>'
                                . '<td align="center">'.$mermaonda.'</td>'
                                . '<td align="center">'.$pliegosonda.'</td>'
                                . '<td align="center">'.$kiloonda.'</td>
                        */

                        $cuerpo .='<tr>
                            <td>'.$dato->ot.'</td>
                            <td>'.$dato->fecha.'</td>
                            <td>'.$dato->razon_social.'</td>
                            <td>'.$dato->producto.'</td>
                            <td>'.$monda->materiales_tipo.'</td>
                            <td>'.$dato->reverso.'</td>
                            <td>'.$monda->gramaje.'</td>
                            <td>'.$dato->ancho.'</td>
                            <td>'.$dato->largo.'</td>
                            <td>'.($dato->cantidad)/($dato->unidades_por_pliego).'</td>
                            <td>'.$mermaonda.'</td>
                            <td>'.$kilos_total.'</td>
                            <td>'.$kiloonda.'</td>
                            <td></td>                                    
                            <td></td>                                    
                        </tr>';
                    
            }
            $cuerpo .='</table></body>
                      </html>';

        
            $this->mpdf->SetDisplayMode('fullpage');
            $this->mpdf->AddPage('L');
            $css1 = file_get_contents('public/frontend/css/despacho.css');
            $css2 = file_get_contents('bootstrap/bootstrap.css');
            $this->mpdf->WriteHTML($css2,1);
            $this->mpdf->WriteHTML($css1,1);
            $this->mpdf->WriteHTML($cuerpo);
            $this->mpdf->Output();
            exit;
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
    }

    public function etiquetas_despacho($id,$paquetede,$codigoproducto,$cuantoetiqueta,$empresa)
    {
         if($this->session->userdata('id'))
        { 
            $producto=$this->produccion_model->getEtiquetaDespacho($id);
            if ($empresa == 'cartonajes'){
                $logo = base_url()."public/frontend/images/Logo-Cartonajes-web.png";
            }else{
                $logo = base_url()."public/frontend/images/Logo-Tendencia-web.png"; 
            }
                        
             //Arrays de datos para la vista
             $this->load->library('mPDF');
             $css= file_get_contents('public/frontend/css/et.css');
             $this->mPDF->pdf = new mPDF();

             for($i=1 ; $i <= $cuantoetiqueta ; $i++){
             $html=$this->load->view('frontend/produccion/etiquetas_despacho', compact('producto','producto','paquetede','paquetede','codigoproducto','codigoproducto','logo','logo'),true); 
                $this->mPDF->pdf->AddPage('L','letter','','','',4,1,5,1,0,0);
                $this->mPDF->pdf->WriteHTML($css,1);
                $this->mPDF->pdf->WriteHTML($html);
             }

             $this->mPDF->pdf->SetJS('print(false);');
             //$this->mPDF->pdf->AutoPrint(true);
             $this->mPDF->pdf->Output();
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
        
        
	}    
    
	 public function despacho($tipo=null,$id=null,$pagina=null,$ot=null)
	{ 
        if($this->session->userdata('id'))
        {                      
           if(!$tipo or !$id){show_404();}
           switch($tipo)
            {
                case '1':
                    $datos=$this->cotizaciones_model->getCotizacionPorId($id);
                break;
                 case '2':
                    $datos=$this->fast_track_model->getFastTrackPorId($id);
                break;
            }      
            if(sizeof($datos)==0){show_404();}
            $control=$this->produccion_model->getBodegaPorTipo($tipo,$id);
            $ing=$this->cotizaciones_model->getCotizacionIngenieriaPorIdCotizacion($id);
            $fotomecanica=$this->cotizaciones_model->getCotizacionFotomecanicaPorIdCotizacion($id);
            $fotomecanica2=$this->produccion_model->getFotomecanicaPorTipo($tipo,$id);
            $troquelado=$this->produccion_model->getTroqueladoPorTipo($tipo,$id);
            $cotizacion=$this->cotizaciones_model->getCotizacionPorId($id);
            $hoja=$this->cotizaciones_model->getHojaDeCostosPorIdCotizacion($id);
            $pegado=$this->produccion_model->getPegadoPorTipo($tipo,$id);
            $talleres_externos=$this->produccion_model->getTallerExternosPorTipo($tipo,$id);
            $ordenDeCompra=$this->cotizaciones_model->getOrdenDeCompraPorCotizacion($id);
            $orden=$this->orden_model->getOrdenesPorCotizacion($id);            
            $producto=$this->productos_model->getProductosPorId($orden->producto_id);
            if($this->input->post())
            {
                if($this->form_validation->run('produccion_bodega'))
                {
                    if(sizeof($talleres_externos)==0 or sizeof($pegado)==0)
                   {
                            $situacion='Pendiente';
                            $fecha_pendiente=date('Y-m-d H:i:s');
                            $fecha_liberada='0000-00-00';
                            $fecha_activa='0000-00-00';
                            $fecha_orden_cerrada='0000-00-00';
                   }else
                   {}
                     switch($this->input->post('estado',true))
                     {
                        case '1':
                            $situacion='Liberada';
                            $fecha_pendiente='0000-00-00';
                            $fecha_liberada=date('Y-m-d H:i:s');
                            $fecha_activa='0000-00-00';
                            $fecha_orden_cerrada='0000-00-00';
                        break;
                        case '0':
                            $situacion='Activa';
                            $fecha_pendiente='0000-00-00';
                            $fecha_liberada='0000-00-00';
                            $fecha_activa=date('Y-m-d H:i:s');
                            $fecha_orden_cerrada='0000-00-00';
                        break;
                        case '2':
                            $situacion='Activa';
                            $fecha_pendiente='0000-00-00';
                            $fecha_liberada='0000-00-00';
                            $fecha_activa=date('Y-m-d H:i:s');
                            $fecha_orden_cerrada='0000-00-00';
                        break;
                        default:
                            $situacion='Activa';
                            $fecha_pendiente='0000-00-00';
                            $fecha_liberada='0000-00-00';
                            $fecha_activa=date('Y-m-d H:i:s');
                            $fecha_orden_cerrada='0000-00-00';
                        break;
						 case '3':
                            $situacion='Parcial';
                            $fecha_pendiente='0000-00-00';
                            $fecha_liberada='0000-00-00';
                            $fecha_activa=date('Y-m-d H:i:s');
                            $fecha_orden_cerrada='0000-00-00';
                        break;
                     }
                   
                    
                    $total_de_ingresos = $this->input->post('cantidades_a_ingresar',true)+$control->total_de_ingresos;
                    $total_cajas_pendientes = $ordenDeCompra->cantidad_de_cajas-$total_de_ingresos;
                    
                     
                    $data=array
                    (
                        "id_usuario"=>$this->session->userdata('id'),
                        "tipo"=>$this->input->post('tipo',true),
                        "id_nodo"=>$this->input->post('id',true),
                        "id_cliente"=>$this->input->post('id_cliente',true),
                        "orden_de_trabajo"=>$this->input->post('id',true),
                        "descripcion_del_trabajo"=>$this->input->post('descripcion_del_trabajo',true),
                        "fecha_de_entrega"=>$this->input->post('fecha_de_entrega',true),
                        "ingreso_a_bodega"=>$this->input->post('ingreso_a_bodega',false),
                        "numero_de_orden_de_trabajo"=>$this->input->post('numero_de_orden_de_trabajo',true),
                        "cantidad_de_cajas"=>$this->input->post('cantidad_de_cajas',true),
                        "precio_venta"=>$this->input->post('precio_venta',true),
                        "codigo_producto"=>$this->input->post('codigo_producto',true),
                        "unidades_por_paquete_oficial"=>$this->input->post('unidades_por_paquete_oficial',true),
                        "unidades_paquete_efectivo"=>$this->input->post('unidades_paquete_efectivo',true),
                        "paquetes_por_pallet"=>$this->input->post('paquetes_por_pallet',true),
                        "medidas_de_pallet"=>$this->input->post('medidas_de_pallet',true),
                        //"total_de_ingresos"=>$this->input->post('total_de_ingresos',true),
                        "total_de_ingresos"=>$total_de_ingresos,
                        "total_cajas_ingresadas"=>$this->input->post('total_cajas_ingresadas',true),
                        "listado_ingresos_cantidades"=>$this->input->post('listado_ingresos_cantidades',true),
                        "cantidades_a_ingresar"=>$this->input->post('cantidades_a_ingresar',true),
                        "total_cajas_pendientes"=>$total_cajas_pendientes,
                        "cierra_la_orden"=>$this->input->post('cierra_la_orden',true),
                        "estado"=>$this->input->post('estado',true),
                        "quien"=>$this->session->userdata('id'),
                        "cuando"=>date("Y-m-d"),
                        "glosa"=>$this->input->post('glosa',true),
                        "situacion"=>$situacion,
                        "fecha_pendiente"=>$fecha_pendiente,
                        "fecha_liberada"=>$fecha_liberada,
                        "fecha_activa"=>$fecha_activa,
                        "fecha_orden_cerrada"=>$fecha_orden_cerrada,
                    );
                    
                  //  print_r($data);exit();
                    
                    if(sizeof($control)==0)
                    {
                        $this->db->insert("produccion_bodega",$data);                        
                    }else
                    {
                        $this->db->update('produccion_bodega', $data, array('tipo' => $this->input->post('tipo',true),'id_nodo'=>$this->input->post('id',true)));                       
                    }    
					
		//Parcial				
					
		    $data2=array
                    (              
                        "id_usuario"=>$this->session->userdata('id'),
                        "tipo"=>$this->input->post('tipo',true),
                        "id_nodo"=>$this->input->post('id',true),
                        "id_cliente"=>$this->input->post('id_cliente',true),
                        "orden_de_trabajo"=>$this->input->post('id',true),
                        "descripcion_del_trabajo"=>$this->input->post('descripcion_del_trabajo',true),
                        "fecha_de_entrega"=>$this->input->post('fecha_de_entrega',true),
                        "ingreso_a_bodega"=>$this->input->post('ingreso_a_bodega',false),
                        "numero_de_orden_de_trabajo"=>$this->input->post('numero_de_orden_de_trabajo',true),
                        "cantidad_de_cajas"=>$this->input->post('cantidad_de_cajas',true),
                        "precio_venta"=>$this->input->post('precio_venta',true),
                        "codigo_producto"=>$this->input->post('codigo_producto',true),
                        "unidades_por_paquete_oficial"=>$this->input->post('unidades_por_paquete_oficial',true),
                        "unidades_paquete_efectivo"=>$this->input->post('unidades_paquete_efectivo',true),
                        "paquetes_por_pallet"=>$this->input->post('paquetes_por_pallet',true),
                        "medidas_de_pallet"=>$this->input->post('medidas_de_pallet',true),
                        "total_de_ingresos"=>$this->input->post('total_de_ingresos',true),
                        "total_cajas_ingresadas"=>$this->input->post('total_cajas_ingresadas',true),
                        "listado_ingresos_cantidades"=>$this->input->post('listado_ingresos_cantidades',true),
                        "cantidades_a_ingresar"=>$this->input->post('cantidades_a_ingresar',true),
                        "total_cajas_pendientes"=>$this->input->post('total_cajas_pendientes',true),
                        "cierra_la_orden"=>$this->input->post('cierra_la_orden',true),
                        "estado"=>$this->input->post('estado',true),
                        "quien"=>$this->session->userdata('id'),
                        "cuando"=>date("Y-m-d"),
                        "glosa"=>$this->input->post('glosa',true),
                        "situacion"=>$situacion,
                        "fecha_pendiente"=>$fecha_pendiente,
                        "fecha_liberada"=>$fecha_liberada,
                        "fecha_activa"=>$fecha_activa,
                        "fecha_orden_cerrada"=>$fecha_orden_cerrada,
                    );
					
                    if($this->input->post('estado',true) == '3')
                    {
                        $this->db->insert("produccion_bodega_parcial",$data);
                    }
		
                    //Parcial Fin										
                    switch($tipo)
                    {
                        case '1':
                            $this->session->set_flashdata('ControllerMessage', 'Se ha guardado el registro exitosamente.');					            
                            redirect(base_url().'produccion/cotizaciones/'.$this->input->post('pagina',true),  301);
                        break;
                         case '2':
                            $this->session->set_flashdata('ControllerMessage', 'Se ha guardado el registro exitosamente.');					            
                            redirect(base_url().'produccion/fast/'.$this->input->post('pagina',true),  301);
                        break;
                    }   
                }
            }
            $usuarios=$this->usuarios_model->getUsuariosPorTipo(3);
            $this->layout->view("despacho",compact('usuarios','datos','tipo','pagina','id','control','ing','fotomecanica','cotizacion','hoja','troquelado','orden','pegado','fotomecanica2','ordenDeCompra','talleres_externos','producto')); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
        
	}                        

    public function listado_programa_emplacado()
    {
        if($this->session->userdata('id'))
        {
            $datos=$this->orden_model->getListadoProgramaEmplacado();

            $cuerpo=' <!DOCTYPE html>
            <html>
                        <head>
                            <meta charset="utf-8" />
                            <link type="text/css" rel="stylesheet" href="'.base_url().'bootstrap/despacho.css" />
                        </head>
                        <body>
                        <h3><p class="text-center">PROGRAMA DE EMPLACADO</p></h3>
                    <p class="text-right">Fecha: '.date('d-m-Y').'</p>

                         <table border="1" width="100%">
                            <tr>
                                <td>OT</td>
                                <td>Cliente</td>
                                <td>Trabajo</td>
                                <td>Cartulina Ancho</td>
                                <td>Cartulina Largo</td>                                
                                <td>Cuchillo Ancho</td>
                                <td>Cuchillo Largo</td>                                
                                <td>Liner</td>
                                <td>Onda</td>
                                <td>Tipo</td>
                                <td>Cantidad</td>
                                <td>Despachos</td>
                                <td>Total a Frabricar</td>
                            </tr>';
             
            foreach ($datos as $dato) {
                            $valores = $this->orden_model->getOndaCotizacion($dato->id_cotizacion);
                            //$onda    = $valores->nombre.' - ('.$valores->gramaje.' '.$valores->reverso.")";
                            //$liner     = $dato->tipo.' - ('.$valores->gramaje.' '.$valores->reverso.")";

                            $datos_cotizacion = $this->cotizaciones_model->getCotizacionPorId($dato->id_cotizacion);
                            echo '<pre>';

                            if (strcasecmp($dato->tipo, 'Cartulina-cartulina') != 0){
                                $onda =$this->cotizaciones_model->getOndaCompleto($datos_cotizacion->materialidad_2);
                                $linder =$this->cotizaciones_model->getOndaCompleto($datos_cotizacion->materialidad_3);

                            }else{
                                //$onda =$this->cotizaciones_model->getOndaCompletoCartulina($datos_cotizacion->id_mat_placa1);
                                //$linder =$this->cotizaciones_model->getOndaCompletoCartulina($datos_cotizacion->id_mat_placa1);

                                $tapa = $this->materiales_model->getMaterialesPorNombre($datos_cotizacion->id_mat_placa1);
                                $monda = $this->materiales_model->getMaterialesPorNombre($datos_cotizacion->id_mat_onda2);
                                $mliner = $this->materiales_model->getMaterialesPorNombre($datos_cotizacion->id_mat_liner3);
                                //$onda = $tapa->materiales_tipo.''.$tapa->gramaje;
                                
                                //$hoja   = $this->cotizaciones_model->getHojaDeCostosPorIdCotizacion($dato->id_cotizacion);
                                //$placakilo = $hoja->placa_kilo.' '.$hoja->kilos_placa;
                                // $placakilos = $hoja->kilos_placa;

                                $onda   = $monda->materiales_tipo.' '.$monda->gramaje.' ('.$monda->reverso.')';
                                $linder = $tapa->materiales_tipo.'-'.$mliner->materiales_tipo.' '.$mliner->gramaje.' ('.$monda->reverso.')';
                                //print_r($tapa);
                                //exit();
                            }                                                
                            //print_r($onda);
                            //exit();

                            //Cantidad de Despacho
                            $despacho = $this->despachos_model->getDespachosUltimoRegistro($dato->id_cotizacion);

                            $cuerpo .='<tr>
                                <td>'.$dato->ot.'</td>
                                <td>'.$dato->razon_social.'</td>
                                <td>'.$dato->producto.'</td>
                                <td>'.$dato->ancho.'</td>
                                <td>'.$dato->largo.'</td>
                                <td>'.$dato->tamano_cuchillo_1.'</td>
                                <td>'.$dato->tamano_cuchillo_2.'</td>                                
                                <td>'.$linder.'</td>
                                <td>'.(($valores->nombre)? $onda : '').'</td>
                                <td>'.$dato->tipo.'</td>
                                <td align="right">'.$dato->cantidad.'</td>
                                <td align="right">'.$despacho->cantidad_faltante.'</td>
                                <td align="right">'.($dato->cantidad - $despacho->cantidad_faltante).'</td>
                            </tr>';
            }
            $cuerpo .='</table></body>
                      </html>';

        
            $this->mpdf->SetDisplayMode('fullpage');
            $this->mpdf->AddPage('L');
            $css1 = file_get_contents('public/frontend/css/despacho.css');
            $css2 = file_get_contents('bootstrap/bootstrap.css');
            $this->mpdf->WriteHTML($css2,1);
            $this->mpdf->WriteHTML($css1,1);
            $this->mpdf->WriteHTML($cuerpo);
            $this->mpdf->Output();
            exit;
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
    } 

    public function listado_programa_confeccion_revision_sin_liberar_fotomecanica()
    {
        if($this->session->userdata('id'))
        {
            $datos=$this->orden_model->getListadoProgramaConfeccionMolde();
            $contador = 0;
            $lineasPorHoja=10;
            $cuerpo=' <!DOCTYPE html>
            <html>
                        <head>
                            <meta charset="utf-8" />
                            <link type="text/css" rel="stylesheet" href="'.base_url().'bootstrap/despacho.css" />
                        </head>
                        <body>
                        <h3><p class="text-center">PROGRAMA DE CONFECCION DE MOLDE</p></h3>
                        <h6><p class="text-center">REVISION SIN LIBERAR FOTOMECANICA</p></h6>
                    <p class="text-right">Fecha: '.date('d-m-Y').'</p>

                         <table border="1" width="100%">
                            <tr>
                                <td align="center"><b>OT</b></td>
                                <td align="center"><b>Fecha OT</b></td>
                                <td align="center"><b>Fecha Liberacion FOMECA</b></td>
                                <td align="center"><b>Cliente</b></td>
                                <td align="center"><b>Trabajo</b></td>
                                <td align="center"><b>Desgaje Autom.</b></td>
                                <td align="center"><b>Trazado Desgajado</b></td>
                                <td align="center"><b>Pegado Autom.</b></td>
                                <td align="center"><b>Molde Numero</b></td>
                                <td align="center"><b>Repeticion</b></td>
                                <td align="center"><b>Numero Trazado</b></td>
                                <td align="center"><b>Numero Asignado</b></td>
                                <td align="center"><b>Fecha confeccion maqueta</b></td>
                                <td align="center"><b>CCAC1 Ancho</b></td>
                                <td align="center"><b>CCAC2 Largo</b></td>
                                <td align="center"><b>Cuchillo a Cuchillo</b></td>
                                <td align="center"><b>Micro corrugado</b></td>
                                <td align="center"><b>Tipo de Troquelado</b></td>
                                <td align="center"><b>Fecha recepcion muestra</b></td>
                                <td align="center"><b>Cant. Golpes</b></td>
                                <td align="center"><b>Estado</b></td>
                            </tr>';
             
            foreach ($datos as $dato) {
                            
                            if ($dato->hay_que_troquelar=='SI' && $dato->condicion_del_producto!='Nuevo' && ($dato->fecha_liberada=='' || $dato->fecha_liberada=='0000-00-00')) {

                                if ($dato->estado == 1) {
                                    $estado_op= "Activa";
                                }
                            
                                $fecha_liberada='Sin liberar';

                                if ($dato->desgajado_automatico==NULL) {
                                    $desgajado_automatico='NO';
                                }else{
                                    $desgajado_automatico= $dato->desgajado_automatico;
                                }

                                if ($dato->desgajado_automatico==NULL || $dato->desgajado_automatico=='NO') {
                                    $trazado_desgajado='NO';
                                }elseif ($dato->desgajado_automatico=='SI'){
                                    $trazado_desgajado=$dato->conf_sal_pel_desgajado;
                                }

                                if ($dato->es_una_maquina==NULL) {
                                    $es_una_maquina='NO';
                                }else{
                                    $es_una_maquina= $dato->es_una_maquina;
                                }

                                if ($dato->troquel_por_atras=="SI") {
                                    $troquel_por_atras= "Por atrás, margen izquierdo, retiro";
                                }elseif($dato->troquel_por_atras=="NO"){
                                    $troquel_por_atras='Por adelante, margen derecho, tiro';
                                }else{
                                    $troquel_por_atras='Por definir';
                                }

                                if ($dato->conf_sal_pel_fecha=='' || $dato->conf_sal_pel_fecha=='0000-00-00' || $dato->conf_sal_pel_fecha==null) {
                                    $conf_sal_pel_fecha='SIN CONFECCION';
                                }else{
                                    $conf_sal_pel_fecha=$dato->conf_sal_pel_fecha;
                                }

                                if ($dato->recepcion_maqueta_fecha=='' || $dato->recepcion_maqueta_fecha=='0000-00-00' || $dato->recepcion_maqueta_fecha==null) {
                                    $recepcion_maqueta_fecha='SIN RECEPCION';
                                }else{
                                    $recepcion_maqueta_fecha=$dato->recepcion_maqueta_fecha;
                                }

                                $cuerpo .='<tr>
                                    <td align="center">'.$dato->ot.'</td>
                                    <td align="center">'.$dato->fecha.'</td>
                                    <td align="center">'.$fecha_liberada.'</td>
                                    <td align="center">'.$dato->razon_social.'</td>
                                    <td align="center">'.$dato->producto.'</td>
                                    <td align="center">'.$desgajado_automatico.'</td>
                                    <td align="center">'.$trazado_desgajado.'</td>
                                    <td align="center">'.$es_una_maquina.'</td>
                                    <td align="center">'.$dato->id_molde.'</td>
                                    <td align="center">'.$dato->condicion_del_producto.'</td>
                                    <td align="center">'.$dato->trazado.'</td>
                                    <td align="center">'.$dato->mg_id.'</td>
                                    <td align="center">'.$conf_sal_pel_fecha.'</td>
                                    <td align="center">'.$dato->ccac_1.' Mms</td>
                                    <td align="center">'.$dato->ccac_2.' Mms</td>
                                    <td align="center">'.$dato->tamano_cuchillo_1.' X '.$dato->tamano_cuchillo_2.' Cms</td>
                                    <td align="center">'.$dato->materialidad_datos_tecnicos.'</td>
                                    <td align="center">'.$troquel_por_atras.'</td>
                                    <td align="center">'.$recepcion_maqueta_fecha.'</td>
                                    <td align="center">'.($dato->cantidad_de_cajas)/($dato->unidades_por_pliego).'</td>
                                    <td align="center">'.$estado_op.'</td>
                                </tr>';
                                
                                $contador = $contador+1;

                                if ($contador==$lineasPorHoja) {
                                    
                                    $cuerpo .= "</table>
                                
                                    <br><table style='page-break-after:always;'></table><br>
                                    <table border='1' width='100%'>

                                        <tr>
                                            <td align='center'><b>OT</b></td>
                                            <td align='center'><b>Fecha OT</b></td>
                                            <td align='center'><b>Fecha Liberacion FOMECA</b></td>
                                            <td align='center'><b>Cliente</b></td>
                                            <td align='center'><b>Trabajo</b></td>
                                            <td align='center'><b>Desgaje Autom.</b></td>
                                            <td align='center'><b>Trazado Desgajado</b></td>
                                            <td align='center'><b>Pegado Autom.</b></td>
                                            <td align='center'><b>Molde Numero</b></td>
                                            <td align='center'><b>Repeticion</b></td>
                                            <td align='center'><b>Numero Trazado</b></td>
                                            <td align='center'><b>Numero Asignado</b></td>
                                            <td align='center'><b>Fecha confeccion</b></td>
                                            <td align='center'><b>CCAC1 Ancho</b></td>
                                            <td align='center'><b>CCAC2 Largo</b></td>
                                            <td align='center'><b>Cuchillo a Cuchillo</b></td>
                                            <td align='center'><b>Micro corrugado</b></td>
                                            <td align='center'><b>Tipo de Troquelado</b></td>
                                            <td align='center'><b>Fecha recepcion muestra</b></td>
                                            <td align='center'><b>Cant. Golpes</b></td>
                                            <td align='center'><b>Estado</b></td>
                                        </tr>";
                                        $contador=0;
                                        $lineasPorHoja=12;
                                        
                                } 
                            }
                            
            }
            $cuerpo .='</table></body>
                      </html>';

            $this->mpdf->SetDisplayMode('fullpage');
            $this->mpdf->AddPage('L');
            $css1 = file_get_contents('public/frontend/css/despacho.css');
            $css2 = file_get_contents('bootstrap/bootstrap.css');
            $this->mpdf->WriteHTML($css2,1);
            $this->mpdf->WriteHTML($css1,1);
            $this->mpdf->WriteHTML($cuerpo);
            $this->mpdf->Output();
            
            
            exit;
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
    } 

    public function listado_programa_confeccion_revision_liberada_fotomecanica()
    {

        if($this->session->userdata('id'))
        {
            $datos=$this->orden_model->getListadoProgramaConfeccionMolde();
            
            $contador = 0;
            $lineasPorHoja=10;
            $cuerpo=' <!DOCTYPE html>
            <html>
                        <head>
                            <meta charset="utf-8" />
                            <link type="text/css" rel="stylesheet" href="'.base_url().'bootstrap/despacho.css" />
                        </head>
                        <body>
                        <h3><p class="text-center">PROGRAMA DE CONFECCION DE MOLDE</p></h3>
                        <h6><p class="text-center">REVISION LIBERADA FOTOMECANICA</p></h6>
                    <p class="text-right">Fecha: '.date('d-m-Y').'</p>

                         <table border="1" width="100%">
                            <tr>
                                <td align="center"><b>OT</b></td>
                                <td align="center"><b>Fecha OT</b></td>
                                <td align="center"><b>Fecha Liberacion FOMECA</b></td>
                                <td align="center"><b>Cliente</b></td>
                                <td align="center"><b>Trabajo</b></td>
                                <td align="center"><b>Desgaje Autom.</b></td>
                                <td align="center"><b>Trazado Desgajado</b></td>
                                <td align="center"><b>Pegado Autom.</b></td>
                                <td align="center"><b>Molde Numero</b></td>
                                <td align="center"><b>Repeticion</b></td>
                                <td align="center"><b>Numero Trazado</b></td>
                                <td align="center"><b>Numero Asignado</b></td>
                                <td align="center"><b>Fecha confeccion maqueta</b></td>
                                <td align="center"><b>CCAC1 Ancho</b></td>
                                <td align="center"><b>CCAC2 Largo</b></td>
                                <td align="center"><b>Cuchillo a Cuchillo</b></td>
                                <td align="center"><b>Micro corrugado</b></td>
                                <td align="center"><b>Tipo de Troquelado</b></td>
                                <td align="center"><b>Fecha recepcion muestra</b></td>
                                <td align="center"><b>Cant. Golpes</b></td>
                                <td align="center"><b>Estado</b></td>
                            </tr>';
             
            foreach ($datos as $dato) {
                //Para filtrar por confeccion de molde liberadas
                $confeccion_molde_troquel=$this->produccion_model->getConfeccionModelTroquel($dato->id_cotizacion);

                            //INICIO DEL IF POR FABRICAR      
                            if ($dato->hay_que_troquelar=='SI' && $dato->condicion_del_producto!='Nuevo' && $dato->fecha_liberada!='0000-00-00' && $confeccion_molde_troquel->estado!=1 && $dato->situacion=='Liberada') {

                                if ($dato->estado == 1) {
                                    $estado_op= "Activa";
                                }
                                
                                $fecha_liberada= $dato->fecha_liberada;
                                

                                if ($dato->desgajado_automatico==NULL) {
                                    $desgajado_automatico='NO';
                                }else{
                                    $desgajado_automatico= $dato->desgajado_automatico;
                                }

                                if ($dato->desgajado_automatico==NULL || $dato->desgajado_automatico=='NO') {
                                    $trazado_desgajado='NO';
                                }elseif ($dato->desgajado_automatico=='SI'){
                                    $trazado_desgajado=$dato->conf_sal_pel_desgajado;
                                }

                                if ($dato->es_una_maquina==NULL) {
                                    $es_una_maquina='NO';
                                }else{
                                    $es_una_maquina= $dato->es_una_maquina;
                                }

                                if ($dato->troquel_por_atras=="SI") {
                                    $troquel_por_atras= "Por atrás, margen izquierdo, retiro";
                                }elseif($dato->troquel_por_atras=="NO"){
                                    $troquel_por_atras='Por adelante, margen derecho, tiro';
                                }else{
                                    $troquel_por_atras='Por definir';
                                }

                                $cuerpo .='<tr>
                                    <td align="center">'.$dato->ot.'</td>
                                    <td align="center">'.$dato->fecha.'</td>
                                    <td align="center">'.$fecha_liberada.'</td>
                                    <td align="center">'.$dato->razon_social.'</td>
                                    <td align="center">'.$dato->producto.'</td>
                                    <td align="center">'.$desgajado_automatico.'</td>
                                    <td align="center">'.$trazado_desgajado.'</td>
                                    <td align="center">'.$es_una_maquina.'</td>
                                    <td align="center">'.$dato->id_molde.'</td>
                                    <td align="center">'.$dato->condicion_del_producto.'</td>
                                    <td align="center">'.$dato->trazado.'</td>
                                    <td align="center">'.$dato->mg_id.'</td>
                                    <td align="center">'.$dato->conf_sal_pel_fecha.'</td>
                                    <td align="center">'.$dato->ccac_1.' Mms</td>
                                    <td align="center">'.$dato->ccac_2.' Mms</td>
                                    <td align="center">'.$dato->tamano_cuchillo_1.' X '.$dato->tamano_cuchillo_2.' Cms</td>
                                    <td align="center">'.$dato->materialidad_datos_tecnicos.'</td>
                                    <td align="center">'.$troquel_por_atras.'</td>
                                    <td align="center">'.$dato->recepcion_maqueta_fecha.'</td>
                                    <td align="center">'.($dato->cantidad_de_cajas)/($dato->unidades_por_pliego).'</td>
                                    <td align="center">'.$estado_op.'</td>
                                </tr>';
                                
                                $contador = $contador+1;
                                if ($contador==$lineasPorHoja) {
                                    
                                    $cuerpo .= "</table>
                                
                                    <br><table style='page-break-after:always;'></table><br>
                                    <table border='1' width='100%'>

                                        <tr>
                                            <td align='center'><b>OT</b></td>
                                            <td align='center'><b>Fecha OT</b></td>
                                            <td align='center'><b>Fecha Liberacion FOMECA</b></td>
                                            <td align='center'><b>Cliente</b></td>
                                            <td align='center'><b>Trabajo</b></td>
                                            <td align='center'><b>Desgaje Autom.</b></td>
                                            <td align='center'><b>Trazado Desgajado</b></td>
                                            <td align='center'><b>Pegado Autom.</b></td>
                                            <td align='center'><b>Molde Numero</b></td>
                                            <td align='center'><b>Repeticion</b></td>
                                            <td align='center'><b>Numero Trazado</b></td>
                                            <td align='center'><b>Numero Asignado</b></td>
                                            <td align='center'><b>Fecha confeccion</b></td>
                                            <td align='center'><b>CCAC1 Ancho</b></td>
                                            <td align='center'><b>CCAC2 Largo</b></td>
                                            <td align='center'><b>Cuchillo a Cuchillo</b></td>
                                            <td align='center'><b>Micro corrugado</b></td>
                                            <td align='center'><b>Tipo de Troquelado</b></td>
                                            <td align='center'><b>Fecha recepcion muestra</b></td>
                                            <td align='center'><b>Cant. Golpes</b></td>
                                            <td align='center'><b>Estado</b></td>
                                        </tr>";
                                        $contador=0;
                                        $lineasPorHoja=12;
                                } 
                            }
                            //FIN DEL IF 'POR FABRICAR'
            }
            $cuerpo .='</table></body>
                      </html>';

           
                $this->mpdf->SetDisplayMode('fullpage');
                $this->mpdf->AddPage('L');
                $css1 = file_get_contents('public/frontend/css/despacho.css');
                $css2 = file_get_contents('bootstrap/bootstrap.css');
                $this->mpdf->WriteHTML($css2,1);
                $this->mpdf->WriteHTML($css1,1);
                $this->mpdf->WriteHTML($cuerpo);
                $this->mpdf->Output();
            
            
            exit;
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
    }

    public function listado_programa_confeccion_fabricar_sin_liberar_fotomecanica()
    {
        if($this->session->userdata('id'))
        {
            $datos=$this->orden_model->getListadoProgramaConfeccionMolde();
            $contador = 0;
            $lineasPorHoja=10;
            $cuerpo=' <!DOCTYPE html>
            <html>
                        <head>
                            <meta charset="utf-8" />
                            <link type="text/css" rel="stylesheet" href="'.base_url().'bootstrap/despacho.css" />
                        </head>
                        <body>
                        <h3><p class="text-center">PROGRAMA DE CONFECCION DE MOLDE</p></h3>
                        <h6><p class="text-center">POR FABRICAR SIN LIBERAR FOTOMECANICA</p></h6>
                    <p class="text-right">Fecha: '.date('d-m-Y').'</p>

                         <table border="1" width="100%">
                            <tr>
                                <td align="center"><b>OT</b></td>
                                <td align="center"><b>Fecha OT</b></td>
                                <td align="center"><b>Fecha Liberacion FOMECA</b></td>
                                <td align="center"><b>Cliente</b></td>
                                <td align="center"><b>Trabajo</b></td>
                                <td align="center"><b>Desgaje Autom.</b></td>
                                <td align="center"><b>Trazado Desgajado</b></td>
                                <td align="center"><b>Pegado Autom.</b></td>
                                <td align="center"><b>Molde Numero</b></td>
                                <td align="center"><b>Repeticion</b></td>
                                <td align="center"><b>Numero Trazado</b></td>
                                <td align="center"><b>Numero Asignado</b></td>
                                <td align="center"><b>Fecha confeccion maqueta</b></td>
                                <td align="center"><b>CCAC1 Ancho</b></td>
                                <td align="center"><b>CCAC2 Largo</b></td>
                                <td align="center"><b>Cuchillo a Cuchillo</b></td>
                                <td align="center"><b>Micro corrugado</b></td>
                                <td align="center"><b>Tipo de Troquelado</b></td>
                                <td align="center"><b>Fecha recepcion muestra</b></td>
                                <td align="center"><b>Cant. Golpes</b></td>
                                <td align="center"><b>Estado</b></td>
                            </tr>';
             
            foreach ($datos as $dato) {
                            
                            if ($dato->hay_que_troquelar=='SI' && $dato->condicion_del_producto=='Nuevo' && ($dato->fecha_liberada=='0000-00-00' || $dato->fecha_liberada=='')) {

                                if ($dato->estado == 1) {
                                    $estado_op= "Activa";
                                }
                                
                                $fecha_liberada='Sin liberar';
                                

                                if ($dato->desgajado_automatico==NULL) {
                                    $desgajado_automatico='NO';
                                }else{
                                    $desgajado_automatico= $dato->desgajado_automatico;
                                }

                                if ($dato->desgajado_automatico==NULL || $dato->desgajado_automatico=='NO') {
                                    $trazado_desgajado='NO';
                                }elseif ($dato->desgajado_automatico=='SI'){
                                    $trazado_desgajado=$dato->conf_sal_pel_desgajado;
                                }

                                if ($dato->es_una_maquina==NULL) {
                                    $es_una_maquina='NO';
                                }else{
                                    $es_una_maquina= $dato->es_una_maquina;
                                }

                                if ($dato->troquel_por_atras=="SI") {
                                    $troquel_por_atras= "Por atrás, margen izquierdo, retiro";
                                }elseif($dato->troquel_por_atras=="NO"){
                                    $troquel_por_atras='Por adelante, margen derecho, tiro';
                                }else{
                                    $troquel_por_atras='Por definir';
                                }

                                $cuerpo .='<tr>
                                    <td align="center">'.$dato->ot.'</td>
                                    <td align="center">'.$dato->fecha.'</td>
                                    <td align="center">'.$fecha_liberada.'</td>
                                    <td align="center">'.$dato->razon_social.'</td>
                                    <td align="center">'.$dato->producto.'</td>
                                    <td align="center">'.$desgajado_automatico.'</td>
                                    <td align="center">'.$trazado_desgajado.'</td>
                                    <td align="center">'.$es_una_maquina.'</td>
                                    <td align="center">'.$dato->id_molde.'</td>
                                    <td align="center">'.$dato->condicion_del_producto.'</td>
                                    <td align="center">'.$dato->trazado.'</td>
                                    <td align="center">'.$dato->mg_id.'</td>
                                    <td align="center">'.$dato->conf_sal_pel_fecha.'</td>
                                    <td align="center">'.$dato->ccac_1.' Mms</td>
                                    <td align="center">'.$dato->ccac_2.' Mms</td>
                                    <td align="center">'.$dato->tamano_cuchillo_1.' X '.$dato->tamano_cuchillo_2.' Cms</td>
                                    <td align="center">'.$dato->materialidad_datos_tecnicos.'</td>
                                    <td align="center">'.$troquel_por_atras.'</td>
                                    <td align="center">'.$dato->recepcion_maqueta_fecha.'</td>
                                    <td align="center">'.($dato->cantidad_de_cajas)/($dato->unidades_por_pliego).'</td>
                                    <td align="center">'.$estado_op.'</td>
                                </tr>';
                                
                                $contador = $contador+1;
                                if ($contador==$lineasPorHoja) {
                                    
                                    $cuerpo .= "</table>
                                
                                    <br><table style='page-break-after:always;'></table><br>
                                    <table border='1' width='100%'>

                                        <tr>
                                            <td align='center'><b>OT</b></td>
                                            <td align='center'><b>Fecha OT</b></td>
                                            <td align='center'><b>Fecha Liberacion FOMECA</b></td>
                                            <td align='center'><b>Cliente</b></td>
                                            <td align='center'><b>Trabajo</b></td>
                                            <td align='center'><b>Desgaje Autom.</b></td>
                                            <td align='center'><b>Trazado Desgajado</b></td>
                                            <td align='center'><b>Pegado Autom.</b></td>
                                            <td align='center'><b>Molde Numero</b></td>
                                            <td align='center'><b>Repeticion</b></td>
                                            <td align='center'><b>Numero Trazado</b></td>
                                            <td align='center'><b>Numero Asignado</b></td>
                                            <td align='center'><b>Fecha confeccion</b></td>
                                            <td align='center'><b>CCAC1 Ancho</b></td>
                                            <td align='center'><b>CCAC2 Largo</b></td>
                                            <td align='center'><b>Cuchillo a Cuchillo</b></td>
                                            <td align='center'><b>Micro corrugado</b></td>
                                            <td align='center'><b>Tipo de Troquelado</b></td>
                                            <td align='center'><b>Fecha recepcion muestra</b></td>
                                            <td align='center'><b>Cant. Golpes</b></td>
                                            <td align='center'><b>Estado</b></td>
                                        </tr>";
                                        $contador=0;
                                        $lineasPorHoja=12;
                                        
                                } 
                            }
                            
            }
            $cuerpo .='</table></body>
                      </html>';

           
                $this->mpdf->SetDisplayMode('fullpage');
                $this->mpdf->AddPage('L');
                $css1 = file_get_contents('public/frontend/css/despacho.css');
                $css2 = file_get_contents('bootstrap/bootstrap.css');
                $this->mpdf->WriteHTML($css2,1);
                $this->mpdf->WriteHTML($css1,1);
                $this->mpdf->WriteHTML($cuerpo);
                $this->mpdf->Output();
            
            
            exit;
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
    } 

    public function listado_programa_confeccion_fabricar_liberada_fotomecanica()
    {
        if($this->session->userdata('id'))
        {
            $datos=$this->orden_model->getListadoProgramaConfeccionMolde();
            $contador = 0;
            $lineasPorHoja=10;
            $cuerpo=' <!DOCTYPE html>
            <html>
                        <head>
                            <meta charset="utf-8" />
                            <link type="text/css" rel="stylesheet" href="'.base_url().'bootstrap/despacho.css" />
                        </head>
                        <body>
                        <h3><p class="text-center">PROGRAMA DE CONFECCION DE MOLDE</p></h3>
                        <h6><p class="text-center">POR FABRICAR LIBERADA FOTOMECANICA</p></h6>
                    <p class="text-right">Fecha: '.date('d-m-Y').'</p>

                         <table border="1" width="100%">
                            <tr>
                                <td align="center"><b>OT</b></td>
                                <td align="center"><b>Fecha OT</b></td>
                                <td align="center"><b>Fecha Liberacion FOMECA</b></td>
                                <td align="center"><b>Cliente</b></td>
                                <td align="center"><b>Trabajo</b></td>
                                <td align="center"><b>Desgaje Autom.</b></td>
                                <td align="center"><b>Trazado Desgajado</b></td>
                                <td align="center"><b>Pegado Autom.</b></td>
                                <td align="center"><b>Molde Numero</b></td>
                                <td align="center"><b>Repeticion</b></td>
                                <td align="center"><b>Numero Trazado</b></td>
                                <td align="center"><b>Numero Asignado</b></td>
                                <td align="center"><b>Fecha confeccion maqueta</b></td>
                                <td align="center"><b>CCAC1 Ancho</b></td>
                                <td align="center"><b>CCAC2 Largo</b></td>
                                <td align="center"><b>Cuchillo a Cuchillo</b></td>
                                <td align="center"><b>Micro corrugado</b></td>
                                <td align="center"><b>Tipo de Troquelado</b></td>
                                <td align="center"><b>Fecha recepcion muestra</b></td>
                                <td align="center"><b>Cant. Golpes</b></td>
                                <td align="center"><b>Estado</b></td>
                            </tr>';
             
            foreach ($datos as $dato) {
                            if ($dato->hay_que_troquelar=='SI' && $dato->condicion_del_producto=='Nuevo' && $dato->fecha_liberada!=NULL && $dato->fecha_liberada!='0000-00-00') {

                                if ($dato->estado == 1) {
                                    $estado_op= "Activa";
                                }
                                
                                $fecha_liberada= $dato->fecha_liberada;

                                if ($dato->desgajado_automatico==NULL) {
                                    $desgajado_automatico='NO';
                                }else{
                                    $desgajado_automatico= $dato->desgajado_automatico;
                                }

                                if ($dato->desgajado_automatico==NULL || $dato->desgajado_automatico=='NO') {
                                    $trazado_desgajado='NO';
                                }elseif ($dato->desgajado_automatico=='SI'){
                                    $trazado_desgajado=$dato->conf_sal_pel_desgajado;
                                }

                                if ($dato->es_una_maquina==NULL) {
                                    $es_una_maquina='NO';
                                }else{
                                    $es_una_maquina= $dato->es_una_maquina;
                                }

                                if ($dato->troquel_por_atras=="SI") {
                                    $troquel_por_atras= "Por atrás, margen izquierdo, retiro";
                                }elseif($dato->troquel_por_atras=="NO"){
                                    $troquel_por_atras='Por adelante, margen derecho, tiro';
                                }else{
                                    $troquel_por_atras='Por definir';
                                }

                                $cuerpo .='<tr>
                                    <td align="center">'.$dato->ot.'</td>
                                    <td align="center">'.$dato->fecha.'</td>
                                    <td align="center">'.$fecha_liberada.'</td>
                                    <td align="center">'.$dato->razon_social.'</td>
                                    <td align="center">'.$dato->producto.'</td>
                                    <td align="center">'.$desgajado_automatico.'</td>
                                    <td align="center">'.$trazado_desgajado.'</td>
                                    <td align="center">'.$es_una_maquina.'</td>
                                    <td align="center">'.$dato->id_molde.'</td>
                                    <td align="center">'.$dato->condicion_del_producto.'</td>
                                    <td align="center">'.$dato->trazado.'</td>
                                    <td align="center">'.$dato->mg_id.'</td>
                                    <td align="center">'.$dato->conf_sal_pel_fecha.'</td>
                                    <td align="center">'.$dato->ccac_1.' Mms</td>
                                    <td align="center">'.$dato->ccac_2.' Mms</td>
                                    <td align="center">'.$dato->tamano_cuchillo_1.' X '.$dato->tamano_cuchillo_2.' Cms</td>
                                    <td align="center">'.$dato->materialidad_datos_tecnicos.'</td>
                                    <td align="center">'.$troquel_por_atras.'</td>
                                    <td align="center">'.$dato->recepcion_maqueta_fecha.'</td>
                                    <td align="center">'.($dato->cantidad_de_cajas)/($dato->unidades_por_pliego).'</td>
                                    <td align="center">'.$estado_op.'</td>
                                </tr>';
                                
                                $contador = $contador+1;
                                if ($contador==$lineasPorHoja) {
                                    
                                    $cuerpo .= "</table>
                                
                                    <br><table style='page-break-after:always;'></table><br>
                                    <table border='1' width='100%'>

                                        <tr>
                                            <td align='center'><b>OT</b></td>
                                            <td align='center'><b>Fecha OT</b></td>
                                            <td align='center'><b>Fecha Liberacion FOMECA</b></td>
                                            <td align='center'><b>Cliente</b></td>
                                            <td align='center'><b>Trabajo</b></td>
                                            <td align='center'><b>Desgaje Autom.</b></td>
                                            <td align='center'><b>Trazado Desgajado</b></td>
                                            <td align='center'><b>Pegado Autom.</b></td>
                                            <td align='center'><b>Molde Numero</b></td>
                                            <td align='center'><b>Repeticion</b></td>
                                            <td align='center'><b>Numero Trazado</b></td>
                                            <td align='center'><b>Numero Asignado</b></td>
                                            <td align='center'><b>Fecha confeccion</b></td>
                                            <td align='center'><b>CCAC1 Ancho</b></td>
                                            <td align='center'><b>CCAC2 Largo</b></td>
                                            <td align='center'><b>Cuchillo a Cuchillo</b></td>
                                            <td align='center'><b>Micro corrugado</b></td>
                                            <td align='center'><b>Tipo de Troquelado</b></td>
                                            <td align='center'><b>Fecha recepcion muestra</b></td>
                                            <td align='center'><b>Cant. Golpes</b></td>
                                            <td align='center'><b>Estado</b></td>
                                        </tr>";
                                        $contador=0;
                                        $lineasPorHoja=12;
                                        
                                } 
                            }
            }
            $cuerpo .='</table></body>
                      </html>';

           
                $this->mpdf->SetDisplayMode('fullpage');
                $this->mpdf->AddPage('L');
                $css1 = file_get_contents('public/frontend/css/despacho.css');
                $css2 = file_get_contents('bootstrap/bootstrap.css');
                $this->mpdf->WriteHTML($css2,1);
                $this->mpdf->WriteHTML($css1,1);
                $this->mpdf->WriteHTML($cuerpo);
                $this->mpdf->Output();
            
            
            exit;
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
    } 



    public function ajaxguardar(){
        $id_nodo = $this->input->post("id_nodo",true);
       
        
        if ($id_nodo==NULL) {
            $data = array(
                "id_usuario"                   =>$this->session->userdata('id'),
                "tipo"                         =>$this->input->post('tipo',true),
                "id_nodo"                      => $this->input->post('id_cotizacion_rechazo',true),
                'recepcion_ot'                 => $this->input->post("recepcion_ot",true),
                'comentario_rechazo'           => $this->input->post("comentario_rechazo",true),
                'fecha_rechazada_recepcion_OT' => $this->input->post("fecha_rechazada_recepcion_OT",true),
                'recepcion_ot_aprobado_fecha'  => '0000-00-00',
            );
            $this->db->insert("produccion_fotomecanica",$data);
        } else {
            $data = array(
                'id_nodo'                      => $this->input->post("id_nodo",true),
                'recepcion_ot'                 => $this->input->post("recepcion_ot",true),
                'comentario_rechazo'           => $this->input->post("comentario_rechazo",true),
                'fecha_rechazada_recepcion_OT' => $this->input->post("fecha_rechazada_recepcion_OT",true),
                'recepcion_ot_aprobado_fecha'  => '0000-00-00',
            );
            $this->db->where('id_nodo', $id_nodo);
            $this->db->update("produccion_fotomecanica", $data);
        }
        $fecha_rechazada_recepcion_OT = $this->input->post("fecha_rechazada_recepcion_OT",true);

        echo "Notificado el ".$fecha_rechazada_recepcion_OT;

    }

    public function listado_programa_fotomecanica()
    {
        if($this->session->userdata('id'))
        {
            $datos=$this->orden_model->getListadoProgramaFotomecanica();

            $cuerpo=' <!DOCTYPE html>
            <html>
                        <head>
                            <meta charset="utf-8" />
                            <link type="text/css" rel="stylesheet" href="'.base_url().'bootstrap/despacho.css" />
                        </head>
                        <body>
                        <h3><p class="text-center">PROGRAMA DE FOTOMECANICA SIN LIBERAR</p></h3>
                        
                    <p class="text-right">Fecha: '.date('d-m-Y').'</p>

                         <table border="1" width="100%">
                            <tr>
                                <td>OT</td>
                                <td>Fecha OT</td>
                                <td>Cliente</td>
                                <td>Trabajo</td>
                                <td>Condicion</td>
                                <td>Terminacion</td>                                
                                <td>Reserva</td>                                
                                <td>Trab.Externos</td>
                                <td>Molde o Trazado</td>
                                <td>Colores</td>
                                <td>Ancho</td>
                                <td>Largo</td>                                
                                <td>Tipo</td>
                                <td>Cantidad</td>
                                <td>Estado</td>
                            </tr>';
             
            foreach ($datos as $dato) {
                            //$valores = $this->orden_model->getOndaCotizacion($dato->id_cotizacion);

                if ($dato->hay_que_troquelar=='SI' && ($dato->fecha_liberada=='0000-00-00' || $dato->fecha_liberada=='')) {
                        
                    $fotomecanica=$this->cotizaciones_model->getCotizacionFotomecanicaPorIdCotizacion($dato->id_cotizacion);
                    $ing=$this->cotizaciones_model->getCotizacionIngenieriaPorIdCotizacion($id);

                    if ($ing->archivo==""){
                        $trazado='NO';    
                    }else{
                        $trazado='SI';
                    }

                    if(($fotomecanica->acabado_impresion_4=="17") || ($fotomecanica->acabado_impresion_4==""))
                    {
                        $hayAcabados = 'NO';
                        $lugarAcabado = 'No Aplica';
                    }else{
                        $hayAcabados = 'SI';
                        $lugarAcabado = 'Externo';
                    }
                    //if(($fotomecanica->acabado_impresion_5=="17") && ($hayAcabados != 'SI') && ($fotomecanica->acabado_impresion_5==""))
                    if(($fotomecanica->acabado_impresion_5=="17") || ($fotomecanica->acabado_impresion_5==""))
                    {
                        $hayAcabados = 'NO';
                        $lugarAcabado = 'No Aplica';
                    }else{
                        $hayAcabados = 'SI';
                        $lugarAcabado = 'Externo';
                    }
                    //if(($fotomecanica->acabado_impresion_6=="17") && ($hayAcabados != 'SI') && ($fotomecanica->acabado_impresion_6==""))
                    if(($fotomecanica->acabado_impresion_6=="17") || ($fotomecanica->acabado_impresion_6==""))
                    {
                        $hayAcabados = 'NO';
                        $lugarAcabado = 'No Aplica';
                    }else{
                        $hayAcabados = 'SI';
                        $lugarAcabado = 'Externo';
                    }      

                    $estado=$this->produccion_model->getFotomecanicaPorTipo(1,$dato->id_cotizacion);
                    ///// ///////// CALCULAR EL ESTADO ///////////////
                    $estados_pendiente = '';
                    //echo "<pre>";
                    //print_r($dato);
                    //exit($dato->recepcion_ot);
                    if ( $dato->recepcion_ot== ''){                    
                        $estados_pendiente = 'Recepcion OT';
                       
                    }elseif ( $dato->recepcion_ot!= 'Aprobada'){                    
                        $estados_pendiente = 'Revisión Trazado';

                    }elseif ( $dato->revision_trazado != 'Aprobada'){ 
                        $estados_pendiente = 'Recepcion de Maqueta';

                    }elseif ( $dato->recepcion_maqueta != 'Recepcion Aprobada'){ 
                        $estados_pendiente = 'Revisión de Imagen';                    

                    }elseif ( $dato->revision_imagen != 'Aprobado'){ 
                        $estados_pendiente = 'Montaje Digital';                    

                    }elseif ( $dato->montaje_digital != 'Aprobado'){ 
                        $estados_pendiente = 'Prueba de Color';                    

                    }elseif ( $dato->prueba_color != 'Aprobado'){ 
                        $estados_pendiente = 'Arte y Diseño';                    

                    }elseif ( $dato->arte_diseno != 'Aprobada'){ 
                        $estados_pendiente = 'Confeccion Salida de Pelicula';                    

                    }elseif ( $dato->conf_sal_pel != 'Entregado'){ 
                        $estados_pendiente = 'Sobre de Desarrollo';

                    }elseif ( $dato->sobre_desarrollo != 'Entregado'){ 

                    }                    
                    //////////////////////////////////////////////////                                

                    $onda    = $valores->nombre.' - ('.$valores->gramaje.' '.$valores->reverso.")";

                    //Cantidad de Despacho
                    $despacho = $this->despachos_model->getDespachosUltimoRegistro($dato->id_cotizacion);

                    $cuerpo .='<tr>
                        <td>'.$dato->ot.'</td>
                        <td>'.fecha_con_slash($dato->fecha).'</td>                                
                        <td>'.$dato->razon_social.'</td>
                        <td>'.$dato->producto.'</td>
                        <td>'.$dato->condicion.'</td>
                        <td>'.$fotomecanica->fot_lleva_barniz.'</td>
                        <td>'.$fotomecanica->fot_reserva_barniz.'</td>
                        <td>'.$hayAcabados.'</td>
                        <td>'.$trazado.'</td>
                        <td>'.$dato->colores.'</td>
                        <td>'.$dato->ancho.'</td>
                        <td>'.$dato->largo.'</td>
                        <td>'.$dato->tipo.'</td>
                        <td align="right">'.$dato->cantidad.'</td>
                        <td>'.$estados_pendiente.'</td>                                
                    </tr>';
                }
            }
            $cuerpo .='</table></body>
                      </html>';

        
            $this->mpdf->SetDisplayMode('fullpage');
            $this->mpdf->AddPage('L');
            $css1 = file_get_contents('public/frontend/css/despacho.css');
            $css2 = file_get_contents('bootstrap/bootstrap.css');
            $this->mpdf->WriteHTML($css2,1);
            $this->mpdf->WriteHTML($css1,1);
            $this->mpdf->WriteHTML($cuerpo);
            $this->mpdf->Output();
            exit;
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
    }        

    public function listado_control_cartulina_liberadas()
    {
        if($this->session->userdata('id'))
        {
            $datos=$this->orden_model->getListadoControlCartulina();
            $contador = 0;
            $lineasPorHoja=10;
            $cuerpo=' <!DOCTYPE html>
            <html>
                        <head>
                            <meta charset="utf-8" />
                            <link type="text/css" rel="stylesheet" href="'.base_url().'bootstrap/despacho.css" />
                        </head>
                        <body>
                        <h3><p class="text-center">LISTADO CONTROL CARTULINA</p></h3>
                        <h6><p class="text-center">LIBERADAS</p></h6>
                    <p class="text-right">Fecha: '.date('d-m-Y').'</p>

                         <table border="1" width="100%">
                            <tr>
                                <td align="center"><b>OT</b></td>
                                <td align="center"><b>Fecha OT</b></td>
                                <td align="center"><b>Fecha Liberacion FOMECA</b></td>
                                <td align="center"><b>Cliente</b></td>
                                <td align="center"><b>Trabajo</b></td>
                                <td align="center"><b>Repeticion</b></td>
                                <td align="center"><b>CCAC1 Ancho</b></td>
                                <td align="center"><b>CCAC2 Largo</b></td>
                                <td align="center"><b>Cuchillo a Cuchillo</b></td>
                                <td align="center"><b>Micro corrugado</b></td>
                                <td align="center"><b>Tamaño a cortar</b></td>
                                <td align="center"><b>Gramaje</b></td>
                                <td align="center"><b>Merma</b></td>
                                <td align="center"><b>Cant. Pliegos</b></td>
                                <td align="center"><b>Total Kilos de la Orden</b></td>
                                <td align="center"><b>Total Kilos Liberados</b></td>
                                <td align="center"><b>Total Kilos a Cortar</b></td>
                                <td align="center"><b>Estado</b></td>
                            </tr>';
             
            foreach ($datos as $dato) {
                            
                            if ( ($dato->fecha_liberada_pcc!='' || $dato->fecha_liberada_pcc!='0000-00-00 00:00:00') && ($dato->situacion_pcc=='Parcial' || $dato->situacion_pcc=='Liberada')) {

                                if ($dato->estado_pcc == 3) {
                                    $estado_op= "Liberado Parcial";
                                }
                                if ($dato->estado_pcc == 1) {
                                    $estado_op= "Liberado";
                                }

                                if ($dato->troquel_por_atras=="SI") {
                                    $troquel_por_atras= "Por atrás, margen izquierdo, retiro";
                                }elseif($dato->troquel_por_atras=="NO"){
                                    $troquel_por_atras='Por adelante, margen derecho, tiro';
                                }else{
                                    $troquel_por_atras='Por definir';
                                }

                                if($dato->cantidad_de_cajas==$dato->cantidad_1){
                                    $merma = $dato->total_merma;
                                }elseif($dato->cantidad_de_cajas==$dato->cantidad_2){
                                    $merma = $dato->total_merma2;
                                }elseif($dato->cantidad_de_cajas==$dato->cantidad_3){
                                    $merma = $dato->total_merma3;
                                }elseif($dato->cantidad_de_cajas==$dato->cantidad_4){
                                    $merma = $dato->total_merma3;
                                }

                                $cant_pliegos=((($dato->cantidad_de_cajas)/($dato->unidades_por_pliego))+$merma);

                                if ($dato->total_kilos_restantes==null) {
                                    $total_kilos_restantes=$cant_pliegos;
                                }else{
                                    $total_kilos_restantes=$dato->total_kilos_restantes;
                                }

                                if ($dato->total_kilos_ingresados==null) {
                                    $total_kilos_ingresados=0;
                                }else{
                                    $total_kilos_ingresados=$dato->total_kilos_ingresados;
                                }

                                $total_kilos_a_cortar=$dato->total_kilos-$total_kilos_ingresados;
                                $total_kilos_orden=round(($dato->placa_kilo*$dato->tamano_a_imprimir_1*$dato->tamano_a_imprimir_2*$dato->gramaje)/10000000);
                                if ($total_kilos_a_cortar==0) {
                                    $total_kilos_a_cortar=round(($dato->placa_kilo*$dato->tamano_a_imprimir_1*$dato->tamano_a_imprimir_2*$dato->gramaje)/10000000);
                                }

                                $cuerpo .='<tr>
                                    <td align="center">'.$dato->ot.'</td>
                                    <td align="center">'.$dato->fecha.'</td>
                                    <td align="center">'.$dato->fecha_liberada.'</td>
                                    <td align="center">'.$dato->razon_social.'</td>
                                    <td align="center">'.$dato->producto.'</td>
                                    <td align="center">'.$dato->condicion_del_producto.'</td>
                                    <td align="center">'.$dato->ccac_1.' Mms</td>
                                    <td align="center">'.$dato->ccac_2.' Mms</td>
                                    <td align="center">'.$dato->tamano_cuchillo_1.' X '.$dato->tamano_cuchillo_2.' Cms</td>
                                    <td align="center">'.$dato->materialidad_datos_tecnicos.'</td>
                                    <td align="center">'.$dato->tamano_a_imprimir_1.' X '.$dato->tamano_a_imprimir_2.' Cms</td>
                                    <td align="center">'.$dato->gramaje.'</td>
                                    <td align="center">'.$merma.'</td>
                                    <td align="center">'.$cant_pliegos.'</td>
                                    <td align="center">'.$total_kilos_orden.'</td>
                                    <td align="center">'.$total_kilos_ingresados.'</td>
                                    <td align="center">'.$total_kilos_a_cortar.'</td>
                                    <td align="center">'.$estado_op.'</td>
                                </tr>';
                                
                                $contador = $contador+1;

                                if ($contador==$lineasPorHoja) {
                                    
                                    $cuerpo .= "</table>
                                
                                    <br><table style='page-break-after:always;'></table><br>
                                    <table border='1' width='100%'>

                                        <tr>
                                            <td align='center'><b>OT</b></td>
                                            <td align='center'><b>Fecha OT</b></td>
                                            <td align='center'><b>Fecha Liberacion FOMECA</b></td>
                                            <td align='center'><b>Cliente</b></td>
                                            <td align='center'><b>Trabajo</b></td>
                                            <td align='center'><b>Repeticion</b></td>
                                            <td align='center'><b>CCAC1 Ancho</b></td>
                                            <td align='center'><b>CCAC2 Largo</b></td>
                                            <td align='center'><b>Cuchillo a Cuchillo</b></td>
                                            <td align='center'><b>Micro corrugado</b></td>
                                            <td align='center'><b>Tamaño a cortar</b></td>
                                            <td align='center'><b>Gramaje</b></td>
                                            <td align='center'><b>Merma</b></td>
                                            <td align='center'><b>Cant. Pliegos</b></td>
                                            <td align='center'><b>Total Kilos de la Orden</b></td>
                                            <td align='center'><b>Total Kilos Liberados</b></td>
                                            <td align='center'><b>Total Kilos a Cortar</b></td>
                                            <td align='center'><b>Estado</b></td>
                                        </tr>";
                                        $contador=0;
                                        $lineasPorHoja=12;
                                        
                                } 
                            }
                            
            }
            $cuerpo .='</table></body>
                      </html>';

            $this->mpdf->SetDisplayMode('fullpage');
            $this->mpdf->AddPage('L');
            $css1 = file_get_contents('public/frontend/css/despacho.css');
            $css2 = file_get_contents('bootstrap/bootstrap.css');
            $this->mpdf->WriteHTML($css2,1);
            $this->mpdf->WriteHTML($css1,1);
            $this->mpdf->WriteHTML($cuerpo);
            $this->mpdf->Output();
            
            
            exit;
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
    } 

    public function listado_control_cartulina_por_liberar()
    {
        if($this->session->userdata('id'))
        {
            $datos=$this->orden_model->getListadoControlCartulina();
            $contador = 0;
            $lineasPorHoja=6;
            $cuerpo=' <!DOCTYPE html>
            <html>
                        <head>
                            <meta charset="utf-8" />
                            <link type="text/css" rel="stylesheet" href="'.base_url().'bootstrap/despacho.css" />
                        </head>
                        <body>
                        <h3><p class="text-center">LISTADO CONTROL CARTULINA</p></h3>
                        <h6><p class="text-center">POR LIBERAR</p></h6>
                    <p class="text-right">Fecha: '.date('d-m-Y').'</p>

                         <table border="1" width="100%">
                            <tr>
                                <td align="center"><b>OT</b></td>
                                <td align="center"><b>Fecha OT</b></td>
                                <td align="center"><b>Fecha Liberacion FOMECA</b></td>
                                <td align="center"><b>Cliente</b></td>
                                <td align="center"><b>Trabajo</b></td>
                                <td align="center"><b>Repeticion</b></td>
                                <td align="center"><b>CCAC1 Ancho</b></td>
                                <td align="center"><b>CCAC2 Largo</b></td>
                                <td align="center"><b>Cuchillo a Cuchillo</b></td>
                                <td align="center"><b>Micro corrugado</b></td>
                                <td align="center"><b>Tamaño a cortar</b></td>
                                <td align="center"><b>Gramaje</b></td>
                                <td align="center"><b>Merma</b></td>
                                <td align="center"><b>Cant. Pliegos</b></td>
                                <td align="center"><b>Total Kilos de la Orden</b></td>
                                <td align="center"><b>Total Kilos Liberados</b></td>
                                <td align="center"><b>Total Kilos a Cortar</b></td>
                                <td align="center"><b>Estado</b></td>
                            </tr>';
             
            foreach ($datos as $dato) {
                            
                            if ($dato->situacion_pcc=='Parcial' || $dato->situacion_pcc=='Guardar' || $dato->situacion=='Liberada') {

                                if ($dato->estado_pcc == 3) {
                                    $estado_op= "Liberado Parcial";
                                }
                                if ($dato->estado_pcc == 0) {
                                    $estado_op= "Pendiente";
                                }

                                if ($dato->situacion == 'Liberada' && $dato->situacion_pcc==null) {
                                    $estado_op= "Activa";
                                }

                                if ($dato->troquel_por_atras=="SI") {
                                    $troquel_por_atras= "Por atrás, margen izquierdo, retiro";
                                }elseif($dato->troquel_por_atras=="NO"){
                                    $troquel_por_atras='Por adelante, margen derecho, tiro';
                                }else{
                                    $troquel_por_atras='Por definir';
                                }

                                if($dato->cantidad_de_cajas==$dato->cantidad_1){
                                    $merma = $dato->total_merma;
                                }elseif($dato->cantidad_de_cajas==$dato->cantidad_2){
                                    $merma = $dato->total_merma2;
                                }elseif($dato->cantidad_de_cajas==$dato->cantidad_3){
                                    $merma = $dato->total_merma3;
                                }elseif($dato->cantidad_de_cajas==$dato->cantidad_4){
                                    $merma = $dato->total_merma3;
                                }

                              
                                $cant_pliegos=((($dato->cantidad_de_cajas)/($dato->unidades_por_pliego))+$merma);

                                if ($dato->total_kilos_restantes==null) {
                                    $total_kilos_restantes=$cant_pliegos;
                                }else{
                                    $total_kilos_restantes=$dato->total_kilos_restantes;
                                }

                                if ($dato->total_kilos_ingresados==null) {
                                    $total_kilos_ingresados=0;
                                }else{
                                    $total_kilos_ingresados=$dato->total_kilos_ingresados;
                                }

                                $total_kilos_a_cortar=$dato->total_kilos-$total_kilos_ingresados;
                                $total_kilos_orden=round(($dato->placa_kilo*$dato->tamano_a_imprimir_1*$dato->tamano_a_imprimir_2*$dato->gramaje)/10000000);
                                if ($total_kilos_a_cortar==0) {
                                    $total_kilos_a_cortar=round(($dato->placa_kilo*$dato->tamano_a_imprimir_1*$dato->tamano_a_imprimir_2*$dato->gramaje)/10000000);
                                }
                                $cuerpo .='<tr>
                                    <td align="center">'.$dato->ot.'</td>
                                    <td align="center">'.$dato->fecha.'</td>
                                    <td align="center">'.$dato->fecha_liberada.'</td>
                                    <td align="center">'.$dato->razon_social.'</td>
                                    <td align="center">'.$dato->producto.'</td>
                                    <td align="center">'.$dato->condicion_del_producto.'</td>
                                    <td align="center">'.$dato->ccac_1.' Mms</td>
                                    <td align="center">'.$dato->ccac_2.' Mms</td>
                                    <td align="center">'.$dato->tamano_cuchillo_1.' X '.$dato->tamano_cuchillo_2.' Cms</td>
                                    <td align="center">'.$dato->materialidad_datos_tecnicos.'</td>
                                    <td align="center">'.$dato->tamano_a_imprimir_1.' X '.$dato->tamano_a_imprimir_2.' Cms</td>
                                    <td align="center">'.$dato->gramaje.'</td>
                                    <td align="center">'.$merma.'</td>
                                    <td align="center">'.$cant_pliegos.'</td>
                                    <td align="center">'.$total_kilos_orden.'</td>
                                    <td align="center">'.$total_kilos_ingresados.'</td>
                                    <td align="center">'.$total_kilos_a_cortar.'</td>
                                    <td align="center">'.$estado_op.'</td>
                                </tr>';
                                
                                $contador = $contador+1;

                                if ($contador==$lineasPorHoja) {
                                    
                                    $cuerpo .= "</table>
                                
                                    <br><table style='page-break-after:always;'></table><br><br><br><br><br><br><br><br><br><br><br>
                                    <table border='1' width='100%'>

                                        <tr>
                                            <td align='center'><b>OT</b></td>
                                            <td align='center'><b>Fecha OT</b></td>
                                            <td align='center'><b>Fecha Liberacion FOMECA</b></td>
                                            <td align='center'><b>Cliente</b></td>
                                            <td align='center'><b>Trabajo</b></td>
                                            <td align='center'><b>Repeticion</b></td>
                                            <td align='center'><b>CCAC1 Ancho</b></td>
                                            <td align='center'><b>CCAC2 Largo</b></td>
                                            <td align='center'><b>Cuchillo a Cuchillo</b></td>
                                            <td align='center'><b>Micro corrugado</b></td>
                                            <td align='center'><b>Tamaño a cortar</b></td>
                                            <td align='center'><b>Gramaje</b></td>
                                            <td align='center'><b>Merma</b></td>
                                            <td align='center'><b>Cant. Pliegos</b></td>
                                            <td align='center'><b>Total Kilos de la Orden</b></td>
                                            <td align='center'><b>Total Kilos Liberados</b></td>
                                            <td align='center'><b>Total Kilos a Cortar</b></td>
                                            <td align='center'><b>Estado</b></td>
                                        </tr>";
                                        $contador=0;
                                        $lineasPorHoja=7;
                                        
                                } 
                            }
                            
            }
            $cuerpo .='</table></body>
                      </html>';

            $this->mpdf->SetDisplayMode('fullpage');
            $this->mpdf->AddPage('L');
            $css1 = file_get_contents('public/frontend/css/despacho.css');
            $css2 = file_get_contents('bootstrap/bootstrap.css');
            $this->mpdf->WriteHTML($css2,1);
            $this->mpdf->WriteHTML($css1,1);
            $this->mpdf->WriteHTML($cuerpo);
            $this->mpdf->Output();
            
            
            exit;
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
    } 

    public function listado_control_cartulina_mercaderia_comprada()
    {
        if($this->session->userdata('id'))
        {
            $datos=$this->orden_model->getListadoControlCartulina();
            $contador = 0;
            $lineasPorHoja=6;
            $cuerpo=' <!DOCTYPE html>
            <html>
                        <head>
                            <meta charset="utf-8" />
                            <link type="text/css" rel="stylesheet" href="'.base_url().'bootstrap/despacho.css" />
                        </head>
                        <body>
                        <h3><p class="text-center">LISTADO CONTROL CARTULINA</p></h3>
                        <h6><p class="text-center">MERCADERIA YA COMPRADA POR LLEGAR</p></h6>
                    <p class="text-right">Fecha: '.date('d-m-Y').'</p>

                         <table border="1" width="100%">
                            <tr>
                                <td align="center"><b>OT</b></td>
                                <td align="center"><b>Fecha OT</b></td>
                                <td align="center"><b>Fecha Liberacion FOMECA</b></td>
                                <td align="center"><b>Cliente</b></td>
                                <td align="center"><b>Trabajo</b></td>
                                <td align="center"><b>Repeticion</b></td>
                                <td align="center"><b>CCAC1 Ancho</b></td>
                                <td align="center"><b>CCAC2 Largo</b></td>
                                <td align="center"><b>Cuchillo a Cuchillo</b></td>
                                <td align="center"><b>Micro corrugado</b></td>
                                <td align="center"><b>Tamaño a cortar</b></td>
                                <td align="center"><b>Gramaje</b></td>
                                <td align="center"><b>Merma</b></td>
                                <td align="center"><b>Cant. Pliegos</b></td>
                                <td align="center"><b>Total Kilos de la Orden</b></td>
                                <td align="center"><b>Total Kilos en Stock</b></td>
                                <td align="center"><b>Total Kilos Comprados</b></td>
                                <td align="center"><b>Proveedor</b></td>
                                <td align="center"><b>Saldo para completar la orden</b></td>
                                <td align="center"><b>Fecha de recepcion estimada</b></td>
                                <td align="center"><b>Estado</b></td>
                            </tr>';
                            $contador_dato = 0;
            foreach ($datos as $dato) {
                            
                            if ($dato->existencia!= 'Hay stock total' && ($dato->FechaEstimada_CompraTotal!='0000-00-00' || $dato->FechaEstimada_ComprarSaldo_StockParcial!='0000-00-00' || ($dato->FechaEstimada_ComprarParcial!='0000-00-00' && $dato->Opciones_ComprarParcial != 'Comprar saldo total') || ($dato->FechaEstimada_ComprarSaldo_ComprarParcial!='0000-00-00' && $dato->Opciones_ComprarParcial=='Comprar saldo total')) && ($dato->FechaRecepcion_CompraTotal=='0000-00-00' && $dato->FechaRecepcion_ComprarSaldo_StockParcial=='0000-00-00' && ($dato->FechaRecepcion_ComprarParcial=='0000-00-00' && $dato->Opciones_ComprarParcial != 'Comprar saldo total') || ($dato->FechaRecepcion_ComprarSaldo_ComprarParcial=='0000-00-00' && $dato->Opciones_ComprarParcial == 'Comprar saldo total'))) {
                                $contador_dato = $contador_dato+1;
                                if ($dato->estado_pcc == 3) {
                                    $estado_op= "Liberado Parcial";
                                }
                                if ($dato->estado_pcc == 0) {
                                    $estado_op= "Pendiente";
                                }

                                if ($dato->situacion == 'Liberada' && $dato->situacion_pcc==null) {
                                    $estado_op= "Activa";
                                }

                                if ($dato->troquel_por_atras=="SI") {
                                    $troquel_por_atras= "Por atrás, margen izquierdo, retiro";
                                }elseif($dato->troquel_por_atras=="NO"){
                                    $troquel_por_atras='Por adelante, margen derecho, tiro';
                                }else{
                                    $troquel_por_atras='Por definir';
                                }

                                if($dato->cantidad_de_cajas==$dato->cantidad_1){
                                    $merma = $dato->total_merma;
                                }elseif($dato->cantidad_de_cajas==$dato->cantidad_2){
                                    $merma = $dato->total_merma2;
                                }elseif($dato->cantidad_de_cajas==$dato->cantidad_3){
                                    $merma = $dato->total_merma3;
                                }elseif($dato->cantidad_de_cajas==$dato->cantidad_4){
                                    $merma = $dato->total_merma3;
                                }

                              
                                $cant_pliegos=((($dato->cantidad_de_cajas)/($dato->unidades_por_pliego))+$merma);

                                if ($dato->total_kilos_restantes==null) {
                                    $total_kilos_restantes=$cant_pliegos;
                                }else{
                                    $total_kilos_restantes=$dato->total_kilos_restantes;
                                }

                                if ($dato->total_kilos_ingresados==null) {
                                    $total_kilos_ingresados=0;
                                }else{
                                    $total_kilos_ingresados=$dato->total_kilos_ingresados;
                                }


                                $total_kilos_a_cortar=$dato->total_kilos-$total_kilos_ingresados;
                                $total_kilos_orden=round(($dato->placa_kilo*$dato->tamano_a_imprimir_1*$dato->tamano_a_imprimir_2*$dato->gramaje)/10000000);
                                if ($total_kilos_a_cortar==0) {
                                    $total_kilos_a_cortar=round(($dato->placa_kilo*$dato->tamano_a_imprimir_1*$dato->tamano_a_imprimir_2*$dato->gramaje)/10000000);
                                }

                                
                                $estado_existencia=$dato->existencia;
                                if ($dato->Opciones_ComprarParcial=='Comprar saldo total') {
                                    $Opciones_ComprarParcial=$dato->Opciones_ComprarParcial;
                                }else{
                                    $Opciones_ComprarParcial='';
                                }
                                
                                $Opciones_StockParcial=$dato->Opciones_StockParcial;
                                
                                // Si existencia = Comprar Total
                                if ($dato->existencia=='Comprar Total') {
                                    $kilos_comprados = $dato->Kilos_CompraTotal;
                                    $FechaEstimada=$dato->FechaEstimada_CompraTotal;
                                    $proves=$this->proveedores_model->getProveedores();
                                    foreach($proves as $prove)
                                    {
                                        if($dato->Proveedor_CompraTotal==$prove->id){
                                            $proveedor = $prove->nombre;
                                        }
                                    }
                                }

                                // Si existencia = Stock parcial && opciones = Comprar saldo
                                if ($dato->existencia=='Stock Parcial' && $dato->Opciones_StockParcial=='Comprar Saldo') {
                                    $kilos_comprados = $dato->Kilos_ComprarSaldo_StockParcial;
                                    $FechaEstimada=$dato->FechaEstimada_ComprarSaldo_StockParcial;
                                    $proves=$this->proveedores_model->getProveedores();
                                    foreach($proves as $prove)
                                    {
                                        if($dato->Proveedor_ComprarSaldo_StockParcial==$prove->id){
                                            $proveedor = $prove->nombre;
                                        }
                                    }
                                }

                                // Si existencia = Comprar parcial
                                if ($dato->existencia=='Comprar Parcial') {
                                    $kilos_comprados = $dato->Kilos_ComprarParcial;
                                    $FechaEstimada=$dato->FechaEstimada_ComprarParcial;
                                    $proves=$this->proveedores_model->getProveedores();
                                    foreach($proves as $prove)
                                    {
                                        if($dato->Proveedor_ComprarParcial==$prove->id){
                                            $proveedor = $prove->nombre;
                                        }
                                    }
                                }

                                // Si existencia = Comprar parcial y opciones_comprarParcial = comprar saldo total
                                if ($Opciones_ComprarParcial=='Comprar saldo total') {
                                    $kilos_comprados = $dato->Kilos_ComprarSaldo_ComprarParcial;
                                    $FechaEstimada=$dato->FechaEstimada_ComprarSaldo_ComprarParcial;
                                    $proves=$this->proveedores_model->getProveedores();
                                    foreach($proves as $prove)
                                    {
                                        if($dato->Proveedor_ComprarSaldo_ComprarParcial==$prove->id){
                                            $proveedor = $prove->nombre;
                                        }
                                    }
                                }

                                //Sumar kilos liberados
                                $total_kilos_liberados = $dato->total_kilos_ingresados+$dato->total_kilos_ingresados_parcial_2+$dato->total_kilos_ingresados_parcial_3;
 
                                $saldo_completar_orden = $total_kilos_orden-$kilos_comprados;

                                $cuerpo .='<tr>
                                    <td align="center">'.$dato->ot.'</td>
                                    <td align="center">'.$dato->fecha.'</td>
                                    <td align="center">'.$dato->fecha_liberada.'</td>
                                    <td align="center">'.$dato->razon_social.'</td>
                                    <td align="center">'.$dato->producto.'</td>
                                    <td align="center">'.$dato->condicion_del_producto.'</td>
                                    <td align="center">'.$dato->ccac_1.' Mms</td>
                                    <td align="center">'.$dato->ccac_2.' Mms</td>
                                    <td align="center">'.$dato->tamano_cuchillo_1.' X '.$dato->tamano_cuchillo_2.' Cms</td>
                                    <td align="center">'.$dato->materialidad_datos_tecnicos.'</td>
                                    <td align="center">'.$dato->tamano_a_imprimir_1.' X '.$dato->tamano_a_imprimir_2.' Cms</td>
                                    <td align="center">'.$dato->gramaje.'</td>
                                    <td align="center">'.$merma.'</td>
                                    <td align="center">'.$cant_pliegos.'</td>
                                    <td align="center">'.$total_kilos_orden.'</td>
                                    <td align="center">'.$total_kilos_liberados.'</td>
                                    <td align="center">'.$kilos_comprados.'</td>
                                    <td align="center">'.$proveedor.'</td>
                                    <td align="center">'.$saldo_completar_orden.'</td>
                                    <td align="center">'.$FechaEstimada.'</td>
                                    <td align="center">'.$estado_existencia.'<br><br>'.$Opciones_StockParcial.$Opciones_ComprarParcial.'</td>
                                </tr>';
                                
                                $contador = $contador+1;

                                if ($contador==$lineasPorHoja) {
                                    
                                    $cuerpo .= "</table>
                                
                                    <br><table style='page-break-after:always;'></table><br><br><br><br><br><br><br><br><br><br><br>
                                    <table border='1' width='100%'>

                                        <tr>
                                            <td align='center'><b>OT</b></td>
                                            <td align='center'><b>Fecha OT</b></td>
                                            <td align='center'><b>Fecha Liberacion FOMECA</b></td>
                                            <td align='center'><b>Cliente</b></td>
                                            <td align='center'><b>Trabajo</b></td>
                                            <td align='center'><b>Repeticion</b></td>
                                            <td align='center'><b>CCAC1 Ancho</b></td>
                                            <td align='center'><b>CCAC2 Largo</b></td>
                                            <td align='center'><b>Cuchillo a Cuchillo</b></td>
                                            <td align='center'><b>Micro corrugado</b></td>
                                            <td align='center'><b>Tamaño a cortar</b></td>
                                            <td align='center'><b>Gramaje</b></td>
                                            <td align='center'><b>Merma</b></td>
                                            <td align='center'><b>Cant. Pliegos</b></td>
                                            <td align='center'><b>Total Kilos de la Orden</b></td>
                                            <td align='center'><b>Total Kilos en Stock</b></td>
                                            <td align='center'><b>Total Kilos Comprados</b></td>
                                            <td align='center'><b>Proveedor</b></td>
                                            <td align='center'><b>Saldo para completar la orden</b></td>
                                            <td align='center'><b>Fecha de recepcion estimada</b></td>
                                            <td align='center'><b>Estado</b></td>
                                        </tr>";
                                        $contador=0;
                                        $lineasPorHoja=7;
                                        
                                } 
                            }
                            
            }
            $cuerpo .='</table></body>
                      </html>';

            $this->mpdf->SetDisplayMode('fullpage');
            $this->mpdf->AddPage('L');
            $css1 = file_get_contents('public/frontend/css/despacho.css');
            $css2 = file_get_contents('bootstrap/bootstrap.css');
            $this->mpdf->WriteHTML($css2,1);
            $this->mpdf->WriteHTML($css1,1);
            $this->mpdf->WriteHTML($cuerpo);
            $this->mpdf->Output();
            
            
            exit;
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
    } 

    public function listado_corte_cartulina_por_cortar()
    {
        if($this->session->userdata('id'))
        {
            $datos=$this->orden_model->getListadoControlCartulina();
            $contador = 0;
            $lineasPorHoja=10;
            $cuerpo=' <!DOCTYPE html>
            <html>
                        <head>
                            <meta charset="utf-8" />
                            <link type="text/css" rel="stylesheet" href="'.base_url().'bootstrap/despacho.css" />
                        </head>
                        <body>
                        <h3><p class="text-center">LISTADO CORTE CARTULINA</p></h3>
                        <h6><p class="text-center">POR CORTAR (ACTIVO)</p></h6>
                    <p class="text-right">Fecha: '.date('d-m-Y').'</p>

                         <table border="1" width="100%">
                            <tr>
                                <td align="center"><b>OT</b></td>
                                <td align="center"><b>Fecha OT</b></td>
                                <td align="center"><b>Fecha Liberacion FOMECA</b></td>
                                <td align="center"><b>Cliente</b></td>
                                <td align="center"><b>Trabajo</b></td>
                                <td align="center"><b>Desgaje Autom.</b></td>
                                <td align="center"><b>Trazado Desgajado</b></td>
                                <td align="center"><b>Pegado Autom.</b></td>
                                <td align="center"><b>Molde Numero</b></td>
                                <td align="center"><b>Repeticion</b></td>
                                <td align="center"><b>Numero Trazado</b></td>
                                <td align="center"><b>Numero Asignado</b></td>
                                <td align="center"><b>Fecha confeccion maqueta</b></td>
                                <td align="center"><b>CCAC1 Ancho</b></td>
                                <td align="center"><b>CCAC2 Largo</b></td>
                                <td align="center"><b>Cuchillo a Cuchillo</b></td>
                                <td align="center"><b>Micro corrugado</b></td>
                                <td align="center"><b>Tipo de Troquelado</b></td>
                                <td align="center"><b>Fecha recepcion muestra</b></td>
                                <td align="center"><b>Cant. Golpes</b></td>
                                <td align="center"><b>Estado</b></td>
                            </tr>';
             
            foreach ($datos as $dato) {
                            
                            if ($dato->hay_que_troquelar=='SI' && $dato->condicion_del_producto!='Nuevo' && ($dato->fecha_liberada=='' || $dato->fecha_liberada=='0000-00-00')) {

                                if ($dato->estado == 1) {
                                    $estado_op= "Activa";
                                }
                            
                                $fecha_liberada='Sin liberar';

                                if ($dato->desgajado_automatico==NULL) {
                                    $desgajado_automatico='NO';
                                }else{
                                    $desgajado_automatico= $dato->desgajado_automatico;
                                }

                                if ($dato->desgajado_automatico==NULL || $dato->desgajado_automatico=='NO') {
                                    $trazado_desgajado='NO';
                                }elseif ($dato->desgajado_automatico=='SI'){
                                    $trazado_desgajado=$dato->conf_sal_pel_desgajado;
                                }

                                if ($dato->es_una_maquina==NULL) {
                                    $es_una_maquina='NO';
                                }else{
                                    $es_una_maquina= $dato->es_una_maquina;
                                }

                                if ($dato->troquel_por_atras=="SI") {
                                    $troquel_por_atras= "Por atrás, margen izquierdo, retiro";
                                }elseif($dato->troquel_por_atras=="NO"){
                                    $troquel_por_atras='Por adelante, margen derecho, tiro';
                                }else{
                                    $troquel_por_atras='Por definir';
                                }

                                if ($dato->conf_sal_pel_fecha=='' || $dato->conf_sal_pel_fecha=='0000-00-00' || $dato->conf_sal_pel_fecha==null) {
                                    $conf_sal_pel_fecha='SIN CONFECCION';
                                }else{
                                    $conf_sal_pel_fecha=$dato->conf_sal_pel_fecha;
                                }

                                if ($dato->recepcion_maqueta_fecha=='' || $dato->recepcion_maqueta_fecha=='0000-00-00' || $dato->recepcion_maqueta_fecha==null) {
                                    $recepcion_maqueta_fecha='SIN RECEPCION';
                                }else{
                                    $recepcion_maqueta_fecha=$dato->recepcion_maqueta_fecha;
                                }

                                $cuerpo .='<tr>
                                    <td align="center">'.$dato->ot.'</td>
                                    <td align="center">'.$dato->fecha.'</td>
                                    <td align="center">'.$fecha_liberada.'</td>
                                    <td align="center">'.$dato->razon_social.'</td>
                                    <td align="center">'.$dato->producto.'</td>
                                    <td align="center">'.$desgajado_automatico.'</td>
                                    <td align="center">'.$trazado_desgajado.'</td>
                                    <td align="center">'.$es_una_maquina.'</td>
                                    <td align="center">'.$dato->id_molde.'</td>
                                    <td align="center">'.$dato->condicion_del_producto.'</td>
                                    <td align="center">'.$dato->trazado.'</td>
                                    <td align="center">'.$dato->mg_id.'</td>
                                    <td align="center">'.$conf_sal_pel_fecha.'</td>
                                    <td align="center">'.$dato->ccac_1.' Mms</td>
                                    <td align="center">'.$dato->ccac_2.' Mms</td>
                                    <td align="center">'.$dato->tamano_cuchillo_1.' X '.$dato->tamano_cuchillo_2.' Cms</td>
                                    <td align="center">'.$dato->materialidad_datos_tecnicos.'</td>
                                    <td align="center">'.$troquel_por_atras.'</td>
                                    <td align="center">'.$recepcion_maqueta_fecha.'</td>
                                    <td align="center">'.($dato->cantidad_de_cajas)/($dato->unidades_por_pliego).'</td>
                                    <td align="center">'.$estado_op.'</td>
                                </tr>';
                                
                                $contador = $contador+1;

                                if ($contador==$lineasPorHoja) {
                                    
                                    $cuerpo .= "</table>
                                
                                    <br><table style='page-break-after:always;'></table><br>
                                    <table border='1' width='100%'>

                                        <tr>
                                            <td align='center'><b>OT</b></td>
                                            <td align='center'><b>Fecha OT</b></td>
                                            <td align='center'><b>Fecha Liberacion FOMECA</b></td>
                                            <td align='center'><b>Cliente</b></td>
                                            <td align='center'><b>Trabajo</b></td>
                                            <td align='center'><b>Desgaje Autom.</b></td>
                                            <td align='center'><b>Trazado Desgajado</b></td>
                                            <td align='center'><b>Pegado Autom.</b></td>
                                            <td align='center'><b>Molde Numero</b></td>
                                            <td align='center'><b>Repeticion</b></td>
                                            <td align='center'><b>Numero Trazado</b></td>
                                            <td align='center'><b>Numero Asignado</b></td>
                                            <td align='center'><b>Fecha confeccion</b></td>
                                            <td align='center'><b>CCAC1 Ancho</b></td>
                                            <td align='center'><b>CCAC2 Largo</b></td>
                                            <td align='center'><b>Cuchillo a Cuchillo</b></td>
                                            <td align='center'><b>Micro corrugado</b></td>
                                            <td align='center'><b>Tipo de Troquelado</b></td>
                                            <td align='center'><b>Fecha recepcion muestra</b></td>
                                            <td align='center'><b>Cant. Golpes</b></td>
                                            <td align='center'><b>Estado</b></td>
                                        </tr>";
                                        $contador=0;
                                        $lineasPorHoja=12;
                                        
                                } 
                            }
                            
            }
            $cuerpo .='</table></body>
                      </html>';

            $this->mpdf->SetDisplayMode('fullpage');
            $this->mpdf->AddPage('L');
            $css1 = file_get_contents('public/frontend/css/despacho.css');
            $css2 = file_get_contents('bootstrap/bootstrap.css');
            $this->mpdf->WriteHTML($css2,1);
            $this->mpdf->WriteHTML($css1,1);
            $this->mpdf->WriteHTML($cuerpo);
            $this->mpdf->Output();
            
            
            exit;
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
    } 

    public function listado_corte_cartulina_ya_cortado()
    {
        if($this->session->userdata('id'))
        {
            $datos=$this->orden_model->getListadoControlCartulina();
            $contador = 0;
            $lineasPorHoja=10;
            $cuerpo=' <!DOCTYPE html>
            <html>
                        <head>
                            <meta charset="utf-8" />
                            <link type="text/css" rel="stylesheet" href="'.base_url().'bootstrap/despacho.css" />
                        </head>
                        <body>
                        <h3><p class="text-center">LISTADO CORTE CARTULINA</p></h3>
                        <h6><p class="text-center">YA CORTADO (LIBERADAS)</p></h6>
                    <p class="text-right">Fecha: '.date('d-m-Y').'</p>

                         <table border="1" width="100%">
                            <tr>
                                <td align="center"><b>OT</b></td>
                                <td align="center"><b>Fecha OT</b></td>
                                <td align="center"><b>Fecha Liberacion FOMECA</b></td>
                                <td align="center"><b>Cliente</b></td>
                                <td align="center"><b>Trabajo</b></td>
                                <td align="center"><b>Desgaje Autom.</b></td>
                                <td align="center"><b>Trazado Desgajado</b></td>
                                <td align="center"><b>Pegado Autom.</b></td>
                                <td align="center"><b>Molde Numero</b></td>
                                <td align="center"><b>Repeticion</b></td>
                                <td align="center"><b>Numero Trazado</b></td>
                                <td align="center"><b>Numero Asignado</b></td>
                                <td align="center"><b>Fecha confeccion maqueta</b></td>
                                <td align="center"><b>CCAC1 Ancho</b></td>
                                <td align="center"><b>CCAC2 Largo</b></td>
                                <td align="center"><b>Cuchillo a Cuchillo</b></td>
                                <td align="center"><b>Micro corrugado</b></td>
                                <td align="center"><b>Tipo de Troquelado</b></td>
                                <td align="center"><b>Fecha recepcion muestra</b></td>
                                <td align="center"><b>Cant. Golpes</b></td>
                                <td align="center"><b>Estado</b></td>
                            </tr>';
             
            foreach ($datos as $dato) {
                            
                            if ($dato->hay_que_troquelar=='SI' && $dato->condicion_del_producto!='Nuevo' && ($dato->fecha_liberada=='' || $dato->fecha_liberada=='0000-00-00')) {

                                if ($dato->estado == 1) {
                                    $estado_op= "Activa";
                                }
                            
                                $fecha_liberada='Sin liberar';

                                if ($dato->desgajado_automatico==NULL) {
                                    $desgajado_automatico='NO';
                                }else{
                                    $desgajado_automatico= $dato->desgajado_automatico;
                                }

                                if ($dato->desgajado_automatico==NULL || $dato->desgajado_automatico=='NO') {
                                    $trazado_desgajado='NO';
                                }elseif ($dato->desgajado_automatico=='SI'){
                                    $trazado_desgajado=$dato->conf_sal_pel_desgajado;
                                }

                                if ($dato->es_una_maquina==NULL) {
                                    $es_una_maquina='NO';
                                }else{
                                    $es_una_maquina= $dato->es_una_maquina;
                                }

                                if ($dato->troquel_por_atras=="SI") {
                                    $troquel_por_atras= "Por atrás, margen izquierdo, retiro";
                                }elseif($dato->troquel_por_atras=="NO"){
                                    $troquel_por_atras='Por adelante, margen derecho, tiro';
                                }else{
                                    $troquel_por_atras='Por definir';
                                }

                                if ($dato->conf_sal_pel_fecha=='' || $dato->conf_sal_pel_fecha=='0000-00-00' || $dato->conf_sal_pel_fecha==null) {
                                    $conf_sal_pel_fecha='SIN CONFECCION';
                                }else{
                                    $conf_sal_pel_fecha=$dato->conf_sal_pel_fecha;
                                }

                                if ($dato->recepcion_maqueta_fecha=='' || $dato->recepcion_maqueta_fecha=='0000-00-00' || $dato->recepcion_maqueta_fecha==null) {
                                    $recepcion_maqueta_fecha='SIN RECEPCION';
                                }else{
                                    $recepcion_maqueta_fecha=$dato->recepcion_maqueta_fecha;
                                }

                                $cuerpo .='<tr>
                                    <td align="center">'.$dato->ot.'</td>
                                    <td align="center">'.$dato->fecha.'</td>
                                    <td align="center">'.$fecha_liberada.'</td>
                                    <td align="center">'.$dato->razon_social.'</td>
                                    <td align="center">'.$dato->producto.'</td>
                                    <td align="center">'.$desgajado_automatico.'</td>
                                    <td align="center">'.$trazado_desgajado.'</td>
                                    <td align="center">'.$es_una_maquina.'</td>
                                    <td align="center">'.$dato->id_molde.'</td>
                                    <td align="center">'.$dato->condicion_del_producto.'</td>
                                    <td align="center">'.$dato->trazado.'</td>
                                    <td align="center">'.$dato->mg_id.'</td>
                                    <td align="center">'.$conf_sal_pel_fecha.'</td>
                                    <td align="center">'.$dato->ccac_1.' Mms</td>
                                    <td align="center">'.$dato->ccac_2.' Mms</td>
                                    <td align="center">'.$dato->tamano_cuchillo_1.' X '.$dato->tamano_cuchillo_2.' Cms</td>
                                    <td align="center">'.$dato->materialidad_datos_tecnicos.'</td>
                                    <td align="center">'.$troquel_por_atras.'</td>
                                    <td align="center">'.$recepcion_maqueta_fecha.'</td>
                                    <td align="center">'.($dato->cantidad_de_cajas)/($dato->unidades_por_pliego).'</td>
                                    <td align="center">'.$estado_op.'</td>
                                </tr>';
                                
                                $contador = $contador+1;

                                if ($contador==$lineasPorHoja) {
                                    
                                    $cuerpo .= "</table>
                                
                                    <br><table style='page-break-after:always;'></table><br>
                                    <table border='1' width='100%'>

                                        <tr>
                                            <td align='center'><b>OT</b></td>
                                            <td align='center'><b>Fecha OT</b></td>
                                            <td align='center'><b>Fecha Liberacion FOMECA</b></td>
                                            <td align='center'><b>Cliente</b></td>
                                            <td align='center'><b>Trabajo</b></td>
                                            <td align='center'><b>Desgaje Autom.</b></td>
                                            <td align='center'><b>Trazado Desgajado</b></td>
                                            <td align='center'><b>Pegado Autom.</b></td>
                                            <td align='center'><b>Molde Numero</b></td>
                                            <td align='center'><b>Repeticion</b></td>
                                            <td align='center'><b>Numero Trazado</b></td>
                                            <td align='center'><b>Numero Asignado</b></td>
                                            <td align='center'><b>Fecha confeccion</b></td>
                                            <td align='center'><b>CCAC1 Ancho</b></td>
                                            <td align='center'><b>CCAC2 Largo</b></td>
                                            <td align='center'><b>Cuchillo a Cuchillo</b></td>
                                            <td align='center'><b>Micro corrugado</b></td>
                                            <td align='center'><b>Tipo de Troquelado</b></td>
                                            <td align='center'><b>Fecha recepcion muestra</b></td>
                                            <td align='center'><b>Cant. Golpes</b></td>
                                            <td align='center'><b>Estado</b></td>
                                        </tr>";
                                        $contador=0;
                                        $lineasPorHoja=12;
                                        
                                } 
                            }
                            
            }
            $cuerpo .='</table></body>
                      </html>';

            $this->mpdf->SetDisplayMode('fullpage');
            $this->mpdf->AddPage('L');
            $css1 = file_get_contents('public/frontend/css/despacho.css');
            $css2 = file_get_contents('bootstrap/bootstrap.css');
            $this->mpdf->WriteHTML($css2,1);
            $this->mpdf->WriteHTML($css1,1);
            $this->mpdf->WriteHTML($cuerpo);
            $this->mpdf->Output();
            
            
            exit;
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
    } 

    public function listado_programa_troquelado()
    {
        if($this->session->userdata('id'))
        {
            $datos=$this->orden_model->getListadoProgramaFotomecanica();

            $cuerpo=' <!DOCTYPE html>
            <html>
                        <head>
                            <meta charset="utf-8" />
                            <link type="text/css" rel="stylesheet" href="'.base_url().'bootstrap/despacho.css" />
                        </head>
                        <body>
                        <h3><p class="text-center">PROGRAMA DE TROQUELADO</p></h3>
                    <p class="text-right">Fecha: '.date('d-m-Y').'</p>

                         <table border="1" width="100%">
                            <tr>
                                <td>OT</td>
                                <td>Fecha OT</td>
                                <td>Cliente</td>
                                <td>Trabajo</td>
                                <td>Condicion</td>
                                <td>Terminacion</td>                                
                                <td>Reserva</td>                                
                                <td>Trab.Externos</td>
                                <td>Molde o Trazado</td>
                                <td>Colores</td>
                                <td>Ancho</td>
                                <td>Largo</td>                                
                                <td>Tipo</td>
                                <td>Cantidad</td>
                                <td>Estado</td>
                            </tr>';
             
            foreach ($datos as $dato) {
                            //$valores = $this->orden_model->getOndaCotizacion($dato->id_cotizacion);

/////
                            $fotomecanica=$this->cotizaciones_model->getCotizacionFotomecanicaPorIdCotizacion($dato->id_cotizacion);
                            $ing=$this->cotizaciones_model->getCotizacionIngenieriaPorIdCotizacion($id);

                                if ($ing->archivo==""){
                                    $trazado='NO';    
                                }else{
                                    $trazado='SI';
                                }

                                if(($fotomecanica->acabado_impresion_4=="17") || ($fotomecanica->acabado_impresion_4==""))
                                {
                                    $hayAcabados = 'NO';
                                    $lugarAcabado = 'No Aplica';
                                }else{
                                    $hayAcabados = 'SI';
                                    $lugarAcabado = 'Externo';
                                }
                                //if(($fotomecanica->acabado_impresion_5=="17") && ($hayAcabados != 'SI') && ($fotomecanica->acabado_impresion_5==""))
                                if(($fotomecanica->acabado_impresion_5=="17") || ($fotomecanica->acabado_impresion_5==""))
                                {
                                    $hayAcabados = 'NO';
                                    $lugarAcabado = 'No Aplica';
                                }else{
                                    $hayAcabados = 'SI';
                                    $lugarAcabado = 'Externo';
                                }
                                //if(($fotomecanica->acabado_impresion_6=="17") && ($hayAcabados != 'SI') && ($fotomecanica->acabado_impresion_6==""))
                                if(($fotomecanica->acabado_impresion_6=="17") || ($fotomecanica->acabado_impresion_6==""))
                                {
                                    $hayAcabados = 'NO';
                                    $lugarAcabado = 'No Aplica';
                                }else{
                                    $hayAcabados = 'SI';
                                    $lugarAcabado = 'Externo';
                                }      

                                $estado=$this->produccion_model->getFotomecanicaPorTipo(1,$dato->id_cotizacion);
/////
                   /////////////// CALCULAR EL ESTADO ///////////////
                   $estados_pendiente = '';
     //              echo "<pre>";
       //            print_r($dato);
         //          exit($dato->recepcion_ot);
                   if ( $dato->recepcion_ot== ''){                    
                        $estados_pendiente = 'Recepcion OT';
                       
                   }elseif ( $dato->recepcion_ot!= 'Aprobada'){                    
                        $estados_pendiente = 'Revisión Trazado';

                   }elseif ( $dato->revision_trazado != 'Aprobada'){ 
                        $estados_pendiente = 'Recepcion de Maqueta';

                   }elseif ( $dato->recepcion_maqueta != 'Recepcion Aprobada'){ 
                        $estados_pendiente = 'Revisión de Imagen';                    

                   }elseif ( $dato->revision_imagen != 'Aprobado'){ 
                        $estados_pendiente = 'Montaje Digital';                    

                   }elseif ( $dato->montaje_digital != 'Aprobado'){ 
                        $estados_pendiente = 'Prueba de Color';                    

                   }elseif ( $dato->prueba_color != 'Aprobado'){ 
                        $estados_pendiente = 'Arte y Diseño';                    

                   }elseif ( $dato->arte_diseno != 'Aprobada'){ 
                        $estados_pendiente = 'Confeccion Salida de Pelicula';                    

                   }elseif ( $dato->conf_sal_pel != 'Entregado'){ 
                        $estados_pendiente = 'Sobre de Desarrollo';

                   }elseif ( $dato->sobre_desarrollo != 'Entregado'){ 

                   }                    
                   //////////////////////////////////////////////////                                

                            $onda    = $valores->nombre.' - ('.$valores->gramaje.' '.$valores->reverso.")";

                            //Cantidad de Despacho
                            $despacho = $this->despachos_model->getDespachosUltimoRegistro($dato->id_cotizacion);

                            $cuerpo .='<tr>
                                <td>'.$dato->ot.'</td>
                                <td>'.fecha_con_slash($dato->fecha).'</td>                                
                                <td>'.$dato->razon_social.'</td>
                                <td>'.$dato->producto.'</td>
                                <td>'.$dato->condicion.'</td>
                                <td>'.$fotomecanica->fot_lleva_barniz.'</td>
                                <td>'.$fotomecanica->fot_reserva_barniz.'</td>
                                <td>'.$hayAcabados.'</td>
                                <td>'.$trazado.'</td>
                                <td>'.$dato->colores.'</td>
                                <td>'.$dato->ancho.'</td>
                                <td>'.$dato->largo.'</td>
                                <td>'.$dato->tipo.'</td>
                                <td align="right">'.$dato->cantidad.'</td>
                                <td>'.$estados_pendiente.'</td>                                
                            </tr>';
            }
            $cuerpo .='</table></body>
                      </html>';

        
            $this->mpdf->SetDisplayMode('fullpage');
            $this->mpdf->AddPage('L');
            $css1 = file_get_contents('public/frontend/css/despacho.css');
            $css2 = file_get_contents('bootstrap/bootstrap.css');
            $this->mpdf->WriteHTML($css2,1);
            $this->mpdf->WriteHTML($css1,1);
            $this->mpdf->WriteHTML($cuerpo);
            $this->mpdf->Output();
            exit;
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
    }    

}


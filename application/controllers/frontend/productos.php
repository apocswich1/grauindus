<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Productos extends CI_Controller {


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
            $porpagina=50;
        $datos=$this->productos_model->getProductosPaginacion($pagina,$porpagina,"limit");
        $cuantos=$this->productos_model->getProductosPaginacion($pagina,$porpagina,"cuantos");
        $config['base_url'] = base_url().'productos/index';
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
            $this->layout->view('index',compact('datos','cuantos','pagina')); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
        
	}
    public function por_cliente($id=null)
	{
        if($this->session->userdata('id'))
        {
          
            if($this->uri->segment(4))
            {
                $pagina=$this->uri->segment(4);
            }else
            {
               $pagina=0;
            }
            $porpagina=10;
        $datos=$this->productos_model->getProductosPorClientePaginacion($pagina,$porpagina,"limit",$id);
        $cuantos=$this->productos_model->getProductosPorClientePaginacion($pagina,$porpagina,"cuantos",$id);
        $config['base_url'] = base_url().'productos/por_cliente/'.$id;
            $config['total_rows'] = $cuantos;
            $config['per_page'] = $porpagina;
            $config['uri_segment'] = '4';
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
            $cliente=$this->clientes_model->getClientePorId($id);
            $this->layout->view('por_cliente',compact('datos','cuantos','pagina','cliente','id')); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
        
	}
    public function por_tipo($id=null)
	{
        if($this->session->userdata('id'))
        {
          
            if($this->uri->segment(4))
            {
                $pagina=$this->uri->segment(4);
            }else
            {
               $pagina=0;
            }
            $porpagina=50;
        $datos=$this->productos_model->getProductosPorTipoPaginacion($pagina,$porpagina,"limit",$id);
        $cuantos=$this->productos_model->getProductosPorTipoPaginacion($pagina,$porpagina,"cuantos",$id);
        $config['base_url'] = base_url().'productos/por_tipo/'.$id;
            $config['total_rows'] = $cuantos;
            $config['per_page'] = $porpagina;
            $config['uri_segment'] = '4';
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
            $cliente=$this->clientes_model->getClientePorId($id);
            $this->layout->view('por_tipo',compact('datos','cuantos','pagina','cliente','id')); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
        
	}
    public function search()
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
                $porpagina=50;
                if ( $this->input->post() )
                 {
                    $this->session->set_userdata('valor', $this->input->post('buscar',true));
                    $buscar= $this->session->userdata('valor');
                 }else
                 {
                    $buscar= $this->session->userdata('valor');
                 }                
            $datos=$this->productos_model->getProductosSearchPaginacion($pagina,$porpagina,"limit",$buscar);
            $cuantos=$this->productos_model->getProductosSearchPaginacion($pagina,$porpagina,"cuantos",$buscar);
            $config['base_url'] = base_url().'productos/search';
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
                $this->layout->view('search',compact('datos','cuantos','pagina')); 
            }else
            {
                redirect(base_url().'usuarios/login',  301);
            }        
        }
        public function ajax()
	{
        if($this->session->userdata('id'))
        {

            $this->layout->setLayout('template_ajax');
            $datos=$this->productos_model->getProductosPorCliente2($this->input->post("valor1",true));
            //print_r($datos);
            $cot=$this->cotizaciones_model->getCotizacionesPorCliente3($this->input->post("valor1",true));
            $this->layout->view('ajax',compact('datos','cot')); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
        
	}
        
        public function ajax_extra_productos()
	{
        if($this->session->userdata('id'))
        {
            $idproducto = $this->input->post("valor",true);
            $idcliente = substr($idproducto, 0,4);
            $extras=$this->productos_model->getProductosDatosExtras($idproducto);
            $cot=$this->cotizaciones_model->getCotizacionesPorClienteLast($idcliente);
            $cli=$this->clientes_model->getClientePorId($idcliente);
            $this->layout->setLayout('template_ajax');
            $this->layout->view('ajax_extras',compact('extras','idproducto','cot','cli','idcliente')); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
        
	}
        
        public function ajax_extra_productos3()
	{
        if($this->session->userdata('id'))
        {
            $idproducto = $this->input->post("valor",true);
            if(strlen($idproducto)>4){
            $idcliente = substr($idproducto, 0,4);
            $extras=$this->productos_model->getProductosDatosExtras($idproducto);
            $cot=$this->cotizaciones_model->getCotizacionesPorClienteLast($idcliente);
            $cli=$this->clientes_model->getClientePorId($idcliente);
            $viejos=$this->cotizaciones_model->getCotizacionesPorClienteViejas($idcliente);
            $viejos_sin_productos=$this->cotizaciones_model->getCotizacionesPorClienteViejasSinPoductos($idcliente);
            $nuevosot=$this->cotizaciones_model->getCotizacionesPorClienteNuevasOT($idcliente);
            $solocotizadas=$this->cotizaciones_model->getCotizacionesPorClienteCotizadas($idcliente);
            }else{
            $idcliente = $idproducto;    
            //$extras=$this->productos_model->getProductosDatosExtras($idproducto);
            $cot=$this->cotizaciones_model->getCotizacionesPorClienteLast($idcliente);
            $cli=$this->clientes_model->getClientePorId($idcliente);
            $viejos=$this->cotizaciones_model->getCotizacionesPorClienteViejas($idcliente);
            $viejos_sin_productos=$this->cotizaciones_model->getCotizacionesPorClienteViejasSinPoductos($idcliente);
            $nuevosot=$this->cotizaciones_model->getCotizacionesPorClienteNuevasOT($idcliente);
            $solocotizadas=$this->cotizaciones_model->getCotizacionesPorClienteCotizadas($idcliente);
            }
            
            $this->layout->setLayout('template_ajax');
            $this->layout->view('ajax_extras3',compact('extras','idproducto','cot','cli','idcliente','viejos','nuevosot','solocotizadas','viejos_sin_productos')); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
        
	}
        
        public function ajax_extra_productos2()
	{
        if($this->session->userdata('id'))
        {
            $idproducto = $this->input->post("valor",true);
            //$idcliente = substr($idproducto, 0,4);
            $extras=$this->productos_model->getProductosDatosExtras2($idproducto);
            
            foreach ($extras as $key => $value) {
                        $extrasa=$value->id_cliente;
            }
            $cot=$this->cotizaciones_model->getCotizacionesPorClienteLast2($extrasa);
            $cli=$this->clientes_model->getClientePorId($extras->id_cliente);
            $this->layout->setLayout('template_ajax');
            $this->layout->view('ajax_extras2',compact('extras','idproducto','cot','cli','idcliente')); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
        
	}
        
     public function change($id=null,$pagina=null)
	{
        if($this->session->userdata('id'))
        {
            if($this->input->post())
            {
               $data=array
                (
                    "tipo"=>$this->input->post("tipo",true),
                    "quien"=>$this->session->userdata('id'),
                    "cuando"=>date("Y-m-d"),
                    "glosa"=>$this->input->post("glosa",true),
                );
                $this->db->where('id', $this->input->post('id',true));
                $this->db->update("productos",$data);
                $this->session->set_flashdata('ControllerMessage', 'Se ha modificado el registro exitosamente.');
                redirect($this->input->post("url",true),  301);
            }
            $this->layout->setLayout('template_ajax');
            $datos=$this->productos_model->getProductosPorId($id);
            $tipos=$this->productos_model->getTiposProducto();
            $this->layout->view('change',compact('datos','tipos','pagina','id')); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
        
	}
        public function validarNombreProductoExistente()
				{
					if($this->session->userdata('id'))
					{
						$this->layout->setLayout('template_ajax');
						$nombreProducto=$this->productos_model->getProductosPorNombre($this->input->post("valor1",true));
						//print_r($nombreProducto);exit;
						$this->layout->view('ajaxValidar',compact('nombreProducto','valor2')); 
					}else
					{
						redirect(base_url().'usuarios/login',  301);
					}
					
				}
   
     public function ajaxProductosGenericos()
	{
        if($this->session->userdata('id'))
        {
            $this->layout->setLayout('template_ajax');
            $datos=$this->productos_model->getProductosPorGenericos($this->input->post("valor1",true));
			//$cotizacion=$this->cotizaciones_model->getCotizacionesPorClienteRepeticionSinCambio($this->input->post("valor1",true));
            //print_r($datos);exit;
            $this->layout->view('ajaxProductosGenericos',compact('datos')); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
        
	}

     public function ajaxlink()
	{
        if($this->session->userdata('id'))
        {

            $this->layout->setLayout('template_ajax');
            //$datos=$this->productos_model->getProductosPorCliente2($this->input->post("valor1",true));
			$datos=$this->input->post("valor1",true);
			//$cot=$this->cotizaciones_model->getCotizacionesPorCliente3($this->input->post("valor1",true));
           // print_r($datos);exit;
            $this->layout->view('ajaxlink',compact('datos','cot')); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
        
	}

        public function edit($id=null)
        {
           if($this->session->userdata('id'))
            {
             if(!$id){ show_404();exit();}
             $datos=$this->productos_model->getProductosPorId($id);
//             print_r($datos);
             if(sizeof($datos)==0){show_404();}
                 if ( $this->input->post() )
 		         {
 		            if ( $this->form_validation->run('productos') )
    			    {
    			        if (sizeof($datos)>0)
                                {
                                        $data=array
                                        (
                                            "tipo"=>$this->input->post("tipo",true),
                                        );       
                                        if ($this->input->post("asignar",true)=="SI")     
                                        {
                                            $data=array
                                            (
                                                "id_cotizacion"=>$datos->id_cotizacion,
                                                "codigo"=> str_replace("A","G",$datos->codigo),
                                                "nombre"=>$datos->nombre,
                                                "tipo"=>2,
                                                "cuando"=>date('Y-m-d'),
                                            );      
                                           $guardar=$this->productos_model->insertar($data);
                                        }
                                        else
                                        {
                                            $data=array
                                            (
                                                "id_cotizacion"=>$this->input->post("id_cotizacion",true),
                                                "codigo"=>$this->input->post("codigo",true),
                                                "nombre"=>$this->input->post("nombre",true),
                                            );   
                                           $guardar=$this->productos_model->update($data,$id);
                                        }

                                        if($guardar)
                                        {
                                            $this->session->set_flashdata('ControllerMessage', 'Se ha editado el registro exitosamente.');
                                                               redirect(base_url().'productos',  301); 
                                        }else
                                        {
                                           $this->session->set_flashdata('ControllerMessage', 'Se produjo un error interno. Por favor inténtelo nuevamente.');
                                                               redirect(base_url().'productos/edit/'.$id,  301);
                                        }
                                
                                
                                }
                         }
                 }   
                  $this->layout->js
                    (
                        array
                            (
                                base_url().'public/backend/js/tiny_mce/tiny_mce.js'
                            )
                    );
                 $cliente=$this->productos_model->getFilaProductosPorCliente($datos->id);
                 $emision_orden=$this->cotizaciones_model->getOrdenDeCompraPorCotizacion($datos->id_cotizacion);
                 $productos_tipo=$this->productos_model->getTiposProducto($id);
                 $this->layout->view('edit',compact("datos","productos_tipo","cliente","emision_orden"));
            }else
            {
                redirect(base_url().'usuarios/login',  301);
            }    
        }

        public function reporte1($id=null)
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
            $porpagina=4000;
        
        
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
            
            $idproducto = $id;
            $idcliente = substr($idproducto, 0,4);
            $extras=$this->productos_model->getProductosDatosExtras($idproducto);
            $cot=$this->cotizaciones_model->getCotizacionesPorClienteLast($idcliente);
            $cli=$this->clientes_model->getClientePorId($idcliente);
        
            $cuerpo.="<table border='' style='width:900px'><tr>"
                    . "<td align='right'><b>FECHA: </b>"
                    . date('d-m-Y')
                    . "<b> Hora: </b>".date('H:m')
                    . "</tr></table><br/>";
            
            $cuerpo.="<table border='1' style='width:900px'>"
                    . "<tr><td align='center' colspan='2'><b>LISTADO GENERAL DE PRODUCTOS POR CLIENTE</b>"
                    . "&nbsp;&nbsp;</td>"
                    . "</tr>";    
            $cuerpo.="<tr>"
                    . "<td align='center' style='width:70px'><b>CLIENTE: </b></td>"
                    . "<td align='left'><b>".$cli->razon_social."</b></td>"
                    . "</tr></table><br/>";    
            
            $cuerpo.="<table border='1' style='width:900px'>"
                    . "<tr><td align='center' colspan='7'><b>DATOS EXTRAS DEL PRODUCTO</b>"
                    . "&nbsp;&nbsp;</td>"
                    . "</tr>"    
                    . "<tr class='titulo'>"
                    . "<td align='center'><b>OT</b></td>"
                    . "<td align='center'><b>OT Migrada</b></td>"
                    . "<td align='center'><b>Cantidad</b></td>"
                    . "<td><b>Precio</td>"
                    . "<td align='center'><b>Producto</b></td>"
                    . "<td align='center'><b>Descripcion</b></td>"
                    . "<td align='center'><b>Fecha</b></td>"
                    . "</tr>";
            
            //print_r($extras);exit();
            foreach ($extras as $value) {
                
                $cuerpo.="<tr><td align='center'>$value->id</td>"
                    . "<td align='center'>$value->ot_migrada</td>"
                    . "<td align='center'>$value->cantidad_1</td>"
                    . "<td align='center'>$value->precio</td>"
                    . "<td align='center'>$value->codigo</td>"
                    . "<td>$value->nombre_producto</td>"
                    . "<td align='center'>$value->fecha</td></tr>";
            }
            
            $cuerpo.="</table><br />";
           
            $cuerpo.="<table border='1' style='width:900px'>"
                    . "<tr><td align='center' colspan='9'><b>COTIZACIONES ANTERIORES</b>"
                    . "&nbsp;&nbsp;</td>"
                    . "</tr>"    
                    . "<tr class='titulo'>"
                    . "<td align='center'><b>Id</b></td>"
                    . "<td align='center'><b>OT</b></td>"
                    . "<td align='center'><b>OT Migrada</b></td>"
                    . "<td align='center'><b>Fecha</b></td>"
                    . "<td align='center'><b>Fecha Cot</b></td>"
                    . "<td align='center'><b>Producto</b></td>"
                    . "<td align='center'><b>Cantidad</b></td>"
                    . "<td><b>Precio Migrado</td>"
                    . "<td><b>Precio Nuevo</td>"
                    . "</tr>";
            
            
            
           
            foreach ($cot as $value) {
                $vendedores=$this->vendedores_model->getVendedorPorId($value->id_vendedor);
                $nombrevendedor=$vendedores->nombre;
                $cli=$this->clientes_model->getClientePorId($value->id_cliente);
                $cliente=$cli->razon_social; 
                $not=$this->orden_model->getNumeroOt($value->id); 
                $ult=$this->despachos_model->getDespachosUltimoRegistro($value->id); 
                 if($value->ot_migrada!="" || !is_null($value->ot_migrada)){$precio=$value->precio_migrado;}else{$precio=$value->valor_empresa;} 
                 if($value->fecha_ult!="" || !is_null($value->fecha_ult)){$fecha=$value->fecha_ult;}else{$fecha=$value->fecha;} 
                $cuerpo.="<tr><td align='center'>$value->id</td>"
                    . "<td align='center'>$value->numero_ot</td>"
                    . "<td align='center'>$value->ot_migrada</td>"
                    . "<td align='center'>$value->fecha</td>"
                    . "<td align='center'>$value->fecha_ult</td>"
                    . "<td align='center'>$value->producto</td>"
                    . "<td>$value->cantidad_1</td>"
                    . "<td>$value->precio_migrado</td>"
                    . "<td>$value->precio_final</td></tr>";
            }
            $cuerpo.="</table>";
            

            
            $this->mpdf->SetDisplayMode('fullpage');
            $css1 = file_get_contents('public/frontend/css/listado.css');
            $css2 = file_get_contents('bootstrap/bootstrap.css');
            $this->mpdf->WriteHTML($css2,1);
            $this->mpdf->WriteHTML($css1,1);
    		$this->mpdf->WriteHTML($cuerpo);
    		$this->mpdf->Output();
                redirect(base_url().'productos');
    		exit;

        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
        
	}        
        
        public function reporte2($id=null)
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
            $porpagina=4000;
        
        
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
        
            $idproducto = $id;
            //$idcliente = substr($idproducto, 0,4);
            $extras=$this->productos_model->getProductosDatosExtras2($idproducto);
            
            foreach ($extras as $key => $value) {
                        $extrasa=$value->id_cliente;
            }
            $cot=$this->cotizaciones_model->getCotizacionesPorClienteLast2($extrasa);
            $cli=$this->clientes_model->getClientePorId($extrasa);
            
            $cuerpo.="<table border='' style='width:900px'><tr>"
                    . "<td align='right'><b>FECHA: </b>"
                    . date('d-m-Y')
                    . "<b> Hora: </b>".date('H:m')
                    . "</tr></table><br/>";
            
            $cuerpo.="<table border='1' style='width:900px'>"
                    . "<tr><td align='center' colspan='2'><b>LISTADO GENERAL DE PRODUCTOS POR CLIENTE</b>"
                    . "&nbsp;&nbsp;</td>"
                    . "</tr>";    
            $cuerpo.="<tr>"
                    . "<td align='center' style='width:70px'><b>CLIENTE: </b></td>"
                    . "<td align='left'><b>".$cli->razon_social."</b></td>"
                    . "</tr></table><br/>";    
            
            
            
            $cuerpo.="<table border='1' style='width:900px'>"
                    . "<tr><td align='center' colspan='6'><b>DATOS EXTRAS DEL PRODUCTO</b>"
                    . "&nbsp;&nbsp;</td>"
                    . "</tr>"    
                    . "<tr class='titulo'>"
                    . "<td align='center'><b>Id</b></td>"
                    . "<td align='center'><b>Ot Migrada</b></td>"
                    . "<td align='center'><b>Cantidad</b></td>"
                    . "<td><b>Precio</td>"
                    . "<td align='center'><b>Producto</b></td>"
                    . "<td align='center'><b>Fecha</b></td>"
                    . "</tr>";
            
            
            foreach ($extras as $value) {
                
                $cuerpo.="<tr><td align='center'>$value->id</td>"
                    . "<td align='center'>$value->ot_migrada</td>"
                    . "<td align='center'>$value->cantidad_1</td>"
                    . "<td align='center'>$value->precio</td>"
                    . "<td align='center'>$value->producto</td>"
                    . "<td align='center'>$value->fecha</td></tr>";
            }
            
            $cuerpo.="</table><br />";
           
            $cuerpo.="<table border='1' style='width:900px'>"
                    . "<tr><td align='center' colspan='8'><b>COTIZACIONES ANTERIORES</b>"
                    . "&nbsp;&nbsp;</td>"
                    . "</tr>"    
                    . "<tr class='titulo'>"
                    . "<td align='center'><b>Id</b></td>"
                    . "<td align='center'><b>Ot</b></td>"
                    . "<td align='center'><b>Producto</b></td>"
                    . "<td align='center'><b>Cantidad</b></td>"
                    . "<td align='center'><b>Precio</td>"
                    . "<td align='center'><b>OT Antigua</b></td>"
                    . "<td align='center'><b>OT Migrada</b></td>"
                    . "<td align='center'><b>Fecha</b></td>"
                    . "</tr>";
            
            
            
           
            foreach ($cot as $value) {
                $cuerpo.="<tr><td align='center'>$value->id</td>"
                    . "<td align='center'>$value->ot</td>"
                    . "<td align='center'>$value->producto</td>"
                    . "<td align='center'>$value->cantidad_1</td>"
                    . "<td align='center'>$value->precio2</td>"
                    . "<td>$value->ot_antigua</td>"
                    . "<td>$value->ot_migrada</td>"
                    . "<td>$value->fecha</td></tr>";
            }
            $cuerpo.="</table>";
          
            $this->mpdf->SetDisplayMode('fullpage');
            $css1 = file_get_contents('public/frontend/css/listado.css');
            $css2 = file_get_contents('bootstrap/bootstrap.css');
            $this->mpdf->WriteHTML($css2,1);
            $this->mpdf->WriteHTML($css1,1);
    		$this->mpdf->WriteHTML($cuerpo);
    		$this->mpdf->Output();
            
            redirect(base_url().'productos');
    		exit;

        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
        
	}        
        public function reporte3($id=null)
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
            $porpagina=4000;
        
        
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
        
            $idproducto = $id;
            $idcliente = substr($idproducto, 0,4);
            $extras=$this->productos_model->getProductosDatosExtras2($idproducto);
            
            foreach ($extras as $key => $value) {
                        $extrasa=$value->id_cliente;
            }
            $cot=$this->cotizaciones_model->getCotizacionesPorClienteLast2($extrasa);
            $cli=$this->clientes_model->getClientePorId($idcliente);
            $viejos=$this->cotizaciones_model->getCotizacionesPorClienteViejas($idcliente);
            $viejos_sin_productos=$this->cotizaciones_model->getCotizacionesPorClienteViejasSinPoductos($idcliente);

            $cuerpo.="<table border='' style='width:900px'><tr>"
                    . "<td align='right'><b>FECHA: </b>"
                    . date('d-m-Y')
                    . "<b> Hora: </b>".date('H:m')
                    . "</tr></table><br/>";
            
            $cuerpo.="<table border='1' style='width:900px'>"
                    . "<tr><td align='center' colspan='2'><b>LISTADO GENERAL DE PRODUCTOS POR CLIENTE</b>"
                    . "&nbsp;&nbsp;</td>"
                    . "</tr>";    
            $cuerpo.="<tr>"
                    . "<td align='center' style='width:70px'><b>CLIENTE: </b></td>"
                    . "<td align='left'><b>".$cli->razon_social."</b></td>"
                    . "</tr></table><br/>";    
          
            
            $cuerpo.="</table><br />";
           
            $cuerpo.="<table border='1' style='width:900px'>"
                    . "<tr><td align='center' colspan='7'><b>COTIZACIONES DEL SISTEMA VIEJO CON PRODUCTO REGISTRADO</b>"
                    . "&nbsp;&nbsp;</td>"
                    . "</tr>"    
                    . "<tr class='titulo'>"
                    . "<td align='center'><b>Id</b></td>"
                    . "<td align='center'><b>Codigo</b></td>"
                    . "<td align='center'><b>Ot</b></td>"
                    . "<td align='center'><b>Fecha</b></td>"
                    . "<td align='center'><b>Trabajo</b></td>"
                    . "<td align='center'><b>Cantidad</td>"
                    . "<td align='center'><b>Valor</b></td>"
                    . "</tr>";
            
            
            
           
            foreach ($viejos as $value) {
                $cuerpo.="<tr><td align='center'>$value->id</td>"
                    . "<td align='center'>$value->codigo</td>"
                    . "<td align='center'>$value->ot_migrada</td>"
                    . "<td align='center'>".invertirFecha2($value->fecha)."</td>"
                    . "<td align='center'>$value->producto</td>"
                    . "<td>$value->cantidad_1</td>"
                    . "<td>$value->precio_migrado</td></tr>";
            }
            $cuerpo.="</table>";
            $cuerpo.="<br /><br /><br />";
            
            
            $cuerpo.="<table border='1' style='width:900px'>"
                    . "<tr><td align='center' colspan='7'><b>COTIZACIONES DEL SISTEMA VIEJO SIN PRODUCTO REGISTRADO</b>"
                    . "&nbsp;&nbsp;</td>"
                    . "</tr>"    
                    . "<tr class='titulo'>"
                    . "<td align='center'><b>Id</b></td>"
                    . "<td align='center'><b>Codigo</b></td>"
                    . "<td align='center'><b>Ot</b></td>"
                    . "<td align='center'><b>Fecha</b></td>"
                    . "<td align='center'><b>Trabajo</b></td>"
                    . "<td align='center'><b>Cantidad</td>"
                    . "<td align='center'><b>Valor</b></td>"
                    . "</tr>";
            
            
            
           
            foreach ($viejos_sin_productos as $value) {
                $cuerpo.="<tr><td align='center'>$value->id</td>"
                    . "<td align='center'>$value->codigo</td>"
                    . "<td align='center'>$value->ot_migrada</td>"
                    . "<td align='center'>".invertirFecha2($value->fecha)."</td>"
                    . "<td align='center'>$value->producto</td>"
                    . "<td>$value->cantidad_1</td>"
                    . "<td>$value->precio_migrado</td></tr>";
            }
            $cuerpo.="</table>";
            $cuerpo.="<br /><br /><br />";            
           
            $cuerpo.="<table border='1' style='width:900px'>"
                    . "<tr><td align='center' colspan='6'><b>COTIZACIONES DEL SISTEMA NUEVO</b>"
                    . "&nbsp;&nbsp;</td>"
                    . "</tr>"    
                    . "<tr class='titulo'>"
                    . "<td align='center'><b>Id</b></td>"
                    . "<td align='center'><b>Codigo</b></td>"
                    . "<td align='center'><b>Fecha</b></td>"
                    . "<td align='center'><b>Trabajo</b></td>"
                    . "<td align='center'><b>Cantidad</td>"
                    . "<td align='center'><b>Valor</b></td>"
                    . "</tr>";
            
            
            $idproducto = $id;
            if(strlen($idproducto)>4){
            $idcliente = substr($idproducto, 0,4);
            $nuevosot=$this->cotizaciones_model->getCotizacionesPorClienteCotizadas($idcliente);
            }else{
            $idcliente = $idproducto;    
            $nuevosot=$this->cotizaciones_model->getCotizacionesPorClienteCotizadas($idcliente);
            }
           
            foreach ($nuevosot as $value) {
                $cuerpo.="<tr><td align='center'>$value->id</td>"
                    . "<td align='center'>$value->codigo</td>"
                    . "<td align='center'>".invertirFecha2($value->fecha)."</td>"
                    . "<td align='center'>$value->producto</td>"
                    . "<td>$value->cantidad_1</td>"
                    . "<td>$value->precio</td></tr>";
            }
            $cuerpo.="</table>";
            $cuerpo.="<br /><br /><br />";
           
            $cuerpo.="<table border='1' style='width:900px'>"
                    . "<tr><td align='center' colspan='7'><b>COTIZACIONES DEL SISTEMA NUEVO CON OT</b>"
                    . "&nbsp;&nbsp;</td>"
                    . "</tr>"    
                    . "<tr class='titulo'>"
                    . "<td align='center'><b>Id</b></td>"
                    . "<td align='center'><b>Codigo</b></td>"
                    . "<td align='center'><b>Ot</b></td>"
                    . "<td align='center'><b>Fecha</b></td>"
                    . "<td align='center'><b>Trabajo</b></td>"
                    . "<td align='center'><b>Cantidad</td>"
                    . "<td align='center'><b>Valor</b></td>"
                    . "</tr>";
            
            
            $idproducto = $id;
            if(strlen($idproducto)>4){
            $idcliente = substr($idproducto, 0,4);
            $nuevosot=$this->cotizaciones_model->getCotizacionesPorClienteNuevasOT($idcliente);
            }else{
            $idcliente = $idproducto;    
            $nuevosot=$this->cotizaciones_model->getCotizacionesPorClienteNuevasOT($idcliente);
            }
           
            foreach ($nuevosot as $value) {
                $cuerpo.="<tr><td align='center'>$value->id</td>"
                    . "<td align='center'>$value->codigo</td>"
                    . "<td align='center'>$value->ot</td>"
                    . "<td align='center'>".invertirFecha2($value->fecha)."</td>"
                    . "<td align='center'>$value->producto</td>"
                    . "<td>$value->cantidad_1</td>"
                    . "<td>$value->precio</td></tr>";
            }
            $cuerpo.="</table>";
          
            $this->mpdf->SetDisplayMode('fullpage');
            $css1 = file_get_contents('public/frontend/css/listado.css');
            $css2 = file_get_contents('bootstrap/bootstrap.css');
            $this->mpdf->WriteHTML($css2,1);
            $this->mpdf->WriteHTML($css1,1);
    		$this->mpdf->WriteHTML($cuerpo);
    		$this->mpdf->Output();
            
            redirect(base_url().'productos');
    		exit;

        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
        
	}        
   
}


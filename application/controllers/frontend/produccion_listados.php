<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class produccion_listados extends CI_Controller {


    private $session_id;
    public function __construct()
    {
        parent::__construct();
        $this->layout->setLayout('backend_rojo');
      
    }
    
    public function fotomecanica()
	{
        
        //echo $session_id;exit;
        if($this->session->userdata('id'))
        {
          if( $this->session->userdata('perfil')==2){redirect(base_url().'index/no_acceso',  301); }
          if($this->uri->segment(3))
            {
                $pagina=$this->uri->segment(3);
            }else
            {
               $pagina=0;
            }
            $porpagina=10;
        $datos=$this->produccion_listados_model->getTodosPaginacion($pagina,$porpagina,"limit");
        $cuantos=$this->produccion_listados_model->getTodosPaginacion($pagina,$porpagina,"cuantos");
        $config['base_url'] = base_url().'produccion_listados/fotomecanica';
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
            
           $this->layout->view('fotomecanica',compact('datos','cuantos','pagina')); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
        
	}
    public function fotomecanica_pdf()
    {
        //if($this->session->userdata('id'))
        //{
            if( $this->session->userdata('perfil')==2){redirect(base_url().'index/no_acceso',  301); }
            $datos=$this->produccion_listados_model->getTodos();
            $nombre="Listado fotomecanica".date("Y-m-d H:i:s").".pdf";
            $cuerpo='<!doctype html>
			<html> 
            <head>
             <meta charset="utf-8" />
             <title>'.$nombre.'</title>
            </head>
			<body>';
            
            $cuerpo.='
		   <div class="page-header"><h3>Listado de Producción Fotomecanica</h3></div>
		   
		   <table border="1" style="font-size:10px">
					  <tr>
								  <td style="width: 60px;"><b>Prioridad</b></td>
								  <td style="width: 60px;"><b>Número cotización</b></td>
                                  <td style="width: 60px;"><b>Número Orden</b></td>
								  <td style="width: 200px;"><b>Cliente</b></td>
								  <td style="width: 200px;"><b>Detallle</b></td>
								  <td style="width: 100px;"><b>Fecha Emisión</b></td>
								  <td style="width: 80px;"><b>Vendedor</b></td>
								  <td style="width: 80px;"><b>Estado</b></td>
					  </tr>
					  
				  
            ';
            foreach($datos as $dato)
            {
                switch($dato->estado)
                {
                        case '0':
                              $estado="Guardado";                                              
                        break;
                        case '1':
                              $estado="Liberado";
                        break;
                        case '2':
                              $estado="Rechazado";
                        break;       
                }
                $orden=$this->orden_model->getOrdenesPorCotizacion($dato->id_nodo);
                $cotizacion=$this->cotizaciones_model->getCotizacionPorId($dato->id_nodo);
                $cli=$this->clientes_model->getClientePorId($cotizacion->id_cliente);
                $cliente=$cli->razon_social;
                $vendedor=$this->vendedores_model->getVendedorPorId($cotizacion->id_vendedor);
                 switch($dato->prioridad)
                {
                    case '0':
                        $prioridad="Normal";
                    break;
                    case '1':
                        $prioridad="Alta";
                    break;
                }
                $cuerpo.=
                '
                    <tr>
								  <td style="width: 60px;"><b>'.$prioridad.'</b></td>
                                  <td style="width: 60px;"><b>'.$dato->id_nodo.'</b></td>
								  <td style="width: 60px;"><b>'.$orden->id.'</b></td>
								  <td style="width: 200px;"><b>'.$cliente.'</b></td>
								  <td style="width: 200px;"><b>'.$orden->nombre_producto_normal.'</b></td>
								  <td style="width: 100px;"><b>'.fecha($dato->fecha).'</b></td>
								  <td style="width: 80px;"><b>'.$vendedor->nombre.'</b></td>
								  <td style="width: 80px;"><b>'.$estado.'</b></td>
					  </tr>
                ';
            }
            $cuerpo.='</table>';
            $cuerpo.='</body></html>';
            $nombre="Listado fotomecanica".date("Y-m-d H:i:s").".pdf";
    		$this->mpdf->WriteHTML($cuerpo);
    		$this->mpdf->Output($nombre,'I');
    		exit;
        //}else
       // {
        //    redirect(base_url().'usuarios/login',  301);
        //}
    }
    public function fotomecanica_por_estado_pdf($situacion=null)
    {
        //if($this->session->userdata('id'))
        //{
            if( $this->session->userdata('perfil')==2){redirect(base_url().'index/no_acceso',  301); }
            $datos=$this->produccion_listados_model->getFotomecanicaPorEstado($situacion);
             switch($situacion)
            {
                case '0':
                    $situacion='Guardado';
                break;
                case '1':
                    $situacion='Liberado';
                break;
                case '2':
                    $situacion='Rechazado';
                   
                break;
                case '3':
                    $situacion='Activa';
                   
                break;
               
            }
            $nombre="Listado fotomecanica".date("Y-m-d H:i:s").".pdf";
            $cuerpo='<!doctype html>
			<html> 
            <head>
             <meta charset="utf-8" />
             <title>'.$nombre.'</title>
            </head>
			<body>';
            
            $cuerpo.='
		   <div class="page-header"><h3>Listado de Producción Fotomecánica por situación : '.$situacion.'</h3></div>
		   
		   <table border="1" style="font-size:10px">
					  <tr>
								  <td style="width: 60px;"><b>Prioridad</b></td>
								  <td style="width: 60px;"><b>Número cotización</b></td>
                                  <td style="width: 60px;"><b>Número Orden</b></td>
								  <td style="width: 200px;"><b>Cliente</b></td>
								  <td style="width: 200px;"><b>Detallle</b></td>
								  <td style="width: 100px;"><b>Fecha Emisión</b></td>
								  <td style="width: 80px;"><b>Vendedor</b></td>
								  <td style="width: 80px;"><b>Estado</b></td>
					  </tr>
					  
				  
            ';
            foreach($datos as $dato)
            {
                switch($dato->estado)
            {
                    case '0':
                    $estado='Guardado';
                    break;
                    case '1':
                        $estado='Liberado';
                    break;
                    case '2':
                        $estado='Rechazado';
                       
                    break;
                    case '3':
                        $estado='Activa';
                       
                    break;
                
            }
            switch($dato->prioridad)
            {
                case '0':
                    $prioridad="Normal";
                break;
                case '1':
                    $prioridad="Alta";
                break;
            }
                $orden=$this->orden_model->getOrdenesPorCotizacion($dato->id_nodo);
                $cotizacion=$this->cotizaciones_model->getCotizacionPorId($dato->id_nodo);
                $cli=$this->clientes_model->getClientePorId($cotizacion->id_cliente);
                $cliente=$cli->razon_social;
                $vendedor=$this->vendedores_model->getVendedorPorId($cotizacion->id_vendedor);
                $cuerpo.=
                '
                    <tr>
								  <td style="width: 60px;"><b>'.$prioridad.'</b></td>
                                  <td style="width: 60px;"><b>'.$dato->id_nodo.'</b></td>
								  <td style="width: 60px;"><b>'.$orden->id.'</b></td>
								  <td style="width: 200px;"><b>'.$cliente.'</b></td>
								  <td style="width: 200px;"><b>'.$orden->nombre_producto_normal.'</b></td>
								  <td style="width: 100px;"><b>'.fecha($dato->fecha).'</b></td>
								  <td style="width: 80px;"><b>'.$vendedor->nombre.'</b></td>
								  <td style="width: 80px;"><b>'.$estado.'</b></td>
					  </tr>
                ';
            }
            $cuerpo.='</table>';
            $cuerpo.='</body></html>';
            $nombre="Listado fotomecanica".date("Y-m-d H:i:s").".pdf";
    		$this->mpdf->WriteHTML($cuerpo);
    		$this->mpdf->Output($nombre,'I');
    		exit;
        //}else
       // {
        //    redirect(base_url().'usuarios/login',  301);
        //}
    }
    public function fotomecanica_search()
    {
        if($this->session->userdata('id'))
        {
            if ( $this->input->post() )
             {
                //$this->session->set_userdata("chelasybares");
                $this->session->set_userdata('valor', $this->input->post('buscar',true));
                $buscar= $this->session->userdata('valor');
             }else
             {
                $buscar= $this->session->userdata('valor');
             }
            $datos=$this->produccion_listados_model->getFotomecanicaPorNumeroDeOrden($buscar); 
            $this->layout->view('fotomecanica_search',compact('datos')); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
    }
    public function fotomecanica_por_estado($estado=null)
    {
        if($this->session->userdata('id'))
        {
           
            //if(!$estado){show_404();}
            
            switch($estado)
            {
                case '1':
                    $situacion='Guardado';
                    $estado2='0';
                break;
                case '2':
                    $situacion='Liberado';
                    $estado2='1';
                break;
                case '3':
                    $situacion='Rechazado';
                    $estado2='2';
                break;
                case '4':
                    $situacion='Activa';
                    $estado2='3';
                break;
               
            }
            if($this->uri->segment(4))
            {
                $pagina=$this->uri->segment(4);
            }else
            {
               $pagina=0;
            }
            $porpagina=10;
            $datos=$this->produccion_listados_model->getTodosPaginacionPorEstado($pagina,$porpagina,"limit",$estado2);
            $cuantos=$this->produccion_listados_model->getTodosPaginacionPorEstado($pagina,$porpagina,"cuantos",$estado2);
            $config['base_url'] = base_url().'produccion_listados/fotomecanica_por_estado/'.$estado;
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
            
           $this->layout->view('fotomecanica_por_estado',compact('datos','cuantos','pagina','situacion','estado','estado2')); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
    }
   
}


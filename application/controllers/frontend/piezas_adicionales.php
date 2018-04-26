<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class piezas_adicionales extends CI_Controller {


    private $session_id;
    public function __construct()
    {
        parent::__construct();
        $this->layout->setLayout('backend');
      
    }
    
//    public function index()
//	{
//        
//        //echo $session_id;exit;
//        if($this->session->userdata('id'))
//        {
//          if( $this->session->userdata('perfil')==2){redirect(base_url().'index/no_acceso',  301); }
//        $datos=$this->piezas_adicionales_model->getPiezasAdicionales();
//           $this->layout->view('index',compact('datos')); 
//        }else
//        {
//            redirect(base_url().'usuarios/login',  301);
//        }
//        
//	}
        
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
                $porpagina=10;
                if ( $this->input->post() )
                 {
                    $this->session->set_userdata('valor', $this->input->post('buscar',true));
                    $buscar= $this->session->userdata('valor');
                 }else
                 {
                    $buscar= $this->session->userdata('valor');
                 }                
            $datos=$this->piezas_adicionales_model->getPiezasAdicionalesSearchPaginacion($pagina,$porpagina,"limit",$buscar);
            $cuantos=$this->piezas_adicionales_model->getPiezasAdicionalesSearchPaginacion($pagina,$porpagina,"cuantos",$buscar);
            $config['base_url'] = base_url().'piezas_adicionales/search';
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
                $this->layout->view('search',compact('datos','cuantos','pagina','buscar')); 
            }else
            {
                redirect(base_url().'usuarios/login',  301);
            }        
        }     
        
    public function index()
	{
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
        $datos=$this->piezas_adicionales_model->getPiezasAdicionalesPaginacion($pagina,$porpagina,"limit");
        $cuantos=$this->piezas_adicionales_model->getPiezasAdicionalesPaginacion($pagina,$porpagina,"cuantos");
        
        $config['base_url'] = base_url().'piezas_adicionales/index';
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
            
            $this->layout->view('index',compact('datos','cuantos','pagina')); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
        
	}        

	public function delete() 
	{
	
		if($this->uri->segment(3))
		{
			if( $this->session->userdata('perfil')==2){redirect(base_url().'index/no_acceso',  301); }
            $id=$this->uri->segment(3);
			$this->piezas_adicionales_model->delete($id);
			$this->session->set_flashdata('ControllerMessage', 'Se ha eliminado el registro seleccionado.');
			redirect(base_url().'piezas_adicionales',  301); 			
		}
	}	
		
    public function add()
    {
        if($this->session->userdata('id'))
        {
            if( $this->session->userdata('perfil')==2){redirect(base_url().'index/no_acceso',  301); }
            if($this->input->post())
            {
                if($this->form_validation->run("ad_piezas_adicionales"))
                {
                    if ($this->input->post("fecha_modificacion",true)=='')
                        $fecha=date('Y-m-d');
                    else 
                    { 
                        $arreglo_fecha=explode('/',$this->input->post("fecha_modificacion",true));  
                        $fecha=$arreglo_fecha[2].'-'.$arreglo_fecha[1].'-'.$arreglo_fecha[0];      
                    }       
               
                    $data=array
                    (
                        "piezas_adicionales"=>$this->input->post("nom",true),
                        "unidad_de_compra"=>$this->input->post("unidad_de_compra",true),  
			"valor_compra"=>$this->input->post("valor_compra",true),                                 
                        "id_proveedor1"=>$this->input->post("id_proveedor1",true),
                        "id_proveedor2"=>$this->input->post("id_proveedor2",true),                        
                        "unidad_de_venta"=>$this->input->post("unidad_de_venta",true),
                        "unidad_de_conversion"=>$this->input->post("unidad_de_conversion",true),
                        "calculo_ingenieria"=>$this->input->post("calculo_ingenieria",true),
			"valor_venta"=>$this->input->post("valor_venta",true),    
                        "calculo_ingenieria"=>$this->input->post("calculo_ingenieria",true),
			"id_user"=>$this->input->post("id_user",true), 
                        "fecha_modificacion"=>$fecha, 
                    );
                    $guardar=$this->piezas_adicionales_model->insertar($data);
                     if($guardar)
                     {
                        $this->session->set_flashdata('ControllerMessage', 'Se ha agregado el registro exitosamente.');
                        redirect(base_url().'piezas_adicionales',  301); 
                     }else
                     {
                        $this->session->set_flashdata('ControllerMessage', 'El login ingresado ya existe en la base de datos.');
                        redirect(base_url().'piezas_adicionales/add',  301);
                     }
                }
            }
            $proveedores=$this->proveedores_model->getProveedores();   
            $usuarios=$this->usuarios_model->getUsuarios();
            
            $regions=$this->direccion_model->getRegion();
            $this->layout->view('add',compact('regions','proveedores','usuarios')); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
    }
    public function edit($id=null)
    {
        if($this->session->userdata('id'))
        {
            if( $this->session->userdata('perfil')==2){redirect(base_url().'index/no_acceso',  301); }
            if(!$id){show_404();}
            $datos=$this->piezas_adicionales_model->getPiezasAdicionalesPorId($id);
            if(sizeof($datos)==0){show_404();}
             if($this->input->post())
            {
                if($this->form_validation->run("ad_unidad_de_compra"))
                {
                    if ($this->input->post("fecha_modificacion",true)=='')
                        $fecha=date('Y-m-d');
                    else 
                    { 
                        $arreglo_fecha=explode('/',$this->input->post("fecha_modificacion",true));  
                        $fecha=$arreglo_fecha[2].'-'.$arreglo_fecha[1].'-'.$arreglo_fecha[0];      
                    }       
//                    exit($fecha);
                    $data=array
                    (
                        "piezas_adicionales"=>$this->input->post("nom",true),
                        "unidad_de_compra"=>$this->input->post("unidad_de_compra",true),  
			"valor_compra"=>$this->input->post("valor_compra",true),                                 
                        "id_proveedor1"=>$this->input->post("id_proveedor1",true),
                        "id_proveedor2"=>$this->input->post("id_proveedor2",true),                        
                        "unidad_de_venta"=>$this->input->post("unidad_de_venta",true),
                        "unidad_de_conversion"=>$this->input->post("unidad_de_conversion",true),
                        "calculo_ingenieria"=>$this->input->post("calculo_ingenieria",true),
			"valor_venta"=>$this->input->post("valor_venta",true),    
                        "calculo_ingenieria"=>$this->input->post("calculo_ingenieria",true),
			"id_user"=>$this->input->post("id_user",true), 
                        "fecha_modificacion"=>$fecha,                     
                    );
//                    exit(print_r($data));
                    $guardar=$this->piezas_adicionales_model->update($data,$this->input->post("id",true));
                     if($guardar)
                            {
                                $this->session->set_flashdata('ControllerMessage', 'Se ha editado el registro exitosamente.');
				redirect(base_url().'piezas_adicionales',  301); 
                            }else
                            {
                               $this->session->set_flashdata('ControllerMessage', 'El login ingresado ya existe en la base de datos.');
                               redirect(base_url().'piezas_adicionales/edit/'.$this->input->post("id",true),  301);
                            }
                }
            }    
            $regions=$this->direccion_model->getRegion();
            $usuarios=$this->usuarios_model->getUsuarios();
            $proveedores=$this->proveedores_model->getProveedores();             
            $this->layout->view('edit',compact('regions','id','pagina','datos','usuarios','proveedores')); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
    }
   
}


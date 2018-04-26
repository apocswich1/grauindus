<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class acabados extends CI_Controller {


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
          if( $this->session->userdata('perfil')==2){redirect(base_url().'index/no_acceso',  301); }
            if($this->uri->segment(3))
            {
                $pagina=$this->uri->segment(3);
            }else
            {
               $pagina=0;
            }
            $porpagina=10;
        $datos=$this->acabados_model->getAcabadosPaginacion($pagina,$porpagina,"limit");
        $cuantos=$this->acabados_model->getAcabadosPaginacion($pagina,$porpagina,"cuantos");
        
        $config['base_url'] = base_url().'acabados/index';
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
            $datos=$this->acabados_model->getAcabadosSearchPaginacion($pagina,$porpagina,"limit",$buscar);
            $cuantos=$this->acabados_model->getAcabadosSearchPaginacion($pagina,$porpagina,"cuantos",$buscar);
            $config['base_url'] = base_url().'acabados/search';
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
        
   public function add()
    {
          if($this->session->userdata('id'))
        {
            if( $this->session->userdata('perfil')==2){redirect(base_url().'index/no_acceso',  301); }
            if ( $this->input->post() )
 		         {
 		              if ( $this->form_validation->run('add_acabado') )
    			         {
                             $data=array
                             (
                                "proveedor_1"=>$this->input->post("proveedor1",true),
                                "proveedor_2"=>$this->input->post("proveedor2",true),
                                "codigo"=>$this->input->post("codigo",true),
                                "caracteristicas"=>$this->input->post("caracteristicas",true),
                                "tipo"=>$this->input->post("tipo",true),
                                "unidad_de_compra"=>$this->input->post("unidad_de_compra",true),
                                "unidad_de_venta"=>$this->input->post("unidad_de_venta",true),
                                "valor_venta"=>$this->input->post("valor_venta",true),
                                "costo_compra"=>$this->input->post("costo_compra",true),
                                "fecha_cotizacion"=>$this->input->post("fecha_cotizacion",true),
                                "procesos_especiales"=>$this->input->post("procesos_especiales",true),
			
								"costo_fijo"=>$this->input->post("costo_fijo",true),
								//"costo_cantidad_minima"=>$this->input->post("costo_cantidad_minima",true),
								//"cantidad_minima"=>$this->input->post("cantidad_minima",true),
								//"valor_venta_minima"=>$this->input->post("valor_venta_minima",true),
                             );
                              $this->db->insert("acabados2",$data);
                              $this->session->set_flashdata('ControllerMessage', 'Se ha agregado el registro exitosamente.');					           redirect(base_url().'acabados',  301); 
    			         }
                }
           $proveedores=$this->proveedores_model->getProveedores();       
           $this->layout->view('add',compact("proveedores")); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
    }
     public function edit($id=null,$pagina=null)
    {
          if($this->session->userdata('id'))
        {
             if( $this->session->userdata('perfil')==2){redirect(base_url().'index/no_acceso',  301); }
             if(!$id){show_404();}
            $datos=$this->acabados_model->getAcabadosPorId($id);
//            print_r($datos);exit;
            if(sizeof($datos)==0){show_404();}
            if ( $this->input->post() )
 		         {
 		             if ( $this->form_validation->run('edit_acabado') )
    			         {
    			             $data=array
                             (
                                "proveedor_1"=>$this->input->post("proveedor1",true),
                                "proveedor_2"=>$this->input->post("proveedor2",true),
                                "codigo"=>$this->input->post("codigo",true),
                                "caracteristicas"=>$this->input->post("caracteristicas",true),
                                "tipo"=>$this->input->post("tipo",true),
                                "unidad_de_compra"=>$this->input->post("unidad_de_compra",true),
                                "unidad_de_venta"=>$this->input->post("unidad_de_venta",true),
                                "valor_venta"=>$this->input->post("valor_venta",true),
                                "costo_compra"=>$this->input->post("costo_compra",true),
                                "fecha_cotizacion"=>$this->input->post("fecha_cotizacion",true),
                                "estado"=>$this->input->post("estado",true),
                                "quien"=>$this->session->userdata('id'),
                                "procesos_especiales"=>$this->input->post('procesos_especiales'),
                                "cuando"=>date("Y-m-d"),
								
								"costo_fijo"=>$this->input->post("costo_fijo",true),
								//"costo_cantidad_minima"=>$this->input->post("costo_cantidad_minima",true),
								///"cantidad_minima"=>$this->input->post("cantidad_minima",true),
								//"valor_venta_minima"=>$this->input->post("valor_venta_minima",true),
                             );
                              $this->db->where('id', $this->input->post("id",true));
                              $this->db->update("acabados2",$data);
                              $this->session->set_flashdata('ControllerMessage', 'Se ha modificado el registro exitosamente.');					           redirect(base_url().'acabados/index/'.$this->input->post("pagina",true),  301); 
    			         }
                }
           $proveedores=$this->proveedores_model->getProveedores();     
           $this->layout->view('edit',compact("datos","id","pagina","proveedores")); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
    }
}


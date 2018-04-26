<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class adhesivos extends CI_Controller {


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
        $datos=$this->adhesivos_model->getAdhesivosPaginacion($pagina,$porpagina,"limit");
        $cuantos=$this->adhesivos_model->getAdhesivosPaginacion($pagina,$porpagina,"cuantos");
        
        $config['base_url'] = base_url().'adhesivos/index';
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
   public function add()
    {
          if($this->session->userdata('id'))
        {
            if( $this->session->userdata('perfil')==2){redirect(base_url().'index/no_acceso',  301); }
            if ( $this->input->post() )
 		         {
 		              if ( $this->form_validation->run('add_adhesivo') )
    			         {
                             $data=array
                             (
                                "nombre"=>$this->input->post("nom",true),
                                "codigo"=>$this->input->post("codigo",true),
                                "proveedor1"=>$this->input->post("proveedor1",true),
                                "proveedor2"=>$this->input->post("proveedor2",true),
                                "precio"=>$this->input->post("precio",true),
                                "fecha_compra"=>$this->input->post("fecha_compra",true),
                             );
                              $this->db->insert("adhesivos",$data);
                              $this->session->set_flashdata('ControllerMessage', 'Se ha agregado el registro exitosamente.');					           redirect(base_url().'adhesivos',  301); 
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
            $datos=$this->adhesivos_model->getAdhesivosPorId($id);
            //print_r($datos);exit;
            if(sizeof($datos)==0){show_404();}
            if ( $this->input->post() )
 		         {
 		             if ( $this->form_validation->run('add_adhesivo') )
    			         {
    			             $data=array
                             (
                                "nombre"=>$this->input->post("nom",true),
                                "codigo"=>$this->input->post("codigo",true),
                                "proveedor1"=>$this->input->post("proveedor1",true),
                                "proveedor2"=>$this->input->post("proveedor2",true),
                                "precio"=>$this->input->post("precio",true),
                                "fecha_compra"=>$this->input->post("fecha_compra",true),
                                "estado"=>$this->input->post("estado",true),
                             );
                              $this->db->where('id', $this->input->post("id",true));
                              $this->db->update("adhesivos",$data);
                              $this->session->set_flashdata('ControllerMessage', 'Se ha modificado el registro exitosamente.');					           redirect(base_url().'adhesivos/index/'.$this->input->post("pagina",true),  301); 
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


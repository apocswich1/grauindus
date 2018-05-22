<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Proveedores extends CI_Controller {


    private $session_id;
    public function __construct()
    {
        parent::__construct();
        $this->layout->setLayout('backend');
        $this->load->model("rubros_model");
      
    }
    
    public function index()
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
        $datos=$this->proveedores_model->getProveedoresPaginacion($pagina,$porpagina,"limit");
        $cuantos=$this->proveedores_model->getProveedoresPaginacion($pagina,$porpagina,"cuantos");
		//var_dump($datos);
        $config['base_url'] = base_url().'proveedores/index';
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
 		              if ( $this->form_validation->run('ad_proveedores') )
    			         {
    			             $data=array
                             (
                                "nombre"=>$this->input->post("nom",true),
                                "telefono"=>$this->input->post("telefono",true),
                                "correo"=>$this->input->post("correo",true),
                                "num_cuenta"=>$this->input->post("num_cuenta",true),
                                "tipo_cuenta"=>$this->input->post("tipo_cuenta",true),
                                "razon_social"=>$this->input->post("razon_social",true),                                         
                                "titular_cuenta"=>$this->input->post("titular_cuenta",true),                                              
                                "rubro"=>$this->input->post("rubro",true),
                                "rubro2"=>$this->input->post("rubro2",true),
                                "fecha_creacion"=>date("Y-m-d H:m:s"),
                                "contacto"=>$this->input->post("contacto",true),
                                "id_forma_pago"=>$this->input->post("forma_pago",true),                                         
                                "horario"=>$this->input->post("horario",true),                                         
                                "direccion"=>$this->input->post("direccion",true),                                         
                                "rut"=>$this->input->post("rut",true),                                         
                             );
                              $guardar=$this->proveedores_model->insertar($data);
                            if($guardar)
                            {
                                $this->session->set_flashdata('ControllerMessage', 'Se ha agregado el registro exitosamente.');
					           redirect(base_url().'proveedores',  301); 
                            }else
                            {
                               $this->session->set_flashdata('ControllerMessage', 'El login ingresado ya existe en la base de datos.');
					           redirect(base_url().'proveedores/add',  301);
                            }
    			         }
                }
           $this->layout->view('add'); 
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
			$this->proveedores_model->delete($id);
			$this->session->set_flashdata('ControllerMessage', 'Se ha eliminado el registro seleccionado.');
			redirect(base_url().'proveedores',  301); 			
		}
	}
	
     public function edit($id=null)
    {
          if($this->session->userdata('id'))
        {
             if( $this->session->userdata('perfil')==2){redirect(base_url().'index/no_acceso',  301); }
             if(!$id){show_404();}
            $datos=$this->proveedores_model->getProveedoresPorId($id);
            if(sizeof($datos)==0){show_404();}
            if ( $this->input->post() )
            {
                        if ( $this->form_validation->run('ed_proveedores') )
                           {
    			     $data=array
                             (
                                "nombre"=>$this->input->post("nom",true),
                                "telefono"=>$this->input->post("telefono",true),
                                "correo"=>$this->input->post("correo",true),
                                "num_cuenta"=>$this->input->post("num_cuenta",true),
                                "tipo_cuenta"=>$this->input->post("tipo_cuenta",true),
                                "razon_social"=>$this->input->post("razon_social",true),                                         
                                "titular_cuenta"=>$this->input->post("titular_cuenta",true),                                     
                                "rubro"=>$this->input->post("rubro",true),
                                "rubro2"=>$this->input->post("rubro2",true),
                                "contacto"=>$this->input->post("contacto",true),
                                "id_forma_pago"=>$this->input->post("forma_pago",true),                                                
                                "horario"=>$this->input->post("horario",true),                                                
                                "direccion"=>$this->input->post("direccion",true),                                                
                                "rut"=>$this->input->post("rut",true),                                                
                             );
                              $guardar=$this->proveedores_model->update($data,$this->input->post("id",true));
                            if($guardar)
                            {
                                $this->session->set_flashdata('ControllerMessage', 'Se ha agregado el registro exitosamente.');
					           redirect(base_url().'proveedores/index/'.$this->uri->segment(4),  301); 
                            }else
                            {
                               $this->session->set_flashdata('ControllerMessage', 'El login ingresado ya existe en la base de datos.');
					           redirect(base_url().'proveedores/edit/'.$this->input->post("id",true),  301);
                            }
    			         }
                }
           $this->layout->view('edit',compact("datos")); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
    }
}


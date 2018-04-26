<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rubros extends CI_Controller {


    private $session_id;
    public function __construct()
    {
        parent::__construct();
        $this->load->model('rubros_model');
        $this->layout->setLayout('backend');
      
    }
    
    public function index(){
        
        if($this->session->userdata('id'))
        {
           if( $this->session->userdata('perfil')==2){redirect(base_url().'index/no_acceso',  301); }
           $datos= $this->rubros_model->getRubros();
           $this->layout->view('index',compact('datos')); 
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
			$this->rubros_model->deleteRubros($id);
			$this->session->set_flashdata('ControllerMessage', 'Se ha eliminado el registro seleccionado.');
			redirect(base_url().'rubros',  301); 			
		}
	}	
	
    public function add()
    {
          if($this->session->userdata('id'))
        {
            if( $this->session->userdata('perfil')==2){redirect(base_url().'index/no_acceso',  301); }
            if ( $this->input->post() )
 		         {
 		              if ( $this->form_validation->run('ad_rubro') )
    			         {
    			             $data=array
                             (
                                "rubro"=>$this->input->post("nom",true),
                                
                             );
                              $guardar=$this->rubros_model->insertarRubro($data);
                            if($guardar)
                            {
                                $this->session->set_flashdata('ControllerMessage', 'Se ha agregado el registro exitosamente.');
					           redirect(base_url().'rubros',  301); 
                            }else
                            {
                               $this->session->set_flashdata('ControllerMessage', 'El login ingresado ya existe en la base de datos.');
					           redirect(base_url().'rubros/add',  301);
                            }
    			         }
                }
           $this->layout->view('add'); 
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
            $datos=$this->rubros_model->getRubrosPorId($id);
            if(sizeof($datos)==0){show_404();}
            if ( $this->input->post() )
 		         {
 		              if ( $this->form_validation->run('ad_rubro') )
    			         {
    			              $data=array
                             (
                                "rubro"=>$this->input->post("nom",true),
                                
                             );
                              $guardar=$this->rubros_model->updateRubros($data,$this->input->post("id",true));
                            if($guardar)
                            {
                                $this->session->set_flashdata('ControllerMessage', 'Se ha agregado el registro exitosamente.');
					           redirect(base_url().'rubros',  301); 
                            }else
                            {
                               $this->session->set_flashdata('ControllerMessage', 'El login ingresado ya existe en la base de datos.');
					           redirect(base_url().'rubros/edit/'.$this->input->post("id",true),  301);
                            }
    			         }
                }
            $this->layout->view('edit',compact('datos')); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
    }
    
}


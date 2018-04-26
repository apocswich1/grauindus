<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Grupos extends CI_Controller {


    private $session_id;
    public function __construct()
    {
        parent::__construct();
        $this->load->model('grupos_model');
        $this->load->model('cotizaciones_model');
        $this->layout->setLayout('backend');
      
    }
    
    public function index(){
        
        if($this->session->userdata('id'))
        {
           if( $this->session->userdata('perfil')==2){redirect(base_url().'index/no_acceso',  301); }
           $datos= $this->grupos_model->getGrupos();
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
			$this->grupos_model->deleteGrupos($id);
			$this->session->set_flashdata('ControllerMessage', 'Se ha eliminado el registro seleccionado.');
			redirect(base_url().'grupos',  301); 			
		}
	}	
	
    public function add()
    {
          if($this->session->userdata('id'))
        {
            if( $this->session->userdata('perfil')==2){redirect(base_url().'index/no_acceso',  301); }
            if ( $this->input->post() )
 		         {
 		              if ( $this->form_validation->run('ad_grupo') )
    			         {
    			             $data=array
                             (
                                "grupo"=>$this->input->post("grupo",true),
                                
                             );
                              $guardar=$this->grupos_model->insertarRubro($data);
                            if($guardar)
                            {
                                $this->session->set_flashdata('ControllerMessage', 'Se ha agregado el registro exitosamente.');
					           redirect(base_url().'grupos',  301); 
                            }else
                            {
                               $this->session->set_flashdata('ControllerMessage', 'El login ingresado ya existe en la base de datos.');
					           redirect(base_url().'grupos/add',  301);
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
            $datos=$this->grupos_model->getGruposPorId($id);
            if(sizeof($datos)==0){show_404();}
            if ( $this->input->post() )
 		         {
 		              if ( $this->form_validation->run('ad_grupo') )
    			         {
    			              $data=array
                             (
                                "grupo"=>$this->input->post("grupo",true),
                                
                             );
                              $guardar=$this->grupos_model->updateRubros($data,$this->input->post("id",true));
                            if($guardar)
                            {
                                $this->session->set_flashdata('ControllerMessage', 'Se ha agregado el registro exitosamente.');
					           redirect(base_url().'grupo',  301); 
                            }else
                            {
                               $this->session->set_flashdata('ControllerMessage', 'El login ingresado ya existe en la base de datos.');
					           redirect(base_url().'grupo/edit/'.$this->input->post("id",true),  301);
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
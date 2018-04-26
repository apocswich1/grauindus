<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Datos_tecnicos extends CI_Controller {


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
            $datos=$this->datos_tecnicos_model->getDatosTecnicosTodos(); 
            $this->layout->view('index',compact('datos')); 
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
 		              if ( $this->form_validation->run('add_datos_tecnicos') )
    			         {
                             $data=array
                             (
                                "datos_tecnicos"=>$this->input->post("nom",true),
                             );
                              $this->db->insert("datos_tecnicos",$data);
                              $this->session->set_flashdata('ControllerMessage', 'Se ha agregado el registro exitosamente.');					           redirect(base_url().'datos_tecnicos',  301); 
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
            $datos=$this->datos_tecnicos_model->getDatosTecnicosPorId($id);
            //print_r($datos);exit;
            if(sizeof($datos)==0){show_404();}
            if ( $this->input->post() )
 		         {
 		             if ( $this->form_validation->run('add_datos_tecnicos') )
    			         {
    			             $data=array
                             (
                                "datos_tecnicos"=>$this->input->post("nom",true),
                                "estado"=>$this->input->post("estado",true),
                             );
                              $this->db->where('id', $this->input->post("id",true));
                              $this->db->update("datos_tecnicos",$data);
                              $this->session->set_flashdata('ControllerMessage', 'Se ha modificado el registro exitosamente.');					           redirect(base_url().'datos_tecnicos',  301); 
    			         }
                }     
           $this->layout->view('edit',compact("datos","id")); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
    }
}


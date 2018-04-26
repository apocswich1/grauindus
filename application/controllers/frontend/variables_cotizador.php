<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class variables_cotizador extends CI_Controller {


    private $session_id;
    public function __construct()
    {
        parent::__construct();
        $this->layout->setLayout('backend');
      
    }
    
    public function index()
	{
        
        //echo $session_id;exit;
        if($this->session->userdata('id'))
        {
           if( $this->session->userdata('perfil')==2){redirect(base_url().'index/no_acceso',  301); }
           $datos=$this->variables_cotizador_model->getVariablesCotizadorSelect();
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
			$this->variables_cotizador_model->delete($id);
			$this->session->set_flashdata('ControllerMessage', 'Se ha eliminado el registro seleccionado.');
			redirect(base_url().'variables_cotizador',  301); 			
		}
	}
	
     public function add()
    {
          if($this->session->userdata('id'))
        {
            if( $this->session->userdata('perfil')==2){redirect(base_url().'index/no_acceso',  301); }
            if ( $this->input->post() )
 		         {
 		              if ( $this->form_validation->run('ad_variables_cotizador') )
    			        {
    			             $data=array
                             (
                                "tipo"=>$this->input->post("tipo",true),
                                "nombre"=>$this->input->post("nom",true),
                                "precio"=>$this->input->post("precio",true),
                                "fecha_modificacion"=>date("Y-m-d"),
                             );
                              $guardar=$this->variables_cotizador_model->insertar($data);
                            if($guardar)
                            {
                                $this->session->set_flashdata('ControllerMessage', 'Se ha agregado el registro exitosamente.');
					           redirect(base_url().'variables_cotizador',  301); 
                            }else
                            {
                               $this->session->set_flashdata('ControllerMessage', 'El login ingresado ya existe en la base de datos.');
					           redirect(base_url().'variables_cotizador/add',  301);
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
            $datos=$this->variables_cotizador_model->getVariablesCotizadorPorId($id);
            //print_r($datos);exit;
            if(sizeof($datos)==0){show_404();}
            if ( $this->input->post() )
 		         {
 		              if ( $this->form_validation->run('ad_variables_cotizador') )
    			        {
    			            $data=array
                             (
                                "tipo"=>$this->input->post("tipo",true),
                                "nombre"=>$this->input->post("nom",true),
                                "precio"=>$this->input->post("precio",true),
                                "fecha_modificacion"=>date("Y-m-d"),
                             );
                              $guardar=$this->variables_cotizador_model->update($data,$this->input->post("id",true));
                            if($guardar)
                            {
                                $this->session->set_flashdata('ControllerMessage', 'Se ha editado el registro exitosamente.');
					           redirect(base_url().'variables_cotizador/',  301); 
                            }else
                            {
                               $this->session->set_flashdata('ControllerMessage', 'El login ingresado ya existe en la base de datos.');
					           redirect(base_url().'variables_cotizador/edit/'.$this->input->post("id",true),  301);
                            }
    			         }
                }
           $this->layout->view('edit',compact("datos","id")); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
    }
}


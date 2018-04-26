<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class servicios extends CI_Controller {


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
          $datos=$this->servicios_model->getServiciosSelect();
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
			$id=$this->uri->segment(3);
			$this->servicios_model->delete($id);
			$this->session->set_flashdata('ControllerMessage', 'Se ha eliminado el registro seleccionado.');
			redirect(base_url().'servicios',  301); 			
		}
	}	
     public function add()
    {
          if($this->session->userdata('id'))
        {
            if ( $this->input->post() )
 		         {
 		              if ( $this->form_validation->run('ad_servicio') )
    			         {
    			             $data=array
                             (
                                "servicio"=>$this->input->post("servicio",true),
                                "tipo"=>$this->input->post("tipo",true),
                                "precio"=>$this->input->post("precio",true),
                             );
                              $guardar=$this->servicios_model->insertar($data);
                            if($guardar)
                            {
                                $this->session->set_flashdata('ControllerMessage', 'Se ha agregado el registro exitosamente.');
					           redirect(base_url().'servicios',  301); 
                            }else
                            {
                               $this->session->set_flashdata('ControllerMessage', 'El login ingresado ya existe en la base de datos.');
					           redirect(base_url().'servicios/add',  301);
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
             if(!$id){show_404();}
            $datos=$this->servicios_model->getServiciosPorId($id);
            //print_r($datos);exit;
            if(sizeof($datos)==0){show_404();}
            if ( $this->input->post() )
 		         {
 		             if ( $this->form_validation->run('ad_servicio') )
    			         {
    			             $data=array
                             (
                                "servicio"=>$this->input->post("servicio",true),
                                "tipo"=>$this->input->post("tipo",true),
                                "precio"=>$this->input->post("precio",true),
                             );
                              $guardar=$this->servicios_model->update($data,$this->input->post("id",true));
                            if($guardar)
                            {
                                $this->session->set_flashdata('ControllerMessage', 'Se ha editado el registro exitosamente.');
					           redirect(base_url().'servicios/',  301); 
                            }else
                            {
                               $this->session->set_flashdata('ControllerMessage', 'El login ingresado ya existe en la base de datos.');
					           redirect(base_url().'servicios/edit/'.$this->input->post("id",true),  301);
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


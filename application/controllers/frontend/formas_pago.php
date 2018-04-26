<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Formas_pago extends CI_Controller {


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
           $datos=$this->clientes_model->getFormasPago(); 
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
			$this->clientes_model->deleteFormaDePago($id);
			$this->session->set_flashdata('ControllerMessage', 'Se ha eliminado el registro seleccionado.');
			redirect(base_url().'formas_pago',  301); 			
		}
	}	
	
    public function add()
    {
          if($this->session->userdata('id'))
        {
            if( $this->session->userdata('perfil')==2){redirect(base_url().'index/no_acceso',  301); }
            if ( $this->input->post() )
 		         {
 		              if ( $this->form_validation->run('ad_forma_pago') )
    			         {
    			             $data=array
                             (
                                "forma_pago"=>$this->input->post("nom",true),
                                "dias"=>$this->input->post("dias",true)
                             );
                              $guardar=$this->clientes_model->insertarFormaDePago($data);
                            if($guardar)
                            {
                                $this->session->set_flashdata('ControllerMessage', 'Se ha agregado el registro exitosamente.');
					           redirect(base_url().'formas_pago',  301); 
                            }else
                            {
                               $this->session->set_flashdata('ControllerMessage', 'El login ingresado ya existe en la base de datos.');
					           redirect(base_url().'formas_pago/add',  301);
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
            $datos=$this->clientes_model->getFormasPagoPorId($id);
            if(sizeof($datos)==0){show_404();}
            if ( $this->input->post() )
 		         {
 		              if ( $this->form_validation->run('ad_forma_pago') )
    			         {
    			              $data=array
                             (
                                "forma_pago"=>$this->input->post("nom",true),
                                "dias"=>$this->input->post("dias",true)
                             );
                              $guardar=$this->clientes_model->updateFormaDePago($data,$this->input->post("id",true));
                            if($guardar)
                            {
                                $this->session->set_flashdata('ControllerMessage', 'Se ha agregado el registro exitosamente.');
					           redirect(base_url().'formas_pago',  301); 
                            }else
                            {
                               $this->session->set_flashdata('ControllerMessage', 'El login ingresado ya existe en la base de datos.');
					           redirect(base_url().'formas_pago/edit/'.$this->input->post("id",true),  301);
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


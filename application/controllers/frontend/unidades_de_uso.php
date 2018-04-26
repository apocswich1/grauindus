<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class unidades_de_uso extends CI_Controller {


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
        $datos=$this->unidades_de_uso_model->getUnidadesDeUso();
           $this->layout->view('index',compact('datos','datos_externos')); 
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
			$this->unidades_de_uso_model->delete($id);
			$this->session->set_flashdata('ControllerMessage', 'Se ha eliminado el registro seleccionado.');
			redirect(base_url().'unidades_de_uso',  301); 			
		}
	}
	
    public function add()
    {
        if($this->session->userdata('id'))
        {
            if( $this->session->userdata('perfil')==2){redirect(base_url().'index/no_acceso',  301); }
            if($this->input->post())
            {
                if($this->form_validation->run("ad_unidad_de_uso"))
                {
                    $data=array
                    (
                        "unidades_de_compra"=>$this->input->post("nom",true),
                        "unidad_venta"=>$this->input->post("unidad_venta",true),
                        "factor_conv"=>$this->input->post("factor_conv",true),  
                        "unidad_uso"=>$this->input->post("unidad_uso",true),                          
                    );
                    $guardar=$this->unidades_de_uso_model->insertar($data);
                     if($guardar)
                            {
                                $this->session->set_flashdata('ControllerMessage', 'Se ha agregado el registro exitosamente.');
					           redirect(base_url().'unidades_de_uso',  301); 
                            }else
                            {
                               $this->session->set_flashdata('ControllerMessage', 'El login ingresado ya existe en la base de datos.');
					           redirect(base_url().'unidades_de_uso/add',  301);
                            }
                }
            }
            $regions=$this->direccion_model->getRegion();
            $this->layout->view('add',compact('regions')); 
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
            $datos=$this->unidades_de_uso_model->getUnidadesDeUsoPorId($id);
            if(sizeof($datos)==0){show_404();}
             if($this->input->post())
            {
                if($this->form_validation->run("ad_unidad_de_uso"))
                {
                    $data=array
                    (
                        "unidades_de_compra"=>$this->input->post("nom",true),
                        "unidad_venta"=>$this->input->post("unidad_venta",true),
                        "factor_conv"=>$this->input->post("factor_conv",true),  
                        "unidad_uso"=>$this->input->post("unidad_uso",true),                            
                        
                    );
                    $guardar=$this->unidades_de_uso_model->update($data,$this->input->post("id",true));
                     if($guardar)
                            {
                                $this->session->set_flashdata('ControllerMessage', 'Se ha editado el registro exitosamente.');
					           redirect(base_url().'unidades_de_uso',  301); 
                            }else
                            {
                               $this->session->set_flashdata('ControllerMessage', 'El login ingresado ya existe en la base de datos.');
					           redirect(base_url().'unidades_de_uso/edit/'.$this->input->post("id",true),  301);
                            }
                }
            }    
            $regions=$this->direccion_model->getRegion();
            $this->layout->view('edit',compact('regions','id','pagina','datos')); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
    }
   
}


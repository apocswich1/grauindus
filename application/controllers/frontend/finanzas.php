<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class finanzas extends CI_Controller {


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
          $datos=$this->finanzas_model->getFinanzasSelect();
          $this->layout->view('index',compact('datos')); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
        
	}
    /**
 *  public function add()
 *     {
 *           if($this->session->userdata('id'))
 *         {
 *             if ( $this->input->post() )
 *  		         {
 *  		              if ( $this->form_validation->run('ad_servicio') )
 *     			         {
 *     			             $data=array
 *                              (
 *                                 "dolar"=>$this->input->post("dolar",true),
 *                                 "uf"=>$this->input->post("uf",true),
 *                              );
 *                               $guardar=$this->finanzas_model->insertar($data);
 *                             if($guardar)
 *                             {
 *                                 $this->session->set_flashdata('ControllerMessage', 'Se ha agregado el registro exitosamente.');
 * 					           redirect(base_url().'finanzas',  301); 
 *                             }else
 *                             {
 *                                $this->session->set_flashdata('ControllerMessage', 'El login ingresado ya existe en la base de datos.');
 * 					           redirect(base_url().'finanzas/add',  301);
 *                             }
 *     			         }
 *                 }
 *            $this->layout->view('add'); 
 *         }else
 *         {
 *             redirect(base_url().'usuarios/login',  301);
 *         }
 *     }
 */
     public function edit($id=null)
    {
          if($this->session->userdata('id'))
        {
             if( $this->session->userdata('perfil')==2){redirect(base_url().'index/no_acceso',  301); }
             if(!$id){show_404();}
            $datos=$this->finanzas_model->getFinanzasPorId($id);
            //print_r($datos);exit;
            if(sizeof($datos)==0){show_404();}
            if ( $this->input->post() )
 		         {
 		             if ( $this->form_validation->run('ad_finanza') )
    			         {
    			              $data=array
                             (
                                "dolar"=>$this->input->post("dolar",true),
                                "uf"=>$this->input->post("uf",true),
                                "quien"=>$this->session->userdata('id'),
                                "cuando"=>date("Y-m-d"),
                             );
                              $guardar=$this->finanzas_model->update($data,1);
                            if($guardar)
                            {
                                $this->session->set_flashdata('ControllerMessage', 'Se ha editado el registro exitosamente.');
					           redirect(base_url().'finanzas/',  301); 
                            }else
                            {
                               $this->session->set_flashdata('ControllerMessage', 'El login ingresado ya existe en la base de datos.');
					           redirect(base_url().'finanzas/edit/'.$this->input->post("id",true),  301);
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


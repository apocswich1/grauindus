<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class trabajo extends CI_Controller {


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
           $datos=$this->orden_model->getOrdenesTodas();
           $i=1;
           foreach($datos as $dato)
           {
                
                 $dataProduccionFotomecanica=array
                     (
                     'id_usuario'=>$this->session->userdata('id'),
                     'tipo'=>'1',
                     'id_nodo'=>$dato->id_cotizacion,
                     'situacion'=>'Guardar',
                     'estado'=>'0',
                     );
                     $this->db->insert("produccion_fotomecanica",$dataProduccionFotomecanica);
                     echo $i."-----".$dato->id_cotizacion."<br />";
            $i++;
           }
           //$this->layout->view('index',compact('datos')); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
        
	}
	
	}


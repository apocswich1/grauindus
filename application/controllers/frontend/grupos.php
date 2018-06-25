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
    
    public function index2(){

        if($this->session->userdata('id'))
        {
            if(empty($_FILES["file"]["name"][0]))
                        {
                             if(sizeof($ing->archivo) > 0)
                             {
                                 $file_name=$ing->archivo;	
                             }else{
                                 $file_name="";	
                             }
                        }else
                        {
//                            echo $_FILES["file"]["name"][0]."<br>";
//                            echo $_FILES["file"]["name"][1];exit();
                            $filesCount = count($_FILES['file']['name']);
                            for($i = 0; $i < $filesCount; $i++){
                            $error=NULL;	
                            $_FILES['file']['name'] = $_FILES['file']['name'][$i];
                            $_FILES['file']['type'] = $_FILES['file']['type'][$i];
                            $_FILES['file']['tmp_name'] = $_FILES['file']['tmp_name'][$i];
                            $_FILES['file']['error'] = $_FILES['file']['error'][$i];
                            $_FILES['file']['size'] = $_FILES['file']['size'][$i];

                             $config['upload_path'] = './'.$this->config->item('direccion_img');
                             $config['allowed_types'] = 'pdf|jpg|png|jpeg|gif|msg';
                             $config['max_size'] = '10240';
                             $config['encrypt_name'] = true; 
                             $this->load->library('upload', $config);
                             
                             
//                             if (!$this->upload->do_upload('file'))
//                             {
//                                $this->session->set_flashdata('ControllerMessage', 'Error de archivo1, no puede tener un tamaño mayor a 1 Megabyte (MB).');
//                                $this->session->set_flashdata('css',"danger");                                   
//                                $error = array('error' => $this->upload->display_errors());
//                                $this->session->set_flashdata('mensaje', $error["error"]);
//                                $this->session->set_flashdata('css',"danger");
//                                redirect(base_url().'grupos/index',  301);
//                             }
                            $this->upload->initialize($config);
                            if($this->upload->do_upload('file')){
                            $fileData = $this->upload->data();
                            $uploadData[$i]['file_name'] = $fileData['file_name'];
                            $uploadData[$i]['created'] = date("Y-m-d H:i:s");
                            $uploadData[$i]['modified'] = date("Y-m-d H:i:s");
                            }

                            // $ima = $this->upload->data();
                           //  unlink('./'.$this->config->item('direccion_img').$archivo_a_borrar_trazado);                             
                             $file_name = $ima['file_name'];
                             
                            } 
                             $datos_archivo_grupo=array
                           (
                               "id_grupo"=>$this->input->post("id_grupo",true),
                               "archivo"=>$file_name,
                               "archivo2"=>$file_name2,
                               "fecha"=>date('Y-m-d'),                        
                           );
                         //  print_r($datos_archivo_grupo);exit();
                             //$this->cotizaciones_model->insertarArchivosGrupos($datos_archivo_grupo);
                             $this->session->set_flashdata('ControllerMessage', 'Imagen cargada con exito'.$file_name.'');
                             $this->session->set_flashdata('css',"success");
                             redirect(base_url().'grupos/index',  301);
                }
                
            
            
           if( $this->session->userdata('perfil')==2){redirect(base_url().'index/no_acceso',  301); }
           $datos= $this->grupos_model->getGrupos();
           $this->layout->view('index',compact('datos')); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
        
	}
        
        function index(){
        if($this->session->userdata('id'))
        {
        $data = array();
        if(!empty($_FILES['userFiles']['name'])){
            $filesCount = count($_FILES['userFiles']['name']);
            for($i = 0; $i < $filesCount; $i++){
                $_FILES['userFile']['name'] = $_FILES['userFiles']['name'][$i];
                $_FILES['userFile']['type'] = $_FILES['userFiles']['type'][$i];
                $_FILES['userFile']['tmp_name'] = $_FILES['userFiles']['tmp_name'][$i];
                $_FILES['userFile']['error'] = $_FILES['userFiles']['error'][$i];
                $_FILES['userFile']['size'] = $_FILES['userFiles']['size'][$i];
                $uploadPath = 'uploads/files/';
                $config['upload_path'] = './'.$this->config->item('direccion_img');
                $config['allowed_types'] = 'pdf|jpg|png|jpeg|gif|msg';
                $config['max_size'] = '10240';

                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if($this->upload->do_upload('userFile')){
                    $fileData = $this->upload->data();
                    $uploadData[$i]['file_name'] = $fileData['file_name'];
                    $uploadData[$i]['created'] = date("Y-m-d H:i:s");
                    $uploadData[$i]['modified'] = date("Y-m-d H:i:s");
                
                    $filename[$i]= $fileData['file_name'];
                }
            }
            $id = $this->input->post("id_grupo",true);
            if(!empty($uploadData)){
                if($filename[0]!="" || $filename[1]!=""){
                    $datos_archivo_grupo=array
                           (
                               "id_grupo"=>$this->input->post("id_grupo",true),
                               "archivo"=>$filename[0],
                               "archivo2"=>$filename[1],
                               "fecha"=>date('Y-m-d'),                        
                           );
                }
                //Insert file information into the database
                $dataa = $this->cotizaciones_model->getArchivoCotizacionGrupalPorId($id);
                if(sizeof($dataa)>0){    
                $update = $this->cotizaciones_model->UpdateArchivoCotizacionGrupalPorId($datos_archivo_grupo,$id);    
                $this->session->set_flashdata('ControllerMessage', 'Imagen cargada y actualizada con exito'.$file_name.'');
                }else{
                $insert = $this->cotizaciones_model->insertarArchivosGrupos($datos_archivo_grupo);
                $this->session->set_flashdata('ControllerMessage', 'Imagen cargada con exito'.$file_name.'');
                }
                $this->session->set_flashdata('css',"success");
                redirect(base_url().'grupos/index',  301);
            }
        }
        //Get files data from database
        
        //Pass the files data to view
        if( $this->session->userdata('perfil')==2){redirect(base_url().'index/no_acceso',  301); }
           $datos= $this->grupos_model->getGrupos();
           $this->layout->view('index',compact('datos')); 
        }
        else
        {
            redirect(base_url().'usuarios/login',  301);
        }
        }
        
        
        function galeria(){
        if($this->session->userdata('id'))
        {
         $this->load->library('javascript');
         $this->load->library('javascript', array('js_library_driver' => 'scripto', 'autoload' => FALSE));
         $this->layout->setLayout('template_ajax');
        if( $this->session->userdata('perfil')==2){redirect(base_url().'index/no_acceso',  301); }
           $id = $this->input->post("id_grupo",true);
           $datos= $this->grupos_model->getGrupos();
           $this->layout->view('galeria',compact('datos','id')); 
        }
        else
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
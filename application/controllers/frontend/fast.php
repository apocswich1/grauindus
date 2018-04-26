<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Fast extends CI_Controller {


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
          
            if($this->uri->segment(3))
            {
                $pagina=$this->uri->segment(3);
            }else
            {
               $pagina=0;
            }
            $porpagina=10;
        $datos=$this->fast_track_model->getFastTrackPaginacion($pagina,$porpagina,"limit");
        $cuantos=$this->fast_track_model->getFastTrackPaginacion($pagina,$porpagina,"cuantos");
        
        $config['base_url'] = base_url().'fast/index';
            $config['total_rows'] = $cuantos;
            $config['per_page'] = $porpagina;
            $config['uri_segment'] = '3';
            $config['num_links'] = '4';
            $config['first_link'] = 'Primero';
            $config['next_link'] = 'Siguiente';
            $config['prev_link'] = 'Anterior';
            $config['last_link'] = 'Ultimo';
            $config['full_tag_open'] = '<ul class="pagination">';
            $config['full_tag_close'] = '</ul>';
            $config['first_tag_open'] = '<li>';
            $config['first_tag_close'] = '</li>';
            $config['last_tag_open'] = '<li>';
            $config['last_tag_close'] = '</li>';
            $config['next_tag_open'] = '<li>';
            $config['next_tag_close'] = '</li>';
            $config['prev_tag_open'] = '<li>';
            $config['prev_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li><a><b>';
            $config['cur_tag_close'] = '</b></a></li>';
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            $this->pagination->initialize($config);
            
            $this->layout->view('index',compact('datos','cuantos','pagina')); 
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
			$this->clientes_model->deleteFormaDePago($id);
			$this->session->set_flashdata('ControllerMessage', 'Se ha eliminado el registro seleccionado.');
			redirect(base_url().'formas_pago',  301); 			
		}
	}	
	
    public function add()
    {
          if($this->session->userdata('id'))
        {
            $procesos=$this->procesos_model->getProcesos();
            if ( $this->input->post() )
 		         {
 		              if ( $this->form_validation->run('add_fast_track') )
    			         {
			                /*
                            $a=array();
                            for($j=0;$j<sizeof($procesos);$j++)
                            {
                                if(isset($_POST["name_".$j]))
                                 {
                                    $a[]=$_POST["name_".$j];
                                 }    
                            }
                            if(sizeof($a)==0)
                            {
                                $this->session->set_flashdata('ControllerMessage', 'Debe seleccionar al menos un proceso.');
					           redirect(base_url().'fast/add',  301);
                            }
                            */
                             $data=array
                             (
                                "id_usuario"=>$this->session->userdata('id'),
                                "cliente"=>$this->input->post("cliente",true),
                                "cantidad"=>$this->input->post("cantidad",true),
                                "materiales_cliente"=>$this->input->post("materiales",true),
                                "quien_solicita"=>$this->input->post("quien_solicita",true),
                                "quien_autoriza"=>$this->input->post("quien_autoriza",true),
                                "quien_externo"=>$this->input->post("quien_externo",true),
                                "fecha"=>date("Y-m-d"),
                                "contacto"=>$this->input->post("contacto",true),
                                "descripcion"=>$this->input->post("des",true),
                                "contacto_empresa_ejecutante"=>$this->input->post("contacto_empresa_ejecutante",true),
                             );
                              $guardar=$this->fast_track_model->insertar($data);
                              /*
                              for($i=0;$i<sizeof($procesos);$i++)
                              {
                                 if(isset($_POST["name_".$i]))
                                 {
                                     $data2=array
                                     (
                                        "id_fast_track"=>$guardar,
                                        "id_proceso"=>$_POST["name_".$i],
                                     );
                                     $this->db->insert("fast_track_procesos",$data2);
                                 }
                              }
                              */
                               $data2=array
                                     (
                                        "id_fast_track"=>$guardar,
                                        "id_proceso"=>$this->input->post("procesos",true),
                                     );
                                     $this->db->insert("fast_track_procesos",$data2);
                              
                              $this->session->set_flashdata('ControllerMessage', 'Se ha agregado el registro exitosamente.');
					           redirect(base_url().'fast',  301); 
    			         }
                }
            $this->layout->css
            (
                array
                (
                    base_url()."public/frontend/css/prism.css",
                    base_url()."public/frontend/css/chosen.css",
                )
            ); 
            $this->layout->js
            (
                array
                (
                    base_url().'public/backend/js/tiny_mce/tiny_mce.js',
                   
                )
            ); 
           $this->layout->view('add',compact('procesos')); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
    }
    public function edit($id=null,$pagina=null)
    {
         if($this->session->userdata('id'))
        { 
            if( $this->session->userdata('perfil')==2){redirect(base_url().'index/no_acceso',  301); }
            if(!$id){show_404();}
            $datos=$this->fast_track_model->getFastTrackPorId($id);
            $procesos=$this->procesos_model->getProcesos();
            if(sizeof($datos)==0){show_404();}
            if ( $this->input->post() )
 		         {
 		              if ( $this->form_validation->run('add_fast_track') )
    			         {
    			            
                             $data=array
                             (
                                "id_usuario"=>$this->session->userdata('id'),
                                "cliente"=>$this->input->post("cliente",true),
                                "cantidad"=>$this->input->post("cantidad",true),
                                "materiales_cliente"=>$this->input->post("materiales",true),
                                "quien_solicita"=>$this->input->post("quien_solicita",true),
                                "quien_autoriza"=>$this->session->userdata('id'),
                                "quien_externo"=>$this->input->post("quien_externo",true),
                                "contacto"=>$this->input->post("contacto",true),
                                "descripcion"=>$this->input->post("des",true),
                                "estado"=>$this->input->post("estado",true),
                                "contacto_empresa_ejecutante"=>$this->input->post("contacto_empresa_ejecutante",true),
                             );
                           $this->fast_track_model->update($data,$this->input->post("id",true));
                           $this->fast_track_model->deleteProcesosFastTrackPorId($this->input->post("id",true)); 
                           /*
                           for($i=0;$i<sizeof($procesos);$i++)
                              {
                                 if(isset($_POST["name_".$i]))
                                 {
                                     $data2=array
                                     (
                                        "id_fast_track"=>$this->input->post("id",true),
                                        "id_proceso"=>$_POST["name_".$i],
                                     );
                                     $this->db->insert("fast_track_procesos",$data2);
                                 }
                              }
                             */
                             $data2=array
                                     (
                                        "id_fast_track"=>$this->input->post("id",true),
                                        "id_proceso"=>$this->input->post("procesos",true),
                                     );
                                     $this->db->insert("fast_track_procesos",$data2); 
                              
                              $this->session->set_flashdata('ControllerMessage', 'Se ha editado el registro exitosamente.');
	                          redirect(base_url().'fast/index/'.$this->input->post("pagina"),  301); 
    			         }
                }
            $this->layout->css
            (
                array
                (
                    base_url()."public/frontend/css/prism.css",
                    base_url()."public/frontend/css/chosen.css",
                )
            ); 
             
            $this->layout->js
            (
                array
                (
                    base_url().'public/backend/js/tiny_mce/tiny_mce.js',
                   
                )
            ); 
            $this->layout->view('edit',compact('datos','id','pagina','procesos')); 
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
    }
    public function imprimir($id=null)
    {
        if($this->session->userdata('id'))
        { 
            if(!$id){show_404();}
            $datos=$this->fast_track_model->getFastTrackPorId($id);
            if(sizeof($datos)==0){show_404();}
            if($datos->estado==0){show_404();}
            $procesos=$this->fast_track_model->getProcesosPorFastTrack($id);
            $cliente=$this->clientes_model->getClientePorId($datos->cliente);
            $quien_solicita=$this->clientes_model->getClientePorId($datos->quien_solicita);
            $que_cliente=$this->clientes_model->getClientePorId($datos->quien_externo);
            $quien_autoriza=$this->usuarios_model->getUsuariosPorId($datos->quien_autoriza);
            $fecha=fecha(date("Y-m-d"));
    		$cuerpo='';
            /*
            $cuerpo.='<h1>Fast track N°'.$id.'</h1>';
            $cuerpo.='<p>Impreso el día '.$fecha.'</p>';
            $cuerpo.='<h2>Datos Generales</h2>';
            $cuerpo.='<ul>
                        <li>Cliente : '.$cliente->razon_social.'</li>
                        <li>Contacto de empresa solicitante : '.$datos->contacto.'</li>
                        <li>Cantidad : '.$datos->cantidad.'</li>
                        <li>Material Cliente : '.$datos->materiales_cliente.'</li>
                        <li>Empresa ejecutante : '.$quien_solicita->razon_social.'</li>
                        <li>Quién Autoriza : '.$quien_autoriza->nombre.'</li>
                        <li>Qué cliente externo es : '.$que_cliente->razon_social.'</li>
                        <li>Descripción : '.$datos->descripcion.'</li>
                    </ul>';
            $cuerpo.='<h2>Procesos</h2><hr />';
            $cuerpo.='<ul>';
            foreach($procesos as $proceso)
            {
                $cuerpo.='<li>'.$proceso->nombre.' ('.$proceso->descripcion.') - Precio : $'.number_format($proceso->precio,0,'','.').'</li>';
            }
            $cuerpo.='</ul>';
            */
			
			
			if ($datos->estado == 0)
			{
				
				$estado = 'Pendiente';
			}
			
			if ($datos->estado == 1)
			{
				
				$estado = 'Liberada';
			}
			//class="borde"
            $cuerpo.=
            '
             <table >
            <tr>
                <td id="td_header_titulo">
                    '.$cliente->razon_social.'
                </td>
                <td id="td_header_separador">
                    &nbsp;
                </td>
                <td id="td_header_numero">
                    <div class="borde_chico">
                          <strong>Fast Track</strong>
                        <br />
                        N° '.$id.'
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="2">&nbsp;</td>
                <td colspan="2"><strong>Estado :'.$estado.'</strong></td>
                
            </tr>
			<tr>
                <td colspan="2">&nbsp;</td>
                <td colspan="2"><strong>Liberado :'.fecha($datos->fecha).'</strong></td>
            </tr>
            <tr>
                <td>
                    <strong>Cliente Solicitante:</strong>
                </td>
                <td>&nbsp;</td>
                <td>
                    <strong>'.$cliente->razon_social.'</strong>
                </td>
            </tr>
            <tr>
                <td>
                    <strong>Contacto:</strong>
                </td>
                <td>&nbsp;</td>
                <td>
                    <strong>'.$datos->contacto.'</strong>
                </td>
            </tr>
            <tr>
                <td colspan="3" class="br_chico">&nbsp;</td>
            </tr>
            <tr>
                <td>
                    <strong>Ejecutante:</strong>
                </td>
                <td>&nbsp;</td>
                <td>
                    <strong>'.$quien_solicita->razon_social.'</strong>
                </td>
            </tr>
            <tr>
                <td>
                    <strong>Contacto:</strong>
                </td>
                <td>&nbsp;</td>
                <td>
                    <strong>'.$datos->contacto_empresa_ejecutante.'</strong>
                </td>
            </tr>
            <tr>
                <td colspan="3" class="br_chico">&nbsp;</td>
            </tr>
            <tr>
                <td>
                    <strong>Cantidad:</strong>
                </td>
                <td>
                    <strong>'.number_format($datos->cantidad,0,'','.').'</strong>
                </td>
                <td>
                   <strong> Material Cliente:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SI</strong>
                </td>
            </tr>
            <tr>
                <td colspan="3" class="br_chico">&nbsp;</td>
            </tr>
            ';
            foreach($procesos as $proceso)
            {
               
            $cuerpo.='
            <tr>
                <td>
                    <strong>Proceso:</strong>
                </td>
                <td>
                    <strong>'.$proceso->nombre.' ('.$proceso->descripcion.') - Precio : $'.number_format($proceso->precio,0,'','.').'</strong>
                </td>
                <td>
                   &nbsp;
                </td>
            </tr>
            ';
            }
            $cuerpo.='
            <tr>
                <td colspan="3" class="br_chico">&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td colspan="2">
                    <div id="descripcion">
                        <strong>Descripción</strong>
                        <p>
                            '.$datos->descripcion.' 
                        </p>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="3" class="br">&nbsp;</td>
            </tr>
            <tr>
                <td>
                    <strong>Cliente Externo:</strong>
                </td>
                <td>&nbsp;</td>
                <td>
                    <strong>'.$que_cliente->razon_social.'</strong>
                </td>
            </tr>
            <tr>
                <td>
                    <strong>Quién Autoriza:</strong>
                </td>
                <td>&nbsp;</td>
                <td>
                    <strong>'.$quien_autoriza->nombre.'</strong>
                </td>
            </tr>
             <tr>
                <td colspan="3" class="br" style="text-align: right;">
                <hr />
                    <div>'.fecha($datos->fecha).'</div>
                </td>
            </tr>
        </table>
            ';
            $nombre="PDF Para Impresión fast Track ".$id." ".date("Y-m-d H:i:s").".pdf";
    		$mpdf=new mPDF('c'); 
            $mpdf->SetDisplayMode('fullpage');
            $stylesheet = file_get_contents(base_url().'public/frontend/css/fast.css');
            $mpdf->WriteHTML($stylesheet,1);
            $mpdf->WriteHTML($cuerpo);
    		$mpdf->Output($nombre,'I');
    		exit;
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
    }
	
	
	
	    public function autorizar($id=null)
    {
         if($this->session->userdata('id'))
        { 
            if( $this->session->userdata('perfil')==2){redirect(base_url().'index/no_acceso',  301); }
            if(!$id){show_404();}
			
           
           //if(sizeof($datos)==0){show_404();}
           // if ( $this->input->post() )
 		        // {
 
    			            
                             $data=array
                             (
                                
                                "quien_autoriza"=>$this->session->userdata('id'),
                                "estado"=>1,
                                
                             );
							 
							 
                              $this->fast_track_model->update($data,$id);
                           
                              
                              $this->session->set_flashdata('ControllerMessage', 'El registro fue autorizado exitosamente.');
	                          redirect(base_url().'fast/index/'); 
    			         
               // }
            $this->layout->css
            (
                array
                (
                    base_url()."public/frontend/css/prism.css",
                    base_url()."public/frontend/css/chosen.css",
                )
            ); 
             
            $this->layout->js
            (
                array
                (
                    base_url().'public/backend/js/tiny_mce/tiny_mce.js',
                   
                )
            ); 
            
        }else
        {
            redirect(base_url().'usuarios/login',  301);
        }
		//redirect(base_url().'fast/index/'); 
    }
    
}


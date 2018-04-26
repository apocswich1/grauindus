<?php

class fast_track_model extends CI_Model{

	

	function __construct()
	{
		// Llamando al contructor del Modelo
		parent::__construct();
	}
   public function getFastTrackPaginacion($pagina,$porpagina,$quehago)
    {
         switch($quehago)
        {
            case 'limit':
                $query=$this->db
                ->select("id,id_usuario,cliente,cantidad,materiales_cliente,quien_solicita,quien_autoriza,fecha,quien_externo,contacto,descripcion,estado")
                ->from("fast_track")
                ->order_by("id","desc")
                ->limit($porpagina,$pagina)
                ->get();
                return $query->result();
            break;
            case 'cuantos':
              $query=$this->db
                ->select("id,id_usuario,cliente,cantidad,materiales_cliente,quien_solicita,quien_autoriza,fecha")
                ->from("fast_track")
                ->count_all_results();
                return $query;
            break;
        }
    }
    public function getFastTrackProduccionPaginacion($pagina,$porpagina,$quehago)
    {
         switch($quehago)
        {
            case 'limit':
                $query=$this->db
                ->select("id,id_usuario,cliente,cantidad,materiales_cliente,quien_solicita,quien_autoriza,fecha,quien_externo,contacto,descripcion,estado")
                ->from("fast_track")
                ->where(array("estado"=>"1"))
                ->order_by("id","asc")
                ->limit($porpagina,$pagina)
                ->get();
                return $query->result();
            break;
            case 'cuantos':
              $query=$this->db
                ->select("id,id_usuario,cliente,cantidad,materiales_cliente,quien_solicita,quien_autoriza,fecha")
                ->from("fast_track")
                ->where(array("estado"=>"1"))
                ->count_all_results();
                return $query;
            break;
        }
    }
   
    public function getFastTrackPorId($id)
    {
          $query=$this->db
                ->select("id,id_usuario,cliente,cantidad,materiales_cliente,quien_solicita,quien_autoriza,fecha,quien_externo,contacto,descripcion,estado,contacto_empresa_ejecutante")
                ->from("fast_track")
                ->where(array("id"=>$id))
                ->get();
                //echo $this->db->last_query();exit;
                return $query->row();
    }
    
      
     public function insertar($data=array())
    {
       //  array $datos = ("nombre_procesp"->$data['proceso']);
 
     //  $this->db->query("insert into procesosespeciales(nombre_procesp) values($data)");
         $this->db->insert("fast_track",$data);
        return $this->db->insert_id();
        
    }
    
    public function update($data=array(),$id)
    {
         $this->db->where('id', $id);
         $this->db->update("fast_track",$data);
        return true;
    }
    
    public function delete($id)
    {
	   	$this->db->where('id', $id);
	    $this->db->delete('fast_track');
    }
    /**
     * procesos
     * */
     public function getProcesosPorFastTrack($id)
     {
         $query=$this->db
                ->select("f.id,f.id_fast_track,f.id_proceso,p.nombre,p.precio,p.descripcion")
                ->from("fast_track_procesos as f")
                ->join("procesos as p","p.id=f.id_proceso","inner")
                ->where(array("f.id_fast_track"=>$id))
                ->get();
                //echo $this->db->last_query();exit;
                return $query->result();
     }
	 
	 public function getProcesosPorFastTrackFotomecanica($id)
     {
         $query=$this->db
                ->select("f.id,f.id_fast_track,f.id_proceso,p.nombre,p.precio,p.descripcion,cli.razon_social,ft.fecha,ft.contacto,ft.estado,ft.descripcion")
                ->from("fast_track_procesos as f")
                ->join("procesos as p","p.id=f.id_proceso","inner")
				->join("fast_track as ft","ft.id=f.id_fast_track","inner")
				->join("clientes as cli","cli.id=ft.cliente","inner")				
				//->join("procesos_tipo as pti","pti.procesos_tipo=p.nombre","inner")				
                ->where(array("p.nombre"=>$id))
                ->get();
               // echo $this->db->last_query();exit;
                return $query->result();
     }
	 
	 	 public function getProcesosPorFastTrackSegunProcesos($id,$filtro)
     {
		 
				$sql="
				SELECT pf.id, p.nombre FROM fast_track_procesos as pf
				INNER JOIN procesos as p ON p.id = pf.id_proceso
				INNER JOIN procesos_tipo as pt ON pt.procesos_tipo = p.nombre
				where pf.id_fast_track = ".$id." and p.nombre = '".$filtro."'
				";
						
           $query=$this->db->query($sql);
		   return $query->result();
  
     }
	 
      public function existeProcesoEnFasttrack($id_proceso,$id_fast_track)
     {
         $query=$this->db
                ->select("id")
                ->from("fast_track_procesos")
                ->where(array("id_proceso"=>$id_proceso,"id_fast_track"=>$id_fast_track))
                ->get();
                //echo $this->db->last_query()."<br>";
                return $query->row();
     }
    public function deleteProcesosFastTrackPorId($id)
    {
	   	$this->db->where('id_fast_track', $id);
	    $this->db->delete('fast_track_procesos');
    }
   
}
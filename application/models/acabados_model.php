<?php

class acabados_model extends CI_Model{

	

	function __construct()
	{
		// Llamando al contructor del Modelo
		parent::__construct();
	}
   public function getAcabadosPaginacion($pagina,$porpagina,$quehago)
    {
         switch($quehago)
        {
            case 'limit':
                $query=$this->db
                ->select("a.id,a.proveedor_1,a.proveedor_2,a.codigo,a.caracteristicas,a.tipo,a.unidad_de_compra,a.unidad_de_venta, a.valor_venta,a.fecha_cotizacion,uv.unidad_uso as unv,uc.unidad_uso as unc,a.quien,a.cuando,a.costo_compra")
                ->from("acabados2 as a")
                ->join("unidades_de_uso as uv","uv.id=a.unidad_de_venta","inner")
                ->join("unidades_de_uso as uc","uc.id=a.unidad_de_compra","inner")
                ->order_by("a.id","desc")
                ->limit($porpagina,$pagina)
                ->get();
                return $query->result();
            break;
            case 'cuantos':
              $query=$this->db
              ->select("a.id,a.proveedor_1,a.proveedor_2,a.codigo,a.caracteristicas,a.tipo,a.unidad_de_compra,a.unidad_de_venta, a.valor_venta,a.fecha_cotizacion,uv.unidad_uso as unv,uc.unidad_uso as unc")
                ->from("acabados2 as a")
                ->join("unidades_de_uso as uv","uv.id=a.unidad_de_venta","inner")
                ->join("unidades_de_uso as uc","uc.id=a.unidad_de_compra","inner")
                ->count_all_results();
                return $query;
            break;
        }
    }
    
    public function getAcabadosSearchPaginacion($pagina,$porpagina,$quehago,$buscar)
    {
         switch($quehago)
        {
            case 'limit':
                $query=$this->db
                ->select("a.id,a.proveedor_1,a.proveedor_2,a.codigo,a.caracteristicas,a.tipo,a.unidad_de_compra,a.unidad_de_venta, a.valor_venta,a.fecha_cotizacion,uv.unidad_uso as unv,uc.unidad_uso as unc,a.quien,a.cuando,a.costo_compra")
                ->from("acabados2 as a")
                ->join("unidades_de_uso as uv","uv.id=a.unidad_de_venta","inner")
                ->join("unidades_de_uso as uc","uc.id=a.unidad_de_compra","inner")
                ->like('upper(a.caracteristicas)', strtoupper($buscar), 'both')
                ->or_like('upper(a.codigo)', strtoupper($buscar), 'both')
                ->order_by("a.id","desc")
                ->limit($porpagina,$pagina)
                ->get();
//                echo $this->db->last_query();
                
                return $query->result();
            break;
            case 'cuantos':
              $query=$this->db
                ->select("a.id,a.proveedor_1,a.proveedor_2,a.codigo,a.caracteristicas,a.tipo,a.unidad_de_compra,a.unidad_de_venta, a.valor_venta,a.fecha_cotizacion,uv.unidad_uso as unv,uc.unidad_uso as unc,a.quien,a.cuando,a.costo_compra")
                ->from("acabados2 as a")
                ->join("unidades_de_uso as uv","uv.id=a.unidad_de_venta","inner")
                ->join("unidades_de_uso as uc","uc.id=a.unidad_de_compra","inner")
                ->like('upper(a.caracteristicas)', strtoupper($buscar), 'both')
                ->or_like('upper(a.codigo)', strtoupper($buscar), 'both')
                ->count_all_results();
                return $query;
            break;
        }
    }    
    
	public function getMoldes()
	{
	  $this->load->database();
  
        
                $query=$this->db
                ->select("*")
                ->from("moldes_grau")
                ->order_by("nombremolde","asc")
                ->get();
                return $query;
	}

    public function getAcabados()
    {
        $this->load->database();
  
        
                $query=$this->db
                ->select("*")
                ->from("acabados")
                ->order_by("nombre_acabado","asc")
                ->get();
                return $query;
        
    }
public function getAcabados2PorTipo($tipo)
    {
        $this->load->database();
  
        
                $query=$this->db
                ->select("a.id,a.proveedor_1,a.proveedor_2,a.codigo,a.caracteristicas,a.tipo,a.unidad_de_compra,a.unidad_de_venta, a.valor_venta,a.fecha_cotizacion,uv.unidad_uso as unv,uc.unidad_uso as unc,a.costo_compra")
                ->from("acabados2 as a")
                ->join("unidades_de_uso as uv","uv.id=a.unidad_de_venta","inner")
                ->join("unidades_de_uso as uc","uc.id=a.unidad_de_compra","inner")
                ->where(array("a.tipo"=>$tipo,"a.estado"=>"0"))
                ->get();
//                echo $this->db->last_query();exit;                
                return $query->result();
        
    }
    public function getAcabadosPorId($id)
    {
          $query=$this->db
                ->select("a.id,a.proveedor_1,a.proveedor_2,a.codigo,a.caracteristicas,a.tipo,a.unidad_de_compra,a.unidad_de_venta, a.valor_venta,a.fecha_cotizacion,uv.unidad_uso as unv,uc.unidad_uso as unc,a.estado,a.costo_compra,a.costo_fijo,a.procesos_especiales")
                ->from("acabados2 as a")
                ->join("unidades_de_uso as uv","uv.id=a.unidad_de_venta","inner")
                ->join("unidades_de_uso as uc","uc.id=a.unidad_de_compra","inner")
                ->where(array("a.id"=>$id))
                ->get();
         // echo $this->db->last_query();exit;
                return $query->row();
    }
    
    public function getAcabadosInternosPrecioPorNombre($id)
    {
          $query=$this->db
                ->select("a.id,a.proveedor_1,a.proveedor_2,a.codigo,a.caracteristicas,a.tipo,a.unidad_de_compra,a.unidad_de_venta, a.valor_venta,a.fecha_cotizacion,uv.unidad_uso as unv,uc.unidad_uso as unc,a.estado,a.costo_compra,a.costo_fijo")
                ->from("acabados2 as a")
                ->join("unidades_de_uso as uv","uv.id=a.unidad_de_venta","inner")
                ->join("unidades_de_uso as uc","uc.id=a.unidad_de_compra","inner")
                ->where(array("a.id"=>$id))
                ->get();
          //echo $this->db->last_query();exit;
                return $query->row();
    }
        
        public function getAcabadosInternos()
    {
          $sql="select * from acabados where categoria_acabado = 'Interno'";
           $query = $this->db->query($sql);
                //->select("nombre_acabado")
               // ->from("acabados")
                //->where("categoria_acabado = 'Interno'")
                //>get();
 
    
                return $query;
    }
    
    
        public function getAcabadosExternos()
    {
             $sql="select * from acabados where categoria_acabado = 'Externo'";
             $query = $this->db->query($sql);

                return $query;
    }
    
     public function insertar($data=array())
    {
       //  array $datos = ("nombre_procesp"->$data['proceso']);
 
     //  $this->db->query("insert into procesosespeciales(nombre_procesp) values($data)");
         $this->db->insert("acabados",$data);
        return true;
        
    }
    
    public function update($data=array(),$id)
    {
         $this->db->where('id_acabado', $id);
         $this->db->update("acabados",$data);
        return true;
    }
    
    public function delete($id)
    {
	   try{
	   
			$this->db->where('id_acabado', $id);
			$this->db->delete('acabados');
		}
		catch(Exception $e)
		{
			return false;
		}
        return true;
    }
    
    public function getAcabadoPorIdImprenta($id)
    {
       $query=$this->db
                ->select("*")
                ->from("acabados2")
                ->where(array("id"=>$id))
                ->get();
                //echo $this->db->last_query();exit;
                return $query->row();
    }    
    
     public function insertar_ordenes_compras_trabajos_externos($data=array())
    {
         $this->db->insert("ordenes_compras_trabajos_externos",$data);
        return true;
        
    }
    
    public function update_ordenes_compras_trabajos_externos($data=array(),$id)
    {
         $this->db->where('id_cotizacion', $id);
         $this->db->update("ordenes_compras_trabajos_externos",$data);
        return true;
    }    
    
    public function get_ordenes_compras_trabajos_externos($id_cotizacion)
    {
       $query=$this->db
                ->select("*")
                ->from("ordenes_compras_trabajos_externos")
                ->where(array("id_cotizacion"=>$id_cotizacion))
                ->get();
//                echo $this->db->last_query();exit;
                return $query->row();
    }      
    
    public function getAcabadosPorId2($id)
    {
          $query=$this->db
                ->select("a.id,a.proveedor_1,a.proveedor_2,a.codigo,a.caracteristicas,a.tipo,a.unidad_de_compra,a.unidad_de_venta, a.valor_venta,a.fecha_cotizacion,uv.unidad_uso as unv,uc.unidad_uso as unc,a.estado,a.costo_compra,a.costo_fijo")
                ->from("acabados2 as a")
                ->join("unidades_de_uso as uv","uv.id=a.unidad_de_venta","inner")
                ->join("unidades_de_uso as uc","uc.id=a.unidad_de_compra","inner")
                ->where(array("a.id"=>$id))
                ->get();
//                echo $this->db->last_query();exit;
                $array=$query->row();
                return $array->unv;  
    }//  

        public function getAcabadosPorId3($id)
    {
          $query=$this->db
                ->select("a.id,a.proveedor_1,a.proveedor_2,a.codigo,a.caracteristicas,a.tipo,a.unidad_de_compra,a.unidad_de_venta, a.valor_venta,a.fecha_cotizacion,uv.unidad_uso as unv,uc.unidad_uso as unc,a.estado,a.costo_compra,a.costo_fijo")
                ->from("acabados2 as a")
                ->join("unidades_de_uso as uv","uv.id=a.unidad_de_venta","inner")
                ->join("unidades_de_uso as uc","uc.id=a.unidad_de_compra","inner")
                ->where(array("a.id"=>$id))
                ->get();
//                echo $this->db->last_query();exit;
                $array=$query->row();
                return $array->caracteristicas;  
    }//   
    

  
   
}
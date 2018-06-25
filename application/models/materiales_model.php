<?php

class materiales_model extends CI_Model{

	

	function __construct()
	{
		// Llamando al contructor del Modelo
		parent::__construct();
	}
        
        
    public function getTridiaMaterialesSelect($descripcion,$codigo,$reverso,$gramaje)
    {
        $query=$this->db
                ->select("*")
                ->from("materiales")
                ->where(array("nombre"=>$descripcion,"codigo"=>$codigo, 'reverso' => $reverso, 'gramaje' => $gramaje))
                ->order_by("id","asc")
                ->get();
//                echo $this->db->last_query();exit;           
        
                return $query->row();
    }        
        
  
 public function getMaterialesPaginacion($pagina,$porpagina,$quehago)
    {
         switch($quehago)
        {
            case 'limit':
                $query=$this->db
                ->select("m.id,m.codigo,m.nombre,m.id_proveedor,m.reverso,m.id_materiales_procedencia,m.gramaje,m.ancho,m.ancho_de_pedido,p.nombre as proveedor,mt.materiales_tipo,m.precio,m.divisa,m.precio_pesos,m.unidad_de_compra,m.estado,m.quien,m.cuando")
                ->from("materiales as m")
                ->join("proveedores as p","p.id=m.id_proveedor","inner")
                ->join("materiales_tipo as mt","mt.id=m.tipo","inner")
                ->order_by("m.id","desc")
                ->limit($porpagina,$pagina)
                ->get();
                return $query->result();
            break;
            case 'cuantos':
              $query=$this->db
                ->select("m.id")
                ->from("materiales as m")
                ->join("proveedores as p","p.id=m.id_proveedor","inner")
                ->join("materiales_tipo as mt","mt.id=m.tipo","inner")
                ->count_all_results();
                return $query;
            break;
        }
    }
    public function getMaterialesSelect()
    {
        $query=$this->db
                ->select("m.id,m.codigo,m.nombre,m.id_proveedor,m.reverso,m.id_materiales_procedencia,m.gramaje,m.ancho,m.ancho_de_pedido,p.nombre as proveedor,mt.materiales_tipo,m.precio,m.divisa,m.precio_pesos,m.unidad_de_compra,m.estado")
                ->from("materiales as m")
                ->join("proveedores as p","p.id=m.id_proveedor","inner")
                ->join("materiales_tipo as mt","mt.id=m.tipo","inner")
                ->where(array("m.estado"=>1))
                ->order_by("m.nombre","asc")
                ->get();
//                echo $this->db->last_query();exit;           
                return $query->result();
    }
     public function getMaterialesPaginacionPorTipo($pagina,$porpagina,$quehago,$tipo)
    {
         switch($quehago)
        {
            case 'limit':
                $query=$this->db
                ->select("m.id,m.codigo,m.nombre,m.id_proveedor,m.reverso,m.id_materiales_procedencia,m.gramaje,m.ancho,m.ancho_de_pedido,m.precio_kilos,m.valor_en_dolares,p.nombre as proveedor,mt.materiales_tipo,m.estado")
                ->from("materiales as m")
                ->join("proveedores as p","p.id=m.id_proveedor","inner")
                ->join("materiales_tipo as mt","mt.id=m.tipo","inner")
                ->where(array("m.tipo"=>$tipo))
                ->order_by("m.id","desc")
                ->limit($porpagina,$pagina)
                ->get();
                return $query->result();
            break;
            case 'cuantos':
              $query=$this->db
                ->select("m.id")
                ->from("materiales as m")
                ->join("proveedores as p","p.id=m.id_proveedor","inner")
                ->join("materiales_tipo as mt","mt.id=m.tipo","inner")
                ->where(array("m.tipo"=>$tipo))
                ->count_all_results();
                return $query;
            break;
        }
    }
    public function getMaterialesPorTipoSelect($tipo)
    {
        $query=$this->db
                ->select("m.id,m.tipo,m.codigo,m.nombre,m.id_proveedor,m.reverso,m.id_materiales_procedencia,m.gramaje,m.ancho,m.ancho_de_pedido,p.nombre as proveedor,mt.materiales_tipo,m.precio,m.divisa,m.precio_pesos,m.unidad_de_compra,m.estado")
                ->from("materiales as m")
                ->join("proveedores as p","p.id=m.id_proveedor","inner")
                ->join("materiales_tipo as mt","mt.id=m.tipo","inner")
                ->where(array("m.tipo"=>$tipo,"m.estado"=>1))
                ->get();
                return $query->result();
    }
    public function getMaterialesPorId($id)
    {
        $query=$this->db
                ->select("m.id,m.tipo,m.codigo,m.nombre,m.id_proveedor,m.reverso,m.id_materiales_procedencia,m.gramaje,m.ancho,m.ancho_de_pedido,p.nombre as proveedor,mt.materiales_tipo,m.precio,m.divisa,m.precio_pesos,m.unidad_de_compra,m.estado")
                ->from("materiales as m")
                ->join("proveedores as p","p.id=m.id_proveedor","inner")
                ->join("materiales_tipo as mt","mt.id=m.tipo","inner")
                ->where(array("m.id"=>$id))
                ->get();
//        echo $this->db->last_query();
                return $query->row();
    }
     public function getMaterialesPorNombre2($id)
    {
        $query=$this->db
                ->select("m.id,m.tipo,m.codigo,m.nombre,m.id_proveedor,m.reverso,m.id_materiales_procedencia,m.gramaje,m.ancho,m.ancho_de_pedido,p.nombre as proveedor,mt.materiales_tipo,m.precio,m.divisa,m.precio_pesos,m.unidad_de_compra,m.estado,m.fecha_ultima_actualizacion")
                ->from("materiales as m")
                ->join("proveedores as p","p.id=m.id_proveedor","inner")
                ->join("materiales_tipo as mt","mt.id=m.tipo","inner")
                //->where(array("m.nombre"=>$id))
                ->like("m.nombre",$id,'both')
                ->get();
              //  echo $this->db->last_query();        
                return $query->row();
    }
     public function getMaterialesPorNombre($id)
    {
        $query=$this->db
                ->select("m.id,m.tipo,m.codigo,m.nombre,m.id_proveedor,m.reverso,m.id_materiales_procedencia,m.gramaje,m.ancho,m.ancho_de_pedido,p.nombre as proveedor,mt.materiales_tipo,m.precio,m.divisa,m.precio_pesos,m.unidad_de_compra,m.estado,m.fecha_ultima_actualizacion")
                ->from("materiales as m")
                ->join("proveedores as p","p.id=m.id_proveedor","inner")
                ->join("materiales_tipo as mt","mt.id=m.tipo","inner")
                //->where(array("m.id"=>$id))
                ->like("m.nombre",$id,'both')
                ->get();
                //echo $this->db->last_query();    exit();    
                return $query->row();
    }
    
     public function getMaterialesPorNombre333($id)
    {
        $query=$this->db
                ->select("m.id,m.tipo,m.codigo,m.nombre,m.id_proveedor,m.reverso,m.id_materiales_procedencia,m.gramaje,m.ancho,m.ancho_de_pedido,p.nombre as proveedor,mt.materiales_tipo,m.precio,m.divisa,m.precio_pesos,m.unidad_de_compra,m.estado,m.fecha_ultima_actualizacion")
                ->from("materiales as m")
                ->join("proveedores as p","p.id=m.id_proveedor","inner")
                ->join("materiales_tipo as mt","mt.id=m.tipo","inner")
                ->where(array("m.nombre"=>$id))
                ->get();
//                echo $this->db->last_query();exit;        
                return $query->row();
    }    
    
     public function insertar($data=array())
    {
         $this->db->insert("materiales",$data);
        return true;
        
    }
    public function update($data=array(),$id)
    {
         $this->db->where('id', $id);
         $this->db->update("materiales",$data);
        return true;
    }
    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('materiales');
        return true;
    }
     public function getMaterialesTipo()
    {
         $query=$this->db
                ->select("id,materiales_tipo")
                ->from("materiales_tipo")
                ->get();
                return $query->result();
    }
	
	
     public function getMaterialesTipoPorId($id)
    {
         $query=$this->db
                ->select("id,materiales_tipo")
                ->from("materiales_tipo")
                ->where(array("id"=>$id))
                ->get();
                //echo $this->db->last_query();exit;
                return $query->row();
    }
    
    
     public function getMaterialesGramajePorId($id)
    {
         $query=$this->db
                ->select("gramaje")
                ->from("materiales")
                ->where(array("id"=>$id))
                ->get();
                //echo $this->db->last_query();exit;
                return $query->row();
    }

    
    /**
     * #################################################################
     * PROCEDENCIA
     * */
     public function getMaterialesProcedencia()
    {
         $query=$this->db
                ->select("id,procedencia")
                ->from("materiales_procedencia")
                ->get();
                return $query->result();
    }
      public function getMaterialesProcedenciaPorId($id)
    {
         $query=$this->db
                ->select("id,procedencia")
                ->from("materiales_procedencia")
                ->where(array("id"=>$id))
                ->get();
                return $query->row();
    }
     public function getMaterialesProcedenciaGramaje($id_procedencia)
    {
         $query=$this->db
                ->select("id,id_materiales_procedencia,gramaje")
                ->from("materiales_procedencia_gramaje")
                ->where(array("id_materiales_procedencia"=>$id_procedencia))
                ->get();
                return $query->result();
    }
      public function getMaterialesProcedenciaGramajePorId($id)
    {
         $query=$this->db
                ->select("id,id_materiales_procedencia,gramaje")
                ->from("materiales_procedencia_gramaje")
                ->where(array("id"=>$id))
                ->get();
                return $query->row();
    }
     public function insertarTipo($data=array())
    {
         $this->db->insert("materiales_tipo",$data);
        return $this->db->insert_id();
        
    }
	    public function getMaterialesSelectLiner() //Solo liner
    {
        /*$query=$this->db
                ->select("m.id,m.codigo,m.nombre,m.id_proveedor,m.reverso,m.id_materiales_procedencia,m.gramaje,m.ancho,m.ancho_de_pedido,p.nombre as proveedor,mt.materiales_tipo,m.precio,m.divisa,m.precio_pesos,m.unidad_de_compra,m.estado")
                ->from("materiales as m")
                ->join("proveedores as p","p.id=m.id_proveedor","inner")
                ->join("materiales_tipo as mt","mt.id=m.tipo","inner")
                ->where(array("m.estado"=>1, "m.tipo"=>5))
                ->order_by("m.nombre","asc")
                ->get();
                return $query->result();
			*/
$sql="select m.id,m.codigo,m.nombre,m.id_proveedor,m.reverso,m.id_materiales_procedencia,m.gramaje,m.ancho,m.ancho_de_pedido,p.nombre as proveedor,mt.materiales_tipo,m.precio,m.divisa,m.precio_pesos,m.unidad_de_compra,m.estado"
				." from materiales as m"
				." INNER JOIN proveedores as p ON p.id=m.id_proveedor"
				." INNER JOIN materiales_tipo as mt ON mt.id=m.tipo"
				." where m.estado = 1 and m.tipo=5 or m.tipo = 3 or m.tipo=1 or m.tipo= 4 or m.tipo=14 or m.tipo=15"
				." ORDER BY m.nombre asc";
				
				$query=$this->db->query($sql);
				return $query->result();			
				
    }
	    public function getMaterialesSelectOnda() //Solo onda
    {
        $query=$this->db
                ->select("m.id,m.codigo,m.nombre,m.id_proveedor,m.reverso,m.id_materiales_procedencia,m.gramaje,m.ancho,m.ancho_de_pedido,p.nombre as proveedor,mt.materiales_tipo,m.precio,m.divisa,m.precio_pesos,m.unidad_de_compra,m.estado")
                ->from("materiales as m")
                ->join("proveedores as p","p.id=m.id_proveedor","inner")
                ->join("materiales_tipo as mt","mt.id=m.tipo","inner")
                ->where(array("m.estado"=>1))
//                ->where(array("m.estado"=>1, "m.tipo"=>4)) // lo mando a quitar el sr enrique 17/07/2017               
                ->order_by("m.nombre","asc")
                ->get();
                //echo $this->db->last_query();
        
                return $query->result();
    }
	
		    public function getMaterialesSelectCartulina() //Solo cartulina
    {
    
				
				$sql="select m.id,m.codigo,m.nombre,m.id_proveedor,m.reverso,m.id_materiales_procedencia,m.gramaje,m.ancho,m.ancho_de_pedido,p.nombre as proveedor,mt.materiales_tipo,m.precio,m.divisa,m.precio_pesos,m.unidad_de_compra,m.estado"
				." from materiales as m"
				." INNER JOIN proveedores as p ON p.id=m.id_proveedor"
				." INNER JOIN materiales_tipo as mt ON mt.id=m.tipo"
				." where m.estado = 1"
				//." where m.estado = 1 and m.tipo=1 or m.tipo = 10 or m.tipo = 14 or m.tipo = 15 or m.tipo = 3 or m.tipo = 4"
				//." ORDER BY m.nombre asc";
				." ORDER BY m.gramaje asc";
				
				$query=$this->db->query($sql);
                                //echo $sql;exit;
				return $query->result();
				
    }
		    public function getMaterialesSelectCartulinaAudi($nombre) //Solo cartulina
    {
       			$sql="select * from (select m.id,m.codigo,m.nombre,m.id_proveedor,m.reverso,m.id_materiales_procedencia,m.gramaje,m.ancho,m.ancho_de_pedido,p.nombre as proveedor,mt.materiales_tipo,m.precio,m.divisa,m.precio_pesos,m.unidad_de_compra,m.estado"
				." from materiales as m"
				." INNER JOIN proveedores as p ON p.id=m.id_proveedor"
				." INNER JOIN materiales_tipo as mt ON mt.id=m.tipo"
				." where m.estado = 1 and m.tipo=1 or m.tipo = 10 or m.tipo = 14 or m.tipo = 15 or m.tipo = 3 or m.tipo = 4"
				." and m.nombre ='$nombre'"
				//." ORDER BY m.nombre asc";
				." ORDER BY m.gramaje asc) a where a.nombre='$nombre'";
				
				$query=$this->db->query($sql);
                               // echo $sql;
                                //echo $query->get();exit;
				return $query->row();
				
    }
	
	public function getMaterialesPaginacionPorSearch($pagina,$porpagina,$quehago,$valor)
    {
		switch($quehago)
        {
            case 'limit':
                $query=$this->db
                ->select("m.id,m.codigo,m.nombre,m.id_proveedor,m.reverso,m.id_materiales_procedencia,m.gramaje,m.ancho,m.ancho_de_pedido,p.nombre as proveedor,mt.materiales_tipo,m.precio,m.divisa,m.precio_pesos,m.unidad_de_compra,m.estado,m.quien,m.cuando")
                ->from("materiales as m")
                ->join("proveedores as p","p.id=m.id_proveedor","inner")
                ->join("materiales_tipo as mt","mt.id=m.tipo","inner")
					->like('m.nombre', $valor, 'both')
					->or_like('m.nombre', $valor, 'both')
					->or_like('m.nombre', $valor, 'both')
                ->order_by("m.id","desc")
                ->limit($porpagina,$pagina)
                ->get();
                return $query->result();
            break;
            case 'cuantos':
              $query=$this->db
                ->select("m.id")
                ->from("materiales as m")
                ->join("proveedores as p","p.id=m.id_proveedor","inner")
                ->join("materiales_tipo as mt","mt.id=m.tipo","inner")
					->like('m.nombre', $valor, 'both')
					->or_like('m.nombre', $valor, 'both')
					->or_like('m.nombre', $valor, 'both')
                ->count_all_results();
                return $query;
            break;
        }
		
    }
    
    public function getMaterialesGramajePorLike($valor)
    {
         $query=$this->db
                ->select("gramaje")
                ->from("materiales")
                ->like('codigo', $valor, 'both')                 
                ->get();
                //echo $this->db->last_query();exit;
                return $query->row();
    }    
    public function getMaterialesReversoPorNombre($valor)
    {
         $query=$this->db
                ->select("materiales.id as materialesid,materiales.*,t.materiales_tipo as tipomaterial")
                ->from("materiales")
                ->join("materiales_tipo as t","materiales.tipo=t.id","inner")
                ->like('codigo', $valor, 'both')                 
                ->or_like('nombre', $valor, 'both')                 
                ->get();
              //  echo $this->db->last_query();exit;
                return $query->row();
    }    
    public function getMaterialesReversoPorId($valor)
    {
         $query=$this->db
                ->select("materiales.id as materialesid,materiales.*,t.materiales_tipo as tipomaterial")
                ->from("materiales")
                ->join("materiales_tipo as t","materiales.tipo=t.id","inner")
                ->where('materiales.id', $valor)                 
                ->get();
                //echo $this->db->last_query();exit;
                return $query->row();
    }    
    
    public function getMaterialesNombreTipo($valor)
    {
         $query=$this->db
                ->select("materiales.id as materialesid,materiales.*,t.materiales_tipo as tipomaterial")
                ->from("materiales")
                ->join("materiales_tipo as t","materiales.tipo=t.id","inner")
                ->where('materiales.id', $valor, 'both')                 
                ->get();
               // echo $this->db->last_query();exit;
                return $query->row();
    }    
    
    public function getMaterialesNombrePorId($valor)
    {
         $query=$this->db
                ->select("materiales.nombre as nombre")
                ->from("materiales")
                ->where('materiales.id', $valor, 'both')                 
                ->get();
               // echo $this->db->last_query();
                return $query->row();
    }    
	

}
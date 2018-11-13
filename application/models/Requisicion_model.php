<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 */
class Requisicion_model extends CI_Model {
	
	public function __construct() {
		parent::__construct();
	}
	
	public function record_count($idusuario) {   		
        $this->db->order_by("requisicion.id","desc");	
		$this->db->select('requisicion.*, detalle_requisicion.folio')->from('requisicion')->join('detalle_requisicion','detalle_requisicion.requesicion_id = requisicion.id','inner')->group_by('requisicion.id')->where("requisicion.autor", $idusuario);
        $query = $this->db->get();
		if($query->num_rows() > 0)
		{
			return $query->num_rows();
		}else{
			return 0;
		}
    }

    public function record_count_adm() {   		
        $this->db->order_by("requisicion.id","desc");	
		$this->db->select('requisicion.*, detalle_requisicion.folio')->from('requisicion')->join('detalle_requisicion','detalle_requisicion.requesicion_id = requisicion.id','inner')->group_by('requisicion.id')->where("requisicion.estatus_req", 1);

		$query = $this->db->get(); 
		if($query->num_rows() > 0)
		{
			return $query->num_rows();
		}else{
			return 0;
		}
    }

    public function record_count_recent_adm(){    	
		$this->db->order_by("requisicion.id","desc");	
		$this->db->select('requisicion.*, detalle_requisicion.folio')->from('requisicion')->join('detalle_requisicion','detalle_requisicion.requesicion_id = requisicion.id','inner')->group_by('requisicion.id')->where("requisicion.estatus_req", 0);

		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			return $query->num_rows();
		}else{
			return 0;
		}	
    }

	public function detalle_requisicion($idreq){
				
		$this->db->where("requesicion_id",$idreq);
		$query = $this->db->get('detalle_requisicion');
		if($query->num_rows() > 0)
		{
			return $query->result();
		}		

	}
	public function requisicion_usuario($idusuario,$limit, $start){
		$this->db->limit($limit, $start);
		$this->db->order_by("requisicion.id","desc");	
		$this->db->select('requisicion.*, detalle_requisicion.folio')->from('requisicion')->join('detalle_requisicion','detalle_requisicion.requesicion_id = requisicion.id','inner')->group_by('requisicion.id')->where("requisicion.autor", $idusuario);

		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
	}

	public function requisicion_borrador($limit, $start){
		$this->db->limit($limit, $start);
		$this->db->order_by("requisicion.fecha_estatus","desc");	
		$this->db->select('requisicion.*, detalle_requisicion.folio')->from('requisicion')->join('detalle_requisicion','detalle_requisicion.requesicion_id = requisicion.id','inner')->group_by('requisicion.id')->where("requisicion.estatus_req", 1);

		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
	}

	public function requisicion_ultimas($limit, $start){

		$this->db->limit($limit, $start);
		$this->db->order_by("requisicion.id","desc");	
		$this->db->select('requisicion.*, detalle_requisicion.folio')->from('requisicion')->join('detalle_requisicion','detalle_requisicion.requesicion_id = requisicion.id','inner')->group_by('requisicion.id')->where("requisicion.estatus_req", 0);

		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
	}

	public function requisicion_id($idreq,$idusuario){
		$this->db->order_by("requisicion.id","desc");	
		$this->db->select('requisicion.*, detalle_requisicion.*')->from('requisicion')->join('detalle_requisicion','detalle_requisicion.requesicion_id = requisicion.id','inner')->where("requisicion.id", $idreq)->where("requisicion.autor", $idusuario);

		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
	}

	public function new_requisicion($id_user,$estatus=null)
	{
		$estatus = is_null($estatus) ? 1 : $estatus;
		date_default_timezone_set('America/Mexico_City');
		ini_alter('date.timezone','America/Mexico_City');
								
		$fecha 	= date('Y-m-d H:i:s');

		$data 	= array(
			'autor'			=>	$id_user,
			'fecha'			=>	$fecha,
			'estatus'		=>  $estatus
		);

		if($this->db->insert('requisicion',$data)){
			$insert_id = $this->db->insert_id();   			
		}else{
			$insert_id = NULL;
		}

		return  $insert_id;
	}
	
	public function update_status($id,$estatus=null){
		$estatus = is_null($estatus) ? 1 : $estatus;
		$data = array(		
			'estatus'		=>	$estatus
		);
		$this->db->where('id',$id);
		if($this->db->update('requisicion',$data)){
			return TRUE;
		}else{
			return FALSE;
		}		
	}

	public function update_statusRequisicion($id,$estatus){
		$estatus = ($estatus == 1) ? 0 : 1;
		$data = array(		
			'estatus_req'		=>	$estatus,
			'fecha_estatus'		=>  date('Y-m-d H:i:s')
		);
		$this->db->where('id',$id);
		if($this->db->update('requisicion',$data)){
			return TRUE;
		}else{
			return FALSE;
		}		
	}

	public function folio(){

		return $this->db->select('id')->order_by('id','desc')->limit(1)->get('requisicion')->row('id');
	}

	public function requisicion_enviar_estatus($idreq){
		$this->db->order_by("requisicion.id","desc");	
		$this->db->select('requisicion.id, users.email')->from('requisicion')->join('users','users.id = requisicion.autor','inner')->where("requisicion.id", $idreq);

		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
	}
}
<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class common_model extends BF_Model {
	function common_model(){
		parent::__construct();
		
	}
	
	function getCities(){
		$this->db->select('name','slug','id');
		$this->db->order_by('id','asc');
		$query = $this->db->get('city');
		if($query){
			$query = $query->result_array();
			return $query;
		}
	}
	
	function getCountries($conditions = array()){
		if(count($conditions)>0){
			$this->db->where($conditions);
		}
		$this->db->from('country');
		$this->db->select('id,symbol,name');
		$result = $this->db->get();
		return $result;
	}
	
	function getTableData($table='',$conditions=array(),$fields='',$like=array(),$limit=array(),$orderby = array(),$like1=array(),$order = array(),$conditions1=array())
	 {
	 	//Check For Conditions
	 	if(is_array($conditions) and count($conditions)>0)		
	 		$this->db->where($conditions);
		
		//Check For Conditions
	 	if(is_array($conditions1) and count($conditions1)>0)		
	 		$this->db->or_where($conditions1);	
			
		//Check For like statement
	 	if(is_array($like) and count($like)>0)		
	 		$this->db->like($like);	
		
		if(is_array($like1) and count($like1)>0)

			$this->db->or_like($like1);	
			
		//Check For Limit	
		if(is_array($limit))		
		{
			if(count($limit)==1)
	 			$this->db->limit($limit[0]);
			else if(count($limit)==2)
				$this->db->limit($limit[0],$limit[1]);
		}	
		
		
		//Check for Order by
		if(is_array($orderby) and count($orderby)>0)
		{
			$this->db->order_by('id', 'desc');
		}
		//Check for Order by
		if(is_array($order) and count($order)>0)
			$this->db->order_by($order[0], $order[1]);	
			
		$this->db->from($table);
		
		//Check For Fields	 
		if($fields!='')
		 
				$this->db->select($fields);
		
		else 		
	 		$this->db->select();
			
		$result = $this->db->get();
		
	//pr($result->result());
		return $result;
		
	 }
	 
	function insertData($table='',$insertData=array()){
	 	//return $this->db->insert($table,$insertData);
		$result=$this->db->insert($table,$insertData);
		if($result)
			return $this->db->insert_id();
		else
			return 0;
	}
	
	function updateTableData($table='',$id=0,$updateData=array(),$conditions=array()){
	 	if(is_array($conditions) and count($conditions)>0)
	 		$this->db->where($conditions);
		else	
		    $this->db->where('id', $id);

		$this->db->update($table, $updateData);
		return $this->db->affected_rows();
	}
}
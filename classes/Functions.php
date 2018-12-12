<?php
/**
 * 
 */
require_once( 'DBClass.php' );

class Core extends DBClass
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function get_report_date($from_date,$to_date,$approve,$ads_id)
	{
		$query = "SELECT * FROM comments WHERE date(created_at) >= '$from_date' AND date(created_at) <= '$to_date' ";
		if ($approve!='all') {
			$query .=" AND approve = $approve";
		}
		if ($ads_id>0) {
			$query .=" AND ads_id = $ads_id";
		}
		$query .=" ORDER BY id desc";
		$data = $this->query($query);
		$error = $this->sql_error($query);
		if ($error) {
			echo $error;
			die();
		}elseif ($data->num_rows == 0 ) {
			return false;
		}else{
			$data = $this->fetchAll($data);
			return $data;			
		}
		$this->close();
	}
	public function delete_where($table,$cond){
		$query = "DELETE FROM  $table   ";
		if (count($cond) > 0 ) {
			$index = 0;
			foreach ($cond as $key => $value) {
				$index++;
				if ($index == 1) {
					$query .= " WHERE $key = '$value' "; 
				}else{
					$query .= " AND $key = '$value' "; 
				}
			}
		} 
		$data = $this->query($query);
 		$error = $this->sql_error($query);
		if ($error) {
			echo $error;
			die();
		}else {
			return true;
		}
		$this->close();
		
	}	

	public function update_where_id($table,$array_data,$table_id){
		$query = "UPDATE   $table SET ";
		$i = 0 ;
		foreach ($array_data as $key => $value) {
			if ($i > 0) {
				$query .= " , " ;
			}
			$query .= " $key = '$value' "; 
			$i++ ;
		} 
		$query .= " WHERE id = $table_id "; 
		$data = $this->query($query);
		$error = $this->sql_error($query);
		if ($error) {
			echo $error;
			die();
		}else {
			return true;
		}
		$this->close();
		
	}
	public function insert_New($table,$array_data){
		$cols = array();
		$vals = array();
		foreach ($array_data as $key => $value) {
			$cols[] = $key; 
			$vals[] = $value; 
		}
		$cols = implode(',', $cols);
		$vals = implode("','", $vals);
		$query = "INSERT INTO  $table ($cols) VALUES ('$vals')";
		$data = $this->query($query);
		$lastInsertedID = $this->lastInsertedID($query);
		$error = $this->sql_error($query);
		if ($error) {
			echo $error;
			die();
		}elseif ($lastInsertedID > 0 ) {
			return $lastInsertedID;			
		}else{
			return false;
		}
		$this->close();
		
	}
	public function get_where($table = 'ads',$selected='*',$cond = array(),$orders=array(),$limit=0)
	{
		$query = "SELECT $selected FROM $table ";
		if (count($cond) > 0 ) {
			$index = 0;
			foreach ($cond as $key => $value) {
				$index++;
				if ($index == 1) {
					$query .= " WHERE $key = '$value' "; 
				}else{
					$query .= " AND $key = '$value' "; 
				}
			}
		}
		if (count($orders) > 0 ) {
			$query .= " AND $key = $value "; 
			$index = 0;
			foreach ($orders as $key => $value) {
				$index++;
				if ($index == 1) {
					$query .= " ORDER BY  $key  $value "; 
				}else{
					$query .= " , $key  $value "; 
				}
			}
		}
		if ($limit > 0 ) {
			$query .= " LIMIT $limit "; 
		}

		$data = $this->query($query);
		$error = $this->sql_error($query);
		if ($error) {
			echo $error;
			die();
		}elseif ($data->num_rows == 0 ) {
			return false;
		}else{
			$data = $this->fetchAll($data);
			return $data;			
		}
		$this->close();
	}


}
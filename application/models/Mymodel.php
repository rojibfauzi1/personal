<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 
*/
class Mymodel extends CI_Model
{
	function __construct() {
        parent::__construct();
    }
	
	public function get_Mahasiswa()
	{
		$data = $this->db->query("SELECT * from mahasiswa");
		return $data->result_array();
	}

	public function GetMahasiswa($table)
	{
		$response = $this->db->get($table);

		return $response->result_array();
	}

	public function insert($table,$data)
	{
		$response = $this->db->insert($table,$data);

		return $response;
	}

	public function GetWhere($table,$data)
	{
		$response = $this->db->get_where($table,$data); //get_where = utk mengambil data yg kita pilih

		return $response->result_array();
	}

	public function update($table,$data,$where)
	{
		$response = $this->db->update($table,$data,$where);

		return $response;
	}

	public function delete($table,$where)
	{
		$response = $this->db->delete($table,$where);

		return $response;
	}
}

?>
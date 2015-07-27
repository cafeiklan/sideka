<?php
class M_apbdes extends CI_Model {

   function __construct()
  {
    parent::__construct();
    $this->_table='tbl_apbdes';
	
    //get instance
    $this->CI = get_instance();
  }
	public function get_flexigrid()
    {
        //Build contents query
        $this->db->select('*')->from($this->_table);
        $this->db->where('id_apbdes !=', 0);
        $this->CI->flexigrid->build_query();

        //Get contents
        $return['records'] = $this->db->get();

        //Build count query
        $this->db->select("count(id_apbdes) as record_count")->from($this->_table);
        $this->db->where('id_apbdes !=', 0);
        $this->CI->flexigrid->build_query(FALSE);
        $record_count = $this->db->get();
        $row = $record_count->row();

        //Get Record Count
        $return['record_count'] = $row->record_count;

        //Return all
        return $return;
    }
  function insert($data)
  {
    $this->db->insert($this->_table, $data);
  }
  
  function delete($id)
  {
    $this->db->where('id_apbdes', $id);
    $this->db->delete($this->_table);
  }
  
  function getById($id) //edit
  {	
    return $this->db->get_where($this->_table,array('id_apbdes' => $id))->row();
  }
  
  function update($where, $data) //update
  {
    $this->db->where($where);
    $this->db->update($this->_table, $data);
    return $this->db->affected_rows();
  }
  
}
?>

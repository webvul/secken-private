<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Group_power extends CI_Model {

    private $_main_table = 'group_power';
    private $_power_table = 'power';

    public function __construct(){
        parent::__construct();

        $this->load->database();
    }

    public function get($gid){
        $this->db->select('*');
        $this->db->from($this->_main_table . ' AS gp');
        $this->db->join($this->_power_table . ' AS p','gp.power_id = p.id','left');
        $this->db->where('gp.gid', $gid);

        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_by_power_id($power_id){
        $this->db->select('*');
        $this->db->from($this->_main_table);
        $this->db->where('power_id', $power_id);

        $query = $this->db->get();
        return $query->result_array();
    }

    public function insert($insertData){
        if(empty($insertData)){
            return 0;
        }

        $this->db->insert($this->_main_table, $insertData);
        return $this->db->affected_rows();
    }

    public function update($updateData, $where){
        if(empty($updateData) && empty($where)){
            return 0;
        }

        $this->db->set($updateData);
        $this->db->where($where);

        $this->db->update($this->_main_table);

        return $this->db->affected_rows();
    }

    public function delete($gid, $power_id = 0){

        $this->db->where('gid', $gid);
        if($power_id){
            $this->db->where('power_id', $power_id);
        }

        $this->db->delete($this->_main_table);
        //echo $this->db->last_query();
        return $this->db->affected_rows();
    }

    public function delete_power($where){

        $this->db->where($where);
        $this->db->delete($this->_main_table);
        //echo $this->db->last_query();
        return $this->db->affected_rows();
    }
}

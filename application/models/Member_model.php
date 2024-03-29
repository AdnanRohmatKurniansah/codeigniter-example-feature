<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 * Model Member_model
 *
 * This Model for ...
 * 
 * @package		CodeIgniter
 * @category	Model
 * @author    Setiawan Jodi <jodisetiawan@fisip-untirta.ac.id>
 * @link      https://github.com/setdjod/myci-extension/
 * @param     ...
 * @return    ...
 *
 */

class Member_model extends CI_Model {

  // ------------------------------------------------------------------------

  public function __construct()
  {
    parent::__construct();
  }

  // ------------------------------------------------------------------------


  // ------------------------------------------------------------------------
  public function all()
  {
    $this->db->order_by('id', 'desc');
    $query = $this->db->get('member');
    return $query->result();
  }

  public function getData($limit, $start) {
    $this->db->order_by('id', 'desc');
    $this->db->limit($limit, $start);
    $query = $this->db->get('member');
    return $query->result();
  }

  public function create($data) {
    return $this->db->insert('member', $data);
  }

  public function find($id) {
    return $this->db->get_where('member', ['id' => $id])->row();
  }

  public function update($id, $data) {
    if(!$id){
			return null;
		}
 
    $result = $this->db->where('id', $id)->update('member', $data);
    return $result;
  }

  public function countData() {
    return $this->db->count_all('member');
  }

  public function delete($id)
  {
    $result = $this->db->delete('member', array('id' => $id));
    return $result;
  }

  // ------------------------------------------------------------------------

}

/* End of file Member_model.php */
/* Location: ./application/models/Member_model.php */
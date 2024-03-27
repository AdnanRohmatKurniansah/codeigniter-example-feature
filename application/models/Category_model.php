<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 * Model Category_model
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

class Category_model extends CI_Model {

  // ------------------------------------------------------------------------

  public function __construct()
  {
    parent::__construct();
  }

  // ------------------------------------------------------------------------


  // ------------------------------------------------------------------------
  public function getData($limit = null, $start = null)
  {
      $this->db->order_by('id', 'desc');
      $this->db->limit($limit, $start);
      $query = $this->db->get('category');
      return $query->result();
  }

  public function create($data) {
    if(!$data){
			return null;
		}

		return $this->db->insert('category', $data);
  }

  public function find($id) {
    return $this->db->get_where('category', ['id' => $id])->row();
  }

  public function update($id, $data) {
    if(!$id){
			return null;
		}
 
    $result = $this->db->where('id', $id)->update('category', $data);
    return $result;
  }

  public function countData() {
    return $this->db->count_all('category');
  }

  public function delete($id)
  {
    $result = $this->db->delete('category', array('id' => $id));
    return $result;
  }

  // ------------------------------------------------------------------------

}

/* End of file Category_model.php */
/* Location: ./application/models/Category_model.php */
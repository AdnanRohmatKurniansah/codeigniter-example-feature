<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 * Model Product_model
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

class Product_model extends CI_Model {

  // ------------------------------------------------------------------------

  public function __construct()
  {
    parent::__construct();
  }

  // ------------------------------------------------------------------------


  // ------------------------------------------------------------------------
  public function getData($limit = null, $start = null)
  {
      $this->db->select('product.*, category.name as category_name');
      $this->db->from('product');
      $this->db->join('category', 'category.id = product.category_id');
      $this->db->order_by('product.id', 'desc');
      $this->db->limit($limit, $start);
      $query = $this->db->get();
      return $query->result();
  }


  public function create($data) {
		return $this->db->insert('product', $data);
  }

  public function find($id) {
    return $this->db->get_where('product', ['id' => $id])->row();
  }

  public function update($id, $data) {
    if(!$id){
			return null;
		}
 
    $result = $this->db->where('id', $id)->update('product', $data);
    return $result;
  }

  public function countData() {
    return $this->db->count_all('product');
  }

  public function delete($id)
  {
    $result = $this->db->delete('product', array('id' => $id));
    return $result;
  }
  // ------------------------------------------------------------------------

}

/* End of file Product_model.php */
/* Location: ./application/models/Product_model.php */
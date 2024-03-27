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
    $this->db->order_by('id', 'desc');
    $this->db->limit($limit, $start);
    $query = $this->db->get('category');
    return $query->result();
  }

  // ------------------------------------------------------------------------

}

/* End of file Product_model.php */
/* Location: ./application/models/Product_model.php */
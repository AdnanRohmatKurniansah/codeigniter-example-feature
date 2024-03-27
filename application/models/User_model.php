<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 * Model User_model
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

class User_model extends CI_Model {

  // ------------------------------------------------------------------------

  public function __construct()
  {
    parent::__construct();
  }

  // ------------------------------------------------------------------------


  // ------------------------------------------------------------------------
  public function getData()
  {
    $this->db->order_by('id', 'desc');
    $query = $this->db->get('users');
    return $query->result();
  }

  public function find($email) {
    return $this->db->get_where('users', ['email' => $email])->row_array();
  }

  public function create($users) {
    if(!$users){
			return null;
		}

		return $this->db->insert('users', $users);
  }

  // ------------------------------------------------------------------------

}

/* End of file User_model.php */
/* Location: ./application/models/User_model.php */
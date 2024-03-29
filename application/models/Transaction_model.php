<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 * Model Transaction_model
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

class Transaction_model extends CI_Model {

  // ------------------------------------------------------------------------

  public function __construct()
  {
    parent::__construct();
  }

  // ---

  public function insert($transaction_data, $details_data) {
    $this->db->insert('transaction', $transaction_data);
    $transaction_id = $this->db->insert_id();

    foreach ($details_data as $detail) {
      $detail['transaction_id'] = $transaction_id;
      $this->db->insert('detail_transaction', $detail);
    }
  }


  // ------------------------------------------------------------------------

}

/* End of file Transaction_model.php */
/* Location: ./application/models/Transaction_model.php */
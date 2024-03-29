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

  public function getData($limit = null, $start = null) {
    $this->db->select('transaction.*, member.name as member_name, GROUP_CONCAT(product.name) as product_names');
    $this->db->from('transaction');
    $this->db->join('member', 'member.id = transaction.member_id');
    $this->db->join('detail_transaction', 'detail_transaction.transaction_id = transaction.id');
    $this->db->join('product', 'product.id = detail_transaction.product_id');
    $this->db->group_by('transaction.id');
    $this->db->order_by('transaction.id', 'desc');
    if ($limit !== null) {
        $this->db->limit($limit, $start);
    }
    $query = $this->db->get();

    return $query->result();
}


  public function insert($transaction_data, $details_data) {
    $this->db->insert('transaction', $transaction_data);
    $transaction_id = $this->db->insert_id();

    foreach ($details_data as $detail) {
      $detail['transaction_id'] = $transaction_id;
      $this->db->insert('detail_transaction', $detail);
    }
  }

  public function countData() {
    return $this->db->count_all('transaction');
  }

  public function statistic() {
    return $this->db->select('DATE_FORMAT(transaction_date, "%M") AS date, COUNT(*) AS count', false)
        ->group_by('DATE_FORMAT(transaction_date, "%M")')
        ->order_by('DATE_FORMAT(transaction_date, "%M")')
        ->get('transaction')->result();
  }



  // ------------------------------------------------------------------------

}

/* End of file Transaction_model.php */
/* Location: ./application/models/Transaction_model.php */
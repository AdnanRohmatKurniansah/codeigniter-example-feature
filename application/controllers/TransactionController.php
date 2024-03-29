<?php
defined('BASEPATH') or exit('No direct script access allowed');


/**
 *
 * Controller TransactionController
 *
 * This controller for ...
 *
 * @package   CodeIgniter
 * @category  Controller CI
 * @author    Setiawan Jodi <jodisetiawan@fisip-untirta.ac.id>
 * @author    Raul Guerrero <r.g.c@me.com>
 * @link      https://github.com/setdjod/myci-extension/
 * @param     ...
 * @return    ...
 *
 */

class TransactionController extends CI_Controller
{
    
  public function __construct()
  {
    parent::__construct();
    // $this->load->model('transaction_model');
  }

  public function index()
  {
    $this->load->view('transaction/index');
  }

  public function create()
  {
      $members = $this->member_model->all();
      $products = $this->product_model->all();

      if ($this->input->post()) {
          $transaction_data = array(
              'transaction_date' => $this->input->post('transaction_date'),
              'total' => $this->input->post('total'),
              'member_id' => $this->input->post('member_id')
          );

          $details_data = $this->input->post('details');

          $this->transaction_model->insert($transaction_data, $details_data);

          echo json_encode(['message' => 'Transaction created successfully']);
      } else {
          $this->load->view('transaction/create', [
              'members' => $members,
              'products' => $products
          ]);
      }
  }
}


/* End of file TransactionController.php */
/* Location: ./application/controllers/TransactionController.php */
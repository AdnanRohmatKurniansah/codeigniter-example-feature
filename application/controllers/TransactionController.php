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
    $config["base_url"] = base_url('dashboard/transaction');
    $config["total_rows"] = $this->transaction_model->countData();
    $config['page_query_string'] = TRUE;
    $config["per_page"] = 10;
    $config["uri_segment"] = 2;
    $config['full_tag_open'] = '<ul class="pagination">';        
    $config['full_tag_close'] = '</ul>';        
    $config['first_link'] = 'First';        
    $config['last_link'] = 'Last';        
    $config['first_tag_open'] = '<li class="page-item"><span class="page-link">';        
    $config['first_tag_close'] = '</span></li>';        
    $config['prev_link'] = '&laquo';        
    $config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';        
    $config['prev_tag_close'] = '</span></li>';        
    $config['next_link'] = '&raquo';        
    $config['next_tag_open'] = '<li class="page-item"><span class="page-link">';        
    $config['next_tag_close'] = '</span></li>';        
    $config['last_tag_open'] = '<li class="page-item"><span class="page-link">';        
    $config['last_tag_close'] = '</span></li>';        
    $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';        
    $config['cur_tag_close'] = '</a></li>';        
    $config['num_tag_open'] = '<li class="page-item"><span class="page-link">';        
    $config['num_tag_close'] = '</span></li>';
    $offset = ($this->input->get('per_page') !== null && ctype_digit($this->input->get('per_page'))) ? html_escape($this->input->get('per_page')) : 0;

    $this->pagination->initialize($config);
    $data["links"] = $this->pagination->create_links();
    $transactions = $this->transaction_model->getData($config["per_page"], $offset);     
    
    $this->load->view('transaction/index', [
      'transactions' => $transactions,
      'links' => $data['links']
    ]);
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
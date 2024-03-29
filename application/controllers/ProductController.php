<?php
defined('BASEPATH') or exit('No direct script access allowed');


/**
 *
 * Controller ProductController
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

class ProductController extends CI_Controller
{
    
  public function __construct()
  {
    parent::__construct();
    authenticate();
  }

  public function _rules() {
    $rules = [
        ['field' => 'name', 'label' => 'Name', 'rules' => 'required|min_length[3]'],
        ['field' => 'category_id', 'label' => 'Category_id', 'rules' => 'required|numeric'],
        ['field' => 'price', 'label' => 'Price', 'rules' => 'required|numeric'],
        ['field' => 'stock', 'label' => 'Stock', 'rules' => 'required|numeric'],
    ];

    foreach ($rules as $rule) {
        $this->form_validation->set_rules($rule['field'], $rule['label'], $rule['rules']);
    }
  }

  public function index()
  {
    $config["base_url"] = base_url('dashboard/product');
    $config["total_rows"] = $this->product_model->countData();
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
    $products = $this->product_model->getData($config["per_page"], $offset);     
    
    $this->load->view('product/index', [
      'products' => $products,
      'links' => $data['links']
    ]);
  }

  public function create() {
      $this->_rules();
      $categories = $this->category_model->all();

      if ($this->form_validation->run() == FALSE) {
          $this->load->view('product/create', [
            'categories' => $categories
          ]);
      } else {
          $upload_result = uploadFile('products', 'image');

          if ($upload_result['status']) {
              $image_data = $upload_result['data'];
              $image_name = $image_data['file_name'];

              $data = [
                  'name' => htmlspecialchars($this->input->post('name', true)),
                  'category_id' => htmlspecialchars($this->input->post('category_id', true)),
                  'price' => htmlspecialchars($this->input->post('price', true)),
                  'stock' => htmlspecialchars($this->input->post('stock', true)),
                  'image' => $image_name  
              ];

              $this->product_model->create($data);
              $this->session->set_flashdata('success', 'New product has been added');
              redirect('dashboard/product');
          } else {
              $error_message = $upload_result['message'];
              $this->session->set_flashdata('error', $error_message);
              redirect('dashboard/product/create');
          }
      }
  }
  
  public function edit($id) {
    $this->_rules();

    $categories = $this->category_model->all();
    $product = $this->product_model->find($id);

    if ($this->form_validation->run() == false) {
        $this->load->view('product/edit', [
            'categories' => $categories,
            'product' => $product
        ]);
    } else {
        $data = [
            'name' => htmlspecialchars($this->input->post('name', true)),
            'category_id' => htmlspecialchars($this->input->post('category_id', true)),
            'price' => htmlspecialchars($this->input->post('price', true)),
            'stock' => htmlspecialchars($this->input->post('stock', true))
        ];

        if (!empty($_FILES['image']['name'])) {
            if ($product->image) {
              unlink(FCPATH . 'public/uploads/' . $product->image);
            }
            $upload_result = uploadFile('products', 'image');
            if ($upload_result['status']) {
                $image_data = $upload_result['data'];
                $image_name = $image_data['file_name'];
                $data['image'] = $image_name;
            } else {
                $error_message = $upload_result['message'];
                $this->session->set_flashdata('error', $error_message);
                redirect('dashboard/product/edit/'.$id);
            }
        }

        $this->product_model->update($id, $data);
        $this->session->set_flashdata('update', 'Product has been updated');
        redirect('dashboard/product');
    }
  }

  public function destroy($id) 
  {
    $product = $this->product_model->find($id);
    if ($product->image) {
      unlink(FCPATH . 'public/uploads/' . $product->image);
    }
    $this->product_model->delete($id);
    $this->session->set_flashdata('success', 'Product has been deleted');
    redirect('dashboard/product');
  }

  public function search() {
    $keyword = $this->input->get('keyword');

		$search_result = $this->product_model->search($keyword);
		
		$this->load->view('search.php', [
      'products' => $search_result
    ]);
  }
}


/* End of file ProductController.php */
/* Location: ./application/controllers/ProductController.php */
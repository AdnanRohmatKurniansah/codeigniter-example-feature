<?php

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

defined('BASEPATH') or exit('No direct script access allowed');


/**
 *
 * Controller MemberController
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

class MemberController extends CI_Controller
{
    
  public function __construct()
  {
    parent::__construct();
  }

  public function _rules() {
    $rules = [
      ['field' => 'name', 'label' => 'Name', 'rules' => 'required|min_length[3]'],
      ['field' => 'address', 'label' => 'Address', 'rules' => 'required'],
      ['field' => 'no_telp', 'label' => 'No_telp', 'rules' => 'required'],
    ];

    foreach ($rules as $rule) {
        $this->form_validation->set_rules($rule['field'], $rule['label'], $rule['rules']);
        $this->form_validation->set_message($rule['field']);
    }
  }

  public function index()
  { 
    $config["base_url"] = base_url('dashboard/member');
    $config["total_rows"] = $this->member_model->countData();
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
    $members = $this->member_model->getData($config["per_page"], $offset);     
    
    $this->load->view('member/index', [
      'members' => $members,
      'links' => $data['links']
    ]);
  }

  public function create() {
    $this->_rules();

    if ($this->form_validation->run() == FALSE) {
      $this->load->view('member/create');
    } else {
      $data = [
          'name' => htmlspecialchars($this->input->post('name', true)),
          'address' => htmlspecialchars($this->input->post('address', true)),
          'no_telp' => htmlspecialchars($this->input->post('no_telp', true)),
      ];

      $this->member_model->create($data);
      $this->session->set_flashdata('success', 'New member has been added');
      redirect('dashboard/member');
    }
  }

  public function edit($id) {
    $this->_rules();

    $member = $this->member_model->find($id);
    $this->load->view('member/edit', [
      'member' => $member
    ]);
    if ($this->form_validation->run() == FALSE) {
    } else {
      $data = [
        'name' => htmlspecialchars($this->input->post('name', true)),
        'address' => htmlspecialchars($this->input->post('address', true)),
        'no_telp' => htmlspecialchars($this->input->post('no_telp', true)),
      ];

      $this->member_model->update($id, $data);
      $this->session->set_flashdata('update', 'Member has been updated');
      redirect('dashboard/member');
    }
  }

  public function destroy($id) {
    $this->member_model->delete($id);
    $this->session->set_flashdata('success', "Member has been deleted");
    redirect('dashboard/member');
  }

  public function export() {
    $filename = 'member.xlsx';
    $members = $this->member_model->all();
    $spreadsheet = new Spreadsheet();    
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->setCellValue('A1', 'No');
    $sheet->setCellValue('B1', 'Name');
    $sheet->setCellValue('C1', 'Address');
    $sheet->setCellValue('D1', 'Telephone');
    $rows = 2;
    foreach ($members as $index => $member) {
        $sheet->setCellValue('A' . $rows, $index + 1);
        $sheet->setCellValue('B' . $rows, $member->name);
        $sheet->setCellValue('C' . $rows, $member->address);
        $sheet->setCellValue('D' . $rows, $member->no_telp);
        $rows++;
    }
    $writer = new Xlsx($spreadsheet);

    // Send the file directly to the browser
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="' . $filename . '"');
    header('Cache-Control: max-age=0');

    $writer->save('php://output');
  }

  public function import() {
    if ($_FILES['excel']['name']) {
        $file_name = $_FILES['excel']['name'];
        $file_extension = pathinfo($file_name, PATHINFO_EXTENSION);

        if (in_array(strtolower($file_extension), array('xlsx', 'xls'))) {
          $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xlsx');
          $spreadsheet = $reader->load($_FILES['excel']['tmp_name']);
      
          $worksheet = $spreadsheet->getActiveSheet();
      
          foreach ($worksheet->getRowIterator(2) as $row) {
              $cellIterator = $row->getCellIterator();
              $cellIterator->setIterateOnlyExistingCells(false); 
              $data = [];
      
              foreach ($cellIterator as $cell) {
                  $data[] = $cell->getValue();
              }
      
              $this->member_model->create([
                'name' => $data[1],     
                'address' => $data[2],  
                'no_telp' => $data[3],  
            ]);
          }

            $this->session->set_flashdata('success', 'Import member data successfully');
            redirect('dashboard/member');
        } else {
            $this->session->set_flashdata('error', 'Invalid file format. Please upload an Excel file.');
            redirect('dashboard/member');
        }
    } else {
        $this->session->set_flashdata('error', 'Please select a file to import');
        redirect('dashboard/member');
    }
}

}


/* End of file MemberController.php */
/* Location: ./application/controllers/MemberController.php */
<?php
defined('BASEPATH') or exit('No direct script access allowed');


/**
 *
 * Controller DashboardController
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

class DashboardController extends CI_Controller
{
    
  public function __construct()
  {
    parent::__construct();
    authenticate();
  }

  public function index()
  {
    $this->load->view('dashboard');
  }

  public function logout() {
    $this->session->unset_userdata(['user_id', 'name', 'email', 'role']);

    redirect('/');
  }
  
}


/* End of file DashboardController.php */
/* Location: ./application/controllers/DashboardController.php */
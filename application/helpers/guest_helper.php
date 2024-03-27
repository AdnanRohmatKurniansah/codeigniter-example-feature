<?php 
    function isLoggedIn() {
        $ci = get_instance();
        if ($ci->session->userdata('user_id')) {
            redirect('dashboard');
        }
    }
?>
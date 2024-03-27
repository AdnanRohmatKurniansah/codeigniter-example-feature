<?php 
    function authenticate() {
        $ci = get_instance();
        if (!$ci->session->userdata('user_id')) {
            redirect('/');
        }
    }
?>
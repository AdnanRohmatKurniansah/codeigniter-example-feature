<?php
function uploadFile($uploadpath, $filename, $allowed_types = 'jpg|png|jpeg|gif', $max_size = '2048000') {
    $ci = &get_instance();

    $config['upload_path'] = './public/uploads/' . $uploadpath;
    $config['allowed_types'] = $allowed_types;
    $config['max_size'] = $max_size;

    $ci->load->library('upload', $config);

    if (!$ci->upload->do_upload($filename)) {
        $error = $ci->upload->display_errors('', '');
        return [
            'status' => false, 
            'message' => $error
        ];
    } else {
        $data = $ci->upload->data();
        $ext = pathinfo($data['file_name'], PATHINFO_EXTENSION);
        $unique_filename = uniqid() . '_' . mt_rand(1000, 9999) . '.' . $ext;

        $old_path = $data['full_path'];
        $new_path = $config['upload_path'] . '/' . $unique_filename;
        rename($old_path, $new_path);

        $relative_path = str_replace('./public/uploads/', '', $new_path);

        return [
            'status' => true, 
            'data' => [
                'file_name' => $relative_path
            ]
        ];
    }
}
?>

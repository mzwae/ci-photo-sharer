<?php

class Create extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('string'));
        $this->load->library('form_validation');
        $this->load->library('image_lib');
        $this->load->model('Image_model');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
    }

    public function index()
    {
        $page_data = array('fail' => false, 'successs' => false);

        $this->load->view('templates/header');
        $this->load->view('create/create', $page_data);
        $this->load->view('templates/footer');
    }

    public function do_upload()
    {
        $upload_dir = base_url().'assets/upload/';
        do {
            // Generate unique code to create a unique file name
            $code = random_string('alnum', 8);

            // Scan upload dir for subdir with same name as the unique code
            $dirs = scandir($upload_dir);

            // Check whether there is a directory with the name wihch we store in $code
        if (in_array($code, $dirs)) {// Yes, there is.
          $img_dir_name = false; //Set to false to start again
        } else { // No, there is not.
          $img_dir_name = $code; // Create a new name
        }
        } while ($img_dir_name == false);

        if (!mkdir($upload_dir.$img_dir_name)) {
            $page_data = array('fail' => 'upload error', 'success' => false);
            $this->load->view('templates/header');
            $this->load->view('create/create', $page_data);
            $this->load->view('templates/footer');
        }

        $config['upload_path'] = $upload_dir . $img_dir_name;
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['max_size'] = '10000';
        $config['max_width'] = '1024';
        $config['max_height'] = '768';

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload()) {
            $page_data = array('fail' => $this->upload->display_errors(), 'success' => false);
            $this->load->view('templates/header');
            $this->load->view('create/create', $page_data);
            $this->load->view('templates/header');
        } else {
            $image_data = $this->upload->data();
            $page_data['result'] = $this->Image_model->save_image(array('image_name'=>$image_data['file_name'], 'img_dir_name'=>$img_dir_name));
            $page_data['file_name'] = $image_data['file_name'];
            $page_data['img_dir_name'] = $img_dir_name;

            if ($page_data['result'] == false) {
                $page_data = array('fail'=>'Upload Error');
                $this->load->view('templates/header');
                $this->load->view('create/create', $page_data);
                $this->load->view('templates/header');
            } else {
                $this->load->view('templates/header');
                $this->load->view('create/result', $page_data);
                $this->load->view('templates/header');
            }
        }
    }
}

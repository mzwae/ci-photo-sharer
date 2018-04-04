<?php

class Go extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('string');
    }

    public function index()
    {
        if (!$this->uri->segment(1)) {
            redirect(base_url());
        } else if(!$this->uri->segment(1) == 'upload'){
          die('create');
        }
          else {
            $image_code = $this->uri->segment(1);

            $this->load->model('Image_model');
            $query = $this->Image_model->fetch_image($image_code);

            if ($query->num_rows() == 1) {
                foreach ($query->result() as $row) {
                    $img_image_name = $row->img_image_name;
                    $img_dir_name = $row->img_dir_name;
                }

                $url_address = base_url().'uploads/'.$img_dir_name.'/'.$img_image_name;
                redirect($url_address);


            } else {
                redirect('create');
            }
        }
    }

}

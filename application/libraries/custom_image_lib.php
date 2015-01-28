<?php
// if it works then 
// Author is Numan Hassan :)

class Custom_image_lib {

    var $image = "";
    var $height = "";
    var $width = "";
    var $size = "";
    var $tmp_name = "";
    var $files_array;
    var $create_thumb = false;
    var $thumb_sizes = array();
    var $path = '';
    var $file_name = '';
    var $file_ext = '';
    var $full_path = ''; // for resizing 
    var $uploaded_image_name = array();

    public function __construct() {
        // do something before upload
    }
    public function __destruct() {
        if( isset($_FILES['userfile']) ) { unset($_FILES['userfile']); }
    }

    public function upload($files, $path = '') {
        $this->freez_time = time();
        $this->files_array = $files;
        $this->path = $path;
        $this->uploaded_image_name = array();
        // detect image number
        $total_img = $this->get_total_images();

        if ($total_img > 0) {

            $remapped_array = $this->remap_array();
            // var_dump($remapped_array); die;
            $error_found = FALSE;
            foreach ($remapped_array as $key => $image) {
                $image['name'] = str_replace(" ","_",$image['name']);
                $_FILES['userfile']['name'] = $image['name'];
                $_FILES['userfile']['type'] = $image['type'];
                $_FILES['userfile']['tmp_name'] = $image['tmp_name'];
                $_FILES['userfile']['error'] = $image['error'];
                $_FILES['userfile']['size'] = $image['size'];
                
                $this->freez_time++;
                if ($image['error'] == 0) {
                    $file = pathinfo($image['name'], PATHINFO_FILENAME);
                    $ext = pathinfo($image['name'], PATHINFO_EXTENSION);
                    $this->tmp_name = $image['tmp_name'];
                    $this->file_name = $file;
                    $this->file_ext = $ext;

                    // Use this function to upload file without CI library
                    //$this->upload_file_to_server($image['tmp_name']);
                    
                    // Use this function to upload file using CI library
                    $up = $this->upload_file_to_server_CI($image['tmp_name']);
                    if(!$up){
                        $error_found = TRUE;
                    }
                }
                else{
                    $error_found = TRUE;
                }
            } // end foreach
            return $this->uploaded_image_name;
        }
    }

    private function upload_file_to_server() {
        $config = array();

        $new_file_name = $this->file_name . '_' . $this->freez_time . '.' . $this->file_ext;
        $this->full_path = $this->path . $new_file_name;
        if (move_uploaded_file($this->tmp_name, $this->path . $new_file_name)) {
            if ($this->create_thumb == TRUE) {
                foreach ($this->thumb_sizes as $sizes) {
                    $w = $sizes['width'];
                    $h = $sizes['height'];
                    $this->resize_image($w, $h);
                }
            }
        } else {
//            echo "move upload file error";
        }
    }

    private function upload_file_to_server_CI() {
        $that = & get_instance();
        
        $new_file_name = $this->file_name . '_' . $this->freez_time . '.' . $this->file_ext;
        $this->full_path = $this->path . $new_file_name;
        $config = array();
        $config['upload_path'] = $this->path;
        $config['allowed_types'] = 'gif|jpg|png';
        $config['file_name'] = $new_file_name;
        $that->load->library('upload');
        $that->upload->initialize($config);
        if ($that->upload->do_upload()) {
            if ($this->create_thumb == TRUE) {
                foreach ($this->thumb_sizes as $sizes) {
                    $w = $sizes['width'];
                    $h = $sizes['height'];
                    $this->resize_image($w, $h);
                }
            }
            $this->uploaded_image_name[] = $new_file_name;
            return true;
        } else {
            return false;
        }
    }

    private function resize_image($w, $h) {
        $that = & get_instance();
        $that->load->library('image_lib');
        $config['image_library'] = 'gd2';
        $config['source_image'] = $this->full_path;
        $config['new_image'] = $this->path . $this->file_name . '_' . $this->freez_time . '_' . $w . '_' . $h . '.' . $this->file_ext;
        $config['quality'] = '90%';
        $config['create_thumb'] = FALSE;
        $config['maintain_ratio'] = TRUE;
        $config['width'] = $w;
        $config['height'] = $h;
        $that->image_lib->initialize($config);
        if (!$that->image_lib->resize()) {
            echo "<pre>";
            echo $that->image_lib->display_errors();
            echo "</pre>";
            exit;
        }
    }

    public function config($array) {
        if ($array) {
            $this->create_thumb = $array['create_thumb'];
            $this->thumb_sizes = $array['thumb_sizes'];
        } else {
            echo "Config array is required";
        }
    }

    private function get_total_images() {
        $array = $this->files_array;
        $total_images = count($array['name']);
        return $total_images;
    }

    private function remap_array() {
        $array = $this->files_array;
        $new_array = array();
        foreach ($array as $key => $val) {
            $i = 0;
            foreach ($val as $val2) {
                $new_array[$i][$key] = $val2;
                $i++;
            }
        }
        return $new_array;
    }

}

?>
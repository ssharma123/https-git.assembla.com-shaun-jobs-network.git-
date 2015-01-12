<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Import extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function import_json_to_mysql()
	{
            if(isset($_FILES['file'])){ 
                
                $pathinfo = pathinfo($_FILES['file']['name']);
                if(isset($_FILES['file']['name']) && $_FILES['file']['name'] == ""){
                    $type="error";
                    $msg = "Please updload file ";
                }

                else if($pathinfo['extension'] !== "json"){
                    $type="error";
                    $msg = "Please updload json file ";
                }
                else{
                    $json_data = file_get_contents($_FILES["file"]["tmp_name"]);
//                    echo "<hr>";
//                    echo $json_data;
//                    echo "<hr>";
                    $json_decode = json_decode ("[".$json_data."]", TRUE);
//                    echo "<pre>"; print_r($json_decode); echo "</pre>"; die;
                    $data = $json_decode[0]["results"];
                    
//                    echo "<pre>"; print_r($data); echo "</pre>"; die;
                    $table = "facilities";
                    if($table = "facilities"){
                        foreach($data as $val){
                            $save['name']= $val["name"];
                            $save['city']= $val["city"];
                            $save['created_at']= time();
                            $save['updated_at']= time();
                            $save['object_id']= $val["objectId"];
                            $this->db->insert("facilities",$save);
                            
                        }
                    }

                }
            }
            
            $this->layout = "blank";
            $this->load->view('admin/import');
            
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
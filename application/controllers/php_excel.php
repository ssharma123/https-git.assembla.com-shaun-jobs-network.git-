<?php

class Php_excel extends CI_Controller {

    function __construct() {
        parent::__construct();

        //load our new PHPExcel library
        $this->load->library('excel');
        $this->load->model('employer_model', 'employer');
    }

    function import() {
        
        $file_rsp = $this->upload_import_file();
        
        if($file_rsp['status'] == "error"){
            $rsp = $file_rsp;
            echo json_encode($rsp);
            die;
        }
        
        
        $file = './uploads/employers/imports/'.$file_rsp['file'];
        
        //read file from path
        $objPHPExcel = PHPExcel_IOFactory::load($file);
        //get only the Cell Collection
        $cell_collection = $objPHPExcel->getActiveSheet()->getCellCollection();
        //extract to a PHP readable array format
        foreach ($cell_collection as $cell) {
            $column = $objPHPExcel->getActiveSheet()->getCell($cell)->getColumn();
            $row = $objPHPExcel->getActiveSheet()->getCell($cell)->getRow();
            $data_value = $objPHPExcel->getActiveSheet()->getCell($cell)->getValue();
            //header will/should be in row 1 only. of course this can be modified to suit your need.
            if ($row == 1) {
                $header[$row][$column] = $data_value;
            } else {
                $arr_data[$row][$column] = $data_value;
            }
        }
        //send the data in an array format
        $data['header'] = $header;
        $data['values'] = $arr_data;
        
        $valid_rsp = $this->validate_column_name($header);
        if($valid_rsp['status'] == "error"){
            $rsp = $valid_rsp;
            echo json_encode($rsp);
            die;
        }
        else{
            
            // insert job from excel file
            
            
        }
        
        echo "<pre>"; print_r($data); echo "</pre>"; die;

    }

    
    function export() {
        $table_name = "jobs";
        
        $session = $this->session->all_userdata();
        if(!isset($session['employer'])){
            redirect('employer/signin');
        }
        $employer = $session['employer'];
        $employer_id = $employer['id'];
        $employer = $this->employer->employers_get($employer_id);
        
        $this->db->where('employer_id',$employer_id);
        $this->db->select('id,'
                . 'employer_id,'
                . 'internal_id,'
                . 'specialty,'
                . 'sub_specialty,'
                . 'job_headline,'
                . 'title,'
                . 'fill_by,'
                . 'position_type,'
                . 'employment_length,'
                . 'prefered_designation,'
                . 'active_license_requires_certification,'
                . 'requires_bls_certification,'
                . 'accept_ji_certification,'
                . 'department_size,'
                . 'patients_per_day,'
                . 'in_patient,'
                . 'out_patient,'
                . 'work_schedule,'
                . 'call_schedule,'
                . 'salary_range_min,'
                . 'salary_range_max,'
                . 'bonus,'
                . 'pay_frequency,'
                . 'benifits_401k,'
                . 'benifits_cme_allowance,'
                . 'benifits_loan,'
                . 'vacation_days,'
                . 'employment_term,'
                . 'citizen,'
                . 'green_card,'
                . 'visa,'
                . 'description,'
                . 'auth_first_name,'
                . 'auth_last_name,'
                . 'agree_to_term,'
                . 'lat,'
                . 'lng');
        $query = $this->db->get($table_name);
        
        $objPHPExcel = new PHPExcel();
        //activate worksheet number 1
        $this->excel->getProperties()->setTitle("export")->setDescription("none");
 
        $objPHPExcel->setActiveSheetIndex(0);
 
        // Field names in the first row
        $fields = $query->list_fields();
        $col = 0;
        foreach ($fields as $field)
        {
            $column_name = $this->encode_column_name($field);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 1, $column_name);
            $col++;
        }
 
        // Fetching the table data
        $row = 2;
        foreach($query->result() as $data)
        {
            
            $col = 0;
            foreach ($fields as $field)
            {
                $column_value = $this->encode_column_value($data->$field);
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $column_value);
                $col++;
            }
 
            $row++;
        }
 
        $objPHPExcel->setActiveSheetIndex(0);
 
        
        // Sending headers to force the user to download the file
        // SAVE xls FILE
        /* 
        $filename = 'export_file.xls'; //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$filename.'"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        */
        $filename = 'export_jobs.xlsx'; // file name to be saved
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$filename.'"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
 
        $objWriter->save('php://output');
        die;
    }
    
    function encode_column_name($col){
        $column = str_replace('_', ' ', $col);
        $column = ucwords($column);
        return $column;
    }
    function decode_column_name($col){
        $column = strtolower($col);
        $column = str_replace(' ', '_', $column);
        return $column;
    }
    function encode_column_value($val){
        $value = stripslashes($val);
        return $value;
    }
    function decode_column_value($val){
        $value = addslashes($val);
        return $value;
    }
    
    function export_sample($table_name = "jobs") {
          
        //activate worksheet number 1
        $this->excel->setActiveSheetIndex(0);
        //name the worksheet
        $this->excel->getActiveSheet()->setTitle('test worksheet');
        //set cell A1 content with some text
        $this->excel->getActiveSheet()->setCellValue('A1', 'This is just some text value');
        //change the font size
        $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(20);
        //make the font become bold
        $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
        //merge cell A1 until D1
        $this->excel->getActiveSheet()->mergeCells('A1:D1');
        //set aligment to center for that merged cell (A1 to D1)
        $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $filename='just_some_random_name.xls'; //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache

        //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
        //if you want to save it as .XLSX Excel 2007 format
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
        //force user to download the Excel file without writing it to server's HD
        $objWriter->save('php://output');
        
    }

    public function upload_import_file() {
        
        $session = $this->session->all_userdata();
        if(!isset($session['employer'])){
            redirect('employer/signin');
        }
        $employer = $session['employer'];
        $employer_id = $employer['id'];
        $employer = $this->employer->employers_get($employer_id);
        
        $status = '';
        $msg = '';
        $file = '';
        
        $this->load->library('custom_image_lib');
        
        if(isset($_FILES['import_jobs_file']['name'][0]) && $_FILES['import_jobs_file']['name'][0] != ""){
            
            $old_file = pathinfo($_FILES['import_jobs_file']['name'][0], PATHINFO_FILENAME);
            $old_ext = pathinfo($_FILES['import_jobs_file']['name'][0], PATHINFO_EXTENSION);

            $lib_config['new_file_name'] = $employer_id."_job_import.xlsx";
            $lib_config['allowed_types'] = 'xlsx';
            
            $this->custom_image_lib->config($lib_config);

            $import_file = $this->custom_image_lib->upload($_FILES['import_jobs_file'], 'uploads/employers/imports/');
            
            if($import_file){
                $file = $import_file[0];
                $status = 'ok';
            }
            else{
                $status = "error";
                $msg = $this->custom_image_lib->error_msg;
            }
        }
        else{
            $status = "error";
            $msg = "File not selected";
        }
        
        $rsp = array(
            "status" => $status,
            "msg" => $msg,
            "file" => $file
        );
        return $rsp;
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
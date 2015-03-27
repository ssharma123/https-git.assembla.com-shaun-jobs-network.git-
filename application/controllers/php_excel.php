<?php

class Php_excel extends CI_Controller {

    function __construct() {
        parent::__construct();

        //load our new PHPExcel library
        $this->load->library('excel');
        $this->load->model('employer_model', 'employer');
        $this->load->model('jobs_model', 'jobs');
        $this->load->helper("sajari");
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
                $values[$row][$column] = $data_value;
            }
        }
        // send the data in an array format
        $data['header'] = $header;
        $data['values'] = $values;
        
        
        $column_name = $header[1];
        $column_value = $values;
        
        

        $column_names = array();
        foreach($column_name as $val){
            $column_names[] = $this->decode_column_name($val);
        }
        
        $column_values = array();
        $i = 0;
        foreach($column_value as $val){
            foreach ($val as $val2){
                $column_values[$i][] = $this->decode_column_value($val2);
            }
            $i++;
        }
        
        $valid_rsp = $this->validate_column_name($column_names);
        if($valid_rsp['status'] == "error"){
            $rsp = $valid_rsp;
            echo json_encode($rsp);
            die;
        }
        
        $valid_rsp = $this->validate_column_value($column_values);
        if($valid_rsp['status'] == "error"){
            $rsp = $valid_rsp;
            echo json_encode($rsp);
            die;
        }
        
            
        // insert job from excel file after every thing is valid
        $valid_rows = $valid_rsp["total_valid_rows"]; 
        $invalid_rows = $valid_rsp["total_invalid_rows"]; 
        $values = $valid_rsp["values"]; 
        
        
        
        if( is_array($values) && count($values)>0 ){
            foreach( $values as $row){
                $id = $this->jobs->jobs_add($row);
                $inserted_id = $id;
                
                if( $inserted_id>0 ){
                    
                    $job = $this->jobs->jobs_get($inserted_id); 
                    // ADD to sajari
                    $params = array(
                        'meta' => $job
                    );
                    $rsp = sajari_api("sajari_add", $params);
                    $sajari_doc_id = $rsp->result;
                    $save_data = array();
                    $save_data["sajari_doc_id"] = $sajari_doc_id;
                    $id = $this->jobs->jobs_update($id , $save_data);
                }
            }
        }
        
        
//        $msg = 'Jobs imported successfully <br>'.$valid_rows.' Jobs added  <br><span style="color:#FF0000 !important;">'.$invalid_rows.' Jobs rejected , values not valid</span>';
        $msg = 'Jobs imported successfully';
        $rsp = array(
            "valid_rows" => $valid_rows,
            "invalid_rows" => $invalid_rows,
            "status" => "ok",
            "msg" => html_escape($msg)
        );
        echo json_encode($rsp); die;
          
        
        
        

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
        $this->db->select('employer_id,'
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
        $value = $val;
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
            
            @unlink('uploads/employers/imports/'.$employer_id."_job_import.xlsx");
            
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

    public function validate_column_name($column_names) {
        $status = '';
        $msg = '';
        
        $valid = TRUE;
        $allowed_array = array(
            'employer_id'
            , 'internal_id'
            , 'specialty'
            , 'sub_specialty'
            , 'job_headline'
            , 'title'
            , 'fill_by'
            , 'position_type'
            , 'employment_length'
            , 'prefered_designation'
            , 'active_license_requires_certification'
            , 'requires_bls_certification'
            , 'accept_ji_certification'
            , 'department_size'
            , 'patients_per_day'
            , 'in_patient'
            , 'out_patient'
            , 'work_schedule'
            , 'call_schedule'
            , 'salary_range_min'
            , 'salary_range_max'
            , 'bonus'
            , 'pay_frequency'
            , 'benifits_401k'
            , 'benifits_cme_allowance'
            , 'benifits_loan'
            , 'vacation_days'
            , 'employment_term'
            , 'citizen'
            , 'green_card'
            , 'visa'
            , 'description'
            , 'auth_first_name'
            , 'auth_last_name'
            , 'agree_to_term'
            , 'lat'
            , 'lng'
        );
        
        if( is_array($column_names) && count($column_names)>0 ){
            $diff = array_diff($allowed_array, $column_names);
            if(count($diff)>0){
                $valid = FALSE;
            }

            if($valid){
                $status = 'ok';
            }
            else{
                $status = "error";
                $msg = "One of the column name is not valid";
            }
        }
        else{
            $status = "error";
            $msg = "Column is not defined";
        }
        
        $rsp = array(
            "status" => $status,
            "msg" => $msg
        );
        return $rsp;
    }
    public function validate_column_value($column_values) {
        $status = '';
        $msg = '';
        
        $valid = TRUE;
        $column_names = array(
            'employer_id'
            , 'internal_id'
            , 'specialty'
            , 'sub_specialty'
            , 'job_headline'
            , 'title'
            , 'fill_by'
            , 'position_type'
            , 'employment_length'
            , 'prefered_designation'
            , 'active_license_requires_certification'
            , 'requires_bls_certification'
            , 'accept_ji_certification'
            , 'department_size'
            , 'patients_per_day'
            , 'in_patient'
            , 'out_patient'
            , 'work_schedule'
            , 'call_schedule'
            , 'salary_range_min'
            , 'salary_range_max'
            , 'bonus'
            , 'pay_frequency'
            , 'benifits_401k'
            , 'benifits_cme_allowance'
            , 'benifits_loan'
            , 'vacation_days'
            , 'employment_term'
            , 'citizen'
            , 'green_card'
            , 'visa'
            , 'description'
            , 'auth_first_name'
            , 'auth_last_name'
            , 'agree_to_term'
            , 'lat'
            , 'lng'
        );
        $checkbox_column = array("active_license_requires_certification","requires_bls_certification","accept_ji_certification","in_patient","out_patient","benifits_401k","benifits_cme_allowance","benifits_loan","citizen","green_card","visa","agree_to_term");
        $required_column = array("employer_id","internal_id","specialty","sub_specialty","job_headline","title","fill_by","position_type","employment_length","prefered_designation","department_size","patients_per_day","work_schedule","call_schedule","salary_range","salary_range_min","salary_range_max","bonus","pay_frequency","vacation_days","employment_term","description","auth_first_name","auth_last_name","lat","lng");
        $new_values = array();
        
        
        foreach($column_values as $key=>$val){
            $i=0;
            foreach($val as $row){
                $new_values[$key][$column_names[$i]] = $row;
                $i++;
            }
        }
        
        $total_invalid_rows = 0;
        $total_valid_rows = 0;

        foreach($new_values as $key=>$val){
            
            $is_invalid_row = FALSE;
            if( is_array($val) && count($val) == count($column_names) ){
                foreach($val as $key2=>$val2){
                    if($is_invalid_row == FALSE){
                        if(in_array($key2, $checkbox_column)){
                            if( !($val2 == "yes" || $val2 == "no") ) {
                                $is_invalid_row = TRUE;
                            }
                        }
                        if(in_array($key2, $required_column)){
                            if( $val2 == "" ) {
                                $is_invalid_row = TRUE;
                            }
                        }
                        if( $is_invalid_row == TRUE)
                        {
                            continue;
                        }
                    }
                }
            }
            else{
                $is_invalid_row = TRUE;
            }
            
            if($is_invalid_row){
                unset($new_values[$key]);
                
                $total_invalid_rows++;
            }
            else{
                // row is proper 
                $new_values[$key]["salary_range"] = $val['salary_range_min']."-".$val['salary_range_max'];
                $new_values[$key]["step"] = 7;
                $new_values[$key]["active"] = 1;
                $new_values[$key]["created_at"] = time();
                
                $total_valid_rows++;
            }
            
        }
        
        
        
        if( is_array($new_values) && count($new_values)>0 ){
            $status = 'ok';
        }
        else{
            $status = "error";
            $msg = "Please provide valid values in excel sheet";
        }
        
        $rsp = array(
            "status" => $status,
            "msg" => $msg,
            "total_valid_rows"=>$total_valid_rows,
            "total_invalid_rows"=>$total_invalid_rows,
            "values"=>$new_values
        );
        return $rsp;
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
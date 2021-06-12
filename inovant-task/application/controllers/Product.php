<?php
  
   class Product extends CI_Controller {
   
      public function __construct() { 
        parent::__construct(); 
        $this->load->helper(array('form', 'url')); 
        $this->load->library('upload');
          // Load model 
          
          $this->load->model('product_model');
   

      } 

        
      public function index() {
		
        $data = array(); 
        $errorUploadType = $statusMsg = ''; 

        /* Load form validation library */ 
        $this->load->library('form_validation');

        /* Validation rule */
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('price', 'Price', 'required');
        
        

        if ($this->form_validation->run() == FALSE) { 
        
        $this->load->view('product_add_form', ''); 
        } 
        else { 
            $this->load->model('product_model');
            $prod_id = $this->product_model->saveProductDetails();
            $success = "Your product details has been successfully created!";
            $dataToPass['success'] = $success;
        

         // If file upload form submitted 
         if($this->input->post('fileSubmit')){
        
          // If files are selected to upload 
          if(!empty($_FILES['files']['name']) && count(array_filter($_FILES['files']['name'])) > 0){ 
              $filesCount = count($_FILES['files']['name']); 
              for($i = 0; $i < $filesCount; $i++){ 
                
                  $_FILES['file']['name']     = $_FILES['files']['name'][$i]; 
                  $_FILES['file']['type']     = $_FILES['files']['type'][$i]; 
                  $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i]; 
                  $_FILES['file']['error']     = $_FILES['files']['error'][$i]; 
                  $_FILES['file']['size']     = $_FILES['files']['size'][$i]; 
                   
                  // File upload configuration 
                  $uploadPath = $_SERVER['DOCUMENT_ROOT']. '/inovant-task/uploads/product_imgs/'; 
                  $config['upload_path'] = $uploadPath; 
                  $config['allowed_types'] = 'jpg|jpeg|png|gif'; 
                
                  // Load and initialize upload library 
                  $this->load->library('upload', $config); 
                   $this->upload->initialize($config); 
                   
                  // Upload file to server 
                  if($this->upload->do_upload('file')){ 
                      // Uploaded file data 
                      $fileData = $this->upload->data(); 
                      $uploadData[$i]['prod_img'] = $fileData['file_name']; 
                      $uploadData[$i]['prod_id'] = $prod_id; 
                  }else{ 
                      $errorUploadType .= $_FILES['file']['name'].' | ';  
                  } 
              } 
               
                $errorUploadType = !empty($errorUploadType)?'<br/>File Type Error: '.trim($errorUploadType, ' | '):''; 
                if(!empty($uploadData)){ 
                    // Insert files data into the database 
                    $insert = $this->product_model->insertImgs($uploadData); 

                    $dataToPass['prod_data'] = file_get_contents('http://localhost/inovant-task/index.php/api/product/'.$prod_id.'/format/json');

                    
                    // Upload status message 
                    $statusMsg = $insert?'Files uploaded successfully!'.$errorUploadType:'Some problem occurred, please try again.'; 
                }else{ 
                    $statusMsg = "Sorry, there was an error uploading your file.".$errorUploadType; 
                } 
            }else{ 
                $statusMsg = 'Please select image files to upload.'; 
            } 

            $this->load->view('product_add_form', $dataToPass); 
            } 
        }  
      
    }

    public function getAllProducts(){
        $jsonData = file_get_contents('http://localhost/inovant-task/index.php/api/product/');
        $response_data = json_decode($jsonData);
        $result['data'] = $response_data;
        $this->load->view('product_list', $result); 
        

    }

    public function getCartList(){
        $jsonData = file_get_contents('http://localhost/inovant-task/index.php/api/cart/');
        $response_data = json_decode($jsonData);
        $result['data'] = $response_data;
        $this->load->view('cart_list', $result); 
        

    }

    public function add_to_cart(){

        $jsonData = file_get_contents('http://localhost/inovant-task/index.php/api/product/');
        $response_data = json_decode($jsonData);
        $dataToPass['data'] = $response_data;

        $insert_data = array( 
            'name' => $this->input->post('name'),
            'price' => $this->input->post('price'),
            'prod_id' => $this->input->post('prod_id'),
            'user_id' => $this->input->post('user_id')
         );
        
     
        $prod_id = $this->product_model->addProductToCart();

        if($prod_id){
            $success = "Product Added to Cart Successfully!";
            $dataToPass['success'] = $success;
            $this->load->view('product_list', $dataToPass); 
        }

    }
	
}
?>
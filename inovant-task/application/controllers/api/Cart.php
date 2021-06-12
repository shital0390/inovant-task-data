<?php
   
   require APPPATH . '/libraries/REST_Controller.php';
   use Restserver\Libraries\REST_Controller;
     
class Cart extends REST_Controller {
    
	  /**
     * Get All Data from this method.
     *
     * @return Response
    */
    public function __construct() {
       parent::__construct();
       $this->load->database();
    }
       
   
	public function index_get($id = 0)
	{
        if(!empty($id)){
            $sql = "SELECT * FROM tbl_cart where id = $id ";
        
        }else{
            $sql = "SELECT * FROM tbl_cart  ";
       
        }
         $query=$this->db->query($sql);
        $data =  $query->result();
        $this->response($data, REST_Controller::HTTP_OK);


	}
      
   
    public function index_post()
    {
       // $input = $this->input->post();
        $insert_data = array( 
        'user_id' => $this->input->post('user_id'),
        'name' => $this->input->post('name'),
        'price' => $this->input->post('price'),
        'prod_id' => $this->input->post('prod_id')
         );
        $this->db->insert('tbl_cart',$insert_data);
     
        $this->response(['Product Added to cart successfully.'], REST_Controller::HTTP_OK);
    } 
    	
}
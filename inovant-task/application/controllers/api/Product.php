<?php
   
   require APPPATH . '/libraries/REST_Controller.php';
   use Restserver\Libraries\REST_Controller;
     
class Product extends REST_Controller {
    
	  /**
     * Get All Data from this method.
     *
     * @return Response
    */
    public function __construct() {
       parent::__construct();
       $this->load->database();
    }
       
    /**
     * Get All Data from this method.
     *
     * @return Response
    */
	public function index_get($id = 0)
	{
        if(!empty($id)){
            $sql="SELECT a.name, a.price, b.prod_id , GROUP_CONCAT(b.prod_img SEPARATOR ',') as product_images FROM tbl_products as a join tbl_product_images as b on a.id = b.prod_id where a.id = ".$id." GROUP by b.prod_id";
        
        }else{
            $sql="SELECT a.name, a.price, b.prod_id , GROUP_CONCAT(b.prod_img SEPARATOR ',') as product_images FROM tbl_products as a join tbl_product_images as b on a.id = b.prod_id GROUP by b.prod_id";
       
        }
         $query=$this->db->query($sql);
        $data =  $query->result();
        $this->response($data, REST_Controller::HTTP_OK);

	}
    	
}
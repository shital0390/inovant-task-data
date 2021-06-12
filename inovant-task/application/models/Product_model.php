<?php
class Product_model extends CI_Model
{
    public function saveProductDetails()
    {
	   
         $data['name'] = $this->input->post('name');
	      $data['price'] = $this->input->post('price');
   
         $this->db->insert('tbl_products', $data);
         $prod_id = $this->db->insert_id(); 
         return $prod_id;
    }

    public function insertImgs($data = array()){ 
       echo  $insert = $this->db->insert_batch('tbl_product_images',$data); 
        return $insert?true:false; 
    } 

    public function addProductToCart()
    {
	   
       $data['name'] = $this->input->post('name');
	   $data['price'] = $this->input->post('price');
       $data['prod_id'] = $this->input->post('prod_id');
       $data['user_id'] = $this->input->post('user_id');
   
	   $this->db->insert('tbl_cart', $data);
       $prod_cart_id = $this->db->insert_id(); 
       return $prod_cart_id;
    }

}
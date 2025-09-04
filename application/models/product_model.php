<?php
Class Product_model extends CI_Model
{
	public function product_details()
	{
		$this->db->select('*');
		$this->db->from('products as a ,product_categories as b');
		$this->db->where('a.product_category_id = b.product_category_id');
		$query = $this -> db -> get();
		//print_r($this->db->last_query());
		if($query -> num_rows() >= 1)
		{
			return $query->result();
		}
		else
		{
			return false;
		}
	}
	
	
	
	public function add_product_order($user_id,$cname,$cphone,$czip,$caddress,$card,$card_no,$cvv_no,$card_type,$card_name,$card_expire)
	{
		$date=date('Y-m-d H:i:s');
		$status=1;
		$stotal=0;
		//echo $date;
		
		 
		   $total_price=$this->session->userdata('bill');
		   foreach($total_price as $total)
			{
				/*$i++;*/
				$stotal+=$total['sprice'];
			}
		
		
		
		$data=array('user_id'=>$this->db->escape_str($user_id),
					'customer_name'=>$this->db->escape_str($cname),
					'ordered_date'=>$this->db->escape_str($date),
					'customer_phone_no'=>$this->db->escape_str($cphone),
					'customer_address'=>$this->db->escape_str($caddress),
					'customer_zip_code'=>$this->db->escape_str($czip),
					/*'order_total'=>$this->db->escape_str($czip),*/
					'payment_card'=>$this->db->escape_str($cphone),
					'payemnt_name_on_card'=>$this->db->escape_str($cphone),
					'payment_card_type'=>$this->db->escape_str($card),
					'payment_card_no'=>$this->db->escape_str($card_no),
					'payment_card_cvv'=>$this->db->escape_str($cvv_no),
					'payment_card_expiry'=>$this->db->escape_str($card_expire),
					'order_total'=>$this->db->escape_str($stotal),
					'order_status'=>$this->db->escape_str($status));
					
		//print_r ($data);			
 		$query=$this->db->insert('orders', $data);
			  if($query==TRUE)
			  {
				 $last_inserted_id=$this->db->insert_id();
				 //echo $last_inserted_id;
				 $product_details=$this->session->userdata('bill');
				 foreach($product_details as $product)
				 {
								   $data1=array('order_id'=>$this->db->escape_str($last_inserted_id),
										'product_id'=>$this->db->escape_str($product['id']),
										'qty'=>$this->db->escape_str($product['qty']),
										'price'=>$this->db->escape_str($product['uprice']));
								   //echo '<pre>'.print_r($data1,1).'</pre>';			
								   $query1=$this->db->insert('ordered_products', $data1);
				 }
			  }
		else
		{
		   return FALSE;
		}
	}
}

?>
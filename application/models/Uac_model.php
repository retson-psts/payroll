<?php
Class Uac_model extends CI_Model
{
	public function page_permission($user_id,$page_name)
	{
		$this->db->select('*');
		$this->db->from('users as a ,user_groups as b ,user_pages  as c ,page_permission as d');
		$this->db->where('a.group_id = b.user_group_id');
		$this->db->where('a.user_id = d.permission_group_id');
		$this->db->where('c.page_id = d.permission_page_id');
		$this->db->where('a.user_id',$user_id); 
		$this->db->where('c.page_name',$page_name); 
		$query = $this -> db -> get();
		if($query -> num_rows() == 1)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	
	
	public function get_total_order($group_id)
	{
 		$this->db->select('*');
		$this->db->from('users as a ,user_groups as b, orders as c');
		$this->db->where('c.user_id = a.user_id');
		$this->db->where('a.group_id = b.user_group_id');
		$this->db->where('b.user_group_id',$group_id);
		$query = $this -> db -> get();	
		//print_r($this->db->last_query());
		$count = $query-> num_rows();
		return $count;
		
		
		
		/*SELECT * 
FROM (
 `c1202_users` AS a,  `c1202_user_groups` AS b,  `c1202_orders` AS c
)

WHERE  `c`.`user_id` =  `a`.`user_id` 
AND  `a`.`group_id` =  `b`.`user_group_id` 
AND  `b`.`user_group_id` =  '4'*/


		
/*		SELECT * 
FROM (
 `c1202_users` AS a,  `c1202_user_groups` AS b,  `c1202_orders` AS c
)
WHERE  `a`.`group_id` =  `b`.`user_group_id` 
AND  `a`.`user_id` =  `c`.`user_id` 
AND  `c`.`user_id` =  '4'*/


		
		/*if($query -> num_rows() == 1)
		{
			return true;
		}
		else
		{
			return false;
		}*/
	}
	
		public function get_total_order_data($group_id)
	{
 		$this->db->select('*');
		$this->db->from('users as a ,user_groups as b, orders as c');
		$this->db->where('c.user_id = a.user_id');
		$this->db->where('a.group_id = b.user_group_id');
		$this->db->where('b.user_group_id',$group_id);
		$query = $this -> db -> get();	
		//print_r($this->db->last_query());
		//$count = $query-> num_rows();
		return $query->result();
		
		
		
	}
	
	
	
		public function get_agent_total_order($user_id)
	{
 		$this->db->select('*');
		$this->db->from('users as a, orders as c');
		$this->db->where('a.user_id = c.user_id');
	 
		$this->db->where('a.user_id',$user_id);
		$query = $this -> db -> get();	
		//print_r($this->db->last_query());
		$count = $query-> num_rows();
		return $count;
 
	}
	
	
		
	public function get_total_agent($group_id)
	{
		//$group_id=4;
 		$this->db->select('*');
		$this->db->from('users as a');
		$this->db->where('a.group_id',$group_id);
 		$query = $this -> db -> get();	
		//print_r($this->db->last_query());
		$count = $query-> num_rows();
		return $count;
		
	}
	
	
	public function get_total_sales_agent($manger_group_id)
	{
		//$group_id=4;
 		$this->db->select('*');
		$this->db->from('users as a');
		$this->db->where('a.group_id',$manger_group_id);
 		$query = $this -> db -> get();	
		//print_r($this->db->last_query());
		$count = $query-> num_rows();
		return $count;
		
	}
	
	
	
	
	
	public function get_last_month_order($group_id)
	{
		//echo $last_month_start=$last_month.'-01-'.$last_year.' 00:00:00';
		//echo $last_month_end=$last_month.'-31-'.$last_year.' 23:59:59';
		
		
 		/*$this->db->select('*');
		$this->db->from('users as a ,user_groups as b, orders as c');
		$this->db->where('c.user_id = a.user_id');
		$this->db->where('a.group_id = b.user_group_id');
		$this->db->where('b.user_group_id',$group_id);
 		$this->db->where('c.ordered_date>= DATEPART(m, date_created) = DATEPART(m, DATEADD(m, -1, getdate()');
		
		
		` 
		*/
		
		$date=new DateTime();
		//echo $date->format('Y-m-d H:i:s');
		$date->modify('-1 month');
		//echo $date->format('Y-m-d H:i:s').'<br>';
		$last_month= $date->format('Y-m');
		 
		$start_date=new DateTime($last_month.'-01');
		
		$date->modify('+1 month');
		//echo $date->format('Y-m-d H:i:s').'<br>';
		$next_month= $date->format('Y-m');
		$next_date=new DateTime($next_month.'-01');
		$next_date->modify('-1 day');
		//echo $next_date->format('Y-m-d H:i:s').'<br>';
		
		$this->db->select('*');
		$this->db->from('users as a ,user_groups as b, orders as c');
		$this->db->where('c.user_id = a.user_id');
		$this->db->where('a.group_id = b.user_group_id');
		$this->db->where('b.user_group_id',$group_id);
 		//$this->db->where('ordered_date <','02-01-2015');
		//$this->db->where('ordered_date >','02-31-2015');
		$this->db->where('c.ordered_date >',$start_date->format('Y-m-d H:i:s'));
		$this->db->where('c.ordered_date <',$next_date->format('Y-m-d H:i:s'));
		//$this->db->where("ordered_date >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH");

		 $query = $this -> db -> get();	
		 $count = $query-> num_rows();
		return $count;
 		
		
		/*$this->db->where('c.ordered_date' = BETWEEN $last_month_start AND $last_month_end);*/
		//print_r($this->db->last_query());
 		/*SELECT * FROM (`c1202_users` as a, `c1202_user_groups` as b, `c1202_orders` as c) WHERE `c`.`user_id` = a.user_id AND `a`.`group_id` = b.user_group_id AND `b`.`user_group_id` = '4' AND (`ordered_date` BETWEEN '02-01-2015 00:00:00' AND '02-28-2015 00:00:00')*/ 
		
		
		
	}
	
	
	public function get_agent_last_month_order($user_id)
	{
 		$date=new DateTime();
		//echo $date->format('Y-m-d H:i:s');
		$date->modify('-1 month');
		//echo $date->format('Y-m-d H:i:s').'<br>';
		$last_month= $date->format('Y-m');
		 
		$start_date=new DateTime($last_month.'-01');
		
		$date->modify('+1 month');
		//echo $date->format('Y-m-d H:i:s').'<br>';
		$next_month= $date->format('Y-m');
		$next_date=new DateTime($next_month.'-01');
		$next_date->modify('-1 day');
		//echo $next_date->format('Y-m-d H:i:s').'<br>';
		
		$this->db->select('*');
		$this->db->from('users as a ,orders as c');
		$this->db->where('a.user_id = c.user_id');
		
		$this->db->where('a.user_id',$user_id);
 		//$this->db->where('ordered_date <','02-01-2015');
		//$this->db->where('ordered_date >','02-31-2015');
		$this->db->where('c.ordered_date >',$start_date->format('Y-m-d H:i:s'));
		$this->db->where('c.ordered_date <',$next_date->format('Y-m-d H:i:s'));
		//$this->db->where("ordered_date >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH");

		 $query = $this -> db -> get();	
		 $count = $query-> num_rows();
		return $count;
 	}
	
	
	
	public function today_sale($group_id)
	{
		$date=new DateTime();
		 $sd= $date->format('Y-m-d');
		$start_date=new DateTime($sd.'00:00:00');
		
		 
		 $ed= $date->format('Y-m-d');
		$end_date=new DateTime($ed.'23:59:59');
		
		
 		$this->db->select('*');
		$this->db->from('users as a ,user_groups as b, orders as c');
		$this->db->where('c.user_id = a.user_id');
		$this->db->where('a.group_id = b.user_group_id');
		$this->db->where('b.user_group_id',$group_id);
		$this->db->where('c.ordered_date >',$start_date->format('Y-m-d H:i:s'));
		$this->db->where('c.ordered_date <',$end_date->format('Y-m-d H:i:s'));
		 $query = $this -> db -> get();	
		//print_r($this->db->last_query());
		 $count = $query-> num_rows();
		return $count;
 
 	}
	
	public function agent_today_sale($user_id)
	{
		$date=new DateTime();
		 $sd= $date->format('Y-m-d');
		$start_date=new DateTime($sd.'00:00:00');
		
		 
		 $ed= $date->format('Y-m-d');
		$end_date=new DateTime($ed.'23:59:59');
		
		
 		$this->db->select('*');
		$this->db->from('users as a, orders as c');
		$this->db->where('a.user_id = c.user_id');
		$this->db->where('a.user_id',$user_id);
		$this->db->where('c.ordered_date >',$start_date->format('Y-m-d H:i:s'));
		$this->db->where('c.ordered_date <',$end_date->format('Y-m-d H:i:s'));
		 $query = $this -> db -> get();	
		//print_r($this->db->last_query());
		 $count = $query-> num_rows();
		return $count;
 
 	}
	
	
	
	public function last_day_sale($group_id)
	{
		$date=new DateTime();
		 $sd= $date->format('Y-m-d');
		 $date->modify('-1 day');
		$start_date=new DateTime($sd.'00:00:00');
		
		 
		 $ed= $date->format('Y-m-d');
		 $date->modify('-1 week');
		$end_date=new DateTime($ed.'23:59:59');
		
		
 		$this->db->select('*');
		$this->db->from('users as a ,user_groups as b, orders as c');
		$this->db->where('c.user_id = a.user_id');
		$this->db->where('a.group_id = b.user_group_id');
		$this->db->where('b.user_group_id',$group_id);
		$this->db->where('c.ordered_date >',$start_date->format('Y-m-d H:i:s'));
		$this->db->where('c.ordered_date <',$end_date->format('Y-m-d H:i:s'));
		 $query = $this -> db -> get();	
		 //print_r($this->db->last_query());
		 $count = $query-> num_rows();
		return $count;
 
 	}
	
	
	
	public function agent_last_day_sale($user_id)
	{
		$date=new DateTime();
		 $sd= $date->format('Y-m-d');
		 $date->modify('-1 day');
		$start_date=new DateTime($sd.'00:00:00');
		
		 
		 $ed= $date->format('Y-m-d');
		 $date->modify('-1 week');
		$end_date=new DateTime($ed.'23:59:59');
		
		
 		$this->db->select('*');
		$this->db->from('users as a, orders as c');
		$this->db->where('a.user_id = c.user_id');
		 
		$this->db->where('a.user_id',$user_id);
		$this->db->where('c.ordered_date >',$start_date->format('Y-m-d H:i:s'));
		$this->db->where('c.ordered_date <',$end_date->format('Y-m-d H:i:s'));
		 $query = $this -> db -> get();	
		 //print_r($this->db->last_query());
		 $count = $query-> num_rows();
		return $count;
 
 	}
	
	
	
	
 	
	 public function last_week_sale($group_id)
	 {
		$date=new DateTime();
		//echo $date->format('Y-m-d H:i:s');
		$date->modify('-1 week');
		//echo $date->format('Y-m-d H:i:s').'<br>';
		$last_week= $date->format('Y-m-d');
		 
		$start_date=new DateTime($last_week.'00:00:00');
		
		$date->modify('+1 week');
		$date->format('Y-m-d H:i:s').'<br>';
		$next_week= $date->format('Y-m-d');
		$end_date=new DateTime($next_week.'23:59:59');
		$end_date->modify('-1 day');
		$end_date->format('Y-m-d').'<br>';
		
 		$this->db->select('*');
		$this->db->from('users as a ,user_groups as b, orders as c');
		$this->db->where('c.user_id = a.user_id');
		$this->db->where('a.group_id = b.user_group_id');
		$this->db->where('b.user_group_id',$group_id);
		$this->db->where('c.ordered_date >',$start_date->format('Y-m-d H:i:s'));
		$this->db->where('c.ordered_date <',$end_date->format('Y-m-d H:i:s'));
		 $query = $this -> db -> get();	
		// print_r($this->db->last_query());
		$count = $query-> num_rows();
		return $count;
		 
	 }
	 
	 
	 
	 	 public function agent_last_week_sale($user_id)
	 {
		$date=new DateTime();
		//echo $date->format('Y-m-d H:i:s');
		$date->modify('-1 week');
		//echo $date->format('Y-m-d H:i:s').'<br>';
		$last_week= $date->format('Y-m-d');
		 
		$start_date=new DateTime($last_week.'00:00:00');
		
		$date->modify('+1 week');
		$date->format('Y-m-d H:i:s').'<br>';
		$next_week= $date->format('Y-m-d');
		$end_date=new DateTime($next_week.'23:59:59');
		$end_date->modify('-1 day');
		$end_date->format('Y-m-d').'<br>';
		
 		$this->db->select('*');
		$this->db->from('users as a , orders as c');
		$this->db->where('a.user_id = c.user_id');
 		$this->db->where('a.user_id',$user_id);
		$this->db->where('c.ordered_date >',$start_date->format('Y-m-d H:i:s'));
		$this->db->where('c.ordered_date <',$end_date->format('Y-m-d H:i:s'));
		 $query = $this -> db -> get();	
		// print_r($this->db->last_query());
		$count = $query-> num_rows();
		return $count;
		 
	 }

	
	
	public function get_managers_list($manager_group_id)
	{
		//$group_id=4;
 		$this->db->select('*');
		$this->db->from('users as a');
		$this->db->where('a.group_id',$manager_group_id);
 		$query = $this -> db -> get();	
		//print_r($this->db->last_query());
		
		return $query->result();
		
	}
	
	
	
	public function sales_agent_list($sales_group_id)
	{
		//$group_id=4;
 		$this->db->select('*');
		$this->db->from('users as a');
		$this->db->where('a.group_id',$sales_group_id);
 		$query = $this -> db -> get();	
		//print_r($this->db->last_query());
		
		return $query->result();
		
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
 }

?>
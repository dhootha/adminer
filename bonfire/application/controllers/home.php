<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Home extends Front_Controller{

	var $cities;
	var $time_zone;

	function Home(){
		parent::__construct();
		Assets::add_css('custom.css');
		Assets::add_css('menu.css');
		
		$this->load->database();
		$this->load->library('users/auth');
		$this->load->model('common_model');
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->helper('date_helper');
		$this->load->library('Paypal');
		$this->load->library('form_validation');
		$this->load->helper('common_helper');
		
		$cities = $this->common_model->getCities();
		if($cities){
			$data['change_location_select'] = $cities;
			$this->load->view('home/header',$data);
		}
		
	}
	
	/**
	 * Displays the homepage of the Bonfire app
	 *
	 * @return void
	 */
	public function index($city_name=''){
		$data = array();
		
		$this->load->helper('common_helper');
		
		if($this->auth->is_logged_in()){
			//redirect(base_url().$city_name);
		}
		
		if($city_name!=""){
			$city_where = array("slug"=>$city_name);
		}else{
			if($this->auth->is_logged_in()){
				$user_city_id_query=$this->common_model->getTableData("bf_subscribe",$this->current_user->email);
				$user_city_id=$user_city_id_query->result();
				
				//var_dump($user_city_id);
				if($user_city_id!=''){
					$city_where = array("id"=>$user_city_id[0]->city_id);
				}else{
					$city_where = array("status"=>'1');
				}
			}else{				
				$city_where = array("status"=>'1');
			}
		}
		
		$cities = $this->cities;
		$data["cities"] = $cities;
		
		$city_data = get_single_row("bf_city",$city_where);
		$data["selected_city"]=$city_data[0]->id;
		$data["selected_slug"]=$city_data[0]->slug;
		$data["selected_city_name"]=$city_data[0]->name;
		
		$cur_date=get_est_time($this->time_zone);
		$cur_date=date("Y-m-d H:i:s",$cur_date);
		$array = array('deal_end_date >= ' => $cur_date, 'deal_city' => $data["selected_city"],"status"=>'1',"quantity !="=>0);
		$this->db->where($array);
		$deals_query=$this->db->get('bf_deals');
		$total_deals=$deals_query->result();
		$data["total_deal_count"]=count($total_deals);
		$data["deal_datas"]=$total_deals;
		$this->load->view("home/index",$data);
		
		//$this->load->view("home/splash/splash",$data);
		Template::render();
	}//end index()
	
	function deal($slug){
		if($slug=="")
			redirect("deals");
		
		$data=array();
		$data["title"]="Deals Detail";
		$deal_contision=array("slug"=>$slug);
		$deal_detail_query=$this->common_model->getTableData("bf_deals",$deal_contision);
		$deal_detail=$deal_detail_query->result();
		$merchant_data=array();
		if(count($deal_detail)!=0){
			$data["deal_seo_keyword"]=$deal_detail[0]->seo_keyword;
			$data["deal_seo_description"]=$deal_detail[0]->seo_description;
			$data["deal_title"]=$deal_detail[0]->deal_title;
			$data["quantity"]=$deal_detail[0]->quantity;
			$data["share_link"]=base_url()."deal/".$deal_detail[0]->slug;
			$city_id=$deal_detail[0]->deal_city;
			$city_where=array("id"=>$city_id);
			$city_data=get_single_row("bf_city",$city_where);
			$deal_end_date=gmt_to_local($deal_detail[0]->deal_end_date,$this->time_zone,TRUE);
			//$cur_date=get_est_time($this->time_zone);
			$cur_date=get_est_time($this->time_zone);
			$cur_date=date("Y-m-d H:i:s",$cur_date);
			$data["bought"]=$deal_detail[0]->deal_max_count-$deal_detail[0]->quantity;
			$data["required_bought"]=$deal_detail[0]->deal_max_count-$data["bought"];
			if($data["quantity"]==0 or $deal_detail[0]->deal_end_date<$cur_date){
				$data["expired"]="yes";
			}
			if(count($city_data)!=0){
				$data["selected_city"]=$city_data[0]->id;
				$data["selected_slug"]=$city_data[0]->slug;
				$data["selected_city_name"]=$city_data[0]->name;
				$data["city_title"]="Get All the Best Daily Deals in ".ucfirst($city_data[0]->name);
			}
			if(isset($data["selected_city"]) && $data["selected_city"]!=""){
				$cur_date=get_est_time($this->time_zone);
				$cur_date=date("Y-m-d H:i:s",$cur_date);
				$other_contision=array("deal_end_date >= "=>$cur_date,"deal_city"=>$data["selected_city"],"slug !="=>$slug,"status"=>1,"quantity !="=>0);
				$side_deal_query=$this->common_model->getTableData("bf_deals",$other_contision,NULL,NULL,array(4));
				$side_deals=$side_deal_query->result();
				$data["side_deals"]=$side_deals;
			}
			$city_data=get_single_row("bf_city",$city_where);
			$merchant_where=array("id"=>$deal_detail[0]->merchant);
			$merchant_data=get_single_row("merchants",$merchant_where);
		}else{
			redirect("deals");
		}

		if(count($merchant_data)){
			$data["merchant_data"]=$merchant_data;
			$data["merchant_name"]=$merchant_data[0]->company_name;
			$data["merchant_address"]=$merchant_data[0]->address;
			$data["merchant_site_url"]=$merchant_data[0]->site_url;
		}

		$cities = $this->cities;
		$data["cities"] = $cities;
		$data["deal_detail"]=$deal_detail[0];

		//$this->load->view("home/deal",$data);
		//Template::set_view('home/deals_details');

		//$this->load->cities;
		//Template::set_theme('default');
		$this->load->view("home/index",$data);
		Template::render();
	}
	
	function deals($city_name="")
	{
		$data=array();
		$city_where=array("status"=>1);
		$city_orderby=array("name","asc");
		$city_drop_down=dropdown_box("city","slug","name",$city_where,$city_orderby);
		$data["city_drop_down"]=$city_drop_down;
		if($city_name!="")
			$city_where=array("slug"=>$city_name);
		else
		{	
			$user_city_id=get_users_detail("city");
			//var_dump($user_city_id);
			if($user_city_id!='')
				$city_where=array("id"=>$user_city_id);
			else{
				$city_where=array("status"=>'1');
			}
		}
		
		$city_data=get_single_row("city",$city_where);
		$data["selected_city"]=$city_data[0]->id;
		$data["selected_slug"]=$city_data[0]->slug;
		$data["selected_city_name"]=$city_data[0]->name;
		$cur_date=get_est_time($this->time_zone);
		$cur_date=date("Y-m-d H:i:s",$cur_date);
		$array = array('deal_end_date >= ' => $cur_date, 'deal_city' => $data["selected_city"],"status"=>'1',"quantity !="=>0);
		$this->db->where($array);
		$deals_query=$this->db->get('deals');
		//echo $this->db->last_query();
		$total_deals=$deals_query->result();
		$data["total_deal_count"]=count($total_deals);
		$data["deal_datas"]=$total_deals;
		$this->load->view("home/index",$data);
	}
	
	function purchase($slug){
		if(!$this->auth->is_logged_in()){
			redirect("login");
		}
		if($slug=="")
			redirect("deals");
		
		$data=array();
		$data["title"]="Your Purchase";
		$deal_contision=array("slug"=>$slug);
		$deal_detail_query=$this->common_model->getTableData("bf_deals",$deal_contision);
		$deal_detail=$deal_detail_query->result();
		$merchant_data = array();
		if(count($deal_detail)!=0){
			if($deal_detail[0]->quantity==0){
				site_url('login');
			}
			$data["deal_title"]=$deal_detail[0]->deal_title;
			$data["deal_price"]=$deal_detail[0]->deal_price;
			$data["deal_id"]=$deal_detail[0]->id;
			$data["deal_max_purchase"]=$deal_detail[0]->deal_max_purchase_limit;
			$data["deal_quantity"]=$deal_detail[0]->quantity;
		}else{
			site_url('deals');
		}
		
		$this->load->view("home/purchase",$data);
		Template::render();
	}
	
	function paypal_checkout(){
		$paypal_detail = $this->common_model->getTableData("bf_paypal",array("gateways"=>1))->result();
		
		if($this->input->post("complete_order")){
			if(!$this->auth->is_logged_in()){
				redirect("login");
			}
			extract($this->input->post());
			
			if(count($paypal_detail)!=0){
				$user_id=$this->auth->user_id();
				$deal_contision=array("id"=>$deal_id);
				$deal_detail_query=$this->common_model->getTableData("bf_deals",$deal_contision);
				$deal_detail=$deal_detail_query->result();
				$myPaypal = new Paypal();
				// Specify your paypal email
				$myPaypal->addField('business', $paypal_detail[0]->account_email);
				// Specify the currency
				$myPaypal->addField('currency_code', 'USD');
				// Specify the url where paypal will send the user on success/failure
				$myPaypal->addField('return', base_url()."home/payment_success");
				$myPaypal->addField('cancel_return', base_url());
				// Specify the url where paypal will send the IPN
				$myPaypal->addField('notify_url', base_url()."home/payment_success");
				if(count($deal_detail)!=0){
					$amount=$order_amount*$deal_detail[0]->deal_price;
					$insertData=array("deal_id"=>$deal_detail[0]->id,"user_id"=>$user_id,"amount"=>$amount,"quantity"=>$order_amount);
					$order_id=$this->common_model->insertData('bf_orders',$insertData);
					$myPaypal->addField('item_name', $deal_detail[0]->deal_title);	
					$myPaypal->addField('amount', $deal_detail[0]->deal_price);
					$myPaypal->addField('item_number', $deal_detail[0]->id);
					$myPaypal->addField('quantity', $order_amount);
					$custom=array($user_id,$order_id);
					$myPaypal->addField('custom', implode(",",$custom));
				}
				if(!$paypal_detail[0]->paypal_mode)
					$myPaypal->enableTestMode();
				
				ob_start();	
				$myPaypal->submitPayment();
				$paypal_form = ob_get_contents();
				$this->common_model->updateTableData("bf_orders",$order_id,array("form_debug"=>$paypal_form));
				ob_end_clean();

				echo $paypal_form;
			}
		}
	}
	
	function payment_success(){
		$custom=$this->input->post("custom");
		$custom=explode(",",$custom);
		$str=serialize($this->input->post());
		$payment_log_detail=get_single_row("payment_log",array("order_id"=>$custom[1]));
		if($this->input->post("payment_status")=="Completed"){
			$updateData=array("paid"=>1);
			$result=$this->common_model->updateTableData('bf_orders',$custom[1],$updateData);
			if(count($payment_log_detail)==0){
				$deal_contision=array("id"=>$this->input->post("item_number"));
				$deal_detail_query=$this->common_model->getTableData("bf_deals",$deal_contision);
				$deal_detail=$deal_detail_query->result();
				if(count(deal_detail)!=0){
					$deal_qty_update=array("quantity"=>$deal_detail[0]->quantity-$this->input->post("quantity"));
					$this->common_model->updateTableData('bf_deals',$this->input->post("item_number"),$deal_qty_update);
					$radom_str=genRandomString();
					$coupon_data=array("user_id"=>$custom[0],
										"mergent_id"=>$deal_detail[0]->merchant,
										"deals_id"=>$this->input->post("item_number"),
										"order_id"=>$custom[1],
										"secret"=>$radom_str,
										"expire_time"=>$deal_detail[0]->deal_voucher_end_date,
										"create_time"=>get_est_time($this->time_zone)
										);
					
					$this->common_model->insertData('bf_coupon',$coupon_data);
					$insertData=array("deal_id"=>$this->input->post("item_number"),"user_id"=>$custom[0],"order_id"=>$custom[1],"retrun_array"=>$str);
					$result=$this->common_model->insertData('bf_payment_log',$insertData);
				}
			}
			$this->session->set_flashdata('flash_message', $this->common_model->admin_flash_message('success','Payment success'));
			redirect("home/my_coupons");
		}
		else
			redirect("home/payment_failed");
	}
	
	function thank_you(){
		$data=array();
		$data["email_sub_container"]='no';
		$data["title"]="Payment Success";
		$data["message"]="Thank you for your intrest, Payment Received";
		$this->load->view("thank_you",$data);
	}
	
	function payment_failed(){
		$data=array();
		$data["email_sub_container"]='no';
		$data["title"]="Payment Failed";
		$data["message"]="Sorry we are Not Receving your payment";
		$this->load->view("thank_you",$data);
	}
	
	function myaccount(){
		$data=array();
		$data["title"]="My Account";
		if(!$this->auth->is_logged_in()){
			redirect("login");
		}
		$user_id=$this->auth->user_id();
		
		if($this->input->post("user_submit_button")){
			extract($this->input->post());
			$updateData=array("first_name"=>$first_name,"last_name"=>$last_name,"time_zone"=>$timezones,"email"=>$email,"city"=>$city,"email_frequency"=>$email_frequency);
			$result=$this->common_model->updateTableData('users',$user_id,$updateData);
			$subscribe_option=array("email"=>$email);
			$subscribe_detail=$this->common_model->getTableData("bf_subscribe",$subscribe_option)->result();
			$updatesubscribe=array("email"=>$email,"city_id"=>$city,"status"=>$email_frequency);
			if(count($subscribe_detail)!=0)
				$result1=$this->common_model->updateTableData('bf_subscribe','',$updatesubscribe,array("email"=>$email));
			else{
				$updatesubscribe["secret"]=md5($secret);
				$insertdata=array("email"=>$email,"city_id"=>$city_data[0]->id,"secret"=>md5($secret));
				$result1=$this->common_model->insertData('bf_subscribe',$updatesubscribe);
			}
			
			if($result)
				$this->session->set_flashdata('flash_message', $this->common_model->admin_flash_message('success','Profile Updated Scessfully'));	
			else
				$this->session->set_flashdata('flash_message', $this->common_model->admin_flash_message('error','Profile Not Updated'));	

			redirect("home/myaccount");
		}
		
		$data['user_id']=$user_id;
		if($user_id!="" && $user_id!=0){
			$user_option=array("id"=>$user_id);
			$user_detail=$this->common_model->getTableData("bf_users",$user_option)->result();
			$data["user_detail"]=$user_detail;
		}
		
		//$data["email_sub_container"]='no';
		//$city_drop_down=$this->city_drop_down;
		//$data["city_drop_down"]=$city_drop_down;
		$cities = $this->common_model->getCities();
		if($cities){
			$data['change_location_select'] = $cities;
		}
		
		$city_contion=array("status"=>1);
		$results=$this->common_model->getTableData("bf_city",$city_contion);
		$cities=$results->result();
		$city_drop_val['']="Select";
		
		foreach($cities as $city){
			$city_drop_val[$city->id]=ucfirst($city->name);
		}
		$this->load->view("home/myaccount",$data);
		Template::render();
	}
}//end class
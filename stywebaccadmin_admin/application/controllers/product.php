<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
class Product extends CI_Controller {
	private $_data = array();
	function __construct()
	{
		parent::__construct();
		if($this->session->userdata('adminId') == ''){
			redirect($this->config->item('base_url'));
        }

		$this->load->model('product_model');
		$this->load->model('subcategory_model');
		$this->load->model('attribute_model');
		$this->load->model('users_model');
	}

	function trackadd()
		{
		$form_field = $data = array(
			'trackadd' => '',
			'status'=>'',
 		);

		if($this->input->post('action') == 'trackadd')
		{

			$id = $this->input->post('id');
			$statid = $this->input->post('status');
			$status = $this->product_model->getstatusname($statid);
			 //PRINT_R($status);DIE;
			foreach($form_field as $key => $value)
			{
				$data[$key]=$this->input->post($key);
			}
				$orderdetail = $this->product_model->orderdetail($id);	//ci_order_item
				//echo "<pre>";print_r($orderdetail);die;
				$uorderdetail = $this->product_model->uorderdetail($id);//	ci_orders

				$uaddress = $this->product_model->uaddress($uorderdetail[0]->order_number);//billship
				if($orderdetail[0]->product_id !=""){
				$prorderdetail = $this->product_model->prorderdetail($orderdetail[0]->product_id);//product detail
				}
				$allprocolor = $this->product_model->allprocolor($uorderdetail[0]->order_id);//allcolor detail
				$format = $this->product_model->getusermail();
				if ($status == 'Packed' || $status == 'Dispatched')
				{

				$message= $format[0]->order_status;
				if ($status == 'Packed'){
				$message = str_replace('{INVOICESTATUS}','Packed',$message);
				}
				if ($status == 'Dispatched'){
				$message = str_replace('{INVOICESTATUS}','Dispatched',$message);
				}
				$message = str_replace('{INVOICEORDER}',$orderdetail[0]->order_id,$message);
				$message = str_replace('{INVOICEADDRESS}',$this->input->post('trackadd'),$message);
					if($orderdetail != '' && count($orderdetail) > 0)
					{
						foreach($orderdetail as $orderdetails) {

									$message = str_replace('{INVOICENAME}',$orderdetails->order_item_name,$message);
									$colour = $this->product_model->getcolorname($orderdetails->colorid);
									$message = str_replace('{INVOICECOLOR}',$colour,$message);
									$size = $this->product_model->getsizename($orderdetails->sizeid);

									$message = str_replace('{INVOICESIZE}',$size ,$message);
									$message = str_replace('{INVOICEQUANTITY}',$orderdetails->product_quantity,$message);
									$message = str_replace('{INVOICEPRICE}',number_format($orderdetails->product_item_price,'2','.',''),$message);


							}
						}
					$message = str_replace('{INVOICETOTAL}',number_format($uorderdetail[0]->order_total,'2','.',''),$message);

				//echo $message;die;

				$data['udata'] = $this->product_model->udata($id);
				$uid=$data['udata']->user_id;
				$data['uemail'] = $this->product_model->uemail($uid);
				$uemail=$data['uemail']->email;

				$subject  = 'Order Status from Stylior.com';
				$headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				$headers .= 'From: Stylior.com <info@stylior.com>' . "\r\n" .
							'Reply-To: info@stylior.com' . "\r\n" .
							'X-Mailer: PHP/' . phpversion();
				mail($uemail, $subject, $message, $headers);

				}


			if($response = $this->product_model->trackadd($id,$data))
			{
				$this->session->set_flashdata('L_strErrorMessage','Order Tracking Address Succcessfully!!!!');
				redirect($this->config->item('base_url').'product/order_manage');
			}
			else
			{
				echo "<script>alert('Order Tracking Address is not added')</sctipt>";
				$data['L_strErrorMessage'] = 'Some Errors prevented from adding track address,please try later.';
				redirect($this->config->item('base_url').'product/order_manage');
			}
		}


		$this->load->view('product/order_manage');
	}

	function add()
	{
		$L_strErrorMessage='';
		$form_field = $data = array(
			'cname' => '',
			'categoryid' => '',
			'subcatid' => '',
			'subsubid'=> '',
			'attributeid' => '',
			'pname' => '',
			'itemcode' => '',
			'shortcode' => '',
			'description' => '',
			'discount' => '',
			//'cup' => '',
			'price' => '',
			'INR' => '',
			'USD' => '',
			'BHD' => '',
			'SAR' => '',
			'QAR' => '',
			'EUR' => '',
			'AED' => '',
			'AUD' => '',
			'S_INR' => '',
			'S_USD' => '',
			'S_BHD' => '',
			'S_SAR' => '',
			'S_QAR' => '',
			'S_EUR' => '',
			'S_AED' => '',
			'S_AUD' => '',
			'yarn' => '',
			'innerlining' => '',
			'buttons' => 'buttons',
			'seasonality' => 'seasonality',
			'suitfabricname' => 'suitfabricname',
			'liningfabric' => 'liningfabric',
			'colour' => '',

			//'size' => '',
			'style_id' => '',
			'name' => '',
			'price1' => '',
			'sellingprice1' => '',
			'title'      => '',
			'metadescription'      => '',
			'keyword'      => '',
			'startdate'      => '',
			'enddate'      => '',
			'designid'      => '',
			'fabricid'      => '',
			'weight'      => '',
			'pageurl'      => '',
			'threadcount' => '',
			'qty'      => '',
			'is_trail_shirt'=>'',
			'sort_ap'=>'',
			'threed_status'=>'',

		);
		if($this->input->post('action') == 'add_product')
		{
			foreach($form_field as $key => $value)
			{
				$data[$key]=$this->input->post($key);

			}
			//echo "<pre>"; print_r($data);die;
			$this->load->library('validation');
			$rules['cname'] = "trim|required";
			$rules['categoryid'] = "trim|required";
			$rules['subcatid'] = "trim|required";
			 $rules['subsubid'] = "trim|required";
			$rules['attributeid'] = "trim|required";
			$rules['pname'] = "trim|required";
			$rules['itemcode'] = "trim|required";
			$rules['shortcode'] = "trim|required";
			$rules['description'] = "trim|required";
			$rules['discount'] = "trim|required";


			$this->validation->set_rules($rules);
			$fields['cname'] = "cname";
			$fields['categoryid'] = "categoryid";
			$fields['subcatid'] = "subcatid";
			 $fields['subsubid'] = "subsubid";
			$fields['attributeid'] = "attributeid";
			$fields['pname'] = "pname";
			$fields['itemcode'] = "itemcode";
			$fields['shortcode'] = "shortcode";
			$fields['description'] = "description";
			$fields['discount'] = "discount";
			$this->validation->set_fields($fields);
				/*if($response =)
					{*/
						 $this->product_model->add($data);
						$this->session->set_flashdata('L_strErrorMessage','Product Added Succcessfully!!!!');
						redirect($this->config->item('base_url').'product/lists');


					/*}
					else
					{
						echo "<script>alert('Product is not successfull')</sctipt>";
						$data['L_strErrorMessage'] = 'Some Errors prevented from adding data,please try later.';
						redirect($this->config->item('base_url'));
					}*/

					if ($this->validation->run() == FALSE){
				$data['L_strErrorMessage'] = $this->validation->error_string;
			} else {


					if(!$this->product_model->is_category_already_exist_add($this->input->post('cname')))
					{
						if($response = $this->product_model->add($data))
						{
							$this->session->set_flashdata('L_strErrorMessage','Category Added Successfully!!!');
							redirect($this->config->item('base_url').'product/lists');
 						}
						else
						{
							$data['L_strErrorMessage'] = 'Some Errors prevented from adding data,please try later.';
						}
					}
					else
					{
						$data['L_strErrorMessage'] = 'Category already exist!';
					}
			}
		}

/*ckeditor code add here by var 23 nov 2016*/
  //start var for ckeditor
			$this->load->library('ckeditor');
			$this->load->library('ckfinder');
			$this->ckeditor->basePath = 'http://www.stylior.com/stylior/stywebaccadmin_admin/ckeditor/';
			$this->ckeditor->config['toolbar'] = array(array( 'Source', '-', 'Bold', 'Italic', 'Underline', '-','Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo','-','NumberedList','BulletedList' ));

			$this->ckeditor->config['language'] = 'it';
			$this->ckeditor->config['width'] = '730px';
			$this->ckeditor->config['height'] = '300px';
			//Add Ckfinder to Ckeditor
			$this->ckfinder->SetupCKEditor($this->ckeditor,'../ckfinder/');
          //end var for ckeditor

/*end ckeditor*/

		$data['allcategory'] = $this->product_model->allcategory();
		$data['allcategory1'] = $this->product_model->allcategory1();
		$data['allsubcategory'] = $this->product_model->allsubcategory();
		$data['allcolour'] = $this->product_model->allcolour();
		$data['allstyle'] = $this->product_model->allstyle();
		$data['allnewfabric'] = $this->product_model->allnewfabric();
		$data['alldesign'] = $this->product_model->alldesign();
		$data['allattributes'] = $this->product_model->allattributes();
		$this->load->view('add_product',$data);
	}

	function add_new()
	{
		$L_strErrorMessage='';
		$form_field = $data = array(
			'cname' => '',
			'categoryid' => '',
			'subcatid' => '',
			'attributeid' => '',
			'pname' => '',
			'itemcode' => '',
			'shortcode' => '',
			'description' => '',
			'discount' => '',
			//'cup' => '',
			'price' => '',
			'INR' => '',
			'USD' => '',
			'BHD' => '',
			'SAR' => '',
			'QAR' => '',
			'EUR' => '',
			'AED' => '',
			'AUD' => '',
			'S_INR' => '',
			'S_USD' => '',
			'S_BHD' => '',
			'S_SAR' => '',
			'S_QAR' => '',
			'S_EUR' => '',
			'S_AED' => '',
			'S_AUD' => '',
			'yarn' => '',
			'innerlining' => '',
			'buttons' => 'buttons',
			'seasonality' => 'seasonality',
			'colour' => '',
			//'size' => '',
			'style_id' => '',
			'name' => '',
			'price1' => '',
			'sellingprice1' => '',
			'title'      => '',
			'metadescription'      => '',
			'keyword'      => '',
			'startdate'      => '',
			'enddate'      => '',
			'designid'      => '',
			'fabricid'      => '',
			'weight'      => '',
			'pageurl'      => '',
			'threadcount' => '',
			'qty'      => '',
			'is_trail_shirt'=>'',
			'sort_ap'=>'',
			'threed_status'=>'',

		);
		if($this->input->post('action') == 'add_product')
		{
			foreach($form_field as $key => $value)
			{
				$data[$key]=$this->input->post($key);

			}
			//echo "<pre>"; print_r($data);die;
			$this->load->library('validation');
			$rules['cname'] = "trim|required";
			$rules['categoryid'] = "trim|required";
			$rules['subcatid'] = "trim|required";

			$rules['attributeid'] = "trim|required";
			$rules['pname'] = "trim|required";
			$rules['itemcode'] = "trim|required";
			$rules['shortcode'] = "trim|required";
			$rules['description'] = "trim|required";
			$rules['discount'] = "trim|required";


			$this->validation->set_rules($rules);
			$fields['cname'] = "cname";
			$fields['categoryid'] = "categoryid";
			$fields['subcatid'] = "subcatid";

			$fields['attributeid'] = "attributeid";
			$fields['pname'] = "pname";
			$fields['itemcode'] = "itemcode";
			$fields['shortcode'] = "shortcode";
			$fields['description'] = "description";
			$fields['discount'] = "discount";
			$this->validation->set_fields($fields);
				/*if($response =)
					{*/
						 $this->product_model->add_new($data);
						$this->session->set_flashdata('L_strErrorMessage','Product Added Succcessfully!!!!');
						redirect($this->config->item('base_url').'product/lists_new');


					/*}
					else
					{
						echo "<script>alert('Product is not successfull')</sctipt>";
						$data['L_strErrorMessage'] = 'Some Errors prevented from adding data,please try later.';
						redirect($this->config->item('base_url'));
					}*/

					if ($this->validation->run() == FALSE){
				$data['L_strErrorMessage'] = $this->validation->error_string;
			} else {


					if(!$this->product_model->is_category_already_exist_add($this->input->post('cname')))
					{
						if($response = $this->product_model->add_new($data))
						{
							$this->session->set_flashdata('L_strErrorMessage','Category Added Successfully!!!');
							redirect($this->config->item('base_url').'product/lists_new');
 						}
						else
						{
							$data['L_strErrorMessage'] = 'Some Errors prevented from adding data,please try later.';
						}
					}
					else
					{
						$data['L_strErrorMessage'] = 'Category already exist!';
					}
			}
		}

		$data['allcategory'] = $this->product_model->allcategory();
		$data['allcategory1'] = $this->product_model->allcategory1();
		$data['allcolour'] = $this->product_model->allcolour();
		$data['allstyle'] = $this->product_model->allstyle();
		$data['allnewfabric'] = $this->product_model->allnewfabric();
		$data['alldesign'] = $this->product_model->alldesign();
		$data['allattributes'] = $this->product_model->allattributes();
		$this->load->view('add_product_new',$data);
	}
	function add1()
	{
		$L_strErrorMessage='';
		$form_field = $data = array(
			'cname' => '',
			'categoryid' => '',
			'subcatid' => '',
			'attributeid' => '',
			'pname' => '',
			'itemcode' => '',
			'shortcode' => '',
			'description' => '',
			'discount' => '',
			//'cup' => '',
			'price' => '',
			'INR' => '',
			'USD' => '',
			'BHD' => '',
			'SAR' => '',
			'QAR' => '',
			'EUR' => '',
			'AED' => '',
			'AUD' => '',
			'S_INR' => '',
			'S_USD' => '',
			'S_BHD' => '',
			'S_SAR' => '',
			'S_QAR' => '',
			'S_EUR' => '',
			'S_AED' => '',
			'S_AUD' => '',

			'colour' => '',
			//'size' => '',
			'style_id' => '',
			'name' => '',
			'price1' => '',
			'sellingprice1' => '',
			'title'      => '',
			'metadescription'      => '',
			'keyword'      => '',
			'startdate'      => '',
			'enddate'      => '',
			'designid'      => '',
			'fabricid'      => '',
			'weight'      => '',
			'pageurl'      => '',
			'threadcount' => '',
			'qty'      => '',
			'is_trail_shirt'=>'',
			'sort_ap'=>'',
			'threed_status'=>'',

		);
		if($this->input->post('action') == 'add_product')
		{
			foreach($form_field as $key => $value)
			{
				$data[$key]=$this->input->post($key);

			}
			//echo "<pre>"; print_r($data);die;
			$this->load->library('validation');
			$rules['cname'] = "trim|required";
			$rules['categoryid'] = "trim|required";
			$rules['subcatid'] = "trim|required";

			$rules['attributeid'] = "trim|required";
			$rules['pname'] = "trim|required";
			$rules['itemcode'] = "trim|required";
			$rules['shortcode'] = "trim|required";
			$rules['description'] = "trim|required";
			$rules['discount'] = "trim|required";


			$this->validation->set_rules($rules);
			$fields['cname'] = "cname";
			$fields['categoryid'] = "categoryid";
			$fields['subcatid'] = "subcatid";

			$fields['attributeid'] = "attributeid";
			$fields['pname'] = "pname";
			$fields['itemcode'] = "itemcode";
			$fields['shortcode'] = "shortcode";
			$fields['description'] = "description";
			$fields['discount'] = "discount";
			$this->validation->set_fields($fields);
				/*if($response =)
					{*/
						 $this->product_model1->add($data);
						$this->session->set_flashdata('L_strErrorMessage','Product Added Succcessfully!!!!');
						redirect($this->config->item('base_url').'product/lists');


					/*}
					else
					{
						echo "<script>alert('Product is not successfull')</sctipt>";
						$data['L_strErrorMessage'] = 'Some Errors prevented from adding data,please try later.';
						redirect($this->config->item('base_url'));
					}*/

					if ($this->validation->run() == FALSE){
				$data['L_strErrorMessage'] = $this->validation->error_string;
			} else {


					if(!$this->product_model1->is_category_already_exist_add($this->input->post('cname')))
					{
						if($response = $this->product_model1->add($data))
						{
							$this->session->set_flashdata('L_strErrorMessage','Category Added Successfully!!!');
							redirect($this->config->item('base_url').'product/lists');
 						}
						else
						{
							$data['L_strErrorMessage'] = 'Some Errors prevented from adding data,please try later.';
						}
					}
					else
					{
						$data['L_strErrorMessage'] = 'Category already exist!';
					}
			}
		}

		$data['allcategory'] = $this->product_model->allcategory();
		$data['allcategory1'] = $this->product_model->allcategory1();
		$data['allcolour'] = $this->product_model->allcolour();
		$data['allstyle'] = $this->product_model->allstyle();
		$data['allnewfabric'] = $this->product_model->allnewfabric();
		$data['alldesign'] = $this->product_model->alldesign();
		$data['allattributes'] = $this->product_model->allattributes();
		$this->load->view('add_product1',$data);
	}
	function inventory($id)
	{
  		$data['result'] = $this->product_model->get_product($id);
		$this->load->view('show_inventory', $data);
	}

	function updatedata($color,$size,$pid,$val=''){

		if($val == ''){
			$val = '0';
		}


		$this->product_model->updatedata($color,$size,$pid,$val);
	    $this->session->set_flashdata('item', 'Stock Updated Successfully');
		redirect($this->config->item('base_url').'product/inventory/'.$pid);
	}


	function order_manage()
	{
	 	$this->load->library('pagination');
		$url_to_paging = $this->config->item('base_url');
		$config['base_url'] = $url_to_paging.'product/order_manage/';
		$config['per_page'] = '15';
		$data['username'] = $this->input->post('username');
		$data['status'] = $this->input->post('status');
		$data['cancel'] = $this->input->post('cancel');
		$data['order_status'] = $this->input->post('order_status');
		$data['startdate'] = $this->input->post('startdate');
		$data['enddate'] = $this->input->post('enddate');
		$return = $this->product_model->order_manage($config['per_page'],$this->uri->segment(3), $data);
		$data['result'] = $return['result'];
		$config['total_rows'] = $return['count'];
		$this->pagination->initialize($config);
		$data['allstatus']=$this->product_model->allstatus();
		$this->load->view('order',$data);

	}
	function order_confirm()
	{
	 	$this->load->library('pagination');
		$url_to_paging = $this->config->item('base_url');
		$config['base_url'] = $url_to_paging.'product/order_manage/';
		$config['per_page'] = '15';
		$data['username'] = $this->input->post('username');
		$data['status'] = $this->input->post('status');
		$data['cancel'] = $this->input->post('cancel');
		$data['order_status'] = $this->input->post('order_status');
		$data['startdate'] = $this->input->post('startdate');
		$data['enddate'] = $this->input->post('enddate');
		$return = $this->product_model->order_confirm($config['per_page'],$this->uri->segment(3), $data);
		$data['result'] = $return['result'];
		$config['total_rows'] = $return['count'];
		$this->pagination->initialize($config);
		$data['allstatus']=$this->product_model->allstatus();
		$this->load->view('order',$data);

	}

	function order_pending()
	{
	 	$this->load->library('pagination');
		$url_to_paging = $this->config->item('base_url');
		$config['base_url'] = $url_to_paging.'product/order_manage/';
		$config['per_page'] = '15';
		$data['username'] = $this->input->post('username');
		$data['status'] = $this->input->post('status');
		$data['cancel'] = $this->input->post('cancel');
		$data['order_status'] = $this->input->post('order_status');
		$data['startdate'] = $this->input->post('startdate');
		$data['enddate'] = $this->input->post('enddate');
		$return = $this->product_model->order_pending($config['per_page'],$this->uri->segment(3), $data);
		$data['result'] = $return['result'];
		$config['total_rows'] = $return['count'];
		$this->pagination->initialize($config);
		$data['allstatus']=$this->product_model->allstatus();
		$this->load->view('order_pending',$data);

	}


	function cancelor()
	{
	 	$this->load->library('pagination');
		$url_to_paging = $this->config->item('base_url');
		$config['base_url'] = $url_to_paging.'product/cancelor/';
		$config['per_page'] = '15';
		$data['username'] = $this->input->post('username');
		$data['status'] = $this->input->post('status');
		$return = $this->product_model->cancelorder_manage($config['per_page'],$this->uri->segment(3), $data);
		$data['result'] = $return['result'];
		$config['total_rows'] = $return['count'];
		$this->pagination->initialize($config);
		$this->load->view('cancelorder',$data);

	}

	function cancelorder($user_id)
	{
			//echo $user_id;die(); order id
			if($this->input->post("action")=="cancelorder"){
			$cancel_resone = $this->input->post("cancel_resone");
			$cancelorder = $this->product_model->cancelorder($user_id,$cancel_resone);

			//my function
				$canorderdet = $this->product_model->canorderdet($user_id);
				//print_r($canorderdet);die();
				$canordetail = $this->product_model->canorddetail($canorderdet->order_id);
				//echo "<pre>";	print_r($canordetail);
				$userinfo = $this->product_model->userinfo($canorderdet->user_id);
				//print_r($userinfo); die();

			$message = '<div style="width:700px; height:auto; margin:0 auto;">
				<p>Hello, </p>
			    <p>Below Order has been cancelled by Admin.</p>
				<p>Cancel reason as below,</p>
				<p>'.$this->input->post("cancel_resone").'</p>

				</br></br>

				<table style="width: 100%;">
						<th>-: Order Detail :-</th>
					 </tr>
					<tr><td>Order Id:</td><td>'.$canorderdet->order_id.'</td>
					</tr>

					<tr><td>Order Total:</td><td>'.$canorderdet->order_total.'</td>
					</tr>

					</tr>
					<tr><td>Order Date:</td><td>'.$canorderdet->cdate.'</td>

					</tr>
					</tr>';
					if($canordetail!="" && count($canordetail)>=0){
					foreach( $canordetail as $orders){

					$message .= '<tr><td>Product Name:</td><td>'.$orders->order_item_name.'</td>
					</tr>';
					}
				}


				$message .= '</table></br>


				';

				$useremail=$userinfo->email;
				//echo $message ; die();
				$subject  = 'Order Cancellation from Stylior.com';
				$headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				$headers .= 'From: Stylior.com <info@stylior.com>' . "\r\n" .
							'Reply-To: info@stylior.com' . "\r\n" .
							'X-Mailer: PHP/' . phpversion();
				//mail('amvisolution@gmail.com', $subject, $message, $headers);
				mail($useremail, $subject, $message, $headers);



			$this->session->set_flashdata('L_strErrorMessage','Order Cancelled Succcessfully!!!!');
			redirect($this->config->item('base_url').'product/order_manage');
		}
	}

	function order_detail($id)
	{
		$data['orderdetails'] = $this->product_model->order_detail($id);
		$order_invoice = $data['orderdetails']->order_invoice;
		$data['shippingdetails'] = $this->product_model->shippingdetails($order_invoice);
		//print_r($data['shippingdetails']);die();
		$data['orderitems'] = $this->product_model->orderitems($id);
		$data['allstatus']=$this->product_model->allstatus();
		$this->load->view('order_detail',$data);
	}

	function invoice($id)
	{
		$data['orderdetails'] = $this->product_model->order_detail($id);
		$order_invoice = $data['orderdetails']->order_invoice;
		$data['shippingdetails'] = $this->product_model->shippingdetails($order_invoice);
		$data['orderitems'] = $this->product_model->orderitems($id);
		$this->load->view('invoice',$data);
	}

		function ship_invoice($shipid,$ci_itemid)
	{
		$data['orderdetails'] = $this->product_model->getorder_detail($ci_itemid);
		//echo "<pre>";print_r($data['orderdetails']);die;
		$orderid= $data['orderdetails']->order_id;
		$data['shippingdetails'] = $this->product_model->shippingdetails($orderid);
		//print_r($data['shippingdetails']);die;
		//$data['orderitems'] = $this->product_model->orderitems($orderid);
		//print_r($data['orderitems']);die;
		$this->load->view('ship_invoice',$data);
	}

	function bookorder($id)
	{
		$data['orderdetails'] = $this->product_model->order_detail($id);
		$order_invoice = $data['orderdetails']->order_invoice;
		$data['shippingdetails'] = $this->product_model->shippingdetails($order_invoice);
		$data['orderitems'] = $this->product_model->orderitems($id);
		$data['fabrics'] = $this->product_model->getitemCode();
		//print_r($data['itemcode']);
		//$data['options']= json_decode();
		//print_r((array)$data['orderitems'][0]->details3d);
		//die;
		$this->load->view('bookorder',$data);
	}

	function deleteorder($id)
	{

		{
		$this->product_model->orderdlt($id);
		}
		$this->session->set_flashdata('L_strErrorMessage','Cancel Order Deleted Succcessfully!!!!');
		redirect($this->config->item('base_url').'product/cancelor');
	}

	function editimage($id)
	{

		$data['L_strErrorMessage'] = '';

 		if ($this->input->post('action') == 'edit' && is_numeric($id)) {
 		for($i = 0; $i < count($_FILES['attachment1']['name']); $i++)
		{

			if($_FILES['attachment1']['name'][$i] != '') {

				$tmp_name1 =  $_FILES['attachment1']['tmp_name'][$i];  //$_FILES['attachment'.$i]['tmp_name'];
		 		//$rootpath1 =  "http://www.stylior.com/upload/products1/";
     	 		$rootpath1 =  $this->config->item('upload')."products1/";

				//$logoname  =  $this->sprojects->upload_Classifile('attachment'.$i,$rootpath1);
				$logoname = time().str_replace(" ","_",$_FILES['attachment1']['name'][$i]);
				move_uploaded_file( $tmp_name1 , $rootpath1.str_replace(" ","_",$logoname) );

				//$tmp_path = "http://www.stylior.com/upload/products1/".str_replace(" ","_",$logoname);
				//$image_thumb= "http://www.stylior.com/upload/products1/medium/".str_replace(" ","_",$logoname);
//				echo $this->config->item('upload');
				$tmp_path = $this->config->item('upload')."products1/".str_replace(" ","_",$logoname);
				$image_thumb= $this->config->item('upload')."products1/medium/".str_replace(" ","_",$logoname);
				$height=361;
				$width=235;

				$this->load->library('image_lib');
				// CONFIGURE IMAGE LIBRARY
				$config['image_library']    = 'gd2';
				$config['source_image']     = $tmp_path;
				$config['new_image']        = $image_thumb;
				$config['maintain_ratio']   = true;
				$config['height']           = $height;
				$config['width']            = $width;

				/*echo "<pre>";
				print_r($config);
				echo "</pre>";
				*/
				//echo $this->image_lib->display_errors();
				//die();

				$this->image_lib->initialize($config);
				$this->image_lib->resize();
				$this->image_lib->clear();

				$tmp_path = $this->config->item('upload')."products1/".str_replace(" ","_",$logoname);
				$image_thumb= $this->config->item('upload')."products1/large/".str_replace(" ","_",$logoname);

				$height=714;
				$width=500;


				$this->load->library('image_lib');

				// CONFIGURE IMAGE LIBRARY
				$config['image_library']    = 'gd2';
				$config['source_image']     = $tmp_path;
				$config['new_image']        = $image_thumb;
				$config['maintain_ratio']   = true;
				$config['height']           = $height;
				$config['width']            = $width;

				$this->image_lib->initialize($config);
				$this->image_lib->resize();
				$this->image_lib->clear();


				$tmp_path = $this->config->item('upload')."products1/".str_replace(" ","_",$logoname);
				$image_thumb= $this->config->item('upload')."products1/small/".str_replace(" ","_",$logoname);

				$height=143;
				$width=100;

				$this->load->library('image_lib');

				// CONFIGURE IMAGE LIBRARY
				$config['image_library']    = 'gd2';
				$config['source_image']     = $tmp_path;
				$config['new_image']        = $image_thumb;
				$config['maintain_ratio']   = true;
				$config['height']           = $height;
				$config['width']            = $width;

				$this->image_lib->initialize($config);
				$this->image_lib->resize();
				$this->image_lib->clear();


				$newdata1 = array(
					'pid'   => $id,
					'image'	=> $logoname,
				);

				$id222 = $this->product_model->add_product_image($newdata1);
			}
		}
		}
		//$data['pid'] = $id;
		$data['result'] = $this->product_model->presult($id);
		$data['productimages'] = $this->product_model->productimages($id);
		$this->load->view('editimage',$data);


	}


	function editimage_new($id)
	{

		$data['L_strErrorMessage'] = '';

 		if ($this->input->post('action') == 'edit' && is_numeric($id)) {
 		for($i = 0; $i < count($_FILES['attachment1']['name']); $i++)
		{

			if($_FILES['attachment1']['name'][$i] != '') {

				$tmp_name1 =  $_FILES['attachment1']['tmp_name'][$i];  //$_FILES['attachment'.$i]['tmp_name'];
		 		$rootpath1 =  $this->config->item('upload')."products1/";
				//$logoname  =  $this->sprojects->upload_Classifile('attachment'.$i,$rootpath1);
				$logoname = time().str_replace(" ","_",$_FILES['attachment1']['name'][$i]);
				move_uploaded_file( $tmp_name1 , $rootpath1.str_replace(" ","_",$logoname) );

				$tmp_path = $this->config->item('upload')."products1/".str_replace(" ","_",$logoname);
				$image_thumb= $this->config->item('upload')."products1/medium/".str_replace(" ","_",$logoname);

				$height=361;
				$width=235;

				$this->load->library('image_lib');

				// CONFIGURE IMAGE LIBRARY
				$config['image_library']    = 'gd2';
				$config['source_image']     = $tmp_path;
				$config['new_image']        = $image_thumb;
				$config['maintain_ratio']   = true;
				$config['height']           = $height;
				$config['width']            = $width;

				$this->image_lib->initialize($config);
				$this->image_lib->resize();
				$this->image_lib->clear();

				$tmp_path = $this->config->item('upload')."products1/".str_replace(" ","_",$logoname);
				$image_thumb= $this->config->item('upload')."products1/large/".str_replace(" ","_",$logoname);

				$height=714;
				$width=500;


				$this->load->library('image_lib');

				// CONFIGURE IMAGE LIBRARY
				$config['image_library']    = 'gd2';
				$config['source_image']     = $tmp_path;
				$config['new_image']        = $image_thumb;
				$config['maintain_ratio']   = true;
				$config['height']           = $height;
				$config['width']            = $width;

				$this->image_lib->initialize($config);
				$this->image_lib->resize();
				$this->image_lib->clear();


				$tmp_path = $this->config->item('upload')."products1/".str_replace(" ","_",$logoname);
				$image_thumb= $this->config->item('upload')."products1/small/".str_replace(" ","_",$logoname);

				$height=143;
				$width=100;

				$this->load->library('image_lib');

				// CONFIGURE IMAGE LIBRARY
				$config['image_library']    = 'gd2';
				$config['source_image']     = $tmp_path;
				$config['new_image']        = $image_thumb;
				$config['maintain_ratio']   = true;
				$config['height']           = $height;
				$config['width']            = $width;

				$this->image_lib->initialize($config);
				$this->image_lib->resize();
				$this->image_lib->clear();


				$newdata1 = array(
					'pid'   => $id,
					'image'	=> $logoname,
				);

				$id222 = $this->product_model->add_product_image_new($newdata1);
			}
		}
		}
		//$data['pid'] = $id;
		$data['result'] = $this->product_model->presult_new($id);
		$data['productimages'] = $this->product_model->productimages_new($id);
		$this->load->view('editimage_new',$data);


	}
	function addimage($style_id,$proid)
	{

		$data['L_strErrorMessage'] = '';

		/*

500x714

980x1400

253x361

100x143
		*/
		if ($this->input->post('action') == 'edit' && is_numeric($proid)) {

		for($i = 0; $i < count($_FILES['attachment1']['name']); $i++)
		{

			if($_FILES['attachment1']['name'][$i] != '') {

				$tmp_name1 =  $_FILES['attachment1']['tmp_name'][$i];  //$_FILES['attachment'.$i]['tmp_name'];
		 		$rootpath1 =  $this->config->item('upload')."allstyle/";
				//$logoname  =  $this->sprojects->upload_Classifile('attachment'.$i,$rootpath1);
				$logoname = time().str_replace(" ","_",$_FILES['attachment1']['name'][$i]);
				move_uploaded_file( $tmp_name1 , $rootpath1.str_replace(" ","_",$logoname) );

				$tmp_path = $this->config->item('upload')."allstyle/".str_replace(" ","_",$logoname);
				$image_thumb= $this->config->item('upload')."allstyle/medium/".str_replace(" ","_",$logoname);

				$height=361;
				$width=235;

				$this->load->library('image_lib');

				// CONFIGURE IMAGE LIBRARY
				$config['image_library']    = 'gd2';
				$config['source_image']     = $tmp_path;
				$config['new_image']        = $image_thumb;
				$config['maintain_ratio']   = false;
				$config['height']           = $height;
				$config['width']            = $width;

				$this->image_lib->initialize($config);
				$this->image_lib->resize();
				$this->image_lib->clear();

				$tmp_path = $this->config->item('upload')."allstyle/".str_replace(" ","_",$logoname);
				$image_thumb= $this->config->item('upload')."allstyle/large/".str_replace(" ","_",$logoname);

				$height=714;
				$width=500;

				$this->load->library('image_lib');

				// CONFIGURE IMAGE LIBRARY
				$config['image_library']    = 'gd2';
				$config['source_image']     = $tmp_path;
				$config['new_image']        = $image_thumb;
				$config['maintain_ratio']   = false;
				$config['height']           = $height;
				$config['width']            = $width;

				$this->image_lib->initialize($config);
				$this->image_lib->resize();
				$this->image_lib->clear();


				$tmp_path = $this->config->item('upload')."allstyle/".str_replace(" ","_",$logoname);
				$image_thumb= $this->config->item('upload')."allstyle/small/".str_replace(" ","_",$logoname);

				$height=143;
				$width=100;

				$this->load->library('image_lib');

				// CONFIGURE IMAGE LIBRARY
				$config['image_library']    = 'gd2';
				$config['source_image']     = $tmp_path;
				$config['new_image']        = $image_thumb;
				$config['maintain_ratio']   = false;
				$config['height']           = $height;
				$config['width']            = $width;

				$this->image_lib->initialize($config);
				$this->image_lib->resize();
				$this->image_lib->clear();


				$newdata1 = array(
					'pid'   => $proid,
					'style_id'   => $style_id,
					'image'	=> $logoname,
				);

				$id222 = $this->product_model->add_style_image($newdata1);
			}
		}
		}
		//$data['pid'] = $id;
		$data['result'] = $this->product_model->presultss($style_id);
		//print_r($data['result']);
		$data['productimages'] = $this->product_model->styleimage($style_id);
		$this->load->view('neweditimage',$data);


	}
	function getsubsubcat(){
		$id = $this->input->post('id');
		$result = $this->product_model->getsubsubcat($id);
		$html =' <select id="subcatid" name="subcatid" class="form-control" onchange="newaddcat(this.value);" >
								<option value="" selected="selected">Select Sub Category</option>';
				if($result != '' && count($result)){
					foreach($result as $res){
						$html .= "<option value='".$res->id."'>".$res->scname."</option>";
					}

				}
		$html .= '</select>';

		echo $html;
	}
    function edit($id)
	{
			if(is_numeric($id)){
			$result = $this->product_model->get_product($id);
			$form_field = $data = array(
						'L_strErrorMessage' => '',
						'id'	=> $result[0]->id,
						'pname' =>  $result[0]->pname,
						'categoryid' =>  $result[0]->categoryid,
						'subcatid' =>  $result[0]->subcatid,
						'subsubid' =>  $result[0]->subsubid,
  					    'itemcode' => $result[0]->itemcode,
						'shortcode' =>  $result[0]->shortcode,
					    'description' => $result[0]->description,
						'discount' => $result[0]->discount,
						//'cupid' => $result[0]->cup,
						'price' => $result[0]->INR,
						'INR' => $result[0]->INR,
						'USD' => $result[0]->USD,
						'BHD' => $result[0]->BHD,
						'SAR' => $result[0]->SAR,
						'QAR' => $result[0]->QAR,
						'EUR' => $result[0]->EUR,
						'AED' => $result[0]->AED,
						'AUD' => $result[0]->AUD,
						'S_INR' => $result[0]->S_INR,
						'S_USD' => $result[0]->S_USD,
						'S_BHD' => $result[0]->S_BHD,
						'S_SAR' => $result[0]->S_SAR,
						'S_QAR' => $result[0]->S_QAR,
						'S_EUR' => $result[0]->S_EUR,
						'S_AED' => $result[0]->S_AED,
						'S_AUD' => $result[0]->S_AUD,
						//'sellingprice' => $result[0]->sellingprice,
						'colour' => $result[0]->colour,
						//'size' => $result[0]->size,
						'title' => $result[0]->title,
						'metadescription' => $result[0]->metadescription,
						'keyword' => $result[0]->keyword,
						'startdate' => $result[0]->startdate,
						'enddate' => $result[0]->enddate,
						'fabricid' => $result[0]->fabricid,
						'designid' => $result[0]->designid,
						'weight' => $result[0]->weight,
						'pageurl' => $result[0]->pageurl,
						'qty' => $result[0]->qty,
						'threadcount' => $result[0]->threadcount,
						//'featured_product' => $result[0]->featured_product
						'is_trail_shirt' => $result[0]->is_trail_shirt,
						'status' => $result[0]->status,
						'is_home' => $result[0]->is_home,
						'sort_ap' => $result[0]->sort_ap,
						'threed_status' => $result[0]->threed_status ,
						);

			if($this->input->post('action') == 'edit_product') {



				foreach($data as $key => $value) {  $form_field[$key]=$this->input->post($key);	}



			$this->load->library('validation');
			$rules['pname'] = "trim|required";

			//$rules['discount']       = "trim|required";

			$this->validation->set_rules($rules);
			$fields['pname']   = "pname";

			//$fields['discount']       = "discount";


			$this->validation->set_fields($fields);

			//echo "<pre>";
//print_r($data);exit;
			if ($this->validation->run() == FALSE) {
					$data = $form_field;
					$data['L_strErrorMessage'] = $this->validation->error_string;
					$data['id'] = $id;
			} else {


					//echo "<pre>";
					//print_r($form_field);exit;

					/*if($response =) { */
					$this->product_model->edit($id, $form_field);
					$this->session->set_flashdata('L_strErrorMessage','Product Updated Succcessfully!!!!');
					redirect($this->config->item('base_url').'product/lists');
						/*} else {
							$data['L_strErrorMessage'] = 'Some Errors prevented from update data,please try again later.';
						}*/

				}
			}

			//start var for ckeditor
			$this->load->library('ckeditor');
			$this->load->library('ckfinder');
			$this->ckeditor->basePath = 'http://www.stylior.com/stylior/stywebaccadmin_admin/ckeditor/';
			$this->ckeditor->config['toolbar'] = array(array( 'Source', '-', 'Bold', 'Italic', 'Underline', '-','Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo','-','NumberedList','BulletedList' ));

			$this->ckeditor->config['language'] = 'it';
			$this->ckeditor->config['width'] = '730px';
			$this->ckeditor->config['height'] = '300px';
			//Add Ckfinder to Ckeditor
			$this->ckfinder->SetupCKEditor($this->ckeditor,'../ckfinder/');
			//end var for ckeditor



			$data['allcategory'] = $this->product_model->allcategory();
			$data['allcategory1'] = $this->product_model->allcategory1();
			$data['allsubcategory'] = $this->product_model->allsubcategory();
			$data['allcolour'] = $this->product_model->allcolour();
			$data['allstyle'] = $this->product_model->allstyle();
			//print_r($data['allstyle']);die;
			$data['allattributes'] = $this->product_model->allattributes();
			$data['productattr'] = $this->product_model->productattr($id);
			$data['pro_style'] = $this->product_model->pro_style($id);
			$data['allnewfabric'] = $this->product_model->allnewfabric();
			$data['alldesign'] = $this->product_model->alldesign();
 			$this->load->view('edit_product',$data);
		} else {
			$this->session->set_flashdata('L_strErrorMessage','No Such Attribute !!!!');
			redirect($this->config->item('base_url').'product/lists');
		}
	}

	function groupproduct($id)
	{
			$data = array();
			if(is_numeric($id)){
			$data['result'] = $this->product_model->get_product($id);
			$data['searchproducts'] = '';
			if($this->input->post('action') == 'add_product') {
					$data['searchproducts'] = $this->product_model->searchproducts($_POST);
			}
			$data['groupid'] = $id;
			$this->load->view('groupprodut',$data);
		} else {
			$this->session->set_flashdata('L_strErrorMessage','No Such Attribute !!!!');
			redirect($this->config->item('base_url').'product/lists');
		}
	}
	function remove($id,$pid)
	{
		//echo $id.$orderid; die();
			if($this->product_model->deleteorder($id,$pid))
			{
				$this->session->set_flashdata('flashError','Data Remove Succcessfully!!');
				redirect($this->config->item('base_url').'product/edit/'.$pid);
			}
			else
			{
				$this->session->set_flashdata('flashError','Some Errors prevented from Deleting!!!!');
				break;
			}
 	}
	function addtogroup($addid,$pid){
		$productid = $this->product_model->get_product($pid);
		$grpid = $productid[0]->groupedprod;

		if($grpid == ''){
			$toupdatid = $addid;
		} else {
			$toupdatid = $grpid.",".$addid;
		}

		$this->product_model->udpategroup($pid,$toupdatid);
		$this->session->set_flashdata('L_strErrorMessage','Group Product has been added successfully');
		redirect($this->config->item('base_url').'product/groupproduct/'.$pid);

	}

	function array_delete(&$array, $value, $strict = TRUE) {
		$count = 0;
		if ($strict) {
			foreach ($array as $key => $item) {
				if ($item === $value) {
					$count++;
					unset($array[$key]);
				}
			}
		} else {
			foreach ($array as $key => $item) {
				if ($item == $value) {
					$count++;
					unset($array[$key]);
				}
			}
		}
		return $count;
	}

	function removeproducttogroup($addid,$pid){
		$productid = $this->product_model->get_product($pid);
		$grpid = $productid[0]->groupedprod;
		$grouparray = explode(',',$grpid);

		$this->array_delete($grouparray,$addid,$strict = TRUE);
		//print_r($grouparray);die;

		if($grouparray != '' && count($grouparray) > 0){
			$toupdatid = implode(',',$grouparray);
		} else {
			$toupdatid = '';
		}
		$this->product_model->udpategroup($pid,$toupdatid);
		$this->session->set_flashdata('L_strErrorMessage','Group Product has been added successfully');
		redirect($this->config->item('base_url').'product/groupproduct/'.$pid);

	}


	function lists()
	{
		$this->load->library('pagination');
		$url_to_paging = $this->config->item('base_url');
		$config['base_url'] = $url_to_paging.'product/lists/';
		$config['per_page'] = '15';
		$config['first_url']='0';
		$data['cname'] = $this->input->post('cname');
		$data['catid'] = $this->input->post('catid');
		$data['subcatid'] = $this->input->post('subcatid');
		$data['pname'] = $this->input->post('pname');
		$data['itemcode'] = $this->input->post('itemcode');
		$data['shortcode'] = $this->input->post('shortcode');
		$data['description'] = $this->input->post('description');
		$data['discount'] = $this->input->post('discount');
		$per_page = '1';
		$perpage = '3';
		$return = $this->product_model->lists($config['per_page'],$this->uri->segment(3), $data);
		$data['result'] = $return['result'];
		$config['total_rows'] = $return['count'];
		$this->pagination->initialize($config);
		$data['allcategory'] = $this->product_model->allcategory();
		$data['subcategory'] = $this->product_model->allcategory1();
		$this->load->view('product', $data);
	}

	function lists_new()
	{
		$this->load->library('pagination');
		$url_to_paging = $this->config->item('base_url');
		$config['base_url'] = $url_to_paging.'product/lists_new/';
		$config['per_page'] = '15';
		$config['first_url']='0';
		$data['cname'] = $this->input->post('cname');
		$data['catid'] = $this->input->post('catid');
		$data['subcatid'] = $this->input->post('subcatid');
		$data['pname'] = $this->input->post('pname');
		$data['itemcode'] = $this->input->post('itemcode');
		$data['shortcode'] = $this->input->post('shortcode');
		$data['description'] = $this->input->post('description');
		$data['discount'] = $this->input->post('discount');
		$per_page = '1';
		$perpage = '3';
		$return = $this->product_model->lists_new($config['per_page'],$this->uri->segment(3), $data);
		$data['result'] = $return['result'];
		$config['total_rows'] = $return['count'];
		$this->pagination->initialize($config);
		$data['allcategory'] = $this->product_model->allcategory();
		$data['subcategory'] = $this->product_model->allcategory1();
		$this->load->view('product_new', $data);
	}
	function deletes()
	{
		if(isset($_POST['selected']) && count($_POST['selected']) > 0) {

			foreach($_POST['selected'] as $selCheck) {
				if($this->product_model->deletes($selCheck)) {
					$this->session->set_flashdata('flashError','Product Deleted Succcessfully!!!!');
				}
				else
				{
						$this->session->set_flashdata('flashError','Some Errors prevented from Deleting!!!!');
						break;
				}
			}
		}
		redirect($this->config->item('base_url').'product/lists');
	}
	function deletes_new()
	{
		if(isset($_POST['selected']) && count($_POST['selected']) > 0) {

			foreach($_POST['selected'] as $selCheck) {
				if($this->product_model->deletes_new($selCheck)) {
					$this->session->set_flashdata('flashError','Product Deleted Succcessfully!!!!');
				}
				else
				{
						$this->session->set_flashdata('flashError','Some Errors prevented from Deleting!!!!');
						break;
				}
			}
		}
		redirect($this->config->item('base_url').'product/lists_new');
	}
	function deletes1()
	{
		if(isset($_POST['selected']) && count($_POST['selected']) > 0) {

			foreach($_POST['selected'] as $selCheck) {
				if($this->product_model->deletes1($selCheck)) {
					$this->product_model->deletes2($selCheck);
					$this->session->set_flashdata('flashError','Order Deleted Succcessfully!!!!');
				}
				else
				{
						$this->session->set_flashdata('flashError','Some Errors prevented from Deleting!!!!');
						break;
				}
			}
		}
		redirect($this->config->item('base_url').'product/order_manage');
	}

	function ajaxlist_product()
	{
		//echo 11;exit;
		$news = "";
		$result = $this->product_model->product_list();
		//print_r($result['result']);die;
		for($i=0;$i<count($result);$i++)
		{
			//echo $result[$i]->fname;
			$news .= $result[$i]->title.",";
		}
		echo $news = substr($news, 0, -1);
	}
	/*function ajaxlist_group()
	{
		//echo 11;exit;
		$news = "";
		$result = $this->product_model->product_list();
		//print_r($result['result']);die;
		for($i=0;$i<count($result);$i++)
		{
			//echo $result[$i]->fname;
			$news .= $result[$i]->pname.",";
		}
		echo $news = substr($news, 0, -1);
	}*/
	function product_murge()
	{
		$this->load->library('pagination');
		$url_to_paging = $this->config->item('base_url');
		$config['base_url'] = $url_to_paging.'product/product_murge';
		$config['per_page'] = '10';
		$config['first_url']='0';
		$data['title'] = $this->input->post('title');
		$per_page = '1';
		$perpage = '3';
		$return = $this->product_model->product_murge($config['per_page'],$this->uri->segment(3), $data);
		$data['result'] = $return['result'];
		$config['total_rows'] = $return['count'];
		$this->pagination->initialize($config);
		$this->load->view('product',$data);

	}




function newadcatselect(){
		$id = $this->input->post('id');
		$result = $this->product_model->getsubcatlist($id);
		$html =' <select id="subsubid" name="subsubid" class="form-control" >
								<option value="">Select Inner subCategory</option>';
				if($result != '' && count($result)){
					foreach($result as $res){
						$html .= "<option value='".$res->id."'>".$res->subname."</option>";
					}

				}
		$html .= '</select>';

		echo $html;
	}

	function setbaseimg($id,$pid)
	{

		$return = $this->product_model->setbaseimg($id,$pid);
		$this->session->set_flashdata('item', 'Base Image set Successfully');
		redirect($this->config->item('base_url').'product/editimage/'.$pid);
	}
	function setbaseimg_new($id,$pid)
	{

		$return = $this->product_model->setbaseimg_new($id,$pid);
		$this->session->set_flashdata('item', 'Base Image set Successfully');
		redirect($this->config->item('base_url').'product/editimage_new/'.$pid);
	}
	function threedyimg($id,$pid)
	{

		$return = $this->product_model->threedyimageset($id,$pid);
		$this->session->set_flashdata('item', '3D Image set Successfully.');
		redirect($this->config->item('base_url').'product/editimage/'.$pid);
	}
	function threedyimg_new($id,$pid)
	{

		$return = $this->product_model->threedyimageset_new($id,$pid);
		$this->session->set_flashdata('item', '3D Image set Successfully.');
		redirect($this->config->item('base_url').'product/editimage_new/'.$pid);
	}

	function setbaseimg1($id,$pid,$stid)
	{
		//echo "imageid".$id."proid".$pid."styleid".$stid;die;
		$return = $this->product_model->setbaseimg1($id,$pid);
		$this->session->set_flashdata('item', 'Base Image set Successfully');
		redirect($this->config->item('base_url').'product/addimage/'.$stid.'/'.$pid);
	}

	function updateorder($val,$id,$pid){
		$return = $this->product_model->updateorder($id,$val);
		$this->session->set_flashdata('item', 'Product Image Updates Successfully');
		redirect($this->config->item('base_url').'product/editimage/'.$pid);

	}
		function updateorder_new($val,$id,$pid){
		$return = $this->product_model->updateorder_new($id,$val);
		$this->session->set_flashdata('item', 'Product Image Updates Successfully');
		redirect($this->config->item('base_url').'product/editimage_new/'.$pid);

	}
	function updateorder1($val,$id,$pid,$styleid){
		//echo $styleid; die;
		$return = $this->product_model->updateorder1($id,$val);
		$this->session->set_flashdata('item', 'Style Image Updates Successfully');
		redirect($this->config->item('base_url').'product/addimage/'.$styleid.'/'.$pid);

	}

	function removeimage($id,$pid)
	{

		$return = $this->product_model->removeimage($id);
		$this->session->set_flashdata('item', 'Image deleted Successfully');
		redirect($this->config->item('base_url').'product/editimage/'.$pid);
	}
	function removeimage_new($id,$pid)
	{

		$return = $this->product_model->removeimage_new($id);
		$this->session->set_flashdata('item', 'Image deleted Successfully');
		redirect($this->config->item('base_url').'product/editimage_new/'.$pid);
	}
		function removeimage1($id,$pid,$style_id)
	{
		//echo $id;die;
		$return = $this->product_model->removeimage1($id);
		$this->session->set_flashdata('item', 'Image deleted Successfully');
		redirect($this->config->item('base_url').'product/addimage/'.$style_id.'/'.$pid);
	}



	function download()
	{

		//print_r($pla);die;
		$output1 = '';
		$planning1 = $this->product_model->getorder();
		//$planning = $this->planning_model->getplan($id);
		//$output .= 'user-';
		//$output .= ''.$this->session->userdata('username').'';
		//$output .="\n";
		//$output .="\n";

 		$output1 .= 'Customer Name, Order Id, Order Number, Order Total, Order Date' ;
		$output1 .="\n";
		// Get Records from the table
		if($planning1 != '' && count($planning1) > 0) {
		foreach($planning1 as $plan) {
		 $uname=$this->product_model->getusername($plan->user_info_id);
		$output1 .= '"'.$uname.'","'.$plan->order_id.'","'.$plan->order_number.'","'.$plan->order_total.'","'.$plan->cdate .'" ';
		$output1 .="\n";
		}
	}
		$filename = "order_report.csv";
		header('Content-type: application/csv');
		header('Content-Disposition: attachment; filename='.$filename);
		echo $output1;
		exit;

	}
	 function ajaxlist_search()
	{
		//echo 11;exit;
		$news = "";
		$result = $this->product_model->ajaxlist_search();
		//print_r($result['result']);die;
		for($i=0;$i<count($result);$i++)
		{
			$news .= $result[$i]->pname.",";

		}
		echo $news = substr($news, 0, -1);
	}
	function shipment($order_id)
	{
		$this->load->library('pagination');
		$url_to_paging = $this->config->item('base_url');
		$page= $this->input->get('per_page') ? $this->input->get('per_page') : 0;
		$config['base_url'] = $url_to_paging.'product/shipment/';
		$config['per_page'] = '15';
		$config['first_url']='0';
		$data['order_id'] = $order_id;

		$data['startdate'] = $this->input->post('startdate');
		$data['enddate'] = $this->input->post('enddate');

		$per_page = '1';
		$perpage = '3';
		$return = $this->product_model->shipment_lists($config['per_page'],$page, $data);
		$data['result'] = $return['result'];
		//echo "<pre>";print_r($data['result']);die;
		$config['total_rows'] = $return['count'];
		$this->pagination->initialize($config);
		//$data['allcategory'] = $this->product_model->allcategory();
		//$data['subcategory'] = $this->product_model->allcategory1();
		$data['allstatus']=$this->product_model->allstatus();
		$data['allcourier']=$this->product_model->allcourier();
		$this->load->view('shipment.php', $data);
	}
	function cust_shipment($order_id)
	{
		$data['message'] = $this->input->post('message');
		$data['status'] = $this->input->post('status');
		$data['courier']= $this->input->post('courier');

		if(isset($_POST['selected']) && count($_POST['selected']) > 0) {
			$newrow ="";
			//foreach($_POST['selected'] as $selCheck) {
				//$newrow = implode(',',$selCheck);

			//}
		}

		$newone = implode (',',$_POST['selected']);
		if($this->product_model->ship_add($order_id,$newone ,$data)) {
				$this->session->set_flashdata('flashError','Shipment Process Complete Succcessfully!!!!');
			}
		//print_r($newone);die;
		/*$checkvalue = $this->product_model->getcheckvalue($order_id);

		if($checkvalue == ""){

  		} else {
			$newone1=$checkvalue->ci_order_item .','.$newone;
			if($this->product_model->ship_edit($order_id,$newone1 ,$data)) {
					$this->session->set_flashdata('flashError','Shipment Process Complete Succcessfully!!!!');
				}

		}*/


					/* mail */

				$uorderdetail = $this->product_model->uorderdetail($order_id);
				$uid = $uorderdetail[0]->user_id;

				$format = $this->product_model->getusermail();
				$message= $format[0]->ship_order_status;
				$shipsub= $format[0]->shipmen_sub ;

				$message = str_replace('{INVOICEORDER}',$order_id,$message);
				 $statusname = $this->product_model->getstatusname($data['status']);
				$message = str_replace('{INVOICESTATUS}', $statusname ,$message);
				 $couriername = $this->product_model->getcouriername($data['courier']);
				$message = str_replace('{INVOICECORIER}',$couriername,$message);

				$ciorderid = explode(',',$newone);

						for($i=0;$i<count($ciorderid);$i++) {
						$uorderdetailnew[] = $this->product_model->cineworderdetail($ciorderid[$i]);
						 }

						//echo "<pre>"; print_r($uorderdetailnew);die;

						 for($j=0;$j<count($uorderdetailnew);$j++) {
									$message = str_replace('{INVOICENAME}',$uorderdetailnew[$j]->order_item_name,$message);
									$colour = $this->product_model->getcolorname($uorderdetailnew[$j]->colorid);
									$message = str_replace('{INVOICECOLOR}',$colour,$message);
									$size = $this->product_model->getsizename($uorderdetailnew[$j]->sizeid);

									$message = str_replace('{INVOICESIZE}',$size ,$message);
									$message = str_replace('{INVOICEQUANTITY}',$uorderdetailnew[$j]->product_quantity,$message);
									$message = str_replace('{INVOICEPRICE}',number_format($uorderdetailnew[$j]->product_item_price,'2','.',''),$message);

							}
					$message = str_replace('{INVOICEMESSAGE}',$data['message'],$message);
					$message = str_replace('{INVOICETOTAL}',number_format($uorderdetail[0]->order_total,'2','.',''),$message);



				$data['uemail'] = $this->product_model->uemail($uid);

				$uemail=$data['uemail']->email;

				$subject  = $shipsub;
				$headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				$headers .= 'From: Stylior.com <info@stylior.com>' . "\r\n" .
							'Reply-To: info@stylior.com' . "\r\n" .
							'X-Mailer: PHP/' . phpversion();
				mail($uemail, $subject, $message, $headers);



					/* mail end */
		redirect($this->config->item('base_url').'product/shipment_list/'.$order_id);
	}


 	function shipment_list($order_id)
	{
		$page = '100';
		$this->load->library('session');
		$this->load->library('pagination');

		$url_to_paging = $this->config->item('base_url');

		$config['base_url'] = $url_to_paging.'product/shipment_list/?per_page='.$page.'&name=';
		$config['per_page'] = '10';
		//		$config['first_url']='0';
		$data['startdate'] = $this->input->post('startdate');
		$data['enddate'] = $this->input->post('enddate');
		$data['order_id'] = $order_id;
		$return = $this->product_model->ship_lists($config['per_page'],$page,$data);
		$data['result'] = $return['result'];

		$config['total_rows'] = $return['count'];
		$config['page_query_string'] = TRUE;

		$this->pagination->initialize($config);
		//$data['allbiketype']=$this->bikeadd_model->allbike();
		$this->load->view('ship_list', $data);

	}
	function measurement($orderid)
	{
		$data['order_id'] = $orderid;
		$this->load->view('order_measure.php',$data);
	}

	function ship_label($id)
	{
 		$data['shipmentdetails'] = $this->product_model->shipmentdetail($id);
 		$data['order__id'] = $data['shipmentdetails']->order_id;
		$data['shippingdetails'] = $this->product_model->shippingdetails($data['order__id']);
		//print_r($data['shipmentdetails']);die();
		$data['orderdetails'] = $this->product_model->order_detail($data['order__id']);
		//$order_invoice = $data['orderdetails']->order_invoice;
 		//print_r($data['shippingdetails']);die();
		//$data['orderitems'] = $this->product_model->orderitems($id);
		$this->load->view('ship_label',$data);
	}

	function designer($id)
	{
		if(is_numeric($id)){
		$result = $this->product_model->get_product($id);
		$form_field = $data = array(
					'L_strErrorMessage' => '',
					'id'	=> $result[0]->id,
					'pname' =>  $result[0]->pname,
					'categoryid' =>  $result[0]->categoryid,
					'subcatid' =>  $result[0]->subcatid,
					'subsubid' =>  $result[0]->subsubid,
					'itemcode' => $result[0]->itemcode,
					);


		$data['allcategory'] = $this->product_model->allcategory();
		$data['allcategory1'] = $this->product_model->allcategory1();
		$data['allsubcategory'] = $this->product_model->allsubcategory();
		$data['allcolour'] = $this->product_model->allcolour();
		$data['allstyle'] = $this->product_model->allstyle();
		//print_r($data['allstyle']);die;
		$data['allattributes'] = $this->product_model->allattributes();
		$data['productattr'] = $this->product_model->productattr($id);
		$data['pro_style'] = $this->product_model->pro_style($id);
		$data['allnewfabric'] = $this->product_model->allnewfabric();
		$data['alldesign'] = $this->product_model->alldesign();
		$data['allcollar'] = $this->product_model->allcollars();
		$data['allcuffs'] = $this->product_model->allcuffs();
		$data['allinnercontrast'] = $this->product_model->allinnercontrast();
		$data['allbuttons'] = $this->product_model->allbuttons();
		$data['allsleeves'] = $this->product_model->allsleeves();
		$data['allpockets'] = $this->product_model->allpockets();
		$data['allplackets'] = $this->product_model->allplackets();
		$data['allback'] = $this->product_model->allback();
		$data['allbottom'] = $this->product_model->allbottom();
		$data['alloutercontrast'] = $this->product_model->alloutercontrast();
		$data['allpiping'] = $this->product_model->allpiping();
		$data['allelbowpatch'] = $this->product_model->allelbowpatch();

		$this->load->view('design',$data);
	} else {
		$this->session->set_flashdata('L_strErrorMessage','No Such Attribute !!!!');
		redirect($this->config->item('base_url').'product/design');
	}
	}

		function add_options($id)
	{
		if($this->product_model->getstylebyproduct($id))
		{
			$status = $this->product_model->deletestylebyid($id);
		}
		$data['pid'] = $id;
		if($this->input->post('collar')=="Yes")
		$data['collar_options'] = serialize($this->input->post('collar_options'));
		if($this->input->post('contrast')=="Yes")
		$data['contrast_options'] = serialize($this->input->post('contrast_options'));
		if($this->input->post('button')=="Yes")
		$data['button_options'] = serialize($this->input->post('button_options'));
		if($this->input->post('cuffs')=="Yes")
		$data['cuffs_options'] = serialize($this->input->post('cuffs_options'));
		if($this->input->post('sleeve')=="Yes")
		$data['sleeves_options'] = serialize($this->input->post('sleeves_options'));
		if($this->input->post('pocket')=="Yes")
		$data['pocket_options'] = serialize($this->input->post('pocket_options'));
		if($this->input->post('placket')=="Yes")
		$data['placket_options'] = serialize($this->input->post('placket_options'));
		if($this->input->post('back')=="Yes")
		$data['back_options'] = serialize($this->input->post('back_options'));
		if($this->input->post('bottom')=="Yes")
		$data['bottom_options'] = serialize($this->input->post('bottom_options'));
		if($this->input->post('outercontrast')=="Yes")
		$data['outercontrast_options'] = serialize($this->input->post('outercontrast_options'));
		if($this->input->post('piping')=="Yes")
		$data['piping_options'] = serialize($this->input->post('piping_options'));
		if($this->input->post('elbow')=="Yes")
		$data['elbow_options'] = serialize($this->input->post('elbow_options'));

		$result =  $this->product_model->add_options($data);
		//print_r($data['collar_options']);die();
		/* mail end */
	}

	function add_collar($id)
	{
		$data['allcollar'] = $this->product_model->get_all_collar();
		$data['L_strErrorMessage'] = '';
		$name =  $this->input->post('name');
			$collar_link =  $this->input->post('collar_link');
		$status = $this->input->post('status');
		$custom_key =  $this->input->post('custom_key');
		if ($this->input->post('action') == 'add_collar') {

			if($_FILES['attachment1']['name']!= '') {
				$tmp_name1 =  $_FILES['attachment1']['tmp_name'];  //$_FILES['attachment'.$i]['tmp_name'];
				$rootpath1 =  $this->config->item('upload_options')."/collar/";
				//$logoname  =  $this->sprojects->upload_Classifile('attachment'.$i,$rootpath1);
				$logoname = str_replace(" ","_",$_FILES['attachment1']['name']);
				echo "file name:".$_FILES['attachment1']['name'];
				// step1 OK
				if(move_uploaded_file( $tmp_name1 , $rootpath1.str_replace(" ","_",$logoname) )){
						$newdata1 = array(
						'name'   => $name,
						'image'	=> '/upload/collar/'.str_replace(" ","_",$logoname),
						'collar_link' => $collar_link ,
						'status' => $status,
						'custom_key' => $custom_key,
						);
							 $id222 = $this->product_model->add_collar($newdata1);

				}
				else{
					echo "There is some problem in uploading image";
				}

			}
		}
		$this->load->view('add_collar',$data);
	}


		function delete_collar($id)
		{

			$rootpath1 =  $this->config->item('upload_options');
			$image_link=$this->product_model->getCollarItem($id);
			$real_path= str_replace("/upload/","",$rootpath1).$image_link;
			unlink($real_path);
			$this->product_model->delete_collar($id);
			redirect($this->config->item('base_url').'product/add_collar');

		}

	function add_sleeve($id)
	{
		$data['allsleeve'] = $this->product_model->get_all_sleeve();
		$data['L_strErrorMessage'] = '';
		$name =  $this->input->post('name');
			$sleeve_link =  $this->input->post('sleeve_link');
		$status = $this->input->post('status');
		$custom_key =  $this->input->post('custom_key');
		if ($this->input->post('action') == 'add_sleeve') {

			if($_FILES['attachment1']['name']!= '') {
				$tmp_name1 =  $_FILES['attachment1']['tmp_name'];  //$_FILES['attachment'.$i]['tmp_name'];
				$rootpath1 =  $this->config->item('upload_options')."/sleeve/";
				//$logoname  =  $this->sprojects->upload_Classifile('attachment'.$i,$rootpath1);
				$logoname = str_replace(" ","_",$_FILES['attachment1']['name']);
				echo "file name:".$_FILES['attachment1']['name'];
				// step1 OK
				if(move_uploaded_file( $tmp_name1 , $rootpath1.str_replace(" ","_",$logoname) )){
						$newdata1 = array(
						'name'   => $name,
						'image'	=> '/upload/sleeve/'.str_replace(" ","_",$logoname),
						'sleeve_link' => $sleeve_link ,
						'status' => $status,
						'custom_key' => $custom_key,
						);
							 $id222 = $this->product_model->add_sleeve($newdata1);

				}
				else{
					echo "There is some problem in uploading image";
				}
				/*echo  $rootpath1.str_replace(" ","_",$logoname);
				echo "upload image path".$this->config->item('upload');

				echo "logoname".$logoname;

				exit();*/
			}
		// }
		}
		$this->load->view('add_sleeve',$data);
	}


			function delete_sleeve($id)
			{

							$rootpath1 =  $this->config->item('upload_options');
							$image_link=$this->product_model->getSleeveItem($id);
							$real_path= str_replace("/upload/","",$rootpath1).$image_link;
							unlink($real_path);
				$this->product_model->delete_sleeve($id);
				redirect($this->config->item('base_url').'product/add_sleeve');
			}

	function add_cuffs($id)
	{
			$data['allcuffs'] = $this->product_model->get_all_cuffs();
		$data['L_strErrorMessage'] = '';
		$name =  $this->input->post('name');
			$cuff_link =  $this->input->post('cuff_link');
		$status = $this->input->post('status');
		$custom_key =  $this->input->post('custom_key');
		if ($this->input->post('action') == 'add_cuffs') {

			if($_FILES['attachment1']['name']!= '') {
				$tmp_name1 =  $_FILES['attachment1']['tmp_name'];  //$_FILES['attachment'.$i]['tmp_name'];
				$rootpath1 =  $this->config->item('upload_options')."/cuffs/";
				//$logoname  =  $this->sprojects->upload_Classifile('attachment'.$i,$rootpath1);
				$logoname = str_replace(" ","_",$_FILES['attachment1']['name']);
				echo "file name:".$_FILES['attachment1']['name'];
				// step1 OK
				if(move_uploaded_file( $tmp_name1 , $rootpath1.str_replace(" ","_",$logoname) )){
						$newdata1 = array(
						'name'   => $name,
						'image'	=> '/upload/cuffs/'.str_replace(" ","_",$logoname),
						'cuff_link' => $cuff_link ,
						'status' => $status,
						'custom_key' => $custom_key,
						);
							 $id222 = $this->product_model->add_cuffs($newdata1);

				}
				else{
					echo "There is some problem in uploading image";
				}
				/*echo  $rootpath1.str_replace(" ","_",$logoname);
				echo "upload image path".$this->config->item('upload');

				echo "logoname".$logoname;

				exit();*/
			}
		// }
		}
		$this->load->view('add_cuffs',$data);
	}


			function delete_cuffs($id)
			{
				$rootpath1 =  $this->config->item('upload_options');
				$image_link=$this->product_model->getCuffItem($id);
				$real_path= str_replace("/upload/","",$rootpath1).$image_link;
				unlink($real_path);
				$this->product_model->delete_cuffs($id);
				redirect($this->config->item('base_url').'product/add_cuffs');
			}


	function add_button($id)
	{
			$data['allbutton'] = $this->product_model->get_all_button();
		$data['L_strErrorMessage'] = '';
		$name =  $this->input->post('name');
			$button_link =  $this->input->post('button_link');
		$status = $this->input->post('status');
		$custom_key =  $this->input->post('custom_key');
		if ($this->input->post('action') == 'add_button') {

			if($_FILES['attachment1']['name']!= '') {
				$tmp_name1 =  $_FILES['attachment1']['tmp_name'];  //$_FILES['attachment'.$i]['tmp_name'];
				$rootpath1 =  $this->config->item('upload_options')."/buttons/";
				//$logoname  =  $this->sprojects->upload_Classifile('attachment'.$i,$rootpath1);
				$logoname = str_replace(" ","_",$_FILES['attachment1']['name']);
				echo "file name:".$_FILES['attachment1']['name'];
				// step1 OK
				if(move_uploaded_file( $tmp_name1 , $rootpath1.str_replace(" ","_",$logoname) )){
						$newdata1 = array(
						'name'   => $name,
						'image'	=> '/upload/buttons/'.str_replace(" ","_",$logoname),
						'button_link' => $button_link ,
						'status' => $status,
						'custom_key' => $custom_key,
						);
							 $id222 = $this->product_model->add_button($newdata1);

				}
				else{
					echo "There is some problem in uploading image";
				}

			}
		}
		$this->load->view('add_button',$data);
	}


			function delete_button($id)
			{
				$rootpath1 =  $this->config->item('upload_options');
				$image_link=$this->product_model->getButtonItem($id);
				$real_path= str_replace("/upload/","",$rootpath1).$image_link;
				unlink($real_path);
				$this->product_model->delete_button($id);
				redirect($this->config->item('base_url').'product/add_button');
			}

	function add_pocket($id)
	{
			$data['allpocket'] = $this->product_model->get_all_pocket();
		$data['L_strErrorMessage'] = '';
		$name =  $this->input->post('name');
		$pocket_link =  $this->input->post('pocket_link');
		$custom_key =  $this->input->post('custom_key');
		$status = $this->input->post('status');
		if ($this->input->post('action') == 'add_pocket') {

			if($_FILES['attachment1']['name']!= '') {
				$tmp_name1 =  $_FILES['attachment1']['tmp_name'];  //$_FILES['attachment'.$i]['tmp_name'];
				$rootpath1 =  $this->config->item('upload_options')."/pockets/";
				//$logoname  =  $this->sprojects->upload_Classifile('attachment'.$i,$rootpath1);
				$logoname = str_replace(" ","_",$_FILES['attachment1']['name']);
				echo "file name:".$_FILES['attachment1']['name'];
				// step1 OK
				if(move_uploaded_file( $tmp_name1 , $rootpath1.str_replace(" ","_",$logoname) )){
						$newdata1 = array(
						'name'   => $name,
						'image'	=> '/upload/pockets/'.str_replace(" ","_",$logoname),
						'pocket_link' => $pocket_link ,
						'status' => $status,
						'custom_key' => $custom_key,
						);
							 $id222 = $this->product_model->add_pocket($newdata1);

				}
				else{
					echo "There is some problem in uploading image";
				}

			}
		}
		$this->load->view('add_pocket',$data);
	}

			function delete_pocket($id)
			{
				$rootpath1 =  $this->config->item('upload_options');
				$image_link=$this->product_model->getPocketItem($id);
				$real_path= str_replace("/upload/","",$rootpath1).$image_link;
				unlink($real_path);
				$this->product_model->delete_pocket($id);
				redirect($this->config->item('base_url').'product/add_pocket');
			}

	function add_placket($id)
	{
			$data['allplacket'] = $this->product_model->get_all_placket();
		$data['L_strErrorMessage'] = '';
		$name =  $this->input->post('name');
		$placket_link =  $this->input->post('placket_link');
		$custom_key =  $this->input->post('custom_key');
		$status = $this->input->post('status');
		if ($this->input->post('action') == 'add_placket') {

			if($_FILES['attachment1']['name']!= '') {
				$tmp_name1 =  $_FILES['attachment1']['tmp_name'];  //$_FILES['attachment'.$i]['tmp_name'];
				$rootpath1 =  $this->config->item('upload_options')."/plackets/";
				//$logoname  =  $this->sprojects->upload_Classifile('attachment'.$i,$rootpath1);
				$logoname = str_replace(" ","_",$_FILES['attachment1']['name']);
				echo "file name:".$_FILES['attachment1']['name'];
				// step1 OK
				if(move_uploaded_file( $tmp_name1 , $rootpath1.str_replace(" ","_",$logoname) )){
						$newdata1 = array(
						'name'   => $name,
						'image'	=> '/upload/plackets/'.str_replace(" ","_",$logoname),
						'placket_link' => $placket_link ,
						'status' => $status,
						'custom_key' => $custom_key,
						);
							 $id222 = $this->product_model->add_placket($newdata1);

				}
				else{
					echo "There is some problem in uploading image";
				}

			}
		}
		$this->load->view('add_placket',$data);
	}

			function delete_placket($id)
			{
				$rootpath1 =  $this->config->item('upload_options');
				$image_link=$this->product_model->getPlacketItem($id);
				$real_path= str_replace("/upload/","",$rootpath1).$image_link;
				unlink($real_path);
				$this->product_model->delete_placket($id);
				redirect($this->config->item('base_url').'product/add_placket');
			}

	function add_back($id)
	{
	$data['allback'] = $this->product_model->get_all_back();
		$data['L_strErrorMessage'] = '';
		$name =  $this->input->post('name');
			$back_link =  $this->input->post('back_link');
		$status = $this->input->post('status');
		$custom_key =  $this->input->post('custom_key');
		if ($this->input->post('action') == 'add_back') {

			if($_FILES['attachment1']['name']!= '') {
				$tmp_name1 =  $_FILES['attachment1']['tmp_name'];  //$_FILES['attachment'.$i]['tmp_name'];
				$rootpath1 =  $this->config->item('upload_options')."/backs/";
				//$logoname  =  $this->sprojects->upload_Classifile('attachment'.$i,$rootpath1);
				$logoname = str_replace(" ","_",$_FILES['attachment1']['name']);
				echo "file name:".$_FILES['attachment1']['name'];
				// step1 OK
				if(move_uploaded_file( $tmp_name1 , $rootpath1.str_replace(" ","_",$logoname) )){
						$newdata1 = array(
						'name'   => $name,
						'image'	=> '/upload/backs/'.str_replace(" ","_",$logoname),
						'back_link' => $back_link ,
						'status' => $status,
						'custom_key' => $custom_key,
						);
							 $id222 = $this->product_model->add_back($newdata1);

				}
				else{
					echo "There is some problem in uploading image";
				}

			}
		}
		$this->load->view('add_back',$data);
	}

			function delete_back($id)
			{
				$rootpath1 =  $this->config->item('upload_options');
				$image_link=$this->product_model->getBackItem($id);
				$real_path= str_replace("/upload/","",$rootpath1).$image_link;
				unlink($real_path);
				$this->product_model->delete_back($id);
				redirect($this->config->item('base_url').'product/add_back');
			}

	function add_bottom($id)
	{
			$data['allbottom'] = $this->product_model->get_all_bottom();
		$data['L_strErrorMessage'] = '';
		$name =  $this->input->post('name');
		$bottom_link = $this->input->post('bottom_link');
		$status = $this->input->post('status');
		$custom_key =  $this->input->post('custom_key');
		if ($this->input->post('action') == 'add_bottom') {

			if($_FILES['attachment1']['name']!= '') {
				$tmp_name1 =  $_FILES['attachment1']['tmp_name'];  //$_FILES['attachment'.$i]['tmp_name'];
				$rootpath1 =  $this->config->item('upload_options')."/bottom/";
				//$logoname  =  $this->sprojects->upload_Classifile('attachment'.$i,$rootpath1);
				$logoname = str_replace(" ","_",$_FILES['attachment1']['name']);
				echo "file name:".$_FILES['attachment1']['name'];
				// step1 OK
				if(move_uploaded_file( $tmp_name1 , $rootpath1.str_replace(" ","_",$logoname) )){
						$newdata1 = array(
						'name'   => $name,
						'image'	=> '/upload/bottom/'.str_replace(" ","_",$logoname),
						'bottom_link' => $bottom_link ,
						'status' => $status,
						'custom_key' => $custom_key,
						);
							 $id222 = $this->product_model->add_bottom($newdata1);

				}
				else{
					echo "There is some problem in uploading image";
				}

			}
		}
		$this->load->view('add_bottom',$data);
	}

	function delete_bottom($id)
	{
		$rootpath1 =  $this->config->item('upload_options');
		$image_link=$this->product_model->getBottomItem($id);
		$real_path= str_replace("/upload/","",$rootpath1).$image_link;
		unlink($real_path);
		$this->product_model->delete_bottom($id);
		redirect($this->config->item('base_url').'product/add_bottom');
	}

	function add_inner_contrast($id)
	{
		$data['allinnercontrast'] = $this->product_model->get_all_inner_contrast();
		$data['L_strErrorMessage'] = '';
		$name =  $this->input->post('name');
		$status = $this->input->post('status');
		$fabricid= $this->input->post('fabric_id');
		$inner_contrast_link =  $this->input->post('inner_contrast_link');
		$custom_key =  $this->input->post('custom_key');
		if ($this->input->post('action') == 'add_inner_contrast') {
		/*	print_r($_FILES);
			print_r($_POST);
			exit();*/
		// for($i = 0; $i < count($_FILES['attachment1']['name']); $i++)
		// {

			if($_FILES['attachment1']['name']!= '') {
				$tmp_name1 =  $_FILES['attachment1']['tmp_name'];  //$_FILES['attachment'.$i]['tmp_name'];
				$rootpath1 =  $this->config->item('upload_options')."/inner_contrast/";
				//$logoname  =  $this->sprojects->upload_Classifile('attachment'.$i,$rootpath1);
				$logoname = str_replace(" ","_",$_FILES['attachment1']['name']);
				echo "file name:".$_FILES['attachment1']['name'];
				// step1 OK
				if(move_uploaded_file( $tmp_name1 , $rootpath1.str_replace(" ","_",$logoname) )){
						$newdata1 = array(
						'name'   => $name,
						'image'	=> '/upload/inner_contrast/'.str_replace(" ","_",$logoname),
						'fabric_id' => $fabricid,
						'status' => $status,
						 'inner_contrast_link' => $inner_contrast_link ,
						 'custom_key' => $custom_key,
						);
							 $id222 = $this->product_model->add_inner_contrast($newdata1);

				}
				else{
					echo "There is some problem in uploading image";
				}
				/*echo  $rootpath1.str_replace(" ","_",$logoname);
				echo "upload image path".$this->config->item('upload');

				echo "logoname".$logoname;

				exit();*/
			}
		// }
		}
		$this->load->view('add_inner_contrast',$data);
	}

	function delete_inner_contrast($id)
	{
		$rootpath1 =  $this->config->item('upload_options');
		$image_link=$this->product_model->getInnerContrastItem($id);
		$real_path= str_replace("/upload/","",$rootpath1).$image_link;
		unlink($real_path);
		$this->product_model->delete_inner_contrast($id);

		redirect($this->config->item('base_url').'product/add_inner_contrast');
	}



	function add_outer_contrast($id)
	{
			$data['alloutercontrast'] = $this->product_model->get_all_outer_contrast();
		$data['L_strErrorMessage'] = '';
		$name =  $this->input->post('name');
		$status = $this->input->post('status');
		$inner_contrast_link =  $this->input->post('inner_contrast_link');
		$fabricid= $this->input->post('fabric_id');
		$custom_key =  $this->input->post('custom_key');
		if ($this->input->post('action') == 'add_outer_contrast') {
		/*	print_r($_FILES);
			print_r($_POST);
			exit();*/
		// for($i = 0; $i < count($_FILES['attachment1']['name']); $i++)
		// {

			if($_FILES['attachment1']['name']!= '') {
				$tmp_name1 =  $_FILES['attachment1']['tmp_name'];  //$_FILES['attachment'.$i]['tmp_name'];
				$rootpath1 =  $this->config->item('upload_options')."/outer_contrast/";
				//$logoname  =  $this->sprojects->upload_Classifile('attachment'.$i,$rootpath1);
				$logoname = str_replace(" ","_",$_FILES['attachment1']['name']);
				echo "file name:".$_FILES['attachment1']['name'];
				// step1 OK
				if(move_uploaded_file( $tmp_name1 , $rootpath1.str_replace(" ","_",$logoname) )){
						$newdata1 = array(
						'name'   => $name,
						'image'	=> '/upload/outer_contrast/'.str_replace(" ","_",$logoname),
						'fabric_id' => $fabricid,
						'status' => $status,
						'outer_contrast_link' => $outer_contrast_link ,
						'custom_key' => $custom_key,

						);
							 $id222 = $this->product_model->add_outer_contrast($newdata1);

				}
				else{
					echo "There is some problem in uploading image";
				}
				/*echo  $rootpath1.str_replace(" ","_",$logoname);
				echo "upload image path".$this->config->item('upload');

				echo "logoname".$logoname;

				exit();*/
			}
		// }
		}
		$this->load->view('add_outer_contrast',$data);
	}

	function delete_outer_contrast($id)
	{
		$rootpath1 =  $this->config->item('upload_options');
		$image_link=$this->product_model->getOuterCntrastItem($id);
		$real_path= str_replace("/upload/","",$rootpath1).$image_link;
		unlink($real_path);
		$this->product_model->delete_outer_contrast($id);
		redirect($this->config->item('base_url').'product/add_outer_contrast');
	}


	function add_piping($id)
	{
			$data['allpiping'] = $this->product_model->get_all_piping();
		$data['L_strErrorMessage'] = '';
		$name =  $this->input->post('name');
		$status = $this->input->post('status');
		$piping_link =  $this->input->post('piping_link');
		$custom_key =  $this->input->post('custom_key');
		if ($this->input->post('action') == 'add_piping') {

			if($_FILES['attachment1']['name']!= '') {
				$tmp_name1 =  $_FILES['attachment1']['tmp_name'];  //$_FILES['attachment'.$i]['tmp_name'];
				$rootpath1 =  $this->config->item('upload_options')."/piping/";
				//$logoname  =  $this->sprojects->upload_Classifile('attachment'.$i,$rootpath1);
				$logoname = str_replace(" ","_",$_FILES['attachment1']['name']);
				echo "file name:".$_FILES['attachment1']['name'];
				// step1 OK
				if(move_uploaded_file( $tmp_name1 , $rootpath1.str_replace(" ","_",$logoname) )){
						$newdata1 = array(
						'name'   => $name,
						'image'	=> '/upload/piping/'.str_replace(" ","_",$logoname),
						'piping_link' => $piping_link ,
						'status' => $status,
						'custom_key' => $custom_key,
						);
							 $id222 = $this->product_model->add_piping($newdata1);

				}
				else{
					echo "There is some problem in uploading image";
				}

			}
		}
		$this->load->view('add_piping',$data);
	}
	function delete_piping($id)
	{
		$rootpath1 =  $this->config->item('upload_options');
		$image_link=$this->product_model->getPipingItem($id);
		$real_path= str_replace("/upload/","",$rootpath1).$image_link;
		unlink($real_path);
		$this->product_model->delete_piping($id);
		redirect($this->config->item('base_url').'product/add_piping');
	}

	function add_elbow($id)
	{
		$data['allelbow'] = $this->product_model->get_all_elbow();
		$data['L_strErrorMessage'] = '';
		$name =  $this->input->post('name');
		$status = $this->input->post('status');
		$elbow_link =  $this->input->post('elbow_link');
		$custom_key =  $this->input->post('custom_key');
		if ($this->input->post('action') == 'add_elbow') {

			if($_FILES['attachment1']['name']!= '') {
				$tmp_name1 =  $_FILES['attachment1']['tmp_name'];  //$_FILES['attachment'.$i]['tmp_name'];
				$rootpath1 =  $this->config->item('upload_options')."/elbow/";
				//$logoname  =  $this->sprojects->upload_Classifile('attachment'.$i,$rootpath1);
				$logoname = str_replace(" ","_",$_FILES['attachment1']['name']);
				echo "file name:".$_FILES['attachment1']['name'];
				// step1 OK
				if(move_uploaded_file( $tmp_name1 , $rootpath1.str_replace(" ","_",$logoname) )){
						$newdata1 = array(
						'name'   => $name,
						'image'	=> '/upload/elbow/'.str_replace(" ","_",$logoname),
						'elbow_link' => $elbow_link ,
						'status' => $status,
						'custom_key' => $custom_key,
						);
							 $id222 = $this->product_model->add_elbow($newdata1);

				}
				else{
					echo "There is some problem in uploading image";
				}

			}
		}
		$this->load->view('add_elbow',$data);
	}
	function delete_elbow($id)
	{
		$rootpath1 =  $this->config->item('upload_options');
		$image_link=$this->product_model->getElbowItem($id);
		$real_path= str_replace("/upload/","",$rootpath1).$image_link;
		unlink($real_path);
		$this->product_model->delete_elbow($id);
		redirect($this->config->item('base_url').'product/add_elbow');
	}

	function add_fabric_thumbnail($id)
	{
		$data['allfabric_thumbnail'] = $this->product_model->get_all_fabric_thumbnail();
		$data['allproducts'] = $this->product_model->get_allproducts();
		$data['allcategory'] = $this->product_model->get_allcategory();
		$data['L_strErrorMessage'] = '';
		$result = $this->product_model->get_product($this->input->post('pid'));
		$name =  $result[0]->pname;
		$status = $this->input->post('status');
		$fabric_link =  $this->input->post('fabric_link');
		$custom_key =  $this->input->post('custom_key');
		$pid =  $this->input->post('pid');
		$subcategory=  $this->input->post('subcategory');
		if ($this->input->post('action') == 'add_fabric_thumbnail') {

			if($_FILES['attachment1']['name']!= '') {
				$tmp_name1 =  $_FILES['attachment1']['tmp_name'];  //$_FILES['attachment'.$i]['tmp_name'];
				$rootpath1 =  $this->config->item('upload_options')."/fabric_swatch/";
				//$logoname  =  $this->sprojects->upload_Classifile('attachment'.$i,$rootpath1);
				$logoname = str_replace(" ","_",$_FILES['attachment1']['name']);
				echo "file name:".$_FILES['attachment1']['name']." path : ". $rootpath1;
				// step1 OK
				if(move_uploaded_file( $tmp_name1 , $rootpath1.str_replace(" ","_",$logoname) )){
						$newdata1 = array(
						'name'   => $name,
						'image'	=> '/upload/fabric_swatch/'.str_replace(" ","_",$logoname),
						'fabric_link' => $fabric_link ,
						'status' => $status,
						'custom_key' => $custom_key,
						'pid' => $pid ,
						'subcategory' => $subcategory,
						);
							 $id222 = $this->product_model->add_fabric_thumbnail($newdata1);

				}
				else{
					echo "There is some problem in uploading image";
				}

			}
		}
		$this->load->view('add_fabric_thumbnail',$data);
	}
	function delete_fabric_thumbnail($id)
	{
		$rootpath1 =  $this->config->item('upload_options');
		$image_link=$this->product_model->getFabricThumbnailItem($id);
		$real_path= str_replace("/upload/","",$rootpath1).$image_link;
		unlink($real_path);
		$this->product_model->delete_fabric_thumbnail($id);
		redirect($this->config->item('base_url').'product/add_fabric_thumbnail');
	}



}
?>

<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends CI_Controller {

   function __Construct(){
		  parent::__Construct ();
			$this->load->helper('url');
			$this->load->database();
			$this->load->library('cart');
			$this->load->library('session');
			$this->load->model('Cart_model');
			$this->load->model('home_model');
			$this->load->model('account_model');
			$this->load->model("standard_measurement_model"); 

	}

	function add()
	{
		//$this->load->library();
		//$this->load->library('session');
		if ($this->session->userdata('measuredid') == ""){
			if($this->input->post('measureid') !=""){
				$this->session->set_userdata('measuredid',$this->input->post('measureid'));
			}
		}
		//echo $this->session->userdata('measuredid');die;
		$goontheway = '0';
		foreach( $this->cart->contents() as $items)
		{
			 if( $items['options']['newmid'] == $this->session->userdata('measuredid') ){
					$goontheway = '1';
			 }
		}

		if($goontheway == '0'){
			redirect($this->config->item('http_host').'measurement','refresh',$data);
		}

		$data['err_msg'] = '';
		$data['sizeid']=$this->input->post('sizeid');
		$this->session->set_userdata('sizeid',$data['sizeid']);
		/* new cart */
		$font = $this->session->userdata('cfonttype');
		$color = $this->session->userdata('ccolour');
		$placement = $this->session->userdata('cplacement');
		$monovalue = $this->session->userdata('cmonovalue');
		//echo $monovalue;die;
		$monotext = $this->session->userdata('cmonotext');

		if($this->session->userdata('updatemeasuredid') != '1') {
		$details = $this->Cart_model->productdetails($this->session->userdata('cstyleid'));
		//echo $details->style_id;die;
		$stylename = $this->home_model->getstylename($details->style_id);
	    $productinfo = $this->home_model->productinfo($this->session->userdata('prodid'));
		$price = $details->sellingprice;
		$data['cartprod'] = array(
			   'id'      => $details->id,
 			   'qty'     => $this->session->userdata('cqty'),
			   'price'   => $price,
			   'name'    => $productinfo->pname.":".$stylename,
			   'options' => array('fonts'=>$font , 'color'=>$color, 'newmid'=>$this->session->userdata('measureid'), 'prodid'=>$this->session->userdata('prodid'), 'placement'=>$placement, 'monovalue'=>$monovalue, 'monotext'=>$monotext, 'is_3d'=> '0')
 	        );
		//print_r($data['cartprod']);die();
 		$this->cart->insert($data);
		$this->Cart_model->insertcartindb($data['cartprod']);
		}
		/* new cart end */
 		redirect($this->config->item('http_host').'cart/lum_view_cart','refresh',$data);

 }


	function addgifttocart(){
		if($_POST['friendemail'] != '' && count($_POST['friendemail']) > 0) {
			//for($j='0';$j<count($_POST['friendemail']);$j++) {
				//print_r($_POST['recipientemail']);die;
 				$friendname   = $_POST['friendname'];
				$yourname = $_POST['yourname'];
				$friendemail    = $_POST['friendemail'];
				$message  = $_POST['message'];
				$theme    = $_POST['gift_type'];
				$currency    = $_POST['currency'];
				//echo $currency;die;
				$data['cartprod'] = array(
					   'id'      => '1',
					   'qty'     => '1',
					   'price'   => $_POST['currency'],
					   'name'    => $_POST['friendname'],
					   'options' => array('friendname'=>$friendname, 'yourname'=>$yourname,'currency'=>$currency, 'friendemail' => $friendemail, 'message' =>$message, 'theme'=>$theme, 'is_3d'=> '2')
					);
				//echo "<pre>";
				//print_r($data['cartprod']);die;
				$this->cart->insert($data);
		//	}
		}

  		redirect($this->config->item('http_host').'cart/lum_view_cart','refresh',$data);
	}


	///
	function fitNew($style_id)
	{
		error_reporting(1);
		$this->session->unset_userdata('subcat');
        if($this->session->userdata('userid') == ''){
				redirect($this->config->item('http_host'),'refresh');
		}
		/* body mapping saving */
		$data = array();
		$data['L_strErrorMessage'] = "";
		$data['err_msg'] = "";
 		$data['foot']=$this->input->post('foot');
		$data['inch']=$this->input->post('inch');
		$data['weight']=$this->input->post('weight');
		$data['impheight']=$this->input->post('impheight');
		$data['impweight']=$this->input->post('impweight');
		$data['style_id']= $this->session->userdata('style_id');
		$data['pid'] = $this->session->userdata('prodid');
		if($this->session->userdata('measuredid') ==""){
			$this->Cart_model->insertbodymeasure($data);
			$lastinsertid=$this->db->insert_id();
			$this->session->set_userdata('measuredid',$lastinsertid);
		} else {
			$this->Cart_model->insertbodymeasure($data);
		}
		/* body measure saving */
		$data = array();
		$data['measure']=$this->input->post('measure');
		$data['pid']=$this->input->post('product_id');
		$data['style_id']= $style_id;
		//echo $this->session->userdata('measuredid');die;
		$this->Cart_model->updatebodymeasure($data);

		/* shoulder type saving */
		$data = array();

		$data['shouldertype']=$this->input->post('shouldertype');
		$data['pid']=$this->input->post('product_id');
		$data['style_id']= $style_id;
		$this->Cart_model->updateshouldertype($data);
		/* shoulder angle saving */
		$data = array();
		$data['shoulderangle']=$this->input->post('shoulderangle');
		$data['pid']=$this->input->post('product_id');
		$data['style_id']= $style_id;
		$this->Cart_model->updateshoulderangle($data);
		//echo $data['pid'];die;
		/*if($this->session->userdata('saveid') == ''){
			$subcatid = $this->home_model->getsubcatid($data['pid']);
		} else {
			$subcatid = '10';
		}*/
		$subcatid = '10';
		$subcatid1 = $this->session->set_userdata('subcat',$subcatid);
		$data['proparts'] = $this->home_model->prodparts($subcatid1);
		$data['subcat']=$subcatid1 ;
		//print_r($data['proparts']);die;
		$data['title'] = 'Stylior.com';
			$data['keywords'] = '';
			$data['description'] = '';
		$this->load->view('fit_new.php',$data);
	}

	////////

	/*function mapping($style_id = '') code replaced on 11oct2016
	{
		if($style_id == 'saved3d'){
				$this->session->set_userdata('saveid',$this->uri->segment(4));
		} else {
		if($this->uri->segment(4) !="")
		{
			$newmid =  $this->uri->segment(4);
			if($newmid != '') {
				//if($this->session->userdata('measuredid') =="") {
					$this->session->set_userdata('measuredid',$newmid );
					$this->session->set_userdata('updatemeasuredid','1');
				//}
			}
		} }
 		//echo ($style_id);die;

		//echo $this->session->userdata('subcat');die;
		$data = array();
		$data['L_strErrorMessage'] = "";
		$data['err_msg'] = "";
		if($this->input->post('measureid') !="") {
			$this->session->set_userdata('usermdata',$this->input->post('measureid'));
		}
		//echo $this->session->userdata('measuredid');die;
		$data['style_id'] = $style_id;
		$data['title'] = 'Stylior.com';
		$data['keywords'] = '';
		$data['description'] = '';
		$data['subcat'] = $this->session->userdata('subcat');

		//echo $this->session->userdata('subcat');die;

			$this->load->view('lum_header');
		//$this->load->view('body_weight_height_new.php',$data);
		if($this->session->userdata('subcat') > 10){

			$this->load->view('trousor_measure.php', $data);

		}
		else{

			$this->load->view('view_measurement.php', $data);
		}
		$this->load->view('lum_footer');
	}
*/
	//var changed
	function mapping($style_id = '')
	{


		if($style_id == 'saved3d'){
				$this->session->set_userdata('saveid',$this->uri->segment(4));
		} else {
		if($this->uri->segment(4) !="")
		{
			$newmid =  $this->uri->segment(4);
			if($newmid != '') {
				//if($this->session->userdata('measuredid') =="") {
					$this->session->set_userdata('measuredid',$newmid );
					$this->session->set_userdata('updatemeasuredid','1');
				//}
			}
		 }
	    }
 		$data = array();
		$data['L_strErrorMessage'] = "";
		$data['err_msg'] = "";
		$data['style_id'] = $style_id;
		$data['title'] = 'Stylior.com';
		$data['keywords'] = '';
		$data['description'] = '';
		$data['subcat'] = $this->session->userdata('subcat');
		$this->load->view('lum_header');
		if($this->session->userdata('subcat') > 10){

			$this->load->view('trousor_measure.php', $data);

		}
		else{
	  		    $base_url_temp=$this->config->config['base_url_temp'];

 	     $url_new=$base_url_temp."/custom-shirt/".$_SESSION['productid']."?&update=shirt&mid=".$newmid."#shirt_measurements";
		redirect($url_new);

		}

	}
 //var changed end
function savemesurementoncart()
	{
		$data=array();
		$data['metricft']=$this->input->post('foot');
		$data['metricinch']=$this->input->post('inch');
		$data['weight']=$this->input->post('weight');
		$data['impheight']=$this->input->post('impheight');
		$data['impweight']=$this->input->post('impweight');
		$data['style_id']= $this->session->userdata('styleid');
		$data['pid'] = $this->input->post('prodid');

		$this->Cart_model->insertbodymeasure($data);
		$lastinsertid=$this->db->insert_id();
		$this->session->set_userdata('measuredid',$lastinsertid);


		$profilename ="Stylior_".rand();
		$type =3;
		$size=$this->Cart_model->getSizeval($_POST['fit'],$_POST['size']);
		//print_r($size);die;
		$height=explode(" ",$_POST["height"]);
		$foot =$height[0]."ft";
		$inch=$height[2];
		$weight=0;
		$arraydata = array('0'=>"", '1'=>"");
		$data = serialize($arraydata);
		$this->Cart_model->updatebodymeasure1($data,$profilename,$type,$size,$foot,$inch,$weight);
		$prd_style_id= $this->Cart_model->productstyledetails($_POST['prodid']);
		$details = $this->Cart_model->productdetails($prd_style_id);
		//echo $details->style_id;die;
		$stylename = $this->home_model->getstylename($details->style_id);
	    $productinfo = $this->home_model->productinfo($_POST['prodid']);

		$price = $details->sellingprice;
		$data['cartprod'] = array(
			   'id'      => $details->id,
 			   'qty'     => 1,
			   'price'   => $price,
			   'name'    => $productinfo->pname.":".$stylename,
			   'options' => array('fonts'=>$font , 'color'=>$color, 'newmid'=>$this->session->userdata('measuredid'), 'prodid'=>$_POST['prodid'], 'placement'=>$placement, 'monovalue'=>$monovalue, 'monotext'=>$monotext, 'is_3d'=> '0')
 	        );

		//print_r($data['cartprod']);die();
 		$this->cart->insert($data);
		$this->Cart_model->insertcartindb($data['cartprod']);

}


/* rreplaced on date 11 oct 2016
	function custommesurements($style_id)
	{
		//echo $style_id;die;

		if($style_id == 'saved3d'){
				$this->session->set_userdata('saveid',$this->uri->segment(4));
				$this->session->set_userdata('latestcartId',$this->uri->segment(5));
		} else {
		if($this->uri->segment(4) !="")
		{
			$newmid =  $this->uri->segment(4);
			if($newmid != '') {
				if($this->session->userdata('measuredid') =="") {
					$this->session->set_userdata('measuredid',$newmid );
					$this->session->set_userdata('updatemeasuredid','1');
				}
			}
		} }

		//echo ($style_id);die;
		$data = array();
		$data['L_strErrorMessage'] = "";
		$data['err_msg'] = "";
		/*if($this->input->post('measureid') !="") {
			$this->session->set_userdata('usermdata',$this->input->post('measureid'));
		}
		//echo $this->session->userdata('measuredid');die;
		$data['style_id'] = $style_id;
		$data['title'] = 'Stylior.com';
		$data['keywords'] = '';
		$data['description'] = '';

		$this->load->library('user_agent');

		$cartdata = array(
 				'styleid'    =>$style_id,
				'cqty'      => '1',
		);
		$this->session->set_userdata($cartdata);
		$data['title'] = 'Stylior.com';
		$data['keywords'] = '';
		$data['description'] = '';

		$this->load->view('customusermeasurement.php',$data);
	}

	*/


	/*var added*/
	function custommesurements($style_id)
	{

		$this->load->model('User_model');
       	if($style_id == 'saved3d'){
				$this->session->set_userdata('saveid',$this->uri->segment(4));
				$this->session->set_userdata('latestcartId',$this->uri->segment(5));
        $subcatid = $this->uri->segment(6) ;
				$data_saved_3d=$this->User_model->savestylebyid($_SESSION['saveid']);
				unset($_SESSION['selected3dInfo_shirt']['details']);
				$_SESSION['selected3dInfo_shirt']['details']=$data_saved_3d[0]->details;
        $this->data['c']=json_decode($data_saved_3d[0]->details);
        $measureurl = $this->data['c']->product_details_page;
		} else {
		if($this->uri->segment(4) !="")
		{
			$newmid =  $this->uri->segment(4);
			if($newmid != '') {
				if($this->session->userdata('measuredid') =="") {
					$this->session->set_userdata('measuredid',$newmid );
					$this->session->set_userdata('updatemeasuredid','1');
				}
			}
		}
	   }

		$data = array();
		$data['L_strErrorMessage'] = "";
		$data['err_msg'] = "";
		/*if($this->input->post('measureid') !="") {
			$this->session->set_userdata('usermdata',$this->input->post('measureid'));
		}*/
		//echo $this->session->userdata('measuredid');die;
		$data['style_id'] = $style_id;
		$data['title'] = 'Stylior.com';
		$data['keywords'] = '';
		$data['description'] = '';

		$this->load->library('user_agent');

		$cartdata = array(
 				'styleid'    =>$style_id,
				'cqty'      => '1',
		);
		$this->session->set_userdata($cartdata);
		$data['title'] = 'Stylior.com';
		$data['keywords'] = '';
		$data['description'] = '';
		$base_url_temp = $this->config->item('base_url_temp');
		$base_fabric=json_decode($data_saved_3d[0]->details);

	/*	print_r(json_decode($data_saved_3d[0]->details));
		$base_fabric=json_decode($data_saved_3d[0]->details);
		print_r($base_fabric->base_fabric);

		exit();*/

		if (strpos($base_fabric->base_fabric, 'STY') !== false)
		{
			$str2 = substr($base_fabric->base_fabric, 3);
		}

    if($subcatid == 17)
    {
      $url_new=$this->config->item('current_protocol').$measureurl."#suit_measurements";
    }
    else if($subcatid == 16)
    {
      $url_new=$this->config->item('current_protocol').$measureurl."#blazer_measurements";
    }
    else if($subcatid == 18)
    {
      $url_new=$this->config->item('current_protocol').$measureurl."#vest_measurements";
    }
    else {
      # code...
        $url_new=$base_url_temp."/custom-shirt/".$_SESSION['productid']."#shirt_measurements";
    }

		redirect($url_new);

		//$this->load->view('new_3dcombine.php',$data);
	}


	function new_mvalue()
	{

		if(isset($_POST['measureid'])){
			$this->session->set_userdata('measureid', $_POST['measureid']);
		}

		//var end
		if($this->session->userdata('measuredid') ==""){
				$this->Cart_model->insertbodymeasure($data);
				$lastinsertid=$this->db->insert_id();
				$this->session->set_userdata('measuredid',$lastinsertid);
			} else {
				$this->Cart_model->insertbodymeasure($data);
		 }


		$this->session->set_userdata($cartdata);
		parse_str($_POST['data'], $mesurement_data);

		//echo "<pre>";
		//print_r($mesurement_data);die;

		$_POST=array();

		//echo $mesurement_data['height'];die;
		if(isset($mesurement_data['height']))
		{

			$height_str=explode("'",$mesurement_data['height']);
			$_POST["foot"]=$height_str[0];
			$inch_arr=explode("\"",$height_str[1]);
			$_POST["inch"]=$inch_arr[0];
		}
		if(isset($mesurement_data['measure']) && $mesurement_data['measure']!="")
		{

			$_POST["measure"]=$mesurement_data['measure']+1;
		}
		if(isset($mesurement_data['shouldertype']) && $mesurement_data['shouldertype']!="")
		{

			$_POST["shouldertype"]=$mesurement_data['shouldertype']+1;
		}
		if(isset($mesurement_data['shoulderangle']) &&$mesurement_data['shoulderangle']!="")
		{

			$_POST["shoulderangle"]=$mesurement_data['shoulderangle']+1;
		}
		if(isset($mesurement_data['fit']) &&$mesurement_data['fit']!="")
		{

			$_POST["fit"]=$mesurement_data['fit']+1;
		}

		if(isset($mesurement_data['weight']) &&$mesurement_data['weight']!="")
		{

			$_POST["weight"]=$mesurement_data['weight'];
		}

		if(isset($mesurement_data['bodypartvalue']) &&$mesurement_data['bodypartvalue']!="")
		{

			$arary1=array_keys($mesurement_data['bodypartvalue']);
			$arary2=array_values($mesurement_data['bodypartvalue']);
		}

		if(!$_POST['type'])
			$_POST['type']=3;

		if($this->session->userdata('measuredid')=='elements' || $this->session->userdata('measuredid')=='')
		{


			$this->session->set_userdata('measuredid',$this->input->post('measureid'));
		}

		//print_r($this->session->userdata('measuredid'));
 		//print_r($_POST);exit;
		//$profilename =strtotime("now")."_".rand(); //$_POST['profilename'];

		$profilename =$mesurement_data['profilename'].'-'.$mesurement_data['catval'];
		echo "Display proifle name:".$profilename;
		$type =$_POST['type'];
		$size=$_POST['sizeid'];
		$foot =$_POST["foot"];
		$inch=$_POST['inch'];
		$weight=$_POST['weight'];
		//print_r($_POST);exit;
		//echo "<pre>";print_r($_POST );die;
			/* body measure saving */
		if($this->input->post('measure')){
			$data = array();
			$data['measure']=$this->input->post('measure');
			$data['pid']=$this->input->post('product_id');
			$data['style_id']= $style_id;
			//echo $this->session->userdata('measuredid');die;
			$this->Cart_model->updatebodymeasure($data);
		}
		/* shoulder type saving */
		if($this->input->post('shouldertype')){
			$data = array();
			$data['shouldertype']=$this->input->post('shouldertype');
			$data['pid']=$this->input->post('product_id');
			$data['style_id']= $style_id;
			$this->Cart_model->updateshouldertype($data);
		}
		/* shoulder angle saving */
		if($this->input->post('shoulderangle')){
			$data = array();
			$data['shoulderangle']=$this->input->post('shoulderangle');
			$data['pid']=$this->input->post('product_id');
			$data['style_id']= $style_id;
			$this->Cart_model->updateshoulderangle($data);
		}

		$data = array();
			if( isset($_POST['fit']) && count($_POST['fit']) > 0) {
				$data['fit'] = $this->input->post('fit');
				$this->session->set_userdata('fit', $data['fit']);
				$data['pid'] = $this->input->post('pid');
				$data['bid'] = $this->input->post('bid');
				$this->Cart_model->updatefit($data);
			} else {
				$data['fit'] = $this->session->userdata('fit');
			}

		if($type == '4') {
			//echo 'test';die;
			$data['brandid'] = $this->input->post('brandid');
			$data['fitid'] = $this->input->post('fitid');
			$data['sizeid'] = $this->input->post('sizeid');
			$data['comments'] = $this->input->post('comments');
  			$this->Cart_model->updatebodymeasure_brand($data,$profilename,$type,$foot,$inch,$weight);
		} else {
			//echo 'oneday';die;
				/*if($_POST['bodypartid'] != ''){
					$arary1 = implode(',',$_POST['bodypartid']);
				}
				if($_POST['bodypartid'] != ''){
					$arary2 = implode(',',$_POST['bodypartvalue']);
				}*/

			$arraydata = array('0'=>$arary1, '1'=>$arary2);
			$data = serialize($arraydata);
			$sizeid = $this->input->post('sizeid');
			echo "data display here".$data;
			print_r($data);
			$this->Cart_model->updatebodymeasure1($data,$profilename,$type,$sizeid,$foot,$inch,$weight);
			//echo "return value".$this->session->set_userdata('measuredid');
			echo $this->session->userdata('user_id');
			echo "This is testing";
		}


		if($this->session->userdata('saveid') != '')
		{

			$i = 1;
				foreach( $this->cart->contents() as $items)
				{
					if( $items['options']['saveid'] == $this->session->userdata('saveid') )
					{
						if($items['options']['newmid'] == ""){
 						$rowid = $items['rowid'];
						$id    = $items['id'];
						$price = $items['price'];
						$qty   = $items['qty'];
						$name  = $items['name'];

						$details = $items['options']['details'];
						$imagename = $items['options']['imagename'];

						$data = array(
						   'rowid' => $rowid,
						   'qty'   => 0
						);

 						$this->cart->update($data);
						$data['cartprod'] = array(
							   'id'      => $id,
							   'qty'     => $qty,
							   'price'   => $price,
							   'name'    => $name,
							   'options' => array('details'=>$details , 'imagename'=>$imagename, 'newmid'=>$this->session->userdata('measuredid'), 'is_3d'=> '1', 'saveid' => $this->session->userdata('saveid') )
							);

						//print_r($data['cartprod']);die();
						$this->cart->insert($data);

						}
 					}
					$i++;
				}

			$this->Cart_model->updatecartmesure($this->session->userdata('latestcartId'),$this->session->userdata('measuredid'));
			redirect($this->config->item('http_host').'cart/lum_view_cart','refresh',$data);
		} else {


			redirect($this->config->item('http_host').'cart/add','refresh',$data);

		}
	}

  //function to update array object from 3d
  
  function updatecart()
{
	
		

		$mycartid=$_SESSION['latestcartId'];
		$lastid=$_SESSION['saveid'];
	    //if a data of subcatid is comming from ajax request....	
		//var start 31 march 2017..

 		if(isset($_POST['subcatid'])){
			$this->session->userdata['selected3dInfo_shirt']['subcatid']=$_POST['subcatid'];
			$this->session->userdata['subcatid']=$_POST['subcatid'];
		 }
		//var end here 31 march 2017
		//echo "lastt id".$lastid;
		//var_dump($_SESSION['saveid']);
		//if(!empty($_POST))
		{
		//JSON data need to be added
		$detailsneedtoupdate   = $_POST['details_up'];			 
		// echo "seesion herer";
		// echo "session 1".$this->session->userdata['subcatid'];
		// echo "session herer23".$this->session->userdata['selected3dInfo_vest']['subcatid'];
		// print_r($detailsneedtoupdate);
		// exit();
		//	print_r($this->session->userdata['selected3dInfo_shirt']['subcatid']);
		$josntoadded= json_decode($detailsneedtoupdate,true);
		//echo "Data  coming from poist--2";
		// print_r( $josntoadded );
		// exit();
		//last inserted record in save3d table
		$lastitem = $this->Cart_model->getlastinsertitem($lastid);
		//print_r($_SESSION);
		//echo "tesitng session";
		//added to get mycartid by var
		$mycartid=$this->session->userdata('latestcartId');
		//end var
		//exit();
		//last inserted record in mycart table
		//echo "mycartid".$mycartid;
		//print_r($this->session->userdata('order'));
		if($this->session->userdata('order')=="custom"){
				print_r($lastitem);
		}	   
	   	$lastitemmycart = $this->Cart_model->getlastinsertitemmycart($mycartid);
		//decoding json array from the last record : save3d(dbtable)
		$josn= json_decode($lastitem[0]->details,true);
		//decoding json array from the last record : mycart(dbtable)
		$josnmy= json_decode($lastitemmycart[0]->options,true);
		//echo "<pre>";
		$entityBody = stripslashes($lastitemmycart[0]->options);
		$decodedJSON = json_decode($entityBody, true);
		$sss=json_decode($josnmy['details'],true);	
		/*$book1 = $lastitemmycart[0]->options;
		$book=json_decode($book1);
		print_r($book);
		echo json_last_error(); // 4 (JSON_ERROR_SYNTAX)
		echo json_last_error_msg(); // unexpected character */
		//exit();
		//echo "<pre>";
		//print_r($sss);
		//echo "josn";
		//print_r($_SESSION);
		// 	die;
		//appending the new key values to the json save3d
		//$josn['standardsize']=$josntoadded['standardsize'];
		//$josn['length']=$josntoadded['length'];
		//$josn['fitype']=$josntoadded['fitype'];
		// echo "josn";
		// print_r($josn);
		//appending the new key values to the json mycart
		//$sss['standardsize']=$josntoadded['standardsize'];
		//$sss['length']=$josntoadded['length'];
		//$sss['fitype']=$josntoadded['fitype'];
		/***var added by 18oct
		*** standard measurements is storing in mycart from here..
		**** 10 for shirt , 11 for trouser ...
		*** note for SHehjaz : add create else if based on subcat id for suite and furhter..
		***/
		// print_r($josntoadded);
		// print_r($josntoadded['standardsize']);
		// 	echo "SSS variable";
		// 			print_r($sss);
		// 			exit();
		if($this->session->userdata['subcatid']==10||$this->session->userdata['selected3dInfo_shirt']['subcatid']==10){ 
				$sss['measurements']['standardsize']=$josntoadded['standardsize'];
				$sss['measurements']['WEIGHTkg']=$josntoadded['WEIGHTkg'];
				$sss['measurements']['fitype']=$josntoadded['fitype'];
				$sss['measurements']['length']=$josntoadded['length'];
				$sss['measurements']['shoulder']=$josntoadded['shoulder'];
				$sss['measurements']['neck']=$josntoadded['neck'];
				$sss['measurements']['sleeve']=$josntoadded['sleeve'];
				$sss['measurements']['shirt_length']=$josntoadded['shirt_length'];
				$sss['measurements']['chest']=$josntoadded['chest'];
				$sss['measurements']['waist']=$josntoadded['waist'];

	    }
    	else if($this->session->userdata['subcatid']==11||$this->session->userdata['selected3dInfo_shirt']['subcatid']==11){

			$sss['measurements']['HEIGHTinch']=$josntoadded['HEIGHTinch'];
			$sss['measurements']['WEIGHTkg']=$josntoadded['WEIGHTkg'];
			$sss['measurements']['pocket']=$josntoadded['pocket'];
			$sss['measurements']['Monogram']=$josntoadded['Monogram'];
			$sss['measurements']['MonoLocation']=$josntoadded['MonoLocation'];
			$sss['measurements']['Monofontstyle']=$josntoadded['Monofontstyle'];
			$sss['measurements']['Monocolor']=$josntoadded['Monocolor'];
			$sss['measurements']['fitype']=$josntoadded['fitype'];
			$sss['measurements']['standardsize']=$josntoadded['standardsize'];
			$sss['measurements']['waist']=$josntoadded['waist'];
			$sss['measurements']['hip']=$josntoadded['hip'];
			$sss['measurements']['rise']=$josntoadded['rise'];
			$sss['measurements']['bottom']=$josntoadded['bottom'];
			$sss['measurements']['knee']=$josntoadded['knee'];
			$sss['measurements']['thigh']=$josntoadded['thigh'];
     }
     else if($this->session->userdata['subcatid']==17 ||$this->session->userdata['selected3dInfo_pant']['subcatid']==17)
     {
      //var trouserMeasure={"HEIGHTinch":"","WEIGHTkg":"","pocket":"NO","Monogram":"NO","MonoLocation":"","Monofontstyle":"","Monocolor":"","Monotext":"None","fitype":"NO","standardsize":"NO","length":"NO","waist":"","hip":"","rise":"","bottom":"","knee":"","thigh":""}
      $sss['measurements']['standardsize']=$josntoadded['standardsize'];
      $sss['measurements']['WEIGHTkg']=$josntoadded['WEIGHTkg'];
      // $sss['measurements']['fitype']=$josntoadded['fitype'];
      // $sss['measurements']['length']=$josntoadded['length'];
      $sss['measurements']['shoulder']=$josntoadded['shoulder'];
      $sss['measurements']['sleeve']=$josntoadded['sleeve'];
      $sss['measurements']['backlength']=$josntoadded['backlength'];
      $sss['measurements']['chest']=$josntoadded['chest'];
      $sss['measurements']['upperwaist']=$josntoadded['upperwaist'];
      $sss['measurements']['HEIGHTinch']=$josntoadded['HEIGHTinch'];
      $sss['measurements']['waist']=$josntoadded['waist'];
      $sss['measurements']['hip']=$josntoadded['hip'];
      $sss['measurements']['rise']=$josntoadded['rise'];
      $sss['measurements']['bottom']=$josntoadded['bottom'];
      $sss['measurements']['knee']=$josntoadded['knee'];
      $sss['measurements']['thigh']=$josntoadded['thigh'];
	// echo "SSS variable";
	// print_r($sss);
	//  exit();
     }
      //end of var
    else if($this->session->userdata['subcatid']==16 ||$this->session->userdata['selected3dInfo_blazer']['subcatid']==16)
     {
        //var trouserMeasure={"HEIGHTinch":"","WEIGHTkg":"","pocket":"NO","Monogram":"NO","MonoLocation":"","Monofontstyle":"","Monocolor":"","Monotext":"None","fitype":"NO","standardsize":"NO","length":"NO","waist":"","hip":"","rise":"","bottom":"","knee":"","thigh":""};
        $sss['measurements']['standardsize']=$josntoadded['standardsize'];
        $sss['measurements']['WEIGHTkg']=$josntoadded['WEIGHTkg'];
        $sss['measurements']['fitype']=$josntoadded['fitype'];
        $sss['measurements']['length']=$josntoadded['length'];
        $sss['measurements']['shoulder']=$josntoadded['shoulder'];

        $sss['measurements']['sleeve']=$josntoadded['sleeve'];
        $sss['measurements']['backlength']=$josntoadded['backlength'];
        $sss['measurements']['chest']=$josntoadded['chest'];
        $sss['measurements']['upperwaist']=$josntoadded['upperwaist'];
        $sss['measurements']['HEIGHTinch']=$josntoadded['HEIGHTinch'];

       }
       else if($this->session->userdata['subcatid']==15 ||$this->session->userdata['selected3dInfo_shirt']['subcatid']==15)
       {
        //var trouserMeasure={"HEIGHTinch":"","WEIGHTkg":"","pocket":"NO","Monogram":"NO","MonoLocation":"","Monofontstyle":"","Monocolor":"","Monotext":"None","fitype":"NO","standardsize":"NO","length":"NO","waist":"","hip":"","rise":"","bottom":"","knee":"","thigh":""};
        $sss['measurements']['standardsize']=$josntoadded['standardsize'];
        $sss['measurements']['WEIGHTkg']=$josntoadded['WEIGHTkg'];
        $sss['measurements']['fitype']=$josntoadded['fitype'];
        $sss['measurements']['length']=$josntoadded['length'];
        $sss['measurements']['shoulder']=$josntoadded['shoulder'];
        $sss['measurements']['backlength']=$josntoadded['backlength'];
        $sss['measurements']['chest']=$josntoadded['chest'];
        $sss['measurements']['upperwaist']=$josntoadded['upperwaist'];
        $sss['measurements']['HEIGHTinch']=$josntoadded['HEIGHTinch'];
       }
	else if($this->session->userdata['subcatid']==18 ||$this->session->userdata['selected3dInfo_vest']['subcatid']==18)
      {
       
        $sss['measurements']['standardsize']=$josntoadded['standardsize'];
        $sss['measurements']['WEIGHTkg']=$josntoadded['WEIGHTkg'];
        //$sss['measurements']['fitype']=$josntoadded['fitype'];
        $sss['measurements']['length']=$josntoadded['backlength'];
        $sss['measurements']['shoulder']=$josntoadded['shoulder'];
        $sss['measurements']['backlength']=$josntoadded['backlength'];
        $sss['measurements']['chest']=$josntoadded['chest'];
        $sss['measurements']['upperwaist']=$josntoadded['upperwaist'];
        $sss['measurements']['HEIGHTinch']=$josntoadded['HEIGHTinch'];
        $sss['measurements']['pocket']=$josntoadded['pocket'];
      
       }
		
		$updateddetails=json_encode($josn);
		$josnmy['details']=json_encode($sss);
		/*var start*/		
		$count_cart=count($lastitemmycart);

		/*var stared : Measurement without the product reference code*/
		/*** Measurement before user login ..
		*/
		if($count_cart<=0) { 

		   $params = array(
			'subcatid' => $_POST['subcatid'],
			'options' => $josnmy['details'],
			'userid' => $_SESSION['user_id'],
			'added_date' => date("Y/m/d"),
			);		

			if($_POST['loginUser']=="no" && !isset($_SESSION['user_id'])){
				$_SESSION['standard_measurement']=$params;     
	      	exit();
			}
			else if(isset($_SESSION['user_id'])){
		   		$params = $_SESSION['standard_measurement'];
				$standard_measurement_id = $this->standard_measurement_model->add_standard_measurement($params);  
		   		exit();

               unset($_SESSION['standard_measurement']);
			}
			else{ 
				$standard_measurement_id = $this->standard_measurement_model->add_standard_measurement($params);           	
				$this->session->set_flashdata('msg', 'Measurement Added Successfully');
				exit();
		    }
	    
	    }
       /*End of Var Code Measurement wihout Product and Before login*/


		/*var end*/
		$updateddetailsmycart=json_encode($josnmy);
		$res = $this->Cart_model->updatedetails($lastid,$updateddetails);
		$resr = $this->Cart_model->updatedetailsmycart($mycartid,$updateddetailsmycart);
		foreach( $this->cart->contents() as $items)
			{
					if( $items['options']['saveid'] == $this->session->userdata('saveid') )
					{
						//echo "<pre>";
						//print_r($items['options']['details']);
						$items['options']['details']=$josnmy['details'];
						$this->cart->update($items);
						// echo "item in loop::";
						// echo "<pre>";
						// print_r($items);
						// //die;
						redirect($this->config->item('http_host').'cart/lum_view_cart','refresh',$data);
					}
			}

		}


	}




	function newmvalue()
	{

		if($_POST['bodypartid'] != ''){
			$arary1 = implode(',',$_POST['bodypartid']);
		}
		if($_POST['bodypartid'] != ''){
			$arary2 = implode(',',$_POST['bodypartvalue']);
		}
		$arraydata = array('0'=>$arary1, '1'=>$arary2);

		$profilename = $_POST['profilename'];
		$this->Cart_model->newupdatebodymeasure1($data, $profilename);
		$data1=unserialize($data);
		//echo "<pre>"; print_r($data1);die;
		redirect($this->config->item('http_host').'cart/add','refresh',$data);
	}
	function viewcart()
 	{
		//echo "<pre>";
		//print_r($_SESSION);

		$this->load->library('cart');
		$this->load->helper('url');
				$this->output->enable_profiler(FALSE);
			$http_host = $this->config->item('http_host');
				$this->load->view('header');
		//$this->session->unset_userdata('measuredid');
		//if(isset($_SESSION['user_id']) ==""){
			//redirect($http_host.'home/login');
		//}
		$this->session->unset_userdata('measuredid');

		if($this->session->userdata('user_id')=="")
		{
			redirect($http_host.'home/login');
		}
		//echo "<pre>";print_r($this->cart->contents() ) ;die;

 		$data = array();
 		$data['err_msg'] = '';
			$data['title'] = 'Stylior.com';
			$data['keywords'] = '';
			$data['description'] = '';
			//echo "<pre>";
			//print_r($data);exit;

		if($_SESSION['currencycode'] == '')
		{
		$inr = 'INR';
		$_SESSION['currencyvalue'] = '1';
		$_SESSION['currencycode'] = $inr;
		}
		else
		{
		$inr = $_SESSION['currencycode'];
		}


 		$this->load->view('viewcart',$data);

		$this->load->view('footer');
 	}




	public function lum_view_cart()
 	{
		 //error_reporting(E_ALL);
         //print_r($_SESSION);exit;
            // Display errors in output
        //    ini_set('display_errors', 1);
		$this->load->library('session');
		$this->load->helper('url');


		//$this->load->library('cart');
		$this->output->enable_profiler(FALSE);
		$http_host = $this->config->item('http_host');
		$this->load->view('lum_header');
		//$this->session->unset_userdata('measuredid');
		//if(isset($_SESSION['user_id']) ==""){
			//redirect($http_host.'home/login');
		//}
		$this->session->unset_userdata('measuredid');

		if($this->session->userdata('user_id')=="")
		{
			redirect($http_host.'home/lum_login_view');
		}
		//echo "<pre>";print_r($this->cart->contents() ) ;die;

 		$data = array();
 		$data['err_msg'] = '';
			$data['title'] = 'Stylior.com';
			$data['keywords'] = '';
			$data['description'] = '';
			//echo "<pre>";
			//print_r($data);exit;

		if($_SESSION['currencycode'] == '')
		{
		$inr = 'INR';
		$_SESSION['currencyvalue'] = '1';
		$_SESSION['currencycode'] = $inr;
		}
		else
		{
		$inr = $_SESSION['currencycode'];
		}

		//echo "<pre>";
		//print_r($session);
		//print_r($data);die;

 		$this->load->view('lum_viewcart',$data);
		$this->load->view('lum_footer');
 	}

/*
var started....
dated : 10th May 2017 
Remove this after use....
*/

public function lum_view_cart_test()
 	{
		 //error_reporting(E_ALL);
         //print_r($_SESSION);exit;
            // Display errors in output
        //    ini_set('display_errors', 1);
		$this->load->library('session');
		$this->load->helper('url');


		//$this->load->library('cart');
		$this->output->enable_profiler(FALSE);
		$http_host = $this->config->item('http_host');
		$this->load->view('lum_header');
		//$this->session->unset_userdata('measuredid');
		//if(isset($_SESSION['user_id']) ==""){
			//redirect($http_host.'home/login');
		//}
		$this->session->unset_userdata('measuredid');

		if($this->session->userdata('user_id')=="")
		{
			redirect($http_host.'home/lum_login_view');
		}
		//echo "<pre>";print_r($this->cart->contents() ) ;die;

 		$data = array();
 		$data['err_msg'] = '';
			$data['title'] = 'Stylior.com';
			$data['keywords'] = '';
			$data['description'] = '';
			//echo "<pre>";
			//print_r($data);exit;

		if($_SESSION['currencycode'] == '')
		{
		$inr = 'INR';
		$_SESSION['currencyvalue'] = '1';
		$_SESSION['currencycode'] = $inr;
		}
		else
		{
		$inr = $_SESSION['currencycode'];
		}
		//echo "<pre>";
		//print_r($session);
		//print_r($data);die;
 		$this->load->view('lum_viewcart_test',$data);
		$this->load->view('lum_footer');
 	}






	function saveadd3d(){

			$this->Cart_model->updatecartmesure($this->session->userdata('latestcartId'),$this->input->post('measureid'));

 				$i = 1;
				foreach( $this->cart->contents() as $items)
				{
					if( $items['options']['saveid'] == $this->session->userdata('saveid') ){

 						$rowid = $items['rowid'];
						$id    = $items['id'];
						$price = $items['price'];
						$qty   = $items['qty'];
						$name  = $items['name'];

						$details = $items['options']['details'];
						$imagename = $items['options']['imagename'];

						$data = array(
						   'rowid' => $rowid,
						   'qty'   => 0
						);

						$this->cart->update($data);
						$data['cartprod'] = array(
							   'id'      => $id,
							   'qty'     => $qty,
							   'price'   => $price,
							   'name'    => $name,
							   'options' => array('details'=>$details , 'imagename'=>$imagename, 'newmid'=>$this->input->post('measureid'), 'is_3d'=> '1', 'saveid' => $this->session->userdata('saveid') )
							);

						//print_r($data['cartprod']);die();
						$this->cart->insert($data);

 					}
					$i++;
				}

 		$this->session->unset_userdata('saveid');
 		$this->session->unset_userdata('measuredid');
		redirect($this->config->item('http_host').'cart/lum_view_cart','refresh',$data);
	}
	function add_direct()
	{
		error_reporting(1);
		$this->load->library();
		$this->load->library('session');

		if ($this->session->userdata('measuredid') == ""){
			if($this->input->post('measureid') !=""){
				$this->session->set_userdata('measuredid',$this->input->post('measureid'));


			}
		}


		$data['err_msg'] = '';
		$data['sizeid']=$this->input->post('sizeid');
		$this->session->set_userdata('sizeid',$data['sizeid']);
		/* new cart */
		$font = $this->session->userdata('cfonttype');
		$color = $this->session->userdata('ccolour');
		$placement = $this->session->userdata('cplacement');
		$monovalue = $this->session->userdata('cmonovalue');
		//echo $monovalue;die;
		$monotext = $this->session->userdata('cmonotext');
		print_r($_SESSION);

 		$details = $this->Cart_model->productdetails($this->session->userdata('cstyleid'));
		//echo $details->style_id;die;
		$stylename = $this->home_model->getstylename($details->style_id);
	    $productinfo = $this->home_model->productinfo($this->session->userdata('prodid'));

		$price = $details->sellingprice;
		$data['cartprod'] = array(
			   'id'      => $details->id,
 			   'qty'     => $this->session->userdata('cqty'),
			   'price'   => $price,
			   'name'    => $productinfo->pname.":".$stylename,
			   'options' => array('fonts'=>$font , 'color'=>$color, 'newmid'=>$this->session->userdata('measuredid'), 'prodid'=>$this->session->userdata('prodid'), 'placement'=>$placement, 'monovalue'=>$monovalue, 'monotext'=>$monotext, 'is_3d'=> '0')
 	        );

		//print_r($data['cartprod']);die();
 		$this->cart->insert($data);
		$this->Cart_model->insertcartindb($data['cartprod']);

		/* new cart end */
 		redirect($this->config->item('http_host').'cart/lum_view_cart','refresh',$data);
 	}

/************** TROUSER ADD TO CART *******************
********   AJAX request handle to store trouser customized data into cart and 3dsavedata....          
********   Date : 04/03/2017
********   Note : Created seperate fucntion from addcart3dcombined()
*****************/

function addToCartTrouser(){
		// print_r($_POST);
		// exit();
		/*[details] => {"pleats":{"part":"TRNOPLEAT","pair":"TRSLIM","swatch":"94238322"},"trouser_fit":{"part":"TRSLIM","pair":"TRNOPLEAT","swatch":"94238322"},"bottom_cuff":{"part":"TRCUFFYES","pair":"TRSLIM","swatch":"94238322"},"back_pocket":{"part":"TRNOPOCKET","pair":"TRSLIM","swatch":"94238322","view":" "},"belt":{"part":"trsidetabwl","pair":"TRSLIM","swatch":"94238322"},"trouser_button":{"part":"TBWHITE","pair":"trsidetabwl","pairpair":"TRSLIM","swatch":"94238322"}}
		[price_p] => 1750
		[productid_p] => 2015267
		[subcatid_p] => 11
		[pname_p] => Star Black Shirt
		[imagedata_p] => http://textronic.online/api_Stylior/v1/img?part=TRNOPLEAT&pair=TRSLIM&swatc…=TRSLIM&swatch=94238322&/part=TRNOPOCKET&pair=TRSLIM&swatch=94238322&view= &/part=trsidetabwl&pair=TRSLIM&swatch=94238322&/part=TBWHITE&pair=trsidetabwl&pairpair=TRSLIM&swatch=94238322&/
		[ordertype] => pant
		[order] => custom
		)
		*/
		unset($_SESSION['save3dInfo_shirt']['subcatid']);
		$_SESSION['save3dInfo_shirt']['subcatid']  = 11;
		$_SESSION['save3dInfo_pant']['subcatid']  = 11;
		$_SESSION['subcatid']  = 11;
		if($_POST['ordertype']=="pant")
		{
					$data_p      = $_POST['imagedata_p'];   //keep customized url here/
					$timeimage_p = time();
					$details_p   = $_POST['details'];
					$price_p     = $_POST['price_p'];
					$productid_p = $_POST['productid_p'];
					$pname_p     = $_POST['pname_p'];
					$subcatid_p  = 11; 
					$data12['details']  = $details_p;
					$data12['price']    = $price_p;
					$data12['productid'] = $productid_p;
					$data12['pname']    = $pname_p;
					$data12['userid']    =  $_SESSION['user_id'];
					// $data12['baseimage'] = $timeimage_p.".png";
					$data12['baseimage'] = $data_p;
				    //print_r($data12);				
					$saveid_p=$this->Cart_model->addto3dinsert($data12);
					$cartprod_p = array(
					'id'      => $productid_p,
					'qty'     => '1',
					'price'   => $price_p,
					'name'    => $pname_p,
					'options' => array('details'=>$details_p , 'imagename'=>$data_p.".png", 'is_3d'=>'1' , 'saveid'=> $saveid_p)
					);
					$this->cart->insert($cartprod_p);
					$addTocartId_p=$this->Cart_model->insertcartindb($cartprod_p);
					$this->session->set_userdata('latestcartId',$addTocartId_p);
					$this->session->set_userdata('saveid',$saveid_p);
				//	$file =$this->config->item('base_url_temp')."site/upload/saveprofile/".$timeimage_p.".png";
					//	$uri_p =  substr($data_p,strpos($data_p,",")+1);
					//file_put_contents($file, base64_decode($uri_p));
					echo "success";

		 }
		 else if($_SESSION['ordertype']=='pant')
		 {
			if(isset($_SESSION['selected3dInfo_pant']) && !empty($_SESSION['selected3dInfo_pant']))
			{

					$data_p      = $_SESSION['selected3dInfo_pant']['data'];
					$timeimage_p = time();
					$details_p   = $_SESSION['selected3dInfo_pant']['details'];
					$price_p     = $_SESSION['selected3dInfo_pant']['price'];
					$productid_p = $_SESSION['selected3dInfo_pant']['productid'];
					$pname_p     = $_SESSION['selected3dInfo_pant']['pname'];
					$subcatid_p  = 11;


			}
			if(!empty($_SESSION['Guestuser_id'])&& $_SESSION['usertype']=="Guest")
			{
					$_SESSION['user_id']=$_SESSION['Guestuser_id'];
			}		

			$newuserdata = array(
				   'username'  => $_SESSION['username'],
				   'userid'    => $_SESSION['user_id'],
				   'email'     => $_SESSION['email'],
				   'insider'   => $_SESSION['insider'],
				   'logged_in' => true
				);

		    $check = $this->session->set_userdata($newuserdata);
			$data12['details']  = $details_p;
			$data12['price']    = $price_p;
			$data12['productid'] = $productid_p;
			$data12['pname']    = $pname_p;
			$data12['userid']    =  $_SESSION['user_id'];
     		$data12['baseimage'] = $timeimage_p.".png";
     	    $saveid_p=$this->Cart_model->addto3dinsert($data12);
			$cartprod_p = array(
				   'id'      => $productid_p,
				   'qty'     => '1',
				   'price'   => $price_p,
				   'name'    => $pname_p,
				   'options' => array('details'=>$details_p , 'imagename'=>$timeimage_p.".png", 'is_3d'=>'1' , 'saveid'=> $saveid_p)
			);

			$this->cart->insert($cartprod_p);
			$addTocartId_p=$this->Cart_model->insertcartindb($cartprod_p);
			$this->session->set_userdata('latestcartId',$addTocartId_p);
			$this->session->set_userdata('saveid',$saveid_p);
			$file =$this->config->item('base_url_temp')."site/upload/saveprofile/".$timeimage_p.".png";
			$uri_p =  substr($data_p,strpos($data_p,",")+1);
			file_put_contents($file, base64_decode($uri_p));
			///////
			if(isset($_SESSION['selected3dInfo_pant']) && !empty($_SESSION['selected3dInfo_pant']) && $_SESSION['usertype']=="Guest")
			{
				$_SESSION['selected3dInfo_pant']='';
				if($_SESSION['order']=="custom")
				{


				 redirect($this->config->item('base_url_temp').'custom-trouser#trouser_measurements','location');
				}
				else if($_SESSION['order']=="stnadard")
				{
				 redirect($this->config->item('base_url_temp').'cart/lum_view_cart','location');
				}

			}
			else if(isset($_SESSION['selected3dInfo_pant']) && !empty($_SESSION['selected3dInfo_pant']) )
			{
				$_SESSION['selected3dInfo_pant']='';
				if($_SESSION['order']=="custom")
				{
				 redirect($this->config->item('http_host').'custom-trouser#trouser_measurements','location');
				}
				else if($_SESSION['order']=="stnadard")
				{
				 redirect($this->config->item('http_host').'cart/lum_view_cart','location');
				}


			}

		}

}

/************** SUIT ADD TO CART *******************
********   AJAX request handle to store suit customized data into cart and 3dsavedata....          
********   Date : 13/03/2017
********   Note : Created seperate fucntion from addcart3dcombined()
*****************/
function suitBeforeLogin(){
	 if($_POST['ordertype']=="suit")
		{

			$_SESSION['selected3dInfo_suit']['data']      = $_POST['imagedata_suit'];
			$timeimage = time();
			$_SESSION['selected3dInfo_suit']['details']   = $_POST['details'];
			$_SESSION['selected3dInfo_suit']['price']     = $_POST['price_suit'];
			$_SESSION['selected3dInfo_suit']['productid'] =  $_POST['productid_suit'];
			$_SESSION['selected3dInfo_suit']['pname']     = $_POST['	'];
			$_SESSION['selected3dInfo_suit']['subcatid']  = $_POST['subcatid_suit'];
			$_SESSION['order']=$_POST['order'];
			$_SESSION['ordertype']='suit';
			echo "success";


		}
}


/***********Function: addToCartBlazer******
********* Handle ajax requet and send response ***
********* 
*********/

function addToCartBlazer(){
		if($_POST['ordertype']=="blazer")
		{
			if(isset($_POST['imagedata_blazer'])){
			 $data = $_POST['imagedata_blazer'];
			}
			$timeimage = time();
			$details   = $_POST['details'];
			//server side price checking ... start var 18 Nov 2016
			if($this->session->userdata('blazer_cal')=="_YESTER"){
				if($this->session->userdata('total_price_blazer') == $_POST['price_blazer'] ){
					$price=$_POST['price_blazer'];
				}
				else{
					$price = $this->session->userdata('total_price_blazer');

				}
				$this->session->unset_userdata('blazer_cal');
				$this->session->unset_userdata('total_price_blazer');
			}
			else{
			$price=$_POST['price_blazer'];
			}
            //server side endd
			$productid = trim($_POST['productid_blazer']);
			$pname     = $_POST['pname_blazer'];
			$subcatid  = $_POST['subcatid_blazer'];
			$data11['details']  = $details;
			$data11['price']    = $price;
			$data11['productid'] = $productid;
			$data11['pname']    = $pname;
			$data11['userid']    =  $_SESSION['user_id'];
			$data11['baseimage'] = $data;
			// print_r($data11);
			// exit();
  			/*var added session to display image*/
			//unset($_SESSION['selected3dInfo_blazer']);
			if($_POST['ordertype']=="blazer")
			{

					$_SESSION['selected3dInfo_blazer']['data'] = $_POST['imagedata_blazer'];
					$timeimage = time();
					$_SESSION['selected3dInfo_blazer']['details']   = $_POST['details'];
					//server side price checking ... start var 18 Nov 2016
					if($this->session->userdata('blazer_cal')=="_YESTER"){
						if($this->session->userdata('total_price_blazer') == $_POST['price_blazer']){
							$_SESSION['selected3dInfo_blazer']['price'] =$_POST['price_blazer'];
						}
						else{
							$_SESSION['selected3dInfo_blazer']['price'] = $this->session->userdata('total_price_blazer');
						}
						$this->session->unset_userdata('blazer_cal');
                        $this->session->unset_userdata('total_price_blazer');
					}
					else{
					$_SESSION['selected3dInfo_blazer']['price']=$_POST['price_blazer'];
					}
		            //server side endd
					//$_SESSION['selected3dInfo_blazer']['price']     = $_POST['price_blazer
					$_SESSION['selected3dInfo_blazer']['productid'] =  $_POST['productid_blazer'];
					$_SESSION['selected3dInfo_blazer']['pname']     = $_POST['pname_blazer'];
					$_SESSION['selected3dInfo_blazer']['subcatid']  = $_POST['subcatid_blazer'];
					$_SESSION['order']=$_POST['order'];
					$_SESSION['ordertype']='blazer';
			}
			/*var end session*/

			$saveid=$this->Cart_model->addto3dinsert($data11);
			$cartprod = array(
				   'id'      => $productid,
				   'qty'     => '1',
				   'price'   => $price,
				   'name'    => $pname,
				   'options' => array('details'=>$details , 'imagename'=>$data, 'is_3d'=>'1' , 'saveid'=> $saveid)
			);



			if($this->cart->insert($cartprod)){
			echo "data inserted into cartd";
			}
			else{
			echo "fail to insert data into cart";

			}

			$addTocartId=$this->Cart_model->insertcartindb($cartprod);
			$this->session->set_userdata('latestcartId',$addTocartId);
			$this->session->set_userdata('saveid',$saveid);
			//$file =$this->config->item('base_url_temp')."site/upload/saveprofile/".$timeimage.".png";

			//$uri =  substr($data,strpos($data,",")+1);

		//	$dssre = base64_decode($uri);
		//	file_put_contents($file, base64_decode($uri));
			/*avr added session*/
			$cartdata = array(
			'styleid'    => $this->session->userdata('saveid'),
			'cqty'      => '1',
			);
			/*session add here avr*/
			/*end session here avr*/
			$this->session->set_userdata($cartdata);
			// print_r($_SESSION);
			echo "success";

		}
		else if($_SESSION['ordertype']=='blazer')
		{
		 	if(isset($_SESSION['selected3dInfo_blazer']) && !empty($_SESSION['selected3dInfo_blazer']))
			{
				    // unset($_SESSION['selected3dInfo_blazer']);
					$data      = $_SESSION['selected3dInfo_blazer']['data'];
					$timeimage = time();
					$details   = $_SESSION['selected3dInfo_blazer']['details'];
					$price     = $_SESSION['selected3dInfo_blazer']['price'];
					$productid = $_SESSION['selected3dInfo_blazer']['productid'];
					$pname     = $_SESSION['selected3dInfo_blazer']['pname'];
					$subcatid  = $_SESSION['selected3dInfo_blazer']['subcatid'];

					//var_dump($details);
			}
			if(!empty($_SESSION['Guestuser_id'])&& $_SESSION['usertype']=="Guest")
			{
					$_SESSION['user_id']=$_SESSION['Guestuser_id'];
			}
			$newuserdata = array(
				   'username'  => $_SESSION['username'],
				   'userid'    => $_SESSION['user_id'],
				   'email'     => $_SESSION['email'],

				   'logged_in' => true
			);
			$check = $this->session->set_userdata($newuserdata);
			$data11['details']  = $details;
			$data11['price']    = $price;
			$data11['productid'] = $productid;
			$data11['pname']    = $pname;
			$data11['userid']    =  $_SESSION['user_id'];
			// $data11['baseimage'] = $timeimage.".png";
			$data11['baseimage'] = $data;
			$saveid=$this->Cart_model->addto3dinsert($data11);
			$cartprod = array(
				   'id'      => $productid,
				   'qty'     => '1',
				   'price'   => $price,
				   'name'    => $pname,
				   'options' => array('details'=>$details , 'imagename'=>$data, 'is_3d'=>'1' , 'saveid'=> $saveid)
			);
			//print_r($cartprod);die();
			$this->cart->insert($cartprod);
			$addTocartId=$this->Cart_model->insertcartindb($cartprod);
			$this->session->set_userdata('latestcartId',$addTocartId);
			$this->session->set_userdata('saveid',$saveid);
			$file =$this->config->item('base_url_temp')."site/upload/saveprofile/".$timeimage.".png";
			$uri =  substr($data,strpos($data,",")+1);

			if (strpos($uri, "/textronic.online/api_Stylior/v1/img") == false){
				file_put_contents($file, base64_decode($uri));
			//		print_r($uri);
			}

			if(isset($_SESSION['selected3dInfo_blazer']) && !empty($_SESSION['selected3dInfo_blazer']))
			{ 
				if($_SESSION['order']=="standard")
				{
		
					$url=$this->config->item('base_url_temp')."custom-blazer";
					redirect($url."#blazer_measurements","location");
					
        
				}

			}
		
		}//session suit else if end
}
/*end of addtocartVest()*/


/***********Function: addToCartVest******
********* Handle ajax requet and send response ***
********* 
*********/

function addToCartVest(){
		if($_POST['ordertype']=="vest")
		{
			if(isset($_POST['imagedata_vest'])){
			 $data = $_POST['imagedata_vest'];
			}
			$timeimage = time();
			$details   = $_POST['details'];
			//server side price checking ... start var 18 Nov 2016
			if($this->session->userdata('vest_cal')=="_YESTER"){
				if($this->session->userdata('total_price_vest') == $_POST['price_vest'] ){
					$price=$_POST['price_vest'];
				}
				else{
					$price = $this->session->userdata('total_price_vest');

				}
				$this->session->unset_userdata('vest_cal');
				$this->session->unset_userdata('total_price_vest');
			}
			else{
			$price=$_POST['price_vest'];
			}
            //server side endd
			$productid = trim($_POST['productid_vest']);
			$pname     = $_POST['pname_vest'];
			$subcatid  = $_POST['subcatid_vest'];
			$data11['details']  = $details;
			$data11['price']    = $price;
			$data11['productid'] = $productid;
			$data11['pname']    = $pname;
			$data11['userid']    =  $_SESSION['user_id'];
			$data11['baseimage'] = $data;
			// print_r($data11);
			// exit();
  			/*var added session to display image*/
			//unset($_SESSION['selected3dInfo_vest']);
			if($_POST['ordertype']=="vest")
			{

					$_SESSION['selected3dInfo_vest']['data'] = $_POST['imagedata_vest'];
					$timeimage = time();
					$_SESSION['selected3dInfo_vest']['details']   = $_POST['details'];
					//server side price checking ... start var 18 Nov 2016
					if($this->session->userdata('vest_cal')=="_YESTER"){
						if($this->session->userdata('total_price_vest') == $_POST['price_vest']){
							$_SESSION['selected3dInfo_vest']['price'] =$_POST['price_vest'];
						}
						else{
							$_SESSION['selected3dInfo_vest']['price'] = $this->session->userdata('total_price_vest');
						}
						$this->session->unset_userdata('vest_cal');
                        $this->session->unset_userdata('total_price_vest');
					}
					else{
					$_SESSION['selected3dInfo_vest']['price']=$_POST['price_vest'];
					}
		            //server side endd
					//$_SESSION['selected3dInfo_vest']['price']     = $_POST['price_vest
					$_SESSION['selected3dInfo_vest']['productid'] =  $_POST['productid_vest'];
					$_SESSION['selected3dInfo_vest']['pname']     = $_POST['pname_vest'];
					$_SESSION['selected3dInfo_vest']['subcatid']  = $_POST['subcatid_vest'];
					$_SESSION['order']=$_POST['order'];
					$_SESSION['ordertype']='vest';
			}
			/*var end session*/

			$saveid=$this->Cart_model->addto3dinsert($data11);
			$cartprod = array(
				   'id'      => $productid,
				   'qty'     => '1',
				   'price'   => $price,
				   'name'    => $pname,
				   'options' => array('details'=>$details , 'imagename'=>$data, 'is_3d'=>'1' , 'saveid'=> $saveid)
			);



			if($this->cart->insert($cartprod)){
			echo "data inserted into cartd";
			}
			else{
			echo "fail to insert data into cart";

			}

			$addTocartId=$this->Cart_model->insertcartindb($cartprod);
			$this->session->set_userdata('latestcartId',$addTocartId);
			$this->session->set_userdata('saveid',$saveid);
			//$file =$this->config->item('base_url_temp')."site/upload/saveprofile/".$timeimage.".png";

			//$uri =  substr($data,strpos($data,",")+1);

		//	$dssre = base64_decode($uri);
		//	file_put_contents($file, base64_decode($uri));
			/*avr added session*/
			$cartdata = array(
			'styleid'    => $this->session->userdata('saveid'),
			'cqty'      => '1',
			);
			/*session add here avr*/
			/*end session here avr*/
			$this->session->set_userdata($cartdata);
			// print_r($_SESSION);
			echo "success";

		}
		else if($_SESSION['ordertype']=='vest')
		{
		 	if(isset($_SESSION['selected3dInfo_vest']) && !empty($_SESSION['selected3dInfo_vest']))
			{
				    // unset($_SESSION['selected3dInfo_vest']);
					$data      = $_SESSION['selected3dInfo_vest']['data'];
					$timeimage = time();
					$details   = $_SESSION['selected3dInfo_vest']['details'];
					$price     = $_SESSION['selected3dInfo_vest']['price'];
					$productid = $_SESSION['selected3dInfo_vest']['productid'];
					$pname     = $_SESSION['selected3dInfo_vest']['pname'];
					$subcatid  = $_SESSION['selected3dInfo_vest']['subcatid'];

					//var_dump($details);
			}
			if(!empty($_SESSION['Guestuser_id'])&& $_SESSION['usertype']=="Guest")
			{
					$_SESSION['user_id']=$_SESSION['Guestuser_id'];
			}
			$newuserdata = array(
				   'username'  => $_SESSION['username'],
				   'userid'    => $_SESSION['user_id'],
				   'email'     => $_SESSION['email'],

				   'logged_in' => true
			);
			$check = $this->session->set_userdata($newuserdata);
			$data11['details']  = $details;
			$data11['price']    = $price;
			$data11['productid'] = $productid;
			$data11['pname']    = $pname;
			$data11['userid']    =  $_SESSION['user_id'];
			// $data11['baseimage'] = $timeimage.".png";
			$data11['baseimage'] = $data;
			$saveid=$this->Cart_model->addto3dinsert($data11);
			$cartprod = array(
				   'id'      => $productid,
				   'qty'     => '1',
				   'price'   => $price,
				   'name'    => $pname,
				   'options' => array('details'=>$details , 'imagename'=>$data, 'is_3d'=>'1' , 'saveid'=> $saveid)
			);
			//print_r($cartprod);die();
			$this->cart->insert($cartprod);
			$addTocartId=$this->Cart_model->insertcartindb($cartprod);
			$this->session->set_userdata('latestcartId',$addTocartId);
			$this->session->set_userdata('saveid',$saveid);
			$file =$this->config->item('base_url_temp')."site/upload/saveprofile/".$timeimage.".png";
			$uri =  substr($data,strpos($data,",")+1);

			if (strpos($uri, "/textronic.online/api_Stylior/v1/img") == false){
				file_put_contents($file, base64_decode($uri));
			//		print_r($uri);
			}

			if(isset($_SESSION['selected3dInfo_vest']) && !empty($_SESSION['selected3dInfo_vest']))
			{ 
				if($_SESSION['order']=="standard")
				{
					//var added here
					/* print_r($_SESSION);
					echo "data new";
					print_r(	$this->session->userdata('selected3dInfo_vest'));
					*/ //
					// exit();
					//	$data_backurl=$this->session->userdata('selected3dInfo_vest');
					//	if($this->session->userdata('subcatid')==17){
					//$url=json_decode($data_backurl['details']);		
					$url=$this->config->item('base_url_temp')."custom/virtual_designer_vest";
						
						// echo $url;
						// exit();
					redirect($url."#vest_measurements","location");
					//}
        
				}

			}
		
		}//session suit else if end
}
/*end of addtocartBlazer()*/







function addToCartSuit(){

		if($_POST['ordertype']=="suit")
		{
			if(isset($_POST['imagedata_suit'])){
			 $data = $_POST['imagedata_suit'];
			}
			$timeimage = time();
			$details   = $_POST['details'];
			//server side price checking ... start var 18 Nov 2016
			if($this->session->userdata('suit_cal')=="_YESTER"){
				if($this->session->userdata('total_price_suit') == $_POST['price_suit'] ){
					$price=$_POST['price_suit'];
				}
				else{
					$price = $this->session->userdata('total_price_suit');

				}
				$this->session->unset_userdata('suit_cal');
				$this->session->unset_userdata('total_price_suit');
			}
			else{
			$price=$_POST['price_suit'];
			}
            //server side endd
			$productid = trim($_POST['productid_suit']);
			$pname     = $_POST['pname_suit'];
			$subcatid  = $_POST['subcatid_suit'];
			$data11['details']  = $details;
			$data11['price']    = $price;
			$data11['productid'] = $productid;
			$data11['pname']    = $pname;
			$data11['userid']    =  $_SESSION['user_id'];
			$data11['baseimage'] = $data;
			
			// print_r($data11);
			// exit();
			/*var added session to display image*/
			//unset($_SESSION['selected3dInfo_suit']);
			
			if($_POST['ordertype']=="suit")
			{

					$_SESSION['selected3dInfo_suit']['data'] = $_POST['imagedata_suit'];
					$timeimage = time();
					$_SESSION['selected3dInfo_suit']['details']   = $_POST['details'];
					//server side price checking ... start var 18 Nov 2016
					if($this->session->userdata('suit_cal')=="_YESTER"){
						if($this->session->userdata('total_price_suit') == $_POST['price_suit']){
							$_SESSION['selected3dInfo_suit']['price'] =$_POST['price_suit'];
						}
						else{
							$_SESSION['selected3dInfo_suit']['price'] = $this->session->userdata('total_price_suit');
						}
						$this->session->unset_userdata('suit_cal');
                        $this->session->unset_userdata('total_price_suit');
					}
					else{
					$_SESSION['selected3dInfo_suit']['price']=$_POST['price_suit'];
					}
		            //server side endd
					//$_SESSION['selected3dInfo_suit']['price']     = $_POST['price_suit
					$_SESSION['selected3dInfo_suit']['productid'] =  $_POST['productid_suit'];
					$_SESSION['selected3dInfo_suit']['pname']     = $_POST['pname_suit'];
					$_SESSION['selected3dInfo_suit']['subcatid']  = $_POST['subcatid_suit'];
					$_SESSION['order']=$_POST['order'];
					$_SESSION['ordertype']='suit';
			}
			/*var end session*/

			$saveid=$this->Cart_model->addto3dinsert($data11);
			$cartprod = array(
				   'id'      => $productid,
				   'qty'     => '1',
				   'price'   => $price,
				   'name'    => $pname,
				   'options' => array('details'=>$details , 'imagename'=>$data, 'is_3d'=>'1' , 'saveid'=> $saveid)
			);



			if($this->cart->insert($cartprod)){
			echo "data inserted into cartd";
			}
			else{
			echo "fail to insert data into cart";

			}

			$addTocartId=$this->Cart_model->insertcartindb($cartprod);
			$this->session->set_userdata('latestcartId',$addTocartId);
			$this->session->set_userdata('saveid',$saveid);
			$file =$this->config->item('base_url_temp')."site/upload/saveprofile/".$timeimage.".png";
			$uri =  substr($data,strpos($data,",")+1);
			//	$dssre = base64_decode($uri);
			//	file_put_contents($file, base64_decode($uri));
			/*avr added session*/
			$cartdata = array(
			'styleid'    => $this->session->userdata('saveid'),
			'cqty'      => '1',
			);
			/*session add here avr*/
			/*end session here avr*/
			$this->session->set_userdata($cartdata);
			// print_r($_SESSION);
			echo "success";

		}
		else if($_SESSION['ordertype']=='suit')
		{
		 	if(isset($_SESSION['selected3dInfo_suit']) && !empty($_SESSION['selected3dInfo_suit']))
			{
				    // unset($_SESSION['selected3dInfo_suit']);
					$data      = $_SESSION['selected3dInfo_suit']['data'];
					$timeimage = time();
					$details   = $_SESSION['selected3dInfo_suit']['details'];
					$price     = $_SESSION['selected3dInfo_suit']['price'];
					$productid = $_SESSION['selected3dInfo_suit']['productid'];
					$pname     = $_SESSION['selected3dInfo_suit']['pname'];
					$subcatid  = $_SESSION['selected3dInfo_suit']['subcatid'];
			}
			if(!empty($_SESSION['Guestuser_id'])&& $_SESSION['usertype']=="Guest")
			{
					$_SESSION['user_id']=$_SESSION['Guestuser_id'];
			}
			$newuserdata = array(
				   'username'  => $_SESSION['username'],
				   'userid'    => $_SESSION['user_id'],
				   'email'     => $_SESSION['email'],

				   'logged_in' => true
			);
			$check = $this->session->set_userdata($newuserdata);
			$data11['details']  = $details;
			$data11['price']    = $price;
			$data11['productid'] = $productid;
			$data11['pname']    = $pname;
			$data11['userid']    =  $_SESSION['user_id'];
			// $data11['baseimage'] = $timeimage.".png";
			$data11['baseimage'] = $data;
			$saveid=$this->Cart_model->addto3dinsert($data11);
			
			$cartprod = array(
				   'id'      => $productid,
				   'qty'     => '1',
				   'price'   => $price,
				   'name'    => $pname,
				   'options' => array('details'=>$details , 'imagename'=>$data, 'is_3d'=>'1' , 'saveid'=> $saveid)
			);

			//print_r($cartprod);die();
			$this->cart->insert($cartprod);
			$addTocartId=$this->Cart_model->insertcartindb($cartprod);
			$this->session->set_userdata('latestcartId',$addTocartId);
			$this->session->set_userdata('saveid',$saveid);
			$file =$this->config->item('base_url_temp')."site/upload/saveprofile/".$timeimage.".png";
			$uri =  substr($data,strpos($data,",")+1);

			if (strpos($uri, "/textronic.online/api_Stylior/v1/img") == false){
				file_put_contents($file, base64_decode($uri));
			//		print_r($uri);
			}
	
			if(isset($_SESSION['selected3dInfo_suit']) && !empty($_SESSION['selected3dInfo_suit']))
			{ 
				if($_SESSION['order']=="stnadard")
				{
					//var added here
					/* print_r($_SESSION);
					echo "data new";
					print_r(	$this->session->userdata('selected3dInfo_suit'));
					*/ //
					// exit();
					//	$data_backurl=$this->session->userdata('selected3dInfo_suit');
					//	if($this->session->userdata('subcatid')==17){
					//$url=json_decode($data_backurl['details']);		
					$url=$this->config->item('base_url_temp')."custom/virtual_designer_suit";					
					// echo $url;
					// exit();
					redirect($url."#suit_measurements","location");

					//}       
				}
			}	
		}//session suit else if end
}
/*end of addtocartSuit()*/

function addcart3dcombined(){
		if(isset($_POST['productid_shirt']) && $_POST['subcatid_shirt']==10){
			$id=$_POST['productid_shirt'];
			$id_p = str_replace("STY","",$id);
			$price_get=$this->Cart_model->getPriceByID($id_p);
			$session_currency=$this->session->userdata('currencycode');
			// print_r($session_currency);
			// print_r($price_get);
			$actual_price=$price_get->INR;
			//replace value of post->price to avoid javascript price change issue...
			$_POST['price']=$actual_price;
		}
		//error_reporting(E_ALL);
		if(!empty($_POST))
		{
			if($_POST['ordertype']=="trailshirt")
			{
			$bag = $this->cart->contents();
	 	 	$adddate;
		  	$data['userid'] = $this->session->userdata('user_id');
			foreach ($bag as $item)
		   	{
				$data['pid'] = str_replace("STY","",$item['id']);
				$sql = "SELECT DISTINCT `added_date` FROM `mycart` WHERE `userid` = '".$data['userid']."' AND `pid` != '2015115' AND `pid` = '".$item['id']."' LIMIT 0 , 1";
				$query = $this->db->query($sql);
				$result = $query->result();
				$adddate=$result[0]->added_date;
				$data['style_id'] = 47;
				$data['added_date'] = $adddate;
				if(!empty($adddate))
				{
				$check = $this->account_model->add_wishlist($data);
				 //removing cart item in Bag
				 $data1 = array(
	             'rowid'   => $item['rowid'],
	             'qty'     => 0
	              );
	             $this->cart->update($data1);
				 $this->Cart_model->removeproductcart($item['id']);
				  }
			}
		    $insert_new = TRUE;
			foreach ($bag as $item)
			{
				if ( $item['id'] == '2015115' )
				{
				  $insert_new = FALSE;
				}

			}

		  if($insert_new == TRUE)
		  {
			$data      = $_POST['imagedata'];
			$timeimage = time();
			$details   = $_POST['details'];
			$price     = $_POST['price'];
			$productid = $_POST['productid'];
			$pname     = $_POST['pname'];
			$subcatid  = $_POST['subcatid'];
			$data11['details']  = $details;
			$data11['price']    = $price;
			$data11['productid'] = $productid;
			$data11['pname']    = $pname;
			$data11['userid']    =  $_SESSION['user_id'];
			$data11['baseimage'] = $timeimage.".png";
			/*echo "data11";
			print_r($data11);
			die();*/
			$saveid=$this->Cart_model->addto3dinsert($data11);
			$cartprod = array(
				   'id'      => $productid,
				   'qty'     => '1',
				   'price'   => $price,
				   'name'    => $pname,
				   'options' => array('details'=>$details , 'imagename'=>$timeimage.".png", 'is_3d'=>'1' , 'saveid'=> $saveid)
			);
			//print_r($cartprod);die();
			$this->cart->insert($cartprod);
			$addTocartId=$this->Cart_model->insertcartindb($cartprod);
			$this->session->set_userdata('latestcartId',$addTocartId);
			$this->session->set_userdata('saveid',$saveid);
			//$file = $this->config->item('upload')."saveprofile/".$timeimage.".png";
			$file =$this->config->item('base_url_temp')."site/upload/saveprofile/".$timeimage.".png";
			$uri =  substr($data,strpos($data,",")+1);
			file_put_contents($file, base64_decode($uri));
			echo "success";

		  }

		}

		if($_POST['ordertype']=="both")
		{

					$data      = $_POST['imagedata_shirt'];
					$timeimage = time();
					$details   = $_POST['details'];
					$price     =$_POST['price_shirt'];
					$productid = $_POST['productid_shirt'];
					$pname     =$_POST['pname_shirt'];
					$subcatid  = $_POST['subcatid_shirt'];
					$data_p      =  $_POST['imagedata_pant'];
					$timeimage_p = time();
					$details_p   = $_POST['details'];
					$price_p     = $_POST['price_pant'];
					$productid_p = $_POST['productid_pant'];
					$pname_p     = $_POST['pname_pant'];
					$subcatid_p  = $_POST['subcatid_pant'];
					$data11['details']  = $details;
					$data11['price']    = $price;
					$data11['productid'] = $productid;
					$data11['pname']    = $pname;
					$data11['userid']    =  $_SESSION['user_id'];
					$data11['baseimage'] = $timeimage.".png";
					$data12['details']  = $details_p;
					$data12['price']    = $price_p;
					$data12['productid'] = $productid_p;
					$data12['pname']    = $pname_p;
					$data12['userid']    =  $_SESSION['user_id'];
					$data12['baseimage'] = $timeimage_p.".png";
			$saveid=$this->Cart_model->addto3dinsert($data11);
			$cartprod = array(
				   'id'      => $productid,
				   'qty'     => '1',
				   'price'   => $price,
				   'name'    => $pname,
				   'options' => array('details'=>$details , 'imagename'=>$timeimage.".png", 'is_3d'=>'1' , 'saveid'=> $saveid)
			);
			//print_r($cartprod);die();
			$this->cart->insert($cartprod);
			$addTocartId=$this->Cart_model->insertcartindb($cartprod);
			$this->session->set_userdata('latestcartId',$addTocartId);
			$this->session->set_userdata('saveid',$saveid);
			$file = $this->config->item('base_url_temp')."site/upload/saveprofile/".$timeimage.".png";
			$uri =  substr($data,strpos($data,",")+1);
			file_put_contents($file, base64_decode($uri));
			$saveid_p=$this->Cart_model->addto3dinsert($data12);
				$cartprod_p = array(
				   'id'      => $productid_p,
				   'qty'     => '1',
				   'price'   => $price_p,
				   'name'    => $pname_p,
				   'options' => array('details'=>$details_p , 'imagename'=>$timeimage_p.".png", 'is_3d'=>'1' , 'saveid'=> $saveid_p)
			);
			////////
			$this->cart->insert($cartprod_p);
			$addTocartId_p=$this->Cart_model->insertcartindb($cartprod_p);
			$this->session->set_userdata('latestcartId',$addTocartId_p);
			$this->session->set_userdata('saveid',$saveid_p);
			$file1 = $this->config->item('base_url_temp')."site/upload/saveprofile/".$timeimage_p.".png";
			$uri_p =  substr($data_p,strpos($data_p,",")+1);
			file_put_contents($file1, base64_decode($uri_p));

			echo "success";

		}
		else if($_POST['ordertype']=="shirt")
		{
			if(isset($_POST['imagedata_shirt'])){
				$data = $_POST['imagedata_shirt'];
			}
			$timeimage = time();
			$details   = $_POST['details'];

			//server side price checking ... start var 18 Nov 2016
			if($this->session->userdata('suit_cal')=="_YESTER"){
				if($this->session->userdata('total_price_suit') == $_POST['price_shirt'] ){
					$price=$_POST['price_shirt'];
				}
				else{
					$price = $this->session->userdata('total_price_suit');

				}
				$this->session->unset_userdata('suit_cal');
				$this->session->unset_userdata('total_price_suit');

			}
			else{
			$price=$_POST['price_shirt'];
			}

            //server side endd

			$productid = trim($_POST['productid_shirt']);

			$pname     = $_POST['pname_shirt'];
			$subcatid  = $_POST['subcatid_shirt'];
			$data11['details']  = $details;
			$data11['price']    = $price;
			$data11['productid'] = $productid;
			$data11['pname']    = $pname;
			$data11['userid']    =  $_SESSION['user_id'];
			$data11['baseimage'] = $data;

  			/*var added session to display image*/
			//unset($_SESSION['selected3dInfo_shirt']);
			if($_POST['ordertype']=="shirt")
			{

					$_SESSION['selected3dInfo_shirt']['data']      = $_POST['imagedata_shirt'];
					$timeimage = time();
					$_SESSION['selected3dInfo_shirt']['details']   = $_POST['details'];

					//server side price checking ... start var 18 Nov 2016
					if($this->session->userdata('suit_cal')=="_YESTER"){
						if($this->session->userdata('total_price_suit') == $_POST['price_shirt']){
							$_SESSION['selected3dInfo_shirt']['price'] =$_POST['price_shirt'];
						}
						else{
							$_SESSION['selected3dInfo_shirt']['price'] = $this->session->userdata('total_price_suit');

						}
						$this->session->unset_userdata('suit_cal');
                        $this->session->unset_userdata('total_price_suit');
					}
					else{
					$_SESSION['selected3dInfo_shirt']['price']=$_POST['price_shirt'];
					}

		            //server side endd


					//$_SESSION['selected3dInfo_shirt']['price']     = $_POST['price_shirt'];

					$_SESSION['selected3dInfo_shirt']['productid'] =  $_POST['productid_shirt'];
					$_SESSION['selected3dInfo_shirt']['pname']     = $_POST['pname_shirt'];
					$_SESSION['selected3dInfo_shirt']['subcatid']  = $_POST['subcatid_shirt'];
					$_SESSION['order']=$_POST['order'];
					$_SESSION['ordertype']='shirt';
			}
			/*var end session*/
  			//print_r($data11);die();
			$saveid=$this->Cart_model->addto3dinsert($data11);

			// var_dump($productid);
			// var_dump('STY2015277');



			$cartprod = array(
				   'id'      => $productid,
				   'qty'     => '1',
				   'price'   => $price,
				   'name'    => $pname,
				   'options' => array('details'=>$details , 'imagename'=>$data, 'is_3d'=>'1' , 'saveid'=> $saveid)
			);



			if($this->cart->insert($cartprod)){
			echo "data inserted into cartd";
			}
			else{
			echo "fail to insert data into cart";

			}

			$addTocartId=$this->Cart_model->insertcartindb($cartprod);
			$this->session->set_userdata('latestcartId',$addTocartId);
			$this->session->set_userdata('saveid',$saveid);
			$file =$this->config->item('base_url_temp')."site/upload/saveprofile/".$timeimage.".png";

			$uri =  substr($data,strpos($data,",")+1);

		//	$dssre = base64_decode($uri);
		//	file_put_contents($file, base64_decode($uri));
			/*avr added session*/
			$cartdata = array(
			'styleid'    => $this->session->userdata('saveid'),
			'cqty'      => '1',
			);
			/*session add here avr*/
			/*end session here avr*/
			$this->session->set_userdata($cartdata);
			// print_r($_SESSION);
			echo "success";

		}
		else if($_POST['ordertype']=="pant")
		{
				$data_p      = $_POST['imagedata_pant'];
				$timeimage_p = time();
				$details_p   = $_POST['details'];
				$price_p     = $_POST['price_pant'];
				$productid_p = $_POST['productid_pant'];
				$pname_p     = $_POST['pname_pant'];
				$subcatid_p  = $_POST['subcatid_pant'];
				$data12['details']  = $details_p;
				$data12['price']    = $price_p;
				$data12['productid'] = $productid_p;
				$data12['pname']    = $pname_p;
				$data12['userid']    =  $_SESSION['user_id'];
				$data12['baseimage'] = $timeimage_p.".png";
	    		$saveid_p=$this->Cart_model->addto3dinsert($data12);
				$cartprod_p = array(
				   'id'      => $productid_p,
				   'qty'     => '1',
				   'price'   => $price_p,
				   'name'    => $pname_p,
				   'options' => array('details'=>$details_p , 'imagename'=>$timeimage_p.".png", 'is_3d'=>'1' , 'saveid'=> $saveid_p)
			);
			$this->cart->insert($cartprod_p);
			$addTocartId_p=$this->Cart_model->insertcartindb($cartprod_p);
			$this->session->set_userdata('latestcartId',$addTocartId_p);
	    	$this->session->set_userdata('saveid',$saveid_p);
			$file =$this->config->item('base_url_temp')."site/upload/saveprofile/".$timeimage_p.".png";
			$uri_p =  substr($data_p,strpos($data_p,",")+1);
			//file_put_contents($file, base64_decode($uri_p));
			echo "success";
			

			}

		}//end of post not empty
		else
		{


				// echo "test";
				// $data_backurl=$this->session->userdata('selected3dInfo_shirt');
				// $url=json_decode($data_backurl['details']);
				// $set_url=$this->config->item('current_protocol').$url->product_details_page."#shirt_measurements";
				// echo "<script>window.location.href='".$set_url."'</script>" ;
				/*
				print_r($_SESSION);
				//				exit();
				//				if($this->session->userdata('subcatid')==10){
				$url=json_decode($data_backurl['details']);
				$set_url=$this->config->item('current_protocol').$url->product_details_page."#shirt_measurements";
				echo "<script>window.location.href=".$set_url."</script>" ;
				//redirect(,"location");
				//				}
				else if($this->session->userdata('subcatid')==11){
				$url=json_decode($data_backurl['details']);
				redirect($this->config->item('current_protocol').$url->product_details_page."#trouser_measurements","location");
				}
				*/

				if($_SESSION['ordertype']=='trailshirt')
				{

					if ($this->session->userdata('user_id') > 0)
					{
					$sql1 = "SELECT COUNT(*) AS ordcount  FROM `ci_orders` WHERE `user_id` = '".$this->session->userdata('user_id')."'";

					$query = $this->db->query($sql1);

					if ($query->num_rows() > 0)
					{
					    $result = $query->result();

					    $ordcont=$result[0]->ordcount;


						if($ordcont >0 )
						{
							echo "<script>
								alert('trail shirt not applicable ');

							window.location.href='".$this->config->item('base_url_temp')."cart/lum_view_cart/'

							</script>" ;
							$data['ordcount']=$ordcont;

						}

				}
				if(!empty($_SESSION['selected3dInfo_shirttrail']))
					{

							  $bag = $this->cart->contents();

								//echo var_dump($bag);
							$adddate;
							$data['userid'] = $this->session->userdata('user_id');

							foreach ($bag as $item)
							{

								$data['pid'] = str_replace("STY","",$item['id']);

							$sql = "SELECT DISTINCT `added_date` FROM `mycart` WHERE `userid` = '".$data['userid']."' AND `pid` != '2015115' AND `pid` = '".$item['id']."' LIMIT 0 , 1";
							$query = $this->db->query($sql);
							$result = $query->result();

							$adddate=$result[0]->added_date;
							$data['style_id'] = 47;
							$data['added_date'] = $adddate;



							if(!empty($adddate))
							{

							$check = $this->account_model->add_wishlist($data);

							//removing cart item in Bag
							$data1 = array(
							'rowid'   => $item['rowid'],
							'qty'     => 0
							);
							$this->cart->update($data1);
							$this->Cart_model->removeproductcart($item['id']);
							}


							}

							    $insert_new = TRUE;
								foreach ($bag as $item)
								{
								if ( $item['id'] == '2015115' )
								{
								  $insert_new = FALSE;
								}

								}


							if($insert_new == TRUE)
							{

							$data      = $_SESSION['selected3dInfo_shirttrail']['data'];
							$timeimage = time();
							$details   = $_SESSION['selected3dInfo_shirttrail']['details'];
							$price     = $_SESSION['selected3dInfo_shirttrail']['price'];
							$productid = $_SESSION['selected3dInfo_shirttrail']['productid'];
							$pname     = $_SESSION['selected3dInfo_shirttrail']['pname'];
							$subcatid  = $_SESSION['selected3dInfo_shirttrail']['subcatid'];


							$data11['details']  = $details;
							$data11['price']    = $price;
							$data11['productid'] = $productid;
							$data11['pname']    = $pname;
							$data11['userid']    =  $_SESSION['user_id'];
							$data11['baseimage'] = $timeimage.".png";

							$saveid=$this->Cart_model->addto3dinsert($data11);
							$cartprod = array(
							   'id'      => $productid,
							   'qty'     => '1',
							   'price'   => $price,
							   'name'    => $pname,
							   'options' => array('details'=>$details , 'imagename'=>$timeimage.".png", 'is_3d'=>'1' , 'saveid'=> $saveid)
						);


						$this->cart->insert($cartprod);
						$addTocartId=$this->Cart_model->insertcartindb($cartprod);
						$this->session->set_userdata('latestcartId',$addTocartId);
						$this->session->set_userdata('saveid',$saveid);
						$file = $this->config->item('base_url_temp')."site/upload/saveprofile/".$timeimage.".png";
						$uri =  substr($data,strpos($data,",")+1);
						file_put_contents($file, base64_decode($uri));


						}

			   		redirect($this->config->item('base_url_temp').'trial-shirt#shirt_measurements','location');
					echo "success";

				}




			}



		} //trial shirt end
			//assign the session data MSYS009
		else if($_SESSION['ordertype']=='both')
		{

					//var_dump($_SESSION);

			   if(isset($_SESSION['selected3dInfo_shirt']) && !empty($_SESSION['selected3dInfo_shirt']))
				{
						 $data  = $_SESSION['selected3dInfo_shirt']['data'];
						$timeimage = time();
						$details   = $_SESSION['selected3dInfo_shirt']['details'];
						$price     = $_SESSION['selected3dInfo_shirt']['price'];
						$productid = $_SESSION['selected3dInfo_shirt']['productid'];
						$pname     = $_SESSION['selected3dInfo_shirt']['pname'];
						$subcatid  = $_SESSION['selected3dInfo_shirt']['subcatid'];
				}


				if(isset($_SESSION['selected3dInfo_pant']) && !empty($_SESSION['selected3dInfo_pant']))
				{
						$data_p      = $_SESSION['selected3dInfo_pant']['data'];
						$timeimage_p = time();
						$details_p   = $_SESSION['selected3dInfo_pant']['details'];
						$price_p     = $_SESSION['selected3dInfo_pant']['price'];
						$productid_p = $_SESSION['selected3dInfo_pant']['productid'];
						$pname_p     = $_SESSION['selected3dInfo_pant']['pname'];
						$subcatid_p  = $_SESSION['selected3dInfo_pant']['subcatid'];

				}


			$newuserdata = array(
				   'username'  => $_SESSION['username'],
				   'userid'    => $_SESSION['user_id'],
				   'email'     => $_SESSION['email'],
				   'insider'   => $_SESSION['insider'],
				   'logged_in' => true
				);

				$check = $this->session->set_userdata($newuserdata);

			$data11['details']  = $details;
			$data11['price']    = $price;
			$data11['productid'] = $productid;
			$data11['pname']    = $pname;
			$data11['userid']    =  $_SESSION['user_id'];
			$data11['baseimage'] = $timeimage.".png";

			$data12['details']  = $details_p;
			$data12['price']    = $price_p;
			$data12['productid'] = $productid_p;
			$data12['pname']    = $pname_p;
			$data12['userid']    =  $_SESSION['user_id'];
			$data12['baseimage'] = $timeimage_p.".png";

			$saveid=$this->Cart_model->addto3dinsert($data11);
			 $saveid_p=$this->Cart_model->addto3dinsert($data12);

			$cartprod = array(
				   'id'      => $productid,
				   'qty'     => '1',
				   'price'   => $price,
				   'name'    => $pname,
				   'options' => array('details'=>$details , 'imagename'=>$timeimage.".png", 'is_3d'=>'1' , 'saveid'=> $saveid)
			);


				$cartprod_p = array(
				   'id'      => $productid_p,
				   'qty'     => '1',
				   'price'   => $price_p,
				   'name'    => $pname_p,
				   'options' => array('details'=>$details_p , 'imagename'=>$timeimage_p.".png", 'is_3d'=>'1' , 'saveid'=> $saveid_p)
			);
			//print_r($cartprod);die();
			$this->cart->insert($cartprod);
			$addTocartId=$this->Cart_model->insertcartindb($cartprod);
			$this->session->set_userdata('latestcartId',$addTocartId);
			$this->session->set_userdata('saveid',$saveid);
			$file = $this->config->item('base_url_temp')."site/upload/saveprofile/".$timeimage.".png";
			$uri =  substr($data,strpos($data,",")+1);
			file_put_contents($file, base64_decode($uri));

			////////


			$this->cart->insert($cartprod_p);

				$addTocartId_p=$this->Cart_model->insertcartindb($cartprod_p);

				$this->session->set_userdata('latestcartId',$addTocartId_p);

			$this->session->set_userdata('saveid',$saveid_p);

			$file1 = $this->config->item('base_url_temp')."site/upload/saveprofile/".$timeimage_p.".png";
			$uri_p =  substr($data_p,strpos($data_p,",")+1);
			file_put_contents($file1, base64_decode($uri_p));

				if(isset($_SESSION['selected3dInfo_pant']) && !empty($_SESSION['selected3dInfo_pant']) && isset($_SESSION['selected3dInfo_shirt']) && !empty($_SESSION['selected3dInfo_shirt']))
				{
					$_SESSION['selected3dInfo_shirt']='';
					$_SESSION['selected3dInfo_pant']='';
					 redirect($this->config->item('http_host').'home/savemeasurement','location');
				}


			}
		else if($_SESSION['ordertype']=='shirt')
		{


		   if(isset($_SESSION['selected3dInfo_shirt']) && !empty($_SESSION['selected3dInfo_shirt']))
			{
				    // unset($_SESSION['selected3dInfo_shirt']);
					$data      = $_SESSION['selected3dInfo_shirt']['data'];
					$timeimage = time();
					$details   = $_SESSION['selected3dInfo_shirt']['details'];
					$price     = $_SESSION['selected3dInfo_shirt']['price'];
					$productid = $_SESSION['selected3dInfo_shirt']['productid'];
					$pname     = $_SESSION['selected3dInfo_shirt']['pname'];
					$subcatid  = $_SESSION['selected3dInfo_shirt']['subcatid'];

					//var_dump($details);
			}

				if(!empty($_SESSION['Guestuser_id'])&& $_SESSION['usertype']=="Guest")
				{
					$_SESSION['user_id']=$_SESSION['Guestuser_id'];
				}

			$newuserdata = array(
				   'username'  => $_SESSION['username'],
				   'userid'    => $_SESSION['user_id'],
				   'email'     => $_SESSION['email'],

				   'logged_in' => true
				);

				$check = $this->session->set_userdata($newuserdata);

			$data11['details']  = $details;
			$data11['price']    = $price;
			$data11['productid'] = $productid;
			$data11['pname']    = $pname;
			$data11['userid']    =  $_SESSION['user_id'];
			$data11['baseimage'] = $timeimage.".png";
			$saveid=$this->Cart_model->addto3dinsert($data11);
			/*$cartprod = array(
				   'id'      => $productid,
				   'qty'     => '1',
				   'price'   => $price,
				   'name'    => $pname,
				   'options' => array('details'=>$details , 'imagename'=>$timeimage.".png", 'is_3d'=>'1' , 'saveid'=> $saveid)
			);*/
             //when file is converted into .png it not showing properly... so as of now we are storing encoded code...
			//1458147838.png
		$cartprod = array(
				   'id'      => $productid,
				   'qty'     => '1',
				   'price'   => $price,
				   'name'    => $pname,
				   'options' => array('details'=>$details , 'imagename'=>$data, 'is_3d'=>'1' , 'saveid'=> $saveid)
			);

			//print_r($cartprod);die();
			$this->cart->insert($cartprod);
			$addTocartId=$this->Cart_model->insertcartindb($cartprod);
			$this->session->set_userdata('latestcartId',$addTocartId);
			$this->session->set_userdata('saveid',$saveid);

			$file =$this->config->item('base_url_temp')."site/upload/saveprofile/".$timeimage.".png";
			$uri =  substr($data,strpos($data,",")+1);

			if (strpos($uri, "/textronic.online/api_Stylior/v1/img") == false){
				file_put_contents($file, base64_decode($uri));
			//		print_r($uri);
			}



			if(isset($_SESSION['selected3dInfo_shirt']) && !empty($_SESSION['selected3dInfo_shirt']))
			{
			    //$_SESSION['selected3dInfo_shirt']='';
				if($_SESSION['order']=="custom")
				{

					echo "usertype guest";
					/*start var code*/
				 	if(isset($_SESSION['catid']) && isset($_SESSION['subcatid']) && isset($_SESSION['productid'])){


					$url_new=$this->config->item('base_url_temp')."home/new_custom"."/".$_SESSION['catid']."/".$_SESSION['subcatid']."/".$_SESSION['productid']."#shirt_measurements";
					redirect($url_new);
					}
					else
					{
						redirect('https://www.stylior.com/custom/virtual_designer_shirt#shirt_measurements');
					}
					/*end var code*/
 			   //redirect('http://www.stylior.com/home/lum_saved_profile','location');
				}
				else if($_SESSION['order']=="stnadard")
				{
			        //var added here
			      /* print_r($_SESSION);
			       echo "data new";
			       print_r(	$this->session->userdata('selected3dInfo_shirt'));
			      */ //
			      // exit();

					$data_backurl=$this->session->userdata('selected3dInfo_shirt');
          if($this->session->userdata('subcatid')==10){
						$url=json_decode($data_backurl['details']);

					    redirect($this->config->item('current_protocol').$url->product_details_page."#shirt_measurements","location");

					}
					else if($this->session->userdata('subcatid')==11){
					$url=json_decode($data_backurl['details']);

					redirect($this->config->item('current_protocol').$url->product_details_page."#trouser_measurements","location");
					}
          else if($this->session->userdata('subcatid')==17){
					$url=json_decode($data_backurl['details']);

					redirect($this->config->item('current_protocol').$url->product_details_page."#suit_measurements","location");
					}
          else if($this->session->userdata('subcatid')==16){
          $url=json_decode($data_backurl['details']);

          redirect($this->config->item('current_protocol').$url->product_details_page."#blazer_measurements","location");
          }
          else if($this->session->userdata('subcatid')==18){
          $url=json_decode($data_backurl['details']);

          redirect($this->config->item('current_protocol').$url->product_details_page."#vest_measurements","location");
          }
					else{
						      redirect($this->config->item('base_url_temp').'cart/lum_view_cart','location');

					 //var end here..
					}

				}

			}
		else if(isset($_SESSION['selected3dInfo_shirt']) && !empty($_SESSION['selected3dInfo_shirt']) ){
				$_SESSION['selected3dInfo_shirt']='';
				if($_SESSION['order']=="custom")
				{
				/*start var code*/
				/*
				if(isset($_SESSION['catid']) && isset($_SESSION['subcatid']) && isset($_SESSION['productid'])){
				$url_new=$base_url_temp."/home/new_custom"."/".$_SESSION['catid']."/".$_SESSION['subcatid']."/".$_SESSION['productid'];
				redirect($url_new);
				}*/
				/*end var code*/
			    redirect($this->config->item('base_url_temp').'home/lum_saved_profile','location');
				}
				else if($_SESSION['order']=="stnadard")
				{

					/*					if(isset($_SESSION['product_details_page'])){
					redirect($_SESSION['product_details_page'],'location');
					}
					else{
					redirect('http://www.stylior.com/cart/lum_view_cart','location');
					}
					*/
					/*avr start*/
  				   $data_backurl=$this->session->userdata('selected3dInfo_shirt');
             if($this->session->userdata('subcatid')==10){
   						$url=json_decode($data_backurl['details']);

   					    redirect($this->config->item('current_protocol').$url->product_details_page."#shirt_measurements","location");

   					}
   					else if($this->session->userdata('subcatid')==11){
   					$url=json_decode($data_backurl['details']);

   					redirect($this->config->item('current_protocol').$url->product_details_page."#trouser_measurements","location");
   					}
             else if($this->session->userdata('subcatid')==17){
   					$url=json_decode($data_backurl['details']);

   					redirect($this->config->item('current_protocol').$url->product_details_page."#suit_measurements","location");
   					}
             else if($this->session->userdata('subcatid')==16){
             $url=json_decode($data_backurl['details']);

             redirect($this->config->item('current_protocol').$url->product_details_page."#blazer_measurements","location");
             }
             else if($this->session->userdata('subcatid')==15){
             $url=json_decode($data_backurl['details']);

             redirect($this->config->item('current_protocol').$url->product_details_page."#vest_measurements","location");
             }
   					else{
   						      redirect($this->config->item('base_url_temp').'cart/lum_view_cart','location');

   					 //var end here..
   					}
				}
			}
		}
		else if($_SESSION['ordertype']=='pant')
		{


			if(isset($_SESSION['selected3dInfo_pant']) && !empty($_SESSION['selected3dInfo_pant']))
			{

					$data_p      = $_SESSION['selected3dInfo_pant']['data'];
					$timeimage_p = time();
					$details_p   = $_SESSION['selected3dInfo_pant']['details'];
					$price_p     = $_SESSION['selected3dInfo_pant']['price'];
					$productid_p = $_SESSION['selected3dInfo_pant']['productid'];
					$pname_p     = $_SESSION['selected3dInfo_pant']['pname'];
					$subcatid_p  = $_SESSION['selected3dInfo_pant']['subcatid'];

			}

			if(!empty($_SESSION['Guestuser_id'])&& $_SESSION['usertype']=="Guest")
			{
					$_SESSION['user_id']=$_SESSION['Guestuser_id'];
			}
			$newuserdata = array(
				   'username'  => $_SESSION['username'],
				   'userid'    => $_SESSION['user_id'],
				   'email'     => $_SESSION['email'],
				   'insider'   => $_SESSION['insider'],
				   'logged_in' => true
				);

				$check = $this->session->set_userdata($newuserdata);


			$data12['details']  = $details_p;
			$data12['price']    = $price_p;
			$data12['productid'] = $productid_p;
			$data12['pname']    = $pname_p;
			$data12['userid']    =  $_SESSION['user_id'];
			$data12['baseimage'] = $timeimage_p.".png";

		   $saveid_p=$this->Cart_model->addto3dinsert($data12);


				$cartprod_p = array(
				   'id'      => $productid_p,
				   'qty'     => '1',
				   'price'   => $price_p,
				   'name'    => $pname_p,
				   'options' => array('details'=>$details_p , 'imagename'=>$timeimage_p.".png", 'is_3d'=>'1' , 'saveid'=> $saveid_p)
			);


			$this->cart->insert($cartprod_p);

				$addTocartId_p=$this->Cart_model->insertcartindb($cartprod_p);

				$this->session->set_userdata('latestcartId',$addTocartId_p);

			$this->session->set_userdata('saveid',$saveid_p);

			$file =$this->config->item('base_url_temp')."site/upload/saveprofile/".$timeimage_p.".png";

			$uri_p =  substr($data_p,strpos($data_p,",")+1);

			file_put_contents($file, base64_decode($uri_p));

			///////

			if(isset($_SESSION['selected3dInfo_pant']) && !empty($_SESSION['selected3dInfo_pant']) && $_SESSION['usertype']=="Guest")
			{
					$_SESSION['selected3dInfo_pant']='';
				if($_SESSION['order']=="custom")
				{


				 redirect($this->config->item('base_url_temp').'home/lum_saved_profile','location');
				}
				else if($_SESSION['order']=="stnadard")
				{
				 redirect($this->config->item('base_url_temp').'cart/lum_view_cart','location');
				}

			}
			else if(isset($_SESSION['selected3dInfo_pant']) && !empty($_SESSION['selected3dInfo_pant']) )
			{
				$_SESSION['selected3dInfo_pant']='';
				if($_SESSION['order']=="custom")
				{
				 redirect($this->config->item('http_host').'home/lum_saved_profile','location');
				}
				else if($_SESSION['order']=="stnadard")
				{
				 redirect($this->config->item('http_host').'cart/lum_view_cart','location');
				}


			}






			//////////
		}
	}
}//end of function


















	//saving 3d data
	function save3d()
	{
		if(!empty($_POST))
		{
			if($_POST['ordertype']=="both")
			{

					$data      = $_POST['imagedata_shirt'];
					$timeimage = time();

					$details   = $_POST['details'];


                    $price=$_POST['price_shirt'];
					$productid = $_POST['productid_shirt'];
					$pname     =$_POST['pname_shirt'];
					$subcatid  = $_POST['subcatid_shirt'];
			    	$data_p      =  $_POST['imagedata_pant'];
					$timeimage_p = time();
					$details_p   = $_POST['details'];
					$price_p     = $_POST['price_pant'];
					$productid_p = $_POST['productid_pant'];
					$pname_p     = $_POST['pname_pant'];
					$subcatid_p  = $_POST['subcatid_pant'];
					$data11['details']  = $details;
					$data11['price']    = $price;
					$data11['productid'] = $productid;
					$data11['pname']    = $pname;
					$data11['userid']    =  $_SESSION['user_id'];
					$data11['baseimage'] = $timeimage.".png";

					$data12['details']  = $details_p;
					$data12['price']    = $price_p;
					$data12['productid'] = $productid_p;
					$data12['pname']    = $pname_p;
					$data12['userid']    =  $_SESSION['user_id'];
					$data12['baseimage'] = $timeimage_p.".png";

			$value = $this->Cart_model->addto3dinsert($data11);
			$value_p = $this->Cart_model->addto3dinsert($data12);

			$file =$this->config->item('base_url_temp')."site/upload/saveprofile/".$timeimage.".png";
			$uri =  substr($data,strpos($data,",")+1);
			file_put_contents($file, base64_decode($uri));

			////////

			$file1 =$this->config->item('base_url_temp')."site/upload/saveprofile/".$timeimage_p.".png";
			$uri_p =  substr($data_p,strpos($data_p,",")+1);
			file_put_contents($file1, base64_decode($uri_p));



			}
			else if($_POST['ordertype']=="shirt")
			{
				$data      = $_POST['imagedata_shirt'];
					$timeimage = time();
					$details   = $_POST['details'];
					$price     =$_POST['price_shirt'];
					$productid = $_POST['productid_shirt'];
					$pname     =$_POST['pname_shirt'];
					$subcatid  = $_POST['subcatid_shirt'];




			$data11['details']  = $details;
			$data11['price']    = $price;
			$data11['productid'] = $productid;
			$data11['pname']    = $pname;
			$data11['userid']    =  $_SESSION['user_id'];
			$data11['baseimage'] = $timeimage.".png";

			$value = $this->Cart_model->addto3dinsert($data11);


			$file =$this->config->item('base_url_temp')."site/upload/saveprofile/".$timeimage.".png";
			$uri =  substr($data,strpos($data,",")+1);
			file_put_contents($file, base64_decode($uri));


			}
			else if($_POST['ordertype']=="pant")
			{

					$data_p      =  $_POST['imagedata_pant'];
					$timeimage_p = time();
					$details_p   = $_POST['details'];
					$price_p     = $_POST['price_pant'];
					$productid_p = $_POST['productid_pant'];
					$pname_p     = $_POST['pname_pant'];
					$subcatid_p  = $_POST['subcatid_pant'];


			$data12['details']  = $details_p;
			$data12['price']    = $price_p;
			$data12['productid'] = $productid_p;
			$data12['pname']    = $pname_p;
			$data12['userid']    =  $_SESSION['user_id'];
			$data12['baseimage'] = $timeimage_p.".png";


			$value_p = $this->Cart_model->addto3dinsert($data12);


			$file1 =$this->config->item('base_url_temp')."site/upload/saveprofile/".$timeimage_p.".png";
			$uri_p =  substr($data_p,strpos($data_p,",")+1);
			file_put_contents($file1, base64_decode($uri_p));

			}

		}
		else
		{
			 if($_SESSION['ordertype']=='both')
			{
				   if(isset($_SESSION['save3dInfo_shirt']) && !empty($_SESSION['save3dInfo_shirt']))
				{
						 $data  = $_SESSION['save3dInfo_shirt']['data'];
						$timeimage = time();
						$details   = $_SESSION['save3dInfo_shirt']['details'];
						$price     = $_SESSION['save3dInfo_shirt']['price'];
						$productid = $_SESSION['save3dInfo_shirt']['productid'];
						$pname     = $_SESSION['save3dInfo_shirt']['pname'];
						$subcatid  = $_SESSION['save3dInfo_shirt']['subcatid'];
				}


				if(isset($_SESSION['save3dInfo_pant']) && !empty($_SESSION['save3dInfo_pant']))
				{
						$data_p      = $_SESSION['save3dInfo_pant']['data'];
						$timeimage_p = time();
						$details_p   = $_SESSION['save3dInfo_pant']['details'];
						$price_p     = $_SESSION['save3dInfo_pant']['price'];
						$productid_p = $_SESSION['save3dInfo_pant']['productid'];
						$pname_p     = $_SESSION['save3dInfo_pant']['pname'];
						$subcatid_p  = $_SESSION['save3dInfo_pant']['subcatid'];

				}


			$data11['details']  = $details;
			$data11['price']    = $price;
			$data11['productid'] = $productid;
			$data11['pname']    = $pname;
			$data11['userid']    =  $_SESSION['user_id'];
			$data11['baseimage'] = $timeimage.".png";

			$data12['details']  = $details_p;
			$data12['price']    = $price_p;
			$data12['productid'] = $productid_p;
			$data12['pname']    = $pname_p;
			$data12['userid']    =  $_SESSION['user_id'];
			$data12['baseimage'] = $timeimage_p.".png";

			$value = $this->Cart_model->addto3dinsert($data11);
			$value_p = $this->Cart_model->addto3dinsert($data12);

			$file =$this->config->item('base_url_temp')."site/upload/saveprofile/".$timeimage.".png";
			$uri =  substr($data,strpos($data,",")+1);
			file_put_contents($file, base64_decode($uri));

			////////

			$file1 = $this->config->item('base_url_temp')."site/upload/saveprofile/".$timeimage_p.".png";
			$uri_p =  substr($data_p,strpos($data_p,",")+1);
			file_put_contents($file1, base64_decode($uri_p));


				if(isset($_SESSION['save3dInfo_pant']) && !empty($_SESSION['save3dInfo_pant']) && isset($_SESSION['save3dInfo_shirt']) && !empty($_SESSION['save3dInfo_shirt']))
			{
				$_SESSION['save3dInfo_shirt']='';
				$_SESSION['save3dInfo_pant']='';
				$_SESSION['profile-flash']='Profile Saved Successfully';
			    redirect($this->config->item('http_host').'cart/viewcart','location');
			}



			}
			else if($_SESSION['ordertype']=='shirt')
			{

				   if(isset($_SESSION['save3dInfo_shirt']) && !empty($_SESSION['save3dInfo_shirt']))
				{
						$data  = $_SESSION['save3dInfo_shirt']['data'];
						$timeimage = time();
						$details   = $_SESSION['save3dInfo_shirt']['details'];
						$price     = $_SESSION['save3dInfo_shirt']['price'];
						$productid = $_SESSION['save3dInfo_shirt']['productid'];
						$pname     = $_SESSION['save3dInfo_shirt']['pname'];
						$subcatid  = $_SESSION['save3dInfo_shirt']['subcatid'];
				}


			$data11['details']  = $details;
			$data11['price']    = $price;
			$data11['productid'] = $productid;
			$data11['pname']    = $pname;
			$data11['userid']    =  $_SESSION['user_id'];
			$data11['baseimage'] = $timeimage.".png";


			$value = $this->Cart_model->addto3dinsert($data11);

			$file = $this->config->item('base_url_temp')."site/upload/saveprofile/".$timeimage.".png";
			$uri =  substr($data,strpos($data,",")+1);
			file_put_contents($file, base64_decode($uri));


			if( isset($_SESSION['save3dInfo_shirt']) && !empty($_SESSION['save3dInfo_shirt']))
			{
				$_SESSION['save3dInfo_shirt']='';
				$_SESSION['profile-flash']='Profile Saved Successfully';
			    redirect($this->config->item('http_host').'cart/viewcart','location');
			}




			}
			else if($_SESSION['ordertype']=='pant')
			{

				if(isset($_SESSION['save3dInfo_pant']) && !empty($_SESSION['save3dInfo_pant']))
				{
						$data_p      = $_SESSION['save3dInfo_pant']['data'];
						$timeimage_p = time();
						$details_p   = $_SESSION['save3dInfo_pant']['details'];
						$price_p     = $_SESSION['save3dInfo_pant']['price'];
						$productid_p = $_SESSION['save3dInfo_pant']['productid'];
						$pname_p     = $_SESSION['save3dInfo_pant']['pname'];
						$subcatid_p  = $_SESSION['save3dInfo_pant']['subcatid'];

				}



			$data12['details']  = $details_p;
			$data12['price']    = $price_p;
			$data12['productid'] = $productid_p;
			$data12['pname']    = $pname_p;
			$data12['userid']    =  $_SESSION['user_id'];
			$data12['baseimage'] = $timeimage_p.".png";


			$value_p = $this->Cart_model->addto3dinsert($data12);


			$file1 =$this->config->item('base_url_temp')."site/upload/saveprofile/".$timeimage_p.".png";
			$uri_p =  substr($data_p,strpos($data_p,",")+1);
			file_put_contents($file1, base64_decode($uri_p));


			if(isset($_SESSION['save3dInfo_pant']) && !empty($_SESSION['save3dInfo_pant']) )
			{

				$_SESSION['save3dInfo_pant']='';
				$_SESSION['profile-flash']='Profile Saved Successfully';
			    redirect($this->config->item('http_host').'cart/viewcart','location');
			}


			}

		}


	}

	function updateproduct()
 	{
 		$this->cart->update($_POST);

 		redirect($this->config->item('http_host').'cart/viewcart');
  	}


	function removeproduct($remove, $pid)
 	{
	 	//echo $remove;



		$remove = explode(',',$remove);
		for($i=0;$i < count($remove);$i++)
		{
			$data = array('rowid'=>$remove[$i],'qty' => 0);
			$this->cart->update($data);
			$this->Cart_model->removeproductcart($pid);
 		}
		redirect($this->config->item('http_host').'cart/lum_view_cart');
 	}

	function removeproductcarts($remove, $pid)
 	{
	 	//echo $remove;



		$remove = explode(',',$remove);
		for($i=0;$i < count($remove);$i++)
		{
			$data = array('rowid'=>$remove[$i],'qty' => 0);
			$this->cart->update($data);
			$this->Cart_model->removeproductcart($pid);
 		}
		redirect($this->config->item('http_host').'home/lum_check_out');
 	}


	function couponcheck(){

			$coupan = $this->input->post("coupon");
			//echo $coupan;
			$select_coupan = $this->Cart_model->selectcoupan($coupan);
			$coupanname = $select_coupan->coupanname;
			$no_of_coupan = $select_coupan->no_of_coupan;//done
			$coupan_per_user = $select_coupan->coupan_per_user;//done
			$mini_amountt = $select_coupan->mini_amount;		//done
			$usedcoupanvalue = $this->Cart_model->coupen_check($coupanname);//no of rows
			$noofcoupon =  $no_of_coupan - $usedcoupanvalue;// no of coupon
			$noofusedperuser = $this->Cart_model->user_coupen_check($coupanname);//no of rows
			$noofcoupancheck = $coupan_per_user - $noofusedperuser;//per user
			//$newtotal = $mini_amountt - $this->session->userdata('total_amount');
			//if($select_coupan != '' && $noofcoupon>0 && $noofcoupancheck>0 && $newtotal>0) {

			if($select_coupan != '' && $no_of_coupan  == 0){
				$couponprice = $select_coupan->discount;
				$coupanvalue = $select_coupan->coupanvalue;
				$coupanname = $select_coupan->coupanname;
				//echo   $couponprice.$coupanname;die();
				$this->session->set_userdata('couponprice',$couponprice);
				$this->session->set_userdata('couponcode',$coupanvalue);
				$this->session->set_userdata('coupanname',$coupanname);
			} else if($select_coupan != '' && $noofcoupon > 0 && $noofcoupancheck>0) {
				$couponprice = $select_coupan->discount;
				$coupanvalue = $select_coupan->coupanvalue;
				$coupanname = $select_coupan->coupanname;
				//echo   $couponprice.$coupanname;die();
				$this->session->set_userdata('couponprice',$couponprice);
				$this->session->set_userdata('couponcode',$coupanvalue);
				$this->session->set_userdata('coupanname',$coupanname);
			} else {
				echo "0";
			}

		}

		function removecheck(){
			 $this->session->unset_userdata('couponprice');
			 $this->session->unset_userdata('couponcode');
			 echo "0";
		}

		function giftwrap(){
			 $giftval = $this->input->post("giftval");
			 if($giftval == '1'){
				 $this->session->set_userdata('giftwrap','1');
			 } else {
				$this->session->unset_userdata('giftwrap');
			 }
		}


	//For saving 3d selection


		function selectionSaveData()
		{
			//ini_set('display_errors',1);
			//error_reporting(E_ERROR);

				if($_POST['ordertype']=="shirt")
				{
					$_SESSION['save3dInfo_shirt']['data']      = $_POST['imagedata_shirt'];
					$timeimage = time();
					$_SESSION['save3dInfo_shirt']['details']   = $_POST['details'];
					$_SESSION['save3dInfo_shirt']['price']     = $_POST['price_shirt'];
					$_SESSION['save3dInfo_shirt']['productid'] =  $_POST['productid_shirt'];
					$_SESSION['save3dInfo_shirt']['pname']     = $_POST['pname_shirt'];
					$_SESSION['save3dInfo_shirt']['subcatid']  = $_POST['subcatid_shirt'];
					$_SESSION['ordertype']='shirt';

				}
				else if($_POST['ordertype']=="pant")
				{
					$_SESSION['save3dInfo_pant']['data']      = $_POST['imagedata_pant'];
					$_SESSION['save3dInfo_pant']['details']   = $_POST['details'];
					$_SESSION['save3dInfo_pant']['price']     = $_POST['price_pant'];
					$_SESSION['save3dInfo_pant']['productid'] =  $_POST['productid_pant'];
					$_SESSION['save3dInfo_pant']['pname']     = $_POST['pname_pant'];
					$_SESSION['save3dInfo_pant']['subcatid']  = 11;
					unset($_SESSION['save3dInfo_shirt']);
					$_SESSION['save3dInfo_shirt']['subcatid']  = 11;
					$_SESSION['subcatid']  = 11;
					$_SESSION['ordertype']='pant';


				}
				else if($_POST['ordertype']=="both")
				{
				   $_SESSION['save3dInfo_shirt']['data']      = $_POST['imagedata_shirt'];
					$_SESSION['save3dInfo_shirt']['details']   = $_POST['details'];
					$_SESSION['save3dInfo_shirt']['price']     = $_POST['price_shirt'];
					$_SESSION['save3dInfo_shirt']['productid'] =  $_POST['productid_shirt'];
					$_SESSION['save3dInfo_shirt']['pname']     = $_POST['pname_shirt'];
					$_SESSION['save3dInfo_shirt']['subcatid']  = $_POST['subcatid_shirt'];
		            $_SESSION['save3dInfo_pant']['data']      = $_POST['imagedata_pant'];
					$_SESSION['save3dInfo_pant']['details']   = $_POST['details'];
					$_SESSION['save3dInfo_pant']['price']     = $_POST['price_pant'];
					$_SESSION['save3dInfo_pant']['productid'] =  $_POST['productid_pant'];
					$_SESSION['save3dInfo_pant']['pname']     = $_POST['pname_pant'];
					$_SESSION['save3dInfo_pant']['subcatid']  = $_POST['subcatid_pant'];
					$_SESSION['ordertype']='both';

				}

		return true;
		}

/****** If user is not logged in and doing cutomization hold the customized data in session
****function to hold session data till 
**  savedataforsuit()
****/
function savedataforsuit(){

	 if($_POST['ordertype']=="suit")
		{
			$_SESSION['selected3dInfo_suit']['data']      = $_POST['imagedata_suit'];
			$timeimage = time();
			$_SESSION['selected3dInfo_suit']['details']   = $_POST['details'];
			$_SESSION['selected3dInfo_suit']['price']     = $_POST['price_suit'];
			$_SESSION['selected3dInfo_suit']['productid'] =  $_POST['productid_suit'];
			$_SESSION['selected3dInfo_suit']['pname']     = $_POST['pname_suit'];
			$_SESSION['selected3dInfo_suit']['subcatid']  = $_POST['subcatid_suit'];
			$_SESSION['order']=$_POST['order'];
			$_SESSION['ordertype']='suit';

			echo "success";


		}
}

/*************** savedataforBlazer
*******  if user is not logged in and  giving order just keep his/her data in session..
******** by VAR
********************/
function savedataforBlazer(){

	if($_POST['ordertype']=="blazer")
		{
			$_SESSION['selected3dInfo_blazer']['data']      = $_POST['imagedata_blazer'];
			$timeimage = time();
			$_SESSION['selected3dInfo_blazer']['details']   = $_POST['details'];
			$_SESSION['selected3dInfo_blazer']['price']     = $_POST['price_blazer'];
			$_SESSION['selected3dInfo_blazer']['productid'] =  $_POST['productid_blazer'];
			$_SESSION['selected3dInfo_blazer']['pname']     = $_POST['pname_blazer'];
			$_SESSION['selected3dInfo_blazer']['subcatid']  = $_POST['subcatid_blazer'];
			$_SESSION['order']=$_POST['order'];
			$_SESSION['ordertype']='blazer';
			echo "success";

		}	
}

/*************** savedataforvest
*******  if user is not logged in and  giving order just keep his/her data in session..
******** by VAR
********************/
function savedataforvest(){

	if($_POST['ordertype']=="vest")
		{
			$_SESSION['selected3dInfo_vest']['data']      = $_POST['imagedata_vest'];
			$timeimage = time();
			$_SESSION['selected3dInfo_vest']['details']   = $_POST['details'];
			$_SESSION['selected3dInfo_vest']['price']     = $_POST['price_vest'];
			$_SESSION['selected3dInfo_vest']['productid'] =  $_POST['productid_vest'];
			$_SESSION['selected3dInfo_vest']['pname']     = $_POST['pname_vest'];
			$_SESSION['selected3dInfo_vest']['subcatid']  = $_POST['subcatid_vest'];
			$_SESSION['order']=$_POST['order'];
			$_SESSION['ordertype']='vest';
			echo "success";

		}	
}







	//For combined version MIN 
	function saveSelectionDatacombined()
	{

		if($_POST['ordertype']=="trailshirt")
		{
			$_SESSION['selected3dInfo_shirttrail']['data']      = $_POST['imagedata'];
			$timeimage = time();
			$_SESSION['selected3dInfo_shirttrail']['details']   = $_POST['details'];
			$_SESSION['selected3dInfo_shirttrail']['price']     = $_POST['price'];
			$_SESSION['selected3dInfo_shirttrail']['productid'] =  $_POST['productid'];
			$_SESSION['selected3dInfo_shirttrail']['pname']     = $_POST['pname'];
			$_SESSION['selected3dInfo_shirttrail']['subcatid']  = $_POST['subcatid'];
			$_SESSION['ordertype']='trailshirt';
			echo "success";

		}



		else if($_POST['ordertype']=="shirt")
		{

			$_SESSION['selected3dInfo_shirt']['data']      = $_POST['imagedata_shirt'];
			$timeimage = time();
			$_SESSION['selected3dInfo_shirt']['details']   = $_POST['details'];
			$_SESSION['selected3dInfo_shirt']['price']     = $_POST['price_shirt'];
			$_SESSION['selected3dInfo_shirt']['productid'] =  $_POST['productid_shirt'];
			$_SESSION['selected3dInfo_shirt']['pname']     = $_POST['pname_shirt'];
			$_SESSION['selected3dInfo_shirt']['subcatid']  = $_POST['subcatid_shirt'];
			$_SESSION['order']=$_POST['order'];
			$_SESSION['ordertype']='shirt';
			echo "success";


		}
		else if($_POST['ordertype']=="pant")
		{
	    	$selectedInfo_pant['data']      = $_POST['imagedata_pant'];
			$timeimage = time();
			$selectedInfo_pant['details']   = $_POST['details'];
			$selectedInfo_pant['price']     = $_POST['price_pant'];
			$selectedInfo_pant['productid'] =  $_POST['productid_pant'];
			$selectedInfo_pant['pname']     = $_POST['pname_pant'];
			$selectedInfo_pant['subcatid']  = $_POST['subcatid_pant'];
			$_SESSION['selected3dInfo_pant']= $selectedInfo_pant;
			$_SESSION['order']=$_POST['order'];
			$_SESSION['ordertype']='pant';



		}
		else if($_POST['ordertype']=="both")
		{
		    $selectedInfo_shirt['data']      = $_POST['imagedata_shirt'];
			$timeimage = time();
			$selectedInfo_shirt['details']   = $_POST['details'];
			$selectedInfo_shirt['price']     = $_POST['price_shirt'];
			$selectedInfo_shirt['productid'] =  $_POST['productid_shirt'];
			$selectedInfo_shirt['pname']     = $_POST['pname_shirt'];
			$selectedInfo_shirt['subcatid']  = $_POST['subcatid_shirt'];
			$_SESSION['selected3dInfo_shirt']= $selectedInfo_shirt;

           	$selectedInfo_pant['data']      = $_POST['imagedata_pant'];
			$timeimage = time();
			$selectedInfo_pant['details']   = $_POST['details'];
			$selectedInfo_pant['price']     = $_POST['price_pant'];
			$selectedInfo_pant['productid'] =  $_POST['productid_pant'];
			$selectedInfo_pant['pname']     = $_POST['pname_pant'];
			$selectedInfo_pant['subcatid']  = $_POST['subcatid_pant'];
			$_SESSION['selected3dInfo_pant']= $selectedInfo_pant;
			$_SESSION['ordertype']='both';

		}


	
	}




	 function voucherchecknew()
	 {

				 $val_sub = $this->input->post("val_sub");
		         //print_r($val_sub);
				 $voucher = $this->input->post("voucher");
				 //echo $coupan.'hhu';
				//echo $voucher;$val_sub;die;
				//$checkvoucher_order = $this->Cart_model->checkvoucher_order($voucher);
				$select_voucher = $this->Cart_model->selectVoucher($voucher);
				//echo "<pre>";
				//print_r($select_voucher);
				//die;
				$value = $select_voucher->value;
				$vname = $select_voucher->code;
				$usedvoucher = $this->Cart_model->user_voucher_check($vname,$value);//check giftvoucher code,price rows in oreder table
				//print_r($usedvoucher);
				if($select_voucher != '')
				{
							//echo 'hi';die;
							if($usedvoucher != '' && !empty($usedvoucher)) {//free/paid giftvoucher Second time uses
								if($usedvoucher->vouchervalue == "paid"){//paid
									//$voucherdisc_first = $usedvoucher->voucherdisc;
									if(($select_voucher->price) > ($usedvoucher->voucherdisc)){
										$voucherprice = ($select_voucher->price)-($usedvoucher->voucherdisc);
										$vouchercode = $usedvoucher->vouchercode;
										$vouchervalue = $usedvoucher->vouchervalue;

										$this->session->set_userdata('voucherprice',$voucherprice);
										$this->session->set_userdata('vouchercode',$vouchercode);
										$this->session->set_userdata('vouchervalue',$vouchervalue);
									}else{ // paid voucher no balance
										echo "1";
									}
								}
								if($usedvoucher->vouchervalue == "free"){//free
									echo "1";
								}
							}else{//free/paid giftvoucher first time uses
								$voucherprice = $select_voucher->price;
								$vouchercode = $select_voucher->code;
								$vouchervalue = $select_voucher->value;

								$this->session->set_userdata('voucherprice',$voucherprice);
								$this->session->set_userdata('vouchercode',$vouchercode);
								$this->session->set_userdata('vouchervalue',$vouchervalue);
							}
				} 
				else{
						$val_sub = $this->input->post("val_sub");
						$coupan = $this->input->post("voucher");
						//print_r($coupan);
						$select_coupan = $this->Cart_model->selectCoupan($coupan,$val_sub);
						//echo "<pre>";
						//print_r($select_coupan);
						//die;
						$coupanname = $select_coupan->coupanname;
						$no_of_coupan = $select_coupan->no_of_coupan;//done
						$coupan_per_user = $select_coupan->coupan_per_user;//done
						$mini_amountt = $select_coupan->mini_amount;		//done
						$totals = $this->session->userdata('total_amount');
						if($totals>=$mini_amountt)
						{
								//echo 'fasdfsdfs';die;
								$usedcoupanvalue = $this->Cart_model->coupen_check($coupanname);//no of rows
								$noofcoupon =  $no_of_coupan - $usedcoupanvalue;// no of coupon
								$noofusedperuser = $this->Cart_model->user_coupen_check($coupanname);//no of rows
								$noofcoupancheck = $coupan_per_user - $noofusedperuser;
								//per user
								//$newtotal = $mini_amountt - $this->session->userdata('total_amount');
								//if($select_coupan != '' && $noofcoupon>0 && $noofcoupancheck>0 && $newtotal>0) {
								if($select_coupan != '' && $no_of_coupan  == 0)
								{
									$couponprice = $select_coupan->discount;
									$coupanvalue = $select_coupan->coupanvalue;
									$coupanname = $select_coupan->coupanname;
									//echo   $couponprice.$coupanname;die();
									$this->session->set_userdata('couponprice',$couponprice);
									$this->session->set_userdata('couponcode',$coupanvalue);
									$this->session->set_userdata('coupanname',$coupanname);
								}else if($select_coupan != '' && $noofcoupon > 0 && $noofcoupancheck>0)
								{
									$couponprice = $select_coupan->discount;
									$coupanvalue = $select_coupan->coupanvalue;
									$coupanname = $select_coupan->coupanname;
									//echo   $couponprice.$coupanname;die();
									$this->session->set_userdata('couponprice',$couponprice);
									$this->session->set_userdata('couponcode',$coupanvalue);
									$this->session->set_userdata('coupanname',$coupanname);
								}else{
									echo "0";
								}				
						}
						else
						{
									echo "2";
						}


					}

		}

		function removecheckvoucher(){
			 $this->session->unset_userdata('voucherprice');
			 $this->session->unset_userdata('vouchercode');
			 $this->session->unset_userdata('vouchervalue');
			 echo "0";
		}
	
		function mywallet()
		{
						$walletamount = $this->Cart_model->getwalletamount();
						$this->session->set_userdata('mywalletdata',$walletamount);
		}
	
		function removewallet()
		{
			 $this->session->unset_userdata('mywalletdata');

			 echo "0";
		}
	
		function show_fit()
		{
			$bid = $_POST['bid'];
			$data = $this->Cart_model->show_fit($bid);
			//print_r($data);exit;
			$html = "<select id='fitid'  class='validate[required] select-box' data-prompt-position='topRight:5' name='fitid' onchange='get_size(this.value)'>";
			$html .= "<option value=''>Select Fit</option>";
			if($data != ''){
			for($i=0;$i<count($data);$i++)
			{
				$html .= "<option value='".$data[$i]->id ."'>".$data[$i]->fitname ."</option>";
			}
			}
			$html .="</select>";
			echo $html;
		}

		function show_size()
		{
			$fitid = $_POST['fitid'];
			$data = $this->Cart_model->show_size($fitid);
			//print_r($data);exit;
			$html = "<select id='sizeid' class='validate[required] select-box' data-prompt-position='topRight:5' name='sizeid' >";
			$html .= "<option value=''>Select Size</option>";
			if($data != ''){
			for($i=0;$i<count($data);$i++)
			{
				$html .= "<option value='".$data[$i]->id."'>".$data[$i]->size."</option>";
			}
			}
			$html .="</select>";
			echo $html;
		}

		function mapping1($style_id)
		{
		//echo $this->input->post('measureid');die;
		//echo $style_id;die;
		$data = array();
		$data['L_strErrorMessage'] = "";
		$data['err_msg'] = "";
		if($this->input->post('measureid') !="") {
			//echo "hello";die;
			$this->session->set_userdata('measuredid',$this->input->post('measureid'));
		}

		$data['style_id']= $style_id;
		//$this->load->view('details.php',$data);
		redirect($this->config->item('http_host').'cart/mapping/'.$style_id,'refresh',$data);
	}

	// added by shaaz

	function addwishlist(){
		$data['userid'] = $this->session->userdata('user_id');
		$data['pid'] = $_POST['productid_shirt'];
		$data['added_date'] =date("Y/m/d");
		try{
			$check = $this->account_model->add_wishlist($data);
		}
		catch(Exception $ex){
			echo "Error:".$ex;
		}

		if($check=="added")
		{
			echo "success";
		}
		else if($check=="dup"){
			echo "duplicate";
		}

	}


	/*added function to remove item from wishlist*/

	function remove_wishlist(){

		$data['userid'] = $this->session->userdata('user_id');
		$data['pid'] = $_GET['pid'];
		//$data['added_date'] =date("Y/m/d");

	    try{

			 $check = $this->account_model->remove_wishlist($data);
			 $data['message']="Removed item from wishlist";
			 if($check){
				 redirect($this->config->item('http_host').'/home/lum_my_account','refresh',$data);
			 }

		}
		catch(Exception $ex){
			echo "Error:".$ex;
		}
		// if($check=="added")
		// {
		// 	echo "success";
		// }
		// else if($check=="dup"){
		// 	echo "duplicate";
		// }

	}

	/*end of remove*/

	/*** var : date : 17 Nov 2016
	** param: 0
	** Handle from details_suit to get added value for vest
	***/
	function get_vest_price(){
	   	   	$itemcode=$_POST['itemcode'];
			$subcatid=17;
			$data_suit=$this->home_model->getProductsByItemcode($itemcode,$subcatid);
			$subcatid=18;
			$data_vest=$this->home_model->getProductsByItemcode($itemcode,$subcatid);
			$session_currency=$this->session->userdata('currencycode');
			$valueofsuite=$data_suit[0]->$session_currency;
			$valueofvest=$data_vest[0]->$session_currency;
	        if(isset($valueofsuite))
		     {
		        if($session_currency == 'INR')
		         {
		                $code_currency="INR";
		         }else{
		            	$code_currency=$session_currency;
		         }

		         if($session_currency == 'INR')
		         {
		        	$valueofsuit_new=$data_suit[0]->price;
				      $valueofvest_new=$data_vest[0]->price;
		         }
             else if($session_currency == 'USD')
            {
             $valueofsuit_new=$data_suit[0]->USD;
             $valueofvest_new=$data_vest[0]->USD;
            }
            else if($session_currency == 'BHD')
            {
             $valueofsuit_new=$data_suit[0]->BHD;
             $valueofvest_new=$data_vest[0]->BHD;
            }
            else if($session_currency == 'AED')
            {
             $valueofsuit_new=$data_suit[0]->AED;
             $valueofvest_new=$data_vest[0]->AED;
            }
            else if($session_currency == 'SAR')
            {
             $valueofsuit_new=$data_suit[0]->SAR;
             $valueofvest_new=$data_vest[0]->SAR;
            }
            else if($session_currency == 'QAR')
           {
            $valueofsuit_new=$data_suit[0]->QAR;
            $valueofvest_new=$data_vest[0]->QAR;
           }
           else if($session_currency == 'EUR')
           {
            $valueofsuit_new=$data_suit[0]->EUR;
            $valueofvest_new=$data_vest[0]->EUR;
           }
           else if($session_currency == 'AUD')
           {
            $valueofsuit_new=$data_suit[0]->AUD;
            $valueofvest_new=$data_vest[0]->AUD;
           }

		         else
	    	     {

	       	        $valueofsuit_new=$data_suit[0]->price;
				 	$valueofvest_new=$data_vest[0]->price;
			        $valueofsuit_new = ceil(( $valueofsuit_new / ( $this->session->userdata('currencyvalue') * ($this->session->userdata('multiplier')/100)))/$this->session->userdata('ceiling'))*$this->session->userdata('ceiling');
	    	        $valueofvest_new = ceil(( $valueofvest_new / ( $this->session->userdata('currencyvalue') * ($this->session->userdata('multiplier')/100)))/$this->session->userdata('ceiling'))*$this->session->userdata('ceiling');

	         	}
	         }

	         if($_POST['val_vest']=="yes"){
				$off_vest=80;
				$offvalue = ($off_vest / 100) * $valueofvest_new;
				$total = $valueofsuit_new + $offvalue;

				if(isset($valueofsuit_new)){
				     	 $this->session->set_userdata('total_price_suit',$total);
						 $this->session->set_userdata('suit_cal',"_YESTER");
						 echo $session_currency." ".$total;
				}else{
						$this->session->set_userdata('total_price_suit',$valueofvest_new);
						$this->session->set_userdata('suit_cal',"_YESTER");
						echo $session_currency." ".$valueofvest_new;
				}

			}
			else if($_POST['val_vest']=="no"){
				 $this->session->set_userdata('total_price_suit',$valueofvest_new);
				 $this->session->set_userdata('suit_cal',"_YESTER");
				 echo $session_currency." ".$valueofsuit_new;
			}


     }


}

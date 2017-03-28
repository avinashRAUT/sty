<?php
class Cart_model extends CI_Model
{

	function productdetails($id)
	{
 		$sql = "SELECT p.*, im.image from pro_style p
				left join  tbl_style_image im ON (im.style_id = p.id AND im.baseimage = '1')
				WHERE p.id = '".$id."'";

		$query = $this->db->query($sql);
		if ($query->num_rows() > 0)
		{
			$result = $query->row();
			return $result;
		}
	}

	function insertcartindb($content)
	{
 		$data['pname']  = $content['name'];
		$data['price']  = $content['price'];
		$data['qty']    = $content['qty'];
		$data['pid']    = $content['id'];
		$data['options']  = json_encode($content['options']);
		$data['userid']   = $this->session->userdata('user_id');
		$data['added_date']  = date('Y-m-d');

		$this->_data = $data;

		if ($this->db->insert('mycart', $this->_data))	{
			return $this->db->insert_id();
		} else {
			return false;
		}

	}
	function getSizeval($fit,$size)
	{
		$sql = "SELECT id  FROM `size` WHERE `subcatid` = 9 and fit='".$fit."' and size LIKE '%($size%'";

 		$query = $this->db->query($sql);


		if ($query->num_rows() > 0)
		{
			return $query->row()->id;
		}
	}


	function getImagename($fit)
	{
		$sql = "SELECT image  FROM tbl_product_image WHERE `pid` = '".$fit."' and  baseimage=1";

 		$query = $this->db->query($sql);

		if ($query->num_rows() > 0)
		{
			return $query->row()->image;
		}
	}


	function productstyledetails($cstyleid)
	{
		$sql = "SELECT id FROM `pro_style` where pid='$cstyleid'";

 		$query = $this->db->query($sql);


		if ($query->num_rows() > 0)
		{
			return $query->row()->id;
		}
	}



			//get last insert save3d item
		function getlastinsertitem($lastid)
		{

		$this->db->select('*');
		$this->db->from('save3d');
		$this->db->where('id',$lastid);
		$this->db->where('userid', $this->session->userdata('user_id'));
		$q = $this->db->get();
   	return $q->result();

	}


	//get last insert mycart item
		function getlastinsertitemmycart($mycartid)
		{

	  	$this->db->select('*');
	$this->db->from('mycart');
	$this->db->where('id',$mycartid);
	$this->db->where('userid', $this->session->userdata('user_id'));
  	$q = $this->db->get();

	return $q->result();

	}



	     //updated details array from 3d in save3d

		 	function updatedetails($lastidd,$updateddetailss)
			{

			$data['details']  = $updateddetailss;
			$this->_data = $data;
			$this->db->where('userid', $this->session->userdata('user_id'));
			$this->db->where('id', $lastidd);
			if ($this->db->update('save3d', $this->_data))
			{
			return true;
			} else {
			return false;
			}
	}


	     //updated details array from 3d in mycart mari

	function updatedetailsmycart($mycartidd,$updateddetailsmycart)
	{

		$data['options']  = $updateddetailsmycart;
		$this->_data = $data;
		$this->db->where('userid', $this->session->userdata('user_id'));
		$this->db->where('id', $mycartidd);
		if ($this->db->update('mycart', $this->_data))
		{
			return true;
		} else {
			return false;
		}
	}









	function insertbodymeasure($content)
	{
		//echo $content['weight'];die;
		//print_r($content);die;
		//echo $this->session->userdata('measuredid');die;

		if($this->session->userdata('measuredid') !="" && $this->session->userdata('measuredid') != "0"){

			$mid = $this->session->userdata('measuredid');
			$userid=$this->session->userdata('user_id');
			 $data['metricft']  = $content['foot'];
			$data['metricinch']  = $content['inch'];
			$data['metricweight']  = $content['weight'];
			//echo $data['metricweight'];die;
			//$data['impheight']  = $content['impheight'];
			$data['impweight']  = $content['impweight'];
			$data['style_id']  = $content['style_id'];
			$data['pid']  = $content['pid'];
			$data['userid']  = $userid;
			$this->_data = $data;
			$this->db->where('id', $mid);
			if ($this->db->update('measurement', $this->_data))	{
			return true;
		} else {
			return false;
		}

		} else {

		$userid=$this->session->userdata('user_id');
 		$data['metricft']  = $content['foot'];
		$data['metricinch']  = $content['inch'];
		$data['metricweight']  = $content['weight'];
		//$data['impheight']  = $content['impheight'];
		//$data['impweight']  = $content['impweight'];
		$data['style_id']  = ($content['style_id'])?$content['style_id']:0;
		$data['pid']  = ($content['pid'])?$content['pid']:0;
		$data['userid']  = $userid;

		$this->_data = $data;
		if ($this->db->insert('measurement', $this->_data))	{
			return true;
		} else {
			return false;
		}

		}

	}
	function updatecartmesure($cartId,$mid)
	{


		$sql = "SELECT p.*  FROM  mycart p WHERE p.id = '".$cartId."'";

 		$query = $this->db->query($sql);
		$newcartarr=array();

		if ($query->num_rows() > 0)
		{

			$newcartarr['options'] = json_decode($query->row()->options,true);
			$newcartarr['options']['newmid']=$mid;
			$newcartarr['options']=json_encode($newcartarr['options']);


			$this->db->where('id', $query->row()->id);

			if ($this->db->update('mycart', $newcartarr))	{
				return true;
			} else {
				return false;
			}

		}


	}

	function updatefit($content) {
		$mid = $this->session->userdata('measuredid');
		//echo $this->session->userdata('measuredid');
		$fit=$content['fit'];
		//echo $fit; die;
		$data['fit']  = $fit;
		//print_r($data);die;
		$this->_data = $data;
		$this->db->where('userid', $this->session->userdata('user_id'));
		$this->db->where('id', $mid);
		if ($this->db->update('measurement', $this->_data))	{
			return true;
		} else {
			return false;
		}
	}

	function updatebodymeasure1($content, $profilename,$type,$sizeId='',$foot,$inch,$weight) {
		//echo $this->session->userdata('measuredid');die;


		$data['serializedata']  = $content;
		$data['userprofilename']  = $profilename;
		$data['type']  = $type;
		$data['sizeid'] =$sizeId;


		$data['metricft']  = $foot;
		$data['metricinch']  = $inch;
		$data['metricweight'] =$weight;

		$this->_data = $data;
		//$this->db->where('userid', $this->session->userdata('userid'));
		$this->db->where('id', $this->session->userdata('measuredid'));

		if ($this->db->update('measurement', $this->_data))	{

		$str = $this->db->last_query();
			return true;
		} else {
			return false;
		}
	}


	function updatebodymeasure_brand($content, $profilename,$type,$foot,$inch,$weight) {
		//echo $this->session->userdata('measuredid');die;
		$data['brandid']  = $content['brandid'];
		$data['fitid']  = $content['fitid'];
		$data['sizeid']  = $content['sizeid'];
		$data['comments']  = $content['comments'];
		$data['userprofilename']  = $profilename;

		$data['metricft']  = $foot;
		$data['metricinch']  = $inch;
		$data['metricweight']  = $weight;

		$data['type']  = $type;
		//echo $this->session->userdata('measuredid');
		//print_r($data);
		//die;


		$this->_data = $data;

		//$this->db->where('userid', $this->session->userdata('userid'));
		$this->db->where('id', $this->session->userdata('measuredid'));

		if ($this->db->update('measurement', $this->_data))	{
			//echo $this->db->last_query();die;
			return true;
		} else {
			return false;
		}

	}
	function newupdatebodymeasure1($content,$profilename,$foot,$inch,$weight)
	{
		//echo $this->session->userdata('measuredid');die;
		$data['serializedata']  = $content;
		$data['userprofilename']  = $profilename;
		$data['metricft']  = $foot;
		$data['metricinch']  = $inch;
		$data['metricweight']  = $weight;
		$this->_data = $data;
		$this->db->where('userid', $this->session->userdata('user_id'));
		$this->db->where('id', $this->session->userdata('measuredid'));

		if ($this->db->update('measurement', $this->_data))	{
			return true;
		} else {
			return false;
		}
	}
	function updateshouldertype($content) {
		//print_r($content);die;
		$mid = $this->session->userdata('measuredid');
 		/*$pid  = $content['pid'];
		$style_id  = $content['style_id'];*/
		$data['shouldertype']  = $content['shouldertype'];
		$this->_data = $data;
		$this->db->where('userid', $this->session->userdata('user_id'));
		//$this->db->where('pid', $pid);
		$this->db->where('id', $mid);
		if ($this->db->update('measurement', $this->_data))	{
			return true;
		} else {
			return false;
		}
	}


	function updateshoulderangle($content) {
		$mid = $this->session->userdata('measuredid');
 		/*$pid  = $content['pid'];
		$style_id  = $content['style_id'];*/
		$data['shoulderangle']  = $content['shoulderangle'];
		$this->_data = $data;
		$this->db->where('userid', $this->session->userdata('user_id'));
		//$this->db->where('pid', $pid);
		$this->db->where('id', $mid);
		if ($this->db->update('measurement', $this->_data))	{
			return true;
		} else {
			return false;
		}
	}
	function updatebodymeasure($content) {
		//print_r($content);die;
		$mid = $this->session->userdata('measuredid');
 		//echo $mid;die;
		$pid  = $content['pid'];
		$style_id  = $content['style_id'];
		$data['posture']  = $content['measure'];
		$this->_data = $data;
		$this->db->where('userid', $this->session->userdata('user_id'));
		//$this->db->where('pid', $pid);
		$this->db->where('id', $mid);

		if ($this->db->update('measurement', $this->_data))	{
			//echo $str = $this->db->last_query();die;
			return true;
		} else {

			return false;
		}
	}

	function sizedata($id , $fit)
	{
		//code modified by MSYS009
		$sql = "SELECT p.*  FROM  size p
  				WHERE p.subcatid = '".$id."' and p.fit = '".$fit."' order by id ASC";
 		$query = $this->db->query($sql);
		if ($query->num_rows() > 0)
		{
			$result = $query->result();
			return $result;
		}
	}
	function prodparts($id){
		//$sql = "SELECT * from   part_attribute where sizeid	 ='".$id."' ";
		 $sql = "SELECT p.* , ap.order , ap.id ,ap.pname from part_attribute p
			    left join add_parts ap ON p.partid = ap.id
 				where p.sizeid = '".$id."' and ap.hide_in_size = '0' order by ap.order asc";

		$query = $this->db->query($sql);

		if ($query->num_rows() > 0)
		{
			$result = $query->result();
			return $result;
		}

	}
	/* Gift Voucher Functions */

	function selectVoucher($id){
		$sql = "SELECT p.value,p.code,gid.giftvalue as price,gid.percentage as percentage FROM  gift_voucher p ,giftid gid  WHERE code = '".$id."' and gid.id=p.giftid";

		$query = $this->db->query($sql);
		if ($query->num_rows() > 0)
		{
			$result = $query->row();
			return $result;
		}
	}
	function user_voucher_check($vouchercode,$vouchervalue){
		$sql = "SELECT * FROM  ci_orders
 		        WHERE vouchercode = '".$vouchercode."' AND vouchervalue = '".$vouchervalue."' ";

		$query = $this->db->query($sql);
		if ($query->num_rows() > 0)
		{
			$result = $query->row();
			return $result;
		}
	}
	function getSizesData($id)
	{
 		$sql = "SELECT p.*, im.image from pro_style p
				left join  tbl_style_image im ON (im.style_id = p.id AND im.baseimage = '1')
				WHERE p.id = '".$id."'";

		$query = $this->db->query($sql);
		if ($query->num_rows() > 0)
		{
			$result = $query->row();
			return $result;
		}
	}
	function getcartDetails($id)
	{

		$userid=$this->session->userdata('user_id');
 		 $sql = "SELECT * FROM mycart WHERE pid= '".$id."' and userid=".$userid." ORDER BY userid DESC LIMIT 1";

		$query = $this->db->query($sql);
		if ($query->num_rows() > 0)
		{
			$result = $query->row();
			return $result;
		}
	}
	function getprofilename($id){

		$sql = "SELECT p.*  FROM  measurement p WHERE p.id = '".$id."'";

 		$query = $this->db->query($sql);
		if ($query->num_rows() > 0)
		{
			$result = $query->row()->userprofilename;
			return $result;
		}
	}


/*get measurements by mid*/
	/*var added*/
	function getMeasurements($id){
			$sql = "SELECT p.*  FROM  measurement p WHERE p.id = '".$id."'";
	 		$query = $this->db->query($sql);
	 		$data_m=array();
			if($query->num_rows() > 0)
			{
					$result = $query->row();
					$serdata = $result->serializedata;
					$uns= unserialize($serdata);
					$posture = $result->posture;
					if($posture == '0'){
					$post_val ='Normal';
					}else if($posture == '1'){
					$post_val = 'Hunched';
					}else if($posture == '2'){
					$post_val ='Erect';
					}
                    $data_m['posture']=$post_val;

					$fit = $result->fit;
					if($fit == '0'){
					$fit_val ='Slim';
					}else if($fit == '1'){
					$fit_val = 'Tailored';
					}else if($fit == '2'){
					$fit_val ='Regular';
					}
					$data_m['fit']=$fit_val;
					$shouldertype = $result->shouldertype;
					if($shouldertype == '0'){
					$shouldertype_val ='Normal';
					}else if($shouldertype == '1'){
					$shouldertype_val = 'Sloping';
					}else if($shouldertype == '2'){
					$shouldertype_val ='Straight';
					}
					$data_m['shouldertype']=$shouldertype_val;
					if($uns != '') {
					$array1 = $uns[0];
					$array2 = $uns[1];

					for($k=0;$k<count($array1);$k++){
					$val_body = $this->User_model->bodypartname($array1[$k])." - ".$array2[$k];
					}
					} else {

					$val_body="-";
					}
					$data_m['body']=$val_body;

					if($uns != '') {
					 $array1 = $uns[0];
					 $array2 = $uns[1];

					 for($k='0';$k<count($array1);$k++) {
					 		$data_m['body_values'][]=$this->User_model->bodypartname($array1[$k])."-".$array2[$k];


					}
				  }
	              // /print_r($)

			return $data_m;
			}
	}
	/*var end*/



	/*start var*/
	/*true or false if suit purchased*/
	function checkCouponForSuit($userid){

		$sql="select t.id from ci_orders co inner join ci_order_item coi on (co.order_id=coi.order_id and co.order_status='C') inner join tbl_product t on t.id=coi.product_id and t.subcatid=17";
  		$query = $this->db->query($sql);
		// $result = $query->row();
		if ($query->num_rows() > 0)
		{

			return true;
		}
		else{
			return false;

		}

	}

	function getShirtPidFromCart($userid){
    	// $sql="select id from tbl_product where subcatid=10 and id in (select pid from mycart where userid='".$userid."')";

		$sql="SELECT m. * FROM tbl_product t INNER JOIN mycart m ON (m.pid = t.id AND m.userid ='".$userid."' AND t.subcatid =10)";
    	$query = $this->db->query($sql);
		$result = $query->result();

	    return $result;

	}


	/*end var*/




	function selectCoupan($id,$val_sub)
	{

		//echo $id.$val_sub.'hgk';die;
		if($val_sub==10)
		{
			   $sql = "SELECT * FROM tbl_coupan p
 		        WHERE coupanname = '".$id."' and subcatid<='13' and enddate >='".date('Y-m-d H:i:s')."'";
		}
		else if($val_sub==11)
		{
			   $sql = "SELECT * FROM tbl_coupan p
 		        WHERE coupanname = '".$id."' and subcatid<='13' and enddate >='".date('Y-m-d H:i:s')."'";
		}
		else
		{
			$sql = "SELECT * FROM tbl_coupan p
 		        WHERE coupanname = '".$id."' and subcatid='".$val_sub."' and enddate >='".date('Y-m-d H:i:s')."'";
		}
        //$sql = "SELECT * FROM tbl_coupan p
 		        //WHERE coupanname = '".$id."' and enddate >='".date('Y-m-d H:i:s')."'";


		$query = $this->db->query($sql);
		if ($query->num_rows() > 0)
		{
			$result = $query->row();
			return $result;
		}
	}
	function coupen_check($id)
	{
		$sql = "SELECT * FROM  ci_orders p
 		        WHERE tbl_coupan_name = '".$id."'";

		$query = $this->db->query($sql);
		if ($query->num_rows() > 0)
		{
			$result = $query->num_rows();
			return $result;
		}
	}
	function user_coupen_check($id)
	{
		$sql = "SELECT * FROM  ci_orders p
 		        WHERE tbl_coupan_name = '".$id."' AND  user_id  = '".$this->session->userdata('userid')."' ";

		$query = $this->db->query($sql);
		if ($query->num_rows() > 0)
		{
			$result = $query->num_rows();
			return $result;
		}
	}
	function getwalletamount()
	{
		$id = $this->session->userdata('user_id');
		$sql = "SELECT * FROM  users
  				WHERE id = '".$id."'";

		$query = $this->db->query($sql);
		if ($query->num_rows() > 0)
		{
			$result = $query->row()->bonus;
			return $result;
		}
	}
	function show_fit($bid)
	{
	//echo $cid;
		 $where = array(
			'brandid' => $bid,
		);
		$this->db->where($where);
		$query = $this->db->get('brand_fit');
		if($query->num_rows() > 0)
		{
			$result = $query->result();
			return $result;
		}
		else
		{
			return false;
		}
	}
	function show_size($fitid)
	{
	//echo $cid;
		 $where = array(
			'fitid' => $fitid,
		);
		$this->db->where($where);
		$query = $this->db->get('brand_size');
		if($query->num_rows() > 0)
		{
			$result = $query->result();
			return $result;
		}
		else
		{
			return false;
		}
	}

	function addto3dinsert($content)
	{

		// echo "This is testing./..";
		// print_r($content);
		
		//$userid = $this->session->userdata('userid');
 		$data['details']  = $content['details'];
		$data['price']  = $content['price'];
		$data['productid']  = "STY".$content['productid'];
		$data['pname']  = $content['pname'];
		$data['baseimage']  = $content['baseimage'];
		$data['userid'] = $this->session->userdata('userid');
		if(!isset($data['userid']))
		{
			$data['userid']   =$content['userid'];
		}
	//	echo "userid".$data['userid'];
	

		//$data['userid']  = '30';
		$data['added_date']  = date('Y-m-d');
		$this->_data = $data;
		if ($this->db->insert('save3d', $this->_data))	{
			return $this->db->insert_id();
		} else {
			return false;
		}
	}

	function insertcarttrialshirtindb($content)
	{

		$sql = "SELECT * FROM  mycart
  				WHERE pid = 'STY2015115' and userid = '".$this->session->userdata('userid')."'";

		$query = $this->db->query($sql);
		if ($query->num_rows() > 0)
		{

			return false;
		}
		else
		{
 		$data['pname']  = $content['pname'];
		$data['price']  = $content['price'];
		$data['qty']    = 1;
		$data['pid']    = $content['productid'];
		$data['options']  = $content['details'];
		$data['userid'] = $this->session->userdata('userid');
		if(!isset($data['userid']))
		{
			$data['userid']   =$content['userid'];
		}
		//$data['userid']   ='30';
		$data['added_date']  = date('Y-m-d');

		$this->_data = $data;
		if ($this->db->insert('mycart', $this->_data))
		{
			return $this->db->insert_id();
		} else {
			return false;
		}
		}
	}

	function removeproductcart($pid){
		$sql = "delete from mycart where pid = '".$pid."' and userid = '".$this->session->userdata('user_id')."' ";
		$query = $this->db->query($sql);
	}



/****** Its to check price of product  *****
**** cross check product price
***** by VAR..
****/
function getPriceByID($id)
	{
		$sql = "SELECT * from tbl_product p WHERE p.id = '".$id."'";

		$query = $this->db->query($sql);
		if ($query->num_rows() > 0)
		{
			$result = $query->row();
			return $result;
		}
	}

	function getProductsByItemcode($itemcode,$subcatid){
	$this->db->select('t1.*');
	$this->db->from('tbl_product as t1');
	$this->db->where('t1.itemcode',$itemcode);
	$this->db->where('t1.subcatid', $subcatid);
	$q = $this->db->get();
	return $q->result();
	}
	
}

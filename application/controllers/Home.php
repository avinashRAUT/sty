<?php

		defined('BASEPATH') OR exit('No direct script access allowed');
		class Home extends CI_Controller {
		
		function __Construct()
		{
		  	parent::__Construct ();
			$this->load->helper('url');
			$this->load->database();
			$this->load->library('session');
			$this->load->model('home_model');
			$this->load->model('User_model');
			$this->load->model('Cart_model');
			$this->load->model('Account_model');
			$this->load->model('Appointment_model');
			$this->load->model('Bilship_model');
		}

		public function index()
		{
			//error_reporting(1);
			//ini_set('display_errors', 1)
			$this->load->helper('url');
			$this->output->enable_profiler(FALSE);
			//var start
			//$_SESSION['sub_message']="one";
			$this->load->model('Home_model');
	        $this->load->view('lum_header');
			//$this->data['image'] = $this->home_model->home_cat();
			//$data['allbanner'] = $this->home_model->allbanner();
			$data=array();  		
	        //new arrival  shirt code
			$this->db->from('tbl_product as t1');
			$this->db->join('tbl_product_image as t2', 't2.pid = t1.id','left');
			$this->db->where('subcatid',10);
			$this->db->where('qty>',0);
			$this->db->where('is_home',1);
			$this->db->where('t2.baseimage',1);
			$this->db->limit(10);
			$q = $this->db->get();
			$data['shirt_new'] = $q->result();
			$this->load->view('lum_home',$data);
			$this->load->view('lum_footer');
		}

		public function deleteaddress()
		{
		 	$this->Bilship_model->deleteaddress($_POST['id']);
			//$this->session->set_flashdata('error','Address Deleted Succcessfully!!!!');
			/*start avr*/
			echo "Deleted By Me";
			$this->session->set_userdata("smsg","Address Deleted Succesfully");
			redirect($this->config->item('base_url_temp').'home/lum_my_account');
			/*end avr*/
		 }

		public function updateaddress()
		{
			$L_strErrorMessage='';
			$form_field = $data = array(
			'L_strErrorMessage' => '',
			'addressid'=>'',
			'Name'      => '',
			'Address1'      => '',
			'Address2'      => '',
			'City'      => '',
			'State'      => '',
			'Zip'      => '',
			'Status'      => '',
			'country'      => '',
			'Phone'      => ''
			);
			if($this->input->post('action') == 'updateaddress')
			{
			foreach($form_field as $key => $value)
			{
			$data[$key]=$this->input->post($key);
			}
		   $this->Bilship_model->updateaddress($data);
			$this->session->set_flashdata('L_strErrorMessage','Address Updated Succcessfully!!!!');

			redirect($this->config->item('base_url_temp').'home/lum_my_account');

			if ($this->validation->run() == FALSE)
			{

			$data['L_strErrorMessage'] = $this->validation->error_string;
			}
			else
			{
			//$data['allcategory'] = $this->product_model->allcategory();
			$this->load->view('lum_my_account',$data);
			}
			}
		}

		public function resetpass(){
			$this->load->model('user_model');
			if($this->input->post('reset')=="reset"){
				$id = $this->session->userdata('user_id');
			//	echo "session id".$id;
			//	print_r($_POST);
			   /*session id1166Array ( [previouspass] => 118191462987173636500 [newpassword] => [re_password] => [reset] => reset )*/
			   $data=array(
		     	'password'=>$_POST['newpassword'],
		     	'repassword'=>$_POST['re_password'],
			    	);
	       if($data['newpassword']==$data['re_password']){
					if($this->user_model->resetPassword($id,$data['password'])){
							$this->session->set_userdata("smsg","Password Changed!");
				            redirect($this->config->item('base_url_temp').'home/lum_my_account');
					}

		       }

			}

		}

	public function addaddress()
	{

		$L_strErrorMessage='';

			$form_field = $data = array
			(

				'L_strErrorMessage' => '',
				'Name'      => '',
				'Address1'      => '',
				'Address2'      => '',
				'City'      => '',
				'State'      => '',
				'Zip'      => '',
				'Status'      => '',
				'country'      => '',
				'Phone'      => ''

			);



	if($this->input->post('action') == 'addaddress')
	{
		foreach($form_field as $key => $value)
		{
			$data[$key]=$this->input->post($key);
		}
		//  echo "<pre>";
		//  print_r($data);
 		$this->Bilship_model->addaddress($data);
		$this->session->set_flashdata('L_strErrorMessage','Address Added Succcessfully!!!!');
		/*start avr*/
		$this->session->set_userdata("smsg","Address Added Succesfully");
		/*end avr*/
        redirect($this->config->item('base_url_temp').'home/lum_my_account');

		if($this->validation->run() == FALSE)
		{

			$data['L_strErrorMessage'] = $this->validation->error_string;

		}
		else
		{

			//$data['allcategory'] = $this->product_model->allcategory();
			$this->load->view('lum_my_account',$data);

		}

	}

}





public function deletemeasure()
{

		//echo $_POST['id'];
	 $this->home_model->deletemeasure($_POST['id']);
	 $this->session->set_flashdata('error','Measure Deleted Succcessfully!!!!');
}

public function sendMail()
{
		//error_reporting(1);
		//ini_set('display_errors', 1);
		$data=$dataInfo=array();
		/* foreach($selectedData as $info){
			$dataInfo[$info['name']]=$info['value'];
		}*/
	 	$appointment_time=$this->input->post("appoint_time_of_day")." at ".$this->input->post("start_time");
		$data['name'] =$_POST['firstname'];
		$data['email'] =$_POST['email'];
		$data['phonenumber'] =$_POST['phonenumber'];
		$data['address'] =$_POST['address'];
		$dataInfo['time_of_day'] = $appointment_time;
		$dataInfo['selectedDate'] = $this->input->post("date");
		$new_date_format = date('Y-m-d', strtotime($dataInfo['selectedDate']));
		$date_today = date("Y-m-d");
		$date_now= new DateTime($date_today);
		$sel_date= new DateTime($new_date_format);
		if ($sel_date < $date_now) {
			echo '<script type="text/javascript">alert("Appointment Not Booked For Selected Date:'.$sel_date.'");</script>';
			 echo "<script>document.location.href='".$this->config->item('base_url_temp')."book-a-home-visit'</script>";
		}
		else
		{
		//if($date_today )

		$dataInfo['appointment_date'] =$new_date_format;

		$response = $this->Appointment_model->getUserAppointmentTimes($dataInfo);

		$data=array();

		$data['responseData']=$response;



		//print_r($dataInfo);print_r($responseData);die;



		foreach($data['responseData'] as $resData)

		{

			$resInfo[$resData->start_time]=$resData->start_time;

		}

		//$data['start_time'] =$dataInfo['start_time'];

		//$data['start_time'] =$dataInfo['start_time'];

		//$data['start_time'] =$dataInfo['start_time'];

		$new_date_format = date('Y-m-d', strtotime($dataInfo['appointment_date']));

		$data['appointment_date'] =$new_date_format;

		$data['appointment_location'] =$_POST['address'];

		$data['start_time'] =$_POST['start_time'];

		$data['first_name'] =$_POST['firstname'];

		$data['last_name'] =' ';

		$data['email'] =$_POST['email'];

		$data['country'] =' ';

		$data['phone_number'] =$_POST['phonenumber'];

		$data['q1'] =' ';

		$data['q2'] =' ';

		$data['q3'] =$dataInfo['q3'];

		$data['status'] =1;

		//print_r($data);die;



		if($response = $this->Appointment_model->addUserAppointment($data))

		{

			 //echo 'hi';

			 $message='<html>

<style>

@media screen and (min-width:300px) and (max-width:700px)

{

#imageclass #image{margin-left:10px;}

.tableimg{width:200%};

.tableimg #imageclass{margin-left:10px;}

}

</style>

<body>

<table width="100%" cellspacing="0" cellpadding="0" style="max-width: 100%;border-left:solid 1px #e6e6e6;border-right:solid 1px #e6e6e6">

  <tbody>

    <tr>

      <td width="10" bgcolor="#28354d" style="width:10px;background:linear-gradient(to bottom,#28354d 0%,#28354d 89%);background-color:#28354d">&nbsp;</td>

      <td valign="middle" align="left" height="50" bgcolor="#28354d" style="background:linear-gradient(to bottom,#28354d 0%,#28354d 89%);background-color:#28354d;padding:0;margin:0"><a style="text-decoration:none;padding-left:42%;" href="http://www.mostlikers.com" target="_blank">

          <img border="0" height="30" src="http://minifysys.com/stylior.com/images/stylior-logof.png" alt="stylior.com" style="border:none;" class="CToWUd">

        </a></td>

      <td valign="middle" align="right" height="50" bgcolor="#28354d" style="background:linear-gradient(to bottom,#28354d 0%,#28354d 89%);background-color:#28354d;padding:0;margin:0"><a style="text-decoration:none;outline:none;color:#ffffff;font-size:12px" href="" target="_blank">

        </a></td>

      <td width="10" bgcolor="#28354d" style="width:10px;background:linear-gradient(to bottom,#28354d 0%,#28354d 89%);background-color:#28354d">&nbsp;</td>

    </tr>

  </tbody>

</table>

<!--<table width="100%" cellspacing="0" cellpadding="0" style="max-width: 100%;border-left:solid 1px #e6e6e6;border-right:solid 1px #e6e6e6">

  <tbody>

    <tr>

      <td valign="top" align="center" width="100"><table border="0" cellspacing="0" cellpadding="0" width="100%" bgcolor="#005387">
          <tbody>
            <tr>
              <td valign="middle" width="20%" align="left" height="35" style="text-align:center;border-bottom:solid 1px #003a5e;border-right:solid 1px #1a6592;padding:0 0 0 5px"><a style="text-decoration:none;outline:none;display:block" href="http://www.stylior.comshirts" target="_blank">

                  <span style="text-align:center;font-size:11px;color:#99bacf;line-height:14px">SHOP</span><br>
                </a></td>
              <td valign="middle" align="left" width="20%" height="35" style="text-align:center;border-bottom:solid 1px #003a5e;border-right:solid 1px #1a6592;padding:0 0 0 5px"><a style="text-decoration:none;outline:none;display:block" href="http://www.stylior.com/our-story" target="_blank">
                  <span style="text-align:center;font-size:11px;color:#99bacf;line-height:14px">OUR STORY</span>
                </a></td>
            </tr>
          </tbody>
        </table></td>
      <td valign="top" align="center" width="100"><table border="0" cellspacing="0" cellpadding="0" width="100%" bgcolor="#005387">
          <tbody>
            <tr>
              <td valign="middle" align="left" width="30%" height="35" style="text-align:center;border-bottom:solid 1px #003a5e;border-right:solid 1px #1a6592;padding:0 0 0 5px"><a style="text-decoration:none;outline:none;display:block" href="http://www.stylior.com/how-it-works" target="_blank">
                  <span style="font-size:11px;text-align:center;color:#99bacf;line-height:14px">HOW IT WORKS </span>
                </a></td>
				 <td valign="middle" align="left" width="30%" height="35" style="border-bottom:solid 1px #003a5e; border-right:solid 1px #1a6592;padding:0 0 0 5px;text-align:center;"><a style="text-decoration:none;outline:none;display:block" href="http://www.stylior.com/" target="_blank">

                  <span style="text-align:center;font-size:11px;color:#99bacf;line-height:14px">LOGIN</span>
                </a></td>
				<td valign="middle" align="left" width="20%" height="35" style="text-align:center;border-bottom:solid 1px #003a5e;border-right:solid 1px #1a6592;padding:0 0 0 5px"><a style="text-decoration:none;outline:none;display:block" href="http://www.stylior.com" target="_blank">
             <img src="http://www.stylior.com/images/cart-icon1.png" style="">
              </a></td>
            </tr>
          </tbody>
        </table></td>
    </tr>
  </tbody>
</table>-->
<table width="100%" cellspacing="0" cellpadding="0" style="max-width: 100%;border-left:solid 1px #e6e6e6;border-right:solid 1px #e6e6e6">

  <tbody>

    <tr>

      <td align="left" valign="top" style="color:#2c2c2c;display:block;line-height:20px;font-weight:300;margin:0 auto;clear:both;border-bottom:1px solid #cccccc;background-color:#f9f9f9;padding:20px" bgcolor="#F9F9F9"><p style="padding:0;margin:0;font-size:16px;font-weight:bold;font-size:15px"> Hi <br>' .'

        </p>

        <br>

        <p style="padding:0;margin:0;color:#565656;line-height:22px;font-size:13px">

         Details of book appointment <br> Name :'.$_POST['firstname'].'<br> Email :'.$data['email'].'<br> Appointment Date :'.$dataInfo['appointment_date'].'<br> Appointment Time :  ' .$_POST['start_time'].'<br> Location :'. $data['appointment_location'].'<br> Mobile :'.$data['phone_number'].'



          </p></td>

    </tr>

  </tbody>

</table>

<table width="100%" class="tableimg" cellspacing="0" cellpadding="0" style="max-width: 100%;border-left:solid 1px #e6e6e6;border-right:solid 1px #e6e6e6">

  <tbody>

    <tr>



        <table width="100%" cellspacing="0" cellpadding="0">

          <tbody>

            <tr>



				<td valign="top" align="left" style=""><a href="" style="text-decoration:none;" >



				<a href="" style="text-decoration:none;" >

				<img src="http://www.stylior.com/images/shirt.jpg" style="width:100%;"></a></td>

          </tbody>

        </table>



        <table width="100%" id="imageclass" cellspacing="0" cellpadding="0">

          <tbody>

            <tr>



				<td valign="top" id="image" align="left" style="padding:0 10px -25px 20px;margin:0"><a href="" style="text-decoration:none;" >



				<a href="" style="text-decoration:none;" >

				<img src="http://www.stylior.com/images/trouser.jpg" style="width:100%;"></a></td>



            </tr>

          </tbody>

        </table>

    </tr>

  </tbody>

</table>

<table width="100%" cellspacing="0" cellpadding="0" style="max-width: 100%;border:solid 1px #e6e6e6;border-top:none">

  <tbody>

    <tr>

      <td valign="top" align="center" style="text-align:center;background-color:#f9f9f9;display:block;margin:0 auto;clear:both;padding:15px 0px" bgcolor=""><p style="padding:0;margin:0 0 7px 0">

          <a title="stylior.com" style="text-decoration:none;color:#565656" href="http://www.stylior.com" target="_blank"><span style="color:#565656;font-size:15px">www.stylior.com</span></a>

        </p>

        <p style="padding:10px 0 0 0;margin:0;border-top:solid 1px #cccccc;font-size:11px;color:#565656">



          <a style="text-decoration:none;" href="#"><img src="http://www.stylior.com/images/fb-icon.png"></a>

          &nbsp;  &nbsp;

          <a style="text-decoration:none;" href="#"><img src="http://www.stylior.com/images/you-tube-icon.png"></a>

          &nbsp;  &nbsp;

		  <a style="text-decoration:none;" href="#"><img src="http://www.stylior.com/images/twitter-icon.png"></a>

          &nbsp; &nbsp;

		  <a style="text-decoration:none;" href="#"><img src="http://www.stylior.com/images/linkdin-icon.png"></a>

          &nbsp;  &nbsp;

		  <a style="text-decoration:none;" href="#"><img src="http://www.stylior.com/images/pintrest-icon.png"></a>

          &nbsp;  &nbsp;

          <a style="text-decoration:none;" href="#"><img src="http://www.stylior.com/images/instagram-icon.png"></a>

        </p></td>

    </tr>

  </tbody>

</table>

</body>

</html> '	;

			 $to='v.dileepan@yahoo.com, riyas@stylior.com, shehjaz@gmail.com ';



				$subject  = 'Stylior : Appointment Scheduled';

				$headers  = 'MIME-Version: 1.0' . "\r\n";

				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

				$headers .= "CC: bookappointment@stylior.com ".PHP_EOL;

				$headers .= 'From: Stylior <bookappointment@stylior.com>' . "\r\n" .

							'Reply-To: bookappointment@stylior.com' . "\r\n" .

							'X-Mailer: PHP/' . phpversion();

			     if(mail($to, $subject, $message, $headers))

				 {

					 echo "<script>alert('Thank you for Book Appointment with stylior.com !');</script>";

					echo "<script>document.location.href='".$this->config->item('base_url_temp')."book-a-home-visit'</script>";



						 //redirect($this->config->item('base_url').'home/lum_appointment');

						return json_encode($data);

				 }

				else{

					 echo "<script>alert('Mail was not sent. Please try again later');</script>";

					echo "<script>document.location.href='".$this->config->item('base_url_temp')."book-a-home-visit'</script>";

				}



		}

		else

		{

						return false;

		}

		}

	}

















	public function lum_login()
	{
		$this->load->helper('url');

		$this->output->enable_profiler(FALSE);

		$base_url = $this->config->item('base_url_temp');

		if($_SESSION['trailshirtoffline']=="True")
		{
		$this->load->view('offline_header');
		$this->load->view('offine_login_view');

		}
		else
		{

		$this->load->view('lum_header');

		$this->load->view('lum_login');

		$this->load->view('lum_footer');

		}

   }





	public function lum_login_test()
	{
		$this->load->helper('url');

		$this->output->enable_profiler(FALSE);

		$base_url = $this->config->item('base_url_temp');

		if($_SESSION['trailshirtoffline']=="True")
		{
		$this->load->view('offline_header');
		$this->load->view('offine_login_view');

		}
		else
		{
			$this->load->view('lum_header');
			$this->load->view('lum_login_test');
			$this->load->view('lum_footer');
		}

   }






   public function contact_submit()
   {



		  $name = $_POST['name'];

		  $email = 'support@stylior.com';

		  $subject = $_POST['subject'];

		  $content = $_POST['message'];

		  $email_customer = $_POST['email'];

		  $phone = $_POST['phone'];

		  $subject = $_POST['subject'];

		  $message = "Dear Support team ,\n $name has made an enquiry using our contact form . The details of the enquiry is as given below. \n\n  Name : $name \n Email : $email_customer \n phone: $phone \n Subject : $subject \n Message : $message";

		  $subject  = 'New Enquiry';

		  $headers  = 'MIME-Version: 1.0' . "\r\n";

		  $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

		  $headers .= 'From: stylior.com <newsletter@stylior.com>' . "\r\n" .

						'Reply-To: newsletter@stylior.com' . "\r\n" .

						'X-Mailer: PHP/' . phpversion();



			//mail('newsletter@stylior.com', $subject, $message, $headers);



			if(mail($email, $subject, $message, $headers))

      {

      echo "<script>alert('Thank you for Contact with stylior.com !');</script>";

      echo "<script>document.location.href='".$this->config->item('base_url_temp')."contact-us'</script>";

      }

      else

      {

      echo "<script>alert('Mail was not sent. Please try again later');</script>";

	  echo "<script>document.location.href='".$this->config->item('base_url_temp')."contact-us'</script>";

      }







	   }









public function corporate_orders()
 {



		  $name = $_POST['name'];

		  $email = $_POST['email'];

		  $comapny = $_POST['comapny'];

		  $phone = $_POST['phone'];

		  $staff = $_POST['staff'];

		  $message = "Hi $name Your Details are : Email :$email and Company : $comapny and Staff: $staff";

		   $subject  = 'Thank you for adding with Stylior.com';

			$headers  = 'MIME-Version: 1.0' . "\r\n";

			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

			$headers .= 'From: stylior.com <newsletter@stylior.com>' . "\r\n" .

						'Reply-To: newsletter@stylior.com' . "\r\n" .

						'X-Mailer: PHP/' . phpversion();



			//mail('newsletter@stylior.com', $subject, $message, $headers);



			if(mail($email, $subject, $message, $headers))

      {

      echo "<script>alert('Thank you for adding with stylior.com !');</script>";

      echo "<script>document.location.href='http://www.stylior.com/corporate-orders'</script>";

      }

      else

      {

      echo "<script>alert('Mail was not sent. Please try again later');</script>";

	  echo "<script>document.location.href='http://www.stylior.com/corporate-orders'</script>";

      }







 }




public function subscribe()
{

		$data = array();
		$data['L_strErrorMessage'] = '';
   	    $email = $_POST['newemail'];
   	     $_SESSION['subscribe']="";
		$emailavail = $this->home_model->checksubscriber($email);
		$_SESSION['user_subscribe']="";

	    if($emailavail==1||$emailavail==true){
            $_SESSION['sub_message']="Already subscribed, Thank you!";
            $_SESSION['user_subscribe']="registered";
		 	echo "<script>document.location.href='".$this->config->item('base_url_temp')."'</script>";
		}
		else{
        $this->home_model->addsubsciber($email);
		$message = str_replace('{Email}',$email,$message);
		$subject  = 'Thank you for subscribing with Stylior.com';
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'From: stylior.com <newsletter@stylior.com>' . "\r\n" .
					'Reply-To: newsletter@stylior.com' . "\r\n" .
					'X-Mailer: PHP/' . phpversion();
		
		mail($email, $subject, $message, $headers);
		mail('newsletter@stylior.com', $subject, $message, $headers);
		
		if(mail($email, $subject, $message, $headers))
	      {
	      //echo "<script>alert('Thank you for subscribe with stylior.com !');</script>";
	      $_SESSION['sub_message']="Thank you for subscribing with stylior.com !";
	      $_SESSION['user_subscribe']="registered";
	      echo "<script>document.location.href='".$this->config->item('base_url_temp')."'</script>";
	      }
	      else
	      {
	      // echo "<script>alert('Mail was not sent. Please try again later');</script>";
	      	$_SESSION['sub_message']="Thank you for subscribing with stylior.com !";
	      	$_SESSION['user_subscribe']="registered";
		    echo "<script>document.location.href='".$this->config->item('base_url_temp')."'</script>";

	      }
	}


 }


public function lum_login_view()
{

		$this->load->helper('url');

		$this->output->enable_profiler(FALSE);



                $this->load->view('lum_header');

		$this->load->view('lum_login');

                $this->load->view('lum_footer');



}



public function lum_appointment()
{

		$this->load->model('home_model');

		$this->load->helper('url');

		$this->output->enable_profiler(FALSE);

		$metadata['title']='Book a Custom Suit Fitting Appointment with Our Stylist';
		$metadata['metadescription']='Book an appointment online to get fitted for custom suits, shirts and trousers as per your needs and comfort. Available in Dubai and Mumbai.';
		$metadata['metakeywords']='book an appointment for custom suits, mens suits,custom suits, custom suits for men, custom clothing for men, mens suits online, cheap suits for men, mens designer suits.';

                $this->load->view('lum_header',$metadata);

		$this->load->view('lum_appointment');

                $this->load->view('lum_footer');

}



public function lum_why_custom()
{

		$this->load->helper('url');

		$this->output->enable_profiler(FALSE);



                $this->load->view('lum_header');

				$this->load->view('why_custom');

				$this->load->view('lum_footer');

}



public function lum_fit_guide()
{

		$this->load->helper('url');

		$this->output->enable_profiler(FALSE);



                $this->load->view('lum_header');

				$this->load->view('fit_guide');

				$this->load->view('lum_footer');

}



	public function lum_fabric_guide()

	{

		$this->load->helper('url');

		$this->output->enable_profiler(FALSE);



                $this->load->view('lum_header');

				$this->load->view('fabric_guide');

				$this->load->view('lum_footer');

	}



	public function lum_corporate_orders()

	{

		$this->load->helper('url');

		$this->output->enable_profiler(FALSE);



                $this->load->view('lum_header');

				$this->load->view('corporate_orders');

				$this->load->view('lum_footer');

	}



	public function lum_trial_shirt()

	{



		$this->load->model('home_model');



		 $sql = "SELECT * from tbl_product where is_trail_shirt = 1";





		$query = $this->db->query($sql);

		$result = $query->result();

		$data['productInfo']=(array)$result['0'];

		 $data['productInfo'];



		$_SESSION['trail-shirt']=$data['productInfo']['id'];

		$_SESSION['price']=$data['productInfo']['price'];

		$_SESSION['pname']=$data['productInfo']['pname'];

		$resultTrial = $this->home_model->trailshirtinfo();



		$data['trialshirtInfo']=(array)$resultTrial['0'];

		$sql = "SELECT * from tbl_product_image where pid=".$result['0']->id;



		$query1 = $this->db->query($sql);

		$result1 = $query1->result();



		foreach($result1 as $index =>$product)

		{

			if($product->baseimage==1)

			{

				$base_images[$product->pid]=$product->image;

			}else{

				$product_images[$product->pid][]=$product->image;

			}

		}



		$data['baseImage']=$base_images;

		$data['images']=$product_images;
        $data['base_url_temp']=$this->config->item('base_url_temp');




	   if ($this->session->userdata('user_id') > 0)

		{

		$sql1 = "SELECT COUNT(*) AS ordcount  FROM `ci_orders` WHERE `order_status`='C' and `user_id` = '".$this->session->userdata('user_id')."'";

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

		}



		$this->load->helper('url');

		$this->output->enable_profiler(FALSE);

				 $this->load->view('lum_header');

				$this->load->view('lum_trialshirt',$data);

				$this->load->view('lum_footer');

	}





	function offline()

	{

		 $this->load->view('offline_header.php');

		$this->load->view('offline_new.php');

	}



	function offline_trailshirt()

	{

		$_SESSION['trailshirtoffline']="True";

	       $this->load->helper('url');



		$sql = "SELECT * from tbl_product where is_trail_shirt = 1";

		$query = $this->db->query($sql);

		$result = $query->result();

		$data['productInfo']=(array)$result['0'];

		//echo $data['productInfo'];die;

		//echo "<pre>";

		//print_r($data['productInfo']);



		$resultTrial = $this->home_model->trailshirtinfo();

		//print_r($resultTrial);die;

		$data['trialshirtInfo']=(array)$resultTrial['0'];

		$sql = "SELECT * from tbl_product_image where pid=".$result['0']->id;

		//echo $sql;die;

		$query1 = $this->db->query($sql);

		$result1 = $query1->result();



		foreach($result1 as $index =>$product)

		{

			if($product->baseimage==1){

				$base_images[$product->pid]=$product->image;

			}else{

				$product_images[$product->pid][]=$product->image;

			}

		}

		//echo $base_images[$product->pid];die;

		//echo $product_images[$product->pid][];die;

		$data['baseImage']=$base_images;

		$data['images']=$product_images;

		//echo $data['baseImage'];die;

		//echo '<pre>';	print_r($data['images']);

	   if ($this->session->userdata('user_id') > 0)

		{

		$sql1 = "SELECT COUNT(*) AS ordcount  FROM `ci_orders` WHERE `user_id` = '".$this->session->userdata('user_id')."'";



		$query = $this->db->query($sql1);



		if ($query->num_rows() > 0)

		{

		    $result = $query->result();



		  $ordcont=$result[0]->ordcount;





			if($ordcont>0)

			{

				echo "<script>

					alert('trail shirt not applicable ');



						window.location.href='<?=base_url() ?>;

					</script>" ;

				$data['ordcount']=$ordcont;

					//var_dump($_SESSION);

		      //die;

			}



		}

		}





			 $this->load->view('offline_header.php');

			$this->load->view('trialshirt.php',$data);







	}

















	public function category()

		{

			 $this->load->helper('url');

				$this->output->enable_profiler(FALSE);

			   $base_url = $this->config->item('base_url');

				$this->load->view('header');

				$this->load->view('category.php');

				$this->load->view('footer');

		}

	  public function login()

		{

			//echo "<pre>";

			///print_r();

			//die;

			if($this->session->userdata['user_id'])

			{

				redirect($this->config->item('base_url_temp').'home');

			}



			 $this->load->helper('url');

				$this->output->enable_profiler(FALSE);

			$base_url = $this->config->item('base_url_temp');





				if($_SESSION['trailshirtoffline']=="True")

				{

					$this->load->view('offline_header');

					$this->load->view('offine_login_view');

				}

				else

				{

				$this->load->view('lum_header');

				$this->load->view('login_view');

				$this->load->view('lum_footer');





				}



		}



	    public function registration()

		{



			//echo "reg";

			//error_reporting(1);

				$this->load->view('lum_header');

				$base_url = $this->config->item('base_url_temp');

				$this->load->helper('url');

				$this->output->enable_profiler(FALSE);

				$this->load->model('user_model');



		foreach($_POST as $key => $value)

		{



			$data[$key]=$this->input->post($key);

		}



		$content['username']  = $data['reg_username'];

		$content['email']	  = $data['reg_email'];

		$content['password']  = $data['reg_password'];

		$content['md5pwd']  = md5($data['reg_password']);

		//$content['reg_password2'] = $data['reg_password2'];

		//$content['reg_mobileno'] = $data['reg_mobileno'];



		if(isset($data['insider']) !="")

		{

		   $content['insider'] = $data['insider'];

		}

		else

		{

				$content['insider'] = "0";

		}

		//$content['ccode'] = $data['ccode'];





		if($data['productid'] != '')

		{
			$content['ref_id']  = $data['productid'] ;

		} else

		{

			$content['ref_id']  = "0";

		}

		$alreadyexists = $this->User_model->checkvalidemail($content);

		if($alreadyexists != '')

		{

		  echo '<script type="text/javascript">'

              , 'alert("email already exists");'

               , '</script>'

                  ;



		 $data['L_strErrorMessage'] = "Email Id already Exists.!!";

			//$data['countrycode'] = $this->user_model->getccode();

			$data['title'] = 'Stylior.com';

			$data['keywords'] = '';

			$data['description'] = '';

			//$this->load->view('user_registration');

		}

		else

		{

			if($this->input->post("action")=="registration")

			{

				$id = $this->User_model->adduser($content);





				if($content['ref_id'] !="")

				{

					$refbonus = $this->user_model->getprebonus($content['ref_id']);

					$refamount = $this->user_model->getrefamount();

					$bonus = $refbonus + $refamount ;

					$this->user_model->updatebonus($bonus,$content['ref_id']);

					$this->user_model->add_transaction($refamount,$content['ref_id'],$id);



				}

				$userdata = $this->user_model->userdata($id);

				$this->load->library('session');



				//print_r($newuserdata);die;

				$email = $this->input->post('reg_email');

				//$check = $this->session->set_userdata($newuserdata);

				$format = $this->user_model->getusermail();



				if(isset($data['insider']) == '1'){

					$message = $format[0]->insreg;

					$mysub = $format[0]->insregsub;

					$sub = str_replace('{FirstName}',$this->input->post('reg_username'),$mysub);

				} else {

					$message = $format[0]->regemail;

					$mysub = $format[0]->regemailsub;

					$sub = str_replace('{FirstName}',$this->input->post('reg_username'),$mysub);



				}

				$message = str_replace('/ckfinder',$this->config->item('base_url_temp').'ckfinder',$message);
				$message = str_replace('{FirstName}',$this->input->post('reg_username'),$message);
				$message = str_replace('{Email}',$this->input->post('reg_email'),$message);
    			$message = str_replace('{passsword}',$this->input->post('reg_password'),$message);
				if(isset($data['insider']) == '1'){
					$url = $base_url.'user/activateac/'.$id.'/'.$this->session->userdata('cstyleid');
					$message = str_replace('{userlink}','<a href="'.$url.'">ACTIVATE</a>',$message);

				}

				//$to = $this->input->post('txtemail');
				$subject  =	$sub;
				$headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				$headers .= 'From: stylior.com <info@stylior.com>' . "\r\n" .

							'Reply-To: info@stylior.com' . "\r\n" .

							'X-Mailer: PHP/' . phpversion();

 			 	//mail('patelnikul321@gmail.com', $subject, $message, $headers);
			   mail($this->input->post('reg_email'), $subject, $message, $headers);
    			/*if($this->cart->total_items() > 0)
				{
					redirect($this->config->item('base_url').'home/checkout', 'location');

				} */









					if($data['insider'] == '1')

					{

						$this->session->set_flashdata('item1','Thank you for registering with Stylior.com. Verification mail has been sent to your email id to activate your registered email address.');

						redirect($this->config->item('base_url_temp').'home/registration');

					}

					else

						{



						$newuserdata = array(

						   'username'  => $userdata->username,

						   'userid'    => $userdata->id,

						   'email'     => $userdata->email,

						   'insider'     => $userdata->insider,

						   'logged_in' => true

						);



						$check = $this->session->set_userdata($newuserdata);

						$_SESSION['username'] = $userdata->username;

						$_SESSION['user_id'] = $userdata->id;

						$_SESSION['email'] = $userdata->email;

						$_SESSION['insider'] = $userdata->insider;

						$_SESSION['logged_in'] = true;


					$data_backurl=$this->session->userdata('selected3dInfo_shirt');
					if($this->session->userdata('subcatid')==10){
						$url=json_decode($data_backurl['details']);
						redirect($this->config->item('base_url_temp').'Cart/addcart3dcombined', 'location');
					//	redirect("http://".$url->product_details_page."#shirt_measurements","location");

					}
					else if($this->session->userdata('subcatid')==11){
					$url=json_decode($data_backurl['details']);
					redirect($this->config->item('base_url_temp').'Cart/addcart3dcombined', 'location');
					//	redirect("http://".$url->product_details_page."#trouser_measurements","location");
					}
					else if($this->session->userdata('subcatid')==12){
					$url=json_decode($data_backurl['details']);
					redirect($this->config->item('base_url_temp').'Cart/addcart3dcombined', 'location');
					//	redirect("http://".$url->product_details_page."#trouser_measurements","location");
					}
					else if($this->session->userdata('subcatid')==15){
					$url=json_decode($data_backurl['details']);
					redirect($this->config->item('base_url_temp').'Cart/addcart3dcombined', 'location');
					//	redirect("http://".$url->product_details_page."#trouser_measurements","location");
					}
					else if($this->session->userdata('subcatid')==16){
					$url=json_decode($data_backurl['details']);
					redirect($this->config->item('base_url_temp').'Cart/addcart3dcombined', 'location');
					//	redirect("http://".$url->product_details_page."#trouser_measurements","location");
					}
					else if($this->session->userdata('subcatid')==17){
					$url=json_decode($data_backurl['details']);
					redirect($this->config->item('base_url_temp').'Cart/addcart3dcombined', 'location');
					//	redirect("http://".$url->product_details_page."#trouser_measurements","location");
					}
					else if($this->session->userdata('subcatid')==18){
					$url=json_decode($data_backurl['details']);
					redirect($this->config->item('base_url_temp').'Cart/addcart3dcombined', 'location');
					//	redirect("http://".$url->product_details_page."#trouser_measurements","location");
					}
					else if($this->session->userdata('subcatid')==19){
					$url=json_decode($data_backurl['details']);
					redirect($this->config->item('base_url_temp').'Cart/addcart3dcombined', 'location');
					//	redirect("http://".$url->product_details_page."#trouser_measurements","location");
					}
					else
					{
					redirect($this->config->item('base_url_temp').'Home/lum_my_account/', 'location');
					}


					//	redirect($this->config->item('base_url_temp').'Home/lum_my_account/', 'location');

					}




			}

		}



				$this->load->view('user_registration');

				$this->load->view('lum_footer');

		}





		function forgotten_passwor()

		{

			//echo 'hi';die;

		//error_reporting(1);

		//$this->load->model('User_model');

		$email = $_POST["recmail"];
		//echo $email ;die;
	    $data = $this->User_model->getpassword($email);
		{
           if($data != '')
		   {

			   $uwd=$data->password;
          	    $message = "<h3'>Your Email Id Is: ".$email."</h2>
				            <p style='color:red;'>Your Password Is: ".$uwd."</p>
					          <div class=''>Thank You</div>";
				$to=$_POST['recmail'];
				$subject  = 'Stylior : Forgot Password';
				$headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				$headers .= "CC: support@stylior.com ".PHP_EOL;
				$headers .= 'From: Stylior <support@stylior.com>' . "\r\n" .
							'Reply-To: support@stylior.com' . "\r\n" .
							'X-Mailer: PHP/' . phpversion();
			    // mail($to, $subject, $message, $headers);

				 if(mail($to, $subject, $message, $headers))
				 {
					echo "Password should sent to email id.";
					//echo "<script>document.location.href='http://www.stylior.com/home/lum_login'</script>";

						 //redirect($this->config->item('base_url').'home/lum_appointment');
						//return json_encode($data);
				 }

				else{

					 echo "<script>alert('Mail was not sent. Please try again later');</script>";

					echo "<script>document.location.href='".$this->config->item('base_url_temp')."home/lum_login'</script>";

				}



		   }
		   else
	   		{
			// echo "<script type='text/javascript'>
			//alert('Invalid Email Id');
			//</script>";
			echo 'Invlid Email Address';

		   }



		}

		}



		public function checkemail()

	{

		error_reporting(1);

		$this->load->model('user_model');

		$email = $this->input->post('email');

		//echo $email;

		$data = $this->user_model->checkvalidemail($email);

		//print_r ($data);





	}

		public function custom($catid,$subcatid,$productid)

		{

			$this->session->set_userdata('catid',$catid);

			$this->session->set_userdata('subcatid',$subcatid);

			$this->session->set_userdata('productid',$productid);

		    $this->load->helper('url');

		    $this->data['shirtfabrics'] = $this->home_model->customdtata($catid,10);

			$this->data['pantfabrics'] = $this->home_model->customdtatapant($catid,11);

			$this->data['allfabrics'] = $this->home_model->allfabdtata();

			$this->data['collars'] = $this->home_model->allcollardata();

			$this->data['cuffs'] = $this->home_model->allcuffdata();

			$this->data['innercontrastfab'] = $this->home_model->allinnercontrastfab();

			$this->data['allbuttons'] = $this->home_model->allbuttons();

			$this->data['basefab'] = $this->home_model->getbasefab($productid);

			$this->data['productid'] =$productid;

			$this->data['subcatid'] =$subcatid;

			$this->data['catid'] =$catid;



				//echo $subcatid; die;



			//echo "<pre>";print_r($this->data['allfabrics'] );die;

			//$this->data['shirtfabrics'] = $this->home_model->customdtata($catid,10);

				//$this->output->enable_profiler(FALSE);





				$this->load->view('header');









				if($subcatid=="11")

				{

				 $this->load->view('3dcombined_pant',$this->data);



				}

				else

				{

				 $this->load->view('3dcombined',$this->data);



				}



				$this->load->view('footer');





		}

		public function custom_new($catid,$subcatid,$productid)

		{

			$this->session->set_userdata('catid',$catid);
			$this->session->set_userdata('subcatid',$subcatid);
			$this->session->set_userdata('productid',$productid);
		    $this->load->helper('url');
		    $this->data['shirtfabrics'] = $this->home_model->customdtata($catid,10);
			$this->data['pantfabrics'] = $this->home_model->customdtatapant($catid,11);
			$this->data['allfabrics'] = $this->home_model->allfabdtata();
			$this->data['collars'] = $this->home_model->allcollardata();
			$this->data['cuffs'] = $this->home_model->allcuffdata();
			$this->data['innercontrastfab'] = $this->home_model->allinnercontrastfab();
			$this->data['allbuttons'] = $this->home_model->allbuttons();
			$this->data['basefab'] = $this->home_model->getbasefab($productid);
			$this->data['productid'] =$productid;
			$this->data['subcatid'] =$subcatid;
			$this->data['catid'] =$catid;
			//echo $subcatid; die;
			//echo "<pre>";print_r($this->data['allfabrics'] );die;
			//$this->data['shirtfabrics'] = $this->home_model->customdtata($catid,10);
			//$this->output->enable_profiler(FALSE);
			$this->load->view('header');
			if($subcatid=="11")
			{
				 $this->load->view('3dcombined_pant',$this->data);
			}
			else
			{
			 $this->load->view('3dcombined_new',$this->data);
			}
			$this->load->view('footer');

		}





		public function newmeasure()
		{
			$this->load->helper('url');
			$this->output->enable_profiler(FALSE);
			$base_url = $this->config->item('base_url');
			if($_SESSION['subcatid']==20||$_SESSION['trail-shirt'])
			{
				$_SESSION['subcatid']=10;
			}
			if(!empty($_SESSION['subcatid']))
		    {
			 $_POST['subcatid']=$_SESSION['subcatid'];
		    }
		    $_POST['catid']=9;
			$_POST['fit']=1;
			$this->data['datashirt'] = $this->home_model->shirtparts($_POST['catid'],$_POST['subcatid']);
			$this->data['shirt_sizes'] = $this->home_model->shirtparts($_POST['catid'],$_POST['subcatid']);
			$get_sizes = $this->Cart_model->sizedata($_POST['subcatid'],$_POST['fit']);
			$this->data['sizes'] =$get_sizes;
			$this->load->view('lum_header');
			if($_POST['subcatid']==10)
			{
			 $this->load->view('lum_saved_profile5',$this->data);
			}
			else if($_POST['subcatid']==11)
			{
			 $this->load->view('lum_saved_profile9',$this->data);
			}
			$this->load->view('lum_footer');

		}

		public function login_test()
		  {
		    $this->load->helper('url');
		    $this->output->enable_profiler(FALSE);
			$base_url = $this->config->item('base_url');
		    //$this->load->view('header');
		    $this->load->view('login_test');
		    //$this->load->view('footer');

		  }

		public function guestlogin()
		{
			if(!empty($_POST['guestemail']))
			{
				$guestemail= $_POST['guestemail'];
				$alreadyexists = $this->User_model->checkvalidemail($guestemail);
				if($alreadyexists != '')
				{
					$data['L_strErrorMessage'] = "Email Id already Exists.!!";
					$data['countrycode'] = $this->user_model->getccode();
					$data['title'] = 'Stylior.com';
					$data['keywords'] = '';
					$data['description'] = '';
					$this->load->view('login_view',$data);
				}
				else
				{
					foreach($_POST as $key => $value)
					{
						$data[$key]=$this->input->post($key);
					}

					$this->load->library('session');
					$content['username']  = $data['guestemail'];
					$content['email']	  = $data['guestemail'];
					$content['password']  = "guest";

					$this->session->set_userdata('email',$content['email']);
					$this->session->set_userdata('username',$content['username']);
					
					if($this->input->post("action")=="guestlogin")
					{
						$id = $this->User_model->guestuser($content);
						$this->session->set_userdata('user_id',$id);
						$_SESSION['usertype']="Guest";
						$_SESSION['Guestuser_id']=$id;
						// redirecting to add cart function based on 3d data selection  
		
						if(isset($_SESSION['selected3dInfo_pant']) && !empty($_SESSION['selected3dInfo_pant'])&& isset($_SESSION['selected3dInfo_shirt']) && !empty($_SESSION['selected3dInfo_shirt'])){
						$_SESSION['ordertype']="both";
						redirect($this->config->item('base_url_temp').'Cart/addToCartTrouser', 'location') ;
					}
					else if(isset($_SESSION['selected3dInfo_shirt']) && !empty($_SESSION['selected3dInfo_shirt'])){
						    $_SESSION['ordertype']="shirt";
							redirect($this->config->item('base_url_temp').'Cart/addcart3dcombined', 'location');
					}
					else if(isset($_SESSION['selected3dInfo_pant']) && !empty($_SESSION['selected3dInfo_pant'])){
							// echo "hihi".$this->config->item('base_url');exit;
							$_SESSION['ordertype']="pant";
							redirect($this->config->item('base_url_temp').'Cart/addToCartTrouser', 'location') ;
					}
					//trailshirt
					else if(isset($_SESSION['selected3dInfo_shirttrail']) && !empty($_SESSION['selected3dInfo_shirttrail'])){
						// echo "hihi".$this->config->item('base_url');exit;
						$_SESSION['ordertype']="trailshirt";
						redirect($this->config->item('base_url_temp').'Cart/addcart3dcombined', 'location') ;
					}
					else if(isset($_SESSION['selected3dInfo_vest']) && !empty($_SESSION['selected3dInfo_vest'])){
						    $_SESSION['ordertype']="vest";
							redirect($this->config->item('base_url_temp').'Cart/addToCartVest', 'location');
					}
		           	else if(isset($_SESSION['selected3dInfo_blazer']) && !empty($_SESSION['selected3dInfo_blazer'])){
						    $_SESSION['ordertype']="blazer";
							redirect($this->config->item('base_url_temp').'Cart/addToCartBlazer', 'location');
					}
		           	else if(isset($_SESSION['selected3dInfo_suit']) && !empty($_SESSION['selected3dInfo_suit'])){
						    $_SESSION['ordertype']="suit";
							redirect($this->config->item('base_url_temp').'Cart/addToCartSuit', 'location');
					}	
					
					redirect($this->config->item('base_url_temp'));

			}

		}

	  }

	}





	/*category controller for shirts...*/
	public function affliate_login()
	{
		// echo "<pre>";
		//print_r($_SESSION);
	 	if($this->session->userdata['user_id'] && $this->session->userdata['affiliate']=1)
		{
				redirect($this->config->item('base_url').'home/myaccount');

		}
		$this->load->helper('url');
		$this->load->view('header');
		$data = array();
		$data['email']="";
		$data['L_strErrorMessage'] = "";
		$data['err_msg'] = "";
		$data['title'] = 'Stylior.com';
		$data['keywords'] = '';
		$data['description'] = '';
		$this->load->view('affliate_login',$data);
		$this->load->view('footer');

	}

	public function affliate_registration()
	 {

		$this->load->helper('url');
		$this->load->view('header');
		$this->load->model('user_model');  
	    if($this->session->userdata('user_id') != "")
		{
   			redirect($this->config->item('base_url').'home/checkout');
        }
        else
  		{
		   $data = array();
	       $data['L_strErrorMessage'] = "";
	       $data['err_msg'] = "";
	       $data['countrycode'] = $this->home_model->countrycode();
	       $data['title'] = 'Stylior.com';
	       $data['keywords'] = '';
	       $data['description'] = '';
	       $this->load->view('affliate_registration',$data);
	       $this->load->view('footer');
        }

     }



	public function insider_registration()
	 {
		$this->load->model('user_model');
		if($this->session->userdata('user_id') != "")
		{

			redirect($this->config->item('base_url').'home/checkout');

		}
		else
		{

			$this->load->helper('url');
    		$this->load->view('header');
			$data = array();
			$data['L_strErrorMessage'] = "";
			$data['err_msg'] = "";
			$data['title'] = 'Stylior.com';
			$data['keywords'] = '';
			$data['description'] = '';
			$data['countrycode'] = $this->home_model->countrycode();
			$this->load->view('insider_registration',$data);
			$this->load->view('footer');

		}



	 }



	public function ilogin()

	{

		$this->load->helper('url');

		$this->load->view('header');

		$data = array();

		$data['email']="";

		$data['L_strErrorMessage'] = "";

		$data['err_msg'] = "";

		$data['title'] = 'Stylior.com';

		$data['keywords'] = '';

		$data['description'] = '';

		$this->load->view('insider_login',$data);

		$this->load->view('footer');

	}









	public function shop_shirt_new($catid,$subcatid)

	{



		$this->load->model('home_model');
		$page= $this->input->get('per_page') ? $this->input->get('per_page') : 0;
		$this->load->library('pagination');
		$url_to_paging = $this->config->item('base_url');
		$sizerange = '';
		if($this->input->get('size') != '')
		{
			$data['size'] = $this->input->get('size');
			if(count($data['size']) > 0)
			{
				for($k='0';$k< count($data['size']); $k++){
				$sizerange .= 'size[]='.$data['size'][$k].'&';
				}
			}
		}
		else
		{
			$data['size'] = array();
		}
		$data['page'] = $this->input->get('page');
		$data['color'] = $this->input->get('color');
		$data['size'] = $this->input->get('size');
		$data['designid'] = $this->input->get('designid');
		$data['fabricid'] = $this->input->get('fabricid');
		$data['priceord'] = $this->input->get('priceord');
		if($data['page'] == '')
		{

			$data['page'] = $config['per_page'] = '9';

		}
		else
		{
			$data['page'] = $config['per_page'] = $this->input->get('page');

		}
		$pageno = $this->input->get('per_page');
		if($pageno == '')
		{
			$pageno = '0';
		}
		$perpage = '3';
		//$return = $this->home_model->allproductsNew();
		$this->data['image'] = $this->home_model->shop_shirt_new($catid,$subcatid,$config['per_page'],$pageno, $data);
		//$data['allproducts'] = $return['result'];
		//$config['total_rows'] = $return['count'];
		//$data['images'] = $return['images'];
		//echo "<pre>";print_r($this->data);die;
		$this->pagination->initialize($config);
		//////////
		if(isset($_POST["designer"]))
		{
			$this->data['customize_type'] = "designer";
		}
		else if(isset($_POST["customize"]))
		{
			$this->data['customize_type'] = "customize";
		}
		$this->load->helper('url');
		$this->output->enable_profiler(FALSE);
		//$this->data['image'] = $this->home_model->shop($catid,$subcatid);
		$this->data['allcolor']=$this->home_model->allcolor();
		$this->data['alldesign'] = $this->home_model->alldesign();
		$this->data['subcatid']=$subcatid;
		$this->data['catid']=$catid;
		//$this->data['images1'] = $return['images'];
		$this->load->view('lum_header');
		$this->load->view('lum_shop_new',$this->data);
		$this->load->view('lum_footer');

	}

	public function shop_shirt($catid,$subcatid)
	{		
			//echo $subcatid;die;
			$this->load->model('home_model');
			$page= $this->input->get('per_page') ? $this->input->get('per_page') : 0;
			$this->load->library('pagination');
			$url_to_paging = $this->config->item('base_url');
			$sizerange = '';
			/*get meta data */
			$subcategory_details=$this->home_model->getCategoryInfo($subcatid);
			$metadata['title']=$subcategory_details->title;
			$metadata['metadescription']=$subcategory_details->description;
			$metadata['metakeywords']=$subcategory_details->keyword;
			/*meta data end*/
			if($this->input->get('size') != '')
			{
				$data['size'] = $this->input->get('size');
				if(count($data['size']) > 0)
				{

					for($k='0';$k< count($data['size']); $k++){
						$sizerange .= 'size[]='.$data['size'][$k].'&';
					}
				}
			}
			else
			{
				$data['size'] = array();
			}
		$data['page'] = $this->input->get('page');
		$data['color'] = $this->input->get('color');
		$data['size'] = $this->input->get('size');
		$data['designid'] = $this->input->get('designid');
		$data['fabricid'] = $this->input->get('fabricid');
		$data['priceord'] = $this->input->get('priceord');

		if($data['page'] == '')
		{
			$data['page'] = $config['per_page'] = '9';
		}
		else
		{
			$data['page'] = $config['per_page'] = $this->input->get('page');
		}
		$pageno = $this->input->get('per_page');
		if($pageno == '')
		{
			$pageno = '0';
		}
		$perpage = '3';
		//$return = $this->home_model->allproductsNew();
    	$this->data['image'] = $this->home_model->shop($catid,$subcatid,$config['per_page'],$pageno, $data);
		//$data['allproducts'] = $return['result'];
		//$config['total_rows'] = $return['count'];
		//$data['images'] = $return['images'];
		//echo "<pre>";print_r($this->data);die;
		$this->pagination->initialize($config);
		//////////
		if(isset($_POST["designer"]))
		{
			$this->data['customize_type'] = "designer";
		}
		else if(isset($_POST["customize"]))
		{
			$this->data['customize_type'] = "customize";
		}
		$this->load->helper('url');
		$this->output->enable_profiler(FALSE);
		//$this->data['image'] = $this->home_model->shop($catid,$subcatid);
		$this->data['allcolor']=$this->home_model->allcolor();
		$this->data['alldesign'] = $this->home_model->alldesign($catid,$subcatid);
		$this->data['subcatid']=$subcatid;
		$this->data['catid']=$catid;
		$_SESSION['subcatid']=$subcatid;
		$_SESSION['catid']=$catid;
		$this->session->set_userdata('subcatid',$this->data['subcatid']);
		//$this->session->set_userdata('subcatid',$subcatid);
		//$this->session->set_userdata('categoryid',$catid);
		//$this->data['images1'] = $return['images'];
		$this->load->view('lum_header',$metadata);
		$this->load->view('lum_shop',$this->data);
		$this->load->view('lum_footer');
}



public function shop_accessories($catid,$subcatid)
	{

		//echo $subcatid;die;

		$this->load->model('home_model');
		$page= $this->input->get('per_page') ? $this->input->get('per_page') : 0;
		$this->load->library('pagination');
		$url_to_paging = $this->config->item('base_url');
		$sizerange = '';
		/*get meta data */
		$subcategory_details=$this->home_model->getCategoryInfo($subcatid);
		$metadata['title']=$subcategory_details->title;
		$metadata['metadescription']=$subcategory_details->description;
		$metadata['metakeywords']=$subcategory_details->keyword;
		/*meta data end*/
		if($this->input->get('size') != '')
		{

				$data['size'] = $this->input->get('size');
				if(count($data['size']) > 0)
    			{
					for($k='0';$k< count($data['size']); $k++){
					$sizerange .= 'size[]='.$data['size'][$k].'&';
					}

				}

		}

		else

		{

			$data['size'] = array();

		}



		$data['page'] = $this->input->get('page');

		$data['color'] = $this->input->get('color');

		$data['size'] = $this->input->get('size');



		$data['designid'] = $this->input->get('designid');

		$data['fabricid'] = $this->input->get('fabricid');

		$data['priceord'] = $this->input->get('priceord');

		if($data['page'] == '')

		{

			$data['page'] = $config['per_page'] = '9';

		}

		else

		{

			$data['page'] = $config['per_page'] = $this->input->get('page');

		}



		$pageno = $this->input->get('per_page');

		if($pageno == '')

		{

			$pageno = '0';

		}



		$perpage = '3';

		$this->data['image'] = $this->home_model->shop_accessories($catid,$subcatid);

		$this->pagination->initialize($config);





		//////////

		if(isset($_POST["designer"]))

		{



			$this->data['customize_type'] = "designer";

		}

		else if(isset($_POST["customize"]))

		{

			$this->data['customize_type'] = "customize";

		}



		$this->load->helper('url');

		$this->output->enable_profiler(FALSE);

		//$this->data['image'] = $this->home_model->shop($catid,$subcatid);

		$this->data['allcolor']=$this->home_model->allcolor();

		$this->data['alldesign1'] = $this->home_model->alldesign1($catid,$subcatid);

		$this->data['subcatid']=$subcatid;

		$this->data['catid']=$catid;

		//$this->data['images1'] = $return['images'];

		$this->load->view('lum_header',$metadata);

		$this->load->view('lum_shop_accessories',$this->data);

		$this->load->view('lum_footer');

	}

	public function shop_ties($catid,$subcatid)
	{

		//echo $subcatid;die;
		$this->load->model('home_model');
		$page= $this->input->get('per_page') ? $this->input->get('per_page') : 0;
		$this->load->library('pagination');
		$url_to_paging = $this->config->item('base_url');
		$sizerange = '';
		/*get meta data */
		$subcategory_details=$this->home_model->getCategoryInfo($subcatid);
		$metadata['title']=$subcategory_details->title;
		$metadata['metadescription']=$subcategory_details->description;
		$metadata['metakeywords']=$subcategory_details->keyword;
		/*meta data end*/

		if($this->input->get('size') != '')
		{

				$data['size'] = $this->input->get('size');
				if(count($data['size']) > 0)
					{
					for($k='0';$k< count($data['size']); $k++){
					$sizerange .= 'size[]='.$data['size'][$k].'&';
					}

				}

		}
		else
		{

			$data['size'] = array();

		}

		$data['page'] = $this->input->get('page');
		$data['color'] = $this->input->get('color');
		$data['size'] = $this->input->get('size');
		$data['designid'] = $this->input->get('designid');
		$data['fabricid'] = $this->input->get('fabricid');
		$data['priceord'] = $this->input->get('priceord');
		if($data['page'] == '')
		{

			$data['page'] = $config['per_page'] = '9';

		}
		else
		{

			$data['page'] = $config['per_page'] = $this->input->get('page');

		}
		$pageno = $this->input->get('per_page');
		if($pageno == '')
		{

			$pageno = '0';

		}
		$perpage = '3';
		$this->data['image'] = $this->home_model->shop_accessories($catid,$subcatid);
		$this->pagination->initialize($config);
		//////////
		if(isset($_POST["designer"]))
		{
			$this->data['customize_type'] = "designer";
		}
		else if(isset($_POST["customize"]))
		{
			$this->data['customize_type'] = "customize";
		}
		$this->load->helper('url');
		$this->output->enable_profiler(FALSE);
		//$this->data['image'] = $this->home_model->shop($catid,$subcatid);
		$this->data['allcolor']=$this->home_model->allcolor();
		$this->data['alldesign1'] = $this->home_model->alldesign1($catid,$subcatid);
		$this->data['subcatid']=$subcatid;
		$this->data['catid']=$catid;
    	//$this->data['images1'] = $return['images'];
		$this->load->view('lum_header',$metadata);
		$this->load->view('lum_shop_ties',$this->data);
		$this->load->view('lum_footer');

	}


	/** This is testing...
	*** shop_cufflinks test
	*** delete after the use 
	*** */
	public function shop_cufflinks($catid,$subcatid)
	{

			//echo $subcatid;die;
			// $this->load->library('pagination');   	
			// $this->load->model('home_model');
			// $this->data['metadata'] = $this->home_model->getCategoryInfo(18);
			// $metadata['title'] = $this->data['c'][0]->title; 
			// $metadata['metadescription'] = $this->data['c'][0]->description; 
			// $metadata['metakeywords'] = $this->data['c'][0]->keyword;	     	
			// /*start var*/
			// $config = array();
			// $url_to_paging = $this->config->item('base_url_temp');
			// $current_url=$url_to_paging."mens-vests";
			// $config['base_url'] = $current_url;
			// $config["total_rows"] = count($this->home_model->shop_suit(18));
			// $config["uri_segment"] = 2;	
			// $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
			// $config["per_page"] =20;
			// $choice = $config["total_rows"] / $config["per_page"];
			// $config["num_links"] = round($choice);    
			// $data["details"] = $this->home_model->shop_suit_page(18,$page,$config["per_page"]);
			// $this->pagination->initialize($config);          
			// $data["links"] = $this->pagination->create_links(); 
			// $this->load->helper('url');
			// $this->output->enable_profiler(FALSE);
			// $this->load->view('lum_header',$metadata);
			// $this->load->view('vests',$data);
			// $this->load->view('lum_footer');
			// echo "No Data coming";
			$this->load->library('pagination');
			$this->load->model('home_model');
			//$page= $this->input->get('per_page') ? $this->input->get('per_page') : 0;	
			//$url_to_paging = $this->config->item('base_url');
			$sizerange = '';	
			/*get meta data */
			$subcategory_details=$this->home_model->getCategoryInfo($subcatid);
			$metadata['title']=$subcategory_details->title;
			$metadata['metadescription']=$subcategory_details->description;
			$metadata['metakeywords']=$subcategory_details->keyword;

			/*meta data end*/
			if($this->input->get('size') != '')
			{
				$data['size'] = $this->input->get('size');
				
				if(count($data['size']) > 0)
	    		{
						for($k='0';$k< count($data['size']); $k++){
							$sizerange .= 'size[]='.$data['size'][$k].'&';				
						}
				}
			}
			else
			{		
				$data['size'] = array();
			}

			$data['page'] = $this->input->get('page');
			$data['color'] = $this->input->get('color');
			$data['size'] = $this->input->get('size');
			$data['designid'] = $this->input->get('designid');
			$data['fabricid'] = $this->input->get('fabricid');
			$data['priceord'] = $this->input->get('priceord');
			if($data['page'] == '')
			{
				$data['page'] = $config['per_page'] = '9';
			}
			else
			{
				$data['page'] = $config['per_page'] = $this->input->get('page');

			}
			
			$pageno = $this->input->get('per_page');
			if($pageno == '')
			{
				$pageno = '0';
			}
			
			$perpage = '3';
			$this->data['image'] = $this->home_model->shop_accessories($catid,$subcatid);
			$this->pagination->initialize($config);	
			if(isset($_POST["designer"]))
			{
				$this->data['customize_type'] = "designer";
			}
			else if(isset($_POST["customize"]))
			{
				$this->data['customize_type'] = "customize";
			}
			$this->load->helper('url');
			$this->output->enable_profiler(FALSE);
			//$this->data['image'] = $this->home_model->shop($catid,$subcatid);
			$this->data['allcolor']=$this->home_model->allcolor();
			$this->data['alldesign1'] = $this->home_model->alldesign1($catid,$subcatid);
			$this->data['subcatid']=$subcatid;
			$this->data['catid']=$catid;
			//$this->data['images1'] = $return['images'];
			$this->load->view('lum_header',$metadata);
			$this->load->view('lum_shop_cufflinks',$this->data);
			$this->load->view('lum_footer');	
		}
	

		public function shop_suits($catid,$subcatid)
		{	
			//var started here : previous code before the pagination
			//echo $subcatid;die;
			// $this->load->model('home_model');
			// $this->data['details'] = $this->home_model->shop_suit(17);;
			// $this->data['metadata'] = $this->home_model->getCategoryInfo(17);;
			// $metadata['title'] = $this->data['c'][0]->title;
			// $metadata['metadescription'] = $this->data['c'][0]->description;
			// $metadata['metakeywords'] = $this->data['c'][0]->keyword;
			//$this->load->helper('url');
			// $this->output->enable_profiler(FALSE);
			// $this->load->view('lum_header',$metadata);
			// $this->load->view('suits',$this->data);
			// $this->load->view('lum_footer');
			/*end of code before pagination : 20 May 2017*/

			$url_to_paging = $this->config->item('base_url_temp');
			$current_url=$url_to_paging."mens-suits";
			$this->load->library('pagination');      
			$this->load->model('home_model');
			// $this->data['details'] = $this->home_model->shop_suit(17);;
			$this->data['metadata'] = $this->home_model->getCategoryInfo(17);;
			$metadata['title'] = $this->data['c'][0]->title;
			$metadata['metadescription'] = $this->data['c'][0]->description;
			$metadata['metakeywords'] = $this->data['c'][0]->keyword;
			/*var added : pagination code here*/
			$config = array();
			$config['base_url'] = $current_url;
			$config["total_rows"] = count($this->home_model->shop_suit(17));
			$config["uri_segment"] = 2; 
			$page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
			$config["per_page"] =20;
			$choice = $config["total_rows"] / $config["per_page"];
			$config["num_links"] = round($choice);    
			$data["details"] = $this->home_model->shop_suit_page(17,$page,$config["per_page"]);
			$this->pagination->initialize($config);          
			$data["links"] = $this->pagination->create_links(); 
			/*End of Pagination*/
			$this->load->helper('url');
			$this->output->enable_profiler(FALSE);
			$this->load->view('lum_header',$metadata);
			$this->load->view('suits',$data);
			$this->load->view('lum_footer');
		}


		public function shop_shirts($catid,$subcatid)
		{
			/*start var : code change for the pagination*/
			// echo $subcatid;die;
			// $this->load->library('pagination');   	
			// $this->load->model('home_model');
			// $this->data['details'] = $this->home_model->shop_suit(10);;
			// $this->data['metadata'] = $this->home_model->getCategoryInfo(10);;
			// $metadata['title'] = $this->data['c'][0]->title;
			// $metadata['metadescription'] = $this->data['c'][0]->description;
			// $metadata['metakeywords'] = $this->data['c'][0]->keyword;	
			// $this->load->helper('url');
			// $this->output->enable_profiler(FALSE);
			// $this->load->view('lum_header',$metadata);
			// $this->load->view('shirts',$this->data);
			// $this->load->view('lum_footer');
			/* END of previous code*/  
			// echo ":".$this->uri->segment(3);     
			// echo $this->uri->segment(2);
			// echo "this is testing";
		    $this->load->library('pagination');   	
	    	$this->load->model('home_model');
			//$this->data['details'] = $this->home_model->shop_suit(10);; X	
			$this->data['metadata'] = $this->home_model->getCategoryInfo(10);
			$metadata['title'] = $this->data['c'][0]->title; 
			$metadata['metadescription'] = $this->data['c'][0]->description; 
			$metadata['metakeywords'] = $this->data['c'][0]->keyword;	     	
			/*start var*/
			$config = array();
			//$config['base_url'] = 'https://www.stylior.com/home/shop_shirts_page/';	
			$config['base_url'] = $this->config->item('base_url_temp').'mens-shirts';
			$config["total_rows"] = count($this->home_model->shop_suit(10));
			$config["uri_segment"] = 2;	
			$page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
			$config["per_page"] =20;
		    $choice = $config["total_rows"] / $config["per_page"];
		    $config["num_links"] = round($choice);    
		    $data["details"] = $this->home_model->shop_suit_page(10,$page,$config["per_page"]);
			$this->pagination->initialize($config);          
	    	$data["links"] = $this->pagination->create_links(); 
	     	$this->load->helper('url');
			$this->output->enable_profiler(FALSE);
			$this->load->view('lum_header',$metadata);
			$this->load->view('shirts',$data);
			$this->load->view('lum_footer');

		}

		/*   var started :
   		***  the working on discount calculation for the offers
   		***   7th JUne 2017 Remove this function after use.
   		*/


		public function shop_shirts_test($catid,$subcatid)
		{
		    $this->load->library('pagination');   	
	    	$this->load->model('home_model');
			//$this->data['details'] = $this->home_model->shop_suit(10);; X	
			$this->data['metadata'] = $this->home_model->getCategoryInfo(10);
			$metadata['title'] = $this->data['c'][0]->title; 
			$metadata['metadescription'] = $this->data['c'][0]->description; 
			$metadata['metakeywords'] = $this->data['c'][0]->keyword;	     	
			/*start var*/
			$config = array();
			//$config['base_url'] = 'https://www.stylior.com/home/shop_shirts_page/';	
			$config['base_url'] = $this->config->item('base_url_temp').'mens-shirts';
			$config["total_rows"] = count($this->home_model->shop_suit(10));
			$config["uri_segment"] = 2;	
			$page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
			$config["per_page"] =20;
		    $choice = $config["total_rows"] / $config["per_page"];
		    $config["num_links"] = round($choice);    
		    $data["details"] = $this->home_model->shop_suit_page(10,$page,$config["per_page"]);
			$this->pagination->initialize($config);          
	    	$data["links"] = $this->pagination->create_links(); 
	     	$this->load->helper('url');
			$this->output->enable_profiler(FALSE);
			$this->load->view('lum_header',$metadata);
			$this->load->view('shirts_test',$data);
			$this->load->view('lum_footer');

		}
 /*** var END :*/

   

		public function shop_trousers($catid,$subcatid)
		{
			//Previous code of trouser before pagination...
			//echo $subcatid;die;
			// $this->load->model('home_model');
			// $this->data['details'] = $this->home_model->shop_suit(11);
			// $this->data['metadata'] = $this->home_model->getCategoryInfo(11);
			// $metadata['title'] = $this->data['c'][0]->title;
			// $metadata['metadescription'] = $this->data['c'][0]->description;
			// $metadata['metakeywords'] = $this->data['c'][0]->keyword;  
			// $this->load->helper('url');
			// $this->output->enable_profiler(FALSE);
			// $this->load->view('lum_header',$metadata);
			// $this->load->view('trousers-test',$this->data);
			// $this->load->view('lum_footer');			
			/*start var*/
			$this->load->library('pagination');   	
			$this->load->model('home_model');

			//$this->data['details'] = $this->home_model->shop_suit(10);; X	
			$this->data['metadata'] = $this->home_model->getCategoryInfo(11);
			$metadata['title'] = $this->data['c'][0]->title; 
			$metadata['metadescription'] = $this->data['c'][0]->description; 
			$metadata['metakeywords'] = $this->data['c'][0]->keyword;	     	
			
			/*start var*/
			$config = array();
			//$config['base_url'] = 'https://www.stylior.com/home/shop_shirts_page/';	
			$config['base_url'] = $this->config->item('base_url_temp').'/mens-trousers';
			$config["total_rows"] = count($this->home_model->shop_suit(11));
			$config["uri_segment"] = 2;	
			$page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
			$config["per_page"] =20;
			$choice = $config["total_rows"] / $config["per_page"];
			$config["num_links"] = round($choice);    
			$data["details"] = $this->home_model->shop_suit_page(11,$page,$config["per_page"]);
			$this->pagination->initialize($config);          
			$data["links"] = $this->pagination->create_links(); 
			$this->load->helper('url');
			$this->output->enable_profiler(FALSE);
			$this->load->view('lum_header',$metadata);
			$this->load->view('trousers',$data);
			$this->load->view('lum_footer');
			/*emd var*/
	}
	
	public function shop_blazer($catid,$subcatid)
	{
		//echo $subcatid;die;
		// $this->load->model('home_model');
		// $this->data['details'] = $this->home_model->shop_suit(16);
		// $this->load->helper('url');
		// $this->output->enable_profiler(FALSE);
		// $this->load->view('lum_header');
		// $this->load->view('blazer',$this->data);
		// $this->load->view('lum_footer');
       //var started 
	   	$this->load->library('pagination');   	
    	$this->load->model('home_model');
		$this->data['metadata'] = $this->home_model->getCategoryInfo(16);
		$metadata['title'] = $this->data['c'][0]->title; 
		$metadata['metadescription'] = $this->data['c'][0]->description; 
		$metadata['metakeywords'] = $this->data['c'][0]->keyword;	     	
		/*start var*/
		$config = array();
		$url_to_paging = $this->config->item('base_url_temp');
		$current_url=$url_to_paging."mens-blazers";
		$config['base_url'] = $current_url;
		$config["total_rows"] = count($this->home_model->shop_suit(16));
		$config["uri_segment"] = 2;	
		$page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
		$config["per_page"] =20;
	    $choice = $config["total_rows"] / $config["per_page"];
	    $config["num_links"] = round($choice);    
	    $data["details"] = $this->home_model->shop_suit_page(16,$page,$config["per_page"]);
		$this->pagination->initialize($config);          
    	$data["links"] = $this->pagination->create_links(); 
     	$this->load->helper('url');
		$this->output->enable_profiler(FALSE);
		$this->load->view('lum_header',$metadata);
		$this->load->view('blazer',$data);
		$this->load->view('lum_footer');
       //var end
	}

	public function shop_vests($catid,$subcatid)
	{
			// $this->load->model('home_model');
			// $this->data['details'] = $this->home_model->shop_suit(18);;
			// $this->load->helper('url');
			// $this->output->enable_profiler(FALSE);
			// $this->load->view('lum_header');
			// $this->load->view('vests',$this->data);
			// $this->load->view('lum_footer');
			/*start  by var */		
			$this->load->library('pagination');   	
			$this->load->model('home_model');
			$this->data['metadata'] = $this->home_model->getCategoryInfo(18);
			$metadata['title'] = $this->data['c'][0]->title; 
			$metadata['metadescription'] = $this->data['c'][0]->description; 
			$metadata['metakeywords'] = $this->data['c'][0]->keyword;	     	
			/*start var*/
			$config = array();
			$url_to_paging = $this->config->item('base_url_temp');
			$current_url=$url_to_paging."mens-vests";
			$config['base_url'] = $current_url;
			$config["total_rows"] = count($this->home_model->shop_suit(18));
			$config["uri_segment"] = 2;	
			$page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
			$config["per_page"] =20;
			$choice = $config["total_rows"] / $config["per_page"];
			$config["num_links"] = round($choice);    
			$data["details"] = $this->home_model->shop_suit_page(18,$page,$config["per_page"]);
			$this->pagination->initialize($config);          
	  		$data["links"] = $this->pagination->create_links(); 
	  	    $this->load->helper('url');
			$this->output->enable_profiler(FALSE);
			$this->load->view('lum_header',$metadata);
			$this->load->view('vests',$data);
			$this->load->view('lum_footer');
			/*end var*/
    
    }

	/*****
	**21st Nov 2016 start VAR
	** get all desgined shirt / new arrival shirt details
	** subcategory id is 19
	*/
	public function shirt_new_arrival($catid,$subcatid)
	{	
			$this->load->model('home_model');
			$this->data['details'] = $this->home_model->shop_suit(19);	    
		    /*get meta data */
	     	$subcategory_details=$this->home_model->getCategoryInfo($subcatid);
			$metadata['title']=$subcategory_details->title;
	        $metadata['metadescription']=$subcategory_details->description;
	        $metadata['metakeywords']=$subcategory_details->keyword;
		    /*meta data end*/
    		$this->load->helper('url');
			$this->output->enable_profiler(FALSE);
			$this->load->view('lum_header',$metadata);
			$this->load->view('shirt-arrival',$this->data);
			$this->load->view('lum_footer');
	}

    public function shop($catid,$subcatid)
	{
		    $this->load->model('home_model');
			$page= $this->input->get('per_page') ? $this->input->get('per_page') : 0;
			$this->load->library('pagination');
			$url_to_paging = $this->config->item('base_url');
			$sizerange = '';

			if($this->input->get('size') != '')
			{
				$data['size'] = $this->input->get('size');
				if(count($data['size']) > 0){
					for($k='0';$k< count($data['size']); $k++){
						$sizerange .= 'size[]='.$data['size'][$k].'&';
					}
				}
			}
			else {
				$data['size'] = array();
			}

			$data['page'] = $this->input->get('page');
			$data['color'] = $this->input->get('color');
	        $data['size'] = $this->input->get('size');
			$data['designid'] = $this->input->get('designid');
			$data['fabricid'] = $this->input->get('fabricid');
	 	    $data['priceord'] = $this->input->get('priceord');
			if($data['page'] == '')
			{
				$data['page'] = $config['per_page'] = '9';
			}
			else
			{
				$data['page'] = $config['per_page'] = $this->input->get('page');

			}
		$pageno = $this->input->get('per_page');
		if($pageno == '')
		{
			$pageno = '0';
		}
		$perpage = '3';
		$this->data['image'] = $this->home_model->shop($catid,$subcatid,$config['per_page'],$pageno, $data);
		//echo "<pre>";
		//print_r($this->data['image']);die;
		$data['allproducts'] = $return['result'];
		$config['total_rows'] = $return['count'];
		$data['images'] = $return['images'];
		//echo "<pre>";
		//print_r($data['allproducts']);
		$this->pagination->initialize($config);
		//////////
		if(isset($_POST["designer"]))
		{
			$this->data['customize_type'] = "designer";

		}
		else if(isset($_POST["customize"]))
		{
				$this->data['customize_type'] = "customize";
		}
		$this->load->helper('url');
		$this->output->enable_profiler(FALSE);
		//$this->data['image'] = $this->home_model->shop($catid,$subcatid);
		$this->data['allcolor']=$this->home_model->allcolor();
		$this->data['alldesign'] = $this->home_model->alldesign($catid,$subcatid);
		$this->data['subcatid']=$subcatid;
		$this->data['catid']=$catid;
		//$this->data['images1'] = $return['images'];
		$this->load->view('header');
		$this->load->view('shop',$this->data);
		$this->load->view('footer');
	}

	public function shopnow($id,$catid,$subcatid)
	{


	  	$this->session->set_userdata('subcatid',$subcatid);
		// $this->load->helper('url');
		$this->output->enable_profiler(FALSE);
		$this->data['c'] = $this->home_model->shopnow($id,$catid,$subcatid);
		$_POST['catid']=9;
		$_POST['subcatid']=$_SESSION['subcatid'];
		$_POST['fit']=1;
		$this->data['datashirt'] = $this->home_model->shirtparts($_POST['catid'],$_POST['subcatid']);
		$this->data['shirt_sizes'] = $this->home_model->shirtparts($_POST['catid'],$_POST['subcatid']);
		$get_sizes = $this->Cart_model->sizedata($_POST['subcatid'],$_POST['fit']);
		$this->data['sizes'] =$get_sizes;
		$this->load->view('header');
		$this->load->view('shop-now',$this->data);
		$this->load->view('footer');


	}

	public function details_designer($pname)
	{

			$outss = preg_match_all('!\d+!', $pname, $matches);
			$this->data['base_url_temp']= $this->config->item('base_url_temp');
			$out = end(end($matches));
			$subcatid=19;
			$catid=10;
			$this->data['c'] = $this->home_model->shopnow($out,$catid,$subcatid);
			$metadata['title'] = $this->data['c'][0]->title;
			$metadata['metadescription'] = $this->data['c'][0]->metadescription;
			$metadata['metakeywords'] = $this->data['c'][0]->keywords;
    		$this->data['datashirt'] = $this->home_model->shirtparts($catid,$subcatid);
			$this->data['shirt_sizes'] = $this->home_model->shirtparts($catid,$subcatid);
			$get_sizes = $this->Cart_model->sizedata($subcatid,$_POST['fit']);
			$this->data['sizes'] =$get_sizes;
			$this->load->view('lum_header', $metadata);
			$this->load->view('details_designer_shirt',$this->data);
			$this->load->view('lum_footer');
	}

	public function details_shirt($pname)
	{

			$outss = preg_match_all('!\d+!', $pname, $matches);
			$this->data['base_url_temp']= $this->config->item('base_url_temp');
			$out = end(end($matches));
			$_SESSION['subcatid'] = 10;
			$subcatid=10;
			$catid=10;
			$f_data=$this->home_model->shopnow($out,$catid,$subcatid);
			foreach ($f_data as $value){
				$prodescr = $value->description;
				$prodimage = $value->image;		
			}
			$this->data['c'] = $this->home_model->shopnow($out,$catid,$subcatid);
			$metadata['fb_description']=$prodescr;
			$metadata['fb_image']=$prodimage;
			$metadata['title'] = $this->data['c'][0]->title;
			$metadata['metadescription'] = $this->data['c'][0]->metadescription;
			$metadata['metakeywords'] = $this->data['c'][0]->keywords;
			$this->data['datashirt'] = $this->home_model->shirtparts($catid,$subcatid);
			$this->data['shirt_sizes'] = $this->home_model->shirtparts($catid,$subcatid);
			$get_sizes = $this->Cart_model->sizedata($subcatid,$_POST['fit']);
			$this->data['sizes'] =$get_sizes;
			$this->load->view('lum_header',$metadata);
			$this->load->view('details_shirt',$this->data);
			$this->load->view('lum_footer');

	}

	public function details_trouser($pname)
	{

			$outss = preg_match_all('!\d+!', $pname, $matches);
			$this->data['base_url_temp']= $this->config->item('base_url_temp');
			$out = end(end($matches));
			$_SESSION['subcatid'] = 11;
			$subcatid=11;
			$catid=10;
			$f_data=$this->home_model->shopnow($out,$catid,$subcatid);
			foreach ($f_data as $value) {
			$prodescr = $value->description;
			$prodimage = $value->image;
			}

			$this->data['c'] = $this->home_model->shopnow($out,$catid,$subcatid);

			$metadata['fb_description']=$prodescr;
			$metadata['fb_image']=$prodimage;

			$metadata['title'] = $this->data['c'][0]->title;
			$metadata['metadescription'] = $this->data['c'][0]->metadescription;
			$metadata['metakeywords'] = $this->data['c'][0]->keywords;


			$this->data['datashirt'] = $this->home_model->shirtparts($catid,$subcatid);
			$this->data['shirt_sizes'] = $this->home_model->shirtparts($catid,$subcatid);
			$get_sizes = $this->Cart_model->sizedata($subcatid,$_POST['fit']);
			$this->data['sizes'] =$get_sizes;
			$this->load->view('lum_header', $metadata);
			$this->load->view('details_trouser',$this->data);
			$this->load->view('lum_footer');

	}

		public function details_tie($pname)
		{

			$outss = preg_match_all('!\d+!', $pname, $matches);
			$this->data['base_url_temp']= $this->config->item('base_url_temp');
			$out = end(end($matches));
			$_SESSION['subcatid'] = 12;
			$subcatid=12;
			$catid=10;
			$f_data=$this->home_model->shopnowacces($out,$catid,$subcatid);
			foreach ($f_data as $value) {
			$prodescr = $value->description;
			$prodimage = $value->image;
			}

			$this->data['c'] = $this->home_model->shopnowacces($out,$catid,$subcatid);

			$metadata['fb_description']=$prodescr;
			$metadata['fb_image']=$prodimage;

			$metadata['title'] = $this->data['c'][0]->title;
			$metadata['metadescription'] = $this->data['c'][0]->metadescription;
			$metadata['metakeywords'] = $this->data['c'][0]->keywords;
			$this->data['datashirt'] = $this->home_model->shirtparts($catid,$subcatid);
			$this->data['shirt_sizes'] = $this->home_model->shirtparts($catid,$subcatid);
			$get_sizes = $this->Cart_model->sizedata($subcatid,$_POST['fit']);
			$this->data['sizes'] =$get_sizes;
			$this->load->view('lum_header', $metadata);
			$this->load->view('details_ties',$this->data);
			$this->load->view('lum_footer');

		}

		public function details_cuff_links($pname)
		{

			$outss = preg_match_all('!\d+!', $pname, $matches);
			$this->data['base_url_temp']= $this->config->item('base_url_temp');
			$out = end(end($matches));
			$_SESSION['subcatid'] = 15;
			$subcatid=15;
			$catid=10;
			$f_data=$this->home_model->shopnowacces($out,$catid,$subcatid);
			foreach ($f_data as $value) {
			$prodescr = $value->description;
			$prodimage = $value->image;
			}
			$this->data['c'] = $this->home_model->shopnowacces($out,$catid,$subcatid);
			$metadata['title'] = $this->data['c'][0]->title;

			$metadata['fb_description']=$prodescr;
			$metadata['fb_image']=$prodimage;

			$metadata['metadescription'] = $this->data['c'][0]->metadescription;
			$metadata['metakeywords'] = $this->data['c'][0]->keywords;

			$this->data['datashirt'] = $this->home_model->shirtparts($catid,$subcatid);
			$this->data['shirt_sizes'] = $this->home_model->shirtparts($catid,$subcatid);
			$get_sizes = $this->Cart_model->sizedata($subcatid,$_POST['fit']);
			$this->data['sizes'] =$get_sizes;
			$this->load->view('lum_header',$metadata);
			$this->load->view('details_cuff_links',$this->data);
			$this->load->view('lum_footer');

		}


				public function details_suit($pname)
				{

					$outss = preg_match_all('!\d+!', $pname, $matches);
					$this->data['base_url_temp']= $this->config->item('base_url_temp');
					$out = end(end($matches));
					$_SESSION['subcatid'] = 17;
					$subcatid=17;
					$catid=10;
					$f_data=$this->home_model->shopnow($out,$catid,$subcatid);
					foreach ($f_data as $value) {
					$prodescr = $value->description;
					$prodimage = $value->image;
					}
					$this->data['c'] = $this->home_model->shopnow($out,$catid,$subcatid);
					$metadata['title'] = $this->data['c'][0]->title;
					$metadata['fb_description']=$prodescr;
					$metadata['fb_image']=$prodimage;
					$metadata['metadescription'] = $this->data['c'][0]->metadescription;
					$metadata['metakeywords'] = $this->data['c'][0]->keywords;
					$this->data['datashirt'] = $this->home_model->shirtparts($catid,$subcatid);
					$this->data['shirt_sizes'] = $this->home_model->shirtparts($catid,$subcatid);
					$get_sizes = $this->Cart_model->sizedata($subcatid,$_POST['fit']);
					$this->data['sizes'] =$get_sizes;
					$this->load->view('lum_header',$metadata);
					$this->load->view('details_suit',$this->data);
					$this->load->view('lum_footer');

				}
				public function details_vest($pname)
				{

					$outss = preg_match_all('!\d+!', $pname, $matches);
					$this->data['base_url_temp']= $this->config->item('base_url_temp');
					$out = end(end($matches));
					$_SESSION['subcatid'] = 18;
					$subcatid=18;
					$catid=10;
					$f_data=$this->home_model->shopnow($out,$catid,$subcatid);
					foreach ($f_data as $value) {
					$prodescr = $value->description;
					$prodimage = $value->image;
					}
					$this->data['c'] = $this->home_model->shopnow($out,$catid,$subcatid);
					$metadata['title'] = $this->data['c'][0]->title;

					$metadata['fb_description']=$prodescr;
					$metadata['fb_image']=$prodimage;

					$metadata['metadescription'] = $this->data['c'][0]->metadescription;
					$metadata['metakeywords'] = $this->data['c'][0]->keywords;

					$this->data['datashirt'] = $this->home_model->shirtparts($catid,$subcatid);
					$this->data['shirt_sizes'] = $this->home_model->shirtparts($catid,$subcatid);
					$get_sizes = $this->Cart_model->sizedata($subcatid,$_POST['fit']);
					$this->data['sizes'] =$get_sizes;
					$this->load->view('lum_header',$metadata);
					$this->load->view('details_vest',$this->data);
					$this->load->view('lum_footer');
				}
				public function details_blazer($pname)
				{

					$outss = preg_match_all('!\d+!', $pname, $matches);
					$this->data['base_url_temp']= $this->config->item('base_url_temp');
					$out = end(end($matches));
					$_SESSION['subcatid'] = 16;
					$subcatid=16;
					$catid=10;
					$f_data=$this->home_model->shopnow($out,$catid,$subcatid);
					foreach ($f_data as $value) {
					$prodescr = $value->description;
					$prodimage = $value->image;
					}
					$this->data['c'] = $this->home_model->shopnow($out,$catid,$subcatid);
					$metadata['title'] = $this->data['c'][0]->title;
					$metadata['fb_description']=$prodescr;
					$metadata['fb_image']=$prodimage;
					$metadata['metadescription'] = $this->data['c'][0]->metadescription;
					$metadata['metakeywords'] = $this->data['c'][0]->keywords;

					$this->data['datashirt'] = $this->home_model->shirtparts($catid,$subcatid);
					$this->data['shirt_sizes'] = $this->home_model->shirtparts($catid,$subcatid);
					$get_sizes = $this->Cart_model->sizedata($subcatid,$_POST['fit']);
					$this->data['sizes'] =$get_sizes;
					$this->load->view('lum_header',$metadata);
					$this->load->view('details_blazer',$this->data);
					$this->load->view('lum_footer');
				}



		public function lum_shopnow($pname)

		{
			//start shehjaz
			if (preg_match('/Shirt/',$pname)){
				$_SESSION['subcatid'] = 10;
			}

			else if (preg_match('/Trouser/',$pname)){
				$_SESSION['subcatid'] = 11;
			}
			else if (preg_match('/Tie/',$pname)) {
				$_SESSION['subcatid'] = 12;
			}
			else if (preg_match('/Cuff/',$pname)) {
				$_SESSION['subcatid'] = 15;
			}
			else if (preg_match('/Suit/',$pname)) {
				$_SESSION['subcatid'] = 17;
			}
			else if (preg_match('/Blazer/',$pname)) {
				$_SESSION['subcatid'] = 16;
			}
			else if (preg_match('/Vest/',$pname)) {
				$_SESSION['subcatid'] = 18;
			}
			// end shehjaz


			//echo $pname;die;
	    	//$out = substr(strstr($pname, '-'), strlen('-'));
			$outss = preg_match_all('!\d+!', $pname, $matches);
			$this->data['base_url_temp']= $this->config->item('base_url_temp');
			$out = end(end($matches));
			//$catid=9;
			$subcatid=$_SESSION['subcatid'];
			$catid=$_SESSION['catid'];

			$_POST['fit']=1;
			// $this->load->helper('url');
			$this->output->enable_profiler(FALSE);
				if($subcatid==12)   //its only for accessories..
 				{

					$this->data['c'] = $this->home_model->shopnowacces($out,$catid,$subcatid);
					$metadata['title'] = $this->data['c'][0]->title;
					$metadata['metadescription'] = $this->data['c'][0]->metadescription;
					$metadata['metakeywords'] = $this->data['c'][0]->keywords;

					$this->data['datashirt'] = $this->home_model->shirtparts($catid,$subcatid);
					$this->data['shirt_sizes'] = $this->home_model->shirtparts($catid,$subcatid);
					$get_sizes = $this->Cart_model->sizedata($subcatid,$_POST['fit']);
					$this->data['sizes'] =$get_sizes;
					$this->load->view('lum_header', $metadata);
					$this->load->view('details_ties',$this->data);
					$this->load->view('lum_footer');

				}

				else if($subcatid==15)   //its only for accessories..
 				{

					$this->data['c'] = $this->home_model->shopnowacces($out,$catid,$subcatid);
					$metadata['title'] = $this->data['c'][0]->title;
					$metadata['metadescription'] = $this->data['c'][0]->metadescription;
					$metadata['metakeywords'] = $this->data['c'][0]->keywords;

					$this->data['datashirt'] = $this->home_model->shirtparts($catid,$subcatid);
					$this->data['shirt_sizes'] = $this->home_model->shirtparts($catid,$subcatid);
					$get_sizes = $this->Cart_model->sizedata($subcatid,$_POST['fit']);
					$this->data['sizes'] =$get_sizes;
					$this->load->view('lum_header',$metadata);
					$this->load->view('details_cuff_links',$this->data);
					$this->load->view('lum_footer');

				}


				else if($subcatid==10)   //all other cat: like shirt and trouser.

				{

					$this->data['c'] = $this->home_model->shopnow($out,$catid,$subcatid);

					$metadata['title'] = $this->data['c'][0]->title;
					$metadata['metadescription'] = $this->data['c'][0]->metadescription;
					$metadata['metakeywords'] = $this->data['c'][0]->keywords;




					$this->data['datashirt'] = $this->home_model->shirtparts($catid,$subcatid);
					$this->data['shirt_sizes'] = $this->home_model->shirtparts($catid,$subcatid);
					$get_sizes = $this->Cart_model->sizedata($subcatid,$_POST['fit']);
					$this->data['sizes'] =$get_sizes;
					$this->load->view('lum_header',$metadata);
					$this->load->view('details_shirt',$this->data);
					$this->load->view('lum_footer');

				}

				else if($subcatid==11)   //all other cat: like shirt and trouser.

				{

					$this->data['c'] = $this->home_model->shopnow($out,$catid,$subcatid);
					$metadata['title'] = $this->data['c'][0]->title;
					$metadata['metadescription'] = $this->data['c'][0]->metadescription;
					$metadata['metakeywords'] = $this->data['c'][0]->keywords;

					$this->data['datashirt'] = $this->home_model->shirtparts($catid,$subcatid);
					$this->data['shirt_sizes'] = $this->home_model->shirtparts($catid,$subcatid);
					$get_sizes = $this->Cart_model->sizedata($subcatid,$_POST['fit']);
					$this->data['sizes'] =$get_sizes;

					$this->load->view('lum_header', $metadata);
					$this->load->view('details_trouser',$this->data);
					$this->load->view('lum_footer');

				}

				else if($subcatid==17)   //all other cat: like shirt and trouser.

				{

					$this->data['c'] = $this->home_model->shopnow($out,$catid,$subcatid);
					$metadata['title'] = $this->data['c'][0]->title;
					$metadata['metadescription'] = $this->data['c'][0]->metadescription;
					$metadata['metakeywords'] = $this->data['c'][0]->keywords;

					$this->data['datashirt'] = $this->home_model->shirtparts($catid,$subcatid);
					$this->data['shirt_sizes'] = $this->home_model->shirtparts($catid,$subcatid);
					$get_sizes = $this->Cart_model->sizedata($subcatid,$_POST['fit']);
					$this->data['sizes'] =$get_sizes;
					$this->load->view('lum_header',$metadata);
					$this->load->view('details_suit',$this->data);
					$this->load->view('lum_footer');

				}

				else if($subcatid==16)   //all other cat: like shirt and trouser.

				{

					$this->data['c'] = $this->home_model->shopnow($out,$catid,$subcatid);
					$metadata['title'] = $this->data['c'][0]->title;
					$metadata['metadescription'] = $this->data['c'][0]->metadescription;
					$metadata['metakeywords'] = $this->data['c'][0]->keywords;

					$this->data['datashirt'] = $this->home_model->shirtparts($catid,$subcatid);
					$this->data['shirt_sizes'] = $this->home_model->shirtparts($catid,$subcatid);
					$get_sizes = $this->Cart_model->sizedata($subcatid,$_POST['fit']);
					$this->data['sizes'] =$get_sizes;
					$this->load->view('lum_header',$metadata);
					$this->load->view('details_blazer',$this->data);
					$this->load->view('lum_footer');

				}

				else if($subcatid==18)   //all other cat: like shirt and trouser.

				{

					$this->data['c'] = $this->home_model->shopnow($out,$catid,$subcatid);
					$metadata['title'] = $this->data['c'][0]->title;
					$metadata['metadescription'] = $this->data['c'][0]->metadescription;
					$metadata['metakeywords'] = $this->data['c'][0]->keywords;

					$this->data['datashirt'] = $this->home_model->shirtparts($catid,$subcatid);
					$this->data['shirt_sizes'] = $this->home_model->shirtparts($catid,$subcatid);
					$get_sizes = $this->Cart_model->sizedata($subcatid,$_POST['fit']);
					$this->data['sizes'] =$get_sizes;
					$this->load->view('lum_header',$metadata);
					$this->load->view('details_vest',$this->data);
					$this->load->view('lum_footer');

				}

		}

		public function lum_shopnownew($pname)

		{

			//echo $pname;die;



		//$out = substr(strstr($pname, '-'), strlen('-'));





			$outss = preg_match_all('!\d+!', $pname, $matches);



			//print_r($matches);

			//echo $matchess = $matches['4'];

			//echo $matches[0][1];

			//echo $arr   = $array[count($matches)-1];



			  $out = end(end($matches));



			$catid=9;

			$subcatid=$_SESSION['subcatid'];

				$_POST['catid']=9;

			    $_POST['subcatid']=$_SESSION['subcatid'];

			   $_POST['fit']=1;

			// $this->load->helper('url');

				$this->output->enable_profiler(FALSE);

				$this->data['c'] = $this->home_model->shopnow_new($out,$catid,$subcatid);



			$this->data['datashirt'] = $this->home_model->shirtparts($_POST['catid'],$_POST['subcatid']);

			$this->data['shirt_sizes'] = $this->home_model->shirtparts($_POST['catid'],$_POST['subcatid']);

			$get_sizes = $this->Cart_model->sizedata($_POST['subcatid'],$_POST['fit']);



			$this->data['sizes'] =$get_sizes;



				$this->load->view('lum_header');

				$this->load->view('lum_shopnow_new',$this->data);

				$this->load->view('lum_footer');

		}

		public function shopnow_designer($id,$catid,$subcatid)

		{

			 $this->load->helper('url');

				$this->output->enable_profiler(FALSE);

				$this->data['c'] = $this->home_model->shopnow($id,$catid,$subcatid);

				$this->load->view('header');

				$this->load->view('designer_studio_prod',$this->data);

				$this->load->view('footer');

		}





	public function checkout()

	{

	//var_dump($_SESSION);

	 $this->load->helper('url');

	$this->load->view('header');

	if($this->session->userdata('user_id')=="")

	{

			redirect($this->config->item('base_url').'home/login');

	}

		$data = array();

		$data['err_msg'] = '';

		$data['all_address'] = $this->home_model->all_address();

		$data['allcountry'] = $this->home_model->allcountry();

		$data['deafaultadd'] = $this->home_model->deafaultadd();

		$data['title'] = 'Stylior.com';

		$data['keywords'] = '';

		$data['description'] = '';

		//echo "<pre>";

		//print_r($_data);



		$this->load->view('checkout',$data);

	   $this->load->view('footer');

	}

	public function review_order()
	{

			$id = $this->input->post('paymentmethod');

			if($this->session->userdata('user_id') == "")
			{

				redirect($this->config->item('base_url').'home/login');

			}

			else

			{

			//var_dump($_POST);

			$data = array();

			$data['err_msg'] = '';

			//echo $this->input->post('shippaddress');die;

			$this->session->set_userdata('shippaddress',$this->input->post('shippaddress'));

			$data['deafaultadd'] = $this->home_model->deafaultadd();
			redirect($this->config->item('base_url_temp').'bilship/payu/'.$id);

      	}
 }

	public function checkgiftdetails(){

		$cardnum = $this->input->post('cardnum');

		$pin = $this->input->post('pin');

		$res = $this->home_model->checkgiftdetails($cardnum,$pin);

		//echo $res;

		if($res != "" && count($res) >0){

				$date=$res->added_date;

				$day="180";

				$date1 = strtotime("+".$day." days", strtotime($date));



		$htm="<h2>Gift Voucher keyup:</h2>



 			  <div>Voucher Code : ".$res->code."</div><br/>

 			  <div>Voucher Price : ".$res->currency." ".$res->price."</div><br/>

			  <div>Voucher Date : ".$res->added_date."</div><br/>

			  <div>Expire Date : ".date("Y-m-d", $date1)."</div><br/>

			";

		}else{

			$htm = "<div>No Voucher keyup</div>";

		}

		//echo $htm;

		exit;

	 }

	 function corporate_recruit(){

		$company = $this->input->post('company');

		$email = $this->input->post('email');

		//$esitimated = $this->input->post('esitimated');

		$name = $this->input->post('name');

		//$last_name = $this->input->post('last_name');

		//$location = $this->input->post('location');

		$mobile = $this->input->post('mobile');

		//$purpose = $this->input->post('purpose');



		$message = "<h2>Corporate Recruitments For User ".$name."</h2>

					<div>Name : ".$name ."</div>



					<div>Mobile : ".$mobile." </div>

					<div>Email : ".$email." </div>



					<div>Location : ".$location ."</div>



					<div>Company : ".$company." </div>

					";



				$to = 'info@stylior.com';

				$subject  = 'Corporate Recruitments For User '.$first_name;

				$headers  = 'MIME-Version: 1.0' . "\r\n";

				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

				$headers .= 'From: Corporate Recruitments <'.$email.'>' . "\r\n" .

							'X-Mailer: PHP/' . phpversion();

 			 	mail($to, $subject, $message, $headers);

				//mail('amvi.milan@gmail.com', $subject, $message, $headers);

	}





		public function designerstudio($id)

		{

			 $this->load->helper('url');

				$this->output->enable_profiler(FALSE);

				$this->data['c'] = $this->home_model->shopnow($id);

				$this->load->view('header');

				$this->load->view('designer_studio_prod',$this->data);

				$this->load->view('footer');

		}

		public function getstyles()

		{

			$name = $_POST['name'];

			$styles = $this->User_model->getsavedstyles($name);

			//print_r(json_encode($styles));die;

		}

		public function getproducts()

		{

			$date = $_POST['date'];

			$styles = $this->User_model->getproducts($date);

			//print_r(json_encode($styles));die;

		}

		public function myaccount()

		{

			//echo "<pre>";

			//print_r($_SESSION);





			$id = $_SESSION['user_id'];

			//echo $name = $_POST['name'];

			 $this->load->helper('url');



				//$this->output->enable_profiler(FALSE);



				$this->load->view('header');



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



				$this->data['dashboard'] = $this->User_model->accountpage($id);

				$this->data['addressview'] = $this->User_model->addressview($id);

				$this->data['allcountry'] = $this->User_model->allcountry();

				$this->data['usermeasure'] = $this->User_model->measureview();

				$this->data['jointbl']=$this->User_model->jointbl($id);

				$this->data['savedstyle'] = $this->User_model->savedstyle($id);

				$this->data['mbrandname'] = $this->User_model->mbrandname($id);

				$this->data['mfitname'] = $this->User_model->mfitname($id);

				$this->data['fabricname'] = $this->User_model->fabricname($id);

				$this->data['msizename'] = $this->User_model->msizename($id);

				$this->data['getproname'] = $this->User_model->getproname($id);

				$this->data['bodypartname'] = $this->User_model->bodypartname($id);

				$this->data['order_details'] = $this->User_model->userorder($id);

				$this->data['wallet'] = $this->User_model->userwallet($id);

				$this->data['wishlist']=$this->User_model->wishlist($id);

                //$this->$data['addressview'] = $this->User_model->addressview();

                //$this->$data['userget'] = $this->account_model->userget($id);

				$data['saveprod'] = $return['result11'];



			//$this->data['saved'] = $this->User_model->savestylev($name);



				//$this->data['changev']=$this->User_model->changev($changev);

				//$this->data['userorder']=$this->User_model->userorder($id);

		        $this->load->view('myaccount',$this->data);





				$this->load->view('footer');





		}

		public function new_custom_demo($catid,$subcatid,$productid)

		{

			$this->session->set_userdata('catid',$catid);
			$this->session->set_userdata('subcatid',$subcatid);
			$this->session->set_userdata('productid',$productid);
		    $this->load->helper('url');
		    $this->data['shirtfabrics'] = $this->home_model->customdtata($catid,10);
			$this->data['pantfabrics'] = $this->home_model->customdtatapant($catid,11);
			$this->data['allfabrics'] = $this->home_model->allfabdtata();
			$this->data['collars'] = $this->home_model->allcollardata();
			$this->data['cuffs'] = $this->home_model->allcuffdata();
			$this->data['innercontrastfab'] = $this->home_model->allinnercontrastfab();
			$this->data['allbuttons'] = $this->home_model->allbuttons();
			$this->data['basefab'] = $this->home_model->getbasefab($productid);
			$this->data['productid'] =$productid;
			$this->data['subcatid'] =$subcatid;
			$this->data['catid'] =$catid;
            /*avr start*/
			$this->data['fabric_colors']= $this->home_model->allcolor();
    		$this->data['fabric_patterns']=$this->home_model->alldesign(1,2);
		    /*end avrt*/
			$this->load->view('lum_header.php');
			if($subcatid=="11")
			{
				 $this->load->view('new_3dcombined_pant',$this->data);
			}
			else
			{
			 $this->load->view('new_3dcombined_new',$this->data);

			}





		}




		public function new_custom($catid,$subcatid,$productid)
		{

			$this->session->set_userdata('catid',$catid);

			$this->session->set_userdata('subcatid',$subcatid);

			$this->session->set_userdata('productid',$productid);

		    $this->load->helper('url');

		    $this->data['shirtfabrics'] = $this->home_model->customdtata_demo($catid,10);

			$this->data['pantfabrics'] = $this->home_model->customdtatapant($catid,11);

			$this->data['allfabrics'] = $this->home_model->allfabdtata();

			$this->data['collars'] = $this->home_model->allcollardata();

			$this->data['cuffs'] = $this->home_model->allcuffdata();
			$this->data['innercontrastfab'] = $this->home_model->allinnercontrastfab();
			$this->data['allbuttons'] = $this->home_model->allbuttons();
			$this->data['basefab'] = $this->home_model->getbasefab($productid);
			$this->data['productid'] =$productid;
			$this->data['subcatid'] =$subcatid;
			$this->data['catid'] =$catid;

            /*avr start*/

			$this->data['fabric_colors']= $this->home_model->allcolor();
			$this->data['fabric_patterns']=$this->home_model->alldesign(1,2);
			//var added for pocket and placket listing... var start
  		    $this->data['allpockets'] = $this->home_model->allpockets();
			$this->data['allplackets'] = $this->home_model->allplackets();
			$this->data['allbacks'] = $this->home_model->allbacks();
			$this->data['allbottom'] = $this->home_model->allbottom();
			$this->data['allpiping'] = $this->home_model->allpiping();
			$this->data['allelbow'] = $this->home_model->allelbow();
			//var end
			$this->data['outercontrastfab'] = $this->home_model->alloutercontrastfab();
			$this->data['allbuttons'] = $this->home_model->allbuttons();
			$this->data['basefab'] = $this->home_model->getbasefab($productid);
			$this->data['productid'] =$productid;
			$this->data['subcatid'] =$subcatid;
			$this->data['catid'] =$catid;
		    /*end avrt*/



				$this->load->view('lum_header.php');

				if($subcatid=="11")

				{

				 $this->load->view('new_3dcombined_pant',$this->data);

				}

				else

				{

				 $this->load->view('new_3dcombined_demo',$this->data);



				}


		}



/*
	public function new_custom_3d($catid,$subcatid,$productid)
	{

			$this->session->set_userdata('catid',$catid);
			$this->session->set_userdata('subcatid',$subcatid);
			$this->session->set_userdata('productid',$productid);
		    $this->load->helper('url');
		    $this->data['shirtfabrics'] = $this->home_model->customdtata($catid,10);
			$this->data['pantfabrics'] = $this->home_model->customdtatapant($catid,11);
			$this->data['allfabrics'] = $this->home_model->allfabdtata();
			$this->data['collars'] = $this->home_model->allcollardata();
			$this->data['cuffs'] = $this->home_model->allcuffdata();
			$this->data['innercontrastfab'] = $this->home_model->allinnercontrastfab();
			$this->data['allbuttons'] = $this->home_model->allbuttons();
			$this->data['basefab'] = $this->home_model->getbasefab($productid);
			$this->data['productid'] =$productid;
			$this->data['subcatid'] =$subcatid;
			$this->data['catid'] =$catid;


			$this->data['fabric_colors']= $this->home_model->allcolor();
			$this->data['fabric_patterns']=$this->home_model->alldesign(1,2);




				$this->load->view('lum_header.php');

				if($subcatid=="11")

				{

				 $this->load->view('new_3dcombined_pant',$this->data);

				}

				else

				{

				 $this->load->view('new_3dcombined_new',$this->data);



				}





		}*/




		public function savemeasurement()

		{

			$this->load->library('session');

			$this->load->helper('url');

			$this->output->enable_profiler(FALSE);

			$cartdata = array(

					'styleid'    => $this->session->userdata('saveid'),

					'cqty'      => '1',

			);

				//print_r($cartdata);die;

			$this->session->set_userdata($cartdata);

			$this->load->view('header');

			$this->load->view('savemeasurement');

			$this->load->view('footer');

		}

		public function lum_saved_profile()

		{

			$this->load->library('session');

			$this->load->helper('url');

			$this->output->enable_profiler(FALSE);

			$cartdata = array(

					'styleid'    => $this->session->userdata('saveid'),

					'cqty'      => '1',

			);

				//print_r($cartdata);die;

			$this->session->set_userdata($cartdata);

			$this->load->view('lum_header');

			$this->load->view('lum_saved_profile');

			$this->load->view('lum_footer');



		}

		public function lum_saved_profile1()

		{

		    $this->load->library('session');

				$this->load->helper('url');

			$this->output->enable_profiler(FALSE);

			$cartdata = array(

					'styleid'    => $this->session->userdata('saveid'),

					'cqty'      => '1',

			);



			$this->session->set_userdata($cartdata);



			$this->load->view('lum_header');

			$this->load->view('lum_saved_profile1');

			$this->load->view('lum_footer');



		}

		public function lum_saved_profile2()

		{

			$this->load->library('session');

			$this->load->helper('url');
			$url_data = new stdClass(); //Creates a new empty object
    		$url_data->base_url_temp = $this->config->item('base_url_temp');

			$this->output->enable_profiler(FALSE);

			$cartdata = array(

					'styleid'    => $this->session->userdata('saveid'),

					'cqty'      => '1',

			);

            $data=array(
                  'base_url_temp'  =>$base_url_temp,
	            );
				//print_r($cartdata);die;

			$this->session->set_userdata($cartdata);

			$this->load->view('lum_header');

			$this->load->view('lum_saved_profile2',$url_data);

			$this->load->view('lum_footer');



		}



		public function lum_saved_profile3()

		{

			$this->load->library('session');

			$this->load->helper('url');

			$this->output->enable_profiler(FALSE);

			$cartdata = array(

					'styleid'    => $this->session->userdata('saveid'),

					'cqty'      => '1',

			);



			if($this->session->userdata('user_id') == '')

			{

				redirect($this->config->item('base_url'),'refresh');

			}





			//echo "<pre>";

			//print_r( $this->session);die;

			$data = array();

			$data['style_id'] =  $style_id;

			$data['L_strErrorMessage'] = "";

			$data['err_msg'] = "";

			$data['metricft']=$this->input->post('foot');

			$data['metricinch']=$this->input->post('inch');

			$data['weight']=$this->input->post('weight');

			$data['impheight']=$this->input->post('impheight');

			$data['impweight']=$this->input->post('impweight');

			$data['style_id']= $this->session->userdata('styleid');

			$data['pid'] = $this->session->userdata('prodid');

		//echo "<pre>";

	//print_r($data);die;

			//echo $this->session->userdata('measuredid');

			if($this->session->userdata('measuredid') ==""){



				$this->Cart_model->insertbodymeasure($data);

				$lastinsertid=$this->db->insert_id();

				$this->session->set_userdata('measuredid',$lastinsertid);

			} else {



				$this->Cart_model->insertbodymeasure($data);



			}

			//echo $this->session->userdata('measuredid');die;





				//print_r($cartdata);die;

			$this->session->set_userdata($cartdata);

			$this->load->view('lum_header');

			$this->load->view('lum_saved_profile3');

			$this->load->view('lum_footer');



		}

		public function lum_saved_profile4()

		{

			$this->load->library('session');

			$this->load->helper('url');

			$this->output->enable_profiler(FALSE);

			$cartdata = array(

					'styleid'    => $this->session->userdata('saveid'),

					'cqty'      => '1',

			);

				//print_r($cartdata);die;

			$this->session->set_userdata($cartdata);

			$this->load->view('lum_header');

			$this->load->view('lum_saved_profile4');

			$this->load->view('lum_footer');



		}

		public function lum_saved_profile5()

		{

			$this->load->library('session');

			$this->load->helper('url');

			$this->output->enable_profiler(FALSE);

			$cartdata = array(

					'styleid'    => $this->session->userdata('saveid'),

					'cqty'      => '1',

			);

				//print_r($cartdata);die;

			$this->session->set_userdata($cartdata);

			$this->load->view('lum_header');

			$this->load->view('lum_saved_profile5');

			$this->load->view('lum_footer');



		}

		public function lum_saved_profile6()

		{

			$this->load->library('session');

			$this->load->helper('url');

			$this->output->enable_profiler(FALSE);

			$cartdata = array(

					'styleid'    => $this->session->userdata('saveid'),

					'cqty'      => '1',

			);



			if($this->session->userdata('user_id') == '')

			{

				redirect($this->config->item('base_url'),'refresh');

			}





			//echo "<pre>";

			//print_r( $this->session);die;

			$data = array();

			$data['style_id'] =  $style_id;

			$data['L_strErrorMessage'] = "";

			$data['err_msg'] = "";

			$data['metricft']=$this->input->post('foot');

			$data['metricinch']=$this->input->post('inch');

			$data['weight']=$this->input->post('weight');

			$data['impheight']=$this->input->post('impheight');

			$data['impweight']=$this->input->post('impweight');

			$data['style_id']= $this->session->userdata('styleid');

			$data['pid'] = $this->session->userdata('prodid');

		//echo "<pre>";

	//print_r($data);die;

			//echo $this->session->userdata('measuredid');

			if($this->session->userdata('measuredid') ==""){



				$this->Cart_model->insertbodymeasure($data);

				$lastinsertid=$this->db->insert_id();

				$this->session->set_userdata('measuredid',$lastinsertid);

			} else {



				$this->Cart_model->insertbodymeasure($data);



			}















				//print_r($cartdata);die;

			$this->session->set_userdata($cartdata);

			$this->load->view('lum_header');

			$this->load->view('lum_saved_profile6');

			$this->load->view('lum_footer');



		}

		public function lum_saved_profile7()

		{

			$this->load->library('session');

			$this->load->helper('url');

			$this->output->enable_profiler(FALSE);

			$cartdata = array(

					'styleid'    => $this->session->userdata('saveid'),

					'cqty'      => '1',

			);



			if($this->session->userdata('user_id') == '')

			{

				redirect($this->config->item('base_url'),'refresh');

			}





			//echo "<pre>";

			//print_r( $this->session);die;

			$data = array();

			$data['style_id'] =  $style_id;

			$data['L_strErrorMessage'] = "";

			$data['err_msg'] = "";

			$data['metricft']=$this->input->post('foot');

			$data['metricinch']=$this->input->post('inch');

			$data['weight']=$this->input->post('weight');

			$data['impheight']=$this->input->post('impheight');

			$data['impweight']=$this->input->post('impweight');

			$data['style_id']= $this->session->userdata('styleid');

			$data['pid'] = $this->session->userdata('prodid');

		//echo "<pre>";

	//print_r($data);die;

			//echo $this->session->userdata('measuredid');

			if($this->session->userdata('measuredid') ==""){



				$this->Cart_model->insertbodymeasure($data);

				$lastinsertid=$this->db->insert_id();

				$this->session->set_userdata('measuredid',$lastinsertid);

			} else {



				$this->Cart_model->insertbodymeasure($data);



			}

				//print_r($cartdata);die;

			$this->session->set_userdata($cartdata);

			$this->load->view('lum_header');

			$this->load->view('lum_saved_profile7');

			$this->load->view('lum_footer');



		}

		public function lum_saved_profile8()

		{

			$this->load->library('session');

			$this->load->helper('url');

			$this->output->enable_profiler(FALSE);

			$cartdata = array(

					'styleid'    => $this->session->userdata('saveid'),

					'cqty'      => '1',

			);

				//print_r($cartdata);die;

			$this->session->set_userdata($cartdata);

			$this->load->view('lum_header');

			$this->load->view('lum_saved_profile8');

			$this->load->view('lum_footer');



		}

		public function lum_saved_profile9()

		{

			$this->load->library('session');

			$this->load->helper('url');

			$this->output->enable_profiler(FALSE);

			$cartdata = array(

					'styleid'    => $this->session->userdata('saveid'),

					'cqty'      => '1',

			);

				//print_r($cartdata);die;

			$this->session->set_userdata($cartdata);

			$this->load->view('lum_header');

			$this->load->view('lum_saved_profile9');

			$this->load->view('lum_footer');



		}

		public function lum_saved_profile10()

		{

			$this->load->library('session');

			$this->load->helper('url');

			$this->output->enable_profiler(FALSE);

			$cartdata = array(

					'styleid'    => $this->session->userdata('saveid'),

					'cqty'      => '1',

			);

			if($this->session->userdata('user_id') == '')

			{

				redirect($this->config->item('base_url'),'refresh');

			}





			//echo "<pre>";

			//print_r( $this->session);die;

			$data = array();

			$data['style_id'] =  $style_id;

			$data['L_strErrorMessage'] = "";

			$data['err_msg'] = "";

			$data['metricft']=$this->input->post('foot');

			$data['metricinch']=$this->input->post('inch');

			$data['weight']=$this->input->post('weight');

			$data['impheight']=$this->input->post('impheight');

			$data['impweight']=$this->input->post('impweight');

			$data['style_id']= $this->session->userdata('styleid');

			$data['pid'] = $this->session->userdata('prodid');

		//echo "<pre>";

	//print_r($data);die;

			//echo $this->session->userdata('measuredid');

			if($this->session->userdata('measuredid') ==""){



				$this->Cart_model->insertbodymeasure($data);

				$lastinsertid=$this->db->insert_id();

				$this->session->set_userdata('measuredid',$lastinsertid);

			} else {



				$this->Cart_model->insertbodymeasure($data);



			}

				//print_r($cartdata);die;

			$this->session->set_userdata($cartdata);

			$this->load->view('lum_header');

			$this->load->view('lum_saved_profile10');

			$this->load->view('lum_footer');



		}



		public function lum_saved_profile11()

		{

			$this->load->library('session');

			$this->load->helper('url');

			$this->output->enable_profiler(FALSE);

			$cartdata = array(

					'styleid'    => $this->session->userdata('saveid'),

					'cqty'      => '1',

			);

				//print_r($cartdata);die;

			$this->session->set_userdata($cartdata);

			$this->load->view('lum_header');

			$this->load->view('lum_saved_profile11');

			$this->load->view('lum_footer');



		}

		public function lum_saved_profile12()

		{

			$this->load->library('session');

			$this->load->helper('url');

			$this->output->enable_profiler(FALSE);

			$cartdata = array(

					'styleid'    => $this->session->userdata('saveid'),

					'cqty'      => '1',

			);

				//print_r($cartdata);die;

			$this->session->set_userdata($cartdata);

			$this->load->view('lum_header');

			$this->load->view('lum_saved_profile12');

			$this->load->view('lum_footer');



		}

		public function lum_saved_profile13()

		{

			$this->load->library('session');

			$this->load->helper('url');

			$this->output->enable_profiler(FALSE);

			$cartdata = array(

					'styleid'    => $this->session->userdata('saveid'),

					'cqty'      => '1',

			);

				//print_r($cartdata);die;

			$this->session->set_userdata($cartdata);

			$this->load->view('lum_header');

			$this->load->view('lum_saved_profile13');

			$this->load->view('lum_footer');



		}

		public function lum_saved_profile14()

		{

			$this->load->library('session');

			$this->load->helper('url');

			$this->output->enable_profiler(FALSE);

			$cartdata = array(

					'styleid'    => $this->session->userdata('saveid'),

					'cqty'      => '1',

			);

				//print_r($cartdata);die;

			$this->session->set_userdata($cartdata);

			$this->load->view('lum_header');

			$this->load->view('lum_saved_profile14');

			$this->load->view('lum_footer');



		}

		public function lum_saved_profile15()

		{

			$this->load->library('session');

			$this->load->helper('url');

			$this->output->enable_profiler(FALSE);

			$cartdata = array(

					'styleid'    => $this->session->userdata('saveid'),

					'cqty'      => '1',

			);

				//print_r($cartdata);die;

			$this->session->set_userdata($cartdata);

			$this->load->view('lum_header');

			$this->load->view('lum_saved_profile15');

			$this->load->view('lum_footer');



		}

		public function lum_saved_profile16()

		{

			$this->load->library('session');

			$this->load->helper('url');

			$this->output->enable_profiler(FALSE);

			$cartdata = array(

					'styleid'    => $this->session->userdata('saveid'),

					'cqty'      => '1',

			);

				//print_r($cartdata);die;

			$this->session->set_userdata($cartdata);

			$this->load->view('lum_header');

			$this->load->view('lum_saved_profile16');

			$this->load->view('lum_footer');



		}

		public function lum_saved_profile17()

		{

			$this->load->library('session');

			$this->load->helper('url');

			$this->output->enable_profiler(FALSE);

			$cartdata = array(

					'styleid'    => $this->session->userdata('saveid'),

					'cqty'      => '1',

			);

				//print_r($cartdata);die;

			$this->session->set_userdata($cartdata);

			$this->load->view('lum_header');

			$this->load->view('lum_saved_profile17');

			$this->load->view('lum_footer');



		}

		public function lum_saved_profile18()

		{

			$this->load->library('session');

			$this->load->helper('url');

			$this->output->enable_profiler(FALSE);

			$cartdata = array(

					'styleid'    => $this->session->userdata('saveid'),

					'cqty'      => '1',

			);

				//print_r($cartdata);die;

			$this->session->set_userdata($cartdata);

			$this->load->view('lum_header');

			$this->load->view('lum_saved_profile18');

			$this->load->view('lum_footer');



		}

		public function lum_my_account()
		{
			//ini_set('display_errors', 1);
			$id = $_SESSION['user_id'];
			$this->load->library('session');
			$this->load->helper('url');
			$this->output->enable_profiler(FALSE);
			$cartdata = array(
			'styleid'    => $this->session->userdata('saveid'),
			'cqty'      => '1',
			);
			//print_r($cartdata);die;
			$this->session->set_userdata($cartdata);
			$this->load->view('lum_header');
			$this->data['dashboard'] = $this->User_model->accountpage($id);
			$this->data['addressview'] = $this->User_model->addressview($id);
			$this->data['allcountry'] = $this->User_model->allcountry();
			$this->data['usermeasure'] = $this->User_model->measureview();
			$this->data['jointbl']=$this->User_model->jointbl($id);
			$this->data['savedstyle'] = $this->User_model->savedstyle($id);
			$this->data['mbrandname'] = $this->User_model->mbrandname($id);
			$this->data['mfitname'] = $this->User_model->mfitname($id);
			$this->data['fabricname'] = $this->User_model->fabricname($id);
			$this->data['msizename'] = $this->User_model->msizename($id);
			$this->data['getproname'] = $this->User_model->getproname($id);
			$this->data['bodypartname'] = $this->User_model->bodypartname($id);
			$this->data['order_details'] = $this->User_model->userorder($id);
			
			//print_r($this->User_model->userorder($id));
			foreach ($this->User_model->userorder($id) as $key => $value) {
					if(isset($value->order_id)) {
					$order_id=$value->order_id;
					$data_order_item=$this->Bilship_model->getciorderitemdetail($order_id);
					$data_nor_shirt=json_decode($data_order_item[0]->details3d);
					
					//print_r($data_nor_shirt->product_details_page);

					if(isset($data_nor_shirt->product_details_page)){
						$this->data['order_item_details'][$order_id] = $data_order_item;
								// print_r($data[0]->product_id);
								$img_name=$this->getProductImageByPid($data_order_item[0]->product_id);

								$this->data['image_of_product_nor'][$order_id]=$img_name[0]->image;

                        }
					else if(isset($data_order_item[0]->save3d)){
						$this->data['order_item_details'][$order_id] = $data_order_item;
						$save3d=$data_order_item[0]->save3d - 1;
						$img_data=$this->User_model->savestylebyid($save3d);		
						if(isset($img_data[0]->baseimage)){
							$this->data['image_of_product'][$order_id]=$img_data[0]->baseimage;
						}

					}

				}
			}
			$this->data['wallet'] = $this->User_model->userwallet($id);
			$this->data['wishlist']=$this->User_model->wishlist($id);
			$this->data['savedstyle']=$this->User_model->savedstyle($id);
			$this->load->view('lum_my_account',$this->data);
			$this->load->view('lum_footer');

		}






		public function lum_pop_ups()
		{

			$this->load->library('session');
			$this->load->helper('url');
			$this->output->enable_profiler(FALSE);
			$cartdata = array(
					'styleid'    => $this->session->userdata('saveid'),
					'cqty'      => '1',
			);

				//print_r($cartdata);die;

			$this->session->set_userdata($cartdata);
			$this->load->view('lum_header');
			$this->load->view('lum_pop_ups');
			//////////////////////
			//var_dump($_SESSION);
		$this->load->helper('url');
		$this->load->view('header');
		if($this->session->userdata('user_id')=="")
		{

			redirect($this->config->item('base_url').'home/login');

		}

		$data = array();
		$data['err_msg'] = '';

		$data['all_address'] = $this->home_model->all_address();

		$data['allcountry'] = $this->home_model->allcountry();

		$data['deafaultadd'] = $this->home_model->deafaultadd();

		$data['title'] = 'Stylior.com';

		$data['keywords'] = '';

		$data['description'] = '';

		//echo "<pre>";

		//print_r($_data);



		$this->load->view('checkout',$data);

	   $this->load->view('footer');



		}

		public function lum_check_out()

		{

			error_reporting(1);
			ini_set('display_errors,1');
			$this->load->library('session');
			$this->load->helper('url');
			$this->output->enable_profiler(FALSE);
			$cartdata = array(
					'styleid'    => $this->session->userdata('saveid'),
					'cqty'      => '1',
			);
			$data = array();
			$data['err_msg'] = '';
			$data['all_address'] = $this->home_model->all_address();
			$data['allcountry'] = $this->home_model->allcountry();
			$data['deafaultadd'] = $this->home_model->deafaultadd();
			$data['title'] = 'Stylior.com';
			$data['keywords'] = '';
	   	    $data['description'] = '';
	    	$this->session->set_userdata($cartdata);
			$this->load->view('lum_header');
			$this->load->view('lum_check_out',$data);
			$this->load->view('lum_footer');

		}






		public function lum_shop_new($catid,$subcatid)
		{

			$this->load->model('home_model');

			$page= $this->input->get('per_page') ? $this->input->get('per_page') : 0;

			$this->load->library('pagination');

			$url_to_paging = $this->config->item('base_url');

			$sizerange = '';

			if($this->input->get('size') != '')

			{

				$data['size'] = $this->input->get('size');



				if(count($data['size']) > 0){

					for($k='0';$k< count($data['size']); $k++){

						$sizerange .= 'size[]='.$data['size'][$k].'&';

					}

				}



			}

			else {

				$data['size'] = array();

			}



		$data['page'] = $this->input->get('page');
		$data['color'] = $this->input->get('color');
        $data['size'] = $this->input->get('size');
		$data['designid'] = $this->input->get('designid');
		$data['fabricid'] = $this->input->get('fabricid');
    	$data['priceord'] = $this->input->get('priceord');
		if($data['page'] == '')
		{

			$data['page'] = $config['per_page'] = '9';

		}
		else
		{

			$data['page'] = $config['per_page'] = $this->input->get('page');

		}
		$pageno = $this->input->get('per_page');
		if($pageno == '')
		{
			$pageno = '0';
		}
		$perpage = '3';
		//	$config['base_url'] = $url_to_paging.'home/shop/9/10?per_page='.$page.'&color='.$this->input->get('color').'&design='.$this->input->get('designid').'&'.$sizerange;
		//echo "<pre>";
		//print_r($config);
		//$config['base_url'] = $url_to_paging.'home/lists/?per_page='.$page.'&color'.$this->input->get('color').'&design='.$this->input->get('designid').'&'.$sizerange;
		//$return = $this->home_model->allproductsNew();
		$this->data['image'] = $this->home_model->shop_new($catid,$subcatid,$config['per_page'],$pageno, $data);
		//echo "<pre>";
		//print_r($this->data['image']);die;
		$data['allproducts'] = $return['result'];
		$config['total_rows'] = $return['count'];
		$data['images'] = $return['images'];
		//echo "<pre>";
		//print_r($data['allproducts']);
		$this->pagination->initialize($config);
		//////////
		if(isset($_POST["designer"]))
		{

				$this->data['customize_type'] = "designer";

		}
		else if(isset($_POST["customize"]))
		{
			$this->data['customize_type'] = "customize";
		}

	    $this->load->helper('url');
		$this->output->enable_profiler(FALSE);
		//$this->data['image'] = $this->home_model->shop($catid,$subcatid);
		$this->data['allcolor']=$this->home_model->allcolor();
		$this->data['alldesign'] = $this->home_model->alldesign();
		$this->data['subcatid']=$subcatid;
	   	$this->data['catid']=$catid;
		//$this->data['images1'] = $return['images'];
		$this->load->view('lum_header');
		$this->load->view('lum_shop_new',$this->data);
		$this->load->view('lum_footer');

	}

	public function savemeasurementtrial()
	{

			error_reporting(E_ALL);
			ini_set('display_errors',1);
			$this->load->library('session');
			$this->load->helper('url');
			$this->output->enable_profiler(FALSE);
			$this->load->library('user_agent');
			$cartdata = array
			(
 				'styleid'    => $this->session->userdata('saveid'),
				'cqty'      => '1',
			);
     		$bag = $this->cart->contents();
	 	 	$adddate;
		  	$data['userid'] = $this->session->userdata('user_id');
		  	foreach ($bag as $item)
		   	{

		      $data['pid'] = str_replace("STY","",$item['id']);
 			  $sql = "SELECT DISTINCT `added_date` FROM `mycart` WHERE `userid` = '".$data['userid']."' AND `pid` = '".$item['id']."' LIMIT 0 , 1";
			$query = $this->db->query($sql);
		    $result = $query->result();
		    if (!empty($result))
			{
			$adddate=$result[0]->added_date;
			$data['style_id'] = 47;
			$data['added_date'] = $adddate;
			}
  		   if(!empty($adddate))
   		    {

			   $check = $this->account_model->add_wishlist($data);
			  // echo var_dump($check);
 		      //removing cart item in Bag
			 $data1 = array(
             'rowid'   => $item['rowid'],
             'qty'     => 0
              );
             $this->cart->update($data1);
			 $this->Cart_model->removeproductcart($item['id']);
		    }

           }



}









	public function trialshirt()

	{

		$this->load->helper('url');

		$this->load->view('header');

		$sql = "SELECT * from tbl_product where is_trail_shirt = 1";

		$query = $this->db->query($sql);

		$result = $query->result();

		$data['productInfo']=(array)$result['0'];

		//echo $data['productInfo'];die;



		$resultTrial = $this->home_model->trailshirtinfo();

		//print_r($resultTrial);die;

		$data['trialshirtInfo']=(array)$resultTrial['0'];
    		// $url_data->base_url_temp = $this->config->item('base_url_temp');

		$sql = "SELECT * from tbl_product_image where pid=".$result['0']->id;

		//echo $sql;die;

		$query1 = $this->db->query($sql);

		$result1 = $query1->result();



		foreach($result1 as $index =>$product)

		{

			if($product->baseimage==1){

				$base_images[$product->pid]=$product->image;

			}else{

				$product_images[$product->pid][]=$product->image;

			}

		}

		//echo $base_images[$product->pid];die;

		//echo $product_images[$product->pid][];die;

		$data['baseImage']=$base_images;

		$data['images']=$product_images;

		//echo $data['baseImage'];die;

		//echo '<pre>';	print_r($data['images']);

	   if ($this->session->userdata('user_id') > 0)

		{

		$sql1 = "SELECT COUNT(*) AS ordcount  FROM `ci_orders` WHERE `user_id` = '".$this->session->userdata('user_id')."'";



		$query = $this->db->query($sql1);



		if ($query->num_rows() > 0)

		{

		    $result = $query->result();



		  $ordcont=$result[0]->ordcount;





			if($ordcont>0)

			{

				echo "<script>

					alert('trail shirt not applicable ');



						window.location.href='<?=base_url() ?>;

					</script>" ;

				$data['ordcount']=$ordcont;

					//var_dump($_SESSION);

		      //die;

			}



		}

		}

		$this->load->view('trialshirt',$data);

        $this->load->view('footer');

	}



	function changecurrency()

	{

		$val = $_POST['val'];

	 	$from = 'INR';

		$to = $val;

		$amount = '1';

 		if($val != "INR") {

			$from = $val;

			$to = 'INR';

			$amount = '1';

			$cvalue = $this->convertCurrency($amount, $from, $to);

			$this->session->set_userdata('currencyvalue',$cvalue);

			$this->session->set_userdata('currencycode',$val);



		} else {

			$this->session->set_userdata('currencyvalue','1');

			$this->session->set_userdata('currencysymbol','Rs');

			$this->session->set_userdata('currencycode','INR');

		}



	}

	function giftcarddefaultvalchg(){

		$giftcarddefaultvalchg = $this->home_model->giftcarddefaultvalchg($this->input->post('cuurencyid'));

		echo $giftcarddefaultvalchg->default_value.'@'.$giftcarddefaultvalchg->incremental_val;



	}

	function changenewcurrency(){

		 $val = $_POST['val'];

	 	$from = 'INR';

		$to = $val;

		$amount = '1';

	 	if($val != "INR") {

				//echo 'hi';die;

			$from = $val;

			$to = 'INR';

			$amount = '1';

			$c = $this->home_model->changecurrency($val); //$this->convertCurrency($amount, $from, $to);

			$cvalue = $c->stylior_roc;

 			$multiplier = $c->multiplier;

			$ceiling = $c->ceiling;



			$this->session->set_userdata('currencyvalue',$cvalue);

			$this->session->set_userdata('currencycode',$val);

			$this->session->set_userdata('multiplier',$multiplier);

			$this->session->set_userdata('ceiling',$ceiling);



			 $_SESSION['currencyvalue'] = $cvalue;

			  $_SESSION['currencycode'] = $val;

			$_SESSION['multiplier'] = $multiplier;

			$_SESSION['ceiling'] = $ceiling;



		} else {



			$this->session->set_userdata('currencyvalue','1');

			$this->session->set_userdata('currencysymbol','Rs');

			$this->session->set_userdata('currencycode','INR');

			$_SESSION['currencyvalue'] = '1';

			$_SESSION['currencycode'] = 'INR';



		}

	}



	function convertCurrency($amount, $from, $to){

		//echo $amount;

		$url  = "https://www.google.com/finance/converter?a=$amount&from=$from&to=$to";

		$data = file_get_contents($url);

		preg_match("/<span class=bld>(.*)<\/span>/",$data, $converted);

		$converted = preg_replace("/[^0-9.]/", "", $converted[1]);

		//echo round($converted, 3);

		return round($converted, 3);

	}

	public function giftcard()

	{



                $this->load->view('header');

				$this->load->helper('url');

				$this->output->enable_profiler(FALSE);

				$data = array();

				$data['L_strErrorMessage'] = "";

				$data['err_msg'] = "";

				$data['email']="";

				$data['title'] = 'Gift card - Stylior.com';

				$data['keywords'] = '';



				$data['title'] = 'Stylior.com';

				$data['description'] = '';

				$data['giftcardtheme'] = $this->home_model->giftcard_theme();

				$data['affliliatecontent'] = $this->home_model->affiliate_content();

				$data['allcurrency'] = $this->home_model->allcurrency();

		// for currency wise get incremental_val ,default_value

		if($this->session->userdata('currencycode') != ""){

			$data['inc_default_val'] = $this->home_model->currency_inc_default_val();

		}

		$this->load->view('giftcard',$data);

                $this->load->view('footer');



	}

		public function lum_giftcard()

	{



                $this->load->view('lum_header');

				$this->load->helper('url');

				$this->output->enable_profiler(FALSE);



				$this->load->view('lum_giftcard');

                $this->load->view('lum_footer');



	}





	public function whystylior()

	{

		$this->load->helper('url');

		$this->output->enable_profiler(FALSE);



                $this->load->view('header');

				$this->data['c'] = $this->home_model->gcontent();  // calling model method gcontent()

				$this->load->view('whystylior',$this->data);      //load the view file , we are passing $data array to view file

				//$this->load->view('whystylior');

                $this->load->view('footer');



	}

	public function fitgurantee()

	{

		$this->load->helper('url');

		$this->output->enable_profiler(FALSE);



				$this->load->view('header');

				$this->data['g']=$this->home_model->guarantee();

				$this->load->view('fitgurantee',$this->data);

                $this->load->view('footer');



	}

	public function auth()
	{
		$this->load->library('session');
		$this->load->helper('url');
		$this->output->enable_profiler(FALSE);
 	    //$this->load->library('session');
		$_SESSION['usertype']="Normal";
		//echo $_SESSION['user_id'] ;
		$this->load->model('User_model');
		$is_valid_user=$this->User_model->login($_POST['email'],$_POST['password']);
		if($is_valid_user)
		{
			$this->session->set_userdata("user_info",$is_valid_user[0]);
			$_SESSION['user_id']      = (int)$is_valid_user[0]->id;
			$_SESSION['username']     = (string)$is_valid_user[0]->username;
			$_SESSION['logged_in']    = (bool)true;
			$_SESSION['email'] = $is_valid_user[0]->email;
    
    		$newuserdata = array(
				'username'  => (int)$is_valid_user[0]->id,
				'userid'    => (string)$is_valid_user[0]->username,
				'email'     =>$is_valid_user[0]->email ,
				'logged_in' => true
			);

			//print_r($newuserdata);
			$check = $this->session->set_userdata($newuserdata);
			$cartdata = $this->User_model->cartdata($_SESSION['user_id']);
			if($cartdata != '' && count($cartdata) > 0)
			{
				foreach($cartdata as $cd){
					$optionarr = json_decode($cd->options);
					foreach($optionarr as $key=>$value) {
						$optionarr1[$key] = $value;
					}
					$data['cartprod'] = array(
					   'id'      => $cd->pid,
					   'qty'     => $cd->qty,
					   'price'   => $cd->price,
					   'name'    => $cd->pname,
					   'options' => $optionarr1
					);
					//print_r($data);
					$this->cart->insert($data);
				}
			}
			// redirecting to add cart function based on 3d data selection  -- 
			/*
			if(empty($_SESSION['selected3dInfo_shirt'])&& isset($_SESSION['selected3dInfo_shirt']) && !empty($_SESSION['selected3dInfo_shirt'])){
				$_SESSION['ordertype']="shirt";
   				redirect($this->config->item('base_url_temp').'Cart/addToCartShirt', 'location') ;
			}		
			else */
			if(isset($_SESSION['standard_measurement']))
			{		

					//$_SESSION['standard_measurement']['user_id']
					$_SESSION['standard_measurement']['userid']=$_SESSION['user_id'];
					redirect($this->config->item('base_url_temp').'Cart/updatecart', 'location');

			}
			else if(isset($_SESSION['selected3dInfo_pant']) && !empty($_SESSION['selected3dInfo_pant'])&& isset($_SESSION['selected3dInfo_shirt']) && !empty($_SESSION['selected3dInfo_shirt'])){
				
				$_SESSION['ordertype']="both";
   				redirect($this->config->item('base_url_temp').'Cart/addToCartTrouser', 'location');

			}
			else if(isset($_SESSION['selected3dInfo_shirt']) && !empty($_SESSION['selected3dInfo_shirt'])) {
			    $_SESSION['ordertype']="shirt";
				redirect($this->config->item('base_url_temp').'Cart/addcart3dcombined', 'location');

			}
			else if(isset($_SESSION['selected3dInfo_pant']) && !empty($_SESSION['selected3dInfo_pant']))
			{  

				$_SESSION['ordertype']="pant";
				redirect($this->config->item('base_url_temp').'Cart/addToCartTrouser', 'location') ;
			}
			else if(isset($_SESSION['selected3dInfo_shirttrail']) && !empty($_SESSION['selected3dInfo_shirttrail'])){
				// echo "hihi".$this->config->item('base_url');exit;
				$_SESSION['ordertype']="trailshirt";
				redirect($this->config->item('base_url_temp').'Cart/addcart3dcombined', 'location') ;
			}
			// this codition has added for suit customization...
			else if(isset($_SESSION['selected3dInfo_suit']) && !empty($_SESSION['selected3dInfo_suit'])){
				// echo "hihi".$this->config->item('base_url');exit;
				$_SESSION['ordertype']="suit";
				redirect($this->config->item('base_url_temp').'Cart/addToCartSuit', 'location') ;
			}
			// this codition has added for blazer customization...
			else if(isset($_SESSION['selected3dInfo_blazer']) && !empty($_SESSION['selected3dInfo_blazer'])){
				// echo "hihi".$this->config->item('base_url');exit;
				$_SESSION['ordertype']="blazer";
				redirect($this->config->item('base_url_temp').'Cart/addToCartBlazer', 'location') ;
			}
			else if(isset($_SESSION['selected3dInfo_vest']) && !empty($_SESSION['selected3dInfo_vest'])){
				$_SESSION['ordertype']="vest";
				redirect($this->config->item('base_url_temp').'Cart/addToCartVest', 'location') ;
			}

			redirect($this->config->item('base_url_temp'));
		}
		else
		{

			echo "<script>
			alert('The email and password you entered don\'t match.');
				window.location.href='".$this->config->item('base_url_temp')."home/lum_login';
			</script>";

		}


	}

	public function ourstory()

	{

		$this->load->helper('url');

		$this->output->enable_profiler(FALSE);

		$this->load->view('lum_header');

		$this->data['c'] = $this->home_model->ourstory();

		$this->load->view('our_story',$this->data);

		$this->load->view('lum_footer');



	}

	 public function careers()
	{

		$this->load->helper('url');
		$this->output->enable_profiler(FALSE);
        $this->load->view('lum_header');
		$this->load->view('careers');
        $this->load->view('lum_footer');
	}

	public function contactus()

	{



            	$this->load->helper('url');

				$this->output->enable_profiler(FALSE);



                $this->load->view('lum_header');

				$this->load->view('contact_us');

                $this->load->view('lum_footer');

	}

	public function paymentp()

	{

		$this->load->helper('url');

		$this->output->enable_profiler(FALSE);



                $this->load->view('lum_header');

		  $this->data['c'] = $this->home_model->paymentp();

          $this->load->view('payment_policy',$this->data);

                $this->load->view('lum_footer');



	}

		public function disclaimer(){

				$this->load->helper('url');

		$this->output->enable_profiler(FALSE);



		  $this->load->view('lum_header');



		   $this->data['c'] = $this->home_model->disclaimer();

		   $this->load->view('disclaimer',$this->data);

		   $this->load->view('lum_footer');

		}

		public function how_it_works(){

		$this->load->helper('url');

		$this->output->enable_profiler(FALSE);

		$metadata['title']='Check How Custom Tailored Clothing Works at Stylior Fashion India';
		$metadata['metadescription']='At Stylior Fashion check how custom tailored clothing will help to complete your look with Style.';
		$metadata['metakeywords']='Custom Clothing, Tailor Made, Clothing, Fashion, Style, Stylior, India';

		$this->load->view('lum_header',$metadata);
		//$this->data['c'] = $this->home_model->disclaimer();
		$this->load->view('how-it-works');
		$this->load->view('lum_footer');

		}



		public  function faq()

		{

			$this->load->view('lum_header');

			$this->load->view('faq');

			$this->load->view('lum_footer');

		}

		public function tandc()

			 {

			 $this->load->view('lum_header');

			   $this->data['c'] = $this->home_model->tandc();

			   $this->load->view('tandc',$this->data);

			   $this->load->view('lum_footer');

			 }



		public function privacyp()

		 {

			 $this->load->view('lum_header');

		   $this->data['c'] = $this->home_model->privacyp();

		   $this->load->view('privacyp',$this->data);

		   $this->load->view('lum_footer');



		}



		public function returnpolicy()

		 {

			 $this->load->view('lum_header');

		   $this->data['c'] = $this->home_model->privacyp();

		   $this->load->view('return_policy',$this->data);

		   $this->load->view('lum_footer');



		}

		public function edit_users()
    	{

		$id =$_SESSION('user_id');

		if(is_numeric($id)) {

			$result = $this->user_model->accountpage($id);

 			$form_field = $data = array(

						'L_strErrorMessage' => '',

						'id'	=> $result->id,

						'username' =>  $result->username,

						'password' => $result->password,

						//'repassword'=>'',

						'email' => $result->email,

						'phone' => $result->phone

			);



			if($this->input->post('action') == 'edit_users') {

				foreach($data as $key => $value) {

					$form_field[$key] = $this->input->post($key);

				}



				$rules['username']   = "trim|required";
				$rules['email']      = "trim|required";
				$rules['password']   = "password|Password|trim|required|matches[repassword]";
				//$rules['repassword']   = "password|Password Confirmation|required";
				$this->validation->set_rules($rules);
				$fields['username']       = "Username";
				$fields['email']      = "Email";
				$fields['password']   = "Password";
				//$fields['repassword']   = "Password Confirmation";
				$this->validation->set_fields($fields);
				if ($this->validation->run() == TRUE) {

					$data = $form_field;

					$data['L_strErrorMessage'] = $this->validation->error_string;

					$data['id'] = $id;

 				}

				else

				{

					if($response = $this->user_model->edit($id, $form_field)) {

					$this->session->set_flashdata('msg_name', 'User Profile Updated Successfully.!!');

						//	$data['allcategory'] = $this->user_model->allcategory();

							$data['accountpage'] = $this->user_model->accountpage($id);

						//redirect($this->config->item('base_url').'account/edit_users',$data);



					} else {

						$data['L_strErrorMessage'] = 'Some Errors prevented from update data,please try again later.';

					}

				}

			}



				$data['err_msg'] = '';

				//$data['allcategory'] = $this->user_model->allcategory();

				$data['accountpage'] = $this->user_model->accountpage($id);

				$data['title'] = 'Stylior.com';

				$data['keywords'] = '';

				$data['description'] = '';

				$this->load->view('myaccount',$data);



			} else {



				$data['err_msg'] = '';

				//$data['allcategory'] = $this->user_model->allcategory();

				$data['accountpage'] = $this->user_model->accountpage($id);

				$data['title'] = 'Stylior.com';

				$data['keywords'] = '';

				$data['description'] = '';

				$this->load->view('myaccount',$data);

			}



	}

	function zeroordersuccess(){

		$content['order_id'] = $this->session->userdata('order_number');

		$content['tracking_id'] = '';

		$this->bilship_model->psuccess($content);

		$prebonus = $this->bilship_model->getprebonus();

			$newbonus = $prebonus - $this->session->userdata('mywalletdata');

			$this->bilship_model->updatebonus($newbonus);



				if($this->session->userdata('trackid')){

					$tracking_id = $this->session->userdata('trackid');

					$trackper = $this->bilship_model->getpercent();

					$bonus_amt =  $this->session->userdata('total_amount') * $trackper / 100;

					$prevbonus = $this->bilship_model->getpreviousbonus($tracking_id);

					$totalbonus = $bonus_amt + $prevbonus;

					$this->bilship_model->updataffbonus($totalbonus,$tracking_id);

					$this->bilship_model->updateordertracking($this->session->userdata('order_number'), $tracking_id);

					$this->bilship_model->add_transaction($bonus_amt,$tracking_id);

					}

		$this->usersuccessmail();

		$data['thankyou'] = 'Thank you for shopping with us.  We will be shipping your order to you soon.';

		$data['title'] = 'Stylior.com';

		$data['keywords'] = '';

		$data['description'] = '';
		$this->load->view('thankyou.php',$data);

	}



	function cancel(){

		$data['thankyou'] = 'You have cancel your transaction.';

		$data['title'] = 'Stylior.com';

		$data['keywords'] = '';

		$data['description'] = '';

		$this->load->view('thankyou.php',$data);

	}



	function success()
	{

		$this->load->model('bilship_model');
		$data = array();
		$data['L_strErrorMessage'] = "";
		$data['err_msg'] = "";
		//echo getcwd(); die;
		//include('site/views/includes/Crypto.php');
        include_once(dirname(__FILE__) . '/../views/includes/Crypto.php');
		$workingKey='1ED6260C345165CDC9223B240BD23888';		//Working Key should be provided here.
		$encResponse=$_POST["encResp"];			//This is the response sent by the CCAvenue Server
		$rcvdString=decrypt($encResponse,$workingKey);		//Crypto Decryption used as per the specified working key.

		/*print_r($rcvdString);
		print_r($_POST);
		echo "avinash testing";
		exit();
		*/

		$order_status="";
		$decryptValues=explode('&', $rcvdString);
		$dataSize=sizeof($decryptValues);
		//echo "<center>";
		for($i = 0; $i < $dataSize; $i++)
		{

			$information=explode('=',$decryptValues[$i]);
			if($i==3){
				$order_status=$information[1];
			}
		}
		//$order_status="success";
		if($order_status==="Success" ||$order_status==="success" )
		{
			//echo "<br>";

			for($i = 0; $i < $dataSize; $i++)
			{
				$information=explode('=',$decryptValues[$i]);
				if($i==0)	$content['order_id'] = $information[1];
				if($i==1)	$content['tracking_id'] = $information[1];
			}


    		$this->bilship_model->updatesuccessstatus($content);

			$prebonus = $this->bilship_model->getprebonus();
			$newbonus = $prebonus - $this->session->userdata('mywalletdata');
			$this->bilship_model->updatebonus($newbonus);
			if($this->session->userdata('trackid')){
					$tracking_id = $this->session->userdata('trackid');
					$trackper = $this->bilship_model->getpercent();
					$bonus_amt =  $this->session->userdata('total_amountnew') * $trackper / 100;
					$prevbonus = $this->bilship_model->getpreviousbonus($tracking_id);
					$totalbonus = $bonus_amt + $prevbonus;
					$this->bilship_model->updataffbonus($totalbonus,$tracking_id);
					$this->bilship_model->updateordertracking($this->session->userdata('order_number'), $tracking_id);
					$this->bilship_model->add_transaction($bonus_amt,$tracking_id);
					}

			$this->usersuccessmail();


  			$data['thankyou'] = "Thank you! <br> We'll get started on your order right away. You Should be receiving an order confirmation email shortly. If you have any questions reach us on info@stylior.com";
			$data['status']="success";
/*
		$data['title'] = 'Stylior.com';
		$data['keywords'] = '';
		$data['description'] = '';

		$this->load->view('lum_header');
		$this->load->view('thankyou.php',$data);
		$this->load->view('lum_footer');
*/
  			// $data['thankyou'] .= '<br>Your Transaction id is '.$tracking_id;

 		}

		else if($order_status==="Aborted")

		{
			//echo "<br>Thank you for shopping with us.We will keep you posted regarding the status of your order through e-mail";
			$data['thankyou'] = 'Thank you for shopping with us.We will keep you posted regarding the status of your order through e-mail';
			$data['status']="failure";


		}
		else if($order_status==="Failure")
		{
			//echo "<br>Thank you for shopping with us.However,the transaction has been declined.";
			//echo "<pre>";
			//print_r($decryptValues);die;
			for($i = 0; $i < $dataSize; $i++)
			{
				$information=explode('=',$decryptValues[$i]);
				if($i==0)	$content['order_id'] = $information[1];
				if($i==1)	$content['tracking_id'] = $information[1];
			}
			$this->bilship_model->updateorderstatus($content);
			//$this->usersuccessmail();
			$data['thankyou'] = 'Your transaction has been declined.';
			$data['status']="failure";
		}
		else
		{

 			//	$data['status'] = "success";
 			//$data['thankyou'] = "Thank you! <br> We'll get started on your order right away. You Should be receiving an order confirmation email shortly. If you have any questions reach us on info@stylior.com";
			//echo "<br>";
			//$data['thankyou'] = 'Security Error. Illegal access detected.';
  			//$data['thankyou'] = "Thank you! <br> We'll get started on your order right away. You Should be receiving an order confirmation email shortly. If you have any questions reach us on info@stylior.com";

		}
		/*echo "<br><br>";
		echo "<table cellspacing=4 cellpadding=4>";
		for($i = 0; $i < $dataSize; $i++)
		{
			$information=explode('=',$decryptValues[$i]);
            echo '<tr><td>'.$information[0].'</td><td>'.$information[1].'</td></tr>';
		}
		echo "</table><br>";
		echo "</center>";*/
		$data['title'] = 'Stylior.com';
		$data['keywords'] = '';
		$data['description'] = '';
		$this->load->view('lum_header');
		$this->load->view('thankyou.php',$data);
		$this->load->view('lum_footer');

	}

	public function usersuccessmail(){

		   	$sql = "SELECT * from etemplate where id = '1' ";
	 	   	$query = $this->db->query($sql);
			if ($query->num_rows() > 0)
			{
				$format = $query->result();

			}

		//$format = $this->user_model->getusermail();
				$message = $format[0]->ordermail;
				$ordersub = $format[0]->ordermailsub;
				$ordersub = str_replace('[ORDERID]',$this->session->userdata('order_number'),$ordersub);
					if(count($this->cart->contents())!=0){
						//$pvalue = '0';
						/*foreach($this->cart->contents() as $arrRowDeailts )
						{

						$arrProddetails=$this->bilship_model->getproddetails($arrRowDeailts['id']);
						$userid =  $this->session->userdata('userid');*/
						/*
						$id=$arrRowDeailts['options']['colorid'];
						if($id !=""){
						$colorname =$this->home_model->getcolorname($id);
						} else {
							$colorname= "Not Available";
						}
						//print_r($data['result']);die;

						$id=$arrRowDeailts['options']['sizeid'];
						//echo($id);die();
					    if($id !=""){
							$sizename =$this->home_model->getsize($id);
							} else {
								$sizename = "Not Available";
							} */
							//print_r($dataa['result']);die();
							$data['result'] = $this->bilship_model->shippingaddress_active();
							//print_r($data['result']);
							$data['result']->id;
							$orderid = $this->session->userdata('order_number');
							//	echo $orderid;die;
							$ci_order_detail = $this->bilship_model->getorderdetai($orderid);
     						$ci_order_item = $this->bilship_model->getciorderitemdetail($orderid);
							$message = str_replace('{FIRSTNAME}',$this->session->userdata('username'),$message);
							$message = str_replace('{INVOICEORDER}',$this->session->userdata('order_number'),$message);
							$message = str_replace('{INVOICEDATE}',$ci_order_detail->cdate,$message);
							$message = str_replace('{PAYMENTMETHOD}','Online Payment',$message);
							$message = str_replace('{SHIPPINGDETIALS}',$data['result']->Address1.'</ br>'.$data['result']->Address2.'</ br>'.$data['result']->City.'</ br>'.$data['result']->State.'</ br>'.$this->bilship_model->getcountryname($data['result']->country).'</ br>'.$data['result']->Zip.'</ br>'.$data['result']->Phone,$message);

								$message = str_replace('{BILLINGDETIALS}',$data['result']->Address1.'</ br>'.$data['result']->Address2.'</ br>'.$data['result']->City.'</ br>'.$data['result']->State.'</ br>'.$this->bilship_model->getcountryname($data['result']->country).'</ br>'.$data['result']->Zip.'</ br>'.$data['result']->Phone,$message);



										$orderdetails = '<table cellpacing="20" cellspacing="0" border="1" width="700">';

										$orderdetails .= '<tr>';

											$orderdetails .= '<td>ITEM</td>';

											$orderdetails .= '<td>PRICE</td>';

											$orderdetails .= '<td>UNIT</td>';

											$orderdetails .= '<td>QTY</td>';

											$orderdetails .= '<td>SUBTOTAL</td>';

											$orderdetails .= '</tr>';

										if($ci_order_item != '' && count($ci_order_item) > 0) {

										foreach($ci_order_item as $ci_order_items)

										{

 											if($ci_order_detail->order_currency != 'INR') {

												$orderdetails .= '<tr>';

												$orderdetails .= '<td>'.$ci_order_items->order_item_name.'</td>';

												$priceitem = $this->roundUpToAny(( $ci_order_items->product_item_price / ( $this->session->userdata('currencyvalue') * ($this->session->userdata('multiplier')/100) ) ));

												$orderdetails .= '<td>'.number_format($priceitem,'2','.','').'</td>';

												$orderdetails .= '<td>'.$ci_order_detail->order_currency.'</td>';

												$orderdetails .= '<td>'.$ci_order_items->product_quantity.'</td>';

												$orderdetails .= '<td>'.number_format($priceitem,'2','.','').'</td>';

												$orderdetails .= '</tr>';

											} else {

												$orderdetails .= '<tr>';

												$orderdetails .= '<td>'.$ci_order_items->order_item_name.'</td>';

												$orderdetails .= '<td>'.number_format($ci_order_items->product_item_price,'2','.','').'</td>';

												$orderdetails .= '<td>'.$ci_order_detail->order_currency.'</td>';

												$orderdetails .= '<td>'.$ci_order_items->product_quantity.'</td>';

												$orderdetails .= '<td>'.number_format($ci_order_items->product_item_price,'2','.','').'</td>';

												$orderdetails .= '</tr>';

											}

											/*$message = str_replace('{INVOICENAME}',$ci_order_item->order_item_name,$message);

											$message = str_replace('{INVOICECOLOR}',$colorname,$message);

											$message = str_replace('{INVOICESIZE}',$sizename,$message);

											$message = str_replace('{INVOICEQUANTITY}',$ci_order_item->product_quantity,$message);

											$message = str_replace('{INVOICEPRICE}',$ci_order_item->product_item_price,$message);*/

										}
									}

										$orderdetails .= '<tr>';



												$orderdetails .= '<td colspan="4">Total: </td>';

												$orderdetails .= '<td>'.number_format($ci_order_detail->order_total,'2','.','').'</td>';

												$orderdetails .= '</tr>';

										$orderdetails .= '</table>';



										$message = str_replace('{ORDERDETAILS}',$orderdetails,$message);

 										$message = str_replace('{INVOICETOTAL}',$ci_order_detail->order_currency.'-'.$ci_order_detail->order_total,$message);

										//echo $message;die();

										$subject  = $ordersub;

										$headers  = 'MIME-Version: 1.0' . "\r\n";

										$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

										$headers .= 'From: stylior.com <orders@stylior.com>' . "\r\n" .

													'Reply-To: orders@stylior.com' . "\r\n" .

													'X-Mailer: PHP/' . phpversion();



										//echo $message; die;

 										//mail('patelnikul321@gmail.com', $subject, $message, $headers);

 										mail('orders@stylior.com', $subject, $message, $headers);

										mail($this->session->userdata('email'), $subject, $message, $headers);



						$this->session->unset_userdata('couponprice');

						$this->session->unset_userdata('giftwrap');

						$this->session->unset_userdata('couponcode');

						$this->session->unset_userdata('shipping_cost');

						$this->cart->destroy();



					//}

				}

			$this->cart->destroy();

	}

	function thanks()

	{

		$data = array();

		$data['L_strErrorMessage'] = "";

		$data['err_msg'] = "";

		$data['title'] = 'Stylior.com';

		$data['keywords'] = '';

		$data['description'] = '';

		$this->load->view('thankyou.php',$data);

	}



	function psuccess(){

		$content['order_id'] = $this->session->userdata('order_number');

		$content['tracking_id'] = '';

		$this->bilship_model->psuccess($content);

		$prebonus = $this->bilship_model->getprebonus();

			$newbonus = $prebonus - $this->session->userdata('mywalletdata');

			$this->bilship_model->updatebonus($newbonus);



				if($this->session->userdata('trackid'))

				{

					$tracking_id = $this->session->userdata('trackid');

					$trackper = $this->bilship_model->getpercent();

					$bonus_amt =  $this->session->userdata('total_amount') * $trackper / 100;

					$prevbonus = $this->bilship_model->getpreviousbonus($tracking_id);

					$totalbonus = $bonus_amt + $prevbonus;

					$this->bilship_model->updataffbonus($totalbonus,$tracking_id);

					$this->bilship_model->updateordertracking($this->session->userdata('order_number'), $tracking_id);

					$this->bilship_model->add_transaction($bonus_amt,$tracking_id);

					}

		$this->usersuccessmail();

		$data['thankyou'] = 'Thank you for shopping with us. Your transaction is successful. We will be shipping your order to you soon.';

		$data['title'] = 'Stylior.com';

		$data['keywords'] = '';

		$data['description'] = '';

		$this->load->view('thankyou.php',$data);

	}

 public function orderstatus(){
           $content=array(
			'user_id'=> $this->session->userdata('user_id'),
			'order_number'=> $intOrderNumber,
			//'order_invoice'=> $intOrderNumber,
			'user_info_id'=> $this->session->userdata('user_id'),
			'order_total'=> $this->session->userdata('resultprice'),
			'order_currency'=> $this->session->userdata('currencycode'),
			//'order_status'=> $order_status,
			//'paymentmode'=> $paymentmode,
			//'additionalcharge' => $additionalamt,
			'cdate'=> date('Y-m-d H:i:s'),
			//'shippingcost' => $this->session->userdata('shipping_cost'),
			//'is_gift' => $this->session->userdata('giftwrap'),
			'coupondiscount' => $this->session->userdata('couponprice'),
			'couponname' => $this->session->userdata('couponcode'),
			'tbl_coupan_name' => $this->session->userdata('coupanname'),
			'order_status' => 'C',
			//'voucherdisc' => $this->session->userdata('voucherprice'),
			//'vouchercode' => $this->session->userdata('vouchercode'),
			//'vouchervalue' => $this->session->userdata('vouchervalue'),
			//'wallet_amount' => $this->session->userdata('mywalletdata'),
 			'ip_address'=>$_SERVER['REMOTE_ADDR']);
			$this->db->set($content);
			if($this->Bilship_model->saveOrderInDatabase($content)){
				$name = $this->session->userdata('username');
				$email_customer = $this->session->userdata('email');
				$order_id=$this->session->userdata('trail-shirt');
				$order_name=$this->session->userdata('pname');
				$order_price=$this->session->userdata('price');
				$message .='We hope you enjoyed shopping at Stylior.com';
				$message1 .="Dear  ,\n $name has made an new order our stylior.com . The details of the order is as given below. \n\n  Name : $name \n Email : $email_customer \n Order id: $order_id \n Order name : $order_name \n Order price : $order_price";
				$to = $this->session->userdata('email');
				//print_r($to);
				$subject  = 'Thank you for shopping with Stylior.com';
				$subject1  = 'New Order';
				$headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				$headers .= 'From: stylior.com <info@stylior.in>' . "\r\n" .
				'Reply-To: stylior@gmail.com' . "\r\n" .
				'X-Mailer: PHP/' . phpversion();
				//$headers .= 'Cc: info@ollobra.com' . "\r\n";
				mail($to, $subject, $message, $headers);
				mail('orders@stylior.com', $subject1, $message1, $headers);
    }

    $this->load->view('lum_header.php');
    $this->load->view('order_status.php');
    $this->load->view('lum_footer.php');

  }
//add by ashok
 public function failure(){
 //remove session datas
	foreach ($_SESSION as $key => $value) {
			unset($_SESSION[$key]);
	}
	$data['status']="failure";
  //print_r($_SESSION);
  $this->load->view('lum_header.php');
  $this->load->view('order_failure.php',$data);
  $this->load->view('lum_footer.php');
}



/*var start */
public function getbodypart(){
	if(isset($_POST['bid']) && is_numeric($_POST['bid']))
	{
	   		$id=$_POST['bid'];
	   		$data=$this->User_model->bodypartdetails($id);
	        echo json_encode($data);
	        die();
	}
 }

		/*var end*/
		public function wedding_page(){
			$this->load->helper('url');
			$this->output->enable_profiler(FALSE);
			$metadata['title']='Wedding Suit | Mens Wedding Suits | Mens Suits for Weddings | Designer Suits for Men';
			$metadata['metadescription']='Shop wedding suits for men, discover our unique selection of vintage and custom made
			slim fit wedding suits to make your day perfect.';
			$metadata['metakeywords']='mens suits, suits, menswear, wedding suit, wedding suits for groom,
			groom suits, wedding suit for men, boys wedding suit, mens clothing';

			$this->load->view('lum_header',$metadata);
			$this->load->view('wedding-suit');
			$this->load->view('lum_footer');
		}

		public function wedding_enquiry_submit()
		{

		 $data = array();
		 $name = $data['name'] = $_POST['name'];
		 $email = 'support@stylior.com';
		 $content = $data['content'] = $_POST['message'];
		 $email_customer = $data['email_customer'] = $_POST['email'];
		 $phone = $data['phone'] = $_POST['phone'];
		 $date_today = date("Y-m-d");
		 $message = "Dear Support team ,\n $name has made an enquiry using our form . The details of the enquiry is as given below. \n\n  Name : $name \n Email : $email_customer \n phone: $phone \n Message : $content";
		 $subject  = 'New Enquiry';
		 $headers  = 'MIME-Version: 1.0' . "\r\n";
		 $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		 $headers .= 'From: stylior.com <newsletter@stylior.com>' . "\r\n" .
					 'Reply-To: newsletter@stylior.com' . "\r\n" .
					 'X-Mailer: PHP/' . phpversion();
		 if(mail($email, $subject, $message, $headers))
			{
				//print_r ($data);//die;
				echo "<script>alert('Thank you for Contact with stylior.com !');</script>";
				echo "<script>document.location.href='".$this->config->item('base_url_temp')."wedding-suit'</script>";
			}
			else
			{
				echo "<script>alert('Mail was not sent. Please try again later');</script>";
				echo "<script>document.location.href='".$this->config->item('base_url_temp')."wedding-suit'</script>";
			}
		}


		public function review(){
		
			$data['name'] = $_POST['name'];
			$data['city'] = $_POST['city'];
			$data['country'] = $_POST['country'];
			$data['state'] = $_POST['state'];
			$data['email'] = $_POST['email'];
			$data['phone'] = $_POST['phone'];
			$data['review'] = $_POST['review'];
			$data['name'] = "";
			$data['city'] = "";
			$data['country'] = "";
			$data['state'] = "";
			$data['email'] = "";
			$data['phone'] = "";
			$data['date_of_birth'] = "";
			$data['created_date'] = date("Y-m-d");
			$data['review'] = "Reviews here";
			$result = $this->home_model->addreview($data);
	
		}
	
	/*
	* Get tbl_size by id
	*/
	function get_tbl_size()
	{	
				$size=$_GET['size'];
				$category=$_GET['category'];
				if(isset($size) && isset($category)){
					$this->db->select('id,category,size,measurement');
					$result=$this->db->get_where('tbl_size',array('size'=>$size,'category'=>$category))->row_array();
					echo json_encode($result);
				}
				else
				{
				echo "No data found";
				}
	}

	/*end of get tbl_size*/
	//*page not found 404*/
	function show_test_header(){	 	   
				//new arrival  shirt code       
		        $data=array();
				$this->db->from('tbl_product as t1');
				$this->db->join('tbl_product_image as t2', 't2.pid = t1.id','left');
				$this->db->where('subcatid',10);
				$this->db->where('qty>',0);
				$this->db->where('is_home',1);
				$this->db->where('t2.baseimage',1);
				$this->db->limit(10);
				$q = $this->db->get();
		        $data['shirt_new'] = $q->result();
				$this->db->from('tbl_product as t1');
				$this->db->join('tbl_product_image as t2', 't2.pid = t1.id','left');
				$this->db->where('subcatid',11);
				$this->db->where('qty>',0);
				$this->db->where('is_home',1);
				$this->db->where('t2.baseimage',1);
				$this->db->limit(10);
				$q = $this->db->get();
				$data['trouser_new'] = $q->result();
	   			$this->db->from('tbl_product as t1');
				$this->db->join('tbl_product_image as t2', 't2.pid = t1.id','left');
				$this->db->where('subcatid',16);
				$this->db->where('qty>',0);
				$this->db->where('is_home',1);
				$this->db->where('t2.baseimage',1);
				$this->db->limit(10);
				$q = $this->db->get();
				$data['blazer_new'] = $q->result();		
				// print_r($data['blazer_new']);
				//print_r($data['trouser_new']);
				$this->load->view('lum_header_test.php');
			    $this->load->view('lum_home_test.php',$data);
			    $this->load->view('lum_footer_test.php');
	}


	/*page not found 404*/
	function show_404(){
		$this->load->view('lum_header.php');
	    $this->load->view('page_404.php');
	    $this->load->view('lum_footer.php');
	}

	/*****return product image based       ****/
	/***             param : pid           ****/
	/******************************************/
	function getProductImageByPid($pid){
			$sql = "SELECT image from tbl_product_image where pid=".$pid;
			$query1 = $this->db->query($sql);
			$result1 = $query1->result();
			return $result1;
	}

	/*delete this once u complete the measruement*/
	function mdemo(){
	// if( !$this->session->userdata('logged_in'))
	// 	{
		
	// 	$this->load->view('lum_header.php');
	//     $this->load->view('page_404.php');
	//     $this->load->view('lum_footer.php');

 // 		}
 // 		else {

	    $this->load->view('measurements-test.php');	
 	   //}
	}

	/*delete this once u complete the measruement*/
	function mdemo_trouser(){
	if( !$this->session->userdata('logged_in'))
		{
		
		$this->load->view('lum_header.php');
	    $this->load->view('page_404.php');
	    $this->load->view('lum_footer.php');

 		}
 		else {
	    $this->load->view('measurements-test-tr.php');	
 	   }
	}



	function store(){
		$this->load->view('lum_header.php');
	    $this->load->view('lum_store.php');
	    $this->load->view('lum_footer.php');	
	}  

    function addreview()
    {
    	$this->load->view('lum_header.php');
	    $this->load->view('creviewmain.php');
	    $this->load->view('lum_footer.php');
    }
}

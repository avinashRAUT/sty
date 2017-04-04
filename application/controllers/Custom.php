<?php
		defined('BASEPATH') OR exit('No direct script access allowed');

		class Custom extends CI_Controller {

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
				$this->load->model('Custom_model');

		}

		public function index()
		{
			//error_reporting(1);
			//ini_set('display_errors', 1)
			$this->load->helper('url');
			$this->output->enable_profiler(FALSE);
			//$_SESSION['sub_message']="one";
			$this->load->model('Home_model');
			$this->load->view('lum_header');
			//$this->data['image'] = $this->home_model->home_cat();
			//$data['allbanner'] = $this->home_model->allbanner();
			$this->load->view('lum_home');
			$this->load->view('lum_footer');

		}

		public function virtual_designer_shirt()
		{
			//error_reporting(1);
			//ini_set('display_errors', 1)
			$this->load->helper('url');
			$this->output->enable_profiler(FALSE);
			//$_SESSION['sub_message']="one";
			$data['collar'] = $this->Custom_model->getCollarOptions();
			$data['pocket'] = $this->Custom_model->getPocketOptions();
			$data['placket'] = $this->Custom_model->getPlacketOptions();
			$data['back'] = $this->Custom_model->getBackOptions();
			$data['bottom'] = $this->Custom_model->getBottomOptions();
			$data['piping'] = $this->Custom_model->getPipingOptions();
			$data['elbow'] = $this->Custom_model->getElbowOptions();
			$data['cuff'] = $this->Custom_model->getCuffOptions();
			$data['sleeve'] = $this->Custom_model->getSleeveOptions();
			$data['button'] = $this->Custom_model->getButtonOptions();
			$data['buttonhole'] = $this->Custom_model->getButtonHoleOptions();
			$data['buttonthread'] = $this->Custom_model->getButtonThreadOptions();
			$data['innercontrast'] = $this->Custom_model->getInnerContrastOptions();
			$data['outercontrast'] = $this->Custom_model->getOuterContrastOptions();
			$data['bodyfit'] = $this->Custom_model->getBodyFitOptions();
			$data['fabric'] = array();
           //print_r((array)$data);die;
			$this->load->model('Home_model');

            /*avr start*/
			$data['fabric_colors']= $this->home_model->allcolor(9,10);
			$data['fabric_patterns']=$this->home_model->alldesign(9,10);
		    /*end avrt*/
			/*start here*/
			//$all_swatches= getAllSwatchDetails();

\

			$swatch_url='http://textronic.online/api_stylior/v1/swatches';
			$json = file_get_contents($swatch_url);
			$shirt_sub_part = json_decode($json);
			foreach ($shirt_sub_part as $key => $value) {
			//print_r($key);
			//echo $key."value".$value;
				$data_value=$this->Custom_model->getShirtFabricImage($key);
			// print_r($data[0]->image);
			// print_r($data);
			if($data_value){
				$data['fabric'][$value]=$data_value;

			}
				//echo "<br/>";

			}

			//$this->load->view('lum_header');
			//$this->data['image'] = $this->home_model->home_cat();
			//$data['allbanner'] = $this->home_model->allbanner();
			$this->load->view('virtual_designer_shirt',$data);

		}


		public function virtual_designer_trouser()
		{
			//error_reporting(1);
			//ini_set('display_errors', 1)
			$this->load->helper('url');
			$this->output->enable_profiler(FALSE);
			//$_SESSION['sub_message']="one";

			$data['fabric'] = array();
           //print_r((array)$data);die;
			$this->load->model('Home_model');
			/*start here*/
			//$all_swatches= getAllSwatchDetails();
			$swatch_url='http://textronic.online/api_stylior/v1/swatches';
			$json = file_get_contents($swatch_url);
			$shirt_sub_part = json_decode($json);
			//print_r($json);
			foreach ($shirt_sub_part as $key => $value) {
				//print_r($key);
				//echo $key."value".$value;
				$data_value=$this->Custom_model->getTrouserFabricImage($key);
				// print_r($data[0]->image);
				// print_r($data);
				if($data_value){
					$data['fabric'][$value]=$data_value;
					//print_r($data['fabric']);
				}
					//echo "<br/>";
			}

			/*avr start*/
			$data['fabric_colors']= $this->home_model->allcolor(9,11);
			$data['fabric_patterns']=$this->home_model->alldesign(9,11);
			/*end avrt*/

			//$this->load->view('lum_header');
			//$this->data['image'] = $this->home_model->home_cat();
			//$data['allbanner'] = $this->home_model->allbanner();
			$this->load->view('virtual_designer_trouser',$data);

		}

		public function virtual_designer_suit()
		{
			//error_reporting(1);
			//ini_set('display_errors', 1)
			$this->load->helper('url');
			$this->output->enable_profiler(FALSE);
			//$_SESSION['sub_message']="one";

			$data['fabric'] = array();
					 //print_r((array)$data);die;
			$this->load->model('Home_model');
			/*start here*/
			//$all_swatches= getAllSwatchDetails();
			$swatch_url='http://textronic.online/api_stylior/v1/swatches';
			$json = file_get_contents($swatch_url);
			$shirt_sub_part = json_decode($json);
			//print_r($json);
			foreach ($shirt_sub_part as $key => $value) {
				//print_r($key);
				//echo $key."value".$value;
				$data_value=$this->Custom_model->getFabricImage($key,17);
				// print_r($data[0]->image);
				// print_r($data);
				if($data_value){
					$data['fabric'][$value]=$data_value;
					//print_r($data['fabric']);
				}
					//echo "<br/>";
			}

			/*avr start*/
			$data['fabric_colors']= $this->home_model->allcolor(9,11);
			$data['fabric_patterns']=$this->home_model->alldesign(9,11);
			/*end avrt*/

			//$this->load->view('lum_header');
			//$this->data['image'] = $this->home_model->home_cat();
			//$data['allbanner'] = $this->home_model->allbanner();
			$this->load->view('virtual_designer_suit',$data);

		}

		public function virtual_designer_blazer()
		{
			//error_reporting(1);
			//ini_set('display_errors', 1)
			$this->load->helper('url');
			$this->output->enable_profiler(FALSE);
			//$_SESSION['sub_message']="one";

			$data['fabric'] = array();
					 //print_r((array)$data);die;
			$this->load->model('Home_model');
			/*start here*/
			//$all_swatches= getAllSwatchDetails();
			$swatch_url='http://textronic.online/api_stylior/v1/swatches';
			$json = file_get_contents($swatch_url);
			$shirt_sub_part = json_decode($json);
			//print_r($json);
			foreach ($shirt_sub_part as $key => $value) {
				//print_r($key);
				//echo $key."value".$value;
				$data_value=$this->Custom_model->getFabricImage($key,16);
				// print_r($data[0]->image);
				// print_r($data);
				if($data_value){
					$data['fabric'][$value]=$data_value;
					//print_r($data['fabric']);
				}
					//echo "<br/>";
			}

			/*avr start*/
			$data['fabric_colors']= $this->home_model->allcolor(9,11);
			$data['fabric_patterns']=$this->home_model->alldesign(9,11);
			/*end avrt*/

			//$this->load->view('lum_header');
			//$this->data['image'] = $this->home_model->home_cat();
			//$data['allbanner'] = $this->home_model->allbanner();
			$this->load->view('virtual_designer_blazer',$data);

		}

		public function virtual_designer_vest()
		{
			//error_reporting(1);
			//ini_set('display_errors', 1)
			$this->load->helper('url');
			$this->output->enable_profiler(FALSE);
			//$_SESSION['sub_message']="one";

			$data['fabric'] = array();
					 //print_r((array)$data);die;
			$this->load->model('Home_model');
			/*start here*/
			//$all_swatches= getAllSwatchDetails();
			$swatch_url='http://textronic.online/api_stylior/v1/swatches';
			$json = file_get_contents($swatch_url);
			$shirt_sub_part = json_decode($json);
			//print_r($json);
			foreach ($shirt_sub_part as $key => $value) {
				//print_r($key);
				//echo $key."value".$value;
				$data_value=$this->Custom_model->getFabricImage($key,18);
				// print_r($data[0]->image);
				// print_r($data);
				if($data_value){
					$data['fabric'][$value]=$data_value;
					//print_r($data['fabric']);
				}
					//echo "<br/>";
			}

			/*avr start*/
			$data['fabric_colors']= $this->home_model->allcolor(9,11);
			$data['fabric_patterns']=$this->home_model->alldesign(9,11);
			/*end avrt*/

			//$this->load->view('lum_header');
			//$this->data['image'] = $this->home_model->home_cat();
			//$data['allbanner'] = $this->home_model->allbanner();
			$this->load->view('virtual_designer_vest',$data);

		}

		public function savedata()
		{
			$data['save'] = array(
					 'email'   => $_POST['user'],
					 'image'    => $_POST['image'],
					 'created_date' => date("Y/m/d"),
					 'subcatid' => $_POST['subcatid'],
				);
			//echo "hello";
			//print_r($data['save']);die;
			 $this->Custom_model->savedata($data['save']);
			return false;
			//$this->cart->insert($data);
		}








}

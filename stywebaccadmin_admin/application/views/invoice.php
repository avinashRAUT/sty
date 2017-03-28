<?php
$front_base_url = $this->config->item('front_base_url');
$base_url 		= $this->config->item('base_url');
$http_host 		= $this->config->item('http_host');
$base_url_views = $this->config->item('base_url_views');
$base_upload = $this->config->item('upload');
$live_base_url = $this->config->item('live_base_url');

function roundUpToAny($n,$x=5) {
    return (round($n)%$x === 0) ? round($n) : round(($n+$x/2)/$x)*$x;
} 
?><!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Invoice</title>
    <link rel="stylesheet" href="<?php echo $base_url_views; ?>css/myorderbootstrap.css">
    <style>
      @import url(http://fonts.googleapis.com/css?family=Bree+Serif);
      body, h1, h2, h3, h4, h5, h6{
      font-family: 'Bree Serif', serif;
      }
    </style>
	<script>
function myFunction()
{
    window.print();
}
</script> 
  </head>
  
  <body>
    <div class="container">
      <div class="row">
        <div class="col-xs-6">
          <h1 style="color:#428bca;"><img src="<?php echo $base_url_views; ?>images/logo.png"/></h1>
        </div>
		<button style="background: none repeat scroll 0 0 #000;    border: medium none;    color: 
#fff;    float: right;    font-size: 13px;       line-height: 20px;    margin: 0px 0 0;    padding: 7px;}" onclick="myFunction()">Print Invoice</button>   
        <div class="col-xs-6 text-right">
          <h1>INVOICE</h1>
          
        </div>
      </div>
      <div class="row">
        <div class="col-xs-6">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4 style="color:#428bca;">Stylior.com</h4>
            </div>
            <div class="panel-body">
              <p style="font-size:16px;">
                201, Akshar Blue Chip IT Park,
				<br>	Navi Mumbai-400705 <br>
                Email:  support@stylior.com <br>
                Customer Care: +91 8055-670-670<br>
               </p>
            </div>
          </div>
        </div>
        <div class="col-xs-6 text-right">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4>Invoice : <b style="font-weight:normal; color:#428bca;"><?php echo $orderdetails->order_id; ?></b></h4>
               <h4>Date : <b style="font-weight:normal; color:#428bca;"><?php echo $orderdetails->cdate; ?></b></h4>
            </div>
            <div class="panel-body" style="min-height:125px;">
              <p style="font-size:16px;">
                 <?php $userinfo = $this->product_model->getuserinfo($orderdetails->user_info_id); ?>
				 Customer Name: <?php echo $userinfo->username;?>   <br>
				 Email: <?php echo $userinfo->email;?>  <br>
				 Phone Number: <?php echo $userinfo->phone;?> <br>
                 Payment Method: - Online <br>
                </p>
            </div>
          </div>
        </div>
        <div style="clear:both;"></div>
        
        
         <div class="col-xs-6">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4><b style="color:#428bca; font-weight:normal;">Bill To:</b></h4>
            </div>
            <div class="panel-body">
              <p style="font-size:16px;">
              <?php echo $shippingdetails->address.",<br/>".$shippingdetails->address1.",<br/>".$shippingdetails->city.",".$shippingdetails->county.",<br/>".$shippingdetails->postcode; ?>
              </p>
            </div>
          </div>
        </div>
        <div class="col-xs-6 text-right">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4><b style="font-weight:normal; color:#428bca;">Ship To:</b></h4>
               
            </div>
            <div class="panel-body" style="min-height:154px;">
              <p style="font-size:16px;">
               <?php echo $shippingdetails->saddress.",<br/>".$shippingdetails->saddress1.",<br/>".$shippingdetails->scity.",<br/>".$shippingdetails->scounty.",<br/>".$shippingdetails->spostcode; ?>
            </div>
          </div>
        </div>
      </div>
      <!-- / end client details section -->
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>
              <h4>Item</h4>
            </th>
            <th>
              <h4>Price (<?php echo $orderdetails->order_currency; ?>)</h4>
            </th>
            <th>
              <h4>Unit</h4>
            </th>
            <th>
              <h4>Qty</h4>
            </th>
            <th>
              <h4>Total (<?php echo $orderdetails->order_currency; ?>)</h4>
            </th>
            <th>
              <h4>Tax</h4>
            </th>
          </tr>
        </thead>
        <tbody>
      
     <?php 
	 $c = $this->product_model->currencydetails($orderdetails->order_currency);
	 $cvalue = $c->stylior_roc;
 	 $multiplier = $c->multiplier;
	 $ceiling = $c->ceiling;
	 if($orderitems != '' && count($orderitems) > 0)
		  {
			  foreach($orderitems as $orderitems) { 
			     // print_r($orderitems);
 		  ?>
          <tr>

				<td>Style Name: <?php echo $orderitems->order_item_name ? $orderitems->order_item_name:$this->product_model->stylename($orderitems->product_id);?> <br /> 
				Product Name: <?php echo $orderitems->order_item_name ? $orderitems->order_item_name : $this->product_model->fabricname($orderitems->fabricid);?></td>
				<td>
				
				<?php
				if($orderdetails->order_currency == 'INR')
				{ ?>
						INR <?php echo number_format($orderitems->product_item_price,'2','.','');?> 
				<?php } else { 
 						echo $orderdetails->order_currency." "; 
						echo roundUpToAny(( $orderitems->product_item_price / ( $cvalue * ($multiplier/100)) )); 
				} ?>
				</td>
				<td><?php echo $orderdetails->order_currency; ?></td>
				<td><?php echo $orderitems->product_quantity; ?></td>
				<td> 
 				<?php
				if($orderdetails->order_currency == 'INR')
				{ ?>
						INR <?php echo number_format( ( $orderitems->product_item_price * $orderitems->product_quantity ),'2','.','');?>
				<?php } else { 
 						echo $orderdetails->order_currency." "; 
						echo roundUpToAny(( $orderitems->product_item_price * $orderitems->product_quantity / ( $cvalue * ($multiplier/100)) )); 
				} ?>

				</td>
				<td>0</td>
          </tr>
		  <!--tr>
			<td>
				 Total 
            </td>
			<td colspan="5" >#0</td>
		  </tr-->
		  <?php }} ?>
        </tbody>
      </table>
      <!--div class="row text-right">
      <div class="col-xs-12">
      <h3 style="text-align:left;">Customer Notes</h3>
      <div style="border: 1px solid rgb(204, 204, 204); min-height: 200px; float: left; width: 380px; margin-bottom:30px;">
      </div>
      <div class="col-xs-4" style="padding:0px; width:320px;"></div>
        <div class="col-xs-4" style="text-align:left; width:160px; float:left; padding:0px;">
          <p>
            <strong>
            Pre-tax Total : <br>
            TAX : <br>
            Shipping : <br>
            Total :
            </strong>
          </p>
        </div>
        <div class="col-xs-4" style="float:right; width:110px; text-align:right; padding:0px;">
          <p style="font-size:15px;">
          3,625.00 <br>
          299.06<br>
          12.95 <br>
          <b>3,937.01</b>
          </p>
        </div>
      </div-->
      <div style="clear:both;"></div>
      <p style="background:#428bca; text-align:center; color:#fff; padding:10px 0 10px 0; font-size:25px;">** Thank you for shopping with stylior.com **</p>
    </div>
	
	
  </body>
</html>

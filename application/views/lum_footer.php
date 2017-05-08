<?php
if ($_SERVER['HTTPS'] == "on")
{
$https_url="https://www.stylior.com/stylior/";
$bas_ul = "https://www.stylior.com/";
$https_url_large_img="https://www.stylior.com/stylior/upload/products1/large/";

}
else {
$bas_ul = "http://www.stylior.com/";
$https_url="http://www.stylior.com/";
$https_url_large_img="http://www.stylior.com/upload/products1/large/";

}

$base_url_temp=$bas_ul;

if($_SESSION['user_subscribe']=="registered" && $_SESSION["subscribe"]=="no"){
	$_SESSION['sub_message']="done";
}

?>

<script>
function validateForm()
{
 		var newemail = $("#newemail").val();
		console.log(newemail.length)

		var lenEmail=newemail.length;
		//return false;
		
		
		if(newemail == '' || lenEmail<4)
		{
			document.getElementById('error').innerHTML = ('Please Enter Email');
			return false;
		}
        
		var ema = document.getElementById('newemail');
        var filter = "/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/";
        if (!filter.test(ema.value))
		{
			document.getElementById('error').innerHTML=('Please Enter Valid Email Address');
            ema.focus;
            return false;
        }
 }
</script>

<!--<script type='text/javascript'>var _refiral=_refiral||{};_refiral.apiKey='0e7c7d6c41c76b9ee6445ae01cc0181d';(function(){var ref=document.createElement('script');ref.type='text/javascript';ref.async=true;ref.src='https://cdn.refiral.com/libs/refiral.min.js';var s=document.getElementsByTagName('script')[0];s.parentNode.insertBefore(ref,s);})();</script>-->

<!-- Google Code for Stylior promotion Conversion Page -->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 857353778;
var google_conversion_language = "en";
var google_conversion_format = "3";
var google_conversion_color = "ffffff";
var google_conversion_label = "4YEVCJGy1G8QstzomAM";
var google_remarketing_only = false;
/* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//www.googleadservices.com/pagead/conversion/857353778/?label=4YEVCJGy1G8QstzomAM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>

<!-- Facebook Pixel Code -->
<script>
!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
document,'script','https://connect.facebook.net/en_US/fbevents.js');

fbq('init', '2055046121389006');
fbq('track', "PageView");</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=2055046121389006&ev=PageView&noscript=1"
/></noscript>
<!-- End Facebook Pixel Code -->


<section class="subscribe">
    <div class="container">
    	<div class="subscribe_content">
        	<h1>get more offers</h1>
            <p><em></em></p>
            <form method="post" name="form" action="<?php echo $base_url_temp; ?>home/subscribe" onsubmit="return validateForm();" enctype="multipart/form-data">
            	<div class="input-group">
                	<input type="email" class="subscribe_input" id="newemail" name="newemail" placeholder="Enter Your Email">
                	<button class="btn subscribe_submit " type="submit">Submit</button>
                     <label id="error"></label>
                </div>
            </form>
        </div>
    </div>
</section>


<!-- start modal -->
<!--<div class="modal fade" id="subscribeModal" role="dialog" style="display:none;">
  <div class="vertical-alignment-helper">
    <div class="modal-dialog modal-md vertical-align-center">
      <div class="modal-content mobi">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <div class="modal-body sub" style="text-align:center;">

        <?php if($_SESSION['user_subscribe']!=="registered") { ?>
             <form  method="post" name="form" action="<?= $base_url_temp ?>home/subscribe" onsubmit="return validateForm();" enctype="multipart/form-data">

       <h1>Subscribe for Newsletter</h1>
        <input type="email" name="newemail" id="newemail" class="form-control" placeholder="Enter your email" required>
        <button id="singlebutton" name="singlebutton" type="submit" class="btn btn-primary">JOIN NOW</button>
        <div class="socio-sub">
        <ul>
        <li><a href="https://www.facebook.com/styliorfashion/" target="_blank" title="Facebook"><img src="<?php echo $base_url_temp; ?>stylior/images/fb-sub.png" width="32" height="33" alt=""/></a></li>
        <li><a href="https://www.pinterest.com/styliorfashion/" target="_blank" title="pinterest"><img src="<?php echo $base_url_temp; ?>stylior/images/pin-sub.png" width="32" height="33" alt=""/></a></li>
        <li><a href="https://www.instagram.com/styliorfashion/" target="_blank" title="instagram"><img src="<?php echo $base_url_temp; ?>stylior/images/sub-insta.png" width="32" height="33" alt=""/></a></li>
        <li><a href="https://www.linkedin.com/company/stylior-com?trk=biz-companies-cym" target="_blank" title="linkedin"> <img src="<?php echo $base_url_temp; ?>stylior/images/link-sub.png" width="32" height="33" alt=""/></a></li>
        <li><a href="https://plus.google.com/u/0/+StyliorFashion-custom-clothing" target="_blank" title="google"><img src="<?php echo $base_url_temp; ?>stylior/images/google-sub.png" width="32" height="33" alt=""/></a></li>
        </ul>
        </div>
		</form>
			<?php }else if($_SESSION['user_subscribe']=="registered"){?>
				<div class="alert alert-info">
                     <p><?php echo $_SESSION['sub_message']; ?></p>
				</div>
		   <?php
			 $_SESSION['subscribe']="no";
		   }?>
         </div>

    </div>
  </div>
  </div>
</div>-->

<!-- end of modal -->
<!-- ================= new footer code ================= -->
<footer class="footer stylior-footer">
    <section class="footer-topSection">
        <div class="container">
            <div class="row hidden-xs hidden-sm">
                <div class="col-md-4">
                    <div class="footer-title">FOLLOW US</div>
                    <ul class="footer-social-links">
                        <li><a href="https://www.facebook.com/styliorfashion/" target="_blank"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="https://www.instagram.com/styliorfashion/" target="_blank"><i class="fa fa-instagram"></i></a></li>
                        <li><a href="https://plus.google.com/u/0/100002617149579103996/posts" target="_blank" class="google-plus"><i class="fa fa-google-plus"></i></a></li>
                        <li><a href="https://www.pinterest.com/styliorfashion/" target="_blank"><i class="fa fa-pinterest"></i></a></li>
                        <li><a href="https://www.linkedin.com/company/stylior-com?trk=biz-companies-cym" target="_blank"><i class="fa fa-linkedin"></i></a></li>
                        <li><a href="https://www.youtube.com/channel/UCFwHuzx8WXKzjminQXJglWw" target="_blank"><i class="fa fa-youtube"></i></a></li>	
                    </ul>
                </div>
                <div class="col-md-3">
                    <div class="footer-title">SERVICES</div>
                    <ul class="footer-links">
                        <li><a href="<?= $base_url_temp ?>trial-shirt">trial shirts</a></li>
                        <li><a href="<?= $base_url_temp ?>book-a-home-visit">book a home visit</a></li>
                        <li><a href="<?= $base_url_temp ?>fit-guide">fit guide</a></li>
                        <li><a href="<?= $base_url_temp ?>return-policy">alteration / remake / return</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <div class="footer-title">ABOUT</div>
                    <ul class="footer-links">
                        <li><a href="<?= $base_url_temp ?>our-story">about stylior</a></li>
                        <li><a href="<?= $base_url_temp ?>why-custom">why custom</a></li>
                        <li><a href="http://www.blog.stylior.com">blog</a></li>
                        <li><a href="http://www.corporatestylior.com">corporate orders</a></li>
                    </ul>
                </div>
                
                <div class="col-md-2">
                    <div class="footer-title">help</div>
                    <ul class="footer-links">
                        <li><a href="<?= $base_url_temp ?>payment-policy">payment policy</a></li>
                        <li><a href="<?= $base_url_temp ?>privacy-policy">privacy policy</a></li>
                        <li><a href="<?= $base_url_temp ?>terms-and-conditions">terms and conditions</a></li>
                        <li><a href="<?= $base_url_temp ?>disclaimer">disclaimer</a></li>
                        <li><a href="<?= $base_url_temp ?>contact-us">contact us</a></li>
                        <li><a href="<?= $base_url_temp ?>faq">faq</a></li>
                    </ul>
                </div>  
            </div>
            <!--  footer code for mobile and ipad  -->
            <div class="row visible-xs visible-sm">
                <div class="col-xs-12">
                    <div class="panel-group footer-panel-small">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                  <a data-toggle="collapse" href="#follow_us">FOLLOW</a>
                                </h4>
                            </div>
                            <div id="follow_us" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <ul class="footer-social-links">
                                        <li><a href="https://www.facebook.com/styliorfashion/" target="_blank"><i class="fa fa-facebook"></i></a></li>
                                        <li><a href="https://www.instagram.com/styliorfashion/" target="_blank"><i class="fa fa-instagram"></i></a></li>
                                        <li><a href="https://plus.google.com/u/0/100002617149579103996/posts" target="_blank"><i class="fa fa-google-plus"></i></a></li>
                                        <li><a href="https://www.pinterest.com/styliorfashion/" target="_blank"><i class="fa fa-pinterest"></i></a></li>
                                        <li><a href="https://www.linkedin.com/company/stylior-com?trk=biz-companies-cym" target="_blank"><i class="fa fa-linkedin"></i></a></li>
                                        <li><a href="https://www.youtube.com/channel/UCFwHuzx8WXKzjminQXJglWw" target="_blank"><i class="fa fa-youtube"></i></a></li>	
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                  <a data-toggle="collapse" href="#service">SERVICE</a>
                                </h4>
                            </div>
                            <div id="service" class="panel-collapse collapse">
                                <div class="panel-body footer-links">
                                    <div class="row">
                                        <div class="col-sm-6 link-left"><a href="<?= $base_url_temp ?>trial-shirt">trial shirts</a></div>
                                        <div class="col-sm-6 link-right"><a href="<?= $base_url_temp ?>book-a-home-visit">book a home visit</a></div>
                                        <div class="col-sm-6 link-left"><a href="<?= $base_url_temp ?>fit-guide">fit guide</a></div>
                                        <div class="col-sm-6 link-right"><a href="<?= $base_url_temp ?>return-policy">alteration / remake / return</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                  <a data-toggle="collapse" href="#about">ABOUT</a>
                                </h4>
                            </div>
                            <div id="about" class="panel-collapse collapse">
                                <div class="panel-body footer-links">
                                <div class="row">
                                    <div class="col-sm-6 link-left"><a href="<?= $base_url_temp ?>our-story">about stylior</a></div>
                                    <div class="col-sm-6 link-right"><a href="<?= $base_url_temp ?>why-custom">why custom</a></div>
                                    <div class="col-sm-6 link-left"><a href="http://www.blog.stylior.com">blog</a></div>
                                    <div class="col-sm-6 link-right"><a href="http://www.corporatestylior.com">corporate orders</a></div>
                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                  <a data-toggle="collapse" href="#help">HELP</a>
                                </h4>
                            </div>
                            <div id="help" class="panel-collapse collapse">
                                <div class="panel-body footer-links">
                                <div class="row">
                                    <div class="col-sm-6 link-left"><a href="<?= $base_url_temp ?>payment-policy">payment policy</a></div>
                                    <div class="col-sm-6 link-right"><a href="<?= $base_url_temp ?>privacy-policy">privacy policy</a></div>
                                    <div class="col-sm-6 link-left"><a href="<?= $base_url_temp ?>terms-and-conditions">terms and conditions</a></div>
                                    <div class="col-sm-6 link-right"><a href="<?= $base_url_temp ?>disclaimer">disclaimer</a></div>
                                    <div class="col-sm-6 link-left"><a href="<?= $base_url_temp ?>contact-us">contact us</a></div>
                                    <div class="col-sm-6 link-right"><a href="<?= $base_url_temp ?>faq">faq</a></div>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--  footer code for mobile and ipad  -->
        </div>
    </section>
    <section class="footer-bottomSection">
    	<div class="container">
        	<p class="text-center">	 &copy; 2015 Luminor Fashion Private Limited. All Rights Reserved. </p>
        </div>
    </section>
</footer>

<!-- ================= new footer code ================= -->


<script>
function hover(element) {
	str = element.src;
	str = str.substring(0, str.length - 7);
    element.setAttribute('src', str + '.png');
}
function unhover(element) {
	str = element.src;
	str = str.substring(0, str.length - 4);
    element.setAttribute('src', str + '_bw.png');
}
function hover_foot(element) {
	var yourImg = document.getElementById(element);
	yourImg.style.transitionDuration="0.3s";
	yourImg.style.width = '18px';
}
function unhover_foot(element) {
	var yourImg = document.getElementById(element);
	yourImg.style.width = '15px'
	yourImg.style.transitionDuration="0.3s";
}

$(window).load(function(){
<?php
 $cookie_name = "subscribe";
$cookie_value = "done";
 setcookie($cookie_name, $cookie_value, time() + (86400 ), "/"); // 86400 = 1 day
if(!isset($_COOKIE[$cookie_name])) {
  $actual_link = $_SERVER['HTTP_HOST'];
  $params=$_SERVER['REQUEST_URI'];
  $count_p=strlen($params);
//  echo "url print".$actual_link."Parmas".$params;
// echo strlen($params);
  if($_SESSION['sub_message']!=="done" && $count_p==1111) {?>
		$('#subscribeModal').modal('show');
	<?php }?>

<?php } ?>

});
</script>

<script type="text/javascript" src="<?=base_url() ?>js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?=base_url() ?>js/bootsnav.js"></script>

<?php 
$data=explode('/', $_SERVER['REQUEST_URI']);
// echo "<div style='display:none'>";
//     $data=explode('/', $_SERVER['REQUEST_URI']);
//     print_r($data);
// echo "</div>";

if($data[2]!="mdemo") {?>
<script src="<?=base_url() ?>js/owl.carousel.js"></script>
<?php } ?>

<script src="<?=base_url() ?>js/jquery.mb.YTPlayer.js"></script>

<script type="text/javascript" src="<?=base_url() ?>js/wow.js"></script>
<script type="text/javascript" src="<?=base_url() ?>js/script.js"></script>


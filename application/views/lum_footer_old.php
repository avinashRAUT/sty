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
		if(newemail == '')
		{
			//alert('Please Enter E-mail.');
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

fbq('init', '1248172288528875');
fbq('track', "PageView");</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=1248172288528875&ev=PageView&noscript=1"
/></noscript>
<!-- End Facebook Pixel Code -->






<div class="lum_footer">



<div class="new_lum_footer_change">
		<div class="new_lum_footer_change_left">
		<form  method="post" name="form" action="<?php echo $base_url_temp; ?>home/subscribe" onsubmit="return validateForm();" enctype="multipart/form-data">

		<input type="email" name="newemail" id="newemail" class="lum_column_big_input_join" placeholder="Enter your email">
		<button class="lum_column_big_button_join" id="lum_column_big_button_join"  type="submit"  >JOIN</button>
		</form>
		</div>
		<div class="new_lum_footer_change_right">
							<a href="https://www.facebook.com/styliorfashion/" target="_new"><img class="lum_column_big_img" src="<?=base_url() ?>images/lum_fb-icon_bw.png" onmouseover="hover(this);" onmouseout="unhover(this);" alt=""></a>


							<a href="https://plus.google.com/u/0/100002617149579103996/posts" target="_new"><img class="lum_column_big_img" src="<?=base_url() ?>images/lum_gplus-icon_bw.png" onmouseover="hover(this);" onmouseout="unhover(this);" alt=""></a>


							<a href="https://www.instagram.com/styliorfashion/" target="_new"><img class="lum_column_big_img" src="<?=base_url() ?>images/lum_instagram-icon_bw.png" onmouseover="hover(this);" onmouseout="unhover(this);" alt=""></a>

							<a href="https://www.linkedin.com/company/stylior-com?trk=biz-companies-cym" target="_new"><img class="lum_column_big_img" src="<?=base_url() ?>images/lum_linkdin-icon_bw.png" onmouseover="hover(this);" onmouseout="unhover(this);" alt=""></a>

							<a href="https://www.pinterest.com/styliorfashion/" target="_new"><img class="lum_column_big_img" src="<?=base_url() ?>images/lum_pintrest-icon_bw.png" onmouseover="hover(this);" onmouseout="unhover(this);" alt=""></a>

							<a href="https://www.youtube.com/channel/UCFwHuzx8WXKzjminQXJglWw" target="_new"><img class="lum_column_big_img" src="<?=base_url() ?>images/lum_you-tube_bw.png" onmouseover="hover(this);" onmouseout="unhover(this);" alt=""></a>

		</div>
</div>

<div class="new_lum_footer_change_space lum_login container-fluid">
	<div class="lum_column_small col-xs-12 col-sm-4 col-lg-4 ">
		<div class="lum_column_small_head" style="padding:0 0 10px 15px">SERVICES</div>
		<div><a href="<?= $base_url_temp ?>trial-shirt" onmouseover="hover_foot('trial_shirt_img');" onmouseout="unhover_foot('trial_shirt_img');"><div class="lum_column_small_head_link"><img id="trial_shirt_img" class="lum_column_small_img" src="<?=base_url() ?>images/lum_trial_shirt.png" alt=""></div>TRIAL SHIRT</a></div>
		<div><a href="<?= $base_url_temp ?>book-a-home-visit" onmouseover="hover_foot('book_an_appointment_img');" onmouseout="unhover_foot('book_an_appointment_img');"><div class="lum_column_small_head_link"><img id="book_an_appointment_img" class="lum_column_small_img" src="<?=base_url() ?>images/lum_book_appointment.png" alt=""></div>BOOK A HOME VISIT</a></div>
		<div><a href="<?= $base_url_temp ?>fit-guide" onmouseover="hover_foot('fit_guide_img');" onmouseout="unhover_foot('fit_guide_img');"><div class="lum_column_small_head_link"><img id="fit_guide_img" class="lum_column_small_img" src="<?=base_url() ?>images/lum_fit_guid.png" alt=""></div>FIT GUIDE</a></div>
		<div><a href="<?= $base_url_temp ?>return-policy" onmouseover="hover_foot('alteration_img');" onmouseout="unhover_foot('alteration_img');"><div class="lum_column_small_head_link"><img id="alteration_img" class="lum_column_small_img" src="<?=base_url() ?>images/lum_alteration.png" alt=""></div>ALTERATION / REMAKE / RETURN</a></div>
		<!--<div><a href="#" onmouseover="hover_foot('refer_a_friend_img');" onmouseout="unhover_foot('refer_a_friend_img');"><div class="lum_column_small_head_link"><img id="refer_a_friend_img" class="lum_column_small_img" src="<?=base_url() ?>images/lum_reffer_friend.png" alt=""></div>REFER A FRIEND</a></div>-->
		<!--<div><a href="<?= $base_url_temp ?>giftcard" onmouseover="hover_foot('gift_card_img');" onmouseout="unhover_foot('gift_card_img');"><div class="lum_column_small_head_link"><img id="gift_card_img" class="lum_column_small_img" src="<?=base_url() ?>images/lum_gift_card.png" alt=""></div>GIFT CARD</a></div>-->
		<!--<div><a href="#" onmouseover="hover_foot('coupons_img');" onmouseout="unhover_foot('coupons_img');"><div class="lum_column_small_head_link"><img id="coupons_img" class="lum_column_small_img" src="<?=base_url() ?>images/lum_coupon.png" alt=""></div>COUPONS</a></div>-->

	</div>
	<div class="lum_column_small col-xs-12 col-sm-4 col-lg-4 ">
		<div class="lum_column_small_head"  style="padding:0 0 10px 15px">ABOUT</div>
		<div><a href="<?= $base_url_temp ?>our-story" onmouseover="hover_foot('about_stylior_img');" onmouseout="unhover_foot('about_stylior_img');">

		<div class="lum_column_small_head_link"><img id="about_stylior_img" class="lum_column_small_img" src="<?=base_url() ?>images/lum_about_stylior.png" alt=""></div>

		ABOUT STYLIOR</a></div>
		<div><a href="<?= $base_url_temp ?>why-custom" onmouseover="hover_foot('why_custom_img');" onmouseout="unhover_foot('why_custom_img');"><div style="width:26px;height:26px;float:left;position:relative;top:-4px;"><img id="why_custom_img" class="lum_column_small_img" src="<?=base_url() ?>images/lum_why_custom.png" alt=""></div>WHY CUSTOM</a></div>
		<div><a href="http://www.blog.stylior.com" onmouseover="hover_foot('blog_img');" onmouseout="unhover_foot('blog_img');">
		<div class="lum_column_small_head_link">
		<img id="blog_img" class="lum_column_small_img" src="<?=base_url() ?>images/lum_blog.png" alt=""></div>BLOG</a></div>
		<!--<div><a href="<?= $base_url_temp ?>careers" onmouseover="hover_foot('careers_img');" onmouseout="unhover_foot('careers_img');"><div class="lum_column_small_head_link"><img id="careers_img" class="lum_column_small_img" src="<?=base_url() ?>images/lum_career.png" alt=""></div>CAREERS</a></div>-->
		<div><a href="http://www.corporatestylior.com" onmouseover="hover_foot('corporate_orders_img');" onmouseout="unhover_foot('corporate_orders_img');"><div class="lum_column_small_head_link"><img id="corporate_orders_img" class="lum_column_small_img" src="<?=base_url() ?>images/lum_caporate_order.png" alt=""></div>CORPORATE ORDERS</a></div>
	</div>
	<div class="lum_column_small col-xs-12 col-sm-4 col-lg-4 ">
		<div class="lum_column_small_head"  style="padding:0 0 10px 15px">HELP</div>
		<div><a href="<?= $base_url_temp ?>payment-policy" onmouseover="hover_foot('payment_policy_img');" onmouseout="unhover_foot('payment_policy_img');"><div class="lum_column_small_head_link"><img id="payment_policy_img" class="lum_column_small_img" src="<?=base_url() ?>images/lum_payment_policy.png" alt=""></div>PAYMENT POLICY</a></div>
		<div><a href="<?= $base_url_temp ?>privacy-policy" onmouseover="hover_foot('privacy_policy_img');" onmouseout="unhover_foot('privacy_policy_img');"><div class="lum_column_small_head_link"><img id="privacy_policy_img" class="lum_column_small_img" src="<?=base_url() ?>images/lum_privacy_policy.png" alt=""></div>PRIVACY POLICY</a></div>
		<div><a href="<?= $base_url_temp ?>terms-and-conditions" onmouseover="hover_foot('terms_conditions_img');" onmouseout="unhover_foot('terms_conditions_img');"><div class="lum_column_small_head_link"><img id="terms_conditions_img" class="lum_column_small_img" src="<?=base_url() ?>images/lum_terms_condition.png" alt=""></div>TERMS & CONDITIONS</a></div>
		<div><a href="<?= $base_url_temp ?>disclaimer" onmouseover="hover_foot('desclaimer_img');" onmouseout="unhover_foot('desclaimer_img');"><div class="lum_column_small_head_link"><img id="desclaimer_img" class="lum_column_small_img" src="<?=base_url() ?>images/lum_disclaimer.png" alt=""></div>DISCLAIMER</a></div>
		<div><a href="<?= $base_url_temp ?>contact-us" onmouseover="hover_foot('your_account_img');" onmouseout="unhover_foot('your_account_img');"><div class="lum_column_small_head_link"><img id="your_account_img" class="lum_column_small_img" src="<?=base_url() ?>images/lum_about_stylior.png" alt=""></div>CONTACT US</a></div>
		<div><a href="<?= $base_url_temp ?>faq" onmouseover="hover_foot('');" onmouseout="unhover_foot('');"><div class="lum_column_small_head_link"><img id="your_account_img" class="lum_column_small_img" src="<?=base_url() ?>images/relaunch/faq.png" alt=""></div>FAQ</a></div>

	</div>
</div>


<!-- start modal -->
  <div class="modal fade" id="subscribeModal" role="dialog" style="display:none;">
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
  </div>

<!-- end of modal -->
<div class="footer_bottom" align="center">
	 &copy; 2015 LUMINOR FASHION PRIVATE LIMITED. ALL RIGHTS RESERVED.
</div>

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
<script src="<?=base_url() ?>js/owl.carousel.js"></script>
 <script src="<?=base_url() ?>js/jquery.mb.YTPlayer.js"></script>
<script type="text/javascript" src="<?=base_url() ?>js/wow.js"></script>
<script type="text/javascript" src="<?=base_url() ?>js/script.js"></script>
<script type="text/javascript" src="<?=base_url() ?>js/bootsnav.js"></script>

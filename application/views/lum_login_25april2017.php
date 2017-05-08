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


?>
<link href="<?php echo base_url();?>css/bootstrap.css" rel="stylesheet">
<link href="<?php echo base_url();?>/css/animate.min.css" rel="stylesheet">


<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>

/* General button style (reset) */
.form-control {
	border-radius:0;}
.btn {
	border: none;
	font-family: century Gothic;
	font-size: 14px;
	color: inherit;
	background: none;
	cursor: pointer;
	display: inline-block;
	margin: 5px 0px;
	text-transform: uppercase;
	letter-spacing: 1px;
	font-weight: 100;
	outline: none;
	position: relative;
	-webkit-transition: all 0.3s;
	-moz-transition: all 0.3s;
	transition: all 0.3s;
}

.btn:after {
	content: '';
	position: absolute;
	z-index: -1;
	-webkit-transition: all 0.3s;
	-moz-transition: all 0.3s;
	transition: all 0.3s;
}

/* Button 1 */
.btn-1 {

    /*border: 1px solid #000;*/

    /*background: #FFFFFF;*/
	background: #282C3E;
    width: 100%;
	color: #fff;
	border: 1px solid #282C3E;
	border-radius:0;

}

/* Button 1a */
.btn-1a:hover,
.btn-1a:active {

	background: #ffff;
	 color: #282C3E;
	 border: 1px solid #282C3E;
   /* color: #fff;*/
}
@media only screen and (max-width: 480px){
	#login-box {
		position: relative !important;
	}
}
@media only screen and (min-width: 320px) {
    .container-fluid{
	width: 100%;

	background-repeat: no-repeat;
	background-size: 100% 100%;
	/*height: 600px;*/

}
#login-box {

    position:absolute;
    display:inline-block;
    z-index:10;
    width:90%;
    max-width: 300px;
}
.display_desktop{
	display: none;
}
#container {
    margin: 0 auto;
    font-size: 14px;
    font-family: Century Gothic;
    text-align: center;
    padding: 5%;

}
.lum_footer{
	display: none;
}
.login_fb {
	width: 100%;
	height: 50px;
	float: left;
	cursor: pointer;
}
.login_gmail{
	width: 100%;
	height: 50px;
	float: right;
	cursor: pointer;
}
.login_fb img{
	width:100%;
	height: 50px;
}
.login_gmail img{
	width: 100%;
	height: 50px;
}
}
@media only screen and (min-width: 480px) {
    .container-fluid{
	width: 100%;

	background-repeat: no-repeat;
	background-size: 100% 100%;
	/*height: 600px;*/

}

#login-box {

    position:absolute;
    display:inline-block;
    z-index:10;
    width:90%;
    max-width: 320px;
    margin: 2% 15%;
}
.display_desktop{
	display: none;
}
#container {
    margin: 0 auto;
    font-size: 14px;
    font-family: Century Gothic;
    text-align: center;
    padding: 5%;

}
.lum_footer{
	display: none;
}
.login_fb {
	width: 100%;
	height: 50px;
	float: left;
	cursor: pointer;
}
.login_gmail{
	width: 100%;
	height: 50px;
	float: right;
	cursor: pointer;
}
.login_fb img{
	width:100%;
	height: 50px;
}
.login_gmail img{
	width: 100%;
	height: 50px;
}

}
@media only screen and (min-width: 768px) {
  .container-fluid{
	width: 100%;

	background-repeat: no-repeat;
	background-size: 100% 100%;
	/*height: 500px;*/

}

#login-box {

    position:absolute;
    display:inline-block;
    z-index:10;
    width:90%;
    max-width: 320px;
    margin: 0% 0%;
    padding: 5%;
}
.display_desktop{
	display: block;
}
#container {
    margin: 0 auto;
    font-size: 14px;
    font-family: Century Gothic;
    text-align: center;
    padding: 0%;

}
.lum_footer{
	display: none;
}
.login_fb {
	width: 100%;
	height: 50px;
	float: left;
	cursor: pointer;
}
.login_gmail{
	width: 100%;
	height: 50px;
	float: right;
	cursor: pointer;
}
.login_fb img{
	width:100%;
	height: 50px;
}
.login_gmail img{
	width: 100%;
	height: 50px;
}
.lum_footer{
	display: none;
}

.display_desktop.login_image_page img {
    height: 500px;
}
}
@media only screen and (min-width: 1024px) {
  .container-fluid{
	width: 100%;

	background-repeat: no-repeat;
	background-size: 100% 100%;
	/*height: 500px;*/

}

#login-box {

    position:absolute;
    display:inline-block;
    z-index:10;
    width:90%;
    max-width: 360px;
    margin: 0% 0%;
    padding: 5%;
}
.display_desktop{
	display: block;
}
#container {
    margin: 0 auto;
    font-size: 14px;
    font-family: Century Gothic;
    text-align: center;
    padding: 0%;

}
.lum_footer{
	display: none;
}
.login_fb {
	width: 50%;
	height: 50px;
	float: left;
	cursor: pointer;
}
.login_gmail{
	width: 50%;
	height: 50px;
	float: right;
	cursor: pointer;
}
.login_fb img{
	width:100%;
	height: 50px;
}
.login_gmail img{
	width: 100%;
	height: 50px;
}
.lum_footer{
	display: none;
}

.display_desktop.login_image_page img {
    height: 500px;
}
}
@media only screen and (min-width: 1200px) {
  .container-fluid{
	width: 100%;

	background-repeat: no-repeat;
	background-size: 100% 100%;
	/*height: 500px;*/

}

#login-box {

    position:relative;
    display:inline-block;
    z-index:0;
    width:90%;
    max-width: 360px;
    margin: 0% 0%;
    padding: 3%;
}
.display_desktop{
	display: block;
}
#container {
    margin: 0 auto;
    font-size: 14px;
    font-family: Century Gothic;
    text-align: center;
    padding: 0%;

}
.lum_footer{
	display: none;
}
.login_fb {
	width: 50%;
	height: 60px;
	float: left;
	cursor: pointer;
	clear: both;
}
.login_gmail{
	width: 50%;
	height: 60px;
	float: right;
	cursor: pointer;

}
.login_fb img{
	width:100%;
	padding: 0% 2%;
	height: auto;
}

.login_gmail img{
	width: 100%;
	padding: 0% 2%;
	height: auto;
}
.lum_footer{
	display: none;
}

.display_desktop.login_image_page img {
    height: 500px;
    padding-left: 35%;
}
.lum_footer{
	display:block;
}

}

.lum_login {
text-align:left
}

button#fgt_pswd {
    background-color: white;
    color: #004F70;
    text-align: left;
    border: none;
    font-size: 10px;
		width: 50%;
		float: left;
}
button#create_new_user {
	background-color: white;
	color: #004F70;
	text-align: left;
	border: none;
	font-size: 10px;
	width:50%;
}
button#login_old_user {
	background-color: white;
	color: #004F70;
	text-align: center;
	border: none;
	font-size: 10px;

}
p.text-account{
	margin-top: 10px;
	font-size: 10px;
}
</style>

<div class="container-fluid" style="padding: 0px;">
	<div class="col-md-6 col-sm-6 col-xs-12" style="padding: 0px;">
		<div class="display_desktop login_image_page">
			<img class="img-responsive" src="<?=base_url() ?>images/login_images/login_image.png">
		</div>
	</div>
	<div class="col-md-6 col-sm-6 col-xs-12">
		<!--<div class=" display_desktop logo_image_page ">
								<img src="<?=base_url() ?>images/login_images/stylior_logo.png" width="200px">
		</div>-->
		<div id="login-box" style="display: block; opacity: 1; visibility: visible;margin-top:-1%;">
			<div id="login-step-choose-page" style="display: block;">




				<form class="form-signin" method="post" action="/home/auth">

				<div class="form-group">
					<input type="email" name="email" class="form-control" id="inputEmail" placeholder="EMAIL" required>
				</div>
				<div class="form-group">
					<input type="password" name="password" class="form-control" id="inputPassword" placeholder="PASSWORD" required>
				</div>
				<!--<a>Forgot password?</a>-->
				<button type="submit" class="btn btn-1 btn-1a">LOG IN </button>

				</form>

				<button type="submit" id="fgt_pswd" class="btn btn-1 btn-1a fgt_pass">Forgot Password ?</button>
				<button class="btn btn-1 btn-1a" id="create_new_user">CREATE ACCOUNT</button>
				<div class="forgotpswd" style="display:none;" >
									<input style="width:79%;" type="email" class="inputfieldf" name="forgotpassword"  id="f_pswd" placeholder="Please Enter Email " required>
									<button class="forgot"  id=" forgotinput"  name="forgotpasswordbutton" class="btn-info">Submit </button>
									</div>


				<div class="login_fb">
					<a href="/hauth/signin_with_hybridauth/facebook" ><img src="<?=base_url() ?>images/login_images/login_facebook.png"></a>
				</div>
				<div class="login_gmail">
					<a href="/hauth/signin_with_hybridauth/google" ><img src="<?=base_url() ?>images/login_images/login_gmail.png"></a>
				</div>
                 <!--<a href="/home/registration" >-->
				<!--<button class="btn btn-1 btn-1a" id="create_new_user">CREATE ACCOUNT</button><!--</a>-->
				<h4> OR </h4>
				<form class="form-guest-checkout" method="post" action="<?= $bas_ul ?>home/guestlogin">

				<h4> Continue as a Guest </h4>
				<div class="form-group">
				<input type="hidden" name="action" value="guestlogin"/>
					<input type="email" name="guestemail" class="form-control" id="inputEmail" placeholder="EMAIL" required autofocus>
				</div>
				<button type="submit" style="margin-top:-4%;" class="btn btn-1 btn-1a">CHECK OUT</button>
			</form>
			</div>
			<div id="login-step-info-page" class="login-step" style="display: none;">

				<form action="<? echo $bas_ul?>home/registration" method="post" id="regform">
						<input name="action" class="inputfield" value="registration" type="hidden">
				<div class="form-group">
					<!--<input type="text" name="name" class="form-control" id="name" placeholder="NAME" required>-->
					<input type="text" class="form-control" name="reg_username" id="reg_user" placeholder="NAME" required>
				</div>
				<div class="form-group">
					<!--<input type="text" name="email" class="form-control" id="email" placeholder="EMAIL" required>-->
					<input type="email" name="reg_email"  id="reg_e" class="form-control" placeholder="EMAIL" required>
				</div>
				<div class="form-group">
					<!--<input type="password" name="password" class="form-control" id="password" placeholder="PASSWORD" required>-->
					<input type="password" class="form-control" name="reg_password" id="reg_pwd" placeholder="PASSWORD" required>
				</div>

				<div class="form-group">
					<!--<input type="password" name="password" class="form-control" id="cpassword" placeholder="CONFIRM PASSWORD" required>-->
					<input type="password" class="form-control" name="c_password"  id="c_pwd" placeholder="CONFIRM PASSWORD" required>
				</div>
				<!--<button class="btn btn-1 btn-1a">REGISTER </button>-->
				<button class="but_lum_ang" onclick="validate()">REGISTER </button>
			</form>
				<!--<div class="login_fb">
					<a href="/hauth/signin_with_hybridauth/facebook" ><img src="<?=base_url() ?>images/login_images/signup_facebook.png"></a>
				</div>
				<div class="login_gmail">
					<a href="/hauth/signin_with_hybridauth/google" ><img src="<?=base_url() ?>images/login_images/signup_gmail.png"></a>
				</div>-->
				<p class="text-account">Already have an account? </p>
				<button class="btn btn-1 btn-1a" id="login_old_user">CLICK HERE TO LOG IN</button>
			</div>
		</div>
	</div>
</div>


<script type="text/javascript">

$(document).ready(function(){

	$(".fgt_pass").click(function(){
		//alert('haii');
		$(".form-signin").toggle();
	 $(".forgotpswd").toggle();
	});
    $("#create_new_user").click(function(){
        $("#login-step-choose-page").hide();
        $("#login-step-info-page").show();

    });
    $("#login_old_user").click(function(){
        $("#login-step-info-page").hide();
        $("#login-step-choose-page").show();

    });
});
</script>

<script>


	$(".forgot").on("click",function()
	{
		 var email_recovery = $("#f_pswd").val();
		 alert(email_recovery);

	//var addrId=$(this).attr("data-attr");
	//alert("hai");
	$.ajax({
		url:'<?= $bas_ul ?>home/forgotten_passwor',
		method:'POST',
		data:{recmail : email_recovery},

		success: function(response)
				{
					alert(response);
					alert('Your PASSWORD Send to Your Register Mail');
					//document.location.href='http://www.stylior.com/home/lum_login;
				               //$(".se-pre-con").fadeOut("slow");
								window.location.href= "http:///www.stylior.com/home/lum_login";
						         //alert(response);
							}


	});

});




</script>
<script>
$("#c_pwd").blur(function()
{

	  var password = $("#reg_pwd").val();
      var confirmPassword = $("#c_pwd").val();
            if (password != confirmPassword)
			{
                alert("Passwords do not match.");
                return false;
            }
            return true;


});


    function validate()
   {

		var fname = document.getElementById('reg_user').value;
		var regemail = document.getElementById('reg_e').value;
		 var regpwe = document.getElementById('reg_pwd').value;



		if($.trim(fname).length < 3)
		{
			alert('Please Provide valid  Name');
			return false;
		}
     	else if($.trim(regemail).length < 3)
		{
			alert('Please Provide Valid email');
			return false;
		}

     	else if($.trim(regpwe).length < 3)
		{
			alert('Please Valid password of minimum 4 characters');
			return false;
		}



	document.regform.submit();
	}



	function emailvalidate()
	{
		var email = $("#reg_e").val();


		var url = '<?=base_url() ?>home/checkemail/';
		$.ajax({
		url:url,
		type:'post',
		data:'email='+email,
		success:function(msg)
		{
			//alert(msg);
			if(msg !=""){
				alert("Email Id Already Exist.!!");
			} else {
				return true;
			}
			$("#reg_email").val('');
			//alert("Thank you for your subscription.!!");
		}
		});
	}
</script>

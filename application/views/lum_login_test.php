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
<section class="login-section">
	<div class="col-lg-6 col-lg-offset-6 col-md-7 col-md-offset-5 col-sm-8 col-sm-offset-2 col-xs-12 login-right">
		<div class="row login-formWrapper login-step-choose-page" style="display: block;">
            <form class="form-signin" method="post" action="/home/auth">
				<div class="row">
					<div class="col-md-7">
						<div class="input-group form-group">
							<span class="form-icon"><i class="username fa fa-user"></i></span>
							<input type="email" name="email" class="form-control" id="inputEmail" placeholder="EMAIL" required>
						</div>
						
						<div class="input-group form-group">
							<span class="form-icon"><i class="password fa fa-lock"></i></span>
							<input type="password" name="password" class="form-control" id="inputPassword" placeholder="PASSWORD" required>
						</div>
                        <div class="login-button">
                            <button type="submit" class="btn btn-login">LOG IN </button>
                        </div> 
					</div>
					
					<div class="col-md-5">
                        <a class="btn btn-facebook social-link" href="/hauth/signin_with_hybridauth/facebook" ><i class="fa fa-facebook"></i>Connect with Facebook</a>
                        <a class="btn btn-google-plus social-link" href="/hauth/signin_with_hybridauth/google" ><i class="fa fa-google-plus"></i>Connect with Google Plus</a>	
					</div>
				</div>
                <div class="row signup">
                    <div class="col-md-5 col-xs-6">
                        <button class="btn btn-1 btn-1a" id="create_new_user">Create Account</button>
                    </div>
                    <div class="col-md-4 col-xs-6">
                        <button type="submit" id="fgt_pswd" class="btn btn-1 btn-1a fgt_pass">Forgot Password ?</button>
                    </div>
            	</div>		
			</form>
		</div>
        
        <div class="row forget_pswd" style="display: none;">
            <div class="forgotpswd">
                <div class="input-group form-group">
                <input type="email" class="inputfieldf form-control" name="forgotpassword"  id="f_pswd" placeholder="Please Enter Email " required>
                <button class="btn-forget forgot" id=" forgotinput"  name="forgotpasswordbutton">Submit </button>
                </div>
                <button class="btn btn-1 btn-1a" id="back_to_login"><i class="fa fa-angle-double-left"></i>Back</button>
            </div>
        </div>
        
		<div class="row create_account" style="display: none;">
            <div class="col-md-10">
                <form action="<? echo $bas_ul?>home/registration" method="post" id="regform">
                <input name="action" class="inputfield" value="registration" type="hidden">
                <div class="form-group">
                <input type="text" class="form-control" name="reg_username" id="reg_user" placeholder="NAME" required>
                </div>
                <div class="form-group">
                <input type="email" name="reg_email"  id="reg_e" class="form-control" placeholder="EMAIL" required>
                </div>
                <div class="form-group">
                <input type="password" class="form-control" name="reg_password" id="reg_pwd" placeholder="PASSWORD" required>
                </div>
                
                <div class="form-group">
                <input type="password" class="form-control" name="c_password"  id="c_pwd" placeholder="CONFIRM PASSWORD" required>
                </div>
                <button class="btn-register" onclick="validate()">REGISTER </button>
                </form>
                <p class="text-account">Already have an account? </p>
                <button class="btn btn-1 btn-1a" id="login_old_user">Click here to log in</button>
            </div>
		</div>
        
        <div class="row guest_login">
        
        	<div class="col-md-12">
                <h4>Continue as a Guest </h4>
                <form class="form-guest-checkout" method="post" action="<?= $bas_ul ?>home/guestlogin">
                <div class="form-group">
                <input type="hidden" name="action" value="guestlogin"/>
                <input type="email" name="guestemail" class="form-control" id="inputEmail" placeholder="EMAIL" required autofocus>
                </div>
                <button type="submit" class="btn btn-1 btn-1a guest_user">Log In</button>
                </form>
            </div>
        </div>
        
    </div>
</section>


<!-- new login form code -->

<!-- new login form code End-->



<script type="text/javascript">

$(document).ready(function(){
	
	
	
	
	

	$(".fgt_pass").click(function(){
		//alert('haii');
		$(".forget_pswd").show();
		$(".login-step-choose-page").hide();
		$(".guest_login").hide();
	});
    $("#create_new_user").click(function(){
        $(".login-step-choose-page").hide();
		$(".guest_login").hide();
        $(".create_account").show();

    });
    $("#login_old_user").click(function(){
        $(".create_account").hide();
        $(".login-step-choose-page").show();

    });
	
	$("#back_to_login").click(function(){
		$(".login-step-choose-page").show();
		$(".forget_pswd").hide();
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

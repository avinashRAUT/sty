
<meta name="viewport" content="width=100%, initial-scale=1">
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<style type="text/css">
  .main-content{
      text-align: center;
      color: grey;
      padding: 30px;
      letter-spacing: 2px;
      line-height: 27px;
  } 

/*deven start */
 /*success declined */
.success-1, .declined-1  {
 max-width:700px; padding:20px 50px; border:2px solid #CDCDCD; margin:0 auto; display:block; margin-top:20px;}
.success-1, .declined-1 { 
 text-align:center; color:rgba(70,70,70,1.00)}
.success-1 h2, .declined-1 h2{ font-size:20px; }
.success-1 h2 b{
 color:#172951
 }
.success-1 h2 b.green{
 color:rgba(16,139,2,1.00)}
.declined-1 h2 b.red{
 color:rgba(212,0,3,1.00)
 }
.success-1 h2 span, .declined-1 h2 span{
  height: 2px;
    margin: 10px auto 15px;
    display: block;
    background-color: #CFCFCF;
 max-width:100px;
 }
.success-1 i , .declined-1 i  {
 margin-left:5px; color:#B5B5B5}
.success-1 a , .declined-1 a  { color:rgba(33,33,33,1.00); }
.success-1 a:hover , .declined-1 a:hover  { color:rgba(33,33,33,1.00); }
/*success declined end */
/*end deven*/


</style>


<script type="text/javascript">
(function(doc) {

    var addEvent = 'addEventListener',
        type = 'gesturestart',
        qsa = 'querySelectorAll',
        scales = [1, 1],
        meta = qsa in doc ? doc[qsa]('meta[name=viewport]') : [];

    function fix() {
        meta.content = 'width=device-width,minimum-scale=' + scales[0] + ',maximum-scale=' + scales[1];
        doc.removeEventListener(type, fix, true);
    }

    if ((meta = meta[meta.length - 1]) && addEvent in doc) {
        fix();
        scales = [.25, 1.6];
        doc[addEvent](type, fix, true);
    }

}(document));
</script>
<script type="text/javascript">
(function(doc) {

	var addEvent = 'addEventListener',
	    type = 'gesturestart',
	    qsa = 'querySelectorAll',
	    scales = [1, 1],
	    meta = qsa in doc ? doc[qsa]('meta[name=viewport]') : [];

	function fix() {
		meta.content = 'width=device-width,minimum-scale=' + scales[0] + ',maximum-scale=' + scales[1];
		doc.removeEventListener(type, fix, true);
	}

	if ((meta = meta[meta.length - 1]) && addEvent in doc) {
		fix();
		scales = [.25, 1.6];
		doc[addEvent](type, fix, true);
	}

}(document));
</script>
<!-- /header -->
<main class="cd-main-content">
<style>
.titalbarmainuss{ left: 50%;
    margin-right: -50%;
    position: absolute;
    text-align: center;
    top: 50%;
    transform: translate(-50%, -50%);}
	
.titalbarmainuss h1	{ color: #000;
    font-size: 48px;
    font-weight: 400;
    letter-spacing: 0.01em;
    line-height: 48px;
    margin-bottom: 0;}
	
	
.titalbarmainuss span{color: #999;
    font-size: 16px;
    font-style: italic;
    font-weight: 400;
    letter-spacing: 0.025em;
    line-height: 37px;}	
	
</style>

 <div class="gap5 blue"></div>
<div class="container">
 <div class="row">


<?php if($status=="success"){ ?>
 <div class="success-1">
 <img class="img-center" src="<?= base_url() ?>images/success-icon.jpg" width="52" height="52" alt=""/>
  <h2><b class="green">Thank you!</b> for shopping with <b>Stylior.com</b>
    <span></span>
  </h2>
 <p>We'll get started on your order right away. You Should be receiving an order confirmation email shortly.</p>
 <p>If you have any questions reach us on <i class="fa fa-envelope" aria-hidden="true"></i> <a href="mailto:info@stylior.com" target="_blank">info@stylior.com</a></p>
 </div>
 <?php }else if($status=="failure"){?>
	<div class="declined-1">
	<img class="img-center" src="<?= base_url() ?>images/cancelled-icon.jpg" width="52" height="52" alt=""/>
	<h2><b class="red">Payment Declined !</b> for shopping with <b>Stylior.com</b>
	  <span></span>
	</h2>
	 <p>We'll get started on your order right away. You Should be receiving an order confirmation email shortly.</p>
	 <p>If you have any questions reach us on <i class="fa fa-envelope" aria-hidden="true"></i><a href="mailto:info@stylior.com" target="_blank">info@stylior.com</a></p>
 </div>

 <?php } ?>

 </div>
</div>


<div class="gap20"></div>

<section class="category-header">
		<div class="titalbarmainuss">
		 <!--<h1 class="category-title">Be Unique</h1>
			<span class="category-subtitle">Explore Our Collections</span>-->
		</div>
	</section>
<div class="panel panel-dark">
  <div id="discovery-container">
    <div class="discovery-section hide page-container-responsive" id="upcoming-trips">
      <div class="section-intro text-center row-space-6 row-space-top-8">
        <h2 class="row-space-1 strong">

   
        </h2>
      </div>
      <div class="discovery-tiles">
        <div class="homepage-module"></div>
      </div>
    </div>

    <div class="discovery-section hide page-container-responsive" id="discovery-saved-searches">
      <div class="section-intro text-center row-space-6 row-space-top-8">
        <h2 class="row-space-1 strong">
        </h2>
      </div>
      <div class="discovery-tiles">
        <div class="homepage-module"></div>
      </div>
    </div>

    <div class="discovery-section hide page-container-responsive" id="weekend-recommendations">
    </div>

    <!-- <div class="discovery-section page-container-responsive row-space-6" id="discover-recommendations">
      
       <div class="main-content container">
            <h1 class="page-title"><?php echo $thankyou; ?></h1>
       </div>
      
    </div> -->
  </div>
</div>
    <script type='text/javascript'>
    var _refiral = _refiral || {};
    _refiral.apiKey = '0e7c7d6c41c76b9ee6445ae01cc0181d';
    _refiral.customerName = '';
    _refiral.customerEmail = '';
    _refiral.grandTotal = '';
    _refiral.subTotal = '';
    _refiral.couponCode = '';
    _refiral.orderId = '';
    _refiral.currency = '';
    (function(){var ref=document.createElement('script');ref.type='text/javascript';ref.async=true;ref.src='https://cdn.refiral.com/libs/refiral-sales.min.js';var s=document.getElementsByTagName('script')[0];s.parentNode.insertBefore(ref,s);})();
    </script>
<div class="trust hide-sm">
</div>

<!-- Google Code for Stylior conversion Conversion Page -->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 944563445;
var google_conversion_language = "en";
var google_conversion_format = "3";
var google_conversion_color = "ffffff";
var google_conversion_label = "eAv7CJD9tmcQ9cmzwgM";
var google_remarketing_only = false;
/* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//www.googleadservices.com/pagead/conversion/944563445/?label=eAv7CJD9tmcQ9cmzwgM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>

<script type='text/javascript'>var _refiral = _refiral || {};_refiral.apiKey = '0e7c7d6c41c76b9ee6445ae01cc0181d';_refiral.customerName = '';_refiral.customerEmail = '';_refiral.grandTotal = '';_refiral.subTotal = '';_refiral.couponCode = '';_refiral.orderId = '';_refiral.currency = '';(function(){var ref=document.createElement('script');ref.type='text/javascript';ref.async=true;ref.src='https://cdn.refiral.com/libs/refiral-sales.min.js';var s=document.getElementsByTagName('script')[0];s.parentNode.insertBefore(ref,s);})();</script>
	
  </body>
</html>
<!-- ver. 96889fb0bcd348517861d9bd119b4a86c65cc81f -->
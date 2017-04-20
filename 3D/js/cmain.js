




$(function(){  

$("#theImg13").click(function(){
	alert('hii');
	$('#theImg13').remove();
	
});

$(".tick13").click(function(){
//alert('dfgyhftgh');
			
					$(this).append('<img id="theImg13" src="http://1373411880.rsc.cdn77.org/3dshirt/images/tick.png" />');
					
					})



$(".tick12").click(function(){
//alert('dfgyhftgh');
			$('#theImg12').remove();
					$(this).append('<img id="theImg12" src="http://1373411880.rsc.cdn77.org/3dshirt/images/tick.png" />');
					
					})
$(".tick11").click(function(){
//alert('dfgyhftgh');
			$('#theImg11').remove();
					$(this).append('<img id="theImg11" src="http://1373411880.rsc.cdn77.org/3dshirt/images/tick.png" />');
					
					})


		$(".tick1").click(function(){

			$('#theImg1').remove();
					$(this).append('<img id="theImg1" src="http://1373411880.rsc.cdn77.org/3dshirt/images/tick.png" />');
					
					})	

$(".tick").click(function(){
			$('#theImg').remove();
					$(this).append('<img id="theImg" src="http://1373411880.rsc.cdn77.org/3dshirt/images/tick.png" />');
					
					})
					
					
		
	


	

$("#inneryes").click(function()
{
	//alert('fdsgdh');
	$("#innerdiv").show();

	
});
$("#innerno").click(function()
{
	//alert('fdsgdh');
	$("#innerdiv").hide();

	
});



$("#noneall").click(function()
{
	//alert('fdsgdh');
	$("#collarandcuffs").hide();
$("#onlycollar").hide();
	
});


$("#collarandcuff").click(function()
{
	//alert('fdsgdh');
	$("#collarandcuffs").show();
$("#onlycollar").hide();
	
});


$("#collaronly").click(function()
{
	//alert('fdsgdh');
	$("#collarandcuffs").hide();
$("#onlycollar").show();
	
});

$("#nonesignature").click(function()
{
	//alert('fdsgdh');
	$("#intial").hide();
$("#name").hide();
	
});


$("#intialsignature").click(function()
{
	//alert('intail');
	$("#intial").show();
$("#name").hide();
	
});


$("#namesignature").click(function()
{
	//alert('intail');
	$("#intial").hide();
$("#name").show();
	
});


 $("#ho4").click(function(){ 

//alert('hii');
$("#shirtcontent").hide();
$("#trousercontent").hide();
$("#waistcontent").show();
$("#blazercontent").hide();

}); 

 $("#ho5").click(function(){ 

//alert('hii');
$("#shirtcontent").hide();
$("#trousercontent").hide();
$("#waistcontent").hide();
$("#blazercontent").show();

}); 




$("#pant").mouseenter(function(){ 

//alert('hii');
$("#img2").show();


});

$("#pant").mouseleave(function(){ 

//alert('hii');
$("#img2").hide();


}); 
$("#ho4").mouseenter(function(){ 

//alert('hii');
$("#img3").show();


});

$("#ho4").mouseleave(function(){ 

//alert('hii');
$("#img3").hide();


});  
$("#ho5").mouseenter(function(){ 

//alert('hii');
$("#img4").show();


});

$("#ho5").mouseleave(function(){ 

//alert('hii');
$("#img4").hide();


});  

$(".fabric").click(function(){  
$(".hiddenfabric").show();
$(".collarcontent").hide();
$(".sleevescontent").hide(); 
$(".cuffscontent").hide();
$(".pocketcontent").hide();
$(".placketcontent").hide();
$(".backcontent").hide();
$(".bottamcontent").hide();
$(".outercontent").hide();
$(".signaturecontent").hide();
$(".innercontent").hide();
$(".buttonscontent").hide();
//alert('kfdavfdfvfdvsvfvfd');
$(this).css("width" , "70px"  );
$(this).css("padding" , "6px");

//alert('hii');

});  

$(".sleeve").click(function(){  
$(".sleevescontent").show();
$(".collarcontent").hide();
$(".hiddenfabric").hide();
$(".cuffscontent").hide();
$(".pocketcontent").hide();
$(".placketcontent").hide();
$(".backcontent").hide();
$(".bottamcontent").hide();
$(".outercontent").hide();
$(".signaturecontent").hide();
$(".innercontent").hide();
$(".buttonscontent").hide();
  
});  
$(".collar").click(function(){  
$(".collarcontent").show();
$(".sleevescontent").hide(); 
$(".hiddenfabric").hide();
$(".cuffscontent").hide();
    $(".buttonscontent").hide();
	$(".pocketcontent").hide();
	$(".placketcontent").hide();
	$(".backcontent").hide();
	$(".bottamcontent").hide();
$(".signaturecontent").hide();
$(".outercontent").hide();
$(".innercontent").hide();
$(".buttonscontent").hide();
}); 

$(".cuffs").click(function(){
$(".cuffscontent").show();
   $(".buttonscontent").hide();
$(".collarcontent").hide();
$(".sleevescontent").hide(); 
$(".hiddenfabric").hide();
$(".pocketcontent").hide();
$(".placketcontent").hide();
$(".backcontent").hide();
$(".bottamcontent").hide();
$(".innercontent").hide();
$(".outercontent").hide();
});

$(".button").click(function(){
	//alert('fdghsdfj');
$(".cuffscontent").hide();
  $(".buttonscontent").show();
$(".collarcontent").hide();
$(".sleevescontent").hide(); 
$(".hiddenfabric").hide();
$(".pocketcontent").hide();
$(".placketcontent").hide();
$(".backcontent").hide();
$(".bottamcontent").hide();
$(".signaturecontent").hide();
$(".outercontent").hide();
$(".innercontent").hide();
});

$(".pocket").click(function(){
	//alert('fdghsdfj');
$(".cuffscontent").hide();
  $(".buttonscontent").hide();
$(".collarcontent").hide();
$(".sleevescontent").hide(); 
$(".hiddenfabric").hide();
$(".pocketcontent").show();
$(".placketcontent").hide();
$(".backcontent").hide();
$(".bottamcontent").hide();
$(".signaturecontent").hide();
$(".outercontent").hide();
$(".innercontent").hide();
});



$(".placket").click(function(){
	//alert('fdghsdfj');
$(".cuffscontent").hide();
  $(".buttonscontent").hide();
$(".collarcontent").hide();
$(".sleevescontent").hide(); 
$(".hiddenfabric").hide();
$(".pocketcontent").hide();
$(".placketcontent").show();
$(".backcontent").hide();
$(".bottamcontent").hide();
$(".signaturecontent").hide();
$(".outercontent").hide();
$(".innercontent").hide();
});





$(".back").click(function(){
	//alert('fdghsdfj');
$(".cuffscontent").hide();
  $(".buttonscontent").hide();
$(".collarcontent").hide();
$(".sleevescontent").hide(); 
$(".hiddenfabric").hide();
$(".pocketcontent").hide();
$(".placketcontent").hide();
$(".backcontent").show();
$(".bottamcontent").hide();
$(".signaturecontent").hide();
$(".outercontent").hide();
$(".innercontent").hide();
});




$(".bottom").click(function(){
	//alert('fdghsdfj');
$(".cuffscontent").hide();
  $(".buttonscontent").hide();
$(".collarcontent").hide();
$(".sleevescontent").hide(); 
$(".hiddenfabric").hide();
$(".pocketcontent").hide();
$(".placketcontent").hide();
$(".backcontent").hide();
$(".bottamcontent").show();
$(".signaturecontent").hide();
$(".outercontent").hide();
$(".innercontent").hide();
});



$(".signature").click(function(){
	//alert('fdghsdfj');
$(".cuffscontent").hide();
  $(".buttonscontent").hide();
$(".collarcontent").hide();
$(".sleevescontent").hide(); 
$(".hiddenfabric").hide();
$(".pocketcontent").hide();
$(".placketcontent").hide();
$(".backcontent").hide();
$(".bottamcontent").hide();
$(".signaturecontent").show();
$(".outercontent").hide();
$(".innercontent").hide();
});

$(".outer").click(function(){
	//alert('fdghsdfj');
$(".cuffscontent").hide();
  $(".buttonscontent").hide();
$(".collarcontent").hide();
$(".sleevescontent").hide(); 
$(".hiddenfabric").hide();
$(".pocketcontent").hide();
$(".placketcontent").hide();
$(".backcontent").hide();
$(".bottamcontent").hide();
$(".signaturecontent").hide();
$(".outercontent").show();
$(".innercontent").hide();

});

$(".inner").click(function(){
	//alert('fdghsdfj');
$(".cuffscontent").hide();
  $(".buttonscontent").hide();
$(".collarcontent").hide();
$(".sleevescontent").hide(); 
$(".hiddenfabric").hide();
$(".pocketcontent").hide();
$(".placketcontent").hide();
$(".backcontent").hide();
$(".bottamcontent").hide();
$(".signaturecontent").hide();
$(".outercontent").hide();
$(".innercontent").show();


});


$(".pantfabric").click(function(){
	//alert('fdghsdfj');
$(".trouserfabric").show();
 $(".pantbelt").hide();
$(".pantfrontpleat").hide();
 $(".pantsidepocket").hide();
   $(".pantsidebutton").hide();
   $(".pantbackpocket").hide();
     $(".pantbackpleat").hide();
});


$(".belt").click(function(){
	//alert('fdghsdfj');
$(".trouserfabric").hide();
 $(".pantbelt").show();
$(".pantfrontpleat").hide();
$(".pantsidepocket").hide();
  $(".pantsidebutton").hide();
  $(".pantbackpocket").hide();
    $(".pantbackpleat").hide();
});

$(".frontpleat").click(function(){
	//alert('fdghsdfj');
$(".trouserfabric").hide();
 $(".pantbelt").hide();
 $(".pantfrontpleat").show();
 $(".pantsidepocket").hide();
   $(".pantsidebutton").hide();
   $(".pantbackpocket").hide();
     $(".pantbackpleat").hide();
});

$(".sidepocket").click(function(){
	//alert('fdghsdfj');
$(".trouserfabric").hide();
 $(".pantbelt").hide();
 $(".pantfrontpleat").hide();
  $(".pantsidepocket").show();
   $(".pantsidebutton").hide();
   $(".pantbackpocket").hide();
     $(".pantbackpleat").hide();
});


$(".sidebutton").click(function(){
	//alert('fdghsdfj');
$(".trouserfabric").hide();
 $(".pantbelt").hide();
 $(".pantfrontpleat").hide();
  $(".pantsidepocket").hide();
   $(".pantsidebutton").show();
   $(".pantbackpocket").hide();
     $(".pantbackpleat").hide();
});

$(".backpocket").click(function(){
	//alert('fdghsdfj');
$(".trouserfabric").hide();
 $(".pantbelt").hide();
 $(".pantfrontpleat").hide();
  $(".pantsidepocket").hide();
   $(".pantsidebutton").hide();
    $(".pantbackpocket").show();
   $(".pantbackpleat").hide();
});

$(".backpleakt").click(function(){
	//alert('fdghsdfj');
$(".trouserfabric").hide();
 $(".pantbelt").hide();
 $(".pantfrontpleat").hide();
  $(".pantsidepocket").hide();
   $(".pantsidebutton").hide();
    $(".pantbackpocket").hide();
     $(".pantbackpleat").show();
});





});


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
$suit_data_options= array("vest_coat"=>"part","inner_lining"=>"part","jacket_style"=>"part","suspender_button"=>"part","body_fit"=>"part","lapel"=>"part","jacket_button"=>"part","vents"=>"part","suit_pocket"=>"pair","chest_pocket"=>"pair","lapel_button_hole"=>"part","cuff_accent_stitching"=>"part","cuff_button_style"=>"part","pleats"=>"part","belt"=>"part","bottom_cuff"=>"part","back_pocket"=>"part","trouser_button"=>"part","measurements");
$shirt_data_options= array("model","sleeve","cuff","collar","placket","bottom_hem","button_placket","button_collar","button_cuff","pocket","back_pleat","contrast_cuff","contrast_collar","contrast_placket");
$shirt_measurement_array=array("standardsize","length","fitype","WEIGHTkg","shoulder","neck","shirt_length","chest","waist");

?>

<style>

/*var added*/
.view_btn{
    border: 1px solid;
    width: auto;
    float: left;
    padding: 4px;
}
.delete_btn{
   border: 1px solid;
    width: auto;
    float:right;
	padding: 4px;
}
/*end var*/
.option_class{
	display: block;
    vertical-align: top;
    text-align: left;
    padding-top: 50px;
    word-wrap: break-word;
    width: 800px;
}
.order2{
	width: 180px;
	height: auto;
	display:inline-block;
	vertical-align:top;
	width:10%;
}
.order1{
	display: inline-flex;
}
.lum_cut_menu
{
	font-family:Century Gothic;
}
.lum_height_content
{
	text-align:center;
}
	.tab_address_lum_inner
	{
		margin:5px;
	}

	.lum_sub_menu
	{
		margin:10px;
		display:block;
	}

	.slideshow_item
	{
		width:300px;height:50px;
		color:#000;
		font-weight:bold;
		letter-spacing:1px;
		font-size:12px;
		text-align:center;
	}
	.slideshow_item_active
	{
		width:300px;height:50px;
		color:#000;
		font-weight:bold;
		letter-spacing:1px;
		font-size:12px;
	}

	#slideshow{
            margin:0 auto;
            width:300px;
            height:30px;
            overflow: hidden;
            position: relative;
			padding:10px 0px;
        }

        #slideshow ul{
            list-style: none;
            margin:0;
            padding:0;
            position: absolute;
        }

        #slideshow li{
            float:left;
        }

        #slideshow a:hover{
            background: rgba(0,0,0,0.8);
            border-color: #000;
        }

        #slideshow a:active{
            background: #990;
        }

        .slideshow-prev, .slideshow-next{
            position: absolute;
            top:0px;
            font-size: 30px;
            text-decoration: none;
            color:#fff;
            background: rgba(0,0,0,0.5);
            padding: 5px;
            z-index:2;
        }
		#slideshow-next_dum{
			position:relative;
            top:0px;
            font-size: 14px;
            text-decoration: none;
            color:#fff;
            background: rgba(0,0,0,0.5);
            padding: 3px 10px;
            z-index:2;
        }

        .slideshow-prev{
            left:0px;
            border-left: 3px solid #fff;
        }

        .slideshow-next{
            right:0px;
            border-right: 3px solid #fff;
        }

		@media screen and (max-width: 768px) and (min-width: 421px) {
			.lum_sub_menu_item
			{
				display:inline-block;
				padding:10px;
				color:#bbb;
				font-weight:bold;
				letter-spacing:1px;
				font-size:12px;
				cursor:pointer;
				width:13%;
			}
			.lum_avg_words>img
			{
				width:110px;
			}
			.lum_avg_num>img
			{
				width:110px;
			}
			.lum_avg_words_dis>img
			{
				width:110px;
			}
			.lum_avg_num_dis>img
			{
				width:110px;
			}
			.lum_sub_menu_item_active
			{
				display:inline-block;
				padding:10px;
				color:#000;
				font-weight:bold;
				letter-spacing:1px;
				font-size:12px;
				cursor:pointer;
				width:13%;
			}
			.lum_sub_menu
			{
				display:block;
			}
			#slideshow
			{
				display:none;
			}
			.lum_left_pad_large
			{
				padding-left:5%;border-right:2px solid #aaa;
			}
			.lum_class_left_my_acc
			{
				width:30%;display:inline-block;
			}
			.lum_class_gap_my_acc
			{
				width:5%;display:inline-block;
			}
			.lum_class_right_my_acc
			{
				width:63%;color:#aaa;display:inline-block;vertical-align:top;
			}
			.lum_sub_sub_menu_vertical
			{
				width:70%;
				text-align:left;
				padding:10px;
				font-size:14px;
				font-weight:bold;
				letter-spacing:1px;
				color:#aaa;
				cursor:pointer;
			}
			.lum_sub_sub_menu_vertical_active
			{
				width:70%;
				text-align:left;
				padding:10px;
				font-size:14px;
				font-weight:bold;
				letter-spacing:1px;
				cursor:pointer;
			}
					.lum_my_account_form
					{
						padding-left:1%;text-align:left;padding-top:0px;font-size:12px;letter-spacing:1px;font-weight:bold;
					}
					.lum_my_account_form>div
					{
						padding:10px;
					}
					.lum_my_account_form>input
					{
						padding:5px;
					}
					.lum_cont_small
					{
						display:inline-block;
						width:150px;
					}
					.lum_font_for_all
					{ display:inline-block;text-align:center;font-size:12px;letter-spacing:1px;font-weight:bold; }
					.lum_small_pad_ac
					{
						padding-left:30px;
					}
					.class_button_lum
					{
						border:none;
						width:60px;
						padding:5px;
						cursor:pointer;
						border:1px solid #1b3359;
						color:#FFFFFF;
						text-transform:uppercase
					}
					.class_button_lum:hover{
						background-color:#fff;
						border:1px solid #1b3359;
						color:#1b3359
						}
					.class_button_lum1
					{
						background-color:#1b3359;
						border:none;
						width:120px;
						padding:2px;
						cursor:pointer;
						text-transform:uppercase
					}
					.class_button_big_lum
					{
						width:200px;
						background-color:#ff9933;
						border:none;
						padding:4px 2px;
						cursor:pointer;
						color:#fff;
					}
						.tab_spac_lum
						{
							padding:20px;
							font-family:12px;
						}
		}
		@media (min-width: 1900px){
			.lum_avg_words>img
			{
				width:90%;
			}
			.lum_avg_num>img
			{
				width:90%;
			}
			.lum_avg_words_dis>img
			{
				width:90%;
			}
			.lum_avg_num_dis>img
			{
				width:90%;
			}
			.lum_sub_menu_item
			{
				display:inline-block;
				padding:20px;
				color:#bbb;
				font-weight:bold;
				letter-spacing:1px;
				font-size:16px;
				cursor:pointer;
				width:13%;
			}
			.lum_sub_menu_item_active
			{
				display:inline-block;
				padding:20px;
				color:#000;
				font-weight:bold;
				letter-spacing:1px;
				font-size:16px;
				cursor:pointer;
				width:13%;
			}
			.lum_sub_menu
			{
				display:block;
			}
			#slideshow
			{
				display:none;
			}
			.lum_left_pad_large
			{
				padding-left:30%;border-right:2px solid #aaa;
			}
			.lum_class_left_my_acc
			{
				width:30%;display:inline-block;
			}
			.lum_class_gap_my_acc
			{
				width:5%;display:inline-block;
			}
			.lum_class_right_my_acc
			{
				width:63%;color:#aaa;display:inline-block;vertical-align:top;
			}
			.lum_sub_sub_menu_vertical
			{
				width:70%;
				text-align:left;
				padding:10px;
				font-size:14px;
				font-weight:bold;
				letter-spacing:1px;
				color:#aaa;
				cursor:pointer;
			}
			.lum_sub_sub_menu_vertical_active
			{
				width:70%;
				text-align:left;
				padding:10px;
				font-size:14px;
				font-weight:bold;
				letter-spacing:1px;
				cursor:pointer;
			}
			.lum_my_account_form
			{
				padding-left:5%;text-align:left;padding-top:30px;font-size:14px;letter-spacing:1px;font-weight:bold;
			}
			.lum_my_account_form>div
			{
				padding:10px;
			}
			.lum_my_account_form>input
			{
				padding:5px;
			}
			.lum_cont_small
			{
				display:inline-block;
				width:200px;
			}
			.lum_font_for_all
			{ display:inline-block;text-align:center;font-size:16px;letter-spacing:1px;font-weight:bold; }
			.lum_small_pad_ac
			{
				padding-left:100px;
			}
			/*hover*/
			.class_button_lum
			{
				background-color:#1b3359;
				border:none;
				width:100px;
				padding:5px;
				cursor:pointer;
				border:1px solid #1b3359;
				color:#fff;
				margin-top:5px;
				text-transform:uppercase
			}
			.class_button_lum:hover{
				background:#fff;
				color:#1b3359}
			.class_button_lum1
			{
				background-color:#fff;
				border:none;
				width:200px;
				padding:2px;
				cursor:pointer;
				border:1px solid #1b3359;
				text-transform:uppercase
			}
			.class_button_big_lum
			{
				width:200px;
				background-color:#ff9933;
				border:none;
				padding:4px 2px;
				cursor:pointer;
				color:#fff;
			}
				.tab_spac_lum
				{
					padding:50px;
					font-family:14px;
				}
		}
		@media screen and (max-width: 420px) and (min-width: 280px) {
			.lum_sub_menu
			{
				display:none;
			}
			#slideshow
			{
				display:block;
			}
			.lum_left_pad_large
			{
				padding-left:0%;
			}
			.lum_class_left_my_acc
			{
				width:100%;display:inline-block;
			}
			.lum_class_gap_my_acc
			{
				padding:3px;
			}
			.lum_class_right_my_acc
			{
				width:100%;color:#aaa;display:inline-block;vertical-align:top;
			}
			.lum_sub_sub_menu_vertical
			{
				width:38%;
				text-align:center;
				padding:5px;
				font-size:12px;
				font-weight:bold;
				letter-spacing:1px;
				color:#aaa;
				cursor:pointer;
				display:inline-block;
				border-bottom:1px solid #bbb;
				margin:5px 0px;
			}
			.lum_sub_sub_menu_vertical_active
			{
				width:38%;
				text-align:center;
				padding:5px;
				font-size:12px;
				font-weight:bold;
				letter-spacing:1px;
				cursor:pointer;
				display:inline-block;
				border-bottom:1px solid #bbb;
				margin:5px 0px;
			}
					.lum_my_account_form
					{
						padding-left:2%;text-align:left;padding-top:10px;font-size:12px;letter-spacing:1px;font-weight:bold;
					}
					.lum_my_account_form>div
					{
						padding:5px;
					}
					.lum_my_account_form>input
					{
						padding:5px;
					}
					.lum_cont_small
					{
						display:inline-block;
						width:110px;

					}
					.lum_small_pad_ac
					{
						text-align:center;
						background-color:#eee;
						color:#000;
						margin-bottom:10px;
					}
					.lum_switch
					{
						text-align:center;
						width:19.5%;display:inline-block;
						margin-bottom:30px;
					}
					.class_button_lum
					{
						background-color:#1b3359;
						border:none;
						width:60px;
						padding:5px;
						cursor:pointer;
						border:border:1px solid #1b3359;
						color:#fff;
						text-transform:uppercase
					}
					.class_button_lum1
					{
						background-color:#1b3359;
						border:none;
						width:120px;
						padding:2px;
						cursor:pointer;
						text-transform:uppercase
					}
					.class_button_big_lum
					{
						width:200px;
						background-color:#ff9933;
						border:none;
						padding:4px 2px;
						cursor:pointer;
						color:#fff;
					}
						.tab_spac_lum
						{
							padding:20px;
							font-family:12px;
						}
		}
		@media screen and (max-width: 1899px) and (min-width: 769px) {
					.lum_switch11
					{
						text-align:center;
						width:19.5%;display:inline-block;
						margin:0px 10px 30px 10px;
						font-size:12px;
						border:1px solid #eee;
					}
			.lum_avg_words>img
			{
				width:90%;
			}
			.lum_avg_num>img
			{
				width:90%;
			}
			.lum_avg_words_dis>img
			{
				width:90%;
			}
			.lum_avg_num_dis>img
			{
				width:90%;
			}
			.lum_sub_menu_item
			{
				display:inline-block;
				padding:20px;
				color:#bbb;
				font-weight:bold;
				letter-spacing:1px;
				font-size:16px;
				cursor:pointer;
				width:13%;
			}
			.lum_sub_menu_item_active
			{
				display:inline-block;
				padding:20px;
				color:#000;
				font-weight:bold;
				letter-spacing:1px;
				font-size:16px;
				cursor:pointer;
				width:13%;
			}
			.lum_sub_menu
			{
				display:block;
			}
			#slideshow
			{
				display:none;
			}
			.lum_left_pad_large
			{
				padding-left:30%;border-right:2px solid #aaa;
				margin-top:50px;
			}
			.lum_class_left_my_acc
			{
				width:30%;display:inline-block;
			}
			.lum_class_gap_my_acc
			{
				width:5%;display:inline-block;
			}
			.lum_class_right_my_acc
			{
				width:63%;color:#aaa;display:inline-block;vertical-align:top;
			}
			.lum_sub_sub_menu_vertical
			{
				width:70%;
				text-align:left;
				padding:10px;
				font-size:14px;
				font-weight:bold;
				letter-spacing:1px;
				color:#aaa;
				cursor:pointer;
			}
			.lum_sub_sub_menu_vertical_active
			{
				width:70%;
				text-align:left;
				padding:10px;
				font-size:14px;
				font-weight:bold;
				letter-spacing:1px;
				cursor:pointer;
			}
					.lum_my_account_form
					{
						padding-left:5%;text-align:left;padding-top:30px;font-size:14px;letter-spacing:1px;font-weight:bold;
					}
					.lum_my_account_form>div
					{
						padding-top:10px;padding-bottom:10px;
					}
					.lum_my_account_form>input
					{
						padding:5px;
					}
					.lum_cont_small
					{
						display:inline-block;
						width:200px;
					}
					.lum_font_for_all
					{ display:inline-block;text-align:center;font-size:16px;letter-spacing:1px;font-weight:bold; }
					.lum_small_pad_ac
					{
						padding-left:100px;
					}
					.class_button_lum
					{
						/*background-color:#1b3359;*/
						border:none;
						width:100px;
						padding:2px;
						cursor:pointer;
						text-transform:uppercase
					}
					.class_button_lum1
					{
						background-color:#1b3359;
						border:none;
						width:200px;
						padding:2px;
						cursor:pointer;
						text-transform:uppercase
					}
					class_button_big_lum
					{
						width:200px;
						background-color:#ff9933;
						border:none;
						padding:4px 2px;
						cursor:pointer;
						color:#fff;
						text-transform:uppercase
					}
						.tab_spac_lum
						{
							padding:50px;
							font-family:14px;
						}
		}


.tab_lum
	{
		display:inline-block;
		width:33%;
		line-height:28px;
		font-size:14px;
		vertical-align:top;
	}
	.tab_address_lum
	{
		margin-bottom:30px;
	}
	.tab_spac_lum
	{
		padding:50px 50px 10px 50px;
	}
	.tab_address_inner_lum
	{
		font-size:14px;
		line-height:20px;
	}
/*	.tab_address_lum_input
	{
		width:300px;
		padding:5px;
	}
*/	.tab_address_lum_inner
	{
		margin:5px;
		font-size:12px;
		font-weight:bold;
		letter-spacing:1px;
	}
	.tab_address_lum_inner1
	{
		margin:10px 0px;
		font-size:16px;
		font-weight:bold;
		letter-spacing:1px;
		line-height:16px;
	}
	.btn-1a{
		background-color:#1b3359; color:#fff; padding:5px 0; text-align:center; border:1px solid #1b3359 }
	.btn-1a:hover,
.btn-1a:active {

	background: #FFFFFF;
    color: #1b3359;
}
.smsg span{
    background: green;
    padding: 5px 10px;
    color: white;
    display: block;
    width: 17%;
    text-align: center;
    margin: 0 auto;
    max-width: 17%;
    min-width: 50%;
}
.lum_switch11 img{
	max-width:300px;}
</style>
<script>

jQuery(function ($) {
$(".delete-addr").on("click",function(){
	var addrId=$(this).attr("data-attr");
	//alert(addrId);
	$.ajax({
		url:'<?= $base_url_temp ?>home/deletemeasure',
		method:'POST',
		data:{"id":addrId},
		success:function(data){
			location.reload();
		}



	})

})
});

</script>

		<div class='smsg'>
				<?php if($this->session->userdata("smsg")) {?>
						<span class="sessionmessge" style="background: green;padding: 5px 10px;color: white;"><?php echo $this->session->userdata("smsg");?></span>
				<?php $this->session->unset_userdata('smsg'); }?>
		</div>

		<div class="lum_cut_menu">
			<div class="lum_sub_menu">
				

			 <div id="slideshow_item0" onclick="slideshow_itemer(0)" class="lum_sub_menu_item_active">
					<div class="lum_font_for_all">
					<div class="lum_switch" onclick="your_fit_fun(0)">
						<div class="lum_avg_words" style="display:none;">
							<img src="<?=base_url() ?>images/img/lum_myaccount_new.png" />
						</div>
						<div class="lum_avg_num" >
							<img src="<?=base_url() ?>images/img/lum_myaccount_new_hover.png" />
						</div>
					</div>
					<div>MY ACCOUNT</div>
					</div>
				</div>
				
				<div id="slideshow_item1" onclick="slideshow_itemer(1)" class="lum_sub_menu_item">
					<div class="lum_font_for_all">
					<div class="lum_switch" onclick="your_fit_fun(0)">
						<div class="lum_avg_words">
							<img src="<?=base_url() ?>images/img/lum_mywish_new.png" />
						</div>
						<div class="lum_avg_num" style="display:none;">
							<img src="<?=base_url() ?>images/img/lum_mywish_new_hover.png" />
						</div>
					</div>
					<div>WISH LIST</div>
					</div>
				</div>
				
				<div onclick="slideshow_itemer(2)" id="slideshow_item2" class="lum_sub_menu_item">
					<div class="lum_font_for_all">
					<div class="lum_switch" onclick="your_fit_fun(0)">
						<div class="lum_avg_words">
							<img src="<?=base_url() ?>images/img/lum_myorder_new.png" />
						</div>
						<div class="lum_avg_num" style="display:none;">
							<img src="<?=base_url() ?>images/img/lum_myorder_new_hover.png" />
						</div>
					</div>
					<div>MY ORDERS</div>
					</div>
				</div>
			
				<div onclick="slideshow_itemer(3)" id="slideshow_item3" class="lum_sub_menu_item">
					<div class="lum_font_for_all">
					<div class="lum_switch" onclick="your_fit_fun(0)">
						<div class="lum_avg_words">
							<img src="<?=base_url() ?>images/img/lum_viewmeasure_new.png" />
						</div>
						<div class="lum_avg_num" style="display:none;">
							<img src="<?=base_url() ?>images/img/lum_viewmeasure_new_hover.png" />
						</div>
					</div>
					<div>MEASUREMENT</div>
					</div>
				</div>

				<div onclick="slideshow_itemer(4)" id="slideshow_item4" class="lum_sub_menu_item">
					<div class="lum_font_for_all">
					<div class="lum_switch" onclick="your_fit_fun(0)">
						<div class="lum_avg_words">
							<img src="<?=base_url() ?>images/img/lum_addbook_new.png" />
						</div>
						<div class="lum_avg_num" style="display:none;">
							<img src="<?=base_url() ?>images/img/lum_addbook_new_hover.png" />
						</div>
					</div>
					<div>ADDRESS</div>
					</div>
				</div>

				<!--<div onclick="slideshow_itemer(5)" id="slideshow_item5" class="lum_sub_menu_item">
					<div class="lum_font_for_all">
					<div class="lum_switch" onclick="your_fit_fun(0)">
						<div class="lum_avg_words">
							<img src="<?=base_url() ?>images/img/lum_savestyle_new.png" />
						</div>
						<div class="lum_avg_num" style="display:none;">
							<img src="<?=base_url() ?>images/img/lum_savestyle_new_hover.png" />
						</div>
					</div>
					<div>SAVED STYLE</div>
					</div>
				</div>-->
			
			</div>
			<div id="slideshow">
				<a href="javascript:void(0);" onclick="lum_snext_item()" class="slideshow-prev" >&laquo;</a>
				<ul>
					<li><div id="slideshow_item0" onclick="slideshow_itemer(0)" class="slideshow_item">MY ACCOUNT</div></li>
					<li><div id="slideshow_item1" onclick="slideshow_itemer(1)" class="slideshow_item">WISH LIST</div></li>
					<li><div id="slideshow_item2" onclick="slideshow_itemer(2)" class="slideshow_item">MY ORDERS</div></li>
					<li><div id="slideshow_item3" onclick="slideshow_itemer(3)" class="slideshow_item">
					</div></li>
					<li><div id="slideshow_item4" onclick="slideshow_itemer(4)" class="slideshow_item">ADDRESS</div></li>
					<li><div id="slideshow_item5" onclick="slideshow_itemer(5)" class="slideshow_item">SAVED STYLE</div></li>
				</ul>
				<a href="javascript:void(0);" onclick="lum_sprev_item()" class="slideshow-next">&raquo;</a>
			</div>
			<div class="lum_height_content" id="lum_des_content0">
				<div style="margin:0px 0px 50px 0px;">
				<div class="lum_class_left_my_acc">

					<div class="lum_left_pad_large">
						<div id="lum_sub_sub_menu0" onclick="lum_sub_sub_menu(0)" class="lum_sub_sub_menu_vertical_active">EDIT PROFILE</div>
						<div id="lum_sub_sub_menu1" onclick="lum_sub_sub_menu(1)" class="lum_sub_sub_menu_vertical">MY WALLET</div>
						<div id="lum_sub_sub_menu2" onclick="lum_sub_sub_menu(2)" class="lum_sub_sub_menu_vertical">GIFT VOUCHER</div>
						<div id="lum_sub_sub_menu3" onclick="lum_sub_sub_menu(3)" class="lum_sub_sub_menu_vertical">RESET PASSWORD</div>
					</div>

				</div>
				<div class="lum_class_gap_my_acc">

				</div>
				<?php //echo "<pre>";
				//print_r($dashboard);die;

				foreach($dashboard as $acc){

					//print_r($_SERVER['HTTP_HOST']);
					//$url=$this->config->item('base_url_temp');
					//print_r($url);
					?>
				<div class="lum_class_right_my_acc">
					<!-- start avr -->

					<!-- end  avr -->
					<div id="lum_right_sub_sub0">
						<div class="lum_my_account_form">
						<form class="form-horizontal" method="post" name="edit_users" action="<?php echo $this->config->item('base_url_temp');?>account/edit_users">
						<input type="hidden" name="action" value="edit_users">
						<div class="lum_small_pad_ac">ACCOUNT DETAILS</div>
						<div><div class="lum_cont_small">NAME : </div><div style="display:inline-block;"><input type="text" style="width:200px;" name="username" value="<?php echo $acc->username?>" ></div></div>
						<div><div class="lum_cont_small">EMAIL : </div><div style="display:inline-block;"><input type="text" style="width:200px;" name="email" value="<?php echo $acc->email?>" readonly></div></div>
						<div><div class="lum_cont_small">PHONE : </div><div style="display:inline-block;"><input type="text" style="width:200px;" name="phone" value="<?php echo $acc->phone?>"></div></div>
						<div><div align="left">
						<button class="class_button_lum">Update</button></div></div>
						</form>
						</div>
					</div>
					<div id="lum_right_sub_sub1" style="display:none;">
						<div class="lum_my_account_form">
						<div class="lum_small_pad_ac">MY WALLET</div>
						<div><div class="lum_cont_small">BALANCE : </div><div style="display:inline-block;"><?php
										$wallet_total=0;

										//print_r($wallet);die;
										foreach($wallet as $balance){
										$wallet =$balance->userwallet;
										$wallet_total = $wallet_total + $wallet;
										}
										echo $wallet_total;
										?></div></div>
						</div>
					</div>
					<div id="lum_right_sub_sub2" style="display:none;">

					</div>
					<div id="lum_right_sub_sub3" style="display:none;">
						<form class="form-horizontal" method="post" name="reset_password" action="<?php echo $this->config->item('base_url_temp');?>home/resetpass">
							<div class="lum_my_account_form">
							<div class="lum_small_pad_ac">RESET PASSWORD</div>
							<div><div class="lum_cont_small">OLD PASSWORD : </div><div style="display:inline-block;"><input type="password" name="previouspass" value="<?php echo $acc->password?>" ></div></div>
							<div><div class="lum_cont_small">NEW PASSWORD : </div><div style="display:inline-block;"><input type="password"  name="newpassword"></div></div>
							<div><div class="lum_cont_small">CONFIRM PASSWORD : </div><div style="display:inline-block;"><input type="password" name="re_password"></div></div>
							<div style="display:inline-block;"><button class="reset_btn class_button_lum" name="reset" value="reset">RESET</button></div>
							</div>
						</form>
					</div>
				<?php } ?>
				</div>
				</div>
			</div>
			<div class="lum_height_content" id="lum_des_content1" style="display:none">
			<div style="padding:5px;">WISHLIST </div>
			<?php foreach($jointbl as $list){

			$trail_is = $list->is_trail_shirt;
				?>

			<div class="lum_switch11">
				<div>
				 <a href="<? echo $base_url_temp."details/".str_replace(' ','-',$list->pname)."-".$list->pid; ?>" ><img src="<?php echo $base_url_temp."stylior/upload/products1/large/".$list->image;  ?>" height="40%" /></a>
				</div>


				<div><?php echo $list->pname;?></div>
			<div class="lum_fab_img_bold"><?php echo $list->price;?> </div>

			<div class="buttons-container">
			<?php print_r($_SESSION['user_id']); ?>
				<div class="view_btn">	<a href="<? echo $base_url_temp."details/".str_replace(' ','-',$list->pname)."-".$list->pid; ?>" >View</a></div>
				<div class="delete_btn"> <a href="<? echo $base_url_temp."cart/remove_wishlist?pid=".$list->pid; ?>" >Remove</a></div>
			</div>
			</div>


			<?php } ?>
			</div>
			

			<div class="lum_height_content" id="lum_des_content2" style="display:none">
			<div style="padding:5px;">ORDERS </div>
			<?php foreach($order_details as $order_list){
			foreach ($order_item_details[$order_list->order_id] as $key => $value) {
			    	$options_data=json_decode($value->details3d);
					//print_r($options_data);
			    	?>
					<div class="order1" style="font-size:14px;margin:5px;border:1px solid #eee;line-height:30px;">
					<div class="order2">
					<?php if($trail_is==1 ||$value->order_item_name=="TRIAL SHIRT"){?>
						<img src="<?php echo $base_url_temp; ?>stylior/upload/products1/large/14739317861.jpg" width="90%" />
					<?php }else{?>
					<?php if(isset($image_of_product[$order_list->order_id])){ ?>
					 <img src="<?php echo $image_of_product[$order_list->order_id]; ?>" width="90%" />
					<?php }
					else {?>
						<img src="<?php echo $base_url_temp."stylior/upload/products1/large/".$image_of_product_nor[$order_list->order_id]; ?>" width="90%" />
					<?php }
					
					} ?>

					</div>

					<div class="option_class">
						<div><span>Order Id :</span><?php echo $order_list->order_id;?></div>

						<div style="font-size:12px;">Quantity : <?= $value->product_quantity;?></div>

						<div style="font-size:12px;">Options : <?php
						//print_r(str_word_count($value->details3d));
						
						if(isset($value->details3d) && str_word_count($value->details3d) >10){
	                    echo "<span class='options'>";
	                    // print_r($options_data->model);
						// print_r($options_data->sleeve);
						// print_r($options_data);

	                    if(isset($options_data->model) && isset($options_data->suspender_button) && isset($options_data->tie)){			
	                    		foreach ($options_data as $key2 => $value_option) {
									$get_value=$suit_data_options[$key2];
									if(isset($get_value)){
											if(isset($value_option->part))
												echo $key2.":".$value_option->part."|";
										else if(isset($value_option->pair))
												echo $key2.":".$value_option->pair."|";


										}
										
								}
						
						}
						else if(isset($options_data->model) && isset($options_data->sleeve) && isset($options_data->cuff)) {
					 		foreach ($options_data as $key2 => $value_option) {
													
								if(in_array($key2,$shirt_data_options))
								{
								
									echo $key2.":".strstr($value_option, '&swatch', true)."| ";	
								
								}
								else if(in_array($key2,$shirt_measurement_array)){

									echo $key2.": ".$value_option."| ";	
								
								}
							//$m_value = strstr($$value_option, '&swatch', true);	
							}	

						}
						//get the options value of balzer 
						else if(isset($options_data->model) && isset($options_data->jacket_style)) {

					 		foreach ($options_data as $key22 => $value_option22) {
                               if(in_array($key22, $shirt_measurement_array)){

									echo ">>".$key22.":".$options_data->$key22."|";
                               }
                               else
                               {
                               		echo $key22.":".$value_option22->part."|";
                               }
                               //print_r($value_option22->key22);   

						}	

						}
						else if(isset($options_data->front_bottom) && isset($options_data->jacket_button)) {
							// print_r($options_data);
						 	foreach ($options_data as $key22 => $value_option22) {

									if(in_array($key22, $shirt_measurement_array)){

										echo ">>".$key22.":".$options_data->$key22."|";
									}
									else
									{
										echo $key22.":".$value_option22->part."|";
									}
							}

						}
						else if(isset($options_data->back_pocket) && isset($options_data->trouser_button) && isset($options_data->trouser_fit)) {
							// print_r($options_data);
						 	foreach ($options_data as $key22 => $value_option22) {

									if(in_array($key22, $shirt_measurement_array)){

										echo ">>".$key22.":".$options_data->$key22."|";
									}
									else
									{
										echo $key22.":".$value_option22->part."|";
									}
							}

						}
						echo "</span>";
						}
						else if(isset($value->measureid)){
						//var start date 15 dec 2016 chnaged for trial shirt measurements
						$measurement =  $this->home_model->getmdata($value->measureid);
						$serdata = $measurement->serializedata;
						$uns = unserialize($serdata);
						if($uns != '') {
							$array1 = $uns[0];
							$array2 = $uns[1];
							for($k='0';$k<count($array1);$k++){
								echo $this->User_model->bodypartname($array1[$k])." => ".$array2[$k].":";
							}
						}
						//var end
						}
						else{
							echo "no options";
						
						}
						?>

						</div>

					</div>
			<?php
				// print_r($value);
			 } //end of order_item_details
			 ?>



					<div class="lum_fab_img_bold" style="display:inline-block;vertical-align:top;text-align:left;font-weight:bold;padding-top:50px;padding-left:50px;padding-right:50px;">
						<span>Total: </span><?php echo $order_list->order_currency;?> <?php echo $order_list->order_total;?>
					</div>
					<div style="display:inline-block;vertical-align:top;text-align:left;padding-top:50px;">
						<div><span>Order Status :</span><?php echo $order_list->order_status;?></div>
						<div><?php echo $order_list->order_trackadd;?></div>
					</div>
			</div>
			<?php } ?>
			</div>
			<div class="lum_height_content" id="lum_des_content3" style="display:none">
					<div style="padding:5px;">MEASUREMENT </div>

					<?php

			  $uid=$_SESSION['user_id'];
			if($uid !=""){

								 //$uid=$this->session->userdata('userid').'fshdf';die;


								$measureprofile = $this->home_model->allusermeasurements($uid);
							}
					if($measureprofile != '' && count(measureprofile) > 0) {
								$i=0;
								foreach($measureprofile as $mdetail)
								{
									$serdata = $mdetail->serializedata;
									$uns= unserialize($serdata);	?>


				<div class="lum_switch11">

					<?php echo $mdetail->userprofilename; ?>
					<div class="lum_fab_img_bold"><?php echo $mdetail->metricft; ?> <?php echo $mdetail->metricinch; ?> In </div>
					<button class="class_button_lum delete-addr" data-attr="<?=$mdetail->id?>">Delete</button>
				</div>
				<?php $i++; }  } else { ?>
							<p>
								Oops! It seems you have not saved any sizes. Get yourself measured now!
							</p>
				<?php } ?>

			</div>
			<div class="lum_height_content" id="lum_des_content4" style="display:none">

					<div class="addressContainer" style="display:inline-block;text-align:left;width:49%;vertical-align:top;font-size:12px;">
						<div class="tab_spac_lum">
						<?php

						$j=0;

						foreach($addressview as $address){
						//print_r($address);
						?>
						<div class="tab_address_lum" id="tab_address<?=$address->id?>">
							<div><strong><?php echo $address->Name;?></strong></div>
							<div class="tab_address_inner_lum"><?php echo $address->Address1;?>
							<?php echo $address->Address2 ;?></br>

										<?php echo $address->City ;?>&nbsp;&nbsp;
										<?php echo $address->State ;?></br>
										<?php echo $address->country ;?>&nbsp;&nbsp;

										<?php echo $address->Phone ;?>

							</div>





							<div class="class_space_lum"><button type="button" class="class_button_lum add_open" id="add_open<?php echo $j ?>">Edit</button>



							<button id="addressdelete" class="class_button_lum addressdelete" data-attr="<?=$address->id?>">Delete</button></div>

						</div>
						<?php

						$j++;
						} ?>
						</div>
				</div>
				<div style="display:inline-block;vertical-align:top;font-size:12px;">
					<div class="tab_spac_lum">ADDRESS
						<div id="hello" class="tab_address_lum">

									<form name="checkout" id="checkout" class="form" method="post" action="<?php echo $this->config->item('base_url_temp');?>home/addaddress">
						<INPUT TYPE="hidden" NAME="action" VALUE="addaddress">
					<div class="tab_address_lum_inner1">
						Add a new address
						<div class="tab_address_lum_inner">Be sure to click "Deliver to this address" when you've finished.</div>
					</div>
					<div class="tab_address_lum_inner">NAME : <br /><input  id="Nameadd" class="tab_address_lum_input Nameadd" type="text" name="Name" /></div>

					<div class="tab_address_lum_inner">ADDRESS LINE 1 :&nbsp;<span id="errmsgad"></span> <br /><input id="Address1add" class="tab_address_lum_input Address1add" type="text" name="Address1" /></div>
					<div class="tab_address_lum_inner">ADDRESS LINE 2 : <br /><input  id="Address2add" class="tab_address_lum_input" type="text" name="Address2"/></div>
					<div class="tab_address_lum_inner">TOWN / CITY : <br /><input id="Cityadd" class="tab_address_lum_input Cityadd" type="text" name="City" required/></div>
					<div class="tab_address_lum_inner">STATE : <br /><input  id="Stateadd" class="tab_address_lum_input Stateadd" type="text" name="State" /></div>
					<div class="tab_address_lum_inner">PINCODE : <br /><input   id="Zipadd" class="tab_address_lum_input Zipadd" type="text" name="Zip" required/></div>
					<div class="tab_address_lum_inner">COUNTRY : <br /><input  id="countryadd" class="tab_address_lum_input countryadd" type="text" name="country"  pattern="[A-Za-z]+" title="Please enter proper country name" required  /></div>
					<div class="tab_address_lum_inner">MOBILE NUMBER :  &nbsp;<span id="errmsg"></span><br /><input  maxlength=10 id="Phoneadd" class="tab_address_lum_input Phoneadd" type="text" name="Phone" /></div>
					<div class="tab_address_lum_inner1">
						Additional Address Details
					</div>
					<div class="tab_address_lum_inner">LAND MARK : <br /><input class="tab_address_lum_input" type="text" name="landmark"/></div>
					<div class="tab_address_lum_inner">ADDRESS TYPE : <br /><input class="tab_address_lum_input" type="text" name="add_type"/></div>
					<div><button class="btns btn-1 btn-1a" type="submit">ADD THIS ADDRESS</button></div>
				</div>
				</form>

					<?php if($addressview != "" && count($addressview) >= 0)
	    			{
						$j=0;
										foreach($addressview as $address)
										{

										 ?>
								<div id="edit_add<?php echo $j ?>" class="edit_add" style="">
				    <form name="checkoutedit" id="checkoutedit<?php echo $j ?>" class="form" method="post"   action="<?php echo $this->config->item('base_url_temp');?>home/updateaddress">
						<INPUT TYPE="hidden" NAME="action" VALUE="updateaddress">
						<INPUT TYPE="hidden" NAME="addressid" VALUE="<?php echo $address->id; ?>">
					<div class="tab_address_lum_inner1">
						EDIT address
						<div class="tab_address_lum_inner">Be sure to click "Deliver to this address" when you've finished.</div>
					</div>
					<div class="tab_address_lum_inner">NAME : <br /><input class="tab_address_lum_input Nameadd" type="text" id="Name<?php echo $j ?>" name="Name" value="<?php echo $address->Name; ?>" /></div>

					<div class="tab_address_lum_inner">ADDRESS LINE 1 : &nbsp;<span id="errmsged<?php echo $j ?>"></span> <br /><input class="tab_address_lum_input Address1edit" type="text" value="<?php echo $address->Address1; ?>" id="Address1<?php echo $j ?>" name="Address1" /></div>
					<div class="tab_address_lum_inner">ADDRESS LINE 2 : <br /><input class="tab_address_lum_input" type="text" value="<?php echo $address->Address2; ?>" id="Address2<?php echo $j ?>" name="Address2"/></div>
					<div class="tab_address_lum_inner">TOWN / CITY : <br /><input class="tab_address_lum_input Cityadd" type="text" value="<?php echo $address->City; ?>" id="City<?php echo $j ?>" name="City" /></div>
					<div class="tab_address_lum_inner">STATE : <br /><input class="tab_address_lum_input Stateadd" type="text" value="<?php echo $address->State; ?>"  id="State<?php echo $j ?>" name="State" /></div>
					<div class="tab_address_lum_inner">PINCODE : <br /><input   id="Zipadd" class="tab_address_lum_input Zipadd" type="text" name="Zip" value="<?php echo $address->Zip; ?>" required></div>

					<div class="tab_address_lum_inner">COUNTRY : <br /><input class="tab_address_lum_input countryadd" type="text" value="<?php echo $address->country; ?>" id="country<?php echo $j ?>" name="country"  pattern="[A-Za-z]+" title="Please enter proper country name" required /></div>
					<div class="tab_address_lum_inner">MOBILE NUMBER : &nbsp;<span id="errmsg"></span><br /><input class="tab_address_lum_input Phoneadd"  maxlength=10  type="text" value="<?php echo $address->Phone; ?>"  id="Phone<?php echo $j ?>"  name="Phone" /></div>
					<div class="tab_address_lum_inner1">Additional Address Details</div>
					<div class="tab_address_lum_inner">LAND MARK : <br /><input class="tab_address_lum_input" type="text" name="landmark"/></div>
					<div class="tab_address_lum_inner">ADDRESS TYPE : <br /><input class="tab_address_lum_input" type="text" name="add_type"/></div>
					<div><button class="btns btn-1 btn-1a" type="submit">UPDATE THIS ADDRESS</button></div>

				</form>
			</div>

			<?php
		$j++;
		}
		?>
		<?php }
		else
		{
	$address = "0";
		}?>




						</div>

					</div>
				</div>

			<div class="lum_height_content" id="lum_des_content5" style="display:none">
			<div style="padding:5px;">SAVED STYLE </div>
				<?php foreach($savedstyle as $savestyle)
				{?>
				<div class="lum_switch11">
					<div>
					 <img src="<?=base_url() ?>uploads/<?php echo $savestyle->baseimage;?>" width="40%" />
					</div>
					<div><?php echo $savestyle->pname;?></div>
					<div class="lum_fab_img_bold"><?php echo $savestyle->price; ?> </div>
				</div>
				<?php } ?>
			</div>
		</div>

		<script>
			$( document ).ready(function() {
			$(".edit_add").hide();
			});
		</script>
		<script>
		jQuery(function ($) {
		$(".addressdelete").on("click",function(){
	    var adeId=$(this).attr("data-attr");
	    //alert(adeId);
		    $.ajax({
			url:'<?= $base_url_temp ?>home/deleteaddress',
			method:'POST',
			data:{"id":adeId},
			success:function(data){
				$(".sessionmessge").html("Address Deleted Succesfully");

				$("#tab_address"+adeId).html("");
			//	location.reload();
			}



	})

})
		});

</script>
<script>
$('.add_open').click(function()
{
	$(".edit_add").hide();
	$(".add_open").show();
	$("#hello").hide();

	 var avoided = (this.id).replace('add_open','');

	 var editshow="edit_add"+avoided;
      $("#"+editshow).show('slow');
	  $("#"+this.id).hide('slow');

});


	$('.lum_switch').hover(function() {
		$(this).find('.lum_avg_words').hide();
        $(this).find('.lum_avg_num').show();
    });
	$('.lum_switch').mouseleave(function() {
			$(this).find('.lum_avg_num').hide();
			$(this).find('.lum_avg_words').show();
			//$('.lum_avg_words').addClass('active').siblings().removeClass('active');
	});
	$('.lum_switch').click(function() {
			$(this).find('.lum_avg_num').hide();
			$(this).find('.lum_avg_words').show();

			$('.lum_avg_words_dis').removeClass("lum_avg_words_dis").addClass("lum_avg_words");
			$('.lum_avg_num_dis').removeClass("lum_avg_num_dis").addClass("lum_avg_num");

			$('.lum_avg_words').show();
			$('.lum_avg_num').hide();

			$(this).find('.lum_avg_words').removeClass("lum_avg_words").addClass("lum_avg_words_dis");
			$(this).find('.lum_avg_num').removeClass("lum_avg_num").addClass("lum_avg_num_dis");

			 $(this).find('.lum_avg_words_dis').hide();
			 $(this).find('.lum_avg_num_dis').show();
			//$('.lum_avg_words').addClass('active').siblings().removeClass('active');
	});

</script>
 <script>
        //an image width in pixels
        var imageWidth = 300;


        //DOM and all content is loaded
        $(window).ready(function() {

            var currentImage = 0;

            //set image count
            var allImages = $('#slideshow li div').length;

            //setup slideshow frame width
            $('#slideshow ul').width(allImages*imageWidth);

            //attach click event to slideshow buttons
            $('.slideshow-next').click(function(){

                //increase image counter
                currentImage++;
                //if we are at the end let set it to 0
                if(currentImage>=allImages) currentImage = 0;
                //calcualte and set position
                setFramePosition(currentImage);

							for(var i=0;i<6;i++)
							{
								var j='#lum_des_content'+i;
								var k='#slideshow_item'+i;
									if(currentImage==i)
									{
										$(j).show();
										$(k).removeClass("lum_sub_menu_item").addClass("lum_sub_menu_item_active");
									}
									else
									{
										$(j).hide();
										$(k).removeClass("lum_sub_menu_item_active").addClass("lum_sub_menu_item");
									}
							}


				 });

            $('.slideshow-prev').click(function(){

                //decrease image counter
                currentImage--;
                //if we are at the end let set it to 0
                if(currentImage<0) currentImage = allImages-1;
                //calcualte and set position
                setFramePosition(currentImage);

							for(var i=0;i<6;i++)
							{
								var j='#lum_des_content'+i;
								var k='#slideshow_item'+i;
									if(currentImage==i)
									{
										$(j).show();
										$(k).removeClass("lum_sub_menu_item").addClass("lum_sub_menu_item_active");
									}
									else
									{
										$(j).hide();
										$(k).removeClass("lum_sub_menu_item_active").addClass("lum_sub_menu_item");
									}
							}
            });

        });

        //calculate the slideshow frame position and animate it to the new position
        function setFramePosition(pos){

            //calculate position
            var px = imageWidth*pos*-1;
            //set ul left position
            $('#slideshow ul').animate({
                left: px
            }, 300);
        }


		function slideshow_itemer(vari)
		{
			for(var i=0;i<6;i++)
			{
				var j='#lum_des_content'+i;
				var k='#slideshow_item'+i;
					if(vari==i)
					{
						$(j).show();
						$(k).removeClass("lum_sub_menu_item").addClass("lum_sub_menu_item_active");
					}
					else
					{
						$(j).hide();
						$(k).removeClass("lum_sub_menu_item_active").addClass("lum_sub_menu_item");
					}
			}

		}
		function lum_sub_sub_menu(fsd)
		{
			for(var i=0;i<4;i++)
			{
				var j='#lum_right_sub_sub'+i;
				var k='#lum_sub_sub_menu'+i;
					if(fsd==i)
					{
						$(j).show();
						$(k).removeClass("lum_sub_sub_menu_vertical").addClass("lum_sub_sub_menu_vertical_active");
					}
					else
					{
						$(j).hide();
						$(k).removeClass("lum_sub_sub_menu_vertical_active").addClass("lum_sub_sub_menu_vertical");
					}
			}

		}
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0-alpha1/jquery.js"></script>

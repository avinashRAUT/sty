<?php
if ($_SERVER['HTTPS'] == "on")
{
$https_url="https://www.stylior.com/stylior/";
$bas_ul = "https://www.stylior.com/";
$https_url_large_img="https://www.stylior.com/stylior/upload/products1/";
}
else {
$bas_ul = "http://www.stylior.com/";
$https_url="http://www.stylior.com/";
$https_url_large_img="http://www.stylior.com/upload/products1/";

}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Custom Shirt | Stylior</title>
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
    <link href="https://fonts.googleapis.com/css?family=Didact+Gothic" rel="stylesheet">
    <link rel="stylesheet" href="<?=base_url() ?>css/bootstrap.css">
    <link rel="stylesheet" href="<?=base_url() ?>css/font-awesome.min.css">
    <link href="<?= $https_url ?>site/css/mega_menu.css" rel="stylesheet">
    
<!--    <link href="assets/css/main.css" rel="stylesheet">-->
<style type="text/css">
.pre-loader{
    display: none;
    position: fixed;
    top: 0;
    right: 0;
    left: 0;
    right: 0;
    z-index: 9999;
    width: 100%;
    height: 100%;
}

</style>

</head>
<body>
<div class="measurement_tabs_section">
    <div class="tabs-options">
    <ul id="measure_tabs_options" class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#saved_profile" role="tab" data-toggle="tab">saved profile</a></li>
        <li role="presentation"><a href="#standard_size" role="tab" data-toggle="tab">standard size</a></li>
        <li role="presentation"><a href="#body_measurement" role="tab" data-toggle="tab">measurement</a></li>        
    </ul>
    </div>
    <div class="tab-content measurement-tab-details" data-content="height">
        <div role="tabpanel" class="tab-pane fade in active" id="saved_profile">
            <div class="height">
                <div class="measurement_container">
                    <div class="savedmeasure">
                    <?php
                     $measureprofile = $this->home_model->allusermeasurements($uid);?>
                     <select name="save_m2" id="save_m2" class="measurement-select" onchange="showExistingMeasure(this.value);"
                     >
                    
                        <option value="">Choose profile</option>
                        <?php foreach($measureprofile as $mdetail)
                             {
                                   echo '<option value="'.$mdetail->id.'">'.$mdetail->userprofilename.'</option>';
                             }
                         ?>
                    </select>
                    <!-- collect saved data based on the selection -->
                    <?php
                            if($uid !=""){
                            $measureprofile = $this->home_model->allusermeasurements($uid);
                             $i=0;
                             foreach($measureprofile as $mdetail)
                             {
                                $serdata = $mdetail->serializedata;
                                $uns= unserialize($serdata);
                                ?>
                    
                        <div id="bodymeasure-<?php echo $mdetail->id; ?>" class="bodymeasure" style="display:none;" >
                            <form action="<? echo $bas_ul?>cart/saveadd3d" method="post" id="filters1" name="filters1" >
                            <input type="hidden"  name="measureid"  class="measureid"  value="<?php echo $mdetail->id; ?>" />
                        <div class="gap10"></div>
                    
                        <table class="m_s_table">
                          <tr>
                            <th>BODY POSTURE</th>
                            <th>BODY FIT</th>
                            <th>SHOULDER TYPE</th>
                            <th>SHOULDER ANGLE</th>
                          </tr>
                          <tr>
                                <?php
                                $posture = $mdetail->posture;
                                if($posture == '0'){
                                $post_val ='Normal';
                                }else if($posture == '1'){
                                $post_val = 'Hunched';
                                }else if($posture == '2'){
                                $post_val ='Erect';
                                }?>
                                <td style="color:red"><?php echo $post_val;?></td>
                                <?php
                                $fit = $mdetail->fit;
                                if($fit == '0'){
                                $fit_val ='Slim';
                                }else if($fit == '1'){
                                $fit_val = 'Tailored';
                                }else if($fit == '2'){
                                $fit_val ='Regular';
                                }
                                ?>
                                <td style="color:red"><?php echo $fit_val;?></td>
                    
                    
                                <?php
                                $shouldertype = $mdetail->shouldertype;
                                if($shouldertype == '0'){
                                $shouldertype_val ='Normal';
                                }else if($shouldertype == '1'){
                                $shouldertype_val = 'Sloping';
                                }else if($shouldertype == '2'){
                                $shouldertype_val ='Straight';
                                }?>
                                <td style="color:red"><?php echo $shouldertype_val;?></td>
                    
                    
                    
                                <?php
                                $shoulderangle = $mdetail->shoulderangle;
                                if($shoulderangle == '0')
                                {
                                $shoulderangle_val ='Even';
                                }
                                else if($shoulderangle == '1')
                                {
                                $shoulderangle_val = 'Lower Left';
                                }
                                else if($shoulderangle == '2')
                                {
                                $shoulderangle_val ='Lower Right';
                                }
                                ?>
                                <td style="color:red"><?php echo $shoulderangle_val;?></td>
                    
                            </tr>
                    
                        </table>
                    
                        <div class="gap10"></div>
                    
                                <?php
                                if($uns != '') {
                                  $array1 = $uns[0];
                                  $array2 = $uns[1];
                    
                                 for($k=0;$k<count($array1);$k++){
                                   $val_body = $this->User_model->bodypartname($array1[$k])." - ".$array2[$k];
                                 }
                                 } else {
                    
                                   $val_body="-";
                                }
                    
                                ?>
                                <input type="hidden"  name="" value="<?php echo $val_body;?>">
                                <?php if($uns != '') {
                                 $array1 = $uns[0];
                                 $array2 = $uns[1];
                                 for($k='0';$k<count($array1);$k++) { ?>
                                    <span class="bodyparts-array
                                    ">
                                    <?php echo $this->User_model->bodypartname($array1[$k]) ?> |
                                    <?php echo $array2[$k]; ?>
                                    </span>
                                <?php }
                    
                              } $i++;?>
                    
                    <div class="submit">
                    
                    <div class="gap10"></div>
                    <div class="gap10"></div>
                    <div class="gap10"></div>
                    <input type="submit" class="lum_measurement_bottom_inner_top_button cart"  value="Add to Cart"  >
                    
                    </form>
                    </div>
                    </div>
                    
                             <?php } /*end of foreach*/ ?>
                    
                    
                    
                    <?php       }  /*end of session uid check*/?>
                    
                    <!-- end collect data -->        
                    </div>
                </div>
            </div>
        </div>

        <div role="tabpanel" class="tab-pane fade" id="standard_size">
            <div class="measurement_wrapper">
                <div class="row">
                    <div class="content-measurement col-md-9 col-md-push-3 col-xs-12">
                        <div data-spy="affix" id="dot-nav" class="affix">
                            <ul>
                                <li class="awesome-tooltip active" title="fit"><a href="#std_fit"></a></li>
                                <li class="awesome-tooltip" title="posture"><a href="#std_length"></a></li>
                                <li class="awesome-tooltip" title="add_measurement"><a href="#std_add_measurement"></a></li>
                            </ul>
                        </div>
                        <div id="main" class="">
                            <section id="std_fit" class="measurement-section">
                                <article>
                                   <div class="row">
                                       <label>Your Fit<span></span></label>
                                        <div id="lum_but_limt-radio" class="item">
                                            <div class="col-md-4">
                                                <div  class="meas_option">
                                                    <div>
                                                        <img rel="regular_fit" src="<?= $https_url ?>site/images/measurement/slim.png" alt="measurement" class="option_without_bg  meas_option_rel">
                                                        <img src="<?= $https_url ?>site/images/measurement/slim_hover.png" alt="measurement" class="option_with_bg ">
                                                        <!-- <img  rel="regular_fit" src="https://www.stylior.com/stylior/site/images/quick/slim.gif" class="measure-outer"  > -->
                                                        <input type="radio" name="yourfit" id="regular_fit" value="slim"  class="outer-contrast-radio hide" checked />
                                                    </div><!-- meas_option_rel -->

                                                </div><!-- EO meas_option -->                                       
                                            <p>Slim</p>
                                            </div>
                                        </div>

                                        <div  id="lum_but_limt-radio" class="item">
                                        <div class="col-md-4">
                                        <div    class="meas_option">
                                        <div>
                                            <img rel="tailored"  src="<?= $https_url ?>site/images/measurement/tailored.png" alt="measurement" class="option_without_bg  meas_option_rel">
                                            <img src="<?= $https_url ?>site/images/measurement/tailored_hover.png" alt="measurement" class="option_with_bg  ">
                                            <!-- <img  rel="tailored" src="https://www.stylior.com/stylior/site/images/quick/tailored.gif" class="measure-outer" > -->
                                            <input type="radio" name="yourfit" id="tailored"    value="tailored"     class="outer-contrast-radio hide"  />
                                       </div><!-- meas_option_rel -->
          
                                        <p>Tailored</p>
                                        </div><!-- EO meas_option --></div>
                                        </div>

                                        <div  id="lum_but_limt-radio" class="item" >
                                        <div class="col-md-4">
                                        <div  class="meas_option">
                                        <div >
                                            <img rel="comfort"  src="<?= $https_url ?>site/images/measurement/regular.png" alt="measurement" class="option_without_bg meas_option_rel">
                                            
                                            <img src="<?= $https_url ?>site/images/measurement/regular_hover.png" alt="measurement" class="option_with_bg ">
                                            <!-- <img rel="comfort" src="https://www.stylior.com/stylior/site/images/quick/regular.gif"    class="measure-outer" > -->
                                            
                                            <input type="radio" name="yourfit" id="comfort" value="comfort"      class="outer-contrast-radio hide"/>

                                        </div><!-- meas_option_rel -->
                                            <p>Comfort</p>
                                        </div><!-- EO meas_option -->
                                        </div>
                                       </div>
                                    </div>
                                </article>           
                            </section>
                            
                            <section id="std_length" class="measurement-section">
                           
                            <article>
                                <div class="row">
                                    <h3>Your Length</h3>
                                    <div class="col-md-4">
                                        <div class="posture_option meas_option">
                                            <img rel="length_short" src="<?= $https_url ?>site/images/measurement/body_normal.png" alt="measurement" class="option_without_bg meas_option_rel">
                                            <img src="<?= $https_url ?>site/images/measurement/body_normal_hover.png" alt="measurement" class="option_with_bg">
                                            <input type="radio" name="yourlength" id="length_short" value="length_short"  class="outer-contrast-radio hide">
                                            <p>Short</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="posture_option meas_option">
                                            <img rel="length_regular" src="<?= $https_url ?>site/images/measurement/body_hunched.png" alt="measurement" class="option_without_bg meas_option_rel">
                                            <img src="<?= $https_url ?>site/images/measurement/body_hunched_hover.png" alt="measurement" class="option_with_bg">
                                            <input type="radio" name="yourlength" id="length_regular" value="length_regular" class="outer-contrast-radio hide" checked="">
                                            <p>Regular</p>
                                        
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <div class="posture_option meas_option">
                                            <img rel="length_high" src="<?= $https_url ?>site/images/measurement/body_erect.png" alt="measurement" class="option_without_bg meas_option_rel">
                                            <img src="<?= $https_url ?>site/images/measurement/body_erect_hover.png" alt="measurement" class="option_with_bg">
                                            <input type="radio" name="yourlength" id="length_high" value="length_high"  class="outer-contrast-radio hide">
                                            <p>Tall</p>
                                        </div>
                                    </div>
                                </div>
                            </article>   

                            </section>   
                           
                            <section id="std_add_measurement" class="measurement-section">
                                <article>
                                   <div class="row">
                                        <h3>measurement</h3>
                                        <div class="col-md-6">
                                        <!--height and weight section-->          
                            <div class="pre-loader">
                                <img src="https://www.stylior.com/stylior/site/images/loading_new.gif" />
                            </div>


                                           <div class="measurement-form-section">
                                               <h4 class="Title">What's your height and weight?</h4>
                                               <div class="standardcol measurement-form">
                                                    <div class="height area measurement-entry">
                                                        <label>Height </label>
                                                            <select class="height_select measurement-select" id="height_select" name="height_select">
                                                                <option value=""> Select Height </option>
                                                                <option value="5'0" " >   5'0"   </option>
                                                                <option value="5'1" " >   5'1"   </option>
                                                                <option value="5'2" " >   5'2"   </option>
                                                                <option value="5'3" " >   5'3"   </option>
                                                                <option value="5'4" " >   5'4"   </option>
                                                                <option value="5'5" " >   5'5"   </option>
                                                                <option value="5'6" " >   5'6"   </option>
                                                                <option value="5'7" " >   5'7"   </option>
                                                                <option value="5'8" " >   5'8"   </option>
                                                                <option value="5'9" " >   5'9"   </option>
                                                                <option value="5'10"" >   5'10"   </option>
                                                                <option value="5'11"" >   5'11"   </option>
                                                                <option value="6'0" " >   6'0"   </option>
                                                                <option value="6'1" " >   6'1"   </option>
                                                                <option value="6'2" " >   6'2"   </option>
                                                                <option value="6'3" " >   6'3"   </option>
                                                                <option value="6'4" " >   6'4"   </option>
                                                                <option value="6'5" " >   6'5"   </option>
                                                                <option value="6'6" " >   6'6"   </option>
                                                                <option value="6'7" " >   6'7"   </option>
                                                                <option value="6'8" " >   6'8"   </option>
                                                                <option value="6'9" " >   6'9"   </option>
                                                                <option value="6'10"" >   6'10" </option>
                                                                <option value="6'11"" >   6'11" </option>
                                                            </select>
                                                    </div>
                                                    <div class="weight area quickmeasure-dev measurement-entry">
                                                        <label>Weight</label>
                                                        <input type="text" name="body_weight" id="body_weight" class="measurement-input" value="" placeholder="Enter Weight" />

                                                    </div> <!-- div of weight -->
                                                    
                                                    <div class="size size-dev">
                                                        <label>Size</label>
                                                        <select class="size_select measurement-select" id="size_select" name="size_select">
                                                        <option value="">Select Size</option>
                                                        <option value= "36"  >   36           </option>
                                                        <option value= "37"   >  37               </option>
                                                        <option value= "38"   >  38           </option>
                                                        <option value= "39"   >  39               </option>
                                                        <option value= "40"  >   40           </option>
                                                        <option value= "41" >    41           </option>
                                                        <option value= "42" >    42        </option>
                                                        <option value= "43" >    43           </option>
                                                        <option value= "44" >    44        </option>
                                                        
                                                        <option value= "45" >    45           </option>
                                                        <option value= "46" >    46        </option>
                                                        </select>
                                                    </div> <!-- div of size -->
                                                </div>
                                            </div>
                                            <div class="standardcol measurement-form">
                                               <h4 class="Title">Enter your Measurements</h4>
                                                   <div class="entry measurement-entry" id="entry-standard">
                                                   <label>Shoulder</label>
                                                   <input type="text" class="mesure-form measurement-input" id="lum_input_required1" name="bodypartvalue[27]" value="" placeholder="SHOULDER" required>
                                                   </div>
                                
                                                    <div class="entry measurement-entry" id="entry-standard">
                                                    <label>Neck</label>
                                                        <input type="text" class="mesure-form measurement-input" id="lum_input_required2" name="bodypartvalue[28]" value="" placeholder="NECK" required >
                                                   </div>
                                
                                                    <div class="entry measurement-entry" id="entry-standard">
                                                    <label>Sleeve</label>
                                                    <input type="text" id="lum_input_required3" class="mesure-form measurement-input" name="bodypartvalue[29]"  placeholder="SLEEVE" required/>
                                                   </div>
                                
                                
                                                    <div class="entry measurement-entry" id="entry-standard">
                                                    <label>Length</label>
                                                    <input type="text" id="lum_input_required5" class="mesure-form measurement-input" name="bodypartvalue[32]"  placeholder="SHIRT LENGTH" required/>
                                                   </div>
                                
                                                   <div class="entry measurement-entry" id="entry-standard">
                                                   <label>Chest</label>
                                                    <input type="text" id="lum_input_required6" class="mesure-form measurement-input" name="bodypartvalue[60]"  placeholder="CHEST" required/>
                                                   </div>
                                
                                
                                                    <div class="entry measurement-entry" id="entry-standard">
                                                    <label>Waist</label>
                                                    <input type="text" id="lum_input_required8" class="mesure-form measurement-input" name="bodypartvalue[62]"  placeholder="WAIST" required/>
                                                    </div>
                                                  
                                                    <button type="submit" id="quick_save" class="blue-btn lum_measurement_bottom_inner_top_button cart">Add to cart </button>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <h4 class="Title">how to measure</h4>
                                            <div id="guideDescription-standard">
                                                <video id="guideDescription" class="lum_video-new" controls>
                                                    <source src="https://www.stylior.com/site_old/views/images/measurement_vdo/Bicep.m4v" type="video/mp4" />
                                                    <source src="https://www.stylior.com/site_old/views/images/measurement_vdo/Bicep.m4v" type="video/ogg" />
                                                </video>
                                                <p> Bicep</p>
                                            </div>
                                        </div>
                                   </div>
                                </article>           
                            </section> 
                        </div>
                    </div>
                    
                    <div class="sidebar-measurement-summary col-md-3 col-md-pull-9 col-xs-12">
 
                        <div class=""> <!-- remove this class meas-summary -->
                            <h3>summary</h3>

                            <div class="summary_container">
                                <div class="summary_fit">
                                </div>
                                <div class="summary_length">
                                </div>

                                <div class="summary_measurement">
                                    <label>Height</label>
                                    <label class="summary_heigth"></label>
                                    <label>Weight</label>
                                    <label class="summary_weight"> </label>
                                    <label>Size</label>
                                    <label class="summary_size"> </label>
                                    <label>Shoulder</label>
                                    <label class="summary_shoulder"> </label>
                                    <label>Neck</label>
                                    <label class="summary_neck"> </label>
                                    <label>Sleeve</label>
                                    <label class="summary_sleeve"> </label>
                                    <label>Length</label>
                                    <label class="summary_shirt_length"> </label>
                                    <label>Chest</label>
                                    <label class="summary_chest"> </label>
                                    <label>Waist</label>
                                    <label class="summary_waist"> </label>
                                </div>
                            </div>

                            <button type="submit" id="lum_measurement_bottom_inner_top_button" class="blue-btn lum_measurement_bottom_inner_top_button cart">Reset</button>

                    </div>
                 </div>               
                </div>
            </div>
        </div>

        <div role="tabpanel" class="tab-pane fade" id="body_measurement">
            <div class="measurement_wrapper">
                <div class="row">
                    
                </div>

                    <div class="content-measurement col-md-9 col-md-push-3 col-xs-12">
                        <div data-spy="affix" id="dot-nav" class="affix">
                            <ul>
                                <li class="awesome-tooltip active" title="fit"><a href="#fit"></a></li>
                                <li class="awesome-tooltip" title="posture"><a href="#body_posture"></a></li>
                                <li class="awesome-tooltip" title="shoulder_type"><a href="#shoulder_type"></a></li>
                                <li class="awesome-tooltip" title="shoulder_angle"><a href="#shoulder_angle"></a></li>
                                <li class="awesome-tooltip" title="add_measurement"><a href="#add_measurement"></a></li>
                            </ul>
                        </div>
                        
                        <div id="main" class="">
                        <section id="fit" class="measurement-section">
                                <article>
                                   <div class="row">
                                        <h3>Your Fit</h3>
                                         <div class="col-md-4">
                                            <div class="fit_option meas_option">
                                                <img  rel="bm_slim" src="<?= $https_url ?>site/images/measurement/slim.png" alt="measurement" class="option_without_bg meas_option_rel">
                                                <img src="<?= $https_url ?>site/images/measurement/slim_hover.png" alt="<" class="option_with_bg">
                                                <input type="radio" name="cust_yourfit" id="bm_slim" value="slim"  class="outer-contrast-radio hide" checked />
                                                <p>Slim</p>
                                           </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="fit_option meas_option">
                                                <img  rel="bm_tailored" src="<?= $https_url ?>site/images/measurement/tailored.png" alt="measurement" class="option_without_bg meas_option_rel">
                                                <img src="<?= $https_url ?>site/images/measurement/tailored_hover.png" alt="measurement" class="option_with_bg">
                                                <input type="radio" name="cust_yourfit" id="bm_tailored" value="tailored" class="mesure-form outer-contrast-radio hide">
                                               <p>Tailored</p>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="fit_option meas_option">
                                               <img  rel="bm_regular" src="<?= $https_url ?>site/images/measurement/regular.png" alt="measurement" class="option_without_bg meas_option_rel">
                                               <img src="<?= $https_url ?>site/images/measurement/regular_hover.png" alt="measurement" class="option_with_bg">
                                               <input type="radio" name="cust_yourfit" id="bm_regular" value="regular" class="outer-contrast-radio hide" />
                                                <p>Regular</p>
                                            </div>
                                     </div>

                                 </div>
                            </article>           
                        </section>
            
                        <section id="body_posture" class="measurement-section">
                           <article>
                                <div class="row">
                                   <h3>Body Posture</h3>
                                    <div class="col-md-4">
                                      <div class="posture_option meas_option">
                                        <img rel="bp_normal" src="<?= $https_url ?>site/images/measurement/body_normal.png" alt="measurement" class="option_without_bg meas_option_rel">
                                        <img src="<?= $https_url ?>site/images/measurement/body_normal_hover.png" alt="measurement" class="option_with_bg">
                                        <input type="radio" name="bp_yourfit" id="bp_normal" value="bp_normal" class="mesure-formouter-contrast-radio hide">
                                        <p>Normal</p>
                                      </div>
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <div class="posture_option meas_option">
                                            <img rel="bp_hunched" src="<?= $https_url ?>site/images/measurement/body_hunched.png" alt="measurement" class="option_without_bg meas_option_rel">
                                            <img src="<?= $https_url ?>site/images/measurement/body_hunched_hover.png" alt="measurement" class="option_with_bg">
                                            <input type="radio" name="bp_yourfit" id="bp_hunched" value="bp_hunched" class="mesure-formouter-contrast-radio hide">
                                            <p>Hunched</p>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <div class="posture_option meas_option">
                                            <img rel="bp_erect" src="<?= $https_url ?>site/images/measurement/body_erect.png" alt="measurement" class="option_without_bg meas_option_rel">
                                            <img src="<?= $https_url ?>site/images/measurement/body_erect_hover.png" alt="measurement" class="option_with_bg">
                                            <input type="radio" name="bp_yourfit" id="bp_erect" value="bp_erect" class="mesure-form outer-contrast-radio hide">
                                            <p>Erect</p>
                                        </div>
                                    </div>
                                </div>
                            </article>

                            </section>
                            
                            <section id="shoulder_type" class="measurement-section">
                                <article>
                                    <div class="row">
                                        <h3>Shoulder Type</h3>
                                        
                                        <div class="col-md-4">
                                            <div class="posture_option meas_option">
                                                <img rel="st_normal" src="<?= $https_url ?>site/images/measurement/shoulder_type_normal.png" alt="measurement" class="option_without_bg meas_option_rel">
                                                <img src="<?= $https_url ?>site/images/measurement/shoulder_type_normal_hover.png" alt="measurement" class="option_with_bg">

                                               <input type="radio" name="st_yourfit" id="st_normal" value="st_normal" class="mesure-form outer-contrast-radio hide" checked>

                                             <p>Normal</p>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-4">
                                            <div class="posture_option meas_option">
                                                <img rel="st_sloping" src="<?= $https_url ?>site/images/measurement/shoulder_type_sloping.png" alt="measurement" class="option_without_bg meas_option_rel">
                                                <img src="<?= $https_url ?>site/images/measurement/shoulde_type_sloping_hover.png" alt="measurement" class="option_with_bg">
                                                <input type="radio" name="st_yourfit" id="st_sloping" value="st_sloping" class="mesure-form outer-contrast-radio hide" >
                                                <p>Sloping</p>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-4">
                                            <div class="posture_option meas_option">
                                                <img rel="st_straight" src="<?= $https_url ?>site/images/measurement/shoulder_type_straight.png" alt="measurement" class="option_without_bg meas_option_rel">
                                                    <img src="<?= $https_url ?>site/images/measurement/shoulder_type_normal_hover.png" alt="measurement" class="option_with_bg">

                                                <input type="radio" name="st_yourfit" id="st_straight" value="st_straight" class="mesure-form outer-contrast-radio hide" >
                                                <p>Straight</p>
                                            </div>
                                        </div>

                                    </div>
                                </article>           
                            </section>

                            <section id="shoulder_angle" class="measurement-section">
                                <article>
                                    <div class="row">
                                        <h3>Shoulder Angle</h3>
                                        <div class="col-md-4">
                                            <div class="posture_option meas_option">
                                                <img rel="sa_even" src="<?= $https_url ?>site/images/measurement/shouler_angle_even.png" alt="measurement" class="option_without_bg meas_option_rel">
                                                <img src="<?= $https_url ?>site/images/measurement/shouler_angle_even_hover.png" alt="measurement" class="option_with_bg">
                                                <input type="radio" name="sa_yourfit" id="sa_even" value="sa_even" class="mesure-form outer-contrast-radio hide" checked >
                                                <p>Even</p>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="posture_option meas_option">
                                               <img rel="sa_lower_left" src="<?= $https_url ?>site/images/measurement/shoulder_angle_left_slop.png" alt="measurement" class="option_without_bg meas_option_rel">
                                               <img src="<?= $https_url ?>site/images/measurement/shoulder_angle_left_slop_hover.png" alt="measurement" class="option_with_bg">
                                               <input type="radio" name="sa_yourfit" id="sa_lower_left" value="sa_lower_left" class="mesure-form outer-contrast-radio hide">
                                                <p>Lower Left</p>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="posture_option meas_option">
                                             <img rel="sa_lower_right" src="<?= $https_url ?>site/images/measurement/shoulder_angle_right_slop.png" alt="measurement" class="option_without_bg meas_option_rel">
                                             <img src="<?= $https_url ?>site/images/measurement/shoulde_angle_right_slop_hover.png" alt="measurement" class="option_with_bg">
                                             <input type="radio" name="sa_yourfit" id="sa_lower_right" value="sa_lower_right" class="mesure-form outer-contrast-radio hide">
                                             <p>Lower Right</p>
                                            </div>
                                        </div>

                                    </div>
                                </article>          
                            </section>    
                            
                            <section id="add_measurement" class="measurement-section">
                                <article>

                                   <div class="row">
                                <div class="pre-loader">
                                <img src="https://www.stylior.com/stylior/site/images/loading_new.gif" />
                                </div>

                                        <h3>measurement</h3>
                                        <div class="col-md-6">
                                        <!--height and weight section-->
                                           <div class="measurement-form-section">
                                               <h4 class="Title">What's your height and weight?</h4>
                                               <div class="standardcol measurement-form">
                                                <div class="height area measurement-entry">
                                                        <label>Height </label>                                             
                                                    <select class="mesure-form  measurement-select" name="height" id="height_select">
                                                     <option value="">Select Height</option>
                                                        <option value="5'0" "="">   5'0"     </option>
                                                        <option value="5'1" "="">   5'1"     </option>
                                                        <option value="5'2" "="">   5'2"     </option>
                                                        <option value="5'3" "="">   5'3"     </option>
                                                        <option value="5'4" "="">   5'4"     </option>
                                                        <option value="5'5" "="">   5'5"     </option>
                                                        <option value="5'6" "="">   5'6"     </option>
                                                        <option value="5'7" "="">   5'7"     </option>
                                                        <option value="5'8" "="">   5'8"     </option>
                                                        <option value="5'9" "="">   5'9"     </option>
                                                        <option value="5'10" "="">   5'10" </option>
                                                        <option value="5'11" "="">   5'11" </option>
                                                        <option value="6'0" "="">   6'0"     </option>
                                                        <option value="6'1" "="">   6'1"     </option>
                                                        <option value="6'2" "="">   6'2"     </option>
                                                        <option value="6'3" "="">   6'3"     </option>
                                                        <option value="6'4" "="">   6'4"     </option>
                                                        <option value="6'5" "="">   6'5"     </option>
                                                        <option value="6'6" "="">   6'6"     </option>
                                                        <option value="6'7" "="">   6'7"     </option>
                                                        <option value="6'8" "="">   6'8"     </option>
                                                        <option value="6'9" "="">   6'9"     </option>
                                                        <option value="6'10" "="">   6'10" </option>
                                                        <option value="6'11" "="">   6'11" </option>
                                                </select>
                                             </div>
                                            <div class="weight area measurement-entry">
                                                <label>Weight</label>
                                                <input type="text" name="weight" id="weight" class="mesure-form measurement-input" placeholder="Enter Weight">
                                            </div>

                                          </div>
                                        </div>
                                            
                                            <div class="standardcol measurement-form">
                                               <h4 class="Title">Enter your Measurements</h4>
                                               <div class="entry measurement-entry">
                                                 <label>Bicep</label>
                                                <input type="text" class="mesure-form measurement-input" id="lum_input_required0" name="bodypartvalue[26]" value="" placeholder="BICEP" required="">
                                               </div>

                                               <div class="entry measurement-entry">
                                               <label>Shoulder</label>
                                               <input type="text" class="mesure-form measurement-input" id="lum_input_required1" name="bodypartvalue[27]" value="" placeholder="SHOULDER" required="">
                                               </div>
                                
                                                <div class="entry measurement-entry">
                                                <label>Neck</label>
                                                <input type="text" class="mesure-form measurement-input" id="lum_input_required2" name="bodypartvalue[28]" value="" placeholder="NECK" required="">
                                               </div>

                                                <div class="entry measurement-entry">
                                                <label>Sleeve</label>
                                                <input type="text" id="lum_input_required3" class="mesure-form measurement-input" name="bodypartvalue[29]" placeholder="SLEEVE" required="">
                                                </div>

                                               <div class="entry measurement-entry">
                                                <label>Wrist</label>
                                                <input type="text" id="lum_input_required4" class="mesure-form measurement-input" name="bodypartvalue[31]" placeholder="WRIST" required="">
                                               </div>
                            
                                                <div class="entry measurement-entry">
                                                <label>Length</label>
                                                <input type="text" id="lum_input_required5" class="mesure-form measurement-input" name="bodypartvalue[32]" placeholder="SHIRT LENGTH" required="">
                                               </div>
                            
                                               <div class="entry measurement-entry">
                                               <label>Chest</label>
                                                <input type="text" id="lum_input_required6" class="mesure-form measurement-input" name="bodypartvalue[60]" placeholder="CHEST" required="">
                                               </div>
                            
                                                <div class="entry measurement-entry">
                                                <label>Arm Hole</label>
                                                <input type="text" id="lum_input_required7" class="mesure-form measurement-input" name="bodypartvalue[61]" placeholder="ARM HOLE" required="">
                                               </div>
                                                
                                                <div class="entry measurement-entry">
                                                <label>Waist</label>
                                                <input type="text" id="lum_input_required8" class="mesure-form measurement-input" name="bodypartvalue[62]" placeholder="WAIST" required="">
                                                </div>
                                                
                                                <div class="entry measurement-entry">
                                                <label>Hip</label>
                                                <input type="text" id="lum_input_required9" class="mesure-form measurement-input" name="bodypartvalue[67]" placeholder="HIP" required="">
                                                </div>
                                           
                                            </div>

                                            <label>Profile Name:</label>
                                            <input type="text" class="mesure-form" name="profilename" required="required">
                                            <button type="submit" id="add-mesurement" class="blue-btn lum_measurement_bottom_inner_top_button cart">Add to cart </button>
                                        </div>
 
                                        <div class="col-md-6">
                                            <h4 class="Title">how to measure</h4>
                                            <div id="guideDescription">

                                            </div>
                                        </div>
                                   
                                   </div>
                                </article>           
                            </section>   
                        </div>
                    </div>
                    
                    <div class="sidebar-measurement-summary col-md-3 col-md-pull-9 col-xs-12">
                        <div class="meas-summary">
                            <h3>summary</h3>
                                <!-- start var  -->
                            <div class="summary_container">
                                <div class="bm_summary_fit">
                                </div>
                                <div class="bm_summary_shoulder_type">
                                </div>
                                <div class="bm_summary_body_posture">
                                </div>
                                <div class="bm_summary_shoulder_angle">
                                </div>

                                <div class="bm_summary_measurement">
                                    <label>Height</label>
                                    <label class="bm_summary_heigth"></label>
                                    <label>Weight</label>
                                    <label class="bm_summary_weight"> </label>
                                    <label>Bicep</label>
                                    <label class="bm_summary_bicep"> </label>
                                    <label>Shoulder</label>
                                    <label class="bm_summary_shoulder"> </label>
                                    <label>Neck</label>
                                    <label class="bm_summary_neck"> </label>
                                    <label>Sleeve</label>
                                    <label class="bm_summary_sleeve"> </label>
                                    <label>Whist</label>
                                    <label class="bm_summary_wrist"> </label>
                                    <label>Length</label>
                                    <label class="bm_summary_shirt_length"> </label>
                                    <label>Chest</label>
                                    <label>Arm Hole</label>
                                    <label class="bm_summary_armhole"> </label>
                                    <label>Hip</label>
                                    <label class="bm_summary_hip"> </label>
                                    <label class="bm_summary_chest"> </label>
                                    <label>Waist</label>
                                    <label class="bm_summary_waist"> </label>
                                </div>
                            
                            </div>


                                <!-- end var  -->


                            <button type="submit" id="lum_measurement_bottom_inner_top_button" class="blue-btn lum_measurement_bottom_inner_top_button cart">Reset </button>
                        </div>
                    </div>
                
                </div>
            </div>
        </div>                
    </div>
</div>
</body>

<script src="<?=base_url() ?>js/jquery-2.1.1.js"></script>
<script src="<?=base_url() ?>js/bootstrap.min.js"></script>
<script src="<?=base_url() ?>js/jquery.slimscroll.js"></script>
<script src="<?=base_url() ?>js/custom-new.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
      $('.meas-summary').slimScroll({
            height: '90vh',
            color: 'rgb(40, 44, 62)',
            disableFadeOut: true
      });
   });
</script>

<script>
$(document).ready(function(){
    $('.meas_option').click( function(){
        $('.meas_option').removeClass("active");
        $(this).addClass("active");
    
        //      alert('test');
        //      $('.option_with_bg').addClass("active");
        //      $('.option_without_bg').hide();

    });
});
</script>

<script>
      var shirtDimension={"collar":"Regular","cuff":"Round", "pocket":"Pocket", "Monogram":"No", "MonoLocation":"", "Monofontstyle":"", "Monocolor":"", "Monotext":"None", "fitype":"None", "standardsize":"None", "length":"None","product_details_page":"<?php echo $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>",};

      $(document).ready(function () {

      //$(".image-zoom").simpleLightBox();
      $('.monogram_options').hide();
      $('.option_error').hide();
      /*shahjaz writing here*/
     // console.log("This is testing");
      $(".collar_select").on("click",function(){
        console.log("This is testing id :"+this.id);
        shirtDimension.collar=this.id.replace(/_/g, ' ');
         $('.collar_select').removeClass('active');
         $(this).addClass('active');
      });

      $(".cuff_select").on("click",function(){
        console.log("This is testing id :"+this.id);
        shirtDimension.cuff=this.id.replace(/_/g, ' ');
         $('.cuff_select').removeClass('active');
         $(this).addClass('active');
       });
       /*$(".fittype_select").on("click",function(){
        console.log("This is fittype id :"+this.id);
        shirtDimension.fitype=this.id.replace(/_/g, ' ');

        $('.fittype_select').removeClass('active');
        $(this).addClass('active');
        $('#fit_error').removeClass('option_error');
        $('#fit_error').hide();
        });
        $(".length_select").on("click",function(){
        console.log("This is fittype id :"+this.id);
        shirtDimension.length=this.id.replace(/_/g, ' ');

        $('.length_select').removeClass('active');
        $(this).addClass('active');
        $('#length_error').removeClass('option_error');
        $('#length_error').hide();
        }); 
        */

      $(".pocket_select").on("click",function(){
        console.log("This is pocket option  :"+this.id);
         shirtDimension.pocket=this.id.replace(/_/g, ' ');
         $('.pocket_select').removeClass('active');
         $(this).addClass('active');

      });

      $(".monogram_select").on("click",function(){
        console.log("This is Monogram option  :"+this.id);
        shirtDimension.Monogram=this.id.replace(/_/g, ' ');
        if(shirtDimension.Monogram=="No")
        {
          shirtDimension.Monocolor="";
          shirtDimension.MonoLocation="";
          shirtDimension.Monofontstyle="";
          shirtDimension.Monotext = "";
          $('.monogram_color_select').removeClass('active');
          $('.monogram_location_select').removeClass('active');
          $('.monogram_font_select').removeClass('active');
          $('.monogram_options').hide();
        }
         if(shirtDimension.Monogram=="Yes")
        {
          $('.monogram_options').show();
        }
        $('.monogram_select').removeClass('active');
        $(this).addClass('active');
        console.log("This is monogram color :"+shirtDimension.Monocolor);
        console.log("This is Location:"+shirtDimension.MonoLocation);
        console.log("This is font id :"+shirtDimension.Monofontstyle);
      });

      $(".monogram_color_select").on("click",function(){
        console.log("This is monogram color :"+this.id);
        shirtDimension.Monocolor=this.id.replace(/_/g, ' ');

         $('.monogram_color_select').removeClass('active');
        $(this).addClass('active');
      });
 
      $(".monogram_location_select").on("click",function(){
        console.log("This is Location:"+this.id);
        shirtDimension.MonoLocation=this.id.replace(/_/g, ' ');

         $('.monogram_location_select').removeClass('active');
        $(this).addClass('active');
      });

      $(".monogram_font_select").on("click",function(){
        console.log("This is font id :"+this.id);
        shirtDimension.Monofontstyle=this.id.replace(/_/g, ' ');

         $('.monogram_font_select').removeClass('active');
        $(this).addClass('active');
      });

        /*   $(".size_select").on("click",function(){
        console.log("This is size  :"+this.id);
        shirtDimension.standardsize=this.id.replace(/_/g, ' ');

        $('.size_select').removeClass('active');
        $(this).addClass('active');
        $('#size_error').removeClass('option_error');
        $('#size_error').hide();
        });*/

      $("#cust_det_fab_lum").click(function(){
        var product_id = $("#prd_id").val();
        var subcatid='<?php echo $_SESSION['subcatid']; ?>';
        window.location.href = '<? echo $bas_ul ?>home/new_custom/9/'+ subcatid +'/'+ product_id;
      });


      $("#summary,#m_summary").click(function(){
          shirtDimension.Monotext = $("#monogram_text").val();
          var html_data1 = "";
          var html_data='<h4>Product Name : <?php echo $proname ?></h4>';

        if(shirtDimension.Monogram=="No"){
        html_data1='</h4><h4>Collar : '+ shirtDimension.collar +'</h4><h4>Cuffs : '+ shirtDimension.cuff +' </h4><h4>Fit : '+ shirtDimension.fitype +' </h4><h4>Length :'+ shirtDimension.length +' </h4><h4>Pocket : '+ shirtDimension.pocket +' </h4><h4>Monogram : '+ shirtDimension.Monogram + '  </h4><h4>Size : '+ shirtDimension.standardsize +' </h4>';

        }
        else {
        html_data1='</h4><h4>Collar : '+ shirtDimension.collar +'</h4><h4>Cuffs : '+ shirtDimension.cuff +' </h4><h4>Fit : '+ shirtDimension.fitype +' </h4><h4>Length :'+ shirtDimension.length +' </h4><h4>Pocket : '+ shirtDimension.pocket +'</h4><h4>Monogram : '+ shirtDimension.Monogram + '  </h4><h4>Color : '+ shirtDimension.Monocolor +' </h4><h4>Location : '+ shirtDimension.MonoLocation +' </h4><h4>Font : '+ shirtDimension.Monofontstyle +' </h4><h4>Text : '+ shirtDimension.Monotext +' </h4><h4>Size : '+ shirtDimension.standardsize +'</h4>';
        }
      if(this.id=="m_summary")
      $('.m-summary-body').html(html_data+""+html_data1);
      else
      $('#summary_options').html(html_data+""+html_data1);

      });

      /*shahjaz end here*/
      $(".buy_now").on("click",function(){
      /*  if(shirtDimension.fitype == "None" || shirtDimension.length =="None" || shirtDimension.standardsize =="None")
        {
            $('.option_error').show();
        }
        else*/
        {
        shirtDimension.Monotext = $("#monogram_text").val();
        console.log(shirtDimension.Monotext);
        var result = "<?= $https_url_large_img."".$cmsf->image;?>";
        base_url = '<? echo $bas_ul?>';
        //alert(base_url);
        var exact_price = $("#prd_price").val();
        var product_id = $("#prd_id").val();
        var subcatid='<?php echo $_SESSION['subcatid']; ?>';
        //alert(subcatid);
        var ordertype;
        if(subcatid=="10")
        {
        ordertype="shirt";
        }
        else if(subcatid=="11")
        {
        ordertype="pant";
        }
        var fabric_nameshirt = $("#prd_namme").val();


        var loginUser='<?php echo $_SESSION['user_id']; ?>';


        if(loginUser)
        {

          $.ajax({
              url: "<? echo $bas_ul?>/cart/addcart3dcombined",
              type: 'POST',
              data:
              {
                details : JSON.stringify(shirtDimension) ,
                price_shirt : exact_price,
                productid_shirt : product_id ,
                subcatid_shirt : subcatid ,
                pname_shirt : fabric_nameshirt,
                imagedata_shirt : result,
                ordertype:"shirt",
                order:"stnadard"
               },
              success: function(response)
              {
              $('#loadingmessage').hide();
              //var url=base_url+'cart/lum_view_cart';
              window.location = "#shirt_measurements";
              }
            });
        }
        else{
          //alert("hello");
          $('#loadingmessage').show();
          $.ajax({
             url: "<? echo $bas_ul?>/cart/saveSelectionDatacombined",
            type: 'POST',
            data:
              {
                details :  JSON.stringify(shirtDimension),
                price_shirt : exact_price,
                productid_shirt : product_id ,
                subcatid_shirt : subcatid ,
                pname_shirt : fabric_nameshirt,
                imagedata_shirt : result,
                ordertype:"shirt",
                order:"stnadard"
               },
            success: function(response)
            {
              //alert(response);
              $('#loadingmessage').hide();
              var url=base_url+'home/lum_login';
              //alert(url);
              window.location = url;
            }
          });

          return false;
        }

      }
         });


        $(".add_wishlist").on("click",function(){

        var product_id = $("#prd_id").val();
        var loginUser='<?php echo $_SESSION['user_id']; ?>';
        base_url = '<? echo $bas_ul?>';
        if(loginUser)
        {
          //alert("hii");
          //$('#loadingmessage').show();
           console.log("Test2");
            $.ajax({
              url: "<? echo $bas_ul?>/cart/addwishlist",
              type: 'POST',
              data:
              {
                productid_shirt : product_id ,
               },
              success: function(response)
              {
                console.log(response);
                if(response=="success")
                $(".wish_added").html("<span  class='alert alert-success wish_message'>Item added in Wishlist</span>");
                else if(response=="duplicate")
                $(".wish_added").html("<span  class='alert alert-success wish_message'>Item already in Wishlist</span>");

          $('#loadingmessage').hide();

              var url=base_url;

              //window.location = url;
              }
            });
        }
        else{

            $.ajax({
             url: "<? echo $bas_ul?>/cart/saveSelectionDatacombined",
            type: 'POST',
            data:
              {
                productid_shirt : product_id ,
              },
            success: function(response)
            {



              //alert(response);
              $('#loadingmessage').hide();
              var url=base_url+'home/lum_login';
              //alert(url);
              window.location = url;
            }
          });

          return false;
        }


         });



      });
    </script>

<script type="text/javascript">

function showExistingMeasure(measureid){
  $(".bodymeasure").hide();
  $('#bodymeasure-'+measureid).show();

}


// <!-- Events -->
  // $(document).on('opening', '.remodal', function () {
  //   console.log('opening');
  // });
  // $(document).on('opened', '.remodal', function () {
  //   console.log('opened');
  // });
  // $(document).on('closing', '.remodal', function (e) {
  //   console.log('closing' + (e.reason ? ', reason: ' + e.reason : ''));
  // });
  // $(document).on('closed', '.remodal', function (e) {
  //   console.log('closed' + (e.reason ? ', reason: ' + e.reason : ''));
  // });
  // $(document).on('confirmation', '.remodal', function () {
  //   console.log('confirmation');
  // });
  // $(document).on('cancellation', '.remodal', function () {
  //   console.log('cancellation');
  // });
  // //The second way to initialize:
  // $('[data-remodal-id=modal2]').remodal({
  //   modifier: 'with-red-theme'
  // });


jQuery(document).ready(function($){
  var tabItems = $('.cd-tabs-navigation a'),
    tabContentWrapper = $('.cd-tabs-content');

  tabItems.on('click', function(event){
    event.preventDefault();
    var selectedItem = $(this);
    if( !selectedItem.hasClass('selected') ) {
      var selectedTab = selectedItem.data('content'),
        selectedContent = tabContentWrapper.find('li[data-content="'+selectedTab+'"]'),
        slectedContentHeight = selectedContent.innerHeight();

      tabItems.removeClass('selected');
      selectedItem.addClass('selected');
      selectedContent.addClass('selected').siblings('li').removeClass('selected');
      //animate tabContentWrapper height when content changes
      tabContentWrapper.animate({
        'height': slectedContentHeight
      }, 200);
    }
  });

  //hide the .cd-tabs::after element when tabbed navigation has scrolled to the end (mobile version)
  checkScrolling($('.cd-tabs nav'));
  $(window).on('resize', function(){
    checkScrolling($('.cd-tabs nav'));
    tabContentWrapper.css('height', 'auto');
  });
  $('.cd-tabs nav').on('scroll', function(){
    checkScrolling($(this));
  });

  function checkScrolling(tabs){
    var totalTabWidth = parseInt(tabs.children('.cd-tabs-navigation').width()),
      tabsViewport = parseInt(tabs.width());
    if( tabs.scrollLeft() >= totalTabWidth - tabsViewport) {
      tabs.parent('.cd-tabs').addClass('is-ended');
    } else {
      tabs.parent('.cd-tabs').removeClass('is-ended');
    }
  }
});

/*avr measurements functions here.*/

var shritDimension={"HEIGHTinch":"","WEIGHTkg":"","pocket":"NO","Monogram":"NO","MonoLocation":"","Monofontstyle":"","Monocolor":"","Monotext":"None","fitype":"NO","standardsize":"NO","length":"NO","shoulder":"","neck":"","length":"","chest":"","waist":"","sleeve":""};

// var selectionType_bm={"bm_summary_heigth":"height_select","bm_summary_weight":"weight","bm_summary_bicep":"lum_input_required0","bm_summary_shoulder":"lum_input_required1","bm_summary_neck":"lum_input_required2","bm_summary_sleeve":"lum_input_required3","bm_summary_wrist":"lum_input_required4","bm_summary_shirt_length":"lum_input_required5","bm_summary_armhole":"lum_input_required7","bm_summary_hip":"lum_input_required9","bm_summary_chest":"","bm_summary_waist":"lum_input_required8",};



var selectionType_summary={"height_select":"bm_summary_heigth","weight":"bm_summary_weight","lum_input_required0":"bm_summary_bicep","lum_input_required1":"bm_summary_shoulder","lum_input_required2":"bm_summary_neck","lum_input_required3":"bm_summary_sleeve","lum_input_required4":"bm_summary_wrist","lum_input_required5":"bm_summary_shirt_length","lum_input_required7":"bm_summary_armhole","lum_input_required9":"bm_summary_hip","lum_input_required8":"bm_summary_waist",};



$(".mesure-form").change(function(){
    
    console.log("This is testing for measure form");
    console.log($(this).val());
    console.log($(this).attr('id'));
    var gettheid=$(this).attr('id');

    console.log("this is selection type by body measurement");
    console.log("this is id of current id"+selectionType_summary[gettheid]);
    $("."+selectionType_summary[gettheid]).text($(this).val())

    // $.each(selectionType_bm, function(key, value){
    //     console.log(key, value);
    // });
  //start assignation of the value to summary class container...
   // <div class="bm_summary_fit">
   //                              </div>
   //                              <div class="bm_summary_shoulder_type">
   //                              </div>
   //                              <div class="bm_summary_body_posture">
   //                              </div>
   //                              <div class="bm_summary_shoulder_angle">
   //                              </div>
   //                              <div class="bm_summary_measurement">
   //                                  <label>Height</label>
   //                                  <label class="bm_summary_heigth"></label>
   //                                  <label>Weight</label>
   //                                  <label class="bm_summary_weight"> </label>
   //                                  <label>Bicep</label>
   //                                  <label class="bm_summary_bicep"> </label>
   //                                  <label>Shoulder</label>
   //                                  <label class="bm_summary_shoulder"> </label>
   //                                  <label>Neck</label>
   //                                  <label class="bm_summary_neck"> </label>
   //                                  <label>Sleeve</label>
   //                                  <label class="bm_summary_sleeve"> </label>
   //                                  <label>Whist</label>
   //                                  <label class="bm_summary_whist"> </label>
   //                                  <label>Length</label>
   //                                  <label class="bm_summary_shirt_length"> </label>
   //                                  <label>Chest</label>
   //                                  <label>Arm Hole</label>
   //                                  <label class="bm_summary_armhole"> </label>
   //                                  <label>Hip</label>
   //                                  <label class="bm_summary_hip"> </label>
   //                                  <label class="bm_summary_chest"> </label>
   //                                  <label>Waist</label>
   //                                  <label class="bm_summary_waist"> </label>
   //                              </div>                         
   //                          </div>
   /*var started working*/
   // "bm_summary_heigth    
   // <label>Weight</label>
   // "bm_summary_weight"    
   // <label>Bicep</label>
   // "bm_summary_bicep"    
   // <label>Shoulder</label>
   // "bm_summary_shoulder"    
   // <label>Neck</label>
   // "bm_summary_neck"    
   // <label>Sleeve</label>
   // "bm_summary_sleeve"    
   // <label>Whist</label>
   // "bm_summary_whist"    
   // <label>Length</label>
   // "bm_summary_shirt_length"    
   // <label>Chest</label>
   // <label>Arm Hole</label>
   // "bm_summary_armhole"    
   // <label>Hip</label>
   // "bm_summary_hip"    
   // "bm_summary_chest"    
   // <label>Waist</label>
   // "bm_summary_waist"    
    // $(".      bm_summary_heigth      ").text();
    // $(".      bm_summary_weight      ").text();
    // $(".      bm_summary_bicep      ").text();
    // $(".      bm_summary_shoulder      ").text();
    // $(".      bm_summary_neck      ").text();
    // $(".      bm_summary_sleeve      ").text();
    // $(".      bm_summary_whist      ").text();
    // $(".      bm_summary_shirt_length      ").text();
    // $(".      bm_summary_armhole      ").text();
    // $(".      bm_summary_hip      ").text();
    // $(".      bm_summary_chest      ").text();
    // $(".      bm_summary_waist      ").text();
    /*var working herer*/

});



function changeTheSummary(measurement){
        $('.summary_shoulder').text(measurement.shoulder);
        $('.summary_neck').text(measurement.neck);
        $('.summary_sleeve').text(measurement.sleeve);
        $('.summary_shirt_length').text(measurement.shirt_length);
        $('.summary_chest').text(measurement.chest);
        $('.summary_waist').text(measurement.waist);
}

/***********
****** to get standard measurements based on size selection
****** stylior.com : 18 Oct 2016
*/
var measurement_server="";
$('select#size_select').change(function(){
var selected_size=$("#size_select option:selected").text();
var     base_url = '<?php echo $bas_ul; ?>';
if(selected_size!=undefined){

      console.log("var testing."+selected_size+"url"+base_url);
      $.ajax({
        url: base_url+"home/get_tbl_size/"+selected_size+"/10",
        type:'GET',
        data:
          {
            size : selected_size,
            category :  '10'
          },
        success: function(response) {
          console.log(response.length);
          if(response !== null && response !== undefined && response.length > 100){
          var var_result= $.parseJSON(response);
          var measurement = $.parseJSON(var_result.measurement);
         //change the value of measurement based on the server response.
          changeTheSummary(measurement);

          $("#lum_input_required1").val(measurement.shoulder);
          $("#lum_input_required2").val(measurement.neck);
          $("#lum_input_required3").val(measurement.sleeve);
          $("#lum_input_required5").val(measurement.shirt_length);
          $("#lum_input_required6").val(measurement.chest);
          $("#lum_input_required8").val(measurement.waist);
          }
          else{

          $("#lum_input_required1").val("");
          $("#lum_input_required2").val("");
          $("#lum_input_required3").val("");
          $("#lum_input_required5").val("");
          $("#lum_input_required6").val("");
          $("#lum_input_required8").val("");

          }


        }
      });
  }
});

    /*********
    ***end of standard measurement function...
    */

    /*  jQuery.validator.setDefaults({
        debug: true,
        success: "valid"
      });
    */
    $("#quick_save").click(function(){
       var measureid ="";
        if("<?= $_GET['update'] ?>"=="shirt"){
         measureid = '<?php echo $_GET['mid'];?>';
        }
        var height_select=$('#height_select').val();
        var size_select=$('#size_select').val();
        var body_weight=$('#body_weight').val();
        var yourfit=$('input[name="yourfit"]:checked').val();
        var yourlength=$('input[name="yourlength"]:checked').val();
        console.clear();
        console.log("height_select:"+height_select+"body_weight:"+body_weight+"yourfit:"+yourfit+"yourlength:"+yourlength);  
        shritDimension.HEIGHTinch=height_select;
        shritDimension.standardsize=size_select;
        shritDimension.WEIGHTkg=body_weight;
        shritDimension.fitype=yourfit;
        shritDimension.length=yourlength;
        
        /*added by var for standard measurements*/
        shritDimension.shoulder=$("#lum_input_required1").val();
        shritDimension.neck=$("#lum_input_required2").val();
        shritDimension.sleeve=$("#lum_input_required3").val();
        shritDimension.shirt_length=$("#lum_input_required5").val();
        shritDimension.chest=$("#lum_input_required6").val();
        shritDimension.waist=$("#lum_input_required8").val();
        
        /*end by var*/
        //ajax call to server420
        var result ="imagedata";
        //var imgData = getBase64Image($('#saveImg').attr('src')));
        base_url = '<?php echo $bas_ul; ?>';
        // var exact_price = $("#prd_price").val();
        // var product_id = $("#prd_id").val();
        var subcatid='<?php echo $_SESSION['subcatid']; ?>';
        var ordertype;
        //alert("tyoe"+subcatid);
        if(subcatid=="10")
        {
         ordertype="shirt";
        }
        else if(subcatid=="11")
        {
         ordertype="pant";
        }
        //var fabric_nameshirt = $("#prd_namme").val();
        var loginUser='<?php echo $_SESSION['user_id']; ?>';
        console.log(base_url);
        if(loginUser)
        {
          $.ajax({
              url: base_url+"cart/updatecart",
              type: 'POST',
              data:
              {
                details_up : JSON.stringify(shritDimension),
                measureid :  measureid
                  },
              success: function(response) {
                  console.log("AVR"+response);
                   window.location.href= base_url+"cart/lum_view_cart";
              }
            });
        }
      });

    /** Add Measurement data collect from here.
    *******
    *****
    ***/
    base_url = '<?= $bas_ul ?>';

    $("#add-mesurement").on("click",function(){
            /*alert("var testing");
            console.log("thid is data tesitng");
            */

            var data = $(".mesure-form").serialize();
             $.ajax({
                url:base_url+'cart/new_mvalue' ,
                method: "POST",
                data: {'data': $(".mesure-form").serialize(),
                      'subcatid':10,
                },
                success:function(data){
                  console.log("this is data"+data);
                  location.href='<? echo $bas_ul?>/cart/lum_view_cart';

                }
               });

    });

    /*change the instruction on body part*/
    /*date 14 sep 2016*/

    $(".entry").on("click",function(){
    $(".pre-loader").show();

    var base_url='<? echo $bas_ul?>';
    var current_id=this.id;
    var i = $(this).find(" input");
    var name = $(i).attr("name");
    var m = name.substring(14, 16);
    $("#guideDescription").html("");
    $("#guideDescription-standard").html("");
    $.ajax({

      url:base_url+'home/getbodypart' ,
      method: "POST",
      data: {'bid': m},
      success:function(data){
      data = JSON.parse(data);
      var youtubeurl = base_url+""+data.youtubeurl;
      var description = "<p>"+data.desc+"</p>";
      var source_video='<video id="lum_input_required_video1" class="lum_video-new" controls><source src="'+youtubeurl+'" type="video/mp4"><source src="'+youtubeurl+'" type="video/ogg"></video>'+description;
      
      $(".pre-loader").hide();
      
      if(current_id == "entry-standard"){
          $("#guideDescription-standard").append(source_video);
      }
      else{
          $("#guideDescription").append(source_video);
      }

      var vidd = document.getElementById("lum_input_required_video1");
        vidd.play();

      }
    });

    });
    


    /*create array to store all the values of fit and lenght body posture  and other image selection options*/
    var selectionType={"fit": ["regular_fit", "tailored", "comfort"],
    "length": ["length_short", "length_regular", "length_high"]};

    var selectionType_bm={"bm_fit": ["bm_slim", "bm_tailored", "bm_regular"],
    "body_posture": ["bp_normal", "bp_hunched", "bp_erect"],
    "shoulder_type": ["st_normal", "st_sloping", "st_straight"],
    "shoulder_angle": ["sa_even", "sa_lower_left", "sa_lower_right"],
};



   // {"fit":{"slim","tailored","confort"},"lenght":{"short","regular","tall"},};
   
    function getSelectedMeasure(idtype,number){
        $("#"+idtype).val(number);
    }

    //hide all with bg images ..
    $(".option_with_bg").hide();
    $(".option_without_bg").show();
    
    var data_container = '';
   


   /*summary work start */
    $(".height_select").on("click",function(){
        var height_selected=$(this).val();
        $(".summary_heigth").text(height_selected);
    });

    $("#body_weight").on("click",function(){
        var height_selected=$(this).val();
        $(".summary_weight").text(height_selected);
    });

    //shoulder value collection
    $("#lum_input_required1").on("change",function(){
        
        var valuetext=$(this).val();
        $(".summary_shoulder").text(valuetext);
   
    });
    //neck text value collect
     $("#lum_input_required2").on("change",function(){
        
        var valuetext=$(this).val();
        $(".summary_neck").text(valuetext);
   
    });

    //sleeve text value collect
     $("#lum_input_required3").on("change",function(){
        
        var valuetext=$(this).val();
        $(".summary_sleeve").text(valuetext);
   
    });


    //shirt_length text value collect
     $("#lum_input_required5").on("change",function(){
        
        var valuetext=$(this).val();
        $(".summary_shirt_length").text(valuetext);
   
    });

    //shirt_length text value collect
     $("#lum_input_required5").on("change",function(){
        
        var valuetext=$(this).val();
        $(".summary_shirt_length").text(valuetext);
   
    });


    //shirt_length text value collect
     $("#lum_input_required6").on("change",function(){
        var valuetext=$(this).val();
        $(".summary_chest").text(valuetext);
     });
    //shirt_length text value collect
     $("#lum_input_required7").on("change",function(){       
        var valuetext=$(this).val();
        $(".summary_chest").text(valuetext);
    });
   

    $(".meas_option_rel").on("click",function(){

            var selected_value=$(this).attr("rel");        
            alert(selected_value);            
            
            //create a empty container here
            if ($.inArray(selected_value, selectionType.fit) > -1)
            {
                $('.summary_fit').html('');
                /*var added*/
                var imgsrc=$(this).attr('src');                    
        
                var string_data='<div class="summary_option">\
                <img src="'+imgsrc+'">\
                <label>'+selected_value+'</label>\
                </div>';
        
                data_container = string_data;
        
                $('.summary_fit').html(data_container);
        
                /*end var*/          
                // $(".option_without_bg,.option_without_fit").show();
                // $(".option_with_bg ,.option_with_bg_fit ").hide();
            }
            else if ($.inArray(selected_value, selectionType.length) > -1)
            {
                $('.summary_length').html('');
                // console.log("Got the selection of length");
                /*var added*/
                var imgsrc=$(this).attr('src');                    
        
                var string_data='<div class="summary_option">\
                <img src="'+imgsrc+'">\
                <label>'+selected_value+'</label>\
                </div>';      
                data_container = string_data;
                $('.summary_length').html(data_container);
            }
            else {

                /*var started on 17 May 2017*/
                /*reference data collected here
                *****
                <div class="bm_summary_shoulder_type">
                </div>
                <div class="bm_summary_body_posture">
                </div>
                <div class="bm_summary_shoulder_angle">
                </div>
                //Measurement array store here
                var selectionType_bm={"bm_fit": ["bm_slim", "bm_tailored", "bm_regular"],
                "body_posture": ["bp_normal", "bp_hunched", "bp_erect"],
                "shoulder_type": ["st_normal", "st_sloping", "st_straight"],
                "shoulder_angle": ["sa_even", "sa_lower_left", "sa_lower_right"],
                };
                ******/
                if ($.inArray(selected_value, selectionType_bm.bm_fit) > -1)
                {
                    $('.bm_summary_fit').html('');
                    // console.log("Got the selection of length");
                    /*var added*/
                    var imgsrc=$(this).attr('src');                    
                    var string_data='<div class="summary_option">\
                    <img src="'+imgsrc+'">\
                    <label>'+selected_value+'</label>\
                    </div>';      
                    data_container = string_data;
                    $('.bm_summary_fit').html(data_container);
                
                }
               else if ($.inArray(selected_value, selectionType_bm.body_posture) > -1)
                {
                    $('.bm_summary_body_posture').html('');
                    // console.log("Got the selection of length");
                    /*var added*/
                    var imgsrc=$(this).attr('src');                    
                    var string_data='<div class="summary_option">\
                    <img src="'+imgsrc+'">\
                    <label>'+selected_value+'</label>\
                    </div>';      
                    data_container = string_data;
                    $('.bm_summary_body_posture').html(data_container);
                }
               else if ($.inArray(selected_value, selectionType_bm.shoulder_type) > -1)
                {
                    $('.bm_summary_shoulder_type').html('');
                    // console.log("Got the selection of length");
                    /*var added*/
                    var imgsrc=$(this).attr('src');                    
                    var string_data='<div class="summary_option">\
                    <img src="'+imgsrc+'">\
                    <label>'+selected_value+'</label>\
                    </div>';      
                    data_container = string_data;
                    $('.bm_summary_shoulder_type').html(data_container);
                }
               else if ($.inArray(selected_value, selectionType_bm.shoulder_angle) > -1)
                {
                    $('.bm_summary_shoulder_angle').html('');
                    // console.log("Got the selection of length");
                    /*var added*/
                    var imgsrc=$(this).attr('src');                    
                    var string_data='<div class="summary_option">\
                    <img src="'+imgsrc+'">\
                    <label>'+selected_value+'</label>\
                    </div>';      
                    data_container = string_data;
                    $('.bm_summary_shoulder_angle').html(data_container);
                }

            }
            // $("section.option_with_bg").hide();
            $(this).parents('section').find('.option_without_bg').show();
            $(this).parents('section').find('.option_with_bg').hide();
            $(this).hide();
            // console.log("Testing");
            // var attr_value = $(this).attr("rel");
            // console.log(attr_value);
            $(this).next('.option_with_bg').show();
            $("#"+$(this).attr("rel")).trigger("click");
            $('.meas_option_rel').each(function() {
                if(!$("#"+$(this).attr("rel")).is(':checked'))
                {    
                     $(this).css({"border": ""});
                     $("."+$(this).attr("rel")).remove();         
                }
                else
                {
                    $("."+$(this).attr("rel")).remove(); 
                   $(this).css({"border": "1px solid black"});
                }
            });

});

</script>
</html>


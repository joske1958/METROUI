<?php
// incl_metro_functions_2.php  is used for metro objects used in wbs project 
ini_set('display_errors', 'On');
error_reporting(E_ALL);

// functions start here
 
// HELP create dropdown menu call like this WIG_dropdown("caption=drop_test","w_dropdown=WIG_msg|||txt=hello WIG_container|||txt=lll WIG_toastr|||txt=toast");
function WIG_dropdown()
 {
WIG_reset_global_vars();
$my_function=__FUNCTION__;$my_function=str_replace("WIG","WAR","$my_function");	
$GLOBALS["$my_function"]=array_merge($GLOBALS["$my_function"],func_get_args());
$GLOBALS["$my_function"]["display"]="inline-block";
$GLOBALS["$my_function"]["style"]="YES";$my_style=WIAG_bs($GLOBALS["$my_function"]);
$caption=$GLOBALS["$my_function"]["caption"];$class=$GLOBALS["$my_function"]["class"];
usleep(100);$time_end=round(microtime(true) * 1000);$new_id="$my_function" . "_" . "$time_end";
echo "<div id=\"$new_id\" $my_style >";	
echo "<div><button  class=\"button dropdown-toggle $class\" $my_style >$caption</button>";
$d_menu_class=str_replace("button","","$class");
 echo "<ul data-role=\"dropdown\" class=\"d-menu $d_menu_class\" >";
  foreach ($GLOBALS["$my_function"] as $key => $value)
   {	   
	 if ( preg_match('/^w_dropdown/',$key) == 1 )
	           {  			
                $my_array=explode(" ","$value");
                for($i=0; $i <=substr_count( "$value" ," "); $i+=1)
				 {	
                  // echo "<li> $i . $my_array[$i] </li>";			 
				 $my_caption=strtolower($my_array[$i]);$my_caption=str_replace("|||",":",$my_array[$i]);$my_cmd=$my_array[$i];
				 if( preg_match('(my_option=)',$my_cmd) == 1 ){$my_caption=substr($my_cmd,strpos($my_cmd,"my_option=")+10,strlen($my_cmd));}
				 echo"<li>";WIG_btn("cmd=$my_cmd","caption=$my_caption","class=$class");echo "</li>";

				  }
			   }
   }
   echo "</ul>";
  echo "</div>";
echo "</div>";
 }
 
 


 // HELP send message JAV_notify(my_text,my_delay,my_color,my_width)
function WIG_notify_new($my_text="none" , $my_delay=5000 , $my_color="info" , $my_width=250 )
{
$my_function=__FUNCTION__;$my_function=str_replace("WIG","WAR","$my_function");	
$GLOBALS["$my_function"]=array_merge($GLOBALS["WAR_metro"],func_get_args());
$my_style=WIAG_bs($GLOBALS["$my_function"]);
$args=implode(func_get_args());
$cls=$GLOBALS["$my_function"]["class"];
$timeout=$GLOBALS["$my_function"]["delay"];
$my_width=250 + rand(10,200);
// echo "<script type=\"text/javascript\">  $(document).ready(function() { JAV_notify(); } );</script>";
// alert,info,succes, primary, .secondary, .success, .alert, .warning, .yellow, .info and .light
// echo "<br> wig_notify : cls: $my_color , width:$my_width , timeout : $my_delay  , args : $my_text ";
echo "<script>Metro.notify.create(\"$my_text\",\"\",{cls:\"$my_color\",width:$my_width,duration:1000,timeout:$my_delay});</script>";
}
 
// HELP  create msg default params are in $GLOBALS["WAR_metro"] use WIG_help("my_help=WIG_msg"); or ?WIG_help=my_help=WIG_msg
function WIG_msg()
{
WIG_reset_global_vars();
$my_function=__FUNCTION__;$my_function=str_replace("WIG","WAR","$my_function");
$GLOBALS["$my_function"]=array_merge($GLOBALS["WAR_metro"],func_get_args());
// $GLOBALS["$my_function"]["visibility"]="hidden";
$my_style=WIAG_bs($GLOBALS["$my_function"]);
$my_delay=intval($GLOBALS["$my_function"]["delay"]);$my_txt=$GLOBALS["$my_function"]["txt"];
$GLOBALS["$my_function"]["width"]="90%";$GLOBALS["$my_function"]["height"]="200px";
usleep(100);$time_end=round(microtime(true) * 1000);$new_id="$my_function" . "_" . "$time_end";
// echo "<br> my_delay :$my_delay:";
$seconds=round($my_delay / 1000, 0, PHP_ROUND_HALF_UP);$seconds=$seconds . "s";
$animation=$GLOBALS["$my_function"]["animation"];
$my_style=WIAG_bs($GLOBALS["$my_function"]);
echo "<div $my_style id=\"$new_id\" >";	
if ( $my_delay > 1000 ){WIG_progress("timer=$my_delay");}
echo "$my_txt<br>";
// foreach ($GLOBALS["$my_function"] as $key => $value){echo "<br> 1 wig_msg key :$key => $value";}
WIAG_bs_exec($GLOBALS["$my_function"]);
// foreach ($GLOBALS["$my_function"] as $key => $value){echo "<br> 2 wig_msg key :$key => $value";}
if ( preg_match('/^YES/', $GLOBALS["$my_function"]["close_btn"]) == 1  )
{WIG_btn("caption=X","cmd=JAV_hide|||$new_id|||none|||5s","top=10px","right=10px","position=absolute","background-color=red !important");}
echo "</div>";
if ( $my_delay > 1000 ){echo "<script type=\"text/javascript\">JAV_show_hide('$new_id','$animation','$seconds');</script>";}
if ( $my_delay < 1000 ){echo "<script type=\"text/javascript\">$(document).ready(function() { JAV_show('$new_id','$animation');} );</script>";}		
}
 
 
 
// HELP  create msg default params are in $GLOBALS["WAR_metro"],type = "info" , delay ="999" , exec=function , txt=kkk
function WIG_msg_old()
{
$my_param=array();$my_param=func_get_args();
// echo "<pre>";print_r(var_dump($my_param));echo "</pre>";
call_user_func_array("WIG_metro",$my_param );
}
 
 
// jos
// color metro= class : bg-blue fg-red ,alert,info,succes, primary, .secondary, .success, .alert, .warning, .yellow, .info and .light 
// my_pos metro          :  top,left,bottom, right , tl,tr,bl,br
// HELP create toast msg with given params , the position is determined by "my_pos" , the color by "class"
function WIG_toast()
{
$my_function=__FUNCTION__;$my_function=str_replace("WIG","WAR","$my_function");
$GLOBALS["$my_function"]=array_merge($GLOBALS["WAR_metro"],func_get_args());
$GLOBALS["$my_function"]["delay"]="5000";$GLOBALS["$my_function"]["z-index"]="9999";
$GLOBALS["$my_function"]["width"]="300px";$GLOBALS["$my_function"]["height"]="100px";
$GLOBALS["$my_function"]["DEBUG"]="OFF";
$GLOBALS["$my_function"]["visibility"]="hidden";
$my_style=WIAG_bs($GLOBALS["$my_function"]);
if ( preg_match('/right|tr|br|mid|mr/', $GLOBALS["$my_function"]["my_pos"]) == 1 ){$GLOBALS["$my_function"]["left"]="80%";}
$my_style=WIAG_bs($GLOBALS["$my_function"]);
$animation=$GLOBALS["$my_function"]["animation"];
$my_delay=$GLOBALS["$my_function"]["delay"];$my_txt=$GLOBALS["$my_function"]["txt"];
usleep(100);$time_end=round(microtime(true) * 1000);$new_id="$my_function" . "_" . "$time_end";
$seconds=round($my_delay / 1000, 0, PHP_ROUND_HALF_UP);$seconds=$seconds . "s";
echo "<div $my_style id=\"$new_id\" >";	
if ( $my_delay > 1000 ){WIG_progress("timer=$my_delay");}
echo "$my_txt <br>";
//echo "<br> $my_style <br>";
WIAG_bs_exec($GLOBALS["$my_function"]);
if ( preg_match('/^YES/', $GLOBALS["$my_function"]["close_btn"]) == 1  )
{
$close_animation=str_replace("In","Out","$animation");
WIG_btn("caption=X","cmd=JAV_hide|||$new_id|||$close_animation|||5s","top=5px","right=5px","position=absolute","background-color=red !important");
}
// echo "<script type=\"text/javascript\">JAV_hide('$new_id','$close_animation','10s');</script>";
echo "</div>";
if ( $my_delay < 1000 ){echo "<script type=\"text/javascript\">JAV_show('$new_id','$animation');</script>";}	
// $animation=str_replace("In","Out","$animation");	
if ( $my_delay > 1000 )
{echo "<script type=\"text/javascript\">JAV_show_hide('$new_id','$animation','$seconds');</script>";}	
}



// echo "<br> option $my_option class  : $class txt_tablename=$txt_tablename old_txt_tablename=$old_txt_tablename";
// $my_option = type of menu : v-menu , h-menu , d-menu , dropdown ,sidebar
// $class = color : alert,info,succes, primary, secondary, success, alert, warning, yellow, info ,light or fg-red bg-blue
// HELP create menu with a text file options are : v-menu , h-menu , d-menu , dropdown ,sidebar
function WIG_menu()
{
$GLOBALS["WAR_menu"]=[ "class"=>"bg-light-green fg-blue","delay" => "999","my_option"=> "none","caption"=>"none",
 "txt" => "none" ,"caption" => "none","border"=> "5px solid blue","border-radius"=> "10px","type"=>"info","font-size" => "20px","mode"=>"horizontal","txt_tablename"=> "test.dat"];
$my_function=__FUNCTION__;$my_function=str_replace("WIG","WAR","$my_function");	
$GLOBALS["$my_function"]=array_merge($GLOBALS["WAR_menu"],func_get_args());
$my_style=WIAG_bs($GLOBALS["$my_function"]);$class=$GLOBALS["$my_function"]["class"];$caption=$GLOBALS["$my_function"]["caption"];
$my_option=$GLOBALS["$my_function"]["my_option"];
$class=$GLOBALS["$my_function"]["class"];
$my_style=WIAG_bs($GLOBALS["$my_function"]);	
// foreach ($GLOBALS["$my_function"] as $key => $value){echo "<br> WIG_menu key :$key => value : $value";}
$my_delay=$GLOBALS["$my_function"]["delay"];$my_txt=$GLOBALS["$my_function"]["txt"];
$txt_tablename=$GLOBALS["$my_function"]["txt_tablename"];
$old_txt_tablename=$txt_tablename;
$wig_datatable=preg_replace('/.dat|\//','', $txt_tablename);
$my_txt_tablename=$wig_datatable;
${$wig_datatable}=$wig_datatable;
$txt_tablename=$_SESSION["DATA"] . "/" . $_SESSION["username"] . "_" . $txt_tablename ;
usleep(100);$time_end=round(microtime(true) * 1000);$my_id="$my_function" . "_" . "$time_end";
global $wig_datatable;$wig_datatable=array();


// if( file_exists($txt_tablename)){unlink($txt_tablename);}	
if( !file_exists($txt_tablename))
{
$txt_tableinfo="status id text link target onclick";
$txt_num_records=30;
WIG_create_txt_db($txt_tablename,$txt_tableinfo,$txt_num_records);
$wig_datatable =WIG_get_txt_db($txt_tablename, $wig_datatable );
for($record=1;$record<= 10;$record++)
{
$wig_datatable[0][$record]="Y";$wig_datatable[2][$record]="google_$record";$wig_datatable[3][$record]="https://www.google.be";
$wig_datatable[4][$record]="_blank";$wig_datatable[5][$record]="JAV_p('WIG_container=width=800px|||DEBUG=ON|||class=$class');return false;";
}
$wig_datatable[0][1]="Y";$wig_datatable[2][1]="EDIT";$wig_datatable[3][1]="?WIG_container=cmd=WIG_metro_show_datatables|%|txt_tablename=$old_txt_tablename|||class=$class";$wig_datatable[4][1]="_self";
$wig_datatable[5][2]="JAV_p('WIG_container=cmd=WIG_metro_show_datatables|%|txt_tablename=$old_txt_tablename|||class=$class');return false";
$wig_datatable[0][7]="Y";$wig_datatable[2][7]="WB20";$wig_datatable[3][7]="https://v5.metroui.org.ua/";
$wig_datatable[0][8]="Y";$wig_datatable[2][8]="test";$wig_datatable[3][8]="./test.php";
$wig_datatable[0][9]="Y";$wig_datatable[2][9]="dropdown";$wig_datatable[4][9]="h-dropdown.dat";
$wig_datatable[0][9]="Y";$wig_datatable[2][9]="dropdown";$wig_datatable[5][9]="JAV_p('WIG_container=width=800px|||DEBUG=ON|||class=fg-red bg-blue');return false;";
$wig_datatable[0][10]="Y";$wig_datatable[2][10]="2-dropdown";$wig_datatable[4][10]="2-h-dropdown.dat";
WIG_write_txt_db($txt_tablename, $wig_datatable);
}	

$wig_datatable=WIG_get_txt_db("$txt_tablename",$wig_datatable );$records_db=count($wig_datatable[0])-2;
// echo "<br> option $my_option class  : $class txt_tablename=$txt_tablename old_txt_tablename=$old_txt_tablename";
// $my_option = type of menu : v-menu , h-menu , d-menu , dropdown ,sidebar
// $class = color : alert,info,succes, primary, secondary, success, alert, warning, yellow, info ,light or fg-red bg-blue
switch( $my_option )
  {	 
    case 1 == preg_match('/^sidebar/',$my_option):
	 // ?><script>Metro.sidebarSetup({position: "right"});</script><?php	
      echo "<button class=\"$class w-min-5 w-max-10\" id=\"sidebar-toggle\">S</button>";
      echo "<div data-role=\"$my_option\" data-toggle=\"#sidebar-toggle\">";
	 echo "<ul class=\"sidebar-menu\" >";
         for($record=1;$record<$records_db;$record++) 
           {
            if ( $wig_datatable[0][$record] == "Y" && preg_match('/.dat/', $wig_datatable[4][$record]) == 0  )
			 {
			  $target=$wig_datatable[4][$record];$href=$wig_datatable[3][$record];$text=$wig_datatable[2][$record];
			  $on_click=$wig_datatable[5][$record];if ( strlen($href) > 1 ){$on_click="";}
			  $my_record="<li ><a  class=\"$class\" onclick=\"$on_click\" href=\"$href\" target=\"$target\">$text&nbsp;</a></li>";echo "$my_record";
			  }	
             if ( $wig_datatable[0][$record] == "Y" && preg_match('/.dat/', $wig_datatable[4][$record]) == 1  )
			 {
			  $menu_txt_tablename=$wig_datatable[4][$record];
			  // echo "<br>";
			  WIG_menu("txt_tablename=$menu_txt_tablename","class=$class","my_option=dropdown");	
			  }					  
           }
     echo "</ul>";	
    echo "</div>"; 	 
	break;

    case 1 == preg_match('/^v-menu/',$my_option):	   
	 echo "<ul class=\"$my_option $class\" style=\"width:300px\" >";
	  echo "<ul>";
         for($record=1;$record<$records_db;$record++) 
           {
            if ( $wig_datatable[0][$record] == "Y" && preg_match('/.dat/', $wig_datatable[4][$record]) == 0  )
			 {
			  $target=$wig_datatable[4][$record];$href=$wig_datatable[3][$record];$text=$wig_datatable[2][$record];
			  $on_click=$wig_datatable[5][$record];if ( strlen($href) > 1 ){$on_click="";}
			  $my_record="<li ><a  class=\"$class\" onclick=\"$on_click\" href=\"$href\" target=\"$target\">$text&nbsp;</a></li>";echo "$my_record";
			  }		  
           }
       echo "</ul>";
     echo "</ul>";		   
	break;

    case 1 == preg_match('/^h-menu/',$my_option):	      
	echo "<ul class=\"$my_option $class\"";
         for($record=1;$record<$records_db;$record++) 
           {
            if ( $wig_datatable[0][$record] == "Y" && preg_match('/.dat/', $wig_datatable[4][$record]) == 0  )
			  {
			  $target=$wig_datatable[4][$record];$text=$wig_datatable[2][$record];$href=$wig_datatable[3][$record];
			  $on_click=$wig_datatable[5][$record];if ( strlen($href) > 4 ){$on_click="";}
			   $my_record="<a  class=\"$class\" onclick=\"$on_click\" href=\"$href\" target=\"$target\">$text&nbsp;</a>";
			    echo "<button class=\"$class m-3\" >$my_record </button>";
			  }
			if ( $wig_datatable[0][$record] == "Y" && preg_match('/.dat/', $wig_datatable[4][$record]) == 1 )
			  {
				// echo "<br> $class click : $on_click href : $href  target : $target text : $text";
			   $menu_txt_tablename=$wig_datatable[4][$record];
			   WIG_menu("txt_tablename=$menu_txt_tablename","class=$class","my_option=dropdown");	
			  }
           }		   		   		   
    echo "</ul>";		 
	break;
	
    case 1 == preg_match('/^d-menu/',$my_option):
	echo "<div>";
     echo "<ul class=\"$my_option $class\""; 
	 echo "<li><a href=\"#\" class=\"dropdown-toggle $class\">$my_txt_tablename</a>";
	 echo "<ul class=\"d-menu $class\" data-role=\"dropdown\">";		 
       for($record=1;$record<$records_db;$record++) 
           {
            if ( $wig_datatable[0][$record] == "Y" && preg_match('/.dat/', $wig_datatable[4][$record]) == 0  )
             {
			  $target=$wig_datatable[4][$record];$text=$wig_datatable[2][$record];$href=$wig_datatable[3][$record];
			  $on_click=$wig_datatable[5][$record];if ( strlen($href) > 4 ){$on_click="";}
			  $my_record="<li ><a  class=\"$class\" onclick=\"$on_click\" href=\"$href\" target=\"$target\">$text&nbsp;</a></li>";echo "$my_record";	 
			  }		  
		   }
         echo "</ul></li></ul></div>";	
		  break;
		  
	case 1 == preg_match('/^dropdown/',$my_option):
	 // echo "<br> class : $class option : $my_option";
		echo "<div class=\"dropdown-button $class\"  style=\"width:300px\">";
		  echo "<button class=\"$class\" $my_option-toggle $class\"  style=\"width:300px\">$my_txt_tablename</button>"; 
		   echo "<ul class=\"d-menu $class\"  style=\"width:300px\" data-role=\"dropdown\">";		 
          for($record=1;$record<$records_db;$record++) 
           {
            if ( $wig_datatable[0][$record] == "Y" && preg_match('/.dat/', $wig_datatable[4][$record]) == 0  )
             {
			  $target=$wig_datatable[4][$record];$text=$wig_datatable[2][$record];$href=$wig_datatable[3][$record];
			  $on_click=$wig_datatable[5][$record];if ( strlen($href) > 4 ){$on_click="";}
			  $my_record="<li ><a  class=\"$class\" onclick=\"$on_click\" href=\"$href\" target=\"$target\">$text&nbsp;</a></li>";echo "$my_record";
			  }	
             if ( $wig_datatable[0][$record] == "Y" && preg_match('/.dat/', $wig_datatable[4][$record]) == 1 )
			  {$menu_txt_tablename=$wig_datatable[4][$record];}			  
		   }	   
          echo "</ul></div>";	
		  break;

      case 1 == preg_match('/^w_dropdown/',$my_option):      
	   echo "<div><button  class=\"button dropdown-toggle $class\" $my_style >$caption</button>";
       $d_menu_class=str_replace("button","","$class");
       echo "<ul data-role=\"dropdown\" class=\"d-menu $d_menu_class\" >";
        foreach ($GLOBALS["$my_function"] as $key => $value)
         {	   
	      if ( preg_match('/^w_dropdown/',$key) == 1 )
	           {  
                // echo "<br>key : $key val : $value";				
                $my_array=explode(" ","$value");
                for($i=0; $i <=substr_count( "$value" ," "); $i+=1)
				 {
			      $my_btn="WIG_btn";$my_caption=strtolower($my_array[$i]);$my_caption=str_replace("|||",":",$my_array[$i]);
				  $my_cmd=$my_array[$i];echo"<li>";WIG_btn("cmd=$my_cmd","caption=$my_caption","class=$class");echo "</li>";
				  }
			   }
         }
		 echo "</ul>";
         echo "</div>";
		 break;

		
    default :
	   $my_record="";$my_record_to_add="";
          for($record=1;$record<$records_db;$record++) 
           {
            if ( $wig_datatable[0][$record] == "Y"  )
             {
			  $target=$wig_datatable[4][$record];
	          $my_record="<a  href=\"" . $wig_datatable[3][$record] . "\"" . "target=\"$target\">" .  $wig_datatable[2][$record] . "</a>";
			  echo "<button type=normal $my_style onclick=\"window.location.href();return false;\" class=\"btn\">$my_record</button>";  	 	
			  }		  
           }		   
		  break;  
 }	

}




// HELP create button using GLOBAL variables + cmd line
function WIG_btn()
{
$my_function=__FUNCTION__;$my_function=str_replace("WIG","WAR","$my_function");
WIG_reset_global_vars();$GLOBALS["$my_function"]=array_merge($GLOBALS["$my_function"],func_get_args());
$GLOBALS["$my_function"]["delay"]=500;
$my_style=WIAG_bs($GLOBALS["$my_function"]);

if ( preg_match('/^ON/', $GLOBALS["$my_function"]["DEBUG"]) == 1  ){echo "<br>MY STYLE  : $my_style <br>";}
$given_cmd=$GLOBALS["$my_function"]["cmd"];$given_caption=$GLOBALS["$my_function"]["caption"];
$given_exec=$GLOBALS["$my_function"]["cmd"];$class=$GLOBALS["$my_function"]["class"];
$new_id="$my_function" . round(microtime(true) * 1000);usleep(10);
// check if we are executing javanscript so it is a direct call no form needed
if ( preg_match('/^JAV_/',$given_exec) == 1  )
	     {  	 
		  $my_args="";$my_click="";$button_txt="";$num_args=explode("|||",$given_exec);
		  $my_args=$num_args[0] . "('" ;unset($num_args[0]);
		  if( !isset($num_args[1])){$num_args[1]="none";}
		  $val_to_check=$num_args[1];		  
		  //echo "<br>:<br> my_args : $my_args <br> , val_to_check : $val_to_check , <br> given_exec : $given_exec <br>"; 
		  
		  // JAV_ with no WIG_  or WAR_ so it is JAV_*('arg1','arg2','...');
		   if ( preg_match('(WIG_|WAR_)',$val_to_check) == 1 || preg_match('/^JAV_/',$given_exec) == 1 )
		    {
			 // echo "<br>:<br> my_args : $my_args <br> , val_to_check : $val_to_check , <br> given_exec : $given_exec <br>"; 
			 $num_args=explode("|||",$given_exec);
		     $my_args=$num_args[0];unset($num_args[0]);$my_args="$my_args(";
			    for($rows=1;$rows<count($num_args=explode("|||",$given_exec));$rows++){$my_args = $my_args . "'" . $num_args[$rows] . "',";}
             $my_click="$my_args)";$button_txt="$my_click";
		    }
			// JAV_p is called it is JAV_p('.............') => arguments are not changed 
            if ( preg_match('/^JAV_p/',$given_exec ) == 1 )
			 {
              $my_args="";$my_click="";$my_args="JAV_p('" ;$given_exec=str_replace("JAV_p|||","","$given_exec");
			  $my_click=$my_args . $given_exec . "');";
			 }				 
	     // echo "<br>MY STYLE  : $my_style <br>";
          echo "<div><button type=\"button\" id=\"$new_id\" data-tooltip=\"$my_click\" class=\"btn-danger bg-red\" $my_style onclick=\"$my_click;return false;\">$given_caption</button></div><br>";return;
		   
		 }

// create FORM based on refresh value 
if ( preg_match('/^NO/',$GLOBALS["$my_function"]["refresh"]) == 1 ){echo "<div><form id=\"$new_id\" >";$class="fg-red bg-blue";} 
if ( preg_match('/^NO/',$GLOBALS["$my_function"]["refresh"]) == 0 ){echo "<div><form id=\"$new_id\" method=\"POST\" >";} 
foreach ($GLOBALS["$my_function"] as $key => $value){echo "<input hidden type = \"text\" value=\"$value\" name = \"$key\"/>";					}			
echo "<br><div><button type=\"submit\"  class=\"$class\"  data-tooltip=\"$given_exec\" $my_style >$given_caption</button></div>";
echo "</div></form>";
echo "<div id=\"jav_form_response\" style=\"top:0px;left:0px;width:100%;position:fixed;\"></div>";
//echo "<div id=\"jav_form_response\" class=\"container-max\">DD</div>";
// echo "<br> ";
if ( preg_match('/^NO/',$GLOBALS["$my_function"]["refresh"]) == 1 )
{
// echo "<script type=\"text/javascript\">  $(document).ready(function() { console.log(Date() + \"$given_caption\"); } );</script>";
?>	 
<script>
document.getElementById(<?php echo "'" . "$new_id" . "'"; ?>).addEventListener('submit', function (e) {
    e.preventDefault(); // *** CRUCIAL: Prevents the default page refresh/reload ***
    const formData = new FormData(this);
    const responseContainer = document.getElementById('jav_form_response');
    fetch('incl_metro_functions.php', {
        method: 'POST',
        body: formData
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.text(); // Get the response body as text/HTML
    })
	//
   
	
    .then(html => {
        const newResponseDiv = document.createElement('div');
        newResponseDiv.innerHTML = html; // Insert the HTML returned from PHP
       //  newResponseDiv.style.borderTop = '1px solid #ccc';
        newResponseDiv.style.padding = '20px';
		newResponseDiv.style.top='1px';
        newResponseDiv.style.left='1px';      
		newResponseDiv.style.width='100%';
		newResponseDiv.style.height='100%';
        // Append the new content to the body/container without refreshing the page
       responseContainer.appendChild(newResponseDiv);     
        // console.log(html);
        console.log(formData);	
        // Optional: clear the form input for the next submission
        e.target.reset();
    })
    .catch(error => {
        console.error('Fetch error:', error);
        responseContainer.innerHTML += `<p style="color: red;">Error: ${error.message}</p>`;
    });
  });
 </script>
<?php
 }	
}



// HELP is called from WIAG_bs do not use it , it needs a valid array $GLOBALS[...] and used to call other functions with params
function WIAG_bs_exec(&$my_array,$my_style="none")
{ 
// for DEBUG
// foreach ($my_array as $key => $value){echo "<br> WIAGS_bs_exec key :$key => $value";}
 //echo "<br>WIAG_BS exec <pre>";print_r(debug_backtrace());echo "</pre>";
//WIG_toastr("$my_result  END ", "info" , "toast-bottom-full-width" , "-1");

foreach ($my_array as $key => $value)
 {
  
  // check if DEBUG is ON 
  if(preg_match('/^DEBUG/',$key) == 1 && preg_match('/^ON/',$value) == 1 )
   {
    foreach ($my_array as $key => $value){echo "<br> WIAGS_bs_exec key :$key value => $value";}
	echo "<br>WIAG_BS BACKTRACE<pre>";print_r(debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS,1));echo "</pre>";
	echo "<br>";echo "<br>$my_style<br>";
	}
  
  // key =WIG_ + value =WIG_
  if(preg_match('/^WIG_/',$key) == 1 && preg_match('/^WIG_/',$value) == 1 )
   {
   $num_args=explode("|||",$value);$my_function=$key;$value=implode("|||" ,$num_args);
   if ( function_exists( $key)){call_user_func_array("$key",explode("|||",$value));continue;}     
   }
   // key=WIG and value is not |||
   if(preg_match('/^WIG_/',$key) == 1 && preg_match('/\|\|\|/',$value) == 0 )
   {
   $num_args=explode("|||",$value);$my_function=$key;$value=implode("|||" ,$num_args);
   if ( function_exists( $key)){call_user_func_array("$key",explode("|||",$value));continue;}     
   } 
  // key=WIG_ and value = ||| more param's are given
  if(preg_match('/^WIG_/',$key) == 1 && preg_match('/\|\|\|/',$value) == 1   )
   {
   $num_args=explode("|||",$value);$my_function=$key;$value=implode("|||" ,$num_args);
    if ( function_exists( $my_function)){call_user_func_array("$my_function",explode("|||",$value));continue;}     
   }  
   // key=WIG_ and no value = |%| param is given to seperate the code
   if(preg_match('/^WIG_/',$value) == 1 && preg_match( '/\|%\|/' , $value) == 0 )
    {   
      $num_args=explode("|||",$value);			 
      $my_function=$num_args[0];unset($num_args[0]);
	  if ( function_exists( $my_function)){call_user_func_array("$my_function",$num_args);continue;}
    }
 
 // key=JAV_  added 30/01/2026
  if(preg_match('/^JAV_/',$value) == 1  )
  {
   $num_args=explode("|||",$value);    
     $my_args=$num_args[0];unset($num_args[0]);$my_args="$my_args(";
   	  for($rows=1;$rows<count($num_args=explode("|||",$value));$rows++){$my_args = $my_args . "'" . $num_args[$rows] . "',";}
	   $my_exec="$my_args)";
		echo "<script type=\"text/javascript\">  $(document).ready(function() { $my_exec} );</script>";  
  }
 
  // check if we can execute the function WIG_* with special value |%| 
  if(preg_match('/^WIG_/',$value) == 1 && preg_match('/\|%\|/', $value) ==  1  )
  {
	// echo "<br> VALUE => $value ";
   $num_args=explode("|%|",$value);
   $my_param=explode("|||",$num_args[0]);$my_function=$my_param[0];
     for ($i = 1; $i <= count($num_args)-1; $i+=1)
     {
	  // echo "<br>i: $i => val : $value <br> function : $my_function <br> => FOUND : " . $num_args[$i];
	  array_push($my_param,$num_args[$i]);
	  // echo "<br>FUNCTION : $my_function <pre>" . print_r($num_args[$i]) . "</pre>";
	  }
	if(function_exists("$my_param[0]") )
	{
	$my_function=$my_param[0];unset($my_param[0]);call_user_func_array("$my_function",$my_param );
		
	} 
   }
  
 
 
 
// echo "<br> WIAGS_bs_exec key :$key => $value";
 }
}



// HELP call metroui objects using an array + set new/replace values 
function WIAG_bs(&$my_array)
{
$dup_array="WAR_dup_" .  round(microtime(true) * 1000);usleep(100);
$GLOBALS["$dup_array"]=$my_array;
$new_style="style=\"";$new_id="cmd_" .  round(microtime(true) * 1000);usleep(10);
// start checking params + change the value
if(!isset($GLOBALS["$dup_array"]["my_option"] )){$GLOBALS["$dup_array"]["my_option"]="none";}
if(!isset($GLOBALS["$dup_array"]["my_function"] )){$GLOBALS["$dup_array"]["my_function"]="none";}
$my_function=debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 2)[1]['function'];
$GLOBALS["$dup_array"]["my_function"]=strtolower("$my_function");

// echo "<br>WIAG_BS <pre>";print_r(debug_backtrace());echo "</pre>";
foreach ($GLOBALS["$dup_array"] as $key => $value)
	{
     // key = 0,1,2 and value begins with WIG_ 	=> remove the old key + skip to next key
	 if( preg_match('/=/',$value) == 1 && is_integer($key)  && preg_match('/WIG_/',$value) == 1 )
	   {
		$new_key=substr($value,0,strpos($value,"="));
         $new_value=substr($value,strpos($value,"=")+1,strlen($value));
		 $GLOBALS["$dup_array"]["$new_key"]=$new_value; 
		 // echo "<br> new var $new_key  ," . $GLOBALS["$dup_array"]["$new_key"];
	     unset($GLOBALS["$dup_array"]["$key"]);continue;
	   }
      // key = 0,1,2 and value contains '=' + 'WIG_' => remove the old key + skip to next key	
	  if( preg_match('/=/',$value) == 1 && is_integer($key) && substr_count($value, '=') == 1 && preg_match('/WIG_/',$value) == 0 )
	   {
		$new_key=substr($value,0,strpos($value,"="));
         $new_value=substr($value,strpos($value,"=")+1,strlen($value));
		 $GLOBALS["$dup_array"]["$new_key"]=$new_value;  
	     unset($GLOBALS["$dup_array"]["$key"]);continue;
	   }      
       // // key = 0,1,2 and value contains more then 1 '=' + 'WIG_'		   
	   if( preg_match('/=/',$value) == 1 && is_integer($key) && substr_count($value, '=') > 1 && preg_match('/WIG_/',$value) == 0 )
	   {
		  $num_args_2=explode("|||",$value);
		   foreach($num_args_2 as $key => $value)
		   {
		    // echo "<br> wiagbs new key : $key => $value";
		    $new_key=substr($value,0,strpos($value,"="));
		    $new_value=substr($value,strpos($value,"=")+1,strlen($value));
		    $GLOBALS["$dup_array"]["$new_key"]=$new_value;  
		   }
	   }    
    }		
// end checking params + change the value
// foreach ($GLOBALS["$dup_array"] as $key => $value){echo "<br> 1 dup_array key :$key => $value";}

// check if my_pos param is given and exist
if (  !isset($GLOBALS["$dup_array"]["my_pos"])){$GLOBALS["$dup_array"]["my_pos"]="none";}

if (  preg_match('/^none/',$GLOBALS["$dup_array"]["my_pos"] ) == 0 )
{
if (  !isset($GLOBALS["my_tr"]) || preg_match('/^none/',$GLOBALS["$dup_array"]["my_pos"] ) == 1 ){$GLOBALS["my_tr"]="10";}
if (  !isset($GLOBALS["my_br"]) || preg_match('/^none/',$GLOBALS["$dup_array"]["my_pos"] ) == 1 ){$GLOBALS["my_br"]="600";}
if (  !isset($GLOBALS["my_tl"]) || preg_match('/^none/',$GLOBALS["$dup_array"]["my_pos"] ) == 1 ){$GLOBALS["my_tl"]="10";}
if (  !isset($GLOBALS["my_bl"]) || preg_match('/^none/',$GLOBALS["$dup_array"]["my_pos"] ) == 1 ){$GLOBALS["my_bl"]="600";}
if (  !isset($GLOBALS["my_mr"]) || preg_match('/^none/',$GLOBALS["$dup_array"]["my_pos"] ) == 1 ){$GLOBALS["my_mr"]="300";}

// if (  preg_match('/^none/',$GLOBALS["$dup_array"]["my_pos"] ) == 1 )
switch( $GLOBALS["$dup_array"]["my_pos"] )
  {
    case 1 == preg_match('/right|tr/', $GLOBALS["$dup_array"]["my_pos"]):
	  $GLOBALS["$dup_array"]["top"]=$GLOBALS["my_tr"] . "px";$GLOBALS["my_tr"]=$GLOBALS["my_tr"]+55;
	  if ( $GLOBALS["my_tr"] >= 600 ){$GLOBALS["my_tr"]="10";}
	  $GLOBALS["$dup_array"]["animation"]="slideInRight";
	  break;
	  
	case 1 == preg_match('/mid|mr/', $GLOBALS["$dup_array"]["my_pos"]):
	  $GLOBALS["$dup_array"]["top"]=$GLOBALS["my_mr"] . "px";$GLOBALS["my_mr"]=$GLOBALS["my_mr"]+55;
	  if ( $GLOBALS["my_mr"] >= 600 ){$GLOBALS["my_mr"]="300";}
	  $GLOBALS["$dup_array"]["animation"]="slideInRight";
	  break;
	  
    case 1 == preg_match('/ml/', $GLOBALS["$dup_array"]["my_pos"]):
	  $GLOBALS["$dup_array"]["top"]=$GLOBALS["my_mr"] . "px";$GLOBALS["my_mr"]=$GLOBALS["my_mr"]+55;
	  if ( $GLOBALS["my_mr"] >= 600 ){$GLOBALS["my_mr"]="300";}
	  $GLOBALS["$dup_array"]["animation"]="slideInLeft";
	  break;
	  		
	case 1 == preg_match('/br/', $GLOBALS["$dup_array"]["my_pos"]):
	 $GLOBALS["$dup_array"]["top"]=$GLOBALS["my_br"] . "px";$GLOBALS["my_br"]=$GLOBALS["my_br"]-55;
	 $GLOBALS["$dup_array"]["animation"]="slideInRight";
	  
    case 1 == preg_match('/bl/', $GLOBALS["$dup_array"]["my_pos"]):
	 $GLOBALS["$dup_array"]["top"]=$GLOBALS["my_bl"] . "px";$GLOBALS["my_bl"]=$GLOBALS["my_bl"]-55;
	 if ( $GLOBALS["my_bl"] <= 110 ){$GLOBALS["my_tl"]="600";}
	 $GLOBALS["$dup_array"]["animation"]="slideInLeft";
	  break;
	  
    	
    case 1 == preg_match('/left|tl/', $GLOBALS["$dup_array"]["my_pos"]):
      $GLOBALS["$dup_array"]["top"]=$GLOBALS["my_tl"] . "px";$GLOBALS["my_tl"]=$GLOBALS["my_tl"]+55;
	  if ( $GLOBALS["my_tl"] >= 600 ){$GLOBALS["my_tl"]="10";}
	  $GLOBALS["$dup_array"]["animation"]="slideInLeft";
	  break;
    
	default:
	  $animation="slideInRight";
	  break;

  }
// echo "<br> selected " . $GLOBALS["$dup_array"]["my_pos"] . " value "  . $GLOBALS["$dup_array"]["top"];	  
}
	

// check options,class  and modify these if exist 
 if (  !isset($GLOBALS["$dup_array"]["class"])){$GLOBALS["$dup_array"]["class"]="none";}
 if (  isset($GLOBALS["$dup_array"]["class"]) && preg_match('/alert|info|succes|primary|secondary|success|warning|yellow|info|light/',$GLOBALS["$dup_array"]["class"] ) == 1)
{
  if (  isset($GLOBALS["$dup_array"]["color"])){unset($GLOBALS["$dup_array"]["color"]);}
  if (  isset($GLOBALS["$dup_array"]["background-color"])){unset($GLOBALS["$dup_array"]["background-color"]);}
}	


         //  $my_result="1 RESULT wiag_bs[$dup_array]  <br>";
		 $my_class="";$my_data_role="";
         foreach ($GLOBALS["$dup_array"] as $key => $value)
           {
			// echo "<br>wiagbs key : $key  , value : $value ";			
			if ( preg_match('/=/',$value) == 0 && preg_match('/^data-|^class|^W_|^WIG_|^my_/',$key) == 0 && preg_match('/\|%\|/',$value) == 0 && strlen($value) > 0 ){$new_style=$new_style . "$key:$value;";}
		    if ( preg_match('/=/',$value) == 0 && preg_match('/\|%\|/',$value) == 0 && strlen($value) > 0 && preg_match('/^class/',$key) == 1 )
			 {$my_class=$my_class . "$key=\"$value\" ";}
		    if ( preg_match('/=/',$value) == 0 && preg_match('/\|%\|/',$value) == 0 && strlen($value) > 0 && preg_match('/^data-/',$key) == 1 )
			 {$my_data_role=$my_data_role . "$key=\"$value\" ";}
		   }
$my_array=$GLOBALS["$dup_array"];
// echo "<br>WIAG_BS <pre>";print_r(debug_backtrace());echo "</pre>";
// echo "<br>WIAG_BS BACKTRACE<pre>";print_r(debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS,1));echo "</pre>";
//  foreach ($GLOBALS["$dup_array"] as $key => $value){echo "<br> after WIAG_bs : key => $key , value => $value";}
if ( isset($GLOBALS["$dup_array"]["style"]) && preg_match('/^NO/', $GLOBALS["$dup_array"]["style"]) == 1  ){$new_style="";return $my_data_role . " " . $my_class;}
return $my_data_role . " " . $my_class . " " . $new_style . "\"";	
}

// HELP call java function  JAV_notify(my_text,my_delay,my_color,my_width)
function WIG_toastr($my_txt="none" , $my_delay="1500" , $my_color="info" , $my_width="250" )
{
echo "<script type=\"text/javascript\">  $(document).ready(function() { JAV_notify('$my_txt','$my_delay','$my_color',$my_width); } );</script>";
// WIG_clean_url();
}



// HELP create popupwindow param=url : help.php or https/google.com
function WIG_popupwnd()
{
$GLOBALS["WAR_popupwnd"]=array_merge($GLOBALS["WAR_popupwnd"],func_get_args());
$my_style=WIAG_bs($GLOBALS["WAR_popupwnd"]);
$new_id="WIG_popupwnd" .  round(microtime(true) * 1000);usleep(10);
$my_param=$GLOBALS["WAR_popupwnd"];
$my_popupwn="<script>window.open(";
foreach ($my_param as $key => $value)
  {
    if (gettype($value) != "array" )
    {
	 if( preg_match('/^url/',$key) == 1 ){$my_popupwn=$my_popupwn . "\"$value\",";}
	 if (preg_match('/^target/',$key) == 1 ){$my_popupwn=$my_popupwn . "\"$value\",";}
	 if (preg_match('/^toolbar/',$key) == 1 ){$my_popupwn=$my_popupwn . "\"$key=$value";}
	 if (preg_match('/^target/',$key) == 0 && preg_match('/^url/',$key) == 0 && preg_match('/^toolbar/',$key) == 0 && preg_match('/^name/',$key) == 0){$my_popupwn=$my_popupwn . ",$key=$value";}	 
	 }
  }
  $my_popupwn=$my_popupwn . "\");</script>";
   echo "$my_popupwn";
}


// HELP call page url inside iframe params are come from $GLOBALS["WAR_iframe"] or given in form iframe=help.php 
function WIG_iframe()
{
WIG_reset_global_vars();
$GLOBALS["WAR_iframe"]=array_merge($GLOBALS["WAR_iframe"],func_get_args());
$my_style=WIAG_bs($GLOBALS["WAR_iframe"]);
$new_id="WIG_iframe" .  round(microtime(true) * 1000);usleep(10);
$delay=$GLOBALS["WAR_iframe"]["delay"];	
$iframe=$GLOBALS["WAR_iframe"]["iframe"];
echo "<div class=\"container-fluid border border-5 border-primary overflow-scroll\" $my_style id=\"$new_id\" >";
echo "<iframe width=\"100%\" height=\"550px\" src=\"$iframe\"";
echo  "frameborder=\"0\" allowtransparency=\"true\" style=\"position:absolute; top:0; left: 0\">";
echo  "</iframe>";
if ( preg_match('/^YES/', $GLOBALS["WAR_iframe"]["close_btn"]) == 1  )
{WIG_btn("caption=X","cmd=JAV_hide|||$new_id|||none|||5s","top=10px","z-index=10101","right=10px","position=absolute","background-color=red !important");}

if ( $delay > 1000 ){WIG_progress("timer=$delay");}	
echo  "</div>";

if ( $delay > 1000 ){echo "<script type=\"text/javascript\">JAV_show_hide('$new_id');</script>";}
if ( $delay < 1000 ){echo "<script type=\"text/javascript\">JAV_show('$new_id');</script>";}
}
	

// HELP create container settings are in file bs_container_events.dat trigger event as needed onclick,ondblclick etc..etc 
function WIG_container_events()
{
$my_function=__FUNCTION__;$my_function=str_replace("WIG","WAR","$my_function");	
$GLOBALS["$my_function"]=array_merge($GLOBALS["WAR_metro"],func_get_args());
$my_style=WIAG_bs($GLOBALS["$my_function"]);
$old_txt_tablename="container_events.dat";
$txt_tablename =$_SESSION["DATA"] . "/" . $_SESSION["username"] . "_container_events.dat";
$my_option=$GLOBALS["$my_function"]["my_option"];

usleep(100);$time_end=round(microtime(true) * 1000);$my_id="$my_function" . "_" . "$time_end";
$wig_datatable=preg_replace('/.dat|\//','', $txt_tablename);
$my_txt_tablename=$wig_datatable;
${$wig_datatable}=$wig_datatable;
$wig_datatable=array();	
// unlink("$txt_tablename");
if( !file_exists($txt_tablename))
 {
  WIG_create_txt_db($txt_tablename,"status id active left top bottom width height event action",12);$wig_datatable=WIG_get_txt_db("$txt_tablename", $wig_datatable );
  for($record=1;$record< 9 ;$record++)
  {
   $wig_datatable[0][$record]="Y";$wig_datatable[2][$record]="N";$wig_datatable[3][$record]="95%";$wig_datatable[4][$record]="00%";$wig_datatable[5][$record]="95%";
   $wig_datatable[6][$record]="05%";$wig_datatable[7][$record]="05%";$wig_datatable[8][$record]="ondblclick";$wig_datatable[9][$record]="JAV_show_hide('WIG_clock');";
  }
  // record 2 : 99%,70%,95%,05%,25%
  $wig_datatable[0][2]="Y";$wig_datatable[2][2]="Y";$wig_datatable[3][2]="99%";$wig_datatable[4][2]="70%";$wig_datatable[5][2]="95%";
   $wig_datatable[6][2]="05%";$wig_datatable[7][2]="25%";$wig_datatable[8][2]="onmouseover";$wig_datatable[9][2]="JAV_p('WIG_container=height=300px|||class=fg-red bg-blue|||cmd=WIG_menu|%|my_option=h-menu|||txt_tablename=h-menu2.dat');"; 
   // record 3 : 25%,95%,100%,35%,05%
  $wig_datatable[0][3]="Y";$wig_datatable[2][3]="Y";$wig_datatable[3][3]="25%";$wig_datatable[4][3]="95%";$wig_datatable[5][3]="100%";
   $wig_datatable[6][3]="45%";$wig_datatable[7][3]="05%";$wig_datatable[8][3]="ondblclick";$wig_datatable[9][3]="JAV_p('WIG_container=height=300px|||cmd=WIG_menu|%|my_option=h-menu|||txt_tablename=h-menu2.dat');"; 
   // record 4 : 01%,95%,100%,05%,05%
   $wig_datatable[0][4]="Y";$wig_datatable[2][4]="Y";$wig_datatable[3][4]="01%";$wig_datatable[4][4]="95%";$wig_datatable[5][4]="100%";
   $wig_datatable[6][4]="05%";$wig_datatable[7][4]="05%";$wig_datatable[8][4]="ondblclick";$wig_datatable[9][4]="JAV_p('WIG_container=height=300px|||cmd=WIG_demo|%|my_option=none');"; 
	$wig_datatable[2][1]="Y";$wig_datatable[2][2]="Y";
  WIG_write_txt_db("$txt_tablename",$wig_datatable ); 
  $wig_datatable=WIG_get_txt_db("$txt_tablename" , $wig_datatable );
 } 	
 $wig_datatable=WIG_get_txt_db("$txt_tablename" , $wig_datatable );
 switch( $my_option )
  {
    case 1 == preg_match('/show/',$my_option):
               WIG_container("cmd=WIG_metro_show_datatables|||txt_tablename=$old_txt_tablename");
               break;		   			   
  }
 
$records_db=count($wig_datatable[0])-2;
     for($record=1;$record<= $records_db;$record++)	
	 {
	  if ( $wig_datatable[2][$record] == "Y" )
	   {
		$new_id="WIG_container_$record";
		$used_style="style=\"position:fixed;z-index:9999;"  . $wig_datatable[3][0] . ":" . $wig_datatable[3][$record] . ";" . $wig_datatable[4][0] . ":" . $wig_datatable[4][$record] . ";";
		$used_style=$used_style  . $wig_datatable[5][0] . ":" . $wig_datatable[5][$record] . ";" . $wig_datatable[6][0] . ":" . $wig_datatable[6][$record] . ";";
		$used_style=$used_style  . $wig_datatable[7][0] . ":" . $wig_datatable[7][$record] . ";\"";
		$used_action="";
		$used_action=$used_action  . $wig_datatable[8][$record] . "=\"" . $wig_datatable[9][$record] . "\"";
		$used_tooltip=$wig_datatable[9][$record];
		if(preg_match('/^ON/',$_SESSION["W_tooltip"]) == 0 ){$used_tooltip="";}
		echo "<div class=\"border bd-red border-solid border-radius-10\" data-tooltip=\"$used_tooltip\" $used_action $used_style  id=\"$new_id\" >";
		echo "</div>";
	   }
	 }
}


// jos
// HELP create container default params are in $GLOBALS["WAR_container"] or given in url  ?WIG_container=txt=WIG_debug|%|width=75%|%|delay=5000
function WIG_container()
{
WIG_reset_global_vars();
$my_function=__FUNCTION__;$my_function=str_replace("WIG","WAR","$my_function");
$GLOBALS["$my_function"]=array_merge($GLOBALS["WAR_metro"],func_get_args());
$my_style=WIAG_bs($GLOBALS["$my_function"]);
$my_delay=intval($GLOBALS["$my_function"]["delay"]);$my_txt=$GLOBALS["$my_function"]["txt"];
usleep(100);$time_end=round(microtime(true) * 1000);$new_id="$my_function" . "_" . "$time_end";
$seconds=round($my_delay / 1000, 0, PHP_ROUND_HALF_UP);$seconds=$seconds . "s";
$animation=$GLOBALS["$my_function"]["animation"];
$my_style=WIAG_bs($GLOBALS["$my_function"]);
// foreach ($GLOBALS["$my_function"] as $key => $value){echo "<br> 1 WIG_container key :$key => $value";}
echo "<div $my_style id=\"$new_id\" >";	
if ( $my_delay > 1000 ){WIG_progress("timer=$my_delay");}
if ( preg_match('/^none/',$GLOBALS["$my_function"]["txt"])== 0 ){echo "<br> $my_txt ";}
WIAG_bs_exec($GLOBALS["$my_function"]);
//  foreach ($GLOBALS["$my_function"] as $key => $value){echo "<br> 2 WIG_container key :$key => $value";}
if ( preg_match('/^YES/', $GLOBALS["$my_function"]["close_btn"]) == 1  )
{WIG_btn("caption=X","cmd=JAV_hide|||$new_id|||none|||5s","top=10px","right=10px","position=absolute","background-color=red !important");}
//WIG_dt();
// WIG_clock();
// WIG_msg("DEBUG=ON","class=bg-blue fg-white","exec=WIG_dt","my_pos=bl","height=300px","delay=5000");
// WIG_toast("caption=wig_container !!!","delay=3000");
echo "</div>";
if ( $my_delay > 1000 ){echo "<script type=\"text/javascript\">JAV_show_hide('$new_id','$animation','$seconds');</script>";}
if ( $my_delay < 1000 ){echo "<script type=\"text/javascript\">$(document).ready(function() { JAV_show('$new_id','$animation');} );</script>";}	
}	






// HELP activate hover effect on dropdown 
function WIG_dropdown_hover_old($given_option = "none")
{
if( !isset($given_option) || empty($given_option) ){$given_my_option="none";}	
if(preg_match('/^OFF/',$given_option) == 1 ){$_SESSION["W_dropdown_hover"]="OFF";WIG_save_session_vars();}
if(preg_match('/^ON/',$given_option) == 1 ){$_SESSION["W_dropdown_hover"]="ON";WIG_save_session_vars();}		
 if(preg_match('/^ON/',$_SESSION["W_dropdown_hover"]) == 1 )
 {
?>
 <style>
.dropdown:hover>.dropdown-menu {
  display: block;
}

.dropdown>.dropdown-toggle:active {
  /*Without this, clicking will make it sticky*/
    pointer-events: none;
}
</style>
<?php
 }	
}


// HELP simulate offcanvas params: 1: "my_option=left" , right ,top,bottom
function WIG_canvas()
{	
WIG_reset_global_vars();
$my_function=__FUNCTION__;$my_function=str_replace("WIG","WAR","$my_function");
$GLOBALS["$my_function"]=array_merge($GLOBALS["WAR_metro"],func_get_args());
$my_style=WIAG_bs($GLOBALS["$my_function"]);
$my_delay=$GLOBALS["$my_function"]["delay"];$my_txt=$GLOBALS["$my_function"]["txt"];
$animation=$GLOBALS["$my_function"]["animation"];
usleep(100);$time_end=round(microtime(true) * 1000);$new_id="$my_function" . "_" . "$time_end";
$seconds=round($my_delay / 1000, 0, PHP_ROUND_HALF_UP);$seconds=$seconds . "s";
 if (  preg_match('/top|bottom|left|right/', $GLOBALS["$my_function"]["my_option"]) == 0  ){$GLOBALS["$my_function"]["my_option"]="top";}
 
switch( $GLOBALS["$my_function"]["my_option"] )
{
	case 1 == preg_match('/top/',$GLOBALS["$my_function"]["my_option"]):
	 $GLOBALS["$my_function"]["width"]="100%";$GLOBALS["$my_function"]["height"]="30%";
	 $GLOBALS["$my_function"]["top"]="1px";$GLOBALS["$my_function"]["left"]="1px";
	 break;
	case 1 == preg_match('/bottom/',$GLOBALS["$my_function"]["my_option"]):
	 $GLOBALS["$my_function"]["width"]="100%";$GLOBALS["$my_function"]["height"]="30%";
	 $GLOBALS["$my_function"]["top"]="70%";$GLOBALS["$my_function"]["left"]="1px";
	 $GLOBALS["$my_function"]["animations"]="slideInUp";$animation=$GLOBALS["$my_function"]["animations"];
	 break;
	case 1 == preg_match('/left/',$GLOBALS["$my_function"]["my_option"]):
	 $GLOBALS["$my_function"]["width"]="30%";$GLOBALS["$my_function"]["height"]="100%";
	 $GLOBALS["$my_function"]["top"]="1px";$GLOBALS["$my_function"]["left"]="1px";
	 break;
	case 1 == preg_match('/right/',$GLOBALS["$my_function"]["my_option"]):
	 $GLOBALS["$my_function"]["width"]="30%";$GLOBALS["$my_function"]["height"]="100%";
	 $GLOBALS["$my_function"]["top"]="1%";$GLOBALS["$my_function"]["left"]="70%";
	 $GLOBALS["$my_function"]["animations"]="slideInRight";$animation=$GLOBALS["$my_function"]["animations"];
	default :
     break;
}
$my_style=WIAG_bs($GLOBALS["$my_function"]);
echo "<div $my_style id=\"$new_id\" >";	
if ( $my_delay > 1000 ){WIG_progress("timer=$my_delay");}
if ( preg_match('/^YES/', $GLOBALS["$my_function"]["close_btn"]) == 1  )
{WIG_btn("caption=X","cmd=JAV_hide|||$new_id|||none|||5s","top=10px","right=10px","position=absolute","background-color=red !important");}
WIAG_bs_exec($GLOBALS["$my_function"]);
// foreach ($GLOBALS["$my_function"] as $key => $value){echo "<br> canvas key :$key => $value";}
echo "</div>";
if ( $my_delay > 1000 ){echo "<script type=\"text/javascript\">JAV_show_hide('$new_id','none','$seconds');</script>";}
if ( $my_delay < 1000 ){echo "<script type=\"text/javascript\">JAV_show('$new_id','$animation');</script>";}	
//WIG_clean_url();
}

 


?>
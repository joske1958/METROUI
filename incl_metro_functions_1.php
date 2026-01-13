<?php
// incl_functions_1.php used in wbs project 
ini_set('display_errors', 'On');
error_reporting(E_ALL);
// WIG_chk_needed_files("jquery-3.7.1.min.js metro_5_1.css metro_5_1.js animate.css toastr.css toastr.js sweetalert.min.js");
// WIG_chk_needed_files();
WIG_reset_global_vars();
// functions start here 





// HELP global arrays used and reset them when needed with default values + create needed directories
function WIG_reset_global_vars()
{
// create needed directories in uppercase 
 foreach (explode(" ","data log bin pictures etc") as $dir)
  {
   if ( !file_exists("$dir") ){umask(022);mkdir("$dir");} 
   if (  file_exists("$dir") ){$uppercase_dir=strtoupper("$dir");$_SESSION["$uppercase_dir"]=$dir;$_SESSION["W_$uppercase_dir"]=$dir;}
  }	
 
 
// set defaultvalues :WAR_metro is used as default array on most of the functions any change has a big impact so be carefully 
$GLOBALS["WAR_metro"]=["data-role" => "container","class" => "bg-light-green fg-blue","left"=>"5px","top"=> "25px","width"=>"90%","height"=>"600px",
"position"=>"absolute","delay" => "2000","animation" =>"slideInLeft","my_option" => "none","my_pos"=>"none","my_function"=>"none","my_help"=>"none",
"cmd" => "none" ,"caption" => "none" ,"txt" => "none","type"=>"info","font-size" => "16px","txt"=>"none","DEBUG" => "OFF","overflow"=>"scroll","pos" => "none",
"my_close_btn"=>"YES","id"=>"none","border"=> "5px solid blue","border-radius"=> "10px","refresh"=>"NO","style"=>"YES","close_btn"=>"YES","z-index"=>"9999"];
 
 // all defined functions has as std array $GLOBALS["WAR_metro"]
$my_array=get_defined_functions();
  foreach ($my_array["user"] as $key => $value)
    {$new_value=str_replace("wig_","WAR_","$value");
	$GLOBALS["$new_value"]=$GLOBALS["WAR_metro"];
	}
 
 // below are the arrays that need an customized array 
 $GLOBALS["WAR_btn"]=[ "delay" => "999","txt" => "none","pos" => "top","DEBUG"=>"OFF",
"cmd" => "none" ,"caption" => "none" , "exec"=>"empty","2exec"=>"empty","border-radius"=> "15px","border-width" => "2px"," border-color" => "blue","close_btn"=>"YES",
"type"=>"info","font-size" => "20px","mode"=>"horizontal","txt"=>"none","refresh" => "YES","style" => "YES","class=button fg-black bg-light-green"];
 
$GLOBALS["WAR_demo"]=[ "delay" => "999","txt" => "none","pos" => "none","DEBUG"=>"OFF","cmd" => "none" ,"caption" => "none" ,"border-radius"=> "15px","my_option" => "none",
"border-width" => "1px"," border-color" => "blue","w_dropdown"=>"WIG_msg|||txt=msg|||delay=2000 WIG_debug WIG_dt","type"=>"info","font-size" => "20px","txt"=>"none","class=fg-black bg-light-green"];
 
$GLOBALS["WAR_help"]=["my_help"=> "^function WIG_|^function JAV_","color" => "blue !important" , "background-color" => "lightgreen !important",
"overflow"=>"scroll","border-width" => "3px","border-color" => "blue !important","border-style" => "solid","class" => "bg-light-green fg-blue"];	
 
$GLOBALS["WAR_iframe"]=["color" => " #000000" , "background-color" => "#E6FFE6","iframe" => "index.html","close_btn"=>"YES",
  "z-index" => "10001" , "txt" => "none" ,"my_option" => "info" , "delay" => "999","exec"=>"empty","overflow"=>"scroll",
 "2exec"=>"empty","position"=> "absolute", "width"=> "95%","height"=> "550px","top"=> "5px","left"=> "5px","border-radius"=> "25px"];	
 
 
 
// create global arrays where we need special variables 
$GLOBALS["WAR_tail"]=["filename" => "none" ,"fetch" => "?WIG_dt","color" => " blue !important" , "background-color" => "lightgreen !important",
"txt" => "none" ,"my_option" => "info" , "delay" => "10000","exec"=>"empty","overflow"=>"scroll", "width"=> "95%","height"=> "500px"];

$GLOBALS["WAR_popupwnd"]=["url" => "index.html" ,"target" => "_blank" , "toolbar" => "no", 
"scrollbars"=> "yes","resizable"=>"yes","status"=> "0", "width"=> "1200","height"=> "550","top"=> "150","left"=> "150"];

// do not remove this as it is used inside WIG_GET and WIG_PUT
$GLOBALS["WAR_exec"]=$GLOBALS["WAR_metro"];


// add or replace records to the global WAR_ arrays certainly for the z-index & delay & colors etc .. etc ... etc 
// $zindex="9999";
// $GLOBALS["W_zindex"]=$zindex;


foreach ($GLOBALS as $key => $value)
   {  
    // echo "<br> WIG_reset_ : $key ";
	if (gettype($value) == "array" && preg_match('/^WAR_/',$key) == 1 )
     // {$GLOBALS["$key"]=array_replace($GLOBALS["$key"],array("delay"=>"999"),array("close_btn"=>"YES"),array("style"=>"YES"),array("DEBUG"=> "OFF"));} 

	if (gettype($value) == "array" && preg_match('/WAR_/', $key) == 1 && preg_match('/WAR_btn/', $key) == 0 )	
	{
     // $GLOBALS["$key"]=array_replace($GLOBALS["$key"],array("z-index"=>"$zindex"));// $zindex++;	 
     // $GLOBALS["$key"]=array_replace($GLOBALS["$key"],array("my_pos"=>"none"));	
     // $GLOBALS["$key"]=array_replace($GLOBALS["$key"],array("my_option"=>"none"));	 
	 // $GLOBALS["$key"]=array_replace($GLOBALS["$key"],array("my_function"=>"none"));	 
	 // $GLOBALS["$key"]=array_replace($GLOBALS["$key"],array("color"=>"white !important"),array("background-color" => "lightgreen !important")); 
	 // $GLOBALS["$key"]=array_replace($GLOBALS["$key"],array("width"=> "90%"),array("height"=> "500px"),array("DEBUG"=> "OFF"));	
	  
	 // $GLOBALS["$key"]=array_replace($GLOBALS["$key"],array("txt"=> "empty"),array("data-width"=> "45%"),array("data-height"=> "40%"),array("type"=> "info"));
	 // $GLOBALS["$key"]=array_replace($GLOBALS["$key"],array("top"=> "25px"),array("left"=> "25px"),array("txt_tablename"=> "test.dat"));
	 $GLOBALS["$key"]=array_replace($GLOBALS["$key"],array("animation"=> "slideInLeft"),array("delay"=>"500"),array("visibility"=>"visible"));
	 // $GLOBALS["$key"]=array_replace($GLOBALS["$key"],array("border"=> "5px solid blue"),array("border-radius"=> "10px"),array("id"=> "none"));
	}
   } 
//$zindex++;
// $GLOBALS["W_zindex"]=$zindex;
// WIG_save_session_vars();
// $GLOBALS["WAR_menu"]=[ "z-index"=>"$zindex","class" => "primary" , "my_option" => "h-menu","delay" => "999","cmd" => "none" ,"animation"=> "slideInLeft",
// "txt_tablename"=> "test.dat","caption" => "none" ,"font-size" => "20px","txt"=> "empty"];   
//$zindex++;
// $GLOBALS["WAR_notify"]=[ "z-index"=>"$zindex"];



}


// functions starts here 

// HELP start demo using dropdown last option is always used with session var W_demo
function WIG_demo()
{
WIG_reset_global_vars();
$my_function=__FUNCTION__;$my_function=str_replace("WIG","WAR","$my_function");	
$GLOBALS["$my_function"]=array_merge($GLOBALS["$my_function"],func_get_args());
$GLOBALS["$my_function"]["style"]="YES";$my_style=WIAG_bs($GLOBALS["$my_function"]);
$caption=$GLOBALS["$my_function"]["caption"];$class=$GLOBALS["$my_function"]["class"];$my_option=$GLOBALS["$my_function"]["my_option"];
// if given arg my_option is different then none then use the session var W_demo 
if ( preg_match('/^none/', $GLOBALS["$my_function"]["my_option"]) == 0  )
{$_SESSION["W_demo"]=$GLOBALS["$my_function"]["my_option"];WIG_save_session_vars();}

	


WIG_dropdown("caption=select :","class=bg-blue fg-red","w_dropdown=
WIG_container|||visibility=hidden|%|exec=WIG_demo|||my_option=functions 
WIG_container|||visibility=hidden|%|exec=WIG_demo|||my_option=dropdown 
WIG_container|||visibility=hidden|%|exec=WIG_demo|||my_option=jav_p 
WIG_container|||visibility=hidden|%|exec=WIG_demo|||my_option=menu 
WIG_container|||visibility=hidden|%|exec=WIG_demo|||my_option=modify"); 

if(!isset($_SESSION["W_demo"] ) || empty($_SESSION["W_demo"]) ){$_SESSION["W_demo"] = "none";}
// WIG_dropdown("caption=functions : ","w_dropdown=$my_dropdown");

switch( $_SESSION["W_demo"] )
{
	case 1 == preg_match('/modify/',$_SESSION["W_demo"]):
	WIG_btn("caption=modify events","cmd=WIG_container_events|||my_option=show");WIG_btn("caption=modify hotkey","cmd=WIG_hotkey|||my_option=show");
    WIG_btn("caption=modify cron","cmd=WIG_cron|||my_option=show");
	WIG_btn("caption=modify session var","cmd=WIG_container|||class=bg-light-blue fg-green|||exec=WIG_change_session_var","class=g-light-blue fg-green");
    WIG_btn("caption=modify global var","cmd=WIG_container|||WIG_change_global_var");
    WIG_btn("caption=modify global  w_top","cmd=WIG_container|%|WIG_change_global_var|||W_top");
    WIG_btn("caption=modify session w_toast","cmd=WIG_container|%|WIG_change_session_var|||W_toast_txt");
    WIG_btn("caption=modify style","cmd=WIG_change_style_from_txt_db|||my_option=show");
    WIG_btn("caption=edit wizard","cmd=WIG_wizard|||my_option=show");
	WIG_dropdown();
	 break;
	case 1 == preg_match('/dropdown/',$_SESSION["W_demo"]):
	 WIG_dropdown();
	 WIG_help("my_help=WIG_dropdown");
	 WIG_help("my_help=WIG_container");
	 break;
	case 1 == preg_match('/menu/',$_SESSION["W_demo"]):
	  WIG_btn("caption=horizontal menu","cmd=WIG_container|%|cmd=WIG_menu|||txt_tablename=test1.dat|||my_option=h-menu");
	  WIG_menu("txt_tablename=test1.dat","my_option=h-menu","class=bg-blue fg-red");
	  WIG_btn("caption=sidebar menu","cmd=WIG_menu|||txt_tablename=sidebar_menu.dat|||class=fg-green bg-light-blue|||my_option=sidebar");
	  WIG_menu("txt_tablename=sidebar_menu.dat","class=fg-green bg-light-blue","my_option=sidebar");
      WIG_btn("caption=dropdown menu","cmd=WIG_menu|||txt_tablename=dropdown_menu.dat|||class=bg-light-blue fg-green|||my_option=dropdown");
	  WIG_menu("txt_tablename=dropdown_menu.dat","class=bg-light-blue fg-green","my_option=dropdown");
      WIG_btn("caption=w_dropdown menu","cmd=WIG_menu|||class=bg-light-blue fg-red|||my_option=w_dropdown|%|w_dropdown=WIG_msg|||txt=hello WIG_dt|||option=none","color=red");
      WIG_btn("caption=d-menu menu","cmd=WIG_menu|||txt_tablename=d_menu.dat|||class=bg-blue fg-white|||my_option=d-menu");
      WIG_btn("caption=v-menu","cmd=WIG_menu|||txt_tablename=v_menu.dat|||class=bg-yellow fg-red|||my_option=v-menu");
      WIG_btn("caption=h-menu","cmd=WIG_menu|||txt_tablename=h_menu.dat|||class=info|||my_option=h-menu");
      WIG_menu("my_option=w_dropdown","w_dropdown=WIG_msg|||txt=hello WIG_container|||txt=lll|||DEBUG=OFF WIG_toastr|||txt=toast");
	 break;
	case 1 == preg_match('/jav_p/',$_SESSION["W_demo"]):
	 WIG_help("my_help=JAV_p");
	 WIG_btn("caption=test jav_p","cmd=JAV_p|||WIG_container=DEBUG=ON|||cmd=WIG_menu");
     WIG_btn("caption=test jav_p","cmd=JAV_p|||WIG_container=DEBUG=OFF|||my_option=left|||height=250px|||cmd=WIG_menu|||exec=WIG_fill");
	 WIG_btn("caption= javp toast","cmd=JAV_p|||WIG_toastr=txt=hello2|||delay=4000");
	 break;
	case 1 == preg_match('/user/',$_SESSION["W_demo"]):
	 WIG_btn("caption=set user to admin","cmd=WIG_set_var|||username|||admin","exec=WIG_reload");
     WIG_btn("caption=set user to tester","cmd=WIG_set_var|||username|||tester","exec=WIG_reload");
     WIG_btn("caption=set user to none","cmd=WIG_set_var|||username|||none","exec=WIG_reload");
	 WIG_btn("caption=login","cmd=WIG_login");
     WIG_btn("caption=logout","cmd=WIG_logout");
	 WIG_menu();
	 break;
	case 1 == preg_match('/functions/',$_SESSION["W_demo"]):
	 $my_array=get_defined_functions();$my_dropdown="w_dropdown=";$x=1;echo "<br>";
      foreach ($my_array["user"] as $key => $value)
       {
        $new_value=str_replace("wig_","WIG_","$value");
        echo "<a href=\"?$new_value\"><button style=\"width:200px\" class=\"bg-green fg-red\" >$value</button></a>";
        $x=$x+1;if( $x > 5 ){echo "<br>";$x=1;}
		}
	 break;	 
	case 1 == preg_match('/^menu2/',$_SESSION["W_demo"]):
	 WIG_btn("caption=sidebar menu","cmd=WIG_menu|||txt_tablename=sidebar_menu.dat|||class=fg-green bg-light-blue|||my_option=sidebar");
     WIG_btn("caption=dropdown menu","cmd=WIG_menu|||txt_tablename=dropdown_menu.dat|||class=bg-light-blue fg-green|||my_option=dropdown");
     WIG_btn("caption=w_dropdown menu","cmd=WIG_menu|||class=bg-light-blue fg-red|||my_option=w_dropdown|%|w_dropdown=WIG_msg|||txt=hello WIG_dt|||option=none","color=red");
     WIG_btn("caption=d-menu menu","cmd=WIG_menu|||txt_tablename=d_menu.dat|||class=bg-blue fg-white|||my_option=d-menu");
     WIG_btn("caption=v-menu","cmd=WIG_menu|||txt_tablename=v_menu.dat|||class=bg-yellow fg-red|||my_option=v-menu");
     WIG_btn("caption=h-menu","cmd=WIG_menu|||txt_tablename=h_menu.dat|||class=info|||my_option=h-menu");
     
	 break; 
	 
	default :
	 WIG_msg("txt=wrong or no option is given !!!");
     break;
}

// WIAG_bs_exec($GLOBALS["$my_function"]);	
// WIG_msg("DEBUG=ON","class=bg-red fg-white","exec=WIG_dt","my_pos=bl","height=300px","delay=5000");
//WIG_toast("txt=option : $_SESSION[W_demo]","delay=200","class=bg-blue fg-white","my_pos=bl");
}


// HELP change session var's beginning with W_ when no argument is given
function WIG_change_session_var($session_key = null)
{
if( !isset($session_key) || empty($session_key) ){$session_key="W_";}	
$my_txt="";echo "<br> $session_key";
  foreach ($_SESSION as $key => $value)
  {
    if (gettype($value) != "array" )
	 {
	  if( preg_match("/^$session_key/", $key) == 1 && strlen($key) >=2  && strlen($value) >=1 ){$my_txt=$my_txt . $key . " ";}
	 }
  }
WIG_create_form("$my_txt", "WIG_save_session_vars");
}


// HELP change global var's beginning with W_ when no argument is given
function WIG_change_global_var($global_key = null)
{
if( !isset($global_key) || empty($global_key) ){$global_key="W_";}	
$my_txt="";echo "<br> $global_key";
 foreach ($GLOBALS as $key => $value)
  {
   if (gettype($value) != "array" )
	 {
	 if( preg_match("/^$global_key/", $key) == 1 && strlen($key) >=2  && strlen($value) >=1 ) {$my_txt=$my_txt . $key . " ";}
	 }
  }
WIG_create_form("$my_txt", "WIG_save_session_vars");
}





// HELP create metro wizard component
function WIG_wizard_old()
{
// echo debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS,2)[1]['function'];
WIG_reset_global_vars();
$my_function=__FUNCTION__;$my_function=str_replace("WIG","WAR","$my_function");	
$GLOBALS["WAR_wizard"]=["txt_tablename"=> "wizard_menu.dat","data-role" => "wizard","class"=>"wizard-classic","data-cls-page"=>"d-flex flex-center", "data-width" =>"100%","data-height"=>"500px","top"=>"20px",
"data-auto-start"=>"true","data-stoponmouse"=>"true","data-effect"=>"slide","data-period"=>"6000","data-effect"=>"slide","data-direction"=>"left",
"data-control-prev"=>"<span class='mif-arrow-left'></span>","data-control-next"=>"<span class='mif-arrow-right'></span>",
"border"=>"","overflow"=>"scroll","visibility"=>"hidden"];
// first get settings for container 
$container_style=WIAG_bs($GLOBALS["WAR_metro"]);
$GLOBALS["$my_function"]=array_merge($GLOBALS["WAR_metro"],$GLOBALS["WAR_wizard"],func_get_args());	
$my_style=WIAG_bs($GLOBALS["$my_function"]);
$old_txt_tablename=$GLOBALS["$my_function"]["txt_tablename"];
$txt_tablename =$_SESSION["DATA"] . "/" . $_SESSION["username"] . "_" . $GLOBALS["$my_function"]["txt_tablename"] ;
$my_option=$GLOBALS["$my_function"]["my_option"];$my_delay=$GLOBALS["$my_function"]["delay"];$animation=$GLOBALS["$my_function"]["animation"];
usleep(100);$time_end=round(microtime(true) * 1000);$new_id="$my_function" . "_" . "$time_end";
$wig_datatable=preg_replace('/.dat|\//','', $txt_tablename);
$my_txt_tablename=$wig_datatable;
${$wig_datatable}=$wig_datatable;
$wig_datatable=array();
// unlink("$txt_tablename");
if( !file_exists($txt_tablename))
 {
 $txt_tableinfo="status id page class";
  $txt_num_records=25;
 WIG_create_txt_db($txt_tablename,$txt_tableinfo,$txt_num_records);
 $wig_datatable=WIG_get_txt_db("$txt_tablename",$wig_datatable );
 for($record=1;$record<= 5;$record++)
 {$wig_datatable[0][$record]="Y";$wig_datatable[2][$record]="WIG_fill";$wig_datatable[2][$record]="https://v5.metroui.org.ua/";$wig_datatable[3][$record]="bg-light-blue fg-green";}
for($record=6;$record<= 10;$record++)
 {$wig_datatable[0][$record]="Y";$wig_datatable[2][$record]="WIG_fill";$wig_datatable[3][$record]="bg-light-green fg-blu";}
 WIG_write_txt_db("$txt_tablename" , $wig_datatable );
 }	
$wig_datatable=WIG_get_txt_db("$txt_tablename",$wig_datatable );$records_db=count($wig_datatable[0])-2;
 
switch( $my_option )
  {
    case 1 == preg_match('/show/',$my_option):
               WIG_container("cmd=WIG_metro_show_datatables|||txt_tablename=$old_txt_tablename");
               return;		   
			   
  }  
echo "<div $container_style >";
?>

    <div data-role="wizard-classic" class="scrollbar-type-3" data-height="500px" >
        <div class="page scrollbar-type-3"><?php WIG_d(); ?></div>
        <div class="page"><?php WIG_d(); ?></div>
        <div class="page">Page 3</div>
        <div class="page">Page 4</div>
    </div>

	<?php
	
  echo "</div>"; 
 // echo "<br> $container_style <br>"; 
 
 
//  echo "<div $container_style >";
 echo "<br> $my_style <br>";
echo "<br>";
 echo "<br> $container_style";
  
    //echo '<div data-role="wizard" class="wizard-wide-sm">';
	echo "<div $my_style class=\"cloak\" id=\"$new_id\" >";	
if ( preg_match('/^YES/', $GLOBALS["$my_function"]["close_btn"]) == 1  )
{WIG_btn("caption=X","cmd=JAV_hide|||$new_id|||none|||5s","top=10px","right=10px","position=absolute","background-color=red !important","z-index=9999");}
// WIAG_bs_exec($GLOBALS["$my_function"]);
 

 
 for($record=1;$record<$records_db;$record++) 
    {
     if ( $wig_datatable[0][$record] == "Y" )
     {
	  // echo "<br> $record" . $wig_datatable[2][$record] . $wig_datatable[3][$record];
	    if (preg_match('/^WIG_/', $wig_datatable[2][$record]) && function_exists($wig_datatable[2][$record] ))
		{
		$my_function=$wig_datatable[2][$record];$my_class=$wig_datatable[3][$record];
		 echo "<section><div class=\"page-content\" class=\"$my_class\" >";
		   $my_function();
		 echo "</div></section>";
		}
	   if (preg_match('/^http/', $wig_datatable[2][$record]))
	   {
	    $iframe=$wig_datatable[2][$record];$my_class=$wig_datatable[3][$record];
		echo "<section><div class=\"page-content\" class=\"$my_class\" >";
	    WIG_iframe("iframe=$iframe");
	    echo "</div></section>";
		}
	   }	  
	}
 echo "</div>";
echo "</div>";
if ( $my_delay > 1000 ){echo "<script type=\"text/javascript\">JAV_show_hide('$new_id','$animation','$seconds');</script>";}
if ( $my_delay < 1000 ){echo "<script type=\"text/javascript\">$(document).ready(function() { JAV_show('$new_id','$animation');} );</script>";}	

return;
?>


<div class="p-1 m-3">
    <div class="row">       
        <div class="cell-lg-6">          
                <div data-role="wizard" class="wizard-wide-sm">
                    <section><div class="page-content">Page 111</div></section>
                    <section><div class="page-content">Page 2</div></section>
                    <section><div class="page-content">Page 3</div></section>
                    <section><div class="page-content">Page 4</div></section>
                    <section><div class="page-content">Page 5</div></section>
                </div>           
        </div>
    </div>         
</div>
<?php
	
	
}

function WIG_carousel()
{
WIG_reset_global_vars();
$my_function=__FUNCTION__;$my_function=str_replace("WIG","WAR","$my_function");	
$GLOBALS["WAR_carousel"]=["txt_tablename"=> "carousel_menu.dat","data-role" => "carousel", "data-width" =>"100%","data-height"=>"90%",
"data-auto-start"=>"true","data-stoponmouse"=>"true","data-effect"=>"slide","data-period"=>"6000","data-effect"=>"slide","data-direction"=>"left",
"data-control-prev"=>"<span class='mif-arrow-left'></span>","data-control-next"=>"<span class='mif-arrow-right'></span>",
"border"=>"","overflow"=>"hidden","visibility"=>"hidden"];
$GLOBALS["$my_function"]=array_merge($GLOBALS["WAR_metro"],$GLOBALS["WAR_carousel"],func_get_args());
$my_style=WIAG_bs($GLOBALS["$my_function"]);
$old_txt_tablename=$GLOBALS["$my_function"]["txt_tablename"];
$txt_tablename =$_SESSION["DATA"] . "/" . $_SESSION["username"] . "_" . $GLOBALS["$my_function"]["txt_tablename"] ;
$my_option=$GLOBALS["$my_function"]["my_option"];$my_delay=$GLOBALS["$my_function"]["delay"];$animation=$GLOBALS["$my_function"]["animation"];
usleep(100);$time_end=round(microtime(true) * 1000);$new_id="$my_function" . "_" . "$time_end";
$wig_datatable=preg_replace('/.dat|\//','', $txt_tablename);
$my_txt_tablename=$wig_datatable;${$wig_datatable}=$wig_datatable;$wig_datatable=array();
// unlink("$txt_tablename");
if( !file_exists($txt_tablename))
 {
 $txt_tableinfo="status id function-iframe class";$txt_num_records=25;
 WIG_create_txt_db($txt_tablename,$txt_tableinfo,$txt_num_records);
 $wig_datatable=WIG_get_txt_db("$txt_tablename",$wig_datatable );
 for($record=1;$record<= 5;$record++)
 {$wig_datatable[0][$record]="Y";$wig_datatable[2][$record]="WIG_fill";$wig_datatable[2][$record]="https://v5.metroui.org.ua/";$wig_datatable[3][$record]="bg-light-blue fg-green";}
 WIG_write_txt_db("$txt_tablename" , $wig_datatable );
 }	
$wig_datatable=WIG_get_txt_db("$txt_tablename",$wig_datatable );$records_db=count($wig_datatable[0])-2;
 
switch( $my_option )
  {
    case 1 == preg_match('/show/',$my_option):
               WIG_container("cmd=WIG_metro_show_datatables|||txt_tablename=$old_txt_tablename");
               return;		   			   
  }
echo "<div $my_style class=\"cloak\" id=\"$new_id\" >";	
if ( preg_match('/^YES/', $GLOBALS["$my_function"]["close_btn"]) == 1  )
{WIG_btn("caption=X","cmd=JAV_hide|||$new_id|||none|||5s","top=10px","right=10px","position=absolute","background-color=red !important","z-index=9999");}
// WIAG_bs_exec($GLOBALS["$my_function"]);
 echo "<div class=\"carousel cloak\">";
  echo "<div class=\"slides cloak\">";
 
 for($record=1;$record<$records_db;$record++) 
    {
     if ( $wig_datatable[0][$record] == "Y" )
     {
	    if (preg_match('/^WIG_/', $wig_datatable[2][$record]) && function_exists($wig_datatable[2][$record] ))
		{
		 $my_function=$wig_datatable[2][$record];$my_class=$wig_datatable[3][$record];
		 echo "<div class=\"slide $my_class\" class=\"$my_class\" >";$my_function();echo "</div>";
		}
	    if (preg_match('/^http/', $wig_datatable[2][$record]))
	    {
	     $iframe=$wig_datatable[2][$record];$my_class=$wig_datatable[3][$record];
		 echo "<div class=\"slide\" >";WIG_iframe("iframe=$iframe");echo "</div>";
	   }
	 }	  
	}
  echo"</div>";
 echo"</div>";	
echo "</div>";
if ( $my_delay > 1000 ){echo "<script type=\"text/javascript\">JAV_show_hide('$new_id','$animation','$seconds');</script>";}
if ( $my_delay < 1000 ){echo "<script type=\"text/javascript\">$(document).ready(function() { JAV_show('$new_id','$animation');} );</script>";}		
}



// HELP show metroui clock with no date 
function WIG_clock()
{
?>
<div class="info" data-role="clock" data-time-format="HH:mm:ss" data-show-date="false"></div>
<?php	
}


function WIG_create()
{
WIG_metro("id=WIG_clock","data-role=container","DEBUG=OFF","width=200px","height=100px","class=alert","my_option=create","exec=WIG_jav|||JAV_clock");		
WIG_metro("id=WIG_window","data-role=window","DEBUG=OFF","width=1200px","height=500px","data-hidden=true","class=window","my_option=create","exec=WIG_debug");			
WIG_metro("id=WIG_box","data-role=box","DEBUG=OFF","width=600px","height=400px","visibility=hidden","class=box","my_option=create","exec=WIG_metro_clock","exec2=WIG_dt");					
WIG_reset_global_vars();
}



// HELP WIG_metro universal function to call any other metro component
function WIG_metro()
{
WIG_reset_global_vars();	
$my_function=__FUNCTION__;$my_function=str_replace("WIG","WAR","$my_function");	
$GLOBALS["$my_function"]=array_merge($GLOBALS["WAR_metro"],func_get_args());
$my_style=WIAG_bs($GLOBALS["$my_function"]);
$my_delay=$GLOBALS["$my_function"]["delay"];$my_txt=$GLOBALS["$my_function"]["txt"];
$animation=$GLOBALS["$my_function"]["animation"];
usleep(100);$time_end=round(microtime(true) * 1000);$my_id="$my_function" . "_" . "$time_end";
switch( $GLOBALS["$my_function"]["my_option"] )
  {
    case 1 == preg_match('/^create/', $GLOBALS["$my_function"]["my_option"]):
	           $GLOBALS["$my_function"]["visibility"]="hidden";
			   $my_id=$my_function;
			   $my_style=WIAG_bs($GLOBALS["$my_function"]);
			   if ( preg_match('/^none/', $GLOBALS["$my_function"]["id"]) == 0 ){$my_id=$GLOBALS["$my_function"]["id"];}
			   else
				   $my_id=__FUNCTION__;
               break;		   			   
  } 
echo "<div $my_style id=$my_id>";
$seconds=round($my_delay / 1000, 0, PHP_ROUND_HALF_UP);$seconds=$seconds . "s";
if ( $my_delay > 1000 && $GLOBALS["$my_function"]["visibility"] !="hidden" ){WIG_progress("timer=$my_delay");}
if ( $my_delay > 1000 ){echo "<script type=\"text/javascript\">JAV_show_hide('$my_id','$animation','$seconds');</script>";}  
if ( $my_delay < 1000 && $GLOBALS["$my_function"]["visibility"] !="hidden" ){echo "<script type=\"text/javascript\">JAV_show('$my_id','$animation','$seconds');</script>";} 
WIAG_bs_exec($GLOBALS["$my_function"]);
if ( preg_match('/^YES/', $GLOBALS["$my_function"]["close_btn"]) == 1  )	
{WIG_btn("caption=X","cmd=JAV_hide|||$my_id|||none","top=10px","right=10px","position=absolute","background-color=red !important");}
echo "</div>";
}



// HELP create window from metro ui"data-place"=>"center",
function WIG_window()
{
WIG_reset_global_vars();
$my_function=__FUNCTION__;$my_function=str_replace("WIG","WAR","$my_function");	
$GLOBALS["WAR_window"]=["data-title"=>".","data-width"=>"900px","data-height"=>"400px","data-top"=>"10px","data-cls-content"=>"fg-green bg-light-blue",
"data-left"=>"10px","data-btn-min"=>"true","data-btn-max"=>"true","data-resizable"=>"true","data-cls-window"=>"fg-red bg-blue","data-position"=>"fixed",
"data-content"=>"<div>.</div>","class"=>"fg-white bg-blue","data-role"=>"window","style"=>"NO","data-dragArea"=>"root"];
$GLOBALS["$my_function"]=array_merge($GLOBALS["WAR_metro"],$GLOBALS["WAR_window"],func_get_args());
$my_delay=$GLOBALS["$my_function"]["delay"];$my_txt=$GLOBALS["$my_function"]["txt"];
usleep(100);$time_end=round(microtime(true) * 1000);$new_id="$my_function" . "_" . "$time_end";
$seconds=round($my_delay / 1000, 0, PHP_ROUND_HALF_UP);$seconds=$seconds . "s";
$my_style=WIAG_bs($GLOBALS["$my_function"]);
echo "<div $my_style id=\"$new_id\" >";
echo "<br> $my_style";
WIG_dt();
WIAG_bs_exec($GLOBALS["$my_function"]);
echo "</div>";
}


function WIG_metro_show_datatables()
{
WIG_reset_global_vars();
$my_function=__FUNCTION__;$my_function=str_replace("WIG","WAR","$my_function");	
$GLOBALS["$my_function"]=array_merge($GLOBALS["WAR_metro"],func_get_args());
$my_style=WIAG_bs($GLOBALS["$my_function"]);$my_delay=$GLOBALS["$my_function"]["delay"];$my_txt=$GLOBALS["$my_function"]["txt"];
$txt_tablename=$GLOBALS["$my_function"]["txt_tablename"];
// foreach ($GLOBALS["$my_function"] as $key => $value){echo "<br> show_datatables key :$key => $value";}
$wig_datatable=preg_replace('/.dat/','', $txt_tablename);
$txt_tablename=$_SESSION["DATA"] . "/" . $_SESSION["username"] . "_" . $txt_tablename ;
usleep(100);$time_end=round(microtime(true) * 1000);$my_id="$my_function" . "_" . "$time_end";
global $wig_datatable;$wig_datatable=array();
// if( file_exists($txt_tablename)){unlink($txt_tablename);}
if( !file_exists($txt_tablename))
 {
 $txt_tableinfo="status id field_1 field_2 field_3";$txt_num_records=12;
 WIG_create_txt_db($txt_tablename,$txt_tableinfo,$txt_num_records);
 $wig_datatable=WIG_get_txt_db("$txt_tablename",$wig_datatable );
 $records_db=count($wig_datatable[0])-2;
 for($record=1;$record<= $records_db;$record++)
 {$wig_datatable[0][$record]="Y";$wig_datatable[1][$record]="$record";$wig_datatable[2][$record]="value_$record";$wig_datatable[3][$record]="value_$record";$wig_datatable[4][$record]="value_$record";}
 WIG_write_txt_db("$txt_tablename" , $wig_datatable );
 $wig_datatable=WIG_get_txt_db("$txt_tablename",$wig_datatable );
 // echo "<br>after write :<br><pre>";print_r(var_dump($wig_datatable));echo "</pre>";
 }
$wig_datatable=WIG_get_txt_db("$txt_tablename",$wig_datatable );
$txt_tableinfo="";$records_db=count($wig_datatable[0]);
echo "records_db :  $records_db : $txt_tablename  , fields : " . sizeof($wig_datatable)-1;
echo "<div class=\"container-fluid\">";
// echo "<table data_role=\"table  table-striped responsive-md table-border mt-4\" id=\"$my_id\" > <thead>";
?>
<input type="checkbox" data-role="theme-switcher">
<table class="table striped row-hover border responsive-md fixed-header"
       data-role="table"
       data-caption="hello"
       data-rows="10"
	   data-rownum="false"
       data-rows-steps="5, 10, 50, 100"
       data-show-activity="false"
       data-show-skip="true"
       data-pagination-wrapper="#pagination"
       data-check="false"
       data-show-inspector-button="false"
       data-horizontal-scroll="true"
       data-cell-wrapper="true">
<div id="pagination"></div>

<?php

// header starts here 
echo "<thead> <tr>";
for($index=0;$index<=sizeof($wig_datatable)-1;$index++)
  {
	$my_record=$wig_datatable[$index][0];
	$txt_tableinfo=$txt_tableinfo . " $my_record";
    echo "<th class=\"sortable-column\" width=\"20%\" > $my_record </th>"; 
   }
echo "</tr> </thead>";
// end header + start body
echo "<tbody><tr>";
for($record=1;$record<$records_db;$record++) 
{
// $wig_datatable[0][$record]="Y";
if ( $wig_datatable[0][$record] == "Y" )
{
 echo "<tr>";
$my_id=$record;

// echo "<br><pre>";print_r(var_dump($wig_datatable));echo "</pre>";

for($index=0;$index<=sizeof($wig_datatable)-1;$index++)
{	
 // echo "<br> record : $record , index : $index" . $wig_datatable[$index][0]  . "val : " . $wig_datatable[$index][$record];
 $my_record=$wig_datatable[$index][$record];
 
 $my_width=strlen($my_record) * 10;
  if ( $wig_datatable[$index][0] == "status" && $wig_datatable[$index][1] == "Y" )
  {  
$my_record='<div class="collapse-toggle" >Change</div>';
$my_record=$my_record . '<div data-role="collapse" data-collapsed="true" >';
$my_record=$my_record . "<ul class=\"d-menu pos-relative\" >";
$my_record=$my_record . "<li><a href=\"?WIG_add_record_txt_db=$txt_tablename\">add record</a></li>";
$my_record=$my_record . "<li><a href=\"?WIG_container=width=60%|||exec=WIG_modify_record_txt_db|%|$txt_tablename|%|$record\">Edit inside container</a></li>";
$my_record=$my_record . "<li><a href=\"?WIG_remove_record_txt_db=$txt_tablename|||$record\">remove record : $record</a></li>";
$my_record=$my_record . "<li><a  href=\"?WIG_reset_dat_file=$txt_tablename\">RESET</a></li>";
$my_record=$my_record .  "</ul>";
 $my_record=$my_record .  '<div class="d-flex gap-1 flex-wrap flex-center"><button></button></div>';
$my_record=$my_record . "</div>";
   }
  if ( $my_width > 350 &&  $index > 0 ){$my_width=150;$my_record="<a href='#' title='$my_record'>More ...</a>";}
 echo "<td cls=\"error\" >$my_record</td>";
}     
 echo "</tr>";
}
}
echo "</tbody>  </table>"; 
echo "</div>";

}


function WIG_metro_box()
{
$my_function=__FUNCTION__;$my_function=str_replace("WIG","WAR","$my_function");	
$GLOBALS["$my_function"]=array_merge($GLOBALS["WAR_metro"],func_get_args());
$GLOBALS["$my_function"]["data-role"]="box";
$my_style=WIAG_bs($GLOBALS["$my_function"]);
$my_delay=$GLOBALS["$my_function"]["delay"];$my_txt=$GLOBALS["$my_function"]["txt"];
usleep(100);$time_end=round(microtime(true) * 1000);$my_id="$my_function" . "_" . "$time_end";
echo "<div $my_style id=$my_id>";WIG_progress("timer=$my_delay");
// echo "$my_style";
$seconds=round($my_delay / 1000, 0, PHP_ROUND_HALF_UP);$seconds=$seconds . "s";
if ( $my_delay > 1000 ){echo "<script type=\"text/javascript\">JAV_show_hide('$my_id','none','$seconds');</script>";}  
if ( $my_delay < 1000 ){echo "<script type=\"text/javascript\">JAV_show('$my_id','none','$seconds');</script>";} 
 WIAG_bs_exec($GLOBALS["$my_function"]);
if ( preg_match('/^YES/', $GLOBALS["$my_function"]["close_btn"]) == 1  )
{WIG_btn("caption=X","cmd=JAV_hide|||$my_id|||none","top=10px","right=10px","position=absolute","background-color=red !important");}

 echo "</div>";
}


// HELP call the metro dialog object 
function WIG_dialog()
{
$my_function=__FUNCTION__;$my_function=str_replace("WIG","WAR","$my_function");	
$GLOBALS["$my_function"]=["data-role"=>"dialog","data-auto-hide"=>"0","data-closeButton"=>"true","data-default-action-buttons"=>"ok","data-overlay-Click-Close"=>"true","data-default-actions"=>"true","data-role"=>"dialog","data-show"=>"true","class"=>"dialog","color" => "red !important" , "background-color" => "lightgreen !important","caption"=>"Options"];
$GLOBALS["$my_function"]=array_merge($GLOBALS["WAR_metro"],$GLOBALS["$my_function"],func_get_args());
$GLOBALS["$my_function"]["data-role"]="dialog";
$my_style=WIAG_bs($GLOBALS["$my_function"]);
$my_delay=$GLOBALS["$my_function"]["delay"];
if ( $my_delay > 1000 ){$GLOBALS["$my_function"]["data-auto-hide"]="$my_delay";}
$my_style=WIAG_bs($GLOBALS["$my_function"]);
$my_txt=$GLOBALS["$my_function"]["txt"];
usleep(100);$time_end=round(microtime(true) * 1000);$my_id="$my_function" . "_" . "$time_end";
 echo "<div $my_style id=$my_id>";
  WIAG_bs_exec($GLOBALS["$my_function"]);
 echo "</div>";	
}



// HELP send message JAV_notify(my_text,my_delay,my_color,my_width)
function WIG_notify($my_text="none" , $my_delay=5000 , $my_color="info" , $my_width=250 )
{
// include_once("incl_metro_functions_2.php");
$my_function=__FUNCTION__;$my_function=str_replace("WIG","WAR","$my_function");	
$GLOBALS["$my_function"]=array_merge($GLOBALS["WAR_metro"],func_get_args());
$my_style=WIAG_bs($GLOBALS["$my_function"]);
$args=implode(func_get_args());
$cls=$GLOBALS["$my_function"]["class"];
$timeout=$GLOBALS["$my_function"]["delay"];
// $my_width=250 + rand(10,200);
// echo "<script type=\"text/javascript\">  $(document).ready(function() { JAV_notify(); } );</script>";
// alert,info,succes, primary, .secondary, .success, .alert, .warning, .yellow, .info and .light
// echo "<br> wig_notify : clsNotify: $my_color , width:$my_width , timeout : $my_delay  , args : $my_text ";
// <script type=\"text/javascript\">  $(document).ready(function() { JAV_notify('tester','20000','red','500px'); } );</script>";
echo "<script>$(document).ready(function() { Metro.notify.create(\"$my_text\",\"\",{clsNotify:\"$my_color\",width:$my_width,duration:1000,timeout:$my_delay}); });</script>";

/*
?>
<script>
Metro.notify.create("This is a notify", "", {cls:"info"});
</script>
<?php
*/

//echo "<br> notify args : $args";	
}








?>
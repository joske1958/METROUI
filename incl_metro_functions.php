<?php
// incl_metro_functions.php
// turn off error reporting 
// error_reporting(0);
// turn on
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (session_status() === PHP_SESSION_NONE)
 {
   ini_set('session.cookie_lifetime', 0);
   session_start();
   $_SESSION["session_id"]=session_id();
 }
// new session start + set user to guest when first session
// if (session_status() === PHP_SESSION_NONE)
// if (session_status() === PHP_SESSION_ACTIVE )
// 0----> PHP_SESSION_DISABLED if sessions are disabled.
// 1 ----> PHP_SESSION_NONE if sessions are enabled, but none exists.
// 2 ----> PHP_SESSION_ACTIVE if sessions are enabled, and one exists.
// echo "session status " . session_status() . " : ";
// each page load status is PHP_SESSION_NONE and no SESSION var's existing !!!
//  WIG_canvas(json_encode($wig_datatable));
// foreach ($_SESSION as $key => $value){echo "<br> SESSION_key => $key SESSION_val => $value";}


// $class = color : alert,info,succes, primary, secondary, success, alert, warning, yellow, info ,light or fg-red bg-blue
// pos metro          :  tl,tr,bl,br

 
// after session_start the status becomes PHP_SESSION_ACTIVE  however no SESSION var's existing !!!


// main start here is always executed when incl_functions.php is used
// code below cannot be in a function otherwise it is not global !!


// first session,global  default values to OFF,ON do not remove START
//
foreach (explode(" ","W_style W_logger W_go_up W_translate W_tooltip W_demo W_class") as $i )
	{if(!isset($_SESSION["$i"] ) || empty($_SESSION["$i"]) ){$_SESSION["$i"] = "OFF";}}

// set default global colors
$_SESSION["W_class"]="bg-light-green fg-blue";	
// put logging on in WIG_logger 
$_SESSION["W_logger"]="ON";

// now session default values to none 
foreach (explode(" ","W_toast_txt W_swa_txt W_select_menu W_right_click W_username username role user_include") as $i )
	{if(!isset($_SESSION["$i"] ) || empty($_SESSION["$i"]) ){$_SESSION["$i"] = "none";}}
// now the globals default values to integer for pos and timers

// $GLOBALS["W_bl"]="500";$GLOBALS["W_br"]="500";
// now the globals
// foreach (explode(" ","myLocal W_my_id W_my_action W_my_delay W_msg W_modal") as $i )
// {if(!isset($GLOBALS["$i"] ) || empty($GLOBALS["$i"]) ){$GLOBALS["$i"] = "none";}}



// foreach ( explode(" ","WIG_msg WIG_modal WIG_navbar WIG_canvas WIG_panel WIG_overlay WIG_label WIG_exec WIG_create_form WIG_container") as $i )
// {if(!isset($GLOBALS["$i"] ) || empty($GLOBALS["$i"]) ){$GLOBALS["$i"] = "none";}}

// $myLocal = $GLOBALS["myLocal"];

// if( !isset($_SESSION["DEBUGS"] )){WIG_chk_needed_files();}
 if( !isset($_SESSION["DEBUG"] ) || empty($_SESSION["DEBUG"]) ){$_SESSION["DEBUG"]="OFF";}
// 
// first session,global  default values to OFF,ON do not remove END 


// check needed scripting .css .js .php !! important generate alarm when missing 
WIG_chk_needed_files();
WIG_tooltip("ON");

// $_SESSION["session_id"]=session_id();

// load default session vars of user none 
$my_include=$_SESSION["username"] . "_incl_session_var.php";
// WIG_msg("txt=............................................................. username : $my_include","delay=5500");
if ( !file_exists($my_include ) ){WIG_save_session_vars();}
if ( file_exists($my_include ) ){include($my_include);}


// check needed scripting .css .js .php !! important generate alarm when missing 
// WIG_chk_needed_files();
// WIG_toast("txt=logged in as =>" . $_SESSION["username"] ,"class=bg-light-blue fg-green","my_pos=tr","delay=2000");

// reset the GLOBAL arrays 
WIG_reset_global_vars();

// when writing/testing php code please set DEBUG to on , on prod turn OFF 
$_SESSION["DEBUG"]="ON"; 	  
       $_SESSION["W_db_user_access"]="NOK";
	   if ( $_SESSION["DEBUG"] == "ON" )
	    {
		ini_set('display_errors', 'On');
		// ini_set("error_log", "global.log");
        // ini_set('log_errors_max_len', 1024); // Logging file size
		error_reporting(E_ALL & E_NOTICE & E_DEPRECATED);
		// set_error_handler('WIG_error_handler');
		}
       else
	   {error_reporting(0);}




// send date and session_id to the console
$my_date=date("d/m/y : H:i:s", time());
$new_session=json_encode( $my_date . " ... user :" . $_SESSION["username"] . "... session_id =>" . $_SESSION["session_id"] );
echo "<script type=\"text/javascript\">console.log($new_session);</script>";




// replace std alert 
// echo "<script> document.addEventListener(\"DOMContentLoaded\", function () {alert = function(a){  JAV_notify(a); }  } );</script>";
echo "<script>function alert(message) {  JAV_notify(message); }</script>";

// create the objects for metro ui 
 WIG_create();



// change styles based on value of a txt db
WIG_change_style_from_txt_db();




// try to find incl_"SCRIPT_FILENAME".php and include it
$my_include=basename($_SERVER["SCRIPT_FILENAME"]);$_SESSION["my_include"]="incl_$my_include";
$my_include="incl_$my_include";
if ( file_exists($my_include ) ) {include_once($my_include);$_SESSION["select_menu"]="none";}  


// include the sql code in incl_mysqli.php
// $my_include="incl_metro_mysqli.php";
// if ( !file_exists($my_include ) ){WIG_toast("txt=WARNING did not found $my_include , sql code cannot work");}
// if ( file_exists($my_include ) ) {include_once($my_include);} 

// include the javascript  code in incl_javascript.php
// $my_include="incl_metro_javascript.php";
// if ( !file_exists($my_include ) ){WIG_toast("txt=WARNING did not found $my_include , java code cannot work");}
// if ( file_exists($my_include ) ) {include_once($my_include);} 


// enable events inside container onclick etc ..
WIG_container_events();	

// enable button to scroll page to top
WIG_go_up();

// check if we used GET or POST 
WIG_GET();
WIG_POST();

// enable the hotkeys
WIG_hotkey();

// enable the crontab ( repeated objects WIG_* )
WIG_cron();

// open or close translator
WIG_translate();

// set event for mouse right click 
WIG_right_click();


// start logging to console and global log 
WIG_log("logging started ");


// include now the user session var's if it does not exist create new one with default vanlue
$my_include=$_SESSION["username"] . "_incl_session_var.php";
if ( !file_exists($my_include ) ){WIG_save_session_vars();}	
if ( file_exists($my_include ) ){include($my_include);}



//
// function part starts here
//
// WIG_window("top=120px","left=120px","width=600px","height=400px");



// jquery-3.7.1.min.js
// HELP check needed included files if missing give error with alert 
function WIG_chk_needed_files()
{
$error=0;$result="\\nERROR\\n";
// switched to version 20 on 11/01/2026
$needed_files="metro_5_1_20.css animate.css metro_5_1_20.js incl_metro_functions.php incl_metro_functions_1.php incl_metro_functions_2.php incl_metro_javascript.php";
$my_param=func_get_args();if ( count($my_param) >  0 ){$needed_files=implode(" " ,$my_param);	}

foreach(explode(" ","$needed_files") as $my_include)	
 {
  if ( !file_exists($my_include ) )
   { 
    $error=1;$result="$result" . "\\n $my_include NOK";
	}
 if ( file_exists($my_include ) )
   {
	 switch( $my_include )
      {
       case 1 == preg_match('/.css/',$my_include):
	    echo "<link href=\"$my_include\" rel=\"stylesheet\">";
		$result="$result" . "\\n $my_include OK";
       break;

       case 1 == preg_match('/.js/',$my_include):
	    echo "<script src=\"$my_include\"></script>";
	    $result="$result" . "\\n $my_include OK";
       break;		   
       
	   case 1 == preg_match('/.php/',$my_include):
	    include_once("$my_include");
		// WIG_log("loading : $my_include ");
	    $result="$result" . "\\n $my_include OK";
       break;
	   
	   default :
	    $result="$result" . "\\n <$my_include OK";
	   break;
	  }
   }
 }
if ( $error == 1 ){echo "<script>alert('$result');</script>";} 
// WIG_toast("txt=loading needed files " , "my_pos=tr" , "delay=1100");
}


// HELP log to a global log 
function WIG_log( $txt="none")
{
$_SESSION["W_global_log"]=$_SESSION["LOG"] . "/" . "global_" . date("Y_m", time()) . ".log";
ini_set("error_log", $_SESSION["W_global_log"]);
ini_set('log_errors_max_len', 1024); 
echo "<script type=\"text/javascript\">console.log(\"$txt\");</script>";
$txt=$txt . "\n";
error_log("$txt",3,$_SESSION["W_global_log"] ) or trigger_error("could not log to => " . $_SESSION["W_global_log"] );
}



// HELP simulate unix command tail -f see $GLOBALS["WAR_tail"] is repeatedly calling WIG_logger 
function WIG_tail()
{
$GLOBALS["WAR_tail"]=array_merge($GLOBALS["WAR_tail"],func_get_args());
WIAG_bs($GLOBALS["WAR_tail"]);
if ( file_exists($GLOBALS["WAR_tail"]["filename"]) )
{
 $filename=$GLOBALS["WAR_tail"]["filename"];
 $_SESSION["size"]=filesize("$filename")or trigger_error("could not get filezise  !! ");
 $GLOBALS["WAR_tail"]["fetch"]="incl_metro_functions.php?WIG_logger=filename=$filename";
}
$my_style=WIAG_bs($GLOBALS["WAR_tail"]);
echo "<div id=\"output\" $my_style ></div>";
?>
    <script>
        const outputDiv = document.getElementById('output');
        function fetchLogs() {
            fetch('<?php echo $GLOBALS["WAR_tail"]["fetch"]; ?>')
                .then(response => response.text())
                .then(data => {
                    outputDiv.innerHTML += data; 
                    outputDiv.scrollTop = outputDiv.scrollHeight; // Auto-scroll to bottom
                })
                .catch(error => console.error('Error:', error));
        }
        setInterval(fetchLogs, <?php echo $GLOBALS["WAR_tail"]["delay"]; ?>); // Fetch logs every second
    </script>
<?php
}

// HELP WIG_logger is called from WIG_tail , if file is growing during call we showing last lines 
function WIG_logger()
{
$GLOBALS["WAR_logger"]=array_merge($GLOBALS["WAR_logger"],func_get_args());
WIAG_bs($GLOBALS["WAR_logger"]);
// $my_filename="log/global_2025_02.log";
$my_filename=$GLOBALS["WAR_logger"]["filename"];

if ( !file_exists($GLOBALS["WAR_logger"]["filename"]) )
{
 echo "file does not exist : " . $GLOBALS["WAR_logger"]["filename"] . ",  return now at :";WIG_dt();return;
}
$GLOBALS["WAR_logger"]=array_merge($GLOBALS["WAR_logger"],func_get_args(),get_defined_vars());
if( !isset($_SESSION["size"] ) || empty($_SESSION["size"]) ){$_SESSION["size"]="1";}
$file = fopen("$my_filename", "r") or trigger_error("could not open !! ");
// echo "<br> " . $_SESSION["size"];
$old_size=$_SESSION["size"];
$new_size=filesize("$my_filename")or trigger_error("could not get filezise  !! ");
$_SESSION["size"]=$new_size;
$num_bytes=$new_size-$old_size;

 if ( $num_bytes == 0 ){$num_bytes=1;echo "file $my_filename does not grow at :";WIG_dt();}
// echo "<br> $old_size , $new_size , $num_bytes";  
   fseek($file, -$num_bytes, SEEK_END);
   $string=fread($file, $num_bytes)or trigger_error("could not read  !! "); 
   $lines = preg_split("/\r\n|\n|\r/", $string); 
   foreach ($lines as $key => $value)
   {if ( strlen("$value") >= 3 ){echo "$key => $value";}}
   // print("<pre>".print_r( $lines ,true)."</pre>");
   fclose($file);
}





// HELP create event when right mousebutton is clicked param must be one string example : see $my_args 
function WIG_right_click($my_args = "WIG_container=cmd=WIG_menu|%|my_option=h-menu|||txt_tablename=h-menu2.dat" )
{
  if( !isset($my_args) || empty($my_args) || preg_match('/^none/',$_SESSION["W_right_click"] ) == 1  )
   {
   // WIG_toastr("empty args !!!", "warning" , "toast-top-right" , "1000");
   $my_args="WIG_container=cmd=WIG_menu|%|my_option=h-menu|||txt_tablename=h-menu2.dat";
   $_SESSION["W_right_click"]=$my_args;WIG_save_session_vars();
   WIG_reload();
   } 
   
 if ( count(func_get_args()) == 0 && preg_match('(^WIG_|^JAV_)',$my_args ) == 1 ){$my_args=$_SESSION["W_right_click"];}
 
  if (  preg_match('(^WIG_|^JAV_)',$my_args ) == 1 )
   {
   // WIG_toastr("reload right click", "warning" , "toast-top-right" , "1000");
   echo "<script type=\"text/javascript\">  document.addEventListener(\"contextmenu\", function () { JAV_a( \"$my_args\"); } );</script>";
   }	 
}



// HELP put tooltip ON or OF
function WIG_tooltip($given_option = "none")
{
if( !isset($given_option) || empty($given_option) ){$given_my_option="none";}	
if(preg_match('/^OF/',$given_option) == 1 ){$_SESSION["W_tooltip"]="OF";WIG_save_session_vars();}
if(preg_match('/^ON/',$given_option) == 1 ){$_SESSION["W_tooltip"]="ON";WIG_save_session_vars();}		
 if(preg_match('/^ON/',$_SESSION["W_tooltip"]) == 1 )
 {
	 // WIG_toastr("WIG Tooltip = ON ","info","toast-top-right","500");
echo "<script type=\"text/javascript\">  $(document).ready(function() { JAV_tooltip(); } );</script>";

 }	
}


// HELP put translate to ON, OFF as needed 
function WIG_translate($given_option = "none")
{
if( !isset($given_option) || empty($given_option) ){$given_my_option="none";}	
if(preg_match('/^OFF/',$given_option) == 1 ){$_SESSION["W_translate"]="OFF";WIG_save_session_vars();}
if(preg_match('/^ON/',$given_option) == 1 ){$_SESSION["W_translate"]="ON";WIG_save_session_vars();}		
 if(preg_match('/^ON/',$_SESSION["W_translate"]) == 1 )
 {
   ?>
   <div class="gtranslate_wrapper"></div>
   <script>window.gtranslateSettings = {"default_language":"en","languages":["en","fr","de","it","es","nl"],"wrapper_selector":".gtranslate_wrapper","switcher_horizontal_position":"right"}</script>
   <script src="https://cdn.gtranslate.net/widgets/latest/float.js" defer></script>
   <?php
 }	
}


// HELP read file and echo with htmlentities
function WIG_read_file($envFile="index.html")
{
echo "<br> file : $envFile <br>";

// $envFile = "index.html"; $envFile = "https://www.google.be"; = "http://schema.org/WebPage"; = "https://192.168.1.201/W19/empty.php";=  "http://dwg.free.nf/incl_functions.php";
$opts=array(
    "ssl"=>array(
        "verify_peer"=>false,
        "verify_peer_name"=>false,
    ),
);  
$file = fopen("$envFile", 'rb', false, stream_context_create($opts));
$i = 0; 
if($file){
         // File is open
         while(($line = stream_get_line($file, 0, "\n")) !== false){
         $i++;
          echo "<br> [Line #{$i}]:" . htmlentities("$line");
         }
    fclose($file);
        }
}



// HELP show progresbar with ccs code  => WIG_progress("timer=2500")
function WIG_progres()
{
$GLOBALS["WAR_progres"]=array_merge($GLOBALS["WAR_progres"],func_get_args());
WIAG_bs($GLOBALS["WAR_progres"]);
$timer=$GLOBALS["WAR_progres"]["timer"];
$seconds = round($timer / 1000, 0, PHP_ROUND_HALF_UP);$timer=$seconds . "s";
// echo "<br> SECONDS : $seconds ";
?>
<style>
.progres_loader {
  width: 100%;
  height: 8px;
  border-radius: 10px;
  color: red;
  border: 1px solid;
  position: relative;
}
.progres_loader::before {
  content: "";
  position: absolute;
  margin: 2px;
  inset: 0 100% 0 0;
  border-radius: 10px;
  background: blue;
  <?php echo "animation: l6 $timer"; ?>;	
}
@keyframes l6 {
    100% {inset:0}
}
</style>
<div class="progres_loader"></div>
<?php

}

// HELP show progressbar with timer => WIG_progress("timer=2500")
function WIG_progress()
{
$GLOBALS["WAR_progress"]=["timer"=> "5000","class" =>"my_progress fg-red bg-red","width"=>"02%","height"=>"5px"];
$GLOBALS["WAR_progress"]=array_merge($GLOBALS["WAR_progress"],func_get_args());
$my_style=WIAG_bs($GLOBALS["WAR_progress"]);
$timer=$GLOBALS["WAR_progress"]["timer"];
echo "<div><div data-role=\"progress\" $my_style >";
// echo "<div data-role=\"progress\" class=\"my_progress bg-light-blue\" style=\"width:0%;height:5px\">";
echo "<script>$(\".my_progress\").animate({width: \"100%\",}, $timer);</script>";
WIG_clock();
echo "</div></div>";

}

// HELP call the repeated jobs to modify use WIG_cron("my_option=show") or WIG_btn("caption=cron","my_option=show") or ?WIG_cron=my_option=show
function WIG_cron()
{
$my_function=__FUNCTION__;$my_function=str_replace("WIG","WAR","$my_function");	
$GLOBALS["$my_function"]=array_merge($GLOBALS["WAR_metro"],func_get_args());
$my_style=WIAG_bs($GLOBALS["$my_function"]);
$old_txt_tablename="cron_settings.dat";
$txt_tablename =$_SESSION["DATA"] . "/" . $_SESSION["username"] . "_cron_settings.dat";
$my_option=$GLOBALS["$my_function"]["my_option"];

usleep(100);$time_end=round(microtime(true) * 1000);$my_id="$my_function" . "_" . "$time_end";
$wig_datatable=preg_replace('/.dat|\//','', $txt_tablename);
$my_txt_tablename=$wig_datatable;
${$wig_datatable}=$wig_datatable;
$wig_datatable=array();
if( !file_exists($txt_tablename))
 {
 $txt_tableinfo="status id cron_active cron_id cron_option cron_delay cron_repeat";$txt_num_records=11;
 WIG_create_txt_db($txt_tablename,$txt_tableinfo,$txt_num_records);
 $wig_datatable=WIG_get_txt_db("$txt_tablename",$wig_datatable );
 for($record=1;$record<= 10;$record++)
 {$wig_datatable[0][$record]="Y";$wig_datatable[2][$record]="N";$wig_datatable[3][$record]="WIG_clock";$wig_datatable[4][$record]="slideInLeft";$wig_datatable[5][$record]="5s";$wig_datatable[6][$record]="50000";}
 WIG_write_txt_db("$txt_tablename" , $wig_datatable );
 }	
$wig_datatable=WIG_get_txt_db("$txt_tablename",$wig_datatable );


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
		$cron_var="<script type=\"text/javascript\">const cron_interval_$record = setInterval(() => JAV_show_hide('" . $wig_datatable[3][$record] . "','" . $wig_datatable[4][$record] . "','" . $wig_datatable[5][$record] . "'";
		$cron_var=$cron_var . ")," . $wig_datatable[6][$record] . ");</script>";
		echo "$cron_var";
       }
	 }
}




// HELP enable the hotkeys saved in txt db using javascript => WIG_hotkey("txt_tablename=hotkey.dat" )
function WIG_hotkey()
{
$my_function=__FUNCTION__;$my_function=str_replace("WIG","WAR","$my_function");	
$GLOBALS["$my_function"]=array_merge($GLOBALS["WAR_metro"],func_get_args());
$my_style=WIAG_bs($GLOBALS["$my_function"]);
$GLOBALS["$my_function"]["txt_tablename"]="hotkey.dat";
$my_option=$GLOBALS["$my_function"]["my_option"];
$txt_tablename=$GLOBALS["$my_function"]["txt_tablename"];
$old_txt_tablename=$txt_tablename;
$txt_tablename=$_SESSION["DATA"] . "/" . $_SESSION["username"] . "_" . $txt_tablename ;
usleep(100);$time_end=round(microtime(true) * 1000);$my_id="$my_function" . "_" . "$time_end";
global $txt_db;$txt_db=array();
// unlink($txt_tablename);
if( !file_exists($txt_tablename))
 {
 $txt_tableinfo="status id number name action active";$txt_num_records=125;
 $wig_datatable=preg_replace('/.dat|\//','', $txt_tablename);
 WIG_create_txt_db($txt_tablename,$txt_tableinfo,$txt_num_records);
 $txt_db=WIG_get_txt_db("$txt_tablename",$txt_db);
 for($record=1;$record<= 30;$record++)
 {$txt_db[0][$record]="Y";$txt_db[2][$record]=(64+$record);$txt_db[3][$record]="ALT_" . chr(64+$record) . " " . (64+$record) ;$txt_db[4][$record]="JAV_show('WIG_clock');";$txt_db[5][$record]="N";}
 $txt_db[4][7]="JAV_show('WIG_clock');";$txt_db[5][7]="Y";
 $txt_db[4][1]="JAV_show('WIG_clock');";$txt_db[5][1]="Y";
 $txt_db[4][3]="JAV_show_hide('WIG_clock');";$txt_db[5][3]="Y";
 $txt_db[4][9]="JAV_show('WIG_clock');";$txt_db[5][9]="Y";
 WIG_write_txt_db("$txt_tablename",$txt_db);
 }	
$txt_db=WIG_get_txt_db("$txt_tablename",$txt_db);
// echo "<br>:$my_function <br><pre>";print_r(var_dump($GLOBALS["$my_function"]));echo "</pre>";

switch( $my_option )
  {
    case 1 == preg_match('/show/',$my_option):
               WIG_container("cmd=WIG_metro_show_datatables|||txt_tablename=$old_txt_tablename");
               break;		   
			   
  }
$records_db=count($txt_db[0])-2;
echo "<script type=\"text/javascript\">";
echo "document.addEventListener('keydown', function(event) {";

for($record=1;$record<=$records_db;$record++) 
{	
$STATUS=$txt_db[0][$record];$ACTIVE=$txt_db[5][$record];
 // if ( $STATUS == "Y" && $ACTIVE= "Y" )
 if ( preg_match('/^Y/',$STATUS ) == 1 && preg_match('/^Y/',$ACTIVE ) == 1)
  {
	$keynum=$txt_db[2][$record];
	$keyaction="{" . $txt_db[4][$record] . "}";
	echo "if (event.altKey  && event.keyCode == $keynum && !(event.shiftKey || event.ctrlKey  || event.metaKey))";
	echo "$keyaction";
  }
}
echo "});";
echo "</script>";
}





// HELP show global var's with echo 
function WIG_globals()
{
	$my_txt="";
foreach ($GLOBALS as $key => $value)
{
if (gettype($value) != "array" )
	 $my_txt=$my_txt . " <br> GLOBALS : $key => $value";
    else
	  $my_txt=$my_txt . " <br> GLOBALS: !!! ARRAY !!! => $key";
}
echo "$my_txt";	
}



// HELP WIG_fill return text param1 : rows , param 2 : lenght 
function WIG_fill($fill_rows = null,$fill_size = null,$fill_option = null )
{
if( !isset($fill_rows) || empty($fill_rows) ){$fill_rows=rand(1,10);}
if( !isset($fill_option) || empty($fill_option) ){$fill_option="show";}
if( !isset($fill_size) || empty($fill_size) ){$fill_size=80;}
$fill_rows=intval("$fill_rows");
$fill_size=intval("$fill_size");
$max_fill=0;$fill_text="rows : $fill_rows , lenght : $fill_size <br>";
// echo "fill_rows  $fill_rows  : fill_size : $fill_size fill_option : $fill_option ";
 for($record=0;$record<= $fill_rows;$record++)
 { 
  $max_fill=0;
   $sub_txt=explode(" ","Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua tempor incididunt ut");
  while ( $max_fill <= $fill_size )
   {
	$random_num = rand(0, 20);  
	$fill_text=$fill_text . " $sub_txt[$random_num]";
	$max_fill=$max_fill + strlen($sub_txt[$random_num]);
   }
  $fill_text=$fill_text . " : $record <br>";	
 
 }
switch( $fill_option )
{
	case 1 == preg_match('/none/',$fill_option):
	 return "$fill_text";break;
	case 1 == preg_match('/show/',$fill_option):
	 echo "$fill_text";return "$fill_text";break;
	case 1 == preg_match('/^WIG_/',$fill_option):
	 if (function_exists($fill_option) ){$fill_text=$fill_option();}
	default :
    return "$fill_text";break;
}
}



// HELP example howto show captcha 
function WIG_captcha()
{
 $testGD = get_extension_funcs("gd"); // Grab function list
 if (!$testGD){ echo "GD not even installed."; return; }
 // example 1
  $random_num    = md5(random_bytes(64));$captcha_code  = substr($random_num, 0, 4);
  $_SESSION['CAPTCHA_CODE'] = $captcha_code;
  $layer = imagecreatetruecolor(168, 37);$captcha_bg = imagecolorallocate($layer, 247, 174, 71);
  imagefill($layer, 0, 0, $captcha_bg);$captcha_text_color = imagecolorallocate($layer, 0, 0, 0);
  imagestring($layer, 5, 55, 10, $captcha_code, $captcha_text_color);
  imagejpeg($layer, 'WIG_captcha1.jpg');echo'<br><img src="WIG_captcha1.jpg"><br>';imagedestroy( $layer );
  // example 2
  $captcha = rand(1000, 9999);    
  $im = imagecreatetruecolor(50, 24);$bg = imagecolorallocate($im, 22, 86, 165);
  $fg = imagecolorallocate($im, 255, 255, 255);imagefill($im, 0, 0, $bg);
  imagestring($im, rand(1, 7), rand(1, 7),rand(1, 7),  $captcha, $fg);imagejpeg($im, 'WIG_captcha2.jpg');
  echo'<br><img src="WIG_captcha2.jpg"><br>';imagedestroy( $im ); 
}



// HELP view used arrays in PHP
function WIG_used_arrays($my_option = null )
{
if( !isset($my_option) || empty($my_option) ){$my_my_option="default";}	
 $inh="";
foreach ($GLOBALS as $key => $value) 
 {
	  $inh=$inh . "<pre>GLOBALS : $key    , __gettype__ : " . gettype($value) . "<br></pre>";
	   if (gettype($value) == "array" )
	   {
		  foreach ($value as $key2 => $value2)
		   {
			  if (  gettype($value2) == "string" ) 
			   {
				$inh=$inh . "array : $key   : name var : $key2  , ____value____ : "  . $value2 . "<br>";
			   }
		      else
			   {
			   $inh=$inh . "array : $key   : name var : $key2  , value : "  . "!! NOT STRING !!" .  gettype($value2) . "<br>";
			   }   
		   }	   
	   }
 }
switch( $my_option )
  {
    case 1 == preg_match('/WIG_/',$my_option):
          
		  if (function_exists($my_option)){$my_option($inh);}
		  break; 	 
	 
    default :
		  echo "$inh";
	 break; 
	 
 }	 

}


// HELP testscript for ajax calls
function WIG_d($d_action = null)
{
$my_txt="";
if( !isset($d_action ) || empty($d_action )){$d_action="none_existing";}
ob_start();

reset($_POST);
echo "<br>_POST val : <br>";
foreach ($_POST as $key => $value){echo "POST : $key => $value <br>"; }
reset($_GET);
echo "<br>_GET val : <br>";
foreach ($_GET as $key => $value){echo  "GET : $key => $value <br>"; }
echo "<br> GLOBAL val : <br>";
foreach ($GLOBALS as $key => $value)
{
if (gettype($value) != "array" )
	 echo "GLOBALS : $key => $value<br>";
    else
	  echo "GLOBALS: !!! ARRAY !!! => $key<br>";
}
echo "<br>_SESSION val : <br>";
reset($_SESSION);
foreach ($_SESSION as $key => $value)
{
if (gettype($value) != "array" )
	 echo "<br>_SESSION :  $key => $value";
    else
	  echo " <br> _SESSION : !!! ARRAY !!! => $key";

}
echo "<br> SERVER val : <br>";
reset($_SERVER);
foreach ($_SERVER as $key => $value){ echo "SERVER : $key  => $value <br>";}

if(  preg_match('/^WIG_/', $d_action ) == 1)
  {	
   if (function_exists($d_action))
	 $d_action();
   }
 $my_txt=ob_get_contents();
ob_end_clean();
if(  preg_match('/^WIG_/', $d_action ) == 0){echo "$my_txt";}
}





// HELP set var's used in PHP 2 param : name,value
function WIG_set_var($var_name = null, $var_value=null)
{
WIG_reset_global_vars();
$my_function=__FUNCTION__;$my_function=str_replace("WIG","WAR","$my_function");	
$GLOBALS["$my_function"]=[ "my_var_name" => "none","my_var_value" => "none","cmd" => "none" ,"caption" => "none" ,"border-radius"=> "15px",
"border-width" => "1px"," border-color" => "blue","type"=>"info","font-size" => "20px","txt"=>"none","class=fg-black bg-light-green"];
$GLOBALS["$my_function"]=array_merge($GLOBALS["$my_function"],func_get_args(),get_defined_vars());
$GLOBALS["$my_function"]["style"]="YES";$my_style=WIAG_bs($GLOBALS["$my_function"]);
$caption=$GLOBALS["$my_function"]["caption"];$class=$GLOBALS["$my_function"]["class"];
usleep(100);$time_end=round(microtime(true) * 1000);$new_id="$my_function" . "_" . "$time_end";
// $var_name=$GLOBALS["$my_function"]["my_var_name"];
// $var_value=$GLOBALS["$my_function"]["my_var_name"];
if( !isset($var_name) || empty($var_name) ){return;}	
if( !isset($var_value) || empty($var_value) ){return;}	
if ( count(func_get_args()) > 0 )
{
$my_param=func_get_args();
$var_name=$my_param[0];
unset($my_param[0]);
$var_value=implode("|||",$my_param);
}
if( !isset($_SESSION[$var_name]) || empty($_SESSION[$var_name])){$_SESSION[$var_name]="none";}
if( !isset($GLOBALS[$var_name]) || empty($GLOBALS[$var_name])){$GLOBALS[$var_name]="none";}
$_SESSION[$var_name]=$var_value;
$GLOBALS[$var_name]=$var_value;
WIG_toastr("set_var : $var_name => $var_value ");
WIG_save_session_vars();
WIAG_bs_exec($GLOBALS["$my_function"]);
}


// HELP clean url 
function WIG_clean_url()
{
// clean url
echo '<script type="text/javascript">history.replaceState(null, "", location.href.split("?")[0]); </script>';
}

// HELP own error handler if needed see line 97 to enable it +  when DEBUG=ON
function WIG_error_handler($errno, $errstr, $errfile, $errline) 
 {
   if ( $_SESSION["DEBUG"] == "ON" ){$message = htmlspecialchars("[ON ERROR][$errno][$errstr][$errfile:$errline]");}
   if ( $_SESSION["DEBUG"] == "OFF" ){$message = htmlspecialchars("OFF ERROR :$errstr");}
   // echo "ERROR MESSAGE : $message";
   WIG_msg("txt=ERROR MESSAGE : $message<br>","class=bg-light-blue fg-red","DEBUG=ON","my_pos=tl","height=100px");
   // WIG_container("txt=ERROR MESSAGE : $message<br>","class=bg-light-blue fg-red pos-top-left","DEBUG=ON","height=250px","width=100%");
}



// HELP delete the data file defined in $_SESSION["txt_tablename"] or given as argument
function WIG_reset_dat_file($dat_file = null)
{
 if ( isset($dat_file) || !empty($dat_file) )
 {
  if( file_exists($dat_file))
  {
   WIG_toast("txt=removing  file  : $dat_file","class=warning");
   unlink($dat_file ) or trigger_error("could not remove ");
   WIG_clean_url();
   WIG_reload();
   return; 
  }
}
 if( file_exists($_SESSION["txt_tablename"]) && !isset($dat_file) )
   {
     WIG_clean_url();
     WIG_reload();
     return;
   }
 WIG_toast("txt=could not remove  file  : $dat_file ","class=warning");
}


// HELP reload page + clean url
function WIG_reload()
{
//reload page
echo '<script type="text/javascript">setTimeout(location.reload.bind(location), 1000);</script>';
// clean url
WIG_clean_url();
}



// HELP open the style db and make the needed changes 
function WIG_change_style_from_txt_db()
{
if(preg_match('/^OFF/',$_SESSION["W_style"]) == 1 ){return;}
$my_function=__FUNCTION__;$my_function=str_replace("WIG","WAR","$my_function");	
$GLOBALS["$my_function"]=array_merge($GLOBALS["WAR_metro"],func_get_args());
$my_style=WIAG_bs($GLOBALS["$my_function"]);
$old_txt_tablename="style_menu.dat";
$txt_tablename =$_SESSION["DATA"] . "/" . $_SESSION["username"] . "_style_menu.dat";
$my_option=$GLOBALS["$my_function"]["my_option"];
usleep(100);$time_end=round(microtime(true) * 1000);$my_id="$my_function" . "_" . "$time_end";
$txt_db=preg_replace('/.dat|\//','', $txt_tablename);
$my_txt_tablename=$txt_db;
${$txt_db}=$txt_db;
$txt_db=array();

// no style file so create one by default 
if( !file_exists($txt_tablename))
{
$txt_tableinfo="status id name font-size color background-color width height border-radius left top";
$txt_num_records=165;
WIG_create_txt_db($txt_tablename,$txt_tableinfo,$txt_num_records);
$txt_db=WIG_get_txt_db($txt_tablename,$txt_db);
$txt_db[0][1]="Y";$txt_db[2][1]="td,tr";$txt_db[3][1]="14px";$txt_db[8][1]="25px";
$txt_db[0][2]="Y";$txt_db[2][2]=".WIG_DEFAULT";$txt_db[3][2]="20px";$txt_db[4][2]="black !important";$txt_db[5][2]="lightblue !important";$txt_db[8][2]="25px";
$txt_db[0][3]="Y";$txt_db[2][3]="div[id*=index_php_]";$txt_db[3][3]="";$txt_db[4][3]="black !important";$txt_db[5][3]="lightblue !important";$txt_db[8][3]="25px";
$txt_db[0][4]="Y";$txt_db[2][4]=":focus";$txt_db[3][4]="";$txt_db[4][4]="red !important";$txt_db[5][4]="lightblue !important";
// $txt_db[0][5]="Y";$txt_db[2][5]="[class*=offcanvas]";$txt_db[3][5]="20px";$txt_db[4][5]="black !important";$txt_db[5][5]="lightblue !important";$txt_db[6][5]="800px";$txt_db[7][5]="500px";$txt_db[8][5]="25px";
$txt_db[0][6]="Y";$txt_db[2][6]="ul,li,strong";$txt_db[8][6]="25px";		
$txt_db[0][7]="Y";$txt_db[2][7]="[class*=btn],[class*=button]";$txt_db[8][7]="25px";
// alert,info,succes, primary, .secondary, .success, .alert
$txt_db[0][8]="Y";$txt_db[2][8]=".alert";$txt_db[8][8]="25px";
$txt_db[0][9]="Y";$txt_db[2][9]=".info";$txt_db[8][9]="25px";
$txt_db[0][10]="Y";$txt_db[2][10]=".succes";$txt_db[8][10]="25px";
$txt_db[0][11]="Y";$txt_db[2][11]=".primary";$txt_db[8][11]="25px";	
// for($record=21;$record<= 33;$record++)
//   {$my_record=$record-10;$txt_db[0][$record]="Y";$txt_db[2][$record]=".WIG_STYLE_" . $my_record;$txt_db[3][$record]="16px";$txt_db[4][$record]="";$txt_db[5][$record]="";}
WIG_write_txt_db("$txt_tablename",$txt_db);
$txt_db=WIG_get_txt_db($txt_tablename,$txt_db);
}	
$txt_db=WIG_get_txt_db($txt_tablename,$txt_db);
// $my_option="show";
switch( $my_option )
  {
    case 1 == preg_match('/show/',$my_option):
               WIG_container("cmd=WIG_metro_show_datatables|||txt_tablename=$old_txt_tablename");
               break;		   
			   
  }


// there is a styel file make the needed changes 
if( file_exists($txt_tablename))
 {

$records_db=count($txt_db[0])-2;
for($record=1;$record<$records_db;$record++) 
 {
 
  if ( $txt_db[0][$record] == "Y" )
   {
	$my_style="<style> " . $txt_db[2][$record] . " { ";
	for($index=3;$index<sizeof($txt_db)-2;$index++)
	{
		// echo "<br> index : $index , record : $record " . "=>" . $txt_db[$index][$record] . "=>" . sizeof($txt_db) ;
		if ( strlen( $txt_db[$index][$record] ) >= 1 )
	      $my_style=$my_style . $txt_db[$index][0]  . " : ". $txt_db[$index][$record] . ";";
    }
   $my_style=$my_style . " } </style>";
   echo "$my_style";	
  }
 }	
}

// start check if we made some changes with colorchange 
$my_name=basename($_SERVER["SCRIPT_FILENAME"]);
$my_name=substr($my_name,0,strpos($my_name,"."));
$my_color="W_" . $my_name . "_color";
$my_color_active="W_" . $my_name . "_active";
$my_bgcolor="W_" . $my_name . "_background-color";
if( !isset($_SESSION["$my_color_active"]) || empty($_SESSION["$my_color_active"])){$_SESSION["$my_color_active"]="N";}
if( !isset($_SESSION["$my_color"]) || empty($_SESSION["$my_color"])){$_SESSION["$my_color"]="";}
if( !isset($_SESSION["$my_bgcolor"]) || empty($_SESSION["$my_bgcolor"])){$_SESSION["$my_bgcolor"]="";}


// WIG_create_form("$my_color $my_bgcolor $my_color_active", "WIG_save_session_vars");
if( isset($_SESSION["$my_color"]) || isset($_SESSION["$my_bgcolor"]) )
{
$my_color=$_SESSION["$my_color"];$my_bgcolor=$_SESSION["$my_bgcolor"];
if( $_SESSION["$my_color_active"] == "Y" ){echo "<style> [div*=\"$my_name\"] ,[id*=\"$my_name\"] ,[class*=\"WIG\"] {color:$my_color;background-color:$my_bgcolor}</style>";}		
 }
// end check if we made some changes with colorchange
}



// HELP change the color by name WIG_change_color_nm(xxx)where xxx=BLACK GREY BLUE RED GREEN YELLOW CYAN DEFAULT
function WIG_change_color_nm($given_arg = "none")
{
$my_name=basename($_SERVER["SCRIPT_FILENAME"]);
$my_name=substr($my_name,0,strpos($my_name,"."));
$my_color="W_" . $my_name . "_color";
$my_color_active="W_" . $my_name . "_active";
$my_bgcolor="W_" . $my_name . "_background-color";	
$my_param=func_get_args();	

foreach ($my_param as $key => $value)
	{
	 if (gettype($value) != "array" )
	 {
	  switch( $value )
       {
		case 1 == preg_match('/-help/',$value):
		 WIG_msg("WIG_change_color_nm(xxx)where xxx=BLACK GREY BLUE RED GREEN YELLOW CYAN DEFAULT");
	     return;
	    case 1 == preg_match('/BLACK/',$value):
		 $_SESSION["$my_color"]="#FFFFFF !important";$_SESSION["$my_bgcolor"]="#000000 !important";$_SESSION["$my_color_active"]="Y";
	     break;
		 case 1 == preg_match('/GREY/',$value):
		 $_SESSION["$my_color"]="#FFFFFF !important";$_SESSION["$my_bgcolor"]="#808080 !important";$_SESSION["$my_color_active"]="Y";
	     break;
	    case 1 == preg_match('/BLUE/',$value):
		 $_SESSION["$my_color"]="#FFFFFF !important";$_SESSION["$my_bgcolor"]="#93FFF8 !important";$_SESSION["$my_color_active"]="Y";
	     break;
	     case 1 == preg_match('/^RED/',$value):
		 $_SESSION["$my_color"]="#FFFFFF !important";$_SESSION["$my_bgcolor"]="#F55525 !important";$_SESSION["$my_color_active"]="Y";
		 break;
		 case 1 == preg_match('/^GREEN/',$value):
		 $_SESSION["$my_color"]="#FFFFFF !important";$_SESSION["$my_bgcolor"]="#9FDD70 !important";$_SESSION["$my_color_active"]="Y";
		 break;
		 case 1 == preg_match('/^YELLOW/',$value):
		 $_SESSION["$my_color"]="#000000 !important";$_SESSION["$my_bgcolor"]="#FFFFB7 !important";$_SESSION["$my_color_active"]="Y";
		 break;
		 case 1 == preg_match('/^BROWN/',$value):
		 $_SESSION["$my_color"]="#FFFFFF !important";$_SESSION["$my_bgcolor"]="#E6A551 !important";$_SESSION["$my_color_active"]="Y";
		 break;
		 case 1 == preg_match('/^CYAN/',$value):
		 $_SESSION["$my_color"]="#000000 !important";$_SESSION["$my_bgcolor"]="#00FFFF !important";$_SESSION["$my_color_active"]="Y";
		 break;
	     default :
		 $_SESSION["$my_color_active"]="N";
         break;
       }
      WIG_save_session_vars();	   
	 }
	}		
}



// HELP change color 
function WIG_change_color()
{	  
// start check if we made some changes with colorchange 
$my_name=basename($_SERVER["SCRIPT_FILENAME"]);
$my_name=substr($my_name,0,strpos($my_name,"."));
$my_color="W_" . $my_name . "_color";
$my_color_active="W_" . $my_name . "_active";
if( !isset($_SESSION["$my_color_active"]) || empty($_SESSION["$my_color_active"])){$_SESSION["$my_color_active"]="N";}
$my_bgcolor="W_" . $my_name . "_background-color";
WIG_create_form("$my_color $my_bgcolor $my_color_active", "WIG_save_session_vars");

if( isset($_SESSION["$my_color"]) || isset($_SESSION["$my_bgcolor"]) )
{
$my_color=$_SESSION["$my_color"];$my_bgcolor=$_SESSION["$my_bgcolor"];
if( $_SESSION["$my_color_active"] == "Y" ){echo "<style> [id*=\"$my_name\"] ,[class*=\"WIG\"] {color:$my_color !important;background-color:$my_bgcolor !important}</style>";}		
 }
// end check if we made some changes with colorchange
// force rounded color
echo "<style> [div*=\"$my_name\"] ,[id*=\"$my_name\"] ,[class*=\"WIG\"] {border-radius: 20px !important;}</style>";	
}


// HELP create a form 2 args see below default settings 
function WIG_create_form($form_record = "W_", $form_action = "WIG_save_session_vars" )
{
if( empty($form_record) && isset($_SESSION["form_record"] ) && !empty($_SESSION["form_record"]) ){$form_record=$_SESSION["form_record"] . " form_record form_action";}
if( empty($form_action) && isset($_SESSION["form_action"]) && !empty($_SESSION["form_action"]) ){$form_action=$_SESSION["form_action"];}

if( !isset($form_record ) || empty($form_record) ){return;}
if( !isset($form_action ) || empty($form_action) ){return;}
// there is some action todo _start so add the buttons	
if (function_exists($form_action))
{
$new_id="WIG_form" . round(microtime(true) * 1000);usleep(10);
$post_scriptname=basename($_SERVER["SCRIPT_FILENAME"]);
echo "<form class='form' action=$post_scriptname id=$new_id enctype='multipart/form-data' method='post'>";
echo "<button type=submit name=\"$form_action\" class=\"fg-blue bg-red\">Submit</button>";
echo "<button type=normal onclick=\"window.location.href();return false;\" class=\"fg-green bg-light-blue\">cancel</button>"; 

}
// echo "<div class=\"form-group\">";
foreach(explode(" ",$form_record) as $var)
{
echo "<br> var => $var ";
$my_old_value="empty";
if( !isset($_SESSION["$var"]) )
 {$_SESSION["$var"]="";$my_old_value=$_SESSION["$var"];}
else
 $my_old_value=$_SESSION["$var"];
 // echo "<div class=\"form-group\">";
 //  echo "<label for=\"usr\">$var</label>";
if ( strlen($var) >=2 )
{
switch($var)
 {
  case 1 == preg_match('/^passw/', $var):
   echo "<div class=\"form-group\">";
   echo "<input type=\"password\" class=\"form-control\" name='$var' value='$my_old_value' id=\"$var\">";
   echo "</div>";
  break;
  
  case 1 == preg_match('/color/', $var) &&  preg_match('/^W_/', $var) :
   echo "<div class=\"form-group\">";
   echo "<input type=\"text\" class=\"form-control\" name='$var' value='$my_old_value' id=\"$var\">";
   echo "</div>";
  break;
   
  default:
  echo "<div class=\"form-group\">";
   echo "<input type=\"text\" class=\"form-control\" name='$var' value='$my_old_value' id=\"$var\">";
   echo "</div>";
  break;   
  }
 }
}

echo "</form>";
}


// HELP insert record in the text db record number is found in parameter + check array _POST 
function WIG_insert_record_txt_db($txt_tablename = null, $txt_recordnumber = null)
{
if( !isset($txt_tablename ) || empty($txt_tablename) ){WIG_toast("txt=insert ERROR did not found tablename  :$txt_tablename" ,"class=warning");return;}	
if( !isset($txt_recordnumber ) || empty($txt_recordnumber) ){WIG_toast("txt=insert ERROR did not found recordnumber :$txt_recordnumber" ,"class=warning");return;}
$wig_datatable=preg_replace('/.dat|\//','', $txt_tablename);
$wig_datatable=array();
$wig_datatable=WIG_get_txt_db($txt_tablename, $wig_datatable);
reset($_POST);
  foreach ($_POST as $key => $value)
   {
    for($index=2;$index<sizeof($wig_datatable);$index++)
     {
	  if ( $wig_datatable[$index][0] == $key )
		$wig_datatable[$index][$txt_recordnumber]=$value;
     }
   }
WIG_write_txt_db("$txt_tablename", $wig_datatable);
}



// HELP remove record in the text db record number _SESSION["txt_id"] status=N 
function WIG_remove_record_txt_db($txt_tablename = null, $txt_recordnumber = null)
{
if( !isset($txt_tablename ) || empty($txt_tablename) ){WIG_toast("txt=insert ERROR did not found tablename  :$txt_tablename" ,"class=warning");return;}	
if( !isset($txt_recordnumber ) || empty($txt_recordnumber) ){WIG_toast("txt=insert ERROR did not found recordnumber :$txt_recordnumber" ,"class=warning");return;}
if( $txt_recordnumber == 1 ){WIG_toast("txt=record 1 cannot be deleted " ,"class=warning");return;}
$wig_datatable=preg_replace('/.dat|\//','', $txt_tablename);
$wig_datatable=array();
$wig_datatable=WIG_get_txt_db($txt_tablename, $wig_datatable);
$STATUS=$wig_datatable[0][$txt_recordnumber];
if ( $STATUS == "Y" && $txt_recordnumber > 1 )
 {
 WIG_toast("txt=removing record : $txt_recordnumber","class=warning");
 $wig_datatable[0][$txt_recordnumber]="N";
 WIG_write_txt_db("$txt_tablename",$wig_datatable);
 }
WIG_clean_url();
}


// HELP modify record var  _SESSION["txt_id"] in a form
function WIG_modify_record_txt_db($txt_tablename = null , $txt_recordnumber = null )
{
if( !isset($txt_tablename ) || empty($txt_tablename) ){WIG_toast("txt=SHOW ERROR did not found tablename  :$txt_tablename" ,"class=warning");return;}	
if( !isset($txt_recordnumber ) || empty($txt_recordnumber) ){WIG_toast("txt=SHOW ERROR did not found recordnumber :$txt_recordnumber" ,"class=warning");return;}
$txt_db=preg_replace('/.dat|\//','', $txt_tablename);$txt_db=array();
$txt_db=WIG_get_txt_db("$txt_tablename",$txt_db);
WIG_clean_url();
$my_style="style=\"width:100%;\"";
$post_scriptname=basename($_SERVER["SCRIPT_FILENAME"]);
echo "<br> <form class='form' action=$post_scriptname enctype='multipart/form-data' method='post'>";
echo "<br> <button type=submit class=\"medium\" name=\"WIG_insert_record_txt_db\" value=\"$txt_tablename|||$txt_recordnumber\" class=\"btn warning\">Submit</button>";
echo " ";
echo "<button type=normal onclick=\"window.location.href();return false;\" class=\"btn primary\">cancel</button>"; 
// echo "<button type=button onclick=\"AjaxFunction2('WIG_remove_record_txt_db','0','$_SESSION[txt_id]');window.location.href();return false;\" class=\"btn btn-danger\">remove</button>"; 
echo "<button type=normal onclick=\"window.location.href='?WIG_remove_record_txt_db=$txt_tablename|||$txt_recordnumber'\" class=\"btn alert\">remove : $txt_recordnumber</button>"; 

echo "<br>"; 
 for($index=2;$index<sizeof($txt_db);$index++)
  {
	$my_record=$txt_db[$index][0];
	$my_old_value=$txt_db[$index]["$txt_recordnumber"];
	echo "<div class='form-group'>";
	     echo "<label for='form'>$my_record : $my_old_value</label>";
		 echo "<input type=\"text\" $my_style value=\"$my_old_value\" id=\"$my_record\" name=\"$my_record\">";
    echo "</div>";
  }
echo "</form>";
echo "record  : $txt_recordnumber";
 }


// HELP add new record var  by setting the status to Y
function WIG_add_record_txt_db($txt_tablename = null)
{
if( !isset($txt_tablename ) || empty($txt_tablename) ){WIG_toast("txt=add record ERROR did not found tablename :$txt_tablename" ,"class=warning");return;}	
$txt_db=preg_replace('/.dat|\//','', $txt_tablename);
$txt_db=array();
$txt_db=WIG_get_txt_db("$txt_tablename",$txt_db);
WIG_clean_url();
// echo "<br><pre>" . print_r($txt_db) . "</pre>";
$records_db=count($txt_db[0])-2;
for($record=1;$record<=$records_db;$record++) 
{	
$STATUS=$txt_db[0][$record];
 if ( $STATUS == "N" )
  {
   WIG_toast("txt=status : $STATUS , adding : $record , tablename : $txt_tablename","class=info");
   $txt_db[0][$record]="Y";
   $_SESSION["txt_id"]=$record;
   WIG_write_txt_db($txt_tablename,$txt_db);   
   return;
  }
 }
}




// HELP create a new txt db rw access is needed !!!
function WIG_create_txt_db($txt_tablename = null,$txt_tableinfo = null,$txt_num_records = null)
{
$GLOBALS["txt_tablename"] = "$txt_tablename";
if( file_exists("$txt_tablename")){return;}	
if( isset($txt_tablename ) && !empty($txt_tablename) ){$wig_datatable=preg_replace('/.dat/','', $txt_tablename);}
if( !isset($txt_tablename ) || empty($txt_tablename) ){WIG_toast("txt=ERROR did not found  tablename :$txt_tablename","class=error");return;}
if( !isset($txt_tableinfo ) || empty($txt_tableinfo ) ){WIG_toast("txt=ERROR did not found  tableinfo : $txt_tableinfo ","class=error");return;}	
if( !isset($txt_num_records ) || empty($txt_num_records ) ){WIG_roast("ERROR did not found number of records :$txt_num_records" ,"class=error");return;}
$wig_datatable=preg_replace('/.dat/','',$txt_tablename );
$txt_db=$wig_datatable;
$txt_db=array();	
for($rows=0;$rows<count($table=explode(" ",$txt_tableinfo));$rows++){${$table[$rows]}=array(range(0,$txt_num_records));}
for($index=0;$index<count($table=explode(" ",$txt_tableinfo));$index++){$txt_db[$index][0]=$table[$index];}	
for($index=0;$index<count($table=explode(" ",$txt_tableinfo));$index++) 
   {
	for($record=1;$record<=$txt_num_records;$record++){$txt_db[$index][$record]="";}
   }
 for($record=1;$record<=$txt_num_records;$record++) {$txt_db[1][$record]=$record;$txt_db[0][$record]="N";}
$txt_db[0][1]="Y"; //  print_r(array_values($txt_db));
 WIG_toastr("!!! NEW DB !!! $txt_tablename ", "warning" , "toast-top-left" , "7000" );
file_put_contents( $txt_tablename, serialize( $txt_db ) ) or trigger_error("could not write !! ");
}


// HELP write a new txt db rw access is needed !!!
function WIG_write_txt_db($txt_tablename = null , &$txt_db_array = "empty" ) 
{
if( isset($txt_tablename ) && !empty($txt_tablename) ){$wig_datatable=preg_replace('/.dat/','', $txt_tablename);}
if( !isset($txt_tablename ) || empty($txt_tablename) ){WIG_toast("write ERROR did not found :$txt_tablename" ,"class=error");return;}
if( !file_exists($txt_tablename)){WIG_toast("txt=ERROR did not found : $txt_tablename ","class=error");return;}
file_put_contents( "$txt_tablename", serialize( $txt_db_array) ) or trigger_error("could not write !! ");
}




// HELP load txt db using _SESSION["txt_tablename"] and  give array as second argument 
function WIG_get_txt_db($txt_tablename = null , &$txt_db_array = "empty" )
 {
  if( isset($txt_tablename ) && !empty($txt_tablename) ){$wig_datatable=preg_replace('/.dat/','', $txt_tablename);}
  if( !isset($txt_tablename ) || empty($txt_tablename) ){WIG_toast("txt=ERROR did not found : $txt_tablename ","class=error");return;}	
  if( !file_exists($txt_tablename)){WIG_toast("txt=get ERROR did not found : $txt_tablename ","class=error");return;}	
  global $txt_db_array;$txt_db_array=array();
  // echo "<br> $txt_tablename";
  if( file_exists($txt_tablename)){$txt_db_array=unserialize( file_get_contents( "$txt_tablename") )or trigger_error("ccould not read !! ");}
   return $txt_db_array;
 }


// HELP change variable W_select_menu in order to switch the menu 
function WIG_change_menu($record_value = null)
{
$my_script=$_SERVER["SCRIPT_NAME"];
$my_script=substr($my_script,strpos($my_script,"/")+1,strlen($my_script));
if( !isset($GLOBALS["W_select_menu_$my_script"]) || empty($GLOBALS["W_select_menu_$my_script"]) ){ $GLOBALS["W_select_menu_$my_script"]="none";}

 if ( count(func_get_args()) > 0 )
  {
   $record_value=implode("|||",func_get_args());
   $GLOBALS["W_select_menu_$my_script"]="$record_value";
   $_SESSION["W_select_menu_$my_script"]=$record_value;
   WIG_save_session_vars();
   WIG_toast("txt=changing menu to => $record_value ","class=bg-light-blue fg-green","my_pos=tl","delay=2000");
   // $select_menu=$record_value;	
   // WIG_clean_url();
   WIG_reload();
   return;
  }
  
 if ( count(func_get_args()) == 0 )
  {
   WIG_reset_global_vars();
   $GLOBALS["WAR_default"] += [ "exec_menu" => $GLOBALS["W_select_menu_$my_script"] ];
   $record_value=$GLOBALS["W_select_menu_$my_script"];
   WIAG_bs($GLOBALS["WAR_default"]);
   WIG_toast("txt=executing  => $record_value ","class=bg-light-blue fg-green","my_pos=tr","delay=1500");
   // foreach ($GLOBALS["WAR_default"] as $key => $value){echo "<br> WAR_default : $key   , value :$value: ";}
   WIAG_bs_exec($GLOBALS["WAR_default"]);
  }
}




// HELP show date and time
function WIG_date_time()
{
$my_date=date("d/m/y : H:i:s", time());
echo $my_date;return $my_date;
}

// HELP show  time
function WIG_time()
{
$my_date=date("H:i:s", time());
echo $my_date;return $my_date;
}

// HELP show date and time
function WIG_dt()
{
$my_date=date("d/m/Y : H:i:s", time());
echo $my_date;return $my_date;
}

// HELP logout and set back to user guest 
function WIG_logout()
{
$_SESSION["W_username"]="none";
$_SESSION["username"]="none";
$my_include=$_SESSION["username"] . "_incl_session_var.php";
 if ( file_exists($my_include ) ){include($my_include);WIG_toast("txt=WIG_logout loading : $my_include");}
 echo("<script>location.href = 'index.html';</script>");
// WIG_reload();
return; 
// echo "<script type=\"text/javascript\">window.close();</script>";
// header( "refresh:1;url=index.html" );
}

// HELP logincheck check user/pwd + session_id user must be different to guest
function WIG_login()
{
$my_function=__FUNCTION__;$my_function=str_replace("WIG","WAR","$my_function");	
$GLOBALS["$my_function"]=array_merge($GLOBALS["WAR_metro"],func_get_args());
$my_style=WIAG_bs($GLOBALS["$my_function"]);
$old_txt_tablename="data.dat";
$txt_tablename =$_SESSION["DATA"] . "/" . "admin_data.dat";
$my_option=$GLOBALS["$my_function"]["my_option"];
usleep(100);$time_end=round(microtime(true) * 1000);$my_id="$my_function" . "_" . "$time_end";
$wig_datatable=preg_replace('/.dat|\//','', $txt_tablename);
$my_txt_tablename=$wig_datatable;
${$wig_datatable}=$wig_datatable;
$wig_datatable=array();

// WIG_toastr($my_txt="none" , $my_delay="1500" , $my_color="info" , $my_width="250" )
// only admin user can change this
if ( preg_match('(admin)',$_SESSION["username"] ) == 0 ){WIG_toastr("only admin can change this !!!","5000","fg-white bg-red","1200");return;}

if( !file_exists($txt_tablename))
 {
 $txt_tableinfo="status id name session_id password role logged_in email full_name street town postnumber country tel";$txt_num_records=31;
 WIG_create_txt_db($txt_tablename,$txt_tableinfo,$txt_num_records);
 $wig_datatable=WIG_get_txt_db("$txt_tablename",$wig_datatable );
 $wig_datatable[0][1]="Y";
	$wig_datatable[2][1]="guest";
	$wig_datatable[3][1]=$_SESSION["session_id"];
	$wig_datatable[4][1]="guest";
	$wig_datatable[5][1]="guest";
	$wig_datatable[6][1]=date("d/m/y : H:i:s", time());
$wig_datatable[0][2]="Y";
	$wig_datatable[2][2]="admin";
	$wig_datatable[3][2]="none";
	$wig_datatable[4][2]="admin";
	$wig_datatable[5][2]="admin";
	$wig_datatable[6][2]=date("d/m/y : H:i:s", time());
  WIG_write_txt_db("$txt_tablename" , $wig_datatable );

 }
 $wig_datatable=WIG_get_txt_db("$txt_tablename",$wig_datatable );
// echo "<br> $my_option old : $old_txt_tablename";

switch( $my_option )
  {
    case 1 == preg_match('/show/',$my_option):
               WIG_container("cmd=WIG_metro_show_datatables|||txt_tablename=$old_txt_tablename");
               break;		   
			   
  }
}


// HELP save current session var's beginning with W_ so each page resfresh the value is kepted
function WIG_save_session_vars()
{
reset($_SESSION);
$my_include=$_SESSION["username"] . "_incl_session_var.php";
$myfile = fopen("$my_include", "w+") or trigger_error("Unable to open file!");
fwrite($myfile,"<?php\n");
 foreach ($_SESSION as $key => $value)
 {
  if (gettype($value) != "array" )
	 {
	 if( preg_match('/W_/', $key) == 1 && strlen($key) >=2  && strlen($value) >=1 ){fwrite($myfile,"\$_SESSION[\"$key\"]=\"$value\";\n");}
	 }
 }
foreach ($GLOBALS as $key => $value)
 {	
  if (gettype($value) != "array" )
	 {
	 if( preg_match('/W_/', $key) == 1 && strlen($key ?? '') >=2  && strlen($value ?? '') >=1 ){fwrite($myfile,"\$GLOBALS[\"$key\"]=\"$value\";\n");}
	 }
 }
fwrite($myfile,"?>");
fclose($myfile);
}	


// HELP show object by id using animate.css 
function WIG_show($my_id= null , $my_action="none" , $my_delay="4s" )
{
if( !isset($my_id)){WIG_toast("txt=wig_show => No id is given return without action");return;}
if ( $my_action == "none" )
 {
  $my_test=explode(" ","slideInDown slideInLeft slideInRight slideInUp fadeIn zoomIn bounceInLeft");
  $random_num = rand(0, 5);
  $my_action="'" . $my_test[$random_num] . "'";
  $my_delay="'" . $my_delay . "'";
 }
 else
 {
  $my_action="'$my_action'";
 }
$my_id="'" . $my_id . "'";
echo "<script type=\"text/javascript\">  $(document).ready(function() { JAV_show($my_id,$my_action,$my_delay); } );</script>";
}

// HELP show object by id using animate.css 
function WIG_hide($my_id= null , $my_action="none" , $my_delay="4s" )
{
if( !isset($my_id)){WIG_toast("txt=wig_hide => No id is given return without action");return;}
if ( $my_action == "none" )
 {
  $my_test=explode(" ","slideOutDown slideOutLeft slideOutRight slideOutUp slideOutUp fadeOut zoomOut bounceOutLeft");
  $random_num = rand(0, 5);$my_action="'" . $my_test[$random_num] . "'";
  $my_delay="'" . $my_delay . "'";  
 }
 else
 {
  $my_action="'$my_action'";
 }
$my_id="'" . $my_id . "'";
echo "<script type=\"text/javascript\">  $(document).ready(function() { JAV_hide($my_id,$my_action,$my_delay); } );</script>";
}



// HELP show hide object by id using javascript
function WIG_show_hide($my_id= null , $my_action="slideInleft" , $my_delay="7s" )
{
if( !isset($my_id)){WIG_toast("txt=wig_show_hide => No id is given return without action");return;}
if ( $my_action == "none" )
 {
  $my_test=explode(" ","slideInDown slideInLeft slideInRight slideInUp fadeIn zoomIn bounceInLeft");
  $random_num = rand(0, 4);
  $my_action="'" . $my_test[$random_num] . "'";
 }
 else
 {
  $my_action="'$my_action'";
 }
$my_id="'" . $my_id . "'";$my_delay="'" . $my_delay . "'";
echo "<script type=\"text/javascript\">  $(document).ready(function() { JAV_show_hide($my_id,$my_action,$my_delay); } );</script>";
// WIG_toast("txt=<br><br>JAV_show_hide($my_id,$my_action,$my_delay)","my_pos=tr","delay=500","width=400px");
// $to_send="JAV_show_hide($my_id,$my_action,'7s')";
// WIG_toast("txt=<br><br>$to_send","my_pos=tr","delay=500","width=400px");
// CORRECT => echo "<script type=\"text/javascript\">JAV_show_hide('WIG_clock','slideInLeft','7s');</script>";  
}

// HELP show defined functions & var'save
function WIG_get_defined()
{
echo "<br> vars <br>";
print("<pre>".print_r(get_defined_vars() ,true)."</pre>");
echo "<br> functions <br>";
 print("<pre>".print_r(get_defined_functions() ,true)."</pre>");
echo "<br>";
}


// HELP show _POST,_GET ,_SESSION , functions n vars for debug reason my_option=any funtion beginning with WIG_*
function WIG_debug()
{
WIG_reset_global_vars();
$GLOBALS["WAR_debug"]=["my_option"=> "all" ,"rows" => "1" , "color" => "bmack !important" , "background-color" => "lightblue !important",
"overflow"=>"scroll","border-width" => "1px","border-color" => "blue !important","border-style" => "solid"];
$my_array=array();
// $my_array=array_merge($GLOBALS["WAR_debug"],$my_args);
if ( count(func_get_args()) > 0 ){	$GLOBALS["WAR_debug"]=array_merge($GLOBALS["WAR_debug"],func_get_args());}

$my_style=WIAG_bs($GLOBALS["WAR_debug"]);
$my_option=$GLOBALS["WAR_debug"]["my_option"];
$new_id="WIG_debug" . round(microtime(true) * 1000);usleep(100);
$final_result="";$counter=0;
$final_array=array();
 if( preg_match('(post|POST|all)',$GLOBALS["WAR_debug"]["my_option"] ) == 1 )
 {reset($_POST);foreach ($_POST as $key => $value){ $final_array+=["POST : $key" => "$value" ];}}

if( preg_match('(get|GET|all)', $GLOBALS["WAR_debug"]["my_option"] ) == 1 )
 {reset($_GET);foreach ($_GET as $key => $value){ $final_array+=["GET : $key" => "$value" ];;}}

if( preg_match('(SESSION|session|all)', $GLOBALS["WAR_debug"]["my_option"] ) == 1 )
 {reset($_SESSION);foreach ($_SESSION as $key => $value){ $final_array+=["SESSION : $key" => "$value" ];}}
 
 if( preg_match('(globals|GLOBALS|all)', $GLOBALS["WAR_debug"]["my_option"] ) == 1 )
 { 
  foreach ($GLOBALS as $key => $value)
   {
	if (gettype($value) != "array" )		
	 $final_array+=["GLOBALS : $key" => "$value" ];
    else
	 $final_array+=["GLOBALS : !!! ARRAY !!!" => "$key" ];
   }   
 }
 
 if( preg_match('(server|SERVER|all)', $GLOBALS["WAR_debug"]["my_option"] ) == 1 )
 {reset($_SERVER);foreach ($_SERVER as $key => $value){ $final_array+=["SERVER : $key" => "$value" ];}	}
 
 
 
 if( preg_match('(function|FUNCTION|all)', $GLOBALS["WAR_debug"]["my_option"] ) == 1 )
 {
  foreach (get_defined_vars() as $key => $value)
  {
   if (gettype($value) != "array" )		
	 $final_array+=["vars : $key" => "$value" ];
    else
	 $final_array+=["vars : !!! ARRAY !!!" => "$key" ];
   }	  
 }
 
echo "<table class=table table-bordered $my_style ><tbody $my_style >";
echo "<tr $my_style>";
	
	 foreach ($final_array as $key => $value)
	  {
	   echo "<td $my_style >$key=$value </td>";
	  $counter=$counter + 1;
	   if ( $counter >= $GLOBALS["WAR_debug"]["rows"] ){$counter=0;echo "</tr><tr>";}	  
	   }
echo "</tbody></table>";

}	



// HELP show _POST , _SESSION using javascript
function WIG_info($given_option = null)
{
if( !isset($given_option) || empty($given_option) ){$given_my_option="jav";}	
WIG_clean_url();
$local_inh="";$show_msg="POST var's : ";
reset($_POST);
foreach ($_POST as $var => $value){$show_msg=$show_msg . "\\n" . "<br> POST : $var => $value ";}
reset($_GET);
$show_msg=$show_msg . " , GET var's ; ";
foreach ($_GET as $var => $value){$show_msg=$show_msg . "\\n" . "<br> GET : $var => $value ";}

foreach ($GLOBALS as $var => $value)
{
 if (gettype($value) != "array" )
    {
     $show_msg=$show_msg . "\\n" . "<br> GLOBALS : $var => $value ";
	}
    else
	  $show_msg=$show_msg . "\\n" . "<br> GLOBALS : !!! ARRAY !!! => $var "; 
}

reset($_SESSION);
foreach ($_SESSION as $var => $value)
{
 if (gettype($value) != "array" )
    {
     $show_msg=$show_msg . "\\n" . "<br> SESSION : $var => $value ";
	}
    else
	  $show_msg=$show_msg . "\\n" . "<br> SESSION : !!! ARRAY !!! => $var "; 

}
foreach ($included_files=get_included_files() as $filename){$show_msg=$show_msg . "\\n" . "<br> included  : $filename ";}
if ( $given_option == "jav" || $given_option == "empty" )
{
?>
<script>
 var my_javascript_var = "<?php echo "message : $show_msg" ; ?>";
alert ( my_javascript_var );
</script> 
<?php
}
else
echo "$show_msg";
}


function WIG_help()
{
WIG_reset_global_vars();	
$GLOBALS["WAR_help"]=array_merge($GLOBALS["WAR_help"],func_get_args());
$my_style=WIAG_bs($GLOBALS["WAR_help"]);$my_function=$GLOBALS["WAR_help"]["my_help"];
$my_class=$GLOBALS["WAR_help"]["class"];
// if(preg_match('/^function/',$my_function) == 1 ){$my_function="'(" . $my_function . ")'";}
// did not found function 
if(substr_count($my_function, "function" ) == 0 ){$my_function="'(" . "^function " . $my_function . ")'";}
// found more then one string 'function'
if(substr_count($my_function, "function" ) > 1 ){$my_function="'(" . $my_function . ")'";}

// foreach ($GLOBALS["WAR_help"] as $key => $value){echo "<br> WAR_HELP :$key => $value";}
// echo "<br>WIAG_BS exec <pre>";print_r(debug_backtrace());echo "</pre>";
$new_id="WIG_help" . round(microtime(true) * 1000);usleep(10);	
$prev_line="";$result="";$msg_txt="";
echo "<div $my_style id=\"$new_id\" >";	
echo "<br> Search for : $my_function <br>";

foreach ($included_files=get_included_files() as $my_helpfile)	
 {
$fn = fopen("$my_helpfile","r");
   while(! feof($fn))
	 {
	   $result = fgets($fn);
	 switch( $result )
{
case 1 == preg_match('/\/\/ HELP/',$result):
$prev_line=$result;
break;	

case 1 ==  preg_match($my_function,$result):
$msg_txt="$prev_line <br> $result<br>";

if ( preg_match('/\/\/ HELP/',$msg_txt) == 1 )
{
 $get_function=str_replace("function ","","$result");
 $get_function=substr($get_function,0,strpos("$get_function","("));
 $get_function=str_replace("WIG","WAR","$get_function");
  echo "$msg_txt<br>";
	
  if( isset($GLOBALS["$get_function"]) )
  {
	$counter=0;
	foreach ($GLOBALS["$get_function"] as $key => $value)
	 {echo "<textarea class=\"$my_class\" style=\"width:250px;height:40px\" >$key=$value</textarea>";echo "...";$counter=$counter + 1;if ( $counter >= 5 ){$counter=0;echo "<br>";}  	  }
	   echo "<br><br>";	
   }
}
$result="";$prev_line="";$msg_txt="";$result="";
break;

default:
// $result="";
break;	
}	  	   	   
    }	 
fclose($fn);
}
echo "</div>";
}

// HELP check to see what is posted 
function WIG_POST()
{
if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST))
  { 
// create SESSION var's and/or fill in the value 
    foreach ($_POST as $POST_var => $POST_value)
	 {
      $POST_VAR="$POST_var";
	  $_SESSION["$POST_VAR"]= htmlspecialchars($POST_value);	  	  	  	  	  
	 }
// for DEBUG
$my_date=date("d/m/Y : H:i:s", time());
$my_result="$my_date : POST : user :" . $_SESSION["username"] . ",";
    foreach ($_POST as $POST_var => $POST_value)
	 {
	  if ( preg_match('(cmd|exec)',$POST_var ) == 1 || preg_match('(cmd|exec)',$POST_value ) == 1 && preg_match('(ON|on)', $_SESSION["W_logger"] ) == 1 )
	  $my_result=$my_result . "$POST_var => $POST_value ,";
	 }
WIG_log("$my_result");

foreach ($_POST as $POST_var => $POST_value)
	 {
		// echo "POST_var : $POST_var  , POST_value : $POST_value <br>";
		if( empty($POST_value)){$POST_value="empty";}
		if( empty($POST_var)){$POST_var="empty";}
		
		if(  preg_match('/^JJJJJJAV_/', $POST_value) == 1 )
		  {
		  $my_function = "$POST_value";
		  $num_args=explode("|||",$POST_value);
		  $my_args="'" .$num_args[0] . "'";
          for($rows=1;$rows<count($num_args=explode("|||",$POST_value));$rows++){$my_args = $my_args . ",'" . $num_args[$rows] . "'";}
          $my_click="$my_function($my_args)";
		  echo "<br> $my_click ";
		  // echo "<script type=\"text/javascript\">JAV_notify();</script>";	
		  echo "<script type=\"text/javascript\">  $(document).ready(function() { $my_click } );</script>";	
          reset($_POST); 
          return;		  
		  }	
	 }


$GLOBALS["WAR_exec"]=$_POST;
// jos changed on 05/01/2026
$GLOBALS["WAR_exec"]=array_merge($GLOBALS["WAR_exec"],func_get_args());	
WIAG_bs($GLOBALS["WAR_exec"]);
WIAG_bs_exec($GLOBALS["WAR_exec"]);
	 reset($_POST);
 }	
}



// check if GET is called with params example : ?WIG_toastr=toastr text|||error|||toast_top_left|||10000&WIG_modal=WIG_debug
function WIG_GET()
{
 if ($_SERVER['REQUEST_METHOD'] == 'GET' && !empty($_GET) )
 {
  $my_date=date("d/m/Y : H:i:s", time());
  $my_result="$my_date : GET : user :" . $_SESSION["username"] . ",";
   foreach ($_GET as $GET_var => $GET_value)
	  {
	 if ( preg_match('(ON|on)', $_SESSION["W_logger"] ) == 1  )
	  $my_result=$my_result . "$GET_var => $GET_value ,";
	 } 
WIG_log("GET : $my_result");	
// echo "<script>console.log(\"GET : $my_result\");</script>";
// WIG_toastr("$my_result <br> END ", "info" , "toast-top-left" , "19000");


  foreach ($_GET as $GET_var => $GET_value)
	 {
		// echo "GET_var : $GET_var  , GET_value : $GET_value <br>";
		if( empty($GET_value)){$GET_value="empty";}
		if( empty($GET_var)){$GET_var="empty";}
		
		if(  preg_match('/^JAV_/', $GET_var) == 1 && preg_match('/^JAV_p/', $GET_var) == 0 )
		  {
		  $my_function = "$GET_var";
		  $num_args=explode("|||",$GET_value);
		  $my_args="'" .$num_args[0] . "'";
          for($rows=1;$rows<count($num_args=explode("|||",$GET_value));$rows++){$my_args = $my_args . ",'" . $num_args[$rows] . "'";}
          $my_click="$my_function($my_args)";
		  // echo "<br> my_click : $my_click ";
		  echo "<script type=\"text/javascript\">  $(document).ready(function() { $my_click } );</script>";	
		  
		  if ( preg_match('/^JAV_p/',$GET_var) == 1 )
			 {
              $my_args="";$my_click="";$my_click="$GET_var" . "('" . "$GET_value" . "')";
			  // echo "<br> my_click : $my_click ";
			  echo "<script type=\"text/javascript\">  $(document).ready(function() { $my_click } );</script>";	
			 }
	 // echo "<br> 2 my_click $my_click ";
		  
          reset($_GET);
          WIG_clean_url();	 
          return;		  
		  }	
	$GLOBALS["WAR_exec"]=$_GET;
    $GLOBALS["WAR_exec"]=array_merge($GLOBALS["WAR_exec"],func_get_args());	
    WIAG_bs($GLOBALS["WAR_exec"]);
	// echo "<pre>";print_r(var_dump($GLOBALS["WAR_exec"]));echo "</pre>";
    WIAG_bs_exec($GLOBALS["WAR_exec"]);
	reset($_GET);
    WIG_clean_url();
    //WIG_toast("wig_get"); 
    // WIG_d();	
  }	
}

}



// HELP show included files 
function WIG_chk_included()
{
// $included_files=get_included_files();
 $chk_msg="<br>";
  foreach ($included_files=get_included_files() as $filename)
  {
	$chk_msg=$chk_msg . "<br> $filename";
	echo "<br>$filename";
  }
}

// HELP show msg or (_SESSION , _SERVER, _ENV ) with javajscript when DEBUG = ON 
function WIG_err_msg ($user_err_msg = null)
 {	
  if( !isset($user_err_msg)){$user_err_msg="undefined";  }
  // when DEBUG is ON show more information  
  if(  $_SESSION["DEBUG"]=="ON" )
  {
   reset($_SESSION);
   foreach ($_SESSION as $key => $value)
     {
	   if (gettype($value) != "array" )
		 $user_err_msg=$user_err_msg .  " <br> _SESSION : $key => $value";
       else  
	     $user_err_msg=$user_err_msg .  " <br> _SESSION : !!! ARRAY !!! => $key";
	 }
   reset($_SERVER);
   foreach ($_SERVER as $key => $value) {$user_err_msg=$user_err_msg .  " <br> _SERVER : $key => $value";}	
   reset($_ENV);
   foreach ($_ENV as $key => $value) {$user_err_msg=$user_err_msg .  " <br> _ENV : $key => $value";}
	  
  // the actual bootstrap alert ...using $user_err_msg
  echo "<div class='alert alert-danger'><a href='#' title='Sluit deze foutmelding' class='close' data-dismiss='alert' 
	    aria-label='close'>&times;</a><br><b>Let op ! </b><br><br>$user_err_msg</div> "; 
  }
 }	

// HELP return crypted user pwd
function WIG_crypt_pwd ($crypt_user_pwd = null)
 {	  
  $new_crypt_user_pwd=hash('sha256',bin2hex("$crypt_user_pwd"));
//  return the crypted pwd 
  return hash('sha256',bin2hex("$crypt_user_pwd"));
 }
 
// HELP return + show user pwd + crypted user pwd 
 function WIG_crypt_pwd_show ($crypt_user_pwd = null)
 {   
  WIG_modal("<br> old : $crypt_user_pwd new : " . hash('sha256',bin2hex("$crypt_user_pwd")) . " <br>" );
  return hash('sha256',bin2hex("$crypt_user_pwd"));
 }

// HELP function java/html to show buttom to scroll page to top
function WIG_go_up($given_option = "none")
{
if( !isset($given_option) || empty($given_option) ){$given_my_option="none";}	
if(preg_match('/^OF/',$given_option) == 1 ){$_SESSION["W_go_up"]="OF";WIG_save_session_vars();}
if(preg_match('/^ON/',$given_option) == 1 ){$_SESSION["W_go_up"]="ON";WIG_save_session_vars();}		
 if(preg_match('/^ON/',$_SESSION["W_go_up"]) == 1 )
 {
?>
<style>
#go_up_myBtn {
  display: none;
  position: fixed;
  bottom: 20px;
  right: 150px;
  z-index: 299;
  font-size: 18px;
  border: none;
  outline: none;
  background-color: red;
  color: white;
  cursor: pointer;
  padding: 15px;
  border-radius: 4px;
}

#go_up_myBtn:hover {
  background-color: green;
}
</style>
<button onclick="topFunction()" id="go_up_myBtn" title="Go to top">Top</button>  
<script>
//Get the button
var go_up_mybutton = document.getElementById("go_up_myBtn");

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {go_up_scrollFunction()};

function go_up_scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    go_up_mybutton.style.display = "block";
  } else {
    go_up_mybutton.style.display = "none";
  }
}
// When the user clicks on the button, scroll to the top of the document
function topFunction() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
}
</script>
<?php	
 }		
}





// END PHP code 
?>



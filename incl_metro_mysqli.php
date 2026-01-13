<?php

// incl_msqli.php used in wbs project
// error_reporting(0);
// ini_set('display_errors', 'On');
// error_reporting(E_ALL);
// include_once("incl_functions.php");

// SHOW TABLES , SHOW DATABASES 

// mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT); // Make MySQLi throw exceptions.


function WIG_txt_db_old($txt_option = null ,$txt_tablename = null,$txt_tableinfo = null,$txt_num_records = null)
{
	return;
if( isset($txt_tablename ) && !empty($txt_tablename) ){$wig_datatable=preg_replace('/.dat/','', $txt_tablename);}
if( !isset($txt_tablename ) || empty($txt_tablename) ){WIG_swa("ERROR did not found  tablename :$txt_tablename",5000,"WIG_STYLE_4");return;}
$wig_datatable=preg_replace('/.dat/','',$txt_tablename );
$txt_db=$wig_datatable;
$txt_db=array();

// start check options
switch( $txt_option )
{
 case 1 == preg_match('/show/',$txt_option):
 {

if( file_exists($txt_tablename))
{
$txt_db=unserialize( file_get_contents( "$txt_tablename") )or trigger_error("could not read !! ");	
$txt_tableinfo="";
for($rows=0;$rows<sizeof($txt_db);$rows++){$txt_tableinfo=$txt_tableinfo . $txt_db[$rows][0] . " ";}
$txt_num_records=count($txt_db[0])-2;
WIG_show_datatables($txt_tablename);
// print_r(array_values($txt_db));
 }
 break;
 }
case 1 == preg_match('/create/',$txt_option):
 // create 
 {
if( file_exists("$txt_tablename")){return;}	
if( !isset($txt_tableinfo ) || empty($txt_tableinfo ) ){WIG_swa("ERROR did not found  tableinfo : $txt_tableinfo ",5000,"WIG_STYLE_4");return;}	
if( !isset($txt_num_records ) || empty($txt_num_records ) ){WIG_swa("ERROR did not found number of records :$txt_num_records" ,5000,"WIG_STYLE_4");return;}	
for($rows=0;$rows<count($table=explode(" ",$txt_tableinfo));$rows++){${$table[$rows]}=array(range(0,$txt_num_records));}
for($index=0;$index<count($table=explode(" ",$txt_tableinfo));$index++){$txt_db[$index][0]=$table[$index];}	
for($index=0;$index<count($table=explode(" ",$txt_tableinfo));$index++) 
   {
	for($record=1;$record<=$txt_num_records;$record++){$txt_db[$index][$record]="";}
   }
 for($record=1;$record<=$txt_num_records;$record++) {$txt_db[1][$record]=$record;$txt_db[0][$record]="N";$txt_db[0][$record]="Y";}
$txt_db[0][1]="Y";

//  print_r(array_values($txt_db));
 WIG_toastr("!!! NEW DB !!! $txt_tablename ", "warning" , "toast-top-left" , "7000" );
file_put_contents( $txt_tablename, serialize( $txt_db ) ) or trigger_error("could not write !! ");
 break;

 // create 
}
// end check options
}



}


function WIG_close_db()
{
	// sluit DB
global $database;	
@mysqli_close($global_link_db,$_SESSION['W_db_name']);
}

function WIG_connect_db()
 {
    global $global_link_db;
	global $link;
	$my_sql_connect_error="";
	$password=$_SESSION["W_db_pwd"];
	$global_link_db =  mysqli_connect($_SESSION['W_db_host'],$_SESSION['W_db_user'],$password,$_SESSION['W_db_name']) or trigger_error("settings DB connect wrong");
    mysqli_select_db($global_link_db,$_SESSION['W_db_name'])or trigger_error("DB name does not exist") ;	
	@mysqli_query( $global_link_db,"SET CHARACTER SET  'utf8' ")or trigger_error("wrong CHARACTER SET");
	if (!$global_link_db)
	 {
	  trigger_error("Connection failed: to DB ");	
	 }
	else
	{
	 $_SESSION["W_db_access"]="OK";
    $link=$global_link_db;
	}
}

// HELP modify record inside db using $_SESSION["sql_id"] and $_SESSION["db_tablename"] 
function WIG_mysqli_modify_record()
{
global $link;
WIG_connect_db();
$_SESSION["W_db_tablename"]=trim($_SESSION["W_db_tablename"]);
$_SESSION["W_db_tablename"]=strtok($_SESSION["W_db_tablename"], " " );
$update_querie="update " . $_SESSION["W_db_tablename"] . " set ";
reset($_POST);
foreach ($_POST as $var => $value)
{
if( preg_match('/WIG_/', $var) == 0 &&  strlen($value) != 0  && preg_match('/id/', $var) == 0 )
 $update_querie=$update_querie . $var . "='$value ',";
}
$update_querie=substr_replace($update_querie ,"",-1);
$update_querie=$update_querie . " where id=" . $_SESSION["sql_id"];
// WIG_swa(" record :WIG_mysqli_modify_record_in_db() " . $_SESSION["sql_id"] . " , tablename : " . $_SESSION["W_db_tablename"]  . "<br> querie : $update_querie" , "success" , "toast-top-left" );		
WIG_toastr(" record : " . $_SESSION["sql_id"] . " , tablename : " . $_SESSION["W_db_tablename"]  . "<br> querie : $update_querie" , "success" , "toast-top-left" ,8000);		
// echo "$update_querie";
mysqli_query($link,$update_querie) or trigger_error("query failed");
WIG_reload();
}

// HELP build form data comes from DB 
function WIG_mysqli_modify_form()
{
WIG_connect_db();$info="";global $link;
WIG_toastr("WIG_mysqli_modify_form()  record : " . $_SESSION["sql_id"]  , "success" , "toast-top-left" , "3000" );
$old_db_tablename=$_SESSION["db_tablename"];
$to_modify="select * from " . $_SESSION["W_db_tablename"] .  " where id=" . $_SESSION["sql_id"];
$to_modify=strtolower($to_modify);
$to_modify=trim($to_modify);
WIG_db_querie($to_modify, NO_ACTION);
$_SESSION["db_tablename"]=$old_db_tablename;
foreach($_SESSION["sql_db"][1] as $sql_index=>$sql_value)
 {
  $info=$info . "$sql_index ";
  $_SESSION["$sql_index"]=$sql_value;
 }
WIG_create_form("$info","WIG_mysqli_modify_record" );	
}



// HELP rem record into DB using session vars as parameter 
function WIG_mysqli_remove_record()
{
WIG_toastr("WIG_mysqli_remove_record()  record : " . $_SESSION["sql_id"]  , "success" , "toast-top-left" , "3000" );
$to_delete="DELETE FROM " . $_SESSION["db_tablename"] .  " WHERE id=" . $_SESSION["sql_id"];
WIG_toastr("WIG_mysqli_remove_record() $to_delete " , "warning" , "toast-top-left" , "6000" );
WIG_connect_db();	
global $link;
mysqli_query($link,$to_delete) or trigger_error("wrong querie") ;
WIG_reload();		
}




// HELP add record into DB using session vars as parameter 
function WIG_mysqli_add_record()
{
WIG_connect_db();	
$num_rows=0;
global $link;
foreach($_SESSION["sql_db"][1] as $sql_index=>$sql_value){$num_rows=$num_rows+1;}
$to_insert="INSERT INTO " . $_SESSION["db_tablename"] . "(";
foreach($_SESSION["sql_db"][1] as $sql_index=>$sql_value)
 $to_insert=$to_insert . "$sql_index ,";
 $to_insert=substr_replace($to_insert ,"",-1);
 $to_insert=$to_insert . ") VALUES (";
foreach($_SESSION["sql_db"][1] as $sql_index) 
  $to_insert=$to_insert . "NULL ,";
  $to_insert=substr_replace($to_insert ,"",-1);
  $to_insert=$to_insert . ");";
 echo "$to_insert";
 mysqli_query($link,$to_insert) or trigger_error("wrong querie") ;
 WIG_reload();	
}


// HELP modify the record in the DB 
function WIG_modify_record_db_old($record_value = null)
{
$info="";
foreach($_SESSION["sql_db"][$record_value] as $sql_index=>$sql_value)
   {
	     echo "<br> $record_value : index : $sql_index val : $sql_value";
		 $info=$info . "$record_value : index : $sql_index val : $sql_value";
		 $_SESSION["$sql_index"]="$sql_value";
   }
WIG_toastr("WIG_modify_record_db : $info", "warning" , "toast-top-left" , "7000" );	
// WIG_save_session_vars();
$info="";
foreach($_SESSION["sql_db"][$record_value] as $sql_index=>$sql_value)
$info=$info . "$sql_index ";
WIG_create_form("$info","WIG_debug" ) ;
}

// HELP sql querie showing in datatable 
function WIG_db_datatable()
{
$wig_datatable="first";
echo "<table id=\"$wig_datatable\" class=\"display\" style=\"width:100%\"> <thead>";
echo "<th  width=10>EDIT</th>";
foreach($_SESSION["sql_db"][1] as $sql_index=>$sql_value)
  {
	$my_width=strlen($sql_index) * 15;
    // if ( $my_width > 50 ){$my_width=200;}		
	echo "<th width=$my_width>$sql_index</th>"; 
  }
echo "</thead> <tbody>";	 
echo "<tr>";
 for ( $x=1; $x <= count($_SESSION["sql_db"]);$x++)
 {
	foreach($_SESSION["sql_db"][$x] as $sql_index=>$sql_value)
	{
	  if ( $sql_index == "id" )
	   {
		$my_id=$sql_value;
		echo "<td><a href='?WIG_set_var=sql_id|||$my_id|||SESSION&WIG_change_menu=WIG_mysqli_modify_form'>EDIT </a>";
        echo "<a style='color:red;' href='?WIG_set_var=sql_id|||$my_id|||SESSION&WIG_change_menu=WIG_mysqli_remove_record'> REM</a></td>";
	  }
		  
	  $my_width=strlen($sql_value) * 15;
		 if ( $my_width > 350 )
		  {
		  $my_width=150;
		  $sql_value="<a href='#' title='$sql_value'>More ...</a>";
		  }
		  echo "<td width=$my_width>$sql_value</td>"; 
		// 
	}	

$func=$_SESSION["TABLE_OUT_MENU"];
if (function_exists($func)){$func($my_id);} 	
echo "</tr>";
} 
echo "</tbody> </table>";          
?>
<script>
$(document).ready(function() {
	var wig_datatable = "<?php echo "#$wig_datatable"; ?>";
    $(wig_datatable).DataTable(
	{
	responsive: true,
	scrollX: true
	
	}
	
	);
} );
</script>
<?php	

}






function WIG_db_table_out()
{
echo "<body> <div class='container'> <div class='table-responsive-sm'> <table class='table table-bordered'>";
 foreach($_SESSION["sql_db"][1] as $sql_index=>$sql_value)
  {
	$my_width=strlen($sql_index) * 5;		
	echo "<th width=$my_width>$sql_index</th>"; 
  }
echo "</tr> </thead>";	
echo "<tbody> <tr>";
for ( $x=1; $x <= count($_SESSION["sql_db"]);$x++)
{
	foreach($_SESSION["sql_db"][$x] as $sql_index=>$sql_value)
	{
	  if ( $sql_index == "id" )
		  $my_id=$sql_value;
		  
	  $my_width=strlen($sql_value) * 15;
		 if ( $my_width > 350 )
		  {
		  $my_width=150;
		  $sql_value="<a href='#' title='$sql_value'>More ...</a>";
		  }
		  echo "<td width=$my_width>$sql_value</td>"; // 
	}	
$func=$_SESSION["TABLE_OUT_MENU"];
if (function_exists($func)){$func($my_id);} 	
echo "</tr> </tbody>";
}           
echo "</table> </div> </div> </body>";	
}

// HELP   execute mysqli querie 
function WIG_db_querie($given_query  = null,$given_action = null)
{
global $link,$query;
WIG_connect_db();
 if( !isset($given_query) || empty($given_query)) {$given_query="SHOW TABLES";}
 if( !isset($given_action)|| empty($given_action)) {$given_action=STD_OUT;}
$given_query=strtolower($given_query);
$given_query=trim($given_query);
$W_db_query=$given_query;
$_SESSION["db_tablename"]=preg_replace('/select (.*) from/','', $W_db_query);
$_SESSION["W_db_tablename"]=$_SESSION["db_tablename"];
WIG_save_session_vars();

$dataopvragen = mysqli_query($link,$given_query) or trigger_error("querie failed : $given_query ");
$teller=1;$_SESSION["W_db_tablevar"]="";
// $sql_db = array();global $sql_db;
   while($rij = mysqli_fetch_object($dataopvragen))
   {
	$_SESSION["sql_db"][$teller]=$rij;
    // $sql_db[$teller]=$rij;
	 $teller=$teller+1;
	 // break;
   }

// $_SESSION["sql_db"]=$sql_db;   
switch($given_action)
  {
   case NO_ACTION:
     echo "NO_ACTION <br>";
    break;
	
	case SET_POST_VAR:
	   foreach($_SESSION["sql_db"][1] as $sql_index=>$sql_value)
	   {
		$POST_VAR="POST_VAR_$sql_index";
		$_SESSION["$POST_VAR"]=$sql_value;
	    // echo "<br> $POST_VAR => " . $_SESSION["$POST_VAR"];
	   }
    break;
   
   case STD_OUT:
    for ( $x=1; $x <= count($_SESSION["sql_db"]);$x++)
	   foreach($_SESSION["sql_db"][$x] as $sql_index=>$sql_value)
	     echo "<br> $x : index : $sql_index val : $sql_value";
   break;
   
   case STD_ROW:
    $to_print="";
    for ( $x=1; $x <= count($_SESSION["sql_db"]);$x++)
    {
	   foreach($_SESSION["sql_db"][$x] as $sql_index=>$sql_value)
	   {
		$to_print=$to_print . " " . $sql_value; 
	   }
	 }
	echo $to_print;
	return "$to_print";
   break;
    
   case STD_RETURN:
    $to_print="";
    if ( sizeof($_SESSION["sql_db"][1])  ){foreach($_SESSION["sql_db"][1] as $sql_index=>$sql_value){$to_print=$sql_value; }	}  
	return "$to_print";
   break;
   
   case STD_BANNER:
     if ( sizeof($_SESSION["sql_db"][1])  )
	 {
      $to_print="";
      for ( $x=1; $x <= count($_SESSION["sql_db"]);$x++)
       {
	   foreach($_SESSION["sql_db"][$x] as $sql_index=>$sql_value){$to_print=$to_print . " " . $sql_value;}	  
	   }
	return "$to_print";
	 }
   break;  
   
   case TABLE_OUT:
    WIG_db_table_out();
   break;
   
   case DB_DATATABLE:
     WIG_db_datatable();
   break;
   
   default:
    for ( $x=1; $x <= count($_SESSION["sql_db"]);$x++)
	   foreach($_SESSION["sql_db"][$x] as $sql_index=>$sql_value)
	     echo "<br> $x : index : $sql_index val : $sql_value";
  }
}	



// HELP test db with querie SHOW TABLES 
function WIG_db_test()
{
global $link;
WIG_connect_db();
echo "<br> executing querie SHOW TABLES might not work see error messages ";
echo "<br> please change settings WIG_mysqli_settings <br> <br>";	
WIG_db_querie("SHOW TABLES",TABLE_OUT);
echo "<br>";
}





?>
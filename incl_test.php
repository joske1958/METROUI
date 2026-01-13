
<?php

// incl_empty.php used in wbs 
ini_set('display_errors', 'On');
error_reporting(E_ALL);
include_once("incl_metro_functions.php");


// echo "<script type=\"text/javascript\">  $(document).ready(function() { JAV_p('WIG_container=DEBUG=OFF|||my_option=left|||height=250px|||cmd=WIG_menu'); } );</script>";
// ?JAV_p=WIG_container|||DEBUG=OFF|||my_option=left|||height=250px|||cmd=WIG_menu|||exec=WIG_fill






WIG_tooltip("ON");

//WIG_msg("DEBUG=ON","class=bg-red fg-white","exec=WIG_dt","my_pos=bl","height=300px","delay=15000");
// WIG_btn("caption= javp toast","cmd=JAV_p|||WIG_toastr|||txt=hello2|||delay=4000");
echo "<br>:<br>:";






WIG_btn("caption=wig_iframe pdf","cmd=WIG_iframe|||iframe=extbuilder.pdf");

WIG_btn("caption=wig_hh","cmd=WIG_hh");
function WIG_hh()
{
// '{"name":"John", "age":30, "car":null}'

?>
<div data-role="html-container" data-method="get" data-html-source="?WIG_container=DEBUG=ON">DDD</div>
 <button class="button info" data-role="hint" data-hint-position="bottom" data-hint-text="This is a hinted button">Bottom</button>  
    <div class="example" data-role="html-container" data-method="post"   data-request-data='{"WIG_container":"DEBUG=ON"}'  data-html-source="incl_metro_functions.php" data-insert-mode="replace">123</div>
	<?php		
}

	
	

// WIG_container();
// WIG_set_var("username","none");
// WIG_btn("caption=set user to admin","cmd=WIG_set_var|||username|||admin","exec=WIG_reload");
// WIG_btn("caption=set user to tester","cmd=WIG_set_var|||username|||tester","exec=WIG_reload");
// WIG_btn("caption=set user to none","cmd=WIG_set_var|||username|||none","exec=WIG_reload");
// WIG_btn("caption=demo user","cmd=WIG_demo|||my_option=user");

WIG_btn("caption=demo","cmd=WIG_container|||visibility=hidden|||exec=WIG_demo|||my_option=modify|||delay=400");
WIG_btn("caption=demo2","cmd=WIG_container|||visibility=hidden|||DEBUG=ON");
 WIG_btn("caption=demo3","cmd=WIG_container|||visibility=hidden|||DEBUG=ON|%|cmd=WIG_demo|||my_option=user|||delay=100|||DEBUG=ON|%|2exec=WIG_msg|||delay=600|||DEBUG=ON","class=fg-red");
WIG_btn("caption=demo5","cmd=WIG_container|||txt=one|||delay=600|||visibility=hidden|||DEBUG=ON|%|cmd2=WIG_msg|||txt=two|%|cmd3=WIG_msg|||txt=three|||class=fg-red bg-blue","class=fg-green");
WIG_btn("caption=help","cmd=WIG_container|||debug=OFF|||class=light|||width=100%|||height=600px|||top=5px|||left=5px|%|exec=WIG_help|||my_help=WIG_metro");
// WIG_demo("my_option=modify");
// WIG_dropdown("caption=drop_test","w_dropdown=WIG_msg|||txt=hello WIG_container|||txt=lll|||DEBUG=OFF WIG_toastr|||txt=toast WIG_window|||refresh=NO");
return;
WIG_btn("caption=container test","cmd=WIG_container","refresh=NO");
echo "<br>:<br>:";
WIG_btn("caption=window no refresh","cmd=WIG_window","refresh=NO");
WIG_btn("caption=window refresh yes","cmd=WIG_window");

return;
WIG_btn("caption=test jav_f","cmd=JAV_f");

WIG_btn("caption=test wig dom","cmd=WIG_dom");


WIG_btn("caption=test wig toast","cmd=WIG_toast");
WIG_btn("caption=test jav_a","cmd=JAV_a");
// WIG_dom();


function WIG_dom()
{
WIG_dt();	
?>
<script>
// 1. Create the main parent div element
const mainBox = document.createElement('div');
mainBox.classList.add('box');
// 2. Create the first nested div element (box-title)
const titleDiv = document.createElement('div');
titleDiv.classList.add('box-title');
titleDiv.textContent = 'Box Title';

// 3. Create the first p element
const firstP = document.createElement('p');
firstP.textContent = 'Content inside the box...';

// 4. Create the second nested div element (box-title-secondary)
const secondaryTitleDiv = document.createElement('div');
secondaryTitleDiv.classList.add('box-title-secondary');
secondaryTitleDiv.textContent = 'Secondary Title';

// 5. Create the second p element
const secondP = document.createElement('p');
secondP.textContent = 'More content...';

// 6. Append all child elements to the main parent div in order
mainBox.appendChild(titleDiv);
mainBox.appendChild(firstP);
mainBox.appendChild(secondaryTitleDiv);
mainBox.appendChild(secondP);

// 7. Append the complete structure to the document body (or another specific element)
document.body.appendChild(mainBox);

</script>
	<?php
	
	
	
}

?>

    <!-- page content -->
  </body>
</html>
<?php


return;

echo "<br><br>";
// WIG_btn("caption=test jav_fetch dt","cmd=JAV_fetch|||WIG_dt");
return;
// chatgtp javascript launch php function with parameters without page refresh or reload output goes to the body
// include_once("incl_metro_functions.php");
// WIG_container("exec=WIG_help|||my_help_function=WIG_canvas","my_pos=tr");
// WIG_msg("DEBUG=ON");
// WIG_help("my_help_function=WIG_window");
//WIG_canvas("my_option=top","class=fg-red bg-white","cmd=WIG_help|||my_help_function=WIG_canvas"	);
// WIG_window("cmd=WIG_help|||my_help_function=WIG_window"	);
// WIG_toast("txt=tr","my_pos=tr","delay=500");
// WIG_container("DEBUG=ON");
// WIG_toast("txt=no arguments given in W_btn  !!!!","class=bg-red fg-blue","my_pos=tl","delay=3000");
// WIG_toast("txt=no arguments given in W_btn  !!!!","class=bg-green fg-blue","my_pos=tl","delay=3000");
// echo "<script type=\"text/javascript\">  $(document).ready(function() { JAV_notify('tester','20000','red','500px'); } );</script>";
//  echo "<button onclick=\"JAV_a('WIG_container=class=info|||cmd=WIG_menu|%|txt_tablename=test_menu.dat|||class=primary|||my_option=sidebar');\">joske</button>";
// echo "<script type=\"text/javascript\">  $(document).ready(function() { joske(); } );</script>";
// echo "<script type=\"text/javascript\">  $(document).ready(function() { JAV_toastr('testing'); } );</script>";
//  echo "<script type=\"text/javascript\">  $(document).ready(function() { JAV_php('WIG_modal','hello'); } );</script>";
// echo "<script type=\"text/javascript\">  $(document).ready(function() { JAV_php('WIG_msg','calling WIG_msg|||alert_danger'); } );</script>";
// echo "<script type=\"text/javascript\">  $(document).ready(function() { JAV_php('WIG_toastr','calling WIG_toast'); } );</script>";
// echo "<script type=\"text/javascript\">  $(document).ready(function() { JAV_php('WIG_msg','calling WIG_msg'); } );</script>";
// echo "<button onclick=\"joske('lllll');\">joske</button>\";</script>";
// echo "<script type=\"text/javascript\">  $(document).ready(function() { JAV_swa('testing'); } );</script>";
// echo "<script type=\"text/javascript\">  $(document).ready(function() { JAV_php('WIG_msg','calling WIG_msg|||alert_danger'); } );</script>";
// echo "<script type=\"text/javascript\">  $(document).ready(function() { JAV_swa('testingffff',10000); } );</script>";
// echo "<script type=\"text/javascript\">  $(document).ready(function() { JAV_show('WIG_layer_test','slideup',5000); } );</script>";
// echo "<script type=\"text/javascript\">  $(document).ready(function() { JAV_toastr('testing','success','toast-top-left',1000); } );</script>";
// echo "<script type=\"text/javascript\">setTimeout(function() {JAV_hide('$new_id','none','5s');} , 4000);</script>";
// echo "<script type=\"text/javascript\">  $(document).ready(function() { JAV_toastr('incl_test.php','success','toast-top-left',1000); } );</script>";
// echo "<script>setTimeout(function () { document.getElementById(\"basicButton\").dispatchEvent(autoClickEvent); },5000);</script>";
// echo "<script>setTimeout(function () { document.getElementById(\"basicButton\").dispatchEvent(autoClickEvent); },8000);</script>";
// echo "<div><button type=\"button\" id=\"basicButton\"  class=\"btn-danger\"  onclick=\"JAV_toastr('onclick');return false;\">basicButton</button></div><br>";
// echo "<script type=\"text/javascript\">  $(document).ready(function() { JAV_p('WIG_container=DEBUG=OFF|||my_option=left|||height=250px|||cmd=WIG_menu'); } );</script>";

// WIG_container("cmd=WIG_dt","delay=40000","class=fg_white bg-blue");
// WIG_btn("caption=jav_p toast","cmd=WIG_container|||DEBUG=ON|||exec=WIG_dt|||exec2=WIG_toast|||txt=mm");
// WIG_msg("class=bg-blue fg-white","DEBUG=ON","exec=WIG_dt","height=100px","my_pos=br");
// WIG_msg("class=bg-lightblue fg-red","DEBUG=ON","height=100px","exec=WIG_dt","my_pos=br");
// WIG_metro("DEBUG=ON","cmd=WIG_clock");
// WIG_msg("DEBUG=ON","class=bg-blue fg-white","exec=WIG_dt","my_pos=bl","height=300px","delay=3000");
// WIG_msg("DEBUG=ON","class=bg-black fg-white","exec=WIG_dt","my_pos=bl","height=200px","delay=5000"); 
// WIG_msg("DEBUG=ON","class=bg-blue fg-white","exec=WIG_dt","my_pos=tl","height=200px","delay=4000");
//  WIG_toast("txt=tr","my_pos=tr","delay=15000");
// WIG_msg("DEBUG=ON","class=bg-black fg-white","exec=WIG_dt","my_pos=tl","height=200px","delay=5000"); 
// WIG_msg("DEBUG=ON","class=bg-blue fg-white","exec=WIG_dt","my_pos=br","height=200px","delay=4000");
// WIG_msg("DEBUG=ON","class=bg-black fg-white","exec=WIG_dt","my_pos=br","height=200px","delay=5000"); 
// WIG_msg("DEBUG=ON","class=bg-blue fg-white","exec=WIG_dt","my_pos=bl","height=200px","delay=4000");
// WIG_msg("DEBUG=ON","class=bg-black fg-white","exec=WIG_dt","my_pos=bl","height=200px","delay=5000"); 
// WIG_container("DEBUG=ON","class=bg-lightblue fg-white","exec=WIG_dt","my_pos=tr","height=90%","delay=5000","visibility=hidden"); 
// WIG_dialog("DEBUG=OFF","exec=WIG_clock","class=bg-blue fg-white","cmd=WIG_menu|||my_option=v-menu");

// WIG_btn("caption=jav window","cmd=JAV_window");
// WIG_btn("caption=jav window","cmd=JAV_window");

// $( "div" ) - select by tag name
// $( ".div" ) - select by class name
// $( "#div" ) - select by id

function WIG_ct()
{
return;
ob_start();
echo "<div>";
WIG_progress("delay=10000");
$timer=4000;
// WIG_window();
// echo "<div id=\"joske\" data-role=\"progress\" class=\"mmy_progress bg-light-blue\" style=\"width:0%;height:25px\">";
// echo "<script>$(\".mmy_progress\").animate({width: \"100%\",}, 6000);</script>";

?>
<div class="info" data-role="clock" data-time-format="HH:mm:ss" data-show-date="false"></div>
<?php
$output=ob_get_contents();
ob_end_clean();
echo "</div>";
echo $output;

}

WIG_btn("caption=test jav_fetch ct","cmd=JAV_fetch|||WIG_ct");

WIG_clock();
WIG_btn("caption=test jav_fetch dt","cmd=JAV_fetch|||WIG_dt");
WIG_btn("caption=test jav fetch container","cmd=JAV_fetch|||WIG_container");
WIG_btn("caption=test wig_ct","cmd=WIG_ct");
WIG_btn("caption=test wig_progress 5000","cmd=WIG_progress|||timer=5000");
WIG_btn("caption=test wig_progress 5000","cmd=JAV_fetch|||WIG_progress|||timer=5000");

?>


<button onclick="JAV_fetch('WIG_ct')">Run wig_ct</button>
<button onclick="JAV_p('WIG_ct')">jav_pwig_ct</button>
<button onclick="JAV_fetch('WIG_container|||cmd=WIG_dt|||delay=4000')">Run wig conainer</button>
<button onclick="JAV_fetch('WIG_window|||cmd=WIG_dt')">Run wig window</button>
<?php


return;



?>

<button class="button large" onclick="JAV_prevent('WIG_k');">wig_k</button>
<button class="button large" onclick="JAV_window();">jav window</button>
<button class="button" onclick="JAV_prevent()">jav_prevent</button>



<div id="my_container" class="container border-solid">DD<br>KKK<br></div>
<script>$("#my_container").css({"color":"green","background-color":"red","height":"300px","visibility":"hidden"});</script>
<script>console.log($("#my_container").id());</script>
<script>console.log($("#my_container").css());</script>
<script>



Metro.notify.create("This is a notification message", "Notification Title", {
    width: 300,
    keepOpen: true,
    clsNotify: "alert"
});

</script>
<script>
function JAV_window()
{	
var id = Math.floor(Math.random() * 10);
var win = Metro.window.create({
	id:"win"+ id,
    title: "Dynamic Window" + id,
    content: "<span></span>", 
    width: 400,
    height: 300,
	status :"<div><?php WIG_dt(); ?></div>",
    place: "center"
});

}

</script>




<?php

// echo "<script type=\"text/javascript\">  $(document).ready(function() { JAV_window(); } );</script>";

// echo "<script type=\"text/javascript\">setTimeout(function() {JAV_window();} , 4000);</script>";
WIG_dt();



return;


// $my_toast="WIG_msg(\"txt=hello\",\"delay=3000\");";eval("$my_toast");
WIG_metro("id=WIG_box2","data-role=box","DEBUG=OFF","width=600px","height=400px","visibility=hidden","class=box","my_option=create","exec=WIG_clock","exec2=WIG_dt");
// echo "<script type=\"text/javascript\">  $(document).ready(function() { JAV_show_hide('WIG_box2','none','5s'); } );</script>";
// WIG_show_hide("WIG_box2","none","10s");
// WIG_btn("caption=test NR","cmd=JAV_p|||WIG_test","refresh=NO");
WIG_btn("caption=test jav_go","cmd=JAV_go|||WIG_msg|||cmd=WIG_dt");
// WIG_btn("caption=test jav_go window","cmd=JAV_go|||WIG_window");
WIG_btn("caption=test jav_p","cmd=JAV_p|||WIG_window");
return;
WIG_btn("caption=box2 show hide","cmd=JAV_show_hide|||WIG_box2|||none|||15s");
WIG_btn("caption=box2 show","cmd=JAV_show|||WIG_box2|||slideInLeft|||5s");
WIG_btn("caption=box2 hide","cmd=JAV_hide|||WIG_box2|||slideOutLeft|||5s");
// echo "<script type=\"text/javascript\">  $(document).ready(function() { JAV_go('WIG_box2','none','5s'); } );</script>";
// WIG_msg("txt=hel","cmd=WIG_dt","delay=5000");

function WIG_test()
{
echo "<br>WIG_test is called at => " . WIG_dt();
WIG_progress("timer=5000");

$my_progress="WIG_progress(\"timer=3000\");";eval($my_progress);
$my_toast="WIG_msg(\"txt=hello\",\"delay=3000\",\"cmd=WIG_dt\");";eval($my_toast);
WIG_toast("txt=test","delay=4000");
// WIG_metro("id=WIG_box2","data-role=box","DEBUG=OFF","width=600px","height=400px","visibility=hidden","class=box","my_option=create","exec=WIG_clock","exec2=WIG_dt","exec3=WIG_test");
// echo "<script type=\"text/javascript\">  $(document).ready(function() { JAV_p('WIG_dt'); } );</script>";
//WIG_metro("id=WIG_box2","data-role=box","DEBUG=OFF","width=600px","height=400px","visibility=hidden","class=box","my_option=create","exec=WIG_metro_clock","exec2=WIG_dt");
// WIG_show_hide("WIG_box2","none","10s");	
// echo "<script type=\"text/javascript\">  $(document).ready(function() { JAV_show_hide('WIG_box2','none','15s'); } );</script>";
// WIG_msg("txt=hel","cmd=WIG_dt","delay=5000");
}
return;

//echo "<script type=\"text/javascript\">  $(document).ready(function() { JAV_p('WIG_toast'); } );</script>";
// echo "<script type=\"text/javascript\">  $(document).ready(function() { JAV_notify(); } );</script>";
// echo "<script type=\"text/javascript\">  $(document).ready(function() { JAV_prevent(); } );</script>";



WIG_btn("caption=toast NR","cmd=WIG_toast","refresh=NO");
WIG_btn("caption=container NR","cmd=WIG_container=txt=helloNR||exec=WIG_window|||exec2=WIG_msg|%|txt=norefresh_msg|||exec3=WIG_dt","refresh=NO");
WIG_btn("captioncontanert RE","cmd=WIG_container|||txt=helloRE|||exec=WIG_window|||exec2=WIG_msg|%|txt=msg_RE|%|exec3=WIG_toast");
// ?WIG_toast=txt=hello
WIG_btn("caption=toast RE","cmd=WIG_toast|||txt=hello|||delay=4000");
WIG_btn("caption=toast NR","refresh=NO","cmd=WIG_toast|||txt=hello|||delay=4000");
WIG_btn("caption= javp toast","cmd=JAV_p|||WIG_toast|||txt=hello2|||delay=4000");
// WIG_btn("caption=no refresh","cmd=WIG_msg=txt=msg|||exec=WIG_dt|||exec2=WIG_toast","refresh=NO");

WIG_menu("caption=change menu","my_option=w_dropdown","w_dropdown=WIG_change_menu|||WIG_test_menu WIG_change_menu|||WIG_test_1 WIG_container|||txt=lll|||DEBUG=OFF WIG_toastr|||txt=toast",
"w_dropdown_2=WIG_change_menu|||WIG_test_2 WIG_change_menu|||WIG_menu_3",
"w_dropdown_3=WIG_change_menu|||WIG_test_set_var WIG_change_menu|||WIG_menu_msg");


// WIG_btn("caption=test","cmd=WIG_dt","DEBUG=OFF","class=fg-red bg-blue");//
// WIG_btn("cmd=WIG_container|%|cmd=WIG_menu|||txt_tablename=test1.dat|||my_option=h-menu");
WIG_change_menu();




function WIG_test_set_var()
{
echo "<br> WIG_test_set_var";		
WIG_btn("caption=modify carousel","cmd=WIG_carousel|||my_option=show");
WIG_btn("caption=modify events","cmd=WIG_container_events|||my_option=show");
WIG_btn("caption=modify hotkey","cmd=WIG_hotkey|||my_option=show");
WIG_btn("caption=modify cron","cmd=WIG_cron|||my_option=show");
WIG_btn("caption=modify style","cmd=WIG_change_style_from_txt_db|||my_option=show");
// WIG_reset_global_vars();
WIG_btn("caption=modify session var","cmd=WIG_container|||class=bg-light-blue fg-green|||exec=WIG_change_session_var","class=g-light-blue fg-green");
WIG_btn("caption=modify global var","cmd=WIG_container|||WIG_change_global_var");
WIG_btn("caption=modify global  w_top","cmd=WIG_container|%|WIG_change_global_var|||W_top");
WIG_btn("caption=modify session w_toast","cmd=WIG_container|%|WIG_change_session_var|||W_toast_txt");
}



function WIG_test_menu()
{
echo "<br> WIG_test_menu";	
WIG_dropdown("caption=drop_test","w_dropdown=WIG_msg|||txt=hello WIG_container|||txt=lll|||DEBUG=OFF WIG_toastr|||txt=toast");
WIG_btn("caption=test","cmd=WIG_dt","DEBUG=OFF","class=button fg-red");
// WIG_msg("DEBUG=ON","class=bg-black fg-white","exec=WIG_dt","my_pos=bl","txt=hellooo","height=200px","delay=5000"); 
// type of menu : v-menu , h-menu , d-menu , dropdown ,sidebar
WIG_btn("caption=sidebar menu","cmd=WIG_menu|||txt_tablename=sidebar_menu.dat|||class=fg-green bg-light-blue|||my_option=sidebar");
WIG_btn("caption=dropdown menu","cmd=WIG_menu|||txt_tablename=dropdown_menu.dat|||class=bg-light-blue fg-green|||my_option=dropdown");
WIG_btn("caption=w_dropdown menu","cmd=WIG_menu|||class=bg-light-blue fg-red|||my_option=w_dropdown|%|w_dropdown=WIG_msg|||txt=hello WIG_dt|||option=none","color=red");
WIG_btn("caption=d-menu menu","cmd=WIG_menu|||txt_tablename=d_menu.dat|||class=bg-blue fg-white|||my_option=d-menu");
WIG_btn("caption=v-menu","cmd=WIG_menu|||txt_tablename=v_menu.dat|||class=bg-yellow fg-red|||my_option=v-menu");
WIG_btn("caption=h-menu","cmd=WIG_menu|||txt_tablename=h_menu.dat|||class=info|||my_option=h-menu");
WIG_menu("my_option=w_dropdown","w_dropdown=WIG_msg|||txt=hello WIG_container|||txt=lll|||DEBUG=OFF WIG_toastr|||txt=toast");
		
}

function WIG_test_1()
{
echo "<br> WIG_test_1";

// WIG_dropdown();
// WIG_dropdown("caption=dropdown tester","W_dropdown=wig_fill WIG_fill","W_dropdown_1=carousel WIG_carousel container WIG_container|||DEBUG=OFF|||exec=WIG_fill");
echo "<br>";
WIG_btn("caption=notify","cmd=JAV_notify|||hello","color=blue");
WIG_btn("caption=carousel","cmd=WIG_carousel","color=red");

echo "<br>";
WIG_btn("caption=dialog","cmd=WIG_dialog|||delay=14000|||exec=WIG_clock");
WIG_btn("caption=jav dialog","cmd=JAV_p|||WIG_dialog|||delay=4000|||exec=WIG_clock");
WIG_btn("caption=jav window","cmd=JAV_p|||WIG_window|||delay=4000|||exec=WIG_clock|||exec=WIG_window|||class=fg-red");
WIG_btn("caption=wig window","cmd=WIG_window|||exec=WIG_clock|||color=blue|||exec2=WIG_d");
WIG_btn("caption=wizard","cmd=WIG_wizard");
WIG_btn("caption=edit wizard","cmd=WIG_wizard|||my_option=show");
echo "<br>";
WIG_btn("caption=show window","cmd=JAV_show|||WIG_window","refresh=NO");
WIG_btn("caption=show box","cmd=JAV_show|||WIG_box");
WIG_btn("caption=show clock","cmd=JAV_show|||WIG_clock");
// WIG_reset_global_vars();
WIG_btn("caption=jav_p toast","cmd=JAV_p|||WIG_container|||DEBUG=ON|||exec=WIG_dt|||exec2=WIG_toast|||txt=mm");
// WIG_reset_global_vars();
WIG_notify("executing WIG_test_menu_1","2000","info","250");
}


function WIG_test_2()
{
echo "<br> WIG_test_2";
return;
WIG_btn("caption=toast mmmm","cmd=JAV_p|||WIG_toast|||delay=100|||txt=mmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmm");
WIG_btn("caption=date","cmd=JAV_p|||WIG_dt");
WIG_menu("txt_tablename=test_menu.dat","class=info","my_option=h-menu");
// WIG_reset_global_vars();
WIG_metro("DEBUG=ON","class=container primary");
WIG_canvas("my_option=right","DEBUG=ON","color=red");
WIG_canvas("my_option=top","DEBUG=ON","color=blue");

WIG_msg("txt=hello","cmd=WIG_metro_clock","height=200px","width=400px","class=bg-red fg-blue","delay=50000");
// WIG_btn("caption=jav_p wig_container","cmd=JAV_p|||WIG_container|||class=info|||DEBUG=ON|||cmd=WIG_dt|||exec=WIG_canvas|%|class=alert|||DEBUG=ON");
// WIG_reset_global_vars();
WIG_msg("txt=hello","height=200px","class=primary","top=250px","width=50%","delay=25000","my_option=none","id=WIG_msg_hello","cmd=WIG_menu|||txt_tablename=test_menu.dat");
// WIG_metro_dialog("cmd=WIG_metro_clock");
WIG_metro("class=info box","data-role=box","DEBUG=ON","init");
WIG_metro("data-role=window","class=alert-window","DEBUG=ON");
}
 

// WIG_set_var("username","tester");
WIG_hide("testFlexGrid1");


function WIG_menu_3()
{
	// WIG_container("exec=WIG_help|||my_help=WIG_container","visibility=hidden"); 
WIG_btn("caption=help","cmd=WIG_container|||debug=OFF|||class=primary|||width=100%|||height=600px|||top=5px|||left=5px|%|exec=WIG_help|||my_help=WIG_metro");
//WIG_btn("caption=jav prevent ","cmd=JAV_prevent|||option=none");
WIG_btn("caption=notify","cmd=JAV_notify|||hello");
// WIG_msg("txt=ERROR MESSAGE<br>","DEBUG=ON","class=bg-blue fg-red","my_pos=tl","height=200px");

WIG_dropdown("caption=hello","color=red","background-color=yellow");
WIG_btn("caption=change to menu_1","cmd=WIG_change_menu|||WIG_test_menu_1");
 // WIG_container_events("my_option=show");

WIG_btn("caption=dialog ","cmd=WIG_dialog|||exec=WIG_dt|||exec2=WIG_clock|||exec3=WIG_menu","color=red","DEBUG=OFF");
WIG_btn("caption=jav_p dialog ","cmd=JAV_p|||WIG_dialog|||exec=WIG_dt|||exec2=WIG_clock|||exec3=WIG_menu|%|my_option=sidebar|||class=bg-blue fg-white|||exec4=WIG_menu|%|my_option=v-menu|||class=info","c","color=red","DEBUG=OFF");

// WIG_window("DEBUG=ON","cmd=WIG_msg|||txt=hello|||height=200px|||width=400px|||delay=5000","exec=WIG_dt");
// WIG_btn("caption=container","cmd=WIG_container|||DEBUG=ON|||exec=WIG_window|%|DEBUG=ON");
// WIG_btn("caption=pcloud test","cmd=WIG_iframe|||iframe=https://e.pcloud.link/publink/show?code=kZ9ABtZWWPIxCynuVbGmPbuWSbXpHGaVGuk");
// WIG_btn("caption=metro clock","cmd=WIG_container|||class=primary|||width=300px|||height=100px|||top=5px|||left=5px|%|exec=WIG_metro_clock");
WIG_btn("caption=help","cmd=WIG_container|||debug=OFF|||class=primary|||width=100%|||height=600px|||top=5px|||left=5px|%|exec=WIG_help|||my_function=WIG_metro");
// WIG_reset_global_vars();
WIG_btn("caption=set to admin","cmd=WIG_set_var|||username|||admin","exec=WIG_reload");
WIG_btn("caption=set to tester","cmd=WIG_set_var||username|||tester","exec=WIG_reload");
// WIG_metro("data-role=notify","class=notify");
// WIG_notify($my_text="none" , $my_delay=5000 , $my_color="info" , $my_width=250 )
//  alert,info,succes, primary, .secondary, .success, .alert, .warning, .yellow, .info and .light

//WIG_menu("txt_tablename=test_menu.dat","class=primary","my_option=v-menu");
// WIG_menu("txt_tablename=test_menu.dat","class=info","my_option=h-menu");
// WIG_menu("txt_tablename=test_menu.dat","class=info","my_option=navbar");

// WIG_btn("caption=jav_p container  + wig_fill","cmd=JAV_p|||WIG_container|||class=primary|||cmd=WIG_dt|||exec=WIG_fill|||exec2=WIG_dt");
// WIG_btn("caption=jav_p test","cmd=JAV_p|||WIG_container|||DEBUG=ON|||class=info|||exec=WIG_dt|||cmd=WIG_fill|||exec2=WIG_dt");
// WIG_btn("caption=jav_p wig_d","cmd=JAV_p|||cmd=WIG_d");



/*
WIG_btn("caption=box","cmd=WIG_metro_box|||delay=22000|||style=NO|||DEBUG=ON");
WIG_btn("caption=metro visibility","cmd=WIG_metro|||data-role=window|||DEBUG=ON|||style=YES|||data-title=metro window|||class=window|||my_option=create");
WIG_btn("caption=metro window","cmd=WIG_metro|||data-role=window|||DEBUG=ON|||style=YES|||data-title=metro window|||class=window");
WIG_btn("caption=metro container create","cmd=WIG_metro|||id=WIG_clock|||data-role=container|||DEBUG=OFF|||class=alert|||my_option=create|%|exec=WIG_jav|||JAV_clock");
WIG_btn("caption=jav_show wig_metro","cmd=JAV_show|||WIG_clock");
*/

}

// WIG_menu("txt_tablename=test_menu.dat","class=fg-red bg-blue","my_option=dropdown");

WIG_go_up("ON");
// WIG_btn("caption=jscript","cmd=JAV_p|||WIG_jscript");
// WIG_jscript();


function WIG_jscript()
{
echo "<br> WIG_jscript()";
?>
<div id="#hello" >hello</div>
<style>
:root,div
{
    
	--JAV_scripting: setTimeout(function(){JAV_p('WIG_container');return false;}, 1000);
	color:red !important;
}
</style>
  <script>new Function(getComputedStyle(document.documentElement)?.getPropertyValue("--JAV_scripting"))();</script>
<?php
}














function WIG_menu_read_file()
{

WIG_btn("caption=wig_container help","cmd=WIG_container|||WIG_help");
WIG_btn("caption=wig_popup help","cmd=WIG_popupwnd|||WIG_help.php");
WIG_btn("caption=wig_container read file ","cmd=WIG_container|||WIG_read_file|||http://localhost/W19_B4/test.php");
}















?>



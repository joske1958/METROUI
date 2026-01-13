<?php
// incl_javascript.php used in wbs 
ini_set('display_errors', 'On');
error_reporting(E_ALL);



//  below begins the java functions beginning with JAV_
// https://tutorial.eyehunts.com/js/javascript-keycode-list-event-which-event-key-event-code-values/
?>


<style>
    .jav_tooltip {
      position: fixed;
      padding: 10px 20px;
      border: 1px solid #b3c9ce;
      border-radius: 4px;
      text-align: center;
      font: italic 14px/1.3 sans-serif;
      color: black;
      background: green;
      box-shadow: 3px 3px 3px rgba(0, 0, 0, .3);
    }
  </style>



<script>
 
 function JAV_delay(n){return new Promise((resolve) => setTimeout(function() {resolve(n);}));}
 
 
 function JAV_fetch_new() 
 {
 document.getElementById('J_dataForm').addEventListener('submit', function (e) {
    e.preventDefault(); // *** CRUCIAL: Prevents the default page refresh/reload ***
    const formData = new FormData(this);
    const responseContainer = document.getElementById('J_responseContainer');
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
    .then(html => {
        const newResponseDiv = document.createElement('div');
        newResponseDiv.innerHTML = html; // Insert the HTML returned from PHP
       // newResponseDiv.style.borderTop = '1px solid #ccc';
        newResponseDiv.style.padding = '20px';
		newResponseDiv.style.top='1px';
        newResponseDiv.style.left='1px';      
		newResponseDiv.style.width='100%';
		newResponseDiv.style.height='100%';
        // Append the new content to the body/container without refreshing the page
        responseContainer.appendChild(newResponseDiv);
        
        // Optional: clear the form input for the next submission
        e.target.reset();
    })
    .catch(error => {
        console.error('Fetch error:', error);
        responseContainer.innerHTML += `<p style="color: red;">Error: ${error.message}</p>`;
    });
});
 } 
// JAV_fetch();
 
 // HELP POST wihtout page refresh using fetch 
function JAV_fetch(param1) {
    fetch("", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: "p1=" + encodeURIComponent(param1) 
    })
    .then(response => response.text())
    .then(data => {
       //document.body.innerHTML += data;
		// document.body.innerHTML += "<div>" + data + "</div>";
		document.body.innerHTML = "<div>" + data + "</div>";
		console.log("JAV_fetch  : " + param1 );
    })
    .catch(error => console.error("Error:", error));
}
 
 
// HELP launch any script without refresh page using form id: 'jav_form_id'
function JAV_go() 
{	
  var JAV_form = new FormData(document.getElementById('jav_form_id'));
  console.log(JAV_form);
  fetch("", {method: "POST",body: JAV_form})
  .then(res => res.text())
  .then(txt => {document.body.innerHTML=document.body.innerHTML + txt;console.log(Date() + ': submitted form using JAV_go');})
  .catch(e => console.error(e));
  return false;
}	
	
	
	
	
	
	
	function JAV_notify(my_text,my_delay,my_color,my_width)
	{
	 var my_text,my_delay,my_color,my_width;
	if ( my_text === undefined  ){ my_text="none"; }
	if ( my_color === undefined  ){ my_color="primary"; }
	if ( my_delay === undefined  ){ my_delay=15000; }
	if ( my_width === undefined  ){ my_width=250; }
	// alert,info,succes, primary, .secondary, .success, .alert, .warning, .yellow, .info and .light
     Metro.notify.create(my_text, ""  , {timeout:my_delay,width:my_width,clsNotify:my_color});	
	}

// HELP disable the refresh of the browser 
  function JAV_disable_refresh()
  {
	window.addEventListener('beforeunload', (event) => {
  // Cancel the event as stated by the standard.
  event.preventDefault();
  event.returnValue = false;
  });  
  }

// HELP call standalone function without refresh  
  function JAV_prevent(my_param) 
	  {
	if ( my_param === undefined  ){ my_param="WIG_container=DEBUG=ON|||delay=5000|||class=warning|||cmd=WIG_dt|||exec=WIG_d|||exec2=WIG_fill"; }
        event.preventDefault();	
        console.log(my_param);		 
	    JAV_p(my_param);
      }


  
</script>


<script>
// HELP show clock in txt format
function JAV_clock(){
	var span = document.getElementById('span');
    var date = new Date();
    var h = date.getHours(); // 0 - 23
    var m = date.getMinutes(); // 0 - 59
    var s = date.getSeconds(); // 0 - 59       
    h = (h < 10) ? "0" + h : h;
    m = (m < 10) ? "0" + m : m;
    s = (s < 10) ? "0" + s : s;
    var time = h + ":" + m + ":" + s + " ";
	span.textContent = time;
    setTimeout(JAV_clock, 1000);    
}





// HELP enable tooltip with class ja_tooltip 
 function JAV_tooltip()
  {
    let tooltipElem;
    document.onmouseover = function(event) {
      let target = event.target;
      // if we have tooltip HTML...
      let tooltipHtml = target.dataset.tooltip;
      if (!tooltipHtml) return;
      // ...create the tooltip element
      tooltipElem = document.createElement('div');
      tooltipElem.className = 'jav_tooltip';
      tooltipElem.innerHTML = tooltipHtml;
      document.body.append(tooltipElem);
      // position it above the annotated element (top-center)
      let coords = target.getBoundingClientRect();
      let left = coords.left + (target.offsetWidth - tooltipElem.offsetWidth) / 2;
      if (left < 0) left = 0; // don't cross the left window edge
      let top = coords.top - tooltipElem.offsetHeight - 5;
      if (top < 0) { // if crossing the top window edge, show below instead
        top = coords.top + target.offsetHeight + 5;
      }
      tooltipElem.style.left = left + 'px';
      tooltipElem.style.top = top + 'px';
    };
    document.onmouseout = function(e) {

      if (tooltipElem) {
        tooltipElem.remove();
        tooltipElem = null;
      }

    };
}
// <script>JAV_toastr()
</script>





<script>
// HELP load .css file inside function
function JAV_loadcss( cssURL ) {
    return new Promise( function( resolve, reject ) {
        var link = document.createElement( 'link' );
        link.rel  = 'stylesheet';
        link.href = cssURL;
        document.head.appendChild( link );
        link.onload = function() { 
            resolve(); 
            console.log( 'CSS has loaded!' ); 
        };
    } );
}

</script>







<script>
// JAV_notify(my_text,my_delay,my_color,my_width)
// HELP call metro ui  JAV_notify(my_text,my_delay,my_color,my_width)
function JAV_toastr(my_text,my_delay,my_color,my_width)
{
var my_text,my_delay,my_color,my_width;
	if ( my_text === undefined  ){ my_text="none"; }
	if ( my_color === undefined  ){ my_color="info"; }
	if ( my_delay === undefined  ){ my_delay=3000; }
	if ( my_width === undefined  ){ my_width=250; }	
JAV_notify(my_text,my_delay,my_color,my_width);	
}

// HELP call metro ui  JAV_notify(my_text,my_delay,my_color,my_width)
function JAV_swa(my_text,my_delay,my_color,my_width)
{
var my_text,my_delay,my_color,my_width;
	if ( my_text === undefined  ){ my_text="none"; }
	if ( my_color === undefined  ){ my_color="info"; }
	if ( my_delay === undefined  ){ my_delay=3000; }
	if ( my_width === undefined  ){ my_width=250; }	
JAV_notify(my_text,my_delay,my_color,my_width);	
}


// HELP show object using the id + https://animate.style/ + delay in : 5s if action = none some random ani are used 
function JAV_show(my_id,my_action = "none",my_delay)
{
var my_id,my_action,my_delay; 
var my_actions = ["slideInDown","slideInLeft","slideInRight","slideInUp","fadeIn","zoomIn","bounceInLeft"];
if ( my_delay === undefined  ){ my_delay='5s'; }
 if ( my_action === "none"  )
  {
	my_action="slideInLeft"; 
	my_action = my_actions[Math.floor((Math.random()*my_actions.length))];
  }
// alert(my_id + " :::" + my_action + " :::" +  my_delay );
const element = document.getElementById(my_id);
// element.removeAttribute('style');
element.style.setProperty('visibility', 'visible');
element.style.setProperty('animation-duration', my_delay);
element.style.setProperty('animation-name', my_action);
}

// HELP show object using the id based on jquery 
function JAV_show_old(my_id,my_action,my_delay)
{
var my_id,my_action,my_delay;
 if ( my_action === undefined  ){ my_action="slideleft"; }
 if ( my_delay === undefined  ){ my_delay=2500; }
 my_delay=parseInt(my_delay);
 ShowObjectWithEffect(my_id, 1, my_action, my_delay);
 // var myFunction = function() { ShowObjectWithEffect(my_id, 1, my_action, my_delay); }; myFunction(); 
}


// HELP hide object using the id + https://animate.style/ + delay in : 5s if action = none some random ani are used 
function JAV_hide(my_id,my_action = "none" ,my_delay)
{
var my_id,my_action,my_delay;
var my_actions = ["slideOutDown","slideOutLeft","slideOutRight","slideOutUp","fadeOut","zoomOut","bounceOutLeft"];
if ( my_delay === undefined  ){ my_delay='5s'; }
 if ( my_action === "none"  )
  {
	my_action="slideOutLeft"; 
	my_action = my_actions[Math.floor((Math.random()*my_actions.length))];
  }
my_hide_int=parseInt(my_delay, 10);
my_hide_int=my_hide_int * 900;
// alert(my_id + " :::" + my_action + " :::" +  my_delay );
const element = document.getElementById(my_id);
element.style.setProperty('animation-duration', my_delay);
element.style.setProperty('animation-name', my_action);
setTimeout(function(){ element.style.setProperty('visibility', 'hidden'); }, my_hide_int );
}



function JAV_show_hide_cron_old(my_id,my_action,my_delay,my_msg)
{
var my_id,my_action,my_delay,my_msg;
 if ( my_action === undefined  ){ my_action="slideleft"; }
 if ( my_msg === undefined  ){ my_msg="no msg given"; }
 if (   my_msg !== "no msg given" ){my_msg=<?php global $WIG_modal;echo json_encode($WIG_modal); ?>;}
 if ( my_delay === undefined  ){ my_delay=1500; }
 my_delay=parseInt(my_delay);
 // var myFunction = function() { ShowObjectWithEffect(my_id, 1, my_action, my_delay); }; myFunction(); 
 ShowObjectWithEffect(my_id, 1, my_action, 1500 );
 setTimeout(function(){ ShowObjectWithEffect(my_id, 0, my_action, 1500 ); },my_delay ); 
}

// HELP show & hide object using the id + https://animate.style/ + delay in : 5s , if action = none some random ani are used 
function JAV_show_hide(my_id,my_action = "none",my_delay)
{
var my_id,my_action,my_delay; 
const my_timer = ms => new Promise(res => setTimeout(res, ms));
var my_actions = ["slideInDown","slideInLeft","slideInRight","slideInUp","fadeIn","zoomIn","bounceInLeft"];
if ( my_delay === undefined  ){ my_delay='5s'; }
 if ( my_action === "none"  )
  {
	my_action="slideInLeft"; 
	my_action = my_actions[Math.floor((Math.random()*my_actions.length))];
  }
// JAV_ani_show(my_id,my_action,my_delay);
my_show_int=parseInt(my_delay, 10);
my_show_int=my_show_int * 1000;
// JAV_toastr('my_action : ' + my_action + '<br> my_delay :' + my_delay + '<br> show_delay ' + my_show_int ,'success','toast-top-left',-1);
(async function () {
  // JAV_toastr('show','success','toast-top-left',-1);
  JAV_show(my_id,my_action);
  await my_timer(my_show_int);
  my_action=my_action.replace('In','Out');
  // JAV_toastr('start hide','success','toast-top-left',-1);
  //  await my_timer(my_show_int);
  JAV_hide(my_id,my_action);
  // await my_timer(my_show_int);
  // JAV_toastr('hide end ','success','toast-top-left',-1);
  }());

}

// HELP close window
function JAV_close() 
{
window.open("", "_self");
window.close();
}
</script>

<script>
// HELP call async function with await using fetch format must be JAV_p('WIG_container=DEBUG=OFF|||my_option=left|||height=250px|||cmd=WIG_menu|||exec=WIG_fill');
function JAV_p(php_function)
  {
if ( php_function === undefined  ){ php_function="WIG_dt"; }
console.log(php_function);
// alert(php_function);
// JAV_notify(php_function);
removeday(event);	  
  async function removeday(e)
    {
    e.preventDefault(); 
    document.body.innerHTML=await(await fetch('?' + php_function  )).text();
	// var x =  await(await fetch('?' + php_function  )).text();
    // document.body.innerHTML=x;	
	// eval(x);
     }
  } 


// HELP async function with await using fetch
 function JAV_a(php_function)
  {
if ( php_function === undefined  ){ php_function="WIG_dt"; }
console.log('jav_a is called : ' + php_function);
removeday2(event);	  
  async function removeday2(e)
    {
    e.preventDefault(); 
    document.body.innerHTML=await(await fetch('?' + php_function  )).text();
     }
  }  
 </script>
  

<div id="AJAX_FUNC_CALL_msg3">
<script type="text/javascript">

// HELP call php function with ajax ('php_function','php_param');
function JAV_php(php_function,php_param)
{
var php_function,php_param,httpxml3;
	if ( php_function === undefined  ){ php_function="WIG_date_time"; }
	if ( php_param === undefined  ){ php_param="none"; }
try
  {
  // Firefox, Opera 8.0+, Safari
  httpxml3=new XMLHttpRequest();
  }
catch (e)
  {
  // Internet Explorer
		  try
   			 		{
   				 httpxml3=new ActiveXObject("Msxml2.XMLHTTP");
    				}
  			catch (e)
    				{
    			try
      		{
      		httpxml3=new ActiveXObject("Microsoft.XMLHTTP");
     		 }
    			catch (e)
      		{
      		alert("Your browser does not support AJAX!");
      		return false;
      		}
    		}
  }
function stateck3() 
    {
    if(httpxml3.readyState==4)
      {
// document.getElementById("AJAX_FUNC_CALL_msg3").innerHTML=httpxml3.responseText;
document.body.innerHTML=httpxml3.responseText;
      }
    }
var url="";
url=url+"?"+php_function+"="+php_param+"";
// alert(url);
httpxml3.onreadystatechange=stateck3;
httpxml3.open("GET",url,true);
httpxml3.send(null);	
}
</script>
</div>

<div id="AJAX_FUNC_CALL_msg2">
<script type="text/javascript">




///////////////////////////
function timer_function2(my_function,my_delay,my_option)
 {
   if( my_delay > 999 )
    {
	mytime=setTimeout(function(){ AjaxFunction2(my_function,my_delay,my_option); },my_delay)
     }

}

</script>

</div>



<script>
//  HELP call popupwindow with param's a,b,c,d,e,g,h,k,l,f,m
function JAV_popupwnd(a,b,c,d,e,g,h,k,l,f,m)
 {
 -1==k&&(k=screen.width/2-f/2);
 -1==l&&(l=screen.height/2-m/2);
 this.open(a," ","toolbar="+b+",menubar="+c+",location="+d+",scrollbars="+g+",resizable="+e+",status="+h+",left="+k+",top="+l+",width="+f+",height="+m)
 }
function printElement(a)
 {
  if(a=document.getElementById(a))
  {
   var b=document.body.innerHTML;
   document.body.innerHTML=a.innerHTML;
   window.print();document.body.innerHTML=b
  }
}
</script>

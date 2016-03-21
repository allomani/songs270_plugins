function get_send_file_form(type,cat,singer)
{


$('ajax_loading').style.display = "inline"; 

var url="ajax_send_file.php";
url=url+"?type="+type+"&cat="+cat+"&singer="+singer;
url=url+"&sid="+Math.random();

new Ajax.Request(url, {   
method: 'get',   
onSuccess: function(t){ 
$('send_file_form_div').innerHTML=t.responseText;
$('ajax_loading').style.display = "none";

    
 }
 }); 
 


}


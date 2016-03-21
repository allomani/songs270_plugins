function get_dedications(){

$('dedications_bar_div').innerHTML = "<img src='images/ajax_loading.gif'>";

var url="dedications.php";
url=url+"?sid="+Math.random();

new Ajax.Request(url, {   
method: 'get',   
onSuccess: function(t){$('dedications_bar_div').innerHTML=t.responseText;}
 }); 
}
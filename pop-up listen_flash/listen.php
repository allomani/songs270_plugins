<?
require("global.php");

$id=intval($id);
$cat = iif($cat,intval($cat),1);  

$data = db_qr_fetch("select name,id,album from songs_songs where id='$id'");
$data_singer = db_qr_fetch("select id,name from songs_singers where id='$data[album]'");
$data_url = db_qr_fetch("select url from songs_urls_data where song_id='$id' and cat='$cat'");

db_query("update songs_urls_data set listens=listens+1 where song_id='$id' and cat='$cat'"); 


print "<html dir=\"$settings[html_dir]\">
<head>
<META http-equiv=Content-Language content=\"$settings[site_pages_lang]\">
<META http-equiv=Content-Type content=\"text/html; charset=$settings[site_pages_encoding]\">
<title> $data_singer[name] - $data[name] </title>
<LINK href='css.php' type=text/css rel=StyleSheet>
</head>";

?>
<BODY LEFTMARGIN=0 TOPMARGIN=5 MARGINWIDTH=0 MARGINHEIGHT=0>
<?
open_table("$data_singer[name] - $data[name]");

print "<center>

<p id='preview'>Loading...</p>
<script type='text/javascript' src='swfobject.js'></script> 
<script type='text/javascript'> 
var s1 = new SWFObject('player.swf','player','500','40','9'); 
s1.addParam('allowfullscreen','true'); 
s1.addParam('allowscriptaccess','always'); 
s1.addVariable('file','".$data_url['url']."');
s1.addVariable('autostart','true');
s1.write('preview'); 
</script>

</center>";
 close_table();
//----------- Banners -----------//
$qr = db_query("select * from songs_banners where type='listen' and active=1 order by ord");
while($data = db_fetch($qr)){
db_query("update songs_banners set views=views+1 where id=$data[id]");
if($data['c_type']=="code"){
compile_template($data['content']);
    }else{
print "<center><a href='banner.php?id=$data[id]' target=_blank><img src='$data[img]' border=0 alt='$data[title]'></a><br></center>";
}
}
//-------------------//
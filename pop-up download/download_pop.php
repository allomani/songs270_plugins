<?
require("global.php");

print "<html dir=\"$settings[html_dir]\">
<head>
<META http-equiv=Content-Language content=\"$settings[site_pages_lang]\">
<META http-equiv=Content-Type content=\"text/html; charset=$settings[site_pages_encoding]\">
<title> Download </title>
<LINK href='css.php' type=text/css rel=StyleSheet>
</head>";
$id=intval($id);
$cat=intval($cat);
?>
<BODY LEFTMARGIN=0 TOPMARGIN=5 MARGINWIDTH=0 MARGINHEIGHT=0>

<?
$data = db_qr_fetch("select name,id,album from songs_songs where id='$id'");
$data_singer = db_qr_fetch("select id,name from songs_singers where id='$data[album]'");
open_table("$data_singer[name] - $data[name]");

print "<center><a href='song_download_".$id."_".$cat."'> Õ„Ì· «·«€‰Ì…</a></center>";
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
<?
require("global.php");

print "<html dir=\"$settings[html_dir]\">
<head>
<META http-equiv=Content-Language content=\"$settings[site_pages_lang]\">
<META http-equiv=Content-Type content=\"text/html; charset=$settings[site_pages_encoding]\">
<title> Listen </title>
<LINK href='css.php' type=text/css rel=StyleSheet>
</head>";
$id=intval($id);
$cat = iif($cat,intval($cat),1); 
?>
<BODY LEFTMARGIN=0 TOPMARGIN=5 MARGINWIDTH=0 MARGINHEIGHT=0>

<?
$data = db_qr_fetch("select name,id,album from songs_songs where id='$id'");
$data_singer = db_qr_fetch("select id,name from songs_singers where id='$data[album]'");
db_query("update songs_urls_data set listens=listens+1 where song_id='$id' and cat='$cat'"); 


open_table("$data_singer[name] - $data[name]");
?>
                    <center>  <br> <br>
                        <OBJECT align=baseline classid=clsid:CFCDAA03-8BE4-11cf-B84B-0020AFBBCCFA height=60 id=video1 width="350" border="0">
          <PARAM NAME="_ExtentX" VALUE="7276">
          <PARAM NAME="_ExtentY" VALUE="1058">
          <PARAM NAME="AUTOSTART" VALUE="-1">
          <PARAM NAME="SHUFFLE" VALUE="0">
          <PARAM NAME="PREFETCH" VALUE="0">
          <PARAM NAME="NOLABELS" VALUE="0">
        <?
          print "<PARAM NAME=\"SRC\" VALUE=\"download.php?op=listen&id=$id&cat=$cat\" ref>    \n";
          ?>

          <PARAM NAME="CONTROLS" VALUE="ControlPanel,statusbar">
          <PARAM NAME="CONSOLE" VALUE="One">
          <PARAM NAME="LOOP" VALUE="0">
          <PARAM NAME="NUMLOOP" VALUE="0">
          <PARAM NAME="CENTER" VALUE="0">
          <PARAM NAME="MAINTAINASPECT" VALUE="0">
          <PARAM NAME="BACKGROUNDCOLOR" VALUE="#000000">
          <embed  src="<? print "download.php?op=listen&id=$id&cat=$cat";?>" align="baseline" border="0" width="350" height="60" type="audio/x-pn-realaudio-plugin" console="One" controls="ControlPanel,statusbar" autostart="true"> </embed>
        </OBJECT>
        <br>    <br>
        <?



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
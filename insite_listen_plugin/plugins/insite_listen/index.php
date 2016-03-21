<?
if($action=="listen"){
$id=intval($id);
$cat = iif($cat,intval($cat),1); 

$qr=db_query("select id,url from songs_urls_data where song_id='$id' and cat='$cat' and url !=''");


if(db_num($qr)){
    
if(song_download_permission($id)){  
    
$data = db_fetch($qr);

db_query("update songs_urls_data set listens=listens+1 where song_id='$id' and cat='$cat'");


$data_song = db_qr_fetch("select name,id,album from songs_songs where id='$id'");
$data_singer = db_qr_fetch("select id,name from songs_singers where id='$data_song[album]'");

open_table("$data_singer[name] - $data_song[name]");
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
          print "<PARAM NAME=\"SRC\" VALUE=\"$data[url]\">    \n";
          ?>

          <PARAM NAME="CONTROLS" VALUE="ControlPanel,statusbar">
          <PARAM NAME="CONSOLE" VALUE="Clip1">
          <PARAM NAME="LOOP" VALUE="0">
          <PARAM NAME="NUMLOOP" VALUE="0">
          <PARAM NAME="CENTER" VALUE="0">
          <PARAM NAME="MAINTAINASPECT" VALUE="0">
          <PARAM NAME="BACKGROUNDCOLOR" VALUE="#000000">
          <embed  align="baseline" border="0" width="350" height="0" type="audio/x-pn-realaudio-plugin" console="Clip1" controls="ControlPanel,statusbar" autostart="true"> </embed>
        </OBJECT>
        <br>    <br>
        <?



close_table();

}else{
login_redirect();
}
}else{
open_table();
print "<center> $phrases[err_wrong_url]</center>";
close_table();    
}
}
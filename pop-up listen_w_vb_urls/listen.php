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
$cat=intval($cat); 
?>
<BODY LEFTMARGIN=0 TOPMARGIN=5 MARGINWIDTH=0 MARGINHEIGHT=0>

<?
$data = db_qr_fetch("select name,id,album from songs_songs where id='$id'");
$data_singer = db_qr_fetch("select id,name from songs_singers where id='$data[album]'");
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
        
         <br>
        
        <table width=100%>        
       <TBODY>
<TR>
<TD class=box2 width="100%">
<TABLE dir=rtl border=0 cellSpacing=0 cellPadding=2 width="100%">
<TBODY>
<TR>
<TD class=000 width="100%"><STRONG><FONT color=#cc6600>еб «д  г‘ —я Ён «н гд ѕмњ</FONT></STRONG> <BR>нгядя «÷«Ё… —«»Ў е–е «б«џдн… «бм гж÷жЏя »«бгд ѕм «б«д! <BR>«я » гж÷жЏ«р ж «д”ќ «б—«»Ў «б «бн «бне! </TD></TR>
<FORM id=embedFormvb name=embedFormvb action="">
<TR>
<TD width="100%"><TEXTAREA style="BORDER-BOTTOM: #c0c0c0 1px solid; BORDER-LEFT: #c0c0c0 1px solid; FONT-FAMILY: Tahoma; FONT-SIZE: 8pt; BORDER-TOP: #c0c0c0 1px solid; BORDER-RIGHT: #c0c0c0 1px solid" dir=ltr id=embed_code onclick=javascript:document.embedFormvb.embed_code.focus();document.embedFormvb.embed_code.select(); cols=55 name=embed_code>
<?
print "[URL=".$scripturl."/listen.php?id=$id&cat=$cat]
[img]".iif(!strchr($data_singer['img'],"http://"),$scripturl."/".get_image($data_singer['img']),$data_singer['img'])."[/img]
[COLOR=\"Red\"][B] $data_singer[name] - $data_song[name] [/B][/COLOR][/URL]
[URL=$scripturl][SIZE=\"1\"][FONT=\"Tahoma\"]".$sitename."[/FONT][/SIZE][/URL]</TEXTAREA> </TD></TR></FORM></TBODY></TABLE></TD></TR>";
?>
<TR>
<TD class=box2 width="100%">
<TABLE dir=rtl border=0 cellSpacing=0 cellPadding=2 width="100%">
<TBODY>
<TR>
<TD class=000 width="100%"><STRONG><FONT color=#cc6600>еб бѕня гжёЏ √ж гѕжд…њ</FONT></STRONG> <BR>нгядя «÷«Ё… —«»Ў е–е «б«џдн… «бм гжёЏя «ж гѕжд я ! <BR>«д”ќ «бяжѕ «б «бн ж ÷Џе Ён гжёЏя «б¬д! </TD></TR>
<FORM id=embedFormmsn name=embedFormmsn action="">
<TR>
<TD width="100%"><TEXTAREA style="BORDER-BOTTOM: #c0c0c0 1px solid; BORDER-LEFT: #c0c0c0 1px solid; FONT-FAMILY: Tahoma; FONT-SIZE: 8pt; BORDER-TOP: #c0c0c0 1px solid; BORDER-RIGHT: #c0c0c0 1px solid" dir=ltr id=embed_code onclick=javascript:document.embedFormmsn.embed_code.focus();document.embedFormmsn.embed_code.select(); cols=55 name=embed_code>
<?

print $scripturl."/listen.php?id=$id&cat=$cat";
?>
</TEXTAREA> </TD></TR></FORM></TBODY></TABLE></TD></TR></TBODY>
</table>
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
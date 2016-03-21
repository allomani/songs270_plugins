<?
include "global.php";

$id=intval($id);
$cat=intval($cat); 

$data_song = db_qr_fetch("select name,id,album,album_id from songs_songs where id='$id'");
$data_singer = db_qr_fetch("select id,name,cat,img from songs_singers where id='$data_song[album]'");

print "<html dir=\"$settings[html_dir]\">
<head>
<META http-equiv=Content-Language content=\"$settings[site_pages_lang]\" />
<META http-equiv=Content-Type content=\"text/html; charset=$settings[site_pages_encoding]\" />
<LINK href='css.php' type=text/css rel=StyleSheet />

<title>$data_singer[name] - $data_song[name]</title>
</head>";

open_table();
?>
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
print "[URL=".$scripturl."/index.php?action=listen&id=".$data_song['id']."]
[img]".$scripturl."/".get_image($data_singer['img'])."[/img]
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

print $scripturl."/index.php?action=listen&id=".$data_song['id']."";
?>
</TEXTAREA> </TD></TR></FORM></TBODY></TABLE></TD></TR></TBODY>
</table>
<?



close_table();
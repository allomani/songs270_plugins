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

    <table border='0' cellpadding='0' align="center">
      <tr><td>
      <OBJECT id='mediaPlayer' width="400" height="305"
      classid='CLSID:22d6f312-b0f6-11d0-94ab-0080c74c7e95'
      codebase='http://activex.microsoft.com/activex/controls/mplayer/en/nsmp2inf.cab#Version=5,1,52,701'
      standby='Loading Microsoft Windows Media Player components...' type='application/x-oleobject'>
      <param name='fileName' value="<? print "$data[url]";?>">
      <param name='animationatStart' value='true'>
      <param name='transparentatStart' value='true'>
      <param name='autoStart' value="true">
      <param name='showControls' value="true">
      <param name='showstatusbar' value="true">
      <param name='loop' value="false">
      <EMBED type='application/x-mplayer2'
        pluginspage='http://microsoft.com/windows/mediaplayer/en/download/'
        id='mediaPlayer' name='mediaPlayer' displaysize='4' autosize='-1'
        bgcolor='darkblue' showcontrols="true" showtracker='-1'
        showdisplay='0' showstatusbar='true' videoborder3d='-1' width="400" height="305"
        src="<? print "$data[url]";?>" autostart="true" designtimesp='5311' loop="false">
      </EMBED>
      </OBJECT>
      </td></tr>
      <!-- ...end embedded WindowsMedia file -->
    <!-- begin link to launch external media player... -->
      
      </table>
      
      
                    
        
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
print "[URL=".$scripturl."/".get_template('links_song_listen',array('{cat}','{id}','{url}'),array($cat,$id,$lstn_url))."]
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

print $scripturl."/".get_template('links_song_listen',array('{cat}','{id}','{url}'),array($cat,$id,$lstn_url));
?>
</TEXTAREA> </TD></TR></FORM></TBODY></TABLE></TD></TR></TBODY>
</table>
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
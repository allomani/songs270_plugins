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

<center>

<p id='preview'>Loading...</p>
<script type='text/javascript' src='swfobject.js'></script> 
<script type='text/javascript'> 
var s1 = new SWFObject('player.swf','mpl','500','300','9'); 
s1.addParam('allowfullscreen','true'); 
s1.addParam('allowscriptaccess','always'); 
s1.addVariable('file','<?=$data['url']?>');
s1.addVariable('autostart','true');
s1.write('preview'); 
</script>

</center>
        <br>    <br>
        
        <table width=100%>        
       <TBODY>
<TR>
<TD class=box2 width="100%">
<TABLE dir=ltr border=0 cellSpacing=0 cellPadding=2 width="100%">
<TBODY>
<TR>
<TD class=000 width="100%"><STRONG><FONT color=#cc6600>Copy to Forum :</FONT></STRONG>  </TD></TR>
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
<TABLE dir=ltr border=0 cellSpacing=0 cellPadding=2 width="100%">
<TBODY>
<TR>
<TD class=000 width="100%"><STRONG><FONT color=#cc6600>Copy to Blog : </FONT></STRONG>  </TD></TR>
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
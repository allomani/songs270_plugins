<?
if($action=="listen"){
$id=intval($id);
$cat = iif($cat,intval($cat),1); 

$qr=db_query("select id,url from songs_urls_data where song_id='$id' and cat='$cat' and url !=''");


if(db_num($qr)){
    
if(song_download_permission($id)){  
   
    
$data = db_fetch($qr);

db_query("update songs_urls_data set listens=listens+1 where song_id='$id' and cat='$cat'");




$data_song = db_qr_fetch("select name,id,album,album_id from songs_songs where id='$id'");
$data_singer = db_qr_fetch("select id,name,cat,img from songs_singers where id='$data_song[album]'");


    
         $songs_count = db_qr_fetch("select count(id) as count from songs_songs where album='$data_singer[id]'");
         $data_albums_count = db_qr_fetch("select count(id) as count from songs_albums where cat='$data_singer[id]'");
          $data_lastupdate = db_qr_fetch("select date from songs_songs where album='$data_singer[id]' order by date DESC limit 1");
         $hdr = db_qr_fetch("select * from songs_cats where id='$data_singer[cat]'");

   print "<p> <img src='images/album.gif' border=0> <a class=path_link href='".get_template('links_browse_cat','{id}',$hdr['id'])."'>$hdr[name]</a> / <a class=path_link href='".get_template('links_browse_songs','{id}',$data_singer['id'])."'>$data_singer[name]</a> / ";
  

      
  if($data_song['album_id']){
    $album_name = db_qr_fetch("select id,name,img from songs_albums where id='$data_song[album_id]'");
   print "<a class=path_link href='".get_template('links_browse_songs_w_album',array('{id}','{album_id}'),array($data_singer['id'],$album_name['id']))."'>$album_name[name]</a>";
    
    }else{
        if($data_albums_count['count']){
   print "$phrases[another_songs]" ;
        } 
   }
          
   print" </p>" ;

  
   compile_hook('songs_after_path_links');
   //-------------- Get Album Image ------------------
           if ($album_name['img']){
     $img_url = $album_name['img'];
    }else{
  if($data_singer['img']){
              $img_url = $data_singer['img'] ;
            }else{

    $img_url = "images/no_pic.gif" ;
    }
    }
  //---------------------------------------------------

         open_table($data_singer['name']);
        print "<table width=100%><tr><td width=20%>";
        compile_hook('songs_before_singer_info_img');
        print "<img src='$img_url' border=0>";
        compile_hook('songs_after_singer_info_img');
        print "</td>
        <td> ";
        compile_hook('songs_before_singer_info_text');
        if($data_lastupdate['date']){ print "<b>$phrases[last_update]  : </b>".substr($data_lastupdate['date'],0,10)."  <br>" ;  }
        if($data_albums_count['count']){ print "<b>$phrases[the_albums_count]  : </b>$data_albums_count[count] <br>" ;}
        print " <b> $phrases[the_songs_count] : </b>$songs_count[count]";
        compile_hook('songs_after_singer_info_text');
        print " </td></tr></table>";
close_table();

compile_hook('songs_after_singer_table');




open_table("$data_song[name]");

if(strchr($data['url'],".mp3")){
//------------- FLASH PLAYER ---------------------------    
    print "<center>

<p id='preview'>Loading...</p>
<script type='text/javascript' src='swfobject.js'></script> 
<script type='text/javascript'> 
var s1 = new SWFObject('player.swf','player','500','20','9'); 
s1.addParam('allowfullscreen','true'); 
s1.addParam('allowscriptaccess','always'); 
s1.addVariable('file',\"".$data['url']."\");
s1.addVariable('autostart','true');
s1.write('preview'); 
</script>

</center>";

// --------- FLASH PLAYER END --------------------
}else{
 //--------- REAL PLAYER ------------------------------------   
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
          print "
          <PARAM NAME=\"SRC\" VALUE=\"$data[url]\"> 
          <PARAM NAME=\"CONTROLS\" VALUE=\"ControlPanel,statusbar\">
          <PARAM NAME=\"CONSOLE\" VALUE=\"one\">
          <PARAM NAME=\"LOOP\" VALUE=\"0\">
          <PARAM NAME=\"NUMLOOP\" VALUE=\"0\">
          <PARAM NAME=\"CENTER\" VALUE=\"0\">
          <PARAM NAME=\"MAINTAINASPECT\" VALUE=\"0\">
          <PARAM NAME=\"BACKGROUNDCOLOR\" VALUE=\"#000000\">
          <embed src=\"$data[url]\" align=\"baseline\" border=\"0\" width=\"350\" height=\"60\" type=\"audio/x-pn-realaudio-plugin\" console=\"one\" controls=\"ControlPanel,statusbar\" autostart=\"true\"> </embed>
        </OBJECT>
        <br>    <br>";
        
//----------------- REAL PLAYER END ----------------
}
 print "<center><a href=\"".$scripturl."/".get_template('links_song_download',array('{cat}','{id}'),array($cat,$id))."\"> Õ„Ì· «·«€‰Ì…</a></center>";
 ?>
 <br>
        
        <table width=100%>        
       <TBODY>
<TR>
<TD class=box2 width="100%">
<TABLE dir=rtl border=0 cellSpacing=0 cellPadding=2 width="100%">
<TBODY>
<TR>
<TD class=000 width="100%"><STRONG><FONT color=#cc6600>Â· «‰  „‘ —ﬂ ›Ì «Ì „‰ œÏø</FONT></STRONG> <BR>Ì„ﬂ‰ﬂ «÷«›… —«»ÿ Â–Â «·«€‰Ì… «·Ï „Ê÷Ê⁄ﬂ »«·„‰ œÏ «·«‰! <BR>«ﬂ » „Ê÷Ê⁄« Ê «‰”Œ «·—«»ÿ «· «·Ì «·ÌÂ! </TD></TR>
<FORM id=embedFormvb name=embedFormvb action="">
<TR>
<TD width="100%"><TEXTAREA style="BORDER-BOTTOM: #c0c0c0 1px solid; BORDER-LEFT: #c0c0c0 1px solid; FONT-FAMILY: Tahoma; FONT-SIZE: 8pt; BORDER-TOP: #c0c0c0 1px solid; BORDER-RIGHT: #c0c0c0 1px solid" dir=ltr id=embed_code onclick=javascript:document.embedFormvb.embed_code.focus();document.embedFormvb.embed_code.select(); cols=55 name=embed_code>
<?
print "[URL=".$scripturl."/".get_template('links_song_listen',array('{cat}','{id}','{url}'),array($cat,$id,$lstn_url))."]
[img]".iif(!strchr($data_singer['img'],"http://"),$scripturl."/".get_image($data_singer['img']),$data_singer['img'])."[/img]
[COLOR=\"Red\"][B] $data_singer[name] - $data_song[name] [/B][/COLOR][/URL]
[URL=$scripturl][SIZE=\"1\"][FONT=\"Tahoma\"]".$sitename."[/FONT][/SIZE][/URL]</TEXTAREA> </TD></TR></FORM></TBODY></TABLE></TD></TR>";
?>
<TR>
<TD class=box2 width="100%">
<TABLE dir=rtl border=0 cellSpacing=0 cellPadding=2 width="100%">
<TBODY>
<TR>
<TD class=000 width="100%"><STRONG><FONT color=#cc6600>Â· ·œÌﬂ „Êﬁ⁄ √Ê „œÊ‰…ø</FONT></STRONG> <BR>Ì„ﬂ‰ﬂ «÷«›… —«»ÿ Â–Â «·«€‰Ì… «·Ï „Êﬁ⁄ﬂ «Ê „œÊ‰ ﬂ ! <BR>«‰”Œ «·ﬂÊœ «· «·Ì Ê ÷⁄Â ›Ì „Êﬁ⁄ﬂ «·¬‰! </TD></TR>
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
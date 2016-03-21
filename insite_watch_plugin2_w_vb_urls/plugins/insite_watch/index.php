<?


// --------------------- Preview Movies ------------------
 if($action=="preview"){
     $players_include = "plugins/insite_watch/" ; 
     $id = intval($id);

 $qr = db_query("select * from songs_videos_data where id='$id'");
   
 if(db_num($qr)){
     
  db_query("update songs_videos_data set views=views+1 where id='$id'");

 $data = db_fetch($qr);
 
     
 $dir_data['cat'] = $data['cat'] ;
while($dir_data['cat']!=0){
   $dir_data = db_qr_fetch("select name,id,cat from songs_videos_cats where id='$dir_data[cat]'");


        $dir_content = "<a href='".get_template('links_browse_videos','{id}',$dir_data['id'])."'>$dir_data[name]</a> / ". $dir_content  ;

        }
   print "<p align=$global_align><img src='images/arrw.gif'> <a href='".get_template('links_browse_videos','{id}','0')."'>$phrases[the_videos] </a> / $dir_content " . "<b>$data[name]</b></p>";


    

open_table($data['name']);

print "<a href='".get_template('links_video_download',array('{id}'),array($id))."'><img src='".get_image('images/save.gif')."' alt=\" Ќгнб «бябн» $data[name]\" border=0>&nbsp; Ќгнб «бябн» $data[name]</a>
<br>
<a href=\"javascript:snd_vid($data[id])\"><img src='images/snd.gif' alt='«—”б «бябн» б’ѕнё' border=0>&nbsp;«—”б «бябн» б’ѕнё</a>

<br><br>";


if(strpos($data['url'],"video.google.com")){

$url = "http://video.google.com/googleplayer.swf?docid=".substr($data['url'],strpos($data['url'],"docid=")+6,strlen($data['url']))."&fs=true";

$cn = file_get_contents($players_include."preview_google.html");
 $cn = str_replace("{url}",$url,$cn);
 print $cn ;
 }elseif(strpos($data['url'],".flv") || strpos($data['url'],".mp4") || strpos($data['url'],"youtube.com")){

   if (strchr($data['url'],"http://")) {
           $url =  "$data[url]";
           }else{
  $url = "http://$_SERVER[HTTP_HOST]/$script_path/$data[url]";
          }

          $cn = file_get_contents($players_include."preview_flv.html");
 $cn = str_replace("{url}",$url,$cn);
 print $cn ;

 }elseif(strpos($data['url'],".wmv")){

   if (strchr($data['url'],"http://")) {
           $url =  "$data[url]";
           }else{
  $url = "http://$_SERVER[HTTP_HOST]/$script_path/$data[url]";
          }

          $cn = file_get_contents($players_include."preview_mediaplayer.html");
 $cn = str_replace("{url}",$url,$cn);
 print $cn ;

}else{
  if (strchr($data['url'],"http://")) {
           $url =  "$data[url]";
           }else{
  $url = "http://$_SERVER[HTTP_HOST]/$script_path/$data[url]";
          }

          $cn = file_get_contents($players_include."preview.html");
 $cn = str_replace("{url}",$url,$cn);
 print $cn ;

 }

 ?>
   <br>    <br>
        
<table width=100%>        
       <TBODY>
<TR>
<TD class=box2 width="100%">
<TABLE dir=rtl border=0 cellSpacing=0 cellPadding=2 width="100%">
<TBODY>
<TR>
<TD class=000 width="100%"><STRONG><FONT color=#cc6600>еб «д  г‘ —я Ён «н гд ѕмњ</FONT></STRONG> <BR>нгядя «÷«Ё… —«»Ў  е–« «бЁнѕнж «бм гж÷жЏя »«бгд ѕм «б«д! <BR>«я » гж÷жЏ«р ж «д”ќ «б—«»Ў «б «бн «бне! </TD></TR>
<FORM id=embedFormvb name=embedFormvb action="">
<TR>
<TD width="100%"><TEXTAREA style="BORDER-BOTTOM: #c0c0c0 1px solid; BORDER-LEFT: #c0c0c0 1px solid; FONT-FAMILY: Tahoma; FONT-SIZE: 8pt; BORDER-TOP: #c0c0c0 1px solid; BORDER-RIGHT: #c0c0c0 1px solid" dir=ltr id=embed_code onclick=javascript:document.embedFormvb.embed_code.focus();document.embedFormvb.embed_code.select(); cols=55 name=embed_code>
<?
print "[URL=".$scripturl."/".get_template('links_video_watch',array('{id}'),array($id))."]
[img]".iif(!strchr($data['img'],"http://"),$scripturl."/").get_image($data['img'])."[/img]
[COLOR=\"Red\"][B] $data[name] [/B][/COLOR][/URL]
[URL=$scripturl][SIZE=\"1\"][FONT=\"Tahoma\"]".$sitename."[/FONT][/SIZE][/URL]</TEXTAREA> </TD></TR></FORM></TBODY></TABLE></TD></TR>";
?>
<TR>
<TD class=box2 width="100%">
<TABLE dir=rtl border=0 cellSpacing=0 cellPadding=2 width="100%">
<TBODY>
<TR>
<TD class=000 width="100%"><STRONG><FONT color=#cc6600>еб бѕня гжёЏ √ж гѕжд…њ</FONT></STRONG> <BR>нгядя «÷«Ё… —«»Ў е–« «бЁнѕнж  «бм гжёЏя «ж гѕжд я ! <BR>«д”ќ «бяжѕ «б «бн ж ÷Џе Ён гжёЏя «б¬д! </TD></TR>
<FORM id=embedFormmsn name=embedFormmsn action="">
<TR>
<TD width="100%"><TEXTAREA style="BORDER-BOTTOM: #c0c0c0 1px solid; BORDER-LEFT: #c0c0c0 1px solid; FONT-FAMILY: Tahoma; FONT-SIZE: 8pt; BORDER-TOP: #c0c0c0 1px solid; BORDER-RIGHT: #c0c0c0 1px solid" dir=ltr id=embed_code onclick=javascript:document.embedFormmsn.embed_code.focus();document.embedFormmsn.embed_code.select(); cols=55 name=embed_code>
<?

print $scripturl."/".get_template('links_video_watch',array('{id}'),array($id));
?>
</TEXTAREA> </TD></TR></FORM></TBODY></TABLE></TD></TR></TBODY>
</table>
 <?
  close_table();   
 }else{
     open_table();
     print "<center>  —«»Ў ќ«ЎнЅ </center>";
      close_table();   
     }

 }

 ?>
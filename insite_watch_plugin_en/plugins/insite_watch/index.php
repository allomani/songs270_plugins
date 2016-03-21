<?
$players_include = "plugins/insite_watch/" ;

// --------------------- Preview Movies ------------------
 if($action=="preview"){
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
if(strpos($data['url'],"youtube.com")){

$url = "http://www.youtube.com/v/".substr($data['url'],strpos($data['url'],"watch?v=")+8,strlen($data['url']))."&hl=en&fs=1";

$cn = file_get_contents($players_include."preview_youtube.html");
 $cn = str_replace("{url}",$url,$cn);
 print $cn ;
}elseif(strpos($data['url'],"video.google.com")){

$url = "http://video.google.com/googleplayer.swf?docid=".substr($data['url'],strpos($data['url'],"docid=")+6,strlen($data['url']))."&fs=true";

$cn = file_get_contents($players_include."preview_google.html");
 $cn = str_replace("{url}",$url,$cn);
 print $cn ;
 }elseif(strpos($data['url'],".flv")){

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

  close_table();   
 }else{
     open_table();
     print "<center>  —«»ÿ Œ«ÿÌ¡ </center>";
      close_table();   
     }

 }

 ?>
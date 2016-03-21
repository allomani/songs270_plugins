<?
if($action=="preview"){
open_table();
$id = (int) $id;
$data_cat = db_qr_fetch("select cat from songs_videos_data where id='$id'");

print "<table width='100%'><tr><td align='right'>";


$qr_p = db_query("select * from songs_videos_data where cat='$data_cat[cat]' and id < $id order by id desc limit 1");
if(db_num($qr_p)){
$data_p = db_fetch($qr_p);

print "<a title=\"$data_p[name]\" href=\"".$scripturl."/".get_template('links_video_watch',array('{id}'),array($data_p['id']))."\">
<img src=\"".get_image($data_p['img'])."\" title=\"$data_p[name]\" border=0><br>$data_p[name]</a>";

}

print "</td><td align='left'>";

$qr_n = db_query("select * from songs_videos_data where cat='$data_cat[cat]' and id > $id order by id asc limit 1");
if(db_num($qr_n)){
$data_n = db_fetch($qr_n);

print "<a title=\"$data_n[name]\" href=\"".$scripturl."/".get_template('links_video_watch',array('{id}'),array($data_n['id']))."\">
<img src=\"".get_image($data_n['img'])."\" title=\"$data_n[name]\" border=0><br>$data_n[name]</a>";

}


print "</td></tr></table>";



   
close_table();
}
?>
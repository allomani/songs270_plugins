<?
 if($action=="listen" && $id){ 
       $id = intval($id);

 $data = db_qr_fetch("select * from songs_songs where id='$id'");
   $data_singer = db_qr_fetch("select name from songs_singers where id='$data[album]'");
   
   $title_sub = $data_singer['name'] ." - ".$data['name'];
 }
 
 
$actions_checks["Listen Page"] = 'listen' ;
?>
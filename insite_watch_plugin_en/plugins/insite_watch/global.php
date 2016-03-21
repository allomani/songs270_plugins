<?
 if($action=="preview" && $id){ 
       $id = intval($id);

 $data = db_qr_fetch("select * from songs_videos_data where id='$id'");
   
   $title_sub = $data['name'];
 }
 
 
 $actions_checks["Video Watch"] = 'preview' ; 
 ?>
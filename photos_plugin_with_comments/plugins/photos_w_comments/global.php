<?
$actions_checks["$phrases[photos_dir]"] = 'photos' ;
$actions_checks["зяж гАуФяи"] = 'photos_preview' ;  

$permissions_checks["$phrases[photos_dir]"]  = "photos" ; 


//---------------------------------------------------------------------------------
function get_photos_cats($id){
    $id = (int) $id;
  $cats_arr = array();
   $cats_arr[]=$id;

         $qr1 = db_query("select id from photos_cats where cat='$id'");
         while($data1 = db_fetch($qr1)){
          $nxx = get_photos_cats($data1['id']);
          if(is_array($nxx)){
              $cats_arr = array_merge($nxx,$cats_arr);
          }
           unset($nxx);
          }

          return  $cats_arr ;
         }


?>
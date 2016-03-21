<?
if(!check_login_cookies()){die("<center> $phrases[access_denied] </center>");} 


if(!$action){
    $data=db_qr_fetch("select count(id) as count from songs_videos_comments where active=0 order by id desc" );   
    print "<br><table with=50% class=grid><tr><td><b>  ⁄·Ìﬁ«  ﬂ·Ì»«   ‰ Ÿ— «·„Ê«›ﬁ… : </b> <a href='index.php?action=videos_comments'>$data[count]</a> </td></tr></table>";
}



if ($action == "videos_comments" || $action == "videos_comment_activate" || $action == "videos_comment_edit_ok"){
    if_admin( "videos_comments" );

  
  if ($action == "videos_comment_edit_ok"){
   db_query("update songs_videos_comments set content='$content' where id='$id'");
  
  }
    if ($action == "videos_comment_activate"){
        $id = intval( $id );
        db_query( "update songs_videos_comments set active=1 where id='".$id."'" );
    }
    
    
$qr = db_query( "select * from songs_videos_comments where active=0 order by id desc" );
print "<p align=center class=title>  ⁄·Ìﬁ«   ‰ Ÿ— «·„Ê«›ﬁ… </p>";
if (db_num($qr)){
    print "<center><table width=100% class=grid>";
    while($data = db_fetch($qr)){
        $data_news = db_qr_fetch("select name from songs_songs where id='$data[cat]'");
        print "<tr><td><a href='$scripturl/index.php?action=preview&id=$data[cat]' target=_blank>$data_news[name]</a></td>
        <td>$data[name]</td><td>$data[email]</td><td>$data[content]</td><td>$data[date]</td><td><a href='index.php?action=videos_comment_activate&id=$data[id]'>  ›⁄Ì· </a> - <a href='index.php?action=videos_comment_edit&id=$data[id]'> ⁄œÌ·</a> - <a href='index.php?action=videos_comment_del&id=$data[id]' onClick=\"return confirm('Are You Sure ?');\">Õ–›</a></td></tr>";
        
    }
    print "</table></center>";
}else{
    print "<center> ·«  ÊÃœ  ⁄·ﬁÌ«  </center>";
}
}


    //--------- comments del ----
if($action=="videos_comment_del"){
    if_admin("videos_comments");
   
    
    db_query("delete from songs_videos_comments where id='$id'");
    if($cat){
 print "<SCRIPT>window.location=\"$scripturl/index.php?action=preview&id=$cat\";</script>";
 }else{
     print "<SCRIPT>window.location=\"index.php?action=videos_comments\";</script>";
 }
 }
 
 
 //--------- edit --------------
if ($action == "videos_comment_edit"){
    if_admin( "videos_comments" );
    $id = intval( $id );
   
    $qr = db_query( "select * from songs_videos_comments where id='".$id."'" );
   if(db_num($qr)){
       $data=db_fetch($qr);
       print "<form action='index.php' method=post>
       <input type=hidden name='action' value='videos_comment_edit_ok'> 
       <input type=hidden name='id' value='$id'>
      
         <center>
       <table width=50% class=grid>
       <tr><td align=center><textarea name='content' cols=30 rows=5>$data[content]</textarea></td></tr>
       <tr><td align=center><input type=submit value='  ⁄œÌ· '></td></tr>
       </table>
       </form>";
   }else{
    print_admin_table("<center> $phrases[err_wrong_url]</center>");   
   }
}

 ?>
<?
if(!check_login_cookies()){die("<center> $phrases[access_denied] </center>");} 

if_admin("songs_comments");

    //--------- comments del ----
if($action=="songs_comment_del"){
    db_query("delete from songs_songs_comments where id='$id'");
 print "<SCRIPT>window.location=\"$scripturl/index.php?action=listen&id=$cat\";</script>";
 }

 ?>
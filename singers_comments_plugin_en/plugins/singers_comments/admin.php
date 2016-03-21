<?
if(!check_login_cookies()){die("<center> $phrases[access_denied] </center>");} 

if_admin("singers_comments");

    //--------- comments del ----
if($action=="singers_comment_del"){
    db_query("delete from songs_singers_comments where id='$id'");
 print "<SCRIPT>window.location=\"$scripturl/index.php?action=songs&id=$cat\";</script>";
 }

 ?>
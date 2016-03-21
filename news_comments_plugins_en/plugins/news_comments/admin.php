<?
if(!check_login_cookies()){die("<center> $phrases[access_denied] </center>");} 

if_admin("news_comments");

    //--------- comments del ----
if($action=="news_comment_del"){
    db_query("delete from songs_news_comments where id='$id'");
 print "<SCRIPT>window.location=\"$scripturl/index.php?action=news&id=$cat\";</script>";
 }

 ?>
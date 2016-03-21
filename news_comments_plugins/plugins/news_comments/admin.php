<?
if(!check_login_cookies()){die("<center> $phrases[access_denied] </center>");} 



    //--------- comments del ----
if($action=="news_comment_del"){
    if_admin("news_comments"); 
    db_query("delete from songs_news_comments where id='$id'");
 print "<SCRIPT>window.location=\"$scripturl/index.php?action=news&id=$cat\";</script>";
 }

 ?>
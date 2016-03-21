<?
if($action=="songs" & $op != "letter"){

    $name=htmlspecialchars($name);
       $email = htmlspecialchars($email);
       $content = htmlspecialchars($content);
       $id = intval($id);
       $comment_op = htmlspecialchars($comment_op);
                                         
         if($comment_op=="send_comment"){
        if(check_member_login()){
  
   
   if($sec_img->verify_string($sec_string)){
  
    
            $userid =  $member_data['id'] ;
            db_query("insert into songs_singers_comments (userid,content,cat,active,date) values('$userid','$content','$id','1',now())");
                                         
            open_table();
            print "<center>Thank You , Your Comment Sent Successfully.</center>";
            close_table();
            $name="";
       $email = "";
       $content = "";
            }else{
            open_table();
            print "<center> Invalid Verification Code. </center>" ;
            close_table();
                }

                }else{
                open_table();
                print "<center>  Please Login. </center>";
                close_table();
                }
            }
            
     //-------------- Comments --------------------
$qr = db_query("select * from songs_singers_comments where cat ='$id' and active=1");
  if(db_num($qr)){
          open_table("Comments");
          print "<hr size=1 class=separate_line>";
          while($data = db_fetch($qr)){
             
             
             $dx = db_qr_fetch("select * from songs_members where id='$data[userid]'");
             
          print "<table width=100% border=0><tr><td width=50%><b>$dx[username]</b><td align=left>$data[date]</td></tr>";
        
          print "<tr><td colspan=2>$data[content]";
          if(check_login_cookies() && if_admin("singers_comments",1)){
          print " &nbsp;[<a href='".iif($admin_folder,$admin_folder,"admin")."/index.php?action=singers_comment_del&id=$data[id]&cat=$id'>Delete</a>]";
              }
          print "<br><hr size=1 class=separate_line></td></tr></table>";
                  }
          close_table();
          }

   //------------ send comment ---------------

   open_table("Send Comment");
   if(check_member_login()){
   print "<form action='index.php' method=post>
   <table width=100% border=0>
   <input type=hidden name=id value='$id'>
   <input type=hidden name=album_id value='$album_id'>
   <input type=hidden name=action value='songs'>
    <input type=hidden name=comment_op value='send_comment'>
 <tr><td><b> Comment </b></td><td><textarea cols=30 rows=5 name=content>$content</textarea></td></tr>

         <tr>
        <td><b>$phrases[security_code]</b></td>
        <td>".$sec_img->output_input_box('sec_string','size=7')."&nbsp;<img src=\"sec_image.php\" alt=\"Verification Image\" /></td></tr>
    
      <tr><td colspan=2 align=center><input type=submit value=' Send '></td></tr>
</table></form>";
}else{
    print "<center>  Please Login </center>";
    }
   close_table();       
}
<?
include "global.php" ;
$dedi_timeout = 60 ;
$dedi_msg_min = 5 ;
$dedi_msg_max = 200 ;


if($action=="send" && (strlen($msg) >= $dedi_msg_min) && (strlen($msg) <= $dedi_msg_max) && $name){
setcookie('songs_dedi_added', "1" , time() + $dedi_timeout,"/");
setcookie('songs_dedi_name', "$name" , (time() + 60*60*24*30),"/");

}

print "<html dir=rtl>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=windows-1256\" />
<LINK href=\"css.php\" type=\"text/css\" rel=\"stylesheet\">
<title>الإهداءات</title>\n";
   open_table();
 if(check_member_login()){
if($action=="send"){
          $msg = trim($msg);
          $msg = htmlspecialchars($msg);

        if (!$HTTP_COOKIE_VARS['songs_dedi_added']){
          if((strlen($msg) >= $dedi_msg_min) && (strlen($msg) <= $dedi_msg_max)){
          	  
        db_query("insert into songs_dedications(user,msg,date)values('".db_clean_string($name)."','".db_clean_string($msg)."',now())");
        print "<center>  تم ارسال اهدائك </center>";
        print "<script>
        opener.dedications_frame.refresh();
        </script>";

        }else{
             print "<center> عفوا , يجب ان تكون رسالتك اقل من $dedi_msg_max حرف و اكثر من $dedi_msg_min أحرف</center>";
                }
        }else{
                print "<center>  عفوا , يمكنك ارسال اهداء كل $dedi_timeout  ثانية </center>";
                }
        }else{




    print "
    <script>
    function get_icon(value){
    sender.msg.value = sender.msg.value + value ;
            }
    </script>

    <form action='send_dedication.php' method=post name=sender>
    <input type=hidden name='action' value='send'>
    <table width=100%>
    <tr><td>اسمك : <br>
    <input type=hidden name=name value='$member_data[username]'><b>$member_data[username]</b></td></tr>
    <tr><td>رسالتك : <br><br>
    <textarea cols=30 rows=5 name=msg></textarea></td></tr>
    <tr><td> <br>الإبتسامات : <table width=100%><tr>";
    $qr = db_query("select * from songs_emotions order by id");
    $c= 0 ;
    while($data= db_fetch($qr)){

    if($c == 6){
          print "</tr><tr>";
          $c = 0 ;
          }

    print "<td align=center><a href='#' onclick=\"get_icon('$data[value]');return false;\"><img src='$data[img]' border=0></a></td>";
       $c++;
            }

    print "</tr></table><br></td></tr><tr><td align=center><input type=submit value=' ارسال '></td></tr>
    </table></form>" ;

}
}else{

print "                <form method=\"POST\" action=\"login.php\">
<input type=hidden name=action value=login>
<input type=hidden name=re_link value=\"$_SERVER[REQUEST_URI]\">
<table border=\"0\" width=\"100%\">
        <tr>
                <td height=\"15\"><span lang=\"ar-sa\">اسم المستخدم :</span></td></tr><tr>
                <td height=\"15\"><input type=\"text\" name=\"username\" size=\"10\"></td>
        </tr>
        <tr>
                <td height=\"12\"><span lang=\"ar-sa\">كلمة المرور :</span></td></tr><tr>
                <td height=\"12\" ><input type=\"password\" name=\"password\" size=\"10\"></td>
        </tr>
        <tr>
                <td height=\"23\">
                <p align=\"center\"><input type=\"submit\" value=\"تسجيل دخول\"></td>
        </tr>
        <tr>
                <td height=\"38\"><span lang=\"ar-sa\">
                <a href=\"index.php?action=register\" target=_blank>مستخدم جديد ؟</a><br>
                <a href=\"index.php?action=forget_pass\" target=_blank>نسيت كلمة المرور ؟</a></span></td>
        </tr>
</table>
</form>\n";

}
close_table();
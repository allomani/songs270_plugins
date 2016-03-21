<?
if(!check_login_cookies()){die("<center> $phrases[access_denied] </center>");} 


if(!$action){
        $cnts1 = db_qr_fetch("select count(id) as count from guestbook_data where active=0");

print_admin_table("<b>”Ã·«   ‰ Ÿ— «·„Ê«›ﬁ… : </b> <a href='index.php?action=guestbook'>$cnts1[count] </a>");    
}
//------------------------------- Guest Book -----------------------------------
if($action=="guestbook" || $action=="guestbook_del" || $action=="guestbook_edit_ok" || $action=="guestbook_activate"){

if_admin("guestbook");
$id=intval($id);

print "<p align=center class=title> ”Ã· «·“Ê«— </p>";

if($action=="guestbook_activate"){
    db_query("update guestbook_data set active=1 where id='$id'");
}

if($action=="guestbook_del"){
        db_query("delete from guestbook_data where id='$id'");
        
        if($redirect){
             print "<SCRIPT>window.location=\"../index.php?action=guestbook\";</script>";
        }
        }

if($action=="guestbook_edit_ok"){
 db_query("update guestbook_data set name='$name',email='$email',msg='$msg' where id='$id'");
 
 if($redirect){
             print "<SCRIPT>window.location=\"../index.php?action=guestbook\";</script>";
        }
        }

        print "<li><span class=title>«Õ’«∆Ì« </span></li><br><br>";
        $cnts1 = db_qr_fetch("select count(id) as count from guestbook_data where active=0");
        $cnts2 = db_qr_fetch("select count(id) as count from guestbook_data where active=1");
        
print_admin_table("<b>”Ã·«   ‰ Ÿ— «·„Ê«›ﬁ… : </b> $cnts1[count] <br>
<b>”Ã·«  „›⁄·… : </b> $cnts2[count]");
        
        print "<li><span class=title>”Ã·«  »«‰ Ÿ«— «· ›⁄Ì·</span></li><br><br>";
        
$qr =db_query("select * from guestbook_data where active=0 order by id desc");
if(db_num($qr)){
print "<center><table width=90% class=grid>";
while($data = db_fetch($qr)){
 print "<tr><td>$data[id]</td><td>$data[name]</td><td>$data[email]</td><td>$data[date]</td>
  <td><a href='index.php?action=guestbook_activate&id=$data[id]'> ›⁄Ì·</a></td>
 <td><a href='index.php?action=guestbook_edit&id=$data[id]'> ⁄œÌ·</a></td>
 <td><a href='index.php?action=guestbook_del&id=$data[id]' onclick=\"confirm('Â· «‰  „ √ﬂœ ø')\">Õ–›</a></td></tr>";

        }
print "</table></center>";
}else{

print_admin_table("<center> ·«  ÊÃœ ”Ã·«  </center>");
}
        }



if($action=="guestbook_edit"){
  if_admin("guestbook"); 
$id=intval($id);
$data = db_qr_fetch("select * from guestbook_data where id='$id'");

print "<form action=index.php method=post>
  <input type=hidden name=action value='guestbook_edit_ok'>
    <input type=hidden name=id value='$id'>
     <input type=hidden name=redirect value='".intval($redirect)."'>
  <table width=100% class=grid>
  <tr><td colspan=2>$data[date]</td></tr>
  <tr><td width=20%><b>«·«”„:</b></td><td> <input type=text name=name size=20 value='$data[name]'></td></tr>
  <tr><td width=20%><b>«·»—Ìœ «·«·ﬂ —Ê‰Ì :</b></td><td><input type=text name=email size=20 dir=ltr value='$data[email]'></td></tr>
  <tr><td width=20%><b>«·—”«·… :</b></td><td> <textarea cols=30 rows=5 name=msg>$data[msg]</textarea></td></tr>

  <tr><td colspan=2 align=center><input type=submit value='  ⁄œÌ· '></td></tr>
  </table></form>";
        }
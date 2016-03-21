<?
if(!check_login_cookies()){die("<center> $phrases[access_denied] </center>");} 

//-------------------------- Dedications ---------------------
if($action=="dedications" || $action=="dedications_del" || $action=="dedications_edit_ok"){
if_admin("dedications");


print "<p align=center class=title>  Dedications </p>" ;

if($action=="dedications_del"){
    if(!is_array($d_id)){$d_id=array($id);}

    foreach($d_id as $del_id){
        db_query("delete from songs_dedications where id='$del_id'");
        }
        }
 if($action=="dedications_edit_ok"){
 db_query("update songs_dedications set user='$user',msg='$msg' where id='$id'");
         }

$qr = db_query("select * from songs_dedications  order by id desc limit 100");
if(db_num($qr)){
print "<center><table width=80% class=grid>
<form action=index.php method=post  name=submit_form>
<input type=hidden name=action value='dedications_del'>";
while($data = db_fetch($qr)){


  print "<tr>


  <td><input type=checkbox name=d_id[] value='$data[id]'></td><td>$data[user]</td><td>$data[msg]</td><td>$data[date]</td><td align=left>
  <a href='index.php?action=dedications_edit&id=$data[id]'>Edit</a> -
  <a href='index.php?action=dedications_del&id=$data[id]'>Delete</a></td></tr>";
        }
        print "<tr><td width=2><img src='images/arrow_rtl.gif'></td>
          <td width=100% colspan=5>
          <table><tr><td>

          <a href='#' onclick=\"CheckAll(); return false;\"> Check All </a> -
          <a href='#' onclick=\"UncheckAll(); return false;\">Uncheck All </a>
          &nbsp;&nbsp;
          </td><td>
          <input type=submit value=' Delete ' onClick=\"return confirm('Are You Sure ?');\">
          </td></tr></table></form> ";

        print "</table></center>";
       }else{
                print  "<br><center>  No Dedications </center>";
                }
        }
//--------------------------
if($action=="dedications_edit"){
    if_admin("dedications"); 
$qr = db_query("select * from  songs_dedications where id='$id'");
if(db_num($qr)){
        $data = db_fetch($qr);
print "<form action='index.php' method=post>
<input type=hidden name=action value=dedications_edit_ok>
<input type=hidden name=id value=$data[id]>
<center>
<table width=60% class=grid><tr><td align=center>
<tr><td align=center><input type=text name=user value='$data[user]'></td></tr>
<tr><td align=center>
<textarea name=msg cols=40 rows=10>$data[msg]</textarea> <br>
<input type=submit value=' Edit '></td></tr>

</table></form>";

        }else{
                print "<br><center> Wrong URL  </center>";
                }
}


//-------------------------- emotions ---------------------
if($action=="emotions" || $action=="emotions_del" || $action=="emotions_edit_ok" || $action=="emotions_add_ok"){
if_admin("dedications"); 

print "<p align=center class=title>  Emoticons </p>" ;

if($action=="emotions_del"){
        db_query("delete from songs_emotions where id='$id'");
        }
 if($action=="emotions_edit_ok"){
 db_query("update songs_emotions set img='$img',value='$value' where id='$id'");
         }

          if($action=="emotions_add_ok"){
 db_query("insert into songs_emotions (img,value) values('$img','$value')");
         }

$qr = db_query("select * from songs_emotions  order by id");
if(db_num($qr)){
print "<center>
<form action='index.php' method=post>
<input type=hidden name=action value=emotions_add_ok>
<input type=hidden name=id value=$data[id]>
<center>
<table width=60% class=grid>
<tr><td>Text value</td><td><input type=text name='value' dir=ltr value='$data[value]'></td></tr>
<tr><td>Image</td><td><input type=text name='img' dir=ltr value='$data[img]'></td></tr>
<tr><td align=center colspan=2><input type=submit value=' Add '></td></tr>

</table></form><br>
<table width=80% class=grid>";
while($data = db_fetch($qr)){

  print "<tr><td>$data[value]</td><td><img src='$data[img]'></td><td align=left>
  <a href='index.php?action=emotions_edit&id=$data[id]'>Edit</a> -
  <a href='index.php?action=emotions_del&id=$data[id]' onclick=\"return confirm('are you sure?');\">Delete</a></td></tr>";
        }
        print "</table></center>";
       }else{
                print  "<br><center>  No Emoticons </center>";
                }
        }
if($action=="emotions_edit"){
    if_admin("dedications"); 
$qr = db_query("select * from  songs_emotions where id='$id'");
if(db_num($qr)){
        $data = db_fetch($qr);
print "<form action='index.php' method=post>
<input type=hidden name=action value=emotions_edit_ok>
<input type=hidden name=id value=$data[id]>
<center>
<table width=60% class=grid>
<tr><td>Text Value</td><td><input type=text name='value' dir=ltr value='$data[value]'></td></tr>
<tr><td>Image</td><td><input type=text name='img' dir=ltr value='$data[img]'></td></tr>
<tr><td align=center colspan=2><input type=submit value=' Edit '></td></tr>

</table></form>";

        }else{
                print "<br><center> Wrong URL </center>";
                }
}        
?>
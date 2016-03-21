<?

if(!defined("CUR_FILENAME")){
        die("You can't access file directly ... ");
}


//------------------------------- photos -------------------
  if($action=="photos"){
  $cat = intval($cat);
  if(!$cat){ $cat=0;}

          $dir_data['cat'] = $cat ;
while($dir_data['cat']!=0){
   $dir_data = db_qr_fetch("select name,id,cat from photos_cats where id='$dir_data[cat]'");


        $dir_content = "<a href='index.php?action=photos&cat=$dir_data[id]'>$dir_data[name]</a> / ". $dir_content  ;

        }
   print "<p align=$global_align><img src='images/link.gif'> <a href='index.php?action=photos&cat=0'>$phrases[photos_dir]  </a> / $dir_content " . "<b>$data[name]</b></p>";

  $qr = db_query("select * from photos_cats where cat='$cat'");

    $cats_num = db_num($qr) ;

    if(db_num($qr)){
      open_table();
    print "<center><table width=100%>" ;
    $c=0;
        while($data = db_fetch($qr)){



if ($c==$settings['photos_cells']) {
print "  </tr><TR>" ;
$c = 0 ;
}
    ++$c ;

    if($data['img']){$img_url=$data['img'];}else{$img_url = "images/folder.gif";}
print " <td><center><a href='index.php?action=photos&cat=$data[id]'>
            <img border=0 alt='$phrases[the_name] : $data[name] '
            src='$img_url'>
            <br>$data[name] </a><br>" ;

 print "</center>    </td>";
           }
           print "</tr></table></center>";
           close_table();
         }
    //----------------- pages system ----------------------
    $start = intval($start);
       $page_string= "index.php?action=photos&cat=$cat" ;
       $photos_perpage = intval($settings['photos_perpage']);
  //---------------------------

    $qr = db_query("select * from photos_data where cat='$cat' order by id DESC limit $start,$photos_perpage");
  $page_result = db_qr_fetch("SELECT count(*) as count from photos_data where cat=$cat");

    $data_title = db_qr_fetch("select name from photos_cats where id='$cat'");

      $numrows=$page_result['count'];
$previous_page=$start - $movies_perpage;
$next_page=$start + $photos_perpage;


   $movies_num = db_num($qr) ;

    if(db_num($qr)){
     open_table($data_title['name']);
     print "<script>
     function enlarge_pic(sPicURL) {
msgwindow=window.open( \"enlarge_pic.htm?\"+sPicURL, \"\",\"resizable=1,HEIGHT=10,WIDTH=10\");
}
</script>";
    print "<center><table width=100%>" ;
    $c=0;
        while($data = db_fetch($qr)){



if ($c==$settings['photos_cells']) {
print "  </tr><TR>" ;
$c = 0 ;
}
    ++$c ;
print " <td><center><a href=\"index.php?action=photos_preview&id=$data[id]\">
            <img border=0 alt='$phrases[add_date] : ".substr($data['date'],0,10)."'
            src='".get_image($data['thumb'])."'>
             </a><br>$data[name]";

 print "</center>    </td>";
           }
           print "</tr></table></center>";
          close_table();
//-------------------- pages system ------------------------
if ($numrows>$photos_perpage){
echo "<p align=center>$phrases[pages] : ";
//----------------------------
if($start >0)
{
$previouspage = $start - $movies_perpage;
echo "<a href=$page_string&start=$previouspage><</a>\n";
}
//------------------------------------------
$pages=intval($numrows/$photos_perpage);
//---------------------------------------
if ($numrows%$photos_perpage)
{
$pages++;
}
//--------------------------------------
for ($i = 1; $i <= $pages; $i++) {

$nextpag = $photos_perpage*($i-1);
//-----------------------------------------

if ($nextpag == $start)
{
echo "<font size=2 face=tahoma><b>$i</b></font>&nbsp;\n";
}
else
{
echo "<a href=$page_string&start=$nextpag>[$i]</a>&nbsp;\n";
}
}
//--------------------------------------------------

if (! ( ($start/$photos_perpage) == ($pages - 1) ) && ($pages != 1) )
{
$nextpag = $start+$photos_perpage;
echo "<a href=$page_string&start=$nextpag>></a>\n";
}
//--------------------------------------------------------------

echo "</p>";
}
//------------ end pages system -------------
            }

if(!$movies_num && !$cats_num){
        open_table();
        print "<center> $phrases[err_no_photos]</center>";
        close_table();
        }


  }
  
  
//----------- preview ---------------
if($action=="photos_preview"){
    $id=intval($id);
    
$qr=db_query("select * from photos_data where id='$id'");

if(db_num($qr)){
 $data=db_fetch($qr);
 
           $dir_data['cat'] = $data['cat'] ;
while($dir_data['cat']!=0){
   $dir_data = db_qr_fetch("select name,id,cat from photos_cats where id='$dir_data[cat]'");


        $dir_content = "<a href='index.php?action=photos&cat=$dir_data[id]'>$dir_data[name]</a> / ". $dir_content  ;

        }
   print "<p align=$global_align><img src='images/link.gif'> <a href='index.php?action=photos&cat=0'>$phrases[photos_dir]  </a> / $dir_content " . "<b>$data[name]</b></p>";

   
   
 open_table("$data[name]");
 print "<center><img src=\"$data[img]\"></center>";
 close_table();
 
 
 //---------- comments -------------
 
     $name=htmlspecialchars($name);
       $email = htmlspecialchars($email);
       $content = htmlspecialchars($content);
       $id = intval($id);
       $comment_op = htmlspecialchars($comment_op);
                                         
         if($comment_op=="send_comment"){
        if(check_member_login()){
  
   
   if($sec_img->verify_string($sec_string)){
  
    
            $userid =  $member_data['id'] ;
            db_query("insert into photos_comments (userid,content,cat,active,date) values('$userid','$content','$id','1',now())");
                                         
            open_table();
            print "<center>‘ﬂ—« ·ﬂ , ·ﬁœ  „ «—”«·  ⁄·Ìﬁﬂ .</center>";
            close_table();
            $name="";
       $email = "";
       $content = "";
            }else{
            open_table();
            print "<center> Œÿ√ ›Ì ﬂÊœ «· Õﬁﬁ </center>" ;
            close_table();
                }

                }else{
                open_table();
                print "<center>  Ì—ÃÏ  ”ÃÌ· «·œŒÊ· «Ê·« </center>";
                close_table();
                }
            }
            
     //-------------- Comments --------------------
$qr = db_query("select * from photos_comments where cat ='$id' and active=1");
  if(db_num($qr)){
          open_table("«· ⁄·Ìﬁ« ");
          print "<hr size=1 class=separate_line>";
          while($data = db_fetch($qr)){
             
             
             $dx = db_qr_fetch("select * from songs_members where id='$data[userid]'");
             
          print "<table width=100% border=0><tr><td width=50%><b>$dx[username]</b><td align=left>$data[date]</td></tr>";
        
          print "<tr><td colspan=2>$data[content]";
          if(check_login_cookies() && if_admin("photos",1)){
          print " &nbsp;[<a href='".iif($admin_folder,$admin_folder,"admin")."/index.php?action=photos_comment_del&id=$data[id]&cat=$id'>Õ–›</a>]";
              }
          print "<br><hr size=1 class=separate_line></td></tr></table>";
                  }
          close_table();
          }

   //------------ send comment ---------------

   open_table("«—”«·  ⁄·Ìﬁ");
   if(check_member_login()){
   print "<form action='index.php' method=post>
   <table width=100% border=0>
   <input type=hidden name=id value='$id'>
   <input type=hidden name=action value='photos_preview'>
    <input type=hidden name=comment_op value='send_comment'>
 <tr><td><b> «· ⁄·Ìﬁ</b></td><td><textarea cols=30 rows=5 name=content>$content</textarea></td></tr>

         <tr>
        <td><b>$phrases[security_code]</b></td>
        <td>".$sec_img->output_input_box('sec_string','size=7')."&nbsp;<img src=\"sec_image.php\" alt=\"Verification Image\" /></td></tr>
    
      <tr><td colspan=2 align=center><input type=submit value=' «—”«· '></td></tr>
</table></form>";
}else{
    print "<center>  Ì—ÃÏ  ”ÃÌ· «·œŒÊ· </center>";
    }
   close_table();
   
   
}else{
    open_table();
    print "<center>$phrases[err_wrong_url]</center>";
    close_table();
}
    
}
  ?>
<?
 if(!defined('IS_ADMIN')){die('No Access');}  
// ------------------------------- News ----------------------------------------
 if ($action == "news" || $action=="del_news" || $action=="edit_news_ok" || $action=="add_news" || $action =="news_cat_add_ok" || $action=="news_cat_del" || $action=="edit_news_cat_ok"){

 if_admin("news");

 $cat= intval($cat);
 
if($action=="add_news"){
if($auto_preview_text){
                $content = getPreviewText($details);
}
                
//----- filter XSS Tages -------
include_once(CWD . "/includes/class_inputfilter.php");
$Filter = new InputFilter(array(),array(),1,1);
$details = $Filter->process($details);
$content = $Filter->process($content);
//------------------------------

         db_query("insert into songs_news(title,writer,content,details,date,img,cat)values('".db_clean_string($title)."','$writer','".db_clean_string($content,"code")."','".db_clean_string($details,"code")."',now(),'$img','$cat')");
        }
        //-------------delete-------
    if ($action=="del_news"){
          db_query("delete from songs_news where id='$id'");
            }
            //----------edit--------------------
            if ($action=="edit_news_ok"){
            if($auto_preview_text){
                $content = getPreviewText($details);
                }

//----- filter XSS Tages -------
include_once(CWD . "/includes/class_inputfilter.php");
$Filter = new InputFilter(array(),array(),1,1);
$details = $Filter->process($details);
$content = $Filter->process($content); 
//------------------------------

                db_query("update songs_news set title='".db_clean_string($title)."',writer='$writer',content='".db_clean_string($content,"code")."',details='".db_clean_string($details,"code")."',img='$img' where id='$id'");

                    }
                  //-----------------------------

 //---------------------------------------------------------
if($action =="news_cat_add_ok"){

  db_query("insert into songs_news_cats (name,cat,img) values('$name','$cat','".db_clean_string($img)."')");
        }
//----------------------------------------------------------
 if($action=="news_cat_del"){
 if($id){
      db_query("delete from songs_news_cats where id='$id'");
       db_query("delete from songs_news where cat='$id'");
         }
 }
//-----------------------------------------------------------
 if($action=="edit_news_cat_ok"){

 db_query("update songs_news_cats set name='$name',img='".db_clean_string($img)."' where id='$id'");
         }
         
         
                print "<p align=center class=title>$phrases[the_news]</p> ";
                
         $dir_data['cat'] = intval($cat) ;
while($dir_data['cat']!=0){
   $dir_data = db_qr_fetch("select name,id,cat from songs_news_cats where id='$dir_data[cat]'");


        $dir_content = "<a href='index.php?action=news&cat=$dir_data[id]'>$dir_data[name]</a> / ". $dir_content  ;

        }
   print "<p align=right><img src='images/link.gif'> <a href='index.php?action=news&cat=0'>«·√Œ»«—  </a> / $dir_content " . "<b>$data[name]</b></p>";


  print "<center><p class=title>«·√ﬁ”«„ </p>
   <form method=\"post\" action=\"index.php\" name='sender'>

   <table width=30% class=grid><tr>
   <td> «·≈”„ :</td><td>
    <input type=hidden name='action' value='news_cat_add_ok'>
    <input type=hidden name='cat' value='$cat'>
   <input type=text name=name size=30>
    </td></tr>
         <tr> <td width=\"100\">
                <b>$phrases[the_image]</b></td>
                                <td>
                                <table><tr><td>
                                <input type=\"text\" name=\"img\" size=\"50\" dir=ltr>  </td><td> <a href=\"javascript:uploader('news','img');\"><img src='images/file_up.gif' border=0 alt='$phrases[upload_file]'></a>
                                 </td></tr></table>
                                 </td></tr>
                                 ";
   /* <tr><td><b>«·ﬁ«·» : </b></td><td><select name=template><option value='0' selected> «·ﬁ«·» «·«› —«÷Ì </option>";
              $qr = db_query("select name,id from songs_templates where protected !=1 order by id ");
              while($data = db_fetch($qr)){
                      print "<option value='$data[id]'>$data[name]</option>";
                      }
                      print "</select></td></tr> */
 print "
    <tr><td colspan=2 align=center><input type=submit value='«÷«›…'></td>
    </tr></table>


     </form>
   </center><br>";
      
      //----------------------- show cats----------------------------

 $qr = db_query("select * from  songs_news_cats where cat='$cat'");
 print "<center>«÷€ÿ ⁄·Ï «”„ «·ﬁ”„ ·≈œ«—… «·«Œ»«— œ«Œ·Â <br><br> <table width=80% class=grid>";
 while($data = db_fetch($qr)){
      print "<tr><td width=75%><a href='index.php?action=news&cat=$data[id]'>$data[name]</a></td>
      <td><a href='index.php?action=news_cat_edit&id=$data[id]'> ⁄œÌ· </a></td>
      <td><a href=\"index.php?action=news_cat_del&id=$data[id]&cat=$cat\" onClick=\"return confirm('Are you sure you want to delete ?');\">Õ–› </a></td>
      ";
         }
       print "</table>";


 //-------------------------------------------------------------
 
    if($cat > 0){    
                print "<p align=$global_align><a href='index.php?action=news_add&cat=$cat'><img src='images/add.gif' border=0>$phrases[news_add]</a></p>";

   
       $qr=db_query("select * from songs_news where cat='$cat' order by id DESC")   ;

       if (db_num($qr)){
           print "<br><center><table border=0 width=\"90%\"   cellpadding=\"0\" cellspacing=\"0\" class=\"grid\">";


         while($data= db_fetch($qr)){
     print "            <tr>
                <td>$data[title]</td>

                <td  width=\"254\"><a href='index.php?action=edit_news&id=$data[id]'>$phrases[edit] </a> - <a href='index.php?action=del_news&id=$data[id]&cat=$cat' onClick=\"return confirm('$phrases[are_you_sure]');\">$phrases[delete]</a></td>
        </tr>";

                 }

                print" </table><br>\n";
                }else{
                        print "<center> $phrases[no_news] </center>";
                        }
    }

}

//-------------- Edit News ----------------
if($action == "edit_news"){

    if_admin("news");
   $id=intval($id);
  $data=db_qr_fetch("select * from songs_news where id='$id'");

      print " <center>
                <table border=0 width=\"80%\"  style=\"border-collapse: collapse\" class=grid><tr>

                <form method=\"POST\" action=\"index.php\" name='sender'>

                    <input type=hidden name=\"action\" value='edit_news_ok'>
                       <input type=hidden name=\"id\" value='$id'>
                        <input type=hidden name=\"cat\" value='$data[cat]'>     


                        <tr>
                                <td width=\"100\">
                <b>$phrases[the_title]</b></td><td >
                <input type=\"text\" name=\"title\" size=\"50\" value='$data[title]'></td>
                        </tr>
                       <tr>
                                <td width=\"100\">
                <b>$phrases[the_writer]</b></td><td width=\"223\">
                <input type=\"text\" name=\"writer\" size=\"50\" value='$data[writer]'></td>
                        </tr>

                               <tr> <td width=\"100\">
                <b>$phrases[the_image]</b></td>
                                <td>


                            <table><tr><td>
                                 <input type=\"text\" name=\"img\" size=\"50\" dir=ltr value=\"$data[img]\">   </td>

                                <td> <a href=\"javascript:uploader('news','img');\"><img src='images/file_up.gif' border=0 alt='$phrases[upload_file]'></a>
                                 </td></tr></table>

                                 </td></tr>


                                    <tr> <td width=\"50\">
                <b>$phrases[the_details]</b></td>
                                <td>";
                                 editor_print_form("details",600,300,"$data[details]");

                                print "
                                <tr><td colspan=2><input name=\"auto_preview_text\" type=\"checkbox\" value=1 onClick=\"show_hide_preview_text(this);\"> $phrases[auto_short_content_create]
                                </td></tr>
                      <tr id=preview_text_tr> <td width=\"100\">
                <b>$phrases[news_short_content]</b></td>
                            <td >
                                <textarea cols=50 rows=5 name='content'>$data[content]</textarea>
                                </td></tr>


                        </td>
                        </tr>
                 <tr><td colspan=2 align=center>  <input type=\"submit\" value=\"$phrases[edit]\">  </td></tr>




                </table>

</form>    </center>\n";

        }
//------------------ News Add -------------------
if($action=="news_add"){

    if_admin("news");
    $cat=intval($cat);
    
print "<center>
                <table border=0 width=\"90%\"  style=\"border-collapse: collapse\" class=grid><tr>

                <form name=sender method=\"POST\" action=\"index.php\">

                      <input type=hidden name=\"action\" value='add_news'>
                       <input type=hidden name=\"cat\" value='$cat'>


                        <tr>
                                <td width=\"100\">
                <b>$phrases[the_title]</b></td><td >
                <input type=\"text\" name=\"title\" size=\"50\"></td>
                        </tr>
                       <tr>
                                <td width=\"100\">
                <b>$phrases[the_writer]</b></td><td width=\"223\">
                <input type=\"text\" name=\"writer\" size=\"50\" value=\"$user_info[username]\"></td>
                        </tr>

                               <tr> <td width=\"100\">
                <b>$phrases[the_image]</b></td>
                                <td>
                                <table><tr><td>
                                <input type=\"text\" name=\"img\" size=\"50\" dir=ltr>  </td><td> <a href=\"javascript:uploader('news','img');\"><img src='images/file_up.gif' border=0 alt='$phrases[upload_file]'></a>
                                 </td></tr></table>
                                 </td></tr>
                                          <tr> <td width=\"100\">
                <b>$phrases[the_details]</b></td>
                                <td>";
                                editor_print_form("details",600,300,"");

                                print "
                                <tr><td colspan=2><input name=\"auto_preview_text\" type=\"checkbox\" value=1 onClick=\"show_hide_preview_text(this);\"> $phrases[auto_short_content_create]
                                </td></tr>
                      <tr id=preview_text_tr> <td width=\"100\">
                <b>$phrases[news_short_content]</b></td>
                                <td>
                                <textarea cols=60 rows=5 name='content'></textarea>


                                </td></tr>
                  <tr><td align=center colspan=2>
                 <input type=\"submit\" value=\"$phrases[add_button]\">
                        </td>
                        </tr>
</table>

</form>    </center>\n";
}

// --------------------- News Edit ------------------------------
 if($action == "news_cat_edit"){
        $id=intval($id);
        
               $data = db_qr_fetch("select * from songs_news_cats where id=$id");

               print "<center>

                <table border=0 width=\"40%\"  style=\"border-collapse: collapse\" class=grid><tr>

                <form method=\"POST\" action=\"index.php\" name='sender'>

                      <input type=hidden name=\"id\" value='$id'>
                      <input type=hidden name=\"cat\" value='$data[cat]'>

                      <input type=hidden name=\"action\" value='edit_news_cat_ok'> ";


                  print "  <tr>
                                <td width=\"50\">
                <b>&#1575;&#1604;&#1575;&#1587;&#1605;</b></td><td width=\"223\">
                <input type=\"text\" name=\"name\" value='$data[name]' size=\"29\"></td>
                        </tr>
                        
                             <tr> <td width=\"100\">
                <b>$phrases[the_image]</b></td>
                                <td>
                                <table><tr><td>
                                <input type=\"text\" name=\"img\" size=\"50\" dir=ltr value=\"$data[img]\">  </td><td> <a href=\"javascript:uploader('news','img');\"><img src='images/file_up.gif' border=0 alt='$phrases[upload_file]'></a>
                                 </td></tr></table>
                                 </td></tr>";

              /*           <tr><td><b>«·ﬁ«·» : </b></td><td><select name=template><option value='0' $def_chk> «·ﬁ«·» «·«› —«÷Ì </option>";
              $qr_template = db_query("select name,id from songs_templates where protected !=1 order by id ");
              while($data_template = db_fetch($qr_template)){
              if($data['template'] == $data_template['id']){
                      $chk = "selected" ;
                      }else{
                              $chk = "";
                              }

                      print "<option value='$data_template[id]' $chk>$data_template[name]</option>";
                      }
                      print "</select></td></tr>"; */
                      print " <tr>
                                <td colspan=2>
                <center><input type=\"submit\" value=\" ⁄œÌ·\">
                        </td>
                        </tr>





                </table>

</form>    </center>\n";

                      }
<?
//----- send file -----//
if($action=="send_file"){
     open_table("«—”«· „·›");  
     
    print " <script type=\"text/javascript\" src=\"ajax_send_file.js\"></script>       
    <script>
    
    function send_file_confirm_fields(){
     
       
    if($('type').value == 'audio'){
      if($('cat').value && $('singer').value && $('datafile').value){ 
      return true;
      }else{
       alert('Ì—ÃÏ «ﬂ„«· Ã„Ì⁄ «·ÕﬁÊ·');
    return false;
      }
    }else if($('type').value == 'video'){
    if($('cat').value && $('datafile').value){
    return true;
    }else{
    alert('Ì—ÃÏ «ﬂ„«· Ã„Ì⁄ «·ÕﬁÊ·');
    return false;
    }
    }else{
    alert('Ì—ÃÏ «ﬂ„«· Ã„Ì⁄ «·ÕﬁÊ·');
    return false;
    }
    }
    </script>
    <div id='ajax_loading' style=\"display:none;\"><img src='images/ajax_loading.gif'></div>
  
    <div id='send_file_form_div'>
     <form action=\"index.php\" method=\"post\" enctype=\"multipart/form-data\" name=send_file_form>          
       <input style=\"display:none;\" name='send_file_submit' type=submit value=' «÷«›… '>
     </form>
     </div>
    
       
      
    <script>
    get_send_file_form('audio',0);
    </script>";
    close_table();
}

//----------------------------
if($action=="send_file_ok"){
    $cat=intval($cat);
    $singer = intval($singer);
    
    
 open_table("«—”«· „·›");
  if(check_member_login()){ 
  
  if(is_uploaded_file($_FILES['datafile']['tmp_name'])){
      
 if($name){     
 $userid=intval($member_data['id']);
  
   $upload_folder = $settings['uploader_path']."/members_files" ; 
           
      if(!$upload_folder || !file_exists(CWD ."/$upload_folder")){
     print("<center>$phrases[err_wrong_uploader_folder]</center>");
   
      }else{

 require_once(CWD. "/includes/class_save_file.php");  
      
   
$imtype = strtolower(file_extension($_FILES['datafile']['name']));

if(in_array($imtype,$upload_types)){   
    
$fl = new save_file($_FILES['datafile']['tmp_name'],$upload_folder,$_FILES['datafile']['name']);

if($fl->status){
    
$saveto_filename =  $fl->saved_filename;   

//--------- img ----------------//

if(is_uploaded_file($_FILES['img_datafile']['tmp_name'])){
$img_upload_types = array('gif','jpg','png','bmp');
$img_imtype = strtolower(file_extension($_FILES['img_datafile']['name']));

if(in_array($img_imtype,$img_upload_types)){
$fl = new save_file($_FILES['img_datafile']['tmp_name'],$upload_folder,$_FILES['img_datafile']['name']);

if($fl->status){
$img_saved =  $fl->saved_filename;      
}else{
    $img_warn =1;
}    
}else{
    $img_warn = 1;
}
}
//-------------------------------//


db_query("insert into members_files (name,url,img,details,userid,cat,date,singer,filetype) values ('".db_clean_string($name)."','$saveto_filename','$img_saved','".db_clean_string($details)."','$userid','$cat',now(),'$singer','$type')");
print "<center> ‘ﬂ—« ·ﬂ , ·ﬁœ  „ «—”«· «·„·› »‰Ã«Õ Ê ”Ê›  ﬁÊ„ «·«œ«—… »„—«Ã⁄ Â ›Ì «ﬁ—» Êﬁ  „„ﬂ‰ </center>";
}else{
print("<center>".$fl->last_error_description."</center>");
die();    
}
}else{
    print "<center> ‰Ê⁄ «·„·› €Ì— „”„ÊÕ »Â </center>";
}
      }
  }else{
      print "<center>  ·„ Ì „ «Œ Ì«— «·„·› </center>";
  }
  }else{
        print "<center> ·„ Ì „ «œŒ«· «”„ «·„·› </center>"; 
  }
  }else{
        print "<center> Ì—ÃÏ  ”ÃÌ· «·œŒÊ·  </center>";
    }
close_table();
}
?>
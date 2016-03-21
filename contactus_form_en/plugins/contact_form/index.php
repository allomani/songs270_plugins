<?

if(!defined("CUR_FILENAME")){
        die("You can't access file directly ... ");
}


//------------------------------- Contact US -------------------
 
    if($action=="contactus_form"){

            if($contactus_ok){
     if($sec_img->verify_string($sec_string)){  
    if($email_name && $email_email && $email_msg && $email_subject){
    $msg_full = "Name: $email_name\n\rEmail: $email_email\n\rIP: ".getenv("REMOTE_ADDR")."\n\r----------------\n\r\n\r$email_msg" ;
    $msg_full = htmlspecialchars($msg_full);
    
    $mailResult = send_email($email_name,$mailing_email,$admin_email,$email_subject ,$msg_full);
    open_table();
    if($mailResult){
            print "<center>  Thank You , Message Sent Successfully </center>";
            }else{
                    print "<center>  Message could not be sent , try again later </center>";
                    }
    close_table();
    }else{
     open_table();
     print "<center> Please Fill All fields </center>";
     close_table();   
    }
            }else{
           open_table(); 
             print  "<center>$phrases[err_sec_code_not_valid]</center>"; 
           close_table();           
            }
    }else{

       ?>
<SCRIPT LANGUAGE="Javascript">

function emailCheck (emailStr) {
var emailPat=/^(.+)@(.+)$/
var specialChars="\\(\\)<>@,;:\\\\\\\"\\.\\[\\]"
var validChars="\[^\\s" + specialChars + "\]"
var quotedUser="(\"[^\"]*\")"
var ipDomainPat=/^\[(\d{1,3})\.(\d{1,3})\.(\d{1,3})\.(\d{1,3})\]$/
var atom=validChars + '+'
var word="(" + atom + "|" + quotedUser + ")"
var userPat=new RegExp("^" + word + "(\\." + word + ")*$")
var domainPat=new RegExp("^" + atom + "(\\." + atom +")*$")
var matchArray=emailStr.match(emailPat)
if (matchArray==null) {
        alert("Invalid Email")
        return false
}
var user=matchArray[1]
var domain=matchArray[2]
if (user.match(userPat)==null) {
           alert("Invalid Email")
    return false
}
var IPArray=domain.match(ipDomainPat)
if (IPArray!=null) {
    // this is an IP address
          for (var i=1;i<=4;i++) {
            if (IPArray[i]>255) {
                     alert("Invalid Email")
                return false
            }
    }
    return true
}
var domainArray=domain.match(domainPat)
if (domainArray==null) {
                alert("Invalid Email")
    return false
}

var atomPat=new RegExp(atom,"g")
var domArr=domain.match(atomPat)
var len=domArr.length
if (domArr[domArr.length-1].length<2 ||
    domArr[domArr.length-1].length>3) {
         alert("Invalid Email")
   return false
}

if (len<2) {
   var errStr="This address is missing a hostname!"
   alert(errStr)
   return false
}

return true;
}
</script>
<?
       print "<script type=\"text/javascript\" language=\"javascript\">
<!--
function checkbox3(theForm){
if (theForm.elements['email_name'].value && theForm.elements['email_email'].value && theForm.elements['email_msg'].value && theForm.elements['email_subject'].value){
if(emailCheck(theForm.elements['email_email'].value)){
return true ;
}else{
 return false ;
        }
}else{
alert (\"Please Complete All fields\");
return false ;
}
}
//-->
</script>\n";

              open_table("Contact Us");
                print "<center>
              <form action=index.php method=post onsubmit=\"return checkbox3(this)\">

              <input type=hidden name=action value=contactus_form>
              <input type=hidden name=contactus_ok value='1'>
              <table width=60%>

              <tr>
              <td width=23%> Name  : </td>
              <td>
              <input name='email_name' type='text' size=30>
              </td>
              </tr>

                <tr>
              <td> Email : </td>
              <td>
              <input name='email_email' type='text' size=30>
              </td>
              </tr>

                  <tr>
              <td> Subject : </td>
              <td>
              <input name='email_subject' type='text' size=30>
              </td>
              </tr>
            <tr>
              <td> Message  : </td>
              <td>
             <textarea name='email_msg' rows=5 cols=40></textarea>
              </td>
              </tr>
             <tr>
             <td>$phrases[security_code]</td><td>".$sec_img->output_input_box('sec_string','size=7')."
           &nbsp;<img src=\"sec_image.php\" alt=\"Verification Image\" /></td></tr>
           
              <tr><td colspan=2 align=center>
             <input type=submit style='width: 90 ; height: 25' value='Send'>
             </td> </tr>
             </form>
             </table>
            </center> ";


      close_table();
      }
          }
  ?>
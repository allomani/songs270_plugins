<?
//------------ next and prev Singer ---------//
if($action=="songs"){
    
if($album_id){
    
   
$qr = db_query("select name,id,img from songs_albums where cat='$id' order by id desc");
if(db_num($qr) > 1){    
$i=0;
while($data=db_fetch($qr)){
    $list[$i]['name'] = $data['name'];
    $list[$i]['img'] = $data['img']; 
    $list[$i]['id'] = $data['id']; 
    if($data['id']==$album_id){$cur_index = $i;}
    $i++;
}

  
$prev_index = $cur_index - 1;
$next_index = $cur_index + 1;


open_table(); 
print  "<table width=100%><tr><td width=100 align=center>";
if($list[$prev_index]['name']){
print "
«·√·»Ê„ «·”«»ﬁ
<br><br>
<a href='album-$id-".$list[$prev_index]['id'].".html'>
<img src=\"".get_image($list[$prev_index]['img'])."\" width=65 height=65 border=0 title=\"".$list[$prev_index]['name']."\"><br>
".$list[$prev_index]['name']."</a>";
}
print "</td>
<td></td>
<td width=100 align=center>";
 if($list[$next_index]['name']){
print "
«·√·»Ê„ «· «·Ì <br><br>
<a href='album-$id-".$list[$next_index]['id'].".html'>
<img src=\"".get_image($list[$next_index]['img'])."\" width=65 height=65 border=0 title=\"".$list[$next_index]['name']."\"><br>
".$list[$next_index]['name']."</a>";
}
print "</td></tr></table>";
    close_table();
    unset($list);  
}
}





$data_singer =db_qr_fetch("select cat from songs_singers where id='$id'");
$qr = db_query("select name,id,img from songs_singers where cat='$data_singer[cat]' order by binary name asc");
if(db_num($qr) > 1){   
    open_table();  
$i=0;
while($data=db_fetch($qr)){
    $list[$i]['name'] = $data['name'];
    $list[$i]['img'] = $data['img']; 
    $list[$i]['id'] = $data['id']; 
    if($data['id']==$id){$cur_index = $i;}
    $i++;
}

  
$prev_index = $cur_index - 1;
$next_index = $cur_index + 1;

print  "<table width=100%><tr><td width=100 align=center>";
if($list[$prev_index]['name']){
print "
«·„€‰Ì «·”«»ﬁ
<br><br>
<a href='singer-".$list[$prev_index]['id'].".html'>
<img src=\"".get_image($list[$prev_index]['img'])."\" width=65 height=65 border=0 title=\"".$list[$prev_index]['name']."\"><br>
".$list[$prev_index]['name']."</a>";
}
print "</td>
<td></td>
<td width=100 align=center>";
 if($list[$next_index]['name']){
print "
«·„€‰Ì «· «·Ì <br><br>
<a href='singer-".$list[$next_index]['id'].".html'>
<img src=\"".get_image($list[$next_index]['img'])."\" width=65 height=65 border=0 title=\"".$list[$next_index]['name']."\"><br>
".$list[$next_index]['name']."</a>";
}
print "</td></tr></table>";
close_table();
}
 
}
?>
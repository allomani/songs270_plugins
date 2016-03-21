<?
//------------ next and prev Singer ---------//
if($action=="songs"){
open_table();
$data_singer =db_qr_fetch("select cat from songs_singers where id='$id'");
$qr = db_query("select name,id from songs_singers where cat='$data_singer[cat]' order by binary name asc");

$i=0;
while($data=db_fetch($qr)){
    $list[$i]['name'] = $data['name'];
    $list[$i]['id'] = $data['id']; 
    if($data['id']==$id){$cur_index = $i;}
    $i++;
}

  
$prev_index = $cur_index - 1;
$next_index = $cur_index + 1;

print  "<table width=100%><tr><td width=50% align=right>";
if($list[$prev_index]['name']){
print "«·„€‰Ì «·”«»ﬁ : <a href='singer-".$list[$prev_index]['id'].".html'>".$list[$prev_index]['name']."</a>";
}
print "</td><td width=50% align=left>";
 if($list[$next_index]['name']){
print "«·„€‰Ì «· «·Ì : <a href='singer-".$list[$next_index]['id'].".html'>".$list[$next_index]['name']."</a>";
}
print "</td></tr></table>";
close_table();
}
?>
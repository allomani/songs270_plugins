<?
//------------ next and prev Songs ---------//
if($action=="listen"){
open_table();
$data_singer =db_qr_fetch("select album from songs_songs where id='$id'");
$qr = db_query("select name,id from songs_songs where album='$data_singer[album]' order by binary name asc");

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
print "«·«€‰Ì… «·”«»ﬁ… : <a href='index.php?action=listen&id=".$list[$prev_index]['id']."'>".$list[$prev_index]['name']."</a>";
}
print "</td><td width=50% align=left>";
 if($list[$next_index]['name']){
print "«·«€‰Ì… «· «·Ì… : <a href='index.php?action=listen&id=".$list[$next_index]['id']."'>".$list[$next_index]['name']."</a>";
}
print "</td></tr></table>";
close_table();
}
?>
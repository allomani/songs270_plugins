<?
//------------ next and prev Singer ---------//
if($action=="browse" && $op=="cat"){
open_table();

$qr = db_query("select name,id from songs_cats order by ord asc");

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
print "Prev. Cat. : <a href='cat-".$list[$prev_index]['id'].".html'>".$list[$prev_index]['name']."</a>";
}
print "</td><td width=50% align=left>";
 if($list[$next_index]['name']){
print "Next Cat. : <a href='cat-".$list[$next_index]['id'].".html'>".$list[$next_index]['name']."</a>";
}
print "</td></tr></table>";
close_table();
}
?>
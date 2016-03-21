<?
//------------ next and prev Photos ---------//
if($action=="photos_preview"){
open_table();
$data_cat=db_qr_fetch("select cat from photos_data where id='$id'");
$qr = db_query("select id,thumb from photos_data where cat='$data_cat[cat]' order by id DESC");

$i=0;
while($data=db_fetch($qr)){
    $list[$i]['thumb'] = $data['thumb']; 
    $list[$i]['id'] = $data['id']; 
    if($data['id']==$id){$cur_index = $i;}
    $i++;
}

  
$prev_index = $cur_index - 1;
$next_index = $cur_index + 1;

print  "<table width=100%><tr><td width=50% align=right>";
if($list[$prev_index]['id']){
print "<a href='index.php?action=photos_preview&id=".$list[$prev_index]['id']."'><img src=\"".get_image($list[$prev_index]['thumb'])."\" border=0><br>Previous</a>";
}
print "</td><td width=50% align=left>";
 if($list[$next_index]['id']){
print "<a href='index.php?action=photos_preview&id=".$list[$next_index]['id']."'><img src=\"".get_image($list[$next_index]['thumb'])."\" border=0><br>Next</a>";
}
print "</td></tr></table>";
close_table();
}
?>
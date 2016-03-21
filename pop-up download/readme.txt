upload download_pop.php file then

add this value in js_functions template

-----------------------
function dwn(id,cat)
{

msgwindow=window.open("download_pop.php?id="+id+"&cat="+cat,"displaywindow","toolbar=no,scrollbars=no,width=450,height=250,top=200,left=200")
}

----------------------

replace links_song_listen template with this value

-----------------------------
javascript:dwn({id},{cat});
----------------------------

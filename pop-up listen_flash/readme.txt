1. upload files to script's folder..


2. add this value in js_functions template before </script>

-----------------------
function lsn(id,cat)
{

msgwindow=window.open("listen.php?id="+id+"&cat="+cat,"displaywindow","toolbar=no,scrollbars=no,width=450,height=250,top=200,left=200")
}

----------------------

3. replace links_song_listen template with this value

-----------------------------
javascript:lsn({id},{cat});
----------------------------
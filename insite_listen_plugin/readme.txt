Insite Listen Plugin
Songs v2.7
---------------------


1.upload plugins folder into your script path
2. edit .htaccess and find :

RewriteRule ^song_listen_(.*)_(.*) download.php?op=listen&id=$1&cat=$2
RewriteRule ^song_listen_(.*) download.php?op=listen&id=$1


replace it with

RewriteRule ^song_listen_(.*)_(.*) index.php?action=listen&id=$1&cat=$2
RewriteRule ^song_listen_(.*) index.php?action=listen&id=$1


Done.

-------------------------
Allomani
www.allomani.com
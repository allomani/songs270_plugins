Insite Watch Plugin
Songs v2.7
---------------------


1.upload plugins folder into your script path
2. edit .htaccess and find :


RewriteRule ^video_watch_(.*) download.php?action=video&op=watch&id=$1

replace it with


RewriteRule ^video_watch_(.*) index.php?action=preview&id=$1

Done.

-------------------------
Allomani
www.allomani.com
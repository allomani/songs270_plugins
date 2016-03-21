<?
require("global.php");
print "<?xml version=\"1.0\" encoding=\"$settings[site_pages_encoding]\" ?> \n";
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.google.com/schemas/sitemap/0.84 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
<?
      $page = intval($page);
      if(!$page){$page=1;}
      $perpage =  50000 ;
      $start = (($page-1) * $perpage) ;
      

$qr=db_query("select id from songs_videos_data order by id desc limit $start,$perpage");
while($data = db_fetch($qr)){
print "<url>
<loc>".htmlentities("$scripturl/".get_template('links_video_watch','{id}',$data['id']))."</loc>
<changefreq>daily</changefreq>
<priority>0.50</priority>
</url>";    
}

print "</urlset>";


<?php 
	header("Content-Type: application/rss+xml; charset=ISO-8859-1");
?>
<xml version="1.0" encoding="ISO-8859-1">
<rss version="2.0">
<channel>
<title> <?= $rss['title']; ?> </title>
<link> <?= $rss['link']; ?> </link>
<description> <?= $rss['description']; ?> </description>
<language> <?= $rss['language']; ?> </language>
<copyright> <?= $rss['copyright']; ?> </copyright>

<?php foreach($rss['struct'] as $title => $option): ?>

<item>
	<title><?= $title ?> </title>
	<link><?= "link" ?> </link>
	<guid><?= "link" ?> </guid>
	<pubDate><?= "date" ?> </pubDate>
	<description><?= "description" ?> </description>
</item>

<?php endforeach ?>

</channel>
</rss>
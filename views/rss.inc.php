<?php 
	header("Content-Type: application/rss+xml; charset=ISO-8859-1");
?>
<xml version="1.0" encoding="ISO-8859-1">
<rss version="2.0">
<channel>
<title> <?= $feed['title']; ?> </title>
<link> <?= $feed['link']; ?> </link>
<description> <?= $feed['description']; ?> </description>
<language> <?= $feed['language']; ?> </language>
<copyright> <?= $feed['copyright']; ?> </copyright>

<?php foreach($feed['struct'] as $title => $option): ?>

<item>
	<title><?= $title['teamName'] ?> </title>
	<link><?= $title['id'] ?> </link>
	<guid><?= "test" ?> </guid>
	<pubDate><?= $title['dateCreated'] ?> </pubDate>
	<description><?= $title['description'] ?> </description>
</item>

<?php endforeach ?>

</channel>
</rss>
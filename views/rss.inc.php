

<xml version="1.0" encoding="utf-8">
<rss version="2.0">
<channel>
<title> <?= $rss['title']; ?> </title>
<link> <?= $rss['link']; ?> </link>
<description> <?php $rss['description'] ?></description>

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
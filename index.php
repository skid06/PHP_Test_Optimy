<?php
require_once __DIR__ . '/vendor/autoload.php';

use Utils\NewsManager;
use Utils\CommentManager;
use Utils\DB;

$db = DB::getInstance();

$commentManager = new CommentManager($db);
$newsManager = new NewsManager($db);


// $newsManager->addNews('Star wars V', 'Episode 5 - The Empire Strikes Back');
// $newsManager->delete(18);

foreach ($newsManager->list() as $keys => $news) {
	echo ("############ NEWS " . $news->getTitle() . " ############\n");
	echo ($news->getBody() . "\n");

	// if ($news->getTitle() === "Star wars V") {
	// 	$commentManager->addCommentForNews("Strikes Back comment 1", $news->getId());
	// 	$commentManager->addCommentForNews("Strikes Back comment 2", $news->getId());
	// }

	foreach ($commentManager->list() as $comment) {
		if ($comment->getNewsId() == $news->getId()) {
			echo ("Comment " . $comment->getId() . " : " . $comment->getBody() . "\n");
		}
	}
}
// $commentManager->delete(34);
// $commentManager = CommentManager::getInstance();
// $c = $commentManager->listComments();

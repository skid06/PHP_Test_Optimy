<?php
require_once __DIR__ . '/vendor/autoload.php';

use Utils\NewsManager;
use Utils\CommentManager;
// define('ROOT', __DIR__);
// require_once(ROOT . '/utils/NewsManager.php');
// require_once(ROOT . '/utils/CommentManager.php');

foreach (NewsManager::getInstance()->listNews() as $news) {
	echo ("############ NEWS " . $news->getTitle() . " ############\n");
	echo ($news->getBody() . "\n");
	foreach (CommentManager::getInstance()->listComments() as $comment) {
		if ($comment->getNewsId() == $news->getId()) {
			echo ("Comment " . $comment->getId() . " : " . $comment->getBody() . "\n");
		}
	}
}

$commentManager = CommentManager::getInstance();
$c = $commentManager->listComments();

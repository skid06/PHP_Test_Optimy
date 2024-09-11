<?php

namespace Utils;

use Utils\CommentManager;
use Utils\DB;
use Model\News;

class NewsManager
{
	private static ?self $instance = null;
	private DB $db;

	// Constructor is private to prevent direct instantiation.
	private function __construct()
	{
		$this->db = DB::getInstance();
	}

	/**
	 * Uses new self() instead of new $c for instantiating the class
	 * It avoids potential issues with class name changes or subclassing.
	 */
	public static function getInstance(): self
	{
		if (self::$instance === null) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * list all news
	 */
	public function listNews()
	{
		$rows = $this->db->select('SELECT * FROM `news`');

		$newsList = [];
		foreach ($rows as $row) {
			$news = new News(
				(int)$row['id'],
				$row['created_at'],
				$row['title'],
				$row['body']
			);

			$newsList[] = $news;
		}

		return $newsList;
	}

	/**
	 * add a record in news table
	 */
	public function addNews($title, $body)
	{
		$sql = "INSERT INTO `news` (`title`, `body`, `created_at`) VALUES (:title, :body, :created_at)";
		$params = [
			':title' => $title,
			':body' => $body,
			':created_at' => date('Y-m-d')
		];

		$this->db->exec($sql, $params);

		return $this->db->lastInsertId();
	}

	/**
	 * deletes a news, and also linked comments
	 */
	public function deleteNews($id)
	{
		$comments = CommentManager::getInstance()->listComments();
		$idsToDelete = [];

		foreach ($comments as $comment) {
			if ($comment->getNewsId() == $id) {
				$idsToDelete[] = $comment->getId();
			}
		}

		foreach ($idsToDelete as $commentId) {
			CommentManager::getInstance()->deleteComment($commentId);
		}

		$sql = "DELETE FROM `news` WHERE `id` = :id";
		$params = [':id' => $id];

		return $this->db->exec($sql, $params);
	}
}

<?php

namespace Utils;

use Utils\DB;
use Model\Comment;

class CommentManager
{
	private static ?self $instance = null;
	private DB $db;

	// Constructor is private to prevent direct instantiation.
	private function __construct()
	{
		$this->db = DB::getInstance();
	}

	public static function getInstance(): self
	{
		if (self::$instance === null) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	public function listComments()
	{
		$rows = $this->db->select('SELECT * FROM `comment`');

		$comments = [];
		foreach ($rows as $row) {
			$n = new Comment();
			$comments[] = $n->setId($row['id'])
				->setBody($row['body'])
				->setCreatedAt($row['created_at'])
				->setNewsId($row['news_id']);
		}

		return $comments;
	}

	public function addCommentForNews($body, $newsId)
	{
		$sql = "INSERT INTO `comment` (`body`, `created_at`, `news_id`) VALUES (:body, :created_at, :news_id)";
		$params = [
			':body' => $body,
			':created_at' => date('Y-m-d'),
			':news_id' => $newsId,
		];
		$this->db->exec($sql, $params);

		return $this->db->lastInsertId();
	}

	public function deleteComment($id)
	{
		$sql = "DELETE FROM `comment` WHERE `id` = :id";
		$params = [':id' => $id];

		return $this->db->exec($sql, $params);
	}
}

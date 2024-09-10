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

		$commentList = [];
		foreach ($rows as $row) {
			$comment = new Comment(
				$row['id'],
				$row['created_at'],
				$row['body'],
				$row['news_id']
			);

			$commentList[] = $comment;
		}

		return $commentList;
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

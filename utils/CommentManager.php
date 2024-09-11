<?php

namespace Utils;

use Model\Comment;

class CommentManager extends BaseManager
{
	public function __construct(DB $db)
	{
		parent::__construct($db);
	}

	/**
	 * Retrieves a list of all comments.
	 * 
	 * @return Comment[] Array of Comment objects.
	 */
	public function list(): array
	{
		$rows = $this->query('SELECT * FROM `comment`');

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

	/**
	 * Adds a new comment for a specific news item.
	 * 
	 * @param string $body The content of the comment.
	 * @param int $newsId The ID of the news item.
	 * 
	 * @return int The ID of the newly inserted comment.
	 */
	public function addCommentForNews(string $body, int $newsId): int
	{
		$sql = "INSERT INTO `comment` (`body`, `created_at`, `news_id`) VALUES (:body, :created_at, :news_id)";
		$params = [
			':body' => $body,
			':created_at' => date('Y-m-d H:i:s'),
			':news_id' => $newsId,
		];

		$this->execute($sql, $params);

		return $this->db->lastInsertId();
	}

	/**
	 * Deletes a comment by its ID.
	 * 
	 * @param int $id The ID of the comment to delete.
	 * 
	 * @return bool Whether the deletion was successful.
	 */
	public function delete(int $id): bool
	{
		$sql = "DELETE FROM `comment` WHERE `id` = :id";
		$params = [':id' => $id];

		return $this->execute($sql, $params);
	}
}

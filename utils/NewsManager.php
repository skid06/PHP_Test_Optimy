<?php

namespace Utils;

use Model\News;
use Utils\CommentManager;

class NewsManager extends BaseManager
{
	public function __construct(DB $db)
	{
		parent::__construct($db);
	}

	/**
	 * Retrieves a list of all news items.
	 * 
	 * @return News[] Array of News objects.
	 */
	public function list(): array
	{
		$rows = $this->query('SELECT * FROM `news`');


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
	 * Adds a new news item.
	 * 
	 * @param string $title The title of the news item.
	 * @param string $body The content of the news item.
	 * 
	 * @return int The ID of the newly inserted news item.
	 */
	public function addNews(string $title, string $body): int
	{
		$sql = "INSERT INTO `news` (`title`, `body`, `created_at`) VALUES (:title, :body, :created_at)";
		$params = [
			':title' => $title,
			':body' => $body,
			':created_at' => date('Y-m-d H:i:s')
		];

		$this->execute($sql, $params);

		return $this->db->lastInsertId();
	}

	/**
	 * Deletes a news item and its associated comments.
	 * 
	 * @param int $id The ID of the news item to delete.
	 * 
	 * @return bool Whether the deletion was successful.
	 */
	public function delete(int $id): bool
	{
		// Delete related comments first
		$commentManager = new CommentManager($this->db);
		$comments = $commentManager->list();

		$idsToDelete = array_filter($comments, fn($comment) => $comment->getNewsId() === $id);
		foreach ($idsToDelete as $comment) {
			$commentManager->delete($comment->getId());
		}

		// Delete news item
		$sql = "DELETE FROM `news` WHERE `id` = :id";
		$params = [':id' => $id];

		return $this->execute($sql, $params);
	}
}

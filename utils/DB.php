<?php

namespace Utils;

class DB
{
	private $pdo;

	private static $instance = null;

	private function __construct()
	{
		$dsn = 'mysql:dbname=phptest;host=127.0.0.1';
		$user = 'root';
		$password = '';

		$this->pdo = new \PDO($dsn, $user, $password);
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

	public function select($sql)
	{
		$sth = $this->pdo->query($sql);
		return $sth->fetchAll();
	}

	public function exec($sql, $params)
	{
		$stmt = $this->pdo->prepare($sql);

		return $stmt->execute($params);
	}

	public function lastInsertId()
	{
		return $this->pdo->lastInsertId();
	}
}

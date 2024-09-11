<?php

namespace Utils;

use Utils\DB;

abstract class BaseManager
{
      protected DB $db;

      public function __construct(DB $db)
      {
            $this->db = $db;
      }

      abstract protected function list(): array;

      abstract protected function delete(int $id): bool;

      /**
       * Perform a database query and return the result.
       * 
       * @param string $sql The SQL query.
       * @param array $params The query parameters.
       * 
       * @return array The query result.
       */
      protected function query(string $sql, array $params = []): array
      {
            return $this->db->select($sql, $params);
      }

      /**
       * Execute a database command.
       * 
       * @param string $sql The SQL command.
       * @param array $params The command parameters.
       * 
       * @return bool Whether the execution was successful.
       */
      protected function execute(string $sql, array $params = []): bool
      {
            return $this->db->exec($sql, $params);
      }
}

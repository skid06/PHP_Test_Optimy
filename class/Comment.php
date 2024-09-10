<?php

namespace Model;

class Comment extends BaseEntity
{
      private string $body;
      private int $newsId;

      public function __construct(int $id, string $createdAt, string $body, int $newsId)
      {
            parent::__construct($id, $createdAt);
            $this->newsId = $newsId;
            $this->body = $body;
      }

      public function getBody(): string
      {
            return $this->body;
      }

      public function getNewsId(): int
      {
            return $this->newsId;
      }
}

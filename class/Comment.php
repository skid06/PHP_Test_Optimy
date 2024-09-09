<?php

namespace Model;

// require_once __DIR__ . '/BaseEntity.php';

class Comment extends BaseEntity
{
      private string $body;
      private int $newsId;

      public function setBody(string $body): self
      {
            $this->body = $body;
            return $this;
      }

      public function getBody(): string
      {
            return $this->body;
      }

      public function setNewsId(int $newsId): self
      {
            $this->newsId = $newsId;
            return $this;
      }

      public function getNewsId(): int
      {
            return $this->newsId;
      }
}

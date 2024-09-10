<?php

namespace Model;

class News extends BaseEntity
{
      private string $title;
      private string $body;

      public function __construct(int $id, string $createdAt, string $title, string $body)
      {
            parent::__construct($id, $createdAt);
            $this->title = $title;
            $this->body = $body;
      }

      public function getTitle(): string
      {
            return $this->title;
      }

      public function getBody(): string
      {
            return $this->body;
      }
}

<?php

namespace Model;

class News extends BaseEntity
{
      private string $title;
      private string $body;

      public function setTitle(string $title): self
      {
            $this->title = $title;
            return $this;
      }

      public function getTitle(): string
      {
            return $this->title;
      }

      public function setBody(string $body): self
      {
            $this->body = $body;
            return $this;
      }

      public function getBody(): string
      {
            return $this->body;
      }
}

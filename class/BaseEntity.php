<?php

namespace Model;

class BaseEntity
{
      protected int $id;
      protected $createdAt;

      public function __construct(int $id, string $createdAt)
      {
            $this->id = $id;
            $this->createdAt = $createdAt;
      }

      public function getId(): int
      {
            return $this->id;
      }

      public function getCreatedAt()
      {
            return $this->createdAt;
      }
}

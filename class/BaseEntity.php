<?php

namespace Model;

class BaseEntity
{
      protected int $id;
      protected $createdAt;

      public function setId(int $id): self
      {
            $this->id = $id;
            return $this;
      }

      public function getId(): int
      {
            return $this->id;
      }

      public function setCreatedAt($createdAt): self
      {
            $this->createdAt = $createdAt;
            return $this;
      }

      public function getCreatedAt()
      {
            return $this->createdAt;
      }
}

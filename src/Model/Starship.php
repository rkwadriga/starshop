<?php

namespace App\Model;

use DateTimeImmutable;

class Starship
{
    public function __construct(
        private int $id,
        private string $name,
        private string $class,
        private string $captain,
        private StarshipStatusEnum $status,
        private DateTimeImmutable $arrivedAt,
    ) {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getClass(): string
    {
        return $this->class;
    }

    public function getCaptain(): string
    {
        return $this->captain;
    }

    public function getStatus(): StarshipStatusEnum
    {
        return $this->status;
    }

    public function getStatusString(): string
    {
        return $this->status->value;
    }

    public function getStatusImgFileName(): string
    {
        return "images/status-{$this->status->value}.png";
    }

    public function getArrivedAt(): DateTimeImmutable
    {
        return $this->arrivedAt;
    }
}

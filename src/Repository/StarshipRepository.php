<?php

namespace App\Repository;

use App\Model\Starship;
use App\Model\StarshipStatusEnum;
use DateTimeImmutable;
use Psr\Log\LoggerInterface;

readonly class StarshipRepository
{
    public function __construct(
        private LoggerInterface $logger,
    ) {
    }

    public function findAll(): array
    {
        $this->logger->info('Starship collection retrieved');

        return [
            new Starship(
                1,
                'USS LeafyCruiser (NCC-0001)',
                'Garden',
                'Jean-Luc Pickles',
                StarshipStatusEnum::IN_PROGRESS,
                new DateTimeImmutable('-1 day'),
            ),
            new Starship(
                2,
                'USS Espresso (NCC-1234-C)',
                'Latte',
                'James T. Quick!',
                StarshipStatusEnum::COMPLETED,
                new DateTimeImmutable('-1 week'),
            ),
            new Starship(
                3,
                'USS Wanderlust (NCC-2024-W)',
                'Delta Tourist',
                'Kathryn Journeyway',
                StarshipStatusEnum::WAITING,
                new DateTimeImmutable('-1 month'),
            ),
        ];
    }

    public function findOne(int $id): ?Starship
    {
        return array_find($this->findAll(), fn ($starship) => $starship->getId() === $id);
    }
}

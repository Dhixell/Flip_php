<?php

namespace FlipPlay\Services;

use FlipPlay\Models\Media;

class Library
{
    /** @var Media[] */
    private array $mediaList = [];

    public function addMedia(Media $media): void
    {
        $this->mediaList[$media->getId()] = $media;
    }

    /**
     * @return Media[]
     */
    public function getAllMedia(): array
    {
        return array_values($this->mediaList);
    }

    public function findById(string $id): ?Media
    {
        return $this->mediaList[$id] ?? null;
    }

    /**
     * Mencari media berdasarkan kemiripan judul (case-insensitive)
     * @param string $keyword
     * @return Media[]
     */
    public function searchByTitle(string $keyword): array
    {
        $results = [];
        $lowerKeyword = strtolower($keyword);

        foreach ($this->mediaList as $media) {
            if (str_contains(strtolower($media->getTitle()), $lowerKeyword)) {
                $results[] = $media;
            }
        }

        return $results;
    }

    /**
     * Mengambil daftar media berdasarkan genre
     * @param string $genre
     * @return Media[]
     */
    public function filterByGenre(string $genre): array
    {
        $results = [];
        $lowerGenre = strtolower($genre);

        foreach ($this->mediaList as $media) {
            if (strtolower($media->getGenre()) === $lowerGenre) {
                $results[] = $media;
            }
        }

        return $results;
    }

    public function getTotalMediaCount(): int
    {
        return count($this->mediaList);
    }
}


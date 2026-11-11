<?php

namespace FlipPlay\Models;

abstract class Media
{
    protected string $id;
    protected string $title;
    protected string $genre;
    protected int $durationMinutes;
    protected int $releaseYear;

    public function __construct(
        string $id,
        string $title,
        string $genre,
        int $durationMinutes,
        int $releaseYear
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->genre = $genre;
        $this->durationMinutes = $durationMinutes;
        $this->releaseYear = $releaseYear;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getGenre(): string
    {
        return $this->genre;
    }

    public function getDurationMinutes(): int
    {
        return $this->durationMinutes;
    }

    public function getReleaseYear(): int
    {
        return $this->releaseYear;
    }

    public function getFormattedDuration(): string
    {
        $hours = intdiv($this->durationMinutes, 60);
        $minutes = $this->durationMinutes % 60;

        if ($hours > 0) {
            return "{$hours} jam {$minutes} menit";
        }
        return "{$minutes} menit";
    }

    // Abstract method yang wajib diimplementasikan oleh subclass
    abstract public function getType(): string;
    abstract public function getDetails(): string;

    public function play(): string
    {
        return "Sedang memutar {$this->getType()}: '{$this->title}' ({$this->releaseYear})...";
    }
}


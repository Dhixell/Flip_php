<?php

namespace FlipPlay\Models;

class Movie extends Media
{
    private string $director;
    private string $ageRating;

    public function __construct(
        string $id,
        string $title,
        string $genre,
        int $durationMinutes,
        int $releaseYear,
        string $director,
        string $ageRating = "PG-13"
    ) {
        parent::__construct($id, $title, $genre, $durationMinutes, $releaseYear);
        $this->director = $director;
        $this->ageRating = $ageRating;
    }

    public function getDirector(): string
    {
        return $this->director;
    }

    public function getAgeRating(): string
    {
        return $this->ageRating;
    }

    public function getType(): string
    {
        return "Film (Movie)";
    }

    public function getDetails(): string
    {
        return "=== DETAIL FILM ===\n" .
            "ID           : {$this->id}\n" .
            "Judul        : {$this->title}\n" .
            "Tipe         : {$this->getType()}\n" .
            "Genre        : {$this->genre}\n" .
            "Durasi       : {$this->getFormattedDuration()}\n" .
            "Tahun Rilis  : {$this->releaseYear}\n" .
            "Sutradara    : {$this->director}\n" .
            "Rating Usia  : {$this->ageRating}\n";
    }
}


<?php

namespace FlipPlay\Models;

class Music extends Media
{
    private string $artist;
    private string $album;

    public function __construct(
        string $id,
        string $title,
        string $genre,
        int $durationMinutes,
        int $releaseYear,
        string $artist,
        string $album
    ) {
        parent::__construct($id, $title, $genre, $durationMinutes, $releaseYear);
        $this->artist = $artist;
        $this->album = $album;
    }

    public function getArtist(): string
    {
        return $this->artist;
    }

    public function getAlbum(): string
    {
        return $this->album;
    }

    public function getType(): string
    {
        return "Musik / Lagu";
    }

    public function getDetails(): string
    {
        return "=== DETAIL MUSIK ===\n" .
            "ID           : {$this->id}\n" .
            "Judul        : {$this->title}\n" .
            "Tipe         : {$this->getType()}\n" .
            "Artis        : {$this->artist}\n" .
            "Album        : {$this->album}\n" .
            "Genre        : {$this->genre}\n" .
            "Durasi       : {$this->getFormattedDuration()}\n" .
            "Tahun Rilis  : {$this->releaseYear}\n";
    }
}


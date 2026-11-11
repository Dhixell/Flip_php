<?php

namespace FlipPlay\Models;

class User
{
    private string $userId;
    private string $name;
    private string $email;
    /** @var Media[] */
    private array $playlist = [];

    public function __construct(string $userId, string $name, string $email)
    {
        $this->userId = $userId;
        $this->name = $name;
        $this->email = $email;
    }

    public function getUserId(): string
    {
        return $this->userId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function addToPlaylist(Media $media): void
    {
        $this->playlist[$media->getId()] = $media;
    }

    public function removeFromPlaylist(string $mediaId): bool
    {
        if (isset($this->playlist[$mediaId])) {
            unset($this->playlist[$mediaId]);
            return true;
        }
        return false;
    }

    /**
     * @return Media[]
     */
    public function getPlaylist(): array
    {
        return array_values($this->playlist);
    }

    public function playMedia(Media $media): string
    {
        return "[User: {$this->name}] " . $media->play();
    }
}


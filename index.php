<?php

/**
 * FlipPlay Backend Engine Prototype - Simulation Entry Point
 * Modul 3: Pemrograman Web (PHP OOP)
 */

// Autoloader sederhana untuk namespace FlipPlay
spl_autoload_register(function (string $class): void {
    $prefix = 'FlipPlay\\';
    $baseDir = __DIR__ . '/src/';

    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }

    $relativeClass = substr($class, $len);
    $file = $baseDir . str_replace('\\', '/', $relativeClass) . '.php';

    if (file_exists($file)) {
        require_once $file;
    }
});

use FlipPlay\Models\Movie;
use FlipPlay\Models\Music;
use FlipPlay\Models\User;
use FlipPlay\Services\Library;

function printSeparator(string $title = ""): void
{
    echo "\n" . str_repeat("=", 60) . "\n";
    if (!empty($title)) {
        echo "  " . strtoupper($title) . "\n";
        echo str_repeat("=", 60) . "\n";
    }
}

echo "============================================================\n";
echo "           SELAMAT DATANG DI SIMULASI FLIPPLAY ENGINE       \n";
echo "              Backend Prototype berbasis PHP OOP            \n";
echo "============================================================\n";

// Inisialisasi Service Library
$library = new Library();

// Inisialisasi User
$user = new User("USR-001", "Axell Dhias", "axell@example.com");
echo "\n[INFO] Pengguna aktif: {$user->getName()} ({$user->getEmail()})\n";

// ============================================================
// SIMULASI 1: Menambahkan media ke dalam library
// ============================================================
printSeparator("1. Menambahkan Media ke dalam Library");

$movie1 = new Movie("MOV-01", "Inception", "Sci-Fi", 148, 2010, "Christopher Nolan", "PG-13");
$movie2 = new Movie("MOV-02", "Interstellar", "Sci-Fi", 169, 2014, "Christopher Nolan", "PG-13");
$movie3 = new Movie("MOV-03", "Spirited Away", "Animation", 125, 2001, "Hayao Miyazaki", "PG");

$music1 = new Music("MUS-01", "Bohemian Rhapsody", "Rock", 6, 1975, "Queen", "A Night at the Opera");
$music2 = new Music("MUS-02", "Viva La Vida", "Alternative", 4, 2008, "Coldplay", "Viva la Vida");
$music3 = new Music("MUS-03", "Sialan", "Pop", 4, 2023, "Juicy Luicy ft. Adrian Khalif", "Non-Album Single");

$allMediaToAdd = [$movie1, $movie2, $movie3, $music1, $music2, $music3];

foreach ($allMediaToAdd as $item) {
    $library->addMedia($item);
    echo " [+] Ditambahkan ke katalog: [{$item->getId()}] {$item->getTitle()} ({$item->getType()})\n";
}

echo " Total media dalam katalog: " . $library->getTotalMediaCount() . " item.\n";

// ============================================================
// SIMULASI 2: Menampilkan daftar media yang tersedia
// ============================================================
printSeparator("2. Daftar Media yang Tersedia di FlipPlay");

$catalog = $library->getAllMedia();
printf("%-8s | %-24s | %-14s | %-12s | %-6s\n", "ID", "Judul", "Tipe", "Genre", "Durasi");
echo str_repeat("-", 60) . "\n";

foreach ($catalog as $media) {
    printf(
        "%-8s | %-24s | %-14s | %-12s | %-6s\n",
        $media->getId(),
        substr($media->getTitle(), 0, 24),
        $media->getType(),
        $media->getGenre(),
        $media->getFormattedDuration()
    );
}

// ============================================================
// SIMULASI 3: Mencari media berdasarkan judul
// ============================================================
printSeparator("3. Pencarian Media Berdasarkan Judul");

$searchQueries = ["Inception", "Viva", "Avatar"];

foreach ($searchQueries as $query) {
    echo "\n>>> Mencari media dengan kata kunci: '{$query}'\n";
    $results = $library->searchByTitle($query);

    if (empty($results)) {
        echo " [x] Tidak ditemukan media dengan judul yang memuat '{$query}'.\n";
    } else {
        echo " [v] Ditemukan " . count($results) . " hasil:\n";
        foreach ($results as $item) {
            echo "     - [{$item->getId()}] {$item->getTitle()} ({$item->getType()} - {$item->getGenre()})\n";
        }
    }
}

// ============================================================
// SIMULASI 4: Menampilkan informasi detail suatu media
// ============================================================
printSeparator("4. Menampilkan Informasi Detail Suatu Media");

echo "Mencoba memuat detail untuk ID 'MOV-01' dan 'MUS-01':\n\n";

$targetMedia1 = $library->findById("MOV-01");
if ($targetMedia1 !== null) {
    echo $targetMedia1->getDetails() . "\n";
}

$targetMedia2 = $library->findById("MUS-01");
if ($targetMedia2 !== null) {
    echo $targetMedia2->getDetails() . "\n";
}

// ============================================================
// SIMULASI 5: Menampilkan koleksi media milik pengguna
// ============================================================
printSeparator("5. Koleksi Media Milik Pengguna ({$user->getName()})");

echo "Menambahkan beberapa media pilihan ke playlist pengguna...\n";
$user->addToPlaylist($movie1);
$user->addToPlaylist($music1);
$user->addToPlaylist($movie2);

echo " [v] Sukses menambahkan ke playlist.\n\n";
echo "Daftar Playlist Saat Ini:\n";
$userPlaylist = $user->getPlaylist();
foreach ($userPlaylist as $index => $item) {
    echo " " . ($index + 1) . ". [{$item->getId()}] {$item->getTitle()} ({$item->getType()}) - {$item->getFormattedDuration()}\n";
}

// Memutar media dari koleksi pengguna
echo "\n--- Simulasi Pemutaran Media oleh Pengguna ---\n";
echo " > " . $user->playMedia($movie1) . "\n";
echo " > " . $user->playMedia($music1) . "\n";

// Menghapus salah satu media dari playlist
echo "\n--- Menghapus Media MOV-02 dari Playlist ---\n";
$removed = $user->removeFromPlaylist("MOV-02");
if ($removed) {
    echo " [v] Media MOV-02 berhasil dihapus dari playlist.\n";
}

echo "\nDaftar Playlist Setelah Penghapusan:\n";
$updatedPlaylist = $user->getPlaylist();
foreach ($updatedPlaylist as $index => $item) {
    echo " " . ($index + 1) . ". [{$item->getId()}] {$item->getTitle()} ({$item->getType()})\n";
}

printSeparator("Simulasi Selesai dengan Sukses!");


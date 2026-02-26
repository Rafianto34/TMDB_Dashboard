<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\SyncLog;
use Illuminate\Support\Facades\Http;

class SyncController extends Controller
{
    private $genreMap = [
        28 => 'Action',
        12 => 'Adventure',
        16 => 'Animation',
        35 => 'Comedy',
        80 => 'Crime',
        18 => 'Drama',
        10749 => 'Romance',
        27 => 'Horror',
        53 => 'Thriller',
        878 => 'Science Fiction',
        14 => 'Fantasy',
        10751 => 'Family',
        9648 => 'Mystery',
        36 => 'History',
        99 => 'Documentary'
    ];

    public function syncMovies()
    {
        $apiKey = env('TMDB_API_KEY');

        $response = Http::get('https://api.themoviedb.org/3/movie/popular', [
            'api_key' => $apiKey,
            'language' => 'en-US',
            'page' => 1
        ]);

        if (!$response->successful()) {
            return back()->with('error', 'Gagal ambil data API');
        }

        $movies = $response->json()['results'];

        foreach ($movies as $movie) {

            // 🔥 Convert genre_ids → genre names
            $genreNames = [];

            if (isset($movie['genre_ids'])) {
                foreach ($movie['genre_ids'] as $genreId) {
                    if (isset($this->genreMap[$genreId])) {
                        $genreNames[] = $this->genreMap[$genreId];
                    }
                }
            }

            $genreString = implode(', ', $genreNames);

            Movie::updateOrCreate(
                ['tmdb_id' => $movie['id']],
                [
                    'title' => $movie['title'],
                    'release_date' => $movie['release_date'] ?? null,
                    'genre' => $genreString,
                    'popularity' => $movie['popularity'] ?? 0,
                    'fetched_at' => now()->timezone('Asia/Jakarta'),
                ]
            );
        }
        SyncLog::create([
            'last_sync_at' => now()->timezone('Asia/Jakarta')
        ]);

        return redirect('/dashboard')
            ->with('success', 'Sync berhasil dan genre sudah dikonversi!');
    }
}
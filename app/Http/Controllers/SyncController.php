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
        try {
            $apiKey = config('services.tmdb.api_key') ?? env('TMDB_API_KEY');

            if (!$apiKey) {
                throw new \Exception('TMDB API Key is missing in configuration. Please check your .env file.');
            }

            $response = Http::timeout(30)->get('https://api.themoviedb.org/3/movie/popular', [
                'api_key' => $apiKey,
                'language' => 'en-US',
                'page' => 1
            ]);

            if (!$response->successful()) {
                $errorMsg = $response->json()['status_message'] ?? 'Failed to fetch data from TMDB API. Check your API Key.';
                throw new \Exception($errorMsg);
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

            if (request()->ajax()) {
                return response()->json([
                    'success' => true, 
                    'message' => 'Sync success!',
                    'last_sync' => now()->timezone('Asia/Jakarta')->format('d M Y H:i:s')
                ]);
            }

            return redirect('/dashboard')
                ->with('success', 'Sync success!');

        } catch (\Exception $e) {
            \Log::error('Sync Error: ' . $e->getMessage());
            
            if (request()->ajax()) {
                return response()->json([
                    'success' => false, 
                    'message' => 'Error: ' . $e->getMessage()
                ], 500);
            }
            return back()->with('error', 'Sync Failed: ' . $e->getMessage());
        }
    }
}
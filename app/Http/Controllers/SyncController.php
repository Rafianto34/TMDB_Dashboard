<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\TvShow;
use App\Models\Person;
use App\Models\SyncLog;
use Illuminate\Support\Facades\Http;

class SyncController extends Controller
{
    private $genreMap = [
        28 => 'Action', 12 => 'Adventure', 16 => 'Animation', 35 => 'Comedy',
        80 => 'Crime', 18 => 'Drama', 10749 => 'Romance', 27 => 'Horror',
        53 => 'Thriller', 878 => 'Science Fiction', 14 => 'Fantasy',
        10751 => 'Family', 9648 => 'Mystery', 36 => 'History', 99 => 'Documentary'
    ];

    private $tvGenreMap = [
        10759 => 'Action & Adventure', 16 => 'Animation', 35 => 'Comedy',
        80 => 'Crime', 99 => 'Documentary', 18 => 'Drama', 10751 => 'Family',
        10762 => 'Kids', 9648 => 'Mystery', 10763 => 'News', 10764 => 'Reality',
        10765 => 'Sci-Fi & Fantasy', 10766 => 'Soap', 10767 => 'Talk',
        10768 => 'War & Politics', 37 => 'Western'
    ];

    public function syncMovies()
    {
        try {
            $apiKey = config('services.tmdb.api_key') ?? env('TMDB_API_KEY');

            if (!$apiKey) {
                throw new \Exception('TMDB API Key is missing in configuration. Please check your .env file.');
            }

            $this->syncMoviesData($apiKey);
            $this->syncTvShowsData($apiKey);
            $this->syncPeopleData($apiKey);

            SyncLog::create([
                'last_sync_at' => now()->timezone('Asia/Jakarta')
            ]);

            if (request()->ajax()) {
                return response()->json([
                    'success' => true, 
                    'message' => 'All data synced successfully!',
                    'last_sync' => now()->timezone('Asia/Jakarta')->format('d M Y H:i:s')
                ]);
            }

            return redirect('/dashboard')->with('success', 'All data synced successfully!');

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

    private function syncMoviesData($apiKey)
    {
        $response = Http::timeout(30)->get('https://api.themoviedb.org/3/movie/popular', [
            'api_key' => $apiKey,
            'language' => 'en-US',
            'page' => 1
        ]);

        if (!$response->successful()) {
            throw new \Exception('Failed to fetch Movies.');
        }

        foreach ($response->json()['results'] as $movie) {
            $genreNames = [];
            if (isset($movie['genre_ids'])) {
                foreach ($movie['genre_ids'] as $genreId) {
                    if (isset($this->genreMap[$genreId])) $genreNames[] = $this->genreMap[$genreId];
                }
            }

            Movie::updateOrCreate(
                ['tmdb_id' => $movie['id']],
                [
                    'title' => $movie['title'],
                    'release_date' => $movie['release_date'] ?? null,
                    'genre' => implode(', ', $genreNames),
                    'popularity' => $movie['popularity'] ?? 0,
                    'poster_path' => $movie['poster_path'] ?? null,
                    'overview' => $movie['overview'] ?? null,
                    'fetched_at' => now()->timezone('Asia/Jakarta'),
                ]
            );
        }
    }

    private function syncTvShowsData($apiKey)
    {
        $response = Http::timeout(30)->get('https://api.themoviedb.org/3/tv/popular', [
            'api_key' => $apiKey,
            'language' => 'en-US',
            'page' => 1
        ]);

        if (!$response->successful()) {
            throw new \Exception('Failed to fetch TV Shows.');
        }

        foreach ($response->json()['results'] as $tv) {
            $genreNames = [];
            if (isset($tv['genre_ids'])) {
                foreach ($tv['genre_ids'] as $genreId) {
                    if (isset($this->tvGenreMap[$genreId])) $genreNames[] = $this->tvGenreMap[$genreId];
                }
            }

            TvShow::updateOrCreate(
                ['tmdb_id' => $tv['id']],
                [
                    'name' => $tv['name'],
                    'first_air_date' => $tv['first_air_date'] ?? null,
                    'genre' => implode(', ', $genreNames),
                    'popularity' => $tv['popularity'] ?? 0,
                    'vote_average' => $tv['vote_average'] ?? 0,
                    'poster_path' => $tv['poster_path'] ?? null,
                    'overview' => $tv['overview'] ?? null,
                ]
            );
        }
    }

    private function syncPeopleData($apiKey)
    {
        $response = Http::timeout(30)->get('https://api.themoviedb.org/3/person/popular', [
            'api_key' => $apiKey,
            'language' => 'en-US',
            'page' => 1
        ]);

        if (!$response->successful()) {
            throw new \Exception('Failed to fetch People.');
        }

        foreach ($response->json()['results'] as $person) {
            // Fetch individual person detail for biography
            $detailResponse = Http::timeout(30)->get("https://api.themoviedb.org/3/person/{$person['id']}", [
                'api_key' => $apiKey,
                'language' => 'en-US'
            ]);

            $biography = null;
            if ($detailResponse->successful()) {
                $biography = $detailResponse->json()['biography'] ?? null;
            }

            Person::updateOrCreate(
                ['tmdb_id' => $person['id']],
                [
                    'name' => $person['name'],
                    'known_for_department' => $person['known_for_department'] ?? null,
                    'popularity' => $person['popularity'] ?? 0,
                    'profile_path' => $person['profile_path'] ?? null,
                    'biography' => $biography,
                ]
            );
        }
    }
}
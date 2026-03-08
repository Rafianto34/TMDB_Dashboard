# CineDash - Movies & Analytics Dashboard

A premium web-based Dashboard application to display and manage movies, TV shows, and people data fetched directly from **The Movie Database (TMDb)**. This project is built using **Laravel 12**.

## Key Features
- **Interactive Dashboard Analytics**:
    - **Top 5 Genres Chart**: Real-time bar chart showing the most frequent genres.
    - **Genre Distribution**: Visual pie chart for oversight of movie and TV show categories.
    - **6-Month Genre Trend**: Chronologically sorted line chart tracking genre popularity over time.
    - **Quick Summary**: Cards for Total Movies, Total TV Shows, Total People, and Last Sync timestamp.
- **Comprehensive Media Management**:
    - **Movies & TV Shows**: Complete system to Create, Read, Update, and Delete records with built-in validation.
    - **People / Cast**: Dedicated module to manage profiles and popularity of actors/crew.
- **AJAX Synchronization (TMDb API)**: Robust one-click sync process using TMDb API with interactive SweetAlert2 loading states.
- **Smart Mapping**: Automatic conversion of numeric *genre_ids* from TMDb into descriptive text names.
- **Premium UI/UX**:
    - **Text-Based Branding**: Modern text-based logo **"CineDash"** for a clean and sleek sidebar appearance.
    - **Consolidated Controls**: Integrated filters and action buttons for better workflow.
    - **Aesthetic Design**: Clean Pink/Teal theme with custom *Flatpickr* and *SweetAlert2* styling.
    - **Responsive Tables**: Borderless, sortable data tables with search and date-range filters.

##  Requirements
Ensure the following are installed and configured on your server/local machine:
- PHP >= 8.2
- Composer (PHP Package Manager)
- Database (MySQL / PostgreSQL / SQLite)
- TMDb API Key - Obtain one for free at [TMDb Developer](https://developer.themoviedb.org/docs)

##  Local Installation Guide
1. **Clone the Project Repository**
   ```bash
   git clone <your-repo-url>
   cd api-dashboard-tugas
   ```

2. **Install Packages/Dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Duplicate Environment Configuration**
   ```bash
   copy .env.example .env
   ```

4. **Database & API Configuration (.env)**
   Update your `.env` with database credentials and TMDb API Key:
   ```env
   DB_DATABASE=your_db_name
   TMDB_API_KEY=your_api_key_here
   ```

5. **Generate App Key & Migrate**
   ```bash
   php artisan key:generate
   php artisan migrate
   ```

6. **Run Development Server**
   ```bash
   php artisan serve
   ```
   Access at [*http://127.0.0.1:8000*](http://127.0.0.1:8000).

## Routes & Main Endpoints Structure
| Method | Endpoint        | Controller Destination                   | Function Description                                                |
|--------|-----------------|------------------------------------------|---------------------------------------------------------------------|
| GET    | `/dashboard`    | `DashboardController@index`            | The dashboard panel's landing home page.                            |
| GET    | `/sync-movies`  | `SyncController@syncMovies`              | One-tap data synchronization from TMDb.                             |
| ALL    | `/movies`       | `MovieController`                        | CRUD management for Movies.                                         |
| ALL    | `/tv-shows`     | `TvShowController`                       | CRUD management for TV Shows.                                       |
| ALL    | `/people`       | `PersonController`                       | CRUD management for People/Cast.                                    |

## Git Guide / Workflow
Quick guide to modify and upload your code:

1. **Synchronize with the main branch**:
   ```bash
   git checkout main
   git pull origin main
   ```
2. **Create a new branch for features**:
   ```bash
   git checkout -b feature-name-here
   ```
3. **Save changes (Commit)**:
   ```bash
   git add .
   git commit -m "feat: brief description of changes"
   ```
4. **Upload to repository (Push)**:
   ```bash
   git push origin feature-name-here
   ```

---
**Documentation © 2026** - Powered by Laravel 12.x

# API Dashboard - Movies Sync

A web-based Dashboard application to display and manage a list of movies fetched directly from **The Movie Database (TMDb)**. This project is built using **Laravel 12**.

## Key Features
- **Interactive Dashboard Analytics**:
    - **Top 5 Genres Chart**: Real-time bar chart showing the most frequent genres.
    - **Genre Distribution**: Visual pie chart for oversight of movie categories.
    - **6-Month Genre Trend**: Chronologically sorted line chart tracking genre popularity over time.
    - **Quick Summary**: Cards for Total Movies, Top Genre, Latest Entry, and Last Sync timestamp.
- **AJAX Synchronization (TMDb API)**: Robust one-click sync process using TMDb API with interactive SweetAlert2 loading states and English feedback.
- **Smart Mapping**: Automatic conversion of numeric *genre_ids* from TMDb into descriptive text names.
- **English Localization**: Fully translated UI, including alerts, warnings, confirmation dialogs, and form placeholders.
- **Premium UI/UX**:
    - **Consolidated Controls**: "Add Movie" button integrated into the filter bar for better workflow.
    - **Aesthetic Design**: Clean Pink/Teal theme with custom *Flatpickr* and *SweetAlert2* styling.
    - **Responsive Tables**: Borderless, sortable data tables with search and date-range filters.
- **Movie CRUD Management**: Complete system to Create, Read, Update, and Delete movie records with built-in validation.

##  Requirements
Ensure the following are installed and configured on your server/local machine:
- PHP >= 8.2
- Composer (PHP Package Manager)
- Database (Adaptable for MySQL / SQLite / PostgreSQL / etc.)
- TMDb API Key - Obtain one for free by registering an account at [TMDb Developer](https://developer.themoviedb.org/docs)

##  Local Installation Guide
Follow these steps to run the application in your local environment.

1. **Clone the Project Repository**
   ```bash
   git clone <your-repo-url>
   cd api-dashboard-tugas
   ```

2. **Install Packages/Dependencies**
   Run the Composer and NPM commands to download all required extensions.
   ```bash
   composer install
   npm install
   ```

3. **Duplicate Environment Configuration**
   Use `.env.example` as a base for setting up your environment by copying the file and renaming it to `.env`.
   ```bash
   # In Command Prompt / Terminal
   copy .env.example .env
   # Or in Linux/Mac/Git Bash: cp .env.example .env
   ```

4. **Integrated Database Configuration (.env)**
   Open the newly created `.env` file with your text editor, and ensure the database connection is set up correctly:
   ```env
   DB_CONNECTION=mysql # Or your preferred db engine
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=your_specific_database_name
   DB_USERNAME=root
   DB_PASSWORD=
   
   # TMDB Configuration
   TMDB_API_KEY=insert_your_tmdb_api_key_here
   ```

5. **Generate Application Key**
   Provides the encryption signature for sessions and caching in the application.
   ```bash
   php artisan key:generate
   ```

6. **Migrate Database Structure**
   This command will create all table relationships for Movies, Users, Cache, etc., required by the application into the database linked in your `.env`.
   ```bash
   php artisan migrate
   ```

7. **Compile Frontend Assets (Optional/As Needed)**
   The project requires styling asset integration using Vite.
   ```bash
   npm run build
   # Or (For live reloading during development): npm run dev
   ```

8. **Run Local Development Server**
   Finally, start Laravel's built-in server instance.
   ```bash
   php artisan serve
   ```
   The application and Admin Dashboard panel are now available to access via [*http://127.0.0.1:8000*](http://127.0.0.1:8000) on your web browser.

## Routes & Main Endpoints Structure
Here is how to access several main controller routes in the application. All the routes below are registered inside `routes/web.php`:

| Method | Endpoint        | Controller Destination                   | Function Description                                                |
|--------|-----------------|------------------------------------------|---------------------------------------------------------------------|
| GET    | `/` or `/dashboard` | `DashboardController@index`            | The dashboard panel's landing home page.                            |
| GET    | `/sync-movies`  | `SyncController@syncMovies`              | One-tap data synchronization from TMDb -> Datastore.                |
| ALL    | `/movies`       | `MovieController (Resourceful)`          | The interface module for all internal CRUD assignment activities.   |

##  Git Guide / Workflow
Collaborators who wish to contribute and update the code structure are highly recommended to follow these guidelines:

1. Make sure you are on and fully synchronized with the main source:
   ```bash
   git checkout main
   git pull origin main
   ```
2. Create a new *branch* from `main` that represents the subject of the task / new feature:
   ```bash
   git checkout -b feature-authentication / hotfix-sync-genre
   ```
3. Make and commit your changes descriptively:
   ```bash
   git add .
   git commit -m "feat: Add exotic genre filter feature"
   ```
4. *Push* your code findings to the remote origin
   ```bash
   git push origin <your_branch_name>
   ```
5. Open a Pull Request via the repository (Github/Gitlab) and request a review from the relevant Lead Developer.

---
**Documentation © 2026** - Powered by the innovative Laravel 12.x framework 🔥

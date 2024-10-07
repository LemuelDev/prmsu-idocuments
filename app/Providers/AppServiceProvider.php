<?php

namespace App\Providers;

use App\Models\ChMessage;
use App\Models\Courses;
use App\Models\UserProfile;
use Chatify\Facades\ChatifyMessenger as Chatify;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();
        $this->loadGoogleStorage();

        View::composer('shared.navbar', function ($view) {
            $user = auth()->user();
            $courseAbr = Courses::where('courses', $user->userProfile->course)->value('courses_abr');
            $view->with('courseAbr', $courseAbr);
        });

      // Share unread message count with all views
        View::composer('*', function ($view) {
            if (Auth::check()) { // Check if user is authenticated
            if(Auth::user()->userProfile->user_type == "student"){
                $userId = Auth::id(); // Get the current user ID
                $adminIds = UserProfile::where('user_type', 'admin')->pluck('id')->toArray();
                $unreadCount = 0;

                // Count unread messages from admin
                $unreadCount = ChMessage::whereIn('from_id', $adminIds)
                    ->where('to_id', $userId)
                    ->where('seen', false)
                    ->count();

                // Share the unread count with all views
                $view->with('unreadCount', $unreadCount);
                }else {
                    $userId = Auth::id(); // Get the current user ID
                    $unreadCount = 0;
                    
                    // Count unread messages from admin
                    $unreadCount = ChMessage::where('to_id', $userId)
                        ->where('seen', false)
                        ->count();
        
                    // Share the unread count with all views
                    $view->with('unreadCount', $unreadCount);
                }
            }

            if (Auth::check()) {
                $user = Auth::user();
                $this->addAdminsToFavorites($user);
            }
        });


        
    }
    protected function addAdminsToFavorites($user)
    {
        // Check if the user is a student
        if ($user->userProfile->user_type === 'student') {
            // Get all admin users
            $adminUsers = UserProfile::where('user_type', 'admin')->pluck('id');

            foreach ($adminUsers as $adminId) {
                // Add each admin to the student's favorites
                if (!Chatify::inFavorite($adminId)) {
                    Chatify::makeInFavorite($adminId, 1); // 1 means adding to favorites
                }
            }
        }
    }

    private function loadGoogleStorage() {
        try {
            Storage::extend('google', function($app, $config) {
                $options = [];

                if (!empty($config['teamDriveId'] ?? null)) {
                    $options['teamDriveId'] = $config['teamDriveId'];
                }

                if (!empty($config['sharedFolderId'] ?? null)) {
                    $options['sharedFolderId'] = $config['sharedFolderId'];
                }

                $client = new \Google\Client();
                $client->setClientId($config['clientId']);
                $client->setClientSecret($config['clientSecret']);
                $client->refreshToken($config['refreshToken']);
                
                $service = new \Google\Service\Drive($client);
                $adapter = new \Masbug\Flysystem\GoogleDriveAdapter($service, $config['folder'] ?? '/', $options);
                $driver = new \League\Flysystem\Filesystem($adapter);

                return new \Illuminate\Filesystem\FilesystemAdapter($driver, $adapter);
            });
        } catch(\Exception $e) {
            return $e;
        }
        // ...
    }
}

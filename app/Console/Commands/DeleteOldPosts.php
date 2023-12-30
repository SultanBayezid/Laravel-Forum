<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Post;
use Carbon\Carbon;
class DeleteOldPosts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'posts:delete-old';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'To keep the forum clean all posts that have not received a comment for 1 year should be soft
    deleted';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $oneYearAgo = Carbon::now()->subYear();
        
        $postsToDelete = Post::where('created_at', '<=', $oneYearAgo) 
        ->whereDoesntHave('comments', function ($query) use ($oneYearAgo) {
            $query->where('created_at', '>', $oneYearAgo); 
        })
        ->get();

        foreach ($postsToDelete as $post) {
            $post->delete();
        }

        $this->info('Old posts soft deleted successfully.');
    }
}

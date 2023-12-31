<h2>Features Overview</h2>
<ul>
  <li><strong>Post Creation:</strong> Users are able to create new posts within the platform.</li>
  <li><strong>Post Attributes:</strong> Each post comprises a title, textual content, and creation date.</li>
  <li><strong>Comments Functionality:</strong> Users have the capability to add comments to posts.</li>
  <li><strong>Comment Attributes:</strong> Comments include text, creation date, and an editable timestamp.</li>
  <li><strong>Comment Management:</strong> Users possess the authority to edit and delete their posted comments.</li>
  <li><strong>Post Management:</strong> Users can edit or delete their posts, provided no comments have been added yet.</li>
  <li><strong>Notification System:</strong> Users receive email notifications upon new comments added to their posts.</li>
  <li><strong>Post Sorting:</strong> Posts are arranged based on their creation date in descending order.</li>
  <li><strong>Content Search:</strong> Users have the ability to search for posts containing specific content (title, text, or comments).</li>
  <li><strong>Email Verification:</strong> Posting or commenting is restricted to users who have verified their email addresses.</li>
  <li><strong>Automated Cleanup:</strong> Posts inactive for one year without receiving comments are marked for soft deletion to maintain forum cleanliness.</li>
</ul>



<section>
  <h2>Notification System for Comments</h2>
  <p>
    Users are notified by email when a new comment is added to one of their posts. This functionality is achieved through a Laravel Notifications feature called 'CommentNotification'. Upon storing a comment, the function <code>$comment->sendNotificationToPostOwner();</code> is executed within the CommentController.
  </p>

  <p>
    The application's email notification process is configured in the ".env" file by setting the <code>QUEUE_CONNECTION</code> variable. Initially, it is set to <code>"sync"</code>, which sends emails without any server environment configuration but might slow down the application. To improve performance, an alternative method involves configuring a jobs table for <code>QUEUE_CONNECTION=database</code>. By changing <code>QUEUE_CONNECTION=sync</code> to <code>QUEUE_CONNECTION=database</code> and running <code>php artisan queue:work</code>, emails are queued in the background, enabling faster application loading.
  </p>
</section>

<section>
  <h2>Cleaning Old Posts</h2>
  <p>
    To maintain a clean forum, a rule has been established: posts that have not received any comments for one year should be soft-deleted.
  </p>

  <p>
    This functionality is implemented using a Laravel Command named 'DeleteOldPosts'. The command's logic for deleting posts meeting the criteria has been implemented. To automate this process, the command has been scheduled in the <code>app/Console/Kernel.php</code> file.
  </p>
</section>

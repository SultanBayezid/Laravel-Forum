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
  <h2>Technical Notes</h2>
  <p>7. Users are notified by email when a new comment is added to one of their posts. To achieve this, I have created a Laravel Notifications called 'CommentNotification.' After storing a comment, this function is executed: <code>$comment->sendNotificationToPostOwner();</code> in CommentController.</p>

<p>In the ".env" file, the <code>QUEUE_CONNECTION</code> is set to <code>“sync”</code> to send emails without any server environment configuration, which makes the application a little slow. However, I have also created a jobs table for <code>QUEUE_CONNECTION=database</code>. It can be achieved by just changing <code>QUEUE_CONNECTION=sync</code> to <code>QUEUE_CONNECTION=database</code> and running <code>php artisan queue:work</code> which will load the application fast.</p>

<p>11. To keep the forum clean, all posts that have not received a comment for 1 year should be soft deleted. To achieve this, I've created a Laravel Command named 'DeleteOldPosts' and implemented its functionality. Then, I've scheduled this command in the <code>app/Console/Kernel.php</code> file.</p>

</section>

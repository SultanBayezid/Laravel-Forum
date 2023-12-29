$(document).ready(function () {
    $('.edit-comment').click(function () {
        var commentId = $(this).data('commentid');
        var commentText = $(this).data('text');
        var form = $('#editCommentForm');
        form.attr('action', '/comments/' + commentId);
        $('#editCommentText').val(commentText);
        $('#editCommentModal').modal('show');
    });

    $('#submitCommentBtn').click(function () {
        // Perform basic validation
        var commentContent = $('#editCommentText').val();
        if (commentContent.trim() === '') {
            $('#commentError').text('Please enter a comment.');
            return; // Prevent form submission
        }

        // If validation passes, submit the form
        $('#editCommentForm').submit();
    });
});

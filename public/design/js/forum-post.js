$(document).ready(function () {
    $('.edit-post').click(function () {
        var postId = $(this).data('postid');
        var title = $(this).data('title');
        var text = $(this).data('text');
        var form = $('#editPostForm');
        form.attr('action', '/posts/' + postId);
        $('#editTitle').val(title);
        $('#editText').val(text);
        $('#editModal').modal('show');
    });

    $('#editPostForm').submit(function (event) {
        var titleValue = $('#editTitle').val().trim();
        if (titleValue === '') {
            event.preventDefault(); // Prevent form submission
            $('#titleError').text('Please enter a title.');
            return false;
        }
        // If validation passes, the form will be submitted
        return true;
    });
});

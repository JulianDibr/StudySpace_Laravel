$(function () {
    let body = $('body');
    //Bind Reset Button for new Posting
    $('.new-posting-reset').on('click', function () {
        $(this).closest('form').trigger("reset");
    });
    //Upvote this post
    body.on('click', '.posting-vote-up', function () {
        let postingId = $(this).closest('.posting-container').attr('data-posting-id');
        let reload = !$(this).closest('.posting-container').hasClass('modal-content');
        votePosting(postingId, 1, reload);
    });
    //Downvote this post
    body.on('click', '.posting-vote-down', function () {
        let postingId = $(this).closest('.posting-container').attr('data-posting-id');
        let reload = !$(this).closest('.posting-container').hasClass('modal-content');
        votePosting(postingId, 0, reload);
    });
});

function votePosting(postingId, isUpvote, reload = true) {
    //Toggle Class -> send toggling of vote to model
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: '/postings/voting',
        method: 'post',
        data: {
            'postingId': postingId,
            'isUpvote': isUpvote,
        },
        success: function (response) {
            if (reload) {
                window.location.reload();
            } else {
                $('#posting-modal').find('.modal-body').replaceWith(response.data.modal);
            }
        }
    });
}

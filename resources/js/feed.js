$(document).ready(function () {
    bindButtons();
});

function bindButtons() {
    //Bind Reset Button for new Posting
    $('.new-posting-reset').on('click', function () {
        $(this).closest('form').trigger("reset");
    });
    //Upvote this post
    $('.posting-vote-up').on('click', function () {
        let postingId = $(this).closest('.posting-container').attr('data-posting-id');
        upvotePosting(postingId, 1);
    });
    //Downvote this post
    $('.posting-vote-down').on('click', function () {
        let postingId = $(this).closest('.posting-container').attr('data-posting-id');
        downvotePosting(postingId, 0);
    });
}

function upvotePosting(postingId, isUpvote) {
    //Toggle Class -> send toggling of vote to model
    //TODO: In allgemeine JS auslagern
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: 'postings/voting',
        method: 'post',
        data: {
            'postingId': postingId,
            'isUpvote': isUpvote,
        },
        success: function () {
            window.location.reload();
        }
    });
}

function downvotePosting(postingId, isUpvote) {
    //Toggle Class -> send toggling of vote to model
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: 'postings/voting',
        method: 'post',
        data: {
            'postingId': postingId,
            'isUpvote': isUpvote,
        },
        success: function () {
            window.location.reload();
        }
    });
}

function updateVoting() {

}

$(function () {
    $('.open-posting').on('click', function () {
        loadPosting($(this).closest('.posting-container').attr('data-posting-id'));
    })

    $('body').on('click', '.open-comment-field', function () {
        console.log($(this));
        $(this).closest('.comment-container').find('.comment-form').removeClass('d-none');
    })

    //Upvote this post
    $('body').on('click', '.comment-vote-up', function () {
        let commentId = $(this).closest('.comment-container').attr('data-comment-id');
        upvoteComment(commentId, 1);
    });
    //Downvote this post
    $('body').on('click', '.comment-vote-down', function () {
        let commentId = $(this).closest('.comment-container').attr('data-comment-id');
        downvoteComment(commentId, 0);
    });
});

function loadPosting(id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: '/loadPosting/' + id,
        method: 'get',
        success: function (response) {
            hidePostingModal();
            $('body').removeClass('modal-open');
            $('.modal-backdrop').remove();
            $('#posting-modal-wrapper').html(response.data.modal);
            showPostingModal();
        }
    });
}

function showPostingModal() {
    $('#posting-modal').modal('show');
}

function hidePostingModal() {
    $('#posting-modal').modal('hide');
}

function upvoteComment(commentId, isUpvote) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: 'comments/voting',
        method: 'post',
        data: {
            'commentId': commentId,
            'isUpvote': isUpvote,
        },
        success: function () {
        }
    });
}

function downvoteComment(commentId, isUpvote) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: 'comments/voting',
        method: 'post',
        data: {
            'commentId': commentId,
            'isUpvote': isUpvote,
        },
        success: function () {
        }
    });
}

$(function () {
    let body = $('body');
    $('.open-posting').on('click', function () {
        loadPosting($(this).closest('.posting-container').attr('data-posting-id'));
    })

    body.on('click', '.open-comment-field', function () {
        $(this).closest('.comment-container').find('.comment-form').removeClass('d-none');
    })

    //Upvote this post
    body.on('click', '.comment-vote-up', function () {
        let commentId = $(this).closest('.comment-container').attr('data-comment-id');
        upvoteComment(commentId, 1);
    });
    //Downvote this post
    body.on('click', '.comment-vote-down', function () {
        let commentId = $(this).closest('.comment-container').attr('data-comment-id');
        downvoteComment(commentId, 0);
    });

    body.on('click', '.submit-comment', function () {
        let form = $(this).closest('form');
        submitComment(form);
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
        success: function (response) {
            $('#posting-modal').find('.modal-body').replaceWith(response.data.modal);
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
        success: function (response) {
            $('#posting-modal').find('.modal-body').replaceWith(response.data.modal);
        }
    });
}

function submitComment(form) {
    let url = "";
    let posting_id = form.closest('.posting-container').attr('data-posting-id');

    if(!form.parent().hasClass('comment-form')){
        url = 'comments/'+posting_id+'/-1';
    } else {
        let comment_id = form.closest('.comment-container').attr('data-comment-id');
        url = 'comments/'+posting_id+'/'+comment_id;
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: url,
        method: 'post',
        data: {
            'content': form.find(".posting-content").val(),
        },
        success: function (response) {
            $('#posting-modal').find('.modal-body').replaceWith(response.data.modal);
        }
    });
}

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
        voteComment(commentId, 1);
    });
    //Downvote this post
    body.on('click', '.comment-vote-down', function () {
        let commentId = $(this).closest('.comment-container').attr('data-comment-id');
        voteComment(commentId, 0);
    });

    body.on('click', '.submit-comment', function () {
        let form = $(this).closest('form');
        submitComment(form);
    });

    body.on('click', '.delete-comment', function () {
        deleteComment($(this).attr('data-comment-id'));
    });

    body.on('click', '.edit-comment', function () {
        editComment($(this));
    });

    body.on('click', '.submit-comment-edit', function () {
        submitEditedComment($(this));
    });

    body.on('click', '.edit-posting-btn', function () {
        editPosting($(this));
    })

    body.on('click', '.submit-posting-edit', function () {
        submitEditedPosting($(this));
    })

    body.on('click', '.cancel-posting-edit', function () {
        cancelEditPosting($(this));
    })
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
            $('#posting-modal').modal('hide');
            $('body').removeClass('modal-open');
            $('.modal-backdrop').remove();
            $('#posting-modal-wrapper').html(response.data.modal);
            $('#posting-modal').modal('show');
        }
    });
}

function voteComment(commentId, isUpvote) {
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

    if (!form.parent().hasClass('comment-form')) {
        url = 'comments/' + posting_id + '/-1';
    } else {
        let comment_id = form.closest('.comment-container').attr('data-comment-id');
        url = 'comments/' + posting_id + '/' + comment_id;
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

function deleteComment(id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: 'comments/' + id,
        method: 'delete',
        success: function (response) {
            $('#posting-modal').find('.modal-body').replaceWith(response.data.modal);
        }
    });
}

function editComment(btn) {
    let container = btn.closest('.comment-container');

    let comment = container.find('.posting-content');
    let content = comment.text();
    comment.replaceWith(`
        <form class="col-10" method="post">
            <textarea name="content" style="height: 50px"
                      class="p-2 mt-1 posting-content edit-posting-val border"
                      placeholder="Kommentar schreiben"></textarea>
            <div class="row">
                <button class="btn col-2 offset-10 submit-comment-edit" type="button">
                    <i class="fa-lg far fa-check-circle icon-light-green"></i>
                </button>
            </div>
        </form>
    `);

    container.find('.edit-posting-val').val(content);
}

function submitEditedComment(btn) {
    let container = btn.closest('.comment-container');
    let id = container.attr('data-comment-id');
    let comment = container.find('.edit-posting-val').val();
    let url = 'comments/' + id;

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: url,
        method: 'patch',
        data: {
            'content': comment
        },
        success: function (response) {
            $('#posting-modal').find('.modal-body').replaceWith(response.data.modal);
        }
    });
}

function editPosting(btn) {
    let container = btn.closest('.posting-container');
    let id = container.attr('data-posting-id');
    let postingContentContainer = container.find('.posting-content-container');

    postingContentContainer.find('.posting-content-trigger').addClass('d-none');
    postingContentContainer.find('.edit-posting-container').removeClass('d-none');
}

function cancelEditPosting(btn) {
    let postingContentContainer = btn.closest('.posting-container').find('.posting-content-container');

    postingContentContainer.find('.posting-content-trigger').removeClass('d-none');
    postingContentContainer.find('.edit-posting-container').addClass('d-none');
}

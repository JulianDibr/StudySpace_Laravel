$(function () {
    $('.add-to-friends-btn').on('click', function () {
        addFriend($(this).attr('data-profile-id'));
    })

    $('.cancel-friend-request-btn, .rm-from-friends-btn').on('click', function () {
        removeFriend($(this).attr('data-profile-id'));
    })
})

function addFriend(id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: '/friend/add/' + id,
        method: 'post',
        success: function () {
            $('.add-to-friends-btn, .rm-from-friends-btn').addClass('d-none');
            $('.cancel-friend-request-btn').removeClass('d-none')
        }
    });
}

function removeFriend(id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: '/friend/remove/' + id,
        method: 'post',
        success: function () {
            $('.cancel-friend-request-btn, .rm-from-friends-btn').addClass('d-none');
            $('.add-to-friends-btn').removeClass('d-none')
        }
    });
}

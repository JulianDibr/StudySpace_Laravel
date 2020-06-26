$(function () {
    let profileContainer = $('#user-profile')
    profileContainer.on('click', '.add-to-friends-btn', function () {
        addFriend($(this).attr('data-profile-id'));
    })

    profileContainer.on('click', '.cancel-friend-request-btn, .rm-from-friends-btn', function () {
        removeFriend($(this).attr('data-profile-id'));
    })

    profileContainer.on('click', '.decline-friend-request-btn', function () {
        declineFriend($(this).attr('data-profile-id'));
    });

    profileContainer.on('click', '.accept-friend-request-btn', function () {
        acceptFriend($(this).attr('data-profile-id'));
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
        method: 'POST',
        success: function () {
            $('.cancel-friend-request-btn, .rm-from-friends-btn').addClass('d-none');
            $('.add-to-friends-btn').removeClass('d-none')
        }
    });
}

function acceptFriend(id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: '/friend/accept/' + id,
        method: 'post',
        success: function () {
            location.reload();
        }
    });
}

function declineFriend(id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: '/friend/decline/' + id,
        method: 'post',
        success: function () {
            location.reload();
        }
    });
}

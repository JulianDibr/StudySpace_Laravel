$(function () {
    let friendlistContainer = $('#friendlist')
    friendlistContainer.on('click', '.add-to-friends-btn', function () {
        addFriendFromFriendlist($(this));
    });

    friendlistContainer.on('click', '.cancel-friend-request-btn, .rm-from-friends-btn, .rm-from-friends-link', function () {
        removeFriendFromFriendlist($(this).attr('data-profile-id'));
    });

    friendlistContainer.on('click', '.decline-friend-request-btn', function () {
        declineFriendFromFriendlist($(this).attr('data-profile-id'));
    });

    friendlistContainer.on('click', '.accept-friend-request-btn', function () {
        acceptFriendFromFriendlist($(this).attr('data-profile-id'));
    })
})

function addFriendFromFriendlist(btn) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: '/friend/add/' + btn.attr('data-profile-id'),
        method: 'post',
        success: function () {
            /*btn.closest('.row').find('.add-to-friends-btn').addClass('d-none');
            btn.closest('.row').find('.cancel-friend-request-btn').removeClass('d-none');*/
            location.reload();
        }
    });
}

function removeFriendFromFriendlist(id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: '/friend/remove/' + id,
        method: 'POST',
        success: function () {
            /*$('.cancel-friend-request-btn, .rm-from-friends-btn').addClass('d-none');
            $('.add-to-friends-btn').removeClass('d-none')*/
            location.reload();
        }
    });
}

function acceptFriendFromFriendlist(id) {
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

function declineFriendFromFriendlist(id) {
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

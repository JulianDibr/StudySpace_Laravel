$(function () {
    let messageContainer = $('#message-container');
    //Toggle Conversations and Contacts
    messageContainer.on('click', '.conversations-btn, .contacts-btn', function () {
        let active = $('.contact-conversation-list-container').find('.active-tab'); //Get currently active tab
        if (!active.is($(this))) { //If clicked isnt the currently active tab
            active.removeClass('active-tab');
            $(this).addClass('active-tab'); //Toggle active tab style

            //Load the other tab
            if ($(this).hasClass('conversations-btn')) {
                loadConversations();
            } else if ($(this).hasClass('contacts-btn')) {
                loadContacts();
            }
        }
    })

    messageContainer.on('click', '.start-conversation', function () {
        let receiverId = $(this).attr('data-user-id');
        startConversation(receiverId);
    })

    messageContainer.on('click', '.load-conversation', function () {
        let conversationid = $(this).attr('data-conversation-id');
        loadConversation(conversationid);
    })
})

function loadConversations() {
    $('.conversation-list').removeClass('d-none');
    $('.contacts-list').addClass('d-none');
}

function loadContacts() {
    $('.conversation-list').addClass('d-none');
    $('.contacts-list').removeClass('d-none');
}

function startConversation(receiverId) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: '/messages/create/' + receiverId,
        method: 'GET',
        success: function (response) {
            console.log(response);
            $('#message-container').html(response.data.messageContainer);
        }
    });
}

function loadConversation(receiverId) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: '/messages/' + receiverId,
        method: 'GET',
        success: function (response) {
            console.log(response);
            $('#message-container').html(response.data.messageContainer);
        }
    });
}

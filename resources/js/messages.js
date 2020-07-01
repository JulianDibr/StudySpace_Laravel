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
        openNewConversation(receiverId);
    })

    messageContainer.on('click', '.load-conversation', function () {
        let conversationid = $(this).attr('data-conversation-id');
        loadConversation(conversationid);
    })

    messageContainer.on('click', '.submit-message-to-conversation', function () {
        if (messageNotEmpty()) {
            submitMessage($(this).attr('data-conversation-id'));
        }
    })

    messageContainer.on('keypress', '.message-input', function (e) {
        if (e.which === 13) {
            if (messageNotEmpty()) {
                if ($(this).next().hasClass('submit-message-to-conversation')) {
                    submitMessage($(this).closest('.message-input-container').find('.submit-message-to-conversation').attr('data-conversation-id'));
                } else {
                    submitNewConversation();
                }
            }
        }
    });

    messageContainer.on('click', '.start-new-conversation', function () {
        if (messageNotEmpty()) {
            submitNewConversation();
        }
    });
})

function loadConversations() {
    $('.conversation-list').removeClass('d-none');
    $('.contacts-list').addClass('d-none');
}

function loadContacts() {
    $('.conversation-list').addClass('d-none');
    $('.contacts-list').removeClass('d-none');
}

function openNewConversation(receiverId) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: '/messages/create/' + receiverId,
        method: 'GET',
        success: function (response) {
            $('#message-container').html(response.data.messageContainer);
            focusMessageInput();
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
            $('#message-container').html(response.data.messageContainer);
            focusMessageInput();
        }
    });
}

function submitNewConversation() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: '/messages',
        method: 'POST',
        data: {
            'message': $('.message-input').val(),
            'recipients': $('.message-recipient').val(),
        },
        success: function (response) {
            $('#message-container').html(response.data.messageContainer);
            focusMessageInput();
        }
    });
}

function submitMessage(conversationId) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: '/messages/' + conversationId,
        method: 'PUT',
        data: {
            'message': $('.message-input').val(),
        },
        success: function (response) {
            $('#message-container').html(response.data.messageContainer);
            focusMessageInput();
        }
    });
}

function messageNotEmpty() {
    return $('.message-input').val() !== "";
}

function focusMessageInput() {
    $('.message-input').focus();
}

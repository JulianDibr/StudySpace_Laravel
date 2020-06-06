$(function() {
    $('.open-posting').on('click', function () {
        loadPosting($(this).closest('.posting-container').attr('data-posting-id'));
    })
});

function loadPosting(id) {
    console.log(id)
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

function showPostingModal(){
    $('#posting-modal').modal('show');
}

function hidePostingModal(){
    $('#posting-modal').modal('hide');
}

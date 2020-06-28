//Create/Edit
$(function () {
    $('.add-to-group-user-list').on('click', '.add-user, .remove-user', function () {
        //Toggle if user is added to course
        $(this).closest('.group-user-row').find('.add-user, .remove-user').toggleClass('d-none');
    })

    $('.submit-group').on('click', function () {
        let idArr = [];
        //Find all users to add an submit form
        $('.add-to-group-user-list').find('.add-user.d-none').each(function () {
            idArr.push($(this).closest('.group-user-row').attr('data-user-id'));
        })

        $('input[name="user_list"]').val(idArr.join(","));
        $('#edit-group-form').submit();
    })
})

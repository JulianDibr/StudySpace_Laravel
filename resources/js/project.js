//Create/Edit
$(function () {
    $('.add-to-project-user-list').on('click', '.add-user, .remove-user', function () {
        //Toggle if user is added to course
        $(this).closest('.project-user-row').find('.add-user, .remove-user').toggleClass('d-none');
    })

    $('.submit-project').on('click', function () {
        let idArr = [];
        //Find all users to add an submit form
        $('.add-to-project-user-list').find('.add-user.d-none').each(function () {
            idArr.push($(this).closest('.project-user-row').attr('data-user-id'));
        })

        $('input[name="user_list"]').val(idArr.join(","));
        $('#edit-project-form').submit();
    })
})

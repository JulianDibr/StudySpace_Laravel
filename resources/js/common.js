$(function () {
    let today = new Date();
    let currentDate = String(today.getDate()).padStart(2, '0') + "/" + String((today.getMonth() + 1)).padStart(2, '0') + "/" + today.getFullYear(); //Format: dd.mm.yyyy

    //Inputmasks
    Inputmask("datetime", {inputFormat: "dd.mm.yyyy", min: "01/01/1900", max: currentDate}).mask('.date-mask'); //Date between 01.01.1900 and today

    //Init tooltips
    $('[data-toggle="tooltip"]').tooltip();

    //Toggle sidebar mobile
    $('.toggle-sidebar').on('click', function () {
        $('.sidebar-wrapper').toggleClass('d-none');
    })
})

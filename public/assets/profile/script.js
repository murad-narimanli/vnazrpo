// $('.profile-data-add-btn').click(function () {
//     $('.profile-data-add-btn').removeClass('active');
//     $(this).addClass('active');
//     const dataValue = $(this).data('value');
//     $('.profile-data-ad-row').hide();
//     $('.profile-data-ad-row#' + dataValue).show()
// })

$('.profile-data-info-item-btn.edit').click(function () {
    $(this).siblings('input').prop("disabled", false)
    $(this).toggleClass('active');
    $(this).siblings('.save').toggleClass('active');
})

$('.profile-data-info-item-btn.save').click(function () {
    $(this).siblings('input').prop("disabled", true);
    $(this).toggleClass('active');
    $(this).siblings('.edit').toggleClass('active');
})

$('.rice-up-profile-btn').click(function()  {
    const id = $(this).data('id')
    localStorage.setItem('announcementId', $(this).data('id'));
    localStorage.setItem('orderType', $(this).data('type'))
    if ($(this).data('type')==='vip'){
        $('#vip-profile-popup').data('id', id)
        $('#vip-profile-popup').show();
    } else {
        $('#rice-up-profile-popup').data('id', id)
        $('#rice-up-profile-popup').show();
    }
})

$('.profile-popup-close-btn#rise-popup-close').click(() => {
    $('#rice-up-profile-popup').hide();
})

$('#vip-profile-btn').click(function () {
    const id = $(this).data('id')

    // doVip(id, 300);
    // $('#vip-profile-popup').data('id', id)
    // $('#vip-profile-popup').show();

    return false;
})

$('.profile-popup-vip-list .profile-popup-label').click(function (){
    localStorage.setItem('vipPrice', $(this).data('price'))
})

$('.profile-popup-close-btn#vip-popup-close').click(() => {
    $('#vip-profile-popup').hide();
})


$('.profile-data-ad-container').click(function (e) {
    const target$ = $(e.target);
    if (target$.hasClass('profile-data-ad-header-btn')) {
        return true;
    }

    e.stopPropagation();
    e.preventDefault();

    location.href = $(this).data('link') + $(this).data('id')
});

function setVipPromoteData(announcementId, orderType){
    // console.log(0)
    // localStorage.setItem('announcementId', announcementId);
    // localStorage.setItem('orderType', orderType)
    // return true
}

// alert('okay')

const adverseTypeField = $('.package-type')

function selectAdverseType(elem) {
    $('.adverse-type.active').removeClass('active');
    elem.addClass('active');

    adverseTypeField.val(elem.data('id'));
}

$('.adverse-type').click(function () {
    selectAdverseType($(this))
    return false;
})

selectAdverseType($('.adverse-type:first'));

$('.adv-type').click(function () {
    const advType = $(this).data('id');
    $('[name=adverse-type]').val(advType)
});


$('#ad-submit-btn').click(function () {
    submitClick = true;
    setTimeout(checkValidation, 100)
})

function checkValidation() {
    $('.ads-error-text').hide();
    let state = true;

    if ($('.gallery-photo img').length < 4) {
        $('#gallery-error').show();
        state = false;
    }

    if($('#agree-checkbox').is(':checked') === false){
        $('#agree-checkbox-error').show();
        state = false;
    }

    if (!$('#announcement-object-type').attr('value')) {
        $('#announcement-object-type-error').show();
        state = false;
    }
    if (!$('#announcement-type').attr('value')) {
        $('#announcement-type-error').show();
        state = false;
    }
    if (!$('#city').attr('value')) {
        $('#city-error').show();
        state = false;
    }
    if (!$('#provience').attr('value')) {
        $('#provience-error').show();
        state = false;
    }
    return state;
}

$('.ad-form .select-list li').click(function () {
    if (submitClick) {
        setTimeout(checkValidation, 500)
    }
})


$('#gallery-photo-add').change(function () {
    if (submitClick) {
        setTimeout(checkValidation, 100)
    }
})

var submitClick = false;

$('.ad-form').submit(function (e) {
    e.preventDefault();
    e.stopPropagation();

    if (!checkValidation()) {
        return false;
    }

    const form = $(this);

    const errors = [];
    const data = {
        status: 'PENDING',
        "create-date": "2021-07-01T20:00:00.000Z",
        "document-type": $('.has-order').prop('checked') ? '60bdf0671f35a21fd8f3d4be' : '60e822f2a79ebd3d3e0242fb',
        "ipotech-type": $('.has-ipotech').prop('checked') ? '60e99ec9a79ebd3d3e024491' : '60e9a100a79ebd3d3e02449f',
        "images": placeImages.images,
        "blueprint": placeImages.blueprint,
        "user": userId,
        "orderDate": new Date().toISOString()
    };

    const inputs = form.find('input[name]:visible,input[name][type=hidden]')
    for (let item of inputs) {
        const input = $(item)
        const key = input.attr('name');
        data[key] = input.val();
        if (input.attr['type'] === 'number') {
            data[key] = 0 + input.val();
        }
    }

    if (errors.length > 0) {
        alert('error: ' + JSON.stringify(errors))
        return;
    }

    $.post({
        url: 'https://evinaznew.cms.kube.tisserv.net/api//api/1.0/post-types/anouncement/posts',
        data: JSON.stringify({
            data: data
        }),
        contentType: "application/json; charset=utf-8",
        dataType: "json",
    })

    form.hide();
    $('.success-send-container').show();

    return false;
});

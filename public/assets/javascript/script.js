// OTP popup
$('.digit-group').find('input').each(function () {
    $(this).attr('maxlength', 1);
    $(this).on('keyup', function (e) {
        var parent = $($(this).parent());

        if (e.keyCode === 8 || e.keyCode === 37) {
            var prev = parent.find('input#' + $(this).data('previous'));

            if (prev.length) {
                $(prev).select();
            }
        } else if ((e.keyCode >= 48 && e.keyCode <= 57) || (e.keyCode >= 65 && e.keyCode <= 90) || (e.keyCode >= 96 && e.keyCode <= 105) || e.keyCode === 39) {
            var next = parent.find('input#' + $(this).data('next'));

            if (next.length) {
                $(next).select();
            } else {
                if (parent.data('autosubmit')) {
                    parent.submit();
                }
            }
        }
    });
});

$(".popup-close-icon").click(() => {
    $(".popup-section").css('display', 'none');
});

$('.last-ads-cards-section-buttons-selection').click(() => {
    $('.last-ads-cards-section-buttons-selection-hidden').toggle('active')
});

$('.custom-common-select').click(function () {
    $(this).children('.form-div-list').toggleClass('active')
})

var openSelect;

$('.ads-place-page-right-button').click(function () {
    $(this).children('.form-div-list').toggleClass('active');
})

$('.form-div-list li').click(function () {
    $(this).parent().siblings('p').text($(this).text());
    $(this).parent().siblings('input').val($(this).data('value'));
})


var clickEl;
$('.select-trigger-wrapper').click(function () {
    clickEl = $(this).children('.select-trigger');
    $(this).children('.select-trigger').toggleClass('active');
})

$('.map-popup-header-btn').click(function () {
    $('.map-popup-header-btn').removeClass('active');
    $(this).addClass('active');
    $('.map-popup-content').hide();
    if ($(this).attr('id') === 'rayon') {
        $('#map-popup-rayon').show();
    } else if ($(this).attr('id') === 'metro') {
        $('#map-popup-metro').show();
    } else if ($(this).attr('id') === 'tag') {
        $('#map-popup-tag').show();
    }
})

var selectedArr = [];
var selectedArrValue = [];

$('.metro-checkbox').change(function () {
    if ($(this).is(":checked")) {
        const item = {
            id: $(this).data('id'),
            text: $(this).siblings('.metro-label-text').text()
        }
        selectedArr.push(item)
    } else {
        selectedArr = selectedArr.filter(item => item.id !== $(this).data('id'))
    }
    selectedArrValue = selectedArr.map(item => {
        return item.id
    })
    $('#metroStations-hidden-input').val(selectedArrValue.join(','))
    createElement();
})


$('#reset').click(() => {
    selectedArr = [];
    selectedArrValue = [];
    provincesArr = [];
    markersArr = [];
    $('#provinces-hidden-input').val(provincesArr.join(','));
    $('#metroStations-hidden-input').val(selectedArrValue.join(','));
    $('#markers-hidden-input').val(markersArr.join(','));
    $('.home-popup-list-item').removeClass('active');
    createElement();
})

$('.map-popup-header-close-btn').click(() => {
    $('.map-popup-bg').removeClass('active');
})

function createElement() {
    $('.map-selected-item').detach();
    selectedArr.map(item => {
        $('.selected-item-row-left').append(
            $('<div class="map-selected-item">' + item.text +
                '<button class="map-selected-close">x</button>' +
                '</div>')
        )
    })
}

$('.location-map-btn').click(() => {
    $('.map-popup-bg').addClass('active');
})

$('#confirm').click(() => {
    // console.log(2)
    $('.map-popup-bg').removeClass('active');
})


$(document).ready(function () {

    // Password eye toggle
    $(".fa-eye").on('click', function () {

        let clickedInput = $(this).siblings('.showPass');
        if (clickedInput.attr('type') === 'text') {
            $(".fa-eye").css('opacity', '0.4');
            clickedInput.attr('type', 'password');
        } else {
            $(".fa-eye").css('opacity', '1');
            clickedInput.attr('type', 'text');
        }

    });

});

$('.upper-nav .az-lang-main').on('click', function () {

    $('.fa-caret-up:before').toggle().css('content', '');
    $('.lang-hidden ul li').toggleClass('lang-active');

});

// .upper-nav .az-lang-main:hover .lang-hidden

$("#closePopup").click(
    function () {
        $(".popup-section").css("display", "none");
    }
);

window.onload = function() {
    $('.vip-card-slider').slick({
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        prevArrow: '<div type="button"  class="vip-card-slider-btn prev"><i class="fas fa-chevron-left"></i></div>',
        nextArrow: '<div type="button" class="vip-card-slider-btn next"><i class="fas fa-chevron-right"></i></div>'
    });

    $('.complex-card-header').slick({
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        prevArrow: '<div type="button"  class="vip-card-slider-btn prev"><i class="fas fa-chevron-left"></i></div>',
        nextArrow: '<div type="button" class="vip-card-slider-btn next"><i class="fas fa-chevron-right"></i></div>'
    });

    $('.home-card-inner-main-img-section').slick({
        slidesToShow: 1,
        centerPadding: '0',
        centerMode: true,
        slidesToScroll: 1,
        asNavFor: '.slider-nav',
        prevArrow: '<div class="home-card-inner-left-btn"><button><i class="fas fa-chevron-left"></i></button></div>',
        nextArrow: '<div class="home-card-inner-right-btn"><button><i class="fas fa-chevron-right"></i></button></div>'
    });

    $('.slider-nav').slick({
        slidesToShow: 6,
        slidesToScroll: 1,
        centerPadding: '80px',
        asNavFor: '.home-card-inner-main-img-section',
        arrows: false,
        focusOnSelect: true,
        responsive: [
            {
                breakpoint: 750,
                settings: {
                    slidesToShow: 3,
                }
            },
        ]
    });

    $('.agency-main-card-inner-main-img-section').slick({
        slidesToShow: 1,
        centerPadding: '0',
        centerMode: true,
        slidesToScroll: 1,
        asNavFor: '.agency-nav-slider',
        prevArrow: '<div class="home-card-inner-left-btn"><button><i class="fas fa-chevron-left"></i></button></div>',
        nextArrow: '<div class="home-card-inner-right-btn"><button><i class="fas fa-chevron-right"></i></button></div>'
    });

    $('.agency-nav-slider').slick({
        slidesToShow: 6,
        slidesToScroll: 1,
        centerPadding: '80px',
        asNavFor: '.agency-main-card-inner-main-img-section',
        arrows: false,
        focusOnSelect: true,
        responsive: [
            {
                breakpoint: 750,
                settings: {
                    slidesToShow: 3,
                }
            },
        ]
    });


    $('.residence-slider').slick({
        slidesToShow: 1,
        centerMode: true,
        infinite: true,
        centerPadding: '0',
        slidesToScroll: 1,
        // asNavFor: '.residence-slider-nav',
        prevArrow: '<div class="agency-main-card-inner-left-btn"><button><i class="fas fa-chevron-left"></i></button></div>',
        nextArrow: '<div class="agency-main-card-inner-right-btn"><button><i class="fas fa-chevron-right"></i></button></div>'
    });
}

// $('.residence-slider-nav').slick({
//     slidesToShow: 3,
//     infinite: true,
//     centerPadding: '0',
//     slidesToScroll: 1,
//     asNavFor: '.residence-slider',
//     centerMode: true,
// });
// }, 1);


$('.vip-card-slider-btn').on('click', function (e) {
    e.stopPropagation(); // use this
});

$('.object-container').click(function (e) {
    const target$ = $(e.target);
    if (target$.hasClass('vip-card-slider-btn') ||
        target$.parent().hasClass('vip-card-slider-btn') ||
        target$.hasClass('fa-star') ||
        target$.hasClass('fa-exchange-alt')
    ) {
        return true;
    }

    e.stopPropagation();
    e.preventDefault();

    location.href = $(this).data('link') + $(this).data('id')
});


$('.home-card-inner-ul-buttons li').click(function () {
    $('.home-card-inner-ul-buttons li').removeClass('active');
    $(this).addClass('active');
    const id = $(this).attr('id');
    $('.object-page-info-item').hide();
    if (id === 'object-info-item-info') {
        $('#object-page-info-item').show();
    } else if (id === 'object-info-item-plan') {
        $('#object-page-plane-item').show();
    } else if (id === 'object-info-item-map') {
        $('#object-page-map-item').show();
    }
})

$('.home-card-inner-ul-button-drop-down').click(function () {
    const id = $(this).attr('id');
    const text = $(this).text()
    console.log(text)
    $('.home-card--ul-button-data-drop-down > p').text(text);

    $('.object-page-info-item').hide();
    if (id === 'object-info-item-info-mob') {
        $('#object-page-info-item').show();
    } else if (id === 'object-info-item-plan-mob') {
        $('#object-page-plane-item').show();
    } else if (id === 'object-info-item-map-mob') {
        $('#object-page-map-item').show();
    }
})


var provincesArr = [];

$('.home-popup-list-item.provinces').click(function (e) {
    const target$ = $(e.target);
    if (target$.hasClass('home-search-popup-close-btn') ||
        target$.parent().hasClass('home-search-popup-close-btn')
    ) {
        return true;
    }
    e.stopPropagation();
    e.preventDefault();
    $(this).addClass('active');
    for (let i = 0; i < provincesArr.length; i++) {
        if (provincesArr[i] === $(this).data('id')) {
            return false;
        }
    }
    provincesArr.push($(this).data('id'))
    $('#provinces-hidden-input').val(provincesArr.join(','))
})

$('.home-search-popup-close-btn.provinces').click(function () {
    $('#' + $(this).data('id')).toggleClass('active')
    for (let i = 0; i < provincesArr.length; i++) {
        if (provincesArr[i] === $(this).data('id')) {
            provincesArr.splice(i, 1)
        }
    }
    $('#provinces-hidden-input').val(provincesArr.join(','))
})

var markersArr = [];

$('.home-popup-list-item.markers').click(function (e) {
    const target$ = $(e.target);
    if (target$.hasClass('home-search-popup-close-btn') ||
        target$.parent().hasClass('home-search-popup-close-btn')
    ) {
        return true;
    }
    e.stopPropagation();
    e.preventDefault();
    $(this).addClass('active');
    for (let i = 0; i < markersArr.length; i++) {
        if (markersArr[i] === $(this).data('id')) {
            return false;
        }
    }
    markersArr.push($(this).data('id'))
    $('#markers-hidden-input').val(markersArr.join(','))
})

$('.home-search-popup-close-btn.markers').click(function () {
    $('#' + $(this).data('id')).toggleClass('active')
    for (let i = 0; i < markersArr.length; i++) {
        if (markersArr[i] === $(this).data('id')) {
            markersArr.splice(i, 1)
        }
    }
    $('#markers-hidden-input').val(markersArr.join(','))
})

$('.agency-main-card-buttons-item').click(function () {
    $('.agency-main-card-buttons-item').removeClass('active');
    $(this).addClass('active');
    const val = $(this).data('value');
    $('.agency-main-card-some-info').hide();

    if (val === 'info') {
        $('.agency-main-card-information-item-info').show()
    } else if (val === 'map') {
        $('.agency-main-card-information-item-map').show()
    }
})

$('.order-flat-location-btn').click(function () {
    $('#order-flat-map-popup-bg').addClass('active')
})


$('.block-list a').click(function () {
    console.log($(this).data('id'))
    $('#place-ads-package-item-input').val($(this).data('id'))
})


// var element = document.getElementById('home-mobile-input');
// var maskOptions = {
//     mask: '(000)-000-00-00'
// };
// var mask = IMask(element, maskOptions);


let map;
var firsMarker = true;

function initMapCommon(id, lt, lg) {
    console.log(0)
    var lat = +lt;
    var lng = +lg;
    var myLatlng = new google.maps.LatLng(lat, lng);
    var mapOptions = {
        center: new google.maps.LatLng(lat, lng),
        zoom: 10,
        streetViewControl: false,
        mapTypeControl: true,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    var map = new google.maps.Map(document.getElementById(id), mapOptions);
    const myLatLng = {lat: lat, lng: lng};
    marker = new google.maps.Marker({
        position: myLatLng,
        map: map
    });

    console.log(marker)
    // google.maps.event.addListener(
    //     map,
    //     'click',
    //     function (e) {
    //         placeMarker(e.latLng, map);
    //         firsMarker = false;
    //     }
    // );
}

// function placeMarker(location, map) {
//     $('#marker-position-lat').val(location.lat())
//     $('#marker-position-lng').val(location.lng())
//
//     if (!firsMarker) {
//         marker.setPosition(location);
//     } else {
//         marker = new google.maps.Marker({
//             position: location,
//             map: map
//         });
//     }
// }


// initMap('object-page-map-item')


$('.pagination-number-btn').click(function () {
    $('.pagination-number-btn').removeClass('active');
    $(this).addClass('active');
})

$('#goBack').click(function () {
    window.history.back();
})

var $menu = $('.custom-common-select');


$('.custom-common-select').click(function () {
    $menu = $(this)
})

$(document).click(e => {
    if (!$menu.is(e.target) // if the target of the click isn't the container...
        && $menu.has(e.target).length === 0) // ... nor a descendant of the container
    {
        $('.select-list').removeClass('active');
    }
});


let popup, Popup, rentMap;

function initRentMap(x, y, id) {
    class Popup extends google.maps.OverlayView {
        position;
        containerDiv;

        constructor(position, content) {
            super();
            this.position = position;
            content.classList.add("popup-bubble");
            const bubbleAnchor = document.createElement("div");
            bubbleAnchor.classList.add("popup-bubble-anchor");
            bubbleAnchor.appendChild(content);
            this.containerDiv = document.createElement("div");
            this.containerDiv.classList.add("popup-container");
            this.containerDiv.appendChild(bubbleAnchor);
            Popup.preventMapHitsAndGesturesFrom(this.containerDiv);
        }

        onAdd() {
            this.getPanes().floatPane.appendChild(this.containerDiv);
        }

        onRemove() {
            if (this.containerDiv.parentElement) {
                this.containerDiv.parentElement.removeChild(this.containerDiv);
            }
        }

        draw() {
            const divPosition = this.getProjection().fromLatLngToDivPixel(
                this.position
            );
            // Hide the popup when it is far out of view.
            const display =
                Math.abs(divPosition.x) < 4000 && Math.abs(divPosition.y) < 4000
                    ? "block"
                    : "none";

            if (display === "block") {
                this.containerDiv.style.left = divPosition.x + "px";
                this.containerDiv.style.top = divPosition.y + "px";
            }

            if (this.containerDiv.style.display !== display) {
                this.containerDiv.style.display = display;
            }
        }
    }

    popup = new Popup(
        new google.maps.LatLng(x, y),
        document.getElementById(id)
    );
    popup.setMap(rentMap);
}

// initRentMap(-33.866, 151.196, 'map-popup-container')

$('.search-input-list').css('display', 'none')

function placeSearchInput(e) {
    const inputText = e.value;
    if (inputText.length !== 0) {
        $('.search-input-list').css('display', 'block')
    } else {
        $('.search-input-list').css('display', 'none')
    }
    $('.search-checkbox-text').map(item => {
        const text = $('.search-checkbox-text')[item].textContent;
        const textContainer = $('.search-checkbox-text')[item].parentElement;
        if (text.toLowerCase().includes(inputText.toLowerCase())) {
            textContainer.style.display = 'flex'
        } else {
            textContainer.style.display = 'none'
        }
    })

    if ($('.search-input-list').height() === 0) {
        $('.search-input-list').css('border', 'none');
    } else {
        $('.search-input-list').css('border', 'solid 1px rgba(119, 104, 171, 0.1)');
    }
}

$('.search-input-list-item').change(function () {
    const arr = $('.search-input-list-item').children('input:checked');
    const dataArr = [];
    arr.map(item => {
        const dataItem = {
            id: arr[item].getAttribute('id'),
            text: arr[item].dataset.text
        }
        dataArr.push(dataItem)
    })
})

// LOGIN

function openPhoneEditPopup() {
    $('#refresh-pass').show();
}


var requestId;

function sentPhoneForResetPassword() {
    const phone = $('#forgotPasswordPhoneInput').val();
    $.post('/forget-password/numberCheck', {phone: phone,}, (response) => {
        requestId = response[0].requestId;
        console.log(requestId)
        if (response[0].status === false) {
            $('#phoneNumberError').show()
        } else {
            $('#refresh-pass').hide();
            $('#otp-code').show()
        }
    });
}

var passwordId;

function sendOtp() {
    const otp = +($('#digit-1').val() + $('#digit-2').val() + $('#digit-3').val() + $('#digit-4').val() + $('#digit-5').val() + $('#digit-6').val())
    $.post('/forget-password/verifyOtp', {code: otp, requestId: requestId}, (response) => {
        if (response.verified === true) {
            $('#otp-code').hide()
            $('#new-pass').show()
            passwordId = response.id;
        } else {
            $('#otpErrorText').show();
        }
    });
}

function sendNewPassword() {
    const newPassword = $('#newPassword').val();
    const password = $('#password').val();
    $.post('/forget-password/changePassword', {
        password: password,
        newPassword: newPassword,
        id: passwordId
    }, (response) => {
        console.log(response)
        if (response.result) {
            $('#new-pass').hide();
            $('#info').show();
        } else {
            $('#newPasswordErrorText').text(response.message);
            $('#newPasswordErrorText').show();
        }
    });
}

function closeSuccessPopup() {
    $('#info').hide();
}


// SEARCH MAP


var locations = [
    // {lat: -31.56391, lng: 147.154312},
    // {lat: -33.718234, lng: 150.363181},
    // {lat: -33.727111, lng: 150.371124},
    // {lat: -33.848588, lng: 151.209834},
    // {lat: -33.851702, lng: 151.216968},
    // {lat: -34.671264, lng: 150.863657},
];

var mapResponse = []


function showSearchMap(id) {

    $('#' + id).show()
    $('.ads-list').hide()

    $.get('/map/getCoordinates', (response) => {
        mapResponse = response;
        locations = mapResponse[0].map(item => {
            return {
                lat: +item.data['map-lat'],
                lng: +item.data['map-lng'],
                id: item['_id']
            }
        })
        initMap(id)
    });

}



function initMap(id) {
    rentMap = new google.maps.Map(document.getElementById(id), {
        zoom: 8,
        center: {lat: 40.40483713845547, lng: 48.90855275249951},
    });
    const labels = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    const markers = locations.map((location, i) => {
        const markerOfList = new google.maps.Marker({
            position: location,
            label: labels[i % labels.length],
            data: location.id,
        });
        markerOfList.addListener("click", function () {
            $.post('/map/getObject', {id: markerOfList.data}, (response) => {
                const data = response[0][0].data;
                const popupData = {
                    price: data.price,
                    img: data.images[0].path,
                    address: data.address,
                    totalFloors: data['total-floors'],
                    area: data.area,
                    totalRoomCount: data['total-room-count'],
                    sanitarCount: data['sanitar-count'],
                    createDate: data['create-date']
                }
                initCustomMarkerPopup(rentMap, markerOfList, popupData)
            });
        });
        return markerOfList;
    });
    new MarkerClusterer(rentMap, markers, {
        imagePath:
            "https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m",
    });
}

function initCustomMarkerPopup(rentMap, markerOfList, data) {


    var imgSrc = "http://evinaznew.cms.kube.tisserv.net/upload/" + data.img;
    const newDate = new Date(data.createDate)
    const date = newDate.getDate() + '.' + newDate.getMonth() + '.' + newDate.getFullYear()

    let popupContent = `<div class="map-popup-container" id="map-popup-container">
                                        <div class="map-popup-header">
                                           <img class="map-popup-header-img" src="${imgSrc}" alt="">
                                            <div class="map-popup-price-container">
                                               <p class="map-popup-price">${data.price}</p>
                                           </div>
                                        </div>
                                        <div class="map-popup-content">
                                            <p class="map-popup-address">${data.address}</p>
                                            <ul class="map-popup-info-list">
                                                <li class="map-popup-info-item">${data.totalRoomCount} otaq sayi</li>
                                                <li class="map-popup-info-item">${data.area} m²</li>
                                                <li class="map-popup-info-item">${data.totalRoomCount} cemi otaq</li>
                                                <li class="map-popup-info-item">${data.sanitarCount} s/q</li>
                                            </ul>
                                            <p class="map-popup-date">${date}</p>
                                        </div>
                                    </div>`;

    infowindow = new google.maps.InfoWindow({
        content: popupContent
    });
    infowindow.open(rentMap, markerOfList);
}


// $(document).ready(function () {
//     const arr = $('.price-dots')
//     for (let i = 0; i < arr.length; i++) {
//         const el = arr[i];
//         let text = el.textContent;
//         text = text ? text.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.') : '';
//         $('.price-dots').text(text);
//     }
// })


$('.mobile-custom-select').click(function () {
    $(this).siblings('.mobile-custom-select-triggered').toggleClass('active');
})


$('.mobile-custom-select-triggered ul li').click(function () {
    const value = $(this).data('value');

    $('.mobile-custom-select').siblings('.mobile-custom-select-triggered').toggleClass('active');

    $('#object-page-info-item').hide();
    $('#object-page-plane-item').hide();
    $('#object-page-map-item').hide();

    if (value === 'info') {
        $('#object-page-info-item').show();
    }
    if (value === 'plan') {
        $('#object-page-plane-item').show();
    }
    if (value === 'map') {
        $('#object-page-map-item').show();
    }

})































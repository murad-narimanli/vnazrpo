$('.custom-ad-select').click(function () {
    $(this).children('.select-list').toggleClass('active')
})

$('#add-type > li').click(function () {
    const val = $(this).attr('value');
    if (val === '1') {
        $('.add-type-triggered').hide();
        $('.checkbox-container-wrapper').show();
    } else if (val === '2') {
        $('.add-type-triggered').hide();
        $('.monthly-select').show();
    }
})

$('.property-type-class > li').click(function () {
    $('.ad-input-row .ad-input-row-item input').val('');
    const val = $(this).attr('data-value');
    $('.ad-input-row-item').hide();
    $('.ad-input-row-item').addClass('hide-input-block');
    if (val === '60c1caea1f35a21fd8f3d60b' || val === '60c1cae41f35a21fd8f3d607') {
        $('#common-area').show();
        $('#common-area').removeClass('hide-input-block');
        $('#number-ranks').show();
        $('#number-ranks').removeClass('hide-input-block');
        $('#location-ranks').show();
        $('#location-ranks').removeClass('hide-input-block');
        $('#total-room-count').show();
        $('#total-room-count').removeClass('hide-input-block');
        $('#sanitary-junction').show();
        $('#sanitary-junction').removeClass('hide-input-block');
    } else if (val === '60c1da711f35a21fd8f3d66d') {
        $('#common-area').show();
        $('#common-area').removeClass('hide-input-block');
        $('#plot-land').show();
        $('#plot-land').removeClass('hide-input-block');
        $('#total-room-count').show();
        $('#total-room-count').removeClass('hide-input-block');
        $('#sanitary-junction').show();
        $('#sanitary-junction').removeClass('hide-input-block');
    } else if (val === '60dad4370720464a362eee67') {
        $('#common-area').show();
        $('#common-area').removeClass('hide-input-block');
        $('#plot-land').show();
        $('#plot-land').removeClass('hide-input-block');
    } else if (val === '60c1cabf1f35a21fd8f3d5fb') {
        $('#plot-land').show();
        $('#plot-land').removeClass('hide-input-block');
    } else if (val === '60c1daab1f35a21fd8f3d694') {
        $('#common-area').show();
        $('#common-area').removeClass('hide-input-block');
    } else if (val === '60c1daa61f35a21fd8f3d693') {
        $('#common-area').show();
        $('#common-area').removeClass('hide-input-block');
    } else if (val === '60c1da7b1f35a21fd8f3d66e') {
        $('#total-room-count').show();
        $('#total-room-count').removeClass('hide-input-block');
        $('#office-type').show();
        $('#office-type').removeClass('hide-input-block');
    }
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

$('#property-type li').click(function () {
    const text = $(this).text();
    $(this).parent().siblings('.select-header').children('.select-header-text').text(text)
})

$('.select-list li').click(function () {
    const text = $(this).text();
    $(this).parent().siblings('.select-header').children('.select-header-text').text(text)
})

$('#add-type li').click(function () {
    const text = $(this).text();
    $(this).parent().siblings('.select-header').children('.select-header-text').text(text)
})


$('#add-phone').click(function () {
    $(this).hide();
    $('#second-phone').show();
})

$('.add-media-btn').click(function () {
    $('.add-media-btn').removeClass('active');
    $(this).addClass('active');
    $('.ad-content-value-item').hide();
    $('.ad-content-value-item#' + $(this).data('value')).show();
})

$('.block-item').click(function () {
    const value = $(this).attr('id');
    $('.block-item').removeClass('active');
    $(this).addClass('active');
    $('#ad-package-type').attr('value', value);
})


$(function () {
    // Multiple images preview in browser
    var imagesPreview = function (input, placeToInsertImagePreview) {

        if (input.files) {
            var filesAmount = input.files.length;

            for (i = 0; i < filesAmount; i++) {
                var reader = new FileReader();

                reader.onload = function (event) {
                    // $('<div class="alert-message"></div>')
                    $($.parseHTML('<img>')).attr('src', event.target.result).appendTo(placeToInsertImagePreview);
                }

                reader.readAsDataURL(input.files[i]);
            }
        }

    };

    $('.gallery-photo-add').on('change', function () {
        imagesPreview(this, $(this).siblings('.gallery'));
    });
});

let map;
var firsMarker = true;

function initMap() {
    var lt = 40.40657390497642;
    var lg = 49.87074209921141;
    var myLatlng = new google.maps.LatLng(lt, lg);
    var mapOptions = {
        center: new google.maps.LatLng(lt, lg),
        zoom: 10,
        streetViewControl: false,
        mapTypeControl: false,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    var map = new google.maps.Map(document.getElementById('map'), mapOptions);

    google.maps.event.addListener(
        map,
        'click',
        function (e) {
            placeMarker(e.latLng, map);
            firsMarker = false;
        }
    );
}

function placeMarker(location, map) {
    $('#marker-position-lat').val(location.lat())
    $('#marker-position-lng').val(location.lng())

    if (!firsMarker) {
        marker.setPosition(location);
    } else {
        marker = new google.maps.Marker({
            position: location,
            map: map
        });
    }
}

//
// function initMap() {
//     const map = new google.maps.Map(document.getElementById("map"), {
//         zoom: 3,
//         center: { lat: -28.024, lng: 140.887 },
//     });
//     const labels = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
//     const markers = locations.map((location, i) => {
//         return new google.maps.Marker({
//             position: location,
//             label: labels[i % labels.length],
//         });
//     });
//     new MarkerClusterer(map, markers, {
//         imagePath:
//             "https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m",
//     });
// }
// const locations = [
//     { lat: -31.56391, lng: 147.154312 },
//     { lat: -33.718234, lng: 150.363181 },
//     { lat: -33.727111, lng: 150.371124 },
//     { lat: -33.848588, lng: 151.209834 },
//     { lat: -33.851702, lng: 151.216968 },
//     { lat: -34.671264, lng: 150.863657 },
//     { lat: -35.304724, lng: 148.662905 },
//     { lat: -36.817685, lng: 175.699196 },
//     { lat: -36.828611, lng: 175.790222 },
//     { lat: -37.75, lng: 145.116667 },
//     { lat: -37.759859, lng: 145.128708 },
//     { lat: -37.765015, lng: 145.133858 },
//     { lat: -37.770104, lng: 145.143299 },
//     { lat: -37.7737, lng: 145.145187 },
//     { lat: -37.774785, lng: 145.137978 },
//     { lat: -37.819616, lng: 144.968119 },
//     { lat: -38.330766, lng: 144.695692 },
//     { lat: -39.927193, lng: 175.053218 },
//     { lat: -41.330162, lng: 174.865694 },
//     { lat: -42.734358, lng: 147.439506 },
//     { lat: -42.734358, lng: 147.501315 },
//     { lat: -42.735258, lng: 147.438 },
//     { lat: -43.999792, lng: 170.463352 },
// ];


var placeImages = {
    images: [],
    blueprint: []
}

$('.gallery-photo-add').change(function () {
    const type = $(this).data('type');
    const files = $(this)[0].files;
    const fileLength = files.length;
    for (let i = 0; i < fileLength; i++) {
        let photo = files[i];  // file from input
        var data = new FormData();
        data.append("file", photo);
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'https://evinaznew.cms.kube.tisserv.net/api//api/1.0/media', true);
        xhr.onload = function () {
            const data = JSON.parse(this.responseText)
            placeImages[type].push({
                path: data.name
            });
        };
        xhr.send(data);
    }
})

initMap()



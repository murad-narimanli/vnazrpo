let listBtn = document.querySelector('.last-ads-cards-section-button-list');
let mapBtn = document.querySelector('.last-ads-cards-section-button-map');

let listSection = document.querySelector('.last-section-cards-flex');
let mapSection = document.querySelector('#rent-search-map');

listBtn.addEventListener('click', showList);
mapBtn.addEventListener('click', showMap);

function showList() {
    if (mapSection && listSection) {
        listSection.style.display = 'flex';
        mapSection.style.display = 'none';

        listBtn.style.color = "#ffffff";
        listBtn.style.backgroundColor = "#7967AD";

        mapBtn.style.color = "#7967AD";
        mapBtn.style.backgroundColor = "#ffffff";
    }
}

var locations = [
    // {lat: -31.56391, lng: 147.154312},
    // {lat: -33.718234, lng: 150.363181},
    // {lat: -33.727111, lng: 150.371124},
    // {lat: -33.848588, lng: 151.209834},
    // {lat: -33.851702, lng: 151.216968},
    // {lat: -34.671264, lng: 150.863657},
];

var mapResponse = []

// vip/kiraye/son

function showMap() {
    mapSection.style.display = 'flex';
    listSection.style.display = 'none';

    mapBtn.style.color = "#ffffff";
    mapBtn.style.backgroundColor = "#7967AD";

    listBtn.style.color = "#7967AD";
    listBtn.style.backgroundColor = "#ffffff";

    $.get('/map/getCoordinates/kiraye', (response) => {
        mapResponse = response;
        locations = mapResponse[0].map(item => {
            return {
                lat: +item.data['map-lat'],
                lng: +item.data['map-lng'],
                id: item['_id']
            }
        })
        initMap()
    });

}


// let currentMark;

function initMap() {
    rentMap = new google.maps.Map(document.getElementById("rent-search-map"), {
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
            console.log('0')
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


// SEARCH MAP


var locationsSome = [
    // {lat: -31.56391, lng: 147.154312},
    // {lat: -33.718234, lng: 150.363181},
    // {lat: -33.727111, lng: 150.371124},
    // {lat: -33.848588, lng: 151.209834},
    // {lat: -33.851702, lng: 151.216968},
    // {lat: -34.671264, lng: 150.863657},
];

var mapResponseSome = []

function hideSearchMap(id) {
    var el = document.getElementById(id);
    $('.ads-list').fadeIn()
    el.style.opacity = 0
    el.style.height = "0px"
}

function showMyMap(id) {
    var el = document.getElementById(id);
    el.style.opacity = 0.9
    el.style.height = "auto"
    console.log(el)
    $('.ads-list').fadeOut()
}

function showSearchMap(id, type) {
    let types = type
    $('#' + id).show()
    $('.ads-list').hide()

    const link = window.location.href;

    if(link.includes('vip')){
        types = 'vip'
    }
    if(link.includes('vip')){
        types = 'vip'
    }

    $.get(`/map/getCoordinates/${types}`, (response) => {
        mapResponseSome = response;
        locationsSome = mapResponseSome[0].map(item => {
            return {
                lat: +item.data['map-lat'],
                lng: +item.data['map-lng'],
                id: item['_id']
            }
        })
        initMapSome(id)
    });

}


function initMapSome(id) {
    rentMap = new google.maps.Map(document.getElementById(id), {
        zoom: 8,
        center: {lat: 40.40483713845547, lng: 48.90855275249951},
    });
    const labels = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    const markers = locationsSome.map((location, i) => {
        const markerOfList = new google.maps.Marker({
            position: location,
            label: labels[i % labels.length],
            data: location.id,
        });
        markerOfList.addListener("click", function () {
            console.log('1')
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
            "https://evinaz.tisserv.net/assets/icons/map-mark.png",
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


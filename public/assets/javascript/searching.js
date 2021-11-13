let searchingButton = document.querySelector('.search-btn');
let valueButton = document.querySelector('.compare-btn');

let valueForm = document.querySelector('.value-form');
let searchForm = document.querySelector('.search-form');

let detailButton = document.querySelector('#about-search');
let detailDiv = document.querySelector('.details-searching');

let remove = true;

function searcing(){
    searchingButton.style.backgroundColor = 'white';
    searchingButton.style.color = '#7967AD';
    valueButton.style.backgroundColor= '#7967AD';
    valueButton.style.color= 'white';
    searchForm.style.display='flex';
    valueForm.style.display='none';
}

function value(){
    valueButton.style.backgroundColor = 'white';
    valueButton.style.color = '#7967AD';
    searchingButton.style.backgroundColor= '#7967AD';
    searchingButton.style.color= 'white';
    valueForm.style.display='flex';
    searchForm.style.display='none';
    detailDiv.style.display='none';
}

function details(){

    if(remove== true){
        detailDiv.style.display='flex';
        remove = false;
    }else{
        detailDiv.style.display='none';
        remove = true;

    }
}

searchingButton.addEventListener('click', searcing);
valueButton.addEventListener('click', value);
detailButton.addEventListener('click', details)

// ----------------------------
// ----------------------------
// ----------------------------
// by Turgay


$('body').on('click','.submitSearchForm',function(e){
    e.preventDefault();
    var data = collectSearchData();
    var url = serialize(data);
    window.location.href=window.location.href.split('?')[0]+'?'+url;
});

function collectSearchData(){
    var data = new Object();

    data.announcementType    = $('[name="announcementType"]').val();
    data.objectType          = $('[name="objectType"]').val();
    data.roomCount           = $('[name="roomCount"]').val();
    data.floorMin            = $('[name="floorMin"]').val();
    data.floorMax            = $('[name="floorMax"]').val();
    data.priceMin            = $('[name="priceMin"]').val();
    data.priceMax            = $('[name="priceMax"]').val();
    data.areaMin             = $('[name="areaMin"]').val();
    data.areaMax             = $('[name="areaMax"]').val();
    data.landAreaMin         = $('[name="landAreaMin"]').val();
    data.landAreaMax         = $('[name="landAreaMax"]').val();
    data.repairStatus        = $('[name="repairStatus"]').val();
    data.documentType        = $('[name="documentType"]').val();
    data.province            = $('[name="province"]').val();
    data.metro               = $('[name="metro"]').val();
    data.marker              = $('[name="marker"]').val();

    return data;
}

serialize = function(obj) {
  var str = [];
  for (var p in obj)
    if (obj.hasOwnProperty(p) && obj[p] && obj[p].length > 0) {
      str.push(encodeURIComponent(p) + "=" + encodeURIComponent(obj[p]));
    }
  return str.join("&");
}

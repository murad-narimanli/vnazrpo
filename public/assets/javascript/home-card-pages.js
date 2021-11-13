let dataBtn = document.querySelector('.home-card-inner-ul-button-data');
let planBtn = document.querySelector('.home-card-inner-ul-button-plan');
let mapBtn = document.querySelector('.home-card-inner-ul-button-map');
let lastBtn = document.querySelector('.home-card-inner-ul-buttons-last');

let homeSection = document.querySelector('.home-card-inner-buttons-table-main');
let homePlanSection = document.querySelector('.home-card-inner-table-image');
let mapSection = document.querySelector('.home-card-inner-table-map');
let threeDSection = document.querySelector('.home-card-inner-table-3d-map');

dataBtn.addEventListener('click', showData);
planBtn.addEventListener('click', showPlan);
mapBtn.addEventListener('click', showMap);
lastBtn.addEventListener('click', showLast);

function showData(){
    homeSection.style.display = 'block';
    homePlanSection.style.display = 'none';
    mapSection.style.display = 'none';
    threeDSection.style.display = 'none';

    dataBtn.style.color = '#7967AD';
    planBtn.style.color = '#3B3B3B';
    mapBtn.style.color = '#3B3B3B';
    lastBtn.style.color = '#3B3B3B';

    dataBtn.style.backgroundColor = 'white';
    planBtn.style.backgroundColor = '#f8f7fc';
    mapBtn.style.backgroundColor = '#f8f7fc';
    lastBtn.style.backgroundColor = '#f8f7fc';

    dataBtn.style.border = '1px solid #7967AD';
    dataBtn.style.borderBottom = '3px solid #7967AD';
    planBtn.style.border = 'none';
    mapBtn.style.border = 'none';
    lastBtn.style.border = 'none';

    dataBtn.style.borderTopLeftRadius = '10px';
}


function showPlan(){
    homeSection.style.display = 'none';
    homePlanSection.style.display = 'flex';
    mapSection.style.display = 'none';
    threeDSection.style.display = 'none';

    dataBtn.style.color = '#3B3B3B';
    planBtn.style.color = '#7967AD';
    mapBtn.style.color = '#3B3B3B';
    lastBtn.style.color = '#3B3B3B';

    dataBtn.style.backgroundColor = '#f8f7fc';
    planBtn.style.backgroundColor = 'white';
    mapBtn.style.backgroundColor = '#f8f7fc';
    lastBtn.style.backgroundColor = '#f8f7fc';

    dataBtn.style.border = 'none';
    planBtn.style.border = '1px solid #7967AD';
    planBtn.style.borderBottom = '3px solid #7967AD';
    mapBtn.style.border = 'none';
    lastBtn.style.border = 'none';
}


function showMap(){
    homeSection.style.display = 'none';
    homePlanSection.style.display = 'none';
    mapSection.style.display = 'flex';
    threeDSection.style.display = 'none';

    dataBtn.style.color = '#3B3B3B';
    planBtn.style.color = '#3B3B3B';
    mapBtn.style.color = '#7967AD';
    lastBtn.style.color = '#3B3B3B';

    dataBtn.style.backgroundColor = '#f8f7fc';
    planBtn.style.backgroundColor = '#f8f7fc';
    mapBtn.style.backgroundColor = 'white';
    lastBtn.style.backgroundColor = '#f8f7fc';

    dataBtn.style.border = 'none';
    planBtn.style.border = 'none';
    mapBtn.style.border = '1px solid #7967AD';
    mapBtn.style.borderBottom = '3px solid #7967AD';
    lastBtn.style.border = 'none';
}


function showLast(){
    homeSection.style.display = 'none';
    homePlanSection.style.display = 'none';
    mapSection.style.display = 'none';
    threeDSection.style.display = 'flex';

    dataBtn.style.color = '#3B3B3B';
    planBtn.style.color = '#3B3B3B';
    mapBtn.style.color = '#3B3B3B';
    lastBtn.style.color = '#7967AD';

    dataBtn.style.backgroundColor = '#f8f7fc';
    planBtn.style.backgroundColor = '#f8f7fc';
    mapBtn.style.backgroundColor = '#f8f7fc';
    lastBtn.style.backgroundColor = 'white';

    dataBtn.style.border = 'none';
    planBtn.style.border = 'none';
    mapBtn.style.border = 'none';
    lastBtn.style.border = '1px solid #7967AD';
    lastBtn.style.borderBottom = '3px solid #7967AD';

    lastBtn.style.borderTopRightRadius = '10px';
}
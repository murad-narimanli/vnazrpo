let myAds = document.querySelector('#user-ads-box');
let myAccount = document.querySelector('#user-account-box');
let myCash = document.querySelector('#user-cash');
let myProfile = document.querySelector('#user-profile');

let adsDiv = document.querySelector('.user-page-ads-list-cards');
let accountDiv = document.querySelector('.user-page-account');
let facturaDiv = document.querySelector('.user-page-factura');
let profileDiv = document.querySelector('.user-page-profile');


let paybtn = document.querySelector('.paybtn');
let upperPayDiv = document.querySelector('.hidden-payButton');
let lowerPayDiv = document.querySelector('.hidden-payDiv');

let userPageButtons = document.querySelector('.user-page-ads-list-buttons');



myAds.addEventListener('click', adsPage);
myAccount.addEventListener('click', accountPage);
myCash.addEventListener('click', cashPage);
myProfile.addEventListener('click', profilePage);
paybtn.addEventListener('click', pay);



function adsPage(){
    myAds.style.color='#7967AD';
    myAds.style.borderColor='rgb(179, 179, 179)';
    adsDiv.style.display = 'flex';

    myAccount.style.color='rgb(117, 117, 117)';
    myAccount.style.borderColor='#f6f5fa8c';
    accountDiv.style.display = 'none';

    myCash.style.borderColor = '#f6f5fa8c';
    facturaDiv.style.display = 'none';
    myCash.style.color = 'rgb(117, 117, 117)'

    myProfile.style.borderColor = '#f6f5fa8c';
    profileDiv.style.display = 'none';
    myProfile.style.color = 'rgb(117, 117, 117)'
    
    userPageButtons.style.visibility ='visible';
}

function accountPage(){
    myAccount.style.color='#7967AD';
    myAccount.style.borderColor='rgb(179, 179, 179)';
    accountDiv.style.display = 'flex';

    adsDiv.style.display = 'none';
    myAds.style.color='rgb(117, 117, 117)';
    myAds.style.borderColor='#f6f5fa8c'

    myCash.style.borderColor = '#f6f5fa8c';
    myCash.style.color = 'rgb(117, 117, 117)'
    facturaDiv.style.display = 'none';

    myProfile.style.borderColor = '#f6f5fa8c';
    profileDiv.style.display = 'none';
    myProfile.style.color = 'rgb(117, 117, 117)'

    userPageButtons.style.visibility ='hidden';
}

function cashPage(){
    myCash.style.color = '#7967AD'
    myCash.style.borderColor = 'rgb(179, 179, 179)';
    facturaDiv.style.display = 'flex';

    accountDiv.style.display = 'none';
    myAccount.style.borderColor='#f6f5fa8c';
    myAccount.style.color='rgb(117, 117, 117)';
    
    myAds.style.borderColor='#f6f5fa8c';
    myAds.style.color='rgb(117, 117, 117)';
    adsDiv.style.display = 'none';

    myProfile.style.borderColor = '#f6f5fa8c';
    profileDiv.style.display = 'none';
    myProfile.style.color = 'rgb(117, 117, 117)'
    
    userPageButtons.style.visibility ='hidden';
}

function profilePage(){
    myProfile.style.borderColor = 'rgb(179, 179, 179)';
    profileDiv.style.display = 'flex';
    myProfile.style.color = '#7967AD'

    accountDiv.style.display = 'none';
    myAccount.style.borderColor='#f6f5fa8c';
    myAccount.style.color='rgb(117, 117, 117)';
    
    myAds.style.borderColor='#f6f5fa8c';
    myAds.style.color='rgb(117, 117, 117)';
    adsDiv.style.display = 'none';

    myCash.style.borderColor = '#f6f5fa8c';
    myCash.style.color = 'rgb(117, 117, 117)'
    facturaDiv.style.display = 'none';

    userPageButtons.style.visibility ='hidden';
}

function pay(){
    upperPayDiv.style.display='none';
    lowerPayDiv.style.display='flex'
}

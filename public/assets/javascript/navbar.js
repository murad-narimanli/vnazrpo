let firstNavBtn = document.querySelector('.hamburger-dropped-item');
let secondNavBtn = document.querySelector('.hamburger-dropped-item-two');

let first = 'true';
let second = 'true';

let exit = document.querySelector('.fa-times-div');
let hamburgerBTN = document.querySelector('.fa-bars-div');
let overlay = document.querySelector('.overlay');

firstNavBtn.addEventListener('click', FirstRow);
secondNavBtn.addEventListener('click', SecondRow);
exit.addEventListener('click', ExitHamburgerMenu);
overlay.addEventListener('click', ExitHamburgerMenu);
hamburgerBTN.addEventListener('click', ShowHamburgerMenu);


function FirstRow(){
    if(first===true){
         document.querySelector('.hamburger-drop-down').style.display='flex';
         first=false;
    }else{
        document.querySelector('.hamburger-drop-down').style.display='none';
        first=true;
    }
}

function SecondRow(){
    if(second===true){
        document.querySelector('.hamburger-drop-down-two').style.display='flex';
        second=false;
    }else{
        document.querySelector('.hamburger-drop-down-two').style.display='none';
        second=true;
    }
}

function ExitHamburgerMenu(){
    document.querySelector('.hamburger-menu-div').style.right='-100%';
    document.querySelector('.overlay').style.display='none';
}

function ShowHamburgerMenu(){
    document.querySelector('.hamburger-menu-div').style.right='0';
    document.querySelector('.overlay').style.display='block';
}

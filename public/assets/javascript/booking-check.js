let bookCheck = document.querySelector('.check-box');
let bookCheckBtn = document.querySelector('.check-div');
let bookCheckCircle = document.querySelector('.check-circle');
let checked=true;

function bookChecked(){
    if(checked){
        bookCheckBtn.style.backgroundColor='rgb(179, 179, 179)';
        bookCheckCircle.style.marginLeft='0px';
        checked=false;
    }else{
        bookCheckBtn.style.backgroundColor='#70C7AB';
        bookCheckCircle.style.marginLeft='30px';
        checked=true;
    }
}

bookCheckBtn.addEventListener('click', bookChecked);

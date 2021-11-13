let minusBtn = document.querySelectorAll('.fa-minus');
let plusBtn = document.querySelectorAll('.fa-plus');
let question = document.querySelectorAll('.faq-header-question')
let card = document.querySelectorAll('.faq-paragraph')


for(let i=0; i<=minusBtn.length-1; i++){
        plusBtn[i].addEventListener('click', function changeToPlus(){
        plusBtn[i].style.visibility='hidden';
        question[i].style.color = '#7967AD';
        minusBtn[i].style.visibility = 'visible';
        card[i].style.display = 'flex';
        })

        minusBtn[i].addEventListener('click', function changeToPlus(){
        plusBtn[i].style.visibility='visible';
        question[i].style.color = 'black'
        minusBtn[i].style.visibility = 'hidden'
        card[i].style.display = 'none'
    })
  }



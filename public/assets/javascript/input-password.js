let oneEye = document.querySelector('.fa-eye-one');
let twoEye = document.querySelector('.fa-eye-two');

let firstPass = document.querySelector('.firstPassAgain');
let secondPass = document.querySelector('.secondPassAgain')

oneEye.addEventListener('click', showPassOne);
twoEye.addEventListener('click', showPassTwo);

let parameterOne = true;
let parametertwo = true;

function  showPassOne(){

    if(parameterOne===true){
        firstPass.type = 'text';
        parameterOne =false;
    }else{
        firstPass.type = 'password';
        parameterOne =true;
    }
}

function showPassTwo(){
    if(parametertwo===true){
        secondPass.type = 'text';
        parametertwo =false;
    }else{
        secondPass.type = 'password';
        parametertwo =true;
    }

}

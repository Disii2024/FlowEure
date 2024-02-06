// console.log('hello world!')

const burger=document.querySelector('#icon-burger');
const navList=document.querySelector('header nav ul')

burger.addEventListener('click', () => {
    if (window.innerWidth < 700) {
        navList.classList.add('dispNone');
    }
});
navList.addEventListener('click', ()=> {
    if (window.innerWidth < 700) {
        navList.classList.remove('navMobile');
    }
});


// const burger = document.querySelector("#icon_burger");
// const nav = document.querySelector("#menu_open");
// const body = document.querySelector("main");
// burger.addEventListener("click", () => {
//     nav.classList.toggle("dispNone");
// });
// nav.addEventListener("click", () => {  
//     nav.classList.toggle("dispNone");
// });
// body.addEventListener("click", () => {  
//     nav.classList.add("dispNone");
// });

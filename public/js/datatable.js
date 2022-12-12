let scroller = document.querySelector('.scroller');
console.log(scroller);
console.log(document.documentElement.scrollHeight);
console.log(document.documentElement.clientHeight);
let height = document.documentElement.scrollHeight - document.documentElement.clientHeight;


window.addEventListener('scroll',() => {

    let scrollTop = document.documentElement.scrollTop;
    // scroller.style.width = `${(scrollTop / height) * 100} `;
    scroller.style.width = `${document.documentElement.scrollTop* 3.6 + 'px'} `;
    console.log('ahmed');
});

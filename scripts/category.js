const buttonRight = document.getElementById('slideRight');
const buttonLeft = document.getElementById('slideLeft');

buttonRight.onclick = function() {
    document.getElementById('category_container').scrollLeft += 600;
};
buttonLeft.onclick = function() {
    document.getElementById('category_container').scrollLeft -= 600;
};

window.onscroll = function() {
    myFunction()
};
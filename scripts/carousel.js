const myCarouselElement = document.getElementById('shopCarousel')

const carousel = new bootstrap.Carousel(myCarouselElement, {
    interval: 3000,
    pause: "hover",
    ride: "carousel",
    touch: false,
    direction: "right",
});
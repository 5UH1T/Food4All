import Swiper from 'swiper';
import 'swiper/css';
import { Navigation, Pagination, Autoplay } from 'swiper/modules';
import 'swiper/css/navigation';
import 'swiper/css/pagination';

document.addEventListener('DOMContentLoaded', function() {
    // Hero Main Showcase
    const heroSlider = new Swiper('.fp-hero-section', {
        loop: true,
        modules: [Pagination, Autoplay],
        autoplay: {
            delay: 4500,
            disableOnInteraction: false
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true
        },
    });
    // Trending Plates Carousel
    const dishesSlider = new Swiper('.fp-dishes-slider', {
        modules: [Navigation, Pagination, Autoplay],
        slidesPerView: 1,
        spaceBetween: 24,
        navigation: {
            nextEl: '.fp-dishes-next',
            prevEl: '.fp-dishes-prev',
        },
        autoplay: {
            delay: 3000,
            disableOnInteraction: false,
            pauseOnMouseEnter: true,
        },
        loop: true,
        breakpoints: {
            576: {
                slidesPerView: 2
            },
            768: {
                slidesPerView: 3
            },
            1024: {
                slidesPerView: 4
            }
        }
    });
    // Value Plates Carousel
    const valueSlider = new Swiper('.fp-value-slider', {
        slidesPerView: 1,
        spaceBetween: 24,
        modules: [Navigation, Pagination, Autoplay],
        navigation: {
            nextEl: '.fp-value-next',
            prevEl: '.fp-value-prev',
        },
        autoplay: {
            delay: 3000,
            disableOnInteraction: false,
            pauseOnMouseEnter: true,
        },
        loop: true,
        breakpoints: {
            576: {
                slidesPerView: 2
            },
            768: {
                slidesPerView: 3
            },
            1024: {
                slidesPerView: 4
            }
        }
    });
    // Round Showcase Categories Carousel
    const categoriesSlider = new Swiper('.fp-categories-slider', {
        slidesPerView: 2,
        spaceBetween: 20,
        modules: [Navigation, Pagination, Autoplay],
        pagination: {
            el: '.swiper-pagination',
            clickable: true
        },
        autoplay: {
            delay: 3000,
            disableOnInteraction: false,
            pauseOnMouseEnter: true,
        },
        loop: true,
        breakpoints: {
            480: {
                slidesPerView: 3
            },
            768: {
                slidesPerView: 4
            },
            992: {
                slidesPerView: 5
            }
        }
    });
    // Trending Plates Carousel
    const recentSlider = new Swiper('.fp-recent-slider', {
        slidesPerView: 1,
        spaceBetween: 24,
        modules: [Navigation, Pagination, Autoplay],
        navigation: {
            nextEl: '.fp-recent-next',
            prevEl: '.fp-recent-prev',
        },
        autoplay: {
            delay: 3000,
            disableOnInteraction: false,
            pauseOnMouseEnter: true,
        },
        loop: true,
        breakpoints: {
            576: {
                slidesPerView: 2
            },
            768: {
                slidesPerView: 3
            },
            1024: {
                slidesPerView: 4
            }
        }
    });
});
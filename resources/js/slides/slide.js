import { Swiper } from "swiper/bundle";
import 'swiper/css/bundle';

import { commonOptions } from './config.js'

export default function setupSlides() {
    const latestSlider = new Swiper("#latestSlider", {
        ...commonOptions,
        pagination: {
            el: "#latestSliderPagination",
            clickable: true,
        },
        navigation: {
            nextEl: "#latestNext",
            prevEl: "#latestPrev",
        },
    });

    const activeSlider = new Swiper("#activeSlider", {
        ...commonOptions,
        pagination: {
            el: "#activeSliderPagination",
            clickable: true,
        },
        navigation: {
            nextEl: "#activeNext",
            prevEl: "#activePrev",
        },
    });
}
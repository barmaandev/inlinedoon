/**
 * InlineDoon Frontend JavaScript
 */


function initInlineDoon() {

    // Get slider settings from localized script
    const sliderSettings = window.inlinedoon_slider_settings || {};

    // Default settings
    const defaultSettings = {
        slides_per_view_mobile: 1.9,
        slides_per_view_tablet: 2,
        slides_per_view_desktop: 6,
        space_between: 5,
        autoplay_enabled: 1,
        autoplay_delay: 1500,
        loop_enabled: 1,
        rtl_enabled: 1,
    };

    // Merge with saved settings
    const settings = Object.assign({}, defaultSettings, sliderSettings);

    // Build Swiper configuration
    const swiperConfig = {
        slidesPerView: parseFloat(settings.slides_per_view_mobile),
        spaceBetween: parseInt(settings.space_between),
        loop: settings.loop_enabled == 1,
        rtl: settings.rtl_enabled == 1,
        breakpoints: {
            768: {
                slidesPerView: parseInt(settings.slides_per_view_tablet),
            },
            1024: {
                slidesPerView: parseInt(settings.slides_per_view_desktop),
            },
        },
    };

    // Add autoplay if enabled
    if (settings.autoplay_enabled == 1) {
        swiperConfig.autoplay = {
            delay: parseInt(settings.autoplay_delay),
        };
    }


    // Initialize all sliders
    const sliders = document.querySelectorAll('.swiper[data-inlinedoon-slider="true"]');

    // Also check for any .swiper elements
    const allSwipers = document.querySelectorAll('.swiper');

    sliders.forEach(function (slider, index) {
        try {
            const swiperInstance = new Swiper(slider, swiperConfig);
        } catch (error) {
        }
    });
}

// Run immediately if DOM is already ready (footer load), otherwise wait for DOMContentLoaded
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', function () {
        initInlineDoon();
    });
} else {
    initInlineDoon();
}


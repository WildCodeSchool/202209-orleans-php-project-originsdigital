const handles = document.querySelectorAll('.handle');
for (let handle of handles) {
    handle.addEventListener("click", (e) => {
        const slider = handle.parentElement.querySelector('.slider');
        let sliderIndex = parseInt(
            getComputedStyle(slider).getPropertyValue("--slider-index")
        );

        const sliderItems = slider.querySelectorAll('a').length;
        let itemsPerScreen = parseInt(
            getComputedStyle(slider).getPropertyValue("--items-per-screen")
        );

        if (handle.classList.contains("left-handle") && sliderIndex > 0) {
            slider.style.setProperty("--slider-index", sliderIndex - 1);
        }

        if (handle.classList.contains("right-handle") && sliderIndex < sliderItems - itemsPerScreen) {
            slider.style.setProperty("--slider-index", sliderIndex + 1);
        }
    });
}
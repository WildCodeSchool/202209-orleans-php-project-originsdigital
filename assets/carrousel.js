document.addEventListener("click", (e) => {
    let handle;
    if (e.target.matches(".handle")) {
        handle = e.target;
    } else {
        handle = e.target.closest(".handle");
    }
    if (handle != null) {
        onHandleClick(handle);
    }
});

let screenWidth = window.innerWidth
window.addEventListener("resize", (event) => {
    screenWidth = window.innerWidth
});

function onHandleClick(handle) {
    const slider = handle.closest(".bloc-carrousel").querySelector(".slider");
    let sliderIndex = parseInt(
        getComputedStyle(slider).getPropertyValue("--slider-index")
    );
    const sliderItems = handle.parentElement.childNodes.length
    let sliderBuffer = 0

    if (screenWidth > 1000) {
        sliderBuffer = 0;
    } else if (screenWidth > 768) {
        sliderBuffer = 1;
    } else if (screenWidth > 574) {
        sliderBuffer = 2;
    } else {
        sliderBuffer = 3
    }

    if (handle.classList.contains("left-handle")) {
        if (sliderIndex > 0) {
            slider.style.setProperty("--slider-index", sliderIndex - 1);
        }
    }

    if (handle.classList.contains("right-handle")) {
        if (sliderIndex < sliderItems + sliderBuffer - 1) {
            slider.style.setProperty("--slider-index", sliderIndex + 1);
        }
    }
}

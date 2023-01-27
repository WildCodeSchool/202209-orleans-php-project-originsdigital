import Hammer from "hammerjs";

const handles = document.querySelectorAll(".handle");
for (let handle of handles) {
    handle.addEventListener("click", (e) => {
        const slider = handle.parentElement.querySelector(".slider");
        let sliderIndex = parseInt(
            getComputedStyle(slider).getPropertyValue("--slider-index")
        );

        const sliderItems = slider.querySelectorAll("a").length;
        let itemsPerScreen = parseInt(
            getComputedStyle(slider).getPropertyValue("--items-per-screen")
        );

        if (handle.classList.contains("left-handle") && sliderIndex > 0) {
            slider.style.setProperty("--slider-index", sliderIndex - 1);
        }

        if (
            handle.classList.contains("right-handle") &&
            sliderIndex < sliderItems - itemsPerScreen
        ) {
            slider.style.setProperty("--slider-index", sliderIndex + 1);
        }
    });
}

const sliders = document.querySelectorAll(".slider");
for (let slider of sliders) {
    let sliderIndex = parseInt(
        getComputedStyle(slider).getPropertyValue("--slider-index")
    );
    const sliderItems = slider.querySelectorAll("a").length;
    let itemsPerScreen = parseInt(
        getComputedStyle(slider).getPropertyValue("--items-per-screen")
    );

    const hammer = new Hammer(slider);
    hammer.on("swipeleft", () => {
        if (sliderIndex < sliderItems - itemsPerScreen) {
            sliderIndex++;
            slider.style.setProperty("--slider-index", sliderIndex);
        }
    });
    hammer.on("swiperight", () => {
        if (sliderIndex > 0) {
            sliderIndex--;
            slider.style.setProperty("--slider-index", sliderIndex);
        }
    });
}

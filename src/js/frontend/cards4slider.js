export default function setup_sliders() {
  document.querySelectorAll(".cf-4cards-slider").forEach((slider) => {
    const container = document.createElement("div");
    container.classList.add("cf-4cards-slider_container");
    const slideArrow = document.createElement("div");
    slideArrow.classList.add("cf-4cards-slider_arrows");
    const noArrow = slider.classList.contains("cf-4cards-slider-noarrow");

    const slideWrapper = document.createElement("div");
    slideWrapper.classList.add("cf-4cards-slider_wrapper");
    slideWrapper.style.scrollBehavior = "smooth";
    slideWrapper.style.overflowX = "hidden";
    slideWrapper.style.display = "flex";
    slideWrapper.style.flexWrap = "nowrap"; // Keep nowrap for horizontal sliding

    const sliderClasses = [...slider.className.split(" ")];
    sliderClasses
      .filter(
        (cls) =>
          !cls.includes("4cards-slider") && !cls.includes("container-fluid")
      )
      .forEach((cls) => slideWrapper.classList.add(cls));
    sliderClasses
      .filter((cls) => !cls.includes("container-fluid"))
      .forEach((cls) => slider.classList.remove(cls));

    const originalSlides = [...slider.children];
    originalSlides.forEach((slide) => {
      slideWrapper.appendChild(slide);
      //   slide.style.flexShrink = "0";
      //   slide.style.width = "100%";
    });

    // Duplicate slides for infinite loop effect
    const numVisibleSlides = 1; // Assuming one slide is fully visible at a time
    const totalOriginalSlides = originalSlides.length;

    // Append clones of the first few slides to the end
    for (let i = 0; i < numVisibleSlides; i++) {
      const clone = originalSlides[i].cloneNode(true);
      slideWrapper.appendChild(clone);
    }
    // Prepend clones of the last few slides to the beginning
    for (
      let i = totalOriginalSlides - numVisibleSlides;
      i < totalOriginalSlides;
      i++
    ) {
      const clone = originalSlides[i].cloneNode(true);
      slideWrapper.prepend(clone);
    }

    let slides = Array.from(slideWrapper.children);
    let currentIndex = numVisibleSlides; // Start at the first original slide
    let autoSlideInterval;

    let isDragging = false;
    let startX;
    let startScrollLeft;
    let arrows;

    const getSlideWidth = () => slides[0]?.offsetWidth || 0;

    const scrollToSlide = (index, smooth = true) => {
      slideWrapper.style.scrollBehavior = smooth ? "smooth" : "auto";
      slideWrapper.scrollLeft = index * getSlideWidth();
    };

    const update = (direction) => {
      currentIndex += direction;
      if (arrows?.next) {
        arrows.next.classList.add("active");
        // arrows.prev.classList.toggle(
        //   "active",
        //   currentIndex <= numVisibleSlides
        // );
      }
      scrollToSlide(currentIndex);
    };

    const handleScrollEnd = () => {
      if (currentIndex >= totalOriginalSlides + numVisibleSlides) {
        // Jump from cloned end to real start
        currentIndex = numVisibleSlides;
        scrollToSlide(currentIndex, false);
      } else if (currentIndex < numVisibleSlides) {
        // Jump from cloned start to real end
        currentIndex = totalOriginalSlides + numVisibleSlides - 1;
        scrollToSlide(currentIndex, false);
      }
    };

    const startAutoSlide = () => {
      stopAutoSlide();
      autoSlideInterval = setInterval(() => update(1), 5000);
    };

    const stopAutoSlide = () => {
      clearInterval(autoSlideInterval);
    };

    const dragStart = (e) => {
      isDragging = true;
      stopAutoSlide();
      slideWrapper.style.cursor = "grabbing";
      startX = (e.pageX || e.touches[0].pageX) - slideWrapper.offsetLeft;
      startScrollLeft = slideWrapper.scrollLeft;
      e.preventDefault();
    };

    const dragging = (e) => {
      if (!isDragging) return;
      e.preventDefault();
      const x = (e.pageX || e.touches[0].pageX) - slideWrapper.offsetLeft;
      const walk = x - startX;
      slideWrapper.scrollLeft = startScrollLeft - walk;
    };

    const dragEnd = () => {
      isDragging = false;
      slideWrapper.style.cursor = "grab";
      // Determine which slide to snap to after drag
      const currentScrollLeft = slideWrapper.scrollLeft;
      const slideWidth = getSlideWidth();
      currentIndex = Math.round(currentScrollLeft / slideWidth);
      scrollToSlide(currentIndex);
      startAutoSlide();
    };

    if (!noArrow) {
      arrows = {
        prev: document.createElement("div"),
        next: document.createElement("div"),
      };
      arrows.prev.innerHTML = `<svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M17.5 21L10.5 14L17.5 7" stroke="#BFBFBF" stroke-width="2.33333" stroke-linecap="round" stroke-linejoin="round"/></svg>`;
      arrows.next.innerHTML = `<svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M10.5 21L17.5 14L10.5 7" stroke="#BFBFBF" stroke-width="2.33333" stroke-linecap="round" stroke-linejoin="round"/></svg>`;

      arrows.prev.addEventListener("click", () => {
        stopAutoSlide();
        update(-1);
        startAutoSlide();
      });
      arrows.next.addEventListener("click", () => {
        stopAutoSlide();
        update(1);
        startAutoSlide();
      });
      Object.values(arrows).forEach((i) => slideArrow.appendChild(i));
    }

    container.style.position = "relative";

    container.appendChild(slideArrow);
    container.appendChild(slideWrapper);
    slider.appendChild(container);

    slideWrapper.addEventListener("mousedown", dragStart);
    slideWrapper.addEventListener("mousemove", dragging);
    slideWrapper.addEventListener("mouseup", dragEnd);
    slideWrapper.addEventListener("mouseleave", dragEnd);

    slideWrapper.addEventListener("touchstart", dragStart);
    slideWrapper.addEventListener("touchmove", dragging);
    slideWrapper.addEventListener("touchend", dragEnd);

    slideWrapper.addEventListener("scrollend", handleScrollEnd); // Modern event for scroll end
    // Fallback for older browsers if 'scrollend' is not supported
    let scrollTimeout;
    slideWrapper.addEventListener("scroll", () => {
      clearTimeout(scrollTimeout);
      scrollTimeout = setTimeout(handleScrollEnd, 100);
    });

    // Initial positioning
    scrollToSlide(currentIndex, false);
    startAutoSlide();

    container.addEventListener("mouseenter", stopAutoSlide);
    container.addEventListener("mouseleave", startAutoSlide);

    window.addEventListener("resize", () => {
      stopAutoSlide();
      scrollToSlide(currentIndex, false);
      startAutoSlide();
    });
  });
}

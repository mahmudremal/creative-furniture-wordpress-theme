export default function setup_sliders() {
  document.querySelectorAll(".cf-4cards-slider").forEach((slider) => {
    const parent = slider.parentElement;
    const progress = parent?.querySelector(".cf-slider-progress-bar");
    const nav = parent?.querySelectorAll(".cf-slider-nav-btn");

    slider.style.display = "flex";
    slider.style.overflowX = "auto";
    slider.style.scrollBehavior = "smooth";

    if (!document.getElementById("cf-slider-style")) {
      const s = document.createElement("style");
      s.id = "cf-slider-style";
      s.textContent =
        ".cf-4cards-slider::-webkit-scrollbar { display: none; } .cf-4cards-slider { scrollbar-width: none; -ms-overflow-style: none; }";
      document.head.appendChild(s);
    }

    const update = () => {
      const scrollLeft = slider.scrollLeft;
      const maxScroll = slider.scrollWidth - slider.clientWidth;

      if (progress) {
        const p = maxScroll > 0 ? (scrollLeft / maxScroll) * 100 : 0;
        const bar = progress.querySelector("div") || progress;
        if (bar) bar.style.width = `${Math.max(10, p)}%`;
      }

      nav?.forEach((btn) => {
        if (btn.dataset.dir === "prev") {
          btn.style.opacity = scrollLeft <= 10 ? "0" : "1";
          btn.style.pointerEvents = scrollLeft <= 10 ? "none" : "auto";
        } else {
          btn.style.opacity = scrollLeft >= maxScroll - 10 ? "0" : "1";
          btn.style.pointerEvents =
            scrollLeft >= maxScroll - 10 ? "none" : "auto";
        }
      });
    };

    nav?.forEach((b) => {
      b.addEventListener("click", () => {
        const d = b.dataset.dir === "next" ? 1 : -1;
        slider.scrollLeft += d * (slider.clientWidth * 0.8);
      });
    });

    slider.addEventListener("scroll", update);
    window.addEventListener("resize", update);
    setTimeout(update, 100);
  });
}

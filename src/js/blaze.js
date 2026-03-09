class ExtendedBlazeSlider extends BlazeSlider {
  constructor(el, config) {
    super(el, config);
    this._events = {};
  }

  on(name, cb) {
    if (!this._events[name]) this._events[name] = new Set();
    this._events[name].add(cb);
  }

  off(name, cb) {
    this._events[name]?.delete(cb);
  }

  emit(name, ...args) {
    this._events[name]?.forEach((fn) => fn(...args));
  }

  next(n) {
    const prev = this.stateIndex;
    super.next(n);

    if (prev !== this.stateIndex) {
      this.emit("slide", ...this.get_slide_event_params());
    }
  }

  prev(n) {
    const prev = this.stateIndex;
    super.prev(n);

    if (prev !== this.stateIndex) {
      this.emit("slide", ...this.get_slide_event_params());
    }
  }
  get_slide_event_params() {
    const page = this.states[this.stateIndex];
    return [
      this.stateIndex,
      page.next.stateIndex,
      page.prev.stateIndex,
      this.states?.length - 1,
    ];
  }
}

document.querySelectorAll(".blaze-slider").forEach((element) => {
  const sliderOf = element.dataset?.slider;
  const config = element.dataset?.config
    ? JSON.parse(element.dataset?.config ?? "{}")
    : {
        all: {
          // Layout
          // slidesToShow: 1,
          // slidesToScroll: 1,
          // slideGap: 0,
          // Loop
          loop: false,
          // // Autoplay
          // enableAutoplay: false,
          // OnInteraction: true,
          // autoplayInterval: 3000,
          // autoplayDirection: 'to left',
          // // Pagination
          // enablePagination: false,
          // // Transition
          // transitionDuration: 500,
          // transitionTimingFunction: 'ease',
        },
        // '(max-width: 900px)': {
        //   slidesToShow: 2,
        // },
        // '(max-width: 500px)': {
        //   slidesToShow: 1,
        // },
      };
  // console.log(config)
  const slider = (window.slider = new ExtendedBlazeSlider(element, config));
  slider.on("slide", (pageIndex, next, prev, total) => {
    // alert('Page Index: ' + pageIndex + '\nNext: ' + next + '\nPrev: ' + prev + '\nTotal: ' + total);
    if (!slider.config?.loop) {
      const prevEl = slider.el.querySelector(".blaze-prev");
      const nextEl = slider.el.querySelector(".blaze-next");
      if (true) {
        if (pageIndex == 0) prevEl.classList.add("hidden");
        else prevEl.classList.remove("hidden");
      }
      if (true) {
        if (pageIndex == total) nextEl.classList.add("hidden");
        else nextEl.classList.remove("hidden");
      }
    }
    if (sliderOf == "products") {
      const progressBar = slider.el.querySelector(".blaze-progress-bar");
      if (progressBar) {
        progressBar.style.width = ((pageIndex + 1) / (total + 1)) * 100 + "%";
      }
    }
  });
});

class Slider {
    constructor(element, options = {}) {
        this.slider = element;
        if (!this.slider) {
            return;
        }

        this.slides = Array.from(this.slider.querySelectorAll('.slide'));
        this.currentSlideIndex = 0;
        this.options = {
            interval: options.interval === 0 ? 0 : (options.interval || 5000),
            activeClass: options.activeClass || 'active',
            hoverPause: options.hoverPause || false,
            arrow: options.arrow || false,
            dots: options.dots || false,
        };

        this.timer = null;

        if (this.slides.length === 0) {
            return;
        }

        this.init();
    }

    init() {
        this.slides.forEach(slide => {
            slide.classList.remove(this.options.activeClass);
            slide.style.display = 'none';
        });

        this.showSlide(this.currentSlideIndex);

        if (this.options.interval > 0) {
            this.startAutoPlay();
        }

        if (this.options.arrow) {
            this.createNavigation();
        }

        if (this.options.dots) {
            this.createPagination();
        }
        if (this.options.hoverPause) {
            this.slider.classList.add('hover-pause');
            this.slider.addEventListener('mouseenter', () => this.stopAutoPlay());
            this.slider.addEventListener('mouseleave', () => this.startAutoPlay());
        }

    }

    showSlide(index) {
        this.currentSlideIndex = (index % this.slides.length + this.slides.length) % this.slides.length;

        this.slides.forEach((slide, i) => {
            if (i === this.currentSlideIndex) {
                slide.classList.add(this.options.activeClass);
                slide.style.display = 'block';
            } else {
                slide.classList.remove(this.options.activeClass);
                slide.style.display = 'none';
            }
        });

        if (this.dots) {
            this.updatePagination();
        }
    }

    next() {
        this.stopAutoPlay();
        this.showSlide(this.currentSlideIndex + 1);
        this.startAutoPlay();
    }

    prev() {
        this.stopAutoPlay();
        this.showSlide(this.currentSlideIndex - 1);
        this.startAutoPlay();
    }

    startAutoPlay() {
        if (this.options.interval > 0) {
            this.stopAutoPlay();
            this.timer = setInterval(() => {
                this.showSlide(this.currentSlideIndex + 1);
            }, this.options.interval);
        }
    }

    stopAutoPlay() {
        if (this.timer) {
            clearInterval(this.timer);
            this.timer = null;
        }
    }

    createNavigation() {
        if (this.slides.length < 2) return;

        const navContainer = document.createElement('div');
        navContainer.className = 'slider-navigation';

        const prevButton = document.createElement('button');
        prevButton.innerHTML = '&#10094;';
        prevButton.className = 'slider-prev-btn';
        prevButton.addEventListener('click', () => this.prev());

        const nextButton = document.createElement('button');
        nextButton.innerHTML = '&#10095;';
        nextButton.className = 'slider-next-btn';
        nextButton.addEventListener('click', () => this.next());

        navContainer.append(prevButton, nextButton);
        this.slider.appendChild(navContainer);
    }

    createPagination() {
        if (this.slides.length < 2) return;

        this.dots = document.createElement('div');
        this.dots.className = 'slider-pagination';

        this.slides.forEach((_, index) => {
            const dot = document.createElement('span');
            dot.className = 'slider-dot';
            dot.dataset.index = index;
            dot.addEventListener('click', () => {
                this.stopAutoPlay();
                this.showSlide(index);
                this.startAutoPlay();
            });
            this.dots.appendChild(dot);
        });

        this.slider.appendChild(this.dots);
        this.updatePagination();
    }

    updatePagination() {
        Array.from(this.dots.children).forEach((dot, index) => {
            dot.classList.remove(this.options.activeClass);
            if (index === this.currentSlideIndex) {
                dot.classList.add(this.options.activeClass);
            }
        });
    }
}

export default Slider;

// Example Usage:
// const mySlider = new Slider(document.querySelector('.creative-slider'), {
//     arrow: true,
//     dots: true,
//     interval: 4000
// });
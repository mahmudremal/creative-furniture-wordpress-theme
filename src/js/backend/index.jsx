const { default: axios } = require("axios");

class SiteCore {
    constructor() {
        // Changed from siteCoreConfig to csStore
        this.config = window?.csStore ?? {};
        this.ajaxUrl = this.config?.ajax_url ?? '';
        // Changed to mega_menu_nonce
        this.megaMenuNonce = this.config?.mega_menu_nonce ?? '';
        var i18n = this.config?.i18n ?? {};
        this.i18n = { confirming: 'Confirming', ...i18n };
        this.setup_hooks();
    }

    setup_hooks() {
        // tailwind_install();
        this.sc_store_frontend();
        this.product_card_slider();
        this.setup_mega_menu();
    }

    sc_store_frontend() {
        [document.querySelector('.sc_store-front #ecommerce_root')].forEach(container => {
            if (!container) return;
            // const root = createRoot(container);root.render(
            //     <Suspense fallback={<div className="xpo_text-center xpo_p-4">{__('Loading...')}</div>}>
            //         <StoreFront />
            //     </Suspense>
            // );
        });
    }

    product_card_slider() {
        const $ = jQuery;

        function initProductSliders() {
            $('.product-card-style2').each(function () {
                const $card = $(this);
                const $slider = $card.find('.product-image-slider');
                const $track = $slider.find('.slider-track');
                const $slides = $slider.find('.slider-item');
                const totalSlides = $slides.length;

                if (totalSlides <= 1) return;

                let currentIndex = 0;

                const $dotsContainer = $slider.find('.slider-dots');
                for (let i = 0; i < totalSlides; i++) {
                    $dotsContainer.append(`<button class="dot ${i === 0 ? 'active' : ''}" data-index="${i}"></button`);
                }

                function goToSlide(index) {
                    if (index < 0) index = totalSlides - 1;
                    if (index >= totalSlides) index = 0;

                    currentIndex = index;
                    $track.css('transform', `translateX(-${currentIndex * 100}%)`);

                    $dotsContainer.find('.dot').removeClass('active');
                    $dotsContainer.find(`.dot[data-index="${currentIndex}"]`).addClass('active');
                }

                $slider.find('.slider-prev').on('click', function (e) {
                    e.preventDefault();
                    e.stopPropagation();
                    goToSlide(currentIndex - 1);
                });

                $slider.find('.slider-next').on('click', function (e) {
                    e.preventDefault();
                    e.stopPropagation();
                    goToSlide(currentIndex + 1);
                });

                $dotsContainer.on('click', '.dot', function (e) {
                    e.preventDefault();
                    e.stopPropagation();
                    const index = parseInt($(this).data('index'));
                    goToSlide(index);
                });

                let touchStartX = 0;
                let touchEndX = 0;

                $slider[0].addEventListener('touchstart', function (e) {
                    touchStartX = e.changedTouches[0].screenX;
                }, { passive: true });

                $slider[0].addEventListener('touchend', function (e) {
                    touchEndX = e.changedTouches[0].screenX;
                    handleSwipe();
                }, { passive: true });

                function handleSwipe() {
                    if (touchEndX < touchStartX - 50) {
                        goToSlide(currentIndex + 1);
                    }
                    if (touchEndX > touchStartX + 50) {
                        goToSlide(currentIndex - 1);
                    }
                }
            });
        }

        function initColorSwatches() {
            $('.product-color-swatches').each(function () {
                const $swatches = $(this);
                const $card = $swatches.closest('.product-card');
                const $mainImage = $card.find('.product-image-main img, .slider-item:first img');
                const originalImageSrc = $mainImage.attr('src');

                $swatches.find('.color-swatch').on('click', function (e) {
                    e.preventDefault();
                    e.stopPropagation();

                    const $swatch = $(this);
                    const newImageSrc = $swatch.data('image');

                    $swatches.find('.color-swatch').removeClass('active');
                    $swatch.addClass('active');

                    if (newImageSrc && $mainImage.length) {
                        $mainImage.fadeOut(200, function () {
                            $mainImage.attr('src', newImageSrc);
                            $mainImage.fadeIn(200);
                        });
                    }
                });

                $swatches.find('.color-swatch:first').addClass('active');
            });
        }

        function initWishlist() {
            $('.product-wishlist-btn').on('click', function (e) {
                e.preventDefault();
                e.stopPropagation();

                const $btn = $(this);
                const productId = $btn.data('product-id');

                $btn.toggleClass('active');

                const isActive = $btn.hasClass('active');

                $.ajax({
                    url: creativeFurnitureAjax.ajaxurl,
                    type: 'POST',
                    data: {
                        action: 'toggle_wishlist',
                        product_id: productId,
                        add: isActive ? 1 : 0,
                        nonce: creativeFurnitureAjax.nonce
                    },
                    success: function (response) {
                        if (response.success) {
                            if (isActive) {
                                $btn.attr('aria-label', 'Remove from wishlist');
                            } else {
                                $btn.attr('aria-label', 'Add to wishlist');
                            }

                            $(document).trigger('wishlist_updated', [productId, isActive]);
                        }
                    },
                    error: function () {
                        $btn.toggleClass('active');
                    }
                });
            });
        }

        function loadWishlistState() {
            const wishlistItems = JSON.parse(localStorage.getItem('creative_wishlist') || '[]');

            wishlistItems.forEach(function (productId) {
                $(`.product-wishlist-btn[data-product-id="${productId}"]`).addClass('active');
            });
        }

        initWishlist();
        initColorSwatches();
        loadWishlistState();
        initProductSliders();

        $(document).on('yith_infs_added_elem', function () {
            initProductSliders();
            initColorSwatches();
            initWishlist();
            loadWishlistState();
        });

        $(document.body).on('updated_wc_div', function () {
            initProductSliders();
            initColorSwatches();
            initWishlist();
            loadWishlistState();
        });
    }

    setup_mega_menu() {
        const currentHeader = document.querySelector('#locations-header-mega-menu')?.checked;

        if (currentHeader) {
            document.querySelectorAll('fieldset.field-move').forEach(block => {
                const button = document.createElement('button');
                button.type = 'button';
                button.className = 'button';
                button.textContent = 'Mega Menu';
                block.appendChild(button);

                button.addEventListener('click', async (e) => {
                    e.preventDefault();
                    e.stopPropagation();
                    const menu_id = block?.parentElement?.parentElement?.id?.replaceAll?.('menu-item-', '');

                    if (!menu_id) {
                        return alert('Failed to get the menu id');
                    }

                    const modal = document.createElement('div');
                    modal.className = 'mega-menu-modal';
                    modal.dataset.modal = menu_id;

                    const modalInner = document.createElement('div');
                    modalInner.className = 'mega-menu-modal-inner';

                    const loadingIndicator = document.createElement('div');
                    loadingIndicator.className = 'mega-menu-loading';
                    loadingIndicator.textContent = 'Loading...';

                    const textarea = document.createElement('textarea');
                    textarea.className = 'widefat mega-menu-input';
                    textarea.rows = '8';
                    textarea.style.display = 'none';

                    const updateButton = document.createElement('button');
                    updateButton.className = 'button button-primary mega-menu-update';
                    updateButton.dataset.id = menu_id;
                    updateButton.style.display = 'none';
                    updateButton.textContent = 'Update';

                    const closeButton = document.createElement('button');
                    closeButton.className = 'button mega-menu-close';
                    closeButton.textContent = 'Close';

                    modalInner.appendChild(loadingIndicator);
                    modalInner.appendChild(textarea);
                    modalInner.appendChild(updateButton);
                    modalInner.appendChild(closeButton);
                    modal.appendChild(modalInner);

                    document.body.appendChild(modal);

                    closeButton.addEventListener('click', () => {
                        modal.remove();
                    });

                    try {
                        const response = await axios.get(`${this.ajaxUrl}?action=mega_menu_content&menu_item_id=${menu_id}&nonce=${this.megaMenuNonce}`);
                        textarea.value = response?.data?.data?.content || '';
                        loadingIndicator.style.display = 'none';
                        textarea.style.display = 'block';
                        updateButton.style.display = 'inline-block';
                    } catch (error) {
                        console.error('Failed to load mega menu content:', error);
                        loadingIndicator.textContent = 'Failed to load content.';
                    }

                    updateButton.addEventListener('click', async () => {
                        const content = textarea.value;
                        updateButton.disabled = true;
                        updateButton.textContent = 'Updating...';

                        try {
                            await axios.post(this.ajaxUrl, new URLSearchParams({
                                action: 'save_mega_menu_content',
                                menu_item_id: parseInt(menu_id),
                                content: content,
                                nonce: this.megaMenuNonce
                            }));
                            alert('Updated!');
                            modal.remove();
                        } catch (error) {
                            console.error('Failed to save mega menu content:', error);
                            alert('Failed to update');
                        } finally {
                            updateButton.disabled = false;
                            updateButton.textContent = 'Update';
                        }
                    });
                });
            });
        }
    }

}

new SiteCore();
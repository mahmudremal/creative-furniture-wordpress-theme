import axios from 'axios';
import { lazy, Suspense } from 'react';
// import { __, tailwind_install } from '@js/utils';
import { createRoot } from 'react-dom/client';
// import CartSidebar from './CartSidebar';
// import FiltersBar from './FiltersBar';
// import QuickView from './QuickView';
// import OrderView from './OrderView';
import Slider from './slider';

const CartSidebar = lazy(() => import('./CartSidebar'));
const FiltersBar = lazy(() => import('./FiltersBar'));
const QuickView = lazy(() => import('./QuickView'));
const OrderView = lazy(() => import('./OrderView'));

const __ = (t, d) => t;

class SiteCore {
    constructor() {
        this.config = window?.siteCoreConfig ?? {};
        this.ajaxUrl = this.config?.ajaxUrl ?? '';
        this.ajaxNonce = this.config?.ajax_nonce ?? '';
        var i18n = this.config?.i18n ?? {};
        this.i18n = { confirming: 'Confirming', ...i18n };
        this.setup_hooks();
    }

    setup_hooks() {
        // tailwind_install();
        this.init_cart();
        this.init_sliders();
        this.init_checkout();
        this.sc_store_frontend();
        // this.product_card_slider();
        this.init_single_product();
        // this.init_currency_switcher();
        this.single_product_accordion();
        this.init_hotspots();
        this.init_client_sliders();
        this.init_logout();
        this.init_filters();
        this.init_wishlist();
        this.init_header();
        this.init_quickview();
        this.init_myaccount();
        this.init_sell_with_us_form();
        this.init_review_actions();
        this.init_explore_products();

        this.init_tabby();
    }

    sc_store_frontend() {
        const container = document.createElement('div');
        document.body.appendChild(container);
        setTimeout(() => {
            const root = createRoot(container);
            root.render(
                <Suspense fallback={<div>{__('Loading...')}</div>}>
                    <CartSidebar />
                </Suspense>
            );
        }, 1000);
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
                    $dotsContainer.append(`<button class="dot ${i === 0 ? 'active' : ''}" data-index="${i}"></button>`);
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
            const config = this.config;
            document.querySelectorAll('.product-wishlist-btn').forEach(button => {
                button.addEventListener('click', (e) => {
                    e.preventDefault();
                    e.stopPropagation();

                    const $btn = $(this);
                    const productId = $btn.data('product-id');

                    $btn.toggleClass('active');

                    const isActive = $btn.hasClass('active');

                    jQuery.ajax({
                        url: config?.ajaxUrl,
                        type: 'POST',
                        data: {
                            action: 'toggle_wishlist',
                            product_id: productId,
                            add: isActive ? 1 : 0,
                            nonce: config?.ajax_nonce
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
                })
            })
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

    init_single_product() {
        const form = document.querySelector('.cf-cart-form');
        const qtyInput = document.querySelector('.cf-qty-input');
        const minusBtn = document.querySelector('.cf-qty-minus');
        const plusBtn = document.querySelector('.cf-qty-plus');
        const addToCartBtn = document.querySelector('.cf-add-to-cart');
        const variationSwatches = document.querySelectorAll('.cf-variation-swatch');
        const variationSelects = document.querySelectorAll('.cf-variation-select');
        const variationIdInput = document.querySelector('.cf-variation-id');
        const priceElement = document.querySelector('.cf-product-price');

        let selectedAttributes = {};

        minusBtn?.addEventListener('click', () => {
            const currentValue = parseInt(qtyInput.value) || 1;
            if (currentValue > 1) {
                qtyInput.value = currentValue - 1;
            }
        });

        plusBtn?.addEventListener('click', () => {
            const currentValue = parseInt(qtyInput.value) || 1;
            qtyInput.value = currentValue + 1;
        });

        variationSwatches.forEach(swatch => {
            swatch.addEventListener('click', (e) => {
                const button = e.currentTarget;
                const attributeName = button.getAttribute('name');
                const value = button.dataset.value;

                document.querySelectorAll(`[name="${attributeName}"]`).forEach(s => s.classList.remove('active'));
                button.classList.add('active');

                selectedAttributes[`attribute_${attributeName}`] = value;
                updateVariation();
            });
        });

        variationSelects.forEach(select => {
            select.addEventListener('change', (e) => {
                const attributeName = e.target.dataset.attribute_name;
                const value = e.target.value;

                selectedAttributes[attributeName] = value;
                updateVariation();
            });
        });

        function updateVariation() {
            const productId = document.querySelector('input[name="product_id"]')?.value;

            if (!productId) return;

            const allSwatchesSelected = Array.from(variationSwatches).length === 0 ||
                Array.from(document.querySelectorAll('.cf-variation-swatch.active')).length > 0;
            const allSelectsSelected = Array.from(variationSelects).every(select => select.value);

            if (!allSwatchesSelected || !allSelectsSelected) return;

            axios.post(cfStore.ajax_url, new URLSearchParams({
                action: 'cf_get_variation',
                nonce: cfStore.get_variation_nonce,
                product_id: productId,
                attributes: JSON.stringify(selectedAttributes)
            }))
                .then(response => response.data)
                .then(data => {
                    if (data.success) {
                        if (variationIdInput) {
                            variationIdInput.value = data.data.variation_id;
                        }
                        if (priceElement) {
                            priceElement.innerHTML = data.data.price_html;
                        }
                        addToCartBtn.disabled = !data.data.is_in_stock;
                    }
                })
                .catch(error => {
                    console.error('Variation error:', error);
                });
        }

        // return;
        form?.addEventListener('submit', (e) => {
            e.preventDefault();

            const formData = new FormData(form);
            const productId = formData.get('product_id');
            const quantity = formData.get('quantity');
            const variationId = formData.get('variation_id');

            if (variationIdInput && !variationId) {
                alert('Please select all product options');
                return;
            }

            addToCartBtn.disabled = true;
            addToCartBtn.textContent = 'Adding...';

            const postData = new URLSearchParams({
                action: 'cf_add_to_cart',
                nonce: cfStore.add_to_cart_nonce,
                product_id: productId,
                quantity: quantity,
                variation_id: variationId || ''
            });

            Object.entries(selectedAttributes).forEach(([key, value]) => {
                postData.append(`variation[${key}]`, value);
            });

            axios.post(cfStore.ajax_url, postData)
                .then(response => response.data)
                .then(data => {
                    if (data.success) {
                        addToCartBtn.textContent = '✓ Added';

                        const cartCount = document.querySelector('.cart-count');
                        if (cartCount) {
                            cartCount.textContent = data.data.cart_count;
                        }

                        document.querySelector('.header-icon.cart')?.classList?.add?.('shake');
                        setTimeout(() => document.querySelector('.header-icon.cart')?.classList?.remove?.('shake'), 1000);

                        setTimeout(() => {
                            addToCartBtn.textContent = 'Add to Cart';
                            addToCartBtn.disabled = false;
                        }, 2000);
                    } else {
                        throw new Error(data.data.message);
                    }
                })
                .then(() =>
                    [...document.querySelectorAll('[data-cart-toggle]')].find(el => el?.nodeType)?.click?.()
                )
                .catch(error => {
                    console.error('Cart error:', error);
                    alert(error.message || 'Failed to add to cart');
                    addToCartBtn.textContent = 'Add to Cart';
                    addToCartBtn.disabled = false;
                });
        });
    }

    single_product_accordion() {
        document.querySelectorAll('.cf-accordion-header').forEach(btn => {
            btn.addEventListener('click', e => {
                e.preventDefault();
                btn.parentElement.parentElement.querySelectorAll('.cf-accordion-active').forEach(el => el.classList.remove('cf-accordion-active'));
                btn.parentElement.classList.toggle('cf-accordion-active');
            });
        });
    }

    init_checkout() {
        // const wrapper = document.querySelector('.billing-fields-wrapper');
        document.querySelectorAll('[name=billing_address_type]').forEach(checkbox => {
            if (!checkbox) return;
            const wrapper = checkbox.parentElement?.nextElementSibling;
            if (wrapper?.style) {
                if (checkbox.checked && checkbox?.value == 'different') {
                    wrapper.style.display = 'block';
                }
            }
            checkbox.addEventListener('change', e => {
                wrapper.style.display = (e.target.checked && e.target.value == 'different') ? 'block' : 'none';
            });
        });
        // const saveInfo = document.querySelector('[name="save_info"]');
        // saveInfo.addEventListener('click', e => {
        //     e.target.checked = !e.target.checked;
        // });
        document.querySelectorAll('input[name=shipping_first_name], input[name=shipping_last_name]').forEach(input => {
            input.addEventListener('input', e => {
                if (document.querySelector('[name="billing_address_type"]:checked')?.value !== 'different') {
                    switch (e.target.name) {
                        case 'shipping_first_name':
                            document.querySelector('input[name="billing_first_name"]').value = e.target.value;
                            break;
                        case 'shipping_last_name':
                            document.querySelector('input[name="billing_last_name"]').value = e.target.value;
                            break;
                        default:
                            break;
                    }
                }
            });
        });
    }

    init_sliders() {
        this.sliders = [];
        document.querySelectorAll('.creative-slider').forEach(slider => {
            const slides = new Slider(slider, {
                arrow: false,
                dots: true,
                interval: 4000
            });
            this.sliders.push(slides);
        })

    }

    init_currency_switcher() {
        document.querySelectorAll('.currency-switcher select').forEach(select => {
            select.addEventListener('change', e => {
                let url = new URL(window.location.href);
                url.searchParams.set('currency', e.target.value);
                window.location.href = url.toString();
            })
        })
    }

    init_cart() {
        const _update_cart_item = (_item_key, _quantity) => {
            return fetch(window?.cfStore?.ajax_url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
                },
                body: new URLSearchParams({
                    action: 'update_cart_item',
                    cart_item_key: _item_key,
                    quantity: _quantity,
                    nonce: window?.cfStore?.update_cart_nonce
                })
            })
                .then(res => res.json())
                .then(data => {
                    if (data?.success) {
                        location.reload();
                    }
                })
                .catch(err => console.error('Cart update error:', err));
        };
        let updateTimer = null;
        document.querySelectorAll('button.qty-btn').forEach(button => {
            button.addEventListener('click', (e) => {
                e.preventDefault(); e.stopPropagation();
                const input = button.parentElement.querySelector('input.input-text.qty');
                const _item_key = button.parentElement.parentElement.dataset.cartItem;
                if (input) {
                    input.value = button.classList.contains('plus') ? parseInt(input.value) + 1 : Math.max(1, parseInt(input.value) - 1);
                    clearTimeout(updateTimer);
                    updateTimer = setTimeout(() => {
                        _update_cart_item(_item_key, input.value);
                    }, 1000);
                }
            });
        });
        document.querySelectorAll('input.input-text.qty').forEach(input => {
            input.addEventListener('change', (e) => {
                const _item_key = input.parentElement.parentElement.parentElement.dataset.cartItem;
                // console.log('Input value change: ', e.target.value);
                _update_cart_item(_item_key, e.target.value);
            });
        });
    }

    init_quickview() {
        if (!document.querySelectorAll('.product-quick-view-btn')?.length) return;
        const container = document.createElement('div');
        document.body.appendChild(container);
        setTimeout(() => {
            const root = createRoot(container);
            root.render(
                <Suspense fallback={<div>{__('Loading...')}</div>}>
                    <QuickView />
                </Suspense>
            );
        }, 1000);
    }

    init_filters() {
        if (!document.querySelectorAll('.filters-toggle')?.length) return;
        const container = document.createElement('div');
        document.body.appendChild(container);
        setTimeout(() => {
            const root = createRoot(container);
            root.render(
                <Suspense fallback={<div>{__('Loading...')}</div>}>
                    <FiltersBar />
                </Suspense>
            );
        }, 1000);
    }

    init_hotspots() {
        document.querySelectorAll('.image-hotspot-container .hotspot').forEach(hotspot => {
            const title = hotspot.dataset.productTitle;
            const excerpt = hotspot.dataset.productExcerpt;
            const link = hotspot.dataset.productLink;

            const popup = document.createElement('a');
            popup.className = 'hotspot-popup';
            popup.href = link;

            popup.innerHTML = `
                <h4 class="hotspot-popup-title">${title}</h4>
                <p class="hotspot-popup-excerpt">${excerpt.slice(0, 120)}</p>
                <button type="button" class="hotspot-popup-button">View Product</button>
            `;

            hotspot.appendChild(popup);

            // auto-position above; fallback below if not enough space
            hotspot.addEventListener('mouseenter', () => {
                const rect = hotspot.getBoundingClientRect();
                const popupRect = popup.getBoundingClientRect();

                const spaceAbove = rect.top;
                const spaceBelow = window.innerHeight - rect.bottom;

                if (spaceAbove > popupRect.height + 10) {
                    popup.style.bottom = rect.height + 10 + 'px';
                    popup.style.top = 'auto';
                } else {
                    popup.style.top = rect.height + 10 + 'px';
                    popup.style.bottom = 'auto';
                }
            });
        });
    }

    init_client_sliders() {
        const sliders = document.querySelectorAll('.cf-client-logos-slider');

        sliders.forEach(wrap => {
            const items = [...wrap.querySelectorAll('.cf-client-logo-item')];
            if (!items.length) return;

            let speed = window.innerWidth <= 768 ? 0.25 : 0.55;
            let paused = false;
            let dragging = false;
            let lastX = 0;
            let positions = [];
            let totalWidth = 0;

            function setup() {
                let x = 0;
                positions = items.map(el => {
                    const w = el.offsetWidth;
                    const obj = { el, x, w };
                    el.style.transform = `translateX(${x}px)`;
                    x += w;
                    return obj;
                });
                totalWidth = x;
            }

            function moveItems(dx) {
                positions.forEach(p => {
                    p.x += dx;
                    if (p.x + p.w < 0) {
                        const last = positions[positions.length - 1];
                        p.x = last.x + last.w;
                        positions.splice(positions.indexOf(p), 1);
                        positions.push(p);
                    }
                    if (p.x > totalWidth - p.w) {
                        const first = positions[0];
                        p.x = first.x - p.w;
                        positions.splice(positions.indexOf(p), 1);
                        positions.unshift(p);
                    }
                });
            }

            function render() {
                positions.forEach(p => {
                    p.el.style.transform = `translateX(${p.x}px)`;
                });
            }

            function loop() {
                if (!paused && !dragging) moveItems(-speed);
                render();
                requestAnimationFrame(loop);
            }

            wrap.addEventListener('mouseenter', () => paused = true);
            wrap.addEventListener('mouseleave', () => paused = false);

            wrap.addEventListener('mousedown', e => {
                dragging = true;
                lastX = e.clientX;
            });

            window.addEventListener('mousemove', e => {
                if (!dragging) return;
                const dx = e.clientX - lastX;
                lastX = e.clientX;
                moveItems(dx);
                render();
            });

            window.addEventListener('mouseup', () => dragging = false);

            wrap.addEventListener('touchstart', e => {
                const t = e.touches[0];
                dragging = true;
                lastX = t.clientX;
            }, { passive: true });

            wrap.addEventListener('touchmove', e => {
                const t = e.touches[0];
                if (!dragging) return;
                const dx = t.clientX - lastX;
                lastX = t.clientX;
                moveItems(dx);
            }, { passive: true });

            wrap.addEventListener('touchend', () => dragging = false);

            setup();
            requestAnimationFrame(loop);
        });
    }

    init_logout() {
        document.querySelectorAll('.woocommerce-MyAccount-navigation-link--customer-logout a').forEach(button => {
            button.addEventListener('click', (e) => {
                const confirmed = confirm('Are you sure you wanna loggedout?');
                if (!confirmed) {
                    e.preventDefault();
                    e.stopImmediatePropagation();
                }
            }, true);
        });
    }

    init_wishlist() {
        document.querySelectorAll('button.product-wishlist-btn').forEach(button => {
            button.addEventListener('click', (e) => {
                e.preventDefault();
                e.stopPropagation();
                if (!button?.dataset?.productId) return;
                button.disabled = true;
                const formData = new FormData();
                formData.append('action', 'cf_wishlist_toggle');
                formData.append('_nonce', cfStore.add_to_cart_nonce);
                formData.append('product_id', button.dataset.productId);

                return fetch(cfStore.ajax_url, {
                    method: 'POST',
                    credentials: 'same-origin',
                    body: formData
                })
                    .then(r => r.json())
                    .then(res => {
                        if (res.status === 'added') {
                            button.classList.add('active');
                        } else if (res.status === 'removed') {
                            button.classList.remove('active');
                        }
                        document.querySelector('.header-icon.cart')?.classList?.add?.('shake');
                        setTimeout(() => document.querySelector('.header-icon.cart')?.classList?.remove?.('shake'), 1000);
                        return res;
                    })
                    .finally(() => {
                        button.disabled = false;
                    })

            });
        });
        document.querySelectorAll('#cf-wishlist-share-btn').forEach(button => {
            button.addEventListener('click', (e) => {
                const panel = document.querySelector('#cf-wishlist-share-panel');
                panel.classList.toggle('active');
            });
        });
        document.querySelectorAll('#cf-wishlist-copy-link').forEach(button => {
            button.addEventListener('click', async (e) => {
                const panel = document.querySelector('#cf-wishlist-share-panel');
                const input = panel.querySelector('.cf-wishlist-share-link')
                input.select(); input.setSelectionRange(0, 99999);
                try { await navigator.clipboard.writeText(input.value) } catch (e) { }
            });
        });
        document.querySelectorAll('#cf-wishlist-share-panel').forEach(panel => {
            const nativeShare = document.createElement('button');
            nativeShare.innerText = 'Share'
            nativeShare.className = 'cf-wishlist-native-share'
            panel.appendChild(nativeShare)
            nativeShare.addEventListener('click', function () {
                const url = panel.querySelector('.cf-wishlist-share-link').value
                if (navigator.share) navigator.share({ title: 'Wishlist', url: url });
            });
        });

        // fetch(cf_ajax.ajaxurl, {
        //     method: 'POST',
        //     body: new URLSearchParams({ action: 'cf_wishlist_share' })
        // })
        // .then(r=>r.json())
        // .then(d=>{
        //     if (d.status === 'ok') {
        //         document.querySelector('.cf-wishlist-share-link').value = d.url
        //     }
        // })


    }

    init_header() {
        const mobileMenuToggle = document.querySelector('.mobile-menu-toggle');
        const mobileMenuClose = document.querySelector('.mobile-menu-close');
        const mobileMenu = document.querySelector('.mobile-menu');
        const mobileMenuOverlay = document.querySelector('.mobile-menu-overlay');
        const searchToggle = document.querySelector('.search-toggle');
        const mobileSearchBar = document.querySelector('.mobile-search-bar');

        const openMobileMenu = () => {
            mobileMenu?.classList.add('active');
            mobileMenuOverlay?.classList.add('active');
            mobileMenuToggle?.classList.add('active');
            document.body.classList.add('mobile-menu-open');
        };

        const closeMobileMenu = () => {
            mobileMenu?.classList.remove('active');
            mobileMenuOverlay?.classList.remove('active');
            mobileMenuToggle?.classList.remove('active');
            document.body.classList.remove('mobile-menu-open');
        };

        const toggleMobileSearch = () => {
            mobileSearchBar?.classList.toggle('active');
        };

        mobileMenuToggle?.addEventListener('click', () => {
            if (mobileMenu?.classList.contains('active')) {
                closeMobileMenu();
            } else {
                openMobileMenu();
            }
        });

        mobileMenuClose?.addEventListener('click', closeMobileMenu);
        mobileMenuOverlay?.addEventListener('click', closeMobileMenu);
        searchToggle?.addEventListener('click', toggleMobileSearch);

        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && mobileMenu?.classList.contains('active')) {
                closeMobileMenu();
            }
        });

        let startX = 0;
        let currentX = 0;

        mobileMenu?.addEventListener('touchstart', (e) => {
            startX = e.touches[0].clientX;
        });

        mobileMenu?.addEventListener('touchmove', (e) => {
            currentX = e.touches[0].clientX;
            const diff = startX - currentX;

            if (diff > 0) {
                mobileMenu.style.transform = `translateX(-${diff}px)`;
            }
        });

        mobileMenu?.addEventListener('touchend', () => {
            const diff = startX - currentX;

            if (diff > 100) {
                closeMobileMenu();
            }

            mobileMenu.style.transform = '';
            startX = 0;
            currentX = 0;
        });
    }

    init_sell_with_us_form() {
        const phoneInputs = document.querySelectorAll('.sell-with-us [name="phone"], .contact-form-field input[type="tel"]');
        if (!phoneInputs?.length) return;
        // Load CSS
        const css = document.createElement('link');
        css.rel = 'stylesheet';
        css.href = 'https://cdn.jsdelivr.net/npm/intl-tel-input@25.12.5/build/css/intlTelInput.css';
        // css.href = `${cfStore.dist}/library/css/intlTelInput.css`;
        document.head.appendChild(css);

        // Load JS
        const script = document.createElement('script');
        script.src = 'https://cdn.jsdelivr.net/npm/intl-tel-input@25.12.5/build/js/intlTelInput.min.js';
        // script.src = `${cfStore.dist}/library/js/intlTelInput.min.js`;
        script.onload = () => {
            phoneInputs.forEach(input => {
                window.intlTelInput(input, {
                    initialCountry: 'ae',
                    loadUtils: () =>
                        // import('https://cdn.jsdelivr.net/npm/intl-tel-input@25.12.5/build/js/utils.js')
                        import(`${cfStore.dist}/library/js/utils.js`)
                });
            });
        };
        document.body.appendChild(script);
    }

    init_myaccount() {
        if (!document.querySelectorAll('.woocommerce-orders-table__cell-order-actions .woocommerce-button.view')?.length) return;
        const container = document.createElement('div');
        document.body.appendChild(container);
        setTimeout(() => {
            const root = createRoot(container);
            root.render(
                <Suspense fallback={<div>{__('Loading...')}</div>}>
                    <OrderView />
                </Suspense>
            );
        }, 1000);
    }

    init_review_actions() {
        document.querySelectorAll('.review-actions .review-action').forEach(like => {
            like.addEventListener('click', (e) => {
                e.preventDefault();
                e.stopPropagation();
                like.disabled = true;
                setTimeout(() => {
                    like.querySelectorAll('path[fill-rule]').forEach(path => {
                        path.setAttribute('fill-rule', path.getAttribute('fill-rule') == 'evenodd' ? 'nonzero' : 'evenodd');
                    });
                    like.disabled = false;
                }, 1500);
            })
        })
    }

    init_explore_products() {
        const section = document.querySelector('.explore_products');
        if (!section) return;

        const tabs = section.querySelectorAll('.explore_products__tab');
        const grid = section.querySelector('.explore_products__grid');
        const perPage = grid.dataset.productsPerPage || 8;

        const loadProducts = async (category) => {
            grid.classList.add('loading');

            const formData = new FormData();
            formData.append('action', 'load_products');
            formData.append('category', category);
            formData.append('per_page', perPage);
            formData.append('nonce', cfStore.get_variation_nonce);

            try {
                const response = await axios.post(cfStore.ajax_url, formData);

                if (response.data.success) {
                    const list = [...grid.children].find(el => el.tagName === 'UL');
                    if (list) {
                        list.outerHTML = response.data.data.html;
                    } else {
                        grid.innerHTML = response.data.data.html;
                    }
                }
            } catch (error) {
                grid.innerHTML = '<p class="explore_products__error">Failed to load products.</p>';
            } finally {
                grid.classList.remove('loading');
            }
        };

        tabs.forEach(tab => {
            tab.addEventListener('click', (e) => {
                e.preventDefault();

                tabs.forEach(t => t.classList.remove('active'));
                tab.classList.add('active');

                const category = tab.dataset.category;
                loadProducts(category);
            });
        });

        // loadProducts('all');
    }

    init_tabby() {
        document.querySelectorAll('.tabbyCalc').forEach(select => {
            select.addEventListener('change', (e) => {
                var price = parseFloat(select.dataset.price);
                var down = parseFloat(select.dataset.down);
                var months = parseInt(e.target.value);
                var remaining = down > 0 ? price - down : price;
                var installment = remaining / months;
                document.querySelector('.cf-payment-amount span').innerHTML = installment.toFixed(2);
            });
        });
    }

}

new SiteCore();
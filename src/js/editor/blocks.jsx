// import ServerSideRender from '@wordpress/server-side-render';

// import "./slider.scss";

document.addEventListener('DOMContentLoaded', e => {

// (function () {
    const { MediaUpload, MediaUploadCheck, useBlockProps, InspectorControls } = window.wp.blockEditor;
    const { Button, SelectControl, PanelBody, RangeControl, QueryControls } = window.wp.components;
    var { createElement, Fragment, useState } = window.wp.element;
    const { registerBlockType } = window.wp.blocks;
    const { useSelect } = window.wp.data;
    const { __ } = wp.i18n;
    const ServerSideRender = wp?.serverSideRender ?? wp.editor?.ServerSideRender;







    registerBlockType('creative-furniture/slider', {
        title: __('Slider Block', 'creative-furniture'),
        icon: 'images-alt2',
        category: 'layout',
        attributes: {
            slides: {
                type: 'array',
                default: [{
                    bgImage: '',
                    title: __('Save 20% This Weekend Only!', 'creative-furniture'),
                    buttonText: __('Shop Now', 'creative-furniture'),
                    buttonLink: '#'
                }]
            }
        },

        edit: (props) => {
            const { attributes, setAttributes } = props;
            const { slides } = attributes;
            const blockProps = useBlockProps();

            const updateSlide = (index, key, value) => {
                const newSlides = [...slides];
                newSlides[index][key] = value;
                setAttributes({ slides: newSlides });
            };

            const addSlide = () => {
                setAttributes({
                    slides: [
                        ...slides,
                        {
                            bgImage: '',
                            title: __('New Slide', 'creative-furniture'),
                            buttonText: __('Learn More', 'creative-furniture'),
                            buttonLink: '#'
                        }
                    ]
                });
            };

            const removeSlide = (index) => {
                setAttributes({
                    slides: slides.filter((_, i) => i !== index)
                });
            };

            return createElement('div', blockProps, [
                createElement('h3', {}, __('Slider Editor', 'creative-furniture')),
                slides.map((slide, index) =>
                    createElement('div', {
                        key: index,
                        style: { border: '1px solid #ccc', padding: '15px', marginBottom: '15px', borderRadius: '8px' }
                    }, [
                        createElement('label', {}, __('Background Image:', 'creative-furniture')),
                        createElement(MediaUploadCheck, {},
                            createElement(MediaUpload, {
                                onSelect: (media) => updateSlide(index, 'bgImage', media.url),
                                allowedTypes: ['image'],
                                render: ({ open }) =>
                                    createElement(Button, { onClick: open, variant: 'secondary' },
                                        slide.bgImage ? __('Change Image', 'creative-furniture') : __('Select Image', 'creative-furniture')
                                    )
                            })
                        ),
                        slide.bgImage && createElement('img', {
                            src: slide.bgImage,
                            style: { width: '100%', marginTop: '10px', borderRadius: '6px' }
                        }),
                        createElement('label', { style: { marginTop: '10px', display: 'block' } }, __('Title:', 'creative-furniture')),
                        createElement('input', {
                            type: 'text',
                            value: slide.title,
                            onChange: (e) => updateSlide(index, 'title', e.target.value),
                            style: { width: '100%' }
                        }),
                        createElement('label', { style: { marginTop: '10px', display: 'block' } }, __('Button Text:', 'creative-furniture')),
                        createElement('input', {
                            type: 'text',
                            value: slide.buttonText,
                            onChange: (e) => updateSlide(index, 'buttonText', e.target.value),
                            style: { width: '100%' }
                        }),
                        createElement('label', { style: { marginTop: '10px', display: 'block' } }, __('Button Link:', 'creative-furniture')),
                        createElement('input', {
                            type: 'url',
                            value: slide.buttonLink,
                            onChange: (e) => updateSlide(index, 'buttonLink', e.target.value),
                            style: { width: '100%' }
                        }),
                        createElement(Button, {
                            onClick: () => removeSlide(index),
                            variant: 'secondary',
                            style: { marginTop: '10px', background: '#f5f5f5' }
                        }, __('Remove Slide', 'creative-furniture'))
                    ])
                ),
                createElement(Button, {
                    onClick: addSlide,
                    variant: 'primary',
                    style: { marginTop: '10px' }
                }, __('Add Slide', 'creative-furniture')),

                createElement('div', { className: 'slider-preview', style: { marginTop: '20px' } },
                    createElement('div', { className: 'slider-container' },
                        slides.map((slide, i) =>
                            createElement('div', {
                                key: i,
                                className: 'slide',
                                style: {
                                    backgroundImage: `url(${slide.bgImage})`,
                                    display: i === 0 ? 'block' : 'none'
                                }
                            },
                                createElement('div', { className: 'slide-content' },
                                    createElement('h2', {}, slide.title),
                                    createElement('a', { href: slide.buttonLink, className: 'btn' }, slide.buttonText)
                                )
                            )
                        )
                    )
                )
            ]);
        },

        save: (props) => {
            const { slides } = props.attributes;

            return createElement('div', { className: 'creative-slider' },
                slides.map((slide, index) =>
                    createElement('div', {
                        key: index,
                        className: 'slide',
                        'data-bg': slide.bgImage,
                        style: {
                            backgroundImage: `url(${slide.bgImage})`
                        }
                    }, [
                        createElement('div', { className: 'slide-overlay' }),
                        createElement('div', { className: 'slide-content' }, [
                            createElement('h2', {}, slide.title),
                            createElement('a', { href: slide.buttonLink, className: 'btn' }, slide.buttonText)
                        ])
                    ])
                )
            );
        }
    });
    registerBlockType('creative-furniture/image-hotspot', {
        title: __('Image Hotspot Block', 'creative-furniture'),
        icon: 'image-flip-horizontal',
        category: 'layout',
        attributes: {
            bgImage: { type: 'string', default: '' },
            hotspots: {
                type: 'array',
                default: [],
            },
        },

        edit: (props) => {
            const { attributes, setAttributes } = props;
            const { bgImage, hotspots } = attributes;

            const products = useSelect((select) => {
                return select('core').getEntityRecords('postType', 'product', { per_page: -1 });
            }, []);

            const selectImage = (media) => {
                setAttributes({ bgImage: media.url });
            };

            const addHotspot = (event) => {
                const container = event.currentTarget;
                const rect = container.getBoundingClientRect();
                const x = ((event.clientX - rect.left) / rect.width) * 100;
                const y = ((event.clientY - rect.top) / rect.height) * 100;

                setAttributes({
                    hotspots: [...hotspots, { x, y, productId: 0 }],
                });
            };

            const updateHotspot = (index, productId, product) => {
                // console.log(product)
                const newHotspots = [...hotspots];
                newHotspots[index].productId = parseInt(productId);
                newHotspots[index].product = { link: product.link, title: product.title?.raw, excerpt: product.excerpt?.raw };
                setAttributes({ hotspots: newHotspots });
            };

            const removeHotspot = (index) => {
                setAttributes({
                    hotspots: hotspots.filter((_, i) => i !== index),
                });
            };

            return createElement(Fragment, {},
                createElement(InspectorControls, {},
                    createElement(PanelBody, { title: __('Hotspot Settings', 'creative-furniture') },
                        hotspots.map((hotspot, index) =>
                            createElement('div', { key: index, style: { marginBottom: '10px' } },
                                createElement('strong', {}, __('Hotspot', 'creative-furniture') + ' ' + (index + 1)),
                                createElement(SelectControl, {
                                    label: __('Select Product', 'creative-furniture'),
                                    value: hotspot.productId,
                                    options: [
                                        { label: __('Select a product', 'creative-furniture'), value: 0 },
                                        ...(products
                                            ? products.map(p => ({ label: p.title.rendered, value: p.id }))
                                            : []),
                                    ],
                                    onChange: (value) => updateHotspot(index, value, products.find(p => p.id == value)),
                                }),
                                createElement(Button, {
                                    variant: 'link',
                                    onClick: () => removeHotspot(index),
                                    style: { color: 'red' },
                                }, __('Remove Hotspot', 'creative-furniture'))
                            )
                        )
                    )
                ),

                createElement('div', { className: 'image-hotspot-editor' },
                    !bgImage &&
                    createElement(MediaUploadCheck, {},
                        createElement(MediaUpload, {
                            onSelect: selectImage,
                            allowedTypes: ['image'],
                            render: ({ open }) => createElement(Button, { onClick: open, variant: 'secondary' },
                                __('Select Background Image', 'creative-furniture'))
                        })
                    ),

                    bgImage &&
                    createElement('div', {
                        style: {
                            position: 'relative',
                            display: 'inline-block',
                            cursor: 'crosshair',
                        },
                        onClick: addHotspot,
                    },
                        createElement('img', {
                            src: bgImage,
                            style: { width: '100%', height: 'auto', display: 'block' },
                        }),
                        hotspots.map((hotspot, index) =>
                            createElement('div', {
                                key: index,
                                style: {
                                    position: 'absolute',
                                    left: `${hotspot.x}%`,
                                    top: `${hotspot.y}%`,
                                    width: '20px',
                                    height: '20px',
                                    background: 'red',
                                    borderRadius: '50%',
                                    transform: 'translate(-50%, -50%)',
                                    cursor: 'pointer',
                                    border: '2px solid white',
                                },
                                title: `Hotspot ${index + 1}`,
                            })
                        )
                    ),
                    createElement(Button, {
                        onClick: () => setAttributes({ bgImage: '' }),
                        variant: 'secondary',
                        style: { marginTop: '10px' },
                    }, __('Change Background', 'creative-furniture'))
                )
            );
        },

        save: (props) => {
            const { bgImage, hotspots } = props.attributes;

            return createElement('div', { className: 'image-hotspot-container', style: { position: 'relative' } },
                createElement('img', { src: bgImage, style: { width: '100%' } }),
                hotspots.map((hotspot, index) =>
                    createElement('div', {
                        key: index,
                        className: 'hotspot',
                        'data-x': hotspot.x,
                        'data-y': hotspot.y,
                        'data-product-id': hotspot.productId,
                        'data-product-title': hotspot?.product?.title || '',
                        'data-product-link': hotspot?.product?.link || '',
                        'data-product-excerpt': hotspot?.product?.excerpt || '',
                        style: {
                            // position: 'absolute',
                            left: `${hotspot.x}%`,
                            top: `${hotspot.y}%`,
                            // width: '20px',
                            // height: '20px',
                            // // background: 'red',
                            // borderRadius: '50%',
                            // transform: 'translate(-50%, -50%)',
                            // cursor: 'pointer',
                        },
                    })
                )
            );
        },
    });
    registerBlockType('creative-furniture/video-promo-banner', {
        title: __('Video Promo Banner', 'creative-furniture'),
        icon: 'format-video',
        category: 'layout',
        attributes: {
            imageUrl: { type: 'string', default: '' },
            videoUrl: { type: 'string', default: '' },
        },

        edit: function (props) {
            const { attributes, setAttributes } = props;
            const { imageUrl, videoUrl } = attributes;

            const onSelectImage = (media) => { setAttributes({ imageUrl: media.url }); };
            const onSelectVideo = (media) => { setAttributes({ videoUrl: media.url }); };

            return createElement('div', { className: 'cf-video-hover-bg editor-view', style: { minHeight: '300px', padding: '20px', border: '1px dashed #ccc', backgroundImage: imageUrl ? `url(${imageUrl})` : 'none', backgroundSize: 'cover' } },
                createElement('h4', null, __('Video Background Block')),
                
                createElement(MediaUploadCheck, null,
                    createElement(MediaUpload, {
                        onSelect: onSelectImage,
                        allowedTypes: ['image'],
                        value: imageUrl,
                        render: ({ open }) => createElement(Button, { isPrimary: true, onClick: open }, imageUrl ? __('Change Image Thumbnail') : __('Select Image Thumbnail'))
                    })
                ),
                
                createElement(MediaUploadCheck, null,
                    createElement(MediaUpload, {
                        onSelect: onSelectVideo,
                        allowedTypes: ['video'],
                        value: videoUrl,
                        render: ({ open }) => createElement(Button, { isSecondary: true, onClick: open, style: { marginLeft: '10px' } }, videoUrl ? __('Change Video URL') : __('Select Video Background'))
                    })
                ),
                
                imageUrl && createElement('p', null, `Image URL: ${imageUrl}`),
                videoUrl && createElement('p', null, `Video URL: ${videoUrl}`)
            );
        },

        save: function (props) {
            const { attributes } = props;
            const { imageUrl, videoUrl } = attributes;
            
            if (!imageUrl || !videoUrl) return null;

            return createElement('div', { className: 'cf-video-hover-bg' },
                
                createElement('video', { 
                    className: 'bg-video', 
                    autoPlay: true, 
                    loop: true, 
                    muted: true,
                    src: videoUrl,
                    style: { position: 'absolute', top: 0, left: 0, width: '100%', height: '100%', objectFit: 'cover', zIndex: 1, transition: 'opacity 0.5s' }
                }),

                createElement('div', { 
                    className: 'bg-image', 
                    style: { 
                        backgroundImage: `url(${imageUrl})`, 
                        position: 'absolute', 
                        top: 0, 
                        left: 0, 
                        width: '100%', 
                        height: '100%', 
                        backgroundSize: 'cover', 
                        backgroundPosition: 'center', 
                        zIndex: 2, 
                        transition: 'opacity 0.5s' 
                    } 
                }),
                
                createElement('div', { className: 'play-overlay', style: { zIndex: 3 } },
                    createElement('span', { className: 'play-button-placeholder' }, __('WATCH THE VIDEO')) 
                ),

                createElement('div', { className: 'block-content', style: { zIndex: 4 } },
                    createElement('h2', null, __('Stylish Living Area'))
                )
            );

            // document.querySelectorAll('.cf-video-hover-bg').forEach(block => {
            //     const image = block.querySelector('.bg-image');
            //     const video = block.querySelector('.bg-video');
                
            //     block.addEventListener('click', function(e) {
            //         e.preventDefault();
            //         if (video && video.paused) {
            //             image.style.opacity = '0';
            //             block.querySelector('.play-overlay').style.opacity = '0';
            //             video.style.opacity = '1';
            //             video.play().catch(error => { console.error('Video playback failed:', error); });
            //         }
            //     });
            //     if (video) video.style.opacity = '0';
            // });
            
        }
    });
    // registerBlockType('creative-furniture/category-tabs', {
    //     title: __('Category Tabs', 'creative-furniture'),
    //     icon: 'category',
    //     category: 'widgets',
    //     attributes: {
    //         categories: {
    //             type: 'array',
    //             default: ['Home', 'Office', 'Hospitality', 'Outdoor', 'Unique'],
    //         },
    //         selectedCategory: {
    //             type: 'string',
    //             default: 'All Products',
    //         },
    //     },
    //     edit: ({ attributes, setAttributes }) => {
    //         const { categories, selectedCategory } = attributes;

    //         const handleCategoryClick = (category) => {
    //             setAttributes({ selectedCategory: category });
    //         };

    //         return (
    //             <Fragment>
    //                 <InspectorControls>
    //                     <PanelBody title={__('Category Settings', 'creative-furniture')}>
    //                         <SelectControl
    //                             label={__('Default Selected Category', 'creative-furniture')}
    //                             value={selectedCategory}
    //                             options={[
    //                                 { label: __('All Products', 'creative-furniture'), value: 'All Products' },
    //                                 ...categories.map((category) => ({
    //                                     label: category,
    //                                     value: category,
    //                                 })),
    //                             ]}
    //                             onChange={(value) => setAttributes({ selectedCategory: value })}
    //                         />
    //                     </PanelBody>
    //                 </InspectorControls>

    //                 <div className="category-tabs">
    //                     <div className="category-tabs__header">
    //                         <span className="heading-normal">{__('Explore our', 'creative-furniture')}</span>{' '}
    //                         <span className="heading-italic">{__('collections', 'creative-furniture')}</span>
    //                     </div>

    //                     <div className="category-tabs__nav">
    //                         {['All Products', ...categories].map((category, index) => (
    //                             <div
    //                                 key={index}
    //                                 role="button"
    //                                 className={`category-tabs__item ${
    //                                     selectedCategory === category ? 'is-active' : ''
    //                                 }`}
    //                                 onClick={() => handleCategoryClick(category)}
    //                             >
    //                                 {category}
    //                             </div>
    //                         ))}
    //                     </div>

    //                     <div className="category-tabs__button">
    //                         <Button
    //                             className="see-all-btn"
    //                             variant="primary"
    //                             onClick={() =>
    //                                 window.location.href = `/category/${selectedCategory
    //                                     .toLowerCase()
    //                                     .replace(/\s+/g, '-')}`
    //                             }
    //                         >
    //                             {__('See All Product', 'creative-furniture')}
    //                         </Button>
    //                     </div>
    //                 </div>
    //             </Fragment>
    //         );
    //     },

    //     save: () => null,
    // });
    // registerBlockType('creative-furniture/shop-by-categories', {
    //     title: 'Shop by Categories',
    //     icon: 'grid-view',
    //     category: 'widgets',
    //     attributes: {
    //         categories: {
    //             type: 'array',
    //             default: [
    //                 { name: 'Office furniture', link: '#', image: 'https://placehold.co/336x340' },
    //                 { name: 'Home furniture', link: '#', image: 'https://placehold.co/336x340' },
    //                 { name: 'Hospitality furniture', link: '#', image: 'https://placehold.co/336x340' },
    //                 { name: 'Unique furniture', link: '#', image: 'https://placehold.co/336x340' }
    //             ]
    //         },
    //         currentIndex: { type: 'number', default: 0 }
    //     },
    //     edit: ({ attributes, setAttributes }) => {
    //         const { categories, currentIndex } = attributes
    //         const addCategory = () => {
    //             const newCats = [...categories, { name: 'New Category', link: '#', image: 'https://placehold.co/336x340' }]
    //             setAttributes({ categories: newCats })
    //         }
    //         const updateCategory = (index, key, value) => {
    //             const newCats = [...categories]
    //             newCats[index][key] = value
    //             setAttributes({ categories: newCats })
    //         }
    //         const prevSlide = () => {
    //             const newIndex = currentIndex === 0 ? categories.length - 1 : currentIndex - 1
    //             setAttributes({ currentIndex: newIndex })
    //         }
    //         const nextSlide = () => {
    //             const newIndex = currentIndex === categories.length - 1 ? 0 : currentIndex + 1
    //             setAttributes({ currentIndex: newIndex })
    //         }
    //         return (
    //             <div className="shop-by-categories-block">
    //                 <div className="shop-header">
    //                     <div className="shop-title">
    //                         <span>Shop by </span>
    //                         <span className="italic">category</span>
    //                     </div>
    //                     <div className="arrows">
    //                         <button onClick={prevSlide} className="arrow prev"></button>
    //                         <button onClick={nextSlide} className="arrow next"></button>
    //                     </div>
    //                 </div>
    //                 <div className="shop-slider">
    //                     {categories.map((cat, index) => (
    //                         <div
    //                             key={index}
    //                             className={`shop-card ${index === currentIndex ? 'active' : ''}`}
    //                             style={{ transform: `translateX(${(index - currentIndex) * 100}%)` }}
    //                         >
    //                             <img src={cat.image} alt={cat.name} />
    //                             <input
    //                                 type="text"
    //                                 value={cat.name}
    //                                 onChange={(e) => updateCategory(index, 'name', e.target.value)}
    //                                 placeholder="Category name"
    //                             />
    //                             <input
    //                                 type="text"
    //                                 value={cat.link}
    //                                 onChange={(e) => updateCategory(index, 'link', e.target.value)}
    //                                 placeholder="Category link"
    //                             />
    //                             <input
    //                                 type="text"
    //                                 value={cat.image}
    //                                 onChange={(e) => updateCategory(index, 'image', e.target.value)}
    //                                 placeholder="Image URL"
    //                             />
    //                         </div>
    //                     ))}
    //                 </div>
    //                 <button className="add-category" onClick={addCategory}>Add Category</button>
    //             </div>
    //         )
    //     },
    //     save: ({ attributes }) => {
    //         const { categories } = attributes
    //         return (
    //             <div className="shop-by-categories-block">
    //                 <div className="shop-header">
    //                     <div className="shop-title">
    //                         <span>Shop by </span>
    //                         <span className="italic">category</span>
    //                     </div>
    //                     <div className="arrows">
    //                         <button className="arrow prev"></button>
    //                         <button className="arrow next"></button>
    //                     </div>
    //                 </div>
    //                 <div className="shop-slider">
    //                     {categories.map((cat, index) => (
    //                         <a key={index} href={cat.link} className="shop-card">
    //                             <img src={cat.image} alt={cat.name} />
    //                             <div className="shop-card-title">{cat.name}</div>
    //                         </a>
    //                     ))}
    //                 </div>
    //             </div>
    //         )
    //     }
    // });
// 

// 

    registerBlockType('creative-furniture/woo-products', {
        title: __('Woo Products', 'creative-furniture'),
        icon: 'cart',
        category: 'widgets',
        attributes: {
            productsPerPage: { type: 'number', default: 6 },
            productsPerRow: { type: 'number', default: 3 },
            productType: { type: 'string', default: 'featured' },
            categories: { type: 'array', default: [] },
            tags: { type: 'array', default: [] },
            includeProducts: { type: 'array', default: [] }
        },

        edit: ({ attributes, setAttributes }) => {
            const { productsPerPage, productsPerRow, productType, categories, tags, includeProducts } = attributes;

            return createElement(
                Fragment,
                null,
                createElement(
                    InspectorControls,
                    null,
                    createElement(
                        PanelBody,
                        { title: __('Settings', 'creative-furniture') },
                        createElement(RangeControl, {
                            label: __('Products per page', 'creative-furniture'),
                            value: productsPerPage,
                            onChange: (value) => setAttributes({ productsPerPage: value }),
                            min: 1,
                            max: 24
                        }),
                        createElement(RangeControl, {
                            label: __('Products per row', 'creative-furniture'),
                            value: productsPerRow,
                            onChange: (value) => setAttributes({ productsPerRow: value }),
                            min: 1,
                            max: 6
                        }),
                        createElement(SelectControl, {
                            label: __('Product type', 'creative-furniture'),
                            value: productType,
                            options: [
                                { label: 'Featured', value: 'featured' },
                                { label: 'Best Selling', value: 'best_selling' },
                                { label: 'Category Based', value: 'category' },
                                { label: 'Tag Based', value: 'tag' },
                                { label: 'Custom Selection', value: 'custom' }
                            ],
                            onChange: (value) => setAttributes({ productType: value })
                        }),

                        productType === 'category' &&
                            createElement(SelectControl, {
                                label: __('Categories', 'creative-furniture'),
                                multiple: true,
                                value: categories,
                                options: [],
                                onChange: (value) => setAttributes({ categories: value })
                            }),

                        productType === 'tag' &&
                            createElement(SelectControl, {
                                label: __('Tags', 'creative-furniture'),
                                multiple: true,
                                value: tags,
                                options: [],
                                onChange: (value) => setAttributes({ tags: value })
                            }),

                        productType === 'custom' &&
                            createElement(SelectControl, {
                                label: __('Products', 'creative-furniture'),
                                multiple: true,
                                value: includeProducts,
                                options: [],
                                onChange: (value) => setAttributes({ includeProducts: value })
                            })
                    )
                ),

                createElement(ServerSideRender, {
                    block: 'creative-furniture/woo-products',
                    attributes: attributes
                })
            );
        },

        save: function () {
            return null; // Dynamic block - front-end rendered in PHP
        }
    });

    registerBlockType('creative-furniture/client-logos', {
        title: __('Client Logos', 'creative-furniture'),
        icon: 'groups',
        category: 'creative-furniture',

        attributes: {
            items: {
                type: 'array',
                default: [],
            }
        },

        edit: function (props) {
            const { attributes, setAttributes } = props;

            const addItem = function () {
                const newItems = attributes.items.slice();
                newItems.push({
                    image: '',
                    link: ''
                });
                setAttributes({ items: newItems });
            };

            const updateItem = function (index, field, value) {
                const newItems = attributes.items.slice();
                newItems[index][field] = value;
                setAttributes({ items: newItems });
            };

            const removeItem = function (index) {
                const newItems = attributes.items.slice();
                newItems.splice(index, 1);
                setAttributes({ items: newItems });
            };

            return createElement(
                Fragment,
                null,
                createElement(
                    InspectorControls,
                    null,
                    createElement(
                        PanelBody,
                        { title: __('Add Logos', 'creative-furniture'), initialOpen: true },
                        createElement(
                            Button,
                            {
                                isPrimary: true,
                                onClick: addItem
                            },
                            __('Add Logo', 'creative-furniture')
                        )
                    )
                ),

                createElement(
                    'div',
                    props.useBlockProps ? props.useBlockProps() : { className: 'cf-client-logos-editor' },

                    attributes.items.map(function (item, index) {
                        return createElement(
                            'div',
                            { className: 'cf-client-logo-item', key: index },

                            // Image Upload
                            createElement(
                                MediaUploadCheck,
                                null,
                                createElement(MediaUpload, {
                                    onSelect: function (media) {
                                        updateItem(index, 'image', media.url);
                                    },
                                    allowedTypes: ['image'],
                                    value: item.image,
                                    render: function (obj) {
                                        return createElement(
                                            Button,
                                            {
                                                className: 'cf-client-logo-upload',
                                                onClick: obj.open
                                            },
                                            item.image
                                                ? createElement('img', { src: item.image, style: { width: '80px' } })
                                                : __('Upload Logo', 'creative-furniture')
                                        );
                                    }
                                })
                            ),

                            // Link Input
                            createElement('input', {
                                type: 'text',
                                className: 'cf-client-logo-link-input',
                                placeholder: __('Custom link (optional)', 'creative-furniture'),
                                value: item.link,
                                onChange: function (e) {
                                    updateItem(index, 'link', e.target.value);
                                }
                            }),

                            // Remove button
                            createElement(
                                Button,
                                {
                                    isDestructive: true,
                                    onClick: function () { removeItem(index); }
                                },
                                __('Remove', 'creative-furniture')
                            )
                        );
                    })
                )
            );
        },

        save: function (props) {
            const items = props.attributes.items || [];

            return createElement(
                'div',
                { className: 'cf-client-logos-slider' },

                createElement(
                    'div',
                    { className: 'cf-client-logos-track' },

                    items.map(function (item, index) {
                        const img = createElement('img', {
                            src: item.image,
                            className: 'cf-client-logo-img',
                            alt: ''
                        });

                        return createElement(
                            'div',
                            { className: 'cf-client-logo-wrapper', key: index },

                            item.link
                                ? createElement('a', { href: item.link, target: '_blank', rel: 'noopener' }, img)
                                : img
                        );
                    })
                )
            );
        }
    });

registerBlockType('creative-furniture/sell-with-us', {
    title: __('Sell With US', 'creative-furniture'),
    icon: 'feedback',
    category: 'widgets',
    edit() {
        const blockProps = useBlockProps()
        const [fullName, setFullName] = useState('')
        const [email, setEmail] = useState('')
        const [phone, setPhone] = useState('')
        const [category, setCategory] = useState('')
        const [description, setDescription] = useState('')

        return createElement(
            'div',
            blockProps,
            createElement(
                'form',
                { className: 'sell-with-us' },
                createElement(
                    'div',
                    { className: 'form-row' },
                    createElement('input', {
                        type: 'text',
                        placeholder: 'Full Name / Company Name *',
                        value: fullName,
                        onChange: e => setFullName(e.target.value)
                    }),
                    createElement('input', {
                        type: 'email',
                        placeholder: 'Business Email *',
                        value: email,
                        onChange: e => setEmail(e.target.value)
                    })
                ),
                createElement(
                    'div',
                    { className: 'form-row' },
                    createElement('input', {
                        type: 'text',
                        placeholder: 'Phone Number',
                        value: phone,
                        onChange: e => setPhone(e.target.value)
                    }),
                    createElement(
                        'select',
                        {
                            value: category,
                            onChange: e => setCategory(e.target.value)
                        },
                        createElement('option', { value: '' }, 'Select Services'),
                        createElement('option', { value: 'design' }, 'Design'),
                        createElement('option', { value: 'marketing' }, 'Marketing'),
                        createElement('option', { value: 'consulting' }, 'Consulting')
                    )
                ),
                createElement('textarea', {
                    placeholder: 'Briefly describe your business *',
                    value: description,
                    onChange: e => setDescription(e.target.value)
                }),
                createElement(
                    'div',
                    { className: 'agree-row' },
                    createElement('input', {
                        type: 'checkbox'
                    }),
                    createElement(
                        'span',
                        null,
                        'By Submitting, You Agree To Our Terms & Conditions And Privacy Policy.'
                    )
                ),
                createElement(
                    'button',
                    { type: 'submit', className: 'submit-btn' },
                    'Submit'
                )
            )
        )
    },
    save() {
        const blockProps = useBlockProps.save()
        return createElement(
            'div',
            blockProps,
            createElement(
                'form',
                { className: 'business-form' },
                createElement(
                    'div',
                    { className: 'form-row' },
                    createElement('input', {
                        type: 'text',
                        placeholder: 'Full Name / Company Name *'
                    }),
                    createElement('input', {
                        type: 'email',
                        placeholder: 'Business Email *'
                    })
                ),
                createElement(
                    'div',
                    { className: 'form-row' },
                    createElement('input', {
                        type: 'text',
                        placeholder: 'Phone Number'
                    }),
                    createElement(
                        'select',
                        null,
                        createElement('option', { value: '' }, 'Select Services'),
                        createElement('option', { value: 'design' }, 'Design'),
                        createElement('option', { value: 'marketing' }, 'Marketing'),
                        createElement('option', { value: 'consulting' }, 'Consulting')
                    )
                ),
                createElement('textarea', {
                    placeholder: 'Briefly describe your business *'
                }),
                createElement(
                    'div',
                    { className: 'agree-row' },
                    createElement('input', {
                        type: 'checkbox'
                    }),
                    createElement(
                        'span',
                        null,
                        'By Submitting, You Agree To Our Terms & Conditions And Privacy Policy.'
                    )
                ),
                createElement(
                    'button',
                    { type: 'submit', className: 'submit-btn' },
                    'Submit'
                )
            )
        )
    }
});

registerBlockType('creative-furniture/contact-form', {
    title: __('Contact Form', 'creative-furniture'),
    icon: 'email',
    category: 'widgets',
    edit: () => {
        const blockProps = useBlockProps();
        const [firstName, setFirstName] = useState('');
        const [lastName, setLastName] = useState('');
        const [email, setEmail] = useState('');
        const [phone, setPhone] = useState('');
        const [message, setMessage] = useState('');
        const [agree, setAgree] = useState(true);

        return createElement('div', { ...blockProps, className: 'contact-form-block' },
            createElement('div', { className: 'contact-form-row' },
                createElement(TextControl, {
                    label: 'First Name *',
                    value: firstName,
                    onChange: setFirstName
                }),
                createElement(TextControl, {
                    label: 'Last Name *',
                    value: lastName,
                    onChange: setLastName
                })
            ),
            createElement('div', { className: 'contact-form-row' },
                createElement(TextControl, {
                    label: 'Email Address *',
                    value: email,
                    onChange: setEmail
                }),
                createElement(TextControl, {
                    label: 'Phone Number',
                    value: phone,
                    onChange: setPhone
                })
            ),
            createElement(TextControl, {
                label: 'Message *',
                value: message,
                onChange: setMessage,
                multiline: true
            }),
            createElement(CheckboxControl, {
                label: 'By Submitting, You Agree To Our Terms & Conditions And Privacy Policy.',
                checked: agree,
                onChange: setAgree
            }),
            createElement(Button, { isPrimary: true }, 'Submit')
        );
    },
    save: () => {
        return createElement('div', { className: 'contact-form-block' },
            createElement('form', {},
                createElement('div', { className: 'contact-form-row' },
                    createElement('input', { type: 'text', placeholder: 'First Name', required: true }),
                    createElement('input', { type: 'text', placeholder: 'Last Name', required: true })
                ),
                createElement('div', { className: 'contact-form-row' },
                    createElement('input', { type: 'email', placeholder: 'Email Address', required: true }),
                    createElement('input', { type: 'tel', placeholder: 'Phone Number' })
                ),
                createElement('textarea', { placeholder: 'Type your message here', required: true }),
                createElement('label', {},
                    createElement('input', { type: 'checkbox', required: true }),
                    ' By Submitting, You Agree To Our Terms & Conditions And Privacy Policy.'
                ),
                createElement('button', { type: 'submit' }, 'Submit')
            )
        );
    }
});



})
// ();
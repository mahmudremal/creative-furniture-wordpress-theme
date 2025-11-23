import { useEffect, useRef, useState } from "react";
import { sprintf } from "sprintf-js";





export default function OrderView() {
    const [order, setOrder] = useState(null);
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState(null);
    const [isOpen, setIsOpen] = useState(null);
    const tracking = useRef(null);

    useEffect(() => {
        const viewButtons = document.querySelectorAll('.woocommerce-orders-table__cell-order-actions .woocommerce-button.view');

        const handle_view_button_click = (e) => {
            e.preventDefault();
            e.stopPropagation();
            e.target.disabled = true;
            const idRegex = /view-order\/(\d+)/;
            let match = e.target.href.match(idRegex);
            if (match && match?.[1]?.length) {
                const order_id = parseInt(match?.[1]);
                setLoading(true);setError(null);
                const encodedData = new URLSearchParams({
                    order_id: order_id,
                    action: 'cf_get_order_details',
                    nonce: window?.cfStore?.add_to_cart_nonce
                });
                fetch(`${window?.cfStore?.ajax_url}?${encodedData}`, {
                    method: 'POST',
                    headers: {'Content-Type': 'application/json'},
                    body: JSON.stringify({})
                })
                .then(res => res.json())
                .then(({ success = false, data = {} }) => {
                    if (!success) {
                        throw new Error(data);
                    }
                    // console.log(data)
                    if (!data?.order) throw new Error('Failed to fetch order information');
                    setOrder(data?.order);
                    if (!isOpen) setIsOpen('details');
                })
                .catch(err => 
                    setError('Failed to fetch order information')
                )
                .finally(() => {
                    setLoading(false);
                    e.target.disabled = true;
                });
            } else {
                setError('Order information not found')
            }
        }
        
        viewButtons.forEach(button => {
            button.addEventListener('click', handle_view_button_click);
        });
    
      return () => viewButtons.forEach(button => button.removeEventListener('click', handle_view_button_click));
    }, []);

    useEffect(() => {
        document.body.style.overflow = isOpen ? 'hidden' : 'auto';
    }, [isOpen]);

    if (!isOpen || !order?.id) return null;

    const OrderDetails = () => {
        return (
            <>
                <div className="cart-sidebar__header">
                    <h2 className="cart-sidebar__title">{sprintf('Order #%s', order.number)}</h2>
                    <button className="cart-sidebar__close" onClick={() => setIsOpen(false)}>
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 4L4 12M4 4L12 12" stroke="#484848" strokeWidth="1.33333" strokeLinecap="round" strokeLinejoin="round"/>
                        </svg>
                    </button>
                </div>

                <div className="cart-sidebar__items">
                    {order.items.map((item, index) => (
                        <div key={index} className="cart-item">
                            <a href={item.url} className="cart-item__image" style={{background: `url("${item.image}") center center / cover no-repeat`}}>
                                {/* <img src={item.image} alt={item.name} /> */}
                            </a>
                            <div className="cart-item__details" style={{flexDirection: 'row', alignItems: 'center'}}>
                                <div className="cart-item__info">
                                    <a href={item.url} className="cart-item__title">{item.name}</a>
                                    <div className="cart-item__price" dangerouslySetInnerHTML={{__html: item.price}}></div>
                                </div>

                                <div className="cart-item__meta">
                                    {Object.keys(item?.variation || []).map((vKey, vIndex) => (
                                        <div key={vIndex} className="cart-item__meta-item">
                                            <span className="label">{sprintf('%s:', vKey.replace('attribute_pa_', ''))}</span> <span className="value">{item.variation[vKey]}</span>
                                        </div>
                                    ))}
                                </div>

                                <div className="cart-item__actions">
                                    {/* <div className="cart-item__quantity">
                                        <button 
                                            className="quantity-btn"
                                            onClick={() => updateQuantity(item.key, item.quantity + 1)}
                                        >
                                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M15 10.625H5C4.65833 10.625 4.375 10.3417 4.375 10C4.375 9.65833 4.65833 9.375 5 9.375H15C15.3417 9.375 15.625 9.65833 15.625 10C15.625 10.3417 15.3417 10.625 15 10.625Z" fill="#292D32"/>
                                                <path d="M10 15.625C9.65833 15.625 9.375 15.3417 9.375 15V5C9.375 4.65833 9.65833 4.375 10 4.375C10.3417 4.375 10.625 4.65833 10.625 5V15C10.625 15.3417 10.3417 15.625 10 15.625Z" fill="#292D32"/>
                                            </svg>
                                        </button>
                                        <span className="quantity-value">{item.quantity}</span>
                                        <button 
                                            className="quantity-btn"
                                            onClick={() => updateQuantity(item.key, Math.max(1, item.quantity - 1))}
                                        >
                                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M15 10.625H5C4.65833 10.625 4.375 10.3417 4.375 10C4.375 9.65833 4.65833 9.375 5 9.375H15C15.3417 9.375 15.625 9.65833 15.625 10C15.625 10.3417 15.3417 10.625 15 10.625Z" fill="#292D32"/>
                                            </svg>
                                        </button>
                                    </div>
                                    <button 
                                        className="cart-item__remove"
                                        onClick={() => removeItem(item.key)}
                                    >
                                        <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M10.4998 3.36523C10.4898 3.36523 10.4748 3.36523 10.4598 3.36523C7.81484 3.10023 5.17484 3.00023 2.55984 3.26523L1.53984 3.36523C1.32984 3.38523 1.14484 3.23523 1.12484 3.02523C1.10484 2.81523 1.25484 2.63523 1.45984 2.61523L2.47984 2.51523C5.13984 2.24523 7.83484 2.35023 10.5348 2.61523C10.7398 2.63523 10.8898 2.82023 10.8698 3.02523C10.8548 3.22023 10.6898 3.36523 10.4998 3.36523Z" fill="black" fillOpacity="0.6"/>
                                            <path d="M4.24988 2.86C4.22988 2.86 4.20988 2.86 4.18488 2.855C3.98488 2.82 3.84488 2.625 3.87988 2.425L3.98988 1.77C4.06988 1.29 4.17988 0.625 5.34488 0.625H6.65488C7.82488 0.625 7.93488 1.315 8.00988 1.775L8.11988 2.425C8.15488 2.63 8.01488 2.825 7.81488 2.855C7.60988 2.89 7.41488 2.75 7.38488 2.55L7.27488 1.9C7.20488 1.465 7.18988 1.38 6.65988 1.38H5.34988C4.81988 1.38 4.80988 1.45 4.73488 1.895L4.61988 2.545C4.58988 2.73 4.42988 2.86 4.24988 2.86Z" fill="black" fillOpacity="0.6"/>
                                            <path d="M7.60519 11.3758H4.39519C2.65019 11.3758 2.58019 10.4108 2.52519 9.63077L2.20019 4.59577C2.18519 4.39077 2.34519 4.21077 2.55019 4.19577C2.76019 4.18577 2.93519 4.34077 2.95019 4.54577L3.27519 9.58077C3.33019 10.3408 3.35019 10.6258 4.39519 10.6258H7.60519C8.65519 10.6258 8.67519 10.3408 8.72519 9.58077L9.05019 4.54577C9.06519 4.34077 9.24519 4.18577 9.45019 4.19577C9.65519 4.21077 9.81519 4.38577 9.80019 4.59577L9.47519 9.63077C9.42019 10.4108 9.35019 11.3758 7.60519 11.3758Z" fill="black" fillOpacity="0.6"/>
                                            <path d="M6.83004 8.625H5.16504C4.96004 8.625 4.79004 8.455 4.79004 8.25C4.79004 8.045 4.96004 7.875 5.16504 7.875H6.83004C7.03504 7.875 7.20504 8.045 7.20504 8.25C7.20504 8.455 7.03504 8.625 6.83004 8.625Z" fill="black" fillOpacity="0.6"/>
                                            <path d="M7.25 6.625H4.75C4.545 6.625 4.375 6.455 4.375 6.25C4.375 6.045 4.545 5.875 4.75 5.875H7.25C7.455 5.875 7.625 6.045 7.625 6.25C7.625 6.455 7.455 6.625 7.25 6.625Z" fill="black" fillOpacity="0.6"/>
                                        </svg>
                                        Remove
                                    </button> */}
                                </div>
                            </div>
                        </div>
                    ))}
                </div>

                <div style={{height: 0, width: 0, opacity: 0, visibility: 'hidden'}}>
                    <form ref={tracking} action={order.tracking} method="POST" target="_blank">
                        <input type="hidden" name="order_id" value={order?.id} />
                        <input type="hidden" name="billing_email" value={order?.email} />
                    </form>
                </div>

                <div className="cart-sidebar__footer">
                    <div className="cart-sidebar__subtotal">
                        <span>Shipping</span>
                        <span dangerouslySetInnerHTML={{__html: order?.totals?.shipping || 0.00}}></span>
                    </div>
                    <div className="cart-sidebar__subtotal">
                        <span>Total</span>
                        <span dangerouslySetInnerHTML={{__html: order?.totals?.total || 0.00}}></span>
                    </div>
                    <div className="cart-sidebar__buttons">
                        <button type="button" onClick={(e) => tracking?.current && tracking.current.submit()} className="cart-sidebar__btn cart-sidebar__btn--primary">
                            Order Tracking
                        </button>
                        {!order?.review_done && (
                            <button type="button" onClick={(e) => setIsOpen('review')} className="cart-sidebar__btn cart-sidebar__btn--outline">
                                Write Review
                            </button>
                        )}
                    </div>
                </div>
            </>
        )
    }

    const OrderReview = () => {
        const form = useRef(null);
        const [formData, setFormData] = useState({
            rating: 0,
            title: '',
            message: ''
        });
        
        const handle_review_submission = (e) => {
            console.log(formData)
            fetch(window?.cfStore?.ajax_url, {
                method: 'POST',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                body: new URLSearchParams({
                    ...formData,
                    order_id: order.id,
                    action: 'customer_order_review'
                })
            })
            .then(res => res.json())
            .then(({ success = false, data = {} }) => {
                if (!success) {
                    throw new Error(data);
                }
                // console.log(data)
                if (!data) throw new Error('Failed to fetch order information');
                return data;
            })
            .then(() => setIsOpen('review-success'))
            .catch(err => 
                setError('Failed to send review')
            )
            .finally(() => {
                setLoading(false);
                // e.target.disabled = true;
            });
        }

        const submit_review_form = (e) => {
            e.preventDefault();
            e.stopPropagation();
            handle_review_submission(e);
        }
        
        return (
            <>
                <div className="cart-sidebar__header">
                    <h2 className="cart-sidebar__title">Rate Product</h2>
                    <button className="cart-sidebar__close" onClick={() => setIsOpen(false)}>
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 4L4 12M4 4L12 12" stroke="#484848" strokeWidth="1.33333" strokeLinecap="round" strokeLinejoin="round"/>
                        </svg>
                    </button>
                </div>

                <div className="cart-sidebar__items">
                    <form className="form" ref={form} onSubmit={submit_review_form}>
                        <div className="form-row">
                            <div className="form-block">
                                <label>Rating <span className="form-block-staric">*</span></label>
                                <div className="form-block-starts">
                                    {[...Array(5).keys()].map(i => (
                                        <label key={i} className={`${formData.rating >= (i + 1) ? 'selected' : ''}`}>
                                            <input type="radio" name="rating" onChange={e => setFormData(prev => ({...prev, rating: i + 1}))} className="form-block-starts-input" defaultChecked={formData.rating == i + 1} required />
                                            <svg width="34" height="33" viewBox="0 0 34 33" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M14.8694 1.38144C15.4681 -0.461181 18.0749 -0.461176 18.6736 1.38144L21.2618 9.347C21.5295 10.1711 22.2974 10.729 23.1639 10.729H31.5394C33.4768 10.729 34.2824 13.2082 32.7149 14.347L25.939 19.27C25.238 19.7793 24.9447 20.682 25.2125 21.5061L27.8006 29.4716C28.3994 31.3142 26.2904 32.8465 24.723 31.7077L17.9471 26.7847C17.2461 26.2754 16.2969 26.2754 15.5959 26.7847L8.82 31.7077C7.25257 32.8465 5.14362 31.3142 5.74232 29.4716L8.33049 21.5061C8.59824 20.682 8.30492 19.7793 7.60395 19.27L0.828032 14.347C-0.739395 13.2082 0.0661607 10.729 2.00361 10.729H10.3791C11.2455 10.729 12.0135 10.171 12.2812 9.347L14.8694 1.38144Z" />
                                            </svg>
                                        </label>
                                    ))}
                                </div>
                            </div>
                        </div>
                        <div className="form-row">
                            <div className="form-block">
                                <label>Title <span className="form-block-muted">(Optional)</span></label>
                                <input type="text" placeholder="" defaultValue={formData.title} onChange={e => setFormData(prev => ({...prev, title: e.target.value}))} />
                            </div>
                        </div>
                        <div className="form-row">
                            <div className="form-block">
                                <label>Review <span className="form-block-staric">*</span></label>
                                <textarea rows={10} defaultValue={formData.message} onChange={e => setFormData(prev => ({...prev, message: e.target.value}))} required></textarea>
                            </div>
                        </div>
                    </form>
                </div>

                <div className="cart-sidebar__footer">
                    <div className="cart-sidebar__buttons">
                        <button type="button" onClick={submit_review_form} className="cart-sidebar__btn cart-sidebar__btn--primary">
                            Submit
                        </button>
                    </div>
                </div>
            </>
        )
    }

    const ReviewSuccess = () => {
        return (
            <>
                <div className="cart-sidebar__header">
                    <h2 className="cart-sidebar__title">Review submitted</h2>
                    <button className="cart-sidebar__close" onClick={() => setIsOpen(false)}>
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 4L4 12M4 4L12 12" stroke="#484848" strokeWidth="1.33333" strokeLinecap="round" strokeLinejoin="round"/>
                        </svg>
                    </button>
                </div>

                <div className="cart-sidebar__items">
                    <div className="review-success">
                        <div className="review-success__icon">
                            <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M26.6663 8L11.9997 22.6667L5.33301 16" stroke="white" stroke-width="2.66667" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>

                        <h3 className="review-success__title">THANK YOU FOR YOUR REVIEW!</h3>

                        <p className="review-success__text">
                            Your opinion helps us improve and inspires others to find
                            the perfect furniture for their home.
                        </p>
                    </div>
                </div>

                <div className="cart-sidebar__footer">
                    <div className="cart-sidebar__buttons">
                        <a href="/" className="cart-sidebar__btn cart-sidebar__btn--primary">
                            Get 10% off your next order!
                        </a>
                    </div>
                </div>
            </>
        )
    }
    
    return (
        <div className="cart-sidebar-overlay" onClick={() => setIsOpen(false)}>
            <div className="cart-sidebar" onClick={(e) => e.stopPropagation()}>
                {isOpen == 'details' && (<OrderDetails />)}
                {isOpen == 'review' && (<OrderReview />)}
                {isOpen == 'review-success' && (<ReviewSuccess />)}
            </div>
        </div>
    );
}
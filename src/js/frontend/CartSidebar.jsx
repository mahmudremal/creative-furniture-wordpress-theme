import { useState, useEffect } from 'react';
import { sprintf } from 'sprintf-js';
// import './CartSidebar.scss';

export default function CartSidebar() {
  const [isOpen, setIsOpen] = useState(false);
  const [cartItems, setCartItems] = useState([]);
  const [subtotal, setSubtotal] = useState(0);
  const [checkoutUrl, setCheckoutUrl] = useState('#');
  const [cartUrl, setCartUrl] = useState('#');

  useEffect(() => {
    const doms = document.querySelectorAll('[data-cart-toggle]');
    
    const handleClick = (e) => {
      e.preventDefault();
      e.stopPropagation();
      setIsOpen(true);
      fetchCart();
    };

    doms.forEach(el => el.addEventListener('click', handleClick));

    return () => {
      doms.forEach(el => el.removeEventListener('click', handleClick));
    };
  }, []);

  const fetchCart = () => {
    const formData = new FormData();
    formData.append('action', 'get_cart_items');

    fetch('/wp-admin/admin-ajax.php', {
      method: 'POST',
      body: formData
    })
      .then(res => res.json())
      .then(({ data }) => {
        setCartUrl(data?.cart);
        setCheckoutUrl(data?.checkout);
        setCartItems(data?.items ?? []);
        setSubtotal(data?.subtotal ?? 0);
      })
      .catch(err => console.error(err));
  };

  const updateQuantity = (itemKey, quantity) => {
    const formData = new FormData();
    formData.append('action', 'update_cart_item');
    formData.append('cart_item_key', itemKey);
    formData.append('quantity', quantity);

    fetch('/wp-admin/admin-ajax.php', {
      method: 'POST',
      body: formData
    })
      .then(res => res.json())
      .then(() => fetchCart())
      .catch(err => console.error(err));
  };

  const removeItem = (itemKey) => {
    const formData = new FormData();
    formData.append('action', 'remove_cart_item');
    formData.append('cart_item_key', itemKey);

    fetch('/wp-admin/admin-ajax.php', {
      method: 'POST',
      body: formData
    })
      .then(res => res.json())
      .then(() => fetchCart())
      .catch(err => console.error(err));
  };

  if (!isOpen) return null;

  return (
    <div className="cart-sidebar-overlay" onClick={() => setIsOpen(false)}>
      <div className="cart-sidebar" onClick={(e) => e.stopPropagation()}>
        <div className="cart-sidebar__header">
          <h2 className="cart-sidebar__title">{sprintf('Your cart (%s)', cartItems.length)}</h2>
          <button className="cart-sidebar__close" onClick={() => setIsOpen(false)}>
            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M12 4L4 12M4 4L12 12" stroke="#484848" strokeWidth="1.33333" strokeLinecap="round" strokeLinejoin="round"/>
            </svg>
          </button>
        </div>

        <div className="cart-sidebar__items">
          {cartItems.map((item, index) => (
            <div key={index} className="cart-item">
              <a href={item.url} className="cart-item__image" style={{    background: `url("${item.image}") center center / cover no-repeat`}}>
                {/* <img src={item.image} alt={item.name} /> */}
              </a>
              <div className="cart-item__details">
                <div className="cart-item__info">
                  <a href={item.url} className="cart-item__title">{item.name}</a>
                  <div className="cart-item__price" dangerouslySetInnerHTML={{__html: item.price}}></div>
                </div>

                <div className="cart-item__meta">
                  {Object.keys(item.variation).map((vKey, vIndex) => (
                    <div key={vIndex} className="cart-item__meta-item">
                      <span className="label">{sprintf('%s:', vKey.replace('attribute_pa_', ''))}</span> <span className="value">{item.variation[vKey]}</span>
                    </div>
                  ))}
                </div>

                <div className="cart-item__actions">
                  <div className="cart-item__quantity">
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
                  </button>
                </div>
              </div>
            </div>
          ))}
        </div>

        <div className="cart-sidebar__footer">
          <div className="cart-sidebar__subtotal">
            <span>Subtotal</span>
            <span dangerouslySetInnerHTML={{__html: subtotal}}></span>
          </div>
          <div className="cart-sidebar__buttons">
            <a href={checkoutUrl} className="cart-sidebar__btn cart-sidebar__btn--primary">
              Checkout Securely
            </a>
            <a href={cartUrl} className="cart-sidebar__btn cart-sidebar__btn--outline">
              View cart
            </a>
          </div>
        </div>
      </div>
    </div>
  );
}
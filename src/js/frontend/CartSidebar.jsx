import { useState, useEffect } from 'react';
// import './CartSidebar.scss';

export default function CartSidebar() {
  const [isOpen, setIsOpen] = useState(false);
  const [cartItems, setCartItems] = useState([]);
  const [subtotal, setSubtotal] = useState(0);

  useEffect(() => {
    const doms = document.querySelectorAll('[data-cart-toggle]');
    
    const handleClick = () => {
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
      .then(data => {
        setCartItems(data.items || []);
        setSubtotal(data.subtotal || 0);
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
          <h2 className="cart-sidebar__title">Your cart ({cartItems.length})</h2>
          <button className="cart-sidebar__close" onClick={() => setIsOpen(false)}>
            <svg>close icon</svg>
          </button>
        </div>

        <div className="cart-sidebar__items">
          {cartItems.map((item, index) => (
            <div key={index} className="cart-item">
              <div className="cart-item__image"></div>
              <div className="cart-item__details">
                <div className="cart-item__info">
                  <h3 className="cart-item__title">{item.name}</h3>
                  <div className="cart-item__price">{item.price}</div>
                </div>

                <div className="cart-item__meta">
                  <div className="cart-item__meta-item">
                    <span className="label">Size:</span> <span className="value">{item.size}</span>
                  </div>
                  <div className="cart-item__meta-item">
                    <span className="label">Material:</span> <span className="value">{item.material}</span>
                  </div>
                </div>

                <div className="cart-item__actions">
                  <div className="cart-item__quantity">
                    <button 
                      className="quantity-btn"
                      onClick={() => updateQuantity(item.key, item.quantity + 1)}
                    >
                      <svg>plus icon</svg>
                    </button>
                    <span className="quantity-value">{item.quantity}</span>
                    <button 
                      className="quantity-btn"
                      onClick={() => updateQuantity(item.key, Math.max(1, item.quantity - 1))}
                    >
                      <svg>minus icon</svg>
                    </button>
                  </div>
                  <button 
                    className="cart-item__remove"
                    onClick={() => removeItem(item.key)}
                  >
                    <svg>trash icon</svg>
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
            <span>AED{subtotal.toFixed(2)}</span>
          </div>
          <div className="cart-sidebar__buttons">
            <button className="cart-sidebar__btn cart-sidebar__btn--primary">
              Checkout Securely
            </button>
            <button className="cart-sidebar__btn cart-sidebar__btn--outline">
              View cart
            </button>
          </div>
        </div>
      </div>
    </div>
  );
}
import { useState, useEffect } from 'react';
// import './QuickView.scss';

export default function QuickView() {
  const [productId, setProductId] = useState(null);
  const [product, setProduct] = useState(null);
  const [isOpen, setIsOpen] = useState(false);
  const [selectedSize, setSelectedSize] = useState('');
  const [selectedMaterial, setSelectedMaterial] = useState(4);

  useEffect(() => {
    const doms = document.querySelectorAll('[data-quickview]');
    
    const handleClick = (e) => {
      const id = e.currentTarget.getAttribute('data-product-id');
      setProductId(id);
      setIsOpen(true);
    };

    doms.forEach(el => el.addEventListener('click', handleClick));

    return () => {
      doms.forEach(el => el.removeEventListener('click', handleClick));
    };
  }, []);

  useEffect(() => {
    if (!productId) return;

    const formData = new FormData();
    formData.append('action', 'get_product_quickview');
    formData.append('product_id', productId);

    fetch('/wp-admin/admin-ajax.php', {
      method: 'POST',
      body: formData
    })
      .then(res => res.json())
      .then(data => setProduct(data))
      .catch(err => console.error(err));
  }, [productId]);

  const handleAddToCart = () => {
    const formData = new FormData();
    formData.append('action', 'add_to_cart');
    formData.append('product_id', productId);
    formData.append('size', selectedSize);
    formData.append('material', selectedMaterial);

    fetch('/wp-admin/admin-ajax.php', {
      method: 'POST',
      body: formData
    })
      .then(res => res.json())
      .then(data => {
        console.log('Added to cart', data);
      })
      .catch(err => console.error(err));
  };

  if (!isOpen || !product) return null;

  const materials = [
    { id: 0, color: '#2F2D2D' },
    { id: 1, color: '#483C35' },
    { id: 2, color: '#3DADD5' },
    { id: 3, color: '#E7F7AE' },
    { id: 4, color: '#AD907E', bordered: true },
    { id: 5, color: '#F8F3E7' }
  ];

  return (
    <div className="quickview-overlay" onClick={() => setIsOpen(false)}>
      <div className="quickview" onClick={(e) => e.stopPropagation()}>
        <div className="quickview__header">
          <h1 className="quickview__title">
            {product.title || 'Wooden Finish Veneer with Metal Frame'}
          </h1>
          <button className="quickview__close" onClick={() => setIsOpen(false)}>
            <svg>close icon</svg>
          </button>
        </div>

        <div className="quickview__price">
          {product.price || 'AED3,575.00'}
        </div>

        <div className="quickview__images">
          <div className="quickview__image"></div>
          <div className="quickview__image"></div>
        </div>

        <div className="quickview__description">
          {product.description || 'Introducing the Santoor Design Series Online Sofa Sets in Dubai by Creative Furniture, the epitome of comfort and style. This sofa set is a popular choice from our catalog.. '}
          <span className="quickview__read-more">Read more</span>
        </div>

        <div className="quickview__option">
          <label className="quickview__label">Size</label>
          <div className="quickview__select" onClick={() => {}}>
            <span>{selectedSize || 'Choose an option'}</span>
            <svg>chevron down icon</svg>
          </div>
        </div>

        <div className="quickview__option">
          <label className="quickview__label">Material</label>
          <div className="quickview__materials">
            {materials.map(material => (
              <div
                key={material.id}
                className={`quickview__material ${selectedMaterial === material.id ? 'active' : ''} ${material.bordered ? 'bordered' : ''}`}
                style={{ backgroundColor: material.color }}
                onClick={() => setSelectedMaterial(material.id)}
              />
            ))}
          </div>
        </div>

        <div className="quickview__actions">
          <button className="quickview__btn quickview__btn--outline">
            Full Details
          </button>
          <button className="quickview__btn quickview__btn--primary" onClick={handleAddToCart}>
            <svg>cart icon</svg>
            Add to Cart
          </button>
        </div>
      </div>
    </div>
  );
}
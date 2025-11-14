import { useState, useEffect } from 'react';
import { X } from 'lucide-react';

export default function ProductQuickView() {
  const [isOpen, setIsOpen] = useState(false);
  const [productId, setProductId] = useState(null);
  const [product, setProduct] = useState(null);
  const [selectedSize, setSelectedSize] = useState('');
  const [selectedMaterial, setSelectedMaterial] = useState('');
  const [quantity, setQuantity] = useState(1);

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
      .then(data => {
        setProduct(data);
        setSelectedSize('');
        setSelectedMaterial('');
        setQuantity(1);
      })
      .catch(err => console.error(err));
  }, [productId]);

  const handleAddToCart = () => {
    const formData = new FormData();
    formData.append('action', 'add_to_cart_quickview');
    formData.append('product_id', productId);
    formData.append('quantity', quantity);
    
    if (selectedSize) formData.append('size', selectedSize);
    if (selectedMaterial) formData.append('material', selectedMaterial);

    fetch('/wp-admin/admin-ajax.php', {
      method: 'POST',
      body: formData
    })
      .then(res => res.json())
      .then(data => {
        if (data.success) {
          setIsOpen(false);
        }
      })
      .catch(err => console.error(err));
  };

  if (!isOpen || !product) return null;

  return (
    <div onClick={() => setIsOpen(false)} className={`quickview-overlay ${isOpen ? 'active' : ''}`}>
      <div className={`quickview-container ${isOpen ? 'active' : ''}`} onClick={e => e.stopPropagation()}>
        <div className="quickview-content">

          <div>
            <div className="quickview-header">
              <h2 className="quickview-title">
                {product.title}
              </h2>
              <button type="button" onClick={() => setIsOpen(false)} className="quickview-close">
                <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M8.6665 0.666016L0.666504 8.66602M0.666504 0.666016L8.6665 8.66602" stroke="#484848" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
              </button>
            </div>
            <div className="quickview-price" dangerouslySetInnerHTML={{__html: product.price}}></div>
          </div>

          <div className="quickview-images">
            {product.images?.slice(0, 2).map((img, idx) => (
              <div key={idx} className="quickview-images-item">
                {img ? <img src={img} alt="" /> : null}
              </div>
            ))}
          </div>

          <div className="quickview-description" dangerouslySetInnerHTML={{__html: `${product.description}${product.description?.length > 150 ? `<a href="${product.permalink}">Read more</a>` : null}`}}>
          </div>

          {product.variations?.size && (
            <div className="quickview-field">
              <label>Size</label>
              <select
                value={selectedSize}
                onChange={(e) => setSelectedSize(e.target.value)}
                className="quickview-select"
              >
                <option value="">Choose an option</option>
                {product.variations.size.map((size, idx) => (
                  <option key={idx} value={size}>{size}</option>
                ))}
              </select>
            </div>
          )}

          {product.variations?.material && (
            <div className="quickview-field">
              <label>Material</label>
              <div className="quickview-materials">
                {product.variations.material.map((mat, idx) => (
                  <button
                    key={idx}
                    onClick={() => setSelectedMaterial(mat.name)}
                    className={`quickview-material ${selectedMaterial === mat.name ? 'selected' : ''}`}
                    style={{ backgroundColor: mat.color }}
                  />
                ))}
              </div>
            </div>
          )}

          <div className="quickview-actions">
            <a href={product.permalink} className="quickview-btn quickview-btn--outline">
              Full Details
            </a>
            <button
              type="button"
              onClick={handleAddToCart}
              className="quickview-btn quickview-btn--primary"
            >
              <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M6.25 6.39192V5.58358C6.25 3.70858 7.75833 1.86692 9.63333 1.69192C11.8667 1.47525 13.75 3.23358 13.75 5.42525V6.57525" stroke="white" stroke-width="1.66667" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M7.49986 18.3327H12.4999C15.8499 18.3327 16.4499 16.991 16.6249 15.3577L17.2499 10.3577C17.4749 8.32435 16.8915 6.66602 13.3332 6.66602H6.66652C3.10819 6.66602 2.52486 8.32435 2.74986 10.3577L3.37486 15.3577C3.54986 16.991 4.14986 18.3327 7.49986 18.3327Z" stroke="white" stroke-width="1.66667" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M12.9131 10.0007H12.9206" stroke="white" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M7.07859 10.0007H7.08608" stroke="white" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
              Add to Cart
            </button>
          </div>
        </div>
      </div>
    </div>
  );
}
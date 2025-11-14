import { useState, useEffect } from 'react';
// import './filters-sidebar.scss';

export default function FiltersSidebar() {
  const [isOpen, setIsOpen] = useState(false);
  const [loading, setLoading] = useState(true);
  const [filters, setFilters] = useState({
    categories: [],
    colors: [],
    finishes: [],
    tags: [],
    priceRange: { min: 0, max: 0 }
  });
  const [selected, setSelected] = useState({
    categories: [],
    colors: [],
    finishes: [],
    tags: [],
    priceMin: 0,
    priceMax: 0
  });
  const [expandedSections, setExpandedSections] = useState({
    category: false,
    color: true,
    finish: false,
    tags: false,
    price: true
  });

  useEffect(() => {
    const handleFilterClick = () => setIsOpen(true);
    const buttons = document.querySelectorAll('.toolbar-filters button, .filters-toggle');
    buttons.forEach(btn => btn.addEventListener('click', handleFilterClick));
    
    return () => {
      buttons.forEach(btn => btn.removeEventListener('click', handleFilterClick));
    };
  }, []);

  useEffect(() => {
    if (isOpen && loading) {
      fetchFilters();
    }
  }, [isOpen]);

  const fetchFilters = async () => {
    try {
      const response = await fetch(window.ajaxurl || '/wp-admin/admin-ajax.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: new URLSearchParams({
          action: 'get_product_filters',
          nonce: window.filtersNonce || ''
        })
      });
      
      const data = await response.json();
      
      if (data.success) {
        setFilters(data.data);
        setSelected(prev => ({
          ...prev,
          priceMin: data.data.priceRange.min,
          priceMax: data.data.priceRange.max
        }));
      }
    } catch (error) {
      console.error('Filter fetch error:', error);
    } finally {
      setLoading(false);
    }
  };

  const toggleSection = (section) => {
    setExpandedSections(prev => ({ ...prev, [section]: !prev[section] }));
  };

  const handleCheckbox = (type, value) => {
    setSelected(prev => {
      const current = prev[type];
      const updated = current.includes(value)
        ? current.filter(v => v !== value)
        : [...current, value];
      return { ...prev, [type]: updated };
    });
  };

  const handlePriceChange = (e, type) => {
    const value = parseFloat(e.target.value) || 0;
    setSelected(prev => ({ ...prev, [type]: value }));
  };

  const applyFilters = () => {
    const params = new URLSearchParams(window.location.search);
    
    if (selected.categories.length) params.set('category', selected.categories.join(','));
    else params.delete('category');
    
    if (selected.colors.length) params.set('color', selected.colors.join(','));
    else params.delete('color');
    
    if (selected.finishes.length) params.set('finish', selected.finishes.join(','));
    else params.delete('finish');
    
    if (selected.tags.length) params.set('tag', selected.tags.join(','));
    else params.delete('tag');
    
    if (selected.priceMin > filters.priceRange.min) params.set('min_price', selected.priceMin);
    else params.delete('min_price');
    
    if (selected.priceMax < filters.priceRange.max) params.set('max_price', selected.priceMax);
    else params.delete('max_price');
    
    window.location.href = `${window.location.pathname}?${params.toString()}`;
  };

  const clearFilters = () => {
    setSelected({
      categories: [],
      colors: [],
      finishes: [],
      tags: [],
      priceMin: filters.priceRange.min,
      priceMax: filters.priceRange.max
    });
  };

  if (!isOpen) return null;

  return (
    <div className={`filters-overlay ${isOpen ? 'active' : ''}`} onClick={() => setIsOpen(false)}>
      <div className={`filters-sidebar ${isOpen ? 'active' : ''}`} onClick={e => e.stopPropagation()}>
        
        <div className="filters-header">
          <div className="filters-header-content">
            <h2 className="filters-title">Filter by</h2>
            <button onClick={() => setIsOpen(false)} className="filters-close">
              <svg>close</svg>
            </button>
          </div>
          <p className="filters-subtitle">Filter your results with the options below.</p>
        </div>

        <div className="filters-content">
          {loading ? (
            <div className="filters-loading">Loading filters...</div>
          ) : (
            <>
              <div className="filters-section">
                <button 
                  className="filters-section-header"
                  onClick={() => toggleSection('category')}
                >
                  <span>Category</span>
                  <svg className={expandedSections.category ? 'expanded' : ''}>chevron</svg>
                </button>
                {expandedSections.category && (
                  <div className="filters-section-content">
                    {filters.categories.map((cat) => (
                      <label key={cat.id} className="filters-checkbox-item">
                        <input
                          type="checkbox"
                          checked={selected.categories.includes(cat.slug)}
                          onChange={() => handleCheckbox('categories', cat.slug)}
                        />
                        <span>{cat.name}</span>
                        <span className="count">({cat.count})</span>
                      </label>
                    ))}
                  </div>
                )}
              </div>

              <div className="filters-section">
                <button 
                  className="filters-section-header"
                  onClick={() => toggleSection('color')}
                >
                  <span>Color</span>
                  <svg className={expandedSections.color ? 'expanded' : ''}>chevron</svg>
                </button>
                {expandedSections.color && (
                  <div className="filters-section-content">
                    {filters.colors.map((color) => (
                      <label key={color.slug} className="filters-image-item">
                        <input
                          type="checkbox"
                          checked={selected.colors.includes(color.slug)}
                          onChange={() => handleCheckbox('colors', color.slug)}
                        />
                        {color.image ? (
                          <img src={color.image} alt={color.name} className="variation-thumb" />
                        ) : (
                          <span 
                            className="color-swatch" 
                            style={{ backgroundColor: color.hex }}
                          />
                        )}
                        <span>{color.name}</span>
                      </label>
                    ))}
                  </div>
                )}
              </div>

              <div className="filters-section">
                <button 
                  className="filters-section-header"
                  onClick={() => toggleSection('finish')}
                >
                  <span>Finish</span>
                  <svg className={expandedSections.finish ? 'expanded' : ''}>chevron</svg>
                </button>
                {expandedSections.finish && (
                  <div className="filters-section-content">
                    {filters.finishes.map((finish) => (
                      <label key={finish.slug} className="filters-checkbox-item">
                        <input
                          type="checkbox"
                          checked={selected.finishes.includes(finish.slug)}
                          onChange={() => handleCheckbox('finishes', finish.slug)}
                        />
                        <span>{finish.name}</span>
                      </label>
                    ))}
                  </div>
                )}
              </div>

              <div className="filters-section">
                <button 
                  className="filters-section-header"
                  onClick={() => toggleSection('tags')}
                >
                  <span>Tags</span>
                  <svg className={expandedSections.tags ? 'expanded' : ''}>chevron</svg>
                </button>
                {expandedSections.tags && (
                  <div className="filters-section-content">
                    {filters.tags.map((tag) => (
                      <label key={tag.id} className="filters-checkbox-item">
                        <input
                          type="checkbox"
                          checked={selected.tags.includes(tag.slug)}
                          onChange={() => handleCheckbox('tags', tag.slug)}
                        />
                        <span>{tag.name}</span>
                      </label>
                    ))}
                  </div>
                )}
              </div>

              <div className="filters-section">
                <button 
                  className="filters-section-header"
                  onClick={() => toggleSection('price')}
                >
                  <span>Price</span>
                  <svg className={expandedSections.price ? 'expanded' : ''}>chevron</svg>
                </button>
                {expandedSections.price && (
                  <div className="filters-section-content">
                    <div className="filters-price-range">
                      <input
                        type="range"
                        min={filters.priceRange.min}
                        max={filters.priceRange.max}
                        value={selected.priceMin}
                        onChange={(e) => handlePriceChange(e, 'priceMin')}
                        className="range-min"
                      />
                      <input
                        type="range"
                        min={filters.priceRange.min}
                        max={filters.priceRange.max}
                        value={selected.priceMax}
                        onChange={(e) => handlePriceChange(e, 'priceMax')}
                        className="range-max"
                      />
                    </div>
                    <div className="filters-price-inputs">
                      <div className="price-input">
                        <span>AED</span>
                        <input
                          type="number"
                          value={selected.priceMin}
                          onChange={(e) => handlePriceChange(e, 'priceMin')}
                        />
                      </div>
                      <span className="price-separator">To</span>
                      <div className="price-input">
                        <span>AED</span>
                        <input
                          type="number"
                          value={selected.priceMax}
                          onChange={(e) => handlePriceChange(e, 'priceMax')}
                        />
                      </div>
                    </div>
                  </div>
                )}
              </div>
            </>
          )}
        </div>

        <div className="filters-footer">
          <button onClick={clearFilters} className="filters-btn filters-btn-outline">
            Clear All
          </button>
          <button onClick={applyFilters} className="filters-btn filters-btn-primary">
            Apply
          </button>
        </div>

      </div>
    </div>
  );
}
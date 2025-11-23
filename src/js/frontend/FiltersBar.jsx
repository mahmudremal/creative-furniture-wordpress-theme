import { useState, useEffect } from 'react';

export default function FiltersSidebar() {
  const [isOpen, setIsOpen] = useState(false);
  const [filters, setFilters] = useState(null);
  const [selected, setSelected] = useState({
    categories: [],
    tags: [],
    attributes: {},
    priceMin: 0,
    priceMax: 0,
    orderby: 'menu_order'
  });
  const [expandedSections, setExpandedSections] = useState({
    categories: true,
    tags: false,
    price: false
  });

  useEffect(() => {
    const handleFilterClick = (e) => {
      e.preventDefault();
      e.stopPropagation();
      try {
        const configJson = [...document.querySelectorAll('.filters-toggle')].find(el => el?.dataset?.filters)?.dataset?.filters;
        if (!configJson) return;
        const _filters = JSON.parse(configJson);
        setFilters(_filters);
        console.log(_filters)
        
        const initialSelected = {
          categories: _filters.current?.categories || [],
          tags: _filters.current?.tags || [],
          attributes: _filters.current?.attributes || {},
          priceMin: _filters.current?.price?.min || _filters.price?.min || 0,
          priceMax: _filters.current?.price?.max || _filters.price?.max || 0,
          orderby: _filters.current?.orderby || 'menu_order'
        };
        setSelected(initialSelected);
        setIsOpen(true);
      } catch (err) {
        console.error(err);
      }
    };
    
    const buttons = document.querySelectorAll('.toolbar-filters button, .filters-toggle');
    buttons.forEach(btn => btn.addEventListener('click', handleFilterClick));
    
    return () => {
      buttons.forEach(btn => btn.removeEventListener('click', handleFilterClick));
    };
  }, []);

  useEffect(() => {
    document.body.style.overflow = isOpen ? 'hidden' : 'auto';
  }, [isOpen]);

  const toggleSection = (section) => {
    setExpandedSections(prev => ({ ...prev, [section]: !prev[section] }));
  };

  const handleCheckbox = (type, value) => {
    setSelected(prev => {
      const current = prev[type] || [];
      const updated = current.includes(value)
        ? current.filter(v => v !== value)
        : [...current, value];
      return { ...prev, [type]: updated };
    });
  };

  const handleAttributeCheckbox = (attrName, value) => {
    setSelected(prev => {
      const current = prev.attributes[attrName] || [];
      const updated = current.includes(value)
        ? current.filter(v => v !== value)
        : [...current, value];
      return { 
        ...prev, 
        attributes: { ...prev.attributes, [attrName]: updated }
      };
    });
  };

  const handlePriceChange = (e, type) => {
    const value = parseFloat(e.target.value) || 0;
    setSelected(prev => ({ ...prev, [type]: value }));
  };

  const applyFilters = () => {
    const params = new URLSearchParams();
    
    if (selected.categories.length) {
      params.set('product_cat', selected.categories.join(','));
    }
    
    if (selected.tags.length) {
      params.set('product_tag', selected.tags.join(','));
    }
    
    Object.entries(selected.attributes).forEach(([attrName, values]) => {
      if (values.length) {
        const taxonomy = 'pa_' + attrName.toLowerCase().replace(/\s+/g, '_');
        params.set(taxonomy, values.join(','));
      }
    });
    
    if (selected.priceMin > filters.price.min) {
      params.set('min_price', selected.priceMin);
    }
    
    if (selected.priceMax < filters.price.max) {
      params.set('max_price', selected.priceMax);
    }
    
    if (selected.orderby !== 'menu_order') {
      params.set('orderby', selected.orderby);
    }
    
    window.location.href = `${window.location.pathname}?${params.toString()}`;
  };

  const clearFilters = () => {
    if (!filters) return;
    setSelected({
      categories: [],
      tags: [],
      attributes: {},
      priceMin: filters.price.min,
      priceMax: filters.price.max,
      orderby: 'menu_order'
    });
  };

  if (!isOpen || !filters) return null;

  return (
    <div className={`filters-overlay ${isOpen ? 'active' : ''}`} onClick={() => setIsOpen(false)}>
      <div className={`filters-sidebar ${isOpen ? 'active' : ''}`} onClick={e => e.stopPropagation()}>
        
        <div className="filters-header">
          <div className="filters-header-content">
            <h2 className="filters-title">Filter by</h2>
            <button onClick={() => setIsOpen(false)} className="filters-close">
              <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 4L4 12M4 4L12 12" stroke="#484848" strokeWidth="1.33333" strokeLinecap="round" strokeLinejoin="round"/>
              </svg>
            </button>
          </div>
          <p className="filters-subtitle">Filter your results with the options below.</p>
        </div>

        <div className="filters-content">
          {filters.categories && filters.categories.length > 0 && (
            <div className="filters-section">
              <button 
                className="filters-section-header"
                onClick={() => toggleSection('categories')}
              >
                <span>Category</span>
                <svg className={expandedSections.categories ? 'expanded' : ''} width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M5 7.5L10 12.5L15 7.5" stroke="#B9B9B9" strokeWidth="1.66667" strokeLinecap="round" strokeLinejoin="round"/>
                </svg>
              </button>
              {expandedSections.categories && (
                <div className="filters-section-content">
                  {filters.categories.map((cat) => (
                    <label key={cat.slug} className="filters-checkbox-item">
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
          )}

          {filters.tags && filters.tags.length > 0 && (
            <div className="filters-section">
              <button 
                className="filters-section-header"
                onClick={() => toggleSection('tags')}
              >
                <span>Tags</span>
                <svg className={expandedSections.tags ? 'expanded' : ''} width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M5 7.5L10 12.5L15 7.5" stroke="#B9B9B9" strokeWidth="1.66667" strokeLinecap="round" strokeLinejoin="round"/>
                </svg>
              </button>
              {expandedSections.tags && (
                <div className="filters-section-content">
                  {filters.tags.map((tag) => (
                    <label key={tag.slug} className="filters-checkbox-item">
                      <input
                        type="checkbox"
                        checked={selected.tags.includes(tag.slug)}
                        onChange={() => handleCheckbox('tags', tag.slug)}
                      />
                      <span>{tag.name}</span>
                      <span className="count">({tag.count})</span>
                    </label>
                  ))}
                </div>
              )}
            </div>
          )}

          {filters.attributes && Object.entries(filters.attributes).map(([attrName, terms]) => {
            if (!terms || terms.length === 0) return null;
            const sectionKey = `attr_${attrName}`;
            return (
              <div key={attrName} className="filters-section">
                <button 
                  className="filters-section-header"
                  onClick={() => toggleSection(sectionKey)}
                >
                  <span>{attrName}</span>
                  <svg className={expandedSections[sectionKey] ? 'expanded' : ''} width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M5 7.5L10 12.5L15 7.5" stroke="#B9B9B9" strokeWidth="1.66667" strokeLinecap="round" strokeLinejoin="round"/>
                  </svg>
                </button>
                {expandedSections[sectionKey] && (
                  <div className="filters-section-content">
                    {terms.map((term) => (
                      <label key={term.slug} className="filters-checkbox-item">
                        <input
                          type="checkbox"
                          checked={(selected.attributes[attrName] || []).includes(term.slug)}
                          onChange={() => handleAttributeCheckbox(attrName, term.slug)}
                        />
                        <span>{term.name}</span>
                        <span className="count">({term.count})</span>
                      </label>
                    ))}
                  </div>
                )}
              </div>
            );
          })}

          {filters.price && (
            <div className="filters-section">
              <button 
                className="filters-section-header"
                onClick={() => toggleSection('price')}
              >
                <span>Price</span>
                <svg className={expandedSections.price ? 'expanded' : ''} width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M5 7.5L10 12.5L15 7.5" stroke="#B9B9B9" strokeWidth="1.66667" strokeLinecap="round" strokeLinejoin="round"/>
                </svg>
              </button>
              {expandedSections.price && (
                <div className="filters-section-content">
                  <div className="filters-price-range">
                    <input
                      type="range"
                      min={filters.price.min}
                      max={filters.price.max}
                      value={selected.priceMin}
                      onChange={(e) => handlePriceChange(e, 'priceMin')}
                      className="range-min"
                    />
                    <input
                      type="range"
                      min={filters.price.min}
                      max={filters.price.max}
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
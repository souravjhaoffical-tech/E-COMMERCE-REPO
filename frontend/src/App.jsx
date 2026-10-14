
import { useEffect, useMemo, useState } from 'react'
import './App.css'

function App() {
  const [products, setProducts] = useState([])
  const [loading, setLoading] = useState(true)
  const [error, setError] = useState('')
  const [search, setSearch] = useState('')
  const [selectedBrand, setSelectedBrand] = useState('All')
  const [selectedCategory, setSelectedCategory] = useState('All')

  useEffect(() => {
    fetch('/E-COMMERCE-SITE/E-COMMERCE-REPO/api_products.php')
      .then((response) => {
        if (!response.ok) {
          throw new Error('Could not load products')
        }
        return response.json()
      })
      .then((data) => {
        setProducts(data.products || [])
      })
      .catch(() => {
        setError('Products load nahi ho paaye. Please refresh the page.')
      })
      .finally(() => {
        setLoading(false)
      })
  }, [])

  const brands = useMemo(() => {
    return [
      'All',
      ...new Set(
        products
          .map((product) => product.brand)
          .filter(Boolean)
      ),
    ]
  }, [products])
  const categories = useMemo(() => {
  return [
    'All',
    ...new Set(
      products
        .map((product) => product.category)
        .filter(Boolean)
    ),
  ]
}, [products])


  const filteredProducts = useMemo(() => {
    const searchText = search.trim().toLowerCase()

    return products.filter((product) => {
      const matchesSearch =
        (product.name || '').toLowerCase().includes(searchText) ||
        (product.brand || '').toLowerCase().includes(searchText)

      const matchesBrand =
        selectedBrand === 'All' ||
        product.brand === selectedBrand

      const matchesCategory =
        selectedCategory === 'All' ||
        product.category === selectedCategory

      return matchesSearch && matchesBrand && matchesCategory
    })
  }, [products, search, selectedBrand, selectedCategory])

  if (loading) {
    return <p className="react-message">Loading products...</p>
  }

  if (error) {
    return <p className="react-message">{error}</p>
  }

  return (
    <div className="react-shop">
      <div className="product-toolbar">
        <input
          type="search"
          className="product-search"
          placeholder="🔍 Search products or brands..."
          value={search}
          onChange={(event) => setSearch(event.target.value)}
          aria-label="Search products or brands"
        />

        <select
          className="brand-filter"
          value={selectedBrand}
          onChange={(event) => setSelectedBrand(event.target.value)}
          aria-label="Filter by brand"
        >
          {brands.map((brand) => (
            <option key={brand} value={brand}>
              {brand === 'All' ? 'All Brands' : brand}
            </option>
          ))}
        </select>

        <select
          className="category-filter"
          value={selectedCategory}
          onChange={(event) => setSelectedCategory(event.target.value)}
          aria-label="Filter by category"
        >
          {categories.map((category) => (
            <option key={category} value={category}>
              {category === 'All' ? 'All Categories' : category}
            </option>
          ))}
        </select>
      </div>

      <p className="product-count">
        Showing {filteredProducts.length} of {products.length} products
      </p>

      {filteredProducts.length === 0 ? (
        <p className="react-message">
          No matching products found. Try another search.
        </p>
      ) : (
        <div className="react-products">
          {filteredProducts.map((product) => (
            <article className="product-card" key={product.id}>
              <img
                className="product-image"
                src={product.image}
                alt={product.name || 'Product'}
                loading="lazy"
              />

              <div className="product-info">
                <h3>{product.name}</h3>
                <p className="brand">{product.brand}</p>
                <div className="price">₹{product.price}</div>

                <a
                  className="cart-btn"
                  href={`add_cart.php?id=${encodeURIComponent(product.id)}`}
                >
                  🛒 Add to Cart
                </a>
              </div>
            </article>
          ))}
        </div>
      )}
    </div>
  )
}

export default App
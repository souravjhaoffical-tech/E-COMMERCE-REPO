import { useEffect, useMemo, useState } from 'react'
import './App.css'

function App() {
  const [products, setProducts] = useState([])
  const [loading, setLoading] = useState(true)
  const [error, setError] = useState('')
  const [search, setSearch] = useState('')
  const [selectedBrand, setSelectedBrand] = useState('All')
  const [selectedCategory, setSelectedCategory] = useState('All')
  const [sortOrder, setSortOrder] = useState('default')

  // Fetch products from PHP API
  useEffect(() => {
    fetch('/E-COMMERCE-SITE/E-COMMERCE-REPO/api_products.php')
      .then((response) => {
        if (!response.ok) {
          throw new Error('Could not load products')
        }

        return response.json()
      })
      .then((data) => {
        if (data.success === false) {
          throw new Error(data.message || 'Could not load products')
        }

        setProducts(data.products || [])
      })
      .catch(() => {
        setError(
          'Products load nahi ho paaye. Please refresh the page.'
        )
      })
      .finally(() => {
        setLoading(false)
      })
  }, [])

  // Get unique brands
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

  // Get unique categories
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

  // Search, filter and sort products
  const filteredProducts = useMemo(() => {
    const searchText = search.trim().toLowerCase()

    const filtered = products.filter((product) => {
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

    if (sortOrder === 'low-high') {
      filtered.sort(
        (a, b) => Number(a.price) - Number(b.price)
      )
    } else if (sortOrder === 'high-low') {
      filtered.sort(
        (a, b) => Number(b.price) - Number(a.price)
      )
    }

    return filtered
  }, [
    products,
    search,
    selectedBrand,
    selectedCategory,
    sortOrder,
  ])

  // Loading state
  if (loading) {
    return (
      <p className="react-message">
        Loading products...
      </p>
    )
  }

  // Error state
  if (error) {
    return (
      <p className="react-message">
        {error}
      </p>
    )
  }

  // Product section
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
          onChange={(event) =>
            setSelectedCategory(event.target.value)
          }
          aria-label="Filter by category"
        >
          {categories.map((category) => (
            <option key={category} value={category}>
              {category === 'All'
                ? 'All Categories'
                : category}
            </option>
          ))}
        </select>

        <select
          className="sort-filter"
          value={sortOrder}
          onChange={(event) => setSortOrder(event.target.value)}
          aria-label="Sort products by price"
        >
          <option value="default">Sort by Price</option>
          <option value="low-high">
            Price: Low to High
          </option>
          <option value="high-low">
            Price: High to Low
          </option>
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
                <h3>
                  <a
                    className="product-title-link"
                    href={`product_details.php?id=${encodeURIComponent(product.id)}`}
                  >
                    {product.name}
                  </a>
                </h3>

                <p className="brand">
                  {product.brand}
                </p>

                <div className="price">
                  ₹{product.price}
                </div>

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
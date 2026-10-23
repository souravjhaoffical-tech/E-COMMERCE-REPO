
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


// Wishlist state: data comes from PHP + MySQL
const [wishlist, setWishlist] = useState([])
const [showWishlist, setShowWishlist] = useState(false)
const [wishlistMessage, setWishlistMessage] = useState('')

// Load logged-in user's wishlist from database
useEffect(() => {
  fetch(
    '/E-COMMERCE-SITE/E-COMMERCE-REPO/wishlist_api.php?action=list',
    { credentials: 'include' }
  )
    .then(async (response) => {
      const data = await response.json()

      if (!response.ok) {
        throw new Error(data.message || 'Please log in first.')
      }

      return data
    })
    .then((data) => {
      if (data.success) {
        setWishlist((data.wishlist || []).map(Number))
      }
    })
    .catch((err) => {
      setWishlistMessage(err.message)
    })
}, [])

// Add/remove wishlist item in database
const toggleWishlist = async (productId) => {
  setWishlistMessage('')

  try {
    const response = await fetch(
      '/E-COMMERCE-SITE/E-COMMERCE-REPO/wishlist_api.php?action=toggle',
      {
        method: 'POST',
        credentials: 'include',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({
          product_id: Number(productId),
        }),
      }
    )

    const data = await response.json()

    if (!response.ok || !data.success) {
      throw new Error(data.message || 'Wishlist update failed.')
    }

    setWishlist((current) => {
      const id = Number(productId)

      return data.added
        ? [...new Set([...current, id])]
        : current.filter((item) => item !== id)
    })
  } catch (err) {
    setWishlistMessage(err.message)
  }
}


  // Fetch products from PHP API
  useEffect(() => {
    
      
fetch(`${window.location.protocol}//${window.location.hostname}/E-COMMERCE-SITE/E-COMMERCE-REPO/api_products.php`)

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

      const matchesWishlist =
  !showWishlist || wishlist.includes(Number(product.id))
        

      return (
        matchesSearch &&
        matchesBrand &&
        matchesCategory &&
        matchesWishlist
      )
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
    showWishlist,
    wishlist,
  ])

  
  // Premium product loading skeleton
  if (loading) {
    return (
      <div className="react-shop">
        <div className="product-toolbar sv-skeleton-toolbar">
          <div className="sv-skeleton sv-skeleton-filter" />
          <div className="sv-skeleton sv-skeleton-filter" />
          <div className="sv-skeleton sv-skeleton-filter" />
          <div className="sv-skeleton sv-skeleton-filter" />
        </div>

        <div className="sv-skeleton-grid" aria-label="Loading products" role="status">
          {Array.from({ length: 8 }).map((_, index) => (
            <div className="sv-skeleton-card" key={index}>
              <div className="sv-skeleton sv-skeleton-image" />
              <div className="sv-skeleton sv-skeleton-line short" />
              <div className="sv-skeleton sv-skeleton-line" />
              <div className="sv-skeleton sv-skeleton-line short" />
              <div className="sv-skeleton sv-skeleton-button" />
            </div>
          ))}
          <span className="sv-sr-only">Loading products, please wait...</span>
        </div>
      </div>
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

        <button
          type="button"
          className={`wishlist-toggle ${showWishlist ? 'active' : ''}`}
          onClick={() => setShowWishlist((value) => !value)}
          aria-pressed={showWishlist}
        >
          ❤️ Wishlist ({wishlist.length})
        </button>
      </div>
      {wishlistMessage && (
  <p className="react-message" role="status">
    {wishlistMessage}
  </p>
)}

      <p className="product-count">
        {showWishlist ? 'Wishlist: ' : 'Showing '}
        {filteredProducts.length} of{' '}
        {showWishlist ? wishlist.length : products.length} products
      </p>

      {filteredProducts.length === 0 ? (
        <p className="react-message">
          {showWishlist
            ? 'Your wishlist is empty. Add products using the heart button!'
            : 'No matching products found. Try another search.'}
        </p>
      ) : (
        <div className="react-products">
          {filteredProducts.map((product) => {
            const isWishlisted = wishlist.includes(Number(product.id))

           
return (
  <article className="product-card" key={product.id}>
    <div className="product-image-wrap">
      <img
        className="product-image"
        src={product.image}
        alt={product.name || 'Product'}
        loading="lazy"
      />

      <span className="product-badge">SHOP VIBE</span>

      <button
        type="button"
        className={`wishlist-btn ${isWishlisted ? 'active' : ''}`}
        onClick={() => toggleWishlist(product.id)}
        aria-label={
          isWishlisted
            ? 'Remove from wishlist'
            : 'Add to wishlist'
        }
        aria-pressed={isWishlisted}
      >
        {isWishlisted ? '❤️' : '🤍'}
      </button>
    </div>

    <div className="product-info">
      <p className="brand">{product.brand || 'Shop Vibe'}</p>

      <h3>
        <a
          className="product-title-link"
          href={`product_details.php?id=${encodeURIComponent(product.id)}`}
        >
          {product.name || 'Untitled Product'}
        </a>
      </h3>

      <div className="price">₹{product.price}</div>

      <a
        className="cart-btn"
        href={`add_cart.php?id=${encodeURIComponent(product.id)}`}
      >
        <span>🛒</span> Add to Cart
      </a>
    </div>
  </article>
)

          })}
        </div>
      )}
    </div>
  )
}

export default App

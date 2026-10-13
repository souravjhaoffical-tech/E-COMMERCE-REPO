
import { useEffect, useState } from 'react'
import './App.css'

function App() {
  const [products, setProducts] = useState([])
  const [loading, setLoading] = useState(true)
  const [error, setError] = useState('')

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

  if (loading) {
    return <p className="react-message">Loading products...</p>
  }

  if (error) {
    return <p className="react-message">{error}</p>
  }

  if (products.length === 0) {
    return <p className="react-message">No products available right now.</p>
  }

  return (
    <div className="react-products">
      {products.map((product) => (
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
  )
}

export default App

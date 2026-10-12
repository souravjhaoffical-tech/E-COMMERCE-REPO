import { useEffect, useMemo, useState } from "react";
import "./App.css";

const products = [
  { id: 1, name: "Classic Black T-Shirt", brand: "Urban Style", price: 499, category: "Fashion", emoji: "👕", tag: "Bestseller" },
  { id: 2, name: "Everyday Sneakers", brand: "Street Walk", price: 1299, category: "Fashion", emoji: "👟", tag: "Popular" },
  { id: 3, name: "Wireless Headphones", brand: "SoundMax", price: 1999, category: "Electronics", emoji: "🎧", tag: "Hot Deal" },
  { id: 4, name: "Smart Watch", brand: "TechTime", price: 2499, category: "Electronics", emoji: "⌚", tag: "New" },
  { id: 5, name: "Everyday Backpack", brand: "CarryPro", price: 899, category: "Accessories", emoji: "🎒", tag: "Popular" },
  { id: 6, name: "Classic Sunglasses", brand: "SunLook", price: 599, category: "Accessories", emoji: "🕶️", tag: "New" },
  { id: 7, name: "Bluetooth Speaker", brand: "BassBox", price: 1499, category: "Electronics", emoji: "🔊", tag: "Hot Deal" },
  { id: 8, name: "Casual Hoodie", brand: "Urban Style", price: 999, category: "Fashion", emoji: "🧥", tag: "Bestseller" },
];

const API_URL =
  "http://localhost/E-COMMERCE-SITE/E-COMMERCE-REPO/api_products.php";

const categories = ["All", "Fashion", "Electronics", "Accessories"];


function money(amount) {
  return new Intl.NumberFormat("en-IN", {
    style: "currency",
    currency: "INR",
    maximumFractionDigits: 0,
  }).format(amount);
}

function App() {
const [products, setProducts] = useState([]);
const [loading, setLoading] = useState(true);
const [apiError, setApiError] = useState("");

useEffect(() => {
  async function loadProducts() {
    try {
      const response = await fetch(API_URL);
      const data = await response.json();

       console.log("API response:", data);
      console.log("Products array:", data.products);

      setProducts(data.products || []);
    } catch (error) {
      console.error("Products fetch error:", error);
      setApiError("Products load nahi ho paaye");
    } finally {
      setLoading(false);
    }
  }

  loadProducts();
}, []);

  const [search, setSearch] = useState("");
  const [category, setCategory] = useState("All");
  const [cart, setCart] = useState([]);
  const [notice, setNotice] = useState("");
  console.log("Products from API:", products);

  const visibleProducts = useMemo(() => {
  const term = search.trim().toLowerCase();

  return products.filter((product) => {
    const matchesCategory =
      category === "All" ||
      (product.category || "") === category;

    const matchesSearch =
      (product.name || "").toLowerCase().includes(term) ||
      (product.brand || "").toLowerCase().includes(term) ||
      (product.category || "").toLowerCase().includes(term);

    return matchesCategory && matchesSearch;
  });
}, [products, search, category]);

  const cartCount = cart.reduce((total, item) => total + item.quantity, 0);
  const cartTotal = cart.reduce(
    (total, item) => total + item.price * item.quantity,
    0
  );

  function addToCart(product) {
    setCart((currentCart) => {
      const existing = currentCart.find((item) => item.id === product.id);

      if (existing) {
        return currentCart.map((item) =>
          item.id === product.id
            ? { ...item, quantity: item.quantity + 1 }
            : item
        );
      }

      return [...currentCart, { ...product, quantity: 1 }];
    });

    setNotice(`${product.name} added to cart!`);
    window.setTimeout(() => setNotice(""), 2200);
  }

  function changeQuantity(id, amount) {
    setCart((currentCart) =>
      currentCart
        .map((item) =>
          item.id === id
            ? { ...item, quantity: item.quantity + amount }
            : item
        )
        .filter((item) => item.quantity > 0)
    );
  }

  return (
    <div className="app">
      <div className="announcement">
        ✨ Great finds, great prices — discover your next favourite!
      </div>

      <header className="navbar">
        <a className="logo" href="#home" aria-label="Shop Vibe home">
          <span className="logo-mark">♡</span>
          <span>Shop <b>Vibe</b></span>
        </a>

        <nav className="nav-links">
          <a href="#home">Home</a>
          <a href="#products">Shop</a>
          <a href="#categories">Categories</a>
        </nav>

        <label className="search-box">
          <span>⌕</span>
          <input
            aria-label="Search products"
            placeholder="Search products..."
            value={search}
            onChange={(event) => setSearch(event.target.value)}
          />
          {search && (
            <button
              className="clear-search"
              onClick={() => setSearch("")}
              aria-label="Clear search"
            >
              ×
            </button>
          )}
        </label>

        <button
          className="cart-button"
          onClick={() =>
            document.getElementById("cart")?.scrollIntoView({
              behavior: "smooth",
            })
          }
        >
          🛒 <span>Cart</span>
          <b className="cart-count">{cartCount}</b>
        </button>
      </header>

      <main>
        <section className="hero" id="home">
          <div className="hero-content">
            <span className="eyebrow">YOUR EVERYDAY SHOPPING DESTINATION</span>
            <h1>
              Big Deals.
              <br />
              <span>Better Vibes.</span>
            </h1>
            <p>
              Discover the latest styles, useful tech and everyday essentials
              — all in one place.
            </p>
            <a className="primary-button" href="#products">
              Explore Products <span>→</span>
            </a>
            <div className="hero-trust">
              <span>✓ Curated finds</span>
              <span>✓ Great value</span>
              <span>✓ Easy shopping</span>
            </div>
          </div>

          <div className="hero-art" aria-hidden="true">
            <div className="art-circle circle-one" />
            <div className="art-circle circle-two" />
            <div className="floating-card card-top">✨ Trending now</div>
            <div className="shopping-bag">🛍️</div>
            <div className="floating-card card-bottom">
              <span>Discover more</span>
              <b>Love what you find.</b>
            </div>
          </div>
        </section>

        <section className="benefits">
          <div><span>🚚</span><p><b>Easy ordering</b><small>Simple shopping flow</small></p></div>
          <div><span>💎</span><p><b>Handpicked finds</b><small>Products for daily life</small></p></div>
          <div><span>🔒</span><p><b>Shop with confidence</b><small>Clear product details</small></p></div>
        </section>

        <section className="catalog" id="products">
          <div className="section-heading">
            <div>
              <span className="eyebrow purple-text">MADE FOR YOUR VIBE</span>
              <h2>Explore <span>Our Products</span></h2>
              <p>Find something you’ll love.</p>
            </div>
            <span className="result-count">
              {visibleProducts.length} products
            </span>
          </div>

          <div className="category-list" id="categories">
            {categories.map((item) => (
              <button
                key={item}
                className={`category-chip ${category === item ? "active" : ""}`}
                onClick={() => setCategory(item)}
              >
                {item}
              </button>
            ))}
          </div>

          {visibleProducts.length > 0 ? (
            <div className="product-grid">
              {visibleProducts.map((product) => (
                <article className="product-card" key={product.id}>
                  <div className="product-visual">
                    <span className="product-tag">{product.tag}</span>
                     
{product.image ? (
  <img
    className="product-photo"
    src={product.image}
    alt={product.name}
    loading="lazy"
    onError={(event) => {
      event.currentTarget.style.display = "none";
    }}
  />
) : (
  <span className="product-emoji" aria-hidden="true">
    {product.emoji || "🛍️"}
  </span>
)}

                  </div>
                  <div className="product-info">
                    <span className="product-category">{product.category}</span>
                    <h3>{product.name}</h3>
                    <p className="brand">{product.brand}</p>
                    <div className="product-bottom">
                      <strong>{money(product.price)}</strong>
                      <button
                        className="add-button"
                        onClick={() => addToCart(product)}
                      >
                        + Add
                      </button>
                    </div>
                  </div>
                </article>
              ))}
            </div>
          ) : (
            <div className="empty-state">
              <span>🔎</span>
              <h3>No products found</h3>
              <p>Try a different search or choose another category.</p>
              <button
                className="primary-button"
                onClick={() => {
                  setSearch("");
                  setCategory("All");
                }}
              >
                Show all products
              </button>
            </div>
          )}
        </section>

        <section className="cart-section" id="cart">
          <div className="section-heading">
            <div>
              <span className="eyebrow purple-text">YOUR PICKS</span>
              <h2>Your <span>Shopping Cart</span></h2>
            </div>
            <span className="result-count">{cartCount} items</span>
          </div>

          {cart.length === 0 ? (
            <div className="empty-cart">
              <span>🛒</span>
              <div>
                <h3>Your cart is waiting for something good.</h3>
                <p>Add a product above and it will appear here.</p>
              </div>
              <a className="secondary-button" href="#products">Browse products</a>
            </div>
          ) : (
            <div className="cart-panel">
              {cart.map((item) => (
                <div className="cart-row" key={item.id}>
                  <span className="cart-item-emoji">{item.emoji}</span>
                  <div className="cart-item-info">
                    <b>{item.name}</b>
                    <small>{money(item.price)} each</small>
                  </div>
                  <div className="quantity-control">
                    <button onClick={() => changeQuantity(item.id, -1)} aria-label={`Remove one ${item.name}`}>−</button>
                    <span>{item.quantity}</span>
                    <button onClick={() => changeQuantity(item.id, 1)} aria-label={`Add one ${item.name}`}>+</button>
                  </div>
                  <strong className="line-total">{money(item.price * item.quantity)}</strong>
                </div>
              ))}
              <div className="cart-total">
                <span>Subtotal</span>
                <strong>{money(cartTotal)}</strong>
              </div>
              <p className="demo-note">
                Demo cart only: checkout and payment are not connected yet.
              </p>
            </div>
          )}
        </section>
      </main>

      <footer className="footer">
        <a className="logo footer-logo" href="#home">
          <span className="logo-mark">♡</span>
          <span>Shop <b>Vibe</b></span>
        </a>
        <p>Find your vibe. Love your finds.</p>
        <span>© {new Date().getFullYear()} Shop Vibe</span>
      </footer>

      {notice && <div className="toast" role="status">{notice}</div>}
    </div>
  );
}

export default App;

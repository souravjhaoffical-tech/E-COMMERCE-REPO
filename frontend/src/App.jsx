import { useEffect, useMemo, useState } from 'react'

import './App.css'



// PHP backend base URL (XAMPP)

const PHP_BASE_URL = `${window.location.protocol}//${window.location.hostname}/E-COMMERCE-SITE/E-COMMERCE-REPO`



const PRODUCTS_API = `${PHP_BASE_URL}/products_api.php`

const WISHLIST_API = `${PHP_BASE_URL}/wishlist_api.php`

const ADD_CART_API = `${PHP_BASE_URL}/add_cart.php`

// Convert database image path into PHP image URL

const getImageUrl = (imagePath) => {

  if (!imagePath) return '';



  let fileName = String(imagePath).trim();



  // Complete URLs ko unchanged rakho

  if (/^(https?:\/\/|data:)/i.test(fileName)) {

    return fileName;

  }



  // Extra hash prefix remove karo

  fileName = fileName.split('/').pop();

  fileName = fileName.replace(/^[a-f0-9]{8,}_/i, '');



  return `${PHP_BASE_URL}/uploads/${encodeURIComponent(fileName)}`;

};



function App() {

  const [products, setProducts] = useState([])

  const [loading, setLoading] = useState(true)

  const [error, setError] = useState('')



  const [search, setSearch] = useState('')

  const [selectedBrand, setSelectedBrand] = useState('All')

  const [selectedCategory, setSelectedCategory] = useState('All')

  const [sortOrder, setSortOrder] = useState('default')

  const [showFilters, setShowFilters] = useState(false)



  const [productQuantities, setProductQuantities] = useState({})

  const [cartMessage, setCartMessage] = useState('')

  const [addedToCart, setAddedToCart] = useState({})



  // Load wishlist

// Wishlist state: data comes from PHP + MySQL

const [wishlist, setWishlist] = useState([])

const [showWishlist, setShowWishlist] = useState(false)

const [wishlistMessage, setWishlistMessage] = useState('')



// Load logged-in user's wishlist from database

useEffect(() => {

  fetch(

     `${WISHLIST_API}?action=list`,

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

  if (err.message !== 'Please log in as a user first.') {

    setWishlistMessage(err.message)

  }

})

}, [])



// Add/remove wishlist item in database

const toggleWishlist = async (productId) => {

  setWishlistMessage('')



  try {

    const response = await fetch(

      `${WISHLIST_API}?action=toggle`,

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

// Add product to cart / update cart quantity

  const handleAddToCart = async (productId, quantity = 1) => {

    const formData = new FormData()

    formData.append('id', productId)

    formData.append('quantity', quantity)

    // add_cart.php requires this action for React requests

    formData.append('action', 'set_quantity')

    try {

      const response = await fetch(ADD_CART_API, {

        method: 'POST',

        credentials: 'include',

        body: formData

      })

      const data = await response.json()

      if (!response.ok || !data.success) {

        throw new Error(data.message || 'Could not add product')

      }

      // Update React state only after PHP confirms the cart update

      setProductQuantities((current) => ({

        ...current,

        [productId]: quantity

      }))

      setAddedToCart((current) => ({

        ...current,

        [productId]: true

      }))

      setCartMessage(

        `${quantity} ${quantity === 1 ? 'product' : 'products'} added to cart`

      )

      setTimeout(() => setCartMessage(''), 2500)

    } catch (error) {

      setCartMessage(error.message)

      setTimeout(() => setCartMessage(''), 2500)

    }

  }


  // Update quantity in PHP session

  const updateCartQuantity = (productId, quantity) => {

    if (quantity < 1) return

    handleAddToCart(productId, quantity)

  }


  // Fetch products from PHP + MySQL API

  useEffect(() => {

    fetch(PRODUCTS_API, {

      method: 'GET',

      credentials: 'include',

      headers: {

        Accept: 'application/json'

      }

    })

      .then(async (response) => {

        const responseText = await response.text()

        let data



        try {

          data = JSON.parse(responseText)

        } catch {

          throw new Error(

            'PHP API ne JSON return nahi kiya. products_api.php check karo.'

          )

        }



        if (!response.ok || !data.success) {

          throw new Error(

            data.message || `Products API error (${response.status})`

          )

        }



        if (!Array.isArray(data.products)) {

          throw new Error('API response mein products list nahi mili.')

        }



        return data

      })

      .then((data) => {

        const formattedProducts = (data.products || []).map((item) => ({

          id: item.id,

          name: item.p_name,

          brand: item.p_brand,

          price: item.p_price,

          image: item.image,

          category: item.category || item.categories || '',

          stock_quantity: item.stock_quantity

        }))



        setProducts(formattedProducts)

      })

      .catch((err) => {

        console.error('Product API Error:', err)



        setError(

          err.message || 'Products load nahi ho paaye. Please refresh the page.'

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

      )

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

      )

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

        !showWishlist ||

        wishlist.includes(Number(product.id))



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

    wishlist

  ])



  // Loading skeleton

  if (loading) {

    return (

      <div className="react-shop">



        <div className="product-toolbar sv-skeleton-toolbar">

          <div className="sv-skeleton sv-skeleton-filter" />

          <div className="sv-skeleton sv-skeleton-filter" />

          <div className="sv-skeleton sv-skeleton-filter" />

          <div className="sv-skeleton sv-skeleton-filter" />

        </div>



        <div

          className="sv-skeleton-grid"

          aria-label="Loading products"

          role="status"

        >

          {Array.from({ length: 8 }).map((_, index) => (

            <div className="sv-skeleton-card" key={index}>

              <div className="sv-skeleton sv-skeleton-image" />

              <div className="sv-skeleton sv-skeleton-line short" />

              <div className="sv-skeleton sv-skeleton-line" />

              <div className="sv-skeleton sv-skeleton-line short" />

              <div className="sv-skeleton sv-skeleton-button" />

            </div>

          ))}



          <span className="sv-sr-only">

            Loading products, please wait...

          </span>

        </div>



      </div>

    )

  }



  // Error state

  if (error) {

    return (

      <div className="react-message" role="alert">

        <p>{error}</p>



        <button

          type="button"

          onClick={() => window.location.reload()}

        >

          Retry

        </button>

      </div>

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

          onFocus={() => setShowFilters(true)}

        />



        {showFilters && (

          <>



            <select

              className="brand-filter"

              value={selectedBrand}

              onChange={(event) => setSelectedBrand(event.target.value)}

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

            >

              {categories.map((category) => (

                <option key={category} value={category}>

                  {category === 'All' ? 'All Categories' : category}

                </option>

              ))}

            </select>



            <select

              className="sort-filter"

              value={sortOrder}

              onChange={(event) => setSortOrder(event.target.value)}

            >

              <option value="default">Sort by Price</option>

              <option value="low-high">Price: Low to High</option>

              <option value="high-low">Price: High to Low</option>

            </select>



          </>

        )}



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



      {cartMessage && (

        <div className="cart-notification" role="status">

          ✓ {cartMessage}

        </div>

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

  src={getImageUrl(product.image)}

  alt={product.name || 'Product'}

  loading="lazy"

  onError={(e) => {

    console.error('Image not found:', e.currentTarget.src);

  }}

/>



                  <span className="product-badge">

                    SHOP VIBE

                  </span>



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



                  <p className="brand">

                    {product.brand || 'Shop Vibe'}

                  </p>



                  <h3>

                    <a

                      className="product-title-link"

                      href={`${PHP_BASE_URL}/product_details.php?id=${encodeURIComponent(product.id)}`}

                    >

                      {product.name || 'Untitled Product'}

                    </a>

                  </h3>



                  <div className="price">

                    ₹{product.price}

                  </div>

{Number(product.stock_quantity ?? 0) > 0 ? (

  addedToCart[product.id] ? (

    <div className="product-quantity-control">

      <button

        type="button"

        disabled={(productQuantities[product.id] || 1) <= 1}

        onClick={() =>

          updateCartQuantity(

            product.id,

            (productQuantities[product.id] || 1) - 1

          )

        }

      >

        −

      </button>



      <span>

        {productQuantities[product.id] || 1}

      </span>



      <button

        type="button"

        disabled={

          (productQuantities[product.id] || 1) >=

          Number(product.stock_quantity)

        }

        onClick={() =>

          updateCartQuantity(

            product.id,

            (productQuantities[product.id] || 1) + 1

          )

        }

      >

        +

      </button>

    </div>

  ) : (

    <button

      type="button"

      className="cart-btn"

      onClick={() => handleAddToCart(product.id, 1)}

    >

      🛒 Add to Cart

    </button>

  )

) : (

  <button

    type="button"

    className="cart-btn"

    disabled

  >

    Out of Stock

  </button>

)}

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

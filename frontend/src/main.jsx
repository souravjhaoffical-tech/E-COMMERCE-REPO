import { StrictMode } from 'react'
import { createRoot } from 'react-dom/client'
import './index.css'
import App from './App.jsx'
import Countdown from './Countdown.jsx'

const productRoot = document.getElementById('products-root')
const countdownRoot = document.getElementById('countdown-root')

if (productRoot) {
  createRoot(productRoot).render(
    <StrictMode>
      <App />
    </StrictMode>,
  )
}

if (countdownRoot) {
  createRoot(countdownRoot).render(
    <StrictMode>
      <Countdown />
    </StrictMode>,
  )
}


import { useEffect, useState } from 'react'
import './Countdown.css'

const SALE_END = new Date('2026-10-25T23:59:00+05:30').getTime()

function getTimeLeft() {
  const difference = Math.max(0, SALE_END - Date.now())

  return {
    days: Math.floor(difference / 86400000),
    hours: Math.floor((difference / 3600000) % 24),
    minutes: Math.floor((difference / 60000) % 60),
    seconds: Math.floor((difference / 1000) % 60),
  }
}

function Countdown() {
  const [timeLeft, setTimeLeft] = useState(getTimeLeft)

  useEffect(() => {
    const timer = setInterval(() => {
      setTimeLeft(getTimeLeft())
    }, 1000)

    return () => clearInterval(timer)
  }, [])

  const finished = Object.values(timeLeft).every((value) => value === 0)

  if (finished) {
    return <p className="sale-ended">Sale has ended!</p>
  }

  const units = [
    ['Days', timeLeft.days],
    ['Hours', timeLeft.hours],
    ['Minutes', timeLeft.minutes],
    ['Seconds', timeLeft.seconds],
  ]

  return (
    <div className="sale-countdown" aria-label="Sale countdown">
      {units.map(([label, value]) => (
        <div className="countdown-unit" key={label}>
          <span className="countdown-number">
            {String(value).padStart(2, '0')}
          </span>
          <span className="countdown-label">{label}</span>
        </div>
      ))}
    </div>
  )
}

export default Countdown
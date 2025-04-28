// Locomotive Scroll initialization
document.addEventListener('DOMContentLoaded', function() {
  // Check if Locomotive Scroll is loaded
  if (typeof LocomotiveScroll !== 'undefined') {
    // Initialize Locomotive Scroll
    const scroll = new LocomotiveScroll({
      el: document.querySelector('[data-scroll-container]'),
      smooth: true,
      multiplier: 0.8,
      lerp: 0.05,
      smartphone: {
        smooth: true
      },
      tablet: {
        smooth: true
      }
    });

    // Update scroll on page load
    scroll.on('scroll', function() {
      // You can add custom scroll animations here
    });

    // Update scroll on window resize
    window.addEventListener('resize', function() {
      scroll.update();
    });
  } else {
    console.error('Locomotive Scroll is not loaded');
  }
}); 
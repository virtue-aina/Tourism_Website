/**
 * Animations.js
 * Handles all scroll-based animations and DOM manipulations
 */

document.addEventListener('DOMContentLoaded', function() {
  // Initialize animation elements
  initAnimations();
  
  // Set up scroll event listeners
  setupScrollListeners();
});

/**
 * Initialize animation elements
 */
function initAnimations() {
  // Add initial classes to elements
  const packagesSection = document.querySelector('.packages');
  const packageTitle = document.querySelector('.package-title');
  const packageCards = document.querySelectorAll('.package-a, .package-b, .package-c');
  
  if (packagesSection) {
    packagesSection.classList.add('animation-ready');
  }
  
  if (packageTitle) {
    packageTitle.classList.add('animation-ready');
  }
  
  packageCards.forEach(card => {
    card.classList.add('animation-ready');
  });
}

/**
 * Set up scroll event listeners
 */
function setupScrollListeners() {
  // Use Intersection Observer for better performance
  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        // Element is in viewport
        const element = entry.target;
        
        if (element.classList.contains('packages')) {
          // Trigger packages section animation
          element.classList.add('visible');
          
          // Trigger title animation with delay
          const title = document.querySelector('.package-title');
          if (title) {
            setTimeout(() => {
              title.classList.add('visible');
            }, 200);
          }
          
          // Trigger package cards animations with staggered delays
          const cards = document.querySelectorAll('.package-a, .package-b, .package-c');
          cards.forEach((card, index) => {
            setTimeout(() => {
              card.classList.add('visible');
            }, 400 + (index * 200));
          });
        }
      }
    });
  }, {
    threshold: 0.2, // Trigger when 20% of the element is visible
    rootMargin: '0px 0px -100px 0px' // Trigger slightly before element enters viewport
  });
  
  // Observe packages section
  const packagesSection = document.querySelector('.packages');
  if (packagesSection) {
    observer.observe(packagesSection);
  }
  
  // Add scroll event listener for locomotive scroll compatibility
  window.addEventListener('scroll', handleScroll);
}

/**
 * Handle scroll events for locomotive scroll compatibility
 */
function handleScroll() {
  // This function will be called by locomotive scroll
  if (window.scroll) {
    // Get scroll position
    const scrollY = window.scroll.y;
    
    // Apply scroll-based effects to elements
    applyScrollEffects(scrollY);
  }
}

/**
 * Apply scroll effects to elements
 */
function applyScrollEffects(scrollY) {
  // Get all elements with scroll-text class
  const scrollTextElements = document.querySelectorAll('.scroll-text');
  
  // Apply scroll values to each element
  scrollTextElements.forEach(element => {
    // Apply custom properties for CSS to use
    element.style.setProperty('--scroll-y', scrollY);
  });
  
  // Apply additional effects to package cards
  const packageCards = document.querySelectorAll('.package-a, .package-b, .package-c');
  
  packageCards.forEach((card, index) => {
    // Calculate position relative to viewport
    const rect = card.getBoundingClientRect();
    const viewportHeight = window.innerHeight;
    
    // If element is in viewport
    if (rect.top < viewportHeight && rect.bottom > 0) {
      // Calculate how far through the viewport the element is (0 to 1)
      const progress = 1 - (rect.top / viewportHeight);
      
      // Apply subtle animations based on scroll position
      if (progress > 0 && progress < 1) {
        // Scale up slightly as element enters viewport
        const scale = 1 + (progress * 0.05);
        card.style.transform = `scale(${scale})`;
      }
    }
  });
}

/**
 * Export functions for use in locomotive-scroll.js
 */
window.Animations = {
  handleScroll: handleScroll
}; 
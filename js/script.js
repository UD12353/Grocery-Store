/**
 * MAIN JAVASCRIPT FILE
 * 
 * This file handles client-side interactivity for the grocery store
 * 
 * Features:
 * - Page loading animation
 * - Toast notifications
 * - Mobile menu toggle
 * - User profile dropdown toggle
 * - Scroll to top button functionality
 * - Auto-hide menus on scroll
 * 
 * @author UD & VV
 */

// ============================================
// PAGE LOADING ANIMATION
// ============================================

// Hide loader when page finishes loading
window.addEventListener('load', () => {
    const loader = document.querySelector('.loader-container');
    if (loader) {
        // Add fade-out class after a short delay for smooth transition
        setTimeout(() => {
            loader.classList.add('fade-out');
            // Remove loader from DOM after fade completes
            setTimeout(() => {
                loader.style.display = 'none';
            }, 500);
        }, 800); // Show loader for at least 800ms
    }
});

// ============================================
// TOAST NOTIFICATION SYSTEM
// ============================================

/**
 * Show a toast notification
 * @param {string} message - The message to display
 * @param {string} type - Type of toast: 'success', 'error', 'info', 'warning'
 * @param {number} duration - How long to show toast (milliseconds)
 */
function showToast(message, type = 'success', duration = 3000) {
    // Create toast container if it doesn't exist
    let toastContainer = document.querySelector('.toast-container');
    if (!toastContainer) {
        toastContainer = document.createElement('div');
        toastContainer.className = 'toast-container';
        document.body.appendChild(toastContainer);
    }

    // Create toast element
    const toast = document.createElement('div');
    toast.className = `toast toast-${type}`;
    
    // Set icon based on type
    let icon = '';
    switch(type) {
        case 'success':
            icon = '<i class="fas fa-check-circle"></i>';
            break;
        case 'error':
            icon = '<i class="fas fa-times-circle"></i>';
            break;
        case 'warning':
            icon = '<i class="fas fa-exclamation-triangle"></i>';
            break;
        case 'info':
            icon = '<i class="fas fa-info-circle"></i>';
            break;
    }
    
    toast.innerHTML = `
        ${icon}
        <span class="toast-message">${message}</span>
        <button class="toast-close" onclick="this.parentElement.remove()">
            <i class="fas fa-times"></i>
        </button>
    `;
    
    // Add toast to container
    toastContainer.appendChild(toast);
    
    // Trigger animation
    setTimeout(() => toast.classList.add('show'), 10);
    
    // Auto-remove after duration
    setTimeout(() => {
        toast.classList.remove('show');
        setTimeout(() => toast.remove(), 300);
    }, duration);
}

// ============================================
// MOBILE MENU FUNCTIONALITY
// ============================================

// Get reference to navigation menu element
let navbar = document.querySelector('.header .flex .navbar');

// Mobile menu button click handler
// Toggles the mobile navigation menu visibility
document.querySelector('#menu-btn').onclick = () =>{
   navbar.classList.toggle('active');  // Show/hide menu
   profile.classList.remove('active'); // Close profile menu if open
}

// ============================================
// USER PROFILE DROPDOWN FUNCTIONALITY
// ============================================

// Get reference to profile dropdown element
let profile = document.querySelector('.header .flex .profile');

// User profile button click handler
// Toggles the user profile dropdown visibility
document.querySelector('#user-btn').onclick = () =>{
   profile.classList.toggle('active');  // Show/hide profile menu
   navbar.classList.remove('active');   // Close navigation menu if open
}

// ============================================
// SCROLL EVENT HANDLER
// ============================================

// Window scroll event - triggered when user scrolls the page
window.onscroll = () =>{
   // Auto-close menus when user scrolls
   // Improves UX by preventing menus from blocking content
   profile.classList.remove('active');
   navbar.classList.remove('active');
   
   // ============================================
   // SCROLL TO TOP BUTTON VISIBILITY
   // ============================================
   
   // Get reference to scroll-to-top button
   let scrollBtn = document.getElementById('scrollToTop');
   
   if(scrollBtn){
      // Show button when user scrolls down 300px
      // Hide button when near top of page
      if(window.scrollY > 300){
         scrollBtn.classList.add('active');  // Show button
      }else{
         scrollBtn.classList.remove('active'); // Hide button
      }
   }
}

// ============================================
// SCROLL TO TOP BUTTON CLICK HANDLER
// ============================================

// Wait for DOM to fully load before attaching event listeners
window.addEventListener('DOMContentLoaded', () => {
    // Get reference to scroll-to-top button
    let scrollBtn = document.getElementById('scrollToTop');
    
    if(scrollBtn){
        // Add click event listener to button
        scrollBtn.addEventListener('click', () => {
            // Scroll to top of page with smooth animation
            window.scrollTo({
                top: 0,              // Scroll to top (0px from top)
                behavior: 'smooth'   // Smooth scrolling animation
            });
        });
    }
    
    // ============================================
    // CONVERT PHP MESSAGES TO TOAST NOTIFICATIONS
    // ============================================
    const messages = document.querySelectorAll('.message');
    messages.forEach(msg => {
        const text = msg.textContent.trim();
        let type = 'info';
        
        // Determine toast type based on message content
        if (text.includes('added to cart') || text.includes('added to wishlist') || 
            text.includes('success') || text.includes('updated')) {
            type = 'success';
        } else if (text.includes('already') || text.includes('error') || text.includes('failed')) {
            type = 'warning';
        }
        
        showToast(text, type);
        msg.style.display = 'none'; // Hide original message
    });
});
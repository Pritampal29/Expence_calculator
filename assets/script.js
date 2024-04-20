// JavaScript code for handling sidebar active link

// Get all sidebar links
const sidebarLinks = document.querySelectorAll('.sidebar a');

// Add event listeners to each link
sidebarLinks.forEach(link => {
  link.addEventListener('click', () => {
    // Remove the 'active' class from all links
    sidebarLinks.forEach(link => {
      link.classList.remove('active');
    });

    // Add the 'active' class to the clicked link
    link.classList.add('active');
  });
});

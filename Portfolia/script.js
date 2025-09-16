// Select all anchor links on the page (you can narrow this selector if you want)
const links = document.querySelectorAll("a");

links.forEach(link => {
  link.addEventListener("click", (e) => {
    const href = link.getAttribute("href");

    // Smooth scroll ONLY for internal anchors like #about, #contact
    if (href && href.startsWith("#") && href.length > 1) {
      e.preventDefault(); // Prevent default jumping

      const targetSection = document.getElementById(href.slice(1));
      if (targetSection) {
        window.scrollTo({
          top: targetSection.offsetTop - 50, // Adjust offset if you have a fixed header
          behavior: "smooth"
        });
      }
    }
    // For all other links (.html, .php, external URLs), do NOT prevent default,
    // so the browser navigates normally.
  });
});

// disable a tag for each product
document.addEventListener("DOMContentLoaded", () => {
  const productLinks = document.querySelectorAll(".menu-items li");

  productLinks.forEach((link) => {
    link.addEventListener("click", (e) => {
      e.preventDefault();
    });
  });
});

document.addEventListener("DOMContentLoaded", () => {
  const copyPopup = document.getElementById("copy-popup");

  document
    .getElementById("copy-address")
    .addEventListener("click", function () {
      const addressContent = this.textContent; // target
      navigator.clipboard.writeText(addressContent).then(() => {
        copyPopup.style.opacity = "1";
        setTimeout(() => {
          copyPopup.style.opacity = "0";
        }, 1000); // Show popup for 1 second
      });
    });
});

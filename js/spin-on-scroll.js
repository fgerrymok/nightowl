const dish = document.querySelectorAll('.item-img');

dish.forEach((singleDish) => {
    const dishImg = singleDish.querySelector('img');
    let currentRotation = 0;
    let lastScrollY = window.scrollY;

    window.addEventListener('scroll', () => {
        const newScrollY = window.scrollY;

        if (newScrollY > lastScrollY) {
            currentRotation += 3;
        } else {
            currentRotation -= 3;
        }

        dishImg.style.transform = `rotate(${currentRotation}deg)`;
        lastScrollY = newScrollY;
    });
});

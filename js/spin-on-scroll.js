const dish = document.querySelectorAll('.item-img');

dish.forEach((singleDish) => {
    const dishImg = singleDish.querySelector('img');
    let currentRotation = 0;
    let lastScrollY = window.scrollY;

    const handleScroll = () => {
        const newScrollY = window.scrollY;
        const scrollDelta = newScrollY - lastScrollY;
        currentRotation += scrollDelta * 0.07;

        dishImg.style.transform = `rotate(${currentRotation}deg)`;
        lastScrollY = newScrollY;
    };

    window.addEventListener('scroll', handleScroll);
});

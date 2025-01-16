document.addEventListener('DOMContentLoaded',() => {
    const topMenuItems            = document.querySelectorAll('.top-menu-item');
    const topMenuNav              = document.querySelector('.top-menu-nav');
    const sidebarMenuItems        = document.querySelectorAll('.sidebar-menu-item');
    const sidebarMenuItemsWrapper = document.querySelector('.sidebar-menu-nav');
    const sidebarMenuButton       = document.querySelector('.sidebar-menu-button');
    const tabIndicator            = document.querySelector('.tab-indicator');


    // hide the sidebar menu on the first load
    sidebarMenuItemsWrapper.style.display = 'none';

     // function to update the tab indicator
     const updateTabIndicator = (activeTab) => {
        if(activeTab && tabIndicator){
             const offsetLeft = activeTab.offsetLeft;
             const tabWidth = activeTab.offsetWidth;

            // Adjust for the scroll position of the container
            const scrollLeft = topMenuNav.scrollLeft;

             // Update indicator position and width
             tabIndicator.style.width = `${tabWidth}px`;
             tabIndicator.style.transform = `translateX(${offsetLeft - scrollLeft}px)`;
 
             // Scroll handling for tab visibility
             const containerWidth = topMenuNav.clientWidth;
             const scrollPosition = topMenuNav.scrollLeft;
 
             // Check if the tab is not fully in view
             if (offsetLeft < scrollPosition) {
                 // Tab is to the left of the visible area
                 topMenuNav.scrollTo({
                     left: offsetLeft,
                     behavior: 'smooth'
                 });
             } else if (offsetLeft + tabWidth > scrollPosition + containerWidth) {
                 // Tab is to the right of the visible area
                 topMenuNav.scrollTo({
                     left: offsetLeft + tabWidth - containerWidth,
                     behavior: 'smooth'
                 });
             }

             // Ensure the indicator stays within the container
            const maxIndicatorPosition = topMenuNav.scrollWidth - tabIndicator.offsetWidth;
            const indicatorPosition = offsetLeft;
            if (indicatorPosition > maxIndicatorPosition) {
                tabIndicator.style.transform = `translateX(${maxIndicatorPosition}px)`;
            }
        }
    };

    // Update indicator on scroll
    topMenuNav.addEventListener('scroll', () => {
        const activeTab = document.querySelector('.top-menu-item.active');
        if (activeTab) {
            updateTabIndicator(activeTab);
        }
    });

    const activateCategory = (term) =>{
        topMenuItems.forEach(item => item.classList.remove('active'));
        sidebarMenuItems.forEach(item => item.classList.remove('side-active'));

        const topItem = document.querySelector(`.top-menu-item[data-term="${term}"]`);
        const sidebarItem = document.querySelector(`.sidebar-menu-item[data-term="${term}"]`);
        const categoryWrapper = document.querySelector(`.single-category-wrapper[data-term="${term}"]`);

        if (topItem) topItem.classList.add('active');
        if (sidebarItem) sidebarItem.classList.add('side-active');
        if (categoryWrapper) {
            categoryWrapper.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }

        const topMenuHeight = parseFloat(window.getComputedStyle(document.querySelector('.top-menu-wrapper')).height);
        
        // Add a small delay to allow the scroll action to complete
        setTimeout(() => {
            window.scrollBy(0, -50);
        },30);

        updateTabIndicator(topItem);

    };

    // Add click listeners to top and sidebar menus
    topMenuItems.forEach(item => {
        item.addEventListener('click', () => {
            const term = item.dataset.term;
            activateCategory(term);
        });
    });

    sidebarMenuItems.forEach(item => {
        item.addEventListener('click', () => {
            const term = item.dataset.term;
            activateCategory(term);
        });
    });


    // Handle the hamburger menu
    sidebarMenuButton.addEventListener('click', () => {
       if(sidebarMenuItemsWrapper.style.display === 'none'){
            sidebarMenuItemsWrapper.style.display = 'block';
       }
       else{
            sidebarMenuItemsWrapper.style.display = 'none';
       }
    });

})
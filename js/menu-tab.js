document.addEventListener('DOMContentLoaded', () => {
    const topMenuItems            = document.querySelectorAll('.top-menu-nav li');
    const sidebarMenuItems        = document.querySelectorAll('.sidebar-menu-nav li');
    const sections                = document.querySelectorAll('.single-category-wrapper');
    const tabIndicator            = document.querySelector('.tab-indicator');
    const topMenuNav              = document.querySelector('.top-menu-nav');
    const topMenuWrapper          = document.querySelector('.top-menu-wrapper');
    const sidebarMenuItemsWrapper = document.querySelector('.sidebar-dismiss-wrapper');
    const sidebarMenuDismissBtn   = document.querySelector('.dismiss-btn')
    const sidebarMenuButton       = document.querySelector('.sidebar-menu-button');
    let userInitiatedScroll       = true;
    const breakpoint = window.matchMedia("(min-width: 768px)");

    sidebarMenuItemsWrapper.style.display = 'none';

    // Function to calculate the offset of an element from the top of the document
    const getOffset = (element) => {
        const rect = element.getBoundingClientRect();
        const scrollTop = window.scrollY || document.documentElement.scrollTop;
        return rect.top + scrollTop;
    };

    // Function to get the height of the sticky header
    const getStickyHeaderHeight = () => {
        const topMenuWrapper = document.querySelector('.top-menu-wrapper');
        return topMenuWrapper ? topMenuWrapper.offsetHeight : 0;
    };

    // Function to scroll to section with proper offset
    const scrollToSection = (term) => {
        const section = document.querySelector(`.single-category-wrapper[data-term="${term}"]`);
        if (section) {
            userInitiatedScroll = false;
            const headerHeight = getStickyHeaderHeight();
            const targetPosition = getOffset(section) - headerHeight;
            
            window.scrollTo({
                top: targetPosition,
                behavior: 'smooth'
            });

            setTimeout(() => {
                userInitiatedScroll = true;
            }, 1000);
        }
    };

    // Function to update tab indicator position
    const updateTabIndicator = (activeTab) => {
        if (!activeTab || !tabIndicator) return;

        // Get the container's left position
        const containerLeft = topMenuNav.getBoundingClientRect().left;

        // Get the active tab's left position relative to the viewport
        const activeTabLeft = activeTab.getBoundingClientRect().left;

        // Calculate tabLeft relative to the container
        const tabLeft = activeTabLeft - containerLeft;

        // Get the active tab's width
        const tabWidth = activeTab.offsetWidth;

        // Apply styles to the tab indicator
        tabIndicator.style.width = `${tabWidth}px`;
        tabIndicator.style.transform = `translateX(${tabLeft}px)`;
    };

    // Function to smoothly scroll the menu to the active tab
    const scrollToTab = (activeTab) => {
        if (!activeTab) return;

        const menuRect = topMenuNav.getBoundingClientRect();
        const tabRect = activeTab.getBoundingClientRect();
        
        // Calculate the desired scroll position to center the tab
        const desiredScrollLeft = activeTab.offsetLeft - (menuRect.width - activeTab.offsetWidth) / 2;
        
        topMenuNav.scrollTo({
            left: desiredScrollLeft,
            behavior: 'smooth'
        });
    };

    // Function to update active tabs and indicator
    const setActiveTab = (term) => {
        // Update top menu items
        let activeTab = null;
        topMenuItems.forEach(item => {
            const isActive = item.dataset.term === term;
            item.classList.toggle('active', isActive);
            if (isActive) activeTab = item;
        });

        // Update sidebar items
        sidebarMenuItems.forEach(item => {
            item.classList.toggle('side-active', item.dataset.term === term);
        });

        if (activeTab) {
            // Update indicator position
            updateTabIndicator(activeTab);
            // Scroll active tab into view
            scrollToTab(activeTab);
        }
    };

    // Function to determine which section is currently in view
    const getCurrentSection = () => {
        const headerHeight = getStickyHeaderHeight();
        const scrollPosition = window.scrollY + headerHeight + 5; // Adjust for header offset
        const viewportHeight = window.innerHeight;
        const pageHeight = document.documentElement.scrollHeight;
    
        let currentSection = null;
    
        sections.forEach((section, index) => {
            const sectionTop = getOffset(section);
            const sectionBottom = sectionTop + section.offsetHeight;
    
            // Special handling for the last section
            if (index === sections.length - 1) {
                if (window.scrollY + viewportHeight >= pageHeight - 1 || scrollPosition >= sectionTop) {
                    currentSection = section;
                }
            } else if (scrollPosition >= sectionTop && scrollPosition < sectionBottom) {
                currentSection = section;
            }
        });
    
        return currentSection;
    };
    
    

    // Debounced scroll handler
    let scrollTimeout;
    const handleScroll = () => {
        if (userInitiatedScroll) {
            clearTimeout(scrollTimeout);
            scrollTimeout = setTimeout(() => {
                const currentSection = getCurrentSection();
                if (currentSection) {
                    setActiveTab(currentSection.dataset.term);
                }
            }, 50);
        }
    };

    // Add click event listeners
    const handleClick = (term) => {
        setActiveTab(term);
        scrollToSection(term);
    };

    topMenuItems.forEach(item => {
        item.addEventListener('click', () => handleClick(item.dataset.term));
    });

    sidebarMenuItems.forEach(item => {
        item.addEventListener('click', () => handleClick(item.dataset.term));
    });

    // Handle horizontal scroll on the menu
    topMenuNav.addEventListener('scroll', () => {
        const activeTab = document.querySelector('.top-menu-nav li.active');
        if (activeTab) {
            updateTabIndicator(activeTab);
        }
    });

    // Add scroll event listener
    window.addEventListener('scroll', handleScroll, { passive: true });

    // Initialize active tab based on current position
    const currentSection = getCurrentSection();
    if (currentSection) {
        setActiveTab(currentSection.dataset.term);
    } else {
        // Highlight the first tab by default
        const firstTab = topMenuItems[0];
        if (firstTab) {
            setActiveTab(firstTab.dataset.term);
            updateTabIndicator(firstTab);
        }
    }


    // function to toggle sidebar
    const toggleSidebar = (visible) => {
        if(!breakpoint.matches){
            sidebarMenuItemsWrapper.style.display = visible ? 'block' : 'none';
        }
    };

    // Handle the hamburger menu
    sidebarMenuButton.addEventListener('click', () => {
        isVisible =  sidebarMenuItemsWrapper.style.display === 'block';
        toggleSidebar(!isVisible);
    });

    // Handle sidebar menu on mobile
    sidebarMenuItems.forEach(item => {
        item.addEventListener('click',() => {
            handleClick(item.dataset.term);
            toggleSidebar(false);
        })
    });

    // handle the dismiss button
    sidebarMenuDismissBtn.addEventListener('click' , () => {
        toggleSidebar(false);
    });


    // handle the desktop view
    const checkBreakpoint = () =>{
        if(breakpoint.matches){
            sidebarMenuButton.style.display = 'none';
            sidebarMenuItemsWrapper.style.display = 'block';
        }
        else{
            sidebarMenuButton.style.display = 'block';
        }
    };
    
    checkBreakpoint();
    breakpoint.addEventListener('change' , checkBreakpoint);
});


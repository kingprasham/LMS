/**
 * Expandable Navbar Component
 * A vanilla JavaScript implementation of expandable tabs navigation
 */

class ExpandableNavbar {
    constructor(container, options = {}) {
        this.container = container;
        this.options = {
            tabs: options.tabs || [],
            activeColor: options.activeColor || '#a435f0',
            onChange: options.onChange || null,
            mobileBreakpoint: options.mobileBreakpoint || 768
        };
        
        this.selectedIndex = null;
        this.init();
        this.attachEventListeners();
        this.handleResize();
    }

    init() {
        this.render();
    }

    render() {
        const tabsHTML = this.options.tabs.map((tab, index) => {
            if (tab.type === 'separator') {
                return `<div class="nav-separator" aria-hidden="true"></div>`;
            }

            return `
                <button 
                    class="nav-tab-btn" 
                    data-index="${index}"
                    aria-label="${tab.title}"
                >
                    <i class="bi bi-${tab.icon}"></i>
                    <span class="nav-tab-text">${tab.title}</span>
                </button>
            `;
        }).join('');

        this.container.innerHTML = `
            <div class="expandable-navbar">
                <div class="navbar-left">
                    <a class="sasai-link" href="index.html">
                        <div class="sasai-logo">
                            <span class="logo-text">SAS<span class="logo-ai">-AI</span></span>
                        </div>
                    </a>
                </div>

                <div class="navbar-center">
                    <div class="expandable-tabs">
                        ${tabsHTML}
                    </div>
                </div>

                <div class="navbar-right">
                    <div class="searchbar">
                        <button><i class="bi bi-search"></i></button>
                        <input type="text" placeholder="Search for AI courses">
                    </div>

                    <a href="pages/cart.html">
                        <button class="cart-btn">
                            <i class="bi bi-cart3"></i>
                            <span class="badge" id="cart-count">0</span>
                        </button>
                    </a>

                    <button class="cart-btn" id="profile-btn" style="display:none;">
                        <i class="bi bi-person-circle" style="font-size: 1.5rem;"></i>
                    </button>

                    <a href="pages/login.html" id="login-link">
                        <button class="login-btn">Log in</button>
                    </a>

                    <button class="mobile-menu-toggle">
                        <i class="bi bi-list"></i>
                    </button>
                </div>
            </div>

            <div class="mobile-menu">
                <div class="mobile-menu-content">
                    ${this.options.tabs.map((tab, index) => {
                        if (tab.type === 'separator') return '<div class="mobile-separator"></div>';
                        return `
                            <button class="mobile-menu-item" data-index="${index}">
                                <i class="bi bi-${tab.icon}"></i>
                                <span>${tab.title}</span>
                            </button>
                        `;
                    }).join('')}
                </div>
            </div>
        `;
    }

    attachEventListeners() {
        // Tab click handlers
        const tabButtons = this.container.querySelectorAll('.nav-tab-btn');
        tabButtons.forEach(btn => {
            btn.addEventListener('click', (e) => {
                const index = parseInt(btn.dataset.index);
                this.selectTab(index);
            });
        });

        // Mobile menu toggle
        const mobileToggle = this.container.querySelector('.mobile-menu-toggle');
        const mobileMenu = this.container.querySelector('.mobile-menu');
        
        mobileToggle?.addEventListener('click', () => {
            mobileMenu.classList.toggle('active');
            const icon = mobileToggle.querySelector('i');
            icon.className = mobileMenu.classList.contains('active') ? 'bi bi-x' : 'bi bi-list';
        });

        // Mobile menu items
        const mobileItems = this.container.querySelectorAll('.mobile-menu-item');
        mobileItems.forEach(item => {
            item.addEventListener('click', () => {
                const index = parseInt(item.dataset.index);
                this.selectTab(index);
                mobileMenu.classList.remove('active');
                mobileToggle.querySelector('i').className = 'bi bi-list';
            });
        });

        // Click outside to close tabs
        document.addEventListener('click', (e) => {
            if (!this.container.contains(e.target)) {
                this.deselectAll();
            }
        });

        // Handle window resize
        window.addEventListener('resize', () => this.handleResize());
    }

    selectTab(index) {
        // Deselect all first
        const allTabs = this.container.querySelectorAll('.nav-tab-btn');
        allTabs.forEach(tab => {
            tab.classList.remove('active');
            const text = tab.querySelector('.nav-tab-text');
            if (text) text.classList.remove('show');
        });

        // Select the clicked tab
        const selectedTab = this.container.querySelector(`[data-index="${index}"]`);
        if (selectedTab && !selectedTab.classList.contains('nav-separator')) {
            selectedTab.classList.add('active');
            const text = selectedTab.querySelector('.nav-tab-text');
            if (text) {
                setTimeout(() => text.classList.add('show'), 10);
            }
            this.selectedIndex = index;
            
            // Trigger callback
            if (this.options.onChange) {
                this.options.onChange(index);
            }
        }
    }

    deselectAll() {
        const allTabs = this.container.querySelectorAll('.nav-tab-btn');
        allTabs.forEach(tab => {
            tab.classList.remove('active');
            const text = tab.querySelector('.nav-tab-text');
            if (text) text.classList.remove('show');
        });
        this.selectedIndex = null;
        
        if (this.options.onChange) {
            this.options.onChange(null);
        }
    }

    handleResize() {
        const mobileMenu = this.container.querySelector('.mobile-menu');
        if (window.innerWidth > this.options.mobileBreakpoint) {
            mobileMenu?.classList.remove('active');
            const toggle = this.container.querySelector('.mobile-menu-toggle i');
            if (toggle) toggle.className = 'bi bi-list';
        }
    }
}

// Export for use
if (typeof module !== 'undefined' && module.exports) {
    module.exports = ExpandableNavbar;
}

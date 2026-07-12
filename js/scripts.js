/*!
 * SMALKIS - Custom Scripts
 * Extended from Start Bootstrap - SB Admin v7.0.7
 */

window.addEventListener('DOMContentLoaded', event => {

    // ─── 1. Sidebar Toggle (Persist state) ────────────────────────────────────
    const sidebarToggle = document.body.querySelector('#sidebarToggle');
    if (sidebarToggle) {
        if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
            document.body.classList.toggle('sb-sidenav-toggled');
        }
        sidebarToggle.addEventListener('click', event => {
            event.preventDefault();
            document.body.classList.toggle('sb-sidenav-toggled');
            localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
        });
    }

    // ─── 2. Sidebar Scroll Persistence ────────────────────────────────────────
    // Target the correct scrollable element as defined in styles.css
    const sidenavMenu = document.querySelector('#layoutSidenav_nav .sb-sidenav-menu');
    if (sidenavMenu) {
        // Restore scroll position saved previously
        const savedScroll = localStorage.getItem('sb|sidebar-scroll');
        if (savedScroll !== null) {
            sidenavMenu.scrollTop = parseInt(savedScroll, 10);
        }

        // Save scroll position whenever user scrolls
        sidenavMenu.addEventListener('scroll', () => {
            localStorage.setItem('sb|sidebar-scroll', sidenavMenu.scrollTop);
        });

        // Save scroll position before navigating to another page
        sidenavMenu.querySelectorAll('a[href]').forEach(link => {
            link.addEventListener('mousedown', () => {
                localStorage.setItem('sb|sidebar-scroll', sidenavMenu.scrollTop);
            });
        });

        // ─── 3. Auto-scroll to active link ────────────────────────────────────
        // If the active link is below the visible area, scroll it into view
        const activeLink = sidenavMenu.querySelector('.nav-link.active');
        if (activeLink && savedScroll === null) {
            // Only auto-scroll if user hasn't manually scrolled before
            activeLink.scrollIntoView({ block: 'center', behavior: 'auto' });
        }
    }

    // ─── 4. Active link highlight fallback ────────────────────────────────────
    // Ensures active state even for pages the PHP $current_page doesn't catch
    const currentPage = window.location.pathname.split('/').pop() || 'dashboard.php';
    document.querySelectorAll('#layoutSidenav_nav .nav-link').forEach(link => {
        const href = (link.getAttribute('href') || '').split('?')[0]; // strip query params
        if (href && href === currentPage && !link.classList.contains('active')) {
            link.classList.add('active');
        }
    });

});

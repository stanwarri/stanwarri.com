import './bootstrap';

// Dark mode functionality
document.addEventListener('DOMContentLoaded', function() {
    // Initialize theme from localStorage or system preference
    const getStoredTheme = () => localStorage.getItem('theme');
    const getSystemTheme = () => window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
    const getPreferredTheme = () => getStoredTheme() || getSystemTheme();

    // Set theme function
    const setTheme = (theme) => {
        if (theme === 'dark') {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
        localStorage.setItem('theme', theme);
    };

    // Initialize theme on page load
    setTheme(getPreferredTheme());

    // Add click event listener to dark mode toggle button
    const themeToggle = document.querySelector('button[aria-label*="theme"]');
    if (themeToggle) {
        themeToggle.addEventListener('click', () => {
            const currentTheme = document.documentElement.classList.contains('dark') ? 'dark' : 'light';
            const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
            setTheme(newTheme);
            
            // Update aria-label for accessibility
            themeToggle.setAttribute('aria-label', 
                newTheme === 'dark' ? 'Switch to light theme' : 'Switch to dark theme'
            );
        });
    }

    // Listen for system theme changes
    window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', (e) => {
        if (!getStoredTheme()) {
            setTheme(e.matches ? 'dark' : 'light');
        }
    });
});

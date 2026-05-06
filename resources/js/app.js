import './bootstrap';

const root = document.documentElement;
const themeElements = () => ({
  button: document.getElementById('theme-toggle'),
  darkIcon: document.getElementById('theme-toggle-dark-icon'),
  lightIcon: document.getElementById('theme-toggle-light-icon'),
});

const applyTheme = (theme) => {
  const { darkIcon, lightIcon } = themeElements();
  const isDark = theme === 'dark';

  root.classList.toggle('dark', isDark);

  if (isDark) {
    darkIcon?.classList.add('hidden');
    lightIcon?.classList.remove('hidden');
  } else {
    lightIcon?.classList.add('hidden');
    darkIcon?.classList.remove('hidden');
  }
};

const initTheme = () => {
  const stored = localStorage.getItem('theme');
  const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
  const theme = stored || (prefersDark ? 'dark' : 'light');
  applyTheme(theme);
};

document.addEventListener('DOMContentLoaded', () => {
  initTheme();
  const { button } = themeElements();

  if (!button) {
    return;
  }

  button.addEventListener('click', () => {
    const isDark = !root.classList.contains('dark');
    localStorage.setItem('theme', isDark ? 'dark' : 'light');
    applyTheme(isDark ? 'dark' : 'light');
  });
});

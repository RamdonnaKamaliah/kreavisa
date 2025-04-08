
  document.addEventListener('DOMContentLoaded', function () {
    const icon = document.getElementById('darkIcon');
    const root = document.documentElement;
    const toggle = document.getElementById('toggleDark');

    function updateIcon() {
      const current = root.classList.contains('dark') ? 'sun' : 'moon';
      icon.setAttribute('data-lucide', current);
      lucide.createIcons(); // re-render iconnya
    }

    // Cek localStorage
    if (localStorage.getItem('theme') === 'dark') {
      root.classList.add('dark');
    } else {
      root.classList.remove('dark');
    }
    updateIcon();

    toggle.addEventListener('click', () => {
      root.classList.toggle('dark');
      const themeNow = root.classList.contains('dark') ? 'dark' : 'light';
      localStorage.setItem('theme', themeNow);
      updateIcon();
    });
  });


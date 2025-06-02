

    // Aplica dark mode se salvo no localStorage
    if (localStorage.getItem('theme') === 'dark') {
      document.documentElement.classList.add('dark');
    }
    
    function toggleTheme() {
      const html = document.documentElement;
      html.classList.toggle('dark');
      const isDark = html.classList.contains('dark');
      localStorage.setItem('theme', isDark ? 'dark' : 'light');
    }

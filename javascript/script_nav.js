//menu toggle
const btn = document.getElementById('menu-btn');
const menu = document.getElementById('mobile-menu');
btn.addEventListener('click', () => {
  menu.classList.toggle('hidden');
});

//select menu
document.getElementById('taskType').addEventListener('change', function() {
  const selectedUrl = this.value;
  if (selectedUrl) {
    window.location.href = selectedUrl;
  }
});

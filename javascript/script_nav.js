
document.getElementById('taskType').addEventListener('change', function() {
  const selectedUrl = this.value;
  if (selectedUrl) {
    window.location.href = selectedUrl;
  }
});

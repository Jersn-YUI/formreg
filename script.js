document.addEventListener('DOMContentLoaded', function() {
  const form = document.getElementById('attendanceForm');
  const modal = document.getElementById('successModal');
  const closeModal = document.getElementById('closeModal');

  form.addEventListener('submit', function(e) {
      e.preventDefault();
      
      const formData = new FormData(form);

      fetch('process.php', {
          method: 'POST',
          body: formData
      })
      .then(response => response.json())
      .then(data => {
          if (data.success) {
              modal.classList.add('active');
              document.body.style.overflow = 'hidden';
              form.reset(); // Clear form fields
          }
      })
      .catch(error => console.error('Error:', error));
  });

  closeModal.addEventListener('click', function() {
      modal.classList.remove('active');
      document.body.style.overflow = 'auto';
  });

  modal.addEventListener('click', function(e) {
      if (e.target === modal) {
          modal.classList.remove('active');
          document.body.style.overflow = 'auto';
      }
  });
});

document.getElementById('section').addEventListener('change', function() {
  var section = this.value;
  var departmentDropdown = document.getElementById('department');
  var subjectLabel = document.getElementById('subjectLabel');
  var subjectInput = document.getElementById('subject');

  if (section === "LIBRARY SECTION") {
    departmentDropdown.disabled = true;
    subjectLabel.style.display = 'block';
    subjectInput.style.display = 'block';
  } else {
    departmentDropdown.disabled = false;
    subjectLabel.style.display = 'none';
    subjectInput.style.display = 'none';
  }
});

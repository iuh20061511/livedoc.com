// ADD user chọn bác sĩ show phòng ban

function toggleOptions() {
    var radio = document.querySelector('input[name="role"]:checked');
    var optionsSelect = document.getElementById('department');
  
    if (radio && radio.value === '4') {
      optionsSelect.style.display = 'block';
    } else {
      optionsSelect.style.display = 'none';
    }
  }
  
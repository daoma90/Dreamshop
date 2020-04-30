function customAlert(message, mode) {
  if (mode == 'confirm') {
    let alert = `<div class="alert">
      <p class="alert__msg"></p>
      <button class="alert__btn">Cancel</button>
      <button class="alert__btn">Confirm</button>
    </div>`;
  } else {
    let alert = `<div class="alert">
        <p class="alert__msg">${message}</p>
        <button onclick='removeAlert()' class="alert__btn">OK</button>
    </div>`;
    document.querySelector('body').prepend(alert);
  }
}

function removeAlert() {
  document.querySelector('.alert').remove();
}
function reTrue() {
  return true;
}

function customAlert(message, mode, cancelCb, confirmCb) {
  if (mode == 'confirm') {
    let el = document.createElement('div');
    let alert = `
    <div class="alert">
      <div class="alert-box">
        <p class="alert__msg">${message}</p>
        <button id='cancel' class="alert__btn">Cancel</button>
        <button id='confirm' class="alert__btn">Confirm</button>
      </div>
    </div>
    `;
    document.querySelector('body').prepend(el);
    el.innerHTML = alert;
    document.querySelector('#cancel').addEventListener('click', function () {
      removeAlert();
      cancelCb();
    });
    document.querySelector('#confirm').addEventListener('click', function () {
      removeAlert();
      confirmCb();
    });
  } else {
    let alert = `
    <div class="alert">
        <div class="alert-box">
            <p class="alert__msg">${message}</p>
            <button onclick='removeAlert()' class="alert__btn">OK</button>
        </div>
    </div>`;
    document.querySelector('body').prepend(alert);
  }
}

function removeAlert() {
  document.querySelector('.alert').remove();
}
function returner(val) {
  console.log(val);
  return val;
}

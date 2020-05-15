function customAlert(message, mode, cancelCb, confirmCb) {
  let el = document.createElement('div');
  if (mode == 'confirm') {
    let alert = `
    <div class="alert">
      <div class="alert-box">
        <p class="alert__msg">${message}</p>
        <div class='btn-wrap'>
          <button id='cancel' class="alert__btn cancel">Cancel</button>
          <button id='confirm' class="alert__btn confirm">Confirm</button>
        </div>
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
  } else if (mode == 'alert') {
    let alert = `
    <div class="alert">
        <div class="alert-box">
            <p class="alert__msg">${message}</p>
            <div class='btn-wrap'>
            <button id="ok" class="alert__btn">OK</button>
            </div>
        </div>
    </div>`;
    document.querySelector('body').prepend(el);
    el.innerHTML = alert;
    document.querySelector('#ok').addEventListener('click', function () {
      removeAlert();
    });
  }
}

function removeAlert() {
  document.querySelector('.alert').remove();
}
function returner(val) {
  console.log(val);
  return val;
}

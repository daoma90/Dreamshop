function updateOrder(id, event) {
  const status = event.target.options[event.target.selectedIndex].value;
  let request = new XMLHttpRequest();
  request.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      window.location.reload();
    }
  };
  request.open(
    'POST',
    '../order/orderUpdate.php?status=' + status + '&id=' + id,
    true
  );
  request.send();
}

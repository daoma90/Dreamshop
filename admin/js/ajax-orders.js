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
if (!String.prototype.includes) {
  String.prototype.includes = function (search, start) {
    'use strict';

    if (search instanceof RegExp) {
      throw TypeError('first argument must not be a RegExp');
    }
    if (start === undefined) {
      start = 0;
    }
    return this.indexOf(search, start) !== -1;
  };
}
function convertDate(d) {
  if (d.includes('-')) {
    var p = d.split('-');
    return +(p[2] + p[1] + p[0]);
  } else {
    return d;
  }
}

function sortTable(n, table) {
  var table,
    rows,
    switching,
    i,
    x,
    y,
    shouldSwitch,
    dir,
    switchcount = 0;
  table = document.getElementById(table);
  switching = true;
  // Set the sorting direction to ascending:
  dir = 'asc';
  /* Make a loop that will continue until
  no switching has been done: */
  while (switching) {
    // Start by saying: no switching is done:
    switching = false;
    rows = table.rows;
    /* Loop through all table rows (except the
    first, which contains table headers): */
    for (i = 1; i < rows.length - 1; i++) {
      // Start by saying there should be no switching:
      shouldSwitch = false;
      /* Get the two elements you want to compare,
      one from current row and one from the next: */

      x = convertDate(rows[i].getElementsByTagName('TD')[n].textContent);

      y = convertDate(rows[i + 1].getElementsByTagName('TD')[n].textContent);

      /* Check if the two rows should switch place,
      based on the direction, asc or desc: */

      if (dir == 'asc') {
        if (Number(x) > Number(y)) {
          // If so, mark as a switch and break the loop:
          shouldSwitch = true;
          break;
        }
      } else if (dir == 'desc') {
        if (Number(x) < Number(y)) {
          // If so, mark as a switch and break the loop:
          shouldSwitch = true;
          break;
        }
      }
    }
    if (shouldSwitch) {
      /* If a switch has been marked, make the switch
      and mark that a switch has been done: */
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
      // Each time a switch is done, increase this count by 1:
      switchcount++;
    } else {
      /* If no switching has been done AND the direction is "asc",
      set the direction to "desc" and run the while loop again. */
      if (switchcount == 0 && dir == 'asc') {
        dir = 'desc';
        switching = true;
      }
    }
  }
}

function sortTableStatus(n, table) {
  var table,
    rows,
    switching,
    i,
    x,
    y,
    shouldSwitch,
    dir,
    switchcount = 0;
  table = document.getElementById(table);
  switching = true;
  //Set the sorting direction to ascending:
  dir = 'asc';
  /*Make a loop that will continue until
  no switching has been done:*/
  while (switching) {
    //start by saying: no switching is done:
    switching = false;
    rows = table.rows;
    /*Loop through all table rows (except the
    first, which contains table headers):*/
    for (i = 1; i < rows.length - 1; i++) {
      //start by saying there should be no switching:
      shouldSwitch = false;
      /*Get the two elements you want to compare,
      one from current row and one from the next:*/
      const xVal = rows[i].getElementsByTagName('TD')[n].firstChild;
      const yVal = rows[i + 1].getElementsByTagName('TD')[n].firstChild;
      const x = xVal.options[xVal.selectedIndex].value;
      const y = yVal.options[yVal.selectedIndex].value;
      /*check if the two rows should switch place,
      based on the direction, asc or desc:*/
      if (dir == 'asc') {
        if (x.toLowerCase() > y.toLowerCase()) {
          //if so, mark as a switch and break the loop:
          shouldSwitch = true;
          break;
        }
      } else if (dir == 'desc') {
        if (x.toLowerCase() < y.toLowerCase()) {
          //if so, mark as a switch and break the loop:
          shouldSwitch = true;
          break;
        }
      }
    }
    if (shouldSwitch) {
      /*If a switch has been marked, make the switch
      and mark that a switch has been done:*/
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
      //Each time a switch is done, increase this count by 1:
      switchcount++;
    } else {
      /*If no switching has been done AND the direction is "asc",
      set the direction to "desc" and run the while loop again.*/
      if (switchcount == 0 && dir == 'asc') {
        dir = 'desc';
        switching = true;
      }
    }
  }
}
function showRelevantStatus(e) {
  const statusToShow = e.target.textContent.toLowerCase();
  const items = document.querySelectorAll('.display-status');
  items.forEach(function (item) {
    item.style = 'display: table-row';
    if (statusToShow === 'all') {
      item.style = 'display: table-row';
    } else if (!item.className.includes(statusToShow)) {
      item.style = 'display: none';
    }
  });
}
function searchFilter(e) {
  const items = document.querySelectorAll('.city');
  items.forEach(function (item) {
    if (item.textContent.toLowerCase().includes(e.target.value.toLowerCase())) {
      item.parentElement.style = 'display: table-row';
    } else {
      item.parentElement.style = 'display: none';
    }
  });
}
function test(id) {
  window.location = './order.php?id=' + id;
}

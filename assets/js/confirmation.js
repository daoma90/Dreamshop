for (var i = 0; i < localStorage.length; i++) {
  let key = localStorage.getItem(localStorage.key(i));
  let value = JSON.parse(key);

  for (let i = 0; i < value.length; i++) {
    const elm = value[i];

    let wrapper = document.querySelector('.wrapper');
    // wrapper.innerHTML += `
    // <div>${elm.name}</div>
    // <div>${elm.price}</div>
    // <div>${elm.quantity}</div>
    // <div> <img src="../FE-Project-Shop/admin/images/${elm.image}"></div>`;
    wrapper.innerHTML += ' \n    <div>'
      .concat(elm.name, '</div>\n    <div>')
      .concat(elm.price, '</div>\n    <div>')
      .concat(
        elm.quantity,
        '</div>\n    <div> <img src="../FE-Project-Shop/admin/images/'
      )
      .concat(elm.image, '"></div>');
  }
}
localStorage.clear();

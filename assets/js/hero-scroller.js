document.addEventListener('DOMContentLoaded', function () {
  refactorProjScrollWidth();
});

let left = document.querySelector('#left');
let right = document.querySelector('#right');
let scroller = document.querySelector('.scroller');
let startWidth = document.documentElement.clientWidth;
let width = 0;

right.addEventListener('click', function () {
  console.log(startWidth);
  width = document.querySelector('.scroller').scrollLeft;
  if (width / startWidth === Math.ceil(width / startWidth)) {
    scroller.scrollTo((width += startWidth), 0);
  } else {
    scroller.scrollTo(Math.ceil(width / startWidth) * startWidth, 0);
  }
});
left.addEventListener('click', function () {
  width = document.querySelector('.scroller').scrollLeft;
  if (width / startWidth === Math.floor(width / startWidth)) {
    scroller.scrollTo((width -= startWidth), 0);
  } else {
    scroller.scrollTo(Math.floor(width / startWidth) * startWidth, 0);
  }
});

window.addEventListener('resize', function () {
  refactorProjScrollWidth();
});

function refactorProjScrollWidth() {
  startWidth = document.documentElement.clientWidth;

  if (!window.document.documentMode) {
    width = document.querySelector('.scroller').scrollLeft;
    scroller.scrollTo(Math.floor(width / startWidth) * startWidth, 0);
    width = 0;
  }
}

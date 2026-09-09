//employee-user login
const btns = document.querySelectorAll('.pagebtn');
const frames = document.querySelectorAll('.frames');

// Every panel was loaded once, at page load, into its own iframe -- but
// they all read the same MySQL tables (e.g. confirming a booking in Room
// Booking inserts a row into `payment`), so switching to the Payments tab
// kept showing whatever it looked like on page load until a full browser
// refresh. Reload the target iframe's own src each time its tab is
// clicked so it always reflects the latest data.
frames.forEach((frame) => {
  frame.dataset.src = frame.getAttribute('src');
});

var frameActive = function (manual) {
  btns.forEach((btn) => {
    btn.classList.remove('active');
  });
  frames.forEach((slide) => {
    slide.classList.remove('active');
  });

  btns[manual].classList.add('active');
  const frame = frames[manual];
  frame.classList.add('active');
  frame.src = frame.dataset.src;
};

btns.forEach((btn, i) => {
  btn.addEventListener('click', () => {
    frameActive(i);
  });
});
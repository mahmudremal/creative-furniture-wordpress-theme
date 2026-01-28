import Toastify from "toastify-js";
import "toastify-js/src/toastify.css";

class Toast {
  success(text, options = {}) {
    Toastify({
      text,
      duration: 3000,
      gravity: "bottom",
      position: "right",
      stopOnFocus: true,
      style: {
        background: "#10b981",
        borderRadius: "8px",
      },
      escapeMarkup: false,
      ...options,
    }).showToast();
  }

  error(text, options = {}) {
    Toastify({
      text,
      duration: 3000,
      gravity: "bottom",
      position: "right",
      stopOnFocus: true,
      style: {
        background: "#ef4444",
        borderRadius: "8px",
      },
      escapeMarkup: false,
      ...options,
    }).showToast();
  }
}

export const toast = new Toast();

// Toastify({
//   text: "This is a toast",
//   duration: 3000,
//   destination: "https://github.com/apvarun/toastify-js",
//   newWindow: true,
//   close: true,
//   gravity: "top", // `top` or `bottom`
//   position: "left", // `left`, `center` or `right`
//   stopOnFocus: true, // Prevents dismissing of toast on hover
//   style: {
//     background: "linear-gradient(to right, #00b09b, #96c93d)",
//   },
// offset: {
//     x: 50, // horizontal axis - can be a number or a string indicating unity. eg: '2em'
//     y: 10 // vertical axis - can be a number or a string indicating unity. eg: '2em'
//   },
//   onClick: function(){} // Callback after click
// }).showToast();

//

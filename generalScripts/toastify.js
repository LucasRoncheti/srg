function toastifyMessage(message, error) {
  let isError = error === "error";
  if (isError) {
    Toastify({
      text: message,
      duration: 3000,
      gravity: "bottom", // top or bottom
      position: "right", // left, center or right
      backgroundColor: "#f03d17", // vermelho
    }).showToast();
  } else {
    Toastify({
      text: message,
      duration: 3000,
      gravity: "bottom", // top or bottom
      position: "right", // left, center or right
      backgroundColor: "#22c55e", // verde Tailwind
    }).showToast();
  }
}

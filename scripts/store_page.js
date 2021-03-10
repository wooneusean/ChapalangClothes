const searchBar = document.getElementById("search-bar");
const searchBarButton = document.getElementById("search-bar-button");
const shoppingCart = document.querySelector(".top-bar-shopping-cart");
const shoppingCartPopup = document.querySelector(".shopping-cart-popup");
const username = document.querySelector(".top-bar-username");
const usernamePopup = document.querySelector(".top-bar-username-dropdown");

searchBar.addEventListener("keyup", (event) => {
  if (event.keyCode === 13) {
    // Cancel the default action, if needed
    event.preventDefault();
    // Trigger the button element with a click
    searchBarButton.click();
  }
});

const Search = () => {
  var q = document.getElementById("search-bar").value.trim();
  window.location.href = encodeURI("search.php?q=" + q);
}

shoppingCart.addEventListener("mouseenter", (e) => {
  shoppingCartPopup.classList.remove("invisible");
})

shoppingCart.addEventListener("mouseleave", (e) => {
  shoppingCartPopup.classList.add("invisible");
})

username.addEventListener("mouseenter", (e) => {
  usernamePopup.classList.remove("invisible");
})

username.addEventListener("mouseleave", (e) => {
  usernamePopup.classList.add("invisible");
})
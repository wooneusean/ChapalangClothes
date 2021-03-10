const RemoveFromCart = (itemId, inCart = false) => {
  // do some jquery shet here

  $.get("shopping_cart.php", { productId: itemId, action: "remove" }, (data, textStatus, jqXHR) => {
    if (inCart) {
      location.reload();
    } else {
      $("#shopping-cart-popup").load("get_cart.php");
      $(".cart-notification").text(parseInt($(".cart-notification").text()) - 1);
    }
  })
}

const AddToCart = (itemId) => {
  // do some jquery shet here
  const quantity = parseInt(document.querySelector("#product-quantity").textContent);

  $.get("shopping_cart.php", { productId: itemId, quantity: quantity, action: "add" }, (data, textStatus, jqXHR) => {
    $("#modal-text").text("Item has been added to cart!");
    ShowModal();
    $("#shopping-cart-popup").load("get_cart.php");
    $(".cart-notification").text(parseInt($(".cart-notification").text()) + 1);
  }).fail(() => {
    $("#modal-text").text("Item failed to be added to cart!");
    ShowModal();
  })
};
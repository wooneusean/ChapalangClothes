const smallProductImageContainer = document.querySelector(".product-image-list");
const smallProductImages = Array.from(smallProductImageContainer.children);
const productImage = document.querySelector("div.product-image > img");

smallProductImageContainer.addEventListener("mouseover", (e) => {
  const targetImageContainer = e.target.closest("div.product-image-small");

  if (!targetImageContainer) return;

  const targetImage = targetImageContainer.querySelector("img");

  if (!targetImage) return;

  smallProductImages.forEach((element) => {
    element.classList.remove("active");
  });
  targetImageContainer.classList.add("active");

  productImage.setAttribute("src", targetImage.getAttribute("src"));
});

const ProductQuantity = (amount) => {
  const quantity = document.querySelector("#product-quantity");
  const instock = document.querySelector("#product-instock");
  var currentQuantity = parseInt(quantity.textContent);
  var currentInstock = parseInt(instock.textContent);
  if (currentQuantity + amount >= 1 && currentQuantity + amount <= currentInstock) {
    quantity.textContent = currentQuantity + amount;
  }
};

$("#add-review").click(() => {
  $("#product-review-form").toggleClass("h-0");
});

var allStars;
var $reviewRatingInput;

const UpdateStars = (rating) => {
  allStars.forEach(el => {
    el.classList.remove("active");
    el.textContent = "star_outline";
  });

  for (let i = 0; i <= rating - 1; i++) {
    allStars[i].classList.add("active");
    allStars[i].textContent = "star";
  }
}

const Initialize = () => {
  if (document.querySelector(".review-rating-stars") != null) {
    allStars = Array.from(document.querySelector(".review-rating-stars").children);
    $reviewRatingInput = $("#review-rating");
    if ($reviewRatingInput != 0) {
      UpdateStars($reviewRatingInput.val());
    }
  }
}

Initialize();

$(".review-rating-stars").mouseleave(e => {
  if ($reviewRatingInput.val() == "0") {
    UpdateStars(0);
  }
})

$(".review-rating-stars > .material-icons").click(e => {
  const ratingValue = allStars.findIndex(el => el === e.target) + 1;
  $reviewRatingInput.val(ratingValue);
  $(".review-rating-stars").removeClass('invalid');
  UpdateStars(ratingValue);
});

$(".review-rating-stars > .material-icons").hover(e => {
  if ($reviewRatingInput.val() == "0") {
    const childIndex = allStars.findIndex(el => el === e.target);
    UpdateStars(childIndex + 1);
  }
});

const ValidateReview = () => {
  if (!$("#review-title").val()) {
    $("#review-title").addClass("invalid");
  } else {
    $("#review-title").removeClass("invalid");
  }
  if (!$("#review-body").val()) {
    $("#review-body").addClass("invalid");
  } else {
    $("#review-body").removeClass("invalid");
  }
}

$("#review-body").change(e => {
  ValidateReview();
})

$("#review-title").change(e => {
  ValidateReview();
})

$("#product-review-form").submit(e => {
  if ($("#review-rating").val() <= 0 || !$("#review-title").val() || !$("#review-body").val()) {
    e.preventDefault();

    if ($("#review-rating").val() <= 0) {
      $(".review-rating-stars").addClass('invalid');
    }
    ValidateReview();
  }
})

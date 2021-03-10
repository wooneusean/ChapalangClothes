

// Restricts input for the given textbox to the given inputFilter function. 
// https://stackoverflow.com/questions/469357/html-text-input-allow-only-numeric-input
function setInputFilter(textbox, inputFilter) {
  [
    "input",
    "keydown",
    "keyup",
    "mousedown",
    "mouseup",
    "select",
    "contextmenu",
    "drop"
  ].forEach(function (event) {
    textbox.addEventListener(event, function () {
      if (inputFilter(this.value)) {
        this.oldValue = this.value;
        this.oldSelectionStart = this.selectionStart;
        this.oldSelectionEnd = this.selectionEnd;
      } else if (this.hasOwnProperty("oldValue")) {
        this.value = this.oldValue;
        this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
      } else {
        this.value = "";
      }
    });
  });
}

const minPriceElement = document.getElementById("min-price");
const maxPriceElement = document.getElementById("max-price");

setInputFilter(minPriceElement, function (value) {
  return /^\d*\.?\d*$/.test(value); // Allow digits and '.' only, using a RegExp
});
setInputFilter(maxPriceElement, function (value) {
  return /^\d*\.?\d*$/.test(value); // Allow digits and '.' only, using a RegExp
});

const FilterPrice = () => {
  const urlParams = new URLSearchParams(window.location.search);
  urlParams.set("min", minPriceElement.value);
  urlParams.set("max", maxPriceElement.value);
  window.location.search = urlParams.toString();
}

const FilterSearchStar = (star) => {
  const urlParams = new URLSearchParams(window.location.search);
  urlParams.set("stars", star);
  window.location.search = urlParams.toString();
}

const SortSearch = () => {
  var attribute = document.getElementById("sort-options").value;
  const urlParams = new URLSearchParams(window.location.search);
  urlParams.set("sortby", attribute);
  window.location.search = urlParams.toString();
}

const ChangeSortDirection = () => {
  var attribute = document.getElementById("sort-options").value;
  const urlParams = new URLSearchParams(window.location.search);
  urlParams.set("sortby", attribute);
  if (!urlParams.has("sort")) {
    urlParams.set("sort", "ASC");
  } else {
    if (urlParams.get("sort") == "DESC") {
      urlParams.set("sort", "ASC");
    } else {
      urlParams.set("sort", "DESC");
    }
  }
  window.location.search = urlParams.toString();
}
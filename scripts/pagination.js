const paginationLinks = document.querySelector(".pagination-links");
const paginations = Array.from(paginationLinks.children);
const leftNav = paginations[0];
const rightNav = paginations[paginations.length - 1];

const initializePagination = () => {
  const urlParams = new URLSearchParams(window.location.search);
  if (urlParams.has("page")) {
    if (parseInt(urlParams.get("page"))) {
      paginations[urlParams.get("page")].classList.add("active");
    } else {
      urlParams.set("page", 1);
      window.location.search = urlParams.toString();
    }
  } else {
    paginations[1].classList.add("active");
  }
};

initializePagination();

leftNav.addEventListener("click", () => {
  const urlParams = new URLSearchParams(window.location.search);
  if (urlParams.has("page")) {
    if (parseInt(urlParams.get("page")) > 1) {
      urlParams.set("page", parseInt(urlParams.get("page")) - 1);
      window.location.search = urlParams.toString();
    }
  }
});

rightNav.addEventListener("click", () => {
  const urlParams = new URLSearchParams(window.location.search);
  if (urlParams.has("page")) {
    if (parseInt(urlParams.get("page")) < paginations.length - 2) {
      urlParams.set("page", parseInt(urlParams.get("page")) + 1);
      window.location.search = urlParams.toString();
    }
  } else {
    urlParams.set("page", 2);
    window.location.search = urlParams.toString();
  }
});

paginationLinks.addEventListener("click", (e) => {
  if (e.target != leftNav && e.target != rightNav && paginations.includes(e.target)) {
    console.log(e.target.dataset.page);
    const urlParams = new URLSearchParams(window.location.search);
    urlParams.set("page", e.target.dataset.page);
    window.location.search = urlParams.toString();
  }
});
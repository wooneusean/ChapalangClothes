const vendorItem = document.querySelectorAll(".vendor-sidenav-item");
const x = window.location.href.split("/");
const pageHref = x[x.length - 1];

vendorItem.forEach(element => {
  if (element.getAttribute("href") == pageHref) {
    element.classList.add("active");
  }
});

const filterProducts = (name) => {
  const productCards = document.querySelectorAll(".item-card");
  const headers = document.querySelectorAll(".header-group, .approvalimgs .cultured-dark, br");
  console.log(name);
  if (name) {
    headers.forEach(e => {
      e.classList.add('hidden');
    });
    productCards.forEach(e => {
      if (!e.querySelector('.item-name').textContent.toLowerCase().includes(name.trim().toLowerCase())) {
        e.classList.add('hidden');
      } else {
        e.classList.remove('hidden');
      }
    });
  } else {
    headers.forEach(e => {
      e.classList.remove('hidden');
    });
    productCards.forEach(e => {
      e.classList.remove('hidden');
    });
  }
}
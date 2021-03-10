const employeeItem = document.querySelectorAll(".employee-sidenav-label a");
const x = window.location.href.split("/");
const pageHref = x[x.length - 1];

employeeItem.forEach(element => {
    if (element.getAttribute("href") == pageHref) {
        element.classList.add("active");
    }
});
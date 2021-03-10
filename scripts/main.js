const DismissModal = (index = 0) => {
  document.getElementsByClassName("modal")[index].classList.add("hidden");
};

const ShowModal = (index = 0) => {
  document.getElementsByClassName("modal")[index].classList.remove("hidden");
};
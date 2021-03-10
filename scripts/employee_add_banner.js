$(function () {
  const LoadImage = (e) => {
    if (e.files && e.files[0]) {
      var reader = new FileReader();
      reader.onload = function (e) {
        $('#image').attr('src', e.target.result);
      };
      reader.readAsDataURL(e.files[0]);
    }
  }

  $("#bannerimage").change((e) => {
    LoadImage(e.target);
  });

  const ValidateInput = () => {
    if (!$("#bannername").val()) {
      $("#bannername").addClass("invalid");
    } else {
      $("#bannername").removeClass("invalid");
    }

    if (!$("#bannerdesc").val()) {
      $("#bannerdesc").addClass("invalid");
    } else {
      $("#bannerdesc").removeClass("invalid");
    }
  }

  $("#bannername,#bannerdesc").on("change paste keyup", e => {
    ValidateInput();
  })
});


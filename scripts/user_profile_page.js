const HandleHash = () => {
  var anchors = Array.from(document.querySelectorAll("a.profile-menu-item"));
  anchors.forEach((element) => {
    if (element.getAttribute("href") == location.hash) {
      element.classList.add("active");
    } else {
      element.classList.remove("active");
    }
  });
};

$(function () {
  const LoadImage = (e) => {
    if (e.files && e.files[0]) {
      var reader = new FileReader();
      reader.onload = function (e) {
        $('#userImage').attr('src', e.target.result);
      };
      reader.readAsDataURL(e.files[0]);
    }
  }

  // change password validation
  const $oldPassword = $("#password");
  const $newPassword = $("#newpassword");
  const $changePasswordBtn = $("#password-submit");
  var $validOldPassword = false;
  var $validNewPassword = false;

  $oldPassword.on("change paste keyup", e => {
    passwordCheckValid();
  });
  $newPassword.on("change paste keyup", e => {
    passwordCheckValid();
  });

  const passwordCheckValid = () => {
    if (!$oldPassword.val()) {
      $validOldPassword = false;
      $oldPassword.addClass("invalid");
    } else {
      $validOldPassword = true;
      $oldPassword.removeClass("invalid");
    }
    if (!$newPassword.val()) {
      $validNewPassword = false;
      $newPassword.addClass("invalid");
    } else {
      $validNewPassword = true;
      $newPassword.removeClass("invalid");
    }

    if ($validNewPassword && $validOldPassword) {
      $changePasswordBtn.prop("disabled", false);
    } else {
      $changePasswordBtn.prop("disabled", true);
    }
  };

  // edit profile validation
  const $picture = $("#picture");
  const $email = $("#email");
  const $dob = $("#dob");
  const $address = $("#address");
  const $gender = $("#gender");
  const $profileSaveBtn = $("#profile-submit");
  var $validImage = true;
  var $validEmail = false;
  var $validDob = false;
  var $validAddress = false;
  var $validGender = false;

  $("#picture").change((e) => {
    LoadImage(e.target);
    checkValid();
  });
  $email.on("change paste keyup", e => {
    checkValid();
  });
  $gender.on("change paste keyup", e => {
    checkValid();
  });
  $dob.on("change paste keyup", e => {
    checkValid();
  });
  $address.on("change paste keyup", e => {
    checkValid();
  });
  const checkValid = () => {
    if ($picture[0].files) {
      $validImage = true;
    } else {
      $validImage = false;
    }

    if (!$address.val()) {
      $address.addClass("invalid");
      $validAddress = false;
    } else {
      $address.removeClass("invalid");
      $validAddress = true;
    }

    const $d1 = new Date($dob.val());
    const $d2 = new Date();
    if ($d1 > $d2) {
      $dob.addClass("invalid");
      $validDob = false;
    } else {
      $dob.removeClass("invalid");
      $validDob = true;
    }

    if (!$gender.val()) {
      $gender.addClass("invalid");
      $validGender = false;
    } else {
      $gender.removeClass("invalid");
      $validGender = true;
    }

    if (!/^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/i.test($email.val())) {
      $email.addClass("invalid");
      $validEmail = false;
    } else {
      $email.removeClass("invalid");
      $validEmail = true;
    }

    if ($validEmail && $validDob && $validAddress && $validGender && $validImage) {
      $profileSaveBtn.prop("disabled", false);
    } else {
      $profileSaveBtn.prop("disabled", true);
    }
  }
});


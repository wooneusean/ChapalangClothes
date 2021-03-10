const ValidateEmail = (email) => {
  if (!/^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/i.test(email)) {
    return false;
  } else {
    return true;
  }
}

const ValidateContact = () => {
  if (!$("#name").val()) {
    $("#name").addClass("invalid");
  } else {
    $("#name").removeClass("invalid");
  }
  if (!$("#email").val() || !ValidateEmail($("#email").val())) {
    $("#email").addClass("invalid");
  } else {
    $("#email").removeClass("invalid");
  }
  if (!$("#message").val()) {
    $("#message").addClass("invalid");
  } else {
    $("#message").removeClass("invalid");
  }
}

$("#name").change(e => {
  ValidateContact();
})

$("#email").change(e => {
  ValidateContact();
})

$("#message").change(e => {
  ValidateContact();
})

$("#contact-form").submit(e => {
  if (!$("#name").val() || !$("#email").val() || !$("#message").val()) {
    e.preventDefault();

    ValidateContact();
  }
})

var $inputValid = false;
const ValidateInput = () => {
  if (!$('#conversationMessage').val() ||
    ($('#conversationMessage').val().length > 1024) ||
    ($('#conversationMessage').val().length < 5)) {
    $('#conversationMessage').addClass('invalid');
    $inputValid = false;
  } else {
    $('#conversationMessage').removeClass('invalid');
    $inputValid = true;
  }
}

$('#conversationMessage').on('change paste keyup', e => {
  ValidateInput();
})

const SubmitMessage = (e) => {
  ValidateInput();
  if ($inputValid) {
    $('#messageform').submit();
  }
}
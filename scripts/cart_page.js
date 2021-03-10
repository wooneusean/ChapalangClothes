$(function () {
  const $cardno = $("#card_no");
  const $cardexp = $("#card_exp");
  const $cardsec = $("#card_secret");
  const $cardhold = $("#card_holder");
  const $sendBtn = $("#send_transaction");

  var $validCardNo = false;
  var $validCardExp = false;
  var $validCardSec = false;
  var $validCardHold = false;

  $cardno.on("change paste keyup", e => {
    if (!/^\d{16}$/g.test($cardno.val())) {
      $cardno.addClass("invalid");
      $validCardNo = false;
    } else {
      $cardno.removeClass("invalid");
      $validCardNo = true;
    }
    checkValid();
  });

  $cardexp.on("change paste keyup", e => {
    if (!/^\d{2}\/\d{2}$/g.test($cardexp.val())) {
      $cardexp.addClass("invalid");
      $validCardExp = false;
    } else {
      $cardexp.removeClass("invalid");
      $validCardExp = true;
    }
    checkValid();
  });

  $cardsec.on("change paste keyup", e => {
    if (!/^\d{3}$/g.test($cardsec.val())) {
      $cardsec.addClass("invalid");
      $validCardSec = false;
    } else {
      $cardsec.removeClass("invalid");
      $validCardSec = true;
    }
    checkValid();
  });

  $cardhold.on("change paste keyup", e => {
    if (!$cardhold.val()) {
      $cardhold.addClass("invalid");
      $validCardHold = false;
    } else {
      $cardhold.removeClass("invalid");
      $validCardHold = true;
    }
    checkValid();
  });

  const checkValid = () => {
    if ($validCardExp && $validCardHold && $validCardNo && $validCardSec) {
      $sendBtn.prop("disabled", false);
    } else {
      $sendBtn.prop("disabled", true);
    }
  }
});

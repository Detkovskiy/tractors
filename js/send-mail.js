/**
 * Created by Yura on 18.06.17.
 */

function services(){
  var name = $("#services-client-name").val();
  var phone = $("#services-client-phone").val();
  var message = $("#message-services").val();
  var error = $("#error-result").val();

  if (name == '') {
    $("#error-result__services").html("<span class='error-text'>Заполните поле - Имя</span>");
    error = setTimeout(
      function errorClear(){
        $("#error-result__services").html("");
      }, 3000);
  } else
  if (phone == '') {
    $("#error-result__services").html("<span class='error-text'>Заполните поле - Телефон</span>");
    error = setTimeout(
      function errorClear() {
        $("#error-result__services").html("");
      }, 3000);
  }
  else {
    $.post(
      "js/send-mail.php",
      {
        name: name,
        phone: phone,
        message: message
      },
      onSendCompleteServices
    );
  }
}

var successServices = $("#send-result__services").val();

function onSendCompleteServices() {
  $("#services-client-name").val('');
  $("#services-client-phone").val('');
  $("#message-services").val('');
  $("#send-result__services").html("<span class='success-text'>Сообщение отправлено!</span>");
  successServices = setTimeout(function success() {$("#send-result__services").html("");}, 3000);
}


function order(){
  var name = $("#order-client-name").val();
  var phone = $("#order-client-phone").val();
  var cars = $("#order-value").val();
  var message = $("#message-order").val();
  var error = $("#error-result").val();

  if (name == '') {
    $("#error-result__order").html("<span class='error-text'>Заполните поле - Имя</span>");
    error = setTimeout(
      function errorClear(){
        $("#error-result__order").html("");
      }, 3000);
  } else
  if (phone == '') {
    $("#error-result__order").html("<span class='error-text'>Заполните поле - Телефон</span>");
    error = setTimeout(
      function errorClear() {
        $("#error-result__order").html("");
      }, 3000);
  }
  else {
    $.post(
      "js/send-mail.php",
      {
        name: name,
        phone: phone,
        cars: cars,
        message: message
      },
      onSendCompleteOrder
    );
  }
}

var successOrder = $("#send-result__order").val();

function onSendCompleteOrder() {
  $("#order-client-name").val('');
  $("#order-client-phone").val('');
  $("#message-order").val('');
  $("#send-result__order").html("<span class='success-text'>Сообщение отправлено!</span>");
  successOrder = setTimeout(function success() {$("#send-result__order").html("");}, 3000);
}

function callBack(){
  var name = $("#client-name").val();
  var phone = $("#client-phone").val();
  var error = $("#error-result").val();

  if (name == '') {
    $("#error-result").html("<span class='error-text'>Заполните поле - Имя</span>");
    error = setTimeout(
      function errorClear(){
        $("#error-result").html("");
      }, 3000);
  } else
  if (phone == '') {
    $("#error-result").html("<span class='error-text'>Заполните поле - Телефон</span>");
    error = setTimeout(
      function errorClear() {
        $("#error-result").html("");
      }, 3000);
  }
  else {
    $.post(
      "js/send-mail.php",
      {
        name: name,
        phone: phone
      },
      onSendCompleteCallback
    );
  }
}

var success = $("#send-result").val();

function onSendCompleteCallback() {
  $("#client-name").val('');
  $("#client-phone").val('');
  $("#send-result").html("<span class='success-text'>Сообщение отправлено!</span>");
  success = setTimeout(function success() {$("#send-result").html("");}, 3000);
}

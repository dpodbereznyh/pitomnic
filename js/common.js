$(function() {

	// Custom JS

});

// SmartMenus init
$(function() {
  $('#main-menu').smartmenus({
    mainMenuSubOffsetX: -1,
    mainMenuSubOffsetY: 4,
    subMenusSubOffsetX: 6,
    subMenusSubOffsetY: -6
  });
});

// SmartMenus mobile menu toggle button
$(function() {
  var $mainMenuState = $('#main-menu-state');
  if ($mainMenuState.length) {
    // animate mobile menu
    $mainMenuState.change(function(e) {
      var $menu = $('#main-menu');
      if (this.checked) {
        $menu.hide().slideDown(250, function() { $menu.css('display', ''); });
      } else {
        $menu.show().slideUp(250, function() { $menu.css('display', ''); });
      }
    });
    // hide mobile menu beforeunload
    $(window).bind('beforeunload unload', function() {
      if ($mainMenuState[0].checked) {
        $mainMenuState[0].click();
      }
    });
  }
});

$(".js-buy").on( "click", function() {
  var newtitle = $(this).attr("data-title");
  var newinput = $(this).attr("data-input");
  $(".js-title").html(newtitle);
  $(".js-zakaz").val(newinput);
});



$("#answer-form").submit(function(){
  $.ajax({
    type: "POST",
    url: "send.php",
    data: $(this).serialize()
  }).done(function() {
    $(this).find("input").val("");
    $.fancybox.open({
      src: '#fancyalert',
    });
    $("#answer-form").trigger("reset");
  });
  return false;
});

$("#popup-form").submit(function(){
  $.ajax({
    type: "POST",
    url: "send.php",
    data: $(this).serialize()
  }).done(function() {
    $(this).find("input").val("");
    parent.jQuery.fancybox.getInstance().close();
    $.fancybox.open({
      src: '#fancyalert',
    });
    $("#popup-form").trigger("reset");
  });
  return false;
});

$(document).ready(function() {
  var plan = "Не указано"; //Имеется ли план участка?
  var ready = "Не указано"; //Проведена ли подготовка земли?
  var need = "Не указано"; //Требуется ли завоз плодородного слоя грунта?
  var size = "Не указано"; //Размер вашего участка
  var dal = "Не указано"; //Удаленность от города Владимир
  var final_input = "";


  $("#main-form").submit(function(e){
    e.preventDefault();
    plan = $('input[name=radio1]:checked').val();
    ready = $('input[name=radio2]:checked').val();
    need = $('input[name=radio3]:checked').val();

    if ($('input[name=input-size-check]').prop('checked')) {
      size = "Не знаю";
    } else {
      if ($('input[name=input-size]').val() != "") {
        size = $('input[name=input-size]').val();
      } else {
        size = "Не указано";
      };
    };

    if ($('input[name=input-dal]').val() != "") {
      dal = $('input[name=input-dal]').val();
    } else {
      dal = "Не указано";
    };
    $(".js-title").html("Узнать стоимость проекта");
    $(".js-zakaz").val("Имеется ли план участка: " + plan + "; Проведена ли подготовка земли: " + plan + "; Требуется ли завоз плодородного слоя грунта: " + need + "; Размер вашего участка " + size + "; Удаленность от города Владимир: " + dal);
    $.fancybox.open({
      src: '#popup-form',
    });
    $("#main-form").trigger("reset");

  });
});

$(document).ready(function() {
// для плавного перехода по якорям
  $(".yakor").on("click", function (event) {
    event.preventDefault();
    var id  = $(this).attr('href'),
        top = $(id).offset().top -80;
    $('body,html').animate({scrollTop: top}, 500);
  });
// для формы расчета
  $( "#select-first" ).trigger( "click" );
  var removeAllActive = function (event) {
    $('.select-btn').removeClass('select-btn-active');
  }
  $('.select-btn').on('click', function() {
    removeAllActive();
    $(this).addClass('select-btn-active');
    var formDepth = $(this).attr("data-depth");
    $(".js-depth").val(formDepth);
  });

});

$(window).ready(closeMenu);
$(window).resize(closeMenu);
function closeMenu()
{
  if ( $(window).width() < 992 ) {
    $(".yakor").on("click", function (event) {
      setTimeout(function(){
        $("#main-menu-state").prop('checked', false).change();
      }, 600);
    });
  }
}

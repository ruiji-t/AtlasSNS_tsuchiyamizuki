// アコーディオンメニュー

$('.menu_button').click(function () {
  $(this).toggleClass('is-open');
  $(this).siblings('.accordion_menu').toggleClass('is-open');
});

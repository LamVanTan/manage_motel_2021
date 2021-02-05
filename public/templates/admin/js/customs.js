// js xử lý upload-images-show admin
function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e) {
      $('.image-upload-wrap').hide();
      $('.file-upload-image').attr('src', e.target.result);
      $('.file-upload-content').show();
      $('.image-title').html(input.files[0].name);
    };
    reader.readAsDataURL(input.files[0]);

  } else {
    removeUpload();
  }
}

function readURL1(input) {
  if (input.files && input.files[0]) {

    var reader = new FileReader();

    reader.onload = function(e) {
      $('.image-upload-wrap-1').hide();

      $('.file-upload-image-1').attr('src', e.target.result);
      $('.file-upload-content-1').show();

      $('.image-title-1').html(input.files[0].name);
    };
    reader.readAsDataURL(input.files[0]);

  } else {
    removeUpload1();
  }
}

function removeUpload() {
  $('.file-upload-input').replaceWith($('.file-upload-input').clone());
  $('.file-upload-content').hide();
  $('.image-upload-wrap').show();
}
$('.image-upload-wrap').bind('dragover', function () {
    $('.image-upload-wrap').addClass('image-dropping');
  });
  $('.image-upload-wrap').bind('dragleave', function () {
    $('.image-upload-wrap').removeClass('image-dropping');
});

function removeUpload1() {
  $('.file-upload-input-1').replaceWith($('.file-upload-input-1').clone());
  $('.file-upload-content-1').hide();
  $('.image-upload-wrap-1').show();
}
$('.image-upload-wrap-1').bind('dragover', function () {
    $('.image-upload-wrap-1').addClass('image-dropping-1');
  });
  $('.image-upload-wrap-1').bind('dragleave', function () {
    $('.image-upload-wrap-1').removeClass('image-dropping-1');
});
(function($) {
  var ids = [];

  $('#photos').fileupload({
    sequentialUploads: true,

    add: function(e, data) {
      $("#sendMessageButton").addClass('disabled');
      $("#sendMessageButton").attr("aria-disabled", "true");
      $("#sendMessageButton").prop("disabled", true);
      $("#sendMessageButton").removeClass('btn-primary');
      data.submit();
    },
    submit: function(e, data) {
      $("#progress-div").removeClass('d-none');
    },
    done: function(e, data) {
      ids.push(data.result['id']);
      $("#progress>span").text(data.files[0].name);
    },
    progressall: function (e, data) {
      var progress = parseInt(data.loaded / data.total * 100, 10);
      $('#progress').css(
        'width',
        progress + '%'
      );
    },
    stop: function(e, data) {
      $("#sendMessageButton").removeClass('disabled');
      $("#sendMessageButton").attr("aria-disabled", "false");
      $("#sendMessageButton").prop("disabled", false);
      $("#sendMessageButton").addClass('btn-primary');
      $("#progress>span").text("Upload Complete");
      if($("input[name='_photos[]']").length == 0) {
        $('<input type="hidden" name="_photos[]" value="' + ids + '">').appendTo('form');
      }
      else {
        $("input[name='_photos[]']").attr('value', ids);
      }
    },
    fail: function(e, data) {
      alertify.error("The file " + data.files[0].name + " was not uploaded");
    }
  });
})(jQuery);

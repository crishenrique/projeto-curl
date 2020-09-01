$("input").keydown(function (e){
    var keyCode= e.which;
    if (keyCode == 13){
      event.preventDefault();
      return false;
    }
  });

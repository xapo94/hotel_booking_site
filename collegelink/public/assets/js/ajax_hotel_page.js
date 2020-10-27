(function($){
  $(document).on('submit', 'form.favoriteForm', function(e){

    e.preventDefault();

    // Get form data
    const formData = $(this).serialize();
    // console.log(formData);

    // Ajax request
    $.ajax(
      'http://localhost/collegelink/public/ajax/hotel_favorite.php',
      {
        type: "POST",
        dataType: "json",
        data: formData
      }).done(function(result){
        // console.log(result);
        if (result.status){
          $('input[name=is_favorite]').val(result.is_favorite ? 1 : 0);
          $('.favoriteForm .fa-heart').toggleClass('favorite');

        } else {
          $('.favoriteForm .fa-heart').toggleClass('favorite');
        }
      });

  });

  $(document).on('submit', 'form.reviewForm', function(e){

    e.preventDefault();

    // Get form data
    const formData = $(this).serialize();
    // console.log(formData);

    // Ajax request
    $.ajax(
      'http://localhost/collegelink/public/ajax/hotel_review.php',
      {
        type: "POST",
        dataType: "html",
        data: formData
      }).done(function(result){
        // console.log(result);

        // Apend review to list of reviews
        $('#ajax-use').append(result);

        // Reset review form
        $('form.reviewForm').trigger('reset');
      });

  });
}) (jQuery);

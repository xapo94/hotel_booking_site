(function($){
  $(document).on('submit', 'form.searchForm', function(e){

    e.preventDefault();

    // Get form data
    const formData = $(this).serialize();
    console.log(formData);

    // Ajax request
    $.ajax(
      'http://localhost/collegelink/public/ajax/search_results.php',
      {
        type: "GET",
        dataType: "html",
        data: formData
      }).done(function(result){
        // Clear results container
        $('#search-results-container').html('');

        // Apend results container
        $('#search-results-container').append(result);

        // Push url state
        history.pushState({}, '', 'http://localhost/collegelink/public/ajax/search_results.php' + formData);

        //console.log(result);
      });

  });
}) (jQuery);

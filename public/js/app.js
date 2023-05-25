$(document).ready(function() {
    $(".danger-alert").fadeTo(5000, 5000).slideUp(500, function(){
      $(".danger-alert").slideUp(5000);
  });

    $.ajaxSetup({
                headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
            });

    $(".search-input").on('keyup', function(){
      var search = this.value;
      if(search.length>2){
        $(".search").css("display", "block");
        $(".search").html("<center><h3>Searching...</h3></center>");

        $.ajax({
          method : 'POST',
          url : 'search/post',
          data : { 'search' : search},
          success : function (data) {
            if(data.data==0){
              $(".search").html("<center><h3>No Data Found!!!</h3></center>");
            }
            else{
              $(".search").html(data.data);
            }
          }
        })

      }
      else{
        $(".search").css("display", "none");
      }
    });

    $('#search-action-modal').on('show.bs.modal', function(e){ 
        var dtid = $(e.relatedTarget).data('id');
        var darray = $(e.relatedTarget).data('array');
        console.log(dtid);
        console.log(darray.amount);
        var event = "<table class='table table-bordered'><tr><td>Title</td><td>"+darray.title+"</td></tr><tr><td>Genre</td><td>"+darray.genre_name+"</td></tr><tr><td>Artist</td><td>"+darray.artist_name+"</td></tr><tr><td>Description</td><td>"+darray.description+"</td></tr><tr><td>Amount</td><td>"+darray.amount+"</td></tr><tr><td>Date</td><td>"+darray.date+"</td></tr><tr><td>Venue</td><td>"+darray.venue_name+"</td></tr>";
        $("#modl-content").html(event);
      });


});

/*
$(document).ready(function($) {
    $(".table-row").click(function() {
        window.document.location = $(this).data("href");
    });
});
*/

//get current rank
//var dbrank = 0;
$(document).ready(function(){


  //when clicked add 1 to current rank
  $('[name="rankup"]').click(function(e){
    var id = $(this).attr("id");
    alert(id);
    $.ajax({
      url:'rank.php',
      type: 'POST',
      data: id,
      success: function(result){
      alert('success');
      }
    });
      //dbrank += 1;
      //$("#rank_"+id).text(dbrank);

      //var name = $(this).attr('id');


  });

});

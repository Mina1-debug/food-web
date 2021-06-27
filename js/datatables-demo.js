// Call the dataTables jQuery plugin
$(document).ready(function() {
  try{
    var table = $('#dataTable').DataTable();
    $('#dataTable2').DataTable();

  } catch(e) {
    console.log(e);
  }

  $(document).on("change", ".report-filter", function () {
    console.log($(".report-filter[name='user']").val());
    table
      .columns(3).search($(".report-filter[name='user']").val())
      .columns(1).search($(".report-filter[name='food']").val())
      // .columns(4).data()
      // .filter( function ( value, index ) {
      //     return true ?? value > "2020-06-12" ? true : false;
      // })
      .draw();
  })

});

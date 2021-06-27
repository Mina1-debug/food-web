// Call the dataTables jQuery plugin
$(document).ready(function() {
  $.fn.dataTable.ext.search.push(
    function( settings, data, dataIndex ) {
      var from_date = Date.parse($('.report-filter[name="date_from"]').val());
      var to_date = Date.parse($('.report-filter[name="date_to"]').val());
      var date_created = Date.parse(data[4]);
      console.log(date_created);
 
      if (from_date <= date_created && to_date >= date_created) {
          return true;
      }
      return false;
    }
  );

  try{
    var table = $('#dataTable').DataTable();
    $('#dataTable2').DataTable();

  } catch(e) {
    console.log(e);
  }

  $(document).on("change", ".report-filter", function () {
    // console.log($(".report-filter[name='user']").val());
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

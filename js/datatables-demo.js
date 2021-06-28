// Call the dataTables jQuery plugin
$(document).ready(function() {
  try{
    var table = $('#dataTable').DataTable();
    $('#dataTable2').DataTable();

    $.fn.dataTable.ext.search.push(
      function(settings, data, dataIndex) {
        var from_date = new Date($(".report-filter[name='date_from']").val());
        var to_date = new Date($(".report-filter[name='date_to']").val());
        // 6nd column (5th index) in the report table (Date Created)
        var date = new Date(data[5]);

        // console.log("Index " + dataIndex);
        // console.log("From " + from_date);
        // console.log("To " + to_date);

        if(from_date == "Invalid Date" || to_date == "Invalid Date") {
          if(from_date == "Invalid Date" && to_date == "Invalid Date") {
            return true;

          } else if(from_date == "Invalid Date") {
            return to_date.getTime() >= date.getTime();

          } else if (to_date == "Invalid Date") {
            return from_date.getTime() <= date.getTime();

          } else if (date == "Invalid Date") {
            return true;
          }

          return true;
        } 

        return from_date.getTime() <= date.getTime() && to_date.getTime() >= date.getTime();
      }
    );

  } catch(e) {
    console.log(e);
  }

  $(document).on("change", ".report-filter", function () {
    table
    // 5th column (4th index) in the report table (Added By)
      .columns(4).search($(".report-filter[name='user']").val())
    // 2nd column (1th index) in the report table (Food)
      .columns(1).search($(".report-filter[name='food']").val())
      .draw();
  })

  $(document).on("click", ".report-filter[type='reset']", function () {
    $("input.report-filter").each((i, e) => {
      if($(e).attr("type") != "reset") $(e).val("")
    })
    table.columns().search("").draw();
  })

});

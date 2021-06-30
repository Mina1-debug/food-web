// Call the dataTables jQuery plugin
$(document).ready(function() {
  function loadingIndicator(trigger = false) {
    trigger ? $("#loader").fadeIn(800) : $("#loader").fadeOut(800);
  }

  try{
    $('#dataTable').DataTable();
    var table = $('#report_table').DataTable({
      drawCallback: function( settings ) {
        var count = 0;
        $(this.api().rows({filter: 'applied'}).nodes()).each((i, e) => {
          count = count + parseFloat($(e).find("td").last().attr("data-value"));
        })
        console.log(count);
        $("#report_table_total .counter").text(count);

      },
      dom: 'Bfrtip',
      buttons: [
        {
          extend: 'print',
          text: "<i class='fa fa-file-pdf mx-2'></i><span style='font-weight: 600'>Print</span>",
          autoPrint: true,
          header: true,
          title: "Food Factory",
          customize: function (win) {
            $(win.document.body).css('padding', '8px');
            $(win.document.body).find('h1').css({
              textAlign: 'center',
              margin: "8px"
            });
          },
          exportOptions: {
            rows: function ( idx, data, node ) {
              var isChecked = $(node).find("input[type='checkbox']");
              return isChecked.prop("checked");
            }
          }
        },
        {
          extend: 'excel',
          className: "btn-success",
          title: "Food Factory",
          text: "<i class='fa fa-file-excel mx-2'></i><span style='font-weight: 600'>Excel</span>",
          exportOptions: {
            rows: function ( idx, data, node ) {
              var isChecked = $(node).find("input[type='checkbox']");
              return isChecked.prop("checked");
            }
          }
        },
        {
          text: "<i class='fa fa-trash mx-2'></i><span style='font-weight: 600'>Delete</span>",
          className: "report-btn-danger",
          action: function ( e, dt, node, config ) {
            var ids = [];

            table.rows().every( function ( rowIdx, tableLoop, rowLoop ) {
              var data = $(this.node()).find("input[type='checkbox']");
              
              if(data.prop("checked") == true) {
                ids.push(data.val());
              } else {
                ids = ids.filter((value, index, arr) => {
                  return value != data.val();
                })
              }
            });

            if(ids.length > 0)
            $.ajax({
              url: "core/mina.php",
              method: "post",
              data: {
                action: "delete_food_payment",
                ids: ids.join(",")
              },
              dataType: "json",
              error: (e) => {loadingIndicator()},
              beforeSend: (e) => {loadingIndicator(true)},
              success: (response) => {
                loadingIndicator();

                if(response['status'] == "success") {
                  swal.fire({
                        title: "Deletion Successful",
                        text: response['message'],
                        icon: "success"
                    }).then((value) => {
                       window.location.reload();
                    });
                } else {
                  swal.fire({
                    title: "Deletion unsuccessful",
                    text: response['message'],
                    icon: "error"
                  });
                }
              },
            });

            console.log(ids);
          }
        }
      ]
    });

    $.fn.dataTable.ext.search.push(
      function(settings, data, dataIndex) {
        var from_date = new Date($(".report-filter[name='date_from']").val());
        var to_date = new Date($(".report-filter[name='date_to']").val());
        // 8th column (7th index) in the report table (Date Created)
        var date = new Date(data[7]);

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
    // 7th column (6th index) in the report table (Added By)
      .columns(6).search($(".report-filter[name='user']").val())
    // 3rd column (2th index) in the report table (Food)
      .columns(2).search($(".report-filter[name='food']").val())
      .draw();
  })

  $(document).on("click", ".report-filter[type='reset']", function () {
    $("input.report-filter").each((i, e) => {
      if($(e).attr("type") != "reset") $(e).val("")
    })
    table.columns().search("").draw();
  })

  $(document).on("change", "#all_ids", function() {
    var _this = $(this);
    table.rows().every( function ( rowIdx, tableLoop, rowLoop ) {    
      var data = $(this.node()).find("input[type='checkbox']");  
      data.prop("checked", _this.prop("checked"));
    });
  })

});

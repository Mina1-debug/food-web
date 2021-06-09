// Call the dataTables jQuery plugin
$(document).ready(function() {
  try{
    $('#dataTable').DataTable();
    $('#dataTable2').DataTable();
  } catch(e) {
    console.log(e);
  }
});

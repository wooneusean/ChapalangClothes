const ShowReportModal = (productid) => {
  ShowModal();
  $("#form-report-productid").val(productid);
}

const SendReportData = () => {
  $.post("report.php", $("#form-report").serialize(), () => {
    DismissModal();
    ShowModal(1);
  }).fail(() => {
    DismissModal();
    ShowModal(2);
  });
}
function api_data_table() {
    $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings) {
      return {
        "iStart": oSettings._iDisplayStart,
        "iEnd": oSettings.fnDisplayEnd(),
        "iLength": oSettings._iDisplayLength,
        "iTotal": oSettings.fnRecordsTotal(),
        "iFilteredTotal": oSettings.fnRecordsDisplay(),
        "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
        "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
      };
    };
  }

  function swalLoading() {
    Swal.fire({
      title: "UNIVERSITAS ISLAM RIAU",
      html: "Mohon Tunggu...",
      allowEscapeKey: false,
      allowOutsideClick: false,
      didOpen: () => {
        Swal.showLoading();
      },
    });
  }
  
  function messegeSuccess(messege) {
    Swal.fire({
      title: "UNIVERSITAS ISLAM RIAU",
      icon: "success",
      html: messege,
      allowEscapeKey: false,
      allowOutsideClick: false,
      showConfirmButton: false,
      timer: 2000,
    });
  }
  
  function messegeWarning(messege) {
    Swal.fire({
      title: "UNIVERSITAS ISLAM RIAU",
      icon: "warning",
      html: messege,
      allowEscapeKey: false,
      allowOutsideClick: false,
    });
  }
  
  function messegeError(messege) {
    Swal.fire({
      title: "UNIVERSITAS ISLAM RIAU",
      icon: "error",
      html: messege,
      allowEscapeKey: false,
      allowOutsideClick: false,
    });
  }
  
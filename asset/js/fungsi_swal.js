const flashdata = $('.flashdata').data('flashdata');
console.log(flashdata);
if (flashdata) {
    Swal.fire({
        title: "Informasi",
        text: flashdata,
        type: "success"
    });
}

const flashdata_login = $('.flashdata_error').data('flashdata');
console.log(flashdata_login);
if (flashdata_login) {
    Swal.fire({
        title: "Opps !",
        text: flashdata_login,
        type: "error"
    });
}


$('.edit_data_biaya').on('click', function(){  
  var id_biaya = $(this).attr("id");  
  console.log(id_biaya);
  
  $.ajax({  
       url:"<?= base_url();?>PembiayaanController/json_data",  
       method:"GET",  
       data:{id_biaya:id_biaya},  
       dataType:"json",  
       success:function(data){ 
         console.log(data.nama_biaya);
          
            $('#nama_biaya').val(data.nama_biaya);  
            $('#jumlah_debit').val(data.jumlah_debit);  
            $('#modal-edit').modal('show');  
       }  
  });  
});

('#tombol-confirm').on('click', function() {
  console.log("yesy");
  
    Swal.fire({
      title: "Apakah anda yakin ?",
      text: "Data akan dinonaktifkan",
      type: "warning",

      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Ya'
    }).then((result) => {
      if (result.value) {
        Swal.fire(
          'Deleted!',
          'Data berhasil dihapus',
          'success'
        )
      }
    })
  });
('.tombol-hapus').click(function(e) {
    Swal.fire({
      title: "Apakah anda yakin ?",
      text: "Data akan dinonaktifkan",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Ya'
    }).then((result) => {
      if (result.value) {
        Swal.fire(
          'Deleted!',
          'Data berhasil dihapus',
          'success'
        )
      }
    })
  });

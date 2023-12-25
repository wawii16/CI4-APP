$(document).on('click', '#btn-edit', function() {
    $('.modal-body #id-mahasiswa').val($(this).data('id'));
    $('.modal-body #nim').val($(this).data('nim'));
    $('.modal-body #nama').val($(this).data('nama'));
    $('.modal-body #alamat').val($(this).data('alamat'));
    $('.modal-body #jurusan').val($(this).data('jurusan'));
})

$(document).on('click', '#btn-hapus', function () {
    $('.modal-body #id-Mahasiswa').val($(this).data('id'));
  })

// sweet alert

const swal = $('.swal').data('swal');
if(swal){
    Swal.fire({
        title: 'Data Berhasil',
        text: swal,
        icon: 'success'
    })
}
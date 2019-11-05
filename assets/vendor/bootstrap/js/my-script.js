const flashdata = $('.flash-data').data('flashdata');

if (flashdata) {
	Swal.fire({
		title: '',
		text: 'Berhasil ' + flashdata,
		type: 'success'
	});
}

const message = $('.sweet').data('messagedata');

if (message) {
	Swal.fire({
		title: 'Pemberitahuan',
		text: message + ' Berhasil',
		type: 'success'
	});
}


jQuery(window).on("load", function () {
	$(".loader").fadeOut("slow");
});

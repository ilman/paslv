jQuery(document).ready(function($){
	

	(function(){
		if(typeof $.fn.datetimepicker == 'undefined'){ return false; }
		$('.input-date').datetimepicker({
			pickTime: false,
			format: 'YYYY/MM/DD'
		});
	})();

	(function(){
		if(typeof $.fn.select2 == 'undefined'){ return false; }
		$('.input-select2').select2({
			minimumInputLength: 2,
		});
	})();

	(function(){
		if(typeof tinymce == 'undefined'){ return false; }
		tinymce.init({
			selector:'.input-tinymce',
			menubar: false,
			toolbar: "undo redo | bold italic | alignleft aligncenter alignright | bullist numlist outdent indent | link image | media table",
		});
	})();

	

	$('.input-convert-to-text').keyup(function(){
		var $this = $(this);

		$($this.data('target')).val(convert_to_word($this.val()));
	});
});
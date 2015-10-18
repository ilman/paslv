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
			plugins: "link, image, media, table, visualblocks, paste",
			toolbar: "undo redo | bold italic | alignleft aligncenter alignright | bullist numlist outdent indent | link image | media table code visualblocks",
			content_css: ['../css/editor.css'],
		});
	})();

	

	$('.input-convert-to-text').keyup(function(){
		var $this = $(this);

		$($this.data('target')).val(convert_to_word($this.val()));
	});

	(function(){
		$('.repeat-add').click(function(event){
			event.preventDefault();

			var $this = $(this);
			var $parent = $this.closest('.repeatable');
			var $item = $parent.find('.repeat-item').first();
			var $clone = $item.clone(true);

			$clone.find(':input').val('')

			$parent.find('.repeat-item').last().after($clone);
		});

		$('.repeat-delete').click(function(event){
			event.preventDefault();

			var $this = $(this);
			var $item = $this.closest('.repeat-item');

			$item.detach();
		});
	})();
});
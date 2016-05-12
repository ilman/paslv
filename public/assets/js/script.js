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


	(function(){

		$('.tr-add').click(function(event){
			event.preventDefault();

			var $this = $(this);
			var $parent =  $($this.attr('rel')).find('tbody');
			var $items = $parent.find('> tr');
			var $clone = $items.first().clone(true);
			var $inputs = $clone.find(':input');
			var input_name;
			var parent_count = $parent.attr('count');

			if(typeof parent_count == 'undefined' || !parent_count){
				parent_count = $items.length;
			}

			$clone.find('> td').first().text($items.length + 1);

			$inputs.each(function(){
				var $each = $(this);
				input_name = $each.attr('name');

				$each.val('');

				if(typeof input_name != 'undefined'){
					$each.attr('name', input_name.replace(/\[.\]/g, '[' + parent_count + ']'));
				}
			});

			$parent.find('> tr').last().after($clone);
			$parent.attr('count') = parent_count + 1;
		});

		$('.tr-delete').click(function(event){
			event.preventDefault();

			var $this = $(this);
			var $item = $this.closest('tr');
			var $parent = $item.closest('tbody');

			if($parent.find('> tr').length > 1){
				$item.detach();
			}
			else{
				var $inputs = $item.find(':input');
				var input_name;

				$item.find('> td').first().text(1);

				$inputs.each(function(){
					var $each = $(this);
					input_name = $each.attr('name');

					$each.val('');

					if(typeof input_name != 'undefined'){
						$each.attr('name', input_name.replace(/\[.\]/g, '[0]'));
					}
				});
			}
		});
	})();


	(function(){

		$(document).on('keyup', '.tr-input-qty, .tr-input-price', function(){
			var $this = $(this);
			var $parent = $this.closest('tr');
			var $table = $this.closest('table');
			var $tr_totals = $table.find('.tr-total');

			var qty = $parent.find('.tr-input-qty').val();
			var price = $parent.find('.tr-input-price').val();
			var totals = 0;

			$parent.find('.tr-total').val(price * qty);


			$tr_totals.each(function(){
				var $each = $(this);
				var each_val = $each.val();

				if(isNaN(each_val)){
					each_val = 0;
				}

				totals = parseInt(totals) + parseInt(each_val);
			});
			$table.find('.table-total').val(totals);
		});

	})();

});
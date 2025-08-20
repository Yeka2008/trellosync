define(['jquery'], function() {
    return {
        init: function() {
$(document).ready(function() {
        	$('i.delete-task-trellosync').on('click', function(){
        		var cardid = $(this).data('cardid');
        		var courseid = $(this).data('courseid');

				$.ajax({
					method: "POST",
					url: M.cfg.wwwroot+"/local/trellosync/ajax.php",
					data: { cardid: cardid, sesskey: M.cfg.sesskey, action: 'deletetask', courseid: courseid}
				})
				.done(function( response ) {
					alert('Elemento procesado: '+response.message);
					location.reload();
				});


        	});
			});
        }
    };
});
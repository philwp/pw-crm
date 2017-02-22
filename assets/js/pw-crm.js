jQuery(document).ready(function($){

	$('#crm-form').submit(function(e){
		e.preventDefault();

		// Source for time: http://davidayala.eu/current-time/
		var timeURL = "https://script.googleusercontent.com/macros/echo?user_content_key=gShxEER5EijqU7DqfZwF3Qo18ngP3Dzbp7lnKaRybr6_gEcHf5ES8idyH-ep5ddnv_bHfO_tU8Zh99LofAsZhnp7_2MfZvdxm5_BxDlH2jW0nuo2oDemN9CCS2h10ox_1xSncGQajx_ryfhECjZEnJ9GRkcRevgjTvo8Dc32iw_BLJPcPfRdVKhJT5HNzQuXEeN3QFwl2n0M6ZmO-h7C6eIqWsDnSrEd&lib=MwxUjRcLr2qLlnVOLh12wSNkqcO1Ikdrk";
		var fullDate;
		var data = $(this).serializeArray();

		$.getJSON(timeURL).then(function(d){
			fullDate = d.fulldate;
		}).always(function(){
			data.push(
				{name: "security", value: pw_crm_ajax.nonce},
				{name: "time", value: fullDate}
			);
			$.ajax({
	       		action: 'crm_send',
	         	url: pw_crm_ajax.ajax_url,
	       		type: 'post',
	         	dataType: 'JSON',
	         	data: $.param(data),
	         	success: function(data){
	         		successMessage = 'Thank you for your submission.';
	         		formMessage(successMessage);
	         	},
	         	error: function(data){
	         		successMessage = 'There was an error, please try again.';
	         		formMessage(successMessage);
	         	}
			});
		});
	});
});

function formMessage( message ){
	jQuery('#crm-form').hide();
	jQuery('.pw-crm-wrap').append('<p>' + message + '</p>');
}






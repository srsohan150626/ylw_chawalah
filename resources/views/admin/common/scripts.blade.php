
<script src="{!! asset('admin/plugins/jQuery/jQuery-2.2.0.min.js') !!}"></script>
<script src="{!! asset('admin/bootstrap/js/bootstrap.min.js') !!}"></script>
<script src="{!! asset('admin/plugins/select2/select2.full.min.js') !!}"></script>

<!-- InputMask -->
<script src="{!! asset('admin/plugins/input-mask/jquery.inputmask.js') !!}"></script>
<script src="{!! asset('admin/plugins/input-mask/jquery.inputmask.date.extensions.js') !!}"></script>
<script src="{!! asset('admin/plugins/input-mask/jquery.inputmask.extensions.js') !!}"></script>
<script src="{!! asset('admin/js/jquery.validate.js') !!}"></script>
<!-- date-range-picker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="{!! asset('admin/plugins/daterangepicker/daterangepicker.js') !!}"></script>
<script src="{!! asset('admin/js/dropzone.js') !!}"></script>
<script src="{!! asset('admin/js/image-picker.js') !!}"></script>
<script src="{!! asset('admin/js/image-picker.min.js') !!}"></script>
{{--fancy box--}}
<script src="{!! asset('admin/js/jquery.fancybox.min.js') !!}"></script>

<!-- bootstrap datepicker -->
<script src="{!! asset('admin/plugins/datepicker/bootstrap-datepicker.js') !!}"></script>

<!-- bootstrap color picker -->
<script src="{!! asset('admin/plugins/colorpicker/bootstrap-colorpicker.min.js') !!}"></script>
<!-- bootstrap time picker -->
<script src="{!! asset('admin/plugins/timepicker/bootstrap-timepicker.min.js') !!}"></script>
<!-- SlimScroll 1.3.0 -->
<script src="{!! asset('admin/plugins/slimScroll/jquery.slimscroll.min.js') !!}"></script>
<!-- iCheck 1.0.1 -->
<script src="{!! asset('admin/plugins/iCheck/icheck.min.js') !!}"></script>
<!-- FastClick -->
<script src="{!! asset('admin/plugins/fastclick/fastclick.js') !!}"></script>
<!-- AdminLTE App -->
<script src="{!! asset('admin/dist/js/app.min.js') !!}"></script>
<script src="{{url('admin/js/clipboard.min.js')}}"></script>
@if(Request::path() == 'admin/dashboard/last_year' or Request::path() == 'admin/dashboard/last_month' or Request::path() == 'admin/dashboard/this_month')
    <!--<script src="{!! asset('dist/js/pages/dashboard.js') !!}"></script>-->
@endif
<!-- AdminLTE for demo purposes -->
<script src="{!! asset('admin/js/demo.js') !!}"></script>

<script src="{!! asset('admin/plugins/chartjs/Chart.min.js') !!}"></script>
<script src="{!! asset('admin/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') !!}"></script>
<script src="{!! asset('admin/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') !!}"></script>
<script src="{!! asset('admin/plugins/sparkline/jquery.sparkline.min.js') !!}"></script>

<script src="{!! asset('admin/plugins/sparkline/jquery.sparkline.min.js') !!}"></script>

<!-- CK Editor -->
<script src="https://cdn.ckeditor.com/4.5.7/standard/ckeditor.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{!! asset('admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') !!}"></script>

<script type="text/javascript">

var error="";



$(document).ready(function(){
	$("#header_img").hover(function(){
		$(".hover_option").css("display","none");
		$(".header_options").slideDown("fast");
	});
	$("#carousal_img").hover(function(){
		$(".hover_option").css("display","none");
		$(".carousal_options").slideDown("fast");
	});
	$("#footer_img").hover(function(){
		$(".hover_option").css("display","none");
		$(".footer_options").slideDown("fast");
	});
	$.each(new Array(12),
		function(n){
			$("#banner_img_"+n).hover(function(){
			$(".hover_option").css("display","none");
			$(".banner_options_"+n).slideDown("fast");
			});
		}
	);
});


function showCartImage(){
  var cart_id = jQuery('#cart_id').val();
  jQuery('#cart_image1').hide();
  jQuery('#cart_image2').hide();

  if(cart_id == 1){
    jQuery('#cart_image1').show();
  }

  if(cart_id == 2){
    jQuery('#cart_image2').show();
  }

}

function showContactImage(){
  var contact_id = jQuery('#contact_id').val();
  jQuery('#contact_image1').hide();
  jQuery('#contact_image2').hide();

  if(contact_id == 1){
    jQuery('#contact_image1').show();
  }

  if(contact_id == 2){
    jQuery('#contact_image2').show();
  }

}

function showLoginImage(){
  var contact_id = jQuery('#login_id').val();
  jQuery('#login_image1').hide();
  jQuery('#login_image2').hide();

  if(contact_id == 1){
    jQuery('#login_image1').show();
  }

  if(contact_id == 2){
    jQuery('#login_image2').show();
  }

}

function showNewsImage(){
  var contact_id = jQuery('#news_id').val();
  jQuery('#news_image1').hide();
  jQuery('#news_image2').hide();

  if(contact_id == 1){
    jQuery('#news_image1').show();
  }

  if(contact_id == 2){
    jQuery('#news_image2').show();
  }

}



function showDetailImage(){
  var cart_id = jQuery('#detail_id').val();
  jQuery('#detail_image1').hide();
  jQuery('#detail_image2').hide();
  jQuery('#detail_image3').hide();
  jQuery('#detail_image4').hide();
  jQuery('#detail_image5').hide();
  jQuery('#detail_image6').hide();


  if(cart_id == 1){
    jQuery('#detail_image1').show();

  }

  if(cart_id == 2){
    jQuery('#detail_image2').show();
  }

  if(cart_id == 3){
    jQuery('#detail_image3').show();
  }

  if(cart_id == 4){
    jQuery('#detail_image4').show();
  }

  if(cart_id == 5){
    jQuery('#detail_image5').show();
  }

  if(cart_id == 6){
    jQuery('#detail_image6').show();
  }

}

function showShopImage(){
  var cart_id = jQuery('#shop_id').val();
  jQuery('#shop_image1').hide();
  jQuery('#shop_image2').hide();
  jQuery('#shop_image3').hide();
  jQuery('#shop_image4').hide();
  jQuery('#shop_image5').hide();


  if(cart_id == 1){
    jQuery('#shop_image1').show();

  }

  if(cart_id == 2){
    jQuery('#shop_image2').show();
  }

  if(cart_id == 3){
    jQuery('#shop_image3').show();
  }

  if(cart_id == 4){
    jQuery('#shop_image4').show();
  }

  if(cart_id == 5){
    jQuery('#shop_image5').show();
  }

}

$(document).ready(function () {
$.ajaxSetup({
    headers: {
        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
    }
});

$(function () {

	//Initialize Select2 Elements
	$(".select2").select2();

	//Datemask dd/mm/yyyy
	$("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
	//Datemask2 mm/dd/yyyy
	$("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
	//Money Euro
	$("[data-mask]").inputmask();

	//Date range picker
	$('.reservation').daterangepicker();
	//Date range picker with time picker
	$('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});

	//Date picker
	$('#datepicker').datepicker({
	  autoclose: true
	});

	//iCheck for checkbox and radio inputs
	$('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
	  checkboxClass: 'icheckbox_minimal-blue',
	  radioClass: 'iradio_minimal-blue'
	});
	//Red color scheme for iCheck
	$('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
	  checkboxClass: 'icheckbox_minimal-red',
	  radioClass: 'iradio_minimal-red'
	});
	//Flat red color scheme for iCheck
	$('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
	  checkboxClass: 'icheckbox_flat-green',
	  radioClass: 'iradio_flat-green'
	});

	//Colorpicker
	$(".my-colorpicker1").colorpicker();
	//color picker with addon
	$(".my-colorpicker2").colorpicker();

	//Timepicker
	$(".timepicker").timepicker({
	  showInputs: false
	});



});



function propchecked(parents_id){
	//alert(parents_id);
	$('#categories_'+parents_id).prop('checked', true);
	var parent_id = $('#categories_'+parents_id).attr('parents_id');
	if(parents_id !== undefined){
		//call nested function
		propchecked(parent_id);
	}
}

function propunchecked(parents_id){
	$('.sub_categories_'+parents_id).prop('checked', false);
	$('.sub_categories_'+parents_id).each(function() {
		var subparents_id = $(this).attr('id');
		var subparents_id = subparents_id.replace("categories_", "");
		propunchecked(subparents_id);
	});
}


 $('#dob').datepicker({
    autoclose: true,
    format: 'dd/mm/yyyy',
    endDate: "today"
  });

// check parents categories
// $(document).on('click', '.categories', function(){
// 	if($(this).is(':checked')){
// 	}else{
// 		var parents_id = $(this).val();
// 		//$('.sub_categories_'+parents_id).prop('checked', false);
// 	}

// });





$(document).on('click', '.checkboxess', function(e){
      checked = $("input[type=checkbox]:checked.checkboxess").length;
		if(!checked) {
        //alert("You must check at least one checkbox.");
        return false;
      }

});


    
	$("#loader").hide();
});

//editAddressModal
$(document).on('click', '.editAddressModal', function(){
	var user_id = $(this).attr('user_id');
	var address_book_id = $(this).attr('address_book_id');
	$.ajax({
		url: "{{url('admin/customers/editaddress')}}",
		type: "POST",
		data: '&user_id='+user_id+'&address_book_id='+address_book_id,
		success: function (data) {
			$('.editContent').html(data);
			$('#editAddressModal').modal('show');
		},
		dataType: 'html'
	});
});

	//ajax call for submit value
	$(document).on('click', '#addImage', function(e){
		$("#loader").show();
		var formData = new FormData($('#addImageFrom')[0]);
		$.ajax({
			url: '{{ URL::to("admin/addnewproductimage")}}',
			type: "POST",
			data: formData,
			success: function (res) {
				if(res.length != ''){
					$("#loader").hide();
					$('.addError').hide();
					$('#addImagesModal').modal('hide');
					var i;
					var showData = [];
					for (i = 0; i < res.length; ++i) {
						var j = i + 1;
						showData[i] = "<tr><td>"+j+"</td><td><img src={{asset('').'/'}}"+res[i].image+" alt='' width=' 100px'></td><td>"+res[i].htmlcontent+"</td> <td><a products_id = '"+res[i].products_id+"' class='badge bg-light-blue editProductImagesModal' id = '"+res[i].id+"' ><i class='fa fa-pencil-square-o' aria-hidden='true'></i></a> <a class='badge bg-red deleteProductImagesModal' id = '"+res[i].id+"' products_id = '"+res[i].products_id+"' ><i class='fa fa-trash' aria-hidden='true'></i></a></td></tr>";
					}
					$(".contentImages").html(showData);
				}else{
					$('.addError').show();
				}


			},
			cache: false,
			contentType: false,
			processData: false
		});


	});



	//editproductimagesmodal
	$(document).on('click', '.editProductImagesModal', function(){
		var id = $(this).attr('id');
		var products_id = $(this).attr('products_id');
		$.ajax({
			url: '{{ URL::to("admin/editproductimage")}}',
			type: "POST",
			data: '&products_id='+products_id+'&id='+id,
			success: function (data) {
				$('.editImageContent').html(data);
				$('#editProductImagesModal').modal('show');
			},
			dataType: 'html'
		});
	});


	$(document).on('click', '#updateProductImage', function(e){
		$("#loader").show();
		var formData = new FormData($('#editImageFrom')[0]);
		$.ajax({
			url: "{{ URL::to('admin/updateproductimage')}}",
			type: "POST",
			data: formData,
			success: function (res) {
				$("#loader").hide();
				if(res.length != ''){
					$('.addError').hide();
					$('#editProductImagesModal').modal('hide');
					var i;
					var showData = [];
					for (i = 0; i < res.length; ++i) {
						var j = i + 1;
						showData[i] = "<tr><td>"+j+"</td><td><img src={{asset('').'/'}}"+res[i].image+" alt='' width=' 100px'></td><td>"+res[i].htmlcontent+"</td> <td><a products_id = '"+res[i].products_id+"' class='badge bg-light-blue editProductImagesModal' id = '"+res[i].id+"' ><i class='fa fa-pencil-square-o' aria-hidden='true'></i></a> <a class='badge bg-red deleteProductImagesModal' id = '"+res[i].id+"' products_id = '"+res[i].products_id+"' ><i class='fa fa-trash' aria-hidden='true'></i></a></td></tr>";

					}
					$(".contentImages").html(showData);
				}else{
					$('.addError').show();
				}


			},
			cache: false,
			contentType: false,
			processData: false
		});

	});

	

	//deleteProductImagesModal
	$(document).on('click', '.deleteProductImagesModal', function(){
		var id = $(this).attr('id');
		var products_id = $(this).attr('products_id');
		$.ajax({
			url: '{{ URL::to("admin/products/images/deleteproductimagemodal")}}',
			type: "POST",
			data: '&products_id='+products_id+'&id='+id,
			success: function (data) {
				$('.deleteImageEmbed').html(data);
				$('#deleteProductImageModal').modal('show');
			},
			dataType: 'html'
		});
	});

	//deleteproductimage
	$(document).on('click', '#deleteProductImage', function(){
		$("#loader").show();
		var formData = $('#deleteImageForm').serialize();
		$.ajax({
			url: "{{ URL::to('admin/products/images/deleteproductimage')}}",
			type: "POST",
			data: formData,
			success: function (res) {
				$("#loader").hide();
				if(res.length != ''){
					$('.addError').hide();
					$('#deleteProductImageModal').modal('hide');
					var i;
					var showData = [];
					for (i = 0; i < res.length; ++i) {
						var j = i + 1;
						showData[i] = "<tr><td>"+j+"</td><td><img src={{asset('').'/'}}"+res[i].image+" alt='' width=' 100px'></td><td>"+res[i].htmlcontent+"</td> <td><a products_id = '"+res[i].products_id+"' class='badge bg-light-blue editProductImagesModal' id = '"+res[i].id+"' ><i class='fa fa-pencil-square-o' aria-hidden='true'></i></a> <a class='badge bg-red deleteProductImagesModal' id = '"+res[i].id+"' products_id = '"+res[i].products_id+"' ><i class='fa fa-trash' aria-hidden='true'></i></a></td></tr>";
					}
					$(".contentImages").html(showData);
				}else{
					var showData = '<tr><td colspan="4"><strong>No record found!</strong> Please click on "<strong>Add Product Images</strong>" to add images.</td></tr>';
					$('#deleteProductImageModal').modal('hide');
					$(".contentImages").html(showData);
				}
			},
		});
	});


	

	//ajax call for manage role
	$(document).on('click', '.manage-role-popup', function(){
		var user_types_id = $(this).attr('user_types_id');
		$.ajax({
			url: '{{ URL::to("admin/managerolepopup")}}',
			type: "POST",
			data: '&customers_id='+customers_id,
			success: function (data) {
				$('#manage-role-content').html(data);
				$('#manageRoleModal').modal('show');
			},
			dataType: 'html'
		});
	});

	
	//special product
	showSpecial();
	showAddons();
	//showFlash();
	
	//deleteproductmodal
	$(document).on('click', '#deleteProductId', function(){
		var products_id = $(this).attr('products_id');
		$('#products_id').val(products_id);
		$("#deleteproductmodal").modal('show');
	});

	

  $(document).on('click', '#delete', function(){
		var category_id = $(this).attr('category_id');
		$('#category_id').val(category_id);
		$("#deleteModal").modal('show');
	});

function showAvailtime() {
	if($('#showAvailTime').val() == 'yes'){
		$(".available-container").show();
		$(".available-container .availtime").addClass("field-validate");
	}else{
		$(".available-container").hide();
		$(".available-container .availtime").removeClass("field-validate");
	}
}

//showSpecial
function showSpecial() {
	if($('#isSpecial').val() == 'yes'){
		$('#isFlash').val('no');
		showFlash();
		$(".special-container").show();
		$(".special-container input#expiry-date").addClass("field-validate");
		$(".special-container input#special-price").addClass("special-price-validate");

	}else{
		$(".special-container").hide();
		$(".special-container input#expiry-date").removeClass("field-validate");
		$(".special-container input#special-price").removeClass("special-price-validate");
	}
}
//showAddons
function showAddons() {
	if($('#isAddons').val() == 'yes'){
		$(".addons-container").show();

	}else{
		$(".addons-container").hide();
	}
}

$(function () {
	$('.datepicker').datepicker({
	  autoclose: true,
	  format: 'dd/mm/yyyy'
	});

});

//focus form field
$(document).on('keyup', '.number-validate-level', function(e){

	if(this.value == '' || isNaN(this.value)) {
		$(this).closest(".form-group").addClass('has-error');
		//$(this).next(".error-content").removeClass('hidden');
	}else{
		$(this).closest(".form-group").removeClass('has-error');
		//$(this).next(".error-content").addClass('hidden');
	}

});

	$(document).on('keyup focusout', '.phone-validate', function(e){
		if(this.value == '' || isNaN(this.value) || this.value.length < 7) {
			$(this).closest(".form-group").addClass('has-error');
			error = "has error";

		}else{
			$(this).closest(".form-group").removeClass('has-error');
		}
	});

	$(document).on('keyup focusout', '.special-price-validate', function(e){
		var products_price = $('#products_price').val();
		if(this.value == ''  || this.value < 0 || parseInt(this.value) >= parseInt(products_price) || isNaN(this.value)) {
			$(this).closest(".form-group").addClass('has-error');
			error = "has error";

		}else{
			$(this).closest(".form-group").removeClass('has-error');
		}
	});


//validate form
$(document).on('submit', '.form-validate', function(e){
	var error = "";

	//to validate text field
	$(".field-validate").each(function() {

		if(this.value == '') {
      var parent_id  = $(this).parents('.tab-pane').attr('id');
      if(parent_id!=undefined){
        $("[href='#"+parent_id+"']").css('color','red');
        var position = $("[href='#"+parent_id+"']").offset().top;
      	$("body, html").animate({
      		scrollTop: position
      	} /* speed */ );
      }
			$(this).closest(".form-group").addClass('has-error');
			//$(this).next(".error-content").removeClass('hidden');
			error = "has error";
		}else{
			$(this).closest(".form-group").removeClass('has-error');
			//$(this).next(".error-content").addClass('hidden');


		}




	});

	$(".required_one").each(function() {
		var checked = $('.required_one:checked').length;
		if(!checked) {
			$(this).closest(".form-group").addClass('has-error');
			error = "has error";
		}else{
			$(this).closest(".form-group").removeClass('has-error');
		}
	});

	$(".number-validate").each(function() {
		if(this.value == '' || isNaN(this.value)) {
			$(this).closest(".form-group").addClass('has-error');
			//$(this).next(".error-content").removeClass('hidden');
			error = "has error";
		}else{
			$(this).closest(".form-group").removeClass('has-error');
			//$(this).next(".error-content").addClass('hidden');
		}
	});

	//focus form field
	$(".price-validate").each(function() {

		if(this.value == ''  || this.value < 1 || isNaN(this.value)) {
			$(this).closest(".form-group").addClass('has-error');
			//$(this).next(".error-content").removeClass('hidden');
				error = "has error";
		}else{
			$(this).closest(".form-group").removeClass('has-error');
			//$(this).next(".error-content").addClass('hidden');
		}

	});


		//focus form field
	$(".price-validate").each(function() {

		if(this.value == ''  || this.value < 1 || isNaN(this.value)) {
			$(this).closest(".form-group").addClass('has-error');
			//$(this).next(".error-content").removeClass('hidden');
				error = "has error";
		}else{
			$(this).closest(".form-group").removeClass('has-error');
			//$(this).next(".error-content").addClass('hidden');
		}

	});

	//
	$(".email-validate").each(function() {
		var validEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
		if(this.value != '' && validEmail.test(this.value)) {
			$(this).closest(".form-group").removeClass('has-error');
			//$(this).next(".error-content").addClass('hidden');

		}else{
			$(this).closest(".form-group").addClass('has-error');
			//$(this).next(".error-content").removeClass('hidden');
			error = "has error";
		}
	});

});

//focus form field
$(document).on('keyup change', '.field-validate', function(e){

	if(this.value == '') {
		$(this).closest(".form-group").addClass('has-error');
		//$(this).next(".error-content").removeClass('hidden');
	}else{
		$(this).closest(".form-group").removeClass('has-error');
		//$(this).next(".error-content").addClass('hidden');
	}

});

$(document).on('click', '.required_one', function(e){

	var checked = $('.required_one:checked').length;
	if(!checked) {
		$(this).closest(".form-group").addClass('has-error');
	}else{
		$(this).closest(".form-group").removeClass('has-error');
	}

});


//focus form field
$(document).on('keyup', '.number-validate', function(e){

	if(this.value == '' || isNaN(this.value)) {
		$(this).closest(".form-group").addClass('has-error');
		//$(this).next(".error-content").removeClass('hidden');
	}else{
		$(this).closest(".form-group").removeClass('has-error');
		//$(this).next(".error-content").addClass('hidden');
	}

});



//focus form field
$(document).on('keyup', '.price-validate', function(e){

	if(this.value == ''  || this.value < 1 || isNaN(this.value)) {
		$(this).closest(".form-group").addClass('has-error');
		//$(this).next(".error-content").removeClass('hidden');
	}else{
		$(this).closest(".form-group").removeClass('has-error');
		//$(this).next(".error-content").addClass('hidden');
	}

});


$(document).on('keyup focusout', '.email-validate', function(e){
	var validEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
	if(this.value != '' && validEmail.test(this.value)) {
		$(this).closest(".form-group").removeClass('has-error');
		//$(this).next(".error-content").addClass('hidden');

	}else{
		$(this).closest(".form-group").addClass('has-error');
		//$(this).next(".error-content").removeClass('hidden');
		error = "has error";
	}
});


//show password div
	function validatePasswordForm(){
		var email = document.forms["updateAdminPassword"]["email"].value;
		var password = document.forms["updateAdminPassword"]["password"].value;
		var re_password = document.forms["updateAdminPassword"]["re_password"].value;
		var err = '';
		if (password == null || password == "" || password.length < 6) {
			  $('#password').closest('.col-sm-10').addClass('has-error');
			  $('#password').focus();
			  err = "Password must be filled and of more than 6 characters! \n";
			  $('#password').next('.error-content').html(err).show();
			  return false;
		}else{
			 $('#password').closest('.col-sm-10').removeClass('has-error');
			 $('#password').next('.error-content').hide();

			  if (re_password == null || re_password == '' ) {
					 err  = "Please re enter password! \n";
					 document.getElementById("re_password").focus();
					 $('#re_password').parent('.col-sm-10').addClass('has-error');
					 $('#re_password').next('.error-content').html(err).show();
					 return false;
			 }else{
				 if (re_password != password) {
					 err  = "Both passwords must be matched! \n";
					 document.getElementById("re_password").focus()
					 $('#re_password').parent('.col-sm-10').addClass('has-error');
					 $('#re_password').next('.error-content').html(err).show();
					return false;
				 }else{
						var validEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
						if(email != null && validEmail.test(email)) {
							$(".form-group-email").removeClass('has-error');
							return true;
						}else{
							$(".form-group-email").addClass('has-error');
							return false;
						}

				}
			 }
		}
}

$(document).on('click','#change-passowrd', function(){
	if($(this).is(':checked')){
		$('#password').addClass('field-validate');
		$('.password').show();
	}else{
        $('.password').hide();
		$('#password').parents('div.form-group').removeClass('has-error');
		$('#password').removeClass('field-validate');
	}
});


$( "#registration" ).on('click','#submit',function( event ) {

  var param =  $( "#parameter" ).val();
  var select = $( "#FilterBy" ).val();

        if( (select == null) || (param == "")) {
            $( "#contact-form12" ).text( "fill the credentials!" ).css({'color':'red'}).show().fadeOut( 10000 );
            $( "#parameter" ).css({'border-color':'red'});
            $( "select" ).css({'border-color':'red'});
            event.preventDefault();
        }else {
          // $( "#contact-form12" ).text( "fill the credentials!" ).css({'padding-left':'10px','margin-right':'20px','padding-bottom':'2px', 'color':'red'}).show().fadeOut( 10000 );
          //     event.preventDefault();
        }
});


Dropzone.options.myDropzone = {
    paramName: 'file',
    maxFilesize: 5, // MB
    maxFiles: 20,
    acceptedFiles: ".jpeg,.jpg,.png,.gif",
    init: function() {
		//alert("ok");
        this.on("success", function(file, response) {
            var a = document.createElement('span');
            // a.className = "thumb-url btn btn-primary";
            a.setAttribute('data-clipboard-text','{{url('admin/media/uploadimage')}}'+'/'+response);
            // a.innerHTML = "copy url";
            file.previewTemplate.appendChild(a);

        });

        this.on("success", function(){
            $("#compelete").removeAttr("disabled");
            $("#compelete").click(function(){

            location.reload()})});


    }
};



$('.thumb-url').tooltip({
    trigger: 'click',
    placement: 'bottom'
});

function setTooltip(btn, message) {
    $(btn).tooltip('hide')
        .attr('data-original-title', message)
        .tooltip('show');
}

function hideTooltip(btn) {
    setTimeout(function() {
        $(btn).tooltip('hide');
    }, 500);
}

var clipboard = new Clipboard('.thumb-url');

clipboard.on('success', function(e) {
    e.clearSelection();
    setTooltip(e.trigger, 'Copied!');
    hideTooltip(e.trigger);

});


clipboard.on('error', function(e) {
    e.clearSelection();
    setTooltip(e.trigger, 'Failed');
    hideTooltip(e.trigger);
});

$(document).ready(function(){
    $("#myModaldetail").on("show.bs.modal", function(e) {
        var id = $(e.relatedTarget).data('target-id');
        $.get( "{{URL::to('admin/detailimage')}}"+'/' + id, function( data ) {
            $(".image_embed").html(data);
        });

    });
});

function ConfirmDelete()
{
    var Delete = confirm("Are you sure you want to delete?");
    if (Delete)
        return true;
    else
        return false;
}

$("select.show-html").imagepicker();
$("#AddImage").click(function(){ window.location.href = '{{url("admin/media/addimages")}}'; });

$(document).on('click','#selected', function(){
    var image_src = $('.thumbnail.selected').children('img').attr('src');
	if(image_src != undefined){
		$('#selectedthumbnail').html('<img src="'+image_src+'" class = "thumbnail" style="max-height: 100px; margin-top: 20px;">');
		$('#selectedthumbnail').show();
		$('#image-close').show();
		$('#imageselected').removeClass('has-error');
		$('#newImage').removeClass('field-validate');
		$('.thumbnail.selected').removeClass('selected');
	}
});

$(document).on('click','#image-close', function(){
   $("select.show-html:not(#countertop_countertype_id)").val('').imagepicker({
        // show_label:   true,
        clicked:function(){
            $(this).find("option[value='" + $(this).val() + "']").empty();
        }
    });
    $('#selectedthumbnail').hide();
    $('#image-close').hide();
    $('#imageselected').removeClass('has-error');
});

$(document).on('click','#closemodal', function(){
    $("select.show-html:not(#countertop_countertype_id)").val('').imagepicker({
        // show_label:   true,
        clicked:function(){
            $(this).find("option[value='" + $(this).val() + "']").empty();
        }
    });
});

$(document).on('click','#selectedICONE', function(){
    var image_src = $('.thumbnail.selected').children('img').attr('src');
	if(image_src != undefined){
		$('#selectedthumbnailIcon').html('<img src="'+image_src+'" class = "thumbnail" style="max-height: 100px; margin-top: 20px; ">');
		$('#selectedthumbnailIcon').show();
		$('#image-Icone').show();
		$('#imageIcone').removeClass('has-error');
		$('#newIcon').removeClass('field-validate');
	}
});



//show modal
$(document).on('click','.add-image', function(){
  var parent_id = $(this).parents('.image-content').attr('id');
  $('#'+parent_id+ ' #imagemodel').modal('show');
});


//select image from modal
$(document).on('click','.selected-image', function(){
  var parent_id = $(this).parents('.image-content').attr('id');
  var image_src = $('#'+parent_id + ' .thumbnail.selected').children('img').attr('src');
  if(image_src != undefined){
  	$('#'+parent_id+ ' .selectedthumbnail').html('<img src="'+image_src+'" class = "thumbnail" style="max-height: 100px; margin-top: 20px; ">');

	$('#'+parent_id+ '.selectedthumbnail').show();
    $('#'+parent_id+ '#show-image-btn').show();
    $('#'+parent_id).removeClass('has-error');
    $('#'+parent_id).removeClass('field-validate');

	}
});

$(document).on('click','#image-Icone', function(){	
	var oldimage = $('#oldImage').val();
	console.log(oldimage);
	if(oldimage == undefined){
		$('#newIcon').addClass('field-validate');
	}

	$("select.show-html:not(#countertop_countertype_id)").val('').imagepicker({
    //$("select.show-html.iconimg:not(#countertop_countertype_id)").val('').imagepicker({
        // show_label:   true,
        clicked:function(){
            $(this).find("option[value='" + $(this).val() + "']").empty();
        }
    });
    $('#selectedthumbnailIcon').hide();
    $('#image-Icone').hide();
    $('#imageIcone').removeClass('has-error');

});



var idCount = 1;
$('.products_left_banner').each(function() {
    // $(this).attr('id', 'left_banner_selected' + idCount);
    var selectid = '#left_banner_selected'+idCount;

    var selectedthumbnail = '#selectedthumbnail'+idCount;
    var imageright = '#newImageleft'+idCount;
    // alert(selectid);
    var imageclose = '#image-close'+idCount
    $(document).on('click',selectid, function(){
        var image_src = $('.thumbnail.selected').children('img').attr('src');
		if(image_src != undefined){
			$(selectedthumbnail).html('<img src="'+image_src+'" class = "thumbnail" style="max-height: 100px; margin-top: 20px;">');
			$(selectedthumbnail).show();
			$(imageclose).show();
			$('#imageselected').removeClass('has-error');
			$(imageright).removeClass('field-validate');
			$('.thumbnail.selected').removeClass('selected');
		}

    });

    $(document).on('click',imageclose, function(){
        $("select.show-html:not(#countertop_countertype_id)").val('').imagepicker({
            // show_label:   true,
            clicked:function(){
                $(this).find("option[value='" + $(this).val() + "']").empty();
            }
        });
       $(selectedthumbnail).hide();
        $(imageclose).hide();
        $('#imageselected').removeClass('has-error');
    });

    $(document).on('click','#closemodal', function(){
        $("select.show-html:not(#countertop_countertype_id)").val('').imagepicker({
            // show_label:   true,
            clicked:function(){
                $(this).find("option[value='" + $(this).val() + "']").empty();
            }
        });
    });
    idCount++;

});

var idCount = 1;
$('.products_right_banner').each(function() {
    // $(this).attr('id', 'left_banner_selected' + idCount);
    var selectid = '#right_banner_selected'+idCount;
    var selectedthumbnail = '#selectedthumbnail_right_banner'+idCount;
    // alert(selectid);
    var imageclose = '#image-close_right_banner'+idCount
    var imageright = '#newImageright'+idCount
    $(document).on('click',selectid, function(){
        var image_src = $('.thumbnail.selected').children('img').attr('src');
		if(image_src != undefined){
			$(selectedthumbnail).html('<img src="'+image_src+'" class = "thumbnail" style="max-height: 100px; margin-top: 20px;">');
			$(selectedthumbnail).show();
			$(imageclose).show();
			$('#imageselected').removeClass('has-error');
			$(imageright).removeClass('field-validate');
			$('.thumbnail.selected').removeClass('selected');
		}

    });

    $(document).on('click',imageclose, function(){
        $("select.show-html:not(#countertop_countertype_id)").val('').imagepicker({
            // show_label:   true,
            clicked:function(){
                $(this).find("option[value='" + $(this).val() + "']").empty();
            }
        });
        $(selectedthumbnail).hide();
        $(imageclose).hide();
        $('#imageselected').removeClass('has-error');
    });

    $(document).on('click','#closemodal', function(){
        $("select.show-html:not(#countertop_countertype_id)").val('').imagepicker({
            // show_label:   true,
            clicked:function(){
                $(this).find("option[value='" + $(this).val() + "']").empty();
            }
        });
    });
    idCount++;
});

//ajax call for submit value
$(document).on('click', '.refresh-image', function(e){
	$("#loader").show();
	$.ajax({
		url: '{{ URL::to("admin/media/refresh")}}',
		type: "GET",
		success: function (res) {
			$("#loader").hide();
			if(res.length != ''){
				$('.show-html').html(res);
			}else{
				$('.addError').show();
			}
      $("select.show-html").imagepicker();
		},
	});
});



//ajax call for confirm passowrd match
$(document).on('click', '#password-confirm-btn', function(e){
	$("#checkpassword").modal('show');
});

$(document).on('click', '#check-password', function(e){
	var password = $("#password").val();
	if(password !=''){
		$.ajax({
			url: '{{ URL::to("admin/managements/checkpassword")}}',
			type: "post",
			data: '&password='+password,
			success: function (res) {

				if(res == 1){
					//submit form of updater
					$("#checkpassword").modal('hide');
					$("#updater-form").submit();
				}else{
					//$("#passowrd-error").show();
					//setTimeout(function(){ $("#passowrd-error").hide(); }, 3000);
				}

			},
		});
	}else{
		$("#passowrd-error").show();
		setTimeout(function(){ $("#passowrd-error").hide(); }, 3000);
	}
});

$(document).ready(function() {
$('.select2').select2({
closeOnSelect: false
});
});

//ajax call for submit value
$(document).on('click', '#addDefaultAttribute', function(e){
	
	var formData = $('#adddefaultattributefrom').serialize();
	$.ajax({
		url: '{{ URL::to("admin/menuitems/attach/addons/add")}}',
		type: "POST",
		data: formData,
		success: function (res) {
			
			if(res.length != ''){
				$('.addError').hide();
				$('#adddefaultattributesmodal').modal('hide');
				var i;
				var showData = [];
				for (i = 0; i < res.length; ++i) {
					var j = i + 1;
					showData[i] = "<tr><td>"+j+"</td><td>"+res[i].extra_options_name+"</td><td>"+res[i].extra_options_price+"</td><td><a class='badge bg-light-blue editdefaultattributemodal' products_attributes_id = '"+res[i].items_addons_id+"' products_id = '"+res[i].item_id+"' options_id ='"+res[i].extra_options_id+"'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></a> <a class='badge bg-red deletedefaultattributemodal' products_attributes_id = '"+res[i].items_addons_id+"' products_id = '"+res[i].item_id+"' ><i class='fa fa-trash' aria-hidden='true'></i></a></td></tr>";

				}
				$(".contentDefaultAttribute").html(showData);

			}else{
				$('.addDefaultError').show();
			}


		},
	});


});

</script>

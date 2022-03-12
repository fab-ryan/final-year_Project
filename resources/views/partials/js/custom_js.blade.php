<script>
	@if(Session::has('message'))
		var type="{{Session::get('alert-type','info')}}"


		switch(type){
			case 'info':
		         toastr.info("{{ Session::get('message') }}");
		         break;
	        case 'success':
	            toastr.success("{{ Session::get('message') }}");
	            break;
         	case 'warning':
	            toastr.warning("{{ Session::get('message') }}");
	            break;
	        case 'error':
		        toastr.error("{{ Session::get('message') }}");
		        break;
		}
	@endif


        $.ajaxSetup({
headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $(document).ready(function () {
    $('#depart').on('change',function(e) {
    var depart_id = e.target.value;
    $.ajax({
    url:"{{ route('academic.searchCourses') }}",
    type:"POST",
    data: {
    depart_id: depart_id
    },
    success:function (data) {

if(data){
                            $('#course').empty();
                            $('#course').append('<option hidden>Choose Course</option>');
                            $.each(data.courses,function(key, course){
                                $('select[name="course_id[]"]').append('<option value="'+ course.id +'">' + course.course_code+ '</option>');

                            });
                            }else{
                            $('#course').empty();
    }
    }
    })
    });
    });





    function disableBtn(btn){
        var btnText = btn.data('text') ? btn.data('text') : 'Submitting';
        btn.prop('disabled', true).html('<i class="icon-spinner mr-2 spinner"></i>' + btnText);
    }

    function enableBtn(btn){
        var btnText = btn.data('text') ? btn.data('text') : 'Submit Form';
        btn.prop('disabled', false).html(btnText + '<i class="icon-paperplane ml-2"></i>');
    }

    function displayAjaxErr(errors){
        $('#ajax-alert').show().html(' <div class="alert alert-danger border-0 alert-dismissible" id="ajax-msg"><button type="button" class="close" data-dismiss="alert"><span>&times;</span></button></div>');
        $.each(errors, function(k, v){
            $('#ajax-msg').append('<span><i class="icon-arrow-right5"></i> '+ v +'</span><br/>');
        });
        scrollTo('body');
    }

    function scrollTo(el){
        $('html, body').animate({
            scrollTop:$(el).offset().top
        }, 2000);
    }

    function hideAjaxAlert(){
        $('#ajax-alert').hide();
    }

    function clearForm(form){
        form.find('.select, .select-search').val([]).select2({ placeholder: 'Select...'});
        form[0].reset();
    }


/**
 * An object for managing tasks related to timeslots
 */

  /**
 * An object for managing tasks related to timeslots
 */










       $.ajaxSetup({
headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $(document).ready(function () {
    $('#department_id').on('change',function(e) {
    var depart_id = e.target.value;

    $.ajax({
    url:"{{ route('academic.search.level') }}",
    type:"POST",
    data: {
    depart_id: depart_id
    },
    success:function (data) {

if(data){
    console.log(data);
                            $('#level_id').empty();
                            $('#level_id').append('<option hidden>Choose Level</option>');
                            $.each(data.level,function(key, level){
                                $('select[name="level_id"]').append('<option value="'+ level.id +'">' + level.level_name+ '</option>');

                            });
                            }else{
                            $('#level_id').empty();
    }
    }
    })
    });
    });








</script>

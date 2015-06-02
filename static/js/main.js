$(document).ready(function() {
	// 아이템 추가를 위한 Datepicker
	$("#start_date").datepicker({
		changeMonth: true,
		nextText: '다음 달',
		prevText: '이전 달', 
		dayNames: ['일요일', '월요일', '화요일', '수요일', '목요일', '금요일', '토요일'],
		dayNamesMin: ['일', '월', '화', '수', '목', '금', '토'], 
		monthNamesShort: ['1','2','3','4','5','6','7','8','9','10','11','12'],
		monthNames: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
		showButtonPanel: true,
		closeText: '닫기',
		dateFormat: "yy-mm-dd",
		minDate: "+2D",
		maxDate: "+1Y",
		defaultDate: +2
  	});
	
	$("#end_date").datepicker({
		changeMonth: true,
		nextText: '다음 달',
		prevText: '이전 달', 
		dayNames: ['일요일', '월요일', '화요일', '수요일', '목요일', '금요일', '토요일'],
		dayNamesMin: ['일', '월', '화', '수', '목', '금', '토'], 
		monthNamesShort: ['1','2','3','4','5','6','7','8','9','10','11','12'],
		monthNames: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
		showButtonPanel: true,
		closeText: '닫기',
		dateFormat: "yy-mm-dd",
		minDate: "+2D",
		maxDate: "+1Y",
		defaultDate: +2
  	});
	$("#deadline_date").datepicker({
		changeMonth: true,
		nextText: '다음 달',
		prevText: '이전 달', 
		dayNames: ['일요일', '월요일', '화요일', '수요일', '목요일', '금요일', '토요일'],
		dayNamesMin: ['일', '월', '화', '수', '목', '금', '토'], 
		monthNamesShort: ['1','2','3','4','5','6','7','8','9','10','11','12'],
		monthNames: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
		showButtonPanel: true,
		closeText: '닫기',
		dateFormat: "yy-mm-dd",
		minDate: "+1D",
		maxDate: "+1Y",
		defaultDate: +1
  	});

  	// 아이템 편집을 위한 Datepicker
  	$("#edit_start_date").datepicker({
		changeMonth: true,
		nextText: '다음 달',
		prevText: '이전 달', 
		dayNames: ['일요일', '월요일', '화요일', '수요일', '목요일', '금요일', '토요일'],
		dayNamesMin: ['일', '월', '화', '수', '목', '금', '토'], 
		monthNamesShort: ['1','2','3','4','5','6','7','8','9','10','11','12'],
		monthNames: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
		showButtonPanel: true,
		closeText: '닫기',
		dateFormat: "yy-mm-dd",
		minDate: "+1D",
		maxDate: "+1Y",
		defaultDate: +2
  	});
	
	$("#edit_end_date").datepicker({
		changeMonth: true,
		nextText: '다음 달',
		prevText: '이전 달', 
		dayNames: ['일요일', '월요일', '화요일', '수요일', '목요일', '금요일', '토요일'],
		dayNamesMin: ['일', '월', '화', '수', '목', '금', '토'], 
		monthNamesShort: ['1','2','3','4','5','6','7','8','9','10','11','12'],
		monthNames: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
		showButtonPanel: true,
		closeText: '닫기',
		dateFormat: "yy-mm-dd",
		minDate: "+1D",
		maxDate: "+1Y",
		defaultDate: +2
  	});
	$("#edit_deadline_date").datepicker({
		changeMonth: true,
		nextText: '다음 달',
		prevText: '이전 달', 
		dayNames: ['일요일', '월요일', '화요일', '수요일', '목요일', '금요일', '토요일'],
		dayNamesMin: ['일', '월', '화', '수', '목', '금', '토'], 
		monthNamesShort: ['1','2','3','4','5','6','7','8','9','10','11','12'],
		monthNames: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
		showButtonPanel: true,
		currentText: '오늘',
		closeText: '닫기',
		dateFormat: "yy-mm-dd",
		minDate: "+0D",
		maxDate: "+1Y",
		defaultDate: +1
  	});
});
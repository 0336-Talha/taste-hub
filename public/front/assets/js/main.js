$(window).on("load", function () {
	/*_____ Toggle _____*/
	$(document).on("click", ".toggle", function () {
		$(".toggle").toggleClass("active")
		$("html").toggleClass("flow")
		$("body").toggleClass("move")
		$("nav").toggleClass("active")
	})
	$(document).on("click", ".toggle.active", function () {
		$(".toggle").removeClass("active")
		$("html").removeClass("flow")
		$("body").removeClass("move")
		$("nav").removeClass("active")
	})
	if ($(window).width() < 992) {
		$(document).on("click", "#nav ul > li.drop > a", function () {
			$(this).parent("li").find("#mega__menu__list").slideToggle()
		})
	}
	/*_____ Popup _____*/
	$(document).on("click", ".popup", function (e) {
		if ($(e.target).closest(".popup ._inner, .popup .inside").length === 0) {
			$(".popup").fadeOut("3000")
			$("html").removeClass("flow")
			$("#vid_blk > iframe, #vid_blk > video").attr("src", "")
		}
	})
	$(document).on("click", ".popup .x_btn", function () {
		$(".popup").fadeOut()
		$("html").removeClass("flow")
		$("#vid_blk > iframe, #vid_blk > video").attr("src", "")
	})
	$(document).keydown(function (e) {
		if (e.keyCode == 27) $(".popup .x_btn").click()
	})
	$(document).on("click", ".pop_btn", function (e) {
		e.target
		e.relatedTarget
		var popUp = $(this).attr("data-popup")
		$("html").addClass("flow")
		$(".popup[data-popup= " + popUp + "]").fadeIn()
		$("#slick-restock").slick("setPosition")
	})
	
	$(document).on("click", ".pop_btn[data-src]", function () {
		var src = $(this).attr("data-src")
		$("#vid_blk > iframe, #vid_blk > video").attr("src", src)
	})
	$(document).on("click", ".confirm_btn_popup", function () {
		$(this).parents(".confirm_popup").fadeOut()
	})
	$(".rateYo").rateYo({
		starWidth: "17px",
		ratedFill: "#d6992a",
		rating: 5,
		readOnly:"true"
	  });
	  $("._rateYo").rateYo({
		starWidth: "17px",
		ratedFill: "#d6992a",
	  });

	/*_____ Rating _____*/
	$(".rating").each(function () {
		let rating = $(this).data("rating")
		if (rating <= 5) {
			for (let i = rating; i < 5; i++) {
				$(this).append("<i></i>")
			}
			for (let i = 1; i <= rating; i++) {
				$(this).append("<i class='fill'></i>")
			}
		}
	})

	$(document).on("click", ".faq_blk > .title", function () {
		$(".faq_blk").not($(this).parent().toggleClass("active")).removeClass("active")
		$(".faq_blk > .text").not($(this).parent().children(".text").slideToggle()).slideUp()
	})
	$(".faq_lst > .faq_blk:nth-child(1)").addClass("active")

	/*_____ Accord Block _____*/
	$(document).on("click", ".accord_blk .title", function () {
		$(this).parent().toggleClass("active")
		$(this).parent().find(".data, .back").slideToggle()
	})

	/*_____ Qty Button _____*/
	// This button will increment the value
	$(document).on("click", ".qty_btn .plus", function (e) {
		e.preventDefault()
		var parnt = $(this).parent().children(".qty")
		var currentVal = parnt.val()
		if (!isNaN(currentVal)) {
			parnt.val(parseInt(currentVal) + 1)
		} else {
			parnt.val(0)
		}
	})
	// This button will decrement the value till 0
	$(document).on("click", ".qty_btn .minus", function (e) {
		e.preventDefault()
		var parnt = $(this).parent().children(".qty")
		var currentVal = parnt.val()
		if (!isNaN(currentVal) && currentVal > 0) {
			parnt.val(parseInt(currentVal) - 1)
		} else {
			parnt.val(0)
		}
	})

	/*
	|----------------------------------------------------------------------
	|		OTHER JAVASCRIPT
	|----------------------------------------------------------------------
	*/
	$("#slick-brands").slick({
		dots: true,
		arrows: false,
		infinite: true,
		speed: 1000,
		slidesToShow: 8,
		slidesToScroll: 1,
		responsive: [
			{
				breakpoint: 1025,
				settings: {
					slidesToShow: 7,
				},
			},
			{
				breakpoint: 992,
				settings: {
					slidesToShow: 6,
				},
			},
			{
				breakpoint: 768,
				settings: {
					slidesToShow: 5,
				},
			},
			{
				breakpoint: 580,
				settings: {
					slidesToShow: 4,
				},
			},
			{
				breakpoint: 480,
				settings: {
					slidesToShow: 3,
				},
			},
		],
	})
	$("#slick-folio").slick({
		dots: false,
		arrows: true,
		infinite: true,
		speed: 1000,
		slidesToShow: 1,
		slidesToScroll: 1,
	})
	$("#slick-detail").slick({
		dots: true,
		fade: true,
		speed: 1000,
		slidesToShow: 1,
		slidesToScroll: 1,
		// asNavFor: "#slick-detail-thumb",
		customPaging: function (slick, i) {
			var img = slick.$slides.eq(i).find("img").attr("src")
			return "<img src='" + img + "' alt=''>"
		},
	})
	$("#slick-detail-thumb").slick({
		arrows: false,
		centerMode: true,
		variableWidth: true,
		centerPadding: 0,
		focusOnSelect: true,
		draggable: false,
		slidesToShow: 2,
		slidesToScroll: 1,
		asNavFor: "#slick-detail",
	})
})

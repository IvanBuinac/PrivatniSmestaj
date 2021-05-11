		$(document).ready(function(){
			

			/* Slide Toogle */
			$("ul.expmenu li > div.header").click(function()
			{
				var arrow = $(this).find("span.arrow");

				if(arrow.hasClass("up"))
				{
					arrow.removeClass("up");
					arrow.addClass("down");
				}
				else if(arrow.hasClass("down"))
				{
					arrow.removeClass("down");
					arrow.addClass("up");
				}
				
				$(this).parent().find("ul.menu").slideToggle();
			});
			$("ul.expmenu1 li > div.header1").click(function()
			{
				var arrow = $(this).find("span.arrow");

				if(arrow.hasClass("up"))
				{
					arrow.removeClass("up");
					arrow.addClass("down");
				}
				else if(arrow.hasClass("down"))
				{
					arrow.removeClass("down");
					arrow.addClass("up");
				}

				$(this).parent().find("ul.menu1").slideToggle();
			});
		});
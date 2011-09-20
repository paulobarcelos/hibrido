/* Author:
	Paulo Barcelos September 2011
*/
var HIBRIDO = HIBRIDO || {};

HIBRIDO.site = new function(){
	_this = this;
	
	var colors,
		shapes,
		body,
		logo;
	
	
	
	this.init = function(){				
		colors = new Object()
		colors.none = '#DDD';	
		colors.red = '#FFE1E1';
		colors.yellow = '#FFFEDE';
		colors.green = '#DFF9D9';
		colors.blue = '#DAF4F7';
		
		body = $('body');
		logo = $('#header .logotype');
		
		shapes = [];
		
		$('#mainnavigation').find('li').each(function(index) {
			_this.deselect($(this), true);
			
			$(this).children('.shapes').children().each(function(index) {
				var shape = [$(this), (Math.random()*2-1), 0];
				shapes.push(shape);
			});
			
			$(this).hover(function(){
				_this.select($(this))
			},function () {
				_this.deselect($(this))
			});
			
		});
		
		this.animate();		
	}
	
	this.deselect = function(item, imediate){
		imediate = imediate || false;
		
		var duration = (imediate)?0:300,
			scaleString = 'scale('+0.6+')',
			itemShapes = item.children('.shapes');
			itemlink = item.children('.link');
			
		itemShapes.stop(true).animate({
		    transform : scaleString
		}, duration*2);
		
		itemlink.stop(true).animate({
			'color' : '#444',
		    top : (itemShapes.height())		    
		}, duration);
		
		var color = colors.none;
		
		body.stop(true).delay(duration*2).animate({
			'backgroundColor' : color	    
		}, duration*3);
		
		logo.delay(duration*3).removeClass('yellow red green blue');
	}
	
	this.select = function(item, imediate){
		imediate = imediate || false;
		var duration = (imediate)?0:300,
			scaleString = 'scale('+1+')',
			itemShapes = item.children('.shapes');
			itemlink = item.children('.link');
			
		itemShapes.stop(true).animate({
		    transform : scaleString
		}, duration+duration);

		itemlink.stop(true).animate({
			'color' : '#fff',
		    top : (itemShapes.height()*0.5 - itemlink.height()*0.5)	    
		}, duration);
		
		var color,
			colorClass = jQuery.trim(item.attr("class"));
		switch (colorClass){
			case 'red':
				color = colors.red;
				break;
			case 'yellow':
				color = colors.yellow;
				break;
			case 'green':
				color = colors.green;
				break;
			case 'blue':
				color = colors.blue;
				break;
		}
		
		body.stop(true).delay(duration*2).animate({
			'backgroundColor' : color	    
		}, duration*3);
		
		logo.delay(duration*3).removeClass('yellow red green blue').addClass(colorClass);
	}
	
	this.animate = function(){
		requestAnimationFrame(_this.animate);
		_this.render();
	}
	this.render = function(){
		for(var i = 0; i < shapes.length; i++){
			var shape = shapes[i];
			var newAngle = shape[2]+shape[1];
			shape[2] = newAngle;
			var angleString = 'rotate('+newAngle+'deg)';
			shape[0].css({
			    transform : angleString
			});
		}		
	}
}

$(function() {
	if(Modernizr.csstransforms && $('body').hasClass('home')){
		HIBRIDO.site.init();
	}	
});



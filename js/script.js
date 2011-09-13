/* Author:
	Paulo Barcelos September 2011
*/
var HIBRIDO = HIBRIDO || {};

HIBRIDO.site = new function(){
	_this = this;
	
	var shapes = [];
	this.init = function(){		
		this.animate();
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
	}
	
	this.deselect = function(item, imediate){
		imediate = imediate || false;
		var duration = (imediate)?0:300;
		var scaleString = 'scale('+0.6+')';
		item.children('.shapes').stop(true).animate({
		    transform : scaleString
		}, duration+duration);
		
		item.children('.link').stop(true).animate({
			'color' : '#444',
		    top : (232)		    
		}, duration);
	}
	
	this.select = function(item, imediate){
		imediate = imediate || false;
		var duration = (imediate)?0:300;
		var scaleString = 'scale('+1+')';
		item.children('.shapes').stop(true).animate({
		    transform : scaleString
		}, duration+duration);
		
		item.children('.link').stop(true).animate({
			'color' : '#fff',
		    top : (232/2)	    
		}, duration);
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



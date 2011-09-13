/* Author:
	Paulo Barcelos September 2011
*/
var HIBRIDO = HIBRIDO || {};

HIBRIDO.site = new function(){
	_this = this;
	
	var shapes = [];
	this.init = function(){		
		this.animate();
		$('.shapes').each(function(index) {
			console.log
			$(this).children().each(function(index) {
				var shape = [$(this), (Math.random()*1-0.5), 0];
				shapes.push(shape);
			});
		});
	}
	
	this.animate = function(){
		requestAnimationFrame(_this.animate);
		for(var i = 0; i < shapes.length; i++){
			_this.rotate(shapes[i]);
		}
	}
	this.rotate = function(shape){
		var newAngle = shape[2]+shape[1];
		shape[2] = newAngle;
		var angleString = 'rotate('+newAngle+'deg)';
		shape[0].css({
		    '-webkit-transform': angleString,
		    '-moz-transform': angleString,
		    '-o-transform': angleString,
		    '-ms-transform': angleString,
		    transform : angleString
		});
	}
}

$(function() {
	if(Modernizr.csstransforms && $('body').hasClass('home')){
		HIBRIDO.site.init();
	}	
});



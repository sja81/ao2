( function() {
	
	var AIOSMortgageCalculator = function(elem) {
		
		var that = this;
		
		that.elem = jQuery(elem);
		
		//Attach form event
		that.elem.submit( function(e) {
			
			e.preventDefault();
			
			that.resetResults(that);
			
			if ( that.isFormValid(that) ) {
				that.compute(that);
				that.scrollToResults(that);
			}
			
		});
		
	}
	
	AIOSMortgageCalculator.prototype.scrollToResults = function(context) {
		
		var that = context;
		
		var top = that.elem.find('.aios-mortgage-calculator-standalone-calculation-result').offset().top;
		var allowance = 150;
		
		jQuery("html,body").animate({
			scrollTop: ( top - allowance )
		},200);
		
	}
	
	AIOSMortgageCalculator.prototype.resetResults = function(context) {
		
		var that = context;
		
		that.elem.find("input[name='PI']").val('');
		that.elem.find("input[name='MT']").val('');
		that.elem.find("input[name='MI']").val('');
		that.elem.find("input[name='MP']").val('');
		
	}
	
	AIOSMortgageCalculator.prototype.isFormValid = function(context) {
		
		var that = context;
		var isValid = true;
		
		//Number fields
		var numberFields = that.elem.find(".aios-mortgage-calculator-standalone-number");
		
		//Reset errors
		numberFields.each( function(i,v) {
			
			that.elem.find(".aios-mortgage-calculator-standalone-error-tooltip").remove();
			numberFields.removeClass("aios-mortgage-calculator-standalone-error");
			
		});
		
		//Display errors
		numberFields.each( function(i,v) {
			
			if ( isNaN( parseInt( jQuery(v).val() ) ) ) {
				var div = jQuery("<div class='aios-mortgage-calculator-standalone-error-tooltip'></div>");
				div.html("Specify a valid number");
				jQuery(v).addClass("aios-mortgage-calculator-standalone-error").after(div);
				isValid = false;
			}
			
		});
		
		return isValid;
		
	}
	
	AIOSMortgageCalculator.prototype.floor = function(number) {
		return Math.floor(number*Math.pow(10,2))/Math.pow(10,2);
	}
	
	AIOSMortgageCalculator.prototype.compute = function(context) {
		
		var that = context;
		
		var mi = parseInt( that.elem.find("input[name='IR']").val() ) / 1200;
		var base = 1;
		var mbase = 1 + mi;
		
		for (i=0; i<parseInt( that.elem.find("input[name='YR']").val() ) * 12; i++) {
			base = base * mbase;
		}
		
		that.elem.find("input[name='PI']").val( that.floor( parseInt( that.elem.find("input[name='LA']").val() ) * mi / ( 1 - (1/base))) );
		that.elem.find("input[name='MT']").val( that.floor( parseInt( that.elem.find("input[name='AT']").val() ) / 12) );
		that.elem.find("input[name='MI']").val( that.floor( parseInt( that.elem.find("input[name='AI']").val() ) / 12) );
		
		var dasum = parseInt( that.elem.find("input[name='LA']").val() ) * mi / ( 1 - (1/base)) + parseInt( that.elem.find("input[name='AT']").val() ) / 12 + parseInt( that.elem.find("input[name='AI']").val() ) / 12;
		that.elem.find("input[name='MP']").val( that.floor(dasum) );
	}
	
	jQuery(document).ready( function() {
		
		jQuery(".aios-mortgage-calculator-standalone").each( function(i,v) {
			new AIOSMortgageCalculator( jQuery(v) );
		});
		
	});
	
})();


 


	jQuery(document).ready(function() {   
	   FormValidation.init();
	});
	

        $(function() {
            $(".datepicker").datepicker();
            $(".uniform_on").uniform();
            $(".chzn-select").chosen();
            $('.textarea').wysihtml5();

            $('#rootwizard').bootstrapWizard({onTabShow: function(tab, navigation, index) {
                var $total = navigation.find('li').length;
                var $current = index+1;
                var $percent = ($current/$total) * 100;
                $('#rootwizard').find('.bar').css({width:$percent+'%'});
                // If it's the last tab then hide the last button and show the finish instead
                if($current >= $total) {
                    $('#rootwizard').find('.pager .next').hide();
                    $('#rootwizard').find('.pager .finish').show();
                    $('#rootwizard').find('.pager .finish').removeClass('disabled');
                } else {
                    $('#rootwizard').find('.pager .next').show();
                    $('#rootwizard').find('.pager .finish').hide();
                }
            }});
            $('#rootwizard .finish').click(function() {
                alert('Finished!, Starting over!');
                $('#rootwizard').find("a[href*='tab1']").trigger('click');
            });
        });
		
	function DisableKey(e,type) {    var desimal = e.charCode? e.charCode : e.keyCode;     if(type == 'alphabet'){    if((desimal==34 || desimal==8 || desimal==9 || desimal==32) || (desimal==45 || desimal==46 || desimal==47) ){ 
    return true;    }else{    if ((desimal<65||desimal>90) && (desimal<97||desimal>122)) { //jika bukan huruf
    return false;     }    }                                        
    }else{          if((desimal==45 || desimal==46) || (desimal==8 || desimal==9)){ // jika menekan tombol Backspace, Tab dan titik diperbolehkan
    return true;    }else{    if (desimal<48 || desimal>57) { //jika bukan angka
    return false; //matikan tombol
    }
    }
    }
   }
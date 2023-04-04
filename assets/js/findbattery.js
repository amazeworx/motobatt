jQuery(function($){

    //* Find Battery
    $('#select-brand').prepend( $('<option></option>').val('0').html(findbattery_object.choose_brand).attr({ selected: 'selected', disabled: 'disabled'}) );
    $('#select-model').prepend( $('<option></option>').val('0').html(findbattery_object.choose_model).attr({ selected: 'selected', disabled: 'disabled'}) );

    if(applicationsJson !== null) {
        if (applicationsJson.hasOwnProperty('brands')) {
            $.each(applicationsJson.brands, function (index, value) {
                $("#select-brand").append('<option value="' + value.slug + '">' + value.name + '</option>');
            });

            var selectedBrand = '';
            $('#select-brand').change(function() {
                $('#select-model').empty();
                selectedBrand = $(this).val();
                //console.log(selectedState);
                for(var i = 0; i < applicationsJson.brands.length; i++) {
                    if(applicationsJson.brands[i].slug == $(this).val()) {
                    $('#select-model').prepend( $('<option></option>').val('0').html('Pilih Model Motor').attr({ selected: 'selected', disabled: 'disabled'}) );
                        $.each(applicationsJson.brands[i].models, function (index, value) {
                            $('#select-model').append('<option value="' + value.slug + '">' + value.name + '</option>');
                        });
                    }
                }
            });

            var selectedModel = '';
            $('#select-model').change(function() {
                selectedModel = $(this).val();
            });

            $('#button-find-battery').click(function() {
                var selectedURL = findbattery_object.recommendation_url + '?model=' + selectedModel;
                window.location = selectedURL;
            });

        }
    }

});

   $.ajax({
            url: 'https://www.universal-tutorial.com/api/getaccesstoken',
            method: 'GET',
            headers: {
                "Accept": "application/json",
                "api-token": "8k1AiRjAFJMqp8Lx8K9AlUYHe6lT8jn1oZ0Som4kMAPPeIukaY1xYqH5Jp1Dmpo2JR8",
                "user-email": "ismaelek03@gmail.com"
            },
            success: function (data) {
                if(data.auth_token){
                    var auth_token = data.auth_token;
                    $.ajax({
                        url: 'https://www.universal-tutorial.com/api/countries/',
                        method: 'GET',
                        headers: {
                            "Authorization": "Bearer " + auth_token,
                            "Accept": "application/json"
                        },
                        success: function (data) {
                            var countries = data;

                            var comboCountries = "<option value=''>Seleccionar</option>";
                            countries.forEach(element => {
                                comboCountries += '<option value="' + element['country_name'] + '">' + element['country_name']+'</option>';
                            });

                            $("#paises").html(comboCountries);

                            // State list

                            $("#paises").on("change", function(){
                                var country = this.value;
                                $("#pais_seleccionado").val(country);
                                $.ajax({
                                    url: 'https://www.universal-tutorial.com/api/states/' + country,
                                    method: 'GET',
                                    headers: {
                                        "Authorization": "Bearer " + auth_token,
                                        "Accept": "application/json"
                                    },
                                    success: function (data) {
                                        var states = data;
                                        var comboStates = "<option value=''>Seleccionar</option>";
                                        states.forEach(element => {
                                            comboStates += '<option value="' + element['state_name'] + '">' + element['state_name'] + '</option>';
                                        });
                                        $("#estados").html(comboStates);

                                        // City list

                                        $("#estados").on("change", function () {
                                            var state = this.value;
                                            $("#estado_seleccionado").val(state);

                                            $.ajax({
                                                url: 'https://www.universal-tutorial.com/api/cities/' + state,
                                                method: 'GET',
                                                headers: {
                                                    "Authorization": "Bearer " + auth_token,
                                                    "Accept": "application/json"
                                                },
                                                success: function (data) {
                                                    var cities = data;
                                                    var comboCities = "<option value=''>Seleccionar</option>";
                                                    cities.forEach(element => {
                                                        comboCities += '<option value="' + element['city_name'] + '">' + element['city_name'] + '</option>';
                                                    });
                                                    $("#ciudades").html(comboCities);

                                                    // Update the hidden input with the selected city
                                                    $("#ciudades").on("change", function () {
                                                        var selectedCity = this.value;
                                                        $("#ciudad_seleccionada").val(selectedCity);
                                                    });
                                                    if (thisClass.cityValue) { $("#ciudades").val(thisClass.cityValue).trigger("change"); }

                                                },
                                                error: function (e) {
                                                    console.log("Error al obtener countries: " + e);
                                                }
                                            });

                                        });

                                        if (thisClass.stateValue) { $("#ciudades").val(thisClass.stateValue).trigger("change"); }

                                    },
                                    error: function (e) {
                                        console.log("Error al obtener countries: " + e);
                                    }
                                });

                            });

                            if (thisClass.countryValue) { $("#ciudades").val(thisClass.countryValue).trigger("change"); }

                        },
                        error: function (e) {
                            console.log("Error al obtener countries: " + e);
                        }
                    });

                }
            },
            error: function (e) {
                console.log("Error al obtener countries: " + e);
            }
        });

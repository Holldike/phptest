initRegionHtml();

function initRegionHtml() {
    $("select[name='region']").on('change', function () {
        let region_id = $("select[name='region'] option:selected").val();
        $('#submit').remove();

        if (region_id) {
            $.ajax({
                url: "signUp/getCitiesByRegionId",
                data: {region_id: region_id},
            }).done(function (html) {
                initCityHtml(html);
            });
        } else {
            $('#city').remove();
            $('#area').remove();
        }
    });
}

function initCityHtml(html) {
    $('#city').remove();
    $('#area').remove();
    $('#region').after(html);

    $("select[name='city']").on('change', function () {
        let city_id = $("select[name='city'] option:selected").val();

        if (city_id) {
            $('#submit').remove();

            $.ajax({
                url: "signUp/getAreasByCityId",
                data: {city_id: city_id},
            }).done(function (html) {
                initAreaHtml(html)
            });
        } else {
            $('#area').remove();
        }
    });
}

function initAreaHtml(html) {
    $('#area').remove();
    $('#city').after(html);

    $("select[name='area']").on('change', function () {
        $('#submit').remove();

        if ($("select[name='area'] option:selected").val()) {
            initButtonHtml();
        }
    })
}

function initButtonHtml() {
    $('form').append('<lavel id="submit"><button>OK</button></lavel>');

    $('#submit button').on('click', function (e) {
        e.preventDefault();
        $.ajax({
            url: "signUp/save",
            dataType: 'json',
            type: 'POST',
            data: $('form').serialize(),
        }).done(function (json) {
            $('.error_box').remove();

            if (json.errors) {
                if (json.errors.name) {
                    $("input[name='name']").after(
                        '<div class="error_box">' +
                        '<span class="error_item">' + json.errors.name + '</span>' +
                        '</div>'
                    );
                }

                if (json.errors.email) {
                    if (json.errors.email.existsPerson) {
                        $("input[name='email']").after(
                            '<div class="error_box">' +
                                '<span class="error_item">' + json.errors.email.message +
                                    '<div class="person">' +
                                        '<div>ФИО: ' + json.errors.email.existsPerson.name + '</div>' +
                                        '<div>Email: ' + json.errors.email.existsPerson.email + '</div>' +
                                        '<div>Адрес: ' + json.errors.email.existsPerson.territory + '</div>' +
                                    '</div>' +
                                '</span>' +
                            '</div>'
                        );
                    } else {
                        $("input[name='email']").after(
                            '<div class="error_box">' +
                            '<span class="error_item">' + json.errors.email + '</span>' +
                            '</div>'
                        );
                    }
                }

                if (json.errors.region) {
                    $("input[name='region']").after(
                        '<div class="error_box">' +
                            '<span class="error_item">' + json.errors.region + '</span>' +
                        '</div>'
                    );
                }

                if (json.errors.city) {
                    $("input[name='city']").after(
                        '<div class="error_box">' +
                            '<span class="error_item">' + json.errors.city + '</span>' +
                        '</div>'
                    );
                }

                if (json.errors.area) {
                    $("input[name='area']").after(
                        '<div class="error_box">' +
                            '<span class="error_item">' + json.errors.area + '</span>' +
                        '</div>'
                    );
                }
            } else {
                alert(json.success);
            }
        });
    });
}
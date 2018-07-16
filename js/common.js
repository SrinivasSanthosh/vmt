$(document).ready(function() {
    $('#japan_geo,#la_geo,#mea_geo,#gcg_geo,#ap_geo,#geo_export,#na_geo,#global_offering,#vendor_tool,#geo_eu_export').DataTable({
        dom: 'Bfrtip',
        "paging": true,
        "pageLength": 20,
        "scrollX": true,
        buttons: [{
            extend: 'collection',
            text: 'Export',
            buttons: [{
                    extend: 'pdfHtml5',
                    orientation: 'landscape',
                    pageSize: 'A0',
                    titleAttr: 'PDF'
                },
                'csv', 'excel'
            ]
        }]
    });

    $('#eu_geo').DataTable({
        dom: 'Bfrtip',
        "paging": true,
        "pageLength": 20,
        "scrollX": true,
        buttons: [{
            extend: 'collection',
            text: 'Export',
            buttons: [
                'csv', 'excel', 'pdfHtml5'
            ]
        }]
    });


    $('#cic_data,#sa_data').DataTable({
        dom: 'Bfrtip',
        "paging": true,
        "pageLength": 20,
        "scrollX": true,
        buttons: [{
            extend: 'collection',
            text: 'Export',
            buttons: [
                'csv', 'excel', 'pdf'
            ]
        }]
    });

    $('#geo_search').on('change', function() {
        if (this.value == '1') {
            $("#business").show();
        } else {
            $("#business").hide();
        }
    });


    $("#customer").select2({
        ajax: {
            url: "select.php",
            type: "post",
            dataType: 'json',
            delay: 250,
            data: function(params) {
                return {
                    searchTerm: params.term // search term
                };
            },
            processResults: function(response) {
                return {
                    results: response
                };
            },
            cache: true
        }
    });

    // code to show market search box
    $("#geo_search").change(function() {
        if ($(this).val() == '') {
            $(".market-search").hide();
            $(".market-search-all").hide();
            $(".cust-search").hide();
        } else if ($(this).val() == 'europe') {
            $(".market-search").show();
            $(".market-search-all").hide();
        } else {
            var datastring = "geo=" + $(this).val() + "&";
            $(".market-search").hide();
            $(".market-search-all").show();
            $(".cust-search").show();
            geo_search(datastring);
        }
    });

    // market search show customers 
    $("#market_search").change(function() {
        var datastring = "geo=" + $("#geo_search").val() + "&market=" + $(this).val();
        $(".cust-search").show();
        geo_search(datastring);
    });

    // code to run ajax line for multisearch
    $("body").on('keyup', '.multiselect-search', function() {
        var keyword = $(this).val();

        console.log(keyword.length);
        $("#myProgress").show();
        move();
        if (keyword.length == 0) {
            var datastring = "geo=" + $("#geo_search").val();
            geo_search(datastring);
        } else if (keyword.length > 1) {
            var geo = $("#geo_search").val();
            var market = $("#market_search").val();
            $.ajax({
                url: 'geo-search-ajax.php',
                type: 'POST',
                data: 'keyword=' + keyword + '&geo=' + geo + '&market=' + market + '',
                success: function(data) {
                    $("#cust_search").multiselect({
                        includeSelectAllOption: true,
                        enableFiltering: true,
                        enableCaseInsensitiveFiltering: true,
                        maxHeight: 250
                    });
                    console.log(data);
                    if (data != 'null') {
                        $("#cust_search").multiselect('dataprovider', JSON.parse(data));
                        console.log(keyword);
                        $("body").find('.multiselect-search').focus();
                        $("body").find('.multiselect-search').val(keyword);
                    }
                }
            });
        }

    });

    // Method for multi-cust
    $("body").on('keyup', '.offering .multiselect-search', function() {
        var keyword = $(this).val();
        console.log(keyword.length);

        // var geo = $("#sourcelist").val();
        // alert(geo);
        if (keyword.length == 0) {
            // var datastring = "geo="+$("#geo_search").val();
            multi_cust(keyword);
        } else if (keyword.length > 1) {
            $.ajax({
                url: 'cust-search.php',
                type: 'POST',
                data: 'keyword=' + keyword + '',
                success: function(data) {
                    $("#sourcelist").multiselect({
                        includeSelectAllOption: true,
                        enableFiltering: true,
                        enableCaseInsensitiveFiltering: true,
                        maxHeight: 250
                    });
                    console.log(data);
                    if (data != 'null') {
                        $("#sourcelist").multiselect('dataprovider', JSON.parse(data));

                        console.log(keyword);
                        $("body").find('.offering .multiselect-search').focus();
                        $("body").find('.offering .multiselect-search').val(keyword);
                    }
                }
            });
        }

    });


    function multi_cust(datastring) {
        $.ajax({
            type: 'POST',
            url: 'cust-search.php',
            data: datastring,
            success: function(data) {
                $.ajax({
                    type: 'POST',
                    url: 'cust-search.php',
                    data: datastring,
                    success: function(data) {
                        console.log(data);
                        $('#sourcelist').multiselect({
                            includeSelectAllOption: true,
                            enableFiltering: true,
                            enableCaseInsensitiveFiltering: true,
                            maxHeight: 250
                        });
                        if (data) {
                            var JSONObject = JSON.parse(data);
                            $("#sourcelist").multiselect('dataprovider', JSONObject);
                            $("#filter_new").removeAttr('disabled', 'disabled');
                        } else {
                            $("#filter_new").attr('disabled', 'disabled');
                        }
                        $("body").find('.offering .multiselect-search').focus();
                        // $(".customer-search-span").html(select);
                    }
                });
            }
        });

    }

    // method to for geo search ajax
    function geo_search(datastring) {
        move();
        $.ajax({
            type: 'POST',
            url: 'geo-search.php',
            data: datastring,
            success: function(data) {
                $.ajax({
                    type: 'POST',
                    url: 'geo-search.php',
                    data: datastring,
                    success: function(data) {
                        $("#myProgress").hide();
                        //console.log(data);
                        $('#cust_search').multiselect({
                            includeSelectAllOption: true,
                            enableFiltering: true,
                            enableCaseInsensitiveFiltering: true,
                            maxHeight: 250
                        });
                        if (data) {
                            var JSONObject = JSON.parse(data);
                            $("#cust_search").multiselect('dataprovider', JSONObject);
                            $("#filter_geo").removeAttr('disabled', 'disabled');
                        } else {
                            $("#filter_geo").attr('disabled', 'disabled');
                        }
                        $("body").find('.multiselect-search').focus();
                        // $(".customer-search-span").html(select);
                    }
                });
            }
        });

    }

    function move() {
        var elem = document.getElementById("myBar");
        var width = 1;
        var id = setInterval(frame, 10);

        function frame() {
            if (width >= 100) {
                clearInterval(id);
            } else {
                width++;
                elem.style.width = width + '%';
            }
        }
    }

    $('#sourcelist').multiselect({
        includeSelectAllOption: true,
        enableFiltering: true,
        enableCaseInsensitiveFiltering: true,
        maxHeight: 250
    });

}); //end of jquery ready() function
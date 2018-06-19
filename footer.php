<p>
    Developed by Risk & Compliance  &nbsp;&nbsp;<a href="https://w3.ibm.com/w3publisher/w3-privacy-notice" target="_blank"> Privacy Policy</a>
</p>
<!--===============================================================================================-->  
<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
<script src="vendor/bootstrap/js/popper.js"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="js/bootstrap-multiselect.js"></script>
<!--===============================================================================================-->
<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
<script src="vendor/tilt/tilt.jquery.min.js"></script>

<script >
    $('.js-tilt').tilt({
        scale: 1.1
    })
</script>
<!--===============================================================================================-->
<script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>

<script src="js/jquery.sumoselect.js"></script>

<script>
    $('.js-pscroll').each(function(){
        var ps = new PerfectScrollbar(this);

        $(window).on('resize', function(){
            ps.update();
        })
    });


</script>

<script src="js/main.js"></script>
<script src="js/login.js"></script>



<!--===============================Code For Export Buttons====================================-->
<script src="js/jquery.dataTables.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/select/1.2.5/js/dataTables.select.min.js"></script>


<script>
    $(document).ready(function() {
       $('#vendor_tool').DataTable( {
           dom: 'Bfrtip',
           "paging": true,
           "pageLength": 20,
           "scrollX": true ,
          buttons: [ 
           {
            extend: 'collection',
            text: 'Export',
            buttons: [
            {
             extend : 'pdfHtml5',
            orientation : 'landscape',
            pageSize : 'A0',
            titleAttr : 'PDF'
        },
            'csv', 'excel'
            ]
        }
        ]
    } );
   } );
</script>

<script>
    $(document).ready(function() {
       $('#global_offering').DataTable( {
           dom: 'Bfrtip',
           "paging": true,
           "pageLength": 20,
           "scrollX": true ,
          buttons: [ 
           {
            extend: 'collection',
            text: 'Export',
            buttons: [
            {
             extend : 'pdfHtml5',
            orientation : 'landscape',
            pageSize : 'A0',
            titleAttr : 'PDF'
        },
            'csv', 'excel'
            ]
        }
        ]
    } );
   } );
</script>

<script>
    $(document).ready(function() {
       $('#na_geo').DataTable( {
           dom: 'Bfrtip',
           "paging": true,
           "pageLength": 20,
           "scrollX": true ,
          buttons: [ 
           {
            extend: 'collection',
            text: 'Export',
            buttons: [
            {
             extend : 'pdfHtml5',
            orientation : 'landscape',
            pageSize : 'A0',
            titleAttr : 'PDF'
        },
            'csv', 'excel'
            ]
        }
        ]
    } );
   } );
</script>

<script>
    $(document).ready(function() {
       $('#japan_geo').DataTable( {
           dom: 'Bfrtip',
           "paging": true,
           "pageLength": 20,
           "scrollX": true ,
          buttons: [ 
           {
            extend: 'collection',
            text: 'Export',
            buttons: [
            {
             extend : 'pdfHtml5',
            orientation : 'landscape',
            pageSize : 'A0',
            titleAttr : 'PDF'
        },
            'csv', 'excel'
            ]
        }
        ]
    } );
   } );
</script>

<script>
    $(document).ready(function() {
       $('#la_geo').DataTable( {
           dom: 'Bfrtip',
           "paging": true,
           "pageLength": 20,
           "scrollX": true ,
          buttons: [ 
           {
            extend: 'collection',
            text: 'Export',
            buttons: [
            {
             extend : 'pdfHtml5',
            orientation : 'landscape',
            pageSize : 'A0',
            titleAttr : 'PDF'
        },
            'csv', 'excel'
            ]
        }
        ]
    } );
   } );
</script>

<script>
    $(document).ready(function() {
       $('#mea_geo').DataTable( {
           dom: 'Bfrtip',
           "paging": true,
           "pageLength": 20,
           "scrollX": true ,
          buttons: [ 
           {
            extend: 'collection',
            text: 'Export',
            buttons: [
            {
             extend : 'pdfHtml5',
            orientation : 'landscape',
            pageSize : 'A0',
            titleAttr : 'PDF'
        },
            'csv', 'excel'
            ]
        }
        ]
    } );
   } );
</script>

<script>
    $(document).ready(function() {
       $('#gcg_geo').DataTable( {
           dom: 'Bfrtip',
           "paging": true,
           "pageLength": 20,
           "scrollX": true ,
          buttons: [ 
           {
            extend: 'collection',
            text: 'Export',
            buttons: [
            {
             extend : 'pdfHtml5',
            orientation : 'landscape',
            pageSize : 'A0',
            titleAttr : 'PDF'
        },
            'csv', 'excel'
            ]
        }
        ]
    } );
   } );
</script>

<script>
    $(document).ready(function() {
       $('#ap_geo').DataTable( {
           dom: 'Bfrtip',
           "paging": true,
           "pageLength": 20,
           "scrollX": true ,
          buttons: [ 
           {
            extend: 'collection',
            text: 'Export',
            buttons: [
            {
             extend : 'pdfHtml5',
            orientation : 'landscape',
            pageSize : 'A0',
            titleAttr : 'PDF'
        },
            'csv', 'excel'
            ]
        }
        ]
    } );
   } );
</script>

<script>
    $(document).ready(function() {
       $('#eu_geo').DataTable( {
           dom: 'Bfrtip',
           "paging": true,
           "pageLength": 20,
           "scrollX": true ,
           buttons: [ 
           {
            extend: 'collection',
            text: 'Export',
            buttons: [
            'csv', 'excel', 'pdfHtml5'
            ]
        }
        ]
    } );
   } );
</script>

<script>
    $(document).ready(function() {
        $('#cic_data').DataTable( {
            dom: 'Bfrtip',
            "paging": true,
            "pageLength": 20,
            "scrollX": true ,
            buttons: [ 
            {
                extend: 'collection',
                text: 'Export',
                buttons: [
                'csv', 'excel', 'pdf'
                ]
            }
            ]
        } );
    } );
</script>

<script>
    $(document).ready(function() {
        $('#sa_data').DataTable( {
            dom: 'Bfrtip',
            "paging": true,
            "pageLength": 20,
            "scrollX": true,
            buttons: [ 
            {
                extend: 'collection',
                text: 'Export',
                buttons: [
                'csv', 'excel', 'pdf'
                ]
            }
            ]
        } );
    } );
</script>

<script>
    $(document).ready(function() {
       $('#geo_export').DataTable( {
           dom: 'Bfrtip',
           "paging": true,
           "pageLength": 20,
           "scrollX": true,
          buttons: [ 
           {
            extend: 'collection',
            text: 'Export',
            buttons: [
            {
             extend : 'pdfHtml5',
            orientation : 'landscape',
            pageSize : 'A0',
            titleAttr : 'PDF'
        },
            'csv', 'excel'
            ]
        }
        ]
    } );
   } );
</script>

<script>
    $(document).ready(function() {
       $('#geo_eu_export').DataTable( {
           dom: 'Bfrtip',
           "paging": true,
           "pageLength": 20,
           "scrollX": true ,
          buttons: [ 
           {
            extend: 'collection',
            text: 'Export',
            buttons: [
            {
             extend : 'pdfHtml5',
            orientation : 'landscape',
            pageSize : 'A0',
            titleAttr : 'PDF'
        },
            'csv', 'excel'
            ]
        }
        ]
    } );
   } );
</script>
<!--===============================Scroll to Top Button====================================-->
<script>
// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        document.getElementById("myBtn").style.display = "block";
    } else {
        document.getElementById("myBtn").style.display = "none";
    }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
}
</script> 

<script>
    $(document).ready(function(){

     $("#customer").select2({
      ajax: { 
        url: "select.php",
        type: "post",
        dataType: 'json',
        delay: 250,
        data: function (params) {
            return {
      searchTerm: params.term // search term
  };
},
processResults: function (response) {
 return {
    results: response
};
},
cache: true
}
});

     // code to show market search box
     $("#geo_search").change(function() {
        if($(this).val() == '') { 
            $(".market-search").hide();
            $(".market-search-all").hide();
            $(".cust-search").hide();
        } else if($(this).val() == 'europe') {
            $(".market-search").show();
            $(".market-search-all").hide();
        } else {
            var datastring = "geo="+$(this).val()+"&";
            $(".market-search").hide();
            $(".market-search-all").show();
            $(".cust-search").show();
            geo_search(datastring);
        }
    });

    // market search show customers 
    $("#market_search").change(function() {
       var datastring = "geo="+$("#geo_search").val()+"&market="+$(this).val();
       $(".cust-search").show();
       geo_search(datastring);
   });

// code to run ajax line for multisearch
$("body").on('keyup', '.multiselect-search', function() {
    var keyword = $(this).val();
    console.log(keyword.length);
        $("#myProgress").show();
        move();
    if(keyword.length == 0) {
        var datastring = "geo="+$("#geo_search").val();
        geo_search(datastring);
    } 
    else if(keyword.length >1)
    {
        var geo = $("#geo_search").val();
        var market = $("#market_search").val();

        $.ajax({
            url: 'geo-search-ajax.php',
            type: 'POST',
            data: 'keyword='+keyword+'&geo='+geo+'&market='+market+'',
            success : function(data) {
                $("#cust_search").multiselect({ 
                  includeSelectAllOption: true,
                  enableFiltering:true,       
                  enableCaseInsensitiveFiltering: true,
                  maxHeight: 250
              });
                console.log(data);
                if(data != 'null') {
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
        if(keyword.length == 0) {
        // var datastring = "geo="+$("#geo_search").val();
        multi_cust(keyword);
    } 
    else if(keyword.length >1)
    {
        $.ajax({
            url: 'cust-search.php',
            type: 'POST',
            data: 'keyword='+keyword+'',
            success : function(data) {
                $("#sourcelist").multiselect({ 
                  includeSelectAllOption: true,
                  enableFiltering:true,       
                  enableCaseInsensitiveFiltering: true,
                  maxHeight: 250
              });
                console.log(data);
                if(data != 'null') {
                    $("#sourcelist").multiselect('dataprovider', JSON.parse(data));

                    console.log(keyword);
                    $("body").find('.offering .multiselect-search').focus();
                    $("body").find('.offering .multiselect-search').val(keyword);
                } 
            }
        });
    }

}); 

function multi_cust(datastring)
{
   $.ajax({
      type : 'POST',
      url : 'cust-search.php',
      data : datastring,
      success : function(data) {
        $.ajax({
          type : 'POST',
          url : 'cust-search.php',
          data : datastring,
          success : function(data) {
            console.log(data);
            $('#sourcelist').multiselect({ 
              includeSelectAllOption: true,
              enableFiltering:true,       
              enableCaseInsensitiveFiltering: true,
              maxHeight: 250
          });
           if(data) {
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
      type : 'POST',
      url : 'geo-search.php',
      data : datastring,
      success : function(data) {
        $.ajax({
          type : 'POST',
          url : 'geo-search.php',
          data : datastring,
          success : function(data) {
             $("#myProgress").hide();
            console.log(data);
            $('#cust_search').multiselect({ 
              includeSelectAllOption: true,
              enableFiltering:true,       
              enableCaseInsensitiveFiltering: true,
              maxHeight: 250
          });
            if(data) {
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

});
</script>
<script type="text/javascript">
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
</script>

<script type="text/javascript">   
$('#sourcelist').multiselect({ 
  includeSelectAllOption: true,
  enableFiltering:true,       
  enableCaseInsensitiveFiltering: true,
  maxHeight: 250
  });
</script>

</body>
</html>
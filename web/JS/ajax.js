
$(document).ready(function() {
    $("#searchForm").off("submit");

    $("#searchForm").submit(function(event) {

        if (event.originalEvent) {
            $("#pageIndex").val(0);
        }

        console.log("hallo");
        event.preventDefault();
        var freeText = $("#wordsearch").val();
        var category = $("#category").val();
        var fromYear = $("#fromYear").val();
        var toYear = $("#toYear").val();
        var radio = $('input[name="graphRadio"]:checked').val();
        var pgNum = $("#pageIndex").val();      
        var submit = $("#searchBTN").val();
            $("#mailContent").load("load-mailcontent.php", {
                freeText: freeText,
                category: category,
                fromYear: fromYear,
                toYear: toYear,
                radio: radio,
                pgNum: pgNum,
                submit: submit
            });
    });

    $("#next").click(function() {
        var value =  parseInt($("#pageIndex").val()) + 10;
        $("#pageIndex").val(value);

        $("#searchForm").trigger("submit");
    });

    $("#previous").click(function() {
        var value =  parseInt($("#pageIndex").val()) - 10;
        if (value >= 0) {
            $("#pageIndex").val(value);
        } else {
            $("#pageIndex").val(0)
        }

        $("#searchForm").trigger("submit");
    });

});

/*

We can also trigger the event when a different element is clicked:
$( "#other" ).on( "click", function() {
  $( "#target" ).trigger( "click" );
} );

 	
The event handler can be bound to any <div>:
$( "#target" ).on( "click", function() {
  alert( "Handler for `click` called." );
} );
*/

$(document).ready(function() {
    $("#searchForm").submit(function(event) {
        event.preventDefault();
        var freeText = $("#wordsearch").val();
        var category = $("#category").val();
        var fromYear = $("#fromYear").val();
        var toYear = $("#toYear").val();
        var radio = $('input[name="graphRadio"]:checked').val();      
        var submit = $("#searchBTN").val();
            $("#mailContent").load("load-mailcontent.php", {
                freeText: freeText,
                category: category,
                fromYear: fromYear,
                toYear: toYear,
                radio: radio,
                submit: submit
            });
    });
});
/*

$(document).ready(function() {
        console.log("jquery is ready");
        $("#searchBTN").click(function() {
            console.log("search clicked");
            $("#mailContent").load("load-mailcontent.php", {
                someFormValues1: "someText1",
                someFormValues2: "someText2",
                someFormValues3: "someText3"
            });
        });
    });
*/
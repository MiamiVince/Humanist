// JQery Ajax
$(document).ready(function() {
    $("#searchForm").off("submit");
    // If Submit is clicked get Values and load load-mailcontent.php in div container
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
    // if Buttons Next | Previous are clicked --> change value if Pageindex and trigger Button Submit
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
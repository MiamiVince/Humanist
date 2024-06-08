<?php
    include 'dbh.php';
    $result ="";
    $graphLabel ="";
    //Check for Submit
    if (isset($_POST['submit'])) {
        $freeText = $_POST['freeText'];
        $fromYear = $_POST['fromYear'];
        $toYear = $_POST['toYear'];
        $category = $_POST['category'];
        $radio = $_POST['radio'];
        $pgNum = $_POST['pgNum'];
        $id = 0;

        //Check radio Button for Graph: Years | Timezones
        if ($radio == "radioYears"){
            $graphStatus = True;
        } else {
            $graphStatus = False;
        }
        //Check User Form Input to set Graphs Labelname
        if (!(empty($freeText))){
            $graphLabel = $freeText;
        }
        if ((empty($freeText)) & ($category != "Select Category")){
            $graphLabel = $category;
        }
        if ((empty($freeText)) & ($category == "Select Category") & !($fromYear == "Select Year") & ($toYear == "Select Year")){
            $graphLabel = $fromYear;
        }
        if ((empty($freeText)) & ($category == "Select Category") & !($fromYear == "Select Year") & !($toYear == "Select Year")){
            $graphLabel = $fromYear." - ".$toYear;
        }

        //Check User Form Input
        if ($category == "Select Category"){
                //No Input
            if ((empty($freeText)) & ($fromYear == "Select Year") & ($toYear == "Select Year") & ($category == "Select Category")) {
                $sql = "SELECT * FROM humanist_research_data WHERE mailYear='default'";
                $result = mysqli_query($conn, $sql);
            }

                //Just Free Text
            if (!(empty($freeText)) & ($fromYear == "Select Year") & ($toYear == "Select Year") & ($category == "Select Category")) {
                $sql = "SELECT * FROM humanist_research_data WHERE ((mailContent LIKE '%$freeText%') OR (mailHeader_Content LIKE '%$freeText%'))";
                $result = mysqli_query($conn, $sql);
            }
            
                //Just From Year
            if ((empty($freeText)) & !($fromYear == "Select Year") & ($toYear == "Select Year") & ($category == "Select Category")) {
                $sql = "SELECT * FROM humanist_research_data WHERE mailYear='$fromYear'";
                $result = mysqli_query($conn, $sql);
            }
                //From Year -> To Year
            if ((empty($freeText)) & !($fromYear == "Select Year") & !($toYear == "Select Year") & ($category == "Select Category")) {
                $sql = "SELECT * FROM humanist_research_data WHERE mailYear BETWEEN $fromYear AND $toYear";
                $result = mysqli_query($conn, $sql);
            }
                //Free Text | From Year -> To Year
            if (!(empty($freeText)) & !($fromYear == "Select Year") & !($toYear == "Select Year") & ($category == "Select Category")) {
                $sql = "SELECT * FROM humanist_research_data WHERE ((mailContent LIKE '%$freeText%') OR (mailHeader_Content LIKE '%$freeText%')) AND mailYear BETWEEN $fromYear AND $toYear";
                $result = mysqli_query($conn, $sql);
            }
                //Just To Year
                //Therefore, no query is executed.
            if ((empty($freeText)) & ($fromYear == "Select Year") & !($toYear == "Select Year") & ($category == "Select Category")) {
                echo 'Please select "From Year" for search results!';
                $sql = "SELECT * FROM humanist_research_data WHERE mailDate='default'";
                $result = mysqli_query($conn, $sql);
            }
                //Just From Year
            if ((empty($freeText)) & !($fromYear == "Select Year") & ($toYear == "Select Year") & ($category == "Select Category")) {
                $sql = "SELECT * FROM humanist_research_data WHERE mailYear='$fromYear'";
                $result = mysqli_query($conn, $sql);
            }
                //Free Text | From Year
            if (!(empty($freeText)) & !($fromYear == "Select Year") & ($toYear == "Select Year") & ($category == "Select Category")) {
                $sql = "SELECT * FROM humanist_research_data WHERE ((mailContent LIKE '%$freeText%') OR (mailHeader_Content LIKE '%$freeText%')) AND mailYear='$fromYear'";
                $result = mysqli_query($conn, $sql);
            }
                //Free Text | To Year
                //Therefore, no query is executed.
            if (!(empty($freeText)) & ($fromYear == "Select Year") & !($toYear == "Select Year") & ($category == "Select Category")) {
                echo 'Please select "From Year" for search results!';
                $sql = "SELECT * FROM humanist_research_data WHERE mailYear='default'";
                $result = mysqli_query($conn, $sql);
            }
        }

        if ($category != "Select Category"){
                //Just Free Text | Category
            if (!(empty($freeText)) & ($fromYear == "Select Year") & ($toYear == "Select Year")) {
                $sql = "SELECT * FROM humanist_research_data WHERE ((mailContent LIKE '%$freeText%') OR (mailHeader_Content LIKE '%$freeText%')) AND (mailContentCategory lIKE '$category')";
                $result = mysqli_query($conn, $sql);
            }
            
                //Just From Year | category
            if ((empty($freeText)) & !($fromYear == "Select Year") & ($toYear == "Select Year")) {
                $sql = "SELECT * FROM humanist_research_data WHERE (mailYear='$fromYear') AND (mailContentCategory LIKE '$category')";
                $result = mysqli_query($conn, $sql);
            }
                //From Year -> To Year | category
            if ((empty($freeText)) & !($fromYear == "Select Year") & !($toYear == "Select Year")) {
                $sql = "SELECT * FROM humanist_research_data WHERE (mailYear BETWEEN $fromYear AND $toYear) AND (mailContentCategory LIKE '$category')";
                $result = mysqli_query($conn, $sql);
            }
                //Free Text | From Year -> To Year | category
            if (!(empty($freeText)) & !($fromYear == "Select Year") & !($toYear == "Select Year")) {
                $sql = "SELECT * FROM humanist_research_data WHERE ((mailContent LIKE '%$freeText%') OR (mailHeader_Content LIKE '%$freeText%')) AND (mailYear BETWEEN $fromYear AND $toYear) AND (mailContentCategory LIKE '$category')";
                $result = mysqli_query($conn, $sql);
            }
                //Just To Year | category
                //Therefore, no query is executed.
            if ((empty($freeText)) & ($fromYear == "Select Year") & !($toYear == "Select Year")) {
                echo 'Please select "From Year" for search results!';
                $sql = "SELECT * FROM humanist_research_data WHERE mailDate='default'";
                $result = mysqli_query($conn, $sql);
            }
                //Just From Year | category
            if ((empty($freeText)) & !($fromYear == "Select Year") & ($toYear == "Select Year")) {
                $sql = "SELECT * FROM humanist_research_data WHERE (mailYear='$fromYear') AND (mailContentCategory LIKE '$category')";
                $result = mysqli_query($conn, $sql);
            }
                //Free Text | From Year | category
            if (!(empty($freeText)) & !($fromYear == "Select Year") & ($toYear == "Select Year")) {
                $sql = "SELECT * FROM humanist_research_data WHERE ((mailContent LIKE '%$freeText%') OR (mailHeader_Content LIKE '%$freeText%')) AND (mailYear='$fromYear') AND (mailContentCategory LIKE '$category')";
                $result = mysqli_query($conn, $sql);
            }
                //Free Text | To Year | category
                //Therefore, no query is executed.
            if (!(empty($freeText)) & ($fromYear == "Select Year") & !($toYear == "Select Year")) {
                echo 'Please select "From Year" for search results!';
                $sql = "SELECT * FROM humanist_research_data WHERE mailYear='default'";
                $result = mysqli_query($conn, $sql);
            }
        }

        $graphData = array();
        $count = 0;
        $emailsNum = mysqli_num_rows($result);
        //check of result of Query is not empty
        if ($emailsNum > 0) {
            //echo total Number of result_rows
            echo '<div class="p-4 mb-3 bg-body-tertiary rounded">
                    <p >Your search has returned a total of '.$emailsNum.' E-Mails.</p>
                </div>';
            //iterate through result_rows
            while ($row = mysqli_fetch_assoc($result))
                {   //fill GraphData
                    if($graphStatus){
                        $graphData[]= $row['mailYear'];
                    }else{
                        $graphData[]= $row['mailTimeZone'];
                    }
                    //increase id for headerButton
                    if ($row['id'] != ""){
                        $count = $count +1;
                        $id = $row['id'];
                    }// Echo 10 Emails
                    if (($count >= ($pgNum)) & ($count <= ($pgNum + 10))){
                        echo '<button class="btn btn-primary btn-sm" type="button" data-toggle="collapse" data-target="#id'.$id.'" aria-expanded="false" aria-controls="id'.$id.'">
                            Email Header <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-down" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1z"/>
                            </svg>
                            </button>';
                        echo '<div class="collapse" id="id'.$id.'">';
                        echo "<p>";
                        echo $row['mailHeader_content'];
                        echo "</p>";
                        echo "<p>";
                        echo "(Category: ".$row['mailContentCategory'].")";
                        echo "</p>";
                        echo "</div>";
                        echo "<br>";
                        echo "<p>";
                        echo "From: ".$row['mailFrom'];
                        echo "<br>";
                        echo "Subject: ".$row['mailSubject'];
                        echo "<br>";
                        echo "Date: ".$row['mailDate'];
                        echo "</p>";
                        echo "<br>";
                        echo "<p>";
                        echo $row['mailContent'];
                        echo "</p>";
                    }    
                    
                }
            // echo pagination
            echo '
                <div class="p-2 mb-3 bg-body-tertiary rounded" id="pagination">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-center">
                        <li class="page-item"><button class="page-link" id="previous">Previous</button></li>
                        <li class="page-item"><a class="page-link">'.$pgNum.' - '.($pgNum + 10).' E-Mails</a></li>
                        <li class="page-item"><button class="page-link" id="next">Next</button></li>
                        </ul>
                    </nav>
                </div>';

            echo '<script src="../JS/ajax.js"></script>';
            $graphData = json_encode([$graphData]);
        } else {
            //echo if no rows in result and empty GraphData
            echo "<br>";
            echo "There is no search result!";
            $graphData = "";
        }
    }
?>
<script>
    var myLineChart;
    //get variables php --> JavaScript
    var chartStatus =  '<?php echo $graphStatus; ?>';
    var arrayData = '<?php echo $graphData; ?>';
    var graphLabel = '<?php echo $graphLabel; ?>';
    //parse graphdata and fill new array
    function getData(array, status) {
        var new_array = [];
        var newArrayPart = "";
        let dataGraphMails = new Array(32).fill(0);
        let dataGraphZones = new Array(25).fill(0);
        for(var i = 0; i < arrayData.length; i++) {
            if (!(arrayData[i] =="[") & !(arrayData[i] =="]") & !(arrayData[i] ==",") & !(arrayData[i] == '"')) {
                if (newArrayPart == ""){
                    newArrayPart = arrayData[i];
                } else {
                    newArrayPart = newArrayPart + arrayData[i];
                }
            }
            if (((arrayData[i] == '"') & (arrayData[i+1] == ",")) | ((arrayData[i] == '"') & (arrayData[i+1] == "]"))) {
                new_array.push(newArrayPart);
                newArrayPart = "";           
            }
        }
        
        if (chartStatus){
            for (var i = 0; i < new_array.length; i++) {
                var x = new_array[i]
                for (var j = 0; j < dataGraphMails.length; j++) {
                    //Switch Years
                    if (x != ""){
                        x = x.toString();
                        switch (x) {
                            case "1987":
                            dataGraphMails[0] += 1;
                            break;
                            case "1988":
                            dataGraphMails[1] += 1;
                            break;
                            case "1989":
                            dataGraphMails[2] += 1;
                            break;
                            case "1990":
                            dataGraphMails[3] += 1;
                            break;
                            case "1991":
                            dataGraphMails[4] += 1;
                            break;
                            case "1992":
                            dataGraphMails[5] += 1;
                            break;
                            case "1993":
                            dataGraphMails[6] += 1;
                            break;
                            case "1994":
                            dataGraphMails[7] += 1;
                            break;
                            case "1995":
                            dataGraphMails[8] += 1;
                            break;
                            case "1996":
                            dataGraphMails[9] += 1;
                            break;
                            case "1997":
                            dataGraphMails[10] += 1;
                            break;
                            case "1998":
                            dataGraphMails[11] += 1;
                            break;
                            case "1999":
                            dataGraphMails[12] += 1;
                            break;
                            case "2000":
                            dataGraphMails[13] += 1;
                            break;
                            case "2001":
                            dataGraphMails[14] += 1;
                            break;
                            case "2002":
                            dataGraphMails[15] += 1;
                            break;
                            case "2003":
                            dataGraphMails[16] += 1;
                            break;
                            case "2004":
                            dataGraphMails[17] += 1;
                            break;
                            case "2005":
                            dataGraphMails[18] += 1;
                            break;
                            case "2006":
                            dataGraphMails[19] += 1;
                            break;
                            case "2007":
                            dataGraphMails[20] += 1;
                            break;
                            case "2008":
                            dataGraphMails[21] += 1;
                            break;
                            case "2009":
                            dataGraphMails[22] += 1;
                            break;
                            case "2010":
                            dataGraphMails[23] += 1;
                            break;
                            case "2011":
                            dataGraphMails[24] += 1;
                            break;
                            case "2012":
                            dataGraphMails[25] += 1;
                            break;
                            case "2013":
                            dataGraphMails[26] += 1;
                            break;
                            case "2014":
                            dataGraphMails[27] += 1;
                            break;
                            case "2015":
                            dataGraphMails[28] += 1;
                            break;
                            case "2016":
                            dataGraphMails[29] += 1;
                            break;
                            case "2017":
                            dataGraphMails[30] += 1;
                            break;
                            case "2018":
                            dataGraphMails[31] += 1;
                            break;
                            default:
                            break;
                        }
                    }
                    break;
                }
            }
             return dataGraphMails;
        } else{    
            var check = []
            for (var i = 0; i < new_array.length; i++) {
                var x = new_array[i]
                for (var j = 0; j < dataGraphZones.length; j++) {
                    //Switch Timezones            
                    if (x != ""){
                        x = x.toString();
                        switch (x) {
                            case "-1200":
                                dataGraphZones[0] += 1;
                            break;
                            case "-1100":
                            dataGraphZones[1] += 1;
                            break;
                            case "-1000":
                            dataGraphZones[2] += 1;
                            break;
                            case "-0900":
                            dataGraphZones[3] += 1;
                            break;
                            case "-0800":
                            dataGraphZones[4] += 1;
                            break;
                            case "-0700":
                            dataGraphZones[5] += 1;
                            break;
                            case "-0600":
                            dataGraphZones[6] += 1;
                            break;
                            case "-0500":
                            dataGraphZones[7] += 1;
                            break;
                            case "-0400":
                            dataGraphZones[8] += 1;
                            break;
                            case "-0330":
                            dataGraphZones[9] += 1;
                            break;
                            case "-0300":
                            dataGraphZones[9] += 1;
                            break;
                            case "-0230":
                            dataGraphZones[10] += 1;
                            break;
                            case "-0200":
                            dataGraphZones[10] += 1;
                            break;
                            case "-0100":
                            dataGraphZones[11] += 1;
                            break;
                            case "-0000":
                            dataGraphZones[12] += 1;
                            case "+0000":
                            dataGraphZones[12] += 1;
                            break;
                            case "+0100":
                            dataGraphZones[13] += 1;
                            break;
                            case "+0200":
                            dataGraphZones[14] += 1;
                            break;
                            case "+0300":
                            dataGraphZones[15] += 1;
                            break;
                            case "+0400":
                            dataGraphZones[16] += 1;
                            break;
                            case "+0500":
                            dataGraphZones[17] += 1;
                            break;
                            case "+0530":
                            dataGraphZones[17] += 1;
                            break;
                            case "+0600":
                            dataGraphZones[18] += 1;
                            break;
                            case "+0700":
                            dataGraphZones[19] += 1;
                            break;
                            case "+0800":
                            dataGraphZones[20] += 1;
                            break;
                            case "+0900":
                            dataGraphZones[21] += 1;
                            break;
                            case "+1000":
                            dataGraphZones[22] += 1;
                            break;
                            case "+1030":
                            dataGraphZones[22] += 1;
                            break;
                            case "+1100":
                            dataGraphZones[23] += 1;
                            break;
                            case "+1200":
                            dataGraphZones[24] += 1;
                            break;
                            case "+1300":
                            dataGraphZones[24] += 1;
                            break;
                            default:
                            check.push(x);
                            break;
                        }
                    }
                    break;
                }
            }
            return dataGraphZones;
        }
    }
//destroy graph to draw new one
function destroyGraph(){
    if (typeof myLineChart != 'undefined') {
     myLineChart.destroy();
    }
}
//draw graph
function drawGraph(){

    var dataGraph = getData(arrayData, chartStatus);
    var labels;

    if (chartStatus){
        labels = ['1987', '1988', '1989', '1990', '1991', '1992', '1993', '1994', '1995', '1996', '1997', '1998', '1999', '2000', '2001', '2002', '2003', '2004', '2005', '2006', '2007', '2008', '2009', '2010', '2011', '2012', '2013', '2014', '2015', '2016', '2017', '2018']
    } else {
        labels = ['UTC -12', 'UTC -11', 'UTC -10', 'UTC -9', 'UTC -8', 'UTC -7', 'UTC -6', 'UTC -5', 'UTC -4', 'UTC -3', 'UTC -2', 'UTC -1', 'UTC 0', 'UTC +1', 'UTC +2', 'UTC +3', 'UTC +4', 'UTC +5', 'UTC +6', 'UTC +7', 'UTC +8', 'UTC +9', 'UTC +10', 'UTC +11', 'UTC +12'] 
    }

    destroyGraph();
    
    
    const ctx = document.getElementById('myChart');
    //fill actual Chart
    myLineChart = new Chart(ctx, {
        type: 'line',
        data: {
            
            labels: labels,
            datasets: [{
                label: graphLabel,
                data: dataGraph,
                borderWidth: 1,
                tension: 0.4,
                fill: true
            }]
        },
        options: {
            maintainAspectRatio: false,
            responsive: true,
            scales: {
                y: {
                    type: 'linear',
                    
                }
            }
        }
    });
}
//call drawGraph()
drawGraph();
</script>
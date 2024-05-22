<?php
    include 'dbh.php';
    $result ="";
    $graphStatus = True;
    if (isset($_POST['submit'])) {
        $freeText = $_POST['freeText'];
        $fromYear = $_POST['fromYear'];
        $toYear = $_POST['toYear'];
        $category = $_POST['category'];
        //$someOther = $_POST['someOther'];
        //$select = $_POST['select'];

        if ((empty($freeText)) & ($fromYear == "Select Year") & ($toYear == "Select Year") & ($category == "timezones")) {
            //echo "There is no search result!";
            //$sql = "SELECT * FROM emailarchives5 WHERE mailYear='default'";
            $sql = "SELECT * FROM emailarchives5";
            $result = mysqli_query($conn, $sql);
            $graphData = array();
            $graphStatus = False;
            $id = 0;
        }

        if ((empty($freeText)) & !($fromYear == "Select Year") & ($toYear == "Select Year") & ($category == "timezones")) {
            //echo "There is no search result!";
            //$sql = "SELECT * FROM emailarchives5 WHERE mailYear='default'";
            $sql = "SELECT * FROM emailarchives5 WHERE mailYear='$fromYear'";
            $result = mysqli_query($conn, $sql);
            $graphData = array();
            $graphStatus = False;
            $id = 0;
        }

        if ((empty($freeText)) & !($fromYear == "Select Year") & !($toYear == "Select Year") & ($category == "timezones")) {
            //echo "There is no search result!";
            //$sql = "SELECT * FROM emailarchives5 WHERE mailYear='default'";
            $sql = "SELECT * FROM emailarchives5 WHERE mailYear BETWEEN $fromYear AND $toYear";
            $result = mysqli_query($conn, $sql);
            $graphData = array();
            $graphStatus = False;
            $id = 0;
        }

        if (!(empty($freeText)) & !($fromYear == "Select Year") & !($toYear == "Select Year") & ($category == "timezones")) {
            //echo "There is no search result!";
            //$sql = "SELECT * FROM emailarchives5 WHERE mailYear='default'";
            $sql = "SELECT * FROM emailarchives5 WHERE mailContent LIKE '%$freeText%' AND mailYear BETWEEN $fromYear AND $toYear";
            $result = mysqli_query($conn, $sql);
            $graphData = array();
            $graphStatus = False;
            $id = 0;
        }

        if ((empty($freeText)) & ($fromYear == "Select Year") & ($toYear == "Select Year") & ($category == "Select Category")) {
            //echo "There is no search result!";
            $sql = "SELECT * FROM emailarchives5 WHERE mailYear='default'";
            $result = mysqli_query($conn, $sql);
        }

        if ((empty($freeText)) & ($fromYear == "Select Year") & !($toYear == "Select Year")) {
            echo 'Please select "From Year" for search results!';
            $sql = "SELECT * FROM emailarchives5 WHERE mailDate='default'";
            $result = mysqli_query($conn, $sql);
        }

        if ((empty($freeText)) & !($fromYear == "Select Year") & ($toYear == "Select Year")) {
            $sql = "SELECT * FROM emailarchives5 WHERE mailYear='$fromYear'";
            $result = mysqli_query($conn, $sql);
            $graphData = array();
            $id = 0;
        }

        if ((empty($freeText)) & !($fromYear == "Select Year") & !($toYear == "Select Year")) {
            $sql = "SELECT * FROM emailarchives5 WHERE mailYear BETWEEN $fromYear AND $toYear";
            $result = mysqli_query($conn, $sql);
            $graphData = array();
            $id = 0;
        }

        if (!(empty($freeText)) & !($fromYear == "Select Year") & !($toYear == "Select Year")) {
            $sql = "SELECT * FROM emailarchives5 WHERE mailContent LIKE '%$freeText%' AND mailYear BETWEEN $fromYear AND $toYear";
            $result = mysqli_query($conn, $sql);
            $graphData = array();
            $id = 0;
        }

        if (!(empty($freeText)) & !($fromYear == "Select Year") & ($toYear == "Select Year")) {
            $sql = "SELECT * FROM emailarchives5 WHERE mailContent LIKE '%$freeText%' AND mailYear='$fromYear'";
            $result = mysqli_query($conn, $sql);
            $graphData = array();
            $id = 0;
        }

        if (!(empty($freeText)) & ($fromYear == "Select Year") & !($toYear == "Select Year")) {
            echo 'Please select "From Year" for search results!';
            $sql = "SELECT * FROM emailarchives5 WHERE mailYear='default'";
            $result = mysqli_query($conn, $sql);
        }

        $count = 0;
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result))
                {
                    $id = $id +1;
                    if($graphStatus){
                        $graphData[]= $row['mailYear'];
                    }else{
                        $graphData[]= $row['mailTimeZone'];
                    }

                    if ($row['id'] != ""){
                        $count = $count +1;
                    }
                    if ($count <= 25){    //1989 -> 2021 | 1990 -> 1535
                        echo '<button class="btn btn-primary btn-sm" <a href="#hiddenTextBootstrap'.$id.'" data-bs-toggle="collapse">Email Header<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-down" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1"/>
                        </svg></a></button>';
                        
                        echo '<div class="collapse" id="hiddenTextBootstrap'.$id.'">';
                        echo "<p>";
                        echo $row['mailHeader_content'];
                        echo "</p>";
                        echo "</div>";
                        echo "<br>";
                        echo "<p>";
                        echo "From: ".$row['mailFrom'];
                        echo "<br>";
                        echo "Subject: ".$row['mailSubject'];
                        echo "<br>";
                        echo "Year: ".$row['mailYear'];
                        echo "</p>";
                        echo "<br>";
                        echo "<p>";
                        echo $row['mailContent'];
                        echo "</p>";
                    }    
                    
                }
            
            $graphData = json_encode([$graphData]);
            echo $graphData;
        } else {
            echo "<br>";
            echo "There is no search result!";
        }
        
    }
        //}
?>

<script>
    
    var myLineChart;
    var chartStatus =  '<?php echo $graphStatus; ?>';
        var arrayData= '<?php echo $graphData; ?>';
    

    console.log(arrayData);

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
            for (var i = 0; i < new_array.length; i++) {
                var x = new_array[i]
                for (var j = 0; j < dataGraphZones.length; j++) {
                    
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
                            case "-0300":
                            dataGraphZones[9] += 1;
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
                            case "+1100":
                            dataGraphZones[23] += 1;
                            break;
                            case "+1200":
                            dataGraphZones[24] += 1;
                            break;
                            default:
                            break;
                        }
                    }
                    break;
                }
            }
            return dataGraphZones;
        }
    }

function destroyGraph(){
    if (typeof myLineChart != 'undefined') {
     myLineChart.destroy();
    }
}

function drawGraph(){

    var dataGraph = getData(arrayData, chartStatus);
    console.log(dataGraph);
    var labels;

    if (chartStatus){
        labels = ['1987', '1988', '1989', '1990', '1991', '1992', '1993', '1994', '1995', '1996', '1997', '1998', '1999', '2000', '2001', '2002', '2003', '2004', '2005', '2006', '2007', '2008', '2009', '2010', '2011', '2012', '2013', '2014', '2015', '2016', '2017', '2018']
    } else {
        labels = ['UTC -12', 'UTC -11', 'UTC -10', 'UTC -9', 'UTC -8', 'UTC -7', 'UTC -6', 'UTC -5', 'UTC -4', 'UTC -3', 'UTC -2', 'UTC -1', 'UTC 0', 'UTC +1', 'UTC +2', 'UTC +3', 'UTC +4', 'UTC +5', 'UTC +6', 'UTC +7', 'UTC +8', 'UTC +9', 'UTC +10', 'UTC +11', 'UTC +12'] 
    }

    destroyGraph();
    
    
    const ctx = document.getElementById('myChart');
    
    myLineChart = new Chart(ctx, {
    type: 'line',
    data: {
        
        labels: labels,
        datasets: [{
            label: '# 1',
            
            data: dataGraph,
            borderWidth: 1,
            tension: 0.4,
            fill: true
            
        },
        {
            label: '# 2',
            
            data: [], //620,456,2689,3282,2535,1669,1393,990,838,817,1445,1037,1092,1114,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0
            borderWidth: 1,
            tension: 0.4,
            fill: true
            
        }
        ]
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

drawGraph();
</script>

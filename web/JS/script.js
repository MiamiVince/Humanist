const ctx = document.getElementById('myChart');

  new Chart(ctx, {
    type: 'line',
    data: {
        
        labels: ['1987', '1988', '1989', '1990', '1991', '1992', '1993', '1994', '1995', '1996', '1997', '1998', '1999', '2000', '2001', '2002', '2003', '2004', '2005', '2006', '2007', '2008', '2009', '2010', '2011', '2012', '2013', '2014', '2015', '2016', '2017', '2018'],
        datasets: [{
            label: '# 1',
           
            data: [40, 122, 30, 5, 44, 67, 467, 367, 298, 176, 223, 467, 56, 520, 121, 267,535, 512,519, 245, 278, 398, 178, 43, 45, 80, 46, 78, 35, 65, 35, 13],
            borderWidth: 1,
            tension: 0.4,
            fill: true
            
        },
        {
            label: '# 2',
           
            data: [400, 322, 330, 539, 444, 367, 67, 67, 98, 476, 123, 67, 256, 20, 321, 167,35, 12,19, 45, 78, 98, 378, 443, 445, 380, 246, 178, 135, 265, 335, 380],
            borderWidth: 1,
            tension: 0.4,
            fill: true
            
        },
        {
            label: '# 3',
            //backgroundColor: 'rgba(255, 99, 132,0.5)',
            data: [300, 222, 430, 139, 44, 267, 167, 267, 398, 76, 323,267, 56, 120, 121, 267,335, 212,119, 145, 178, 198, 278, 343, 345, 480, 346, 278, 335, 165, 435,400],
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
            min: 0,
            max: 600
        }
        }

      
    }
  });

  // fillColor: "rgba(220,220,220,0.2)",
           // strokeColor: "rgba(220,220,220,1)",
           // pointColor: "rgba(220,220,220,1)",
            //pointStrokeColor: "fff",
            //pointHighlightFill: "fff",
            //pointHighlightStroke: "rgba(220,220,220,1)",

            //backgroundColor: 'rgb(255, 99, 132)',
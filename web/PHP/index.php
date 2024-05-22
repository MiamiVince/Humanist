<?php 
  include 'dbh.php';
?>

<!doctype html>
<html lang="en" data-bs-theme="auto">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>HUMANIST Web Search</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <link href="../CSS/bootstrap.min.css" rel="stylesheet">
    <link href="../CSS/blog.css" rel="stylesheet">
  </head>

  <body id="bodyBottom">
  
    <!--Header-->
  <div class="container">
    <header class="border-bottom lh-1 py-3">
      <div class="col-12 text-center">
        <a class="blog-header-logo text-body-emphasis text-decoration-none" href="index.php">HUMANIST Reaserch</a>
      </div>
    </header>

      <!--NavBar-->
    <div class="nav-scroller py-1 mb-3 border-bottom">
      <nav class="nav nav-underline justify-content-left">
        <a class="nav-item nav-link link-body-emphasis active" href="index.php">Reasearch</a>
        <a class="nav-item nav-link link-body-emphasis" href="#">Archives</a>
      </nav>
    </div>
  </div>

  <main class="container">
    <!--Mail Content-->
    <div class="row g-5">
      <div class="col-md-8" id="mailContent">
        <p >There are currently no search results.
          Please fill in the search form.</p>
      </div>
      <!--Sidebar / Search-->
      <div class="col-md-4">
        <div class="position-sticky" style="top: 2rem;">
          <div class="p-4 mb-3 bg-body-tertiary rounded">
            <h4 class="fst-italic">About</h4>
            
              <form action="load-mailcontent.php" method="POST" id="searchForm">
                <div>
                  <label for ="wordsearch" class="form-label">Free Text Search</label>
                  <input class="form-control" id="wordsearch" type="text">
                </div>
                <div>
                  <label for="category" class="form-select-label">Category</label>
                  <select class="form-select" aria-label="Default select example" id="category">
                    <option selected>Select Category</ooption>
                    <option value="timezones">Timezones</option>
                  </select>
                </div>
                <div>
                  <label for="fromYear" class="form-select-label">From Year</label>
                  <select class="form-select" aria-label="Default select example" id="fromYear">
                    <option selected>Select Year</ooption>
                    <option value="1987">1987</option>
                    <option value="1988">1988</option>
                    <option value="1989">1989</option>
                    <option value="1990">1990</option>
                    <option value="1991">1991</option>
                    <option value="1992">1992</option>
                    <option value="1993">1993</option>
                    <option value="1994">1994</option>
                    <option value="1995">1995</option>
                    <option value="1996">1996</option>
                    <option value="1997">1997</option>
                    <option value="1998">1998</option>
                    <option value="1999">1999</option>
                    <option value="2000">2000</option>
                    <option value="2001">2001</option>
                    <option value="2002">2002</option>
                    <option value="2003">2003</option>
                    <option value="2004">2004</option>
                    <option value="2005">2005</option>
                    <option value="2006">2006</option>
                    <option value="2007">2007</option>
                    <option value="2008">2008</option>
                    <option value="2009">2009</option>
                    <option value="2010">2010</option>
                    <option value="2011">2011</option>
                    <option value="2012">2012</option>
                    <option value="2013">2013</option>
                    <option value="2014">2014</option>
                    <option value="2015">2015</option>
                    <option value="2016">2016</option>
                    <option value="2017">2017</option>
                    <option value="2018">2018</option>
                  </select>
                  <label for="toYear" class="form-select-label">To Year</label>
                  <select class="form-select" aria-label="Default select example" id="toYear">
                    <option selected>Select Year</ooption>
                    <option value="1987">1987</option>
                    <option value="1988">1988</option>
                    <option value="1989">1989</option>
                    <option value="1990">1990</option>
                    <option value="1991">1991</option>
                    <option value="1992">1992</option>
                    <option value="1993">1993</option>
                    <option value="1994">1994</option>
                    <option value="1995">1995</option>
                    <option value="1996">1996</option>
                    <option value="1997">1997</option>
                    <option value="1998">1998</option>
                    <option value="1999">1999</option>
                    <option value="2000">2000</option>
                    <option value="2001">2001</option>
                    <option value="2002">2002</option>
                    <option value="2003">2003</option>
                    <option value="2004">2004</option>
                    <option value="2005">2005</option>
                    <option value="2006">2006</option>
                    <option value="2007">2007</option>
                    <option value="2008">2008</option>
                    <option value="2009">2009</option>
                    <option value="2010">2010</option>
                    <option value="2011">2011</option>
                    <option value="2012">2012</option>
                    <option value="2013">2013</option>
                    <option value="2014">2014</option>
                    <option value="2015">2015</option>
                    <option value="2016">2016</option>
                    <option value="2017">2017</option>
                    <option value="2018">2018</option>
                  </select>
                </div>
                <button type="submit" name="submit" class="btn btn-primary" id="searchBTN">Search</button>
              </form>
            </div>

          
        </div>
      </div>
    </div>
  </main>

  <footer class="py-4 text-center bg-body-tertiary fixed-bottom">
    <div class ="chartBox">
      <canvas  id="myChart"></canvas>
    </div>
  </footer>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="../JS/ajax.js"></script>
</body>
    
</html>
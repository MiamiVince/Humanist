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
        <a class="blog-header-logo text-body-emphasis text-decoration-none" href="index.php">HUMANIST Rsearch</a>
      </div>
    </header>

      <!--NavBar-->
    <div class="nav-scroller py-1 mb-3 border-bottom">
      <nav class="nav nav-underline justify-content-left">
        <a class="nav-item nav-link link-body-emphasis active" href="index.php">Research</a>
        <a class="nav-item nav-link link-body-emphasis" href="https://dhhumanist.org/">Archives</a>
      </nav>
    </div>
  </div>

  <main class="container">
    <!--Mail Content-->
    <div class="row g-5">
      <div class="col-md-8" id="mailContent">
        <div class="p-4 mb-3 bg-body-tertiary rounded">
          <p >HUMANIST Research offers a search through the archives of the Humanist Discussion Group. The data is based on all emails from 1987 to 2018.
              The search form offers the possibility to search for text content, categories of email topics and years. These options can also be used in combination. However, at least one must be selected. In the case of “To Year”, “From Year” must also be selected.
              The graph at the bottom shows either the number of emails searched for by year or by time zone. <br><br> There are currently no search results.
            Please fill in the search form and click on "Search".</p>
        </div>
      </div>
      <!--Sidebar / Search-->
      <div class="col-md-4">
        <div class="position-sticky" style="top: 2rem;">
          <div class="p-4 mb-1 bg-body-tertiary rounded">
            <h4 class="fst-italic">Search Form</h4>
            
            <form action="load-mailcontent.php" method="POST" id="searchForm">
            <div class="mb-2">
                  <label for ="wordsearch" class="form-label">Free Text Search</label>
                  <input class="form-control" id="wordsearch" type="text">
                </div>
                  <div class="mb-2">
                    <label for="category" class="form-select-label">Category</label>
                  <select class="form-select" aria-label="Default select example" id="category">
                    <option selected>Select Category</ooption>
                    <option value="Conference Announcements">Conference Announcements</option>
                    <option value="Book Announcements">Book Announcements</option>
                    <option value="Calls for Papers">Calls for Papers</option>
                    <option value="Job Postings">Job Postings</option>
                    <option value="Research Queries">Research Queries</option>
                    <option value="Event Information">Event Information</option>
                    <option value="Publications">Publications</option>
                    <option value="Technical Issues">Technical Issues</option>
                    <option value="Literature Review">Literature Review</option>
                    <option value="Data Sharing">Data Sharing</option>
                    <option value="Collaboration Requests">Collaboration Requests</option>
                    <option value="Research Findings">Research Findings</option>
                    <option value="Methodological Discussions">Methodological Discussions</option>
                    <option value="Workshop Invitations">Workshop Invitations</option>
                    <option value="Seminar Details">Seminar Details</option>
                    <option value="tiWebinar Informationmezones">Webinar Information</option>
                    <option value="Symposium Notices">Symposium Notices</option>
                    <option value="Journal Articles">Journal Articles</option>
                    <option value="Online Resources">Online Resources</option>
                    <option value="Databases">Databases</option>
                  </select>
                </div>
                  <div class="row g-5 mb-2">
                    <div class="col-md-6">
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
                  </div>
                  <div class="col-md-6">
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
                </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="graphRadio" id="radioYears" value="radioYears" checked>
                    <label class="form-check-label" for="radioYears">
                      Graph: Years 1987 - 2018
                    </label>
                  </div>
                  <div class="form-check">
                  <input type="hidden" id="pageIndex" name="pageIndex" value="0">
                    <input class="form-check-input" type="radio" name="graphRadio" id="radioTimezones" value="radioTimezones">
                    <label class="form-check-label" for="radioTimezones">
                      Graph: Timezones
                    </label>
                  </div>
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
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
    
</html>
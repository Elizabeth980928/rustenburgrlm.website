<?php


class query extends Connection
{

//Annual budget,annual report, performance agreement, performance report
  public function getReports($grouptype,$fyfrom,$fyto)
  {



      $stmt=$this->openConnection()->prepare("SELECT description ,filepath,dateuploaded FROM documents_uploaded WHERE grouptype=:grouptype AND fyfrom>=:fyfrom AND fyto<=:fyto ORDER BY dateuploaded ");
      $stmt->bindParam("grouptype", $grouptype,PDO::PARAM_STR);
      $stmt->bindParam("fyfrom", $fyfrom,PDO::PARAM_STR) ;
      $stmt->bindParam("fyto", $fyto,PDO::PARAM_STR) ;
      $stmt->execute();
      if($stmt->rowCount()>=1)

      {
          echo"<table class='styled-table'>
  <tr>
    <th>Description</th>
    <th>Date uploaded</th>
    
  </tr>";
          while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

              extract($row);
              echo"<tr>";
              echo"<td><a href='../$row[filepath]' target='_blank'>$row[description]</a></td>";
              echo"<td>$row[dateuploaded]</td>";

              echo"</tr>";





          }
          echo" </table>";
      }
else{
    echo "<h2>No Documents found.</h2>";
}
  }
  
  


//Documents

    public function getDocuments($grouptype)
    {



        $stmt=$this->openConnection()->prepare("SELECT description ,filepath,dateuploaded FROM documents_uploaded WHERE grouptype=:grouptype ORDER BY dateuploaded DESC ");
        $stmt->bindParam("grouptype", $grouptype,PDO::PARAM_STR);
        $stmt->execute();
        if($stmt->rowCount()>=1)

        {
            echo"<table class='styled-table'>
  <tr>
    <th>Description</th>
    <!--<th>Date uploaded</th>-->
    
  </tr>";
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                extract($row);
                echo"<tr>";
                echo"<td><a href='../$row[filepath]' target='_blank'>$row[description]</a></td>";
                //echo"<td>$row[dateuploaded]</td>";

                echo"</tr>";





            }
            echo" </table>";
        }
        else{
            echo "<h2>No Documents found.</h2>";
        }
    }

//recent news

    public function getNews($grouptype)
    {



        $stmt=$this->openConnection()->prepare("SELECT description ,filepath,image_path,dateuploaded FROM documents_uploaded WHERE grouptype=:grouptype ORDER BY dateuploaded DESC LIMIT 3");
        $stmt->bindParam("grouptype", $grouptype,PDO::PARAM_STR);
        $stmt->execute();
        if($stmt->rowCount()>=1)

        {

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                extract($row);
                echo" <div class='item'>
            <div class='thumb-post'>
                <div class='overlay'>
                    <div class='overlay-inner'>
                        <div class='portfolio-infos'>
                            <span class='meta-category'></span>
                            
                                       <h3 class='portfolio-title'><a href='./$row[filepath]' target='_blank'>$row[description]</a></h3>
                        </div>
                        <div class='portfolio-expand'>
                            <a class='fancybox' href='./$row[image_path]' title='$row[description]'>
                                <i class='fa fa-expand'></i>
                            </a>
                        </div>
                    </div>
                </div>
                <img src='./$row[image_path]' alt='$row[description]'>
            </div>
        </div> 
";


            }

        }
        else{
            echo "<h2>No news</h2>";
        }
    }




    //Notices

    public function getNotices($grouptype)
    {



        $stmt=$this->openConnection()->prepare("SELECT description ,filepath,dateuploaded FROM documents_uploaded WHERE grouptype=:grouptype ORDER BY dateuploaded DESC LIMIT 3");
        $stmt->bindParam("grouptype", $grouptype,PDO::PARAM_STR);
        $stmt->execute();
        if($stmt->rowCount()>=1)

        {

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                extract($row);
                echo"  <div class='testimonial'>
                        <div class='testimonial-content'>
                            <span class='testimonial-author' style='color:#13553b;font-size:30px'>Public notice</span>
                            <p class='testimonial-description'><a href='./$row[filepath]' target='_blank'>$row[description]</a></p>
                        </div>
                    </div>
";


            }

        }
        else{
            echo "<h2>No notices</h2>";
        }
    }


//Vacancies, Tender adverts and bursaries

    public function getProcurement($grouptype,$fyfrom,$fyto)
    {



        $stmt=$this->openConnection()->prepare("SELECT description ,filepath,dateuploaded,ddate FROM documents_uploaded WHERE grouptype=:grouptype AND fyfrom>=:fyfrom AND fyto<=:fyto ORDER BY ddate DESC ");
        $stmt->bindParam("grouptype", $grouptype,PDO::PARAM_STR);
		$stmt->bindParam("fyfrom", $fyfrom,PDO::PARAM_STR) ;
        $stmt->bindParam("fyto", $fyto,PDO::PARAM_STR) ;
        $stmt->execute();
        if($stmt->rowCount()>=1)

        {
            echo"<table class='styled-table'>
  <tr>
    <th>Description</th>
    <th>Date uploaded</th>
    <th>Closing date</th>
  </tr>";
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                extract($row);
                echo"<tr>";
                echo"<td><a href='../$row[filepath]' target='_blank'>$row[description]</a></td>";
                echo"<td>$row[dateuploaded]</td>";
                echo"<td>$row[ddate]</td>";

                echo"</tr>";





            }
            echo" </table>";
        }
        else{
            echo "<h2>No Documents found.</h2>";
        }
    }

    //Other Tenders

    public function getTenders($grouptype)
    {



        $stmt=$this->openConnection()->prepare("SELECT description ,filepath,dateuploaded,ddate FROM documents_uploaded WHERE grouptype=:grouptype ORDER BY ddate DESC ");
        $stmt->bindParam("grouptype", $grouptype,PDO::PARAM_STR);
        $stmt->execute();
        if($stmt->rowCount()>=1)

        {
            echo"<table class='styled-table'>
      <tr>
        <th>Description</th>
        <th>Date uploaded</th>
        <th>Closing date</th>
      </tr>";
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                extract($row);
                echo"<tr>";
                echo"<td><a href='../$row[filepath]' target='_blank'>$row[description]</a></td>";
                echo"<td>$row[dateuploaded]</td>";
                echo"<td>$row[ddate]</td>";

                echo"</tr>";





            }
            echo" </table>";
        }
        else{
            echo "<h2>No Documents found.</h2>";
        }
    }



//Annual budget
   /* public function getReports($fyfrom,$fyto)
    {

        $grouptype="annual report";

        $stmt=$this->openConnection()->prepare("SELECT description ,filepath,dateuploaded FROM documents_uploaded WHERE grouptype=:grouptype AND fyfrom>=:fyfrom AND fyto<=:fyto ORDER BY dateuploaded ");
        $stmt->bindParam("grouptype", $grouptype,PDO::PARAM_STR);
        $stmt->bindParam("fyfrom", $fyfrom,PDO::PARAM_STR) ;
        $stmt->bindParam("fyto", $fyto,PDO::PARAM_STR) ;
        $stmt->execute();
        if($stmt->rowCount()>=1)

        {
            echo"<class="styled-table">
  <tr>
    <th>Description</th>
    <th>Date uploaded</th>
    
  </tr>";
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                extract($row);
                echo"<tr>";
                echo"<td><a href='../$row[filepath]' target='_blank'>$row[description]</a></td>";
                echo"<td>$row[dateuploaded]</td>";

                echo"</tr>";





            }
            echo" </table>";
        }
        else{
            echo "<h2>No Documents found.</h2>";
        }
    }*/
//Archives


    public function getArchives()
    {



        $stmt=$this->openConnection()->prepare("SELECT description ,filepath,dateuploaded,ddate FROM documents_uploaded WHERE (grouptype='tender_adverts' OR grouptype='quotation') AND fyfrom<2017 AND fyto=2017 ORDER BY ddate DESC ");

        $stmt->execute();
        if($stmt->rowCount()>=1)

        {
            echo"<table class='styled-table'>
  <tr>
    <th>Description</th>
    <th>Date uploaded</th>
    <th>Closing date</th>
  </tr>";
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                extract($row);
                echo"<tr>";
                echo"<td><a href='../$row[filepath]' target='_blank'>$row[description]</a></td>";
                echo"<td>$row[dateuploaded]</td>";
                echo"<td>$row[ddate]</td>";

                echo"</tr>";





            }
            echo" </table>";
        }
        else{
            echo "<h2>No Documents found.</h2>";
        }
    }

//vacancies archives

    public function getOldVacancies()
    {



        $stmt=$this->openConnection()->prepare("SELECT description ,filepath,dateuploaded,ddate FROM documents_uploaded WHERE grouptype  IN ('int_vacancies', 'ext_vacancies') ORDER BY ddate DESC");

        $stmt->execute();
        if($stmt->rowCount()>=1)

        {
            echo"<table class='styled-table'>
  <tr>
    <th>Description</th>
    <th>Date uploaded</th>
    <th>Closing date</th>
  </tr>";
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                extract($row);
                echo"<tr>";
                echo"<td><a href='../$row[filepath]' target='_blank'>$row[description]</a></td>";
                echo"<td>$row[dateuploaded]</td>";
                echo"<td>$row[ddate]</td>";

                echo"</tr>";





            }
            echo" </table>";
        }
        else{
            echo "<h2>No Documents found.</h2>";
        }
    }


    //Bursaries archives

    public function getOldBursary()
    {



        $stmt=$this->openConnection()->prepare("SELECT description ,filepath,dateuploaded,ddate FROM documents_uploaded WHERE grouptype='bursary'  AND ddate<current_date() ORDER BY ddate ");

        $stmt->execute();
        if($stmt->rowCount()>=1)

        {
            echo"<table class='table'>
  <tr>
    <th>Description</th>
    <th>Date uploaded</th>
    <th>Closing date</th>
  </tr>";
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                extract($row);
                echo"<tr>";
                echo"<td><a href='../$row[filepath]' target='_blank'>$row[description]</a></td>";
                echo"<td>$row[dateuploaded]</td>";
                echo"<td>$row[ddate]</td>";

                echo"</tr>";





            }
            echo" </table>";
        }
        else{
            echo "<h2>No Documents found.</h2>";
        }
    }


    //Media items,other Documents

    public function getDocs($grouptype)
    {



        $stmt=$this->openConnection()->prepare("SELECT description ,filepath,dateuploaded FROM documents_uploaded WHERE grouptype=:grouptype  ORDER BY dateuploaded DESC ");
        $stmt->bindParam("grouptype", $grouptype,PDO::PARAM_STR);
        $stmt->execute();
        if($stmt->rowCount()>=1)

        {
            echo"<table class='styled-table'>
  <tr>
    <th>Description</th>
     <th>Date uploaded</th>
    

  </tr>";
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                extract($row);
                echo"<tr>";
                echo"<td><a href='../$row[filepath]' target='_blank'>$row[description]</a></td>";

                echo"<td>$row[dateuploaded]</td>";

                echo"</tr>";





            }
            echo" </table>";
        }
        else{
            echo "<h2>No Documents found.</h2>";
        }
    }




    //Search

    public function getSearch($find)
    {


            $stmt = $this->openConnection()->prepare("SELECT description ,filepath,dateuploaded FROM documents_uploaded WHERE description  LIKE concat('%',:find,'%') ORDER BY description");
            $stmt->bindParam("find", $find, PDO::PARAM_STR);
            $stmt->execute();
            if ($stmt->rowCount() >= 1) {
                echo "<table class='styled-table'>
  <tr>
    <th>Description</th>
    <th>Date uploaded</th>
    
  </tr>";
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                    extract($row);
                    echo "<tr>";
                    echo "<td><a href='../$row[filepath]' target='_blank'>$row[description]</a></td>";
                    echo "<td>$row[dateuploaded]</td>";



                    echo "</tr>";


                }

                echo " </table>";
            }

            else

            {

                    echo "<h2>Sorry , no match.</h2>";

            }


    }

//end of class
}

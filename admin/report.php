<?php
  session_start();
  require 'session.php';
  include "navbar.php";
  require_once "../model/db.php";
?>
<div class="wrapper">
  <section class="section">
    <div class="container2">
      <h5><i class="fas fa-chart-line"></i> Report analysis</h5>
      <div class="divider"></div>
      <div class="row">
        <div class="col s12 m6">
          <h5>Subscription Status</h5>
          <div class="chart-container">
            <canvas id="chart1"></canvas>
          </div>
        </div>
        <div class="col s12 m6">
          <h5>Total Booked</h5>
          <div class="chart-container">
            <canvas id="chart2"></canvas>
          </div>
        </div>
      </div><br>

      <div class="divider"></div><br>
      <h5>Student Department</h5>
      <canvas id="chart3"></canvas><br>

      <div class="divider"></div><br>
      <h5>Total Paid Student</h5>
      <canvas id="chart4"></canvas><br>
    </div>
  </section>
</div>
<?php
  include "footer.php";
?>
<script type="text/javascript">
  $(document).ready(function(){
    // Chart 1 - Total active user
    let ctx1 = $('#chart1');
    let myChart1 = new Chart(ctx1, {
      type: 'pie',
      data: {
        labels: ["Active", "Expired"],
        datasets: [{
          data: [
            <?php
              $sql = "SELECT SUM(record_sub = 'active') AS active, SUM(record_sub = 'expired') AS expired FROM record";
              $result = mysqli_query($conn, $sql);
              while ($row = mysqli_fetch_array($result)) {
                echo $row['active'].",".$row['expired'];
              }
            ?>
          ],
          backgroundColor: [
            'rgba(255, 99, 132, 0.2)',
            'rgba(54, 162, 235, 0.2)'
          ],
          borderColor: [
            'rgba(255,99,132,1)',
            'rgba(54, 162, 235, 1)'
          ],
          borderWidth: 1
        }]
      }
    });

    // Chart 2 - Total booked
    let ctx2 = $('#chart2');
    let myChart2 = new Chart(ctx2, {
      type: 'pie',
      data: {
        labels: ["Booked", "Available", "Damage"],
        datasets: [{
          data: [
            <?php
              $sql = "SELECT SUM(locker_status = 'available') AS available, SUM(locker_status = 'booked') AS booked, SUM(locker_status = 'damage') AS damage FROM locker";
              $result = mysqli_query($conn, $sql);
              while ($row = mysqli_fetch_array($result)) {
                echo $row['available'].",".$row['booked'].",".$row['damage'];
              }
            ?>
          ],
          backgroundColor: [
            'rgba(54, 162, 235, 0.3)',
            'rgba(153, 102, 255, 0.3)',
            'rgba(255, 99, 132, 0.3)'
          ],
          borderColor: [
            'rgba(54, 162, 235, 1)',
            'rgba(153, 102, 255, 1)',
            'rgba(255, 99, 132, 1)',
          ],
          borderWidth: 1
        }]
      }
    });

    // Chart 3 -
    let ctx3 = $('#chart3');
    let myChart3 = new Chart(ctx3, {
      type: 'bar',
      data: {
          labels: ["FTMK", "FKE", "FKEKK", "FTP", "FPTT", "FKP", "FKM"],
          datasets: [{
              label: '# Student Department',
              data: [
                <?php
                  $sql = "SELECT SUM(student_department = 'FTMK') AS ftmk,
                  SUM(student_department = 'FKE') AS fke,
                  SUM(student_department = 'FKEKK') AS fkekk,
                  SUM(student_department = 'FTP') AS ftp,
                  SUM(student_department = 'FPTT') AS fptt,
                  SUM(student_department = 'FKP') AS fkp,
                  SUM(student_department = 'FKM') AS fkm
                  FROM student";
                  $result = mysqli_query($conn, $sql);
                  while ($row = mysqli_fetch_array($result)) {
                    echo $row['ftmk'].",".$row['fke'].",".$row['fkekk'].",".$row['ftp'].",".$row['fptt'].",".$row['fkp'].",".$row['fkm'];
                  }
                ?>
              ],
              backgroundColor: [
                  'rgba(255, 99, 132, 0.2)',
                  'rgba(54, 162, 235, 0.2)',
                  'rgba(255, 206, 86, 0.2)',
                  'rgba(75, 192, 192, 0.2)',
                  'rgba(153, 102, 255, 0.2)',
                  'rgba(255, 159, 64, 0.2)',
                  'rgba(0, 0, 0, 0.2)'
              ],
              borderColor: [
                  'rgba(255,99,132,1)',
                  'rgba(54, 162, 235, 1)',
                  'rgba(255, 206, 86, 1)',
                  'rgba(75, 192, 192, 1)',
                  'rgba(153, 102, 255, 1)',
                  'rgba(255, 159, 64, 1)',
                  'rgba(0, 0, 0, 1)'
              ],
              borderWidth: 1
          }]
      },
      options: {
        elements: {
          point: {
            radius:0
          }
        },
        scales: {
          yAxes: [{
            ticks: {
              beginAtZero:true
            }
          }]
        }
      }
    });

    // Chart 4 -
    let ctx4 = $('#chart4');
    let myChart4= new Chart(ctx4, {
      type: 'bar',
      data: {
          labels: ["Paid", "Pending"],
          datasets: [{
              label: '# Total Paid Student',
              data: [
                <?php
                  $sql = "SELECT SUM(record_status = 'approved') AS app,
                  SUM(record_status = 'pending') AS pen FROM record";
                  $result = mysqli_query($conn, $sql);
                  while ($row = mysqli_fetch_array($result)) {
                    echo $row['app'].",".$row['pen'];
                  }
                ?>
              ],
              backgroundColor: [
                  'rgba(255, 99, 132, 0.2)',
                  'rgba(54, 162, 235, 0.2)'
              ],
              borderColor: [
                  'rgba(255,99,132,1)',
                  'rgba(54, 162, 235, 1)',
              ],
              borderWidth: 1
          }]
      },
      options: {
        elements: {
          point: {
            radius:0
          }
        },
        scales: {
          yAxes: [{
            ticks: {
              beginAtZero:true
            }
          }]
        }
      }
    });
  });
</script>

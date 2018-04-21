<?php
  session_start();
  include 'navbar.php';
  require 'model/db.php';
?>
<section class="section">
  <div class="container">
    <h5><i class="fas fa-box blue-text"></i> Locker List</h5>
    <div class="divider"></div><br>

    <div class="row">
      <!-- Locker icon with number -->
      <div class="col s12 m9">
        <div class="row">
          <?php
            $sql = "SELECT * FROM `locker`";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_array($result)):
          ?>
          <div class='col s6 m3'>
            <div class='card'>
              <div class='card-image'>
                <img src='img/locker1.png' class='responsive-img' alt='locker'>
              </div>
              <div class='card-action'>
                <input type="hidden" name="id" value="<?php echo $row['locker_id']; ?>">
                <div><?php echo $row['locker_id']; ?></div>
                <div>RM <?php echo $row['locker_price']; ?></div>
                <div class="<?php switch ($row['locker_status']) {
                  case 'Available':
                    echo 'green-text';
                    break;
                  case 'Booked':
                    echo 'blue-text';
                    break;
                  case 'Damage':
                    echo 'red-text';
                    break;
                  default:
                    echo 'black-text';
                    break;
                } ?>"><?php echo $row['locker_status'] ?></div><br>
                <?php if ($row['locker_status'] == 'Available'): ?>
                  <div class="center">
                    <a href="booking.php?id=<?php echo $row['locker_id']; ?>" class="btn blue">Book</a>
                  </div>
                <?php else: ?>
                  <div class="center">
                    <a href='' class='btn disabled'>Book</a>
                  </div>
                <?php endif ?>
              </div>
            </div>
          </div>
          <?php endwhile ?>
        </div>
      </div>

      <!-- Locker Details, Available -->
      <div class="col s12 m3">
        <div class="row">
          <ul class="collection with-header">
            <li class="collection-header blue white-text">
              <i class="fas fa-box"></i> Lockers
            </li>
            <?php
              // Total
              $sql = "SELECT COUNT(locker_id) as total from `locker`";
              $result = mysqli_query($conn, $sql);
              $row = mysqli_fetch_array($result);
              echo "<li class='collection-item'>Total: <span class='secondary-content'>".$row['total']."</span></li>";

              // Available
              $sql = "SELECT COUNT(locker_status) as available from `locker` WHERE locker_status='Available'";
              $result = mysqli_query($conn, $sql);
              $row = mysqli_fetch_array($result);
              echo "<li class='collection-item'>Available: <span class='secondary-content green-text'>".$row['available']."</span></li>";

              // Booked
              $sql = "SELECT COUNT(locker_status) as booked from `locker` WHERE locker_status='Booked'";
              $result = mysqli_query($conn, $sql);
              $row = mysqli_fetch_array($result);
              echo "<li class='collection-item'>Booked: <span class='secondary-content'>".$row['booked']."</span></li>";

              // Damage
              $sql = "SELECT COUNT(locker_status) as damage from `locker` WHERE locker_status='Damage'";
              $result = mysqli_query($conn, $sql);
              $row = mysqli_fetch_array($result);
              echo "<li class='collection-item'>Damage: <span class='secondary-content red-text'>".$row['damage']."</span></li>";
            ?>
          </ul>
        </div>
        <div class="row">
          <ul class="collection with-header">
            <li class="collection-header blue white-text">
              <i class="fas fa-info"></i> Notification
            </li>
            <li>
              <p style="padding:0 1em;">Please <a href="register.php">register</a> first before you make any booking, once booked print the receipt and bring the receipt for payment at counter receptionist.</p>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>
<?php
  include 'footer.php';
?>

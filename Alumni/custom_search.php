<?php
session_start();
include 'conn.php';


?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Search Alumni</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      margin: 0;
      padding: 0;
      background: linear-gradient(120deg, #d1e3ff, #f0f4fb);
      font-family: 'Segoe UI', sans-serif;
    }
    .search-card {
      background: linear-gradient(to right, #ffffff, #f3f9ff);
      border-radius: 20px;
      box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
      padding: 40px;
      border: 1px solid #f57c00;
      font-size: 18px;
    }

    


    .btn-primary {
      background: linear-gradient(to right, #007bff, #0056b3);
      border: none;
      border-radius: 30px;
    }
    .btn-primary:hover {
      background: linear-gradient(to right, #0056b3, #003c80);
    }
    .result-table {
      background: #ffffff;
      border-radius: 20px;
      overflow: hidden;
      box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
    }
    .table-hover tbody tr:hover {
      background-color: #f0f8ff;
    }
    .table th {
      background-color: #007bff;
      color: white;
      text-align: center;
    }
    .table td {
      vertical-align: middle;
      text-align: center;
    }
  </style>
</head>
<body>


<?php

include 'header.php';

?>
<div class="container my-5">

  <div class="search-card mb-5">
    <h3 class="mb-4 text-center">🎓 Search Alumni</h3>

    <form method="GET" class="row g-3">

      <!-- Keyword Input -->
      <div class="col-md-3">
        <label class="form-label fw-bold">Keyword</label>
        <input type="text" class="form-control" name="keyword" 
               value="<?= htmlspecialchars($_GET['keyword'] ?? '') ?>" 
               placeholder="Search by any keyword...">
      </div>

      <!-- Name Input -->
      <div class="col-md-3">
        <label class="form-label fw-bold">Name</label>
        <input type="text" class="form-control" name="name" 
               value="<?= htmlspecialchars($_GET['name'] ?? '') ?>" 
               placeholder="Enter alumni name...">
      </div>

      <!-- Batch Dropdown -->
      <div class="col-md-3">
        <label class="form-label fw-bold">ICE Batch</label>
        <?php $batch_nos = (array) ($_GET['ice_batch'] ?? []); ?>
        <div class="dropdown">
          <button id="btn-batch" class="form-control dropdown-toggle text-start" type="button" data-bs-toggle="dropdown">
            <?= empty($batch_nos) ? 'Select Batches' : implode(', ', $batch_nos) ?>
          </button>
          <ul class="dropdown-menu px-3">
            <?php
            $res = mysqli_query($conn, "SELECT DISTINCT ice_batch FROM alumni_info WHERE ice_batch != '' ORDER BY ice_batch ASC");
            while ($row = mysqli_fetch_assoc($res)) {
                $batch = $row['ice_batch'];
                $checked = in_array($batch, $batch_nos) ? 'checked' : '';
                echo "<li><div class='form-check'>
                        <input class='form-check-input' type='checkbox' name='ice_batch[]' value='$batch' $checked>
                        <label class='form-check-label'>$batch</label>
                      </div></li>";
            }
            ?>
          </ul>
        </div>
      </div>

      <!-- Sector Dropdown -->
      <div class="col-md-3">
        <label class="form-label fw-bold">Sector</label>
        <?php $sectors = (array) ($_GET['sector'] ?? []); ?>
        <div class="dropdown">
          <button id="btn-sector" class="form-control dropdown-toggle text-start" type="button" data-bs-toggle="dropdown">
            <?= empty($sectors) ? 'Select Sectors' : implode(', ', $sectors) ?>
          </button>
          <ul class="dropdown-menu px-3">
            <?php
            $res = mysqli_query($conn, "SELECT DISTINCT sector FROM alumni_info WHERE sector != '' ORDER BY sector ASC");
            while ($row = mysqli_fetch_assoc($res)) {
                $sector = $row['sector'];
                $checked = in_array($sector, $sectors) ? 'checked' : '';
                echo "<li><div class='form-check'>
                        <input class='form-check-input' type='checkbox' name='sector[]' value='$sector' $checked>
                        <label class='form-check-label'>$sector</label>
                      </div></li>";
            }
            ?>
          </ul>
        </div>
      </div>

      <!-- Submit button (full row) -->
      <div class="col-12 text-center mt-3">
        <button type="submit" class="btn btn-primary btn-lg px-5">Search</button>
      </div>
    </form>
  </div>

  <?php
  if ($_GET) {
    
      $query = "SELECT * FROM alumni_info WHERE is_Approve = 1";


      // Keyword search across multiple columns
      if (!empty($_GET['keyword'])) {
          $keyword = mysqli_real_escape_string($conn, $_GET['keyword']);
          $query .= " AND (
              name LIKE '%$keyword%' OR 
              ice_batch LIKE '%$keyword%' OR 
              sector LIKE '%$keyword%' OR 
              designation LIKE '%$keyword%' OR 
              workplace LIKE '%$keyword%' OR 
              email LIKE '%$keyword%' OR 
              phone LIKE '%$keyword%' OR 
              facebook LIKE '%$keyword%' OR 
              linkedin LIKE '%$keyword%'
          )";
      }

      // Name search
      if (!empty($_GET['name'])) {
          $name = mysqli_real_escape_string($conn, $_GET['name']);
          $query .= " AND name LIKE '%$name%'";
      }

      // Batch filter
      if (!empty($batch_nos)) {
          $batch_safe = array_map(fn($b) => "'" . mysqli_real_escape_string($conn, $b) . "'", $batch_nos);
          $query .= " AND ice_batch IN (" . implode(',', $batch_safe) . ")";
      }

      // Sector filter
      if (!empty($sectors)) {
          $sector_safe = array_map(fn($s) => "'" . mysqli_real_escape_string($conn, $s) . "'", $sectors);
          $query .= " AND sector IN (" . implode(',', $sector_safe) . ")";
      }

      // ✅ Pagination setup
      $limit = 5; // results per page
      $page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int) $_GET['page'] : 1;
      $offset = ($page - 1) * $limit;

      // Count total rows
      $count_query = str_replace("SELECT *", "SELECT COUNT(*) as total", $query);
      $count_res = mysqli_query($conn, $count_query);
      $total_rows = mysqli_fetch_assoc($count_res)['total'];
      $total_pages = ceil($total_rows / $limit);

      // Fetch limited results
      $query .= " LIMIT $limit OFFSET $offset";
      $result = mysqli_query($conn, $query);

      if ($result && mysqli_num_rows($result) > 0) {
          echo "<div class='result-table mt-4'>";
          echo "<table class='table table-striped table-hover mb-0'>";
          echo "<thead class='table-dark'><tr>
                  <th>Name</th>
                  <th>ICE Batch</th>
                  <th>Sector</th>
                  <th>Designation</th>
                </tr></thead><tbody>";
         while ($row = mysqli_fetch_assoc($result)) {
            $alumni_id = $row['id'];
            $name = htmlspecialchars($row['name']);
            $batch = htmlspecialchars($row['ice_batch']);
            $sector = htmlspecialchars($row['sector']);
            $designation = htmlspecialchars($row['designation']);

            $image = !empty($row['user_img']) 
                ? 'image/' . htmlspecialchars($row['user_img']) 
                : 'image/blank_pp.png';

            echo "<tr>
                    <td class='d-flex align-items-center gap-2'>
                        <img src='$image' alt='Profile' width='35' height='35' style='object-fit:cover; border-radius:50%;'>
                        <a href='view_user.php?id=$alumni_id' class='text-decoration-none'>$name</a>
                    </td>
                    <td>$batch</td>
                    <td>$sector</td>
                    <td>$designation</td>
                  </tr>";
        }

          echo "</tbody></table></div>";

          // ✅ Pagination links
          if ($total_pages > 1) {
              echo "<nav class='mt-4'>
                      <ul class='pagination justify-content-center'>";
              
              // Previous button
              $prev_page = $page - 1;
              $disabled = ($page <= 1) ? "disabled" : "";
              echo "<li class='page-item $disabled'>
                      <a class='page-link' href='?" . http_build_query(array_merge($_GET, ['page' => $prev_page])) . "'>Previous</a>
                    </li>";

              // Page numbers
              for ($i = 1; $i <= $total_pages; $i++) {
                  $active = ($i == $page) ? "active" : "";
                  echo "<li class='page-item $active'>
                          <a class='page-link' href='?" . http_build_query(array_merge($_GET, ['page' => $i])) . "'>$i</a>
                        </li>";
              }

              // Next button
              $next_page = $page + 1;
              $disabled = ($page >= $total_pages) ? "disabled" : "";
              echo "<li class='page-item $disabled'>
                      <a class='page-link' href='?" . http_build_query(array_merge($_GET, ['page' => $next_page])) . "'>Next</a>
                    </li>";

              echo "</ul></nav>";
          }

      } else {
          echo "<div class='alert alert-warning mt-4 text-center'>🚫 No alumni found.</div>";
      }
  }
  ?>

</div>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
  function updateLabel(buttonId, checkboxName, defaultText) {
    const checkboxes = document.querySelectorAll(`input[name='${checkboxName}[]']`);
    const selected = Array.from(checkboxes).filter(c => c.checked).map(c => c.value);
    document.getElementById(buttonId).textContent = selected.length > 0 ? selected.join(', ') : defaultText;
  }

  document.addEventListener('DOMContentLoaded', function () {
    const mappings = [
      { btn: 'btn-batch', name: 'ice_batch', label: 'Select Batches' },
      { btn: 'btn-sector', name: 'sector', label: 'Select Sectors' }
    ];

    mappings.forEach(map => {
      const checkboxes = document.querySelectorAll(`input[name='${map.name}[]']`);
      checkboxes.forEach(cb => {
        cb.addEventListener('change', () => updateLabel(map.btn, map.name, map.label));
      });
      updateLabel(map.btn, map.name, map.label);
    });
  });
</script>
</body>
</html>

<?php
// Database connection settings
$db_host = 'localhost';
$db_name = 'dialpro2';
$db_user = 'root';
$db_pass = '';

try {
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

// Fetch data for Call Summary tab
function fetchCallSummaryData($pdo) {
    $query = "SELECT * FROM call_summary";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Fetch data for Offline CRM tab
function fetchOfflineCRMData($pdo) {
    $query = "SELECT * FROM offline_crm";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Fetch data for My Callbacks tab
function fetchCallbacksData($pdo) {
    $query = "SELECT * FROM callbacks";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Fetch data for My Call History tab
function fetchCallHistoryData($pdo) {
    $query = "SELECT * FROM call_history";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Call Center Agent CRM Dashboard</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="/styles.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
</head>
<body>
  <div style="height: 700px; overflow: scroll;">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
        <div class="line-background">
            <!-- Tabs and Follow-ups -->
            <div class="tabs">
              <button class="tab-button active" onclick="openTab(event, 'home')">Home</button>
              <button class="tab-button" onclick="openTab(event, 'callSummary')">Call Summary</button>
              <button class="tab-button" onclick="openTab(event, 'offlineCRM')">Offline CRM</button>
              <button class="tab-button" onclick="openTab(event, 'mycallBacks')">My Callbacks</button>
              <button class="tab-button" onclick="openTab(event, 'myCallHistory')">My Call History</button>

              <!-- Follow-ups -->
              <div class="follow-ups">
                <p class="followup">Follow-ups:</p>
                <p class="pending">Pending: <span id="pendingFollowUps">0</span></p>
                <p class="upcoming">Upcoming: <span id="upcomingFollowUps">0</span></p>
              </div>
            </div>
          </div>
          <!-- Main Content -->
          <!-- Home Tab Content -->
          <div id="home" class="tab-content active">
            <div class="row">
              <div class="col-md-6">
                <h3 class="section-title">Agent Call Summary</h3>
                <div class="chart-container">
                  <canvas id="callSummaryChart"></canvas>
                </div>
              </div>
              <div class="col-md-6">
                <h3 class="section-title">Agent Login Summary</h3>
                <div class="chart-container">
                  <canvas id="loginSummaryChart"></canvas>
                </div>
              </div>
            </div>
          </div>

          <!-- Call Summary Tab Content -->
          <div id="callSummary" class="tab-content">
            <div class="row">
              <div class="col-md-12">
                <h4 class="section-title">Agent Calls Summary</h4>
                <table id="callSummaryTable" class="table table-striped table-bordered">
                  <thead>
                  <tr>
                      <th>Date</th>
                      <th>Incoming Answered Calls</th>
                      <th>Incoming Abandoned Calls</th>
                      <th>Outgoing Answered Calls</th>
                      <th>Outgoing Abandoned Calls</th>
                      <th>Total Calls</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $callSummaryData = fetchCallSummaryData($pdo);
                    foreach ($callSummaryData as $row) {
                      echo "<tr>";
                      echo "<td>{$row['date']}</td>";
                      echo "<td>{$row['incoming_answered_calls']}</td>";
                      echo "<td>{$row['incoming_abandoned_calls']}</td>";
                      echo "<td>{$row['outgoing_answered_calls']}</td>";
                      echo "<td>{$row['outgoing_abandoned_calls']}</td>";
                      echo "<td>{$row['total_calls']}</td>";
                      echo "</tr>";
                    }
                    ?>
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>Total</th>
                      <th>0</th>
                      <th>0</th>
                      <th>0</th>
                      <th>0</th>
                      <th>0</th>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
          </div>

          <!-- Offline CRM Tab Content -->
          <div id="offlineCRM" class="tab-content">
            <div class="row">
              <div class="col-md-12">
                <h3 class="section-title">Offline CRM</h3>
                <table id="offlineCRMTable" class="table table-striped table-bordered">
                  <thead>
                    <!-- Table headers... -->
                  </thead>
                  <tbody>
                    <?php
                    $offlineCRMData = fetchOfflineCRMData($pdo);
                    foreach ($offlineCRMData as $row) {
                      echo "<tr>";
                      echo "<td>{$row['customer_name']}</td>";
                      echo "<td>{$row['phone_number']}</td>";
                      echo "<td>{$row['email']}</td>";
                      echo "<td>{$row['lead_source']}</td>";
                      echo "<td>{$row['status']}</td>";
                      echo "<td>{$row['comments']}</td>";
                      echo "</tr>";
                    }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

          <!-- My Callbacks Tab Content -->
          <div id="mycallBacks" class="tab-content">
            <div class="row">
              <div class="col-md-12">
                <h4 class="section-title">Pending CallBacks Summary</h4>
                <div class="callbacks-summary">
                <p><span class="summary-label">Total:</span> <span id="totalCallbacks">0</span></p>
                  <p><span class="summary-label">Pending:</span> <span id="pendingCallbacks">0</span></p>
                  <p><span class="summary-label">Upcoming:</span> <span id="upcomingCallbacks">0</span></p>
                </div>
                <table id="callbacksTable" class="table table-striped table-bordered">
                  <thead>
                    <!-- Table headers... -->
                  </thead>
                  <tbody>
                    <?php
                    $callbacksData = fetchCallbacksData($pdo);
                    foreach ($callbacksData as $row) {
                      echo "<tr>";
                      echo "<td>{$row['id']}</td>";
                      echo "<td>{$row['customer_name']}</td>";
                      echo "<td>{$row['phone_number']}</td>";
                      echo "<td>{$row['callback_time']}</td>";
                      echo "<td>{$row['callback_type']}</td>";
                      echo "<td>{$row['disposition']}</td>";
                      echo "<td>{$row['comments']}</td>";
                      echo "<td>Action Button</td>";
                      echo "</tr>";
                    }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

          <!-- My Call History Tab Content -->
          <div id="myCallHistory" class="tab-content">
            <div class="row">
              <div class="col-md-12">
                <div class="row">
                  <div class="col-md-8">
                    <h4 class="section-title">Recent Agent Calls Summary</h4>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group inline-form">
                      <!-- Form elements... -->
                    </div>
                  </div>
                </div>
                <table class="table table-bordered">
                  <thead>
                    <!-- Table headers... -->
                  </thead>
                  <tbody>
                    <?php
                    $callHistoryData = fetchCallHistoryData($pdo);
                    foreach ($callHistoryData as $row) {
                      echo "<tr>";
                      echo "<td>{$row['id']}</td>";
                      echo "<td>{$row['phone_number']}</td>";
                      echo "<td>{$row['status']}</td>";
                      echo "<td>{$row['disposition']}</td>";
                      echo "<td>{$row['customer_name']}</td>";
                      echo "<td>{$row['comments']}</td>";
                      echo "<td>{$row['call_type']}</td>";
                      echo "<td>{$row['call_time']}</td>";
                      echo "</tr>";
                    }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

          <!-- JavaScript and other libraries... -->

        </div>
      </div>
    </div>
  </div>
</body>
</html>

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
        <!-- Left Section (Main Content) -->
        <div class="col-lg-12">
        <div class="line-background">
          <!-- Tabs and Follow-ups -->
          <div class="tabs">
            <button class="tab-button active" onclick="openTab(event, 'home')">Home</button>
            <button class="tab-button" onclick="openTab(event, 'callSummary')">Call Summary</button>
            <button class="tab-button" onclick="openTab(event, 'offlineCRM')">Offline CRM</button>
            <button class="tab-button" onclick="openTab(event, 'myCallbacks')">My Callbacks</button>
            <button class="tab-button" onclick="openTab(event, 'myCallHistory')">My Call History</button>

            <!-- Follow-ups -->
            <div class="follow-ups">
              <p class="followup">Follow-ups:</p>
              <p class="pending">Pending: <span id="pendingFollowUps">0</span></p>
              <p class="upcoming">Upcoming: <span id="upcomingFollowUps">0</span></p>
            </div>
          </div>

          <!-- Main Content -->
          <div id="home" class="tab-content active">
            <!-- Home Tab Content -->
            <div class="row">
              <div class="col-md-6">
                <h3>Agent Call Summary</h3>
                <div class="chart-container">
                  <canvas id="callSummaryChart"></canvas>
                </div>
              </div>
              <div class="col-md-6">
                <h3>Agent Login Summary</h3>
                <div class="chart-container">
                  <canvas id="loginSummaryChart"></canvas>
                </div>
              </div>
            </div>
          </div>

          <!-- Call Summary Tab Content -->
          <div id="callsummary" class="tab-content active">
            <div class="row">
              <div class="col-md-12">
                <h3>Agent Call Summary</h3>
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
                    <!-- Data will be populated dynamically -->
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>Total</th>
                      <th></th>
                      <th></th>
                      <th></th>
                      <th></th>
                      <th></th>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
          </div>
        </div>
        </div>
      </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="/script.js"></script>
  <script>
    $(document).ready(function() {
      $('#callSummaryTable').DataTable();
    });
  </script>
</body>

</html>
<!DOCTYPE html>
<html>
<head>
  <title>Call Center Agent CRM Dashboard</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="/style2.css">
  
</head>

<body>
  <div id="app">
    <div class="container mt-4">
      <div class="tabs mb-3">
        <button class="tab-button active" onclick="openTab(event, 'home')">CRM</button>
        <button class="tab-button" onclick="openTab(event, 'callSummary')">Call Summary</button>
        <button class="tab-button" onclick="openTab(event, 'offlineCRM')">Comments</button>
      </div>
      
      <div id="home" class="tab-content active">
        <div class="row">
          <div class="col-md-6">
            <div class="content-block mb-4">
              <h2 class="mb-3">General Information</h2>
              <div class="form-group">
                <label for="primaryNumber">Primary Number:</label>
                <input type="text" id="primaryNumber" class="form-control">
              </div>
              <div class="form-group">
                <label for="customerName">Customer Name:</label>
                <input type="text" id="customerName" class="form-control">
              </div>
              <div class="form-group">
                <label for="email">Email ID:</label>
                <input type="email" id="email" class="form-control">
              </div>
              <div class="form-group">
                <label for="comment">Comment:</label>
                <input type="text" id="comment" class="form-control">
              </div>
            </div>
            
            <div class="content-block mb-4">
              <h2 class="mb-3">CRM Fields</h2>
              <div class="form-group">
                <label for="address">Address:</label>
                <input type="text" id="address" class="form-control">
              </div>
              <!-- Add more CRM fields here -->
            </div>
          </div>
          
          <div class="col-md-6">
            <div class="content-block mb-4">
              <h2 class="mb-3">Dispositions</h2>
              <div class="form-group">
                <label for="dispositionDropdown">Dispositions:</label>
                <select id="dispositionDropdown" class="form-control">
                  <!-- Populate dispositions here using Vue.js or AJAX -->
                </select>
              </div>
              <div class="form-group">
                <label for="subDispositionDropdown">Sub-Dispositions:</label>
                <select id="subDispositionDropdown" class="form-control">
                  <!-- Populate sub-dispositions here using Vue.js or AJAX -->
                </select>
              </div>
              <div class="form-group">
                <label for="subSubDispositionDropdown">Sub-Sub-Dispositions:</label>
                <select id="subSubDispositionDropdown" class="form-control">
                  <!-- Populate sub-sub-dispositions here using Vue.js or AJAX -->
                </select>
              </div>
              <div class="form-group">
                <label for="followupDropdown">Set Follow Up:</label>
                <div class="followup-row">
                  <select id="followupDropdown" class="form-control">
                    <!-- Populate followup options here using Vue.js or AJAX -->
                  </select>
                  <input type="date" id="followDate" class="form-control">
                  <input type="time" id="followTime" class="form-control">
                </div>
              </div>
            
            <div class="content-block">
              <div class="form-group">
                <label for="breaksDropdown">Breaks:</label>
                <select id="breaksDropdown" class="form-control">
                  <!-- Populate breaks options here using Vue.js or AJAX -->
                </select>
              </div>
              <div class="form-group">
                <label for="transferDropdown">Transfer:</label>
                <select id="transferDropdown" class="form-control">
                  <!-- Populate transfer options here using Vue.js or AJAX -->
                </select>
              </div>
              
            </div>
            
          </div>
          <div class="button-row text-center mt-4">
  <button class="btn btn-primary" onclick="endCall()">End Call</button>
  <button class="btn btn-success">Hot Transfer</button>
</div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.min.js"></script>
  <script src="/script2.js"></script>
</body>
</html>

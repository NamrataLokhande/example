// Simulate updating follow-ups data with Ajax
setInterval(updateFollowUps, 5000); // Update data every 5 seconds

function updateFollowUps() {
  // Simulate getting follow-ups data from the server
  const pendingFollowUps = Math.floor(Math.random() * 10);
  const upcomingFollowUps = Math.floor(Math.random() * 10);

  // Update the follow-ups counts in the HTML
  document.getElementById("pendingFollowUps").textContent = pendingFollowUps;
  document.getElementById("upcomingFollowUps").textContent = upcomingFollowUps;
}

// Call the function on page load to populate initial follow-ups data
updateFollowUps();

  // Function to update agent call summary and login summary charts using Ajax
  function updateAgentSummaryCharts() {
    // Simulate getting agent call summary and login summary data from the server
    const agentCallSummaryData = {
      total: 200,
      answered: 150,
      notAnswered: 50,
      missedCalls: 20, // Add new data field for missed calls
    };

    const agentLoginSummaryData = {
      idleTime: 30,
      talkTime: 100,
      holdTime: 20,
      wrapupTime: 15,
      ringingTime: 10,
      dialingTime: 25,
      breakTime: 60,
    };

    // Update agent call summary chart
    updateCallSummaryChart(agentCallSummaryData);

    // Update agent login summary chart
    updateLoginSummaryChart(agentLoginSummaryData);
  }

  // Function to update agent call summary chart
  function updateCallSummaryChart(data) {
    const callSummaryChart = new Chart(document.getElementById("callSummaryChart"), {
      type: "pie", // Change to pie chart
      data: {
        labels: ["Answered", "Not Answered", "Missed Calls", "Total"],
        datasets: [
          {
            data: [data.answered, data.notAnswered, data.missedCalls, data.total], // Add "missedCalls" value to the data array
            backgroundColor: ["#36a2eb", "#ff6384", "#87CEEB", "#4169E1"],
          },
        ],
      },
      options: {
        title: {
          display: true,
          text: `Agent Call Summary (${data.total} Calls)`,
          fontSize: 16,
          fontColor: "#1c5f83",
        },
        legend: {
          labels: {
            fontColor: "#00008B", // Set labels color to black
          },
        },
        // Set labels color to black
        plugins: {
          datalabels: {
            color: "#00008B",
          },
        },
      },
    });
  }

  // Function to update agent login summary chart
  function updateLoginSummaryChart(data) {
    const loginSummaryChart = new Chart(document.getElementById("loginSummaryChart"), {
      type: "bar", // Change to bar chart
      data: {
        labels: ["Idle Time", "Talk Time", "Hold Time", "Wrapup Time", "Ringing Time", "Dialing Time", "Break Time"],
        datasets: [
          {
            label: "Duration (in minutes)",
            data: [data.idleTime, data.talkTime, data.holdTime, data.wrapupTime, data.ringingTime, data.dialingTime, data.breakTime],
            backgroundColor: [
              "#4bc0c0",
              "#36a2eb",
              "#ffce56",
              "#ff6384",
              "#9966ff",
              "#ff9f40",
              "#ff00bf",
            ],
          },
        ],
      },
      options: {
        legend: {
          display: false,
        },
        scales: {
          yAxes: [
            {
              ticks: {
                beginAtZero: true,
              },
            },
          ],
          xAxes: [
            {
              ticks: {
                fontColor: "#00008B", // Set labels color to black
              },
            },
          ],
        },
        title: {
          display: true,
          text: "Agent Login Summary (Duration in Minutes)",
          fontSize: 16,
          fontColor: "#1c5f83",
        },
        // Set labels color to black
        plugins: {
          datalabels: {
            color: "#00008B",
          },
        },
      },
    });
  }

// Call the function on page load to populate initial agent summary data
updateAgentSummaryCharts();

// Simulate updating agent summary data with Ajax every 5 seconds
setInterval(updateAgentSummaryCharts, 5000);

// Function to open tabs
function openTab(event, tabName) {
  var i, tabContent, tabButtons;
  tabContent = document.getElementsByClassName("tab-content");
  for (i = 0; i < tabContent.length; i++) {
    tabContent[i].style.display = "none";
  }
  tabButtons = document.getElementsByClassName("tab-button");
  for (i = 0; i < tabButtons.length; i++) {
    tabButtons[i].classList.remove("active");
  }
  document.getElementById(tabName).style.display = "block";
  event.currentTarget.classList.add("active");
}

// Call the function on page load to open the "home" tab by default
document.addEventListener("DOMContentLoaded", function () {
  openTab(event, "home");
});


// Function to get today's date and day of the week
function updateTodayDate() {
  const daysOfWeek = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
  const today = new Date();
  const dayOfWeek = daysOfWeek[today.getDay()];
  const dateString = `${today.toDateString()}`;
  return dateString;
}

// Update the Date column with today's date and day of the week in the first row
document.addEventListener("DOMContentLoaded", function () {
  const dateCell = document.querySelector("#todayDate");
  dateCell.textContent = updateTodayDate();
});

// Initialize DataTables
$(document).ready(function () {
  $('#callSummaryTable').DataTable();
  $('#callbacksTable').DataTable();
});

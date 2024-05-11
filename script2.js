const tabs = ['CRM', 'Call Summary', 'Comments'];
let activeTab = 'CRM';

function openTab(event, tabName) {
  const tabContents = document.getElementsByClassName('tab-content');
  for (let i = 0; i < tabContents.length; i++) {
    tabContents[i].style.display = 'none';
  }

  document.getElementById(tabName).style.display = 'block';
  activeTab = tabName;
}

function endCall() {
  // Navigate to the homepage of agentdashboard.php in the leftFrame
  window.parent.frames['leftFrame'].location.href = 'agentdashboard.php';
}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agent Dashboard</title>
    <link rel="stylesheet" href="/style1.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
<script src="/script1.js"></script>
    <style>
body {
    font-family: Arial, sans-serif;
    background-image: url("/background.jpeg");
    margin: 0;
    padding: 0;
}
        .power-button {
            text-align: center;
        }
     
        .overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 999; /* Increase the z-index to ensure it's above other content */
    }

        .keypad-container {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .keypad {
            background-color: #f9f9f9;
    border-radius: 10px;
    box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.2);
    width: 50px;
    padding: 15px;
        }

        /* Keypad icon styles */
        .keypad img {
            cursor: pointer;
            width: 40px;
            height: 40px;
        }
        .dialpad {
    display: none;
    position: fixed;
    bottom: 20px;
    right: 40px; /* Adjusted the right position */
    width: 150px;
    background-color: white;
    border: 1px solid #ccc;
    padding: 8px;
    border-radius: 8px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    font-family: Arial, sans-serif;
    font-size: 12px;
    z-index: 1000;
}


.compact-keypad {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 2px;
    margin-top: 10px;
}

.dialpad input {
    width: 100%;
    height: 40px;
    font-size: 18px;
    text-align: center;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    padding: 5px;
}

.dialpad button {
    width: 30px;
    height: 30px;
    font-size: 14px;
    border: 1px solid #ccc;
    border-radius: 50%; /* Changed to a more rounded shape */
    background-color: #f5f5f5;
    cursor: pointer;
    transition: background-color 0.2s;
}

.dialpad button.call{
    width: 30px;
    height: 30px;
    font-size: 12px; /* Adjusted font size for consistency */
    cursor: pointer;
    transition: background-color 0.2s, transform 0.2s;
}

.dialpad button.call {
    background-color: green;
    color: white;
}

.dialpad button.call:hover {
    background-color: green;
    transform: scale(1.05);
}

.dialpad button.redial {
    background-color: blue;
        color: white;
        font-size: 14px;
        border: none; /* Remove the border */
        border-radius: 50%; /* Keep the rounded shape */
        width: 40px; /* Adjust width for a slightly larger button */
        height: 40px; /* Adjust height for a slightly larger button */
        margin: 5px; /* Add margin for spacing between buttons */
        cursor: pointer;
        transition: background-color 0.2s, transform 0.2s;
}

.dialpad button.redial:hover {
    background-color: #0056b3;
    transform: scale(1.05);
}

.dialpad button.hangup {
    background-color: #dc3545;
        color: white;
        font-size: 14px;
        border: none; /* Remove the border */
        border-radius: 50%; /* Keep the rounded shape */
        width: 40px; /* Adjust width for a slightly larger button */
        height: 40px; /* Adjust height for a slightly larger button */
        margin: 5px; /* Add margin for spacing between buttons */
        cursor: pointer;
        transition: background-color 0.2s, transform 0.2s;
}

.dialpad button.hangup:hover {
    background-color: #a71c30;
    transform: scale(1.05);
}

.dialpad button.clear {
    background-color: red;
    color: white;
    width: 100%;
    font-size: 16px;
    padding: 8px;
    margin-top: 10px;
    border-radius: 4px;
  }

.dialpad button:hover {
    background-color: red;
    transform: scale(1.05);
  }

  /* Status box styles */
  .status-box {
        border-radius: 4px;
        padding: 4px 8px;
        display: inline-block;
        transition: background-color 0.3s;
    }
    
    .idle {
        background-color: #f0ad4e; /* Idle status color */
        color: #fff;
    }
    
    .calling {
        background-color: #5bc0de; /* Calling status color */
        color: #fff;
    }
    
    .active {
        background-color: #5cb85c; /* Active status color */
        color: #fff;
    }
    
    /* Call timing styles */
    #callTiming {
        margin-top: 5px;
        color: #888;
    }
    
        @media (max-width: 768px) {
            .container {
                max-width: 100%;
            }
        }
    </style>
</head>
<body>
<div id="app" class="container">
        <div class="power-button text-center my-2">
            <button class="btn btn-light btn-sm" @click="togglePower">
                <img :src="isPowerOn ? '/poweron.png' : '/poweroff.png'" alt="Power Button" class="power-icon" style="width: 20px; height: 20px;">
                <span class="power-status">{{ isPowerOn ? 'ON' : 'OFF' }}</span>
            </button>
        </div>

        <div class="header py-2">
            <div class="d-flex align-items-center justify-content-between agent-logo-info">
                <img src="/52930.jpg" alt="Agent Info" class="rounded-circle agent-logo" style="width: 40px; height: 40px;">
                <div class="agent-info ml-2 text-center">
                    <p class="mb-0 agent-name" style="font-size: 14px;">Agent</p>
                    <p class="mb-0 agent-id" style="font-size: 12px;">1234</p>
                </div>
            </div>
        </div>

        <div class="main-section text-center">
            <div class="timestamp mb-1">
                <p class="mb-0" style="font-size: 12px;">{{ currentDate }}</p>
                <p class="mb-0" style="font-size: 12px;">{{ currentTime }}</p>
            </div>
        </div>

        <div class="options-section text-center">
            <div class="dropdown mb-1">
                <button class="btn btn-light btn-sm dropdown-toggle" @click="toggleProcessOptions" style="font-size: 12px;">
                    {{ selectedProcess }} Process
                </button>
                <ul class="dropdown-menu" v-show="showProcessOptions" @click="toggleProcessOptions">
                    <li><a class="dropdown-item" href="#">Process 1</a></li>
                    <li><a class="dropdown-item" href="#">Process 2</a></li>
                    <li><a class="dropdown-item" href="#">Process 3</a></li>
                </ul>
            </div>

            <div class="idle-status mb-1">
            <div :class="['status-box', { 'idle': callStatus === 'IDLE', 'calling': callStatus === 'CALLING', 'active': callStatus === 'ACTIVE' }]" style="font-size: 12px; padding: 4px 8px;">{{ callStatus }}</div>
            <p id="callTiming" class="mb-0" style="font-size: 10px;">{{ callTiming }}</p>
        </div>


            <div class="overlay" id="overlay" @click="closeDialpad"></div>
        <div class="dialpad" id="dialpad">
            <input type="text" id="number" readonly autofocus>
            <div class="compact-keypad">
            <button onclick="addNumber(1)">1</button>
            <button onclick="addNumber(2)">2</button>
            <button onclick="addNumber(3)">3</button>
            <button onclick="addNumber(4)">4</button>
            <button onclick="addNumber(5)">5</button>
            <button onclick="addNumber(6)">6</button>
            <button onclick="addNumber(7)">7</button>
            <button onclick="addNumber(8)">8</button>
            <button onclick="addNumber(9)">9</button>
            <button onclick="addNumber('*')">*</button>
            <button onclick="addNumber(0)">0</button>
            <button onclick="addNumber('#')">#</button>
            <button class="call" onclick="makeCall()">📞</button>
            <button style="background-color: #0056b3;" onclick="redial()">🔄</button>
            <button style="background-color: #a71c30;" onclick="hangup()">🔴</button>
        </div>
        <div class="controls">
            
        <button class="clear" onclick="clearNumber()">Clear</button>
        </div>
    </div>
    <img class="keypad img" src="dialpad1.png" id="toggle" onclick="toggleDialpad()">


            <div class="dropdown mb-1">
                <button class="btn btn-light btn-sm dropdown-toggle" @click="toggleBreakOptions" style="font-size: 12px;">
                    {{ selectedBreak }} Break
                </button>
                <ul class="dropdown-menu" v-show="showBreakOptions" @click="toggleBreakOptions">
                    <li><a class="dropdown-item" href="#">Break 1</a></li>
                    <li><a class="dropdown-item" href="#">Break 2</a></li>
                    <li><a class="dropdown-item" href="#">Break 3</a></li>
                </ul>
            </div>
        </div>

        <div class="queues-zero-container mb-2">
    <div class="queues-column">
        <div class="table-responsive">
            <table class="table table-bordered compact-table">
                <thead class="thead-light">
                    <tr>
                        <th>Queues</th>
                        <th><span class="dropdown-arrow">&#9660;</span></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Sales Q</td>
                        <td>0</td>
                    </tr>
                    <tr>
                        <td>Support Q</td>
                        <td>0</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
<script>
    function toggleDialpad() {
    var dialpad = document.getElementById("dialpad");
    if (dialpad.style.display == "none") {
      dialpad.style.display = "block";
    } else {
      dialpad.style.display = "none";
    }
  }
  
  function addNumber(num) {
    var number = document.getElementById("number");
    number.value += num;
  }
  
  function clearNumber() {
        var number = document.getElementById("number");
        number.value = number.value.slice(0, -1); // Remove the last character
        var dialpad = document.getElementById("dialpad"); // Get the dialpad element
        dialpad.style.display = "none"; // Hide the dialpad
    }

  
    function makeCall() {
        var number = document.getElementById("number");
        alert("Calling " + number.value);
        
        // Calculate and update call timing
        var startTime = new Date();
        this.callTiming = "Calling since " + startTime.toLocaleTimeString();
    
        var leftFrame = window.parent.frames['leftFrame'];
        leftFrame.location.href = 'agentcutcrm.php';
        this.callStatus = 'CALLING';
    }
    
  // Add functions for redial and hangup
function redial() {
    var number = document.getElementById("number");
    var lastDialedNumber = number.value;
    if (lastDialedNumber) {
        alert("Redialing " + lastDialedNumber);
    } else {
        alert("No number to redial.");
    }
    this.callStatus = 'CALLING'; // Update the call status
}

function hangup() {
        var number = document.getElementById("number");
        if (number.value) {
            alert("Call ended for number " + number.value);
            number.value = "";
        } else {
            alert("No active call.");
        }
    
        // Reset call timing and status
        this.callTiming = "";
        this.callStatus = 'IDLE';
    }

  // Added code to handle keyboard input
  document.addEventListener("keydown", function(event) {
    var key = event.key; // Get the pressed key
    var number = document.getElementById("number");
    
    // Check if the key is a valid digit or symbol
    if (key >= '0' && key <= '9' || key == '*' || key == '#') {
      addNumber(key); // Add the key to the input
    } else if (key == 'Backspace') { // Check if the key is backspace
      clearNumber(); // Clear the input
    } else if (key == 'Enter') { // Check if the key is enter
      makeCall(); // Make the call
    }
  });
</script>
</body>
</html>

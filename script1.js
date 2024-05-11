

document.addEventListener('DOMContentLoaded', () => {
    new Vue({
        el: '#app',
        data: {
            callStatus: 'IDLE', 
            isPowerOn: false,
            showProcessOptions: false,
            showBreakOptions: false,
            isIdle: true,
            currentDate: '',
            currentTime: '',
            idleTime: '00:00:00',
        },
        methods: {
            toggleKeypad() {
                this.isKeypadOpen = !this.isKeypadOpen;
            },
            appendToKeypad(number) {
                const keypadInput = document.getElementById("keypad");
                keypadInput.value += number;
            },
            togglePower() {
                this.isPowerOn = !this.isPowerOn;
            },
            toggleProcessOptions() {
                this.showProcessOptions = !this.showProcessOptions;
            },
            toggleBreakOptions() {
                this.showBreakOptions = !this.showBreakOptions;
            },
            updateTimeAndDate() {
                console.log("Updating time and date...");
                const currentDate = new Date();
                this.currentDate = currentDate.toDateString();
                this.currentTime = currentDate.toLocaleTimeString();
            }
            ,
        },
        computed: {
            idleTime() {
                // Replace this with the actual idle time calculation
                return '00:00:00';
            },
        },
        created() {
            this.updateTimeAndDate();
            setInterval(() => {
                this.updateTimeAndDate();
            }, 1000);
        },

    });
});
new Vue({
    el: '#app',
    data: {
        isKeypadOpen: false,
    },
    methods: {
        toggleKeypad() {
            this.isKeypadOpen = !this.isKeypadOpen;
        },
        appendToKeypad(number) {
            const keypadInput = document.getElementById("keypad");
            keypadInput.value += number;
        },

        clearKeypad() {
            const keypadInput = document.getElementById("keypad");
            keypadInput.value = '';
        },

        makeCall() {
            const keypadInput = document.getElementById("keypad");
            const phoneNumber = keypadInput.value;
            console.log(`Calling ${phoneNumber}`);
            // You can implement actual call functionality here
        }
    },
    
});


    

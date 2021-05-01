let today = new Date();
let currentMonth = today.getMonth();
let currentYear = today.getFullYear();
let selectYear = document.getElementById("year");
let selectMonth = document.getElementById("month");

let months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
let day = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
let fullmonths = ["January", "February", "March", "April", "June", "July", "August", "September", "October", "November", "December"];
let monthAndYear = document.getElementById("monthAndYear");
showCalendar(currentMonth, currentYear);


function next() {
    currentYear = (currentMonth === 11) ? currentYear + 1 : currentYear;
    currentMonth = (currentMonth + 1) % 12;
    showCalendar(currentMonth, currentYear);
}

function previous() {
    currentYear = (currentMonth === 0) ? currentYear - 1 : currentYear;
    currentMonth = (currentMonth === 0) ? 11 : currentMonth - 1;
    showCalendar(currentMonth, currentYear);
}

function jump() {
    currentYear = parseInt(selectYear.value);
    currentMonth = parseInt(selectMonth.value);
    showCalendar(currentMonth, currentYear);
}

function showCalendar(month, year) {

    let firstDay = (new Date(year, month)).getDay();
    let daysInMonth = 32 - new Date(year, month, 32).getDate();

    let tbl = document.getElementById("calendar-body"); // body of the calendar

    // clearing all previous cells
    tbl.innerHTML = "";
    let monthanddateinfo = document.createElement("h2");
    monthanddateinfo.id = "monthAndYear";
    let txt = document.createTextNode(months[month] + " " + year);
    monthanddateinfo.appendChild(txt);
    tbl.appendChild(monthanddateinfo);
    // filing data about month and in the page via DOM.
    monthAndYear.innerHTML = months[month] + " " + year;
    document.getElementById("evedate").innerHTML = day[today.getDay()] + ", " + today.getDate() + " " + fullmonths[today.getMonth()];
    selectYear.value = year;
    selectMonth.value = month;

    // creating all cells
    let date = 1;
    for (let i = 0; i < 6; i++) {
        // creates a table row


        //creating individual cells, filing them up with data.
        for (let j = 0; j < 7; j++) {
            if (i === 0 && j < firstDay) {
                let cell = document.createElement("button");

                cell.className = "null";
                let cellText = document.createTextNode("");
                cell.appendChild(cellText);
                tbl.appendChild(cell);
            } else if (date > daysInMonth) {
                break;
            } else {
                let cell = document.createElement("button");
                cell.addEventListener("click", dateclicked)
                let cellText = document.createTextNode(date);
                if (date === today.getDate() && year === today.getFullYear() && month === today.getMonth()) {
                    cell.classList.add("today");
                } // color today's date
                cell.appendChild(cellText);
                tbl.appendChild(cell);
                date++;
            }


        }
    }

}
let current = today;
showCurrentRequests();
showAcceptedRequests()

function dateclicked(clicked) {

    current = new Date(selectYear.value, selectMonth.value, this.innerHTML);
    document.getElementById("evedate").innerHTML = day[current.getDay()] + ", " + current.getDate() + " " + fullmonths[current.getMonth()];
    showCurrentRequests();
    showAcceptedRequests();
}
showAcceptedRequests();

function showCurrentRequests() {
    $.ajax({
        type: "POST",
        url: "http://localhost/techeden/php/showCurrentRequests.php",
        data: {
            date: current.getDate(),
            month: current.getMonth() + 1,
            year: current.getFullYear()
        },
        success: function(data) {

            $("#currentRequestList").html(data).show();

        }
    });
}

function acceptRequest(sl) {
    $.ajax({
        type: "POST",
        url: "http://localhost/techeden/php/acceptRequest.php",
        data: {
            sl: sl
        },
        success: function(html) {
            showCurrentRequests();
            $("#acceptRequestStatus").html(html).show();
        }
    });
}

function showAcceptedRequests() {
    $.ajax({
        type: "POST",
        url: "http://localhost/techeden/php/showSupplyAcceptedRequests.php",

        success: function(html) {
            $("#acceptedRequestList").html(html).show();
        }
    });
}
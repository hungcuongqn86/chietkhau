function displayTime() {
    var d = new Date();
    console.log(d.getTime());
	location.reload();
}

console.log(1111);
const createClock = setInterval(displayTime, 100000);

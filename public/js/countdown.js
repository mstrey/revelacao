const elDays = document.getElementById("d");
const elHours = document.getElementById("h");
const elMinutes = document.getElementById("m");
const elSeconds = document.getElementById("s");

setInterval(function() {
    const now = new Date().getTime();
    const dist = target - now;
    
    if (dist < 0) {
        window.location.reload();
    } else {
        const d = Math.floor(dist / (1000 * 60 * 60 * 24));
        const h = Math.floor((dist % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const m = Math.floor((dist % (1000 * 60 * 60)) / (1000 * 60));
        const s = Math.floor((dist % (1000 * 60)) / 1000);
        
        elDays.innerText = String(d).padStart(2, '0');
        elHours.innerText = String(h).padStart(2, '0');
        elMinutes.innerText = String(m).padStart(2, '0');
        elSeconds.innerText = String(s).padStart(2, '0');
    }
}, 1000);

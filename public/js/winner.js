const duration = 15 * 1000;
const animationEnd = Date.now() + duration;

(function frame() {
    confetti({
        particleCount: 5,
        angle: 60,
        spread: 55,
        origin: { x: 0 },
        colors: [color, '#ffffff'],
        zIndex: 1
    });
    confetti({
        particleCount: 5,
        angle: 120,
        spread: 55,
        origin: { x: 1 },
        colors: [color, '#ffffff'],
        zIndex: 1
    });

    if (Date.now() < animationEnd) {
        requestAnimationFrame(frame);
    }
}());
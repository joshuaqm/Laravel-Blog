// Desactivar clic derecho
document.addEventListener('contextmenu', function(e) {
    e.preventDefault();
});

// Desactivar teclas comunes de inspección
document.addEventListener('keydown', function(e) {
    if (
        e.key === 'F12' ||
        (e.ctrlKey && e.shiftKey && ['I', 'J', 'C'].includes(e.key)) ||
        (e.ctrlKey && e.key === 'U')
    ) {
        e.preventDefault();
    }
});

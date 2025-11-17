document.addEventListener('DOMContentLoaded', function() {
    const particlesContainer = document.getElementById('particles');
    
    // Buat partikel latar belakang
    createParticles();
    
    // Periksa status koneksi ESP32
    checkESP32Status();
    
    function createParticles() {
        // Buat partikel untuk latar belakang
        for (let i = 0; i < 50; i++) {
            createParticle();
        }
    }
    
    function createParticle() {
        const particle = document.createElement('div');
        particle.classList.add('particle');
        
        const size = Math.random() * 5 + 2;
        const x = Math.random() * window.innerWidth;
        const y = Math.random() * window.innerHeight;
        
        particle.style.width = `${size}px`;
        particle.style.height = `${size}px`;
        particle.style.left = `${x}px`;
        particle.style.top = `${y}px`;
        
        // Warna acak antara merah dan hitam
        const colorValue = Math.random() > 0.5 ? Math.floor(Math.random() * 128) : Math.floor(Math.random() * 128) + 128;
        particle.style.backgroundColor = `rgb(${colorValue}, 0, 0)`;
        
        particlesContainer.appendChild(particle);
        
        // Animasi partikel
        animateParticle(particle);
    }
    
    function animateParticle(particle) {
        const animationDuration = Math.random() * 10 + 5;
        const xMove = (Math.random() - 0.5) * 100;
        const yMove = (Math.random() - 0.5) * 100;
        
        particle.style.transition = `all ${animationDuration}s linear`;
        particle.style.transform = `translate(${xMove}px, ${yMove}px)`;
        
        setTimeout(() => {
            particle.remove();
            createParticle();
        }, animationDuration * 1000);
    }
    
    function checkESP32Status() {
        // Cek status koneksi ke ESP32
        fetch('api.php?action=status')
            .then(response => response.json())
            .then(data => {
                if (data.status === 'active') {
                    console.log('ESP32 terhubung dengan baik');
                }
            })
            .catch(error => {
                console.error('Gagal terhubung ke ESP32:', error);
                const statusIndicator = document.querySelector('.status-indicator');
                if (statusIndicator) {
                    statusIndicator.style.background = '#ff0000';
                }
            });
    }
    
    // Jika ada countdown, atur efek visual
    const countdownElement = document.querySelector('.countdown');
    if (countdownElement) {
        const countdownValue = parseInt(countdownElement.textContent);
        if (!isNaN(countdownValue)) {
            startVisualCountdown(countdownValue);
        }
    }
    
    function startVisualCountdown(seconds) {
        const interval = setInterval(() => {
            seconds--;
            if (seconds <= 0) {
                clearInterval(interval);
                simulateExplosion();
            }
        }, 1000);
    }
    
    function simulateExplosion() {
        // Efek visual ledakan
        document.body.style.background = "#ff0000";
        setTimeout(() => {
            document.body.style.background = "linear-gradient(135deg, #000000, #1a0000)";
        }, 500);
    }
});
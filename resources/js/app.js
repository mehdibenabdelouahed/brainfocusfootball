import "./bootstrap";

// === Animations avancées BFF ===
console.log("BFF app.js loaded");

document.addEventListener("DOMContentLoaded", () => {
    // 1) Révélation au scroll
    const revealElements = document.querySelectorAll(
        ".bff-reveal, .bff-reveal-stagger"
    );

    if ("IntersectionObserver" in window && revealElements.length) {
        const observer = new IntersectionObserver(
            (entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add("bff-reveal-visible");
                        observer.unobserve(entry.target);
                    }
                });
            },
            {
                threshold: 0.2,
            }
        );

        revealElements.forEach((el) => observer.observe(el));
    } else {
        // fallback
        revealElements.forEach((el) => el.classList.add("bff-reveal-visible"));
    }

    // 2) Tilt 3D sur la carte joueur
    const tiltCard = document.querySelector(".bff-card-tilt");
    if (tiltCard) {
        const maxTilt = 10; // degrés

        tiltCard.addEventListener("mousemove", (e) => {
            const rect = tiltCard.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            const percentX = x / rect.width - 0.5;
            const percentY = y / rect.height - 0.5;

            const rotateX = (-percentY * maxTilt).toFixed(2);
            const rotateY = (percentX * maxTilt).toFixed(2);

            tiltCard.style.transform = `perspective(900px) rotateX(${rotateX}deg) rotateY(${rotateY}deg)`;
            tiltCard.style.boxShadow = `0 20px 50px rgba(15, 23, 42, 0.9)`;
        });

        tiltCard.addEventListener("mouseleave", () => {
            tiltCard.style.transform =
                "perspective(900px) rotateX(0deg) rotateY(0deg)";
            tiltCard.style.boxShadow = "";
        });
    }

    // 3) Parallax du fond hero
    const parallaxLayer = document.querySelector(".bff-parallax-layer");
    if (parallaxLayer) {
        window.addEventListener("scroll", () => {
            const scrollY = window.scrollY || window.pageYOffset;
            const translateY = scrollY * 0.08; // ajustable
            parallaxLayer.style.transform = `translate3d(0, ${translateY}px, 0)`;
        });
    }
});

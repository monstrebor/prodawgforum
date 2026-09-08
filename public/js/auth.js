  document.addEventListener('DOMContentLoaded', () => {

    const container = document.getElementById('parallax-container');
    const particlesContainer = document.getElementById('particles');

    const reduceMotion = window.matchMedia(
        '(prefers-reduced-motion: reduce)'
    ).matches;


    /* =========================================
       1. CREATE FLOATING PARTICLES
    ========================================= */

    if (!reduceMotion && particlesContainer) {

        const particleCount =
            window.innerWidth < 768 ? 20 : 50;


        for (let i = 0; i < particleCount; i++) {

            const particle =
                document.createElement('span');

            particle.classList.add('particle');


            const size =
                Math.random() * 4 + 2;


            particle.style.width =
                `${size}px`;

            particle.style.height =
                `${size}px`;


            particle.style.left =
                `${Math.random() * 100}%`;


            particle.style.animationDuration =
                `${Math.random() * 15 + 10}s`;


            particle.style.animationDelay =
                `${Math.random() * -20}s`;


            particle.style.opacity =
                Math.random() * 0.6 + 0.2;


            particlesContainer.appendChild(particle);

        }

    }



    /* =========================================
       2. SMOOTH 3D MOUSE PARALLAX
    ========================================= */

    if (!reduceMotion && window.innerWidth > 768) {

        let targetRotateX = 0;
        let targetRotateY = 0;

        let currentRotateX = 0;
        let currentRotateY = 0;


        window.addEventListener('mousemove', (event) => {

            const centerX =
                window.innerWidth / 2;

            const centerY =
                window.innerHeight / 2;


            const percentageX =
                (event.clientX - centerX) / centerX;

            const percentageY =
                (event.clientY - centerY) / centerY;


            targetRotateY =
                percentageX * 5;

            targetRotateX =
                percentageY * -5;

        });


        function animateParallax() {

            currentRotateX +=
                (targetRotateX - currentRotateX) * 0.08;

            currentRotateY +=
                (targetRotateY - currentRotateY) * 0.08;


            container.style.transform = `
                rotateX(${currentRotateX}deg)
                rotateY(${currentRotateY}deg)
            `;


            requestAnimationFrame(animateParallax);

        }


        animateParallax();

    }



    /* =========================================
       3. RESET PARALLAX
    ========================================= */

    document.addEventListener('mouseleave', () => {

        anime({
            targets: container,

            rotateX: 0,
            rotateY: 0,

            duration: 1000,

            easing: 'easeOutElastic(1, .5)'
        });

    });



    /* =========================================
       4. FORM TOGGLE ANIMATION
    ========================================= */

    window.toggleForms = function () {

        const loginForm =
            document.getElementById('login-form');

        const registerForm =
            document.getElementById('register-form');


        /* LOGIN */

        if (loginForm.classList.contains('hidden')) {

            anime({
                targets: registerForm,

                opacity: [1, 0],

                translateX: [0, 30],

                duration: 250,

                easing: 'easeInQuad',

                complete: function () {

                    registerForm.classList.add('hidden');

                    loginForm.classList.remove('hidden');


                    anime({
                        targets: loginForm,

                        opacity: [0, 1],

                        translateX: [-30, 0],

                        scale: [0.96, 1],

                        duration: 600,

                        easing: 'easeOutExpo'
                    });

                }

            });

        }


        /* REGISTER */

        else {

            anime({
                targets: loginForm,

                opacity: [1, 0],

                translateX: [0, -30],

                duration: 250,

                easing: 'easeInQuad',

                complete: function () {

                    loginForm.classList.add('hidden');

                    registerForm.classList.remove('hidden');


                    anime({
                        targets: registerForm,

                        opacity: [0, 1],

                        translateX: [30, 0],

                        scale: [0.96, 1],

                        duration: 600,

                        easing: 'easeOutExpo'
                    });

                }

            });

        }

    };


    /* =========================================
       5. AUTH CARD ENTRANCE
    ========================================= */

    if (!reduceMotion) {

        anime({
            targets: '#auth-card',

            opacity: [0, 1],

            translateY: [40, 0],

            scale: [0.95, 1],

            duration: 1000,

            easing: 'easeOutExpo',

            delay: 300
        });


        anime({
            targets: '.hero-content',

            opacity: [0, 1],

            translateX: [-50, 0],

            duration: 1000,

            easing: 'easeOutExpo',

            delay: 200
        });

    }

});

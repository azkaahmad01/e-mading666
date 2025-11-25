<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'E-Mading Digital') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <style>
        :root {
            --primary-blue: #3B82F6;
            --secondary-blue: #1E40AF;
            --accent-blue: #60A5FA;
        }
    </style>
</head>
<body class="antialiased bg-gradient-to-br from-gray-50 via-slate-100 to-gray-200" style="font-family: 'Inter', sans-serif;">
    <div class="min-h-screen">
        @include('partials.navbar')

        <!-- Page Content -->
        <main class="pt-16">
            @yield('content')
        </main>
        
        @include('partials.footer')
    </div>

    <script>
        // Smooth scroll untuk semua link internal
        document.querySelectorAll('a[href*="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                const href = this.getAttribute('href');
                const hashIndex = href.indexOf('#');
                if (hashIndex !== -1) {
                    const hash = href.substring(hashIndex);
                    const target = document.querySelector(hash);
                    if (target) {
                        e.preventDefault();
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                }
            });
        });

        // Fade in animation untuk elemen saat scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        // Observe semua card dan section
        document.addEventListener('DOMContentLoaded', function() {
            const elements = document.querySelectorAll('.bg-white, .grid > div, .shadow-md');
            elements.forEach((el, index) => {
                el.style.opacity = '0';
                el.style.transform = 'translateY(20px)';
                el.style.transition = `opacity 0.6s ease ${index * 0.1}s, transform 0.6s ease ${index * 0.1}s`;
                observer.observe(el);
            });
        });

        // Hover effect untuk cards
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.shadow-md');
            cards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-5px)';
                    this.style.boxShadow = '0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04)';
                });
                
                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                    this.style.boxShadow = '0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06)';
                });
            });
        });

        // Loading animation untuk buttons
        document.addEventListener('DOMContentLoaded', function() {
            const buttons = document.querySelectorAll('button, .bg-blue-600, .bg-green-600, .bg-purple-600, .bg-yellow-600');
            buttons.forEach(button => {
                button.style.transition = 'all 0.3s ease';
                
                button.addEventListener('click', function(e) {
                    // Ripple effect
                    const ripple = document.createElement('span');
                    const rect = this.getBoundingClientRect();
                    const size = Math.max(rect.width, rect.height);
                    const x = e.clientX - rect.left - size / 2;
                    const y = e.clientY - rect.top - size / 2;
                    
                    ripple.style.cssText = `
                        position: absolute;
                        width: ${size}px;
                        height: ${size}px;
                        left: ${x}px;
                        top: ${y}px;
                        background: rgba(255, 255, 255, 0.3);
                        border-radius: 50%;
                        transform: scale(0);
                        animation: ripple 0.6s linear;
                        pointer-events: none;
                    `;
                    
                    this.style.position = 'relative';
                    this.style.overflow = 'hidden';
                    this.appendChild(ripple);
                    
                    setTimeout(() => ripple.remove(), 600);
                });
            });
        });

        // Smooth fade-in effect untuk text
        document.addEventListener('DOMContentLoaded', function() {
            const titles = document.querySelectorAll('h1');
            titles.forEach(title => {
                title.style.opacity = '0';
                title.style.transform = 'translateY(10px)';
                title.style.transition = 'opacity 0.8s ease, transform 0.8s ease';
                
                setTimeout(() => {
                    title.style.opacity = '1';
                    title.style.transform = 'translateY(0)';
                }, 100);
            });
            
            // Typing effect untuk .typing-text
            const typingElements = document.querySelectorAll('.typing-text');
            typingElements.forEach(element => {
                const text = element.textContent;
                element.textContent = '';
                element.style.borderRight = '2px solid #60A5FA';
                element.style.opacity = '1';
                
                let i = 0;
                const typeWriter = () => {
                    if (i < text.length) {
                        element.textContent += text.charAt(i);
                        i++;
                        setTimeout(typeWriter, 50);
                    } else {
                        setTimeout(() => {
                            element.style.borderRight = 'none';
                        }, 500);
                    }
                };
                
                setTimeout(typeWriter, 1500);
            });
            
            // Smooth fade-in untuk deskripsi lainnya
            const descriptions = document.querySelectorAll('p:not(.typing-text)');
            descriptions.forEach((desc, index) => {
                desc.style.opacity = '0';
                desc.style.transform = 'translateY(10px)';
                desc.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
                
                setTimeout(() => {
                    desc.style.opacity = '1';
                    desc.style.transform = 'translateY(0)';
                }, 300 + (index * 100));
            });
        });

        // CSS untuk ripple animation
        const style = document.createElement('style');
        style.textContent = `
            @keyframes ripple {
                to {
                    transform: scale(4);
                    opacity: 0;
                }
            }
            
            .shadow-md {
                transition: all 0.3s ease;
            }
            
            .navbar-brand {
                animation: pulse 2s infinite;
            }
            
            @keyframes pulse {
                0%, 100% { transform: scale(1); }
                50% { transform: scale(1.05); }
            }
        `;
        document.head.appendChild(style);
    </script>
    
    @stack('scripts')
</body>
</html>
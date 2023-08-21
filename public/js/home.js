let stars = document.getElementById('stars');

onscroll = function(){
    let val = this.scrollY;
    stars.style.left = val * 2 + 'px';

}
const navItems = document.querySelectorAll('.nav-item a');
const aboutLink = document.querySelector('.nav-item a[href="#about"]');
const contactLink = document.querySelector('.nav-item a[href="#contact"]');
const homeLink = document.querySelector('.nav-item a[href="#home"]');
const aboutContent = document.getElementById('about-content');
const homeContent = document.getElementById('home-content');
const contactContent = document.getElementById('contact-content');

        navItems.forEach(item => {
            item.addEventListener('click', () => {
                navItems.forEach(item => {
                    item.classList.remove('active');
                });
                item.classList.add('active');
            });
        });
        
        aboutLink.addEventListener('click', event => {
            event.preventDefault();
            homeContent.style.display = 'none';
            contactContent.style.display = 'none';
            aboutContent.style.display = 'block';
        });

contactLink.addEventListener('click', event => {
    event.preventDefault();
    homeContent.style.display = 'none';
    aboutContent.style.display = 'none';
    contactContent.style.display = 'block';
});
homeLink.addEventListener('click', event => {
    event.preventDefault();
    aboutContent.style.display = 'none';
    contactContent.style.display = 'none';
    homeContent.style.display = 'block';
});
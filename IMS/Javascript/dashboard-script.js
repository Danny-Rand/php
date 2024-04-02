var sideBarIsOpen = true;
toggleBtn.addEventListener('click', (event) => {
    event.preventDefault();

    if (sideBarIsOpen) {
        dashboardSidebar.style.width = '10%';
        dashboardSidebar.style.transition = '0.3s all';
        dashboardContentContainer.style.width = '90%';
        dashboardLogo.style.fontSize = '40px';
        userImage.style.width = '60px';

        menuIcons = document.getElementsByClassName('menuText');
        for (var i = 0; i < menuIcons.length; i++) {
            menuIcons[i].style.display = 'none';
        }

        document.getElementsByClassName('dashboardMenuList')[0].style.textAlign = 'center';
        sideBarIsOpen = false;
    } else {
        dashboardSidebar.style.width = '20%';
        dashboardSidebar.style.transition = '0.3s all';
        dashboardContentContainer.style.width = '80%';
        dashboardLogo.style.fontSize = '40px';
        userImage.style.width = '60px';

        menuIcons = document.getElementsByClassName('menuText');
        for (var i = 0; i < menuIcons.length; i++) {
            menuIcons[i].style.display = 'inline-block';
        }

        document.getElementsByClassName('dashboardMenuList')[0].style.textAlign = 'left';
        sideBarIsOpen = true;
    }
});

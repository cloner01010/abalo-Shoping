/*
Test Menü
document.addEventListener('DOMContentLoaded', function () {
    let menuItems = [
        { label: 'Home', link: "/" },
        { label: 'Kategorien', link: '#' },
        {
            label: 'Verkaufen', link: '#',
            submenu: [
                { label: 'Neuer Artikel', link: '/newarticle' },
            ]
        },
        {
            label: 'Unternehmen',
            link: '#',
            submenu: [
                { label: 'Philosophie', link: '#' },
                { label: 'Karriere', link: '#' }
            ]
        }
    ];
*/
class Navigation {
    constructor(items) {
        this.items = items;
        this.kategorien = [];
    }


    setKategorien(kategorien) {
        this.kategorien = kategorien;
    }

    render(targetElementId) {
        const targetElement = document.getElementById(targetElementId);
        const menuList = document.createElement('ul');
        menuList.classList.add('menu-list');

        this.items.forEach(item => {
            const menuItem = document.createElement('li');
            const menuItemLink = document.createElement('a');
            menuItemLink.textContent = item.label;
            menuItemLink.href = item.link;
            menuItem.appendChild(menuItemLink);

            if (item.submenu) {
                const submenuList = document.createElement('ul');
                submenuList.classList.add('submenu-list');

                item.submenu.forEach(submenuItem => {
                    const submenuListItem = document.createElement('li');
                    const submenuItemLink = document.createElement('a');
                    submenuItemLink.textContent = submenuItem.label;
                    submenuItemLink.href = submenuItem.link;
                    submenuListItem.appendChild(submenuItemLink);
                    submenuList.appendChild(submenuListItem);
                });
                menuItem.appendChild(submenuList);
            } else if (item.label === 'Kategorien') {
                const submenuList = document.createElement('ul');
                submenuList.classList.add('submenu-list');

                this.kategorien.forEach(kategorie => {
                    const submenuListItem = document.createElement('li');
                    const submenuItemLink = document.createElement('a');
                    submenuItemLink.textContent = kategorie.ab_name;
                    submenuItemLink.href = '#';
                    submenuListItem.appendChild(submenuItemLink);
                    submenuList.appendChild(submenuListItem);
                });

                menuItem.appendChild(submenuList);
            }
            menuList.appendChild(menuItem);
        });
        targetElement.appendChild(menuList);
    }
}



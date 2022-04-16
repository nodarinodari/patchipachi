class btnDropDwon {
    constructor(btn, i, cts, menu) {
        // this.btn = document.getElementsByClassName(btn).item(i);
        this.btn = document.querySelectorAll(btn).item(i);
        // const btn = document.getElementsByClassName('.btnOpen').item(0);
        this.cts = document.querySelector(cts);
        // const ghSign = document.querySelector('.gh-sign');
        this.menu = document.querySelector(menu);
        // menu = document.querySelector('.maker-menu');
        this.menuH= this.menu.clientHeight;
        // menuH = menu.clientHeight;
        this.menu.style.height = '0px';
        // menu.style.height = '0px';
        this._addList();
    }
    
    _addList() {
        this.btn.addEventListener('click', () => {
            this.menu.style.height === '0px' ? this.menu.style.height = this.menuH + 'px' : this.menu.style.height = '0px';
            this._toggle()
        }, false);
    }
    
    _toggle() {
        this.cts.classList.toggle('rota')
        this.btn.classList.toggle('inview')
        // this._addList();
    }
}

const so1 = new btnDropDwon('.btnOpen-1', 0,'.gh-sign-1','.maker-company-menu-1');
const so2 = new btnDropDwon('.btnOpen-2', 0,'.gh-sign-2','.maker-company-menu-2');
const so3 = new btnDropDwon('.btnOpen-3', 0,'.gh-sign-3','.maker-company-menu-3');
const so4 = new btnDropDwon('.btnOpen-4', 0,'.gh-sign-4','.maker-company-menu-4');
const so5 = new btnDropDwon('.btnOpen-5', 0,'.gh-sign-5','.maker-company-menu-5');
const so6 = new btnDropDwon('.btnOpen-6', 0,'.gh-sign-6','.maker-company-menu-6');
const so7 = new btnDropDwon('.btnOpen-7', 0,'.gh-sign-7','.maker-company-menu-7');
const so8 = new btnDropDwon('.btnOpen-8', 0,'.gh-sign-8','.maker-company-menu-8');
const so9 = new btnDropDwon('.btnOpen-9', 0,'.gh-sign-9','.maker-company-menu-9');
const so10 = new btnDropDwon('.btnOpen-10', 0,'.gh-sign-10','.maker-company-menu-10');
const so11 = new btnDropDwon('.btnOpen-11', 0,'.gh-sign-11','.maker-company-menu-11');
const so12 = new btnDropDwon('.btnOpen-12', 0,'.gh-sign-12','.maker-company-menu-12');

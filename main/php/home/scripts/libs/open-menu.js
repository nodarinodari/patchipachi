class MobileMenu {
    constructor() {
        this.DOM = {};
        this.DOM.btn = document.querySelector('.mobile-menu__btn');
        this.DOM.container = document.querySelector('#container');
        this.DOM.global = document.querySelector('#global-container');
        this.eventType = this._getEventType()
        this._addEvent();
    }
    
    _getEventType() {
        const isTouchCapable = "ontouchstart" in window ||
        (window.DocumentTouch && document instanceof window.DocumentTouch)
            navigator.maxTouchPoints > 0 ||
            window.navigator.msMaxTouchPoints > 0;
            return isTouchCapable ? "touchstart" : "click";
        
    }

    _toggle() {
        /* menu-openを付けたり消したりする */
        this.DOM.container.classList.toggle('menu-open');
    }

    _addEvent() {
        // イベントを追加する
        this.DOM.btn.addEventListener('click', this._toggle.bind(this));
        // this.DOM.global.addEventListener('click', this._toggle.bind(this));
    }
}
// インスタンス化はmain.jsのほうで


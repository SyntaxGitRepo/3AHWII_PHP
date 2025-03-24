class Genre_selector extends HTMLElement {
    constructor() {
        super();
    }

    connectedCallback() {
        var rawChilds = this.children

        var childs = []
        for (let i = 0; i < rawChilds.length; i++) {
            if (rawChilds[i].tagName.toLowerCase() === 'option') {
                childs.push(rawChilds[i]);
            }
        }

        this.selected_div = document.createElement('div');
        this.selected_div.classList.add('genre-selected-div');
        this.selected_div.className = 'genre-selected-div';
        this.appendChild(this.selected_div);

        this.input = document.createElement('input');
        this.input.type = 'text';
        this.input.id = 'genre-selector-input';
        this.input.name = 'genre-selector-input';
        this.appendChild(this.input);

        this.auto_fill_div = document.createElement('div');
        this.auto_fill_div.className = 'auto-fill-div';
        this.auto_fill_div.style.visibility = 'hidden';
        this.appendChild(this.auto_fill_div);

        for (let i = 0; i < childs.length; i++) {
            var div = document.createElement('div');
            div.innerHTML = childs[i].value;

            this.auto_fill_div.appendChild(div);
        }

        this.input.addEventListener('input', (event) => {
            this.auto_fill_div.style.visibility = 'visible';
        });
    }
}

customElements.define('genre-selector', Genre_selector);
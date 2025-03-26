class Genre_selector extends HTMLElement {
    constructor() {
        super();
    }

    connectedCallback() {
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



        this.input.addEventListener('input', (event) => {
            this.auto_fill_div.style.visibility = 'visible';
            this.auto_fill_div.innerHTML = "";

            let inputText = this.input.value;

            let children = this._getOptionChildren();
            for (let i = 0; i < children.length; i++) {
                console.log(children[i].value.substring(0, inputText.length).toLowerCase())

                if (children[i].value.substring(0, inputText.length).toLowerCase() === inputText.toLowerCase()) {
                    console.log(children[i].value.substring(0, inputText.length).toLowerCase())
                    let div = document.createElement('div');
                    div.innerHTML = children[i].value;

                    this.auto_fill_div.appendChild(div);
                }

                if (i >= 4) break
            }

            if (children.length > 5) this.auto_fill_div.style.height = "125px";
            else this.auto_fill_div.style.height = children.length * 25 + "px";
        });

        this.input.addEventListener('focusout', (event) => {
            this.auto_fill_div.style.visibility = 'hidden';

            this.auto_fill_div.innerHTML = "";
        })
    }

    _getOptionChildren() {
        const rawChilds = this.children;

        let children = []
        for (let i = 0; i < rawChilds.length; i++) {
            if (rawChilds[i].tagName.toLowerCase() === 'option') {
                children.push(rawChilds[i]);
            }
        }

        return children
    }
}

customElements.define('genre-selector', Genre_selector);


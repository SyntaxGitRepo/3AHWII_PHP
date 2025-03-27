class GenreSelector extends HTMLElement {
    constructor() {
        super();
    }

    connectedCallback() {
        this._createSubmissionInput();
        this._createSelectedGenresDiv();
        this._createAutoCompleteDiv();
        this._createUserInput();
    }

    _getGenres() {
        const children = this.children;
        let genres = []

        for (let i = 0; i < children.length; i++) {
            if (children[i].tagName.toLowerCase() === 'option') {
                genres.push(children[i]);
            }
        }

        return genres
    }

    hideAutoCompleteDiv() {
        this.autoCompleteDiv.style.visibility = "hidden";
        this.autoCompleteDiv.innerHTML = "";
    }

    _updateSubmissionInput() {
        this.SubmissionInput.value = "";
        let genresSelectedRaw = this.selectedGenresDiv.children;

        for (let i = 0; i < genresSelectedRaw.length; i++) {
            if (i !== 0) this.SubmissionInput.value += "; "

            this.SubmissionInput.value += genresSelectedRaw[i].id;
        }
    }

    _createSubmissionInput() {
        this.SubmissionInput = document.createElement("input");
        this.SubmissionInput.setAttribute("type", "hidden");
        this.SubmissionInput.setAttribute("name", "genre");
        this.SubmissionInput.setAttribute("value", "");
        this.appendChild(this.SubmissionInput);
    }

    _createSelectedGenresDiv() {
        this.selectedGenresDiv = document.createElement('div');
        this.selectedGenresDiv.classList.add('selected-genres-div');
        this.selectedGenresDiv.style.height = '0';
        this.appendChild(this.selectedGenresDiv);
    }

    _createAutoCompleteDiv() {
        this.autoCompleteDiv = document.createElement('div');
        this.autoCompleteDiv.className = 'auto-complete-div';
        this.autoCompleteDiv.setAttribute('id', 'auto-complete-div');
        this.autoCompleteDiv.style.visibility = 'hidden';
        this.autoCompleteDiv.style.top = '35px';
        this.appendChild(this.autoCompleteDiv);
    }

    _createUserInput() {
        this.userInput = document.createElement('input');
        this.userInput.setAttribute('type', 'text');
        this.userInput.addEventListener('input', (event) => {this._userInputChanged(event);});
        this.appendChild(this.userInput);
    }

    _userInputChanged(event) {
        this.autoCompleteDiv.style.visibility = 'visible';
        this.autoCompleteDiv.innerHTML = '';

        let inputText = this.userInput.value.toLowerCase().trim();
        let genres = this._getGenres();
        let numOfGenresDisplayed = 0;

        for (let i = 0; i < genres.length; i++) {
            let genre = genres[i];
            let genreStartName = genre.value.substring(0, inputText.length).toLowerCase().trim();

            if (inputText !== genreStartName) continue

            let genreDiv = document.createElement('div');
            genreDiv.innerHTML = genre.value;
            genreDiv.id = genre.id;
            genreDiv.addEventListener('click', (event) => {this._genreSelected(event);});
            this.autoCompleteDiv.appendChild(genreDiv);

            numOfGenresDisplayed++;
            if (numOfGenresDisplayed > 6) break
        }

        if (this.autoCompleteDiv.children.length > 7) this.autoCompleteDiv.style.height = "175px";
        else this.autoCompleteDiv.style.height = this.autoCompleteDiv.children.length * 25 + "px";
    }

    _genreSelected(event) {
        let genreSelectedDiv = document.createElement("div");
        genreSelectedDiv.innerHTML = event.target.innerText;
        genreSelectedDiv.id = event.target.id;

        this.selectedGenresDiv.style.height = '35px';
        this.autoCompleteDiv.style.top = '70px';

        let genreOptions = this.children;
        for (let i = 0; i < genreOptions.length; i++) {
            if (genreOptions[i].tagName.toLowerCase() !== 'option') continue;

            if (genreOptions[i].value.trim() === event.target.innerText.trim()) {
                this.removeChild(genreOptions[i]);
            }
        }

        genreSelectedDiv.addEventListener('click', event => {
            let genreOption = document.createElement('option');
            genreOption.value = genreSelectedDiv.innerHTML;
            genreOption.id = event.target.id;
            this.selectedGenresDiv.removeChild(genreSelectedDiv);

            this.selectedGenresDiv.style.height = '';
            this.autoCompleteDiv.style.top = '35px';

            this.appendChild(genreOption);
            this._updateSubmissionInput()
        });
        this.selectedGenresDiv.appendChild(genreSelectedDiv);
        this._updateSubmissionInput()

        this.hideAutoCompleteDiv();
        this.userInput.value = "";
    }
}

document.addEventListener('click', (event) => {
    document.getElementById("auto-complete-div").style.visibility = "hidden";
    document.getElementById("auto-complete-div").innerHTML = "";
});

customElements.define('genre-selector', GenreSelector);
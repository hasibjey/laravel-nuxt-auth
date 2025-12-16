class xMultiSelector {
    constructor({
        containerSelector,
        title = 'Select item',
        subTitle = '',
        placeholder = 'Select items',
        name = '',
        itemLimit = Infinity,
        itemField = ['id', 'label'],
        update = []
    }) {
        this.container = document.querySelector(containerSelector);

        if (!this.container) {
            console.error(`xMultiSelector: Container "${containerSelector}" not found`);
            return;
        }

        this.title = title;
        this.subTitle = subTitle;
        this.placeholder = placeholder;
        this.name = name;
        this.itemLimit = itemLimit;
        this.itemField = itemField;
        this.update = Array.isArray(update) ? update : [];

        this.targets = this.parseDataTargets();
        this.buildUI();
        this.init();
        
        

        // Pre-select items if update array is provided
        if (this.update.length) {
            this.preSelect();
        }
    }

    parseDataTargets() {
        try {
            const raw = this.container.getAttribute('data-target');
            return raw ? JSON.parse(raw) : [];
        } catch (e) {
            console.error('xMultiSelector: Invalid data-target JSON →', e);
            return [];
        }
    }

    buildSearchBox() {
        const input = document.createElement('input');
        input.type = 'text';
        input.placeholder = 'Search...';
        input.className = 'w-full px-2 py-1 text-sm border-b border-gray-300 outline-none';
        input.addEventListener('input', (e) => this.filterItems(e.target.value));
        return input;
    }

    buildDropdown() {
        const ul = document.createElement('ul');
        ul.className = 'multiSelector-items text-sm border border-gray-300 rounded-md mt-1 absolute bg-white z-50 w-full hidden max-h-48 overflow-y-auto';

        this.searchInput = this.buildSearchBox();
        ul.appendChild(this.searchInput);

        this.itemElements = [];

        this.targets.forEach(item => {
            const li = document.createElement('li');
            li.setAttribute('data-id', item[this.itemField[0]]);
            li.setAttribute('data-label', item[this.itemField[1]]);
            li.className = 'py-1 px-2 hover:bg-gray-100 cursor-pointer';
            li.textContent = item[this.itemField[1]];

            li.addEventListener('click', () => this.selectItem(li));
            ul.appendChild(li);
            this.itemElements.push(li);
        });

        return ul;
    }

    filterItems(searchTerm) {
        const term = searchTerm.toLowerCase();
        this.itemElements.forEach(li => {
            const text = li.textContent.toLowerCase();
            li.style.display = text.includes(term) ? '' : 'none';
        });
    }

    buildUI() {
        const valueHTML = `
            <label class="block mb-2 font-semibold text-gray-700 capitalize">
                ${this.title} <small class="font-normal text-gray-400">${this.subTitle}</small>
            </label>
            <select class="selected-values w-full hidden" name="${this.name}" multiple></select>
            <div class="multiSelector-value w-full border border-gray-300 rounded-md py-2 px-2 text-sm flex flex-wrap gap-1 cursor-default min-h-[40px]">
                <span class="placeholder text-gray-400">${this.placeholder}</span>
            </div>
        `;

        this.container.innerHTML = valueHTML;
        this.dropdown = this.buildDropdown();
        this.container.appendChild(this.dropdown);

        this.input = this.container.querySelector('.selected-values'); // select field
        this.valueBox = this.container.querySelector('.multiSelector-value');
    }

    init() {
        this.valueBox.addEventListener('click', () => this.toggleDropdown());

        document.addEventListener('click', (e) => {
            if (!this.container.contains(e.target)) {
                this.dropdown.classList.add('hidden');
            }
        });
    }

    toggleDropdown() {
        this.dropdown.classList.toggle('hidden');
        if (!this.dropdown.classList.contains('hidden')) {
            this.searchInput.value = '';
            this.filterItems('');
        }
    }

    selectItem(el) {
        const selectedCount = this.valueBox.querySelectorAll('[data-selected]').length;
        if (selectedCount >= this.itemLimit) {
            alert(`You can select up to ${this.itemLimit} item(s).`);
            return;
        }

        const value = el.dataset.id;
        const label = el.dataset.label;

        if (this.valueBox.querySelector(`[data-selected="${value}"]`)) return;

        const tag = document.createElement('span');
        tag.className = 'bg-gray-100 text-gray-800 px-2 py-1 rounded text-xs flex items-center gap-1';
        tag.setAttribute('data-selected', value);
        tag.innerHTML = `${label} <button type="button" class="cursor-pointer hover:text-red-600">&times;</button>`;

        tag.querySelector('button').addEventListener('click', () => {
            tag.remove();
            this.updateInput();
        });

        const placeholder = this.valueBox.querySelector('.placeholder');
        if (placeholder) placeholder.remove();

        this.valueBox.appendChild(tag);
        this.updateInput();
        this.toggleDropdown();
    }

    updateInput() {
        const selected = [...this.valueBox.querySelectorAll('[data-selected]')]
            .map(span => span.getAttribute('data-selected'));

        // Clear existing options
        this.input.innerHTML = '';

        // Add selected options to the <select>
        selected.forEach(val => {
            const option = document.createElement('option');
            option.value = val;
            option.selected = true;
            this.input.appendChild(option);
        });

        // Show placeholder if empty
        if (selected.length === 0) {
            const placeholder = document.createElement('span');
            placeholder.className = 'placeholder text-gray-400';
            placeholder.textContent = this.placeholder;
            this.valueBox.appendChild(placeholder);
        }
    }

    preSelect() {
        // Go through targets and select if id exists in update array
        this.targets.forEach(item => {
            if (this.update.includes(item[this.itemField[0]])) {
                const fakeEl = {
                    dataset: {
                        id: item[this.itemField[0]],
                        label: item[this.itemField[1]]
                    }
                };
                this.selectItem(fakeEl);
            }
        });
    }
}

class TextEditor {
  constructor(selector) {
    this.container = document.querySelector(selector);
    this.init();
  }

  init() {
    this.container.innerHTML = `
        <div class="x-editor">
          <div class="editor-toolbar flex flex-wrap gap-2 mb-2">
            ${this.toolbarButtons()}
          </div>
          <div contenteditable="true" class="editor-area min-h-[200px] p-4 border bg-white shadow-sm leading-relaxed">
            <p><br></p>
          </div>
        </div>
    `;

    this.editor = this.container.querySelector('.editor-area');

    // Enable paragraph wrapping
    document.execCommand('defaultParagraphSeparator', false, 'p');

    // Handle toolbar button commands
    this.container.querySelectorAll('[data-cmd]').forEach(btn => {
      btn.addEventListener('click', () => {
        const command = btn.dataset.cmd;
        const value = btn.dataset.val || null;

        if (command === 'createLink' || command === 'insertImage') {
          const url = prompt('Enter URL:');
          if (url) document.execCommand(command, false, url);
        } else {
          document.execCommand(command, false, value);
        }
      });
    });

    // Handle color inputs and font size
    this.container.querySelectorAll('input[type="color"]').forEach(input => {
      input.addEventListener('input', () => {
        const cmd = input.dataset.cmd;
        const val = input.value;
        document.execCommand(cmd, false, val);

        // Update adjacent SVG icon color
        const svg = input.closest('label')?.querySelector('svg');
        console.log(svg);
        
        if (svg) {
          svg.style.color = val;
          svg.style.background = val;
        }
      });
    });

    this.container.querySelectorAll('select').forEach(select => {
      select.addEventListener('change', () => {
        const cmd = select.dataset.cmd;
        const val = select.value;
        document.execCommand(cmd, false, val);
      });
    });

  }

  toolbarButtons() {
    return `
        <select name="tools-select" data-cmd="fontSize" class="bg-white rounded border border-gray-300 p-1.5 text-sm">
          <option value="1">Small</option>
          <option value="3" selected>Normal</option>
          <option value="7">H1</option>
          <option value="5">H2</option>
        </select>
        <div class="tools-group">
          <button class="tools-btn" data-cmd="bold">
              <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M8 5h4.5a3.5 3.5 0 1 1 0 7H8m0-7v7m0-7H6m2 7h6.5a3.5 3.5 0 1 1 0 7H8m0-7v7m0 0H6" />
              </svg>
          </button>
          <button class="tools-btn" data-cmd="italic">
              <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="m8.874 19 6.143-14M6 19h6.33m-.66-14H18" />
              </svg>
          </button>
          <button class="tools-btn" data-cmd="underline">
              <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                  <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                      d="M6 19h12M8 5v9a4 4 0 0 0 8 0V5M6 5h4m4 0h4" />
              </svg>
          </button>
      </div>

      <div class="tools-group">
          <button class="tools-btn" data-cmd="justifyLeft">
              <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M6 6h8m-8 4h12M6 14h8m-8 4h12" />
              </svg>
          </button>
          <button class="tools-btn" data-cmd="justifyCenter">
              <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M8 6h8M6 10h12M8 14h8M6 18h12" />
              </svg>
          </button>
          <button class="tools-btn" data-cmd="justifyRight">
              <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M18 6h-8m8 4H6m12 4h-8m8 4H6" />
              </svg>
          </button>
      </div>

      <div class="tools-group">
          <button class="tools-btn" data-cmd="insertOrderedList">
              <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M12 6h8m-8 6h8m-8 6h8M4 16a2 2 0 1 1 3.321 1.5L4 20h5M4 5l2-1v6m-2 0h4" />
              </svg>
          </button>
          <button class="tools-btn" data-cmd="insertUnorderedList">
              <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                  <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                      d="M9 8h10M9 12h10M9 16h10M4.99 8H5m-.02 4h.01m0 4H5" />
              </svg>
          </button>
      </div>

      <div class="tools-group">
          <button class="tools-btn" data-cmd="createLink">
              <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M13.213 9.787a3.391 3.391 0 0 0-4.795 0l-3.425 3.426a3.39 3.39 0 0 0 4.795 4.794l.321-.304m-.321-4.49a3.39 3.39 0 0 0 4.795 0l3.424-3.426a3.39 3.39 0 0 0-4.794-4.795l-1.028.961" />
              </svg>
          </button>
      </div>

      <div class="tools-group">
          <button class="tools-btn" data-cmd="createLink">
              <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="m3 16 5-7 6 6.5m6.5 2.5L16 13l-4.286 6M14 10h.01M4 19h16a1 1 0 0 0 1-1V6a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1Z" />
              </svg>
          </button>
      </div>
      <div class="tools-group">
          <button class="tools-btn relative" data-cmd="foreColor">
              <label class="relative !m-0 !p-0">
                <input type="color" data-cmd="foreColor" class="invisible absolute w-0" title="Text Color">
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                  <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="m6.08169 15.9817 1.57292-4m-1.57292 4h-1.1m1.1 0h1.65m-.07708-4 2.72499-6.92967c.0368-.09379.1673-.09379.2042 0l2.725 6.92967m-5.65419 0h-.00607m.00607 0h5.65419m0 0 .6169 1.569m5.1104 4.453c0 1.1025-.8543 1.9963-1.908 1.9963s-1.908-.8938-1.908-1.9963c0-1.1026 1.908-4.1275 1.908-4.1275s1.908 3.0249 1.908 4.1275Z"/>
                </svg>
              </label>
          </button>
          <button class="tools-btn relative" data-cmd="hiliteColor">
              <label class="relative !m-0 !p-0">
                <input type="color" data-cmd="hiliteColor" class="invisible absolute w-0" title="Background Color">
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                  <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="m6.08169 15.9817 1.57292-4m-1.57292 4h-1.1m1.1 0h1.65m-.07708-4 2.72499-6.92967c.0368-.09379.1673-.09379.2042 0l2.725 6.92967m-5.65419 0h-.00607m.00607 0h5.65419m0 0 .6169 1.569m5.1104 4.453c0 1.1025-.8543 1.9963-1.908 1.9963s-1.908-.8938-1.908-1.9963c0-1.1026 1.908-4.1275 1.908-4.1275s1.908 3.0249 1.908 4.1275Z"/>
                </svg>
              </label>
          </button>
      </div>
    `;
  }
}

// Tailwind button styling via JS
const style = document.createElement('style');
style.innerHTML = `
`;
document.head.appendChild(style);

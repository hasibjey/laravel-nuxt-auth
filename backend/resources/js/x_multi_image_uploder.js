export class xMultiImageUpload {
    constructor({
        name = "image",
        containerSelector = ".single-image",
        title = "Image Upload",
        subTitle = "",
        multiple = false,
        columns = 3,
        height = 150,
        fileLimit = 1,
        preload = [],
        dbField = '',
        deleteUrl = ''
    }) {
        this.baseUrl = window.location.origin;
        this.name = name;
        this.container = document.querySelector(containerSelector);
        this.title = title;
        this.subTitle = subTitle;
        this.multiple = multiple;
        this.columns = columns;
        this.height = height + "px";
        this.fileLimit = fileLimit;
        this.preloads = preload;
        this.dbField = dbField;
        this.files = [];
        this.deleteUrl = deleteUrl;

        if (!this.container) {
            console.error("Container not found:", containerSelector);
            return;
        }

        this.init();
    }

    init() {
        // Create label + preview container
        this.container.innerHTML = `
            <label class="flex items-start mb-2 font-semibold text-gray-700">
                ${this.title}
                <small class="font-normal text-gray-400 ml-2">${this.subTitle}</small>
            </label>
            <div class="grid grid-cols-${this.columns} gap-2 x-multi-image-upload-preview"></div>
        `;
        this.previewContainer = this.container.querySelector(".x-multi-image-upload-preview");

        // Render preloaded images
        this.renderPreloads();

        // Decide if upload box should be shown
        const preloadCount = Array.isArray(this.preloads)
            ? this.preloads.filter(p => p[this.dbField]).length
            : (this.preloads[this.dbField] ? 1 : 0);

        if (preloadCount < this.fileLimit) {
            this.renderUploadBox();
        }

    }

    renderUploadBox() {
        const uploadLabel = document.createElement("label");
        uploadLabel.className = "upload-demo border border-dashed border-gray-400 w-full h-full rounded cursor-pointer p-1 relative overflow-hidden group flex justify-center items-center";
        uploadLabel.style.height = this.height;

        uploadLabel.innerHTML = `
            <input type="file" class="hidden" ${this.multiple ? "multiple" : ""} accept="image/*" name="${this.name}">
            <p class="text-gray-400 absolute top-1/2 -translate-y-1/2 w-full text-center font-semibold italic">Click or drag & drop</p>
        `;

        this.fileInput = uploadLabel.querySelector("input[type=file]");
        this.fileInput.addEventListener("change", e => this.handleFileSelect(e));

        // Drag & drop events
        ["dragenter", "dragover"].forEach(ev => {
            uploadLabel.addEventListener(ev, e => {
                e.preventDefault();
                e.stopPropagation();
                uploadLabel.classList.add("border-blue-500");
            });
        });
        ["dragleave", "drop"].forEach(ev => {
            uploadLabel.addEventListener(ev, e => {
                e.preventDefault();
                e.stopPropagation();
                uploadLabel.classList.remove("border-blue-500");
            });
        });
        uploadLabel.addEventListener("drop", e => {
            const droppedFiles = Array.from(e.dataTransfer.files).filter(f => f.type.startsWith("image/"));
            this.handleFileSelect({ target: { files: droppedFiles } });
        });

        this.previewContainer.appendChild(uploadLabel);
        this.uploadDemo = uploadLabel;
    }

    renderPreloads() {
        if (!Array.isArray(this.preloads)) {
            this.preloadContent(this.preloads);
        } else {
            this.preloads.forEach(preload => this.preloadContent(preload));
        }
    }

    preloadContent(preload) {
        if (preload[this.dbField]) {
            const div = document.createElement("div");
            div.className = "relative border border-dashed rounded overflow-hidden";

            const img = document.createElement("img");
            img.src = `${this.baseUrl}${preload[this.dbField]}`;
            img.className = "w-full h-full object-cover p-1";

            const delBtn = document.createElement("span");
            delBtn.className = "absolute top-1 right-1 bg-red-500 text-white rounded-full cursor-pointer p-0.5";
            delBtn.innerHTML = `
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                     stroke-width="2" stroke="currentColor" class="w-4 h-4">
                     <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"/>
                </svg>
            `;
            delBtn.addEventListener("click", () => this.handlePreloadDelete(preload, div, this.deleteUrl));

            div.appendChild(img);
            div.appendChild(delBtn);
            this.previewContainer.appendChild(div);
        }
    }

    handleFileSelect(event) {
        const files = Array.from(event.target.files);
        const totalImages = this.previewContainer.querySelectorAll("img").length + files.length;

        if (totalImages > this.fileLimit) {
            alert(`You can only upload up to ${this.fileLimit} image(s).`);
            return;
        }

        files.forEach(file => {
            // Extra validation
            if (!file.type.startsWith("image/")) return;
            if (file.size > 5 * 1024 * 1024) { // 5 MB limit
                alert("File too large! Max 5MB.");
                return;
            }

            const reader = new FileReader();
            reader.onload = e => this.addImageToPreview(e.target.result, file);
            reader.readAsDataURL(file);
        });
    }

    addImageToPreview(imageSrc, file) {
        const div = document.createElement("div");
        div.className = "relative border border-dashed rounded overflow-hidden";

        const img = document.createElement("img");
        img.src = imageSrc;
        img.className = "w-full h-full object-cover";

        const delBtn = document.createElement("span");
        delBtn.className = "absolute top-1 right-1 bg-red-500 text-white rounded-full cursor-pointer p-0.5";
        delBtn.innerHTML = `
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                 stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                 <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"/>
            </svg>
        `;
        delBtn.addEventListener("click", () => {
            div.remove();
            this.files = this.files.filter(f => f !== file);
            if (this.uploadDemo && this.previewContainer.querySelectorAll("img").length < this.fileLimit) {
                this.uploadDemo.style.display = "flex";
            }
        });

        div.appendChild(img);
        div.appendChild(delBtn);
        this.previewContainer.appendChild(div);

        this.files.push(file);

        if (this.uploadDemo && this.previewContainer.querySelectorAll("img").length >= this.fileLimit) {
            this.uploadDemo.style.display = "none";
        }
    }

    handlePreloadDelete(preload, element, deleteUrl) {
        if (confirm("Are you sure you want to delete this image?")) {
            fetch(`${this.baseUrl}${deleteUrl}${preload.id}`, {
                method: "GET",
                headers: {
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                }
            }).then(res => res.json())
                .then(data => {
                    if (data.success) {
                        element.remove();
                        if (this.uploadDemo && this.previewContainer.querySelectorAll("img").length < this.fileLimit) {
                            this.uploadDemo.style.display = "flex";
                        }
                    } else {
                        alert("Failed to delete image");
                    }
                }).catch(() => {
                    alert("Error while deleting image");
                });
        }
    }
}

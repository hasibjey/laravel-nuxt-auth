export class Cart {
    constructor() {
        this.baseUrl = window.location.origin; // ✅ set base url
    }

    popupCartHtml(item) {
        const price = window.Common.formatPrice(item.price);
        return `
            <li class="flex flex-row justify-between items-start py-2 border-gray-300 gap-5 cursor-pointer">
                <div class="relative">
                    <div
                        class="absolute -top-2 -right-1.5 bg-secondary w-6 h-6 rounded-full text-primary-1 text-xs text-center flex justify-center items-center">
                        <span class="">${ item.quantity }</span>
                    </div>
                    <img src="${this.baseUrl}${ item.image }" alt=""
                        class="w-24 h-2w-24 object-cover border rounded-sm bg-black bg-opacity-50" />
                </div>
                <div class="w-full group">
                    <h2 class="">
                        <a href="" class="transition-300 group-hover:text-secondary">${ item.title }</a>
                    </h2>
                    <span class="text-sm mt-2 text-secondary group-hover:text-black">
                        <span class="text-xs">TK</span>
                        <span>${ price }</span>
                    </span>
                </div>
                <div class="w-10">
                    <div
                        class="flex flex-row justify-center items-center w-8 h-8 bg-gray-100 rounded-full group cursor-pointer">
                        <span class="transition-300 group-hover:text-secondary">
                            <i class="far fa-trash-alt"></i>
                        </span>
                    </div>
                </div>
            </li>
        `;
    }
}